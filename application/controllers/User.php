<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
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
}
