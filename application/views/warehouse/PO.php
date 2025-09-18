<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <div class="easyui-layout">
                    <table id="dgGrid" title="Purchase Order" 
                        toolbar="#toolbar" 
                        class="easyui-datagrid" 
                        rowNumbers="true" 
                        pagination="true" 
                        url="<?= base_url('admin/getPO') ?>" 
                        pageSize="20" 
                        pageList="[10,20,50,75,100,125,150,200]" 
                        nowrap="true" 
                        singleSelect="true">
                        <thead>
                            <tr>
                                <th field="po_number" width="15%">PO Number</th>
                                <th field="supplier_name" width="15%">Supplier</th>
                                <th field="expeted_date" width="15%">Expected Date</th>
                                <th field="total_amount" width="15%">Total Amount</th>
                                <th field="status" width="15%">Status</th>
                                <th field="po_date" width="15%">PO Date</th>
                                <th field="file" width="10%">File</th>
                                <th field="po_description" width="15%">Description</th>
                            </tr>
                        </thead>
                    </table>

                    <div id="toolbar" style="padding: 10px">
                        <div class="row ml-1">
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add</a>
                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a>
                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="delete_item()">Delete</a>
                            </div>

                            <div class="col-sm-6 pull-right">
                                <input id="search" placeholder="Search PO" style="width:60%;" align="right">
                                <a href="javascript:void(0);" id="btn_search" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- Dialog -->
        <div id="dialog-form" class="easyui-window" title="Add/Edit Purchase Order" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
            $(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
         <form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
    <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="po_number" style="width:100%" data-options="label:'PO Number:',required:true">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-combobox" id="Supplier_id" name="Supplier_id" style="width:100%" 
            data-options="label:'Supplier:',required:true,valueField:'id',textField:'nama',url:'<?= base_url('admin/getComboSupplier') ?>'">
    </div>
    <div style="margin-bottom:20px">
   					 <input class="easyui-textbox" id="expeted_date" name="expeted_date" type="date" style="width:100%" data-options="label:'Expected Date:',required:true">
	</div>
    <div style="margin-bottom:20px">
        <input class="easyui-numberbox" name="total_amount" style="width:100%" data-options="label:'Total Amount:',required:true">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="status" style="width:100%" data-options="label:'Status:'">
    </div>
    <div style="margin-bottom:20px">
   					 <input class="easyui-textbox" id="po_date" name="po_date" type="date" style="width:100%" data-options="label:'PO Date:',required:true">
	</div>
    <div style="margin-bottom:20px">
        <input class="easyui-filebox" name="file" style="width:100%" data-options="label:'Upload File:'">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="po_description" style="width:100%" data-options="label:'Description:',multiline:true">
    </div>
    <div style="margin-bottom:20px">
					<textarea class="easyui-textbox" name="itesdesc" style="width:100%" data-options="label:'Item Description :',required:true,multiline:true,height:100"></textarea>
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
$(document).ready(function(){
    $('#dgGrid').datagrid({
        minHeight:410,
        maxHeight:520,
    });
    $('#search').keyup(function(event){
        if(event.keyCode == 13){
            $('#btn_search').click();
        }
    });
});

function doSearch(){
    $('#dgGrid').datagrid('load',{
        search_data: $('#search').val()
    });
}
 var id_sup ='';

 $('#Supplier_id').combobox({
    onSelect: function(record) {
		
        id_sup = record.id; 
		
		
    }
});

function submitForm(){

    $('#ff').append('<input type="hidden" name="id_sup" value="'+id_sup+'">');

    $('#ff').form('submit', {
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
                Toast.fire({
                    type: 'error',
                    title: '' + result.errorMsg + '.'
                });
            } else {
                Toast.fire({
                    type: 'success',
                    title: '' + result.message + '.'
                });
                $('#dialog-form').dialog('close'); // close the dialog
                $('#dgGrid').datagrid('reload'); // reload the user data
            }
        }
    });
}

function newForm(){
    $('#dialog-form').dialog('open').dialog('setTitle','Add New PO');
    $('#ff').form('clear');
    url = 'savePO'; // Ganti dengan URL penyimpanan data PO
}

function editForm(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $('#dialog-form').dialog('open').dialog('setTitle','Edit PO ' + row.po_number);
        $('#ff').form('load', row);
        url = 'updatePO?id='+row.id; // Ganti dengan URL pembaruan data PO
    }
}

function delete_item(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to delete PO number ' + row.po_number + '?', function(r){
            if (r){
                $.post('deletePO', {id:row.id}, function(result){
                    if (result.errorMsg){
                        Toast.fire({
                            type: 'error',
                            title: '' + result.errorMsg + '.'
                        });
                    } else {
                        Toast.fire({
                            type: 'success',
                            title: '' + result.message + '.'
                        });
                        $('#dgGrid').datagrid('reload');
                    }
                }, 'json');
            }
        });
    }
}
</script>
