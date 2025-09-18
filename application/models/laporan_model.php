<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function getData()
    {
        return $this->db->get('accounting_voucher')->result_array(); // Sesuaikan dengan nama tabel di database
    }

   
}
