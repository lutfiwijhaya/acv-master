<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getMenus($id)
    {
    	// $query='SELECT * FROM tbl_menus WHERE is_main=0 AND is_aktif=1 ORDER BY `ordinal` ASC';
    	$query='SELECT * FROM tbl_menus WHERE _id in(SELECT id_menu FROM tbl_levels WHERE id_posisi='.$id.') AND is_main=0 AND is_aktif=1 ORDER BY `ordinal` ASC';
    	return $this->db->query($query);
    }

    function getSubMenus($id, $is_main)
{
    $this->db->select('tbl_menus._id AS menu_id, tbl_levels._id AS level_id, tbl_menus.*, tbl_levels.*');
    $this->db->from('tbl_menus');
    $this->db->join('tbl_levels', 'tbl_menus._id = tbl_levels.id_menu');
    $this->db->where('is_aktif', 1);
    $this->db->where('tbl_levels.id_posisi', $id);
    $this->db->where('tbl_menus.is_main', $is_main);
    return $this->db->get();
}


    function getSubMenus2($id, $is_main)
    {
    	$this->db->from('tbl_menus');
    	$this->db->join('tbl_levels','tbl_menus._id=tbl_levels.id_menu');
        $this->db->where('is_aktif',1);
    	$this->db->where('tbl_levels.id_posisi',$id);
    	$this->db->where('tbl_menus.is_main',$is_main);
    	return $this->db->get();
    }
}