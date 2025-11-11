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
                        url="<?= base_url('project_code/getProjectCode') ?>"
                        pageSize="50"
                        pageList="[10,20,50,75,100,125,150,200]"
                        nowrap="true"
                        singleSelect="true">
                        <thead>
                            <tr>
                                <th field="name" width="50%">Name</th>
                                <th field="code" width="50%">Code</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="toolbar" style="padding: 10px">
                        <div class="row ml-1">
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add</a>
                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a>
                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="destroy()">Delete</a>
                            </div>
                            <div class="col-sm-6 pull-right">
                                <input id="search" placeholder="Search a Project" style="width:60%;" align="right">
                                <a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dialog -->
        <div id="dialog-form" class="easyui-window" title="Add New Project Code" data-options="modal:true,closed:true,iconCls:'icon-save',inline:true,onResize:function(){ $(this).window('hcenter'); }" style="width:100%;max-width:500px;padding:30px 60px;">
            <form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="name" style="width:100%" data-options="label:'Project Name:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="code" style="width:100%" data-options="label:'Project Code:',required:true">
                </div>
            </form>
            <div id="dialog-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dgGrid').datagrid({
            minHeight: 410,
            maxHeight: 520,
        });

        $('#search').keyup(function(event) {
            if (event.keyCode == 13) {
                $('#btn_serach').click();
            }
        });
    });

    function doSearch() {
        $('#dgGrid').datagrid('load', {
            search_data: $('#search').val()
        });
    }

    function submitForm() {
        var string = $("#ff").serialize();
        $('#ff').form('submit', {
            url: url,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    alert(result.errorMsg);
                } else {
                    alert(result.message);
                    $('#dialog-form').dialog('close');
                    $('#dgGrid').datagrid('reload');
                }
            }
        });
    }

    function newForm() {
        $('#dialog-form').dialog('open').dialog('setTitle', 'Add New Project');
        $('#ff').form('clear');
        url = 'saveProjectCode';
    }

    function editForm() {
        var row = $('#dgGrid').datagrid('getSelected');
        if (row) {
            $('#dialog-form').dialog('open').dialog('setTitle', 'Edit Project ' + row.name);
            $('#ff').form('load', row);
            url = 'updateProjectCode?id=' + row.id;
        }
    }

    function destroy() {
        var row = $('#dgGrid').datagrid('getSelected');
        if (row) {
            if (confirm('Are you sure you want to delete this project?')) {
                $.post('destroyProjectCode', {
                    id: row.id
                }, function(result) {
                    if (result.errorMsg) {
                        alert(result.errorMsg);
                    } else {
                        alert(result.message);
                        $('#dgGrid').datagrid('reload');
                    }
                }, 'json');
            }
        }
    }
</script>
