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
    public function generate_rpa($rpa_id) {
        // Validasi ID
        if (!$rpa_id) {
            show_404();
        }

        // Get data RPA header (parent table)
        $data['rpa'] = $this->Rpa_model->print_rpa_by_id($rpa_id);
        
        if (!$data['rpa']) {
            show_404();
        }

        // Get detail RPA dengan join ke COA (child table)
        $data['rpa_details'] = $this->Rpa_model->get_rpa_details_for_print($rpa_id);

        // Get supplier info
        $data['supplier'] = $this->Rpa_model->get_supplier_for_print($data['rpa']->supplier_id);

        // Get summary totals (alternative to manual calculation)
        $summary = $this->Rpa_model->get_rpa_summary($rpa_id);
        $data['total_debit'] = $summary->total_debit;
        $data['total_credit'] = $summary->total_credit;
        $data['total_difference'] = $summary->total_difference;
        $data['total_to_be_paid'] = $summary->total_to_be_paid;
        $data['total_actual_expenditure'] = $summary->total_actual_expenditure;

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        
        // Instantiate Dompdf
        $dompdf = new Dompdf($options);
        
        // Load view ke HTML
        $html = $this->load->view('pdf/rpa_pdf', $data, true);
        
        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);
        
        // Setup ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');
        
        // Render HTML ke PDF
        $dompdf->render();
        
        // Output PDF (0 = preview, 1 = download)
        $filename = 'RPA_' . $data['rpa']->invoice_no . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, array("Attachment" => 0));
    }

    /**
     * Download PDF
     */
    public function download_rpa($rpa_id) {
        if (!$rpa_id) {
            show_404();
        }

        $data['rpa'] = $this->Rpa_model->print_rpa_by_id($rpa_id);
        
        if (!$data['rpa']) {
            show_404();
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
        
        $dompdf = new Dompdf($options);
        $html = $this->load->view('pdf/rpa_pdf', $data, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'RPA_' . $data['rpa']->invoice_no . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, array("Attachment" => 1)); // Force download
    }
}
