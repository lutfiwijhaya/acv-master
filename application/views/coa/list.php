<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <div class="easyui-layout">
                    <table id="dgGrid" title="<?= $title; ?>"
                        toolbar="#toolbar"
                        class="easyui-datagrid"
                        rowNumbers="true"
                        pagination="true"
                        pageSize="50"
                        pageList="[10,20,50,75,100,125,150,200]"
                        nowrap="true"
                        singleSelect="true">
                        <thead>
                            <tr>
                                <th field="category_name">Category</th>
                                <th field="category_code">Category Code</th>
                                <th field="level">Level</th>
                                <th field="code" width="20%">COA Code</th>
                                <th field="name" width="20%">COA Name</th>
                                <th field="sub_name" width="30%">COA Detail Name</th>
                                <th field="description" width="30%">COA Description</th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Toolbar -->
                    <div id="toolbar" style="padding: 10px">
                        <div class="row ml-1 d-flex justify-content-between align-items-center">
                            <!-- Left menu -->
                            <div class="col-sm-6 text-menu">
                                <a href="javascript:void(0);" onclick="newForm()">Add</a>
                                <a href="javascript:void(0);" onclick="editForm()">Edit</a>
                                <a href="javascript:void(0);" onclick="destroy()">Delete</a>
                            </div>

                            <!-- Right search -->
                            <div class="col-sm-6 text-right">
                                <select id="search_field" style="width:15%;margin-right:10px;">
                                    <option value="">Please Select Field</option>
                                    <option value="all">All</option>
                                    <option value="category_name">Category</option>
                                    <option value="category_code">Category Code</option>
                                    <option value="level">Level</option>
                                    <option value="code">COA Code</option>
                                    <option value="name">COA Name</option>
                                    <option value="sub_name">COA Detail Name</option>
                                    <option value="description">COA Description</option>
                                </select>
                                <input id="search" placeholder="Please Enter Search" style="width:40%;" />
                                <a href="javascript:void(0);" id="btn_serach" onclick="doSearch()">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dialog -->
    </div>
</div>
<div id="dialog-form" class="easyui-window" title="Add / Edit COA" 
    data-options="modal:true,closed:true,iconCls:'icon-save',inline:true,onResize:function(){$(this).window('hcenter');}" 
    style="width:100%;max-width:800px;padding:30px 40px;margin-top:20px;">
    <form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
        <input type="hidden" name="id">
        <input type="hidden" name="category_code" id="category_code">
        <div class="row">
            <div class="col-md-6">
                <div style="margin-bottom:20px">
                    <select class="easyui-combobox" name="category_id" id="category_id" style="width:100%" 
                        data-options="label:'Category:',required:true,editable:false,panelHeight:'auto'">
                    </select>
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="code" style="width:100%" data-options="label:'COA Code:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="name" style="width:100%" data-options="label:'COA Name:',required:true">
                </div>
            </div>
            <div class="col-md-6">
                <div style="margin-bottom:20px">
                    <select class="easyui-combobox" name="level" id="level" style="width:100%"
                        data-options="label:'Level:',required:true,editable:false,panelHeight:'auto'">
                        <option value="">Select Level</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="sub_name" style="width:100%" data-options="label:'COA Detail Name:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="description" style="width:100%" data-options="label:'COA Description:',required:true,multiline:true" style="height:80px">
                </div>
            </div>
        </div>
    </form>
    <div id="dialog-buttons" style="text-align:center;padding-top:10px;">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()" style="width:100px;">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-form').dialog('close')" style="width:100px;">Batal</a>
    </div>
</div>

<style>
    /* Text menu style */
    .text-menu a,
    #btn_serach {
        margin-right: 15px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
    } 

    .text-menu a:hover,
    #btn_serach:hover {
        color: #007bff;       /* biru saat hover */
        text-decoration: underline;
    }
</style>

<script type="text/javascript">
    var url; // global untuk menampung endpoint

    $(document).ready(function() {
        $('#dgGrid').datagrid({
            minHeight: 410,
            maxHeight: 520,
            method: 'get',
            loader: function(param, success, error) {
                $.ajax({
                    url: "<?= base_url('coa/getDataCoa') ?>",
                    type: "GET",
                    data: {
                        page: param.page,
                        rows: param.rows,
                        search_data: $('#search').val(),
                        search_field: $('#search_field').val()
                    },
                    dataType: "json",
                    success: function(data) {
                        success(data);
                    },
                    error: function() {
                        error.apply(this, arguments);
                    }
                });
            }
        });

        $('#search').keyup(function(event) {
            if (event.keyCode == 13) {
                $('#btn_serach').click();
            }
        });

        // Load category data saat halaman siap
        loadCategory();
    });

    // Function untuk load category via Ajax
    function loadCategory() {
        $.ajax({
            url: "<?= base_url('coa/getDataCoaCategoryOption') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var options = [];
                $.each(data, function(index, item) {
                    options.push({
                        value: item.id,
                        text: item.text,
                        code: item.code
                    });
                });
                $('#category_id').combobox('loadData', options);
            },
            error: function() {
                Toast.fire({ icon: 'error', title: 'Gagal memuat data category' });
            }
        });
    }

    $('#category_id').combobox({
        onSelect: function(record) {
            $('#category_code').val(record.code);
        }
    });

    function doSearch() {
        $('#dgGrid').datagrid('reload');
    }

    function submitForm() {
        if ($('#ff').form('validate')) {
            var formData = new FormData($('#ff')[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(result) {
                    if (result.status == 'error') {
                        Toast.fire({ icon: 'error', title: result.message });
                        $('#dialog-form').dialog('close');
                        $('#dgGrid').datagrid('reload');
                    } else {
                        Toast.fire({ icon: 'success', title: result.message });
                        $('#dialog-form').dialog('close');
                        $('#dgGrid').datagrid('reload');
                    }
                },
                error: function() {
                    Toast.fire({ icon: 'error', title: 'Gagal menyimpan data' });
                }
            });
        }
    }

    function newForm() {
        $('#dialog-form').dialog('open').dialog('setTitle', 'Add New COA');
        $('#ff').form('clear');
        url = "<?= base_url('coa/saveCoa') ?>";
    }

    function editForm() {
        var row = $('#dgGrid').datagrid('getSelected');
        if (row) {
            $('#dialog-form').dialog('open').dialog('setTitle', 'Edit COA ' + row.coa);
            $('#ff').form('load', row);
            url = "<?= base_url('coa/updateCoa') ?>?id=" + row.id;
        } else {
            Toast.fire({ icon: 'warning', title: 'Pilih data dulu' });
        }
    }

    function destroy() {
        var row = $('#dgGrid').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirm', 'Yakin ingin hapus COA: ' + row.coa + '?', function(r) {
                if (r) {
                    $.ajax({
                        url: "<?= base_url('coa/destroyCoa') ?>",
                        type: "POST",
                        data: { id: row.id },
                        dataType: "json",
                        success: function(result) {
                            if (result.errorMsg) {
                                Toast.fire({ icon: 'error', title: result.errorMsg });
                            } else {
                                Toast.fire({ icon: 'success', title: result.message });
                                $('#dgGrid').datagrid('reload');
                            }
                        },
                        error: function() {
                            Toast.fire({ icon: 'error', title: 'Gagal menghapus data' });
                        }
                    });
                }
            });
        } else {
            Toast.fire({ icon: 'warning', title: 'Pilih data dulu' });
        }
    }
</script>