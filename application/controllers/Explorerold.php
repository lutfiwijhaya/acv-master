<?php
class Explorer extends CI_Controller
{
    public function get_tree()
    {
        $this->load->database();
        $data = [];

        // Root node
        $data[] = [
            'id' => 'lv1_ho',
            'parent' => '#',
            'text' => 'HO',
            'icon' => 'jstree-folder',
            'a_attr' => ['href' => site_url('admin/holv1/ho'), 'target' => '_self']
        ];
        $data[] = [
            'id' => 'lv1_project_berau',
            'parent' => '#',
            'text' => 'Project Berau',
            'icon' => 'jstree-folder',
            'a_attr' => ['href' => site_url('admin/holv1/project_berau'), 'target' => '_self']
        ];
        $data[] = [
            'id' => 'lv1_warehouse',
            'parent' => '#',
            'text' => 'Warehouse',
            'icon' => 'jstree-folder',
            'a_attr' => ['href' => site_url('admin/holv1/warehouse'), 'target' => '_self']
        ];

        // Data level 1
        $lv1 = $this->db->get('sd_ho_lv1')->result();
        foreach ($lv1 as $row) {
            $parent_id = 'lv1_' . $row->depart;
            $node_id = 'lv1_' . $row->id;

            $data[] = [
                'id' => $node_id,
                'parent' => $parent_id,
                'text' => $row->name,
                'icon' => 'jstree-folder',
                'a_attr' => [
                    'href' => site_url("admin/dr_lv2/{$row->id}/sd_ho_lv1/sd_ho_lv2/" . rawurlencode($row->name)),
                    'target' => '_self'
                ]
            ];

            // Rekursif ke level selanjutnya
            $child = $this->get_recursive_data(2, $row->id, $node_id, 'sd_ho_lv1');
            $data = array_merge($data, $child);
        }

        echo json_encode($data);
    }

    private function get_recursive_data($level, $parent_id, $parent_node_id, $parent_table)
    {
        if ($level > 10) return [];
        $result = [];

        $table = "sd_ho_lv{$level}";
        $parent_fk = "lv" . ($level - 1) . "_id";

        if (!$this->db->table_exists($table)) return [];

        $rows = $this->db->where($parent_fk, $parent_id)->get($table)->result();

        foreach ($rows as $row) {
            $node_id = "lv{$level}_" . $row->id;

            $result[] = [
                'id' => $node_id,
                'parent' => $parent_node_id,
                'text' => $row->name,
                'icon' => 'jstree-folder',
                'a_attr' => [
                    'href' => site_url("admin/dr_lv" . ($level + 1) . "/{$row->id}/{$table}/sd_ho_lv" . ($level + 1) . "/" . rawurlencode($row->name)),
                    'target' => '_self'
                ]
            ];

            $child = $this->get_recursive_data($level + 1, $row->id, $node_id, $table);
            $result = array_merge($result, $child);
        }

        return $result;
    }
}
