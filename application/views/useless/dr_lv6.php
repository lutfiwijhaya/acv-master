<section class="content-header">
	<h1><?= htmlspecialchars(urldecode($dr_name), ENT_QUOTES, 'UTF-8') ?></h1>
</section>
<div class="col-12">
	<div class="card">
		<div class="easyui-panel" style="position:relative;overflow:auto;">
			<div class="card-body">
				<div class="easyui-layout">
					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-6">
							<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="toggleTable()">Show/Hide Directory</a>
							<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add Directory</a>
							<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Rename</a>
							<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="destroy()">Delete</a>
						</div>

						<div class="col-md-6" style="display: flex; justify-content: flex-end; align-items: center;">
							<input id="search" placeholder="Search Directory" style="width: auto; flex-grow: 1; margin-right: 10px;">
							<a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton" style="margin-right: 190px;" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>

							<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-back" plain="false" onclick="goBack()" style="margin-left: 10px;">Back</a>
						</div>
					</div>
					<table id="dgGrid"
						toolbar="#toolbar2"
						class="easyui-datagrid"
						rowNumbers="true"
						pagination="true"
						url="<?= base_url('admin/get_dr_lv6/' . urlencode($lv5_id) . '/' . urlencode($table1) . '/' . urlencode($table2)) ?>"
						pageSize="10"
						pageList="[5,10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">
						<thead>
							<tr>
								<th field="lv6_id" hidden="yes" width="30%">id</th>
								<th field="name" width="30%">Nama</th>
								<th field="link" width="10%" formatter="formatLink">Open</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-12">
	<div class="card">
		<div class="easyui-panel" style="position:relative;overflow:auto;">
			<div class="card-body">
				<div class="easyui-layout">
					<table id="dgGrid_file" title="File"
						toolbar="#toolbar_file"
						class="easyui-datagrid"
						rowNumbers="true"
						pagination="true"
						url="<?= base_url('admin/get_dr_lv6_file/' . urlencode($lv5_id) . '/' . urlencode($table1) . '/' . urlencode($table2)) ?>"
						pageSize="10"
						pageList="[5,10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="false"
						checkOnSelect="true"
						selectOnCheck="true">
						<thead>
							<tr>
								<th field="ck" checkbox="true"></th>
								<th field="id_dr" hidden="true" width="auto">ID DR</th>
								<th field="incharge" width="auto">Incharge</th>
								<th field="subject" hidden="true" width="auto">Subject</th>
								<th field="name_file" width="auto">File Name</th>
								<th field="upload_date" width="auto">Upload Date</th>
								<th field="size" width="auto" formatter="formatFileSize">Size</th>
								<th field="type_file" width="auto">Type File</th>
								<th field="link_dr" width="auto" formatter="formatLink_open">Open/Download</th>
								<th field="remark" width="auto">Remark</th>
							</tr>
						</thead>
					</table>
					<div id="toolbar_file" style="padding: 10px">
						<div class="row ml-1">
							<div class="col-sm-6">
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newFile()">Add File</a>
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="downloadCheckedFiles()">Download</a>
								<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="openRenameFileDialog()">Rename File</a>
								<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="delete_file()">Delete</a>
							</div>
							<div class="col-md-6" style="display: flex; justify-content: flex-end; align-items: center;">
								<input id="search_file" placeholder="Search File" style="width: auto; flex-grow: 1; margin-right: 10px;">
								<a href="javascript:void(0);" id="btn_serach_file" style="margin-right: 250px;" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearchFile()">Search</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<!-- Dialog -->
<div id="dialog-form" class="easyui-window" title="Add New Menu" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
	<form id="ff_directory" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
		<div style="margin-bottom:20px">
			<input type="hidden" name="id" id="id">
			<input type="hidden" name="table2" id="table2">
			<input type="hidden" name="column_id" id="column_id">
			<input class="easyui-textbox" name="name" style="width:100%" data-options="label:'Directory Name:',required:true">
		</div>
	</form>
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitFormDirectory()">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
	</div>
</div>

<div id="dialog-form2" class="easyui-window" title="Upload File or Insert Link" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    			$(this).window('hcenter');}" style="width:100%;max-width:600px;padding:20px;">
	<div class="easyui-tabs" style="width:100%;height:auto;">
		<div title="Upload File" style="padding:10px;">
			<form id="ff" class="easyui-form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_table" id="id_table">
				<input type="hidden" name="table1" id="table1">
				<input type="hidden" name="id_user" id="id_user">
				<input type="hidden" name="subject" id="subject">
				<input type="hidden" name="file_name" id="file_name">
				<!-- <div style="margin-bottom:20px">
							<input class="easyui-textbox" id="subject" name="subject" style="width:90%" data-options="label:'Subject:'">
						</div> -->
				<div style="margin-bottom:0px">
					<input class="easyui-filebox" id="file" name="file" style="width:90%"
						data-options="label:'Upload File:',required:true,accept:'*'">
				</div>
				<div id="progress-bar" style="display:none; margin-top:20px;">
					<div id="progress" style="width:0%; background-color: green; color: white; padding: 3px; text-align: center;">0%</div>
				</div>
				<div style="margin-bottom:0px">
					<input class="easyui-textbox" name="type_file" id="type_file" style="width:90%" data-options="label:'File Type:',readonly:true">
				</div>
				<div style="margin-bottom:0px">
					<input class="easyui-textbox" name="size" id="file_size" style="width:90%" data-options="label:'File Size:',readonly:true">
				</div>
				<div style="margin-bottom:0px">
					<input class="easyui-textbox" id="remark" name="remark" style="width:90%" data-options="label:'Remark:'">
				</div>
			</form>
		</div>

		<div title="Multiple Upload" style="padding:20px">
			<form id="form_multi_upload" method="post" enctype="multipart/form-data">
				<table style="width:100%">
					<input type="hidden" name="subject_multi" id="subject_multi">
					<tr>
						<td>Upload Files</td>
						<td>
							<input type="file" id="multi_files" name="multi_files[]" multiple style="width:100%">
							<p style="font-size:12px;color:gray">
								Select more than one file (use Ctrl or Shift).</p>

							<div id="file_list_container" style="margin-top: 10px; border: 1px solid #eee; padding: 10px; min-height: 50px; background-color: #f9f9f9;">
								<p style="margin: 0;">No files selected yet.</p>
							</div>
						</td>
					</tr>
					<div id="progress-bar-multi" style="width: 100%; background-color: #f3f3f3; border: 1px solid #ccc; display: none;">
						<div id="progress-multi" style="width: 0%; background-color: #4CAF50; text-align: center; color: white;">0%</div>
					</div>
					<tr>
						<td>Remark</td>
						<td>
							<input class="easyui-textbox" name="remark_multi" multiline="true" style="width:100%;height:60px">
						</td>
					</tr>
					<input type="hidden" name="id_user_multi" id="id_user_multi">
					<input type="hidden" name="table1_multi" id="table1_multi">
					<input type="hidden" name="id_table_multi" id="id_table_multi">
				</table>
				<br>
			</form>
		</div>
	</div>
	<div id="dialog-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="cancelform2()">Cancel</a>
	</div>
</div>
<div id="dialog-rename-file" class="easyui-window" title="Rename File" data-options="modal:true,closed:true,iconCls:'icon-edit',inline:false" style="width:100%;max-width:600px;padding:20px;">
	<form id="ff_rename_file" class="easyui-form" method="post" data-options="novalidate:false">
		<input type="hidden" name="id_dr_hidden" id="id_dr_hidden">
		<input type="hidden" name="old_full_file_name_hidden" id="old_full_file_name_hidden">
		<div style="margin-bottom:20px">
			<input class="easyui-textbox" name="new_display_name" id="new_display_name" style="width:100%" data-options="label:'New File Name:',required:true">
		</div>
	</form>
	<div id="dialog-buttons-rename">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitRenameFile()">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-rename-file').dialog('close')">Cancel</a>
	</div>
</div>


<script type="text/javascript">
	var selectedFileIdDr;
	var selectedFileOldFullName;
	$(document).ready(function() {
		$('#search').keyup(function(event) {
			if (event.keyCode == 13) {
				$('#btn_serach').click();
			}
		});

		var tableWrapper = $('#dgGrid').closest('.datagrid-wrap');
		tableWrapper.toggle();
	});

	function formatFileSize(value, rowData, rowIndex) {
		if (value === null || value === undefined || isNaN(value)) {
			return 'N/A'; // Atau string default lainnya untuk nilai tidak valid
		}

		let bytes = parseFloat(value);


		bytes = bytes * 1024; // Ubah input KB ke Bytes

		if (bytes === 0) {
			return '0 Bytes'; // Atau '0 KB' jika Anda ingin unit awal selalu KB
		}

		const k = 1024;
		const dm = 2; // Desimal tempat
		const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

		const i = Math.floor(Math.log(bytes) / Math.log(k));

		// Periksa untuk memastikan 'i' tidak negatif (jika bytes sangat kecil) atau terlalu besar
		if (i < 0) {
			return parseFloat(bytes.toFixed(dm)) + ' Bytes'; // Handle kasus sangat kecil, tetap dalam Bytes
		}
		if (i >= sizes.length) { // Jika melebihi unit terbesar yang didefinisikan
			return parseFloat((bytes / Math.pow(k, sizes.length - 1)).toFixed(dm)) + ' ' + sizes[sizes.length - 1];
		}


		return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
	}

	function formatFileName(value, rowData, rowIndex) {
		if (value) {


			const timestampLength = 18; // 'YYYYMMDDHHmmssSSSS'
			const separatorLength = 1; // '_'
			const totalPrefixLength = timestampLength + separatorLength; // 20 karakter


			if (value.length > totalPrefixLength && value.charAt(timestampLength) === '_') {
				return value.substring(totalPrefixLength); // Ambil string setelah timestamp dan underscore
			}
		}

		return value; // Jika format tidak cocok atau kosong, kembalikan nilai asli
	}



	function doSearch() {
		$('#dgGrid').datagrid('load', {
			search_data: $('#search').val()
		});
	}



	function doSearchFile() {
		$('#dgGrid_file').datagrid('load', {
			search_data: $('#search_file').val()
		});
	}


	function formatLink_open(value, row) {
		if (!value || !row || !row.id_dr) { // Validasi dasar: pastikan value, row, dan id_dr ada
			return '';
		}

		let fileType = row.type_file.toLowerCase(); // Ambil tipe file dari data baris
		let isImage = fileType.includes("image"); // Cek jika tipe adalah gambar
		let isPdf = fileType.includes("pdf"); // Cek jika tipe adalah PDF

		// URL dasar ke endpoint PHP yang akan mencatat log dan mengirim file
		// Pastikan base_url() tersedia di JavaScript, biasanya dari PHP echo
		const logAndServeUrlBase = '<?= base_url('admin/log_and_serve_file/') ?>';

		let actionTypeParam; // Parameter 'action' untuk URL
		let linkText; // Teks yang akan ditampilkan di link
		let linkStyle; // Gaya CSS untuk link
		let targetAttribute; // Atribut 'target' untuk link

		if (isPdf || isImage) {
			// Jika PDF atau Gambar, kita asumsikan tujuan utamanya adalah 'view'
			actionTypeParam = 'view';
			linkText = 'View File';
			linkStyle = 'color: blue; text-decoration: underline;';
			targetAttribute = '_blank'; // Buka di tab/jendela baru untuk melihat
		} else {
			// Untuk tipe file lainnya, kita asumsikan tujuan utamanya adalah 'download'
			actionTypeParam = 'download';
			linkText = 'Download';
			linkStyle = 'color: green; text-decoration: underline;';
			targetAttribute = '_blank'; // Tetap buka di tab baru, server akan memaksa download
			// Atau bisa juga "" jika ingin di tab yang sama dan langsung download
		}

		// Bangun URL lengkap ke endpoint PHP logging
		// row.id_dr akan dikirim sebagai segmen URL, dan actionTypeParam sebagai parameter GET
		let finalLinkUrl = `${logAndServeUrlBase}${row.id_dr}?action=${actionTypeParam}`;

		// Kembalikan tag <a> yang menunjuk ke endpoint PHP logging
		return `<a href="${finalLinkUrl}" target="${targetAttribute}" style="${linkStyle}">${linkText}</a>`;
	}



	var id = "<?= isset($lv5_id) ? $lv5_id : '' ?>";
	var table1 = "<?= isset($table1) ? $table1 : '' ?>";
	var table2 = "<?= isset($table2) ? $table2 : '' ?>";
	var idUser = "<?= $this->session->userdata('_id'); ?>";
	var column_id = "lv5_id";


	function newForm() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Add New Directory');
		$('#ff_directory').form('clear');
		$('#id').val(id);
		$('#table2').val(table2);
		$('#column_id').val(column_id);
		url = "<?= base_url('admin/saveDirectory') ?>"; // Gunakan tanda '=' bukan ':'
	}



	function submitFormDirectory() {
		// var string = $("#ff_directory").serialize(); // Baris ini tidak digunakan, bisa dihapus jika tidak ada tujuan lain.
		// EasyUI's form('submit') akan melakukan serialisasi sendiri.

		$('#ff_directory').form('submit', {
			url: url, // Menggunakan variabel 'url' yang disetel oleh editForm()

			onSubmit: function() {
				// Ini akan memicu validasi form EasyUI
				return $(this).form('validate');
			},
			success: function(result) {
				// EasyUI's form('submit') kadang mengembalikan respons mentah yang perlu di-eval
				var result = eval('(' + result + ')');

				if (result.errorMsg) {
					Toast.fire({
						icon: 'error', // Ubah 'type' menjadi 'icon' untuk SweetAlert2 modern
						title: '' + result.errorMsg + '.'
					});
				} else {
					Toast.fire({
						icon: 'success', // Ubah 'type' menjadi 'icon'
						title: '' + result.message + '.'
					});
					$('#dialog-form').dialog('close'); // Tutup dialog
					$('#dgGrid').datagrid('reload'); // Reload datagrid untuk menampilkan perubahan
				}
			},
			error: function(jqXHR, textStatus, errorThrown) { // Tambahkan penanganan error AJAX
				Toast.fire({
					icon: 'error',
					title: 'Terjadi kesalahan saat koneksi ke server.'
				});
				console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
			}
		});
	}



	function downloadCheckedFiles() {
		var rows = $('#dgGrid_file').datagrid('getChecked');
		if (rows.length === 0) {
			$.messager.alert('Info', 'Please check at least one file.', 'info');
			return;
		}
		var fileIds = rows.map(row => row.id_dr); // atau bisa pakai row.name_file, tergantung sistemmu
		$.ajax({
			type: 'POST',
			url: '<?= base_url("admin/download_bulk_files") ?>', // Buat controller ini
			data: {
				ids: fileIds
			},
			dataType: 'json',
			success: function(response) {
				if (response.status === 'ok') {
					window.location.href = response.download_url; // download ZIP
				} else {
					$.messager.alert('Error', response.message || 'Download failed.');
				}
			},
			error: function() {
				$.messager.alert('Error', 'Server error occurred.');
			}
		});
	}



	function editForm() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit Parameter');
			$('#ff_directory').form('load', row);
			url = '<?= base_url("admin/updatenamedirectory") ?>?id=' + row.lv6_id + '&table=sd_ho_lv6';
			console.log("URL yang disetel:", url);
			console.log("Data row terpilih:", row);
		}
	}




	function destroy() {
		var selectedRow = $('#dgGrid').datagrid('getSelected'); // Ganti 'nama_datagrid' dengan ID datagrid Anda
		if (selectedRow) {
			$.messager.confirm('Confirm', 'Delete ' + selectedRow.name + '?', function(r) {
				if (r) {
					$.ajax({
						url: '<?php echo base_url('admin/destroydirectory/' . urlencode($table2)); ?>', // Menggunakan base_url CodeIgniter
						type: 'POST',
						data: {
							id: selectedRow.lv6_id
						}, // Asumsikan ada kolom 'id' di data Anda
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								$('#dgGrid').datagrid('reload'); // Muat ulang datagrid
								$('#dgGrid').datagrid('clearSelections'); // Hapus seleksi
								Toast.fire({
									type: 'success',
									title: 'Data deleted successfully.'
								})
							} else {
								Toast.fire({
									type: 'Error',
									title: '' + response.message + '.'
								})
							}
						},
						error: function() {
							Toast.fire({
								type: 'Error',
								title: 'An error occurred while deleting data.'
							})
						}
					});
				}
			});
		} else {
			Toast.fire({
				type: 'Error',
				title: 'Please select an item to delete.'
			})
		}
	}



	function delete_file() {
		var rows = $('#dgGrid_file').datagrid('getChecked'); // Ambil semua baris yang dicentang
		if (rows.length === 0) {
			Toast.fire({
				icon: 'error',
				title: 'Please select at least one file to delete.'
			});
			return;
		}
		$.messager.confirm('Confirm', 'Are you sure you want to delete ' + rows.length + ' file(s)?', function(r) {
			if (r) {
				// Ambil semua ID dari checkbox
				var ids = rows.map(function(row) {
					return row.id_dr;
				});
				var formData = new FormData();
				ids.forEach(function(id_value) {
					formData.append('ids[]', id_value); // Menambahkan setiap ID dengan kunci 'ids[]'
				});
				// --- Akhir Perubahan Penting ---
				$.ajax({
					url: '<?php echo base_url('admin/destroyfile'); ?>',
					type: 'POST',
					data: formData, // Gunakan formData yang sudah kita buat
					contentType: false, // Penting saat menggunakan FormData
					processData: false, // Penting saat menggunakan FormData
					// traditional: true, // Baris ini tidak lagi diperlukan karena kita sudah memformat manual
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$('#dgGrid_file').datagrid('reload');
							$('#dgGrid_file').datagrid('clearChecked');
							Toast.fire({
								icon: 'success',
								title: response.message
							});
						} else {
							Toast.fire({
								icon: 'error',
								title: response.message
							});
						}
					},
					error: function() {
						Toast.fire({
							icon: 'error',
							title: 'An error occurred while deleting data.'
						});
					}
				});
			}
		});
	}


	function openRenameFileDialog() {
		var row = $('#dgGrid_file').datagrid('getSelected');
		if (row) {
			selectedFileIdDr = row.id_dr; // Ambil ID dari kolom 'id_dr'
			selectedFileOldFullName = row.name_file; // Ambil nama file lengkap lama
			// Gunakan formatter formatFileName untuk mendapatkan nama file tanpa timestamp
			var currentDisplayName = formatFileName(row.name_file, row, -1);
			$('#dialog-rename-file').dialog('open').dialog('setTitle', 'Rename File');
			$('#ff_rename_file').form('clear'); // Bersihkan form
			$('#new_display_name').textbox('setValue', currentDisplayName); // Set nilai nama display saat ini
			// Simpan nilai di hidden input untuk dikirim ke backend
			$('#id_dr_hidden').val(selectedFileIdDr);
			$('#old_full_file_name_hidden').val(selectedFileOldFullName);
		} else {
			$.messager.alert('Warning', 'Please select a file to rename.', 'warning');
		}
	}


	function submitRenameFile() {
		$('#ff_rename_file').form('submit', {
			url: '<?= base_url("admin/rename_file_action") ?>', // Endpoint baru di PHP
			onSubmit: function(param) {
				// Pastikan data dari hidden input terkirim
				param.id_dr = $('#id_dr_hidden').val();
				param.old_full_file_name = $('#old_full_file_name_hidden').val();
				// Lakukan validasi form
				return $(this).form('validate');
			},
			success: function(result) {
				var result = eval('(' + result + ')'); // Parsing JSON
				if (result.errorMsg) {
					Toast.fire({
						icon: 'error',
						title: '' + result.errorMsg + '.'
					});
				} else {
					Toast.fire({
						icon: 'success',
						title: '' + result.message + '.'
					});
					$('#dialog-rename-file').dialog('close'); // Tutup dialog
					$('#dgGrid_file').datagrid('reload'); // Reload datagrid
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Toast.fire({
					icon: 'error',
					title: 'Terjadi kesalahan saat berkomunikasi dengan server.'
				});
				console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
			}
		});
	}




	function formatLink(value, row, index) {
		if (row.link && row.link.trim() !== "") {
			return '<a href="' + row.link + '" target="_blank">Open</a>';
		} else if (table1 === "sd_ho_lv5") {
			let newTable1 = "sd_ho_lv6";
			let newTable2 = "sd_ho_lv7";
			// Ganti '/' dengan karakter lain, misalnya '-'
			let safeName = row.name.replace(/\//g, '-');
			return '<a href="<?= base_url('admin/dr_lv7/') ?>' + row.lv6_id + '/' + newTable1 + '/' + newTable2 + '/' + encodeURIComponent(safeName) + '">Open</a>';
		}
	}


	$('#file').filebox({
		onChange: function() {
			const input = $('input[name="file"]')[0];
			const file = input.files[0];

			if (file) {
				const fileName = file.name;
				// Validasi karakter terlarang
				const invalidChars = /[&%#*?<>:"\\|]/;
				if (invalidChars.test(fileName)) {
					Toast.fire({
						icon: 'error',
						title: 'File name contains forbidden characters: & % # * ? < > : " \\ |'
					});

					// Reset field file dan textbox terkait
					$('#file').filebox('clear');
					$('#file_name').textbox('setValue', '');
					$('#file_size').textbox('setValue', '');
					$('#type_file').textbox('setValue', '');
					return;
				}
				const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
				const fileExtension = fileName.split('.').pop().toLowerCase();
				let fileType = 'Other';
				switch (fileExtension) {
					case 'jpg':
					case 'png':
					case 'gif':
					case 'jpeg':
						fileType = 'Image';
						break;
					case 'pdf':
						fileType = 'PDF Document';
						break;
					case 'doc':
					case 'docx':
						fileType = 'Word Document';
						break;
					case 'xls':
					case 'xlsx':
						fileType = 'Excel Document';
						break;
					case 'dwg':
					case 'dxf':
						fileType = 'AutoCAD File';
						break;
				}
				$('#file_name').textbox('setValue', fileName);
				$('#file_size').textbox('setValue', fileSizeMB + ' MB');
				$('#type_file').textbox('setValue', fileType);
			} else {
				$('#file_name').textbox('setValue', '');
				$('#file_size').textbox('setValue', '');
				$('#type_file').textbox('setValue', '');
			}
		}
	});





	function newFile() {
		$('#dialog-form2').dialog('open').dialog('setTitle', 'Upload New File');
		$('#ff').form('clear');
		$('#id_table').val(id);
		$('#table1').val(table1);
		$('#id_user').val(idUser);
		$('#id_table_link').val(id);
		$('#table1_link').val(table1);
		$('#id_user_link').val(idUser);
		url = '<?= base_url('admin/saveDrFile') ?>';
	}


	function goBack() {
		window.history.back(); // Kembali ke halaman sebelumnya
	}


	function toggleTable() {
		var tableWrapper = $('#dgGrid').closest('.datagrid-wrap');
		tableWrapper.toggle();
		$('#dgGrid').datagrid('reload');
	}


	function submitForm() {
		// Dapatkan tab yang aktif
		var activeTab = $('.easyui-tabs').tabs('getSelected').panel('options').title;
		if (activeTab === 'Upload File') {
			submitForm_upload();
		} else if (activeTab === 'Insert Link') {
			// Eksekusi fungsi insert link jika tab "Insert Link" aktif
			submitForm_link();
		} else if (activeTab === 'Multiple Upload') {
			// Eksekusi fungsi insert link jika tab "Insert Link" aktif
			submitMultiUpload();
		}
	}


	function submitForm_upload() {
		var formData = new FormData($("#ff")[0]);
		// Show the progress bar
		$('#progress-bar').show();
		$('#progress').css('width', '0%').text('0%');
		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			contentType: false, // Do not set content type
			processData: false, // Do not process data
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
					$('#dialog-form2').dialog('close');
					$('#dgGrid_file').datagrid('reload');
				}

				// Hide the progress bar after upload completes
				$('#progress-bar').hide();
			},
			error: function(xhr, status, error) {
				Toast.fire({
					type: 'error',
					title: 'An error occurred during the upload.'
				});

				// Hide the progress bar in case of error
				$('#progress-bar').hide();
			}
		});
	}


	function submitForm_link() {
		var url = '<?= base_url('admin/saveDr_link') ?>'; // Inisialisasi URL di sini
		var formData = new FormData($("#link-form")[0]);
		// Debug: Cek isi FormData sebelum dikirim
		console.log("FormData yang akan dikirim:");
		for (var pair of formData.entries()) {
			console.log(pair[0] + ': ' + pair[1]);
		}
		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			contentType: false, // Jangan set content type
			processData: false, // Jangan proses data
			dataType: 'json',
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
					$('#dialog-form2').dialog('close');
					$('#dgGrid_file').datagrid('reload');
				}
				$('#progress-bar').hide();
			},
			error: function(status, error) {
				Toast.fire({
					type: 'error',
					title: 'An error occurred during the insert link.'
				});
				$('#progress-bar').hide();
			}
		});
	}


	function submitMultiUpload() {
		const files = $('#multi_files')[0].files;
		if (files.length === 0) {
			Toast.fire({
				icon: 'warning',
				title: 'Pilih minimal satu file!'
			});
			return;
		}
		// --- Validasi Jumlah File ---
		const MAX_FILES = 20;
		if (files.length > MAX_FILES) {
			Toast.fire({
				icon: 'error',
				title: 'Jumlah file melebihi batas! Maksimal ' + MAX_FILES + ' file.'
			});
			return;
		}
		// --- Validasi Ukuran Total File ---
		const MAX_TOTAL_SIZE_BYTES = 1 * 1024 * 1024 * 1024; // 1 GB dalam Bytes
		let totalSize = 0;
		for (let i = 0; i < files.length; i++) {
			totalSize += files[i].size;
		}
		if (totalSize > MAX_TOTAL_SIZE_BYTES) {
			const maxSizeGB = MAX_TOTAL_SIZE_BYTES / (1024 * 1024 * 1024);
			Toast.fire({
				icon: 'error',
				title: 'Ukuran total file melebihi batas! Maksimal ' + maxSizeGB + ' GB.'
			});
			return;
		}
		// Validasi karakter terlarang di nama file
		const invalidChars = /[&%#*?<>:"\\|]/;
		for (let file of files) {
			if (invalidChars.test(file.name)) {
				Toast.fire({
					icon: 'error',
					title: 'File "' + file.name + '" Nama file mengandung karakter terlarang: & % # * ? < > : " \\ |'
				});
				return;
			}
		}
		$('#id_table_multi').val(id); // Pastikan 'id' didefinisikan di scope global atau passed sebagai argumen
		$('#table1_multi').val(table1); // Pastikan 'table1' didefinisikan di scope global atau passed sebagai argumen
		$('#id_user_multi').val(idUser); // Pastikan 'idUser' didefinisikan di scope global atau passed sebagai argumen
		const formData = new FormData($('#form_multi_upload')[0]);
		// Show the progress bar and reset its state
		$('#progress-bar-multi').show();
		$('#progress-multi').css('width', '0%').text('0%');
		$.ajax({
			url: '<?= site_url('admin/saveDrFileMulti') ?>', // Ganti dengan controller Anda
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			// Add xhr for progress tracking
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						var percent = (evt.loaded / evt.total) * 100;
						$('#progress-multi').css('width', percent + '%').text(Math.round(percent) + '%');
					}
				}, false);
				return xhr;
			},
			beforeSend: function() {
				// Optional: Hide messager progress if you prefer to only show the custom progress bar
				// $.messager.progress({
				//     title: 'Uploading',
				//     msg: 'Please Wait...'
				// });
			},
			success: function(res) {
				// Optional: Hide messager progress if you used it
				// $.messager.progress('close'); 

				// Hide the progress bar after upload completes
				$('#progress-bar-multi').hide();

				let response = {};
				try {
					response = JSON.parse(res);
				} catch (e) {
					Toast.fire({
						icon: 'error',
						title: 'Gagal parsing response server. Silakan cek konsol browser untuk detail.'
					});
					console.error('Raw server response:', res);
					return;
				}

				if (response.message) {
					Toast.fire({
						icon: 'success',
						title: response.message
					});
					$('#form_multi_upload')[0].reset();
					// Clear the displayed file list as well
					$('#file_list_container').html('<p style="margin: 0;">No files selected yet.</p>');
					$('#dialog-form2').dialog('close');
					$('#dgGrid_file').datagrid('reload');
				} else if (response.errorMsg) {
					Toast.fire({
						icon: 'error',
						title: response.errorMsg
					});
					if (response.errors) {
						console.error('Detail kesalahan upload:', response.errors);
					}
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// Optional: Hide messager progress if you used it
				// $.messager.progress('close'); 

				// Hide the progress bar in case of error
				$('#progress-bar-multi').hide();

				Toast.fire({
					icon: 'error',
					title: 'Gagal upload. Coba lagi.'
				});
				console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
			}
		});
	}

	function cancelform2() {
		$('#form_multi_upload')[0].reset();
		// Clear the displayed file list as well
		$('#file_list_container').html('<p style="margin: 0;">No files selected yet.</p>');
		$('#dialog-form2').dialog('close');
	}


	document.addEventListener('DOMContentLoaded', function() {
		const fileInput = document.getElementById('multi_files');
		const fileListContainer = document.getElementById('file_list_container');
		// Fungsi untuk mengupdate tampilan daftar file
		function updateFileList() {
			const files = fileInput.files; // Dapatkan objek FileList dari input
			fileListContainer.innerHTML = ''; // Hapus konten sebelumnya
			if (files.length === 0) {
				fileListContainer.innerHTML = '<p style="margin: 0;">No files selected yet.</p>';
				return;
			}
			const ul = document.createElement('ul');
			ul.style.listStyle = 'none'; // Menghilangkan bullet point default
			ul.style.paddingLeft = '0';
			ul.style.margin = '0'; // Menghilangkan margin default ul
			for (let i = 0; i < files.length; i++) {
				const file = files[i];
				const li = document.createElement('li');
				li.className = 'file-item';
				li.style.marginBottom = '5px'; // Memberi sedikit jarak antar item
				// Menampilkan nama file dan ukuran
				li.textContent = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
				ul.appendChild(li);
			}
			fileListContainer.appendChild(ul);
		}
		// Tambahkan event listener saat input file berubah
		fileInput.addEventListener('change', updateFileList);
		// Panggil fungsi sekali saat halaman dimuat untuk menampilkan file yang mungkin sudah dipilih (misalnya dari browser cache)
		updateFileList();
	});
</script>