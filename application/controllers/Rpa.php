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
        $this->load->helper('accounting_helper');
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

    public function getRpaData() {
        $page  = (int) $this->input->get("page");
        $rows  = (int) $this->input->get("rows");
        $search = $this->input->get("search_data");
        $status = $this->input->get("status");  // Get the filter status

        $offset = ($page - 1) * $rows;

        // Pass the status filter to the model query
        $dataRows = $this->Rpa_model->get_all($search, $status, $rows, $offset);
        $total    = $this->Rpa_model->count_all($search, $status);

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
                'supplier_id'   => $this->input->post('supplier_id'),
                'charge_code'   => $this->input->post('reference_no')
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
        // Retrieve RPA ID and note from POST
        $rpa_id = $this->input->post('rpa_id');
        $note = $this->input->post('note');
        
        if (!$rpa_id) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid RPA ID'
            ]);
            return;
        }
        
        // Get the user ID from session
        $user_id = $this->session->userdata('user_id');
        
        // Start transaction
        $this->db->trans_start(); // Start the transaction

        try {
            // Approve the RPA
            $result = $this->Rpa_model->approve($rpa_id, $note, $user_id);

            // If approval failed, rollback and return an error
            if (!$result) {
                throw new Exception('Failed to approve RPA');
            }

            // Fetch RPA details from the database
            $rpa = $this->Rpa_model->get_by_id($rpa_id);
            $rpa_details = $this->Rpa_model->get_rpa_details($rpa_id); // Assuming this function fetches the details

            // Prepare journal details for the journal entry
            $journal_details = [];
            foreach ($rpa_details as $detail) {
                $journal_details[] = [
                    'coa_id' => $detail['coa_id'],
                    'debit' => $detail['debit_amount'],
                    'credit' => $detail['credit_amount'],
                    'description' => $detail['supplementary_desc'],
                ];
            }

            // Prepare journal data
            $journal_data = [
                'project_code' => 'RPA-' . $rpa_id, // Custom project code
                'journal_date' => date('Y-m-d'), // Current date
                'reference' => $rpa['charge_code'],
                'description' => 'RPA Approval Journal for RPA ID ' . $rpa_id,
                'status' => 'Approved',
                'created_by' => $user_id,
            ];

            // Call the helper function to create the journal entry
            $journal_id = create_journal_entry($journal_data, $journal_details);

            // Optionally update the RPA table with the created journal ID
            $this->Rpa_model->update_journal_id($rpa_id, $journal_id);

            // Commit transaction if all operations were successful
            $this->db->trans_complete(); // Commit the transaction

            // Check transaction status
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed. Rolling back.');
            }

            // Return success message
            echo json_encode([
                'success' => true,
                'message' => 'Proposal Payment has been approved and journal entry created successfully'
            ]);
        } catch (Exception $e) {
            // Rollback if an exception occurs
            $this->db->trans_rollback();
            
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
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
