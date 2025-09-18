<?php
class Explorer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Explorer_model');
    }


    public function get_tree()
    {
        header('Content-Type: application/json');
        $tree = $this->Explorer_model->get_tree_data();
        echo json_encode($tree);
    }
}
