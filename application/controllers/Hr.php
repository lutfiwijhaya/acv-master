<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Dompdf\Dompdf;
use Dompdf\Options;

class Hr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
        $this->load->model('Hr_model', 'hr_model');  
    }
    
    // Fungsi untuk menampilkan form pendaftaran kandidat
    function formCandidate()
    {
        $data['collapsed'] = '';
        $data['title'] = 'Formulir Kandidat';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'hr/formuser', $data);
    }
    
    //controller form candidate
    // Fungsi untuk menyimpan data pendaftaran kandidat dan keluarga
   public function submit_application()
    {
    // Tangkap user_id dari form
    $user_id = $this->input->post('user_id');

    // Menangkap dan memproses data alamat
    $home_address = $this->input->post('alamat');
    $current_address = $this->input->post('current_address');
    if (empty($current_address)) {
        $current_address = $home_address;
    }

    // Menangkap data utama untuk tabel tbl_user
    $data = [
        'applying_occupation' => $this->input->post('applying_occupation'),
        'desired_salary'      => $this->input->post('desired_salary'),
        'nama'                => $this->input->post('nama'),
        'jk'                  => $this->input->post('jk'),
        'nik'                 => $this->input->post('nik'),
        'tgl_lahir'           => $this->input->post('tgl_lahir'),
        'tempat_lahir'        => $this->input->post('tempat_lahir'),
        'marital'             => $this->input->post('marital'),
        'religion'            => $this->input->post('religion'),
        'alamat'              => $home_address,
        'current_address'     => $current_address,
        'email'               => $this->input->post('email'),
        'no_hp'               => $this->input->post('no_hp'),
        'npwp'                => $this->input->post('npwp'),
        'bpjs_kt'             => $this->input->post('bpjs_kt'),
        'bpjs_ks'             => $this->input->post('bpjs_ks'),
    ];

    // Logika upload foto jika ada
    if (!empty($_FILES['photo']['name'])) {
        $config['upload_path']   = './uploads/hr_file/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            $data['path_foto'] = $this->upload->data('file_name');
        }
    }

    // LOGIKA UTAMA: INSERT ATAU UPDATE?
    if (empty($user_id)) {
        // Jika tidak ada user_id, ini adalah DATA BARU (INSERT)
        $data['posisi'] = 16; // Set posisi default untuk kandidat baru
        $success = $this->hr_model->save_application($data);
        $new_user_id = $this->db->insert_id();
        //buat notifikasi email ke admin
          if ($success) {
            $this->load->library('email'); // Muat library email

            $nama_kandidat = $this->input->post('nama');

            $this->email->from('emailanda@gmail.com', 'Sistem HR CKA');
            $this->email->to('abni4250@gmail.com'); // GANTI DENGAN EMAIL TUJUAN
            
            $this->email->subject('Pendaftaran Kandidat Baru: ' . $nama_kandidat);
            $this->email->message(
                '<h3>Pendaftaran Kandidat Baru</h3>' .
                '<p>Seorang kandidat baru telah mendaftar melalui sistem.</p>' .
                '<ul>' .
                '<li><strong>Nama:</strong> ' . $nama_kandidat . '</li>' .
                '<li><strong>Posisi yang Dilamar:</strong> ' . $this->input->post('applying_occupation') . '</li>' .
                '</ul>' .
                '<p>Silakan periksa data lengkapnya di aplikasi.</p>'
            );

            // Coba kirim email (tidak akan menghentikan proses jika gagal)
            if (!$this->email->send()) {
                log_message('error', $this->email->print_debugger());
            }
        }
        // --- AKHIR BLOK KODE EMAIL ---
    } else {
        // Jika ada user_id, ini adalah EDIT (UPDATE)
        $success = $this->hr_model->update_candidate($user_id, $data);
        $new_user_id = $user_id;
    }
    //
    
    
    if ($success) {
        
        // Hapus data lama yang terkait agar bisa diisi ulang
        $this->hr_model->delete_related_data($new_user_id);
        
        // Simpan/Update data pendidikan
        $graduations = $this->input->post('graduation');
        if (is_array($graduations)) {
            $academic_batch = [];
            for ($i = 0; $i < count($graduations); $i++) {
                if (!empty($this->input->post('registered_school_name')[$i])) {
                    $academic_batch[] = [
                        'user_id' => $new_user_id,
                        'graduation' => $graduations[$i],
                        'registered_school_name' => $this->input->post('registered_school_name')[$i],
                        'location' => $this->input->post('location')[$i],
                        'jurusan' => $this->input->post('jurusan')[$i]
                    ];
                }
            }
            if (!empty($academic_batch)) {
                $this->hr_model->insert_academic_batch($academic_batch);
            }
        }
        
        // Simpan/Update data sertifikat
        $acquisitions = $this->input->post('acquisition');
        if (is_array($acquisitions)) {
            $certificate_data = [];
            for ($i = 0; $i < count($acquisitions); $i++) {
                if (!empty($this->input->post('certificate')[$i])) {
                    $certificate_data[] = [
                        'user_id' => $new_user_id,
                        'acquisition' => $acquisitions[$i],
                        'certificate' => $this->input->post('certificate')[$i],
                        'authority' => $this->input->post('authority')[$i],
                        'issue_location' => $this->input->post('issue_location')[$i],
                        'certificate_no' => $this->input->post('certificate_no')[$i]
                    ];
                }
            }
            if (!empty($certificate_data)) {
                $this->hr_model->insert_certificates_batch($certificate_data);
            }
        }

        // Simpan/Update data karir
        $company_names = $this->input->post('company_name');
        if (is_array($company_names)) {
            $career_data = [];
            for ($i = 0; $i < count($company_names); $i++) {
                if (!empty($company_names[$i])) {
                    $career_data[] = [
                        'user_id' => $new_user_id,
                        'company_name' => $company_names[$i],
                        'position' => $this->input->post('position')[$i],
                        'period_star' => $this->input->post('period_star')[$i] . '-01',
                        'period_end' => $this->input->post('period_end')[$i] . '-01',
                        'career' => $this->input->post('career')[$i]
                    ];
                }
            }
            if (!empty($career_data)) {
                $this->hr_model->insert_career_data($career_data);
            }
        }

        // Simpan/Update data motivasi
        $motivation_reason = $this->input->post('motivation_reason');
        if (!empty($motivation_reason)) {
            $motivation_data = ['user_id' => $new_user_id, 'motivation_reason' => $motivation_reason];
            $this->hr_model->insert_motivation_data($new_user_id, $motivation_data);
        }
        
        echo json_encode(['success' => true, 'message' => 'Data updated successfully.']);

    } else {
        echo json_encode(['errorMsg' => 'Failed to update main data.']);
    }
}
//end form candidate




        
//cobtroller list candidate
        function listCandidate2()
    {
        // 1. Ambil data kandidat
    $data['candidates'] = $this->hr_model->get_all_candidates();

    // 2. Data untuk template
    $data['title'] = 'List of Candidates';
    $data['collapsed'] = ''; // Variabel ini mungkin untuk status sidebar

    // 3. Muat ASET UNTUK DATATABLES, BUKAN EASYUI
    $data['css_files'][] = 'https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css';
    $data['js_files'][] = 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js';
    $data['js_files'][] = 'https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js';


    $this->template->load('template', 'hr/listcandidate', $data);
    }
//end list candidate untuk dataa 


// star listdancidatate
     function listCandidate()
    {
        // $data['candidates'] = $this->hr_model->get_all_candidates();

        $data['title']  = 'List Candidates';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'hr/listcandidate', $data);
    }
//end list candidate

    //star 
    public function edit_candidate($id)
    {
    // Ambil data kandidat yang akan diedit dari model
    $data['candidate'] = $this->hr_model->get_candidate_by_id($id);

    $data['academics'] = $this->hr_model->get_academics_by_user_id($id);

    $data['certificates'] = $this->hr_model->get_certificates_by_user_id($id);

    $data['careers'] = $this->hr_model->get_careers_by_user_id($id);

     $data['motivation'] = $this->hr_model->get_motivation_by_user_id($id);

    // Jika data tidak ditemukan, tampilkan error 404
    if (!$data['candidate']) {
        show_404();
    }
    
    // Siapkan data untuk view
    $data['title'] = 'Edit Candidate - ' . $data['candidate']['nama'];
    $data['is_edit'] = true; // Tambahkan flag untuk menandakan ini mode edit

    // Muat view yang sama dengan form tambah data
    $this->template->load('template', 'hr/formuser', $data);
}
//end  

// academic_detail.php
    public function view_academic_detail($user_id)
    {
    // Ambil data kandidat untuk menampilkan nama di judul
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    
    if (!$data['candidate']) {
        show_404();
    }

    // Ambil semua data akademik untuk kandidat ini
    $data['academics'] = $this->hr_model->get_academics_by_user_id($user_id);
    
    // Siapkan data untuk template
    $data['title'] = 'Academic History - ' . $data['candidate']['nama'];
    $data['collapsed'] = '';
    // (Anda bisa tambahkan css/js EasyUI di sini jika perlu)
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Load view baru untuk halaman detail
    $this->template->load('template', 'hr/view_academic_detail', $data);
    }
// end academic_detail 

    //star untuk mengambil semua data candidate
    public function get_candidates_json()
    {

    // Atur header output menjadi JSON
    header('Content-Type: application/json');

    // Ambil data pencarian dari AJAX request
    $search_term = $this->input->get('search_data');
    
    // Kirim search_term ke model
    $candidates = $this->hr_model->get_all_candidates($search_term);

    // Hitung total data untuk paginasi
    $total = count($candidates);

    // Siapkan data dalam format yang dibutuhkan EasyUI: {total:..., rows:[...]}
    $response = [
        'total' => $total,
        'rows' => $candidates
    ];

    // Cetak data sebagai JSON
    echo json_encode($response);
    }
// end get_candidates_json

// bagian academics_detail.php
    public function get_academic_json($user_id)
    {
    // Atur header output menjadi JSON
    header('Content-Type: application/json');

    // Ambil keyword pencarian dari request GET yang dikirim oleh datagrid
    $search_term = $this->input->get('search_term');

    // Kirim user_id dan search_term ke model
    $academics = $this->hr_model->get_academics_by_user_id($user_id, $search_term);
    // Siapkan data dalam format yang dibutuhkan EasyUI: {total:..., rows:[...]}
    $response = [
        'total' => count($academics),
        'rows' => $academics
    ];

    // Cetak data sebagai JSON
    echo json_encode($response);
    }
// bagian detail end

// bagian untuk data family_detail.php
    public function view_family_detail($user_id)
    {
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Family Data - ' . $data['candidate']['nama'];
    $data['collapsed'] = '';
    
    // Muat aset yang dibutuhkan EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Load view baru untuk halaman detail keluarga
    $this->template->load('template', 'hr/view_family_detail', $data);
    }
//end

// family pencarian
    public function get_family_json($user_id)
    {
    header('Content-Type: application/json');

 // Ambil keyword pencarian dari request GET
    $search_term = $this->input->get('search_term');

    // Gunakan fungsi model yang sudah ada
    $families = $this->hr_model->get_families_by_user_id($user_id, $search_term);
    
    // Format data agar sesuai standar EasyUI
    $response = [
        'total' => count($families),
        'rows' => $families
    ];

    echo json_encode($response);
    }
// end family_detail.php pencarian


// bagian skil and certification
    public function view_skill_detail($user_id)
    {
    // Ambil data kandidat untuk judul dan keperluan lain
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    
    // Jika kandidat dengan ID tersebut tidak ada, tampilkan 404
    if (!$data['candidate']) {
        show_404();
    }

    // Siapkan data untuk dikirim ke template
    $data['title'] = 'List of Skills - ' . $data['candidate']['nama'];
    $data['collapsed'] = ''; // Sesuaikan jika perlu
    
    // Muat aset yang dibutuhkan EasyUI untuk halaman ini
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Load view detail skill melalui template utama
    $this->template->load('template', 'hr/view_skil_detail', $data);
    }
// end skill and certification

// bagian test table
    public function get_career_json($user_id)
    {
    header('Content-Type: application/json');

    // Ambil keyword pencarian yang dikirim oleh request GET yang dikirim oleh datagrid
    $search_term = $this->input->get('search_term');

    // buat ngambil data di model 
    $careers = $this->hr_model->get_careers_by_user_id($user_id, $search_term);
    
    $response = [
        'total' => count($careers),
        'rows'  => $careers
    ];
    echo json_encode($response);
    }
//endd


public function view_certificate_detail($user_id)
{
    // Ambil data kandidat untuk menampilkan nama di judul
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);

    if (!$data['candidate']) {
        show_404();
    }

    // Siapkan data untuk dikirim ke template
    $data['title'] = 'Skill Authorized Certificates - ' . $data['candidate']['nama'];
    $data['collapsed'] = ''; // Sesuaikan jika perlu
    
    // Muat aset yang dibutuhkan EasyUI untuk halaman ini
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

// --- LOGIKA BARU UNTUK TOMBOL BACK DINAMIS ---
    $from = $this->input->get('from'); // Ambil parameter 'from' dari URL

    if ($from == 'listsummary') {
        // Jika datang dari listsummary, siapkan URL kembali ke listsummary
        $data['back_url'] = site_url('hr/listsummary');
    } else {
        // Jika tidak, atau jika parameter 'from' tidak ada, kembali ke listcandidate
        $data['back_url'] = site_url('hr/listcandidate');
    }
    // --- AKHIR DARI LOGIKA BARU ---

    // Load view detail sertifikat melalui template utama
    $this->template->load('template', 'hr/view_certificate_detail', $data);
}
        
public function get_certificates_json($user_id)
{
  
    header('Content-Type: application/json');

    
    $search_term = $this->input->get('search_term');

    // Panggil fungsi model untuk mengambil data dari database
    $certificates = $this->hr_model->get_certificates_by_user_id($user_id, $search_term);

    // Siapkan data dalam format yang dibutuhkan EasyUI: {total:..., rows:[...]}
    $response = [
        'total' => count($certificates),
        'rows'  => $certificates
    ];

    // Cetak data sebagai string JSON
    echo json_encode($response);
}

// save
public function save_candidate()
{
    // ... Logika untuk mengambil data dari $_POST dan menyimpan ke database ...
    // ... Mirip seperti fungsi save_certificate atau save_career ...
    header('Content-Type: application/json');
    $data = [
        'nama' => $this->input->post('nama'),
        'applying_occupation' => $this->input->post('applying_occupation'),
        // ... semua field lainnya ...
        'posisi' => 16 // Pastikan posisi diset dengan benar
    ];

    // Panggil model untuk insert
    $success = $this->hr_model->insert_candidate($data);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
    } else {
        echo json_encode(['errorMsg' => 'Failed to save data.']);
    }
}



//star untuk update dan bagian menyimpan data data dan foto
public function update_candidate($id) 
{
    
    // ... Mirip seperti fungsi update_certificate atau update_career ...
    header('Content-Type: application/json');
    $data = [
        'nama' => $this->input->post('nama'),
        'applying_occupation' => $this->input->post('applying_occupation'),
        'desired_salary' => $this->input->post('desired_salary'),
        'email' => $this->input->post('email'),
        'nik' => $this->input->post('nik'),
        'marital' => $this->input->post('marital'),
        'tempat_lahir' => $this->input->post('tempat_lahir'),
        'jk' => $this->input->post('jk'),
        'tgl_lahir' => $this->input->post('tgl_lahir'),
        'alamat' => $this->input->post('alamat'),
        'current_address' => $this->input->post('current_address'),
        'religion' => $this->input->post('religion'),
        'no_hp' => $this->input->post('no_hp'),
        'npwp' => $this->input->post('npwp'),
        'bpjs_kt'=> $this->input->post('bpjs_kt'),
        'bpjs_ks' => $this->input->post('bpjs_ks'),
        
    ];

    

     // --- LOGIKA UPLOAD FOTO YANG DIPERBAIKI ---
    if (!empty($_FILES['photo']['name'])) { // Pastikan 'photo' sesuai dengan name di form
        $config['upload_path']   = './uploads/hr_file/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // Max 2MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('photo')) {
            // 1. Ambil nama file yang lama dari input tersembunyi
            $old_photo = $this->input->post('old_photo');
            
            // 2. Hapus file foto yang lama jika ada
            if (!empty($old_photo) && file_exists('./uploads/hr_file/' . $old_photo)) {
                unlink('./uploads/hr_file/' . $old_photo);
            }
            
            // 3. Simpan nama file yang baru ke dalam array data
            $data['path_foto'] = $this->upload->data('file_name');
        } else {
            // Jika upload gagal, kirim pesan error
            echo json_encode(['errorMsg' => $this->upload->display_errors('', '')]);
            return;
        }
    }
// --- AKHIR LOGIKA UPLOAD ---
    
    // Panggil model untuk update
    $success = $this->hr_model->update_candidate($id, $data);

//
     if ($success) {
        // --- LOGIKA BARU UNTUK DATA AKADEMIK ---
        
        // 1. Hapus semua data pendidikan LAMA untuk user ini
        // $this->hr_model->delete_academic_data($id);
        $this->hr_model->delete_related_data($id);

        // 2. Ambil data pendidikan BARU dari form
        $graduations = $this->input->post('graduation');
        $school_names = $this->input->post('registered_school_name');
        $locations = $this->input->post('location');
        $majors = $this->input->post('jurusan');

        $academic_batch = [];
        if (is_array($graduations)) {
            for ($i = 0; $i < count($graduations); $i++) {
                // Hanya simpan jika nama sekolah diisi
                if (!empty($school_names[$i])) {
                    $academic_batch[] = [
                        'user_id'                => $id,
                        'graduation'             => $graduations[$i],
                        'registered_school_name' => $school_names[$i],
                        'location'               => $locations[$i],
                        'jurusan'                => $majors[$i]
                    ];
                }
            }
        }
        //end 2
        
        // 2. Simpan semua data pendidikan BARU sekaligus
        if (!empty($academic_batch)) {
            $this->hr_model->insert_academic_batch($academic_batch);
        }
        // --- end AKHIR LOGIKA academic ---

        // 3 untuk sertifikat
         $acquisitions = $this->input->post('acquisition');
    if (is_array($acquisitions)) {
        $certificate_batch = [];
        for ($i = 0; $i < count($acquisitions); $i++) {
            // Hanya simpan jika nama sertifikat diisi
            if (!empty($this->input->post('certificate')[$i])) {
                $certificate_batch[] = [
                    'user_id'         => $id,
                    'acquisition'    => $acquisitions[$i],
                    'certificate'    => $this->input->post('certificate')[$i],
                    'authority'      => $this->input->post('authority')[$i],
                    'issue_location' => $this->input->post('issue_location')[$i],
                    'certificate_no' => $this->input->post('certificate_no')[$i]
                ];
            }
        }
        if (!empty($certificate_batch)) {
            $this->hr_model->insert_certificates_batch($certificate_batch);
        }
    }
        //end 3

        // star
        // 4. Simpan data pengalaman kerja
        $company_names = $this->input->post('company_name');
    if (is_array($company_names)) {
        $career_batch = [];
        for ($i = 0; $i < count($company_names); $i++) {
            // Hanya simpan jika nama perusahaan diisi
            if (!empty($company_names[$i])) {
                $career_batch[] = [
                    'user_id'       => $id,
                    'company_name'  => $company_names[$i],
                    'position'      => $this->input->post('position')[$i],
                    'period_star'   => $this->input->post('period_star')[$i] . '-01',
                    'period_end'    => $this->input->post('period_end')[$i] . '-01',
                    'career'        => $this->input->post('career')[$i]
                ];
            }
        }
        if (!empty($career_batch)) {
            $this->hr_model->insert_career_batch($career_batch);
        }
    }
    // end

    //untuk motivasi star
    $motivation_reason = $this->input->post('motivation_reason');
        if (!empty($motivation_reason)) {
            $motivation_data = [
                'user_id' => $id,
                'motivation_reason' => $motivation_reason
            ];
            // Anda mungkin sudah punya fungsi ini, atau perlu membuatnya
            $this->hr_model->insert_motivation_data($motivation_data);
        }
    //end motivaiso

    //star
        echo json_encode(['success' => true, 'message' => 'Data updated successfully.']);

    } else {
        echo json_encode(['errorMsg' => 'Failed to update main data.']);
    }
}

// Fungsi untuk MENGHAPUS data
    public function delete_candidate()
    {
    header('Content-Type: application/json');
    $id = $this->input->post('id');
    $success = $this->hr_model->delete_candidate($id);
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['errorMsg' => 'Failed to delete data.']);
    }
    }
// end


// public function test_table()
// {
//     // Mengambil data kandidat
//     $data['candidates'] = $this->hr_model->get_all_candidates();
    
//     // Memuat view BARU secara langsung, TANPA template
//     $this->load->view('hr/v_test_table', $data);
// }

// untuk bagian form summary

    public function formsummary($id)
    {
    $data['candidate'] = $this->hr_model->get_candidate_by_id($id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['last_education'] = $this->hr_model->get_last_education($id);
    $data['careers'] = $this->hr_model->get_careers_by_user_id($id);
    
    // --- LOGIKA BARU DAN BENAR UNTUK DATA KELUARGA ---
    
    // 1. Siapkan array default. Gunakan 'grandparent' (tanpa spasi) agar konsisten.
    $family_summary = [
        'grandparent' => ['number' => 0, 'accompany' => 'No'],  
        'parent'      => ['number' => 0, 'accompany' => 'No'],
        'wife'        => ['number' => 0, 'accompany' => 'No'],
        'son'         => ['number' => 0, 'accompany' => 'No'],
        'daughter'    => ['number' => 0, 'accompany' => 'No']
    ];

    // 2. Ambil data keluarga yang sudah tersimpan di database
    $families_from_db = $this->hr_model->get_families_by_user_id($id);

    // 3. Isi array summary dengan data yang sudah ada
    if (!empty($families_from_db)) {
        foreach ($families_from_db as $family) {
            // ganti 'grand parent' atau 'Grand Parent' menjadi 'grandparent' agar cocok
            $relation_key = str_replace(' ', '', strtolower($family['relation'])); 
            
            if (array_key_exists($relation_key, $family_summary)) {
                // Ambil nilai 'number' dan 'cohabit' yang sudah tersimpan di database
                $family_summary[$relation_key]['number'] = $family['number'] ?? 0;
                $family_summary[$relation_key]['accompany'] = ucfirst($family['cohabit'] ?? 'no');
            }
        }
    }
    
    // 4. Kirim hasil akhir ke view
    $data['family_summary'] = $family_summary;
    // ---end AKHIR DARI LOGIKA KELUARGA ---

    //bagian untuk melihat data dokumen yang sudah tersimpan di database
        $uploaded_docs_raw = $this->hr_model->get_documents_by_user_id($id);
        
          $uploaded_docs_formatted = [];
    foreach ($uploaded_docs_raw as $doc) {
        $uploaded_docs_formatted[$doc['document_type']] = $doc;
    }
    $data['documents'] = $uploaded_docs_formatted;
    // --- AKHIR DARI BLOK DOKUMEN ---

    // --- LOGIKA UNTUK DATA SERTIFIKAT (DIPERBAIKI) ---
$certificates_from_db = $this->hr_model->get_certificates_by_user_id($id);
$certificate_data_formatted = [];

// Isi array dengan data dari database, sesuai urutan
if (!empty($certificates_from_db)) {
    $i = 1;
    foreach ($certificates_from_db as $cert) {
        $certificate_data_formatted['id_' . $i]        = $cert['id'];
        $certificate_data_formatted['name_' . $i]      = $cert['certificate'];
        $certificate_data_formatted['authority_' . $i] = $cert['authority'];
        $certificate_data_formatted['no_' . $i]        = $cert['certificate_no'];
        $certificate_data_formatted['date_' . $i]      = $cert['acquisition'];
        $i++;
    }
}
$data['certificate_data'] = $certificate_data_formatted;
// --- AKHIR LOGIKA SERTIFIKAT ---



// 1. Ambil semua data hired untuk user ini dari database
    $hired_data_from_db = $this->hr_model->get_hired_data_by_user_id($id);

    // 2. Siapkan array kosong untuk menampung data yang sudah diformat
    $hired_status_formatted = [];

    // 3. Ubah format data agar mudah diakses di view
    foreach ($hired_data_from_db as $row) {
        // Buat key baru yang cocok dengan nama input di form Anda
        // Contoh: 'Type of Hired' -> 'hired_type'
        $input_name = str_replace(' ', '_', strtolower($row['intial']));
        $input_name = str_replace(['.', '(', ')'], '', $input_name);
        
        $hired_status_formatted[$input_name] = $row['value'];
    }

    // 4. Kirim data yang sudah diformat ke view
    $data['hired_status'] = $hired_status_formatted;
    
    // --- AKHIR LOGIKA HIRED STATUS ---
    //end

    // 1. Ambil semua data gaji untuk user ini dari database
$salary_data_from_db = $this->hr_model->get_salary_data_by_user_id($id);

// 2. Siapkan array kosong untuk menampung data yang sudah diformat
$salary_formatted = [];

// 3. Ubah format data agar mudah diakses di view
foreach ($salary_data_from_db as $row) {
    // Buat kunci baru yang cocok dengan nama input di form Anda
    // str_replace sekarang juga mengubah '/' menjadi '_'
    $key = 'salary_' . str_replace([' ', '/'], '_', strtolower($row['allowances']));
    
    // Hapus karakter lain yang mungkin mengganggu
    $key = str_replace(['.', '(', ')'], '', $key);
    
    $salary_formatted[$key] = $row['salary'];
}   

    // 4. Kirim data yang sudah diformat ke view
    $data['salary_data'] = $salary_formatted;



    // Ambil data reward
$rewards_from_db = $this->hr_model->get_rewards_by_user_id($id);
$reward_data_formatted = [];

if (!empty($rewards_from_db)) {
    $i = 1;
    foreach ($rewards_from_db as $reward) {
        if ($i > 4) break;
        $reward_data_formatted['id_'.$i]     = $reward['id'];
        $reward_data_formatted['name_'.$i]   = $reward['reward_name'];
        $reward_data_formatted['date_'.$i]   = $reward['reward_date'];
        $reward_data_formatted['result_'.$i] = $reward['reward_result'];
        $i++;
    }
}
$data['reward_data'] = $reward_data_formatted;
//end 


// --- LOGIKA UNTUK DATA DISCIPLINARY (DIPERBAIKI) ---
$disciplinary_from_db = $this->hr_model->get_disciplinary_by_user_id($id);
$disciplinary_data_formatted = [];

if (!empty($disciplinary_from_db)) {
    $i = 1;
    foreach ($disciplinary_from_db as $item) {
        if ($i > 4) break;
        $disciplinary_data_formatted['id_'.$i]          = $item['id'];
        $disciplinary_data_formatted['description_'.$i]  = $item['description'];
        $disciplinary_data_formatted['date_'.$i]        = $item['disciplinary_date'];
        $disciplinary_data_formatted['date_start_'.$i]  = $item['disciplinary_period_star']; // Ambil dari kolom yang benar
        $disciplinary_data_formatted['date_end_'.$i]    = $item['disciplinary_period_end'];   // Ambil dari kolom yang benar
        $disciplinary_data_formatted['result_'.$i]      = $item['disciplinary_result'];
        $i++;
    }
}
$data['disciplinary_data'] = $disciplinary_data_formatted;
// --- AKHIR LOGIKA DISCIPLINARY ---



// --- TAMBAHKAN LOGIKA INI ---
    // Ambil daftar semua posisi untuk dropdown
    $data['positions'] = $this->hr_model->get_all_positions();
    
    // Ambil data kronologi yang sudah tersimpan
    $data['chronology_data'] = $this->hr_model->get_chronology_by_user_id($id);
    // --- AKHIR DARI LOGIKA BARU ---
    
    
    $data['title'] = 'Summary Status - ' . $data['candidate']['nama'];
    $this->template->load('template', 'hr/formsummary', $data);
}
//end 
// application/controllers/Hr.php





//star pas bagian submit sumary
public function submit_summary()
{
    $user_id = $this->input->post('user_id');
    
    // 1. Kumpulkan dan simpan data yang HANYA untuk tabel tbl_user
    $summary_user_data = [
        'religion'                   => $this->input->post('religion'),
        'summary_discipline'         => $this->input->post('summary_discipline'),
        'posisi'                     => $this->input->post('posisi_id'),
        'summary_age_years'          => $this->input->post('summary_age_years'),
        'summary_age_months'         => $this->input->post('summary_age_months'),
        'applying_occupation'        => $this->input->post('summary_position'),
        'summary_class_grade'        => $this->input->post('summary_class_grade'),
        'desired_salary'             => $this->input->post('summary_expected_salary'),
        'summary_career_years'       => $this->input->post('summary_career_years'),
        'summary_career_months'      => $this->input->post('summary_career_months'),

          // Data untuk alamat dari textarea
        'alamat'                       => $this->input->post('address_home'),
        'current_address'              => $this->input->post('address_current')
        
    ];

    // --- LOGIKA BARU UNTUK APPLYING OCCUPATION ---
    $custom_occupation = $this->input->post('applying_occupation');
    if (!empty($custom_occupation)) {
    $summary_user_data['applying_occupation'] = $custom_occupation;
    }

    // --- AKHIR LOGIKA BARU ---

  $this->hr_model->update_candidate($user_id, $summary_user_data);
      //logika ini hanya untuk hr_family 
     $family_types = ['grandparent', 'parent', 'wife', 'son', 'daughter'];

    foreach ($family_types as $type) {
        $number_input_name = 'family_' . $type . '_number';
        $accompany_input_name = 'family_' . $type . '_accompany';

        // Ambil data dari form
        $number = $this->input->post($number_input_name);
        $accompany = $this->input->post($accompany_input_name);

        // Lakukan proses hanya jika user mengisi angka
        if (isset($number) && $number !== '') {
            $family_data = [
                'number'    => $number,
                'cohabit'   => $accompany
                // Anda bisa tambahkan field lain jika perlu, misal 'name' => NULL
            ];

            // Panggil model untuk update atau insert
            $this->hr_model->save_or_update_family_by_relation($user_id, ucfirst($type), $family_data);
        }
    }
    // end



    // 2. Kumpulkan dan simpan data yang HANYA untuk tabel hr_academic
    $academic_id = $this->input->post('academic_id');
    
    // Lakukan update hanya jika ada academic_id
    if (!empty($academic_id)) {
        $academic_data = [
            'registered_school_name' => $this->input->post('summary_education_name'),
            'location'               => $this->input->post('summary_education_location')
        ];
        // Panggil fungsi model baru untuk update academic
        $this->hr_model->update_academic_record($academic_id, $academic_data);
    }
   // 4. TAMBAHKAN BLOK INI UNTUK UPLOAD DOKUMEN
    // =======================================================
    $document_fields = [
        'doc_resume'         => 'Resume',
        'doc_ktp'            => 'KTP',
        'doc_photo'          => 'Photo 3.5x4.5',
        'doc_skck'           => 'SKCK',
        'doc_academic'       => 'Academic Certificate',
        'doc_career'         => 'Career Certificate',
        'doc_self_intro'     => 'Self Introduction',
        'doc_medical'        => 'Medical Check Up',
        'doc_bank'           => 'Bank Account',
        'doc_family_cert'    => 'Family Relation Certificate',
        'doc_npwp'           => 'Tax ID Card (NPWP)',
        'doc_bpjs_tk'        => 'BPJS Ketenagakerjaan',
        'doc_bpjs_kes'       => 'BPJS Kesehatan',
        'doc_family_contact' => 'Family Contact'
    ];

    $config['upload_path']   = './uploads/documents/';
    $config['allowed_types'] = 'pdf|jpg|jpeg|png';
    $config['max_size']      = 2048; // 2MB
    $config['encrypt_name']  = TRUE;
    $this->load->library('upload', $config);

    foreach ($document_fields as $input_name => $document_type) {
        if (!empty($_FILES[$input_name]['name'])) {
            if ($this->upload->do_upload($input_name)) {
                $upload_data = $this->upload->data();
                $document_data = [
                    'user_id'       => $user_id,
                    'document_type' => $document_type,
                    'file_name'     => $upload_data['file_name'],
                ];
                $this->hr_model->insert_document($document_data);
            } else {
                log_message('error', 'Upload failed for '. $input_name . ': ' . $this->upload->display_errors());
            }
        }
    }
//end 
    
 
    

//starr 
   // --- LOGIKA UNTUK UPDATE DATA SERTIFIKAT ---
for ($i = 1; $i <= 4; $i++) {
    $id = $this->input->post('certificate_id_' . $i);
    $name = $this->input->post('certificate_name_' . $i);
    
    // Siapkan data untuk disimpan
    $cert_data = [
        'user_id' => $user_id,
        'certificate' => $name,
        'authority' => $this->input->post('certificate_authority_' . $i),
        'certificate_no' => $this->input->post('certificate_no_' . $i),
        'acquisition' => $this->input->post('certificate_date_' . $i)
    ];

    // Jika tidak ada nama sertifikat, lewati baris ini
    if (empty($name)) continue;

    // Jika ada ID, update. Jika tidak ada ID, insert.
    if (!empty($id)) {
        $this->hr_model->update_certificate($id, $cert_data);
    } else {
        $this->hr_model->insert_certificate($cert_data);
    }
}
// --- AKHIR BLOK UPDATE SERTIFIKAT ---


// 1. Hapus data hired lama untuk user ini agar tidak duplikat saat di-update
$this->hr_model->delete_hired_data($user_id);

// 2. Definisikan pasangan 'initial' (untuk database) dan nama 'input' dari form
$hired_fields = [
    'Type of Hired'        => 'hired_type',
    'Salary Type'          => 'salary_type',
    'Hired Contract No.'   => 'contract_no',
    'Position ID No.'      => 'position_id',
    'Company Join Date'    => 'join_date',
    'Contract Finish Date' => 'contract_finish_date',
    'Probation Period'     => 'probation_period',
    'Work Location'        => 'hired_work_location',
    'Team'                 => 'team'
];

// 3. Siapkan array untuk batch insert
$hired_batch_data = [];

// 4. Lakukan perulangan untuk setiap field
foreach ($hired_fields as $initial => $input_name) {
    $value = $this->input->post($input_name);

    // Hanya simpan jika ada nilainya
    if (isset($value) && $value !== '') {
        $hired_batch_data[] = [
            'user_id' => $user_id,
            'intial' => $initial,
            'value'   => $value
        ];
    }
}

// 5. Simpan semua data sekaligus jika ada
if (!empty($hired_batch_data)) {
    $this->hr_model->insert_hired_data_batch($hired_batch_data);
}
//endddd
// --- AKHIR LOGIKA HIRED STATUS ---


// 1. Hapus data gaji lama untuk user ini agar tidak duplikat
$this->hr_model->delete_salary_data($user_id);

// 2. Definisikan pasangan 'allowances' (untuk database) dan nama 'input' dari form
$salary_fields = [
    'Basic'           => 'salary_basic',
    'OT Allowance'   => 'salary_ot_allowance',
    'Site Allowance'  => 'salary_site_allowance',
    'Meal'            => 'salary_meal',
    'Transportation'  => 'salary_transportation',
    'Role Allowance'  => 'salary_role_allowance',
    'Accommodation'   => 'salary_accommodation',
    'Sunday/Holiday'  => 'salary_sunday_holiday',
    'Hourly Rate'     => 'salary_hourly_rate'
];

// 3. Siapkan array untuk batch insert
$salary_batch_data = [];

// 4. Lakukan perulangan untuk setiap field gaji
foreach ($salary_fields as $allowance => $input_name) {
    $value = $this->input->post($input_name);

    // Hanya simpan jika ada nilainya
    if (isset($value) && $value !== '') {
        $salary_batch_data[] = [
            'user_id'    => $user_id,
            'allowances' => $allowance,
            'salary'     => $value
        ];
    }
}

// 5. Simpan semua data gaji sekaligus jika ada
if (!empty($salary_batch_data)) {
    $this->hr_model->insert_salary_data_batch($salary_batch_data);
}
// --- AKHIR LOGIKA GAJI ---


// LOGIKA BARU UNTUK MENYIMPAN DATA REWARD STATUS
// Lakukan perulangan untuk 4 baris input sertifikat
for ($i = 1; $i <= 4; $i++) {
    $reward_id = $this->input->post('reward_id_' . $i);
    $reward_name = $this->input->post('reward_name_' . $i);

    // Proses hanya jika nama reward diisi untuk mencegah data kosong
    if (!empty($reward_name)) {
        $reward_data = [
            'user_id'       => $user_id, // Sertakan user_id untuk data baru
            'reward_name'   => $reward_name,
            'reward_date'   => $this->input->post('reward_date_' . $i),
            'reward_result' => $this->input->post('reward_result_' . $i)
        ];
        
        // Panggil model untuk update atau insert record
        $this->hr_model->save_or_update_reward($reward_id, $reward_data);
    }
}
// --- AKHIR LOGIKA REWARD STATUS ---



// LOGIKA BARU UNTUK MENYIMPAN DATA DISCIPLINARY STATUS
// Lakukan perulangan untuk 4 baris input
for ($i = 1; $i <= 4; $i++) {
    $disciplinary_id = $this->input->post('disciplinary_id_' . $i);
    $description = $this->input->post('disciplinary_description_' . $i);

    // Proses hanya jika deskripsi diisi
    if (!empty($description)) {
        $disciplinary_data = [
            'user_id'                   => $user_id,
            'description'               => $description,
            'disciplinary_date'         => $this->input->post('disciplinary_date_' . $i),
            'disciplinary_period_star'  => $this->input->post('disciplinary_date_start_' . $i), // Cocokkan dengan nama input
            'disciplinary_period_end'   => $this->input->post('disciplinary_date_end_' . $i),   // Cocokkan dengan nama input
            'disciplinary_result'       => $this->input->post('disciplinary_result_' . $i)
        ];
        
        // Panggil model untuk update atau insert
        $this->hr_model->save_or_update_disciplinary($disciplinary_id, $disciplinary_data);
    }
}
// --- AKHIR LOGIKA DISCIPLINARY STATUS ---



// Ambil data subject terlebih dahulu sebagai acuan
$subjects  = $this->input->post('chronology_subject');

// Lakukan proses hanya jika ada data subject yang dikirim
if (is_array($subjects)) {
    // Ambil data array lainnya
    $ids       = $this->input->post('chronology_id');
    $starts    = $this->input->post('employee_date_start');
    $ends      = $this->input->post('employee_date_end');
    $positions = $this->input->post('position');
    $locations = $this->input->post('chronology_work_location');

    // Lakukan perulangan sebanyak data yang ada
    for ($i = 0; $i < count($subjects); $i++) {
        // Proses hanya jika 'subject' di baris ini tidak kosong
        if (!empty($subjects[$i])) {
            $chronology_data = [
                'user_id'             => $user_id,
                'subject'             => $subjects[$i],
                'employee_date_start' => $starts[$i],
                'employee_date_end'   => $ends[$i],
                'position'            => $positions[$i],
                'work_location'       => $locations[$i]
            ];
            
            $this->hr_model->save_or_update_chronology($ids[$i], $chronology_data);
        }
    }
}
// --- AKHIR LOGIKA CHRONOLOGY STATUS ---

    $this->hr_model->update_status($user_id, 'Employee');

    // 5. Set notifikasi dan redirect
    $this->session->set_flashdata('swal_icon', 'success');
    $this->session->set_flashdata('swal_text', 'Summary has been saved successfully.');
    redirect('hr/listsummary');
}
//end untuk bagian update data karyawan di add summary

public function listsummary()
{
    $data['title'] = 'List Summaries';
    
    // Muat aset EasyUI yang sama seperti listcandidate
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view baru melalui template utama
    $this->template->load('template', 'hr/listsummary', $data);
}

//star 
public function get_summaries_json()
{
    header('Content-Type: application/json');
    $search_term = $this->input->get('search_data');
    
    $summaries = $this->hr_model->get_all_summaries($search_term);
    
    $response = [
        'total' => count($summaries),
        'rows'  => $summaries
    ];
    echo json_encode($response);
}


//
public function candidate_report()
{
    $data['title'] = 'Candidate Details Report';
    
    // Panggil fungsi baru dari model
    $data['candidates'] = $this->hr_model->get_all_candidate_details();

    // Muat view baru melalui template utama
    $this->template->load('template', 'hr/v_candidate_report', $data);
}
//


//untukk hapus
public function delete_summary()
{
    header('Content-Type: application/json');
    $id = $this->input->post('id');
    
    // Panggil fungsi model yang sudah ada
    $success = $this->hr_model->delete_candidate($id);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['errorMsg' => 'Failed to delete data.']);
    }
}
//end untuk bagian delete data karyawan di list summary
public function toggle_active_status()
{
    header('Content-Type: application/json');
    $id = $this->input->post('id');
    $new_status = $this->input->post('status');

    // Validasi status untuk keamanan
    if ($new_status == '1' || $new_status == '0') {
        $success = $this->hr_model->update_active_status($id, $new_status);
        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['errorMsg' => 'Failed to update status.']);
        }
    } else {
        echo json_encode(['errorMsg' => 'Invalid status value.']);
    }
}
//

//
public function view_family_address_detail($user_id)
{
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Family Detail - ' . $data['candidate']['nama'];
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view
    $this->template->load('template', 'hr/v_family_address_detail', $data);
}

//
public function get_family_address_json($user_id)
{
    header('Content-Type: application/json');
    $search_term = $this->input->get('search_term');

    // Gunakan fungsi model yang sudah ada untuk mengambil data keluarga
    $families = $this->hr_model->get_families_by_user_id($user_id, $search_term);
    
    // Format data agar sesuai standar EasyUI
    $response = [
        'total' => count($families),
        'rows'  => $families
    ];

    echo json_encode($response);
}
//

//
public function view_document_detail($user_id)
{
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Document List - ' . $data['candidate']['nama'];
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view
    $this->template->load('template', 'hr/v_document_detail', $data);
}
//

public function get_document_json($user_id)
{
    header('Content-Type: application/json');

    // Gunakan fungsi model yang sudah ada untuk mengambil data dokumen
    $documents = $this->hr_model->get_documents_by_user_id($user_id);
    
    // Format data agar sesuai standar EasyUI
    $response = [
        'total' => count($documents),
        'rows'  => $documents
    ];

    echo json_encode($response);
}
//

public function view_hired_detail($user_id)
{
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Hired & Salary Detail - ' . $data['candidate']['nama'];
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view
    $this->template->load('template', 'hr/v_hired_detail', $data);
}
//

//
// Fungsi JSON untuk tabel Hired Status
public function get_hired_json($user_id)
{
    header('Content-Type: application/json');
    $hired_data = $this->hr_model->get_hired_data_by_user_id($user_id);
    
    $response = [
        'total' => count($hired_data),
        'rows'  => $hired_data
    ];
    echo json_encode($response);
}
//

// Fungsi JSON untuk tabel Salary
public function get_salary_json($user_id)
{
    header('Content-Type: application/json');
    $salary_data = $this->hr_model->get_salary_data_by_user_id($user_id);
    
    $response = [
        'total' => count($salary_data),
        'rows'  => $salary_data
    ];
    echo json_encode($response);
}
//

// Fungsi untuk menampilkan halaman detail reward
public function view_reward_detail($user_id)
{
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Reward Status - ' . $data['candidate']['nama'];
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view
    $this->template->load('template', 'hr/v_reward_detail', $data);
}

// Fungsi untuk menyediakan data JSON ke tabel EasyUI
public function get_reward_json($user_id)
{
    header('Content-Type: application/json');

    $rewards = $this->hr_model->get_rewards_by_user_id($user_id);
    
    $response = [
        'total' => count($rewards),
        'rows'  => $rewards
    ];

    echo json_encode($response);
}
//

//
public function view_disciplinary_detail($user_id)
{
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Disciplinary Status - ' . $data['candidate']['nama'];
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view
    $this->template->load('template', 'hr/v_disciplinary_detail', $data);
}

// Fungsi untuk menyediakan data JSON ke tabel EasyUI
public function get_disciplinary_json($user_id)
{
    header('Content-Type: application/json');

    $disciplinary_data = $this->hr_model->get_disciplinary_by_user_id($user_id);
    
    $response = [
        'total' => count($disciplinary_data),
        'rows'  => $disciplinary_data
    ];

    echo json_encode($response);
}
//


// Fungsi untuk menampilkan halaman detail chronology
public function view_chronology_detail($user_id)
{
    // Ambil data kandidat untuk judul halaman
    $data['candidate'] = $this->hr_model->get_candidate_by_id($user_id);
    if (!$data['candidate']) {
        show_404();
    }

    $data['title'] = 'Chronology Status - ' . $data['candidate']['nama'];
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view
    $this->template->load('template', 'hr/v_chronology_detail', $data);
}
//

// Fungsi untuk menyediakan data JSON ke tabel EasyUI
public function get_chronology_json($user_id)
{
    header('Content-Type: application/json');

    $chronology_data = $this->hr_model->get_chronology_by_user_id($user_id);
    
    $response = [
        'total' => count($chronology_data),
        'rows'  => $chronology_data
    ];

    echo json_encode($response);
}
//

//coba coba absennn
//
// 1. Fungsi untuk menampilkan halaman absensi dengan data dan form import
public function absensi()
{
    $data['title'] = 'Employee Attendance Form';
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // Muat view absensi melalui template utama
    $this->template->load('template', 'hr/v_absensi', $data);
}

    // 2. Fungsi untuk memproses upload dan import Excel
 public function import_absensi()
{
    // Pastikan folder upload ada
    $upload_path = './uploads/temp_excel/';
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, TRUE);
    }

     // Konfigurasi upload file
    $config['upload_path']   = './uploads/temp_excel/';
    $config['allowed_types'] = 'xlsx|xls';
    $config['encrypt_name']  = TRUE;
    $this->load->library('upload', $config);

    // Lakukan upload
   if ($this->upload->do_upload('file_excel')) {
        $file_data = $this->upload->data();
        $file_path = FCPATH . 'uploads/temp_excel/' . $file_data['file_name'];

        try {
            // 1. Muat library 'excel' yang sudah Anda buat
            $this->load->library('excel');

            // 2. Baca file Excel, mulai dari baris ke-2
            $sheetData = $this->excel->read_excel($file_path, 2);

            $batch_data = [];
            
            // 3. Lakukan perulangan untuk setiap baris data
            foreach ($sheetData as $row) {
                // Lewati baris jika NIK (kolom pertama) kosong
                if (empty($row[0])) continue;

                // Siapkan data untuk disimpan, lewati kolom 'nama' (kolom kedua)
                $batch_data[] = [
                    'nik'        => $row[0], // Kolom A: NIK
                    'tgl_masuk'  => date('Y-m-d', strtotime($row[2])), // Kolom C: tgl_masuk
                    'keterangan' => $row[3], // Kolom D: keterangan
                    'kehadiran'  => $row[4]  // Kolom E: kehadiran
                ];
            }

            // 4. Simpan data ke database
            if (!empty($batch_data)) {
                $this->hr_model->insert_absensi_batch($batch_data);
                $this->session->set_flashdata('swal_icon', 'success');
                $this->session->set_flashdata('swal_text', 'Data absensi berhasil diimpor.');
            } else {
                $this->session->set_flashdata('swal_icon', 'warning');
                $this->session->set_flashdata('swal_text', 'Tidak ada data valid untuk diimpor.');
            }
            
        } catch (Exception $e) {
            $this->session->set_flashdata('swal_icon', 'error');
            $this->session->set_flashdata('swal_text', 'Gagal memproses file: ' . $e->getMessage());
        }

        // Hapus file sementara
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        redirect('hr/absensi');

    } else {
        $this->session->set_flashdata('swal_icon', 'error');
        $this->session->set_flashdata('swal_text', 'Upload file gagal: ' . $this->upload->display_errors('', ''));
        redirect('hr/absensi');
    }
}
//

//
     public function export_absensi($format = 'excel')
    {
        // Ambil data (tanpa pagination) berdasarkan filter pencarian
        $search_term = $this->input->get('search_data');
        $data_absensi = $this->hr_model->get_all_absensi($search_term); // Panggil fungsi get all tanpa limit

        if ($format == 'excel') {
            $this->export_to_excel($data_absensi);
        } elseif ($format == 'pdf') {
            $this->export_to_pdf($data_absensi);
        } else {
            show_404();
        }
    }

   private function export_to_excel($data_absensi)
{
 
    // BAGIAN 1: Mengolah Data Absensi (Sama seperti di PDF)
    $groupedData = [];
    if (!empty($data_absensi)) {
        foreach ($data_absensi as $row) {
            $location = $row['work_location'] ?: 'Uncategorized';
            $position = $row['position'] ?: 'Unassigned';
            if (!isset($groupedData[$location])) { $groupedData[$location] = []; }
            if (!isset($groupedData[$location][$position])) { $groupedData[$location][$position] = ['masuk' => 0, 'tidak_masuk' => 0]; }
            if (strtolower($row['kehadiran']) == 'hadir') {
                $groupedData[$location][$position]['masuk']++;
            } else {
                $groupedData[$location][$position]['tidak_masuk']++;
            }
        }
    }

    // BAGIAN 2: Membuat File Excel dengan PhpSpreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Rekap & Detail Absensi');
    
    // --- Style untuk header dan total ---
    $headerStyle = ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F2F2F2']]];
    $totalStyle = ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9F9F9']]];

    $currentRow = 1;

    // --- Judul Utama ---
    $sheet->setCellValue('A'.$currentRow, 'Laporan Data Absensi');
    $sheet->mergeCells('A'.$currentRow.':E'.$currentRow);
    $sheet->getStyle('A'.$currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A'.$currentRow)->getFont()->setBold(true)->setSize(14);
    $currentRow += 2;

    // --- Cetak Rekapitulasi per Lokasi ---
    if (!empty($groupedData)) {
        foreach ($groupedData as $location => $positions) {
            $sheet->setCellValue('A'.$currentRow, 'Rekapitulasi Lokasi Kerja: ' . htmlspecialchars($location));
            $sheet->getStyle('A'.$currentRow)->getFont()->setBold(true);
            $currentRow++;

            // Header untuk tabel rekapitulasi
            $recapHeaders = ['No.', 'Posisi', 'Jumlah Hadir', 'Jumlah Tidak Hadir', 'Total Karyawan'];
            $sheet->fromArray($recapHeaders, NULL, 'A'.$currentRow);
            $sheet->getStyle('A'.$currentRow.':E'.$currentRow)->applyFromArray($headerStyle);
            $currentRow++;

            $nomor = 1;
            $totalHadirPerLokasi = 0;
            $totalTidakHadirPerLokasi = 0;
            ksort($positions);

            foreach ($positions as $position => $summary) {
                $totalKaryawanPerPosisi = $summary['masuk'] + $summary['tidak_masuk'];
                $totalHadirPerLokasi += $summary['masuk'];
                $totalTidakHadirPerLokasi += $summary['tidak_masuk'];

                $sheet->setCellValue('A'.$currentRow, $nomor++);
                $sheet->setCellValue('B'.$currentRow, $position);
                $sheet->setCellValue('C'.$currentRow, $summary['masuk']);
                $sheet->setCellValue('D'.$currentRow, $summary['tidak_masuk']);
                $sheet->setCellValue('E'.$currentRow, $totalKaryawanPerPosisi);
                $currentRow++;
            }

            // Baris Total per Lokasi
            $sheet->mergeCells('A'.$currentRow.':B'.$currentRow);
            $sheet->setCellValue('A'.$currentRow, 'Total ' . htmlspecialchars($location));
            $sheet->getStyle('A'.$currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('C'.$currentRow, $totalHadirPerLokasi);
            $sheet->setCellValue('D'.$currentRow, $totalTidakHadirPerLokasi);
            $sheet->setCellValue('E'.$currentRow, $totalHadirPerLokasi + $totalTidakHadirPerLokasi);
            $sheet->getStyle('A'.$currentRow.':E'.$currentRow)->applyFromArray($totalStyle);
            $currentRow += 2; // Beri spasi sebelum tabel berikutnya
        }
    }

    // --- Cetak Tabel Detail Data ---
    $currentRow++; // Beri spasi tambahan
    $sheet->setCellValue('A'.$currentRow, 'Detail Data Absensi');
    $sheet->getStyle('A'.$currentRow)->getFont()->setBold(true);
    $currentRow++;

    $detailHeaders = ['No.', 'NIK', 'Nama', 'Tanggal', 'Posisi', 'Team', 'Lokasi Kerja', 'Keterangan', 'Kehadiran'];
    $sheet->fromArray($detailHeaders, NULL, 'A'.$currentRow);
    $sheet->getStyle('A'.$currentRow.':I'.$currentRow)->applyFromArray($headerStyle);
    $currentRow++;

    if (!empty($data_absensi)) {
        $nomor_detail = 1;
        foreach ($data_absensi as $row) {
            $sheet->setCellValue('A'.$currentRow, $nomor_detail++);
            $sheet->setCellValue('B'.$currentRow, $row['nik']);
            $sheet->setCellValue('C'.$currentRow, $row['nama']);
            $sheet->setCellValue('D'.$currentRow, $row['tgl_masuk']);
            $sheet->setCellValue('E'.$currentRow, $row['position']);
            $sheet->setCellValue('F'.$currentRow, $row['team']);
            $sheet->setCellValue('G'.$currentRow, $row['work_location']);
            $sheet->setCellValue('H'.$currentRow, $row['keterangan']);
            $sheet->setCellValue('I'.$currentRow, $row['kehadiran']);
            $currentRow++;
        }
    }

    // --- Auto-size Columns ---
    foreach (range('A', 'I') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // --- Proses Download ---
    $writer = new Xlsx($spreadsheet);
    $filename = 'laporan_absensi_' . date('YmdHis') . '.xlsx';
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit();
}
    private function export_to_pdf($data)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);

        // Buat HTML untuk PDF
        $data_view['title'] = "Laporan Data Absensi";
        $data_view['absensi'] = $data;
        $html = $this->load->view('hr/v_laporan_absensi_pdf', $data_view, true);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Atur kertas & orientasi
        $dompdf->render();
        
        $filename = 'data_absensi_' . date('YmdHis') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => 1]); // 1 untuk download, 0 untuk preview
    }

    // 3. Fungsi untuk download template
    public function download_template_absensi()
    {
        $this->load->helper('download');
        // Pastikan Anda membuat file ini
        force_download('./assets/templates/template_absensi.xlsx', NULL);
    }

    public function get_absensi_json()
{
    header('Content-Type: application/json');
    $search_term = $this->input->get('search_data');
    
    $absensi_data = $this->hr_model->get_all_absensi($search_term);
    
    $response = [
        'total' => count($absensi_data),
        'rows'  => $absensi_data
    ];
    echo json_encode($response);
}

/**
 * 1. Fungsi untuk upload dan preview data dari Excel
 * - Menerima file, membacanya, dan mengembalikan data sebagai JSON.
 * - Tidak menyimpan ke database.
 */
public function preview_absensi()
{
    header('Content-Type: application/json');

    // ... (Bagian konfigurasi dan proses upload file tetap sama) ...
    $upload_path = './uploads/temp_excel/';
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, TRUE);
    }
    $config['upload_path']   = $upload_path;
    $config['allowed_types'] = 'xlsx|xls';
    $config['encrypt_name']  = TRUE;
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file_excel')) {
        echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
        return;
    }

    $file_data = $this->upload->data();
    $file_path = $upload_path . $file_data['file_name'];

    try {
        $this->load->library('excel');

        // LANGKAH VALIDASI HEADER TEMPLATE

        // 1. Definisikan header yang seharusnya ada di template (gunakan huruf kecil)
        $expected_headers = ['nik', 'nama', 'tgl_masuk', 'keterangan', 'kehadiran'];
        
        // 2. Baca seluruh sheet dari baris pertama untuk mendapatkan header
        $sheetDataWithHeader = $this->excel->read_excel($file_path, 1); // Baca dari baris 1

        if (empty($sheetDataWithHeader)) {
            unlink($file_path); // Hapus file
            echo json_encode(['status' => 'error', 'message' => 'File Excel kosong atau tidak bisa dibaca.']);
            return;
        }

        // 3. Ambil baris pertama sebagai header aktual
        $actual_headers_raw = array_shift($sheetDataWithHeader);
        
        // 4. Bersihkan dan normalkan header aktual (hapus spasi, ubah ke huruf kecil)
        $actual_headers = [];
        foreach ($actual_headers_raw as $header) {
            // Ganti spasi dengan underscore dan ubah ke huruf kecil
            $actual_headers[] = strtolower(str_replace(' ', '_', trim($header)));
        }
        
        // 5. Bandingkan header
        //pesan eror excelnya tidak sesuai
        if ($expected_headers !== $actual_headers) {
            unlink($file_path); // Hapus file yang tidak valid
            $pesan = "Format file Excel tidak sesuai. Pastikan Anda menggunakan template yang disediakan dan urutan kolom sudah benar.";
            $pesan .= "Header yang diharapkan: " . implode(', ', $expected_headers) . "";
            $pesan .= "Header di file Anda: " . implode(', ', $actual_headers);
            
            echo json_encode(['status' => 'error', 'message' => $pesan]);
            return;
        }
        
        // Jika validasi berhasil, $sheetDataWithHeader sekarang hanya berisi data (tanpa header)
        $sheetData = $sheetDataWithHeader;
        
        // ========================================================
        // AKHIR DARI VALIDASI HEADER
        // ========================================================

        // Proses selanjutnya berjalan seperti biasa menggunakan $sheetData
        $preview_data = [];
        $niks = array_column($sheetData, 0);

        $karyawan_data = [];
        if (!empty($niks)) {
            $karyawan_db = $this->db->select('nik, nama')->where_in('nik', $niks)->get('tbl_user')->result_array();
            $karyawan_data = array_column($karyawan_db, 'nama', 'nik');
        }
        
        foreach ($sheetData as $row) {
            if (empty($row[0])) continue;
            $nik = $row[0];
            $preview_data[] = [
                'nik'        => $nik,
                'nama'       => isset($karyawan_data[$nik]) ? $karyawan_data[$nik] : '<span class="text-danger">NIK Not Found</span>',
                'tgl_masuk'  => date('Y-m-d', strtotime($row[2])),
                'keterangan' => $row[3],
                'kehadiran'  => $row[4]
            ];
        }

        if (empty($preview_data)) {
            unlink($file_path);
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data valid untuk diimpor di dalam file.']);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data'   => $preview_data
            // Kita tidak perlu lagi mengirim nama file karena data sudah diproses
        ]);

    } catch (Exception $e) {
        unlink($file_path);
        echo json_encode(['status' => 'error', 'message' => 'Gagal memproses file: ' . $e->getMessage()]);
    }
}

/**
 * 2. Fungsi untuk konfirmasi dan menyimpan data
 * - Menerima nama file sementara, membacanya lagi, lalu simpan ke DB.
 */



public function confirm_import_edited()
{
    header('Content-Type: application/json');

    // Ambil data JSON yang dikirim dari AJAX
    $importedDataJson = $this->input->post('imported_data');
    if (!$importedDataJson) {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang diterima.']);
        return;
    }

    // Ubah string JSON menjadi array PHP
    $dataToImport = json_decode($importedDataJson, true);

    // Pastikan data tidak kosong dan valid
    if (empty($dataToImport) || !is_array($dataToImport)) {
        echo json_encode(['status' => 'error', 'message' => 'Format data tidak valid.']);
        return;
    }

    try {
        // Langsung simpan data array ini ke database
        $this->hr_model->insert_absensi_batch($dataToImport);
        
        // Hapus file temporary Excel jika masih ada (opsional tapi bagus untuk bersih-bersih)
        // Note: Anda perlu cara untuk mendapatkan nama file ini jika ingin menghapusnya,
        // misal dengan mengirimkannya juga saat konfirmasi. Untuk saat ini, kita abaikan dulu.

        echo json_encode(['status' => 'success', 'message' => 'The attendance data has been successfully imported.']);

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save data: ' . $e->getMessage()]);
    }
}
//

//untuk edit absensi
public function update_absensi($id)
{
    header('Content-Type: application/json');
    $data = [
        'tgl_masuk'  => $this->input->post('tgl_masuk'),
        'keterangan' => $this->input->post('keterangan'),
        'kehadiran'  => $this->input->post('kehadiran')
    ];

    $result = $this->hr_model->update_absensi_record($id, $data);

    if ($result) {
        echo json_encode(['message' => 'The attendance data has been successfully updated.']);
    } else {
        echo json_encode(['errorMsg' => 'Failed to update attendance data.']);
    }
}
//end untu edit absensi

//
public function delete_absensi()
{
    header('Content-Type: application/json');
    $id = $this->input->post('id');

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid.']);
        return;
    }

    // Panggil fungsi model untuk melakukan soft delete
    $result = $this->hr_model->soft_delete_absensi($id);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Data absensi berhasil dihapus.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data atau tidak ada data yang berubah.']);
    }
}
//end delete absensi

// 1. Method untuk menampilkan halaman timesheet
public function timesheet()
{
    $data['title'] = 'Employee Timesheet';
    
    // Muat aset EasyUI
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
    $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
    $data['js_files'][]  = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';

    // TAMBAHKAN INI: Muat aset jsTree agar tidak error
    // (Sesuaikan path jika berbeda)
    $data['css_files'][] = base_url() . 'assets/admin/plugins/jstree/dist/themes/default/style.min.css';
    $data['js_files'][]  = base_url() . 'assets/admin/plugins/jstree/dist/jstree.min.js';

    // Muat view timesheet melalui template utama
    $this->template->load('template', 'hr/v_timesheet', $data);
}

// 2. Method untuk menyediakan data JSON ke datagrid
public function get_timesheet_json()
{
    header('Content-Type: application/json');
    $tanggal = $this->input->get('tanggal');
    if (!$tanggal) {
        echo json_encode(['total' => 0, 'rows' => []]);
        return;
    }

    $data = $this->hr_model->get_timesheet_data($tanggal);
    echo json_encode([
        'total' => count($data),
        'rows' => $data
    ]);
}
//end

// 3. Method untuk menyimpan perubahan dari datagrid
public function save_timesheet()
{
    header('Content-Type: application/json');
    $changedRows = json_decode($this->input->post('changed_rows'), true);
    
    if (empty($changedRows)) {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada data untuk disimpan.']);
        return;
    }

    $successCount = 0;
    foreach ($changedRows as $row) {
        if ($this->hr_model->save_timesheet_entry($row)) {
            $successCount++;
        }
    }

    if ($successCount == count($changedRows)) {
        echo json_encode(['status' => 'success', 'message' => 'Semua perubahan berhasil disimpan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Beberapa data gagal disimpan.']);
    }
}
//

//
public function save_single_timesheet()
{
    header('Content-Type: application/json');
    // Ambil semua data yang dikirim dari form
    $row = $this->input->post();
    
    // Panggil fungsi model yang sudah ada (save_timesheet_entry)
    // karena fungsi itu sudah bisa menangani UPDATE dan INSERT.
    $result = $this->hr_model->save_timesheet_entry($row);

    if ($result) {
        echo json_encode(['message' => 'Timesheet berhasil disimpan.']);
    } else {
        echo json_encode(['errorMsg' => 'Gagal menyimpan data timesheet.']);
    }
}
//

//start
public function delete_timesheet()
{
    header('Content-Type: application/json');
    $id = $this->input->post('id');

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID timesheet tidak valid.']);
        return;
    }

    $result = $this->hr_model->soft_delete_timesheet($id);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Data timesheet berhasil dihapus.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data.']);
    }
}
//

//
public function export_timesheet($format = 'excel')
{
    // Ambil data berdasarkan filter tanggal (tanpa pagination)
    $tanggal = $this->input->get('tanggal');
    if (!$tanggal) {
        echo "Tanggal tidak valid.";
        return;
    }
    
    $data_timesheet = $this->hr_model->get_timesheet_data($tanggal);

    if ($format == 'excel') {
        $this->export_timesheet_to_excel($data_timesheet);
    } elseif ($format == 'pdf') {
        $this->export_timesheet_to_pdf($data_timesheet);
    } else {
        show_404();
    }
}
//

//
private function export_timesheet_to_excel($data)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Data Timesheet');

    // Header
    $headers = ['No.', 'NIK', 'Nama', 'Tanggal', 'Masuk', 'Istirahat Keluar', 'Istirahat Masuk', 'Pulang', 'Keluar Lembur', 'Masuk Lembur', 'Pulang Lembur'];
    $sheet->fromArray($headers, NULL, 'A1');
    $sheet->getStyle('A1:K1')->getFont()->setBold(true);

    // Body
    $rowData = [];
    $nomor = 1;
    foreach ($data as $row) {
        $rowData[] = [
            $nomor++,
            $row['nik'],
            $row['nama'],
            $row['tgl_masuk'],
            $row['time_in'],
            $row['break_out'],
            $row['break_in'],
            $row['time_out'],
            $row['break_overtime_out'],
            $row['break_overtime_in'],
            $row['overtime_out']
        ];
    }
    $sheet->fromArray($rowData, NULL, 'A2');

    // Auto-size columns
    foreach (range('A', 'K') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'data_timesheet_' . date('YmdHis') . '.xlsx';
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit();
}
//

//
private function export_timesheet_to_pdf($data)
{
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $data_view['title'] = "Laporan Data Timesheet";
    $data_view['tanggal_laporan'] = !empty($data) ? date('d F Y', strtotime($data[0]['tgl_masuk'])) : date('d F Y');
    $data_view['timesheet'] = $data;
    $html = $this->load->view('hr/v_laporan_timesheet_pdf', $data_view, true);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    
    $filename = 'data_timesheet_' . date('YmdHis') . '.pdf';
    $dompdf->stream($filename, ['Attachment' => 1]);
}
//

//
public function export_pdf()
    {
        // Ambil ID yang dikirim sebagai string, lalu ubah menjadi array
        $ids_string = $this->input->post('ids');
        $ids = explode(',', $ids_string);

        if (empty($ids)) {
            redirect('hr/listcandidate');
            return;
        }

     $all_candidates_data = [];
    foreach ($ids as $id) {
        $profile = $this->hr_model->get_full_candidate_profile($id);

        // --- LOGIKA BARU UNTUK GAMBAR ---
        $image_path = FCPATH . 'uploads/hr_file/' . $profile['main']['path_foto'];
        if (file_exists($image_path) && !empty($profile['main']['path_foto'])) {
            $image_type = pathinfo($image_path, PATHINFO_EXTENSION);
            $image_data = file_get_contents($image_path);
            // Ubah gambar menjadi teks Base64
            $profile['main']['photo_base64'] = 'data:image/' . $image_type . ';base64,' . base64_encode($image_data);
        } else {
            $profile['main']['photo_base64'] = null;
        }
        // --- AKHIR LOGIKA GAMBAR ---

        $all_candidates_data[] = $profile;
    }

        $data['candidates'] = $all_candidates_data;

        // Proses pembuatan PDF
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        
        $html = $this->load->view('hr/v_candidate_pdf', $data, TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Output PDF ke browser untuk di-download
        $dompdf->stream('candidate_data.pdf', ['Attachment' => 1]);
    }
    //

    public function preview_import_timesheet()
{
    header('Content-Type: application/json');
    $upload_path = './uploads/temp_excel/';
    if (!is_dir($upload_path)) { mkdir($upload_path, 0777, TRUE); }

    $config['upload_path']   = $upload_path;
    $config['allowed_types'] = 'xlsx|xls';
    $config['encrypt_name']  = TRUE;
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file_excel_timesheet')) {
        echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
        return;
    }

    $file_data = $this->upload->data();
    $file_path = $upload_path . $file_data['file_name'];

    try {
        $this->load->library('excel');

        // 1. Definisikan header yang diharapkan (HARUS SAMA DENGAN DI EXCEL)
        $expected_headers = ['nik', 'nama', 'tgl_masuk', 'time_in', 'break_out', 'break_in', 'time_out', 'break_overtime_out', 'break_overtime_in', 'overtime_out'];
        
        $sheetDataWithHeader = $this->excel->read_excel($file_path, 1);
        if (empty($sheetDataWithHeader)) {
            unlink($file_path);
            echo json_encode(['status' => 'error', 'message' => 'File Excel kosong.']);
            return;
        }
        
        // 2. Validasi header
        $actual_headers_raw = array_shift($sheetDataWithHeader);
        $actual_headers = array_map(function($h) { return strtolower(trim($h)); }, $actual_headers_raw);

        if ($expected_headers !== $actual_headers) {
            unlink($file_path);
            $pesan = "Format file Excel tidak sesuai.<br><br>";
            $pesan .= "<b>Header Seharusnya:</b><br><span style='font-family:monospace;'>" . implode(', ', $expected_headers) . "</span><br><br>";
            $pesan .= "<b>Header di File Anda:</b><br><span style='font-family:monospace;'>" . implode(', ', $actual_headers) . "</span>";
            echo json_encode(['status' => 'error', 'message' => $pesan]);
            return;
        }
        
        // 3. Proses data jika header valid
        $sheetData = $sheetDataWithHeader;
        $preview_data = [];
        $niks = array_column($sheetData, 0);
        $karyawan_data = [];
        if(!empty($niks)){
            $karyawan_db = $this->db->select('nik, nama')->where_in('nik', $niks)->get('tbl_user')->result_array();
            $karyawan_data = array_column($karyawan_db, 'nama', 'nik');
        }
        
      foreach ($sheetData as $row) {
    if (empty($row[0]) || empty($row[2])) continue;
    $nik = $row[0];
    
    // KODE KEMBALI SEDERHANA, KARENA LIBRARY SUDAH MENANGANI KONVERSI
    $preview_data[] = [
        'nik'                 => $nik,
        'nama'                => isset($karyawan_data[$nik]) ? $karyawan_data[$nik] : 'Nama Tidak Ditemukan',
        'tgl_masuk'           => $row[2], // Langsung ambil
        'time_in'             => $row[3] ?? '',
        'break_out'           => $row[4] ?? '',
        'break_in'            => $row[5] ?? '',
        'time_out'            => $row[6] ?? '',
        'break_overtime_out'  => $row[7] ?? '',
        'break_overtime_in'   => $row[8] ?? '',
        'overtime_out'        => $row[9] ?? '',
    ];
}

        unlink($file_path);
        echo json_encode(['status' => 'success', 'data' => $preview_data]);

    } catch (Exception $e) {
        if(file_exists($file_path)) unlink($file_path);
        echo json_encode(['status' => 'error', 'message' => 'Gagal memproses file: ' . $e->getMessage()]);
    }
}

public function confirm_import_timesheet()
{
    header('Content-Type: application/json');
    
    $importedData = json_decode($this->input->post('imported_data'), true);
    $filterTanggal = $this->input->post('filter_tanggal');

    if (empty($importedData) || !$filterTanggal) {
        echo json_encode(['status' => 'error', 'message' => 'Data impor atau tanggal filter tidak ditemukan.']);
        return;
    }

    $successCount = 0;
    $skippedCount = 0;
    
    // Konversi tanggal filter ke format Y-m-d untuk perbandingan yang konsisten
    $filterDateFormatted = date('Y-m-d', strtotime($filterTanggal));

    foreach ($importedData as $row) {
        // Konversi juga tanggal dari setiap baris ke format Y-m-d
        $rowDateFormatted = date('Y-m-d', strtotime($row['tgl_masuk']));

        // PERBAIKAN UTAMA: Bandingkan tanggal yang sudah diformat ulang
        if (isset($row['tgl_masuk']) && $rowDateFormatted == $filterDateFormatted) {
            if ($this->hr_model->save_timesheet_entry($row)) {
                $successCount++;
            }
        } else {
            $skippedCount++;
        }
    }
    
    $message = $successCount . ' data timesheet berhasil diimpor/diperbarui.';
    if ($skippedCount > 0) {
        $message .= ' ' . $skippedCount . ' baris diabaikan karena tanggal tidak cocok.';
    }

    if ($successCount > 0) {
         echo json_encode(['status' => 'success', 'message' => $message]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang cocok dengan tanggal filter untuk diimpor.']);
    }
}
//

//
public function export_summary_pdf()
{
    $ids_string = $this->input->post('ids');
    $ids = explode(',', $ids_string);

    if (empty($ids) || empty($ids[0])) {
        redirect('hr/listsummary');
        return;
    }

    $all_summaries_data = [];
    foreach ($ids as $id) {
        if (!empty($id)) {
            $all_summaries_data[] = $this->hr_model->get_full_summary_profile($id);
        }
    }

    $data['summaries'] = $all_summaries_data;

    // Proses pembuatan PDF menggunakan Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $dompdf = new Dompdf($options);
    
    $html = $this->load->view('hr/v_summary_pdf', $data, TRUE);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Output PDF ke browser untuk di-download
    $dompdf->stream('summary_data.pdf', ['Attachment' => 1]);
}
//

//
public function update_candidate_status()
{
    header('Content-Type: application/json');
    $id = $this->input->post('id');
    $current_status = $this->input->post('current_status');

    $new_status = '';
    // Tentukan alur kerja status
    if ($current_status === 'Candidate') {
        $new_status = 'Pre-selected';
    } elseif ($current_status === 'Pre-selected') {
        $new_status = 'Interview';
    }

    if (!empty($new_status)) {
        $success = $this->hr_model->update_status($id, $new_status);
        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['errorMsg' => 'Gagal mengupdate status.']);
        }
    } else {
        echo json_encode(['errorMsg' => 'Status tidak bisa dinaikkan lagi.']);
    }
}
//


}

   