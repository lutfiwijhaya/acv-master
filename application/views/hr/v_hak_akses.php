<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <table id="dgPosisi" class="easyui-datagrid" style="width:100%;height:550px">
                <thead>
                    <tr>
                        <th data-options="field:'_id',hidden:true">ID</th>
                        <th data-options="field:'posisi', width:400">Nama Posisi</th>
                        <th data-options="field:'hak_akses_str', width:400">Hak Akses Status</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarAkses" style="padding:10px;">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newPosisi()">Add</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editPosisi()">Edit</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="aturHakAkses()">Hak Akses</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deletePosisi()">Delete</a>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <input id="searchPosisi" class="easyui-searchbox" data-options="prompt:'Cari Posisi...', searcher:doSearchPosisi" style="width:250px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog-posisi" class="easyui-window" title="Data Posisi" data-options="modal:true,closed:true,iconCls:'icon-save'" style="width:500px;padding:20px;">
    <form id="form-posisi" method="post">
        <input type="hidden" name="posisi_id">
        <div style="margin-bottom:15px">
            <input class="easyui-textbox" name="posisi" style="width:100%" data-options="label:'Nama Posisi:', required:true">
        </div>
        <div class="text-end">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="savePosisi()">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-posisi').window('close')">Batal</a>
        </div>
    </form>
</div>

<div id="dialog-akses" class="easyui-window" title="Atur Hak Akses Status" 
    data-options="modal:true,closed:true,iconCls:'icon-save'" style="width:400px;padding:20px;">
    
    <form id="form-akses" method="post">
        <input type="hidden" name="posisi_id">
        <div style="margin-bottom:10px; font-weight:bold;" id="nama-posisi-label"></div>

        <div style="margin-bottom:10px;">
            <input class="easyui-checkbox" name="can_prepare" label="Bisa mengubah status ke 'Prepared'">
        </div>
        <div style="margin-bottom:10px;">
            <input class="easyui-checkbox" name="can_review" label="Bisa mengubah status ke 'Reviewed'">
        </div>
        <div style="margin-bottom:10px;">
            <input class="easyui-checkbox" name="can_review_2" label="Bisa mengubah status ke 'Reviewed 2'">
        </div>
        <div style="margin-bottom:20px;">
            <input class="easyui-checkbox" name="can_approve" label="Bisa mengubah status ke 'Approved'">
        </div>
        <div class="text-end">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveAkses()">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-akses').window('close')">Batal</a>
        </div>
    </form>
</div>


        
   

<!-- <div id="dialog-akses" class="easyui-window" title="Atur Hak Akses Status" 
    data-options="modal:true,closed:true,iconCls:'icon-save'" style="width:400px;padding:20px;">
    
    <form id="form-akses" method="post">
        <input type="hidden" name="posisi_id">
        <div style="margin-bottom:10px; font-weight:bold;" id="nama-posisi-label"></div>

        <div id="checkbox-container">
</div> -->

<script>
    var url_posisi; 

// --- FUNGSI-FUNGSI UNTUK POSISI (BARU) ---
function doSearchPosisi(value){
    $('#dgPosisi').datagrid('load', { search_data: value });
}

function newPosisi(){
    $('#dialog-posisi').window('open').window('setTitle','Tambah Posisi Baru');
    $('#form-posisi').form('clear');
    url_posisi = '<?= site_url('hr/save_posisi') ?>'; // Arahkan ke controller yang benar
}

function editPosisi(){
    var row = $('#dgPosisi').datagrid('getSelected');
    if (row){
        $('#dialog-posisi').window('open').window('setTitle','Edit Posisi');
        $('#form-posisi').form('load',{
            posisi_id: row._id, // Gunakan _id dari datagrid
            posisi: row.posisi
        });
        url_posisi = '<?= site_url('hr/update_posisi') ?>/' + row._id; // Arahkan ke controller yang benar
    } else {
        $.messager.alert('Peringatan', 'Pilih posisi yang ingin diubah.', 'warning');
    }
}

function savePosisi(){
    $('#form-posisi').form('submit', {
        url: url_posisi,
        onSubmit: function(){ return $(this).form('validate'); },
        success: function(result){
            var res = JSON.parse(result);
            if (res.status === 'success') {
                $('#dialog-posisi').window('close');
                $('#dgPosisi').datagrid('reload');
                $.messager.show({title:'Sukses', msg:res.message});
            } else {
                $.messager.alert('Error', res.message, 'error');
            }
        }
    });
}

function deletePosisi(){
    var row = $('#dgPosisi').datagrid('getSelected');
    if (row){
        $.messager.confirm('Konfirmasi','Anda yakin ingin menghapus posisi: ' + row.posisi + '?', function(r){
            if (r){
                $.post('<?= site_url('hr/delete_posisi') ?>', {id:row._id}, function(res){
                    if (res.status === 'success') {
                        $('#dgPosisi').datagrid('reload');
                    } else {
                        $.messager.alert('Error', res.message, 'error');
                    }
                },'json');
            }
        });
    } else {
         $.messager.alert('Peringatan', 'Pilih posisi yang ingin dihapus.', 'warning');
    }
}
//

//
function aturHakAkses() {
    var row = $('#dgPosisi').datagrid('getSelected');
    if (row) {
        $('#form-akses').form('clear');
        $('#dialog-akses').window('open').window('setTitle', 'Atur Hak Akses untuk ' + row.posisi);
        $('#nama-posisi-label').text('Posisi: ' + row.posisi);
        
        $('#form-akses').form('load', { posisi_id: row._id });

        // Ambil daftar status dan hak akses yang sudah ada
        $.get('<?= site_url('hr/get_akses_by_posisi') ?>/' + row._id, function(data){
            var container = $('#checkbox-container');
            container.empty(); // Kosongkan container
            
            // Buat checkbox secara dinamis
            data.all_status.forEach(function(status){
                var isChecked = data.checked_status.includes(status.id);
                var checkbox = $('<input class="easyui-checkbox">').attr({
                    name: 'akses[]',
                    value: status.id,
                    label: 'Bisa mengakses status: ' + status.name,
                    checked: isChecked
                });
                container.append($('<div style="margin-bottom:10px;"></div>').append(checkbox));
            });
            
            $.parser.parse(container); // Render ulang komponen EasyUI
        }, 'json');

    } else {
        $.messager.alert('Peringatan', 'Pilih salah satu posisi terlebih dahulu.', 'warning');
    }
}

function saveAkses() {
    $('#form-akses').form('submit', {
        url: '<?= site_url('hr/save_hak_akses') ?>',
        onSubmit: function(){
            $.messager.progress({title:'Mohon Tunggu', msg:'Menyimpan data...'});
            return true;
        },
        success: function(result){
            $.messager.progress('close');
            var res = JSON.parse(result);
            if (res.status === 'success') {
                $('#dialog-akses').window('close');
                $('#dgPosisi').datagrid('reload');
                $.messager.show({title:'Sukses', msg:res.message});
            } else {
                $.messager.alert('Error', res.message, 'error');
            }
        }
    });
}

// Inisialisasi Datagrid saat halaman siap
$(function() {
    $('#dgPosisi').datagrid({
        url: '<?= site_url('hr/get_posisi_json_for_akses') ?>',
        toolbar: '#toolbarAkses',
        pagination: true,
        rownumbers: true,
        singleSelect: true,
        fitColumns: true
    });
});
</script>