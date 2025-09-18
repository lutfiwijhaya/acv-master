<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class hr_model extends CI_Model
{
        public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk menyimpan data pengguna ke dalam database
    public function save_application($data) {
        return $this->db->insert('tbl_user', $data);  // Menyimpan data ke tabel tbl_user
    }
    
    // Fungsi untuk upload foto kandidat
    public function upload_photo($photo)
    {
        $config['upload_path'] = './uploads/photos/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB max size
        $config['encrypt_name'] = TRUE; // Enkripsi nama file agar unik

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($photo)) {
            return $this->upload->data('file_name');  // Mengembalikan nama file foto yang diupload
        } else {
            return NULL;  // Jika upload gagal
        }
    }
    
    // bagia ke 2 
   public function save_academic_data($user_id, $academic_data)
{
    $this->db->trans_begin();

    try {
        // Ambil data array dari parameter
        $graduations  = $academic_data['graduation'];
        $school_names = $academic_data['registered_school_name']; // <- Sesuaikan dengan key baru
        $locations    = $academic_data['location'];
        $specialties  = $academic_data['jurusan'];

        if (is_array($school_names)) {
            for ($i = 0; $i < count($school_names); $i++) {
                // Lewati baris yang kosong
                if (empty($school_names[$i])) {
                    continue;
                }

                $data = [
                    'user_id'                => $user_id,
                    'graduation'             => $graduations[$i],
                    'registered_school_name' => $school_names[$i], // Nama kolom di DB
                    'location'               => $locations[$i],
                    'jurusan'                => $specialties[$i]
                ];

                $this->db->insert('hr_academic', $data);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    } catch (Exception $e) {
        $this->db->trans_rollback();
        log_message('error', 'Error saving academic data: ' . $e->getMessage());
        return FALSE;
    }
}
    
   
    public function insert_academic_data($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('graduation', 'ASC');
        $query = $this->db->get('hr_academic');
        return $query->result_array();
    }
    
    // bagian ke 3 hr hr_family
    //   public function insert_family_data($family_data) {
    //     // Menyimpan data ke dalam tabel hr_family
    //     return $this->db->insert_batch('hr_family', $family_data);
    // }
    
    // bagian ke 4
    // Fungsi untuk menyimpan data sertifikat ke dalam tabel certificates
    public function insert_certificates($certificate_data) {
        return $this->db->insert_batch('hr_certificates', $certificate_data); // Menyimpan banyak sertifikat sekaligus
    }
    
    // bagian ke 5
    // menyimpan data pengalaman kerja ke dalam tabel hr_career
    public function insert_career_data($career_data)
    {
    return $this->db->insert_batch('hr_career', $career_data);
    }
    
    //bagian ke 6
    // untuk menyimpan data kemampuan ke dalam tabel hr_motivasion
     public function insert_motivation_data($motivation_data)
    {
        return $this->db->insert('hr_motivation', $motivation_data);
    }

    // bagian ke 7
    // untuk mengambil data kemampuan yang diimpor
   public function insert_document($data)
{
    return $this->db->insert('hr_document', $data);
}
    //end unutk bagian formcandidat


    // star untuk bagian list candidate
public function get_all_candidates($search_term = null)
    {
        //untuk aktif dan nonaktif
        $this->db->select([
            'tbl_user.*, tbl_user.candidate_status',
        'tbl_user.is_aktif', // Pilih 'is_aktif' secara eksplisit
        '(SELECT SUM(TIMESTAMPDIFF(MONTH, period_star, period_end) + 1) 
          FROM hr_career 
          WHERE hr_career.user_id = tbl_user._id) as total_career_months'
            ]);
        
        $this->db->from('tbl_user');
        //untuk filtering data yang tampil 
         $this->db->where('posisi', 16); 
        //untuk menampilkan data yang belum dihapus (deleted = 0)
         $this->db->where('deleted', 0);
        // Mengurutkan berdasarkan ID terbaru (paling baru di atas)
        $this->db->order_by('_id', 'DESC'); 

       //buat pencarian apa saja
    if (!empty($search_term)) {
        $this->db->group_start();
        $this->db->like('nama', $search_term);
        $this->db->or_like('applying_occupation', $search_term);
        $this->db->or_like('email', $search_term);
        $this->db->or_like('nik', $search_term);
        $this->db->or_like('no_hp', $search_term);
        $this->db->group_end();
    }
    // --- AKHIR BLOK PENCARIAN ---
       return $this->db->get()->result_array();
    }

//  mengambil data tbl_user berdasarkan id
      public function get_candidate_by_id($id)
    {
        
        return $this->db->get_where('tbl_user', ['_id' => $id, 'deleted' => 0])->row_array();
    }
// end mengambil data tbl_user berdasarkan id


// star untuk mengambil data hr_academic berdasarkan id
    public function get_academics_by_user_id($user_id, $search_term = null)
    {
    // Memulai query builder
    $this->db->from('hr_academic');
    $this->db->where('user_id', $user_id);

    //   untuk pencarian
    if (!empty($search_term)) {

        $this->db->group_start(); 
        $this->db->like('registered_school_name', $search_term);
        $this->db->or_like('jurusan', $search_term);
        $this->db->or_like('location', $search_term);
        // group_end() membuat kurung tutup ')'
        $this->db->group_end();
    }


    // Eksekusi query dan kembalikan hasilnya
    return $this->db->get()->result_array();
    }
// end ngambil data hr_academic berdasarkan id


// star untuk mengambil data dari tebel hr_family    
    public function get_families_by_user_id($user_id, $search_term = null) 
    {

        $this->db->cache_off(); 

        $this->db->from('hr_family');
        $this->db->where('user_id', $user_id);

        // pencarian
        if (!empty($search_term)) {
            $this->db->group_start();
            $this->db->like('name', $search_term);
            $this->db->or_like('relation', $search_term);
            $this->db->or_like('birthday', $search_term);
            $this->db->or_like('cohabit', $search_term);
            $this->db->or_like('mobile_no', $search_term);
            $this->db->group_end();
        }
    // Diubah dari 'family_data' menjadi 'hr_family'
    // Eksekusi query dan kembalikan hasilnya
    return $this->db->get()->result_array();
    }
// end ngambil data dari tebel hr_family    


// star ngambil data untuk certification
    public function get_certificates_by_user_id($user_id, $search_term = null) {
    
    $this->db->from('hr_certificates');
    $this->db->where('user_id', $user_id);


    if (!empty($search_term)) {

        $this->db->group_start(); 
        $this->db->like('certificate', $search_term); 
        $this->db->or_like('authority', $search_term);        
        $this->db->group_end(); 
    }

    // Eksekusi query dan kembalikan hasilnya
    return $this->db->get()->result_array();
    }
// end ngambil data untuk certification


// star ngambil data untuk careerv 
    public function get_careers_by_user_id($user_id, $search_term = null)
    {
    $this->db->from('hr_career');
    $this->db->where('user_id', $user_id);

    if (!empty($search_term)) {
        $this->db->group_start();
        $this->db->like('company_name', $search_term);
        $this->db->or_like('position', $search_term);
        $this->db->group_end();
    }

    return $this->db->get()->result_array();
    }
// end ngambil data untuk career

//star ngambil data untuk document
    public function get_documents_by_user_id($user_id) {
        // Diubah dari 'user_documents' menjadi 'hr_document'
        return $this->db->get_where('hr_document', ['user_id' => $user_id])->result_array();
    }
// end ngambil data untuk document

// star untuk bagian motivasi
    public function get_motivation_by_user_id($user_id) {
        // Diubah dari 'motivations' menjadi 'hr_motivation'
        return $this->db->get_where('hr_motivation', ['user_id' => $user_id])->row_array();
    }
// end untuk bagian motivasi

// Fungsi untuk meng-update ngedit kandidat di tabel tbl_user
    public function update_candidate($id, $data)
    {
        $this->db->where('_id', $id); 
        $this->db->update('tbl_user', $data);
        return $this->db->affected_rows() > 0;
    }
//end fungsi untuk meng-update ngedit kandidat di tabel tbl_user

// Fungsi untuk menghapus data kandidat dari tabel tbl_user
    public function delete_candidate($id)
    {
    // untuk bagian Data yang akan di-update: set kolom 'deleted' menjadi 1
    $data_update = ['deleted' => 1];

    $this->db->where('_id', $id);
    $this->db->update('tbl_user', $data_update); // Perintah ini MENG-UPDATE baris data
    
    return $this->db->affected_rows() > 0;
    }
//end fungsi untuk menghapus data kandidat dari tabel tbl_user

// Fungsi untuk menyimpan kandidat baru (lebih konsisten dari save_application)
    public function insert_candidate($data)
    {
        $this->db->insert('tbl_user', $data);
        return $this->db->affected_rows() > 0;
    }
// end fungsi untuk menyimpan kandidat baru

// (Opsional) Fungsi update path foto, ini lebih baik daripada di controller
    public function update_photo_path($id, $filename)
    {
        $this->db->where('_id', $id);
        $this->db->update('tbl_user', ['path_foto' => $filename]);
        return $this->db->affected_rows() > 0;
    }
    //end of class

    public function get_last_education($user_id)
{
    // Mengambil data dari tabel riwayat akademik
    $this->db->from('hr_academic'); 

    // Mencari berdasarkan ID user yang sesuai
    $this->db->where('user_id', $user_id);

    // Mengurutkan berdasarkan tanggal lulus, yang paling baru (DESCending) akan di atas
    $this->db->order_by('graduation', 'DESC'); 
    
    // Membatasi hasil agar hanya mengambil 1 baris teratas
    $this->db->limit(1); 
    
    // Eksekusi query dan kembalikan satu baris data sebagai array
    return $this->db->get()->row_array();
}

//
public function update_candidate_summary($id, $data)
{
    $this->db->where('_id', $id);
    return $this->db->update('tbl_user', $data);
}

public function update_academic_record($id, $data)
{
    // Cari baris berdasarkan ID unik dari record akademik
    $this->db->where('id', $id); 
    
    // Lakukan update pada tabel 'hr_academic'
    return $this->db->update('hr_academic', $data);
}

public function save_or_update_family_by_relation($user_id, $relation, $data)
{
    // Cek dulu apakah data untuk user_id dan relasi ini sudah ada
    $this->db->where('user_id', $user_id);
    $this->db->where('relation', $relation);
    $query = $this->db->get('hr_family');

    if ($query->num_rows() > 0) {
        // Jika data sudah ada, lakukan UPDATE
        $this->db->where('user_id', $user_id);
        $this->db->where('relation', $relation);
        return $this->db->update('hr_family', $data);
    } else {
        // Jika data belum ada, lakukan INSERT
        // Tambahkan user_id dan relation ke data yang akan di-insert
        $data['user_id'] = $user_id;
        $data['relation'] = $relation;
        return $this->db->insert('hr_family', $data);
    }
}
//end 

//star
// public function update_certificate_record($id, $data)
// {
//     $this->db->where('id', $id);
//     return $this->db->update('hr_certificates', $data);
// }
//endd

// Fungsi untuk menghapus data hired lama berdasarkan user_id
public function delete_hired_data($user_id)
{
    return $this->db->delete('hr_hired', ['user_id' => $user_id]);
}
//end


// Fungsi untuk menyimpan data hired baru secara batch (banyak baris sekaligus)
public function insert_hired_data_batch($data)
{
    return $this->db->insert_batch('hr_hired', $data);
}
//end

public function get_hired_data_by_user_id($user_id)
{
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('hr_hired');
    return $query->result_array();
}

// Fungsi untuk menghapus data gaji lama berdasarkan user_id
public function delete_salary_data($user_id)
{
    return $this->db->delete('hr_salary', ['user_id' => $user_id]);
}

// Fungsi untuk menyimpan data gaji baru secara batch
public function insert_salary_data_batch($data)
{
    return $this->db->insert_batch('hr_salary', $data);
}

// Fungsi untuk mengambil data gaji berdasarkan user_id
public function get_salary_data_by_user_id($user_id)
{
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('hr_salary');
    return $query->result_array();
}

public function save_or_update_reward($id, $data)
{
    if (!empty($id)) {
        // Jika ada ID, berarti ini adalah data lama. Lakukan UPDATE.
        $this->db->where('id', $id);
        return $this->db->update('hr_reward', $data);
    } else {
        // Jika tidak ada ID, berarti ini data baru. Lakukan INSERT.
        return $this->db->insert('hr_reward', $data);
    }
}

public function get_rewards_by_user_id($user_id)
{
    $this->db->where('user_id', $user_id);
    $this->db->order_by('reward_date', 'ASC');
    $this->db->limit(4);
    return $this->db->get('hr_reward')->result_array();
}
//

//
public function save_or_update_disciplinary($id, $data)
{
    if (!empty($id)) {
        // Jika ada ID, lakukan UPDATE
        $this->db->where('id', $id);
        return $this->db->update('hr_disciplinary', $data);
    } else {
        // Jika tidak ada ID, lakukan INSERT
        return $this->db->insert('hr_disciplinary', $data);
    }
}

public function get_disciplinary_by_user_id($user_id)
{
    $this->db->where('user_id', $user_id);
    $this->db->order_by('disciplinary_date', 'ASC');
    $this->db->limit(4);
    return $this->db->get('hr_disciplinary')->result_array();
}

// Fungsi untuk mengambil semua data dari tbl_posisi
public function get_all_positions()
{
    $this->db->order_by('posisi', 'ASC'); // Urutkan berdasarkan abjad
    return $this->db->get('tbl_posisi')->result_array();
}

// Fungsi untuk mengambil data kronologi yang sudah tersimpan
public function get_chronology_by_user_id($user_id)
{
    $this->db->where('user_id', $user_id);
    $this->db->order_by('employee_date_start', 'ASC'); // <-- Diubah menjadi 'star'
    $this->db->limit(5); // Ambil maksimal 5 baris sesuai form
    return $this->db->get('hr_employee')->result_array();
}
//

//
public function save_or_update_chronology($id, $data)
{
    if (!empty($id)) {
        // Jika ada ID, berarti ini adalah data lama. Lakukan UPDATE.
        $this->db->where('id', $id);
        return $this->db->update('hr_employee', $data);
    } else {
        // Jika tidak ada ID, berarti ini data baru. Lakukan INSERT.
        return $this->db->insert('hr_employee', $data);
    }
}

public function get_posisi_by_name($name)
{
    // Mengambil data dari tbl_posisi dimana kolom 'posisi' cocok dengan nama
    return $this->db->get_where('tbl_posisi', ['posisi' => $name])->row_array();
}

/**
 * Meng-update hanya kolom 'posisi' di tabel tbl_user
 */
public function update_candidate_posisi($user_id, $posisi_id)
{
    $this->db->where('_id', $user_id);
    return $this->db->update('tbl_user', ['posisi' => $posisi_id]);
}
//end untuk bagian candidate

//star untuk summary

//starrr
public function get_all_summaries($search_term = null)
{
    // Daftar ID posisi yang tidak ingin ditampilkan
    $excluded_positions = [1, 2, 12, 16, 13, 14];

    $this->db->select([
        // 'u._id',
        'u.*',
        'u._id AS id_family', 
        'u._id AS id_document',
        'u._id AS id_certificate',
        'u._id AS id_hired',
        'u._id AS id_reward',
        'u._id AS id_disciplinary',
        'u._id AS id_chronology',
        'ac.registered_school_name as last_education',
        'u.nama as candidate_name',
        'u.tgl_lahir as birthday',
        'u.nik as ktp_no',
        'u.no_hp as mobile_no',
        'tp.posisi as position',
        'u._id AS id_cert',
        'u.is_aktif',
        'u.desired_salary',
        'u.religion',
        'u.summary_discipline as discipline',
        'u.applying_occupation',
        'u.marital as marriage_status',
        'u.summary_class_grade as class_grade',
        'u.email',
        // Subquery untuk mengambil pendidikan terakhir
        // '(SELECT ac.registered_school_name FROM hr_academic ac WHERE ac.user_id = u._id ORDER BY ac.graduation DESC LIMIT 1) as last_education',
        // Subquery untuk menghitung total karir dalam bulan
        // '(SELECT SUM(TIMESTAMPDIFF(MONTH, hc.period_star, hc.period_end) + 1) FROM hr_career hc WHERE hc.user_id = u._id) as total_career_months'
         // --- TAMBAHKAN SUBQUERY INI ---
        '(SELECT SUM(TIMESTAMPDIFF(MONTH, hc.period_star, hc.period_end) + 1) 
          FROM hr_career hc 
          WHERE hc.user_id = u._id) as total_career_months',

    ]);
    $this->db->from('tbl_user u');
    $this->db->join('tbl_posisi tp', 'u.posisi = tp._id', 'left');
   $this->db->join(
        '(SELECT user_id, registered_school_name, ROW_NUMBER() OVER(PARTITION BY user_id ORDER BY graduation DESC) as rn 
         FROM hr_academic) ac', 
        'u._id = ac.user_id AND ac.rn = 1', 
        'left'
    );
    $this->db->where('u.deleted', 0);
    $this->db->where_not_in('u.posisi', $excluded_positions);

    if (!empty($search_term)) {
        $this->db->group_start(); // Membuka kurung di query: ( ... )
        $this->db->like('u.nama', $search_term);
        $this->db->or_like('u.nik', $search_term);
        $this->db->or_like('tp.posisi', $search_term);
        $this->db->or_like('u.applying_occupation', $search_term);
        $this->db->or_like('u.email', $search_term);
        $this->db->group_end(); // Menutup kurung: ... )
    }
    
    $this->db->order_by('u._id', 'DESC');
    return $this->db->get()->result_array();
}
//


//
public function get_all_candidate_details()
{
    $this->db->select([
        'u._id',
        'u.nama as candidate_name',
        'u.tgl_lahir as birthday',
        'u.nik as ktp_no',
        'u.no_hp as mobile_no',
        'u.desired_salary',
        'u.religion',
        'u.summary_discipline as discipline',
        'tp.posisi as position', // Mengambil nama posisi dari tbl_posisi
        'u.applying_occupation',
        'u.marital as marriage_status',
        'u.summary_class_grade as class_grade',
        'u.email',
        // Subquery untuk mengambil pendidikan terakhir
        '(SELECT ac.registered_school_name FROM hr_academic ac WHERE ac.user_id = u._id ORDER BY ac.graduation DESC LIMIT 1) as last_education',
        // Subquery untuk menghitung total karir dalam bulan
        '(SELECT SUM(TIMESTAMPDIFF(MONTH, hc.period_star, hc.period_end) + 1) FROM hr_career hc WHERE hc.user_id = u._id) as total_career_months'
    ]);
    $this->db->from('tbl_user u');
    $this->db->join('tbl_posisi tp', 'u.posisi = tp._id', 'left');
    $this->db->where('u.deleted', 0); // Hanya tampilkan yang tidak dihapus
    
    return $this->db->get()->result_array();
}
//
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
//

//UNTUK AKTIF DAN NONAKTIF
public function update_active_status($id, $status)
{
    $this->db->where('_id', $id);
    return $this->db->update('tbl_user', ['is_aktif' => $status]);
}
//


//
public function get_all_absensi($search = null)
{
    $this->db->select([
        'ha.*', 
        'tu.nama',
        'tp.posisi as position',
        'h_team.value as team', // Ambil 'value' dari join 'h_team'
        'h_loc.value as work_location' // Ambil 'value' dari join 'h_loc'
    ]);
    $this->db->from('hr_absen ha');
    
    
    // Join utama
     $this->db->where('ha.deleted', 0);
    $this->db->join('tbl_user tu', 'ha.nik = tu.nik', 'left');
    $this->db->join('tbl_posisi tp', 'tu.posisi = tp._id', 'left');

    // JOIN khusus untuk mengambil data 'Team' dari hr_hired
    $this->db->join('hr_hired h_team', "h_team.user_id = tu._id AND h_team.intial = 'Team'", 'left');
    
    // JOIN khusus untuk mengambil data 'Work Location' dari hr_hired
    $this->db->join('hr_hired h_loc', "h_loc.user_id = tu._id AND h_loc.intial = 'Work Location'", 'left');

    if ($search) {
        $this->db->group_start();
        $this->db->like('ha.nik', $search);
        $this->db->or_like('tu.nama', $search);
        $this->db->or_like('tp.posisi', $search);
        // Tambahkan pencarian untuk team dan lokasi
        $this->db->or_like('h_team.value', $search);
        $this->db->or_like('h_loc.value', $search);
        $this->db->group_end();
    }
    
    $this->db->order_by('ha.tgl_masuk', 'DESC');
    return $this->db->get()->result_array();
}

//
public function insert_absensi_batch($data)
{
    // Menyimpan banyak baris data sekaligus ke tabel hr_absen
    return $this->db->insert_batch('hr_absen', $data);
}
//

//
public function update_absensi_record($id, $data)
{
    $this->db->where('id', $id);
    $this->db->update('hr_absen', $data);
    return $this->db->affected_rows() > 0;
}
//

//
public function soft_delete_absensi($id)
{
    $data = ['deleted' => 1];
    $this->db->where('id', $id);
    $this->db->update('hr_absen', $data);
    return $this->db->affected_rows() > 0;
}
//end 

// 1. Method untuk mengambil data gabungan dari hr_absen dan hr_timesheet
public function get_timesheet_data($tanggal)
{
    $this->db->select('
        ha.nik, 
        tu.nama,
        ha.tgl_masuk,
        ht.id,
        ht.time_in,
        ht.break_out,
        ht.break_in,
        ht.time_out,
        ht.break_overtime_out,
        ht.break_overtime_in,
        ht.overtime_out
    ');
    $this->db->from('hr_absen ha');
    $this->db->join('tbl_user tu', 'ha.nik = tu.nik', 'left');
    $this->db->join('hr_timesheet ht', 'ha.nik = ht.nik AND ha.tgl_masuk = ht.tgl_masuk', 'left');
    $this->db->where('LOWER(ha.kehadiran)', 'hadir'); 
    $this->db->where('ha.tgl_masuk', $tanggal);
    $this->db->where('ha.deleted', 0); // Pastikan hanya ambil data yg tidak di-soft-delete
    
    $this->db->where('(ht.deleted = 0 OR ht.deleted IS NULL)');
    $this->db->order_by('tu.nama', 'ASC');
    
    return $this->db->get()->result_array();
}

// 2. Method untuk menyimpan (update/insert) satu baris data timesheet
public function save_timesheet_entry($row)
{
    // Siapkan data
    $data = [
        'nik' => $row['nik'],
        'tgl_masuk' => $row['tgl_masuk'],
        'time_in' => empty($row['time_in']) ? NULL : $row['time_in'],
        'break_out' => empty($row['break_out']) ? NULL : $row['break_out'],
        'break_in' => empty($row['break_in']) ? NULL : $row['break_in'],
        'time_out' => empty($row['time_out']) ? NULL : $row['time_out'],
        'break_overtime_out' => empty($row['break_overtime_out']) ? NULL : $row['break_overtime_out'],
        'break_overtime_in' => empty($row['break_overtime_in']) ? NULL : $row['break_overtime_in'],
        'overtime_out' => empty($row['overtime_out']) ? NULL : $row['overtime_out']
    ];

    // Cek apakah data sudah ada
    $this->db->where('nik', $data['nik']);
    $this->db->where('tgl_masuk', $data['tgl_masuk']);
    $q = $this->db->get('hr_timesheet');

    if ($q->num_rows() > 0) {
        // Jika ada, UPDATE
        $this->db->where('nik', $data['nik']);
        $this->db->where('tgl_masuk', $data['tgl_masuk']);
        $this->db->update('hr_timesheet', $data);
    } else {
        // Jika tidak ada, INSERT
        $this->db->insert('hr_timesheet', $data);
    }

    return $this->db->affected_rows() >= 0; // Berhasil jika tidak ada error
}
//

// Di dalam Hr_model.php
public function soft_delete_timesheet($id)
{
    $data = ['deleted' => 1];
    $this->db->where('id', $id);
    $this->db->update('hr_timesheet', $data);
    return $this->db->affected_rows() > 0;
}
//

//
public function delete_related_data($user_id) {
    $this->db->delete('hr_academic', ['user_id' => $user_id]);
    $this->db->delete('hr_certificates', ['user_id' => $user_id]);
    $this->db->delete('hr_career', ['user_id' => $user_id]);
    $this->db->delete('hr_motivation', ['user_id' => $user_id]);
}
//

//
// Fungsi untuk menghapus semua data akademik berdasarkan user_id
public function delete_academic_data($user_id)
{
    return $this->db->delete('hr_academic', ['user_id' => $user_id]);
}
//

// Fungsi untuk menyimpan banyak data akademik sekaligus
public function insert_academic_batch($data)
{
    return $this->db->insert_batch('hr_academic', $data);
}
//
//
public function insert_certificates_batch($data)
{
    return $this->db->insert_batch('hr_certificates', $data);
}
//

//
public function insert_career_batch($data)
{
    return $this->db->insert_batch('hr_career', $data);
}
//

//
public function get_family_data_by_user_id($user_id)
{
    return $this->db->get_where('hr_family', ['user_id' => $user_id])->result_array();
}
//

//
public function get_certificates_by_user_id_formatted($user_id)
{
    $certificates_raw = $this->db->get_where('hr_certificates', ['user_id' => $user_id])->result_array();
    $certificates_formatted = [];
    foreach ($certificates_raw as $index => $cert) {
        $key_prefix = $index + 1;
        $certificates_formatted['id_' . $key_prefix] = $cert['id'];
        $certificates_formatted['name_' . $key_prefix] = $cert['certificate'];
        $certificates_formatted['authority_' . $key_prefix] = $cert['authority'];
        $certificates_formatted['no_' . $key_prefix] = $cert['certificate_no'];
        $certificates_formatted['date_' . $key_prefix] = $cert['acquisition'];
    }
    return $certificates_formatted;
}
//

//
public function get_full_candidate_profile($user_id)
{
    $profile = [];
    $profile['main'] = $this->get_candidate_by_id($user_id);
    $profile['academics'] = $this->get_academics_by_user_id($user_id);
    $profile['certificates'] = $this->get_certificates_by_user_id($user_id);
    $profile['careers'] = $this->get_careers_by_user_id($user_id);
    $profile['motivation'] = $this->get_motivation_by_user_id($user_id);

    // Tambahkan data lain yang perlu diekspor
    
    return $profile;
}
//

public function get_full_summary_profile($user_id)
{
    $summary = [];
    $summary['main'] = $this->get_candidate_by_id($user_id);
    // $summary['hired_data'] = $this->get_hired_data_by_user_id($user_id);
    $summary['salary_data'] = $this->get_salary_data_by_user_id($user_id);
    $summary['rewards'] = $this->get_rewards_by_user_id($user_id);
    $summary['disciplinary'] = $this->get_disciplinary_by_user_id($user_id);
    $summary['last_education'] = $this->get_last_education($user_id);
    $summary['certificates'] = $this->get_certificates_by_user_id_formatted($user_id);
    $summary['disciplinary'] = $this->get_disciplinary_by_user_id($user_id);
    $summary['chronology'] = $this->get_chronology_by_user_id($user_id);
    


    $family_raw = $this->get_family_data_by_user_id($user_id);
    
    
    // --- untuk reward ---
    $rewards_raw = $this->get_rewards_by_user_id($user_id);
    $rewards_formatted = [];
    foreach($rewards_raw as $index => $reward) {
        $key_prefix = $index + 1;
        $rewards_formatted['id_'.$key_prefix] = $reward['id'];
        $rewards_formatted['name_'.$key_prefix] = $reward['reward_name'];
        $rewards_formatted['date_'.$key_prefix] = $reward['reward_date'];
        $rewards_formatted['result_'.$key_prefix] = $reward['reward_result'];
    }
    $summary['rewards'] = $rewards_formatted;
    // --- AKHIR DARI LOGIKA rewad ---
    

    // untuk dokument
    $documents_raw = $this->get_documents_by_user_id($user_id);
    $documents_formatted = [];
    foreach ($documents_raw as $doc) {
        // Kunci array dibuat dari 'document_type' agar cocok dengan di view
        $documents_formatted[$doc['document_type']] = $doc;
    }
    $summary['documents'] = $documents_formatted;
    // end untuk bagian dokumentasi
    
    // Proses data keluarga agar mudah diakses di view
    $family_processed = [];
    foreach ($family_raw as $fam) {
        $relation = strtolower(str_replace(' ', '', $fam['relation']));
        $family_processed[$relation] = [
            'number' => $fam['number'] ?? 0,
            'accompany' => ucfirst($fam['cohabit'] ?? 'No')
        ];
    }
    $summary['family'] = $family_processed;
    // end
    
    //buat intial hireed status
    $hired_raw = $this->get_hired_data_by_user_id($user_id);
    $hired_formatted = [];
    foreach ($hired_raw as $row) {
        // Buat kunci yang bersih: ubah ke huruf kecil, ganti spasi dengan _, hapus titik.
        $key = str_replace('.', '', strtolower($row['intial']));
        $key = str_replace(' ', '_', $key);
        
        $hired_formatted[$key] = $row['value'];
    }
    $summary['hired_status'] = $hired_formatted;
    //

    $salary_raw = $this->get_salary_data_by_user_id($user_id);
    $salary_formatted = [];
    foreach ($salary_raw as $row) {
        $key = 'salary_' . str_replace([' ', '/'], '_', strtolower($row['allowances']));
        $salary_formatted[$key] = $row['salary'];
    }
    $summary['salary'] = $salary_formatted;
    //end intial hored

    //posisi
    if (!empty($summary['main']['posisi'])) {
        $posisi_data = $this->db->get_where('tbl_posisi', ['_id' => $summary['main']['posisi']])->row_array();
        $summary['main']['position_name'] = $posisi_data['posisi'] ?? '';
    } else {
        $summary['main']['position_name'] = '';
    }
    // Tambahkan data lain yang perlu diekspor
    
    
    
    return $summary;
}
//

//
public function update_certificate($id, $data)
{
    $this->db->where('id', $id);
    return $this->db->update('hr_certificates', $data);
}
//

//
public function insert_certificate($data)
{
    return $this->db->insert('hr_certificates', $data);
}
//

//
public function update_status($id, $new_status)
{
    $this->db->where('_id', $id);
    return $this->db->update('tbl_user', ['candidate_status' => $new_status]);
}
//

}

?>