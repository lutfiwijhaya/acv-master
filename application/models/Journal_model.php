<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {

    private $table = "journal";

    public function get_paginated_parent_child($limit, $offset, $search = null) {
        // Get parent journals first
        $this->db->select("journal.id, journal.journal_date, journal.reference, journal.description, 
                          COUNT(journal_details.id) as detail_count,
                          SUM(journal_details.debit) as total_debit,
                          SUM(journal_details.credit) as total_credit");
        $this->db->from($this->table);
        $this->db->join("journal_details", "journal_details.journal_id = journal.id", "left");
        
        if (!empty($search)) {
            $this->db->join("coa", "coa.id = journal_details.coa_id", "left");
            $this->db->group_start()
                     ->like("coa.code", $search)
                     ->or_like("coa.name", $search)
                     ->or_like("journal.description", $search)
                     ->or_like("journal.reference", $search)
                     ->group_end();
        }
        
        $this->db->group_by("journal.id");
        $this->db->order_by("journal.journal_date", "DESC");
        $this->db->limit($limit, $offset);
        
        $parents = $this->db->get()->result();
        
        // Get children for each parent
        foreach($parents as $parent) {
            $parent->children = $this->get_journal_details($parent->id);
            // Add state for treegrid
            $parent->state = 'closed'; // or 'open' if you want expanded by default
        }
        
        return $parents;
    }
    
    public function get_journal_details($journal_id) {
        $this->db->select("journal_details.*, coa.code, coa.name, coa.sub_name");
        $this->db->from("journal_details");
        $this->db->join("coa", "coa.id = journal_details.coa_id", "left");
        $this->db->where("journal_details.journal_id", $journal_id);
        $this->db->order_by("journal_details.id", "ASC");
        
        return $this->db->get()->result();
    }
    
    public function count_all_parents($search = null) {
        $this->db->select("journal.id");
        $this->db->from($this->table);
        
        if (!empty($search)) {
            $this->db->join("journal_details", "journal_details.journal_id = journal.id", "left");
            $this->db->join("coa", "coa.id = journal_details.coa_id", "left");
            $this->db->group_start()
                     ->like("coa.code", $search)
                     ->or_like("coa.name", $search)
                     ->or_like("journal.description", $search)
                     ->or_like("journal.reference", $search)
                     ->group_end();
        }
        
        $this->db->group_by("journal.id");
        return $this->db->count_all_results();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->where("id", $id)->get($this->table)->row();
    }


   // Insert Journal Header
    public function insertHeader($data) {
        $this->db->insert($this->table_header, $data);
        return $this->db->insert_id(); // return ID yang baru dibuat
    }

    // Insert Journal Detail (bulk insert)
    public function insertDetail($data) {
        return $this->db->insert_batch($this->table_detail, $data);
    }

    // Update Journal Header
    public function updateHeader($id, $data) {
        return $this->db->where("id", $id)->update($this->table_header, $data);
    }

    // Delete old details before update
    public function deleteDetailByHeaderId($header_id) {
        return $this->db->where("journal", $header_id)->delete($this->table_detail);
    }

    // Get Journal Header by ID
    public function getHeaderById($id) {
        return $this->db->where("id", $id)->get($this->table_header)->row();
    }

    // Get Journal Details by Header ID
    public function getDetailsByHeaderId($header_id) {
        return $this->db->where("journal", $header_id)->get($this->table_detail)->result();
    }


     public function get_balance_sheet($start_date = null, $end_date = null)
    {
        $this->db->select("
            c.code as coa_code, 
            c.name as name, 
            SUM(jd.debit) as total_debit, 
            SUM(jd.credit) as total_credit
        ");
        $this->db->from("journal_details jd");
        $this->db->join("journal j", "j.id = jd.journal_id");
        $this->db->join("coa c", "c.id = jd.coa_id");

        if ($start_date && $end_date) {
            $this->db->where("j.journal_date >=", $start_date);
            $this->db->where("j.journal_date <=", $end_date);
        }

        $this->db->group_by("c.id, c.code, c.name");
        $this->db->order_by("c.code", "ASC");

        return $this->db->get()->result();
    }

    public function get_profit_loss($start_date = null, $end_date = null)
    {
        // Base query untuk mendapatkan semua data
        $this->db->select('
            cc.id as category_id,
            cc.name as category_name,
            coa.code, 
            coa.name, 
            SUM(jd.debit) as total_debit,
            SUM(jd.credit) as total_credit
        ');
        $this->db->from('journal_details jd');
        $this->db->join('journal jh', 'jd.journal_id = jh.id');
        $this->db->join('coa', 'jd.coa_id = coa.id');
        $this->db->join('coa_category cc', 'coa.category_id = cc.id');
        
        // Filter hanya Income (5) dan Expenditure (6)
        $this->db->where_in('coa.category_id', [5, 6]);
        
        if ($start_date && $end_date) {
            $this->db->where('jh.journal_date >=', $start_date);
            $this->db->where('jh.journal_date <=', $end_date);
        }
        
        $this->db->group_by('coa.id');
        $this->db->order_by('cc.id', 'ASC');
        $this->db->order_by('coa.code', 'ASC');
        
        $results = $this->db->get()->result();

        // Grouping hasil berdasarkan category_id
        $revenues = [];
        $expenses = [];

        foreach ($results as $row) {
            // Hitung amount berdasarkan normal balance
            if ($row->category_id == 5) {
                // Income: credit - debit (normal balance = credit)
                $amount = $row->total_credit - $row->total_debit;
                
                if ($amount != 0) {
                    $revenues[] = (object)[
                        'code' => $row->code,
                        'name' => $row->name,
                        'amount' => $amount
                    ];
                }
            } 
            else if ($row->category_id == 6) {
                // Expenditure: debit - credit (normal balance = debit)
                $amount = $row->total_debit - $row->total_credit;
                
                if ($amount != 0) {
                    $expenses[] = (object)[
                        'code' => $row->code,
                        'name' => $row->name,
                        'amount' => $amount
                    ];
                }
            }
        }

        // Return data yang sudah dikelompokkan
        return [
            'revenues' => $revenues,        // Category ID 5 (Income)
            'expenses' => $expenses         // Category ID 6 (Expenditure)
        ];
    }
}
