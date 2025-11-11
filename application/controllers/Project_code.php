<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_code extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Project_code_model');
        if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
        $this->load->helper('file');
    }

    // Menampilkan data project code
    public function list()
    {
       $data['title'] = 'Project Code Data';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template',"project_code/list", $data);
    }

    // Mendapatkan data project code
    public function getProjectCode() {
        $search = $this->input->get('search_data');
        $data = $this->Project_code_model->get_all($search);
        echo json_encode($data);
    }

    // Menyimpan data project code baru
    public function saveProjectCode() {
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $data = [
            'name' => $name,
            'code' => $code
        ];
        $this->Project_code_model->save($data);
        echo json_encode(['message' => 'Data berhasil disimpan.']);
    }

    // Mengupdate data project code
    public function updateProjectCode() {
        $id = $this->input->get('id');
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $data = [
            'name' => $name,
            'code' => $code
        ];
        $this->Project_code_model->update($id, $data);
        echo json_encode(['message' => 'Data berhasil diupdate.']);
    }

    // Menghapus data project code
    public function destroyProjectCode() {
        $id = $this->input->post('id');
        $this->Project_code_model->delete($id);
        echo json_encode(['message' => 'Data berhasil dihapus.']);
    }
}
