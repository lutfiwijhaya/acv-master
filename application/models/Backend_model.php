<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backend_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->driver('cache');
    }

    function getIsMain()
    {
        $this->db->where('is_aktif', 1);
        $query = $this->db->get('tbl_menus')->result();
        return $query;
    }
    function getMenus()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_menus._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_menus.title', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('tbl_menus')->num_rows();

        //
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_menus.title', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('tbl_menus');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getUsers()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_user._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $this->db->select('tbl_user.*,tbl_posisi.posisi');
        $this->db->from('tbl_user');
        $this->db->join('tbl_posisi', 'tbl_user.posisi=tbl_posisi._id');
        $result['total'] = $this->db->get()->num_rows();
        $this->db->select('tbl_user.*,tbl_posisi.posisi');
        $this->db->from('tbl_user');
        $this->db->join('tbl_posisi', 'tbl_user.posisi=tbl_posisi._id');
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();
        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getIsLevel()
    {
        $query = $this->db->get('tbl_posisi')->result();
        return $query;
    }

    // codding kutfi


    //     function getStock()
    // {
    //     $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    //     $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
    //     $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_items.id';
    //     $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
    //     $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
    //     $offset = ($page-1)*$rows;
    //     $result = array();

    //     // Apply search filter if provided
    //     if(isset($_POST['search_data'])) {
    //         $this->db->group_start();
    //         $this->db->like('wh_items.level1',$search,'both');
    //         $this->db->group_end();
    //     }

    //     // Get the total number of records
    //     $result['total'] = $this->db->get('wh_items')->num_rows();

    //     // Apply search filter again for data retrieval
    //     if(isset($_POST['search_data'])) {
    //         $this->db->group_start();
    //         $this->db->like('wh_items.level1',$search,'both');
    //         $this->db->group_end();
    //     }

    //     // Retrieve the data with sorting and paging
    //     $this->db->order_by($sort,$order);
    //     $this->db->limit($rows,$offset);
    //     $query = $this->db->get('wh_items');

    //     // Fetch results and prepare the final result
    //     $item = $query->result_array();
    //     $result = array_merge($result, ['rows' => $item]);
    //     return $result;
    // }


    function getBank()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'accounting_bank.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Hitung total data dengan status = '0'
        // $this->db->where('status', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('accounting_voucher.name', $search, 'both');
            $this->db->or_like('accounting_voucher.name', $search, 'both');
            $this->db->or_like('accounting_voucher.account_bank', $search, 'both');
            $this->db->or_like('accounting_voucher.balance', $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->get('accounting_bank')->num_rows();

        // Query data dengan limit, order, dan status = '0'
        // $this->db->where('status', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('accounting_voucher.name', $search, 'both');
            $this->db->or_like('accounting_voucher.name', $search, 'both');
            $this->db->or_like('accounting_voucher.account_bank', $search, 'both');
            $this->db->or_like('accounting_voucher.balance', $search, 'both');
            $this->db->group_end();
        }

        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('accounting_bank');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }


    function getVoucher()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'accounting_voucher.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Hitung total data dengan status = '0'
        // $this->db->where('status', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('accounting_voucher.no_doc', $search, 'both');
            $this->db->or_like('accounting_voucher.account', $search, 'both');
            $this->db->or_like('accounting_voucher.incharge', $search, 'both');
            $this->db->or_like('accounting_voucher.date', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient_bank', $search, 'both');
            $this->db->or_like('accounting_voucher.bank_account', $search, 'both');
            $this->db->or_like('accounting_voucher.due_date', $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->get('accounting_voucher')->num_rows();

        // Query data dengan limit, order, dan status = '0'
        // $this->db->where('status', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('accounting_voucher.no_doc', $search, 'both');
            $this->db->or_like('accounting_voucher.account', $search, 'both');
            $this->db->or_like('accounting_voucher.incharge', $search, 'both');
            $this->db->or_like('accounting_voucher.date', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient_bank', $search, 'both');
            $this->db->or_like('accounting_voucher.bank_account', $search, 'both');
            $this->db->or_like('accounting_voucher.due_date', $search, 'both');
            $this->db->group_end();
        }

        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('accounting_voucher');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getVoucherApproval()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'accounting_voucher.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Hitung total data dengan status = '0'
        $this->db->where('status', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('accounting_voucher.no_doc', $search, 'both');
            $this->db->or_like('accounting_voucher.account', $search, 'both');
            $this->db->or_like('accounting_voucher.incharge', $search, 'both');
            $this->db->or_like('accounting_voucher.date', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient_bank', $search, 'both');
            $this->db->or_like('accounting_voucher.bank_account', $search, 'both');
            $this->db->or_like('accounting_voucher.due_date', $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->get('accounting_voucher')->num_rows();

        // Query data dengan limit, order, dan status = '0'
        $this->db->where('status', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('accounting_voucher.no_doc', $search, 'both');
            $this->db->or_like('accounting_voucher.account', $search, 'both');
            $this->db->or_like('accounting_voucher.incharge', $search, 'both');
            $this->db->or_like('accounting_voucher.date', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient', $search, 'both');
            $this->db->or_like('accounting_voucher.recipient_bank', $search, 'both');
            $this->db->or_like('accounting_voucher.bank_account', $search, 'both');
            $this->db->or_like('accounting_voucher.due_date', $search, 'both');
            $this->db->group_end();
        }

        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('accounting_voucher');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }



    public function get_detail_items_voucher($id)
    {
        $this->db->select('accounting_voucher_spec.*');
        $this->db->from('accounting_voucher_spec');
        $this->db->where('accounting_voucher_spec.voucher_id', $id);
        $query = $this->db->get(); // Menjalankan query
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }


    function getStock()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_items.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Query to get total number of rows
        $this->db->select('COUNT(DISTINCT wh_items.id) AS total');
        $this->db->from('wh_items');
        $this->db->join('wh_items_stock', 'wh_items.id = wh_items_stock.item_id', 'left');

        // Kondisi where untuk is_deleted = 0
        $this->db->where('wh_items.is_deleted', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('wh_items.Level_1', $search, 'both');
            $this->db->or_like('wh_items.level_2', $search, 'both');
            $this->db->or_like('wh_items.level_3', $search, 'both');
            $this->db->or_like('wh_items.level_4', $search, 'both');
            $this->db->or_like('wh_items.kode_barang', $search, 'both');
            $this->db->or_like('wh_items.remark', $search, 'both');
            $this->db->group_end();
        }

        $query = $this->db->get();
        $result['total'] = $query->row()->total;

        // Query to get the actual data
        $this->db->select('wh_items.id, wh_items.kode_barang, wh_items.category, wh_items.inisial_kuantitas, 
                       wh_items.Level_1, wh_items.level_2, wh_items.level_3, wh_items.level_4, wh_items.path_foto, wh_items.remark, 
                       SUM(wh_items_stock.quantity) AS total_quantity');
        $this->db->from('wh_items');
        $this->db->join('wh_items_stock', 'wh_items.id = wh_items_stock.item_id', 'left');

        // Kondisi where untuk is_deleted = 0
        $this->db->where('wh_items.is_deleted', '0');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('wh_items.Level_1', $search, 'both');
            $this->db->or_like('wh_items.level_2', $search, 'both');
            $this->db->or_like('wh_items.level_3', $search, 'both');
            $this->db->or_like('wh_items.level_4', $search, 'both');
            $this->db->or_like('wh_items.kode_barang', $search, 'both');
            $this->db->or_like('wh_items.remark', $search, 'both');
            $this->db->group_end();
        }

        $this->db->group_by('wh_items.id, wh_items.kode_barang, wh_items.category, wh_items.inisial_kuantitas, 
                        wh_items.Level_1, wh_items.level_2, wh_items.level_3, wh_items.level_4, wh_items.path_foto, wh_items.remark');
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $item = $query->result_array();
        $result['rows'] = $item;

        return $result;
    }

    function getStockwarehouse($idwarehouse)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_items.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $filter_qty = isset($_POST['filter_qty']) ? intval($_POST['filter_qty']) : 0;
        $offset = ($page - 1) * $rows;
        $result = array();

        // Query to get total number of items
        $this->db->select('COUNT(DISTINCT wh_items.id) AS total');
        $this->db->from('wh_items');
        $this->db->join('wh_items_stock', 'wh_items.id = wh_items_stock.item_id', 'left');
        $this->db->where('wh_items.is_deleted', '0');
        if ($filter_qty) {
            $this->db->where('wh_items_stock.warehouse_id', $idwarehouse);
            $this->db->where('wh_items_stock.quantity >', 0);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('wh_items.category', $search, 'both');
            $this->db->or_like('wh_items.level_1', $search, 'both');
            $this->db->or_like('wh_items.level_2', $search, 'both');
            $this->db->or_like('wh_items.level_3', $search, 'both');
            $this->db->or_like('wh_items.level_4', $search, 'both');
            $this->db->or_like('wh_items.kode_barang', $search, 'both');
            $this->db->or_like('wh_items.remark', $search, 'both');
            $this->db->group_end();
        }

        $query = $this->db->get();
        $result['total'] = $query->row()->total;

        // Query to get actual item data with warehouse-specific quantity
        $this->db->select("
        wh_items.id,
        wh_items.kode_barang,
        wh_items.category,
        wh_items.inisial_kuantitas,
        wh_items.Level_1,
        wh_items.level_2,
        wh_items.level_3,
        wh_items.level_4,
        wh_items.path_foto,
        wh_items.remark,
        COALESCE(SUM(CASE WHEN wh_items_stock.warehouse_id = {$idwarehouse} THEN wh_items_stock.quantity ELSE 0 END), 0) AS total_quantity
    ", false); // false agar tidak di-escape otomatis

        $this->db->from('wh_items');
        $this->db->join('wh_items_stock', 'wh_items.id = wh_items_stock.item_id', 'left');
        $this->db->where('wh_items.is_deleted', '0');
        if ($filter_qty) {
            $this->db->where('wh_items_stock.warehouse_id', $idwarehouse);
            $this->db->where('wh_items_stock.quantity >', 0);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('wh_items.category', $search, 'both');
            $this->db->or_like('wh_items.level_1', $search, 'both');
            $this->db->or_like('wh_items.level_2', $search, 'both');
            $this->db->or_like('wh_items.level_3', $search, 'both');
            $this->db->or_like('wh_items.level_4', $search, 'both');
            $this->db->or_like('wh_items.kode_barang', $search, 'both');
            $this->db->or_like('wh_items.remark', $search, 'both');
            $this->db->group_end();
        }

        $this->db->group_by([
            'wh_items.id',
            'wh_items.kode_barang',
            'wh_items.category',
            'wh_items.inisial_kuantitas',
            'wh_items.Level_1',
            'wh_items.level_2',
            'wh_items.level_3',
            'wh_items.level_4',
            'wh_items.path_foto',
            'wh_items.remark'
        ]);
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $result['rows'] = $query->result_array();

        return $result;
    }


  function getserials($item_id, $id_from)
{
    $page  = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows  = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
    $sort  = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_item_serials.id';
    $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
    $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
    $offset = ($page - 1) * $rows;
    $result = array();

    // 🔹 Hitung total data serials
    $this->db->from('wh_item_serials');
    $this->db->join('wh_items', 'wh_items.id = wh_item_serials.item_id', 'left');
    $this->db->where('wh_item_serials.item_id', $item_id);
    $this->db->where('wh_item_serials.loc', 1);
    $this->db->where('wh_item_serials.loc_id', $id_from);

    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('wh_items.kode_barang', $search, 'both');
        $this->db->or_like('wh_item_serials.serial', $search, 'both');
        $this->db->or_like('wh_item_serials.remark', $search, 'both');
        $this->db->or_like('wh_items.level_1', $search, 'both');
        $this->db->or_like('wh_items.level_2', $search, 'both');
        $this->db->or_like('wh_items.level_3', $search, 'both');
        $this->db->or_like('wh_items.level_4', $search, 'both');
        $this->db->group_end();
    }
    $result['total'] = $this->db->count_all_results();  // 👈 tambahkan total

    // 🔹 Ambil data rows
    $this->db->select("
        wh_items.id AS item_id,
        wh_items.kode_barang,
        wh_items.level_1,
        wh_items.level_2,
        wh_items.level_3,
        wh_items.level_4,
        wh_item_serials.id AS serial_id,
        wh_item_serials.remark AS serial_remark,
        wh_item_serials.serial,
        wh_item_serials.loc,
        wh_item_serials.loc_id
    ");
    $this->db->from('wh_item_serials');
    $this->db->join('wh_items', 'wh_items.id = wh_item_serials.item_id', 'left');
    $this->db->where('wh_item_serials.item_id', $item_id);
    $this->db->where('wh_item_serials.loc', 1);
    $this->db->where('wh_item_serials.loc_id', $id_from);

    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('wh_items.kode_barang', $search, 'both');
        $this->db->or_like('wh_item_serials.serial', $search, 'both');
        $this->db->or_like('wh_items.level_1', $search, 'both');
        $this->db->or_like('wh_items.level_2', $search, 'both');
        $this->db->or_like('wh_items.level_3', $search, 'both');
        $this->db->or_like('wh_items.level_4', $search, 'both');
        $this->db->group_end();
    }

    $this->db->order_by($sort, $order);
    $this->db->limit($rows, $offset);

    $query = $this->db->get();
    $result['rows'] = $query->result_array();

    return $result;
}



    function getStockemployee()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_user.nama';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $result = array();

        // Hitung total data (jumlah karyawan yang ambil barang)
        $this->db->select('COUNT(DISTINCT CONCAT(wh_items.id, "-", wh_items_stock.employee_id)) AS total', false);
        $this->db->from('wh_items_stock');
        $this->db->join('wh_items', 'wh_items_stock.item_id = wh_items.id', 'left');
        $this->db->join('tbl_user', 'wh_items_stock.employee_id = tbl_user._id', 'left');
        $this->db->where('wh_items.is_deleted', '0');
        $this->db->where('wh_items_stock.employee_id IS NOT NULL');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('wh_items.kode_barang', $search, 'both');
            $this->db->or_like('wh_items.Level_1', $search, 'both');
            $this->db->or_like('wh_items.level_2', $search, 'both');
            $this->db->or_like('wh_items.level_3', $search, 'both');
            $this->db->or_like('wh_items.level_4', $search, 'both');
            $this->db->or_like('tbl_user.nama', $search, 'both');
            $this->db->group_end();
        }

        $query = $this->db->get();
        $result['total'] = $query->row()->total;

        // Ambil data real berdasarkan limit & offset
        $this->db->select('
        wh_items.id,
        wh_items.kode_barang,
        wh_items.Level_1,
        wh_items.level_2,
        wh_items.level_3,
        wh_items.level_4,
        wh_items.category,
        wh_items.inisial_kuantitas,
        tbl_user.nama AS nama_karyawan,
        SUM(wh_items_stock.quantity) AS total_quantity
    ');
        $this->db->from('wh_items_stock');
        $this->db->join('wh_items', 'wh_items_stock.item_id = wh_items.id', 'left');
        $this->db->join('tbl_user', 'wh_items_stock.employee_id = tbl_user._id', 'left');
        $this->db->where('wh_items.is_deleted', '0');
        $this->db->where('wh_items_stock.employee_id IS NOT NULL');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('wh_items.kode_barang', $search, 'both');
            $this->db->or_like('wh_items.Level_1', $search, 'both');
            $this->db->or_like('wh_items.level_2', $search, 'both');
            $this->db->or_like('wh_items.level_3', $search, 'both');
            $this->db->or_like('wh_items.level_4', $search, 'both');
            $this->db->or_like('tbl_user.nama', $search, 'both');
            $this->db->group_end();
        }

        $this->db->group_by([
            'wh_items.id',
            'wh_items.kode_barang',
            'wh_items.Level_1',
            'wh_items.level_2',
            'wh_items.level_3',
            'wh_items.level_4',
            'wh_items.category',
            'wh_items.inisial_kuantitas',
            'tbl_user.nama'
        ]);
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $result['rows'] = $query->result_array();
        return $result;
    }



    public function getStockdetails($id)
    {
        $this->db->select('wh_items_stock.*, wh_warehouse.*, wh_items.*, tbl_user.nama'); // Menentukan kolom yang diambil
        $this->db->from('wh_items_stock');
        $this->db->join('wh_warehouse', 'wh_items_stock.warehouse_id = wh_warehouse.id', 'left'); // LEFT JOIN dengan wh_warehouse
        $this->db->join('wh_items', 'wh_items_stock.item_id = wh_items.id', 'left'); // LEFT JOIN dengan wh_items
        $this->db->join('tbl_user', 'tbl_user._id = wh_items_stock.employee_id', 'left'); // LEFT JOIN dengan tbl_user
        $this->db->where('wh_items_stock.item_id', $id); // Menambahkan where untuk item_id
        $this->db->where('wh_items_stock.quantity >', 0); // Menambahkan where untuk quantity > 0

        $query = $this->db->get(); // Menjalankan query
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    public function getSetItem($id)
    {
        $this->db->select('wh_item_set.*, wh_items.kode_barang,wh_items.category'); // Menentukan kolom yang diambil dari kedua tabel
        $this->db->from('wh_item_set'); // Mengambil data dari tabel wh_item_set
        $this->db->join('wh_items', 'wh_item_set.item_id = wh_items.id', 'left'); // LEFT JOIN dengan wh_items berdasarkan item_id
        $this->db->where('wh_item_set.item_id', $id); // Menambahkan where untuk item_id yang sesuai dengan parameter $id

        $query = $this->db->get(); // Menjalankan query
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    public function getSetItem2()
    {
        $this->db->select('wh_item_set.*, wh_items.kode_barang,wh_items.category'); // Menentukan kolom yang diambil dari kedua tabel
        $this->db->from('wh_item_set'); // Mengambil data dari tabel wh_item_set
        $this->db->join('wh_items', 'wh_item_set.item_id = wh_items.id', 'left'); // LEFT JOIN dengan wh_items berdasarkan item_id
        $this->db->where('wh_item_set.item_id', '11'); // Menambahkan where untuk item_id yang sesuai dengan parameter $id

        $query = $this->db->get(); // Menjalankan query
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }






    public function getDistribution()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_distribution.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Query to get total number of rows
        $this->db->select('COUNT(*) AS total');
        $this->db->from('wh_distribution');
        $this->db->join('wh_items', 'wh_distribution.item_id = wh_items.id', 'left');
        $this->db->join('wh_warehouse AS wh_warehouse_from', 'wh_distribution.from_warehouse_id = wh_warehouse_from.id', 'left');
        $this->db->join('wh_warehouse AS wh_warehouse_to', 'wh_distribution.to_warehouse_id = wh_warehouse_to.id', 'left');
        $this->db->join('tbl_user AS tbl_user_from', 'wh_distribution.employee_id_from = tbl_user_from._id', 'left');
        $this->db->join('tbl_user AS tbl_user_to', 'wh_distribution.employee_id_to = tbl_user_to._id', 'left');
        $this->db->join('tbl_supplier AS tbl_supplier_from', 'wh_distribution.from_suplier_id = tbl_supplier_from.id', 'left');
        $this->db->join('tbl_supplier AS tbl_supplier_to', 'wh_distribution.to_suplier_id = tbl_supplier_to.id', 'left');

        if ($search) {
            $this->db->group_start();
            $this->db->like('wh_items.level_1', $search, 'both'); // Adjust column name as needed
            $this->db->group_end();
        }
        $query = $this->db->get();
        $result['total'] = $query->row()->total;

        // Query to get the actual data
        $this->db->select('wh_distribution.*, 
                       wh_warehouse_from.wh_name AS from_warehouse_name, 
                       wh_warehouse_to.wh_name AS to_warehouse_name, 
                       wh_items.*, 
                       tbl_user_from.nama AS employee_from_name, 
                       tbl_user_to.nama AS employee_to_name,
                       tbl_supplier_from.nama AS supplier_from_name, 
                       tbl_supplier_to.nama AS supplier_to_name,');
        $this->db->from('wh_distribution');
        $this->db->join('wh_items', 'wh_distribution.item_id = wh_items.id', 'left');
        $this->db->join('wh_warehouse AS wh_warehouse_from', 'wh_distribution.from_warehouse_id = wh_warehouse_from.id', 'left');
        $this->db->join('wh_warehouse AS wh_warehouse_to', 'wh_distribution.to_warehouse_id = wh_warehouse_to.id', 'left');
        $this->db->join('tbl_user AS tbl_user_from', 'wh_distribution.employee_id_from = tbl_user_from._id', 'left');
        $this->db->join('tbl_user AS tbl_user_to', 'wh_distribution.employee_id_to = tbl_user_to._id', 'left');
        $this->db->join('tbl_supplier AS tbl_supplier_from', 'wh_distribution.from_suplier_id = tbl_supplier_from.id', 'left');
        $this->db->join('tbl_supplier AS tbl_supplier_to', 'wh_distribution.to_suplier_id = tbl_supplier_to.id', 'left');



        if ($search) {
            $this->db->group_start();
            $this->db->like('wh_items.level_1', $search, 'both'); // Adjust column name as needed
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $items = $query->result_array();

        foreach ($items as &$item) {
            // Untuk bagian "from"
            if (!empty($item['from_warehouse_id'])) {
                $item['from_type'] = 'warehouse';
                $item['from_name'] = ($item['from_warehouse_name']);
            } elseif (!empty($item['employee_id_from'])) {
                $item['from_type'] = 'employee';
                $item['from_name'] = ($item['employee_from_name']);
            } else {
                $item['from_type'] = null;
                $item['from_name'] = null;
            }

            // Untuk bagian "to"
            if (!empty($item['to_warehouse_id'])) {
                $item['to_type'] = 'warehouse';
                $item['to_name'] = ($item['to_warehouse_name']);
            } elseif (!empty($item['employee_id_to'])) {
                $item['to_type'] = 'employee';
                $item['to_name'] = ($item['employee_to_name']);
            } else {
                $item['to_type'] = null;
                $item['to_name'] = null;
            }
        }



        $result = array_merge($result, ['rows' => $items]);
        return $result;
    }



    // public function getDistribution()
    // {
    //     $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    //     $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
    //     $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_distribution.id';
    //     $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
    //     $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
    //     $offset = ($page - 1) * $rows;
    //     $result = array();

    //     // Query to get total number of rows
    //     $this->db->select('COUNT(*) AS total');
    //     $this->db->from('wh_distribution');
    //     $this->db->join('wh_items', 'wh_distribution.item_id = wh_items.id', 'left');
    //     $this->db->join('wh_warehouse AS wh_warehouse_from', 'wh_distribution.from_warehouse_id = wh_warehouse_from.id', 'left');
    //     $this->db->join('wh_warehouse AS wh_warehouse_to', 'wh_distribution.to_warehouse_id = wh_warehouse_to.id', 'left');
    //     $this->db->join('tbl_user AS tbl_user_from', 'wh_distribution.employee_id_from = tbl_user_from._id', 'left');
    //     $this->db->join('tbl_user AS tbl_user_to', 'wh_distribution.employee_id_to = tbl_user_to._id', 'left');

    //     if ($search) {
    //         $this->db->group_start();
    //         $this->db->like('wh_items.level_1', $search, 'both');
    //         $this->db->group_end();
    //     }
    //     $query = $this->db->get();
    //     $result['total'] = $query->row()->total;

    //     // Query to get the actual data
    //     $this->db->select('wh_distribution.*, 
    //                        wh_warehouse_from.wh_name AS from_warehouse_name, 
    //                        wh_warehouse_to.wh_name AS to_warehouse_name, 
    //                        wh_items.level_1, 
    //                        tbl_user_from.nama AS employee_from_name, 
    //                        tbl_user_to.nama AS employee_to_name');
    //     $this->db->from('wh_distribution');
    //     $this->db->join('wh_items', 'wh_distribution.item_id = wh_items.id', 'left');
    //     $this->db->join('wh_warehouse AS wh_warehouse_from', 'wh_distribution.from_warehouse_id = wh_warehouse_from.id', 'left');
    //     $this->db->join('wh_warehouse AS wh_warehouse_to', 'wh_distribution.to_warehouse_id = wh_warehouse_to.id', 'left');
    //     $this->db->join('tbl_user AS tbl_user_from', 'wh_distribution.employee_id_from = tbl_user_from._id', 'left');
    //     $this->db->join('tbl_user AS tbl_user_to', 'wh_distribution.employee_id_to = tbl_user_to._id', 'left');

    //     if ($search) {
    //         $this->db->group_start();
    //         $this->db->like('wh_items.level_1', $search, 'both');
    //         $this->db->group_end();
    //     }
    //     $this->db->order_by($sort, $order);
    //     $this->db->limit($rows, $offset);
    //     $query = $this->db->get();

    //     // Ambil data dari query
    //     $items = $query->result_array();

    //     // Menambahkan kolom tambahan "from" dan "to"
    //     foreach ($items as &$item) {
    //         // Untuk bagian "from"
    //         if (!empty($item['from_warehouse_id'])) {
    //             $item['from_type'] = 'warehouse';
    //             $item['from_name'] = ($item['from_warehouse_name']);
    //         } elseif (!empty($item['employee_id_from'])) {
    //             $item['from_type'] = 'employee';
    //             $item['from_name'] = ($item['employee_from_name']);
    //         } else {
    //             $item['from_type'] = null;
    //             $item['from_name'] = null;
    //         }

    //         // Untuk bagian "to"
    //         if (!empty($item['to_warehouse_id'])) {
    //             $item['to_type'] = 'warehouse';
    //             $item['to_name'] = ($item['to_warehouse_name']);
    //         } elseif (!empty($item['employee_id_to'])) {
    //             $item['to_type'] = 'employee';
    //             $item['to_name'] = ($item['employee_to_name']);
    //         } else {
    //             $item['to_type'] = null;
    //             $item['to_name'] = null;
    //         }
    //     }

    //     // Menggabungkan hasil dengan data pagination
    //     $result = array_merge($result, ['rows' => $items]);
    //     return $result;
    // }

    function getParams()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'params.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('params.param_group', $search, 'both');
            $this->db->like('params.param_name', $search, 'both');
            $this->db->like('params.status', $search, 'both');
            $this->db->like('params.remark', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('params')->num_rows();

        //
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('params.param_group', $search, 'both');
            $this->db->or_like('params.param_name', $search, 'both');
            $this->db->or_like('params.remark', $search, 'both');
            $this->db->or_like('params.status', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('params');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getwh_Params()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'wh_params.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('wh_params.param_group', $search, 'both');
            $this->db->like('wh_params.param_name', $search, 'both');
            $this->db->like('wh_params.status', $search, 'both');
            $this->db->like('wh_params.remark', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('wh_params')->num_rows();

        //
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('wh_params.param_group', $search, 'both');
            $this->db->or_like('wh_params.param_name', $search, 'both');
            $this->db->or_like('wh_params.remark', $search, 'both');
            $this->db->or_like('wh_params.status', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('wh_params');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }





    function getsharedFiles($desc)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'file_shared.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $description = isset($_POST['Desc']) ? strval($_POST['Desc']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if ($desc != 'all') {
            $this->db->where('file_shared.Description', $desc);
        }

        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }


        // Dapatkan jumlah total data yang sesuai pencarian
        $result['total'] = $this->db->get('file_shared')->num_rows();

        if ($desc != 'all') {
            $this->db->where('file_shared.Description', $desc);
        }

        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }


        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Order dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('file_shared');

        // Ambil hasil query sebagai array
        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);

        return $result;
    }



    function getsharedFilessteelstructure($desc)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'file_shared.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $description = isset($_POST['Desc']) ? strval($_POST['Desc']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'Steel Structure');
        } else {
            $this->db->where('file_shared.level1', 'Steel Structure');
            $this->db->where('file_shared.Description', $desc);
        }


        // Pencarian data
        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Hitung total data
        $this->db->from('file_shared');
        $result['total'] = $this->db->count_all_results();

        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'Steel Structure');
        } else {
            $this->db->where('file_shared.level1', 'Steel Structure');
            $this->db->where('file_shared.Description', $desc);
        }

        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Order dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('file_shared');

        // Ambil hasil query sebagai array
        $result['rows'] = $query->result_array();

        return $result;
    }



    function getsharedfilespid($desc)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'file_shared.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $description = isset($_POST['Desc']) ? strval($_POST['Desc']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'P&ID');
        } else {
            $this->db->where('file_shared.level1', 'P&ID');
            $this->db->where('file_shared.Description', $desc);
        }

        // Pencarian data
        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Hitung total data
        $this->db->from('file_shared');
        $result['total'] = $this->db->count_all_results();

        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'P&ID');
        } else {
            $this->db->where('file_shared.level1', 'P&ID');
            $this->db->where('file_shared.Description', $desc);
        }

        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Order dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('file_shared');

        // Ambil hasil query sebagai array
        $result['rows'] = $query->result_array();

        return $result;
    }


    function getsharedfilespiping($desc)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'file_shared.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $description = isset($_POST['Desc']) ? strval($_POST['Desc']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'piping');
        } else {
            $this->db->where('file_shared.level1', 'piping');
            $this->db->where('file_shared.Description', $desc);
        }

        // Pencarian data
        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Hitung total data
        $this->db->from('file_shared');
        $result['total'] = $this->db->count_all_results();

        // Reset query untuk pengambilan data sesuai pagination
        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'piping');
        } else {
            $this->db->where('file_shared.level1', 'piping');
            $this->db->where('file_shared.Description', $desc);
        }


        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Order dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('file_shared');

        // Ambil hasil query sebagai array
        $result['rows'] = $query->result_array();

        return $result;
    }

    function getsharedfilesEquipment($desc)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'file_shared.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $description = isset($_POST['Desc']) ? strval($_POST['Desc']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Filter untuk level1 = 'piping'

        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'Equipment');
        } else {
            $this->db->where('file_shared.level1', 'Equipment');
            $this->db->where('file_shared.Description', $desc);
        }


        // Pencarian data
        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Hitung total data
        $this->db->from('file_shared');
        $result['total'] = $this->db->count_all_results();

        // Reset query untuk pengambilan data sesuai pagination
        if ($desc == 'all') {
            $this->db->where('file_shared.level1', 'Equipment');
        } else {
            $this->db->where('file_shared.level1', 'Equipment');
            $this->db->where('file_shared.Description', $desc);
        }

        if (isset($_POST['Desc'])) {
            $this->db->group_start();
            $this->db->like('file_shared.Description', $description, 'both');
            $this->db->group_end();
        }
        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();
        }

        if (isset($_POST['search_data']) && isset($_POST['Desc'])) {  // Periksa kedua kondisi


            $this->db->group_start();
            $this->db->like('file_shared.level1', $search, 'both');
            $this->db->or_like('file_shared.Description', $search, 'both');
            $this->db->or_like('file_shared.name_file', $search, 'both');
            $this->db->or_like('file_shared.upload_date', $search, 'both');
            $this->db->or_like('file_shared.size', $search, 'both');
            $this->db->or_like('file_shared.type_file', $search, 'both');
            $this->db->or_like('file_shared.remark', $search, 'both');
            $this->db->group_end();

            // Menambahkan WHERE tambahan untuk kondisi 'Desc'
            $this->db->where('file_shared.Description', $description);  // Menambah kondisi WHERE berdasarkan Desc
        }

        // Order dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('file_shared');

        // Ambil hasil query sebagai array
        $result['rows'] = $query->result_array();

        return $result;
    }




    function getSupplier()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_supplier.id'; // Sesuaikan dengan tabel tbl_supplier
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Pencarian data supplier
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_supplier.nama', $search, 'both');
            $this->db->or_like('tbl_supplier.PIC_name', $search, 'both');
            $this->db->or_like('tbl_supplier.email', $search, 'both');
            $this->db->or_like('tbl_supplier.phone', $search, 'both');
            $this->db->or_like('tbl_supplier.address', $search, 'both');
            $this->db->or_like('tbl_supplier.bank_account', $search, 'both');
            $this->db->or_like('tbl_supplier.rek_bank', $search, 'both');
            $this->db->or_like('tbl_supplier.tax', $search, 'both');
            $this->db->or_like('tbl_supplier.status', $search, 'both');
            $this->db->group_end();
        }

        // Dapatkan jumlah total data yang sesuai pencarian
        $result['total'] = $this->db->get('tbl_supplier')->num_rows();

        // Reset query untuk mendapatkan data sesuai pagination
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_supplier.nama', $search, 'both');
            $this->db->or_like('tbl_supplier.PIC_name', $search, 'both');
            $this->db->or_like('tbl_supplier.email', $search, 'both');
            $this->db->or_like('tbl_supplier.phone', $search, 'both');
            $this->db->or_like('tbl_supplier.address', $search, 'both');
            $this->db->or_like('tbl_supplier.bank_account', $search, 'both');
            $this->db->or_like('tbl_supplier.rek_bank', $search, 'both');
            $this->db->or_like('tbl_supplier.tax', $search, 'both');
            $this->db->or_like('tbl_supplier.status', $search, 'both');
            $this->db->group_end();
        }

        // Order dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('tbl_supplier');

        // Ambil hasil query sebagai array
        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);

        return $result;
    }


    function getPO()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_po.id'; // Sesuaikan dengan tabel po
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        // Join antara tabel tbl_po dengan tbl_supplier
        $this->db->select('tbl_po.*, tbl_supplier.nama AS supplier_name');  // Ambil semua data dari tbl_po dan nama supplier
        $this->db->from('tbl_po');
        $this->db->join('tbl_supplier', 'tbl_po.Supplier_id = tbl_supplier.id', 'left'); // Join berdasarkan supplier_id

        // Pencarian data PO
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('tbl_po.po_number', $search, 'both');
            $this->db->or_like('tbl_supplier.nama', $search, 'both');  // Cari juga berdasarkan nama supplier
            $this->db->or_like('tbl_po.expeted_date', $search, 'both');
            $this->db->or_like('tbl_po.total_amount', $search, 'both');
            $this->db->or_like('tbl_po.status', $search, 'both');
            $this->db->or_like('tbl_po.po_date', $search, 'both');
            $this->db->or_like('tbl_po.file', $search, 'both');
            $this->db->or_like('tbl_po.po_description', $search, 'both');
            $this->db->or_like('tbl_po.item_description', $search, 'both');
            $this->db->group_end();
        }

        // Dapatkan jumlah total data yang sesuai pencarian
        $temp_query = clone $this->db; // Clone query untuk menghitung total
        $result['total'] = $temp_query->count_all_results();

        // Reset query untuk mendapatkan data sesuai pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        // Ambil hasil query sebagai array
        $item = $query->result_array();
        $result['rows'] = $item;

        return $result;
    }

























    //lutfi beres


    function getPosisi()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_posisi._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_posisi.posisi', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('tbl_posisi')->num_rows();

        //
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_posisi.posisi', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('tbl_posisi');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }


    function getBarang()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_barang._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_barang.nama_barang', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('tbl_barang')->num_rows();

        //
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_barang.nama_barang', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('tbl_barang');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }


    function isBarang()
    {
        return $this->db->get('tbl_barang');
    }

    function getBarangById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->where('_id', $id);
        return $this->db->get();
    }

    function getBarangMasuk()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_barang_masuk._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('tbl_barang_masuk.*,tbl_barang.nama_barang');
        $this->db->from('tbl_barang_masuk');
        $this->db->join('tbl_barang', 'tbl_barang_masuk.id_barang=tbl_barang._id');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_barang.nama_barang', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get()->num_rows();

        $this->db->select('tbl_barang_masuk.*,tbl_barang.nama_barang');
        $this->db->from('tbl_barang_masuk');
        $this->db->join('tbl_barang', 'tbl_barang_masuk.id_barang=tbl_barang._id');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('tbl_barang.nama_barang', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
    function getPenjualanKredit()
    {
        $this->db->select('*');
        $this->db->from('tbl_penjualan');
        $this->db->where('status_approve', '1');
        $this->db->where_not_in('status_penjualan', array(0, 11));
        return $this->db->get();
    }
    function getPenjualan($month)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('p.*,u.nama, us.nama as penagih, b.nama_barang,(SELECT MONTH(created_at) from tbl_penagihan WHERE no_faktur = p.no_faktur ORDER BY _id DESC LIMIT 1) as bayar');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_user us', 'us._id = p.id_penagih');
        $this->db->join('tbl_barang b', 'b._id = p.id_barang');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, us.nama as penagih, b.nama_barang,(SELECT MONTH(created_at) from tbl_penagihan WHERE no_faktur = p.no_faktur ORDER BY _id DESC LIMIT 1) as bayar');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_user us', 'us._id = p.id_penagih');
        $this->db->join('tbl_barang b', 'b._id = p.id_barang');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
    function getPenjualanApprove()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('p.*,u.nama, b.nama_barang');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_barang b', 'b._id = p.id_barang');
        $this->db->where('status_approve', '0');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, b.nama_barang');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_barang b', 'b._id = p.id_barang');
        $this->db->where('status_approve', '0');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
    function getPenjualanById($id)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $this->db->select('p.*,u.nama, b.nama_barang');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_barang b', 'b._id = p.id_barang');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('p.id_user', $id);
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, b.nama_barang');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_barang b', 'b._id = p.id_barang');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $this->db->where('p._id', $id);
        $query = $this->db->get();

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getDetailPenjualan($id)
    {
        $this->db->select('j.*, b.nama_barang');
        $this->db->from('tbl_penjualan j');
        $this->db->join('tbl_barang b', 'b._id = j.id_barang');
        $this->db->where('j._id', $id);
        return $this->db->get();
    }

    function getDetailPenagihan($noFaktur)
    {
        $this->db->select('*');
        $this->db->from('tbl_penagihan');
        $this->db->where('no_faktur', $noFaktur);
        return $this->db->get();
    }

    function getPenagihan()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('p.*,u.nama, j.no_faktur, j.alamat, j.nama_pembeli, j.tgl_tempo');
        $this->db->from('tbl_penagihan p');
        $this->db->join('tbl_penjualan j', 'j.no_faktur = p.no_faktur');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.no_faktur', $search, 'both');
            $this->db->or_like('j.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('j.nama_pembeli', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, j.no_faktur, j.alamat, j.nama_pembeli, j.tgl_tempo');
        $this->db->from('tbl_penagihan p');
        $this->db->join('tbl_penjualan j', 'j.no_faktur = p.no_faktur');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.no_faktur', $search, 'both');
            $this->db->or_like('j.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('j.nama_pembeli', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();
        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
    function getApprovePenagihan()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('p.*,u.nama, j.no_faktur, j.alamat, j.nama_pembeli, j.tgl_tempo');
        $this->db->from('tbl_penagihan p');
        $this->db->join('tbl_penjualan j', 'j.no_faktur = p.no_faktur');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.no_faktur', $search, 'both');
            $this->db->or_like('j.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('j.nama_pembeli', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('status', '0');
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, j.no_faktur, j.alamat, j.nama_pembeli, j.tgl_tempo');
        $this->db->from('tbl_penagihan p');
        $this->db->join('tbl_penjualan j', 'j.no_faktur = p.no_faktur');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.no_faktur', $search, 'both');
            $this->db->or_like('j.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('j.nama_pembeli', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('status', '0');
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();
        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
    function getTotalBayar($kode)
    {
        $this->db->select('*');
        $this->db->from('tbl_penagihan');
        $this->db->where('no_faktur', $kode);
        return $this->db->get();
    }
    function getPenagihanById($id) {}
    function getIsPenagih()
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('posisi', 6);
        $this->db->where('is_aktif', "1");
        return $this->db->get()->result();
    }
    function getFakturTagihan($month)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('p.*,u.nama, us.nama as penagih,(SELECT MONTH(created_at) from tbl_penagihan WHERE no_faktur = p.no_faktur ORDER BY _id DESC LIMIT 1) as bayar');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_user us', 'us._id = p.id_penagih');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('p.status_bayar', '1');
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, us.nama as penagih,(SELECT MONTH(created_at) from tbl_penagihan WHERE no_faktur = p.no_faktur ORDER BY _id DESC LIMIT 1) as bayar');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_user us', 'us._id = p.id_penagih');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('p.status_bayar', '1');
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
    function getFakturTagihanById($month, $id)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'p._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();

        $this->db->select('p.*,u.nama, us.nama as penagih,(SELECT MONTH(created_at) from tbl_penagihan WHERE no_faktur = p.no_faktur ORDER BY _id DESC LIMIT 1) as bayar');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_user us', 'us._id = p.id_penagih');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('p.status_bayar', '1');
        $this->db->where('p.id_penagih', $id);
        $result['total'] = $this->db->get('')->num_rows();
        $this->db->select('p.*,u.nama, us.nama as penagih,(SELECT MONTH(created_at) from tbl_penagihan WHERE no_faktur = p.no_faktur ORDER BY _id DESC LIMIT 1) as bayar');
        $this->db->from('tbl_penjualan p');
        $this->db->join('tbl_user u', 'u._id = p.id_user');
        $this->db->join('tbl_user us', 'us._id = p.id_penagih');
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('p.nama_pembeli', $search, 'both');
            $this->db->or_like('p.alamat', $search, 'both');
            $this->db->or_like('p.tgl_tempo', $search, 'both');
            $this->db->or_like('u.nama', $search, 'both');
            $this->db->or_like('p.no_faktur', $search, 'both');
            $this->db->group_end();
        }
        $this->db->where('p.status_bayar', '1');
        $this->db->where('p.id_penagih', $id);
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }



    public function getVoucherById($id)
    {
        return $this->db->get_where('accounting_voucher', ['id' => $id])->row();
    }

    public function getVoucherSpecById($id)
    {
        return $this->db->get_where('accounting_voucher_spec', ['voucher_id' => $id])->result();
    }

    public function getAllBanks()
    {
        return $this->db->select('id, name, account_bank, balance') // Pastikan ID Bank diambil
            ->from('accounting_bank') // Sesuaikan dengan nama tabel di database
            ->get()
            ->result_array();
    }

    public function get_file_by_id($id)
    {
        return $this->db->get_where('tree_file', ['id' => $id])->row();
    }



    function getholv1($depart)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sd_ho_lv1.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        // 🔐 Buat kunci unik cache berdasarkan semua parameter
        $cache_key_lv1 = "dr_lv1_{$depart}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        // 🚀 Cek apakah cache sudah ada
        if ($cached = $this->cache->file->get($cache_key_lv1)) {
            return $cached;
        }


        $result = array();

        $this->db->where("sd_ho_lv1.depart", $depart);


        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('sd_ho_lv1.id', $search, 'both');
            $this->db->or_like('sd_ho_lv1.name', $search, 'both');
            $this->db->or_like('sd_ho_lv1.link', $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->get('sd_ho_lv1')->num_rows();

        //
        $this->db->where("sd_ho_lv1.depart", $depart);
        if (isset($_POST['search_data'])) {
            $this->db->group_start();
            $this->db->like('sd_ho_lv1.id', $search, 'both');
            $this->db->or_like('sd_ho_lv1.name', $search, 'both');
            $this->db->or_like('sd_ho_lv1.link', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get('sd_ho_lv1');

        $item = $query->result_array();
        $result = array_merge($result, ['rows' => $item]);

        // 💾 Simpan hasil ke cache selama 10 menit
        $this->cache->file->save($cache_key_lv1, $result, 3600);

        return $result;
    }

    public function get_dr_tree($id)
    {
        $page = $this->input->post('page', true) ?: 1;
        $rows = $this->input->post('rows', true) ?: 20;
        $sort = $this->input->post('sort', true) ?: 'id';
        $order = $this->input->post('order', true) ?: 'ASC';
        $search = $this->input->post('search_data', true) ?: '';
        $offset = ($page - 1) * $rows;

        // 🔐 Cache key unik
        $cache_key = "dr_tree_{$id}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        // 🚀 Cek cache
        if ($cached = $this->cache->file->get($cache_key)) {
            return $cached;
        }

        $this->db->from('sd_ho_tree');
        $this->db->where('parent_id', $id);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('link', $search);
            $this->db->group_end();
        }
        $total = $this->db->count_all_results();

        // Ambil data baris
        $this->db->from('sd_ho_tree');
        $this->db->where('parent_id', $id);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('link', $search);
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();

        $result = [
            'total' => $total,
            'rows' => $query->result_array()
        ];

        // 💾 Simpan cache selama 10 menit
        $this->cache->file->save($cache_key, $result, 600);

        return $result;
    }

    public function move_directory($id, $new_parent_id)
    {
        return $this->db->update('sd_ho_tree', ['parent_id' => $new_parent_id], ['id' => $id]);
    }

    public function move_files_to_directory($file_ids = [], $new_tree_id)
    {
        if (empty($file_ids) || !$new_tree_id) return false;

        $this->db->where_in('id', $file_ids);
        return $this->db->update('tree_file', ['id_tree' => $new_tree_id]);
    }




    public function get_combotree_data($parent_id = null)
    {
        if (is_null($parent_id)) {
            // Ambil semua level 0 sebagai root
            $this->db->where('level', 0);
        } else {
            // Ambil anak dari parent_id
            $this->db->where('parent_id', $parent_id);
        }

        $query = $this->db->get('sd_ho_tree');
        $results = [];

        foreach ($query->result() as $row) {
            $children = $this->get_combotree_data($row->id);
            $results[] = [
                'id' => $row->id,
                'text' => $row->name,
                'children' => $children
            ];
        }

        return $results;
    }


    public function is_descendant($child_id, $parent_id)
    {
        if ($child_id == $parent_id) return true;

        $query = $this->db->get_where('sd_ho_tree', ['id' => $child_id]);
        if ($query->num_rows() == 0) return false;

        $row = $query->row();
        if ($row->parent_id == 0) return false;

        if ($row->parent_id == $parent_id) return true;

        // rekursif ke atas
        return $this->is_descendant($row->parent_id, $parent_id);
    }




    public function get_name_directory($id)
    {
        $cache_key = "dir_name_{$id}";

        // Cek apakah cache tersedia
        if ($cached = $this->cache->file->get($cache_key)) {
            return $cached;
        }

        // Jika belum ada, ambil dari database
        $result = $this->db->get_where('sd_ho_tree', ['id' => $id])->row();

        // Simpan ke cache selama 10 menit (600 detik)
        if ($result) {
            $this->cache->file->save($cache_key, $result, 600);
        }

        return $result;
    }

    public function get_dr_file_tree($id_tree)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "upload_date";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $result = [];

        // TOTAL
        $this->db->from("tree_file");
        $this->db->where("id_tree", $id_tree);
        $this->db->where("is_aktiv", 0);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("subject", $search);
            $this->db->or_like("name_file", $search);
            $this->db->or_like("upload_date", $search);
            $this->db->or_like("remark", $search);
            $this->db->group_end();
        }
        $result['total'] = $this->db->count_all_results();

        // DATA
        $this->db->select("tree_file.*, tree_file.id AS id_dr, tbl_user.nama AS incharge, tree_file.link AS link_dr");
        $this->db->from("tree_file");
        $this->db->join("tbl_user", "tbl_user._id = tree_file.id_user", "left");
        $this->db->where("tree_file.id_tree", $id_tree);
        $this->db->where("tree_file.is_aktiv", 0);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("tree_file.subject", $search);
            $this->db->or_like("tree_file.name_file", $search);
            $this->db->or_like("tree_file.upload_date", $search);
            $this->db->or_like("tree_file.remark", $search);
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $result['rows'] = $query->result_array();

        return $result;
    }







    public function get_dr_lv2($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        // 🔐 Buat kunci unik cache berdasarkan semua parameter
        $cache_key_lv2 = "dr_lv2_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        // 🚀 Cek apakah cache sudah ada
        if ($cached = $this->cache->file->get($cache_key_lv2)) {
            return $cached;
        }

        $result = array();

        // Hitung total data
        $this->db->select("$table2.id AS lv2_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv1_id", "left");
        $this->db->where("$table2.lv1_id", $id);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->count_all_results();

        // Ambil data baris
        $this->db->select("$table2.id AS lv2_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv1_id", "left");
        $this->db->where("$table2.lv1_id", $id);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();
        $result['rows'] = $query->result_array();

        // 💾 Simpan hasil ke cache selama 10 menit
        $this->cache->file->save($cache_key_lv2, $result, 600);

        return $result;
    }





    public function get_dr_lv2_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        // 🔐 Kunci cache
        $cache_key_lv2_file = "dr_lv2_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv2_file)) {
            return $cached;
        }

        $result = array();

        // TOTAL
        $this->db->select("dr_file.*, dr_file.id as id_dr, tbl_user._id, tbl_user.nama as incharge, dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both');
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }
        $result['total'] = $this->db->count_all_results();

        // DATA ROWS
        $this->db->select("dr_file.*, dr_file.id as id_dr, tbl_user._id, tbl_user.nama as incharge, dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both');
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query = $this->db->get();
        $result['rows'] = $query->result_array();

        // 💾 Cache 10 menit
        $this->cache->file->save($cache_key_lv2_file, $result, 300);

        return $result;
    }



    public function get_dr_lv3_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        // 🔐 Kunci cache
        $cache_key_lv3_file = "dr_lv3_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv3_file)) {
            return $cached;
        }


        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        // 💾 Cache 10 menit
        $this->cache->file->save($cache_key_lv3_file, $result, 300);
        return $result;
    }



    public function get_dr_lv3($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        // 🔐 Buat kunci unik cache berdasarkan semua parameter
        $cache_key_lv3 = "dr_lv3_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        // 🚀 Cek apakah cache sudah ada
        if ($cached = $this->cache->file->get($cache_key_lv3)) {
            return $cached;
        }


        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv3_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv2_id", "left");
        $this->db->where("$table2.lv2_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv3_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv2_id", "left");
        $this->db->where("$table2.lv2_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;

        // 💾 Simpan hasil ke cache selama 10 menit
        $this->cache->file->save($cache_key_lv3, $result, 600);

        return $result;
    }




    public function get_dr_lv4_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv4_file = "dr_lv4_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv4_file)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv4_file, $result, 300);
        return $result;
    }



    public function get_dr_lv4($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv4 = "dr_lv4_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv4)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv4_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv3_id", "left");
        $this->db->where("$table2.lv3_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv4_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv3_id", "left");
        $this->db->where("$table2.lv3_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv4, $result, 600);
        return $result;
    }



    public function get_dr_lv5_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv5_file = "dr_lv5_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv5_file)) {
            return $cached;
        }


        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // 
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv5_file, $result, 300);

        return $result;
    }



    public function get_dr_lv5($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv5 = "dr_lv5_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv5)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv5_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv4_id", "left");
        $this->db->where("$table2.lv4_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv5_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv4_id", "left");
        $this->db->where("$table2.lv4_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv5, $result, 600);
        return $result;
    }





    public function get_dr_lv6_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv6_file = "dr_lv6_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv6_file)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // 
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv6_file, $result, 300);
        return $result;
    }



    public function get_dr_lv6($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $cache_key_lv6 = "dr_lv6_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv6)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv6_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv5_id", "left");
        $this->db->where("$table2.lv5_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv6_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv5_id", "left");
        $this->db->where("$table2.lv5_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv6, $result, 600);
        return $result;
    }



    public function get_dr_lv7_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;
        $cache_key_lv7_file = "dr_lv7_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv7_file)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // 
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv7_file, $result, 300);
        return $result;
    }



    public function get_dr_lv7($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv7 = "dr_lv7_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv7)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv7_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv6_id", "left");
        $this->db->where("$table2.lv6_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv7_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv6_id", "left");
        $this->db->where("$table2.lv6_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv7, $result, 600);
        return $result;
    }




    public function get_dr_lv8_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv8_file = "dr_lv8_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv8_file)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // 
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv8_file, $result, 300);
        return $result;
    }



    public function get_dr_lv8($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv8 = "dr_lv8_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv8)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv8_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv7_id", "left");
        $this->db->where("$table2.lv7_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv8_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv7_id", "left");
        $this->db->where("$table2.lv7_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv8, $result, 600);
        return $result;
    }



    public function get_dr_lv9_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv9_file = "dr_lv9_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv9_file)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // 
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv9_file, $result, 300);
        return $result;
    }



    public function get_dr_lv9($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv9 = "dr_lv9_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv9)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv9_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv8_id", "left");
        $this->db->where("$table2.lv8_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv9_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv8_id", "left");
        $this->db->where("$table2.lv8_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv9, $result, 600);
        return $result;
    }



    public function get_dr_lv10_file($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "dr_file.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv10_file = "dr_lv10_file_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);

        if ($cached = $this->cache->file->get($cache_key_lv10_file)) {
            return $cached;
        }


        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // 
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("dr_file.*,dr_file.id as id_dr,tbl_user._id,tbl_user.nama as incharge,dr_file.link as link_dr, $table1.*");
        $this->db->from("dr_file");
        $this->db->join("tbl_user", "tbl_user._id = dr_file.id_user", "left");
        $this->db->join($table1, "$table1.id = dr_file.id_table", "left");
        $this->db->where("dr_file.table_name", $table1);
        $this->db->where("dr_file.id_table", $id);
        $this->db->where("dr_file.is_aktiv", '0');

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("dr_file.id", $search, 'both');
            $this->db->or_like("tbl_user.nama", $search, 'both'); // ✅ GANTI incharge dengan tbl_user.nama
            $this->db->or_like("dr_file.subject", $search, 'both');
            $this->db->or_like("dr_file.name_file", $search, 'both');
            $this->db->or_like("dr_file.upload_date", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv10_file, $result, 300);
        return $result;
    }



    public function get_dr_lv10($id, $table1, $table2)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : "$table2.id";
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page - 1) * $rows;

        $cache_key_lv10 = "dr_lv10_{$id}_{$table1}_{$table2}_{$page}_{$rows}_{$sort}_{$order}_" . md5($search);


        if ($cached = $this->cache->file->get($cache_key_lv10)) {
            return $cached;
        }

        $result = array();

        // Hitung total data sebelum paginasi
        $this->db->select("$table2.id AS lv10_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv9_id", "left");
        $this->db->where("$table2.lv9_id", $id);

        // Jika ada pencarian, tambahkan kondisi
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        $result['total'] = $this->db->count_all_results(); // Menghitung total hasil

        // Query dengan paginasi dan sorting
        $this->db->select("$table2.id AS lv10_id, $table2.*, $table1.id");
        $this->db->from($table2);
        $this->db->join($table1, "$table1.id = $table2.lv9_id", "left");
        $this->db->where("$table2.lv9_id", $id);

        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("$table2.id", $search, 'both');
            $this->db->or_like("$table2.name", $search, 'both');
            $this->db->or_like("$table2.link", $search, 'both');
            $this->db->group_end();
        }

        // Sorting dan pagination
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);

        $query = $this->db->get();
        $items = $query->result_array();

        $result['rows'] = $items;
        $this->cache->file->save($cache_key_lv10, $result, 600);

        return $result;
    }

    public function delete_data($id, $table)
    {
        $this->cache->file->clean();
        return $this->db->delete($table, ['id' => $id]);
    }



    public function delete_file($id)
    {
        $this->cache->file->clean();
        $data = array(
            'is_aktiv' => 1
        );

        $this->db->where('id', $id);
        $this->db->update('tree_file', $data);

        return $this->db->affected_rows() > 0;
    }
}
