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
        $page   = $this->input->post('page') ? intval($this->input->post('page')) : 1;
        $rows   = $this->input->post('rows') ? intval($this->input->post('rows')) : 20;
        $sort   = $this->input->post('sort') ?: 'tbl_user._id';
        $order  = $this->input->post('order') ?: 'ASC';
        $search = $this->input->post('search_data'); // konsisten pakai search_data
        $offset = ($page - 1) * $rows;

        $result = $this->backend_model->getUsers($rows, $offset, $sort, $order, $search);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function getMenus()
    {
        $segment = $this->input->post('segment') ?: '';
        $segment = preg_replace('/[^a-zA-Z0-9]+/', ' ', $segment);
        $segment = trim($segment);
        if (!$segment) {
            show_error("segment wajib dikirim", 400);
        }

        // === Ambil parent sesuai segment ===
        $this->db->select('_id,title');
        $this->db->from('tbl_menus');
        $this->db->where('is_main', 0);
        $this->db->like('title', $segment, 'both');
        $parentQuery = $this->db->get();
        $parents     = $parentQuery->result_array();

        if (empty($parents)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([]));
        }

        // recursive builder
        $buildTree = function ($parentId) use (&$buildTree) {
            $this->db->select('_id,title');
            $this->db->from('tbl_menus');
            $this->db->where('is_main', $parentId);
            $children = $this->db->get()->result_array();

            $result = [];
            foreach ($children as $child) {
                $result[] = [
                    "id"   => $child['_id'],
                    "text" => $child['title'],
                    "children" => $buildTree($child['_id'])
                ];
            }
            return $result;
        };

        $tree = [];
        foreach ($parents as $p) {
            $tree[] = [
                "id"   => $p['_id'],
                "text" => $p['title'],
                "children" => $buildTree($p['_id'])
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($tree));
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
