<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Rpa_model");
         $this->load->library('form_validation');
        $this->load->model("Journal_model", "journal");
        $this->load->model("Coa_model", "coa");
         if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
        $this->load->helper('file'); 
    }

    public function list()
    {
       $data['title'] = 'Proposal Payment List';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template',"rpa/list", $data);
    }

    public function getRpaData()
    {
        $page  = (int) $this->input->get("page");
        $rows  = (int) $this->input->get("rows");
        $search = $this->input->get("search_data");

        $offset = ($page - 1) * $rows;

        $dataRows = $this->Rpa_model->get_all($search, $rows, $offset);
        $total    = $this->Rpa_model->count_all($search);

        echo json_encode([
            "total" => $total,
            "rows"  => $dataRows
        ]);
    }

  
    public function get_json()
    {
        $search = $this->input->get("search");
        $rows = $this->Rpa_model->get_all($search, 200, 0);
        $total = $this->Rpa_model->count_all($search);

        echo json_encode([
            "total" => $total,
            "rows" => $rows
        ]);
    }

    public function create()
    {
        if ($this->input->method() === "post") {
            $data = $this->input->post("rpa");
            $details = json_decode($this->input->post("rpa_details"), true);

            $this->Rpa_model->insert($data, $details);
            echo json_encode(["message" => "Proposal Payment created successfully","success" => true]);
        } else {
            $this->load->view("rpa/form");
        }
    }

    public function edit($id)
    {
        if ($this->input->method() === "post") {
            $data = $this->input->post("rpa");
            $details = json_decode($this->input->post("rpa_details"), true);

            $this->Rpa_model->update($id, $data, $details);
            echo json_encode(["message" => "Proposal Payment updated successfully"]);
        } else {
            $data['rpa'] = $this->Rpa_model->get_by_id($id);
            $this->load->view("rpa/form", $data);
        }
    }

    public function delete($id)
    {
        $this->Rpa_model->delete($id);
        echo json_encode(["message" => "Proposal Payment deleted successfully"]);
    }

    public function save() 
    {
        if ($this->input->method() === "post") {
            $data = [
                'invoice_no'    => $this->input->post('invoice_no'),
                'request_date'  => $this->input->post('request_date'),
                'bill_date'  => $this->input->post('bill_date'),
                'supplier_id'   => $this->input->post('supplier_id')
            ];
            $details = json_decode($this->input->post('details'), true);
            $this->Rpa_model->insert($data, $details);
            echo json_encode(['message' => 'Proposal Payment saved successfully']);
        } else {
            $this->load->view("rpa/form");
        }
    }

    public function update($id)
    {
        if ($this->input->method() === "post") {
            $data = [
                'invoice_no'    => $this->input->post('invoice_no'),
                'request_date'  => $this->input->post('request_date'),
                'bill_date'  => $this->input->post('bill_date'),
                'supplier_id'   => $this->input->post('supplier_id')
            ];
            $details = json_decode($this->input->post('details'), true);

            $this->Rpa_model->update($id, $data, $details);
            echo json_encode(['message' => 'Proposal Payment updated successfully']);
        } else {
            $data['rpa'] = $this->Rpa_model->get_by_id($id);
            $this->load->view("rpa/form", $data);
        }
    }

    // Get RPA by ID with details
    public function getRpaById($id) {
        $this->load->model('Rpa_model');
        
        if (!$id) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid RPA ID'
            ]);
            return;
        }
        
        $rpa = $this->Rpa_model->get_by_id($id);
        
        if ($rpa) {
            echo json_encode([
                'success' => true,
                'data' => $rpa
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Proposal Payment not found'
            ]);
        }
    }

    // Get RPA Detail items only (for detail table)
    public function getRpaDetail($id) {
        $this->load->model('Rpa_model');
        
        if (!$id) {
            echo json_encode([]);
            return;
        }
        
        $details = $this->Rpa_model->get_detail_by_rpa_id($id);
        echo json_encode($details);
    }

    // Approve RPA
    public function approve()
    {
        $rpa_id = $this->input->post('rpa_id');
        $note = $this->input->post('note');
        
        if (!$rpa_id) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid RPA ID'
            ]);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $result = $this->Rpa_model->approve($rpa_id, $note, $user_id);
        
        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Proposal Payment has been approved successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to approve RPA'
            ]);
        }
    }

    // Reject RPA
    public function reject()
    {
        $rpa_id = $this->input->post('rpa_id');
        $note = $this->input->post('note');
        
        if (!$rpa_id) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid RPA ID'
            ]);
            return;
        }
        
        if (empty($note)) {
            echo json_encode([
                'success' => false,
                'message' => 'Rejection note is required'
            ]);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $result = $this->Rpa_model->reject($rpa_id, $note, $user_id);
        
        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Proposal Payment has been rejected'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to reject RPA'
            ]);
        }
    }

}
