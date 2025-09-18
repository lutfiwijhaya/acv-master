<section class="content-header"></section>
<div class="col-12">
	<div class="card">
	  <div class="easyui-panel" style="position:relative;overflow:auto;">
	    <div class="card-body">
	      <div class="easyui-layout">
	          <table id="dgGrid" title="<?= $title;?>" 
					toolbar="#toolbar" 
					class="easyui-datagrid" 
					rowNumbers="true" 
					pagination="true" 
					url="<?= base_url('admin/getsetitem/' . $id_barang) ?>" 
					pageSize="20" 
					pageList="[10,20,50,75,100,125,150,200]" 
					nowrap="true" 
					singleSelect="true">
					<thead>
						<tr>
							<th field="category" width="10%">Category</th>
							<th field="kode_barang" width="10%">Item Code</th>
							<th field="name" width="10%">Name</th>
							<th field="qty" width="10%">Quanity</th>
							<th field="status" width="10%">Status</th>
							<th field="remark" width="10%">Remark</th>
							<th field="doc" width="20%">Document</th>
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
            <input id="search" placeholder="Please Enter Search a Level" style="width:60%;" align="right">
            <a href="javascript:void(0);" id="btn_search" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
            <a href="javascript:void(0);" id="btn_back" class="easyui-linkbutton" iconCls="icon-back" plain="false" onclick="goBack()" style="margin-left: 90px;">Back</a>
        </div>
	              </div>
	          </div>
	        </div>
	    </div>
	  </div>
	  <!-- /.card-header -->
	  <!-- Dialog -->
	  <div id="dialog-form" class="easyui-window" title="Add New Menu" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
	      	<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
				<div style="margin-bottom:5px">
   				 <input class="easyui-textbox" id="item_id" editable="true" name="item_id" style="width:100%" data-options="label:'Item ID:',required:true">
				</div>
				<div style="margin-bottom:5px">
   				 <input class="easyui-textbox" id="name" editable="true" name="name" style="width:100%" data-options="label:'Name:',required:true">
				</div>
					<div style="margin-bottom:5px">
   				 <input class="easyui-textbox" id="qty" editable="true" name="qty" style="width:100%" data-options="label:'Quantity:',required:true">
				</div>
					<div style="margin-bottom:5px">
   				 <input class="easyui-textbox" id="status" editable="true" name="status" style="width:100%" data-options="label:'Status:',required:true">
				</div>
					<div style="margin-bottom:5px">
   				 <input class="easyui-textbox" id="remark" editable="true" name="remark" style="width:100%" data-options="label:'Remark:',required:true">
				</div>
				<!-- <input type="hidden" id="item_id" value="<?= $item_id; ?>"> -->

				
				<div style="margin-bottom:5px">
    			<label for="foto">Upload Foto:</label>
    			<input id="foto" name="foto" type="file" style="width:100%" data-options="label:'Upload Foto:',required:true">
    			<small style="display:block; color:#666;">Hanya file foto Maks 200kb (jpg, jpeg, png, Pdf)</small>
				</div>
				</form>
				<div id="dialog-buttons">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
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
        $('#btn_serach').click();
        }
    });
});

function doSearch(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val()
	});
}

function submitForm(){
	var fileInput = document.getElementById('foto');
	if (fileInput.files.length > 0) {
		var fileSize = fileInput.files[0].size; // ukuran file dalam byte
		var maxSize = 200 * 1024; // 200 KB dalam byte

		if (fileSize > maxSize) {
			alert('Ukuran file tidak boleh lebih dari 200KB');
			return false; // menghentikan submit form jika ukuran file terlalu besar
		}
	}

	alert($('#item_id').textbox('getValue'));

	
	$('#ff').form('submit', {
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('(' + result + ')');
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
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Item');
	$('#ff').form('clear');

	url = 'saveItemSet';
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Posisi' + row.posisi);
			$('#ff').form('load',row);
			url = 'updatePosisi?id='+row._id;
		}
}

function goBack() {
    // Fungsi ini akan kembali ke halaman sebelumnya
    window.history.back();
}





</script>