<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Rpa_model');
        $this->load->helper('url');
    }

    /**
     * Generate PDF untuk RPA (Request for Payment Authorization)
     * @param int $rpa_id ID dari tabel rpa
     */
  public function generate_rpa($rpa_id) 
{
    // Validasi ID
    if (!$rpa_id || !is_numeric($rpa_id)) {
        show_404();
        return;
    }

    // Get data RPA header
    $data['rpa'] = $this->Rpa_model->print_rpa_by_id($rpa_id);
    
    if (!$data['rpa']) {
        show_404();
        return;
    }

    // Get detail RPA dengan join ke COA
    $data['rpa_details'] = $this->Rpa_model->get_rpa_details_for_print($rpa_id);

    // Get supplier info
    $data['supplier'] = $this->Rpa_model->get_supplier_for_print($data['rpa']->supplier_id);

    // Calculate summary totals manually dari details
    $total_debit = 0;
    $total_credit = 0;
    $total_difference = 0;
    $total_to_be_paid = 0;
    $total_actual_expenditure = 0;

    if (!empty($data['rpa_details'])) {
        foreach ($data['rpa_details'] as $detail) {
            $total_debit += floatval($detail->debit_amount ?? 0);
            $total_credit += floatval($detail->credit_amount ?? 0);
            $total_difference += floatval($detail->difference_amount ?? 0);
            $total_to_be_paid += floatval($detail->to_be_paid_internal ?? 0);
            $total_actual_expenditure += floatval($detail->actual_expenditure ?? 0);
        }
    }

    $data['total_debit'] = $total_debit;
    $data['total_credit'] = $total_credit;
    $data['total_difference'] = $total_difference;
    $data['total_to_be_paid'] = $total_to_be_paid;
    $data['total_actual_expenditure'] = $total_actual_expenditure;

    // Clear any output buffer before generating PDF
    while (ob_get_level()) {
        ob_end_clean();
    }

    // Konfigurasi Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $options->set('isFontSubsettingEnabled', true);
    
    // PERBAIKAN: Set chroot ke FCPATH atau array paths
    $options->set('chroot', [
        FCPATH,                          // Root CodeIgniter
        APPPATH,                         // Application folder
        FCPATH . 'assets/',             // Assets folder
        FCPATH . 'uploads/'             // Uploads folder jika ada
    ]);
    
    // Instantiate Dompdf
    $dompdf = new Dompdf($options);
    
    try {
        // Load view ke HTML
        $html = $this->load->view('pdf/rpa_pdf', $data, true);
        
        // Validasi HTML tidak kosong
        if (empty($html)) {
            throw new Exception('Generated HTML is empty');
        }
        
        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);
        
        // Setup ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');
        
        // Render HTML ke PDF
        $dompdf->render();
        
        // Clear output buffer sekali lagi sebelum streaming
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        // Output PDF filename
        $invoice_no = preg_replace('/[^A-Za-z0-9\-_]/', '_', $data['rpa']->invoice_no);
        $filename = 'RPA_' . $invoice_no . '_' . date('Ymd_His') . '.pdf';
        
        // Stream the PDF (Attachment = 0 untuk preview, 1 untuk download)
        $dompdf->stream($filename, array("Attachment" => 0));
        
    } catch (Exception $e) {
        // Log error
        log_message('error', 'PDF Generation Error: ' . $e->getMessage());
        
        // Show error to user
        show_error('Error generating PDF: ' . $e->getMessage());
    }
    
    // CRITICAL: Stop execution
    exit();
}


    /**
     * Download PDF
     */
    public function download_rpa($rpa_id) {
        if (!$rpa_id) {
            show_404();
            return;
        }

        // Clear any previous output buffer
        if (ob_get_length()) {
            ob_end_clean();
        }

        $data['rpa'] = $this->Rpa_model->print_rpa_by_id($rpa_id);
        
        if (!$data['rpa']) {
            show_404();
            return;
        }

        $data['rpa_details'] = $this->Rpa_model->get_rpa_details_for_print($rpa_id);
        $data['supplier'] = $this->Rpa_model->get_supplier_for_print($data['rpa']->supplier_id);

        // Use summary function
        $summary = $this->Rpa_model->get_rpa_summary($rpa_id);
        $data['total_debit'] = $summary->total_debit;
        $data['total_credit'] = $summary->total_credit;
        $data['total_difference'] = $summary->total_difference;
        $data['total_to_be_paid'] = $summary->total_to_be_paid;
        $data['total_actual_expenditure'] = $summary->total_actual_expenditure;

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        $options->set('chroot', realpath(base_url()));
        
        $dompdf = new Dompdf($options);
        $html = $this->load->view('pdf/rpa_pdf', $data, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Clear output buffer before streaming
        if (ob_get_length()) {
            ob_end_clean();
        }
        
        $filename = 'RPA_' . $data['rpa']->invoice_no . '_' . date('Ymd') . '.pdf';
        
        // Force download
        $dompdf->stream($filename, array("Attachment" => 1));
        
        // CRITICAL: Stop execution after streaming
        exit();
    }
}
          