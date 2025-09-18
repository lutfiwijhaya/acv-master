<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Mendapatkan daftar file yang is_aktiv = '1'
     *
     * @return array of objects Daftar file yang memenuhi kriteria
     */
    public function get_active_files_for_deletion()
    {
        $this->db->where('is_aktiv', '1');
        $query = $this->db->get('dr_file');
        return $query->result(); // Mengembalikan array of objects
    }

    /**
     * Menghapus record file dari database berdasarkan ID
     *
     * @param int $id_dr ID dari record file yang akan dihapus
     * @return bool True jika berhasil dihapus, false jika tidak
     */
    public function delete_file_record($id_dr)
    {
        $this->db->where('id', $id_dr);
        return $this->db->delete('dr_file');
    }
}