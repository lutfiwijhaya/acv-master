<?php
defined('BASEPATH') or exit('No direct script access allowed');




class Accounting extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
    }

    function accounting_voucher()
    {
        $data['title']  = 'Voucher';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'accounting/accounting-voucher', $data);
    }

    function getlistbank()
    {
        $this->output->set_content_type('application/json');
        $bank = $this->backend_model->getbank();
        echo json_encode($bank);
    }

    public function viewVoucher($id)
    {
        // Ambil data voucher dan spesifikasinya dari model
        $data['voucher'] = $this->backend_model->getVoucherById($id);
        $data['voucherspec'] = $this->backend_model->getVoucherSpecById($id);

        // Load view HTML yang akan dikonversi ke PDF
        $html = $this->load->view('accounting/voucher_pdf', $data, true);

        // Load Dompdf library dan generate PDF
        $this->load->library('Dompdf_lib');
        $this->dompdf_lib->loadHtml($html);
        $this->dompdf_lib->render();

        // Output ke browser sebagai PDF
        $this->dompdf_lib->stream("voucher_$id.pdf", ["Attachment" => false]);
    }


    public function details_items_voucher($id)
    {
        $data['title']  = 'Detail Items Voucher';
        $data['collapsed'] = '';

        // Mengirimkan id ke view
        $data['item_id'] = $id;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'accounting/details_items_voucher', $data);
    }

     public function form_voucher()
    {
        $data['title']  = 'Form Voucher';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/accounting/accounting.min.js';
        $this->template->load('template', 'accounting/form-voucher', $data);
    }

    function getvoucher_approval()
    {
        $this->output->set_content_type('application/json');
        $voucher = $this->backend_model->getVoucherApproval();
        echo json_encode($voucher);
    }

    
    //accounting

    function accounting_bank()
    {
        $data['title']  = 'Bank';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'accounting/accounting-bank', $data);
    }

    

    function accounting_voucher_approval()
    {
        $data['title']  = 'Voucher';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'accounting/accounting-voucher-approval', $data);
    }


    function saveVoucher()
    {
        // Mengambil input dari form
        $no_doc = $this->input->post('no_doc', TRUE);
        $account = $this->input->post('account', TRUE);
        $incharge = $this->input->post('incharge', TRUE);
        $date = $this->input->post('date', TRUE);
        $recipient = $this->input->post('recipient', TRUE);
        $recipient_bank = $this->input->post('recipient_bank', TRUE);
        $bank_account = $this->input->post('bank_account', TRUE);
        $due_date = $this->input->post('due_date', TRUE);

        // Data utama voucher
        $data_voucher = array(
            'no_doc' => $no_doc,
            'account' => $account,
            'incharge' => $incharge,
            'date' => $date,
            'recipient' => $recipient,
            'recipient_bank' => $recipient_bank,
            'bank_account' => $bank_account,
            'due_date' => $due_date,
        );

        // Simpan ke tabel accounting_voucher
        $this->db->insert('accounting_voucher', $data_voucher);
        $voucher_id = $this->db->insert_id(); // Ambil ID voucher yang baru disimpan

        // Simpan data detail item ke accounting_voucher_spec
        $specs = $this->input->post('spec', TRUE);
        $qtys = $this->input->post('qty', TRUE);
        $prices = $this->input->post('price', TRUE);
        $amounts = $this->input->post('amount', TRUE);

        // Konfigurasi upload file
        $config['upload_path'] = './AccountingFiles/Invoice';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 1024;
        $this->load->library('upload', $config);

        for ($i = 0; $i < count($specs); $i++) {
            $file_name = null;
            $file_path = null;

            if (!empty($_FILES['invoice']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['invoice']['name'][$i];
                $_FILES['file']['type'] = $_FILES['invoice']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['invoice']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['invoice']['error'][$i];
                $_FILES['file']['size'] = $_FILES['invoice']['size'][$i];

                $config['file_name'] = $no_doc . '_' . ($i + 1) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $file_name = $this->upload->data('file_name');
                    $file_path = base_url('AccountingFiles/Invoice/') . $file_name;
                }
            }

            $data_spec = array(
                'voucher_id' => $voucher_id,
                'spec' => $specs[$i],
                'qty' => $qtys[$i],
                'price' => $prices[$i],
                'amount' => $amounts[$i],
                'invoice' => $file_path
            );

            $this->db->insert('accounting_voucher_spec', $data_spec);
        }

        // Kirim respons JSON untuk diproses di JavaScript
        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan!', 'redirect' => base_url('admin/accounting_voucher')));
    }


    public function saveDailyReport()
    {
        $this->db->trans_start(); // Mulai transaksi

        // Simpan ke accounting_daily_report
        $dataDailyReport = [
            'incharge' => $this->session->userdata('_id'),
            'date' => $this->input->post('date')
        ];
        $this->db->insert('accounting_daily_report', $dataDailyReport);
        $id_dr = $this->db->insert_id(); // Dapatkan ID yang baru dibuat

        // **Perbaikan Pengambilan Data dari BankGrid**
        $banks = $this->input->post('bank_id');

        // Simpan ke accounting_daily_report_transaction
        $descriptions = $this->input->post('desc');
        $inOuts = $this->input->post('in_out');
        $amounts = $this->input->post('amount');
        $remarks = $this->input->post('remark');

        if (!empty($descriptions) && is_array($descriptions)) {
            foreach ($descriptions as $index => $desc) {
                $filePath = ''; // Default kosong

                if (!empty($_FILES['file']['name'][$index])) {
                    $fileName = time() . '_' . $_FILES['file']['name'][$index];
                    $uploadPath = './AccountingFiles/Invoice/';
                    move_uploaded_file($_FILES['file']['tmp_name'][$index], $uploadPath . $fileName);
                    $filePath = $uploadPath . $fileName;
                }

                $dataTransaction = [
                    'id_dr' => $id_dr,
                    'transaction_desc' => $desc,
                    'id_bank' => $banks[$index] ?? null, // Hindari undefined index error
                    'in-out' => $inOuts[$index] ?? null,
                    'amount' => str_replace(',', '', $amounts[$index] ?? '0'),
                    'remark' => $remarks[$index] ?? '',
                    'file' => $filePath
                ];
                $this->db->insert('accounting_daily_report_transaction', $dataTransaction);
            }
        }

        log_message('error', 'Isi bank_data: ' . print_r($this->input->post('bank_data'), true));

        // Simpan data bankGrid ke accounting_daily_report_bank
        $bankData = json_decode($this->input->post('bank_data'), true);
        if (!empty($bankData) && is_array($bankData)) {
            foreach ($bankData as $bank) {
                $dataBank = [
                    'id_dr' => $id_dr,
                    'id_bank' => $bank['id'],
                    'start_balance' => $bank['balance'],
                    'end_balance' => $bank['end_balance']
                ];
                $this->db->insert('accounting_daily_report_balance', $dataBank);

                // Update saldo akhir di tabel accounting_bank
                $this->db->where('id', $bank['id']);
                $this->db->update('accounting_bank', ['balance' => $bank['end_balance']]);
            }
        }

        $this->db->trans_complete(); // Akhiri transaksi

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan!', 'redirect' => base_url('admin/form_input_report')]);
        }
    }









   

    public function form_input_report()
    {
        $data['title']  = 'Form Input Report';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/accounting/accounting.min.js';
        $this->template->load('template', 'accounting/form-input-report', $data);
    }

    

    public function get_detail_items_voucher($id)
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->get_detail_items_voucher($id); // Mengirimkan id ke model
        echo json_encode($stock);
    }


    function getvoucher()
    {
        $this->output->set_content_type('application/json');
        $voucher = $this->backend_model->getVoucher();
        echo json_encode($voucher);
    }

    

    public function getBank()
    {
        $banks = $this->db->get('accounting_bank')->result_array();
        foreach ($banks as &$bank) {
            $bank['end_balance'] = $bank['balance']; // Awalnya end_balance = start_balance
        }
        echo json_encode(["rows" => $banks]);
    }

    




    

    public function getBankList()
    {
        $this->output->set_content_type('application/json');
        $banks = $this->backend_model->getAllBanks();

        if (!empty($banks)) {
            echo json_encode(["status" => "success", "data" => $banks]);
        } else {
            echo json_encode(["status" => "error", "message" => "No bank found"]);
        }
    }

    

}