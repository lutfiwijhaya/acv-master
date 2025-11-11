<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class Journal extends CI_Controller {

    public function __construct() {
        parent::__construct();
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

    public function list() {
        $data['title'] = 'Journal List';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template',"journal/list", $data);
    }

    public function getDataJournal() {
        $page   = $this->input->get('page') ?: 1;
        $rows   = $this->input->get('rows') ?: 10;
        $search = $this->input->get('search_data');

        $offset = ($page - 1) * $rows;

        $result = $this->journal->get_paginated_parent_child($rows, $offset, $search);
        $total  = $this->journal->count_all_parents($search);

        echo json_encode([
            "total" => $total,
            "rows"  => $result
        ]);
    }
    
    // Method untuk mendapatkan detail journal
    public function getJournalDetails() {
        $journal_id = $this->input->get('journal_id');
        $details = $this->journal->get_journal_details($journal_id);
        
        echo json_encode([
            "total" => count($details),
            "rows"  => $details
        ]);
    }


     public function create() {
        $data['title']     = 'Proposal Payment Create';
        $data['sidebar']   = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][]  = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][]  = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template',"journal/create", $data);
    }


     public function edit($id) {
        $data['journal'] = $this->journal->get_by_id($id);
        if (!$data['journal']) {
            show_404();
            return;
        }
        $data['title'] = 'Proposal Payment Edit';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $data['coa'] = $this->journal->get_all();
        $this->template->load('template',"journal/edit", $data);
    }

    public function saveJournal() {
        // Validasi input
        $this->form_validation->set_rules('project', 'Project', 'required');
        $this->form_validation->set_rules('reference', 'Reference', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                "errorMsg" => validation_errors()
            ]);
            return;
        }

        // Get ID jika update
        $id = $this->input->post("id");

        // Data Header
        $headerData = [
            "project"       => $this->input->post("project"),
            "reference"     => $this->input->post("reference"),
            "supplier_id"   => $this->input->post("supplier_id"),
            "journal_date"  => date('Y-m-d'), // atau dari input
            "created_by"    => $this->session->userdata('user_id') // jika ada session
        ];

        // Data Details
        $coa_ids = $this->input->post("coa_id");
        $types = $this->input->post("type");
        $descriptions = $this->input->post("description");
        $debits = $this->input->post("debit");
        $credits = $this->input->post("credit");

        // Validasi balance
        $totalDebit = 0;
        $totalCredit = 0;
        
        foreach ($debits as $debit) {
            $totalDebit += floatval($debit);
        }
        
        foreach ($credits as $credit) {
            $totalCredit += floatval($credit);
        }

        if ($totalDebit != $totalCredit) {
            echo json_encode([
                "errorMsg" => "Total Debit ($totalDebit) harus sama dengan Total Credit ($totalCredit)"
            ]);
            return;
        }

        // Start Transaction
        $this->db->trans_start();

        // Insert or Update Header
        if (!empty($id)) {
            // UPDATE
            $headerData['updated_at'] = date('Y-m-d H:i:s');
            $this->journal->updateHeader($id, $headerData);
            $header_id = $id;

            // Delete old details
            $this->journal->deleteDetailByHeaderId($header_id);
        } else {
            // INSERT
            $headerData['created_at'] = date('Y-m-d H:i:s');
            $header_id = $this->journal->insertHeader($headerData);
        }

        // Prepare detail data
        $detailData = [];
        for ($i = 0; $i < count($coa_ids); $i++) {
            $detailData[] = [
                "journal_id" => $header_id,
                "coa_id"            => $coa_ids[$i],
                "type"              => $types[$i],
                "description"       => $descriptions[$i],
                "debit"             => floatval($debits[$i]) ?: 0,
                "credit"            => floatval($credits[$i]) ?: 0
            ];
        }

        // Insert details
        $this->journal->insertDetail($detailData);

        // Complete Transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode([
                "errorMsg" => "Gagal menyimpan journal"
            ]);
        } else {
            echo json_encode([
                "message" => "Journal berhasil disimpan",
                "header_id" => $header_id
            ]);
        }
    }

    public function updateJournal() {
        $id = $this->input->get("id");
        $data = [
            "coa_id"        => $this->input->post("coa_id"),
            "journal_date"  => $this->input->post("journal_date"),
            "description"   => $this->input->post("description"),
            "debit"         => $this->input->post("debit"),
            "credit"        => $this->input->post("credit"),
        ];
        $this->journal->update($id, $data);
        echo json_encode(["message" => "Journal berhasil diupdate"]);
    }

    public function destroyJournal() {
        $id = $this->input->post("id"); 
        $this->journal->delete($id);
        echo json_encode(["message" => "Journal berhasil dihapus"]);
    }

    public function import()
    {
         $data['title'] = 'Journal Import';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template',"journal/import", $data);
    } 

    // public function importPreview()
    // {
    //     $config['upload_path']   = './uploads/';
    //     $config['allowed_types'] = 'xls|xlsx';
    //     $config['encrypt_name']  = TRUE;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('file_excel')) {
    //         echo json_encode(['error' => $this->upload->display_errors()]);
    //         return;
    //     }

    //     $file = $this->upload->data();
    //     $filePath = $file['full_path'];

    //     $spreadsheet = IOFactory::load($filePath);
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $rows = [];
    //     $highestRow = $sheet->getHighestRow();

    //     for ($r = 2; $r <= $highestRow; $r++) {
    //         // ambil cell object untuk kolom A..H sesuai format:
    //         // A=journal_date, B=project_code, C=reference, D=coa_code, E=faktur_pajak, F=description, G=debit, H=credit
    //         $cellA = $sheet->getCell('A'.$r); // tanggal
    //         $rawDate = $cellA->getValue();

    //         // parse tanggal (handle excel date serial / Date cell / string)
    //         $journal_date = null;
    //         try {
    //             if (Date::isDateTime($cellA)) {
    //                 // jika cell bertipe date atau berformat date
    //                 $journal_date = Date::excelToDateTimeObject($rawDate)->format('Y-m-d');
    //             } elseif (is_numeric($rawDate) && $rawDate > 0) {
    //                 // fallback: numeric excel serial
    //                 $journal_date = Date::excelToDateTimeObject((float)$rawDate)->format('Y-m-d');
    //             } else {
    //                 // string -> coba konversi dengan strtotime atau DateTime
    //                 $str = trim((string)$rawDate);
    //                 if ($str !== '') {
    //                     // beberapa kemungkinan format, kita coba strtotime
    //                     $ts = strtotime(str_replace('.', '-', $str));
    //                     if ($ts !== false && $ts > 0) {
    //                         $journal_date = date('Y-m-d', $ts);
    //                     } else {
    //                         // coba beberapa format eksplisit
    //                         $formats = ['Y-m-d','d-m-Y','d/m/Y','d.m.Y','m/d/Y','Y/m/d'];
    //                         foreach ($formats as $fmt) {
    //                             $dt = \DateTime::createFromFormat($fmt, $str);
    //                             if ($dt && $dt->format($fmt) === $str) {
    //                                 $journal_date = $dt->format('Y-m-d');
    //                                 break;
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         } catch (\Exception $e) {
    //             $journal_date = null;
    //         }

    //         $project_code = trim((string)$sheet->getCell('B'.$r)->getValue());
    //         $reference    = trim((string)$sheet->getCell('C'.$r)->getValue());
    //         $coa_code     = trim((string)$sheet->getCell('D'.$r)->getValue());
    //         $faktur_pajak = trim((string)$sheet->getCell('E'.$r)->getValue());
    //         $description  = trim((string)$sheet->getCell('F'.$r)->getValue());
    //         $debit_raw    = $sheet->getCell('G'.$r)->getValue();
    //         $credit_raw   = $sheet->getCell('H'.$r)->getValue();

    //         // coba ubah debit/credit jadi numeric (hilangkan tanda ribuan jika ada)
    //         $debit  = is_numeric($debit_raw) ? (float)$debit_raw : floatval(str_replace([',',' '], ['', ''], $debit_raw));
    //         $credit = is_numeric($credit_raw) ? (float)$credit_raw : floatval(str_replace([',',' '], ['', ''], $credit_raw));

    //         // cek coa
    //         $coa = $this->db->where('code', $coa_code)->get('coa')->row();
    //         $status = $coa ? 'VALID' : 'INVALID';

    //         // jika tanggal tidak valid, tandai INVALID_DATE (opsional)
    //         if (empty($journal_date)) {
    //             $status = 'INVALID_DATE';
    //         }

    //         $rows[] = [
    //             'journal_date' => $journal_date,        // sudah Y-m-d atau null
    //             'project_code' => $project_code,
    //             'reference'    => $reference,
    //             'coa_code'     => $coa_code,
    //             'faktur_pajak' => $faktur_pajak,
    //             'coa_name'     => $coa ? $coa->name : '-',
    //             'description'  => $description,
    //             'debit'        => $debit,
    //             'credit'       => $credit,
    //             'status'       => $status ?? 'Approve'
    //         ];
    //     }

    //     echo json_encode(['rows' => $rows]);
    // }

    // public function importSave()
    // {
    //     $rows = json_decode($this->input->post('rows'), true);

    //     // 🔍 cek apakah ada data invalid
    //     $invalidRows = array_filter($rows, function ($r) {
    //         return ($r['status'] !== 'VALID');
    //     });

    //     if (count($invalidRows) > 0) {
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Masih ada data yang INVALID atau tanggal tidak valid. Harap perbaiki sebelum menyimpan.'
    //         ]);
    //         return;
    //     }

    //     $success = 0;

    //     $this->db->trans_start();

    //     foreach ($rows as $r) {
    //         // di sini pasti sudah VALID semua
    //         $journal = $this->db->where('reference', $r['reference'])
    //                             ->where('project_code', $r['project_code'])
    //                             ->get('journal')
    //                             ->row();

    //         if (!$journal) {
    //             $dataJournal = [
    //                 'project_code' => $r['project_code'],
    //                 'journal_date' => $r['journal_date'],
    //                 'reference'    => $r['reference'],
    //                 'description'  => $r['description'],
    //                 'tax_invoice'  => $r['faktur_pajak']
    //             ];
    //             $this->db->insert('journal', $dataJournal);
    //             $journal_id = $this->db->insert_id();
    //         } else {
    //             $journal_id = $journal->id;
    //         }

    //         // ambil coa
    //         $coa = $this->db->where('code', $r['coa_code'])->get('coa')->row();

    //         // insert journal detail
    //         $dataDetail = [
    //             'journal_id'   => $journal_id,
    //             'coa_id'       => $coa->id,
    //             'description'  => $r['description'],
    //             'debit'        => (float)$r['debit'],
    //             'credit'       => (float)$r['credit']
    //         ];
    //         $this->db->insert('journal_details', $dataDetail);
    //         $success++;
    //     }

    //     $this->db->trans_complete();

    //     if ($this->db->trans_status() === FALSE) {
    //         echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data.']);
    //     } else {
    //         echo json_encode(['success' => true, 'message' => "$success data berhasil disimpan."]);
    //     }
    // }

    public function importPreview()
    {
        header('Content-Type: application/json');
        
        // Validasi apakah ada file yang diupload
        if (!isset($_FILES['file_excel']) || $_FILES['file_excel']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'Tidak ada file yang diupload atau terjadi error saat upload.']);
            return;
        }
    
        // Validasi tipe file
        $allowed_types = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $file_type = $_FILES['file_excel']['type'];
        $file_extension = strtolower(pathinfo($_FILES['file_excel']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_type, $allowed_types) && !in_array($file_extension, ['xls', 'xlsx'])) {
            echo json_encode(['error' => 'Tipe file tidak diizinkan. Hanya file Excel (.xls, .xlsx) yang diperbolehkan.']);
            return;
        }
    
        // Validasi ukuran file (maksimal 5MB)
        $max_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['file_excel']['size'] > $max_size) {
            echo json_encode(['error' => 'Ukuran file terlalu besar. Maksimal 5MB.']);
            return;
        }
    
        try {
            // Baca file langsung dari temporary location tanpa menyimpan
            $filePath = $_FILES['file_excel']['tmp_name'];
            
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
    
            $rows = [];
            $highestRow = $sheet->getHighestRow();
    
            // Validasi apakah ada data
            if ($highestRow < 2) {
                echo json_encode(['error' => 'File Excel tidak memiliki data. Minimal harus ada 1 baris data setelah header.']);
                return;
            }
    
            for ($r = 2; $r <= $highestRow; $r++) {
                $cellA = $sheet->getCell('A'.$r);
                $rawDate = $cellA->getValue();
    
                // Parse tanggal
                $journal_date = null;
                try {
                    if (Date::isDateTime($cellA)) {
                        $journal_date = Date::excelToDateTimeObject($rawDate)->format('Y-m-d');
                    } elseif (is_numeric($rawDate) && $rawDate > 0) {
                        $journal_date = Date::excelToDateTimeObject((float)$rawDate)->format('Y-m-d');
                    } else {
                        $str = trim((string)$rawDate);
                        if ($str !== '') {
                            $ts = strtotime(str_replace('.', '-', $str));
                            if ($ts !== false && $ts > 0) {
                                $journal_date = date('Y-m-d', $ts);
                            } else {
                                $formats = ['Y-m-d', 'd-m-Y', 'd/m/Y', 'd.m.Y', 'm/d/Y', 'Y/m/d'];
                                foreach ($formats as $fmt) {
                                    $dt = \DateTime::createFromFormat($fmt, $str);
                                    if ($dt && $dt->format($fmt) === $str) {
                                        $journal_date = $dt->format('Y-m-d');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } catch (\Exception $e) {
                    $journal_date = null;
                }
    
                $project_code = trim((string)$sheet->getCell('B'.$r)->getValue());
                $reference    = trim((string)$sheet->getCell('C'.$r)->getValue());
                $coa_code     = trim((string)$sheet->getCell('D'.$r)->getValue());
                $faktur_pajak = trim((string)$sheet->getCell('E'.$r)->getValue());
                $description  = trim((string)$sheet->getCell('F'.$r)->getValue());
                $debit_raw    = $sheet->getCell('G'.$r)->getValue();
                $credit_raw   = $sheet->getCell('H'.$r)->getValue();
                $journal_status = trim((string)$sheet->getCell('I'.$r)->getValue());
    
                // Skip baris kosong
                if (empty($project_code) && empty($reference) && empty($coa_code)) {
                    continue;
                }
    
                $debit  = is_numeric($debit_raw) ? (float)$debit_raw : floatval(str_replace([',',' '], ['', ''], $debit_raw));
                $credit = is_numeric($credit_raw) ? (float)$credit_raw : floatval(str_replace([',',' '], ['', ''], $credit_raw));
    
                // Validasi COA
                $coa = $this->db->where('code', $coa_code)->get('coa')->row();
                $status = $coa ? 'VALID' : 'INVALID';
    
                // Validasi Project Code
                $code_project = $this->db->where('code', $project_code)->get('project_code')->row();
                $code_project_name = $code_project ? $code_project->name : '-';
                
                // Jika project code tidak ditemukan, tandai sebagai INVALID
                if (!$coa) {
                    $status = 'INVALID';
                }
    
                // Validasi tanggal
                if (empty($journal_date)) {
                    $status = 'INVALID_DATE';
                }
    
                // Validasi status journal
                $status_journal = (strtolower($journal_status) === 'new') ? 'New' : 'Approved';
    
                $rows[] = [
                    'journal_date'   => $journal_date,
                    'project_code'   => $code_project_name,
                    'reference'      => $reference,
                    'coa_code'       => $coa_code,
                    'faktur_pajak'   => $faktur_pajak,
                    'coa_name'       => $coa ? $coa->name : '-',
                    'description'    => $description,
                    'debit'          => $debit,
                    'credit'         => $credit,
                    'status'         => $status,
                    'status_journal' => $status_journal
                ];
            }
    
            // Validasi apakah ada data yang berhasil dibaca
            if (empty($rows)) {
                echo json_encode(['error' => 'Tidak ada data valid yang dapat dibaca dari file Excel.']);
                return;
            }
    
            echo json_encode(['rows' => $rows]);
    
        } catch (\Exception $e) {
            echo json_encode(['error' => 'Terjadi kesalahan saat membaca file Excel: ' . $e->getMessage()]);
        }
    }



    public function importSave()
    {
        $rows = json_decode($this->input->post('rows'), true);
    
        // Validate rows for 'INVALID' status or invalid dates
        $invalidRows = array_filter($rows, function ($r) {
            return ($r['status'] !== 'VALID');
        });
    
        if (count($invalidRows) > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Masih ada data yang INVALID atau tanggal tidak valid. Harap perbaiki sebelum menyimpan.'
            ]);
            return;
        }
    
        // Group rows by reference
        $groupedByReference = [];
        foreach ($rows as $r) {
            $ref = $r['reference'];
            if (!isset($groupedByReference[$ref])) {
                $groupedByReference[$ref] = [];
            }
            $groupedByReference[$ref][] = $r;
        }
    
        // Check each reference group - all items must have same status_journal
        foreach ($groupedByReference as $reference => $refRows) {
            $statuses = array_unique(array_column($refRows, 'status_journal'));
            
            if (count($statuses) > 1) {
                echo json_encode([
                    'success' => false,
                    'message' => "Reference '$reference' memiliki status yang berbeda. Semua item dalam satu reference harus memiliki status yang sama (semua New atau semua Approved)."
                ]);
                return;
            }
        }
    
        $success = 0;
    
        // Start transaction
        $this->db->trans_begin();
    
        foreach ($groupedByReference as $reference => $refRows) {
            $status_journal = $refRows[0]['status_journal'];
    
            if ($status_journal === 'New') {
                // Get COA ID from coa_code first
                $coaIds = [];
                foreach ($refRows as $r) {
                    $coa = $this->db->where('code', $r['coa_code'])->get('coa')->row();
                    if ($coa) {
                        $coaIds[$r['coa_code']] = $coa->id;
                    }
                }
                
                // Insert into RPA and RPA Details
                $dataRPA = [
                    'category' => $refRows[0]['project_code'],
                    'request_date' => $refRows[0]['journal_date'],
                    'charge_code'    => $reference,
                    'note'  => $refRows[0]['description'],
                    'faktur_pajak'  => $refRows[0]['faktur_pajak']
                ];
                $this->db->insert('rpa', $dataRPA);
                $rpa_id = $this->db->insert_id();
    
                foreach ($refRows as $r) {
                    $dataRpaDetail = [
                        'rpa_id'              => $rpa_id,
                        'coa_id'              => $coaIds[$r['coa_code']],
                        'remark'              => $r['description'],
                        'debit_amount'        => $r['debit'],
                        'credit_amount'       => $r['credit']
                    ];
                    $this->db->insert('rpa_detail', $dataRpaDetail);
                    $success++;
                }
            } else if ($status_journal === 'Approved') {
                // Insert into Journal and Journal Details
                $journal = $this->db->where('reference', $reference)
                                    ->where('project_code', $refRows[0]['project_code'])
                                    ->get('journal')
                                    ->row();
    
                if (!$journal) {
                    $dataJournal = [
                        'project_code' => $refRows[0]['project_code'],
                        'journal_date' => $refRows[0]['journal_date'],
                        'reference'    => $reference,
                        'description'  => $refRows[0]['description'],
                        'tax_invoice'  => $refRows[0]['faktur_pajak']
                    ];
                    $this->db->insert('journal', $dataJournal);
                    $journal_id = $this->db->insert_id();
                } else {
                    $journal_id = $journal->id;
                }
    
                foreach ($refRows as $r) {
                    $coa = $this->db->where('code', $r['coa_code'])->get('coa')->row();
    
                    $dataDetail = [
                        'journal_id'   => $journal_id,
                        'coa_id'       => $coa->id,
                        'description'  => $r['description'],
                        'debit'        => (float)$r['debit'],
                        'credit'       => (float)$r['credit']
                    ];
                    $this->db->insert('journal_details', $dataDetail);
                    $success++;
                }
            }
        }
    
        // Commit or rollback transaction
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data ke database.']);
        } else {
            $this->db->trans_commit();
            echo json_encode(['success' => true, 'message' => "$success data berhasil disimpan."]);
        }
    }

}
