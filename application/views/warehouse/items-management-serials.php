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
						url="<?= base_url('admin/getserials/' . $item_id . '/' . $id_from) ?>"
						pageSize="20"
						pageList="[10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">
						<thead>
							<tr>
								<th field="serial_id" hidden="true" width="10%">Serial</th>
								<th field="serial" width="10%">Serial</th>
								<th field="kode_barang" width="10%">Kode Item</th>
								<!-- <th field="category" width="10%">Category</th> -->
								<th field="level_1" width="10%">Level 1</th>
								<th field="level_2" width="10%">Level 2</th>
								<th field="level_3" width="10%">Level 3</th>
								<!-- <th field="level_4" width="10%">Level 4</th> -->
								<th field="serial_remark" width="10%">Remark</th>
							</tr>
						</thead>
					</table>
					<div id="toolbar" style="padding: 10px">
						<div class="row ml-1">
							<div class="col-sm-6">
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm(<?= $item_id ?>, <?= $id_from ?>)">Add Serial</a>
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a> -->
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
		<div id="dialog-form" class="easyui-window" title="Add New Menu"
			data-options="modal:true,closed:true,iconCls:'icon-save',
        onOpen:function(){ $(this).window('center'); },
        onResize:function(){ $(this).window('center'); }"
			style="width:500px;max-width:100%;padding:30px 60px;">
			<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
				<!-- Hidden fields -->
				<input type="hidden" name="item_id" value="<?= $item_id; ?>">
				<input type="hidden" name="loc_id" value="<?= $id_from; ?>">
				<input type="hidden" name="loc" value="1">
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="serial" style="width:100%" data-options="label:'Serial:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="serial_remark" style="width:100%" data-options="label:'Remark:',required:false">
				</div>
			</form>
			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
					onclick="$('#dialog-form').window('close')">Cancel</a>
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

	function formatLink(value, row, index) {

		return '<a href="<?= base_url('admin/barang/') ?>' + row.id + '">Detail Stock</a>';
	}

	function submitForm() {
		$('#ff').form('submit', {
			url: url,
			onSubmit: function() {
				return $(this).form('validate'); // validasi form EasyUI
			},
			success: function(result) {
				try {
					var result = JSON.parse(result); // parsing JSON dari backend

					if (result.errorMsg) {
						Toast.fire({
							type: 'error',
							title: '' + result.errorMsg + '.'
						})
					} else {
						Toast.fire({
							type: 'success',
							title: '' + result.message + '.'
						})
						$('#dialog-form').dialog('close'); // tutup dialog
						$('#dgGrid').datagrid('reload'); // reload datagrid
					}
				} catch (e) {
					Toast.fire({
						icon: 'error',
						title: 'error!'
					});
				}
			}
		});
	}


	function newForm(item_id, loc_id) {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Add New Position');
		$('#ff').form('clear');

		// set hidden input
		$('#ff input[name=item_id]').val(item_id);
		$('#ff input[name=loc_id]').val(loc_id);
		$('#ff input[name=loc]').val(1);

		// ABSOLUTE URL ke controller
		url = "<?= base_url('admin/saveSerial') ?>";
	}




	function destroy() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to destroy this Serial ? ' + row.serial, function(r) {
				if (r) {
					$.post("<?= site_url('admin/destroySerial') ?>", {
						id: row.serial_id
					}, function(result) {
						if (result.errorMsg) {
							Toast.fire({
								icon: 'error',
								title: result.errorMsg
							})
						} else {
							Toast.fire({
								icon: 'success',
								title: result.message
							})
							$('#dgGrid').datagrid('reload');
						}
					}, 'json');

				}
			});
		}
	}




	function editForm() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit Posisi' + row.posisi);
			$('#ff').form('load', row);
			url = 'updatePosisi?id=' + row._id;
		}
	}

	function goBack() {
		// Fungsi ini akan kembali ke halaman sebelumnya
		window.history.back();
	}

	function hakakses() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			window.location.replace("akses/" + row._id);
		}
	}
</script>