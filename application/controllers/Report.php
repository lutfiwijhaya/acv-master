<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Report_model','report_model');
        $this->load->model('Menu_model','menu_model');
        $this->load->model('Global_model','global_model');
        $this->load->model('Journal_model','Journal_model');
    }
    function penjualan(){
        $data['title']  = 'Laporan Penjualan';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material-blue/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['css_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker-bs3.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-export.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/accounting/accounting.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/chartjs/Chart.bundle.js';
        $data['content'] = 'test';
		$this->template->load('template','report/penjualan',$data);
    }
    function penagihan(){
        $data['title']  = 'Laporan Penjualan';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material-blue/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['css_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker-bs3.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-export.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/accounting/accounting.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/chartjs/Chart.bundle.js';
		$this->template->load('template','report/penagihan',$data);
    }
    function pendapatan(){

    }
    function getPenjualan(){
        $this->output->set_content_type('application/json');
        $data = $this->report_model->getPenjualan();
        echo json_encode($data);
    }
    function getPenagihan(){

    }
    function getPendapatan(){

    }
    function getChartPenjualan(){

    }
    function getChartPenagihan(){

    }
    function getChartPendapatan(){

    }

    function balance(){
        $data['title']  = 'Balance Sheet';
        $data['sidebar']   = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material-blue/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['css_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker-bs3.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-export.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/accounting/accounting.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/chartjs/Chart.bundle.js';
		$this->template->load('template','report/balance',$data);
    }

    public function get_balance_sheet_data()
    {
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $filter     = $this->input->get('filter'); // quick filter 1day/1week/1month/1year

        // kalau quick filter dipilih, hitung otomatis tanggal
        if (!empty($filter)) {
            $today = date('Y-m-d');
            switch ($filter) {
                case '1day':
                    $start_date = $today;
                    $end_date   = $today;
                    break;
                case '1week':
                    $start_date = date('Y-m-d', strtotime('-6 days'));
                    $end_date   = $today;
                    break;
                case '1month':
                    $start_date = date('Y-m-01');
                    $end_date   = date('Y-m-t');
                    break; 
                case '1year':
                    $start_date = date('Y-01-01');
                    $end_date   = date('Y-12-31');
                    break;
            }
        }

        $rows = $this->Journal_model->get_balance_sheet($start_date, $end_date);

        $total_debit  = 0;
        $total_credit = 0;
        $formatted_rows = [];

        foreach ($rows as $r) {
            $total_debit  += (float) $r->total_debit;
            $total_credit += (float) $r->total_credit;

            $formatted_rows[] = [
                "coa_code" => $r->coa_code,
                "coa_name" => $r->name,
                "debit"    => number_format($r->total_debit, 2),
                "credit"   => number_format($r->total_credit, 2),
                "balance"  => number_format($r->total_debit - $r->total_credit, 2),
            ];
        }

        $result = [ 
            "total"  => count($formatted_rows),
            "rows"   => $formatted_rows,
            "footer" => [[
                "coa_code" => "",
                "coa_name" => "TOTAL",
                "debit"    => number_format($total_debit, 2),
                "credit"   => number_format($total_credit, 2),
                "balance"  => number_format($total_debit - $total_credit, 2),
            ]]
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    function profit(){
        $data['title']  = 'Balance Sheet';
        $data['sidebar']   = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material-blue/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['css_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker-bs3.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-export.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/daterangepicker/daterangepicker.js';
        $data['js_files'][] = base_url() . 'assets/admin/plugins/accounting/accounting.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/chartjs/Chart.bundle.js';
		$this->template->load('template','report/profit',$data);
    }

    //  Controller Method (Report.php)
    public function get_profit_loss_data()
    {
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $filter     = $this->input->get('filter'); // quick filter 1day/1week/1month/1year

        // kalau quick filter dipilih, hitung otomatis tanggal
        if (!empty($filter)) {
            $today = date('Y-m-d');
            switch ($filter) {
                case '1day':
                    $start_date = $today;
                    $end_date   = $today;
                    break;
                case '1week':
                    $start_date = date('Y-m-d', strtotime('-6 days'));
                    $end_date   = $today;
                    break;
                case '1month':
                    $start_date = date('Y-m-01');
                    $end_date   = date('Y-m-t');
                    break; 
                case '1year':
                    $start_date = date('Y-01-01');
                    $end_date   = date('Y-12-31');
                    break;
            }
        }

        // Ambil data dari model
        $data = $this->Journal_model->get_profit_loss($start_date, $end_date);

        // Inisialisasi totals
        $total_revenue = 0;
        $total_expenses = 0;

        $formatted_rows = [];

        // ========== PENDAPATAN (REVENUES) - Category ID 5 ==========
        $formatted_rows[] = [
            "category" => "PENDAPATAN",
            "code" => "",
            "name" => "REVENUES",
            "amount" => "",
            "is_header" => true
        ];

        foreach ($data['revenues'] as $r) {
            $amount = (float) $r->amount;
            $total_revenue += $amount;
            
            $formatted_rows[] = [
                "category" => "PENDAPATAN",
                "code" => $r->code,
                "name" => $r->name,
                "amount" => number_format($amount, 2),
                "is_header" => false
            ];
        }

        // Subtotal Pendapatan
        $formatted_rows[] = [
            "category" => "TOTAL PENDAPATAN",
            "code" => "",
            "name" => "TOTAL REVENUES",
            "amount" => number_format($total_revenue, 2),
            "is_subtotal" => true
        ];

        // ========== BEBAN (EXPENSES) - Category ID 6 ==========
        $formatted_rows[] = [
            "category" => "BEBAN",
            "code" => "",
            "name" => "EXPENSES",
            "amount" => "",
            "is_header" => true
        ];

        foreach ($data['expenses'] as $r) {
            $amount = (float) $r->amount;
            $total_expenses += $amount;
            
            $formatted_rows[] = [
                "category" => "BEBAN",
                "code" => $r->code,
                "name" => $r->name,
                "amount" => number_format($amount, 2),
                "is_header" => false
            ];
        }

        // Subtotal Beban
        $formatted_rows[] = [
            "category" => "TOTAL BEBAN",
            "code" => "",
            "name" => "TOTAL EXPENSES",
            "amount" => number_format($total_expenses, 2),
            "is_subtotal" => true
        ];

        // ========== LABA/RUGI BERSIH ==========
        $net_profit = $total_revenue - $total_expenses;
        
        $formatted_rows[] = [
            "category" => "LABA/(RUGI) BERSIH",
            "code" => "",
            "name" => "NET PROFIT/(LOSS)",
            "amount" => number_format($net_profit, 2),
            "is_total" => true
        ];

        $result = [ 
            "total"  => count($formatted_rows),
            "rows"   => $formatted_rows,
            "summary" => [
                "total_revenue" => number_format($total_revenue, 2),
                "total_expenses" => number_format($total_expenses, 2),
                "net_profit" => number_format($net_profit, 2)
            ]
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

}