<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Explorer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->driver('cache'); // Memuat driver cache jika belum di-autoload
    }

    // public function get_tree_data()
    // {
    //     $query = $this->db->get('sd_ho_tree');
    //     $result = $query->result();

    //     $data = [];

    //     foreach ($result as $row) {
    //         $data[] = [
    //             'id' => $row->id,
    //             'parent' => $row->parent_id ? $row->parent_id : '#',
    //             'text' => $row->name,
    //             'a_attr' => [
    //                 'href' => base_url("admin/dr_tree/" . $row->id)
    //             ]
    //         ];
    //     }

    //     return $data;
    // }

    public function get_tree_data()
    {
        $cache_key = 'sd_ho_tree_data'; // Kunci unik untuk data cache ini
        $cache_time = 300; // Waktu cache dalam detik (contoh: 300 detik = 5 menit)

        // Coba ambil data dari cache
        if ($cached_data = $this->cache->file->get($cache_key)) {
            log_message('debug', 'sd_ho_tree_data fetched from cache.');
            return $cached_data;
        }

        // Urutkan berdasarkan nama sebelum ambil data
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('sd_ho_tree');
        $result = $query->result();

        $data = [];

        foreach ($result as $row) {
            $data[] = [
                'id' => $row->id,
                'parent' => $row->parent_id ? $row->parent_id : '#',
                'text' => $row->name,
                'a_attr' => [
                    'href' => base_url("admin/dr_tree/" . $row->id)
                ]
            ];
        }

        // Simpan hasil query ke cache sebelum mengembalikannya
        $this->cache->file->save($cache_key, $data, $cache_time);
        log_message('debug', 'sd_ho_tree_data saved to cache.');

        return $data;
    }
}
