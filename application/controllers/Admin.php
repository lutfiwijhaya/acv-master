<?php
defined('BASEPATH') or exit('No direct script access allowed');




class Admin extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        if (!is_login()) redirect(site_url('login'));
        $this->load->model('Login_model', 'login_model');
        $this->load->model('Backend_model', 'backend_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Global_model', 'global_model');
        $this->load->helper('file');
    }

    function index()
    {
        $data['title']  = 'Achivon Prestasi Abadi';
        $data['sidebar']  = 'sidebar';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        // $data['js_files'][] = base_url() . 'assets/admin/js/menu.js';
        $data['content'] = 'test';
        $this->template->load('template', 'dashboard', $data);
    }

    function login()
    {

        $query = $this->login_model->getLogin()->row_array();
        $this->session->set_userdata($query);
        $this->load->view('auth/login');
    }
    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login', 'Anda sudah berhasil keluar dari aplikasi');
        $this->load->view('auth/login', 'refresh');
    }

    function isLevel()
    {
        $this->output->set_content_type('application/json');
        $level = $this->backend_model->getIsLevel();
        echo json_encode($level);
    }
    function akses()
    {
        $data['css_files'][] = '';
        $data['js_files'][] = '';
        $data['level'] = $this->db->get_where('tbl_levels', array('id_posisi' =>  $this->uri->segment(3)))->row_array();
        $data['menu'] = $this->db->get_where('tbl_menus', array('is_main !=' => null))->result();
        $this->template->load('template', 'master/akses', $data);
    }

    function kasi_akses_ajax()
    {
        $id_menu        = $_GET['id_menu'];
        $id_user_level  = $_GET['level'];
        // chek data
        $params = array('id_menu' => $id_menu, 'id_posisi' => $id_user_level);
        $akses = $this->db->get_where('tbl_levels', $params);
        if ($akses->num_rows() < 1) {
            // insert data baru
            $this->db->insert('tbl_levels', $params);
        } else {
            $this->db->where('id_menu', $id_menu);
            $this->db->where('id_posisi', $id_user_level);
            $this->db->delete('tbl_levels');
        }
    }
    function menu()
    {
        $data['title']  = 'Data Menu';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'master/menu', $data);
    }
    function getMenus()
    {
        $this->output->set_content_type('application/json');
        $users = $this->backend_model->getMenus();
        echo json_encode($users);
    }
    public function ismain()
    {
        $this->output->set_content_type('application/json');
        $ismain = $this->backend_model->getIsMain();
        echo json_encode($ismain);
    }
    function updateMenu()
    {
        $title = $this->input->post('title', TRUE);
        $uri = $this->input->post('uri', TRUE);
        $icon = $this->input->post('icon', TRUE);
        $is_main = $this->input->post('is_main', TRUE);
        $order = $this->input->post('order', TRUE);
        $data = array();
        $data = array(
            'title'         => $title,
            'uri'           => $uri,
            'icon'          => $icon,
            'is_main'       => $is_main,
            'ordinal'         => $order
        );
        $where = array('_id' => $this->input->get('id'));
        $result = $this->global_model->update('tbl_menus', $data, $where);
        if ($result) {
            echo json_encode(array('message' => 'Update Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }
    function saveMenu()
    {
        $title = $this->input->post('title', TRUE);
        $uri = $this->input->post('uri', TRUE);
        $icon = $this->input->post('icon', TRUE);
        $is_main = $this->input->post('is_main', TRUE);
        $order = $this->input->post('order', TRUE);
        $data = array();
        $data = array(
            'title'         => $title,
            'uri'           => $uri,
            'icon'          => $icon,
            'is_main'       => $is_main,
            'ordinal'       => $order
        );
        $result = $this->global_model->insert('tbl_menus', $data);
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }


    public function change_password()
    {
        $this->load->model('User_model');

        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $user_id = $this->session->userdata('_id');

        // Cek apakah password lama benar
        $user = $this->User_model->getUserById($user_id);
        if (!password_verify($old_password, $user->password)) {
            echo json_encode(['success' => false, 'message' => 'Old password is incorrect']);
            return;
        }

        if ($new_password == '') {
            echo json_encode(['success' => false, 'message' => 'New password cannot be empty']);
            return;
        }

        // Cek apakah password baru dan konfirmasi cocok
        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'New password does not match confirmation']);
            return;
        }



        // Update password
        $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $this->User_model->updatePassword($user_id, $new_hashed_password);

        echo json_encode(['success' => true]);
    }






    function aktifMenu()
    {
        $id = $this->input->post('id');
        $rows = $this->db->get_where('tbl_menus', array('_id' => $id))->row_array();
        if ($rows['is_aktif'] == 0) {
            $aktif = 1;
        } else {
            $aktif = 0;
        }
        $result = $this->global_model->update('tbl_menus', array('is_aktif' => $aktif), array('_id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'Menu ' . $rows['title'] . ' Aktif or Non Aktif Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }



    function destroyMenu()
    {
        $id = $this->input->post('id');
        $result = $this->global_model->delete('tbl_menus', array('_id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }
    //modul user
    //list pegawai//
    function users()
    {
        $data['title']  = 'Data Pegawai';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'master/users', $data);
    }

    public function ping()
    {
        // Melakukan query ringan untuk menjaga koneksi tetap hidup
        $this->db->query('SELECT 1');
        echo 'Connection Alive';
    }






    //params
    public function set_menu_title()
    {
        // Ambil nilai menu_title dari request
        $menu_title = $this->input->post('menu_title');

        // Simpan ke session
        $this->session->set_userdata('menu_title', $menu_title);

        // Kirim respons balik ke frontend
        echo json_encode(['status' => 'success', 'menu_title' => $menu_title]);
    }





    public function getKodeBarangByKode()
    {
        $kode_barang = $this->input->post('kode_barang');
        $category = $this->input->post('category'); // Ambil category dari request

        if ($kode_barang && $category) {
            $this->db->select('id,kode_barang, category, inisial_kuantitas, level_1, level_2, level_3, level_4, remark');
            $this->db->from('wh_items');
            $this->db->where('kode_barang', $kode_barang);
            $this->db->where('category', $category); // Tambah filter category
            $this->db->where('is_deleted', '0');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Data not found']);
            }
        } else {
            echo json_encode(['error' => 'Invalid kode_barang or category']);
        }
    }


    public function getKodeBarang()
    {
        $category = $this->input->get('category');

        $this->db->select('kode_barang');
        $this->db->from('wh_items');
        $this->db->where('category', $category);  // Filter berdasarkan category yang dipilih
        $query = $this->db->get();

        $result = $query->result();

        // Pastikan hasil dikembalikan dalam format JSON dengan array yang benar
        echo json_encode($result);
    }



    function params()
    {
        $data['title']  = 'Params Managements';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'master/params', $data);
    }

    function wh_params()
    {
        $data['title']  = 'Warehouse Params';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/wh-params', $data);
    }

    function adminshare($desc)
    {
        $desc = urldecode($desc);
        $data['desc']  = $desc;
        $data['title']  = 'Share Managements';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'admin-shared/admin-shared', $data);
    }

    function filesharepid($desc)
    {
        $desc = urldecode($desc);
        $data['desc']  = $desc;
        $data['title']  = 'File P&ID';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'admin-shared/admin-shared-pid', $data);
    }

    function filesharedsteelstructure($desc)
    {
        $desc = urldecode($desc);
        $data['desc']  = $desc;
        $data['title']  = 'File Steel Structure';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'admin-shared/admin-shared-steelstructure', $data);
    }

    function fileshareequipment($desc)
    {
        $desc = urldecode($desc);
        $data['title']  = 'File Equipment';
        $data['desc']  = $desc;
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'admin-shared/admin-shared-equipment', $data);
    }

    function filesharedpiping($desc)
    {
        $desc = urldecode($desc);
        $data['title']  = 'File Piping';
        $data['desc']  = $desc;
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'admin-shared/admin-shared-piping', $data);
    }


    function getsharedfiles($desc)
    {
        $desc = urldecode($desc);
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getsharedFiles($desc);
        echo json_encode($stock);
    }

    function getsharedfilespiping($desc)
    {
        $desc = urldecode($desc);
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getsharedFilespiping($desc);
        echo json_encode($stock);
    }

    function getsharedfilesequipment($desc)
    {
        $desc = urldecode($desc);


        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getsharedfilesEquipment($desc);
        echo json_encode($stock);
    }

    function getsharedfilespid($desc)
    {
        $desc = urldecode($desc);
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getsharedFilespid($desc);
        echo json_encode($stock);
    }

    function getfilesharesteelstructure($desc)
    {
        $desc = urldecode($desc);
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getsharedFilessteelstructure($desc);
        echo json_encode($stock);
    }

    function getparams()
    {
        $this->output->set_content_type('application/json');
        $params = $this->backend_model->getParams();
        echo json_encode($params);
    }

    function getwh_params()
    {
        $this->output->set_content_type('application/json');
        $params = $this->backend_model->getwh_Params();
        echo json_encode($params);
    }


    function savewh_Params()
    {
        $param_name = $this->input->post('param_name', TRUE);
        $param_group = $this->input->post('param_group', TRUE);
        $status = $this->input->post('status', TRUE);
        $remark = $this->input->post('remark', TRUE);
        $data = array();
        $data = array(
            'param_name'         => $param_name,
            'param_group'        => $param_group,
            'status'             => $status,
            'remark'             => $remark,
        );
        $result = $this->global_model->insert('wh_params', $data);
        $this->cache->file->delete('getCategoryParams');
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }

    function saveParams()
    {
        $param_name = $this->input->post('param_name', TRUE);
        $param_group = $this->input->post('param_group', TRUE);
        $status = $this->input->post('status', TRUE);
        $remark = $this->input->post('remark', TRUE);
        $data = array();
        $data = array(
            'param_name'         => $param_name,
            'param_group'        => $param_group,
            'status'             => $status,
            'remark'             => $remark,
        );
        $result = $this->global_model->insert('params', $data);
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }


    function updateParams()
    {
        $param_name = $this->input->post('param_name', TRUE);
        $param_group = $this->input->post('param_group', TRUE);
        $status = $this->input->post('status', TRUE);
        $remark = $this->input->post('remark', TRUE);
        $data = array();
        $data = array(
            'param_name'         => $param_name,
            'param_group'        => $param_group,
            'status'             => $status,
            'remark'             => $remark,
        );
        $where = array('id' => $this->input->get('id'));
        $result = $this->global_model->update('params', $data, $where);
        if ($result) {
            echo json_encode(array('message' => 'Update Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }





    function updatewh_Params()
    {
        $param_name = $this->input->post('param_name', TRUE);
        $param_group = $this->input->post('param_group', TRUE);
        $status = $this->input->post('status', TRUE);
        $remark = $this->input->post('remark', TRUE);
        $data = array();
        $data = array(
            'param_name'         => $param_name,
            'param_group'        => $param_group,
            'status'             => $status,
            'remark'             => $remark,
        );
        $where = array('id' => $this->input->get('id'));
        $result = $this->global_model->update('wh_params', $data, $where);
        $this->cache->file->delete('getCategoryParams');
        if ($result) {
            echo json_encode(array('message' => 'Update Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }

    function destroyParams()
    {
        $id = $this->input->post('id');
        $result = $this->global_model->delete('params', array('id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }

    function destroywh_Params()
    {
        $id = $this->input->post('id');
        $result = $this->global_model->delete('wh_params', array('id' => $id));
        $this->cache->file->delete('getCategoryParams');
        if ($result) {
            echo json_encode(array('message' => 'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }

    public function getGroupParams()
    {
        $this->db->distinct();  // Menambahkan klausa DISTINCT
        $this->db->select('param_group');
        $this->db->from('params');
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function getGroupwh_Params()
    {
        $this->db->distinct();  // Menambahkan klausa DISTINCT
        $this->db->select('param_group');
        $this->db->from('wh_params');
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }



    public function saveDistribution()
    {
        // Ambil input dari post
        $date      = $this->input->post('tanggal', TRUE);
        $no_req    = $this->input->post('no_req', TRUE);
        $dist_type = $this->input->post('dist_type', TRUE);
        $remark    = $this->input->post('remark', TRUE);
        $item_id   = $this->input->post('item_id', TRUE);
        $from      = $this->input->post('from', TRUE);
        $id_from   = $this->input->post('id_from', TRUE);
        $to        = $this->input->post('to', TRUE);
        $id_to     = $this->input->post('id_to', TRUE);
        $qty       = $this->input->post('quantity', TRUE);
        $po_number = '';
        $from_dist = '';
        $to_dist   = '';

        // Mapping nilai $from ke field yang sesuai di database
        if ($from == 'warehouse_id') {
            $from_dist = 'from_warehouse_id';
        } else if ($from == 'employee_id') {
            $from_dist = 'employee_id_from';
        } else {
            $from_dist = 'from_suplier_id';
        }

        if ($to == 'warehouse_id') {
            $to_dist = 'to_warehouse_id';
        } else if ($to == 'employee_id') {
            $to_dist = 'employee_id_to';
        } else {
            $to_dist = 'to_suplier_id';
        }

        // Data yang akan disimpan ke dalam wh_distribution
        $data = array(
            'item_id'           => $item_id,
            $from_dist          => $id_from,
            $to_dist            => $id_to,
            'qty'               => $qty,
            'distribution_date' => $date,
            'remark'            => $remark,
            'po_id'             => $po_number,
            'request_id'        => $no_req,
            'distribution_type' => $dist_type
        );

        // Simpan data ke wh_distribution
        $result = $this->global_model->insert('wh_distribution', $data);

        if ($result) {


            if ($dist_type != 'New') {
                // 1. Kurangi stok dari `id_from`
                $this->db->set('quantity', 'quantity - ' . (int)$qty, FALSE);
                $this->db->where('item_id', $item_id);
                $this->db->where($from, $id_from);
                $this->db->update('wh_items_stock');
            }

            // 2. Cek apakah ada stok di `id_to`
            $this->db->where('item_id', $item_id);
            $this->db->where($to, $id_to);
            $query = $this->db->get('wh_items_stock');

            if ($dist_type == 'Consumable' && $to == 'employee_id') {
                $qty = 0;
            }

            if ($query->num_rows() > 0) {
                // Jika ada, tambahkan stok
                $this->db->set('quantity', 'quantity + ' . (int)$qty, FALSE);
                $this->db->where('item_id', $item_id);
                $this->db->where($to, $id_to);
                $this->db->update('wh_items_stock');
            } else {
                // Jika tidak ada, lakukan insert
                $data_to_insert = array(
                    'item_id' => $item_id,
                    $to       => $id_to,
                    'quantity'     => $qty
                );
                $this->db->insert('wh_items_stock', $data_to_insert);
            }

            // Berikan respons sukses
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occurred.'));
        }
    }



    public function getDistributionValue()
    {

        $this->db->select('param_name,remark');
        $this->db->from('params');
        $this->db->where('param_group', 'distribution_value');  // sesuaikan dengan group untuk kategori
        $query = $this->db->get();
        $result = $query->result();
        echo json_encode($result);
    }

    public function getFromId()
    {

        $remark = $this->input->get('remark');
        if ($remark) {
            if ($remark == 'wh_warehouse') {
                $this->db->select('wh_name,id');
                $this->db->from($remark);
                $query = $this->db->get();
                $result = $query->result();
                echo json_encode($result);
            } else if ($remark == 'tbl_user') {
                $this->db->select('nama,_id');
                $this->db->from($remark);
                $query = $this->db->get();
                $result = $query->result();
                echo json_encode($result);
            } else {
                $this->db->select('nama,id');
                $this->db->from($remark);
                $query = $this->db->get();
                $result = $query->result();
                echo json_encode($result);
            }
        } else {
            echo json_encode(['error' => 'Invalid remark']);
        }
    }



    public function checkStock()
    {
        $item_id = $this->input->get('item_id');
        $from_id = $this->input->get('id_from');
        $from = $this->input->get('from');

        // Validasi item_id
        if (!$item_id) {
            echo json_encode(['error' => 'Invalid item_id']);
            return;
        }

        // Validasi kolom 'from' agar aman
        $valid_columns = ['warehouse_id', 'employee_id', 'supplier_id'];
        if (!in_array($from, $valid_columns)) {
            echo json_encode(['error' => 'Invalid from parameter']);
            return;
        }

        // Query ke database dengan SUM untuk menjumlahkan quantity
        $this->db->select_sum('quantity');
        $this->db->from('wh_items_stock');
        $this->db->where('item_id', $item_id);
        $this->db->where($from, $from_id);

        $query = $this->db->get();

        // Mengembalikan hasil query dalam format JSON
        if ($query->num_rows() > 0 && $query->row()->quantity !== null) {
            // Mengembalikan jumlah stok
            echo json_encode(['quantity' => $query->row()->quantity]);
        } else {
            echo json_encode(['error' => 'Stock not found']);
        }
    }



    public function getlevel1shared()
    {
        $this->db->select('param_name');
        $this->db->from('params');
        $this->db->where('param_group', 'KN_Chemical_Plant');  // sesuaikan dengan group untuk kategori
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function getLevel2shared()
    {
        $level_1_shared = $this->input->get('level_1');  // Ambil level_1 yang dipilih

        $this->db->select('param_name,remark');
        $this->db->from('params');
        $this->db->where('status', $level_1_shared);
        $this->db->where('remark', 'KN_Chemical_Plant');  // Filter berdasarkan remark yang sesuai dengan level_1
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function gettypefile()
    {
        $this->db->select('param_name');
        $this->db->from('params');
        $this->db->where('param_group', 'type_file');  // sesuaikan dengan group untuk kategori
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function getInisialKuantitasParams()
    {
        $this->db->select('param_name');
        $this->db->from('params');
        $this->db->where('param_group', 'inisial_kuantitas');  // sesuaikan dengan group untuk kategori
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }




    public function getCategoryParams()
    {
        $cache_key = 'getCategoryParams';

        // Cek apakah data sudah ada di cache
        if ($cached = $this->cache->file->get($cache_key)) {
            echo json_encode($cached);
            return;
        }

        // Jika belum ada, ambil dari database
        $this->db->select('param_name, status');
        $this->db->from('wh_params');
        $this->db->where('param_group', 'category');
        $query = $this->db->get();

        $result = $query->result();

        // Simpan hasil query ke dalam cache selama 10 menit (600 detik)
        $this->cache->file->save($cache_key, $result, 600);

        echo json_encode($result);
    }


    public function getLevel1Params()
    {
        $Category = $this->input->get('Category');  // Ambil level_1 yang dipilih

        $this->db->select('param_name,status');
        $this->db->from('wh_params');
        $this->db->where('param_group', 'wh_level_1');
        $this->db->where('remark', $Category);  // Filter berdasarkan remark yang sesuai dengan level_1
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function getLevel2Params()
    {
        $level_1 = $this->input->get('level_1');  // Ambil level_1 yang dipilih

        $this->db->select('param_name,status');
        $this->db->from('wh_params');
        $this->db->where('param_group', 'wh_level_2');
        $this->db->where('remark', $level_1);  // Filter berdasarkan remark yang sesuai dengan level_1
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function getLevel3Params()
    {
        $level_2 = $this->input->get('level_2');  // Ambil level_1 yang dipilih

        $this->db->select('param_name,status');
        $this->db->from('wh_params');
        $this->db->where('param_group', 'wh_level_3');
        $this->db->where('remark', $level_2);  // Filter berdasarkan remark yang sesuai dengan level_1
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }

    public function getLevel4Params()
    {
        $level_3 = $this->input->get('level_3');  // Ambil level_1 yang dipilih

        $this->db->select('param_name,status');
        $this->db->from('wh_params');
        $this->db->where('param_group', 'wh_level_4');
        $this->db->where('remark', $level_3);  // Filter berdasarkan remark yang sesuai dengan level_1
        $query = $this->db->get();

        $result = $query->result();
        echo json_encode($result);
    }




    public function getCountForLevel1()
    {
        $param_name = $this->input->get('param_name', TRUE);

        $this->db->from('wh_items');
        $this->db->where('level_1', $param_name);
        $count = $this->db->count_all_results();

        echo json_encode(array('count' => $count));
    }





    function saveUsers()
    {
        $nik               = $this->input->post('nik', TRUE);
        $password       = $this->input->post('password', TRUE);
        $options        = array("cost" => 4);
        $hashPassword    = password_hash($password, PASSWORD_BCRYPT, $options);
        $nama           = $this->input->post('nama', TRUE);
        $jk              = $this->input->post('jk', TRUE);
        $tempat         = $this->input->post('tempat_lahir', TRUE);
        $tgl_l          = $this->input->post('tgl_lahir', TRUE);
        $tgl_g            = $this->input->post('tgl_masuk', TRUE);
        $posisi           = $this->input->post('posisi', TRUE);
        $alamat           = $this->input->post('alamat', TRUE);
        $no_hp           = $this->input->post('no_hp', TRUE);
        $email           = $this->input->post('email', TRUE);
        $marital           = $this->input->post('marital', TRUE);
        $npwp           = $this->input->post('npwp', TRUE);
        $bpjs_ks           = $this->input->post('bpjs_ks', TRUE);
        $bpjs_kt           = $this->input->post('bpjs_kt', TRUE);
        $employee_id    = $this->input->post('id_employee', TRUE);

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/';  // Direktori sementara untuk upload
        $config['allowed_types'] = 'jpg|jpeg|png';  // Tipe file yang diizinkan
        $config['max_size'] = 200;  // Batas ukuran file dalam KB

        $this->load->library('upload', $config);

        // Variabel untuk menyimpan nama file
        $file_name = null;

        if ($this->upload->do_upload('foto')) {
            $uploadData = $this->upload->data();
            $file_name = $uploadData['file_name'];  // Mendapatkan nama file yang di-upload

            // Simpan path dari file yang di-upload
            $file_path = base_url('uploads/') . $file_name;  // Path relatif file yang di-upload
        }

        // Menyimpan data ke database
        $data = array(
            'employee-id'    => $employee_id,
            'nik'            => $nik,
            'password'       => $hashPassword,
            'nama'           => $nama,
            'jk'             => $jk,
            'tempat_lahir'   => $tempat,
            'tgl_lahir'      => $tgl_l,
            'tgl_masuk'      => $tgl_g,
            'posisi'         => $posisi,
            'alamat'         => $alamat,
            'no_hp'          => $no_hp,
            'email'          => $email,
            'marital'        => $marital,
            'npwp'           => $npwp,
            'bpjs_ks'        => $bpjs_ks,
            'bpjs_kt'        => $bpjs_kt,
            'path_foto'      => $file_path   // Menyimpan path file gambar
        );

        $result = $this->global_model->insert('tbl_user', $data);
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }

    function saveItem()
    {
        // Mengambil input dari form
        $kode_barang        = $this->input->post('kode_barang', TRUE);
        $category           = $this->input->post('category', TRUE);
        $inisial_kuantitas  = $this->input->post('inisial_kuantitas', TRUE);
        $level_1            = $this->input->post('level_1', TRUE);
        $level_2            = $this->input->post('level_2', TRUE);
        $level_3            = $this->input->post('level_3', TRUE);
        $level_4            = $this->input->post('level_4', TRUE);
        $remark             = $this->input->post('remark', TRUE);

        // Validasi input (jika diperlukan)
        if (empty($kode_barang) || empty($category) || empty($level_1)) {
            echo json_encode(array('errorMsg' => 'Pastikan semua field yang diperlukan telah terisi.'));
            return;
        }

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/foto-items';  // Direktori upload
        $config['allowed_types'] = 'jpg|jpeg|png';  // Tipe file yang diizinkan
        $config['max_size'] = 200;  // Batas ukuran file dalam KB

        // Menggunakan kode_barang sebagai nama file
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);  // Mendapatkan ekstensi file
        $config['file_name'] = $kode_barang . '.' . $ext;  // Nama file sesuai dengan kode_barang

        $this->load->library('upload', $config);

        // Variabel untuk menyimpan nama dan path file
        $file_name = null;
        $file_path = null;

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['foto']['name'])) {  // Hanya upload jika ada file foto
            if ($this->upload->do_upload('foto')) {
                $uploadData = $this->upload->data();
                $file_name = $uploadData['file_name'];  // Mendapatkan nama file yang di-upload
                $file_path = base_url('uploads/foto-items/') . $file_name;  // Path relatif file yang di-upload
            } else {
                // Jika ada file namun gagal upload, tampilkan pesan error
                $error = $this->upload->display_errors();
                echo json_encode(array('errorMsg' => 'Upload gagal: ' . $error));
                return;
            }
        }

        // Data yang akan disimpan ke database
        $data = array(
            'kode_barang'       => $kode_barang,
            'category'          => $category,
            'inisial_kuantitas' => $inisial_kuantitas,
            'level_1'           => $level_1,
            'level_2'           => $level_2,
            'level_3'           => $level_3,
            'level_4'           => $level_4,
            'remark'            => $remark,
        );

        // Hanya tambahkan path_foto jika ada file yang berhasil diupload
        if ($file_path) {
            $data['path_foto'] = $file_path;
        }

        // Simpan ke database
        $result = $this->global_model->insert('wh_items', $data);

        // Cek hasil penyimpanan
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan data.'));
        }
    }




    function updateItem()
    {
        $kode_barang        = $this->input->post('kode_barang', TRUE);
        $category           = $this->input->post('category', TRUE);
        $inisial_kuantitas  = $this->input->post('inisial_kuantitas', TRUE);
        $level_1            = $this->input->post('level_1', TRUE);
        $level_2            = $this->input->post('level_2', TRUE);
        $level_3            = $this->input->post('level_3', TRUE);
        $level_4            = $this->input->post('level_4', TRUE);
        $remark             = $this->input->post('remark', TRUE);

        // Ambil data item berdasarkan ID
        $item_id = $this->input->get('id');
        $current_item = $this->global_model->get_by_id('wh_items', array('id' => $item_id));

        if (!$current_item) {
            echo json_encode(array('errorMsg' => 'Item tidak ditemukan.'));
            return;
        }

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/foto-items';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 200; // 200KB

        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $config['file_name'] = $kode_barang . '.' . $ext;

        $this->load->library('upload', $config);

        // Inisialisasi file foto
        $file_name = null;
        $file_path = null;

        // Cek apakah ada file foto baru yang diunggah
        if (!empty($_FILES['foto']['name'])) {
            // Jika ada, hapus foto lama
            if ($current_item->path_foto && file_exists('./uploads/foto-items/' . basename($current_item->path_foto))) {
                unlink('./uploads/foto-items/' . basename($current_item->path_foto));
            }

            // Proses upload foto baru
            if ($this->upload->do_upload('foto')) {
                $uploadData = $this->upload->data();
                $file_name = $uploadData['file_name'];
                $file_path = base_url('uploads/foto-items/') . $file_name;  // Path baru untuk gambar yang di-upload
            } else {
                $error = $this->upload->display_errors();
                echo json_encode(array('errorMsg' => 'Upload gagal: ' . $error));
                return;
            }
        }

        // Buat array data untuk update
        $data = array(
            'kode_barang'       => $kode_barang,
            'category'          => $category,
            'inisial_kuantitas' => $inisial_kuantitas,
            'level_1'           => $level_1,
            'level_2'           => $level_2,
            'level_3'           => $level_3,
            'level_4'           => $level_4,
            'remark'            => $remark
        );

        // Jika file foto diunggah, tambahkan path foto baru ke data update
        if ($file_path) {
            $data['path_foto'] = $file_path;
        }

        // Update data item
        $where = array('id' => $item_id);
        $result = $this->global_model->update('wh_items', $data, $where);

        if ($result) {
            echo json_encode(array('message' => 'Update Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occurred.'));
        }
    }

    function getUsers()
    {
        $this->output->set_content_type('application/json');
        $users = $this->backend_model->getUsers();
        echo json_encode($users);
    }
    function aktifUsers()
    {
        $id = $this->input->post('id');
        $rows = $this->db->get_where('tbl_user', array('_id' => $id))->row_array();
        if ($rows['is_aktif'] == 0) {
            $aktif = "1";
        } else {
            $aktif = "0";
        }
        $result = $this->global_model->update('tbl_user', array('is_aktif' => $aktif), array('_id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'User ' . $rows['nama'] . ' Aktif or Non Aktif Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }


    function delete_item()
    {
        $id = $this->input->post('id');
        $rows = $this->db->get_where('wh_items', array('id' => $id))->row_array();
        if ($rows['is_deleted'] == 0) {
            $aktif = "1";
        } else {
            $aktif = "0";
        }
        $result = $this->global_model->update('wh_items', array('is_deleted' => $aktif), array('id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'Item ' . $rows['kode_barang'] . ' Delete Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }



    function updateUsers()
    {
        $nik               = $this->input->post('nik', TRUE);
        $password       = $this->input->post('password', TRUE);
        $options        = array("cost" => 4);
        $hashPassword    = password_hash($password, PASSWORD_BCRYPT, $options);
        $nama           = $this->input->post('nama', TRUE);
        $jk              = $this->input->post('jk', TRUE);
        $tempat         = $this->input->post('tempat_lahir', TRUE);
        $tgl_l          = $this->input->post('tgl_lahir', TRUE);
        $tgl_g            = $this->input->post('tgl_masuk', TRUE);
        $posisi           = $this->input->post('posisi', TRUE);
        $alamat           = $this->input->post('alamat', TRUE);
        if ($password == '') {
            $data = array(
                'nik'            => $nik,
                'nama'            => $nama,
                'jk'            => $jk,
                'tempat_lahir'    => $tempat,
                'posisi'        => $posisi,
                'alamat'        => $alamat,
                'tgl_lahir'        => $tgl_l,
                'tgl_masuk'        => $tgl_g,
            );
        } else {
            $data = array(
                'nik'            => $nik,
                'password'        => $hashPassword,
                'nama'            => $nama,
                'jk'            => $jk,
                'tempat_lahir'    => $tempat,
                'posisi'        => $posisi,
                'alamat'        => $alamat,
                'tgl_lahir'        => $tgl_l,
                'tgl_masuk'        => $tgl_g,
            );
        }
        $where = array('_id' => $this->input->get('id'));
        $result = $this->global_model->update('tbl_user', $data, $where);
        if ($result) {
            echo json_encode(array('message' => 'Update Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }





    function destroyUsers()
    {
        $id = $this->input->post('id');
        $result = $this->global_model->delete('tbl_user', array('_id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }
    //end list pegawai//



    //management - items
    function PO()
    {
        $data['title']  = 'Items Managements';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/PO', $data);
    }


    function getPO()
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getPO();
        echo json_encode($stock);
    }

    public function getComboSupplier()
    {

        $this->db->select('id,nama');
        $this->db->from('tbl_supplier');
        $query = $this->db->get();
        $result = $query->result();
        echo json_encode($result);
    }

    public function savePO()
    {
        // Mengambil input dari form
        $po_number        = $this->input->post('po_number', TRUE);
        $Supplier_id      = $this->input->post('id_sup', TRUE);
        $expeted_date     = $this->input->post('expeted_date', TRUE);
        $total_amount     = $this->input->post('total_amount', TRUE);
        $status           = $this->input->post('status', TRUE);
        $po_date          = $this->input->post('po_date', TRUE);
        $po_description   = $this->input->post('po_description', TRUE);
        $item_description = $this->input->post('item_description', TRUE);

        // Validasi input (jika diperlukan)
        if (empty($po_number) || empty($Supplier_id) || empty($expeted_date)) {
            echo json_encode(array('errorMsg' => 'Pastikan semua field yang diperlukan telah terisi.'));
            return;
        }

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/po-files';  // Direktori upload
        $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';  // Tipe file yang diizinkan
        $config['max_size'] = 1024;  // Batas ukuran file dalam KB

        // Menggunakan po_number sebagai nama file
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);  // Mendapatkan ekstensi file
        $config['file_name'] = $po_number . '.' . $ext;  // Nama file sesuai dengan po_number

        $this->load->library('upload', $config);

        // Variabel untuk menyimpan nama dan path file
        $file_name = null;
        $file_path = null;

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['file']['name'])) {  // Hanya upload jika ada file
            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $file_name = $uploadData['file_name'];  // Mendapatkan nama file yang di-upload
                $file_path = base_url('uploads/po-files/') . $file_name;  // Path relatif file yang di-upload
            } else {
                // Jika ada file namun gagal upload, tampilkan pesan error
                $error = $this->upload->display_errors();
                echo json_encode(array('errorMsg' => 'Upload gagal: ' . $error));
                return;
            }
        }

        // Data yang akan disimpan ke database
        $data = array(
            'po_number'       => $po_number,
            'Supplier_id'     => $Supplier_id,
            'expeted_date'    => $expeted_date,
            'total_amount'    => $total_amount,
            'status'          => $status,
            'po_date'         => $po_date,
            'po_description'  => $po_description,
            'item_description' => $item_description,
        );

        // Hanya tambahkan file jika ada file yang berhasil diupload
        if ($file_path) {
            $data['file'] = $file_path;
        }

        // Simpan ke database
        $result = $this->global_model->insert('tbl_po', $data);

        // Cek hasil penyimpanan
        if ($result) {
            echo json_encode(array('message' => 'Purchase Order berhasil disimpan.'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan data.'));
        }
    }





    function stock()
    {
        $data['title']  = 'Items Managements';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/items-management', $data);
    }


    function stockwarehouse($idwarehouse)
    {
        $data['title']  = 'Items Managements';
        $data['collapsed'] = '';
        $data['idwarehouse']  = $idwarehouse;
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/items-management-at-warehouse', $data);
    }


    function stockemployee()
    {
        $data['title']  = 'Items Managements';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/items-management-at-employee', $data);
    }

    function getstock()
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getStock();
        echo json_encode($stock);
    }

    function getStockwarehouse($idwarehouse)
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getStockwarehouse($idwarehouse);
        echo json_encode($stock);
    }

    function getserials($item_id, $id_from)
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getserials($item_id, $id_from);
        echo json_encode($stock);
    }

    public function destroySerial()
    {
        $id = $this->input->post('id', TRUE);

        if (!$id) {
            echo json_encode(['errorMsg' => 'ID serial tidak ditemukan!']);
            return;
        }

        // cek apakah serial ada
        $serial = $this->db->get_where('wh_item_serials', ['id' => $id])->row();
        if (!$serial) {
            echo json_encode(['errorMsg' => 'Serial tidak ditemukan!']);
            return;
        }

        // hapus serial
        $this->db->where('id', $id);
        $result = $this->db->delete('wh_item_serials');

        if ($result) {
            echo json_encode(['message' => 'Serial berhasil dihapus']);
        } else {
            echo json_encode(['errorMsg' => 'Gagal menghapus serial']);
        }
    }




    function getStockemployee()
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getStockemployee();
        echo json_encode($stock);
    }

    function supplier()
    {
        $data['title']  = 'Supplier';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/supplier', $data);
    }

    function deleteSupplier()
    {
        // Mendapatkan ID supplier yang akan dihapus
        $id_supplier = $this->input->post('id', TRUE);

        // Melakukan penghapusan data supplier berdasarkan ID
        $result = $this->global_model->delete('tbl_supplier', array('id' => $id_supplier));

        // Mengembalikan hasil operasi ke dalam bentuk JSON
        if ($result) {
            echo json_encode(array('message' => 'Supplier berhasil dihapus'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menghapus Supplier'));
        }
    }


    function getsupplier()
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getSupplier();
        echo json_encode($stock);
    }

    function saveSupplier()
    {
        // Mendapatkan input dari form
        $nama_supplier = $this->input->post('nama', TRUE);
        $PIC_name = $this->input->post('PIC_name', TRUE);
        $email = $this->input->post('email', TRUE);
        $phone = $this->input->post('phone', TRUE);
        $address = $this->input->post('address', TRUE);
        $bank_account = $this->input->post('bank_account', TRUE);
        $rek_bank = $this->input->post('rek_bank', TRUE);
        $tax = $this->input->post('tax', TRUE);
        $status = $this->input->post('status', TRUE);

        // Menyiapkan data untuk disimpan
        $data = array(
            'nama'         => $nama_supplier,
            'PIC_name'     => $PIC_name,
            'email'        => $email,
            'phone'        => $phone,
            'address'      => $address,
            'bank_account' => $bank_account,
            'rek_bank'     => $rek_bank,
            'tax'          => $tax,
            'status'       => $status,
            'created_at'   => date('Y-m-d H:i:s') // Menambahkan timestamp untuk created_at
        );

        // Insert data ke dalam database
        $result = $this->global_model->insert('tbl_supplier', $data);

        // Mengembalikan hasil operasi ke dalam bentuk JSON
        if ($result) {
            echo json_encode(array('message' => 'Supplier berhasil disimpan'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan supplier'));
        }
    }




    public function saveFileShared()
    {


        // Konfigurasi upload file
        $config['upload_path'] = './fileshared';
        $config['allowed_types'] = '*'; // Bisa diatur sesuai kebutuhan
        $config['max_size'] = 2097152; // Maksimal ukuran file dalam KB (2 GB)
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            // Jika gagal upload, kirimkan pesan error
            echo json_encode(array('errorMsg' => $this->upload->display_errors('', '')));
            return;
        }

        // Ambil informasi file yang diunggah
        $uploadData = $this->upload->data();

        // Data yang akan disimpan ke database
        $data = array(
            'level1'     => $this->input->post('level1', TRUE),
            'description'     => $this->input->post('description', TRUE),
            'name_file'  => $this->input->post('file_name', TRUE),
            'size'       => $this->input->post('size', TRUE),
            'type_file'  => $this->input->post('type_file', TRUE),
            'link'       => base_url('fileshared/' . $uploadData['file_name']), // URL lengkap
            'remark'     => $this->input->post('remark', TRUE),
            'upload_date' => date('Y-m-d H:i:s'),
        );

        // Insert data ke dalam database
        $result = $this->global_model->insert('file_shared', $data);

        // Respon operasi
        if ($result) {
            echo json_encode(array('message' => 'File berhasil diunggah dan disimpan.'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan file.'));
        }
    }

    public function saveFileShared_link()
    {



        // Data yang akan disimpan ke database
        $data = array(
            'level1'     => $this->input->post('level_1_link', TRUE),
            'description'     => $this->input->post('description_link', TRUE),
            'name_file'  => $this->input->post('name_file_link', TRUE),
            'type_file'  => $this->input->post('type_file_link', TRUE),
            'link'       => $this->input->post('link_link', TRUE),
            'remark'     => $this->input->post('remark_link', TRUE),
            'upload_date' => date('Y-m-d H:i:s'),
        );

        // Insert data ke dalam database
        $result = $this->global_model->insert('file_shared', $data);

        // Respon operasi
        if ($result) {
            echo json_encode(array('message' => 'File berhasil diunggah dan disimpan.'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan file.'));
        }
    }


    function getSubMenus2($id, $is_main)
    {
        $this->db->from('tbl_menus');
        $this->db->join('tbl_levels', 'tbl_menus._id=tbl_levels.id_menu');
        $this->db->where('is_aktif', 1);
        $this->db->where('tbl_levels.id_posisi', $id);
        $this->db->where('tbl_menus.is_main', $is_main);
        return $this->db->get();
    }

    function updateFileshare()
    {
        // Mendapatkan input dari form
        $id = $this->input->get('id', TRUE);
        $level1 = $this->input->post('level1', TRUE);
        $file_name = $this->input->post('file_name', TRUE);
        $file_size = $this->input->post('size', TRUE);
        $type_file = $this->input->post('type_file', TRUE);
        $link = $this->input->post('link', TRUE);
        $remark = $this->input->post('remark', TRUE);


        // Menyiapkan data untuk diupdate
        $data = array(
            'level1'    => $level1,
            'name_file'     => $file_name,
            'size'        => $file_size,
            'type_file'        => $type_file,
            'link'      => $link,
            'remark' => $remark,
            'upload_date'    => date('Y-m-d')
        );

        // Menentukan kondisi WHERE untuk mengupdate data berdasarkan ID supplier
        $where = array('id' => $id);

        // Melakukan update data di database
        $result = $this->global_model->update('file_shared', $data, $where);

        // Mengembalikan hasil operasi ke dalam bentuk JSON
        if ($result) {
            echo json_encode(array('message' => 'Update Supplier berhasil'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat mengupdate Supplier'));
        }
    }

    function deletefileShared()
    {
        // Mendapatkan ID supplier yang akan dihapus
        $id = $this->input->post('id', TRUE);

        // Melakukan penghapusan data supplier berdasarkan ID
        $result = $this->global_model->delete('file_shared', array('id' => $id));

        // Mengembalikan hasil operasi ke dalam bentuk JSON
        if ($result) {
            echo json_encode(array('message' => 'Supplier berhasil dihapus'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menghapus Supplier'));
        }
    }



    function updateSupplier()
    {
        // Mendapatkan input dari form
        $id_supplier = $this->input->get('id', TRUE); // Mengambil ID supplier yang akan diupdate
        $nama_supplier = $this->input->post('nama', TRUE);
        $PIC_name = $this->input->post('PIC_name', TRUE);
        $email = $this->input->post('email', TRUE);
        $phone = $this->input->post('phone', TRUE);
        $address = $this->input->post('address', TRUE);
        $bank_account = $this->input->post('bank_account', TRUE);
        $rek_bank = $this->input->post('rek_bank', TRUE);
        $tax = $this->input->post('tax', TRUE);
        $status = $this->input->post('status', TRUE);

        // Menyiapkan data untuk diupdate
        $data = array(
            'nama'         => $nama_supplier,
            'PIC_name'     => $PIC_name,
            'email'        => $email,
            'phone'        => $phone,
            'address'      => $address,
            'bank_account' => $bank_account,
            'rek_bank'     => $rek_bank,
            'tax'          => $tax,
            'status'       => $status,
            'update_at'    => date('Y-m-d H:i:s') // Menambahkan timestamp untuk update_at
        );

        // Menentukan kondisi WHERE untuk mengupdate data berdasarkan ID supplier
        $where = array('id' => $id_supplier);

        // Melakukan update data di database
        $result = $this->global_model->update('tbl_supplier', $data, $where);

        // Mengembalikan hasil operasi ke dalam bentuk JSON
        if ($result) {
            echo json_encode(array('message' => 'Update Supplier berhasil'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat mengupdate Supplier'));
        }
    }





    public function stock_details($id)
    {
        $data['title']  = 'Items Managements';
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
        $this->template->load('template', 'warehouse/items-management-details', $data);
    }

    public function serials($id, $from, $id_from)
    {
        $data['title']  = 'Serial Number';
        $data['collapsed'] = '';

        // Mengirimkan id ke view
        $data['item_id'] = $id;
        $data['from'] = $from;
        $data['id_from'] = $id_from;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'warehouse/items-management-serials', $data);
    }



    public function getstock_details($id)
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getStockdetails($id); // Mengirimkan id ke model
        echo json_encode($stock);
    }


    public function setitem($id)
    {
        $data['title']  = 'Set Item 1';
        $data['collapsed'] = '';

        // Mengirimkan id ke view
        $data['id_barang'] = $id;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'warehouse/items-management-set', $data);
    }

    public function setitem2()
    {
        $data['title']  = 'Set Item 2';
        $data['collapsed'] = '';

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'warehouse/items-management-set2', $data);
    }

    public function getsetitem($id)
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getSetItem($id); // Mengirimkan id ke model
        echo json_encode($stock);
    }

    public function getsetitem2()
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getSetItem2(); // Mengirimkan id ke model
        echo json_encode($stock);
    }


    function saveItemSet()
    {
        // Mengambil input dari form
        $kode_barang        = $this->input->post('item_id', TRUE);
        $category           = $this->input->post('name', TRUE);
        $inisial_kuantitas  = $this->input->post('qty', TRUE);
        $level_1            = $this->input->post('status', TRUE);
        $level_2            = $this->input->post('remark', TRUE);


        echo json_encode(array('message' => 'Teset'));

        // Validasi input (jika diperlukan)
        if (empty($kode_barang) || empty($category) || empty($level_1)) {
            echo json_encode(array('errorMsg' => 'Pastikan semua field yang diperlukan telah terisi.'));
            return;
        }

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/foto-items-set';  // Direktori upload
        $config['allowed_types'] = 'jpg|jpeg|png';  // Tipe file yang diizinkan
        $config['max_size'] = 200;  // Batas ukuran file dalam KB

        // Menggunakan kode_barang sebagai nama file
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);  // Mendapatkan ekstensi file
        $config['file_name'] = $kode_barang . '.' . $ext;  // Nama file sesuai dengan kode_barang

        $this->load->library('upload', $config);

        // Variabel untuk menyimpan nama dan path file
        $file_name = null;
        $file_path = null;

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['foto']['name'])) {  // Hanya upload jika ada file foto
            if ($this->upload->do_upload('foto')) {
                $uploadData = $this->upload->data();
                $file_name = $uploadData['file_name'];  // Mendapatkan nama file yang di-upload
                $file_path = base_url('uploads/foto-items-set/') . $file_name;  // Path relatif file yang di-upload
            } else {
                // Jika ada file namun gagal upload, tampilkan pesan error
                $error = $this->upload->display_errors();
                echo json_encode(array('errorMsg' => 'Upload gagal: ' . $error));
                return;
            }
        }

        // Data yang akan disimpan ke database
        $data = array(
            'item_id'       => $kode_barang,
            'name'          => $category,
            'qty' => $inisial_kuantitas,
            'status'           => $level_1,
            'remark'           => $level_2,
        );

        // Hanya tambahkan path_foto jika ada file yang berhasil diupload
        if ($file_path) {
            $data['doc'] = $file_path;
        }

        // Simpan ke database
        $result = $this->global_model->insert('wh_item_set', $data);

        // Cek hasil penyimpanan
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan data.'));
        }
    }





    //wh distribution

    function distribution()
    {
        $data['title']  = 'Distributions Managements';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'warehouse/wh-distribution', $data);
    }

    function getdistribution()
    {
        $this->output->set_content_type('application/json');
        $stock = $this->backend_model->getDistribution();
        echo json_encode($stock);
    }






    //list posisi//
    function posisi()
    {
        $data['title']  = 'Data Posisi';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'master/posisi', $data);
    }


    function getPosisi()
    {
        $this->output->set_content_type('application/json');
        $posisi = $this->backend_model->getPosisi();
        echo json_encode($posisi);
    }



    function savePosisi()
    {
        $posisi = $this->input->post('posisi', TRUE);
        $data = array();
        $data = array(
            'posisi'         => $posisi
        );
        $result = $this->global_model->insert('tbl_posisi', $data);
        if ($result) {
            echo json_encode(array('message' => 'Save Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }

    function saveSerial()
    {
        $item_id = $this->input->post('item_id', TRUE);
        $serial = $this->input->post('serial', TRUE);
        $loc = $this->input->post('loc', TRUE);
        $loc_id = $this->input->post('loc_id', TRUE);
        $remark = $this->input->post('serial_remark', TRUE);

        // 🔹 1. Cek duplicate serial
        $dup = $this->db->get_where('wh_item_serials', [
            'item_id' => $item_id,
            'serial'  => $serial,
            'loc'     => $loc,
            'loc_id'  => $loc_id
        ])->num_rows();

        if ($dup > 0) {
            echo json_encode(['errorMsg' => 'Serial ini sudah pernah digunakan!']);
            return;
        }

        // 🔹 2. Hitung total serial saat ini
        $total_serials = $this->db->where([
            'item_id' => $item_id,
            'loc'     => $loc,
            'loc_id'  => $loc_id
        ])->count_all_results('wh_item_serials');

        // 🔹 3. Hitung stok dari wh_items_stock
        if ($loc == 1) { // warehouse
            $total_stock = $this->db->where([
                'item_id'      => $item_id,
                'warehouse_id' => $loc_id
            ])->count_all_results('wh_items_stock');
        } else { // employee
            $total_stock = $this->db->where([
                'item_id'     => $item_id,
                'employee_id' => $loc_id
            ])->count_all_results('wh_items_stock');
        }

        // 🔹 4. Validasi stok
        if ($total_serials >= $total_stock) {
            echo json_encode(['errorMsg' => 'Jumlah serial sudah melebihi atau sama dengan stok!']);
            return;
        }

        // 🔹 5. Simpan data
        $data = [
            'item_id'       => $item_id,
            'serial'        => $serial,
            'loc'           => $loc,
            'loc_id'        => $loc_id,
            'remark'        => $remark
        ];

        $result = $this->global_model->insert('wh_item_serials', $data);
        if ($result) {
            echo json_encode(['message' => 'Save Success']);
        } else {
            echo json_encode(['errorMsg' => 'Some errors occured.']);
        }
    }






    function updatePosisi()
    {
        $posisi = $this->input->post('posisi', TRUE);
        $data = array();
        $data = array(
            'posisi'         => $posisi
        );
        $where = array('_id' => $this->input->get('id'));
        $result = $this->global_model->update('tbl_posisi', $data, $where);
        if ($result) {
            echo json_encode(array('message' => 'Update Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }




    function destroyPosisi()
    {
        $id = $this->input->post('id');
        $result = $this->global_model->delete('tbl_posisi', array('_id' => $id));
        if ($result) {
            echo json_encode(array('message' => 'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg' => 'Some errors occured.'));
        }
    }
    //end posisi//
    //end modul user//




    //Directory

    function directory()
    {
        $data['title']  = 'Achivon Prestasi Abadi';
        $data['sidebar']  = 'sidebar_dr2';
        $data['collapsed'] = '';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        // $data['js_files'][] = base_url() . 'assets/admin/js/menu.js';
        $data['content'] = 'test';
        $this->template->load('template', 'dashboard', $data);
    }

    public function download_bulk_files()
    {
        $ids = $this->input->post('ids'); // array of selected IDs
        if (!$ids || !is_array($ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No files selected.']);
            return;
        }

        $this->load->library('zip');
        $this->load->helper('file');

        // Contoh query ambil data file berdasarkan ID
        $files = $this->db->where_in('id', $ids)->get('tree_file')->result();

        foreach ($files as $file) {
            $file_path = FCPATH . 'dr_files/' . $file->name_file; // sesuaikan direktori
            if (file_exists($file_path)) {
                $this->zip->read_file($file_path);
            }
        }

        $zip_name = 'files_' . time() . '.zip';
        $zip_path = FCPATH . 'downloads/' . $zip_name;

        $this->zip->archive($zip_path);

        echo json_encode([
            'status' => 'ok',
            'download_url' => base_url('downloads/' . $zip_name)
        ]);
    }

    public function dr_tree($id_table, $name = null)

    {

        $row = $this->backend_model->get_name_directory($id_table);

        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';

        // Mengirimkan id ke view

        $data['lv1_id'] = $id_table;
        $data['table1'] = 'Default';
        $data['table2'] = 'Default';
        $data['dr_name'] = $row ? $row->name : 'Directory Management';
        $data['sidebar']  = 'sidebar_dr2';


        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_tree', $data);
    }


    public function get_dr_tree($id)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_tree($id); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_file_tree($id_tree)
    {
        $this->output->set_content_type('application/json');
        $this->load->model('backend_model');
        $data = $this->backend_model->get_dr_file_tree($id_tree);
        echo json_encode($data);
    }



    function holv1($depart)
    {
        $data['title']  = 'Directory';
        $data['collapsed'] = '';
        $data['depart'] = $depart;
        $data['sidebar']  = 'sidebar_dr';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';
        $this->template->load('template', 'directory/ho-lv1', $data);
    }

    function getholv1($depart)
    {
        $this->output->set_content_type('application/json');
        $params = $this->backend_model->getholv1($depart);
        echo json_encode($params);
    }


    public function dr_lv2($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';

        // Mengirimkan id ke view

        $data['lv1_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;
        $data['sidebar']  = 'sidebar_dr';


        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv2', $data);
    }



    public function get_dr_lv2($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv2($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv2_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv2_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }



    public function dr_lv3($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';

        // Mengirimkan id ke view
        $data['lv2_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;
        $data['sidebar']  = 'sidebar_dr';

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv3', $data);
    }



    public function get_dr_lv3($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv3($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv3_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv3_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }




    public function dr_lv4($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv3_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv4', $data);
    }



    public function get_dr_lv4($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv4($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv4_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv4_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }



    public function dr_lv5($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv4_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv5', $data);
    }



    public function get_dr_lv5($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv5($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv5_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv5_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }




    public function dr_lv6($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv5_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv6', $data);
    }



    public function get_dr_lv6($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv6($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv6_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv6_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }



    public function dr_lv7($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv6_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv7', $data);
    }



    public function get_dr_lv7($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv7($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv7_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv7_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function dr_lv8($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv7_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv8', $data);
    }



    public function get_dr_lv8($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv8($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv8_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv8_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }


    public function dr_lv9($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv8_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv9', $data);
    }



    public function get_dr_lv9($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv9($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv9_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv9_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }



    public function dr_lv10($id, $table1, $table2, $dr_name)
    {
        $data['title']  = 'Directory';
        $data['title_file']  = 'File';
        $data['collapsed'] = '';
        $data['sidebar']  = 'sidebar_dr';

        // Mengirimkan id ke view
        $data['lv9_id'] = $id;
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['dr_name'] = $dr_name;

        // Menambahkan CSS dan JS Files
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/material/easyui.css';
        $data['css_files'][] = base_url() . 'assets/admin/easyui/themes/icon.css';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/jquery.easyui.min.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/datagrid-groupview.js';
        $data['js_files'][] = base_url() . 'assets/admin/easyui/plugins/datagrid-scrollview.js';

        // Memuat view dan mengirimkan data
        $this->template->load('template', 'directory/dr_lv10', $data);
    }



    public function get_dr_lv10($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv10($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }

    public function get_dr_lv10_file($id, $table1, $table2)
    {
        $this->output->set_content_type('application/json');
        $rows = $this->backend_model->get_dr_lv10_file($id, $table1, $table2); // Mengirimkan id ke model
        echo json_encode($rows);
    }


    public function check_access()
    {
        $id = $this->input->post('id');
        $table1 = $this->input->post('table1');
        $idUser = $this->input->post('idUser');

        // Cek di tabel dr_akses apakah user punya izin
        $this->db->where('table_name', $table1);
        $this->db->where('id_table', $id);
        $this->db->where('id_user', $idUser); // Pastikan user_id juga dicek
        $query = $this->db->get('dr_akses');

        if ($query->num_rows() > 0) {
            echo json_encode(['status' => 'granted']);
        } else {
            echo json_encode(['status' => 'denied']);
        }
    }





    public function saveDirectory()
    {
        $parent_id = $this->input->post('id_parent', TRUE);
        $name      = $this->input->post('name', TRUE);

        $parent = $this->db->get_where('sd_ho_tree', ['id' => $parent_id])->row();
        $level  = $parent ? $parent->level + 1 : 1;

        $data = array(
            'parent_id' => $parent_id,
            'name'      => $name,
            'level'     => $level
        );

        if ($this->db->insert('sd_ho_tree', $data)) {
            $new_id = $this->db->insert_id();
            $this->cache->file->clean();
            echo json_encode([
                'message' => 'Save Success',
                'id' => $new_id
            ]);
        } else {
            echo json_encode(['errorMsg' => 'Save failed, please try again.']);
        }
    }



    public function updatenamedirectory()
    {
        // Ambil data dari POST
        $name = $this->input->post('name', TRUE);
        $id = $this->input->get('id'); // Ambil ID dari GET

        // Validasi
        if (empty($id)) {
            echo json_encode(array('errorMsg' => 'ID untuk update tidak ditemukan.'));
            return;
        }
        if (empty($name)) {
            echo json_encode(array('errorMsg' => 'Nama direktori tidak boleh kosong.'));
            return;
        }

        $data = array(
            'name' => $name,
        );

        $where = array('id' => $id);

        // Update langsung ke sd_ho_tree
        $result = $this->global_model->update('sd_ho_tree', $data, $where);

        if ($result) {
            $this->cache->file->clean(); // Bersihkan cache jika ada
            echo json_encode(array('message' => 'Update Success'));
        } else {
            log_message('error', 'Gagal update sd_ho_tree: ' . json_encode($where));
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat mengupdate data.'));
        }
    }

    public function move_directory()
    {
        $this->cache->file->clean();
        $ids = $this->input->post('move_ids');
        $target_parent_id = $this->input->post('target_tree');

        if (!$ids || !$target_parent_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            return;
        }

        // jika dikirim JSON string, decode dulu
        if (!is_array($ids)) {
            $ids = json_decode($ids, true);
        }

        if (!is_array($ids) || empty($ids)) {
            echo json_encode(['success' => false, 'message' => 'Invalid IDs.']);
            return;
        }

        $this->load->model('backend_model');

        $moved = 0;
        foreach ($ids as $id) {
            // validasi circular move
            if ($this->backend_model->is_descendant($target_parent_id, $id)) {
                continue; // skip yang invalid
            }
            if ($this->backend_model->move_directory($id, $target_parent_id)) {
                $moved++;
            }
        }

        echo json_encode([
            'success' => $moved > 0,
            'message' => $moved > 0
                ? "$moved directory(s) moved successfully."
                : "Failed to move directory."
        ]);
    }



    public function move_file()
    {
        $ids = $this->input->post('ids');
        $target_tree = $this->input->post('target_tree');

        if (!$ids || !$target_tree) {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            return;
        }

        $id_array = explode(',', $ids);
        $this->load->model('backend_model');

        $success = $this->backend_model->move_files_to_directory($id_array, $target_tree);

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'File(s) moved successfully.' : 'Failed to move files.'
        ]);
    }



    public function get_tree_for_combotree($id_parent = null)
    {
        if ($id_parent === null) {
            $this->db->where('level', 0);
        } else {
            $this->db->where('parent_id', $id_parent);
        }

        $query = $this->db->get('sd_ho_tree');
        $results = [];

        foreach ($query->result() as $row) {
            // Cek apakah ada anak
            $has_child = $this->db->where('parent_id', $row->id)
                ->from('sd_ho_tree')
                ->count_all_results() > 0;

            $results[] = [
                'id' => $row->id,
                'text' => $row->name,
                'state' => $has_child ? 'closed' : 'open'
            ];
        }

        echo json_encode($results);
    }

    //     public function get_tree_for_combotree($id_parent = null)
    // {
    //     // Buat key unik untuk cache berdasarkan parent ID
    //     $cache_key = 'tree_cache_' . ($id_parent ?? 'root');

    //     // Coba ambil dari cache dulu
    //     $this->load->driver('cache');
    //     if ($cached = $this->cache->file->get($cache_key)) {
    //         echo $cached;
    //         return;
    //     }

    //     // Ambil dari database jika tidak ada cache
    //     if ($id_parent === null) {
    //         $this->db->where('level', 0);
    //     } else {
    //         $this->db->where('parent_id', $id_parent);
    //     }

    //     $query = $this->db->get('sd_ho_tree');
    //     $results = [];

    //     foreach ($query->result() as $row) {
    //         $has_child = $this->db->where('parent_id', $row->id)
    //             ->from('sd_ho_tree')
    //             ->count_all_results() > 0;

    //         $results[] = [
    //             'id' => $row->id,
    //             'text' => $row->name,
    //             'state' => $has_child ? 'closed' : 'open'
    //         ];
    //     }

    //     $json_result = json_encode($results);

    //     // Simpan ke cache selama 10 menit (600 detik)
    //     $this->cache->file->save($cache_key, $json_result, 600);

    //     echo $json_result;
    // }










    public function saveDrFile()
    {
        $this->cache->file->clean();

        // Konfigurasi upload file
        $config['upload_path'] = './dr_files';
        $config['allowed_types'] = '*'; // Bisa diatur sesuai kebutuhan
        $config['max_size'] = 2097152; // Maksimal ukuran file dalam KB (2 GB)

        // Ambil nama file asli
        $original_name = $_FILES['file']['name'];

        // Ganti karakter yang bermasalah agar aman (spasi, &, #, ?, %, dan karakter aneh lainnya)
        // Bisa juga pakai versi yang lebih bersih:
        // $clean_name = preg_replace('/[^A-Za-z0-9_\.-]/', '_', $original_name);
        $clean_name = str_replace(
            [' ', '&', '#', '?', '%', '+', '!', ':', '*', '/', '\\', '"', "'", '<', '>', '|'],
            ['_', 'and', '', '', '', 'plus', '', '', '', '', '', '', '', '', ''],
            $original_name
        );

        $timestamp = date('YmdHis') . rand(1000, 9999); // Waktu upload dalam format YYYYMMDDHHmmss

        // Buat nama file baru: [currentdatetime]_[originalfilename]
        $new_file_name = $timestamp . '_' . $clean_name;

        // Tambahkan nama file ke konfigurasi upload
        $config['file_name'] = $new_file_name;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            // Jika gagal upload, kirimkan pesan error
            echo json_encode(array('errorMsg' => $this->upload->display_errors('', '')));
            return;
        }

        // Ambil informasi file yang diunggah
        $uploadData = $this->upload->data();

        // Data yang akan disimpan ke database
        $data = array(
            'id_tree'      => $this->input->post('parent_id', TRUE),
            'id_user'      => $this->input->post('id_user', TRUE),
            'subject'      => $this->input->post('subject', TRUE),
            'name_file'    => $new_file_name, // Simpan nama file baru
            'upload_date'  => date('Y-m-d H:i:s'),
            'size'         => $uploadData['file_size'],
            'type_file'    => $this->input->post('type_file', TRUE),
            'link'         => base_url('dr_files/' . urlencode($new_file_name)), // URL aman
            'remark'       => $this->input->post('remark', TRUE),
        );

        // Insert data ke dalam database
        $result = $this->global_model->insert('tree_file', $data);

        // Respon operasi
        if ($result) {
            echo json_encode(array('message' => 'File berhasil diunggah dan disimpan.'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan file.'));
        }
    }


    public function saveDrFileMulti()
    {
        $this->cache->file->clean();
        $config['upload_path'] = './dr_files';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2097152; // 2GB dalam KB

        $this->load->library('upload');
        $files = $_FILES;

        $file_count = count($_FILES['multi_files']['name']);
        $results = [];
        $errors = [];

        for ($i = 0; $i < $file_count; $i++) {
            if (empty($files['multi_files']['name'][$i])) continue;

            $_FILES['file']['name']     = $files['multi_files']['name'][$i];
            $_FILES['file']['type']     = $files['multi_files']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['multi_files']['tmp_name'][$i];
            $_FILES['file']['error']    = $files['multi_files']['error'][$i];
            $_FILES['file']['size']     = $files['multi_files']['size'][$i];

            // Bersihkan nama file dari karakter berbahaya
            $original_name = $_FILES['file']['name'];
            $clean_name = str_replace(
                [' ', '&', '#', '?', '%', '+', '!', ':', '*', '/', '\\', '"', "'", '<', '>', '|'],
                ['_', 'and', '', '', '', 'plus', '', '', '', '', '', '', '', '', ''],
                $original_name
            );

            // Alternatif yang lebih agresif jika diperlukan:
            // $clean_name = preg_replace('/[^A-Za-z0-9_\.-]/', '_', $original_name);

            $timestamp = date('YmdHis') . rand(1000, 9999);
            $new_file_name = $timestamp . '_' . $clean_name;

            $config['file_name'] = $new_file_name;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $errors[] = [
                    'file' => $original_name,
                    'error' => $this->upload->display_errors('', '')
                ];
                continue;
            }

            $uploadData = $this->upload->data();

            // Tentukan tipe file dari ekstensi
            $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            $type_file = 'Other';
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $type_file = 'Image';
            } elseif ($extension === 'pdf') {
                $type_file = 'PDF';
            } elseif (in_array($extension, ['doc', 'docx'])) {
                $type_file = 'Word';
            } elseif (in_array($extension, ['xls', 'xlsx'])) {
                $type_file = 'Excel';
            } elseif (in_array($extension, ['dwg', 'dxf'])) {
                $type_file = 'AutoCAD';
            }

            $data = [
                'id_tree'     => $this->input->post('parent_id_multi', TRUE),
                'id_user'     => $this->input->post('id_user_multi', TRUE),
                'subject'     => $this->input->post('subject_multi', TRUE),
                'name_file'   => $new_file_name,
                'upload_date' => date('Y-m-d H:i:s'),
                'size'        => $uploadData['file_size'],
                'type_file'   => $type_file,
                'link'        => base_url('dr_files/' . urlencode($new_file_name)),
                'remark'      => $this->input->post('remark_multi', TRUE),
            ];

            $inserted = $this->global_model->insert('tree_file', $data);
            if ($inserted) {
                $results[] = $new_file_name;
            } else {
                $errors[] = [
                    'file' => $original_name,
                    'error' => 'Database insert failed.'
                ];
            }
        }

        if (!empty($errors)) {
            echo json_encode(['errorMsg' => 'Beberapa file gagal diupload.', 'errors' => $errors]);
        } else {
            echo json_encode(['message' => count($results) . ' file berhasil diupload.']);
        }
    }

    public function move_file_to_tree()
    {
        $file_ids = $this->input->post('file_ids'); // array
        $target_tree = $this->input->post('target_tree');

        if (empty($file_ids) || !$target_tree) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }

        foreach ($file_ids as $id) {
            $this->db->where('id', $id)
                ->update('tree_file', ['id_tree' => $target_tree]);
        }

        echo json_encode(['success' => true, 'message' => 'Files moved!']);
    }






    public function log_and_serve_file($file_id)
    {
        // 1. Ambil action_type dari query string
        $action_type = $this->input->get('action', TRUE);

        // Validasi parameter URL
        if (empty($file_id) || !in_array($action_type, ['download', 'view'])) {
            show_404();
            return;
        }

        // 2. Ambil informasi file dari database berdasarkan $file_id
        // PASTIKAN 'dr_file' ADALAH NAMA TABEL YANG BENAR DI DATABASE ANDA
        // DAN 'id' ADALAH NAMA KOLOM ID YANG BENAR DI TABEL TERSEBUT
        $file_info = $this->global_model->get_by_id('tree_file', ['id' => $file_id]); // <-- PERUBAHAN DI SINI

        if (!$file_info) {
            // File tidak ditemukan di database
            log_message('error', 'File ID not found in database: ' . $file_id . '. Check table name and ID column in DB.');
            show_404();
            return;
        }

        $full_file_name = $file_info->name_file; // Pastikan kolom ini ada di tabel Anda
        $file_path = FCPATH . 'dr_files/' . $full_file_name;

        // Periksa apakah file fisik benar-benar ada di server
        if (!file_exists($file_path)) {
            log_message('error', 'Physical file not found on disk: ' . $file_path . '. Check file name case, path, and permissions.');
            show_404();
            return;
        }

        // 3. Catat log akses ke tabel file_access_log
        $user_id = null; // Inisialisasi awal, akan diganti jika user login

        // Pastikan pengguna sudah login sebelum melanjutkan
        if ($this->session->userdata('_id')) {
            $user_id = $this->session->userdata('_id'); // Ambil ID pengguna dari sesi

            // --- PENTING: Validasi user_id ---
            // Jika user_id dari sesi ternyata kosong/null padahal logged_in,
            // ini mungkin masalah konfigurasi sesi atau data user yang hilang.
            // Anda bisa menangani ini sebagai error juga.
            if (empty($user_id)) {
                log_message('error', 'Pengguna teridentifikasi login, tetapi user_id (_id) kosong di sesi. Menghentikan akses file.');
                show_error('Akses ditolak: Informasi pengguna tidak lengkap.', 403); // Tampilkan error 403 Forbidden
                return;
            }
        } else {
            // Jika pengguna TIDAK login, Anda punya dua pilihan:

            // PILIHAN 1: Redirect ke halaman login
            // Direkomendasikan jika semua akses file membutuhkan login
            // log_message('error', 'Akses file ditolak: Pengguna belum login.');
            // redirect('auth/login'); // Ganti 'auth/login' dengan URL halaman login Anda
            // return; // Hentikan eksekusi setelah redirect

            // PILIHAN 2: Tampilkan pesan error dan hentikan akses
            log_message('error', 'Akses file ditolak: Pengguna belum login.');
            show_error('Akses ditolak: Anda harus login untuk melihat atau mengunduh file ini.', 403); // Tampilkan error 403 Forbidden
            return; // Hentikan eksekusi
        }

        $log_data = array(
            'file_id'          => $file_id,
            'user_id'          => $user_id,
            'action_type'      => $action_type,
            'access_timestamp' => date('Y-m-d H:i:s'),
            'ip_address'       => $this->input->ip_address(),
            'user_agent'       => $this->input->user_agent()
        );
        $this->db->insert('file_access_log', $log_data);

        // 4. Kirimkan (Serve) file ke browser pengguna
        $mime_type = get_mime_by_extension($full_file_name);
        if (!$mime_type) {
            $mime_type = 'application/octet-stream';
        }

        if ($action_type === 'download') {
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . basename($full_file_name) . '"');
        } else { // 'view'
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: inline; filename="' . basename($full_file_name) . '"');
        }

        header('Content-Length: ' . filesize($file_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        readfile($file_path);
        exit();
    }




    public function saveDr_link()
    {
        // Data yang akan disimpan ke database
        $data = array(
            'id_user'   => $this->input->post('id_user_link', TRUE),
            'subject'   => $this->input->post('subject_link', TRUE),
            'name_file'  => $this->input->post('name_file_link', TRUE),
            'upload_date' => date('Y-m-d H:i:s'), // Tambahkan kolom upload_date
            'type_file'  => $this->input->post('type_file_link', TRUE),
            'link'       => $this->input->post('link_link', TRUE),
            'remark'     => $this->input->post('remark_link', TRUE),
            'table_name' => $this->input->post('table1_link', TRUE),
            'id_table'  => $this->input->post('id_table_link', TRUE),
        );

        // Insert data ke dalam database
        $result = $this->global_model->insert('dr_file', $data);

        // Respon operasi
        if ($result) {
            $this->cache->file->clean();
            echo json_encode(array('message' => 'File berhasil diunggah dan disimpan.'));
        } else {
            echo json_encode(array('errorMsg' => 'Terjadi kesalahan saat menyimpan file.'));
        }
    }

    public function rename_file_action()
    {
        if ($this->input->method() !== 'post') {
            echo json_encode(array('errorMsg' => 'Invalid request method.'));
            return;
        }

        $id_dr = $this->input->post('id_dr', TRUE);
        $old_full_file_name = $this->input->post('old_full_file_name', TRUE);
        $new_display_name = $this->input->post('new_display_name', TRUE); // Nama baru tanpa timestamp

        if (empty($id_dr) || empty($old_full_file_name) || empty($new_display_name)) {
            echo json_encode(array('errorMsg' => 'Parameter yang dibutuhkan tidak lengkap.'));
            return;
        }

        // ==============================
        // Dukung dua jenis panjang prefix: 14 dan 18
        // ==============================

        $separator_char = '_';
        $prefix_length = 0;
        $timestamp_prefix = '';

        $possible_prefix_lengths = [14, 18];
        $found = false;

        foreach ($possible_prefix_lengths as $len) {
            if (strlen($old_full_file_name) >= ($len + 1) && substr($old_full_file_name, $len, 1) === $separator_char) {
                $prefix_length = $len + 1;
                $timestamp_prefix = substr($old_full_file_name, 0, $prefix_length);
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo json_encode(array('errorMsg' => 'Format nama file lama tidak sesuai (prefix tidak dikenali).'));
            log_message('error', 'Rename File: Format nama file tidak valid untuk ID ' . $id_dr . ': ' . $old_full_file_name);
            return;
        }

        // ==============================
        // Ganti karakter terlarang di nama baru
        // ==============================

        // Karakter ilegal untuk nama file: \ / : * ? " < > | dan spasi yang tidak diinginkan
        $new_display_name = str_replace(
            ['\\', '/', ':', '*', '?', '"', '<', '>', '|', '&', '#', '%', '+', ' '],
            ['_', '_', '_', '_', '_', '', '', '', '', 'and', '', '', '_'],
            $new_display_name
        );

        // ==============================
        // Ambil ekstensi dan pastikan valid
        // ==============================

        $old_file_extension = pathinfo($old_full_file_name, PATHINFO_EXTENSION);
        if (empty($old_file_extension)) {
            echo json_encode(array('errorMsg' => 'Tidak dapat menemukan ekstensi file lama.'));
            return;
        }

        $new_display_name_without_ext = pathinfo($new_display_name, PATHINFO_FILENAME);
        $new_full_file_name = $timestamp_prefix . $new_display_name_without_ext . '.' . $old_file_extension;

        $upload_dir = FCPATH . 'dr_files/';
        $old_file_path = $upload_dir . $old_full_file_name;
        $new_file_path = $upload_dir . $new_full_file_name;

        if (!file_exists($old_file_path)) {
            echo json_encode(array('errorMsg' => 'File lama tidak ditemukan: ' . $old_file_path));
            log_message('error', 'Rename File: File lama tidak ditemukan pada path: ' . $old_file_path);
            return;
        }

        if (!rename($old_file_path, $new_file_path)) {
            log_message('error', 'Rename File: Gagal rename dari ' . $old_file_path . ' ke ' . $new_file_path . ' Error: ' . error_get_last()['message']);
            echo json_encode(array('errorMsg' => 'Gagal mengubah nama file di server. Cek izin folder.'));
            return;
        }

        $this->load->model('global_model');
        $data_to_update = array(
            'name_file' => $new_full_file_name,
            'link'      => base_url('dr_files/' . $new_full_file_name)
        );
        $where = array('id' => $id_dr);

        $db_update_result = $this->global_model->update('tree_file', $data_to_update, $where);

        if ($db_update_result) {
            $this->cache->file->clean();
            echo json_encode(array('message' => 'Nama file berhasil diubah.'));
        } else {
            log_message('error', 'Rename File: DB gagal update meskipun file fisik berhasil untuk ID ' . $id_dr);
            echo json_encode(array('errorMsg' => 'File berhasil di-rename, tapi update database gagal.'));
        }
    }



    public function destroydirectory()
    {
        $ids = $this->input->post('ids'); // bisa array

        if (empty($ids)) {
            echo json_encode(['success' => false, 'message' => 'No IDs provided.']);
            return;
        }

        if (!is_array($ids)) {
            $ids = [$ids]; // kalau ternyata cuma single id
        }

        $deleted = 0;
        foreach ($ids as $id) {
            if (is_numeric($id)) {
                $result = $this->backend_model->delete_data($id, 'sd_ho_tree');
                if ($result) {
                    $deleted++;
                }
            }
        }

        if ($deleted > 0) {
            $this->cache->file->clean();
            echo json_encode(['success' => true, 'message' => $deleted . ' folder(s) deleted.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data deleted.']);
        }
    }




    public function destroyfile()
    {
        $ids = $this->input->post('ids'); // Ambil array ID dari POST
        if (!is_array($ids) || empty($ids)) {
            echo json_encode(['success' => false, 'message' => $ids]);
            return;
        }

        $this->load->model('backend_model');

        $deletedCount = 0;

        foreach ($ids as $id) {
            if (!is_numeric($id)) continue;

            $file = $this->backend_model->get_file_by_id($id);
            if ($file) {
                $filePath = FCPATH . 'dr_files/' . $file->name_file;

                if (file_exists($filePath)) {
                    @unlink($filePath); // Hapus file dari server
                }

                $this->backend_model->delete_file($id);
                $deletedCount++;
            }
        }

        echo json_encode([
            'success' => true,
            'message' => "$deletedCount file(s) successfully deleted."
        ]);
    }
}
