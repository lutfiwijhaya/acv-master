<div class="container-fluid mt-4">
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="start-date" class="form-label">Dari Tanggal:</label>
                    <input id="start-date" class="easyui-datebox" style="width:100%;" 
                           data-options="formatter:myformatter, parser:myparser" value="<?= date('Y-m-01'); ?>">
                </div>
                <div class="col-md-3">
                    <label for="end-date" class="form-label">Sampai Tanggal:</label>
                    <input id="end-date" class="easyui-datebox" style="width:100%;"
                           data-options="formatter:myformatter, parser:myparser" value="<?= date('Y-m-t'); ?>">
                </div>
                <div class="col-md-6 text-end">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="loadReportData()">Tampilkan Data</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="toolbarReport" style="padding:5px;">
                
                <input class="easyui-searchbox" data-options="prompt:'Cari NIK atau Nama...', searcher:doSearchReport" style="width:250px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" onclick="exportReport('excel')">Export Excel</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-pdf" onclick="exportReport('pdf')">Export PDF</a>
                <a href="javascript:void(0)" id="btn-promote-status" class="easyui-linkbutton" iconCls="icon-ok" plain="false" 
                data-options="disabled:true" onclick="promoteAbsensiStatus()">Naikkan Status</a>
                <a href="<?= site_url('hr/absensi') ?>" class="easyui-linkbutton" iconCls="icon-back" plain="false">Back</a>
            </div>
            <table id="dgReport" class="easyui-datagrid" style="width:100%;height:450px">
                <thead>
                    <tr>
                        <th data-options="field:'tgl_masuk',width:120,sortable:true">Tanggal</th>
                        <th data-options="field:'nik',width:150">NIK</th>
                        <th data-options="field:'nama',width:200">Nama</th>
                        <th data-options="field:'position',width:150">Posisi</th>
                        <th data-options="field:'team',width:150">Team</th>
                        <th data-options="field:'work_location',width:150">Lokasi Kerja</th>
                        <th data-options="field:'keterangan',width:200">Keterangan</th>
                        <th data-options="field:'kehadiran',width:100">Kehadiran</th>
                        <th data-options="field:'status',width:120,formatter:formatAbsensiStatus">Status</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    // --- FUNGSI FORMAT TANGGAL ---
    function myformatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
        return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    }
    function myparser(s){
        if (!s) return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0],10);
        var m = parseInt(ss[1],10);
        var d = parseInt(ss[2],10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
            return new Date(y,m-1,d);
        } else {
            return new Date();
        }
    }

    // --- FUNGSI AKSI ---
    function loadReportData() {
        $('#dgReport').datagrid('load', {
            start_date: $('#start-date').datebox('getValue'),
            end_date: $('#end-date').datebox('getValue'),
            search_data: $('#toolbarReport .easyui-searchbox').searchbox('getValue'),
            location: '<?= $location_filter ?>' // Filter lokasi yang tetap
        });
    }
    
    function doSearchReport(value) {
        loadReportData();
    }

    function exportReport(format) {
        let url = "<?= site_url('hr/export_absensi') ?>/" + format;
        let params = {
            start_date: $('#start-date').datebox('getValue'),
            end_date: $('#end-date').datebox('getValue'),
            search_data: $('#toolbarReport .easyui-searchbox').searchbox('getValue'),
            location: '<?= $location_filter ?>'
        };
        window.open(url + '?' + $.param(params), '_blank');
    }

    function promoteAbsensiStatus() {
        var row = $('#dgReport').datagrid('getSelected');
        if (row) {
            var currentStatus = row.status;
            var nextStatus = '';

            // Tentukan status berikutnya
            if (currentStatus === 'Nothing') nextStatus = 'Prepared';
            else if (currentStatus === 'Prepared') nextStatus = 'Reviewed';
            else if (currentStatus === 'Reviewed') nextStatus = 'Reviewed 2';
            else if (currentStatus === 'Reviewed 2') nextStatus = 'Approved';
            else {
                $.messager.alert('Info', 'Status sudah final (Approved) dan tidak bisa diubah lagi.', 'info');
                return;
            }

            $.messager.confirm('Konfirmasi', 'Naikkan status untuk "' + row.nama + '" dari "' + currentStatus + '" menjadi "' + nextStatus + '"?', function(r) {
                if (r) {
                    $.post('<?= site_url('hr/promote_absensi_status') ?>', { id: row.id }, function(result) {
                        if (result.status === 'success') {
                            $('#dgReport').datagrid('reload');
                            $.messager.show({ title: 'Sukses', msg: result.message });
                        } else {
                            $.messager.alert('Error', result.message, 'error');
                        }
                    }, 'json');
                }
            });
        }
    }
    //

    //
function formatAbsensiStatus(value, row, index) {
    if (value === 'Prepared') {
        return '<span class="badge bg-warning text-dark">Prepared</span>'; // Kuning
    } else if (value === 'Reviewed') {
        return '<span class="badge bg-info">Reviewed</span>'; // Biru muda
    } else if (value === 'Reviewed 2') {
        return '<span class="badge bg-primary">Reviewed 2</span>'; // Biru tua
    } else if (value === 'Approved') {
        return '<span class="badge bg-success">Approved</span>'; // Hijau
    }
    // Default untuk 'Nothing'
    return '<span class="badge bg-secondary">Nothing</span>'; // Abu-abu
}
    //

    // --- INISIALISASI SAAT HALAMAN SIAP ---
    $(function() {
        $('#dgReport').datagrid({
            title: '<?= $title ?>',
            toolbar: '#toolbarReport',
            url: '<?= site_url('hr/get_report_json') ?>',
            method: 'get',
            pagination: true,
            rownumbers: true,
            singleSelect: true, // Kembali ke singleSelect
            fitColumns: true,
            queryParams: {
                start_date: $('#start-date').datebox('getValue'),
                end_date: $('#end-date').datebox('getValue'),
                location: '<?= $location_filter ?>'
            },
            // Event handler untuk mengaktifkan/menonaktifkan tombol
            onSelect: function(index, row) {
                // Aktifkan tombol hanya jika statusnya bukan 'Approved'
                if (row.status !== 'Approved') {
                    $('#btn-promote-status').linkbutton('enable');
                } else {
                    $('#btn-promote-status').linkbutton('enable');
                }
            },
            onUnselect: function(index, row) {
                $('#btn-promote-status').linkbutton('enable');
            },
            onLoadSuccess: function() {
                $('#btn-promote-status').linkbutton('enable');
            }
        });
    });
</script>