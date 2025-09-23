<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
        $this->load->helper('file');
    }

    function index()
    {
        $kode_level = $this->uri->segment(2);
        if (!$kode_level) {
            show_404();
        }

        $data['title']  = 'Hak Akses - ' . ucfirst($kode_level);
        $data['collapsed'] = '';

        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';

        $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][]  = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][]  = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        $data['kode_level'] = $kode_level;
        if ($kode_level == 'all') {
            $this->template->load('template', 'akses/all', $data);
        } else {
            $this->template->load('template', 'akses/index', $data);
        }
    }
}
