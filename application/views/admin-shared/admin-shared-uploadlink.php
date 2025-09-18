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
	            url="<?= base_url('admin/getsharedfiles') ?>" 
	            pageSize="20" 
	            pageList="[10,20,50,75,100,125,150,200]" 
	            nowrap="true" 
	            singleSelect="true">
	              <thead>
				  <<tr>
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
	                  	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editFile()">Edit</a>
	                  	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteFile()">Delete</a>
	                  </div>
	                  
	                  <div class="col-sm-6 pull-right">
	                      <input id="search" placeholder="Search File by Name or Remark" style="width:60%;" align="right">
	                      <a href="javascript:void(0);" id="btn_search" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
	                  </div>
	              </div>
	          </div>
	        </div>
	    </div>
	  </div>


	  <div id="dialog-form" class="easyui-window" title="Upload File" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
							<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
        <div style="margin-bottom:20px">
            <input class="easyui-combobox" id="level1" name="level1" style="width:90%" 
                   data-options="label:'Level 1:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getlevel1shared') ?>'">
        </div>
        <div style="margin-bottom:20px">
            <input class="easyui-textbox" name="file_name" style="width:90%" data-options="label:'File Name:',required:true">
        </div>

		<div style="margin-bottom:20px">
		<input class="easyui-filebox" id="file" name="file" style="width:90%" 
       data-options="label:'Upload File:',required:true,accept:'*'" 
       onchange="test()">
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
    </form>
    <div id="dialog-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
    </div>
	   </div>

<!-- 


	   <div id="dialog-form" class="easyui-window" title="Upload File" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}" style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
	      	<form id="ff" class="easyui-form" method="post" data-options="novalidate:false" enctype="multipart/form-data">
			  <div style="margin-bottom:20px">
					<input class="easyui-combobox" name="level1" style="width:90%" 
					       data-options="label:'Level 1:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/getlevel1shared') ?>'">
				</div>
			  <div style="margin-bottom:20px">
					<input class="easyui-textbox" name="file_name" style="width:90%" data-options="label:'File Name:',required:true">
				</div>	
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="size" style="width:90%" data-options="label:'File Size (Optional):',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-combobox" name="type_file" style="width:90%" 
					       data-options="label:'Type File:',required:true,valueField:'param_name',textField:'param_name',url:'<?= base_url('admin/gettypefile') ?>'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="link" style="width:90%" data-options="label:'Link:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="remark" style="width:90%" data-options="label:'Remark:'">
				</div>
				</form>
				<div id="dialog-buttons">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Save</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
				</div>
	   </div> -->
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


$('input[name="file"]').filebox({
    onChange: function () {
        console.log('onChange event triggered');

        // Ambil elemen input file asli menggunakan jQuery
        const input = $('input[name="file"]')[0]; 
        const file = input.files[0]; // Ambil file pertama yang dipilih

        if (file) {
            console.log('File selected:', file); // Debugging log
            
            // Ambil nama file dan tipe berdasarkan ekstensi
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase(); // Ambil ekstensi file

            // Tentukan tipe file berdasarkan ekstensi
            let fileType = 'Unknown';
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
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
                case 'txt':
                    fileType = 'Text Document';
                    break;
                case 'dwg':
                case 'dxf':
                    fileType = 'AutoCAD File';
                    break;
                default:
                    fileType = 'Unknown Type';
            }

            // Hitung ukuran file dalam MB
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2); // Hasil dalam MB dengan 2 desimal

            // Set field dengan data file
            
            $('#type_file').textbox('setValue', fileType); // Set tipe file berdasarkan ekstensi
            $('#file_size').textbox('setValue', fileSizeMB + ' MB'); // Ukuran file dalam MB
            $('#file_name').textbox('setValue', fileName); // Nama file
        } else {
            console.log('No file selected'); // Debugging log jika tidak ada file
        
            $('#type_file').textbox('setValue', '');
            $('#file_size').textbox('setValue', '');
            $('#file_name').textbox('setValue', ''); // Reset nama file jika tidak ada file
        }
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




function doSearch(){
	$('#dgGrid').datagrid('load', {
		search_data: $('#search').val()
	});
}

function submitForm(){
	var formData = new FormData($("#ff")[0]);
	$('#ff').form('submit', {
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = JSON.parse(result);
			if (result.errorMsg){
				Toast.fire({ type: 'error', title: result.errorMsg });
			} else {
				Toast.fire({ type: 'success', title: result.message });
				$('#dialog-form').dialog('close');
				$('#dgGrid').datagrid('reload');
			}
		}
	});
}

function newFile(){
	$('#dialog-form').dialog('open').dialog('setTitle','Upload New File');
	$('#ff').form('clear');
	url = 'saveFileShared';
}

function editFile(){
	var row = $('#dgGrid').datagrid('getSelected');
	if (row){
		$('#dialog-form').dialog('open').dialog('setTitle','Edit File');
		$('#ff').form('load', row);
		url = 'updateFileshare?id=' + row.id;
	}
}

function deleteFile(){
	var row = $('#dgGrid').datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this file?', function(r){
			if (r){
				$.post('deletefileShared', {id: row.id}, function(result){
					if (result.errorMsg){
						Toast.fire({ type: 'error', title: result.errorMsg });
					} else {
						Toast.fire({ type: 'success', title: result.message });
						$('#dgGrid').datagrid('reload');
					}
				}, 'json');
			}
		});
	}
}
</script>
