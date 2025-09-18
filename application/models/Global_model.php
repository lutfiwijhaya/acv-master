<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function insert($table, $data)
    {
    	return $this->db->insert($table, $data); 
    }

    //Insert Batch
    function insertbatch($table,$data){
        return $this->db->insert_batch($table, $data);
    }

    //Update Batch
    function updatebatch($table, $data, $where){
        return $this->db->update_batch($table, $data, $where);
    }

    function update($table, $data, $where)
    {
    	return $this->db->update($table, $data, $where); 
    }

    function delete($table, $where){
        return $this->db->delete($table, $where);
    }

     public function get_by_id($table, $where) {
        $this->db->where($where);  // Menambahkan kondisi where berdasarkan parameter yang diberikan
        $query = $this->db->get($table);  // Melakukan query ke tabel
        
        // Jika ada hasil dari query, kembalikan baris pertama sebagai objek
        if ($query->num_rows() > 0) {
            return $query->row();  // Mengembalikan satu baris data
        } else {
            return false;  // Jika tidak ada data, kembalikan false
        }
    }
}