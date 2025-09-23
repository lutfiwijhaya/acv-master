<section class="content-header"></section>

<head>
    <!-- Include CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <!-- Other head content -->
</head>
<div class="col-12">
    <div class="card">
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <div class="easyui-layout">

                    <!-- Search di atas tabel -->
                    <div style="margin-bottom:10px; text-align:right;">
                        <input id="search" placeholder="Cari Nama / Posisi" style="width:250px; padding:5px;">
                        <a href="javascript:void(0);" id="btn_search" class="easyui-linkbutton" onclick="doSearch()">Search</a>
                    </div>

                    <!-- DataGrid -->
                    <table id="dgGrid"
                        class="easyui-datagrid"
                        url="<?= base_url('user/getUsers') ?>"
                        data-options="rownumbers:true,pagination:true,singleSelect:true,method:'get',fit:true,fitColumns:true">
                        <thead>
                            <tr>
                                <th field="nama" width="30%" sortable="true">Nama</th>
                                <th field="posisi" width="30%" sortable="true">Posisi</th>
                                <th field="menus" width="40%" formatter="menusFormatter">Menus</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var akses_segment = '<?= $this->uri->segment(2) ?>';
    var getMenusUrl = '<?= base_url("user/getMenus") ?>';
    $(function() {
        var $dg = $('#dgGrid');

        $dg.datagrid({
            minHeight: 300,
            maxHeight: 450,
            onLoadError: function() {
                console.error('Datagrid load error - periksa response dari server (harus JSON).');
            }
        });

        $('#btn_search').on('click', doSearch);
        $('#search').on('keypress', function(e) {
            if (e.which === 13) doSearch();
        });
    });

    function doSearch() {
        $('#dgGrid').datagrid('load', {
            search_data: $('#search').val().trim()
        });
    }

    function menusFormatter(value, row, index) {
        var treeId = "menusTree_" + row._id;
        var wrapperHtml = `<div id="${treeId}" class="menus-tree"></div>`;

        setTimeout(function() {
            var $el = $("#" + treeId);
            if ($el.length === 0) return;
            if ($el.data('loaded')) return;

            $el.jstree({
                    'core': {
                        'data': {
                            'url': "<?= base_url('admin/check_user_access') ?>",
                            'type': 'POST',
                            'data': function() {
                                return {
                                    user_id: row._id,
                                    segment: akses_segment
                                };
                            },
                            'dataType': 'json'
                        },
                        'multiple': true,
                        'themes': {
                            'icons': true,
                            'responsive': true
                        }
                    },
                    "plugins": ["checkbox"]
                })
                // ✅ setelah tree selesai refresh dari AJAX, langsung close_all
                .on("refresh.jstree", function(e, data) {
                    var inst = data.instance;
                    setTimeout(function() {
                        inst.close_all();
                    }, 50);
                })
                // fallback kalau refresh tidak kepanggil
                .on("loaded.jstree", function(e, data) {
                    var inst = data.instance;
                    setTimeout(function() {
                        inst.close_all();
                    }, 100);
                })
                .on("changed.jstree", function(e, data) {
                    if (data && data.node) {
                        var id_menu = data.node.id;
                        var id_user = row._id;
                        var status = (data.action === "select_node" || data.action === "check_node") ? 1 : 0;

                        console.log("Changed:", id_menu, status);

                        $.post("<?= base_url('admin/kasi_akses_ajax_new') ?>", {
                            id_menu: id_menu,
                            id_user: id_user,
                            status: status
                        }, function(res) {
                            console.log("akses updated", res);
                        });
                    }
                });

            $el.data('loaded', true);
        }, 30);

        return wrapperHtml;
    }
</script>

<style>
    .menus-wrapper {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        max-width: 100%;
        /* supaya sesuai lebar kolom */
        padding-bottom: 5px;
    }

    .menus-wrapper::-webkit-scrollbar {
        height: 6px;
        /* tipis scrollbar */
    }

    .menus-wrapper::-webkit-scrollbar-thumb {
        background: #bbb;
        border-radius: 4px;
    }
</style>