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
						url="<?= base_url('accounting/getlistbank') ?>"
						pageSize="20"
						pageList="[10,20,50,75,100,125,150,200]"
						nowrap="true"
						width="100%"  
						height="auto"
						singleSelect="true">
						<thead>
							<tr>
								<th field="name" width="25%">Bank</th>  <!-- Set a flexible percentage for width -->
								<th field="account_bank" width="25%">Account Bank</th>
								<th field="balance" width="25%">Balance</th>
								<th field="coa_name" width="25%">Coa Name</th>
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
								<input id="search" placeholder="Please Enter Search a Bank" style="width:60%;" align="right">
								<a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.card-header -->
		<!-- Dialog -->
		<div id="dialog-form" class="easyui-window" title="Add New Bank" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
			$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
			<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
				<input type="hidden" name="id" id="id">
				
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="name" editable="true" name="name" style="width:100%" data-options="label:'Bank Name:',required:true">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="account_bank" editable="true" name="account_bank" style="width:100%" data-options="label:'Bank Number:',required:true">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-numberbox" id="amount" editable="true" name="amount" style="width:100%" data-options="label:'Amount:',required:true,precision:2">
				</div>
				
				<!-- New COA ID Dropdown -->
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="coa_id" name="coa_id" style="width:100%" data-options="label:'COA:',required:true,editable:true, 
						url:'<?= base_url('coa/getDataCoaOption') ?>', 
						method:'get',
						valueField:'id',
						textField:'text',
						onLoadSuccess:function(data){
							console.log(data);  // Optional: Log data to check if it's being loaded correctly
						},
						onSelect:function(record){
							console.log(record);  // Optional: Log selected record
						}">
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
	var url;

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
		// Validasi form
		if (!$('#ff').form('validate')) {
			$.messager.alert('Warning', 'Please fill all required fields', 'warning');
			return false;
		}

		var formData = new FormData($("#ff")[0]);

		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function(result) {
				if (result.errorMsg) {
					$.messager.alert('Error', result.errorMsg, 'error');
				} else {
					$.messager.alert('Success', result.message, 'info', function() {
						$('#dialog-form').dialog('close');
						$('#dgGrid').datagrid('reload');
					});
				}
			},
			error: function(xhr, status, error) {
				$.messager.alert('Error', 'An error occurred: ' + error, 'error');
			}
		});
	}

	function newForm() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Add New Bank Account');
		$('#ff').form('clear');
		url = '<?= base_url('accounting/saveBank') ?>';
	}

	function editForm() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit Bank Account: ' + row.name);
			$('#ff').form('load', row);
			
			// Set nilai amount untuk edit
			$('#amount').numberbox('setValue', row.balance);
			$('#id').val(row.id);
			url = '<?= base_url('accounting/updateBank') ?>?id=' + row.id;
		} else {
			$.messager.alert('Warning', 'Please select a bank account to edit', 'warning');
		}
	}

	function delete_item() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to delete bank account: ' + row.name + '?', function(r) {
				if (r) {
					$.post('<?= base_url('accounting/deleteBank') ?>', {
						id: row.id
					}, function(result) {
						if (result.errorMsg) {
							$.messager.alert('Error', result.errorMsg, 'error');
						} else {
							$.messager.alert('Success', result.message, 'info', function() {
								$('#dgGrid').datagrid('reload');
							});
						}
					}, 'json');
				}
			});
		} else {
			$.messager.alert('Warning', 'Please select a bank account to delete', 'warning');
		}
	}
</script>