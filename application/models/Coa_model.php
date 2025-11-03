<?php
class Coa_model extends CI_Model {

    protected $table = 'coa';

    public function get_all() {
        $this->db->select('coa.*, coa_category.name as category_name');
        $this->db->from($this->table);
        $this->db->join('coa_category', 'coa.category_id = coa_category.id', 'left');
        return $this->db->get()->result();
    }

    public function count_all($search = null, $field = null)
    {
        $this->db->from($this->table);
        $this->db->join('coa_category', 'coa.category_id = coa_category.id', 'left');
        if (!empty($search)) {
            if ($field === 'all' || empty($field)) {
                $this->db->group_start()
                    ->like('coa.code', $search)
                    ->or_like('coa.name', $search)
                    ->or_like('coa.sub_name', $search)
                    ->or_like('coa.description', $search)
                    ->or_like('coa.level', $search)
                    ->or_like('coa_category.name', $search)
                    ->or_like('coa_category.code', $search)
                    ->group_end();
            } else {
                switch ($field) {
                    case 'category_name':
                        $this->db->like('coa_category.name', $search);
                        break;
                    case 'category_code':
                        $this->db->like('coa_category.code', $search);
                        break;
                    case 'level':
                        $this->db->like('coa.level', $search);
                        break;
                    case 'code':
                        $this->db->like('coa.code', $search);
                        break;
                    case 'name':
                        $this->db->like('coa.name', $search);
                        break;
                    case 'sub_name':
                        $this->db->like('coa.sub_name', $search);
                        break;
                    case 'description':
                        $this->db->like('coa.description', $search);
                        break;
                }
            }
        }
        return $this->db->count_all_results();
    }

    public function get_paginated($limit, $offset, $search = null, $field = null)
    {
        $this->db->select('coa.*, coa_category.name as category_name, coa_category.code as category_code');
        $this->db->from($this->table);
        $this->db->join('coa_category', 'coa.category_id = coa_category.id', 'left');
        if (!empty($search)) {
            if ($field === 'all' || empty($field)) {
                $this->db->group_start()
                    ->like('coa.code', $search)
                    ->or_like('coa.name', $search)
                    ->or_like('coa.sub_name', $search)
                    ->or_like('coa.description', $search)
                    ->or_like('coa.level', $search)
                    ->or_like('coa_category.name', $search)
                    ->or_like('coa_category.code', $search)
                    ->group_end();
            } else {
                switch ($field) {
                    case 'category_name':
                        $this->db->like('coa_category.name', $search);
                        break;
                    case 'category_code':
                        $this->db->like('coa_category.code', $search);
                        break;
                    case 'level':
                        $this->db->like('coa.level', $search);
                        break;
                    case 'code':
                        $this->db->like('coa.code', $search);
                        break;
                    case 'name':
                        $this->db->like('coa.name', $search);
                        break;
                    case 'sub_name':
                        $this->db->like('coa.sub_name', $search);
                        break;
                    case 'description':
                        $this->db->like('coa.description', $search);
                        break;
                }
            }
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by('coa.id', 'ASC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
}
