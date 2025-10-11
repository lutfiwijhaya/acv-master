<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpa_model extends CI_Model {

    public function get_all($search = null, $limit = 100, $offset = 0)
    {
        // Step 1: Select the main RPA records (header data)
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.status,
            r.category,
            s.nama as supplier_name
        ");
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");

        // Step 2: Apply search filters (if any)
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("r.invoice_no", $search);
            $this->db->or_like("r.charge_code", $search);
            $this->db->or_like("s.nama", $search);
            $this->db->group_end();
        }

        // Step 3: Pagination
        $this->db->limit($limit, $offset);
        
        // Step 4: Order by RPA id descending
        $this->db->order_by("r.id", "DESC");

        // Step 5: Fetch the main RPA records
        $main_records = $this->db->get()->result_array();

        // Step 6: For each RPA record, fetch its associated details from rpa_detail
        foreach ($main_records as &$record) {
            // Step 6a: Fetch the detail records for this specific RPA
            $this->db->select("
                d.id as child_id,
                d.seq_no,
                d.coa_id,
                d.payment_by,
                d.currency,
                d.debit_amount,
                d.credit_amount,
                d.difference_amount,
                d.remark_tax_income,
                d.to_be_paid_internal,
                d.actual_expenditure,
                d.key_text,
                c.code as coa_code,
                c.name as coa_name
            ");
            $this->db->from("rpa_detail d");
            $this->db->join("coa c", "c.id = d.coa_id", "left");
            $this->db->where("d.rpa_id", $record['rpa_id']);
            $children = $this->db->get()->result_array();

            // Step 6b: Add the fetched children to the current RPA record
            $record['children'] = $children;
        }

        // Step 7: Return the final array of RPA records with nested children
        return $main_records;
    }

    public function count_all($search = null)
    {
        // Start the query on the main rpa table
        $this->db->from("rpa r");

        // Join the necessary related tables
        $this->db->join("rpa_detail d", "d.rpa_id = r.id", "left");  // Join rpa_detail table
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");  // Join tbl_supplier table

        // Apply search conditions if the search term is provided
        if (!empty($search)) {
            $this->db->group_start();  // Start the OR group
            $this->db->like("r.invoice_no", $search);  // Search by invoice_no
            $this->db->or_like("r.charge_code", $search);  // Search by charge_code
            $this->db->or_like("s.nama", $search);  // Search by supplier name
            $this->db->group_end();  // End the OR group
        }

        // Count the distinct rpa records, avoiding duplicates from rpa_detail table
        $this->db->distinct(); // Ensure distinct rpa records are counted
        $this->db->select("r.id"); // We only need the `r.id` to count the unique rpa records

        // Return the total count of distinct records after applying the search filter
        return $this->db->count_all_results();
    }
    
    // Get RPA header by ID (without details)
    public function get_by_id($id)
    {
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.status,
            r.category,
            r.supplier_id,
            r.remark_tax_income,
            r.to_be_paid_internal,
            r.actual_expenditure,
            r.approval_note,
            r.approved_by,
            s.nama as supplier_name,
            s.bank_account,
            s.rek_bank
        ");
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
        $this->db->where("r.id", $id);
        
        return $this->db->get()->row_array();
    }

    // Get RPA details by RPA ID
    public function get_detail_by_rpa_id($rpa_id)
    {
        $this->db->select("
            d.id as detail_id,
            d.rpa_id,
            d.seq_no,
            d.coa_id,
            d.payment_by,
            d.currency,
            d.debit_amount,
            d.credit_amount,
            d.difference_amount,
            d.remark_tax_income,
            d.to_be_paid_internal,
            d.actual_expenditure,
            d.key_text,
            d.remark,
            c.code as coa_code,
            c.name as coa_name
        ");
        $this->db->from("rpa_detail d");
        $this->db->join("coa c", "c.id = d.coa_id", "left");
        $this->db->where("d.rpa_id", $rpa_id);
        $this->db->order_by("d.seq_no", "ASC");
        
        return $this->db->get()->result_array();
    }

    // Get complete RPA with details (alternative method)
    public function get_with_details($id)
    {
        // Get header
        $header = $this->get_by_id($id);
        
        if (!$header) {
            return null;
        }
        
        // Get details
        $details = $this->get_detail_by_rpa_id($id);
        
        // Combine
        $header['details'] = $details;
        $header['children'] = $details; // Alias for compatibility
        
        return $header;
    }

    public function insert($data, $details)
    {
        $this->db->insert("rpa", $data);
        $rpa_id = $this->db->insert_id();
        if (is_array($details)) {
            foreach ($details as $detail) {
                $detail['rpa_id'] = $rpa_id;
                if (isset($detail['coa_code'])) {
                    $coa = $this->db->get_where('coa', ['code' => $detail['coa_code']])->row();
                    $detail['coa_id'] = $coa ? $coa->id : null;
                    unset($detail['coa_code']);
                }
                if (isset($detail['debit'])) {
                    $detail['debit_amount'] = $detail['debit'];
                    unset($detail['debit']);
                }
                if (isset($detail['credit'])) {
                    $detail['credit_amount'] = $detail['credit'];
                    unset($detail['credit']);
                }
                if (isset($detail['name'])) {
                    unset($detail['name']);
                }
                if (isset($detail['remark'])) {
                    $detail['remark_tax_income'] = $detail['remark'];
                    unset($detail['remark']);
                }
                $this->db->insert("rpa_detail", $detail); 
            }
        }
        return $rpa_id;
    }

    public function update($id, $data, $details)
    {
        $this->db->where("id", $id);
        $this->db->update("rpa", $data);

        // replace detail
        $this->db->where("rpa_id", $id)->delete("rpa_detail");
        foreach ($details as $detail) {
            $detail['rpa_id'] = $id;
            $this->db->insert("rpa_detail", $detail);
        }

        return true;
    }

    public function update_status($id, $status)
    {
        $this->db->where("id", $id);
        $this->db->update("rpa", ["status" => $status]);
        return true;
    }

    public function delete($id)
    {
        $this->db->where("rpa_id", $id)->delete("rpa_detail");
        $this->db->where("id", $id)->delete("rpa");
        return true;
    }

 
    public function approve($rpa_id, $note = '', $approved_by = null)
    {
        if (!$rpa_id) {
            return false;
        }
        
        $data = [
            'status' => 'Approved',
            'approval_date' => date('Y-m-d'),
            'note' => $note,
            'approved_by' => $approved_by,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $rpa_id);
        $this->db->update('rpa', $data);
        
        return $this->db->affected_rows() > 0;
    }

    public function reject($rpa_id, $note, $approved_by = null)
    {
        if (!$rpa_id || empty($note)) {
            return false;
        }
        
        $data = [
            'status' => 'Rejected',
            'approval_date' => date('Y-m-d'),
            'note' => $note,
            'approved_by' => $approved_by,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $rpa_id);
        $this->db->update('rpa', $data);
        
        return $this->db->affected_rows() > 0;
    }

    /**
 * Get RPA data untuk print PDF dengan join ke tbl_user untuk approved_by dan created_by
 * Method khusus untuk keperluan generate PDF
 * 
 * @param int $rpa_id ID dari tabel rpa
 * @return object|null RPA data dengan informasi user (approved_by & created_by) dan signature
 */
public function print_rpa_by_id($rpa_id)
{
    $this->db->select("
        r.id as rpa_id,
        r.invoice_no,
        r.charge_code,
        r.bill_date,
        r.request_date,
        r.approval_date,
        r.company_payment_date,
        r.status,
        r.category,
        r.supplier_id,
        r.is_posted,
        r.posted_journal_id,
        r.approved_by,
        r.created_by,
        s.nama as supplier_name,
        s.PIC_name as supplier_pic,
        s.email as supplier_email,
        s.phone as supplier_phone,
        s.address as supplier_address,
        s.bank_account,
        s.rek_bank,
        s.tax as supplier_tax,
        s.status as supplier_status,
        approved_user.nama as approved_by_name, 
        approved_user.path_ttd as approved_by_signature,
        approved_posisi.posisi as approved_by_position,
        approved_user.email as approved_by_email,
        created_user.nama as created_by_name, 
        created_user.path_ttd as created_by_signature,
        created_posisi.posisi as created_by_position,
        created_user.email as created_by_email
    ");
    $this->db->from("rpa r");
    $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
    $this->db->join("tbl_user as approved_user", "r.approved_by = approved_user._id", "left");
    $this->db->join("tbl_posisi as approved_posisi", "approved_user.posisi = approved_posisi._id", "left");
    $this->db->join("tbl_user as created_user", "r.created_by = created_user._id", "left");
    $this->db->join("tbl_posisi as created_posisi", "created_user.posisi = created_posisi._id", "left");
    $this->db->where("r.id", $rpa_id);
    
    return $this->db->get()->row();
}


/**
 * Get RPA details untuk print PDF dengan join ke COA
 * Method khusus untuk keperluan generate PDF
 * 
 * @param int $rpa_id ID dari tabel rpa
 * @return array RPA detail records dengan informasi COA lengkap
 */
public function get_rpa_details_for_print($rpa_id)
{
    $this->db->select("
        d.id as detail_id,
        d.rpa_id,
        d.seq_no,
        d.coa_id,
        d.payment_by,
        d.currency,
        d.debit_amount,
        d.credit_amount,
        d.difference_amount,
        d.remark_tax_income,
        d.to_be_paid_internal,
        d.actual_expenditure,
        d.tax_income_classification,
        d.key_text,
        d.supplementary_desc,
        d.remark,
        c.code as coa_code,
        c.name as coa_name,
        c.code,
        c.name
    ");
    $this->db->from("rpa_detail d");
    $this->db->join("coa c", "c.id = d.coa_id", "left");
    $this->db->where("d.rpa_id", $rpa_id);
    $this->db->order_by("d.seq_no", "ASC");
    
    return $this->db->get()->result();
}


/**
 * Get supplier info untuk print PDF
 * Method khusus untuk keperluan generate PDF
 * 
 * @param int $supplier_id ID dari tabel supplier
 * @return object|null Supplier data lengkap
 */
public function get_supplier_for_print($supplier_id)
{
    if (!$supplier_id) {
        return null;
    }
    
    $this->db->select("
        id,
        nama,
        PIC_name,
        email,
        phone,
        address,
        bank_account,
        rek_bank,
        tax,
        status
    ");
    $this->db->from("tbl_supplier");
    $this->db->where("id", $supplier_id);
    
    return $this->db->get()->row();
}


/**
 * Get aggregated/summary data from RPA details
 * Useful untuk mendapatkan total tanpa harus loop di controller
 * 
 * @param int $rpa_id ID dari tabel rpa
 * @return object Summary data dengan total debit, credit, dll
 */
public function get_rpa_summary($rpa_id)
{
    $this->db->select("
        SUM(d.debit_amount) as total_debit,
        SUM(d.credit_amount) as total_credit,
        SUM(d.difference_amount) as total_difference,
        SUM(d.to_be_paid_internal) as total_to_be_paid,
        SUM(d.actual_expenditure) as total_actual_expenditure,
        COUNT(d.id) as total_items
    ");
    $this->db->from("rpa_detail d");
    $this->db->where("d.rpa_id", $rpa_id);
    
    return $this->db->get()->row();
}



}
