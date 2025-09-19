<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function getUserById($user_id)
	{
		return $this->db->where('_id', $user_id)
			->get('tbl_user')
			->row();
	}

	public function updatePassword($user_id, $new_password)
	{
		$this->db->where('_id', $user_id)
			->update('tbl_user', ['password' => $new_password]);
	}

	public function getUserMenus($user_id)
	{
		return $this->db->where('user_id', $user_id)
			->get('tbl_user_menu')
			->result();
	}

	public function saveUserMenus($user_id, $menus_id = [])
	{
		$this->db->where('user_id', $user_id)
			->delete('tbl_user_menu');

		if (!empty($menus_id)) {
			foreach ($menus_id as $menu_id) {
				$this->db->insert('tbl_user_menu', [
					'user_id'    => $user_id,
					'menu_id'    => $menu_id,
					'is_granted' => '1'
				]);
			}
		}
		return true;
	}

	public function setDefaultMenusFromLevel($user_id)
	{
		$user = $this->getUserById($user_id);
		if (!$user) return false;

		// ambil menu default dari tbl_levels
		$menus = $this->db->select('id_menu')
			->where('id_posisi', $user->posisi)
			->get('tbl_levels')
			->result();

		$menus_id = array_map(function ($m) {
			return $m->id_menu;
		}, $menus);

		return $this->saveUserMenus($user_id, $menus_id);
	}

	public function checkUserMenu($user_id, $menu_id)
	{
		$exists = $this->db->where('user_id', $user_id)
			->where('menu_id', $menu_id)
			->where('is_granted', '1')
			->get('tbl_user_menu')
			->row();
		return $exists ? true : false;
	}
}
