<style>
/* Perbaikan untuk teks tombol Export Data di toolbar EasyUI */
#toolbarAbsensi .easyui-menubutton .l-btn-text {
    color: #444 !important;
    /* Ubah warna teks menjadi abu-abu gelap */
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
        <div class="card-body">
            <div id="toolbarAbsensi" style="padding:5px;">
                <input class="easyui-searchbox" data-options="prompt:'Search...', searcher:doSearchAbsensi"
                    style="width:250px">

                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit', plain:false"
                    onclick="editAbsensi()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove', plain:false"
                    onclick="deleteAbsensi()">Delete</a>


                <a href="javascript:void(0)" class="easyui-menubutton"
                    data-options="menu:'#menu-export', iconCls:'icon-save', plain:false">Export Data</a>
                <div id="menu-export" style="width:150px;" data-options="hideOnUnhover:true">
                    <div data-options="iconCls:'icon-excel'" onclick="exportData('excel')">Export to Excel</div>
                    <div data-options="iconCls:'icon-pdf'" onclick="exportData('pdf')">Export to PDF</div>


                </div>
            </div>
            <table id="absensi-table" class="easyui-datagrid" style="width:100%;height:450px" data-options="
                        url:'<?= site_url('hr/get_absensi_json'); ?>',
                        method:'get',
                        pagination:true,
                        rownumbers:true,
                        singleSelect:true,
                        fitColumns:true,
                        toolbar:'#toolbarAbsensi'">
                <thead>

                    <tr>
                        <th data-options="field:'nik',width:150">NIK</th>
                        <th data-options="field:'nama',width:200">Nama</th>
                        <th data-options="field:'tgl_masuk',width:100">Date</th>
                        <th data-options="field:'position',width:120">Position</th>
                        <th data-options="field:'team',width:110">Team</th>
                        <th data-options="field:'work_location',width:150">Work Location</th>
                        <th data-options="field:'keterangan',width:200">Explanation</th>
                        <th data-options="field:'kehadiran',width:100">Presence</th>
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

// Fungsi untuk format tanggal (jika belum ada)
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
        $.messager.confirm('Confirm Delete', 'Are you sure you want to delete the attendance data for:' + row.nama + '?', function(r) {
            
            // 4. Jika pengguna menekan tombol "OK" (r akan bernilai true)
            if (r) {
                // Tampilkan loading progress
                $.messager.progress({
                    title: 'Please wait',
                    msg: 'Deleting data...'
                });

                // 5. Kirim request hapus ke server
                $.post('<?= site_url('hr/delete_absensi') ?>', { id: row.id }, function(response) {
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

function exportData(format) {
    // Gunakan selector yang lebih spesifik untuk menargetkan searchbox di dalam toolbar
    const searchValue = $('#toolbarAbsensi .easyui-searchbox').searchbox('getValue');

    // Buat URL untuk ekspor
    let url = "<?= site_url('hr/export_absensi') ?>/" + format;

    // Tambahkan parameter pencarian jika ada
    if (searchValue) {
        url += "?search_data=" + encodeURIComponent(searchValue);
    }

    // Buka URL di tab baru untuk memulai download
    window.open(url, '_blank');
}

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

                    // ======================================================
                    // NOTIFIKASI SUKSES (TOAST) YANG ANDA INGINKAN
                    // ======================================================
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
</script>