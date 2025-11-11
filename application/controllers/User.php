<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Backend_model', 'backend_model');
    }

    public function set_default($user_id)
    {
        if ($this->User_model->setDefaultMenusFromLevel($user_id)) {
            echo "Akses menu user $user_id berhasil di-set default dari level.";
        } else {
            echo "User tidak ditemukan.";
        }
    }

    public function save()
    {
        $user_id  = $this->input->post('user_id');
        $menus_id = $this->input->post('menus_id'); // array

        if (empty($user_id)) {
            show_error("user_id wajib dikirim", 400);
        }

        $this->User_model->saveUserMenus($user_id, $menus_id);

        echo "Akses menu user $user_id berhasil diupdate.";
    }

    /**
     * Lihat semua menu yang dimiliki user
     * Contoh: /user_menu/list/123
     */
    public function list($user_id)
    {
        $menus = $this->User_model->getUserMenus($user_id);

        echo "<h3>Daftar Menu User $user_id</h3><ul>";
        foreach ($menus as $m) {
            echo "<li>Menu ID: {$m->menu_id} | Granted: {$m->is_granted}</li>";
        }
        echo "</ul>";
    }

    public function check($user_id, $menu_id)
    {
        if ($this->User_model->checkUserMenu($user_id, $menu_id)) {
            echo "User $user_id PUNYA akses ke menu $menu_id";
        } else {
            echo "User $user_id TIDAK punya akses ke menu $menu_id";
        }
    }

    public function getUsers()
    {
        $page = $this->input->post('page') ?? 1;
        $rows = $this->input->post('rows') ?? 10;
        $categoryId = $this->input->post('category_id');

        $offset = ($page - 1) * $rows;

        // total count
        $this->db->where('is_aktif', '1');
        $this->db->where('deleted', '0');
        $total = $this->db->count_all_results('tbl_user');

        // ambil user
        $this->db->select('u._id, u.nama, p.posisi, u.email');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_posisi p', 'u.posisi = p._id', 'left');
        $this->db->where('u.is_aktif', '1');
        $this->db->where('u.deleted', '0');
        $this->db->order_by('u.nama', 'ASC');
        $this->db->limit($rows, $offset);
        $users = $this->db->get()->result_array();

        // ambil akses user sesuai kategori (jika ada)
        $accessMap = [];
        if ($categoryId) {
            $this->db->select('um.id_user, um.id_menu, um.access_type');
            $this->db->from('tbl_user_menu um');
            $this->db->join('tbl_menus m', 'm._id = um.id_menu');
            $this->db->where('m.is_main', $categoryId);
            $access = $this->db->get()->result_array();

            foreach ($access as $a) {
                $accessMap[$a['id_user']][$a['id_menu']] = $a['access_type'];
            }
        }

        // inject access ke setiap user
        foreach ($users as &$u) {
            $u['access'] = $accessMap[$u['_id']] ?? [];
        }

        $result = [
            "total" => $total,
            "rows"  => $users
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }



   public function getMenus()
    {
        $segment = $this->input->post('segment') ?? 'root';

        // Ambil semua menu (jangan difilter langsung)
        $this->db->select('_id, title, is_main');
        $this->db->from('tbl_menus');
        $this->db->where('is_aktif', '1');
        $menus = $this->db->get()->result_array();

        // Ambil semua akses user_menu
        $this->db->select('id_user, id_menu, access_type');
        $this->db->from('tbl_user_menu');
        $allAccess = $this->db->get()->result_array();

        $accessMap = [];
        foreach ($allAccess as $acc) {
            $accessMap[$acc['id_menu']][$acc['id_user']] = $acc['access_type'];
        }

        // recursive build
        $buildTree = function($parentId) use ($menus, $accessMap, &$buildTree) {
            $result = [];
            foreach ($menus as $menu) {
                if ($menu['is_main'] == $parentId) {
                    $menuId = $menu['_id'];
                    $userAccess = $accessMap[$menuId] ?? [];
                    $result[] = [
                        "id" => $menuId,
                        "text" => $menu['title'],
                        "user_access" => $userAccess,
                        "children" => $buildTree($menuId)
                    ];
                }
            }
            return $result;
        };

        // === Beda behavior sesuai segment ===
        if ($segment === 'root') {
            // ambil semua parent utama
            $tree = $buildTree(0);
        } else {
            // ambil subtree dari segment tertentu
            $tree = $buildTree($segment);
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($tree));
    }


    public function toggleApproval() 
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        // Load model User jika belum
        $this->load->model('User_model');
        
        // Update is_approval
        $data = array(
            'is_approval' => $status
        );
        
        $this->db->where('_id', $id);
        $update = $this->db->update('tbl_user', $data);
        
        if ($update) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Status approval berhasil diupdate'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'errorMsg' => 'Gagal mengupdate status approval'
            ));
        }
    }



    public function getMenusAll()
    {
        // Ambil semua parent menu (is_main = 0)
        $this->db->select('_id, title');
        $this->db->from('tbl_menus');
        $this->db->where('is_main', 0);
        $parents = $this->db->get()->result_array();

        // Jika tidak ada parent
        if (empty($parents)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([]));
        }

        // Recursive builder
        $buildTree = function ($parentId) use (&$buildTree) {
            $this->db->select('_id, title');
            $this->db->from('tbl_menus');
            $this->db->where('is_main', $parentId);
            $children = $this->db->get()->result_array();

            $result = [];
            foreach ($children as $child) {
                $result[] = [
                    "id" => $child['_id'],
                    "text" => $child['title'],
                    "children" => $buildTree($child['_id'])
                ];
            }
            return $result;
        };

        // Build tree dari semua parent
        $tree = [];
        foreach ($parents as $p) {
            $tree[] = [
                "id" => $p['_id'],
                "text" => $p['title'],
                "children" => $buildTree($p['_id'])
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($tree));
    }

    public function saveAkses()
    {
        $user_ids = $this->input->post('user_ids'); // array
        $menus    = $this->input->post('menus');    // array

        if (empty($user_ids) || !is_array($user_ids)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'user_ids wajib dikirim sebagai array']));
        }

        // Simpan akses untuk setiap user
        foreach ($user_ids as $user_id) {
            $this->User_model->saveUserMenus($user_id, $menus);
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'success', 'message' => 'Akses berhasil disimpan']));
    }
}
