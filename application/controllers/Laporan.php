<?php
defined('BASEPATH') or exit('No direct script access allowed');


require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf as PdfWriter;

use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database
    }




   

    public function exportExcel()
    {
        // Load template Excel
        $templatePath = FCPATH . 'AccountingFiles/laporan/form-voucher.xlsx';
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil data dari database
        $this->db->select('*');
        $this->db->from('accounting_voucher_spec');
        $query = $this->db->get();
        $data = $query->result_array();

        // Mulai tulis data di baris tertentu (misalnya mulai baris ke-5)
        $row = 13;
        foreach ($data as $d) {
            $sheet->setCellValue('A' . $row, $d['id']);
            $sheet->setCellValue('B' . $row, $d['spec']);
            $sheet->setCellValue('C' . $row, $d['qty']);
            $sheet->setCellValue('D' . $row, $d['price']);
            $sheet->setCellValue('E' . $row, $d['amount']);
            $row++;
        }

        // Set nama file
        $fileName = 'Laporan_Users_' . date('Ymd') . '.xlsx';

        // Header untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }



    public function exportPDF()
    {
        // Ambil data dari database
        $this->db->select('*');
        $this->db->from('accounting_voucher_spec');
        $query = $this->db->get();
        $data = $query->result_array();
    
        // Buat HTML untuk PDF
        $html = '
        <style>
            body { font-family: Arial, sans-serif; font-size: 12px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 5px; text-align: left; }
            th { background-color: #ddd; }
        </style>
        <h2>Laporan Voucher</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Spec</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>';
        
        foreach ($data as $d) {
            $html .= '<tr>
                <td>' . $d['id'] . '</td>
                <td>' . $d['spec'] . '</td>
                <td>' . $d['qty'] . '</td>
                <td>' . number_format($d['price'], 2, ',', '.') . '</td>
                <td>' . number_format($d['amount'], 2, ',', '.') . '</td>
            </tr>';
        }
        
        $html .= '</tbody></table>';
    
        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
    
        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);
    
        // Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');
    
        // Render PDF
        $dompdf->render();
    
        // Output ke browser
        $dompdf->stream('Laporan_Voucher.pdf', ['Attachment' => false]);
    }








    

    public function generateCV()
    {
        // Data Dummy (Bisa diambil dari database)
        $data['nama'] = "Arshad";
        $data['email'] = "arshad@example.com";
        $data['phone'] = "+62 812 3456 7890";
        $data['address'] = "Jl. Merdeka No. 10, Jakarta";
        $data['summary'] = "Programmer dengan pengalaman dalam CodeIgniter & PHP.";
        $data['skills'] = ['PHP', 'CodeIgniter', 'MySQL', 'JavaScript', 'HTML & CSS'];

        // Load View sebagai HTML
        $html = $this->load->view('laporan/cv_template', $data, true);

        // Konfigurasi DOMPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Outputkan PDF ke browser
        $dompdf->stream("CV_" . $data['nama'] . ".pdf", array("Attachment" => false));
    }

    public function form()
    {
        $this->load->view('accounting/form-voucher'); // Menampilkan form dari views/accounting/form-voucher.php
    }
}
