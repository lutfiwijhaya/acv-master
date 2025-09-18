<div class="card">
    <div class="card-body">
        <table id="dgAcademic" class="easyui-datagrid" title="Academic History for: <?= htmlspecialchars($candidate['nama']) ?>" style="width:100%;height:450px"
                data-options="
                    singleSelect:true,
                    toolbar:'#toolbarAcademic',
                    pagination:true,
                    rownumbers:true,
                    url:'<?= site_url('hr/get_academic_json/' . $candidate['_id']) ?>',  
                    method:'get'
                ">
                
            <thead>
                
                <tr>
                    <th data-options="field:'graduation',width:400">Graduation</th>
                    <th data-options="field:'registered_school_name',width:400">Registered School Name</th>
                    <th data-options="field:'location',width:400">Location</th>
                    <th data-options="field:'jurusan',width:400">Specialty (or) Major</th>
                </tr>
            </thead>
        </table>

        <div id="toolbarAcademic" style="padding:8px;" style="padding:8px;" class="d-flex justify-content-between align-items-center">

        <div class="col-md-6">
            <input id="searchAcademic" class="easyui-searchbox" 
                   prompt="Search by School Name, Major, or Location" 
                   data-options="searcher:doSearchAcademic" 
                   style="width:400px;">
                </div>
                
                <div >
                    <a href="<?= site_url('hr/listcandidate') ?>" class="easyui-linkbutton btn-custom-blue"data-options="iconCls:'icon-back'">Back</a>        
                </div>

</div>
    

<script>
    
    // Contoh:
    function doSearchAcademic(value) {
    // Memuat ulang datagrid dengan parameter baru
    $('#dgAcademic').datagrid('load', {
        // 'search_term' adalah nama parameter yang akan dikirim ke controller
        // 'value' adalah isi dari kotak pencarian
        search_term: value 
    });
}
</script>