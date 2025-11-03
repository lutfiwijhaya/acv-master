<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Coa_model');
        $this->load->model('Coa_category_model');
        
         if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
        $this->load->helper('file'); 
    }

    /* ==============================
     * CRUD COA CATEGORY
     * ============================== */

    public function category()
    {
        $data['categories'] = $this->Coa_category_model->get_all();
         $data['title'] = 'Chart of Accounts (COA) Category';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'coa/category', $data);
    }

     

    public function category_store()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'name' => $this->input->post('name')
            ];
            $insert = $this->Coa_category_model->insert($data);

            echo json_encode([
                'status'  => $insert ? 'success' : 'error',
                'message' => $insert ? 'Kategori berhasil ditambahkan' : 'Gagal menambahkan kategori'
            ]);
        } else {
            show_404();
        }
    }

    public function category_update($id)
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'name' => $this->input->post('name')
            ];
            $update = $this->Coa_category_model->update($id, $data);

            echo json_encode([
                'status'  => $update ? 'success' : 'error',
                'message' => $update ? 'Kategori berhasil diperbarui' : 'Gagal memperbarui kategori'
            ]);
        } else {
            show_404();
        }
    }

    public function category_delete($id)
    {
        if ($this->input->is_ajax_request()) {
            $delete = $this->Coa_category_model->delete($id);

            echo json_encode([
                'status'  => $delete ? 'success' : 'error',
                'message' => $delete ? 'Kategori berhasil dihapus' : 'Gagal menghapus kategori'
            ]);
        } else {
            show_404();
        }
    }

    public function getDataCoaCategoryOption()
    {
        $search = $this->input->get('search');

        $this->db->select('id, code, name');
        $this->db->from('coa_category');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('code', $search);
            $this->db->or_like('name', $search);
            $this->db->group_end();
        }
        $query = $this->db->get()->result();

        $result = [];
        foreach ($query as $row) {
            $text = $row->code . ' - ' . $row->name;
            if (!empty($row->name)) {
                $text .= ' (' . $row->name . ')';
            }
            $result[] = [
                'id'   => $row->id,
                'text' => $text,
                'code' => $row->code
            ];
        }

        echo json_encode($result);
    }


    /* ==============================
     * CRUD COA
     * ============================== */

    public function list()
    {
        $data['coa'] = $this->Coa_model->get_all();
        $data['title'] = 'Chart of Accounts (COA)';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'coa/list', $data);
    } 

    public function getDataCoa()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $page   = (int) $this->input->get('page') ?: 1;
        $rows   = (int) $this->input->get('rows') ?: 10;
        $search = $this->input->get('search_data');
        $field = $this->input->get('search_field');

        $offset = ($page - 1) * $rows;

        $total = $this->Coa_model->count_all($search, $field);
        $data  = $this->Coa_model->get_paginated($rows, $offset, $search, $field);

        echo json_encode([
            "total" => $total,
            "rows"  => $data
        ]);
    }

    public function getDataCoaOption()
    {
        $search = $this->input->get('search');

        $this->db->select('id, code, name, sub_name');
        $this->db->from('coa');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('code', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('sub_name', $search);
            $this->db->group_end();
        }
        $query = $this->db->get()->result();

        $result = [];
        foreach ($query as $row) {
            $text = $row->code . ' - ' . $row->name;
            if (!empty($row->sub_name)) {
                $text .= ' (' . $row->sub_name . ')';
            }
            $result[] = [
                'id'   => $row->id,
                'text' => $text
            ];
        }

        echo json_encode($result);
    }

    public function getCoaDataOption()
    {
        $search = $this->input->get('q'); // EasyUI combogrid uses 'q' parameter

        $this->db->select('id, code, name, sub_name'); // Tambahkan currency jika ada di table
        $this->db->from('coa');
        
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('code', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('sub_name', $search);
            $this->db->group_end();
        }
        
        $this->db->limit(50); // Batasi hasil untuk performa
        $query = $this->db->get()->result();

        $result = [];
        foreach ($query as $row) {
            $displayName = $row->name;
            if (!empty($row->sub_name)) {
                $displayName .= ' (' . $row->sub_name . ')';
            }
            
            $result[] = [
                'id'       => $row->id,
                'code'     => $row->code,      // Sesuai dengan field di combogrid
                'name'     => $displayName,     // Sesuai dengan field di combogrid
                'currency' => $row->currency ?? 'IDR' // Default IDR jika kosong
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['total' => count($result), 'rows' => $result]));
    }


    public function saveCoa()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'category_id' => $this->input->post('category_id'),
                'category_code' => $this->input->post('category_code'),
                'level' => $this->input->post('level'),
                'code'        => $this->input->post('code'),
                'name'        => $this->input->post('name'),
                'sub_name'    => $this->input->post('sub_name'),
                'description' => $this->input->post('description')
            ];
            $insert = $this->Coa_model->insert($data);

            echo json_encode([
                'status'  => $insert ? 'success' : 'error',
                'message' => $insert ? 'COA berhasil ditambahkan' : 'Gagal menambahkan COA'
            ]);
        } else {
            show_404();
        }
    }

    public function updateCoa()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $data = [
                'category_id' => $this->input->post('category_id'),
                'category_code' => $this->input->post('category_code'),
                'level' => $this->input->post('level'),
                'code'        => $this->input->post('code'),
                'name'        => $this->input->post('name'),
                'sub_name'    => $this->input->post('sub_name'),
                'description' => $this->input->post('description')
            ];
            if (empty($id)) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'ID COA tidak ditemukan'
                ]);
                return;
            }
            $update = $this->Coa_model->update($id, $data);

            echo json_encode([
                'status'  => $update ? 'success' : 'error',
                'message' => $update ? 'COA berhasil diperbarui' : 'Gagal memperbarui COA'
            ]);
        } else {
            show_404();
        }
    }

    public function destroyCoa()
    {
        $id = $this->input->post('id');
        if ($this->input->is_ajax_request()) {
            $delete = $this->Coa_model->delete($id);

            echo json_encode([
                'status'  => $delete ? 'success' : 'error',
                'message' => $delete ? 'COA berhasil dihapus' : 'Gagal menghapus COA'
            ]);
        } else {
            show_404();
        }
    }
}
  