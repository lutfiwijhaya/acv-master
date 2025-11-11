<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_code_model extends CI_Model {

    // Menyimpan data project code
    public function save($data) {
        $this->db->insert('project_code', $data);
        return $this->db->insert_id();
    }

    // Mendapatkan semua data project code
    public function get_all($search = '') {
        if ($search) {
            $this->db->like('name', $search);
            $this->db->or_like('code', $search);
        }
        return $this->db->get('project_code')->result_array();
    }

    // Mengambil data berdasarkan ID
    public function get_by_id($id) {
        return $this->db->get_where('project_code', ['id' => $id])->row_array();
    }

    // Mengupdate data project code
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('project_code', $data);
    }

    // Menghapus data project code
    public function delete($id) {
        return $this->db->delete('project_code', ['id' => $id]);
    }
}
