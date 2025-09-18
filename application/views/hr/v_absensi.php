<style>
/* Perbaikan untuk teks tombol Export Data di toolbar EasyUI */




/* Tambahkan ini ke CSS Anda */
.icon-h-office::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f1ad";
    /* Ikon gedung */
    font-size: 16px;
    color: #007BFF;
}

.icon-kn-project::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f085";
    /* Ikon cogs/gears */
    font-size: 16px;
    color: #6c757d;
}

.icon-excel {
    background: url('path/to/your/excel_icon.png') no-repeat center center;
}

.icon-pdf {
    background: url('path/to/your/pdf_icon.png') no-repeat center center;
}

.icon-template {
    background: url('path/to/your/template_icon.png') no-repeat center center;
}

/* Atau gunakan ikon FontAwesome jika Anda lebih suka */
.icon-excel::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f1c3";
    /* Ikon file-excel */
    font-size: 16px;
    color: #1D6F42;
}

.icon-pdf::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f1c1";
    /* Ikon file-pdf */
    font-size: 16px;
    color: #B30B00;
}

.icon-template::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f56d";
    /* Ikon file-download */
    font-size: 16px;
    color: #555;
}
</style>

<div class="container-fluid mt-4">
    <div id="upload-container">
        <div class="card">
            <div class="card-header text-dark">
                <h4 class="mb-0"><i class="fas fa-file-import me-2"></i>Import Employee Attendance</h4>
            </div>
            <div class="card-body">
                <form id="form-import" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-end">
                        <div class="col-md-6 mb-3">
                            <label for="file_excel" class="form-label fw-bold">Select Excel File (.xlsx):</label>
                            <input class="form-control" type="file" name="file_excel" id="file_excel"
                                accept=".xlsx,.xls" required>
                            <small class="text-muted">Allowed format: .xlsx, .xls (Max: 5MB)</small>
                        </div>
                        <div class="col-md-6 mb-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>Review Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="review-container" class="card mt-4" style="display: none;">
        <div class="card-header text-dark">
            <h4 class="card-title mb-0"><i class="fas fa-clipboard-check me-2"></i>Review Data Before Import</h4>
        </div>
        <div class="card-body">
            <p>Please review the data below. If everything is correct, click "Confirm & Import".</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NIK</th>
                            <th>Nama <small>(dari sistem)</small></th>
                            <th>Tanggal Masuk</th>
                            <th>Keterangan</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="review-table-body">
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="temp_file_name">
        </div>
        <div class="card-footer text-end">
            <button id="btn-cancel-review" class="btn btn-danger me-2"><i class="fas fa-times me-2"></i>Cancel</button>
            <button id="btn-confirm-import" class="btn btn-success"><i class="fas fa-check me-2"></i>Confirm &
                Import</button>
        </div>
    </div>

    <div class="card mt-4">

        <div class="card-header bg-light">
            <h4 class="card-title mb-0"><i class="fas fa-list-alt me-2"></i>Attendance Data</h4>
        </div>

        <div id="toolbarAbsensi" style="padding:5px; display:flex; flex-wrap:wrap; align-items:center; gap:8px;">

    <!-- Searchbox -->
    <input class="easyui-searchbox" 
           data-options="prompt:'Search...', searcher:doSearchAbsensi" 
           style="width:250px">

    <!-- Aksi edit/hapus -->
    <!-- <a href="javascript:void(0)" class="easyui-linkbutton" 
       data-options="iconCls:'icon-edit', plain:false" 
       onclick="editAbsensi()">Edit</a> -->

    <a href="javascript:void(0)" class="easyui-linkbutton" 
       data-options="iconCls:'icon-remove', plain:false" 
       onclick="deleteAbsensi()">Delete</a>

    <!-- Export -->
    <!-- <a href="javascript:void(0)" class="easyui-menubutton"
       data-options="menu:'#menu-export', iconCls:'icon-save', plain:false">Export Data</a>
    <div id="menu-export" style="width:150px;" data-options="hideOnUnhover:true">
        <div data-options="iconCls:'icon-excel'" onclick="exportData('excel')">Export to Excel</div>
        <div data-options="iconCls:'icon-pdf'" onclick="exportData('pdf')">Export to PDF</div>
    </div> -->

    <!-- Report -->
    <a href="javascript:void(0)" class="easyui-menubutton"
       data-options="menu:'#menu-report', iconCls:'icon-print', plain:false">Report</a>
    <div id="menu-report" style="width:160px;">
        <div data-options="iconCls:'icon-h-office'" 
             onclick="window.location.href='<?= site_url('hr/report_ho') ?>'">Report HO</div>
        <div data-options="iconCls:'icon-kn-project'" 
             onclick="window.location.href='<?= site_url('hr/report_kn_project') ?>'">Report KN Project</div>
    </div>

    <!-- Tombol Naikkan Status -->
   <a href="javascript:void(0)" id="btn-promote-status" class="easyui-linkbutton" 
   data-options="iconCls:'icon-ok', plain:false, disabled:true" onclick="promoteDailyStatus()">Update Status</a>

    <!-- Filter Tahun -->
    <label for="filter-tahun">Tahun:</label>
    <input id="filter-tahun" class="easyui-combobox" style="width:100px;">

    <!-- Filter Bulan -->
    <label for="filter-bulan">Bulan:</label>
    <input id="filter-bulan" class="easyui-combobox" style="width:120px;">

    <!-- Filter Lokasi -->
    <label for="filter-lokasi">Lokasi:</label>
    <input id="filter-lokasi" class="easyui-combobox" style="width:120px;"
           data-options="
                valueField: 'value', textField: 'text', panelHeight: 'auto', required: true,
                data: [{value: 'HO', text: 'HO'}, {value: 'KN Project', text: 'KN Project'}]
           ">

    <!-- Tombol filter -->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-filter" onclick="applyFilters()">Filter</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="resetFilters()">Reset</a>
</div>

        <table id="absensi-table" class="easyui-datagrid" style="width:100%;height:450px" data-options="
                         url:'<?= site_url('hr/get_absensi_json'); ?>',
                        method:'get',
                        pagination:true,
                        rownumbers:true,
                        singleSelect:true,
                        fitColumns:true,
                        toolbar:'#toolbarAbsensi',
                         onSelect: function(index, row){
                        // Aktifkan tombol hanya jika statusnya BUKAN 'Approved'
                        if(row.status !== 'Approved'){
                            $('#btn-promote-absen').linkbutton('enable');
                        } else {
                            $('#btn-promote-absen').linkbutton('disable');
                        }
                    },
                    onUnselect: function(){
                        $('#btn-promote-absen').linkbutton('disable');
                    }
                        ">
            <thead>

                <tr>
                    <th data-options="field:'tgl_masuk',width:100">Date</th>
                    <th data-options="field:'indirect',width:150">Work Location</th>
                     <th data-options="field:'total_hadir',width:120,align:'center'">present today</th>
                     <th data-options="field:'total_tidak_hadir',width:120,align:'center'">not present</th>
                     <th data-options="field:'total_keseluruhan',width:120,align:'center'">total present</th>
                    <th data-options="field:'status',width:120,align:'center',formatter:formatAbsenStatus">Status</th>
                    <th data-options="field:'action_report', width:120, align:'center',  formatter:formatReportHarianAction">Daily Report</th>

                </tr>
            </thead>
        </table>
    </div>
</div>
</div>
<!-- end -->

<!-- untuk edit -->
<div id="dialog-absensi" class="easyui-window" title="Edit Data Absensi"
    data-options="modal:true,closed:true,iconCls:'icon-edit',footer:'#dialog-buttons'"
    style="width:500px;padding:20px;">

    <form id="form-absensi" method="post" novalidate>
        <input type="hidden" name="id">

        <div style="margin-bottom:15px">
            <input class="easyui-textbox" name="nik" style="width:100%" data-options="label:'NIK:',readonly:true">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-textbox" name="nama" style="width:100%" data-options="label:'Nama:',readonly:true">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-datebox" name="tgl_masuk" style="width:100%"
                data-options="label:'Tanggal Masuk:',required:true,formatter:myformatter,parser:myparser">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-textbox" name="keterangan" style="width:100%"
                data-options="label:'Keterangan:',multiline:true" style="height:60px">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-combobox" name="kehadiran" style="width:100%" data-options="
                label:'Kehadiran:',
                valueField: 'value',
                textField: 'text',
                panelHeight: 'auto',
                required:true,
                data: [
                    {value:'Hadir', text:'Hadir'},
                    {value:'Sakit', text:'Sakit'},
                    {value:'Izin', text:'Izin'},
                    {value:'Tidak Hadir', text:'Tidak Hadir'}
                ]">
        </div>
    </form>
</div>

<div id="dialog-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="submitAbsensi()"
        style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
        onclick="javascript:$('#dialog-absensi').window('close')" style="width:90px">Cancel</a>
</div>
<!--  -->

<script>
// Deklarasikan variabel global untuk URL
var url_absensi;

//
$(function() {
    // Inisialisasi dropdown Tahun
    $('#filter-tahun').combobox({
        valueField: 'year',
        textField: 'year',
        panelHeight: 'auto',
        data: (function() {
            var years = [];
            var currentYear = new Date().getFullYear();
            for (var i = currentYear; i >= 2020; i--) {
                years.push({
                    year: i
                });
            }
            return years;
        })()
    });

    // Inisialisasi dropdown Bulan
    $('#filter-bulan').combobox({
        valueField: 'value',
        textField: 'text',
        panelHeight: 'auto',
        data: [{
                value: '01',
                text: 'Januari'
            }, {
                value: '02',
                text: 'Februari'
            },
            {
                value: '03',
                text: 'Maret'
            }, {
                value: '04',
                text: 'April'
            },
            {
                value: '05',
                text: 'Mei'
            }, {
                value: '06',
                text: 'Juni'
            },
            {
                value: '07',
                text: 'Juli'
            }, {
                value: '08',
                text: 'Agustus'
            },
            {
                value: '09',
                text: 'September'
            }, {
                value: '10',
                text: 'Oktober'
            },
            {
                value: '11',
                text: 'November'
            }, {
                value: '12',
                text: 'Desember'
            }
        ]
    });
});

// Fungsi untuk menerapkan semua filter
function applyFilters() {
    $('#absensi-table').datagrid('load', {
        search_data: $('#search_absensi').val(),
        year: $('#filter-tahun').combobox('getValue'),
        month: $('#filter-bulan').combobox('getValue'),
        location: $('#filter-lokasi').combobox('getValue')
    });
}

// Fungsi untuk mereset filter
function resetFilters() {
    $('#search_absensi').searchbox('clear');
    $('#filter-tahun').combobox('clear');
    $('#filter-bulan').combobox('clear');
    $('#filter-lokasi').combobox('clear');
    applyFilters();
}
//

//
 function formatAbsenStatus(value, row, index) {
    // 'value' sekarang berisi teks status (Nothing, Prepared, dll)
    let color = 'secondary';
    if (value === 'Prepared') color = 'warning text-dark';
    if (value === 'Reviewed') color = 'info';
    if (value === 'Reviewed 2') color = 'primary';
    if (value === 'Approved') color = 'success';
    
    if (!value) return '<span class="badge bg-secondary">Nothing</span>';
    return `<span class="badge bg-${color}">${value}</span>`;
}

// FUNGSI BARU UNTUK TOMBOL NAIKKAN STATUS
function promoteAbsenStatus() {
    var row = $('#absensi-table').datagrid('getSelected');
    if (row) {
        $.post('<?= site_url('hr/update_absensi_status') ?>', {
            id: row.id,
            current_status: row.status
        }, function(result) {
            if (result.success) {
                $('#absensi-table').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            }
        }, 'json');
    }
}

function filterDataAbsensi() {
     var isValid = $('#filter-tahun').combobox('validate') && 
                      $('#filter-bulan').combobox('validate') && 
                      $('#filter-lokasi').combobox('validate');
        
        if (!isValid) {
            $.messager.alert('Peringatan', 'Harap isi semua filter (Tahun, Bulan, dan Lokasi).', 'warning');
            return;
        }

        // Kumpulkan parameter
        var params = {
            year: $('#filter-tahun').combobox('getValue'),
            month: $('#filter-bulan').combobox('getValue'),
            location: $('#filter-lokasi').combobox('getValue')
        };

        // Atur URL dan muat data ke datagrid
        $('#absensi-table').datagrid({
            url: '<?= site_url('hr/get_absensi_json') ?>',
            queryParams: params
        });
}
//

//
// FUNGSI BARU: Untuk membuat tombol "Cetak PDF" di setiap baris
    function formatReportHarianAction(value, row, index) {
        // Tombol ini akan memanggil fungsi cetakLaporanHarian dengan tanggal dari baris tersebut
        return `<a href="javascript:void(0)" class="cetak-harian-btn" 
                   onclick="cetakLaporanHarian('${row.tgl_masuk}')">Print PDF</a>`;
    }

    // FUNGSI BARU: Untuk membuka halaman cetak PDF harian
    function cetakLaporanHarian(tanggal) {
        if (tanggal) {
            let url = "<?= site_url('hr/cetak_laporan_harian') ?>?tanggal=" + encodeURIComponent(tanggal);
            window.open(url, '_blank');
        }
    }
//

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

// Fungsi untuk membuka dialog edit
function editAbsensi() {
    var row = $('#absensi-table').datagrid('getSelected');
    if (row) {
        $('#dialog-absensi').window('open').window('setTitle', 'Edit Data Absensi');
        $('#form-absensi').form('load', row);
        url_absensi = '<?= site_url('hr/update_absensi') ?>/' + row.id;
    } else {
        Swal.fire('Warning', 'Select the row of data you want to change.', 'warning');
    }
}
//

//
function deleteAbsensi() {
    // 1. Dapatkan baris yang dipilih
    var row = $('#absensi-table').datagrid('getSelected');

    // 2. Periksa apakah ada baris yang dipilih
    if (row) {
        // 3. Tampilkan dialog konfirmasi bawaan EasyUI
        $.messager.confirm('Confirm Delete', 'Are you sure you want to delete the attendance data for:' + row.nama +
            '?',
            function(r) {

                // 4. Jika pengguna menekan tombol "OK" (r akan bernilai true)
                if (r) {
                    // Tampilkan loading progress
                    $.messager.progress({
                        title: 'Please wait',
                        msg: 'Deleting data...'
                    });

                    // 5. Kirim request hapus ke server
                    $.post('<?= site_url('hr/delete_absensi') ?>', {
                        id: row.id
                    }, function(response) {
                        $.messager.progress('close'); // Tutup loading

                        // 6. Tangani respons dari server
                        if (response.status === 'success') {
                            $('#absensi-table').datagrid('reload'); // Muat ulang tabel

                            // Tampilkan notifikasi sukses di pojok kanan bawah
                            $.messager.show({
                                title: 'Sukses',
                                msg: response.message,
                                timeout: 300,
                                showType: 'slide'
                            });
                        } else {
                            // Tampilkan pesan error jika gagal
                            $.messager.alert('Error', response.message, 'error');
                        }
                    }, 'json').fail(function() {
                        $.messager.progress('close');
                        $.messager.alert('Error', 'Cannot connect to the server.', 'error');
                    });
                }
            });
    } else {
        // Jika tidak ada baris yang dipilih, tampilkan peringatan
        $.messager.alert('Warning', 'Select the data row you want to delete.', 'warning');
    }
}
//

// Fungsi untuk menyimpan perubahan
function submitAbsensi() {
    $('#form-absensi').form('submit', {
        url: url_absensi,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(result) {
            var result = eval('(' + result + ')');
            if (result.errorMsg) {
                Swal.fire('Error', result.errorMsg, 'error');
            } else {
                $('#dialog-absensi').window('close'); // Tutup dialog
                $('#absensi-table').datagrid('reload'); // Muat ulang data
                Toast.fire({
                    icon: 'success',
                    title: result.message
                });
            }
        }
    });
}
//

// Fungsi untuk melakukan pencarian (Anda sudah punya ini)
function doSearchAbsensi(value) {
    $('#absensi-table').datagrid('load', {
        search_data: value
    });
}
//

// function exportData(format) {
//     // Gunakan selector yang lebih spesifik untuk menargetkan searchbox di dalam toolbar
//     const searchValue = $('#toolbarAbsensi .easyui-searchbox').searchbox('getValue');

//     // Buat URL untuk ekspor
//     let url = "<?= site_url('hr/export_absensi') ?>/" + format;

//     // Tambahkan parameter pencarian jika ada
//     if (searchValue) {
//         url += "?search_data=" + encodeURIComponent(searchValue);
//     }

//     // Buka URL di tab baru untuk memulai download
//     window.open(url, '_blank');
// }

// Fungsi BARU untuk download template
function downloadTemplate() {
    window.location.href = "<?= site_url('hr/download_template_absensi') ?>";
}
$(document).ready(function() {



    // Konfigurasi untuk notifikasi "Toast" di pojok kanan atas
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000, // Notifikasi hilang setelah 3 detik
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    const OPSI_KEHADIRAN = ['Hadir', 'Sakit', 'Izin', 'Tidak Hadir'];

    // 1. Menangani form submit untuk preview
    $('#form-import').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        Swal.fire({
            title: 'Processing...',
            text: 'Reading the Excel file, please wait.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "<?= site_url('hr/preview_absensi') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                Swal.close();
                if (response.status === 'success') {
                    $('#review-table-body').empty();
                    response.data.forEach(function(row) {
                        let selectKehadiran =
                            `<select class="form-select form-select-sm review-kehadiran">`;
                        OPSI_KEHADIRAN.forEach(function(opsi) {
                            let isSelected = (row.kehadiran
                                    .toLowerCase() === opsi.toLowerCase()) ?
                                'selected' : '';
                            selectKehadiran +=
                                `<option value="${opsi}" ${isSelected}>${opsi}</option>`;
                        });
                        selectKehadiran += `</select>`;

                        var tableRow = `
                            <tr>
                                <td><input type="text" class="form-control form-control-sm review-nik" value="${row.nik}"></td>
                                <td>${row.nama}</td>
                                <td><input type="date" class="form-control form-control-sm review-tgl" value="${row.tgl_masuk}"></td>
                                <td><input type="text" class="form-control form-control-sm review-keterangan" value="${row.keterangan}"></td>
                                <td>${selectKehadiran}</td> 
                            </tr>`;
                        $('#review-table-body').append(tableRow);
                    });
                    $('#upload-container').hide();
                    $('#review-container').show();
                } else {
                    // Notifikasi error jika preview gagal
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An unexpected error occurred while processing the file.'
                });
            }
        });
    });

    // 2. Menangani tombol "Confirm & Import"
    $('#btn-confirm-import').on('click', function() {
        let dataToImport = [];
        $('#review-table-body tr').each(function() {
            let row = $(this);
            dataToImport.push({
                nik: row.find('.review-nik').val(),
                tgl_masuk: row.find('.review-tgl').val(),
                keterangan: row.find('.review-keterangan').val(),
                kehadiran: row.find('.review-kehadiran').val()
            });
        });

        if (dataToImport.length === 0) {
            Swal.fire('Warning!', 'Tidak ada data untuk diimpor.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Importing...',
            text: 'Saving data to the database..',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "<?= site_url('hr/confirm_import_edited') ?>",
            type: "POST",
            data: {
                imported_data: JSON.stringify(dataToImport)
            },
            dataType: 'json',
            success: function(response) {
                Swal.close();
                if (response.status === 'success') {
                    $('#review-container').hide();
                    $('#upload-container').show();
                    $('#form-import')[0].reset();
                    $('#absensi-table').datagrid('load', {});

                    // NOTIFIKASI SUKSES (TOAST) 

                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An unexpected error occurred during the import..'
                });
            }
        });
    });

    // 3. Menangani tombol "Cancel"
    $('#btn-cancel-review').on('click', function() {
        $('#review-container').hide();
        $('#upload-container').show();
        $('#form-import')[0].reset();
    });
});
//
// --- INISIALISASI ---
// $(function() {
//         // ... (inisialisasi filter Anda tetap sama)

//         $('#absensi-table').datagrid({
//             // ... (konfigurasi Anda)
//             singleSelect: true,
//             onSelect: function(index, row) {
//                 if (row.status !== 'Approved') {
//                     $('#btn-promote-status').linkbutton('enable');
//                 } else {
//                     $('#btn-promote-status').linkbutton('disable');
//                 }
//             },
//             onUnselect: function(index, row) {
//                 $('#btn-promote-status').linkbutton('disable');
//             },
//             onLoadSuccess: function() {
//                 $('#btn-promote-status').linkbutton('disable');
//             }
//         });
//     });
// //

//
function promoteDailyStatus() {
    var row = $('#absensi-table').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Konfirmasi', 'Naikkan status untuk tanggal ' + row.tgl_masuk + ' di lokasi ' + row.work_location + '?', function(r) {
            if (r) {
                // 1. Tampilkan loading progress SEBELUM request dikirim
                $.messager.progress({
                    title: 'Mohon Tunggu',
                    msg: 'Memperbarui status dan mengirim notifikasi email...'
                });

                // Gunakan $.ajax agar kita bisa menangani 'error' dengan lebih baik
                $.ajax({
                    url: '<?= site_url('hr/promote_daily_status') ?>',
                    type: 'POST',
                    data: { 
                        tgl_masuk: row.tgl_masuk,
                        work_location: row.work_location
                    },
                    dataType: 'json',
                    success: function(result) {
                        // 2. Tutup loading jika berhasil
                        $.messager.progress('close');
                        if (result.status === 'success') {
                            $('#absensi-table').datagrid('reload');
                            $.messager.show({ title: 'Sukses', msg: result.message });
                        } else {
                            $.messager.alert('Error', result.message, 'error');
                        }
                    },
                    error: function() {
                        // 3. Tutup loading jika terjadi error koneksi
                        $.messager.progress('close');
                        $.messager.alert('Error', 'Gagal terhubung ke server.', 'error');
                    }
                });
            }
        });
    }
}
//

// --- INISIALISASI SAAT HALAMAN SIAP ---
   $(function() {
        // Atur nilai default untuk filter
        $('#filter-tahun').combobox('setValue', '<?= date('Y') ?>');
        $('#filter-bulan').combobox('setValue', '<?= date('m') ?>');

        // Inisialisasi datagrid SATU KALI dengan semua properti
        $('#absensi-table').datagrid({
            // Tidak ada 'url' di sini agar tidak loading otomatis
            title: 'Data Absensi',
            toolbar: '#toolbarAbsensi',
            pagination: true,
            rownumbers: true,
            singleSelect: true,
            fitColumns: false, // Diubah agar bisa scroll jika banyak kolom
            
            onSelect: function(index, row) {
                if (row.status !== 'Approved') {
                    $('#btn-promote-status').linkbutton('enable');
                } else {
                    $('#btn-promote-status').linkbutton('disable');
                }
            },
            onUnselect: function(index, row) {
                $('#btn-promote-status').linkbutton('disable');
            },
            onLoadSuccess: function() {
                // Inisialisasi tombol "Cetak PDF" yang baru dibuat di dalam tabel
                $('.cetak-harian-btn').linkbutton({
                    plain: false,
                    iconCls: 'icon-print'
                });
                // Selalu nonaktifkan tombol promote status setelah data dimuat
                $('#btn-promote-status').linkbutton('enable');
                // Hapus pilihan setelah memuat ulang
                $(this).datagrid('clearSelections');
            }
        });

        // Kosongkan datagrid saat pertama kali dimuat
        $('#absensi-table').datagrid('loadData', {"total":0,"rows":[]});
    });
//

</script>