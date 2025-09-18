<style>
   /* 1. Atur SEMUA tombol agar berwarna biru solid secara default */
#toolbarSummary .easyui-linkbutton {
    background-color: #007BFF !important;
    border-color: #0069d9 !important;
    color: #ffffff !important;
}

/* 2. Atur teks dan ikon di semua tombol agar berwarna putih */
#toolbarSummary .easyui-linkbutton .l-btn-text,
#toolbarSummary .easyui-linkbutton .l-btn-icon {
    color: #ffffff !important;
}

/* 3. Atur efek hover (sedikit lebih gelap) untuk tombol yang AKTIF */
#toolbarSummary .easyui-linkbutton:hover {
    background-color: #d1d1d1ff !important;
    border-color: #cccfd3ff !important;4
}

/* 4. Atur style untuk tombol yang DISABLED agar SAMA PERSIS dengan yang aktif */
#toolbarSummary .l-btn-disabled,
#toolbarSummary .l-btn-disabled:hover { /* <-- Aturan hover untuk yg disabled */
    background-color: #007BFF !important; /* Latar biru solid */
    border-color: #0069d9 !important;
    opacity: 1 !important;              /* <-- INI KUNCINYA: Hapus efek pudar */
    cursor: default !important;
}

/* 5. Pastikan teks & ikon di tombol disabled tetap putih */
#toolbarSummary .l-btn-disabled .l-btn-text,
#toolbarSummary .l-btn-disabled .l-btn-icon,
#toolbarSummary .l-btn-disabled:hover .l-btn-text,
#toolbarSummary .l-btn-disabled:hover .l-btn-icon {
    color: #ffffff !important;
}
</style>
<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <table id="dgSummary" class="easyui-datagrid" data-options="
                        title: '<?= $title;?>',
                        method:'get',
                        toolbar: '#toolbarSummary',
                        url: '<?= site_url('hr/get_summaries_json') ?>',
                        pagination: true,
                        rownumbers: true,
                        singleSelect: false,
                        fitColumns: false, /* Penting agar bisa scroll horizontal */
                        pageSize: 20,
                         /* === TAMBAHKAN EVENT HANDLER UNTUK CHECKBOX === */
                        onCheck: function() { $('#btn-export-pdf-summary').linkbutton('enable'); },
                        onUncheck: function() {
                        if ($('#dgSummary').datagrid('getChecked').length === 0) {
                            $('#btn-export-pdf-summary').linkbutton('disable');
                            }
                        },
                        onCheckAll: function() { $('#btn-export-pdf-summary').linkbutton('enable'); },
                        onUncheckAll: function() { $('#btn-export-pdf-summary').linkbutton('disable'); },
                        pageList: [10,20,50,100]
                    ">
                    <thead>
                        <tr>
                            <th data-options="field:'ck', checkbox:true"></th> 
                            <th data-options="field:'candidate_name', width:150">Name</th>
                            <th data-options="field:'birthday', width:80">Birthday</th>
                            <th data-options="field:'age_calc', width:60,  formatter:formatAge">Age</th>
                            <th data-options="field:'ktp_no', width:120">Nik</th>
                            <th data-options="field:'last_education', width:100">Last Education</th>
                            <th data-options="field:'mobile_no', width:100">Mobile No</th>
                            <th data-options="field:'desired_salary', width:100,  formatter:formatRupiah">
                                Expected Salary</th>
                            <th data-options="field:'religion', width:70">Religion</th>
                            <th data-options="field:'discipline', width:120">Discipline</th>
                            <th data-options="field:'position', width:70">Position</th>
                            <th data-options="field:'applying_occupation', width:120">Applying Occupation</th>
                            <th data-options="field:'marriage_status', width:80">Marriage Status</th>
                            <th data-options="field:'class_grade', width:100">Class Grade</th>
                            <th data-options="field:'email', width:200">E-mail</th>
                            <th data-options="field:'total_career_months', width:120, formatter:formatCareer">Career
                            </th>

                            <th
                                data-options="field:'id_family', width:100, align:'center', formatter:formatFamilyAddressDetail">
                                Family & Address </th>

                            <th
                                data-options="field:'id_document', width:120, align:'center', formatter:formatDocumentDetail">
                                Documents</th>

                            <th data-options="field:'id_certificate', align:'center', width:130, formatter:formatDetailCertificate">
                                Skill Authorized Certificates</th>

                            <th data-options="field:'id_hired', width:120, align:'center', formatter:formatHiredDetail">
                                Intial Hired Status 
                            </th>

                            <th
                                data-options="field:'id_reward', width:100, align:'center', formatter:formatRewardDetail">
                                Reward Status</th>

                            <th
                                data-options="field:'id_disciplinary', width:130, align:'center', formatter:formatDisciplinaryDetail">
                                Disciplinary Status</th>

                            <th
                                data-options="field:'id_chronology', width:120, align:'center', formatter:formatChronologyDetail">
                                Chronology Status</th>


                            <th data-options="field:'is_aktif', width:80, align:'center', formatter:formatActiveStatus">
                                Status</th>
                        </tr>
                    </thead>
                </table>

                <div id="toolbarSummary" style="padding: 10px">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?= site_url('hr/listcandidate') ?>" class="easyui-linkbutton" iconCls="icon-back"
                                plain="false">Back to Candidates</a>

                            <a href="javascript:void(0)" id="btn-edit-summary" class="easyui-linkbutton"
                                iconCls="icon-edit" plain="false" data-options="disabled:true"
                                onclick="editSummary()">Edit Summary</a>
                            <a href="javascript:void(0)" id="btn-delete-summary" class="easyui-linkbutton"
                                iconCls="icon-remove" plain="false" data-options="disabled:true"
                                onclick="deleteSummary()">Delete Summary</a>
                            <a href="javascript:void(0)" id="btn-toggle-active" class="easyui-linkbutton"
                                iconCls="icon-remove" data-options="disabled:true" onclick="toggleActive()">Aktif / Non
                                Aktif</a>
                            <a href="javascript:void(0)" id="btn-export-pdf-summary" class="easyui-linkbutton" data-options="iconCls:'icon-print', disabled:true" onclick="exportSummaryToPdf()">Export PDF</a>

                        </div>
                        <div class="col-md-6 text-end">
                            <input id="searchSummary" class="easyui-searchbox"
                                data-options="prompt:'Search Summary...', searcher:doSearchSummary" style="width:70%;">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk search box
function doSearchSummary(value) {
    $('#dgSummary').datagrid('load', {
        search_data: value
    });
}

// Fungsi untuk format mata uang Rupiah
function formatRupiah(value, row, index) {
    if (value) {
        return 'IDR ' + new Intl.NumberFormat('id-ID').format(value);
    }
    return '';
}

function exportSummaryToPdf() {
    var rows = $('#dgSummary').datagrid('getChecked');
    if (rows.length > 0) {
        var ids = [];
        for(var i=0; i<rows.length; i++){
            ids.push(rows[i]._id);
        }
        
        // Buat form sementara untuk mengirim ID ke controller BARU
        var form = document.createElement('form');
        form.method = 'POST';
        // UBAH ACTION KE FUNGSI BARU INI
        form.action = '<?= site_url('hr/export_summary_pdf') ?>';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids';
        input.value = ids.join(',');

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

    } else {
        $.messager.alert('Info', 'Silakan pilih minimal satu summary untuk diekspor.');
    }
}


// Fungsi untuk format durasi karir
function formatCareer(value, row, index) {
    if (value) {
        var years = Math.floor(value / 12);
        var months = value % 12;
        return years + ' years ' + months + ' months';
    }
    return 'N/A';
}

// Fungsi untuk tombol Edit di toolbar
function editSummary() {
    var row = $('#dgSummary').datagrid('getSelected');
    if (row) {
        window.location.href = '<?= site_url('hr/formsummary') ?>/' + row._id;
    }
}
//

//
function formatAge(value, row, index) {
    // Ambil data tanggal lahir dari 'row.birthday'
    const birthDateString = row.birthday; 

    if (!birthDateString) {
        return ''; // Kembalikan kosong jika tanggal lahir tidak ada
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

// Fungsi untuk tombol Delete di toolbar
function deleteSummary() {
    var row = $('#dgSummary').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Are you sure you want to delete this candidate: ' + row.candidate_name + '?',
            function(r) {
                if (r) {
                    // Pastikan URL ini benar
                    $.post('<?= site_url('hr/delete_summary') ?>', {
                        id: row._id
                    }, function(result) {
                        if (result.success) {

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

// FUNGSI BARU UNTUK FORMATTER STATUS
function formatActiveStatus(value, row, index) {
    if (value == 1) {
        return '<span class="badge bg-success">Aktif</span>';
    } else {
        return '<span class="badge bg-danger">Non Aktif</span>';
    }
}

// FUNGSI BARU UNTUK TOMBOL TOGGLE
function toggleActive() {
    var row = $('#dgSummary').datagrid('getSelected');
    if (row) {
        // Tentukan status baru (jika 1 jadi 0, jika 0 jadi 1)
        var newStatus = (row.is_aktif == 1) ? 0 : 1;
        var actionText = (newStatus == 1) ? 'mengaktifkan' : 'menonaktifkan';

        $.messager.confirm('Confirm', 'Anda yakin ingin ' + actionText + ' kandidat: ' + row.candidate_name + '?',
            function(r) {
                if (r) {
                    $.post('<?= site_url('hr/toggle_active_status') ?>', {
                        id: row._id,
                        status: newStatus
                    }, function(result) {
                        if (result.success) {
                            $('#dgSummary').datagrid('reload');
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

//
function formatDocumentDetail(value, row, index) {
    // 'value' sekarang akan berisi nilai dari row._id
    var url = '<?= site_url('hr/view_document_detail') ?>/' + value; // Diperbaiki di sini
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Documents</a>';
}
//

//format family detail
function formatFamilyAddressDetail(value, row, index) {
    // value di sini adalah row._id
    var url = '<?= site_url('hr/view_family_address_detail') ?>/' + value;
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Family</a>';
}
//

//
//star untuk menampilkan detail data status career
function formatDetailCertificate(value, row, index) {
    // 'value' sekarang akan berisi ID dari field 'id_certificate'
    var url = '<?= site_url('hr/view_certificate_detail') ?>/' + value + '?from=listsummary';
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Certificates</a>';
}
//end untuk menampilkan detail data status career


//
function formatHiredDetail(value, row, index) {
    // value di sini adalah row._id
    var url = '<?= site_url('hr/view_hired_detail') ?>/' + value;
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Hired Status</a>';
}
//


//
function formatRewardDetail(value, row, index) {
    // value di sini adalah row.id_reward
    var url = '<?= site_url('hr/view_reward_detail') ?>/' + value;
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Reward</a>';
}
//

//
function formatDisciplinaryDetail(value, row, index) {
    // value di sini adalah row.id_disciplinary
    var url = '<?= site_url('hr/view_disciplinary_detail') ?>/' + value;
    return '<a href="' + url +
        '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Disciplinary </a>';
}
//

//
function formatChronologyDetail(value, row, index) {
    // value di sini adalah row.id_chronology
    var url = '<?= site_url('hr/view_chronology_detail') ?>/' + value;
    return '<a href="' + url + '" class="easyui-linkbutton" data-options="iconCls:\'icon-search\', plain:true">View Chronology</a>';
}
//


//

// Inisialisasi DataGrid saat halaman siap (digabung menjadi satu)
$(function() {
    $('#dgSummary').datagrid({
        onSelect: function(index, row) {
            // Aktifkan tombol saat baris dipilih
            $('#btn-edit-summary').linkbutton('enable');
            $('#btn-delete-summary').linkbutton('enable');
            $('#btn-toggle-active').linkbutton('enable'); // Aktifkan tombol baru
        },
        onUnselect: function(index, row) {
            // Nonaktifkan tombol saat pilihan dibatalkan
            $('#btn-edit-summary').linkbutton('disable');
            $('#btn-delete-summary').linkbutton('disable');
            $('#btn-toggle-active').linkbutton('disable'); // Nonaktifkan tombol baru
        },
        onLoadSuccess: function() {


            // Pastikan tombol nonaktif saat data baru dimuat
            $('#btn-edit-summary').linkbutton('disable');
            $('#btn-delete-summary').linkbutton('disable');
            $('#btn-toggle-active').linkbutton('disable'); // Nonaktifkan tombol baru
        }
    });
});
</script>