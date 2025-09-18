<section class="content-header"></section>
<head>
    <!-- Include CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
	
    <!-- Other head content -->
</head>
<div class="col-12">
	<div class="card">
	  <div class="easyui-panel" style="position:relative;overflow:auto;">
	    <div class="card-body">
	      <div class="easyui-layout">
	         <table id="dgGrid" title="" 
				toolbar="#toolbar" 
				class="easyui-datagrid" 
				rowNumbers="true" 
				pagination="true" 
				url="<?= base_url('admin/getUsers') ?>" 
				pageSize="20" 
				pageList="[10,20,50,75,100,125,150,200]" 
				nowrap="true" 
				singleSelect="true"
				fit="true"
				fitColumns="true">
				<thead>
        <tr>
            <th field="nik" width="10%" sortable="true">NIK</th>
            <th field="employee-id" width="10%" sortable="true">ID Karyawan</th>
            <th field="nama" width="20%" sortable="true">Nama</th>
            <th field="jk" width="10%" sortable="true">Jenis Kelamin</th>
            <th field="posisi" width="20%" sortable="true">Posisi</th>
            <th field="tgl_masuk" width="10%" sortable="true">Tanggal Masuk</th>
            <th field="no_hp" width="10%" sortable="true">No HP</th>
            <th field="email" width="20%" sortable="true">Email</th>
            <th field="marital" width="10%" sortable="true">Status Nikah</th>
            <th field="alamat" width="20%" sortable="true">Alamat</th>
            <th field="npwp" width="10%" sortable="true">NPWP</th>
            <th field="bpjs_ks" width="10%" sortable="true">BPJS Kes</th>
            <th field="bpjs_kt" width="10%" sortable="true">BPJS TK</th>
            <th field="path_foto" width="10%" formatter="formatAction">Foto</th>
            <th field="is_aktif" width="10%" data-options="formatter:formatDetailactive" align="center" sortable="true">Status</th>
					</tr>
				</thead>
			</table>

				<div id="photo-dialog" class="easyui-dialog" title="Foto Karyawan" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false" style="width:400px;height:500px;">
					<img id="photo-display" src="" style="width:100%;height:auto;">
				</div>	          

					<div id="toolbar" style="padding: 10px">
	              <div class="row ml-1">
	                  <div class="col-sm-6">
	                  	<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newForm()">Add</a>
	                  	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editForm()">Edit</a>
	                  	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="aktif()">Aktif / Non Aktif</a>
	                  	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="destroy()">Delete</a>
	                  </div>
	                  
	                  <div class="col-sm-6 pull-right">
	                      <input  id="search" placeholder="Please Enter Search a Users" style="width:60%;" align="right">
	                      <a href="javascript:void(0);"  id="btn_serach" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
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
					<input class="easyui-textbox" name="id_employee" style="width:100%" data-options="label:'Id Karyawan:',required:false">
				</div>
			
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="nik" style="width:100%" data-options="label:'Nik:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input id="pass" class="easyui-passwordbox" name="password" prompt="Password" iconWidth="28" style="width:100%" data-options="label:'Password:',required:false">
				</div>
				<div style="margin-bottom:20px">
					<input id="nama" class="easyui-textbox" name="nama" style="width:100%" data-options="label:'Nama Lengkap:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input id="jk" class="easyui-textbox" name="jk" style="width:100%" data-options="label:'Jenis Kelamin:',required:true">
				</div>

				<div style="margin-bottom:20px; position: relative;">
  						  <input id="phone" name="no_hp" type="tel" class="easyui-textbox" 
						  			pattern="\d*"
          						 style="width:100%; padding-left: 50px;" 
           						data-options="label:'Nomor HP:',required:true">
				</div>	

				<div style="margin-bottom:20px">
    				<input class="easyui-textbox" name="email" style="width:100%" data-options="label:'Email (Optional):',required:false" placeholder="Masukkan Email(opsional)" pattern="\d*" title="Hanya angka yang diperbolehkan">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="tempat_lahir" style="width:100%" data-options="label:'Tempat Lahir:',required:true">
				</div>

				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="tgl_lahir" type="date" style="width:100%" data-options="label:'Tanggal Lahir:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input id="sp" class="easyui-textbox" name="marital" style="width:100%" data-options="label:'Setatus Pernikahan:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="tgl_masuk" type="date" style="width:100%" data-options="label:'Tanggal Masuk:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input id="islevel" class="easyui-textbox" name="posisi" style="width:100%" data-options="label:'Posisi :',required:true">
				</div>
				<div style="margin-bottom:20px">
					<textarea class="easyui-textbox" name="alamat" style="width:100%" data-options="label:'Alamat :',required:true,multiline:true,height:100"></textarea>
				</div>

				<div style="margin-bottom:20px">
    				<input class="easyui-textbox" name="npwp" style="width:100%" data-options="label:'NPWP (Optional):',required:false" placeholder="Masukkan nomor BPJS (opsional)" pattern="\d*" title="Hanya angka yang diperbolehkan">
				</div>

				<div style="margin-bottom:20px">
    				<input class="easyui-textbox" name="bpjs_ks" style="width:100%" data-options="label:'BPJS Kes (Optional):',required:false" placeholder="Masukkan nomor BPJS (opsional)" pattern="\d*" title="Hanya angka yang diperbolehkan">
				</div>

				<div style="margin-bottom:20px">
    				<input class="easyui-textbox" name="bpjs_kt" style="width:100%" data-options="label:'BPJS KT (Optional):',required:false" placeholder="Masukkan nomor BPJS (opsional)" pattern="\d*" title="Hanya angka yang diperbolehkan">
				</div>

				<div style="margin-bottom:20px">
    			<label for="foto">Upload Foto:</label>
    			<input id="foto" name="foto" type="file" style="width:100%" data-options="label:'Upload Foto:',required:true">
    			<small style="display:block; color:#666;">Hanya file foto Maks 200kb (jpg, jpeg, png)</small>
				</div>

				</form>
				<div id="dialog-buttons">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="submitForm()">Simpan</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
				</div>
				
	   </div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>



<script type="text/javascript">
  $(document).ready(function(){
  	$('#islevel').combobox({
  	    url:'islevel',
  	    valueField:'_id',
  	    textField:'posisi',
        setText:'posisi'
  	});
  	$('#jk').combobox({
		textField: 'jenis',
		valueField: 'value',
		data: [
			{ 'jenis': 'Laki-Laki', "value": 'L' },
			{ 'jenis': 'Perempuan', "value": 'P' },
		]
  	});
	$('#sp').combobox({
		textField: 'jenis',
		valueField: 'value',
		data: [
			{ 'jenis': 'Tidak Kawin', "value": 'Tidak Kawin' },
			{ 'jenis': 'Kawin', "value": 'Kawin' },
		]
  	});


  	$('#dgGrid').datagrid({
  		minHeight:410,
        maxHeight:520,
	});
    $('#search').keyup(function(event){
      if(event.keyCode == 13){
        $('#btn_serach').click();
      }
    });
  })
  function doSearch(){
	$('#dgGrid').datagrid('load',{
		search_data: $('#search').val()
	});
}

function formatAction(value, row, index) {
    return '<a href="javascript:void(0);" onclick="showPhoto(\'' + row.path_foto + '\')">Tampilkan</a>';
}

function showPhoto(photoUrl) {
    var photoWindow = $('<div/>').window({
        title: 'Foto Karyawan',
        width: 500,
        height: 400,
        modal: true,
        closed: false,
        content: '<img src="' + photoUrl + '" style="width:100%; height:auto;">',
        onClose: function() {
            $(this).window('destroy');
        }
    });
}

function showPhoto(photoUrl) {
    $('#photo-display').attr('src', photoUrl);
    $('#photo-dialog').dialog('open');
}

function formatFoto(value, row, index) {
    if (value) {
        return '<img src="' + value + '" style="width:50px;height:50px;">'; // Atur ukuran sesuai kebutuhan
    } else {
        return 'No Image'; // Tampilkan pesan jika tidak ada gambar
    }
}

function submitForm(){
	var string = $("#ff").serialize();
	
	$('#ff').form('submit',{
		url: url,
		
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			var fileInput = document.getElementById('foto');
			
			if (fileInput.files.length > 0) {
				var fileSize = fileInput.files[0].size; // ukuran file dalam byte
				var maxSize = 200 * 1024; // 200 KB dalam byte

				if (fileSize > maxSize) {
					alert('Ukuran file tidak boleh lebih dari 200KB');
					return false; // menghentikan submit form jika ukuran file terlalu besar
				}
			}

			if (result.errorMsg){
				Toast.fire({
	              type: 'error',
	              title: ''+result.errorMsg+'.'
	              })
			} else {
				Toast.fire({
                  type: 'success',
                  title: ''+result.message+'.'
                })
				$('#dialog-form').dialog('close');		// close the dialog
				$('#dgGrid').datagrid('reload');	// reload the user data
			}
		}
	});
}

function newForm(){
	$('#dialog-form').dialog('open').dialog('setTitle','Add New Users');
	$('#ff').form('clear');
	url = 'saveUsers';
}

function editForm(){
	var row = $('#dgGrid').datagrid('getSelected');
		if (row){
			$('#dialog-form').dialog('open').dialog('setTitle','Edit Users' + row.nama);
			$('#ff').form('load',row);
			$('#pass').textbox('setValue', '');
			$('#islevel').textbox('setValue', '');
			$('#jk').textbox('setValue', '');
			url = 'updateUsers?id='+row._id;
		}
}

function destroy(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this Users ? '+ row.nama,function(r){
            if (r){
                $.post('destroyUsers',{id:row._id},function(result){
                    if (result.errorMsg){
                        Toast.fire({
			              type: 'error',
			              title: ''+result.errorMsg+'.'
			            })
                    } else {
                        Toast.fire({
		                  type: 'success',
		                  title: ''+result.message+'.'
		                })
                        $('#dgGrid').datagrid('reload');
                    }
                },'json');
            }
        });
    }
}

function aktif(){
    var row = $('#dgGrid').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to Aktif or Non Aktif ? '+ row.nama,function(r){
            if (r){
                $.post('aktifUsers',{id:row._id},function(result){
                    if (result.errorMsg){
                        Toast.fire({
			              type: 'error',
			              title: ''+result.errorMsg+'.'
			            })
                    } else {
                        Toast.fire({
		                  type: 'success',
		                  title: ''+result.message+'.'
		                })
                        $('#dgGrid').datagrid('reload');
                    }
                },'json');
            }
        });
    }
}

function formatDetailactive(index, row){
	if (row.is_aktif == 1){
		return '<span class="l-btn-left"><span class="l-btn-text"><i class="fa fa-eye" style="color:#007bff;"></i> Active</span></span>';
	}else{
		return '<span class="l-btn-left"><span class="l-btn-text"><i class="fa fa-eye-remove" style="color:#007bff;"></i> In Active</span></span>';
	}
}

//Start

  document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector("#phone");

        // Initialize intlTelInput
        var iti = window.intlTelInput(input, {
            separateDialCode: true, // Menampilkan kode negara di luar input field
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch('https://ipinfo.io/json', {
                    cache: 'reload'
                }).then(function(response) {
                    return response.json();
                }).then(function(json) {
                    var countryCode = (json && json.country) ? json.country : "us";
                    callback(countryCode);
                }).catch(function() {
                    callback("us");
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Function to validate input
        function validatePhoneNumber() {
            // Get the value of the input
            var phoneNumber = input.value;
            
            // Remove all non-numeric characters except "+"
            phoneNumber = phoneNumber.replace(/[^\d+]/g, '');

            // Remove leading 0 if it exists after the code
            if (phoneNumber.startsWith('0') && iti.getSelectedCountryData().dialCode.length > 0) {
                phoneNumber = phoneNumber.slice(1);
            }

            // Update the input value
            input.value = phoneNumber;
        }

        // Add event listener to handle input change
        input.addEventListener('input', function(e) {
            // Prevent typing letters
            if (/[a-zA-Z]/.test(e.data)) {
                e.preventDefault();
                input.value = input.value.replace(/[a-zA-Z]/g, '');
            }
            validatePhoneNumber();
        });

        // Add event listener to handle paste event
        input.addEventListener('paste', function() {
            setTimeout(function() {
                validatePhoneNumber();
            }, 0);
        });
    });



	


//Finish





// function formatDetail(index,row){
// 	if (row.photo == '' || row.photo == null){
// 		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="../assets/avatars/profil.png" width="25"></a>';		
// 	}else{
// 		return '<a href="#" class="pop" data-backdrop="static" onClick="zoomImage()"><img src="../assets/avatars/'+row.photo+'" width="25"></a>';
// 	}
// }
</script>