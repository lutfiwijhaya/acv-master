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
						url="<?= base_url('admin/getholv1/'. urlencode($depart)) ?>"
						pageSize="20"
						pageList="[10,15,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">
						<thead>
							<tr>
								<th field="id" hidden="yes" width="30%">id</th>
								<th field="name" width="30%">Nama</th>
								<th field="link" width="10%" formatter="formatLink">Open</th>
							</tr>
						</thead>
					</table>

					<div id="toolbar" style="padding: 10px">
						<div class="row ml-1">
							<div class="col-sm-6">
								<!-- <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add Value</a> -->
								<!-- <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addGroup()">Add Group</a> -->
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a> -->
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="destroy()">Delete</a> -->
							</div>

							<div class="col-sm-6 pull-right">
								<input id="search" placeholder="Please Enter Search a Group or Value" style="width:60%;" align="right">
								<a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Dialog -->
		<div id="dialog-form" class="easyui-window" title="Add New Menu" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
			<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="param_name" style="width:100%" data-options="label:'Parameter Name:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" name="param_group" style="width:100%"
						data-options="label:'Parameter Group:',required:true,valueField:'param_group',textField:'param_group',url:'<?= base_url('admin/getGroupParams') ?>'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="status" style="width:100%" data-options="label:'Status:'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="remark" style="width:100%" data-options="label:'Remark:'">
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
	$(document).ready(function() {
		
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
					Toast.fire({
						type: 'error',
						title: '' + result.errorMsg + '.'
					})
				} else {
					Toast.fire({
						type: 'success',
						title: '' + result.message + '.'
					})
					$('#dialog-form').dialog('close'); // close the dialog
					$('#dgGrid').datagrid('reload'); // reload the data
				}
			}
		});
	}

	function newForm() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Add New Value');
		$('#ff').form('clear');
		url = 'saveParams';
	}

	function addGroup() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Add New Group');
		$('#ff').form('clear');
		url = 'saveGroup';
	}

	function editForm() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit Parameter');
			$('#ff').form('load', row);
			url = 'updateParams?id=' + row.id;
		}
	}

	function destroy() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to destroy this Params ? ' + row.param_name, function(r) {
				if (r) {
					$.post('destroyParams', {
						id: row.id
					}, function(result) {
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
							$('#dgGrid').datagrid('reload');
						}
					}, 'json');
				}
			});
		}
	}



	function formatLink(value, row, index) {
    var idUser = "<?= $this->session->userdata('_id'); ?>";
    var name_dr = encodeURIComponent(row.name || ""); // Encoding URL dengan JavaScript

    if (row.link && row.link.trim() !== "") {
        return '<a href="' + row.link + '" target="_blank">Open</a>';
    } else {
        let table1 = "sd_ho_lv1"; // Ubah sesuai kebutuhan
        let table2 = "sd_ho_lv2"; // Ubah sesuai kebutuhan
        let url = "<?= base_url('admin/dr_lv2/') ?>" + row.id + "/" + table1 + "/" + table2 + "/" + name_dr;

        return '<a href="#" onclick="checkAccess(\'' + row.id + '\', \'' + table1 + '\', \'' + idUser + '\', \'' + url + '\')">Open</a>';
    }
}


	// Fungsi AJAX untuk validasi akses sebelum membuka link
	function checkAccess(id, table1, idUser, url) {
		$.ajax({
			url: "<?= base_url('admin/check_access/') ?>", // Buat endpoint di controller
			type: "POST",
			data: {
				id: id,
				table1: table1,
				idUser: idUser
			},
			dataType: "json",
			success: function(response) {
				if (response.status === "granted") {
					window.location.href = url; // Jika akses diizinkan, buka halaman
				} else {
					$.messager.alert('Peringatan', 'Access Denied! Anda tidak memiliki izin.', 'error');
				}
			},
			error: function(xhr, status, error) {
				$.messager.alert('Error', 'Terjadi kesalahan: ' + error, 'error');
			}
		});
	}
</script>