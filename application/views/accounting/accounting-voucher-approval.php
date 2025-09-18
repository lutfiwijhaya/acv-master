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
						url="<?= base_url('accounting/getvoucher_approval') ?>"
						pageSize="20"
						pageList="[10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">
						<thead>
							<tr>
								<th field="no_doc" width="auto">No Doc</th>
								<th field="account" width="auto">Account</th>
								<th field="incharge" width="auto">Incharge</th>
								<th field="date" width="auto">Date</th>
								<th field="recipient" width="auto">Recipient</th>
								<th field="recipient_bank" width="auto">Recipient Bank</th>
								<th field="bank_account" width="auto">Bank Account</th>
								<th field="due_date" width="auto">Due Date</th>
								<th field="link_set" width="10%" formatter="formatLinkset">Detail Items</th>
								<th field="action" width="10%" formatter="formatView">Voucher PDF</th>
								<th field="status" width="auto" formatter="formatStatus">Status</th>
								<th field="action_buttons" width="15%" formatter="formatActions">Action</th>
								<!-- <th field="link_barang" width="10%" formatter="formatLink">Detail Stock</th>
								<th field="link_set" width="10%" formatter="formatLinkset">Detail Set</th>
								<th field="path_foto" width="10%" formatter="formatAction">Foto</th> -->
							</tr>
						</thead>
					</table>

					<div id="toolbar" style="padding: 10px">
						<div class="row ml-1">
							<div class="col-sm-6">
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add</a>
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a> -->
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" onclick="hakakses()"><i class="fas fa-users-cog"></i> Hak Akses</a> -->
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="delete_item()">Delete</a> -->

							</div>

							<div class="col-sm-6 pull-right">
								<input id="search" placeholder="Please Enter Search a Level" style="width:60%;" align="right">
								<a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
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
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="no_doc" editable="true" name="no_doc" style="width:100%" data-options="label:'No Document:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="account" editable="true" name="account" style="width:100%" data-options="label:'Account:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="incharge" editable="false" name="incharge" style="width:100%" data-options="label:'Incharge:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="date" name="date" type="date" style="width:100%" data-options="label:'Date:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="spec" editable="true" name="spec" style="width:100%" data-options="label:'Spec:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="remark" editable="true" name="remark" style="width:100%" data-options="label:'Remark:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="amount" editable="true" name="amount" style="width:100%" data-options="label:'Amount:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="recipient" editable="true" name="recipient" style="width:100%" data-options="label:'Recipient:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="recipient_bank" editable="true" name="recipient_bank" style="width:100%" data-options="label:'Recipient Bank:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="bank_account" editable="true" name="bank_account" style="width:100%" data-options="label:'Bank Account:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" id="due_date" name="due_date" type="date" style="width:100%" data-options="label:'Due Date:',required:false">
				</div>

				<div style="margin-bottom:20px">
					<label for="foto">Invoice:</label>
					<input id="foto" name="foto" type="file" style="width:100%" data-options="label:'Upload Foto:',required:false">
					<small style="display:block; color:#666;">Hanya file Maks 200kb (jpg, jpeg, png, pdf)</small>
				</div>
				<div id="progress-bar" style="display:none; width: 100%; background: #ddd; border-radius: 5px; margin-top: 10px;">
					<div id="progress" style="width: 0%; height: 20px; background: green; color: white; text-align: center; border-radius: 5px;">0%</div>
				</div>
			</form>
			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
			</div>
		</div>


	</div>
</div>

<style>
	.l-btn {
		margin-right: 5px;
	}
</style>

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

	$(function() {
		$('.easyui-linkbutton').linkbutton();
	});

	function formatActions(value, row, index) {
		return `
        <a href="javascript:void(0);" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" iconCls="icon-ok" onclick="approveVoucher(${row.id})">
            <span class="l-btn-left">
                <span class="l-btn-text icon-ok">Approve</span>
            </span>
        </a>
        <a href="javascript:void(0);" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" iconCls="icon-cancel" onclick="rejectVoucher(${row.id})">
            <span class="l-btn-left">
                <span class="l-btn-text icon-cancel">Reject</span>
            </span>
        </a>
    `;
	}

	function approveVoucher(id) {
		$.post("<?= base_url('accounting/approveVoucher') ?>", {
			id: id
		}, function(result) {
			if (result.success) {
				$.messager.alert('Success', 'Voucher approved successfully!', 'info');
				$('#dgGrid').datagrid('reload'); // Reload data setelah update
			} else {
				$.messager.alert('Error', result.errorMsg, 'error');
			}
		}, 'json');
	}

	function rejectVoucher(id) {
		$.post("<?= base_url('accounting/rejectVoucher') ?>", {
			id: id
		}, function(result) {
			if (result.success) {
				$.messager.alert('Success', 'Voucher rejected successfully!', 'info');
				$('#dgGrid').datagrid('reload'); // Reload data setelah update
			} else {
				$.messager.alert('Error', result.errorMsg, 'error');
			}
		}, 'json');
	}


	function formatView(value, row, index) {
		return '<a href="javascript:void(0);" onclick="viewDetail(' + row.id + ')" class="easyui-linkbutton" iconCls="icon-search">View</a>';
	}

	function viewDetail(id) {
		var url = "<?= base_url('accounting/viewVoucher/') ?>" + id;
		window.open(url, '_blank'); // Buka di tab baru
	}

	function doSearch() {
		$('#dgGrid').datagrid('load', {
			search_data: $('#search').val()
		});
	}

	// function formatLink(value, row, index) {
	// 	return '<a href="<?= base_url('accounting/stock_details/') ?>' + row.id + '">Detail Stock</a>';
	// }

	function formatStatus(value, row, index) {
		switch (value) {
			case '0':
				return '<span style="color: orange;">Waiting Approval</span>';
			case '1':
				return '<span style="color: green;">Approved</span>';
			case '2':
				return '<span style="color: blue;">Paid</span>';
			default:
				return '<span style="color: red;">Unknown</span>';
		}
	}


	// function formatLinkset(value, row, index){
	//     return '<a href="<?= base_url('aaccounting/setitem/') ?>' + row.id + '">Detail Set</a>';
	// }




	function formatLinkset(value, row, index) {
		return '<a href="<?= base_url('accounting/details_items_voucher/') ?>' + row.id + '">Detail Items</a>';
	}



	function submitForm() {
		var fileInput = document.getElementById('foto');
		if (fileInput.files.length > 0) {
			var fileSize = fileInput.files[0].size; // ukuran file dalam byte
			var maxSize = 200 * 1024; // 200 KB dalam byte

			if (fileSize > maxSize) {
				alert('Ukuran file tidak boleh lebih dari 200KB');
				return false; // menghentikan submit form jika ukuran file terlalu besar
			}
		}

		var formData = new FormData($("#ff")[0]); // Gunakan FormData untuk menangani file
		$('#progress-bar').show();
		$('#progress').css('width', '0%').text('0%');

		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			contentType: false, // Jangan set content-type secara manual
			processData: false, // Jangan proses data secara otomatis
			dataType: 'json',
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						var percent = (evt.loaded / evt.total) * 100;
						$('#progress').css('width', percent + '%').text(Math.round(percent) + '%');
					}
				}, false);
				return xhr;
			},
			success: function(result) {
				if (result.errorMsg) {
					Toast.fire({
						type: 'error',
						title: result.errorMsg
					});
				} else {
					Toast.fire({
						type: 'success',
						title: result.message
					});
					$('#dialog-form').dialog('close');
					$('#dgGrid').datagrid('reload');
				}
				$('#progress-bar').hide(); // Sembunyikan progress bar setelah selesai
			},
			error: function(xhr, status, error) {
				Toast.fire({
					type: 'error',
					title: 'An error occurred during the upload.'
				});
				$('#progress-bar').hide(); // Sembunyikan progress bar jika error
			}
		});
	}

	function newForm() {
		// $('#dialog-form').dialog('open').dialog('setTitle', 'Add New Item');
		// $('#ff').form('clear');
		// // Ambil data user dari PHP
		// var namaUser = "<?= $this->session->userdata('nama'); ?>";

		// // Set nilai input incharge secara otomatis
		// $('#incharge').textbox('setValue', namaUser);

		// url = 'saveVoucher';

		window.location.href = "<?= base_url('accounting/form_voucher') ?>";

	}



	function delete_item() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to delete ? ' + row.kode_barang, function(r) {
				if (r) {
					$.post('delete_item', {
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

	function editForm() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit Item ' + row.kode_barang);
			$('#ff').form('load', row);

			// Set combobox level_1 dengan nilai yang sesuai dari data row
			$('#level_1').combobox('setValue', row.Level_1);

			// Untuk level_2, lakukan reload berdasarkan level_1 yang terpilih
			$('#level_2').combobox('reload', '<?= base_url('admin/getLevel2Params') ?>?level_1=' + row.Level_1);

			// Disable kode_barang saat mode edit


			// URL untuk submit form update
			url = 'updateItem?id=' + row.id;
		}

	}







	function formatFoto(value, row, index) {
		if (value) {
			return '<img src="' + value + '" style="width:50px;height:50px;">'; // Thumbnail foto
		} else {
			return 'No Image'; // Jika tidak ada gambar
		}
	}

	function formatAction(value, row, index) {
		if (row.path_foto) {
			return '<a href="javascript:void(0);" onclick="showPhoto(\'' + row.path_foto + '\')">Tampilkan</a>';
		} else {
			return 'No Image';
		}
	}

	function showPhoto(photoUrl) {
		if (photoUrl) {
			var photoWindow = $('<div/>').window({
				title: 'Foto Item',
				width: 500,
				height: 400,
				modal: true,
				closed: false,
				content: '<img src="' + photoUrl + '" style="width:100%; height:auto;">',
				onClose: function() {
					$(this).window('destroy');
				}
			});
		} else {
			alert('Gambar tidak tersedia.');
		}
	}
</script>