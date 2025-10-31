<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Report_model','report_model');
        $this->load->model('Rpa_model','Rpa_model');
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

    public function daily()
    {
        $data['title'] = 'Daily RPA Report';
        $data['sidebar'] = 'sidebar';
        $data['collapsed'] = '';
        
        $data['css_files'][] = base_url() . 'assets/admin/css/datepicker.css';
        $data['js_files'][] = base_url() . 'assets/admin/js/datepicker.js';
        
        $this->template->load('template', "report/daily_report", $data);
    }

    /**
     * Get Daily Report Data (AJAX)
     */
    public function get_daily_report_data()
    {
        $report_date = $this->input->post('report_date');
        $date_field = $this->input->post('date_field') ?: 'request_date';
        
        if (!$report_date) {
            echo json_encode([
                'success' => false,
                'message' => 'Please select a date',
                'rows' => [],
                'total' => 0
            ]);
            return;
        }
        
        // Get report data
        $report_data = $this->Rpa_model->get_daily_report($report_date, $date_field);
        $summary = $this->Rpa_model->get_daily_report_summary($report_date, $date_field);
        $financial_summary = $this->Rpa_model->get_daily_report_financial_summary($report_date, $date_field);
        
        // Format data
        foreach ($report_data as &$row) {
            $row['bill_date'] = (!empty($row['bill_date']) && $row['bill_date'] != '0000-00-00') 
                ? date('d/m/Y', strtotime($row['bill_date'])) : '-';
            $row['request_date'] = (!empty($row['request_date']) && $row['request_date'] != '0000-00-00') 
                ? date('d/m/Y', strtotime($row['request_date'])) : '-';
            $row['approval_date'] = (!empty($row['approval_date']) && $row['approval_date'] != '0000-00-00') 
                ? date('d/m/Y', strtotime($row['approval_date'])) : '-';
            $row['company_payment_date'] = (!empty($row['company_payment_date']) && $row['company_payment_date'] != '0000-00-00') 
                ? date('d/m/Y', strtotime($row['company_payment_date'])) : '-';
            
            $row['supplier_name'] = $row['supplier_name'] ?: '-';
            $row['charge_code'] = $row['charge_code'] ?: '-';
            $row['category'] = $row['category'] ?: '-';
            $row['note'] = $row['note'] ?: '-';
            $row['status'] = strtolower($row['status']);
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'rows' => $report_data,
                'total' => count($report_data),
                'summary' => $summary,
                'financial_summary' => $financial_summary,
                'report_date' => date('d F Y', strtotime($report_date))
            ]));
    }

    /**
     * Print Daily Report
     */
    public function print_daily_report()
    {
        $date = $this->input->get('date');
        $date_field = $this->input->get('date_field') ?: 'request_date';
        
        if (!$date) {
            show_404();
            return;
        }
        
        // Get report data
        $data['report_data'] = $this->Rpa_model->get_daily_report($date, $date_field);
        
        if (empty($data['report_data'])) {
            $this->session->set_flashdata('error', 'No data found for selected date');
            redirect('report/daily');
            return;
        }
        
        // Get all banks dynamically
        $banks_raw = $this->Rpa_model->get_active_banks();
        $data['bank_accounts'] = $this->build_bank_accounts_array($banks_raw);
        
        // Get opening balances
        $data['opening_balances'] = $this->Rpa_model->get_all_opening_balances($date);
        
        // Ensure all banks have opening balance
        foreach ($data['bank_accounts'] as $alias => $bank) {
            if (!isset($data['opening_balances'][$alias])) {
                $data['opening_balances'][$alias] = 0;
            }
        }
        
        // Process transactions
        $data['transactions'] = $this->process_transactions_dynamic(
            $data['report_data'], 
            $data['bank_accounts']
        );
        
        // Calculate summary
        $data['summary'] = $this->calculate_summary(
            $data['bank_accounts'], 
            $data['opening_balances'], 
            $data['transactions']
        );
        
        // Date formatting
        $data['report_date'] = $date;
        $data['report_date_short'] = date('d-M-y', strtotime($date));
        $data['previous_day'] = date('Y-m-d', strtotime($date . ' -1 day'));
        $data['previous_day_short'] = date('d-M-y', strtotime($data['previous_day']));
        $data['print_date'] = date('d-M-Y');
        $data['date_field'] = $date_field;
        
        // Load view
        $this->load->view('report/print_daily_report', $data);
    }

    /**
     * Build bank accounts array from raw data
     */
    private function build_bank_accounts_array($banks_raw)
    {
        $bank_accounts = [];
        
        foreach ($banks_raw as $bank) {
            $alias = $this->get_bank_alias($bank['name'], $bank['account_bank']);
            
            $bank_accounts[$alias] = [
                'id' => $bank['id'],
                'name' => $bank['name'],
                'account_bank' => $bank['account_bank'],
                'coa_id' => $bank['coa_id'],
                'coa_code' => $bank['coa_code'] ?? '',
                'coa_name' => $bank['coa_name'] ?? '',
                'alias' => $alias,
                'display_name' => $this->format_bank_display_name($bank['name'], $bank['account_bank'])
            ];
        }
        
        return $bank_accounts;
    }

    /**
     * Get bank alias from name and account number
     */
    private function get_bank_alias($bank_name, $account_number = '')
    {
        $name_lower = strtolower(trim($bank_name));
        $account_lower = strtolower(trim($account_number));
        
        // Remove spaces and special characters for matching
        $name_clean = preg_replace('/[^a-z0-9]/i', '', $name_lower);
        $account_clean = preg_replace('/[^0-9]/i', '', $account_lower);
        
        // Mandiri 273
        if ((strpos($name_lower, 'mandiri') !== false && strpos($account_clean, '273') !== false) ||
            strpos($name_lower, 'mandiri273') !== false ||
            strpos($name_lower, 'mandiri 273') !== false) {
            return 'mandiri273';
        }
        
        // Mandiri 721
        if ((strpos($name_lower, 'mandiri') !== false && strpos($account_clean, '721') !== false) ||
            strpos($name_lower, 'mandiri721') !== false ||
            strpos($name_lower, 'mandiri 721') !== false) {
            return 'mandiri721';
        }
        
        // Other banks
        if (strpos($name_lower, 'bca') !== false) {
            return 'bca';
        }
        if (strpos($name_lower, 'bri') !== false) {
            return 'bri';
        }
        if (strpos($name_lower, 'bni') !== false) {
            return 'bni';
        }
        if (strpos($name_lower, 'tunai') !== false || strpos($name_lower, 'cash') !== false) {
            return 'cash';
        }
        
        // Default: use sanitized bank name (max 15 chars)
        return substr($name_clean, 0, 15);
    }

    /**
     * Format bank name for display
     */
    private function format_bank_display_name($name, $account_number)
    {
        if (!empty($account_number) && $account_number != '-') {
            // Get last 4 digits
            $last_digits = substr(preg_replace('/[^0-9]/', '', $account_number), -4);
            if (!empty($last_digits)) {
                return $name . ' (' . $last_digits . ')';
            }
        }
        
        return $name;
    }

    /**
     * Process transactions dynamically by bank
     */
    private function process_transactions_dynamic($report_data, $bank_accounts)
    {
        $result = [
            'income' => [],
            'expense' => []
        ];
        
        // Initialize for all banks
        foreach ($bank_accounts as $alias => $bank) {
            $result['income'][$alias] = 0;
            $result['expense'][$alias] = 0;
            $result['income']['items'][$alias] = [];
            $result['expense']['items'][$alias] = [];
        }
        
        foreach ($report_data as $rpa) {
            foreach ($rpa['details'] as $detail) {
                $debit = floatval($detail['debit_amount']);
                $credit = floatval($detail['credit_amount']);
                
                // Identify which bank account this transaction belongs to
                $payment_method = $this->identify_payment_method(
                    $detail['payment_by'], 
                    $detail['coa_id'],
                    $bank_accounts
                );
                
                $item = [
                    'description' => $detail['remark_tax_income'] ?: ($detail['coa_name'] ?? 'Unknown'),
                    'coa_code' => $detail['coa_code'] ?? '',
                    'amount' => $debit > 0 ? $debit : $credit,
                    'invoice_no' => $rpa['invoice_no'] ?? '',
                    'payment_by' => $detail['payment_by'] ?? '',
                    'bank_name' => $detail['bank_name'] ?? '',
                    'account_bank' => $detail['account_bank'] ?? ''
                ];
                
                if ($debit > 0) {
                    $result['income'][$payment_method] += $debit;
                    $result['income']['items'][$payment_method][] = $item;
                } elseif ($credit > 0) {
                    $result['expense'][$payment_method] += $credit;
                    $result['expense']['items'][$payment_method][] = $item;
                }
            }
        }
        
        return $result;
    }

    /**
     * Identify which bank account the payment belongs to
     */
    private function identify_payment_method($payment_by, $coa_id, $bank_accounts)
    {
        // Strategy 1: Match by COA ID (most accurate)
        if (!empty($coa_id)) {
            foreach ($bank_accounts as $alias => $bank) {
                if ($bank['coa_id'] == $coa_id) {
                    return $alias;
                }
            }
        }
        
        // Strategy 2: Match by payment_by field
        if (!empty($payment_by)) {
            $payment_lower = strtolower(trim($payment_by));
            $payment_clean = preg_replace('/[^a-z0-9]/i', '', $payment_lower);
            
            foreach ($bank_accounts as $alias => $bank) {
                $bank_name_lower = strtolower($bank['name']);
                $account_lower = strtolower($bank['account_bank']);
                $account_clean = preg_replace('/[^0-9]/', '', $account_lower);
                
                // Check alias match
                if (strpos($payment_lower, $alias) !== false) {
                    return $alias;
                }
                
                // Check bank name match
                if (strpos($payment_lower, $bank_name_lower) !== false) {
                    return $alias;
                }
                
                // Check account number match (last 3-4 digits)
                if (!empty($account_clean)) {
                    $last_digits = substr($account_clean, -4);
                    if (strpos($payment_clean, $last_digits) !== false) {
                        return $alias;
                    }
                }
            }
        }
        
        // Default to cash
        return 'cash';
    }

    /**
     * Calculate financial summary
     */
    private function calculate_summary($bank_accounts, $opening_balances, $transactions)
    {
        $summary = [];
        $total_opening = 0;
        $total_income = 0;
        $total_expense = 0;
        $total_closing = 0;
        
        foreach ($bank_accounts as $alias => $bank) {
            $opening = isset($opening_balances[$alias]) ? floatval($opening_balances[$alias]) : 0;
            $income = floatval($transactions['income'][$alias]);
            $expense = floatval($transactions['expense'][$alias]);
            $closing = $opening + $income - $expense;
            
            $summary[$alias] = [
                'name' => $bank['display_name'],
                'opening' => $opening,
                'income' => $income,
                'expense' => $expense,
                'closing' => $closing
            ];
            
            $total_opening += $opening;
            $total_income += $income;
            $total_expense += $expense;
            $total_closing += $closing;
        }
        
        $summary['total'] = [
            'opening' => $total_opening,
            'income' => $total_income,
            'expense' => $total_expense,
            'closing' => $total_closing
        ];
        
        return $summary;
    }

    /**
     * Export Daily Report to Excel
     */
    public function export_daily_report()
    {
        $date = $this->input->get('date');
        $date_field = $this->input->get('date_field') ?: 'request_date';
        
        if (!$date) {
            show_404();
            return;
        }
        
        $data = $this->Rpa_model->get_daily_report($date, $date_field);
        
        if (empty($data)) {
            $this->session->set_flashdata('error', 'No data to export');
            redirect('report/daily');
            return;
        }
        
        // Flatten data for CSV export
        $export_data = [];
        foreach ($data as $rpa) {
            foreach ($rpa['details'] as $detail) {
                $export_data[] = [
                    'Invoice No' => $rpa['invoice_no'],
                    'Date' => $rpa[$date_field],
                    'Supplier' => $rpa['supplier_name'] ?? '',
                    'Description' => $detail['remark_tax_income'] ?: $detail['coa_name'],
                    'Payment By' => $detail['payment_by'],
                    'Debit' => number_format($detail['debit_amount'], 2),
                    'Credit' => number_format($detail['credit_amount'], 2),
                    'Status' => $rpa['status']
                ];
            }
        }
        
        // Set headers
        $filename = 'RPA_Daily_Report_' . $date . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // BOM for Excel UTF-8 support
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Header row
        if (!empty($export_data)) {
            fputcsv($output, array_keys($export_data[0]));
            
            // Data rows
            foreach ($export_data as $row) {
                fputcsv($output, $row);
            }
        }
        
        fclose($output);
        exit;
    }

}