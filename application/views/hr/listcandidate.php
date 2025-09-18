<style>
/* Target utama: wrapper dari tombol yang disabled di dalam toolbar */
#toolbar .l-btn-disabled {
    background-color: #007BFF !important;
    /* Latar biru solid seperti tombol aktif */
    border-color: #0069d9 !important;
    /* Sesuaikan warna border */
    opacity: 1 !important;
    /* Hapus efek transparan/pudar bawaan */
    cursor: default !important;
    /* Pastikan kursor tetap panah (bukan tangan) */
}

/* Target untuk teks di dalam tombol yang disabled */
#toolbar .l-btn-disabled .l-btn-text {
    color: #ffffff !important;
    /* Paksa teks menjadi putih */
}

/* Target untuk ikon di dalam tombol yang disabled */
#toolbar .l-btn-disabled .l-btn-icon {
    color: #ffffff !important;
    /* Paksa ikon menjadi putih */
}
</style>
<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <div class="easyui-layout">
                    <table id="dgGrid" class="easyui-datagrid" data-options="
        method:'get',
       title: '<?= $title;?>',
        toolbar: '#toolbar',
        rownumbers: true, /* Sekarang akan berfungsi */
        pagination: true,
        url: '<?= site_url('hr/get_candidates_json') ?>',
        pageSize: 20,
        pageList: [10,20,50,75,100,125,150,200],
        nowrap: true,
        singleSelect: false,
        fitColumns: false,

        /* === PINDAHKAN EVENT HANDLER KE SINI === */
        onSelect: function(index, row) {
            $('#btn-edit').linkbutton('enable');
            $('#btn-delete').linkbutton('enable');
            $('#btn-toggle-active').linkbutton('enable');
            
            
            if (row.candidate_status === 'Interview') {
                // Jika sudah 'Interview', tombol summary aktif, tombol naik status nonaktif
                var summaryUrl = '<?= site_url('hr/formsummary') ?>/' + row._id;
                $('#btn-add-summary').linkbutton('enable').attr('href', summaryUrl);
                $('#btn-promote-status').linkbutton('disable');
            } else {
                // Jika belum 'Interview', tombol summary nonaktif, tombol naik status aktif
                $('#btn-add-summary').linkbutton('disable').attr('href', '#');
                $('#btn-promote-status').linkbutton('enable');
            }

          
        },
        onUnselect: function(index, row) {
            $('#btn-edit').linkbutton('disable');
            $('#btn-delete').linkbutton('disable');
            $('#btn-promote-status').linkbutton('disable');
            $('#btn-add-summary').linkbutton('disable').attr('href', '#');
            $('#btn-toggle-active').linkbutton('disable');
        },

        onLoadSuccess: function() {
            $('#btn-edit').linkbutton('disable');
            $('#btn-delete').linkbutton('disable');
            $('#btn-toggle-active').linkbutton('disable');
            $('#btn-promote-status').linkbutton('disable');
            $('#btn-add-summary').linkbutton('disable').attr('href', '#');
        },
            /* === TAMBAHKAN EVENT HANDLER UNTUK CHECKBOX === */
        onCheck: function() { $('#btn-export-pdf').linkbutton('enable'); },
        onUncheck: function() {
            if ($('#dgGrid').datagrid('getChecked').length === 0) {
                $('#btn-export-pdf').linkbutton('disable');
            }
        },
        onCheckAll: function() { $('#btn-export-pdf').linkbutton('enable'); },
        onUncheckAll: function() { $('#btn-export-pdf').linkbutton('disable'); }
    ">

                        <thead>
                            <tr>
                                <!-- <th field="id" width="5%">ID</th> -->
                                <th data-options="field:'ck', checkbox:true"></th>
                                 <th data-options="field:'candidate_status', width:120, align:'center', formatter:formatCandidateStatus">Status</th>
                                <th field="nik" width="8%">Nik</th>
                                <th field="nama" width="10%">Name</th>
                                <th field="applying_occupation" width="10%">Applying Occupation</th>
                                <th field="desired_salary" width="10%" data-options=" formatter:formatRupiah">Desired
                                    Salary</th>
                                <th field="email" width="10%">Email</th>
                                <th field="no_hp" width="8%">No Hp</th>
                                <th data-options="field:'total_career_months', width:150, formatter:formatTotalCareer">
                                    Total Career</th>
                                <th field="marital" width="7%">Marital Status</th>
                                <th field="jk" width="3%">Sex</th>
                                <th field="tgl_lahir" width="7%">Birthday</th>
                                <th data-options="field:'age', width:70, formatter:formatAge, field_alias:'tgl_lahir'">
                                    Age</th>
                                <th field="tempat_lahir" width="8%">Place of Birth</th>
                                <th field="alamat" width="15%">Home Address</th>
                                <th field="current_address" width="15%">Current Address</th>
                                <th field="npwp" width="10%">NPWP No</th>
                                <th field="bpjs_ks" width="8%">BPJS Ks</th>
                                <th field="bpjs_kt" width="10%">BPJS Kt</th>
                                <th field="detail_akademik" width="8%" align="center" formatter="formatDetailAcademic">Academic Status
                                </th>
                                <th
                                    data-options="field:'detail_certificate', width:120, align:'center', formatter:formatDetailCertificate">
                                    Skill Authorized Certificates</th>
                                <th data-options="field:'detail_career', width:100, align:'center', formatter:formatDetailCareer">
                                    Summary Of Career Status</th>
                                <th data-options="field:'path_foto', width:80, align:'center', formatter:formatAction">
                                    Foto</th>
                            </tr>
                        </thead>
                    </table>

                    <div id="toolbar" style="padding: 10px">
                        <div class="row ml-1">
                            <div class="col-sm-6">
                                <a href="<?= site_url('hr/formCandidate') ?>" class="easyui-linkbutton"
                                    iconCls="icon-add" plain="false">Input</a>
                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false"
                                    onclick="editForm()">Edit</a>
                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove"
                                    plain="false" onclick="delete_item()">Delete</a>
                                <a href="#" id="btn-add-summary" class="easyui-linkbutton" iconCls="icon-add" data-options="disabled:true">Add Summary</a>
                                <a href="javascript:void(0)" id="btn-promote-status" class="easyui-linkbutton" iconCls="icon-add" data-options="disabled:true" onclick="promoteStatus()">Promote Status</a>
                                <a href="javascript:void(0)" id="btn-export-pdf" class="easyui-linkbutton"
                                    data-options="iconCls:'icon-print', disabled:true" onclick="exportToPdf()">Export
                                    PDF</a>
                            </div>
                            <div class="col-sm-6 pull-right">
                                <input id="search" placeholder="Please Enter Search Term" style="width:60%;"
                                    align="right">
                                <a href="javascript:void(0);" id="btn_serach" class="easyui-linkbutton"
                                    iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dialog untuk menambah dan mengedit supplier -->
        <div id="dialog-form" class="easyui-window" title="Add/Edit Supplier" data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){
    						$(this).window('hcenter');}"
            style="width:100%;max-width:500px;padding:30px 60px;max-height:500px;overflow-y:auto;">
            <form id="ff" class="easyui-form" method="post" data-options="novalidate:false">
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="nama" name="nama" style="width:100%"
                        data-options="label:'Nama Candidate:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="applying_occupation" name="applying_occupation" style="width:100%"
                        data-options="label:'Applying Occupation:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="desired_salary" name="desired_salary" style="width:100%"
                        data-options="label:'Desired Salary:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="email" name="email" style="width:100%"
                        data-options="label:'email:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="nik" name="nik" style="width:100%"
                        data-options="label:'KTP No:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-combobox" name="marital" style="width:100%" data-options="
       					label:'Marital Status:',
					  	 valueField: 'label',
					 	  textField: 'label',
					  	 panelHeight: 'auto',
					 	  required:true,
        				data: [
            				{label:'Single', value:'Single'},
           			 		{label:'Married', value:'Married'},
           					{label:'Divorced', value:'Divorced'},
            				{label:'Widowed', value:'Widowed'}
        				]
    				">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-combobox" name="jk" style="width:100%" data-options="
					label:'Sex:',
					required:true,
					valueField: 'value',
					textField: 'label',
                    panelHeight: 'auto',
                    data: [
                            {label:'Male', value:'L'},
                            {label:'Female', value:'P'}
						]	
					">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-datebox" name="tgl_lahir" style="width:100%"
                        data-options="label:'Birthday:',required:true,formatter:myformatter,parser:myparser">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="alamat" name="alamat" style="width:100%"
                        data-options="label:'Home Address:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="current_address" name="current_address" style="width:100%"
                        data-options="label:'Current Address:',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="npwp" name="npwp" style="width:100%"
                        data-options="label:'NPWP No:',required:false">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" id="bpjs_kt" name="bpjs_kt" style="width:100%"
                        data-options="label:'BPJS No:',required:false">
                </div>
                <div style="margin-bottom:15px">
                    <input class="easyui-filebox" name="path_foto" style="width:100%"
                        data-options="label:'New Photo:',prompt:'Choose a file...'">
                </div>
                <div id="dialog-buttons">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok"
                        onclick="submitForm()">Simpan</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
                        onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dlg-photo" class="easyui-dialog" style="width:450px;height:500px;padding:10px"
    data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-photo'">

    <img id="candidate-photo-img" src="" style="width:100%;">

</div>

<div id="dlg-buttons-photo">
    <a href="javascript:void(0)" class="easyui-linkbutton"
        onclick="javascript:$('#dlg-photo').dialog('close')">Close</a>
</div>

<script type="text/javascript">
// FUNGSI BARU UNTUK FORMAT TOTAL KARIR
function formatTotalCareer(value, row, index) {
    if (value && value > 0) {
        const totalMonths = parseInt(value);
        const years = Math.floor(totalMonths / 12);
        const months = totalMonths % 12;
        return `${years} years, ${months} months`;
    }
    return 'No career data'; // Tampilkan ini jika belum ada riwayat karir
}

// FUNGSI BARU UNTUK EKSPOR PDF
function exportToPdf() {
    var rows = $('#dgGrid').datagrid('getChecked');
    if (rows.length > 0) {
        var ids = [];
        for (var i = 0; i < rows.length; i++) {
            ids.push(rows[i]._id);
        }

        // Buat form sementara untuk mengirim ID ke controller
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= site_url('hr/export_pdf') ?>';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids';
        input.value = ids.join(','); // Kirim sebagai string dipisahkan koma

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

    } else {
        $.messager.alert('Info', 'Please select at least one candidate to export.');
    }
}
//

// untuk mengambil data foto
function formatAction(value, row, index) {
    if (value) {
        // mengambil URL gambar yang ada di uploads/hr_file/
        var fullUrl = '<?= base_url('uploads/hr_file/') ?>' + value;

        // Buat link yang memanggil fungsi showPhoto dengan URL LENGKAP
        return '<a href="javascript:void(0);" onclick="showPhoto(\'' + fullUrl + '\')">View Photo</a>';
    } else {
        return 'No Image';
    }
}
//end untuk mengambil data foto

// untuk menampikan fotonya
function showPhoto(photoUrl) {
    if (photoUrl) {
        $('<div/>').window({
            title: 'Foto Karyawan',
            width: 450,
            height: 500,
            modal: true,
            closed: false,
            constrain: true, // Agar window tidak bisa digeser keluar layar
            content: '<img src="' + photoUrl + '" style="width:100%; height:auto;">',
            onClose: function() {

                $(this).window('destroy');
            }
        });
    } else {
        $.messager.alert('Info', 'Gambar tidak tersedia.');
    }
}
//end untuk menampilkan window menampilkan fotonya

// FUNGSI BARU UNTUK MENGHITUNG DAN MENAMPILKAN UMUR
function formatAge(value, row, index) {
    const birthDateString = row.tgl_lahir; // Ambil data dari kolom tgl_lahir
    if (!birthDateString) {
        return '';
    }

    const birthDate = new Date(birthDateString);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();

    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    return age + ' years';
}
//

// untuk menampilkan fotonya di dialog
function showPhotoDialog(url, name) {
    $('#candidate-photo-img').attr('src', url);
    $('#dlg-photo').dialog('open').dialog('setTitle', 'Photo of: ' + name);
}
// end untuk windoy menampilkan fotonya



// untuk menampilkan detail data academic
function formatDetailAcademic(value, row, index) {
    // Link akan mengarah ke controller 'hr' fungsi 'view_academic' dengan membawa ID kandidat
    var url = '<?= site_url('hr/view_academic_detail') ?>/' + row._id;

    // Kembalikan HTML untuk tombolnya
    return '<a href="' + url + '" class="easyui-linkbutton" iconCls="icon-search" plain="true">View Academic</a>';
}
//end untuk menampilkan detail data academic



// star untuk menampilkan detail data Skill Authorized Certificates
function formatDetailCareer(value, row, index) {
    // Link akan mengarah ke controller 'hr' fungsi 'view_certificate_detail'
    var url = '<?= site_url('hr/view_skill_detail') ?>/' + row._id;

    // Mengembalikan HTML untuk tombolnya
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Career</a>';
}
// end untuk menampilkan detail data Skill Authorized Certificates



//star untuk menampilkan detail data status career
function formatDetailCertificate(value, row, index) {
    // Tambahkan parameter '?from=...' di akhir URL
    var url = '<?= site_url('hr/view_certificate_detail') ?>/' + row._id + '?from=listcandidate';
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="plain:true,iconCls:\'icon-search\'">View Certificates</a>';
}
//end untuk menampilkan detail data status career


//star untuk search
function doSearch() {
    $('#dgGrid').datagrid('load', {
        search_data: $('#search').val()
    });
}
//end untuk search

// FUNGSI BARU UNTUK FORMAT RUPIAH
function formatRupiah(value, row, index) {
    if (value) {
        return 'IDR ' + new Intl.NumberFormat('id-ID').format(value);
    }
    return '';
}

//star untuk form submission
var url


function editForm() {
    var row = $('#dgGrid').datagrid('getSelected');
    if (row) {
        // Arahkan ke URL controller edit_candidate dengan membawa ID
        window.location.href = '<?= site_url('hr/edit_candidate') ?>/' + row._id;
    }
}

function delete_item() {
    var row = $('#dgGrid').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Are you sure you want to delete this candidate: ' + row.nama + '?', function(r) {
            if (r) {
                // Gunakan URL yang lengkap dan konsisten
                $.post('<?= site_url('hr/delete_candidate') ?>', {
                    id: row._id
                }, function(result) {
                    if (result.errorMsg) {
                        // ...
                    } else {
                        // ...
                        $('#dgGrid').datagrid('reload');
                    }
                }, 'json');
            }
        });
    }
}
//

//
function formatCandidateStatus(value, row, index) {
    if (value === 'Candidate') {
        return '<span class="badge bg-secondary">Candidate</span>';
    } else if (value === 'Pre-selected') {
        return '<span class="badge bg-primary">Pre-selected</span>';
    } else if (value === 'Interview') {
        return '<span class="badge bg-success">Interview</span>';
    } else if (value === 'Employee') {
        return '<span class="badge bg-info">Employee</span>';
    }
    return value;
}
//

// FUNGSI BARU UNTUK TOMBOL NAIKKAN STATUS
function promoteStatus() {
    var row = $('#dgGrid').datagrid('getSelected');
    if (row) {
        var nextStatus = '';
        if (row.candidate_status === 'Candidate') nextStatus = 'Pre-selected';
        if (row.candidate_status === 'Pre-selected') nextStatus = 'Interview';

        $.messager.confirm('Confirm', `Naikkan status "${row.nama}" menjadi "${nextStatus}"?`, function(r) {
            if (r) {
                $.post('<?= site_url('hr/update_candidate_status') ?>', {
                    id: row._id,
                    current_status: row.candidate_status
                }, function(result) {
                    if (result.success) {
                        $('#dgGrid').datagrid('reload');
                    } else {
                        $.messager.show({ title: 'Error', msg: result.errorMsg });
                    }
                }, 'json');
            }
        });
    }
}

// FUNGSI BARU UNTUK FORMATTER STATUS
function formatActiveStatusCandidate(value, row, index) {
    if (value == 1) {
        return '<span class="badge bg-success">Aktif</span>';
    } else {
        return '<span class="badge bg-danger">Non Aktif</span>';
    }
}

// FUNGSI BARU UNTUK TOMBOL TOGGLE
function toggleActiveCandidate() {
    var row = $('#dgGrid').datagrid('getSelected');
    if (row) {
        var newStatus = (row.is_aktif == 1) ? 0 : 1;
        var actionText = (newStatus == 1) ? 'mengaktifkan' : 'menonaktifkan';

        $.messager.confirm('Confirm', 'Anda yakin ingin ' + actionText + ' kandidat: ' + row.nama + '?', function(r) {
            if (r) {
                $.post('<?= site_url('hr/toggle_active_status') ?>', {
                    id: row._id,
                    status: newStatus
                }, function(result) {
                    if (result.success) {
                        $('#dgGrid').datagrid('reload');
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

function submitForm() {
    // Buat objek FormData dari form dengan id 'ff'
    var formData = new FormData($('#ff')[0]);

    // Lakukan submit menggunakan jQuery Ajax
    $.ajax({
        url: url, // Variabel 'url' dari fungsi newForm() atau editForm()
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false, // Wajib untuk upload file
        processData: false, // Wajib untuk upload file

        success: function(result) {
            if (result.errorMsg) {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                $('#dialog-form').dialog('close'); // Tutup dialog
                $('#dgGrid').datagrid('reload'); // Muat ulang data tabel
            }
        },
        error: function() {
            $.messager.alert('Error', 'An error occurred while processing the request.', 'error');
        }
    });
}
//end for form submission

// Fungsi untuk format tanggal pada edit tanggall
function myformatter(date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
}

function myparser(s) {
    if (!s) return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
    } else {
        return new Date();
    }
}
//end for format tanggal
</script>