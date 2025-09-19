<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <!-- BEGIN card-body -->
        <div class="card-body">

            <div class="p-b-10 ">
                <?php
                $segment2 = $this->uri->segment(2);
                if ($segment2 == 'akses_posisi') {
                    $back_url = base_url('admin/posisi');
                } else {
                    $back_url = base_url('admin/users');
                }
                ?>
                <a href="<?php echo $back_url; ?>" class="btn btn-warning mb-3"> Kembali</a>
                <a href="javascript:;" onclick="saveAkses()" class="btn btn-success mb-3"> Save Akses</a>
            </div>
            <table id="mytable" class="table table-striped table-td-valign-middle table-bordered bg-white">
                <thead>
                    <tr>
                        <th width="1%" class="no-sort">#</th>
                        <th>Nama Modul</th>
                        <th width="10%" class="no-sort text-center">
                            <input type="checkbox" id="select_all">
                            <label for="select_all"> Select All</label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    function render_menu($menus, $parent_id = 0, $level = 0, $uri_segment, &$no, $segment2)
                    {
                        foreach ($menus as $m) {
                            if ($m->is_main == $parent_id && $m->is_aktif == 1) {
                                $isParent = has_child($menus, $m->_id);
                                if ($segment2 == 'akses_posisi') {
                                    $checked = checked_akses($uri_segment, $m->_id);
                                } else {
                                    $checked = checked_akses_user($uri_segment, $m->_id);
                                }
                                echo "<tr data-parent='$parent_id' data-id='$m->_id' data-level='$level' class='" . ($isParent ? "parent" : "child") . "'>
                        <td>$no</td>
                        <td style='padding-left:" . ($level * 20) . "px; cursor:" . ($isParent ? "pointer" : "default") . "'>" . ($isParent ? "<strong class='toggle-parent'>$m->title</strong>" : $m->title) . "</td>
                        <td class='checkbox-col' align='center'>
                            <div class='checkbox-inline'>
                                <input type='checkbox' $checked data-id='$m->_id' id='table_checkbox_$no' class='child-checkbox'>
                                <label for='table_checkbox_$no'></label>
                            </div>
                        </td>
                    </tr>";

                                $no++;

                                if ($isParent) {
                                    render_menu($menus, $m->_id, $level + 1, $uri_segment, $no, $segment2);
                                }
                            }
                        }
                    }

                    function has_child($menus, $id)
                    {
                        foreach ($menus as $m) {
                            if ($m->is_main == $id && $m->is_aktif == 1) {
                                return true;
                            }
                        }
                        return false;
                    }

                    render_menu($menu, 0, 0, $this->uri->segment(3), $no, $segment2);
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

<script type="text/javascript">
    // === Simpan akses ===
    function saveAkses() {
        if (!confirm("Apakah Anda yakin ingin menyimpan akses ini?")) {
            return false;
        }

        var menus = [];
        $("input.child-checkbox").each(function() {
            menus.push({
                id: $(this).data("id"),
                status: $(this).prop("checked") // true/false sesuai checkbox
            });
        });

        var level = '<?php echo $this->uri->segment(3); ?>';
        var segment = '<?php echo $this->uri->segment(2); ?>';
        console.log({
            menus
        });

        $.ajax({
            url: "<?php echo base_url() ?>admin/kasi_akses_ajax",
            type: "POST",
            data: {
                menus: menus,
                segment: segment,
                level: level
            },
            success: function(response) {
                alert("Akses berhasil disimpan!");
            },
            error: function() {
                alert("Terjadi kesalahan saat menyimpan akses.");
            }
        });
    }


    // === Update state parent-child (disable child kalau parent unchecked) ===
    function updateSubmenuState() {
        $("input.child-checkbox").each(function() {
            let $row = $(this).closest("tr");
            let level = parseInt($row.data("level")) || 0;

            if (level > 0) {
                let $prev = $row.prev();
                while ($prev.length) {
                    let prevLevel = parseInt($prev.data("level")) || 0;
                    if (prevLevel < level) {
                        let parentCb = $prev.find("input.child-checkbox");
                        $(this).prop("disabled", !parentCb.prop("checked"));
                        break;
                    }
                    $prev = $prev.prev();
                }
            }
        });
    }

    $(document).ready(function() {
        // === Select All ===
        $("#select_all").on("change", function() {
            let checked = $(this).prop("checked");
            $("input.child-checkbox").prop("checked", checked); // centang semua tanpa terkecuali
            updateSubmenuState();
        });


        // === Cascading parent → child ===
        $(document).on("change", "input.child-checkbox", function() {
            let $row = $(this).closest("tr");
            let currentLevel = parseInt($row.data("level"));
            let checked = $(this).prop("checked");

            // toggle semua child ke bawah
            let $next = $row.next();
            while ($next.length) {
                let nextLevel = parseInt($next.data("level"));
                if (isNaN(nextLevel) || nextLevel <= currentLevel) break;

                let $cb = $next.find("input.child-checkbox");
                if (!$cb.prop("disabled")) {
                    $cb.prop("checked", checked);
                }
                $next = $next.next();
            }

            // update state (disable anak kalau parent off)
            updateSubmenuState();

            // update select all
            let total = $("input.child-checkbox:not(:disabled)").length;
            let checkedCount = $("input.child-checkbox:checked:not(:disabled)").length;
            $("#select_all").prop("checked", total > 0 && total === checkedCount);
        });

        // === Toggle parent untuk hide/show child ===
        $(document).on("click", ".toggle-parent", function() {
            let $row = $(this).closest("tr");
            let parentLevel = parseInt($row.data("level"));

            let $next = $row.next();
            while ($next.length) {
                let nextLevel = parseInt($next.data("level"));
                if (isNaN(nextLevel) || nextLevel <= parentLevel) break;

                $next.toggle();
                $next = $next.next();
            }
        });

        // === pertama kali jalan ===
        updateSubmenuState();
    });
</script>