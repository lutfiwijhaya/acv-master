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
						url="<?= base_url('admin/getsharedfiles/' . rawurlencode($desc)) ?>"
						pageSize="20"
						pageList="[10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">

						<thead>
							<tr>
								<th field="level1" width="auto">Level</th>
								<th field="Description" width="auto">Description</th>
								<th field="name_file" width="auto">File Name</th>
								<th field="upload_date" width="auto">Upload Date</th>
								<th field="size" width="auto">File Size</th>
								<th field="type_file" width="auto">File Type</th>
								<th field="link" width="auto" formatter="formatLink">Link</th>
								<th field="remark" width="auto">Remark</th>
							</tr>
						</thead>
					</table>

					<div id="toolbar" style="padding: 10px">
						<div class="row ml-1">
							<div class="col-sm-6">
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newFile()">Add</a>
								<!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editFile()">Edit</a> -->
								<a href="javascript:void(0)" id="btn_list" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteFile()">Delete</a>
								<!-- <a href="javascript:void(0)" data-options="toggle:true,group:'g1',selected:true" class="easyui-linkbutton" onclick="doAll()">All</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('List')">List</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('Scanned PDF file - KN Office')">Scanned PDF file - KN Office</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('CAD Drawing')">CAD Drawing</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('CAD to PDF')">CAD to PDF</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('Bill of Quantity')">Bill of Quantity</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('Equipment List')">Equipment List</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('Inspection Report')">Inspection Report</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1'" class="easyui-linkbutton" onclick="filterByDesc('Other')">Other</a> -->

							</div>

							<div class="col-sm-6 pull-right">
								<input id="search" placeholder="Search File" style="width:60%;" align="right">
								<a href="javascript:void(0);" id="btn_search" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div id="dialog-form" class="easyui-window" title="Upload File or Insert Link" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    $(this).window('hcenter');}" style="width:100%;max-width:600px;padding:20px;">

			<div class="easyui-tabs" style="width:100%;height:auto;">
				<div title="Insert Link" style="padding:10px;">
					<form id="link-form" class="easyui-form" method="post">
						<div style="margin-bottom:20px">
							<input class="easyui-combobox" id="level_1_link" name="level_1_link" style="width:90%"
								data-options="label:'Level 1:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getlevel1shared') ?>'">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-combobox" id="description_link" name="description_link" style="width:90%"
								data-options="label:'Description:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getLevel2shared') ?>'">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-textbox" name="name_file_link" id="name_file_link" style="width:90%" data-options="label:'File Name:',required:true">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-combobox" id="type_file_link" name="type_file_link" style="width:90%"
								data-options="label:'File Type:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/gettypefile') ?>'">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-textbox" name="link_link" id="link_link" style="width:90%" data-options="label:'File Link:',required:true">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-textbox" name="remark_link" id="remark_link" style="width:90%" data-options="label:'Remark:'">
						</div>
					</form>
				</div>
				<!-- Tab 1: Upload File -->
				<div title="Upload File" style="padding:10px;">
					<form id="ff" class="easyui-form" method="post" enctype="multipart/form-data">
						<div style="margin-bottom:20px">
							<input class="easyui-combobox" id="level_1" name="level1" style="width:90%"
								data-options="label:'Level 1:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getlevel1shared') ?>'">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-combobox" id="description" name="description" style="width:90%"
								data-options="label:'Description:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getLevel2shared') ?>'">
						</div>

						<div style="margin-bottom:20px">
							<input class="easyui-filebox" id="file" name="file" style="width:90%"
								data-options="label:'Upload File:',required:true,accept:'*'">
						</div>
						<div id="progress-bar" style="display:none; margin-top:20px;">
							<div id="progress" style="width:0%; background-color: green; color: white; padding: 3px; text-align: center;">0%</div>
						</div>

						<div style="margin-bottom:20px">
							<input class="easyui-textbox" name="file_name" id="file_name" style="width:90%" data-options="label:'File Name:',readonly:true">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-textbox" name="type_file" id="type_file" style="width:90%" data-options="label:'File Type:',readonly:true">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-textbox" name="size" id="file_size" style="width:90%" data-options="label:'File Size:',readonly:true">
						</div>
						<div style="margin-bottom:20px">
							<input class="easyui-textbox" id="remark" name="remark" style="width:90%" data-options="label:'Remark:'">
						</div>
						<!-- Hidden input untuk menyimpan link file -->
						<input type="hidden" name="link" id="link">
					</form>
				</div>

				<!-- Tab 2: Insert Link -->

			</div>

			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-form').window('close')">Cancel</a>
			</div>
		</div>

	</div>


</div>
</div>

<script type="text/javascript">
	var dsc = "<?= isset($desc) ? addslashes($desc) : ''; ?>";

	$(document).ready(function() {
		$('#dgGrid').datagrid({
			minHeight: 410,
			maxHeight: 520,
		});

		$('#search').keyup(function(event) {
			if (event.keyCode == 13) {
				$('#btn_search').click();
			}
		});




	});





	function doSearch() {
		$('#dgGrid').datagrid('load', {
			search_data: $('#search').val()
		});
	}


	// function doSearch() {



	// 	if (dsc !== '') {
	// 		$('#dgGrid').datagrid('load', {
	// 			search_data: $('#search').val(),
	// 			Desc: dsc
	// 		});
	// 	} else {
	// 		$('#dgGrid').datagrid('load', {
	// 			search_data: $('#search').val()
	// 		});
	// 	}
	// }


	function doAll() {
		dsc = '';
		$('#dgGrid').datagrid('load', {

		});
	}



	function filterByDesc(descValue) {
		dsc = descValue;
		console.log($('#listbtn'));

		$('#dgGrid').datagrid('load', {
			Desc: dsc
		});
	}



	$('#file').filebox({
		onChange: function() {
			const input = $('input[name="file"]')[0];
			const file = input.files[0];

			if (file) {
				const fileName = file.name;
				const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
				const fileExtension = fileName.split('.').pop().toLowerCase();

				let fileType = 'Unknown';
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
					default:
						fileType = 'Other';
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

	$('#level_1_link').combobox({
		onSelect: function(record) {

			var paramName = record.param_name;

			if (paramName == 'P&ID') {
				paramName = 'PID';

			}



			$('#description_link').combobox('reload', '<?= base_url('admin/getLevel2shared') ?>?level_1=' + paramName);
		}
	});

	$('#level_1').combobox({
		onSelect: function(record) {

			var paramName = record.param_name;

			if (paramName == 'P&ID') {
				paramName = 'PID';

			}



			$('#description').combobox('reload', '<?= base_url('admin/getLevel2shared') ?>?level_1=' + paramName);
		}
	});








	// $('input[name="file"]').filebox({
	//         onChange: function () {
	//             const input = $(this).filebox('textbox')[0]; // Ambil elemen input asli
	// 			$('#remark').textbox('setValue', 'testfile');
	//         }
	//     });












	function submitForm() {
		// Dapatkan tab yang aktif
		var activeTab = $('.easyui-tabs').tabs('getSelected').panel('options').title;

		if (activeTab === 'Upload File') {

			submitForm_upload();
		} else if (activeTab === 'Insert Link') {
			// Eksekusi fungsi insert link jika tab "Insert Link" aktif
			submitForm_link();
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
					$('#dialog-form').dialog('close');
					$('#dgGrid').datagrid('reload');
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
		var url = '<?= base_url('admin/saveFileShared_link') ?>'; // Inisialisasi URL di sini
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
					$('#dialog-form').dialog('close');
					$('#dgGrid').datagrid('reload');
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










	function newFile() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Upload New File');
		$('#ff').form('clear');
		url = '<?= base_url('admin/saveFileShared') ?>';

	}

	function editFile() {
		var row = $('#dgGrid').datagrid('getSelected');
		if (row) {
			$('#dialog-form').dialog('open').dialog('setTitle', 'Edit File');
			$('#ff').form('load', row);
			url = 'updateFileshare?id=' + row.id;
		}
	}

	function deleteFile() {
		var row = $('#dgGrid').datagrid('getSelected');

		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to delete this file?', function(r) {
				if (r) {
					$.post('<?= base_url('admin/deletefileShared') ?>', { // Menggunakan URL absolut
						id: row.id
					}, function(result) {
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
							$('#dgGrid').datagrid('reload');
						}
					}, 'json');
				}
			});
		}
	}




	function formatLink(value, row, index) {
		if (value) {
			// Periksa apakah URL sudah memiliki scheme
			if (!value.startsWith('http://') && !value.startsWith('https://')) {
				value = 'https://' + value; // Tambahkan scheme default
			}
			return '<a href="' + value + '" target="_blank">Download</a>';
		}
		return '-'; // Jika tidak ada value, tampilkan tanda "-"
	}
</script>