<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoucherModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    // Mengambil voucher berdasarkan ID
    public function getVoucherById($id) {
        return $this->db->get_where('voucher', ['id' => $id])->row();
    }

    // Mengambil semua voucher
    public function getAllVouchers() {
        return $this->db->get('voucher')->result();
    }

    // Menyimpan voucher baru
    public function insertVoucher($data) {
        return $this->db->insert('voucher', $data);
    }

    // Mengupdate voucher berdasarkan ID
    public function updateVoucher($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('voucher', $data);
    }

    // Menghapus voucher berdasarkan ID
    public function deleteVoucher($id) {
        $this->db->where('id', $id);
        return $this->db->delete('voucher');
    }
}
