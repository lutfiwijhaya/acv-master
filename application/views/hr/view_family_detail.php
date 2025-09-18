<div class="card">
    <div class="card-body">
        <table id="dgFamily" class="easyui-datagrid" 
               title="Family Data for: <?= htmlspecialchars($candidate['nama']) ?>" 
               style="width:100%;height:450px"
               data-options="
                    singleSelect:true,
                    toolbar:'#toolbarFamily',
                    pagination:true,
                    rownumbers:true,
                    url:'<?= site_url('hr/get_family_json/' . $candidate['_id']) ?>',  
                    method:'get'
                ">
            <thead>
                <tr>
                    <th data-options="field:'name',width:400">Name</th>
                    <th data-options="field:'relation',width:400">Relation</th>
                    <th data-options="field:'birthday',width:400">Birthday</th>
                    <th data-options="field:'cohabit',width:400">Cohabit</th>
                    <th data-options="field:'mobile_no',width:400">Mobile No.</th>
                </tr>
            </thead>
        </table>

       <div id="toolbarFamily" style="padding:8px;" class="d-flex justify-content-between align-items-center">

    <div>
        <input id="searchFamily" class="easyui-searchbox" 
               prompt="Search by Name or Relationship" 
               data-options="searcher:doSearchFamily" 
               style="width:400px;">
    </div>

    <div>
        <a href="<?= site_url('hr/listcandidate') ?>" class="easyui-linkbutton btn-custom-blue" data-options="iconCls:'icon-back'">
          Back
        </a>
    </div>

</div>
</div>

<script>
    // Jika Anda ingin menambahkan fungsi search, Anda bisa letakkan di sini.
    // Contoh:
    function doSearchFamily(value) {
    // Memuat ulang datagrid keluarga dengan parameter baru
    $('#dgFamily').datagrid('load', {
        // 'search_term' adalah nama parameter yang akan dikirim ke controller
        search_term: value 
    });
}
</script>