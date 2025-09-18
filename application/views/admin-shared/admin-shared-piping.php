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
						url="<?= base_url('admin/getsharedfilespiping/' . rawurlencode($desc)) ?>"
						pageSize="20"
						pageList="[10,20,50,75,100,125,150,200]"
						nowrap="true"
						singleSelect="true">

						<thead>
						<tr>
								<!-- <th field="level1" width="auto">Level</th> -->
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
								<!-- <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newFile()">Add</a>
								<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editFile()">Edit</a>
								<a href="javascript:void(0)" id="btn_list" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteFile()">Delete</a>
								<a href="javascript:void(0)" data-options="toggle:true,group:'g1',selected:true" class="easyui-linkbutton" onclick="doAll()">All</a>
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


		<div id="dialog-form" class="easyui-window" title="Upload File" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
			<form id="ff" class="easyui-form" method="post" enctype="multipart/form-data">
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="level_1" name="level_1" style="width:90%"
						data-options="label:'Level 1:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getlevel1shared') ?>'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" id="level_2" name="level_2" style="width:90%"
						data-options="label:'Level 2:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getLevel2shared') ?>'">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-filebox" id="file" name="file" style="width:90%"
						data-options="label:'Upload File:',required:true,accept:'*'">
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
			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
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

	$('#level_1').combobox({
		onSelect: function(record) {

			var paramName = record.param_name;

			if(paramName == 'P&ID'){
				paramName = 'PID';

			}

		
			
			$('#level_2').combobox('reload', '<?= base_url('admin/getLevel2shared') ?>?level_1=' + paramName);
		}
	});









	// $('input[name="file"]').filebox({
	//         onChange: function () {
	//             const input = $(this).filebox('textbox')[0]; // Ambil elemen input asli
	// 			$('#remark').textbox('setValue', 'testfile');
	//         }
	//     });








	function formatLink(value, row, index) {
		if (value) {
			// Periksa apakah URL sudah memiliki scheme
			if (!value.startsWith('http://') && !value.startsWith('https://')) {
				value = 'https://' + value; // Tambahkan scheme default
			}
			return '<a href="' + value + '" target="_blank">' + value + '</a>';
		}
		return '-'; // Jika tidak ada value, tampilkan tanda "-"
	}







	function submitForm() {
		var formData = new FormData($("#ff")[0]);
		$('#ff').form('submit', {
			url: url,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(result) {
				var result = JSON.parse(result);
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
			}
		});
	}

	function newFile() {
		$('#dialog-form').dialog('open').dialog('setTitle', 'Upload New File');
		$('#ff').form('clear');
		url = 'saveFileShared';
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
					$.post('deletefileShared', {
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