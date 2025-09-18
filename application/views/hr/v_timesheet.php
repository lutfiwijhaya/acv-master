<style>
/* CSS untuk tombol toolbar agar seragam */
/* #toolbarTimesheet .easyui-linkbutton {
    background-color: #007BFF !important;
    border-color: #0069d9 !important;
    color: #ffffff !important;
}

#toolbarTimesheet .easyui-linkbutton .l-btn-text,
#toolbarTimesheet .easyui-linkbutton .l-btn-icon {
    color: #ffffff !important;
}

#toolbarTimesheet .easyui-linkbutton:hover {
    background-color: #0056b3 !important;
    border-color: #0054a9 !important;
} */

#toolbarTimesheet .easyui-menubutton {
    /* Tambahkan menubutton di sini */
    background-color: #007BFF !important;
    border-color: #0069d9 !important;
    color: #ffffff !important;
}

#toolbarTimesheet .easyui-menubutton .l-btn-icon {
    /* Tambahkan menubutton di sini */
    color: #ffffff !important;
}

/*CSS untuk icon excel dan icon pdf*/
.icon-excel::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f1c3";
    /* Ikon file-excel */
    font-size: 16px;
    color: #1D6F42;
    /* Warna hijau */
}

.icon-pdf::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f1c1";
    /* Ikon file-pdf */
    font-size: 16px;
    color: #B30B00;
    /* Warna merah */
}

/* Aturan agar warna ikon di menu tidak berubah saat di-hover */
.menu-item-hover .icon-excel::before {
    color: #1D6F42 !important;
}

.menu-item-hover .icon-pdf::before {
    color: #B30B00 !important;
}
</style>

<div class="container-fluid mt-4">
    <div id="upload-container-timesheet">
        <div class="card">
            <div class="card-header text-dark">
                <h4 class="mb-0"><i class="fas fa-file-import me-2"></i>Import Timesheet from Excel</h4>
            </div>
            <div class="card-body">
                <form id="form-import-timesheet" method="POST" enctype="multipart/form-data">
                    <div class="row align-items-end">
                        <div class="col-md-6 mb-3">
                            <label for="file_excel_timesheet" class="form-label fw-bold">Select Excel File
                                (.xlsx):</label>
                            <input class="form-control" type="file" name="file_excel_timesheet"
                                id="file_excel_timesheet" accept=".xlsx,.xls" required>
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

    <div id="review-container-timesheet" class="card mt-4" style="display: none;">
        <div class="card-header text-dark">
            <h4 class="card-title mb-0"><i class="fas fa-clipboard-check me-2"></i>Review Timesheet Data</h4>
        </div>
        <div class="card-body">
            <p>Please review the data below. If everything is correct, click "Confirm & Import".</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Entry Time</th>
                            <th>Break Start</th>
                            <th>Break End</th>
                            <th>Exit Time</th>
                            <th>OT Break Start</th>
                            <th>OT Break End</th>
                            <th>OT Exit</th>
                        </tr>
                    </thead>
                    <tbody id="review-body-timesheet">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end">
            <button id="btn-cancel-review-timesheet" class="btn btn-danger me-2"><i
                    class="fas fa-times me-2"></i>Cancel</button>
            <button id="btn-confirm-import-timesheet" class="btn btn-success"><i class="fas fa-check me-2"></i>Confirm &
                Import</button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table id="dgTimesheet" class="easyui-datagrid" style="width:100%;height:550px">
                <thead>
                    <tr>
                        <th data-options="field:'nik', width:150">NIK</th>
                        <th data-options="field:'nama', width:200">Employee Name</th>
                        <th data-options="field:'time_in', width:200">Entry Time</th>
                        <th data-options="field:'break_out', width:200">Break Start</th>
                        <th data-options="field:'break_in', width:200">Break End</th>
                        <th data-options="field:'time_out', width:100">Exit Time</th>
                        <th data-options="field:'break_overtime_out', width:200, editor:'timespinner'">Overtime Break
                            Start</th>
                        <th data-options="field:'break_overtime_in', width:200, editor:'timespinner'">Overtime Break End
                        </th>
                        <th data-options="field:'overtime_out', width:100, editor:'timespinner'">Overtime Exite</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarTimesheet" style="padding:5px;">
                <span>Tanggal:</span>
                <input id="filter-tanggal" class="easyui-datebox" style="width:140px;"
                    data-options="formatter:myformatter, parser:myparser, value:'<?= date('Y-m-d') ?>'">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search"
                    onclick="loadTimesheetData()">Load Data</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit"
                    onclick="editTimesheet()">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove"
                    onclick="deleteTimesheet()">Delete</a>

                <a href="javascript:void(0)" class="easyui-menubutton"
                    data-options="menu:'#menu-export-timesheet', iconCls:'icon-save'">Export Data</a>

                <div id="menu-export-timesheet" style="width:150px;">
                    <div data-options="iconCls:'icon-excel'" onclick="exportTimesheet('excel')">Export to Excel</div>
                    <div data-options="iconCls:'icon-pdf'" onclick="exportTimesheet('pdf')">Export to PDF</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end -->

<!-- star -->
<div id="dialog-timesheet" class="easyui-window" title="Edit Timesheet"
    data-options="modal:true,closed:true,iconCls:'icon-edit',footer:'#dialog-buttons-timesheet'"
    style="width:500px;padding:20px;">

    <form id="form-timesheet" method="post" novalidate>
        <input type="hidden" name="nik">
        <div style="margin-bottom:15px">
            <input class="easyui-datebox" name="tgl_masuk" style="width:100%"
                data-options="label:'Date:',readonly:true,labelWidth:150,formatter:myformatter,parser:myparser">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-textbox" name="nama" style="width:100%"
                data-options="label:'Name:',readonly:true,labelWidth:150">
        </div>

        <div style="margin-bottom:15px">
            <input class="easyui-timespinner" name="time_in" style="width:100%"
                data-options="label:'Entry Time:',labelWidth:150, required:false">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-timespinner" name="break_out" style="width:100%"
                data-options="label:'Break Start:',labelWidth:150, required:false">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-timespinner" name="break_in" style="width:100%"
                data-options="label:'Break End:',labelWidth:150, required:false">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-timespinner" name="time_out" style="width:100%"
                data-options="label:'Exit Time:',labelWidth:150, required:false">
        </div>
        <hr>
        <div style="margin-bottom:15px; margin-top:15px;">
            <input class="easyui-timespinner" name="break_overtime_out" style="width:100%"
                data-options="label:'Overtime Break Start:',labelWidth:150, required:false">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-timespinner" name="break_overtime_in" style="width:100%"
                data-options="label:'Overtime Break End:',labelWidth:150, required:false">
        </div>
        <div style="margin-bottom:15px">
            <input class="easyui-timespinner" name="overtime_out" style="width:100%"
                data-options="label:'Overtime Exit:',labelWidth:150, required:false">
        </div>
    </form>
</div>
<div id="dialog-buttons-timesheet">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="submitTimesheet()"
        style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
        onclick="javascript:$('#dialog-timesheet').window('close')" style="width:90px">Cancel</a>
</div>
<!-- end -->

<script>
var url_timesheet;
var editIndexTimesheet = undefined; // Untuk datagrid utama
var editIndexReview = undefined; // Untuk datagrid review

// --- FUNGSI UNTUK MEMUAT DATA BERDASARKAN TANGGAL ---
function loadTimesheetData() {
    var tanggal = $('#filter-tanggal').datebox('getValue');
    if (tanggal) {
        $('#dgTimesheet').datagrid('load', {
            tanggal: tanggal
        });
    } else {
        $.messager.alert('Peringatan', 'Silakan pilih tanggal terlebih dahulu.', 'warning');
    }
}
//

//
function editTimesheet() {
    var row = $('#dgTimesheet').datagrid('getSelected');
    if (row) {
        $('#dialog-timesheet').window('open').window('setTitle', 'Edit Timesheet for ' + row.nama);
        // Muat data dari baris yang dipilih ke dalam form
        $('#form-timesheet').form('load', row);
        // Siapkan URL untuk submit
        url_timesheet = '<?= site_url('hr/save_single_timesheet') ?>';
    } else {
        $.messager.alert('Peringatan', 'Pilih baris data yang ingin diubah.', 'warning');
    }
}
//

//
function submitTimesheet() {
    // Nonaktifkan validasi pada semua timespinner sebelum submit
    // $('#form-timesheet .easyui-timespinner').timespinner({
    //     required: false
    // });

    $('#form-timesheet').form('submit', {
        url: url_timesheet,
        onSubmit: function() {
            // Kita tidak perlu lagi memanggil .form('validate') di sini,
            // karena tidak ada field yang required.
            $.messager.progress({
                title: 'Mohon Tunggu',
                msg: 'Menyimpan data...'
            });
            return true; // Langsung kirim form
        },
        success: function(result) {
            $.messager.progress('close');
            var res = JSON.parse(result);

            if (res.errorMsg) {
                $.messager.alert('Error', res.errorMsg, 'error');
            } else {
                $('#dialog-timesheet').window('close');
                $('#dgTimesheet').datagrid('reload');
                $.messager.show({
                    title: 'Sukses',
                    msg: res.message
                });
            }
        },
        error: function() {
            $.messager.progress('close');
            $.messager.alert('Error', 'Gagal terhubung ke server.', 'error');
        }
    });
}
//

// --- FUNGSI DELETE BARU ---
function deleteTimesheet() {
    var row = $('#dgTimesheet').datagrid('getSelected');
    if (row) {
        // Cek jika timesheet-nya memang sudah ada (punya ID)
        if (!row.id) {
            $.messager.alert('Info', 'Data timesheet ini masih kosong dan belum bisa dihapus.', 'info');
            return;
        }

        $.messager.confirm('Konfirmasi Hapus', 'Anda yakin ingin menghapus data timesheet untuk: ' + row.nama + '?',
            function(r) {
                if (r) {
                    $.messager.progress({
                        title: 'Mohon Tunggu',
                        msg: 'Menghapus data...'
                    });

                    $.post('<?= site_url('hr/delete_timesheet') ?>', {
                        id: row.id
                    }, function(response) {
                        $.messager.progress('close');
                        if (response.status === 'success') {
                            $('#dgTimesheet').datagrid('reload');
                            $.messager.show({
                                title: 'Sukses',
                                msg: response.message
                            });
                        } else {
                            $.messager.alert('Error', response.message, 'error');
                        }
                    }, 'json').fail(function() {
                        $.messager.progress('close');
                        $.messager.alert('Error', 'Gagal terhubung ke server.', 'error');
                    });
                }
            });
    } else {
        $.messager.alert('Peringatan', 'Pilih baris data yang ingin dihapus.', 'warning');
    }
}
//

//
function exportTimesheet(format) {
    // Ambil tanggal yang sedang aktif di filter
    var tanggal = $('#filter-tanggal').datebox('getValue');

    if (!tanggal) {
        $.messager.alert('Peringatan', 'Silakan pilih tanggal terlebih dahulu.', 'warning');
        return;
    }

    // Buat URL untuk ekspor dengan menyertakan parameter tanggal
    let url = "<?= site_url('hr/export_timesheet') ?>/" + format + "?tanggal=" + encodeURIComponent(tanggal);

    // Buka URL di tab baru untuk memulai download
    window.open(url, '_blank');
}
//


// --- FUNGSI FORMAT TANGGAL ---
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
//

function endEditingReview() {
    if (editIndexReview == undefined) return true;
    if ($('#review-datagrid-timesheet').datagrid('validateRow', editIndexReview)) {
        $('#review-datagrid-timesheet').datagrid('endEdit', editIndexReview);
        editIndexReview = undefined;
        return true;
    } else {
        return false;
    }
}
//


// --- INISIALISASI SAAT HALAMAN SIAP ---
$(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    $('#dgTimesheet').datagrid({
        title: 'Employee Timesheet',
        toolbar: '#toolbarTimesheet',
        pagination: true,
        rownumbers: true,
        singleSelect: true,
        fitColumns: false,
        rownumbers: true,
        singleSelect: true,
        fitColumns: false,
        url: '<?= site_url('hr/get_timesheet_json') ?>',
        method: 'get',
        queryParams: {
            tanggal: $('#filter-tanggal').datebox('getValue')
        },
        onClickRow: function(index) {
            if (editIndexTimesheet != index) {
                if (endEditing()) {
                    $(this).datagrid('selectRow', index).datagrid('beginEdit', index);
                    editIndexTimesheet = index;
                } else {
                    $(this).datagrid('selectRow', editIndexTimesheet);
                }
            }
        }
    });

    // Event handler untuk form import
    $('#form-import-timesheet').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Swal.fire({
            title: 'Processing...',
            text: 'Membaca file Excel...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "<?= site_url('hr/preview_import_timesheet') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                Swal.close();
                console.log('Response data:', response.data);
                if (response.status === 'success') {
                    var tableBody = $('#review-body-timesheet');
                    tableBody.empty();

                    console.log(response.data);

                    response.data.forEach(function(row) {
                        // TAMBAHKAN INPUT UNTUK OVERTIME DI SINI
                        var tableRow = `
                                <tr>
                                    <td><input type="text" class="form-control form-control-sm review-nik" value="${row.nik}" readonly></td>
                                    <td>${row.nama}</td>
                                    <td><input type="date" class="form-control form-control-sm review-tgl" value="${row.tgl_masuk}" readonly></td>
                                    <td><input type="time" class="form-control form-control-sm review-time-in" value="${row.time_in || ''}"></td>
                                    <td><input type="time" class="form-control form-control-sm review-break-out" value="${row.break_out || ''}"></td>
                                    <td><input type="time" class="form-control form-control-sm review-break-in" value="${row.break_in || ''}"></td>
                                    <td><input type="time" class="form-control form-control-sm review-time-out" value="${row.time_out || ''}"></td>
                                    <td><input type="time" class="form-control form-control-sm review-ot-break-out" value="${row.break_overtime_out || ''}"></td>
                                    <td><input type="time" class="form-control form-control-sm review-ot-break-in" value="${row.break_overtime_in || ''}"></td>
                                    <td><input type="time" class="form-control form-control-sm review-ot-out" value="${row.overtime_out || ''}"></td>
                                </tr>`;
                        tableBody.append(tableRow);
                    });

                    $('#upload-container-timesheet').hide();
                    $('#review-container-timesheet').show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: response.message
                    });
                }
            },
            error: function() {
                Swal.fire('Error', 'Gagal memproses file.', 'error');
            }
        });
    });

    // 2. Event handler untuk tombol konfirmasi import
    $('#btn-confirm-import-timesheet').on('click', function() {
        var dataToImport = [];
        $('#review-body-timesheet tr').each(function() {
            let r = $(this);
            // TAMBAHKAN FIELD OVERTIME DI SINI
            dataToImport.push({
                nik: r.find('.review-nik').val(),
                tgl_masuk: r.find('.review-tgl').val(),
                time_in: r.find('.review-time-in').val(),
                break_out: r.find('.review-break-out').val(),
                break_in: r.find('.review-break-in').val(),
                time_out: r.find('.review-time-out').val(),
                break_overtime_out: r.find('.review-ot-break-out').val(),
                break_overtime_in: r.find('.review-ot-break-in').val(),
                overtime_out: r.find('.review-ot-out').val()
            });
        });

        if (dataToImport.length === 0) {
            return Swal.fire('Perhatian', 'Tidak ada data.', 'warning');
        }

        Swal.fire({
            title: 'Importing...',
            text: 'Memperbarui data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "<?= site_url('hr/confirm_import_timesheet') ?>",
            type: "POST",
            data: {
                imported_data: JSON.stringify(dataToImport),
            },
            dataType: 'json',
            success: function(response) {
                Swal.close();
                if (response.status === 'success') {
                    $('#review-container-timesheet').hide();
                    $('#upload-container-timesheet').show();
                    $('#form-import-timesheet')[0].reset();
                    $('#dgTimesheet').datagrid('reload');
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Gagal terhubung ke server.', 'error');
            }
        });
    });
    // Event handler untuk tombol cancel import
    $('#btn-cancel-review-timesheet').on('click', function() {
        $('#review-container-timesheet').hide();
        $('#upload-container-timesheet').show();
        $('#form-import-timesheet')[0].reset();
    });
});
</script>