<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <!-- BEGIN card-body -->
        <div class="card-body">

            <div class="p-b-10 ">
                <a href="<?php echo base_url('admin/posisi') ?>" class="btn btn-warning"> Kembali</a>
            </div>
            <table id="mytable" class="table table-striped table-td-valign-middle table-bordered bg-white">
                <thead>
                    <tr>
                        <th width="1%" class="no-sort">#</th>
                        <th>Nama Modul</th>
                        <th width="10%" class="no-sort text-center">Checklist</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    function render_menu($menus, $parent_id = 0, $level = 0, $uri_segment, &$no)
                    {
                        foreach ($menus as $m) {
                            if ($m->is_main == $parent_id && $m->is_aktif == 1) {
                                $isParent = has_child($menus, $m->_id);
                                $checked = checked_akses($uri_segment, $m->_id);

                                echo "<tr>
                <td>$no</td>
                <td style='padding-left:" . ($level * 20) . "px'>" . ($isParent ? "<strong>$m->title</strong>" : $m->title) . "</td>
                <td class='checkbox-col' align='center'>
                    <div class='checkbox-inline'>
                        <input type='checkbox' $checked onClick='kasi_akses($m->_id)' id='table_checkbox_$no'>
                        <label for='table_checkbox_$no'></label>
                    </div>
                </td>
            </tr>";

                                $no++;

                                if ($isParent) {
                                    render_menu($menus, $m->_id, $level + 1, $uri_segment, $no);
                                }
                            }
                        }
                    }

                    // fungsi cek apakah ada child menu
                    function has_child($menus, $id)
                    {
                        foreach ($menus as $m) {
                            if ($m->is_main == $id && $m->is_aktif == 1) {
                                return true;
                            }
                        }
                        return false;
                    }

                    render_menu($menu, 0, 0, $this->uri->segment(3), $no);
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function kasi_akses(id_menu) {
        //alert(id_menu);
        var id_menu = id_menu;
        var level = '<?php echo $this->uri->segment(3); ?>';
        //alert(level);
        // Ambil semua checkbox yang dicentang
        var checked = [];
        document.querySelectorAll('input[type=checkbox]:checked').forEach(function(cb) {
            // Ambil id_menu dari onClick (dari id di akhir, misal: table_checkbox_3)
            var row = cb.closest('tr');
            if (row) {
                // Ambil id_menu dari onClick attribute
                var onclickAttr = cb.getAttribute('onClick');
                if (onclickAttr) {
                    var match = onclickAttr.match(/\((\d+)\)/);
                    if (match) {
                        checked.push(match[1]);
                    }
                }
            }
        });

        var level = '<?php echo $this->uri->segment(3); ?>';

        $.ajax({
            url: "<?php echo base_url() ?>admin/kasi_akses_ajax",
            type: "POST",
            data: {
                id_menu: checked,
                level: level
            },
            success: function(html) {
                //load();
                //alert('sukses');
            }
        });
    }

    function updateSubmenuState() {
        document.querySelectorAll("input[type=checkbox]").forEach(cb => {
            let row = cb.closest("tr");
            let td = row.querySelector("td:nth-child(2)");

            // cari level dari padding-left
            let level = parseInt(td.style.paddingLeft) || 0;
            if (level > 0) {
                // cari parent terdekat (level lebih kecil)
                let prev = row.previousElementSibling;
                while (prev) {
                    let prevLevel = parseInt(prev.querySelector("td:nth-child(2)").style.paddingLeft) || 0;
                    if (prevLevel < level) {
                        let parentCheckbox = prev.querySelector("input[type=checkbox]");
                        cb.disabled = !parentCheckbox.checked;
                        break;
                    }
                    prev = prev.previousElementSibling;
                }
            }
        });
    }

    // jalanin pas load
    document.addEventListener("DOMContentLoaded", updateSubmenuState);
    // update tiap kali ada click
    document.addEventListener("click", function(e) {
        if (e.target.type === "checkbox") {
            updateSubmenuState();
        }
    });
</script>