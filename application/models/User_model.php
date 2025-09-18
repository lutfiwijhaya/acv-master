
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class User_model extends CI_Model {
	public function getUserById($user_id) {
		return $this->db->where('_id', $user_id)->get('tbl_user')->row();
	}

	public function updatePassword($user_id, $new_password) {
		$this->db->where('_id', $user_id)->update('tbl_user', ['password' => $new_password]);
	}
}
