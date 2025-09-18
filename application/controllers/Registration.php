<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Tidak memeriksa login di controller ini
    }

    public function index() {
        $this->load->view('auth/register'); // Halaman pendaftaran
    }
}
