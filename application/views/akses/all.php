<section class="content-header"></section>

<div class="col-12">
    <div class="card">
        <div class="card-body">

            <!-- === TABEL USER === -->
            <h4>Daftar User</h4>
            <div style="margin-bottom:10px;">
                <a href="javascript:void(0);" id="btn_select_all_users" class="easyui-linkbutton">Select All Users</a>
                <a href="javascript:void(0);" id="btn_deselect_all_users" class="easyui-linkbutton">Deselect All Users</a>
            </div>
            <table id="dgUsers"
                class="easyui-datagrid"
                url="<?= base_url('user/getUsers') ?>"
                data-options="rownumbers:true,pagination:true,singleSelect:false,method:'get',fit:true,fitColumns:true">
                <thead>
                    <tr>
                        <th field="ck" checkbox="true"></th>
                        <th field="nama" width="40%" sortable="true">Nama</th>
                        <th field="posisi" width="40%" sortable="true">Posisi</th>
                    </tr>
                </thead>
            </table>

            <!-- === TREE MENUS === -->
            <h4 style="margin-top:20px;">Hak Akses Menus</h4>
            <div style="margin-bottom:10px;">
                <a href="javascript:void(0);" id="btn_select_all_menus" class="easyui-linkbutton">Select All Menus</a>
                <a href="javascript:void(0);" id="btn_deselect_all_menus" class="easyui-linkbutton">Deselect All Menus</a>
            </div>
            <div id="menusTree"></div>

            <!-- === BUTTON SAVE === -->
            <div style="margin-top:15px; text-align:right;">
                <a href="javascript:void(0);" id="btn_save" class="easyui-linkbutton c6" iconCls="icon-save">Save Akses</a>
            </div>

        </div>
    </div>
</div>

<!-- JSTREE -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

<script>
    var akses_segment = '<?= $this->uri->segment(2) ?>';
    var getMenusUrl = '<?= base_url("user/getMenusAll") ?>';
    var saveAksesUrl = '<?= base_url("user/saveAkses") ?>';

    $(function() {
        // === init datagrid ===
        $('#dgUsers').datagrid({
            minHeight: 250,
            maxHeight: 300,
            singleSelect: false, // bisa pilih banyak user
            onSelect: updateMenus,
            onUnselect: updateMenus,
            onLoadSuccess: function(data) {
                // Awal load, tidak auto-check user
                // Update menus (default: kosong / backend handle)
                updateMenus();
            }
        });

        // Tombol select/deselect all users
        $('#btn_select_all_users').on('click', function() {
            var rows = $('#dgUsers').datagrid('getRows');
            for (var i = 0; i < rows.length; i++) {
                $('#dgUsers').datagrid('selectRow', i);
            }
            updateMenus();
        });
        $('#btn_deselect_all_users').on('click', function() {
            $('#dgUsers').datagrid('clearSelections');
            updateMenus();
        });

        // === init jstree ===
        $('#menusTree').jstree({
            'core': {
                'data': [], // default kosong
                'multiple': true
            },
            "plugins": ["checkbox"]
        });

        // Tombol select/deselect all menus
        $('#btn_select_all_menus').on('click', function() {
            $('#menusTree').jstree("check_all");
        });
        $('#btn_deselect_all_menus').on('click', function() {
            $('#menusTree').jstree("uncheck_all");
        });

        // Tombol save
        $('#btn_save').on('click', function() {
            var selectedRows = $('#dgUsers').datagrid('getSelections');
            if (selectedRows.length === 0) {
                $.messager.alert('Warning', 'Pilih user dulu', 'warning');
                return;
            }

            var userIds = selectedRows.map(row => row._id);
            var checkedIds = $('#menusTree').jstree("get_checked");

            $.post(saveAksesUrl, {
                user_ids: userIds,
                menus: checkedIds
            }, function(res) {
                $.messager.alert('Info', res.message || 'Akses berhasil disimpan', 'info');
            }, 'json').fail(function(xhr) {
                $.messager.alert('Error', 'Gagal simpan akses', 'error');
            });
        });
    });

    // === fungsi updateMenus ===
    function updateMenus() {
        var selectedRows = $('#dgUsers').datagrid('getSelections');
        var userIds = selectedRows.map(row => row._id);

        $('#menusTree').jstree(true).settings.core.data = {
            'url': getMenusUrl,
            'type': 'POST',
            'data': function() {
                return {
                    segment: akses_segment,
                    user_ids: userIds // bisa kosong jika tidak ada user
                };
            },
            'dataType': 'json'
        };
        $('#menusTree').jstree(true).refresh();
    }
</script>