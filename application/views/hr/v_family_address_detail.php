<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="dgFamilyDetail" class="easyui-datagrid"
                   title="Family Data for: <?= htmlspecialchars($candidate['nama']) ?>"
                   style="width:100%;height:450px"
                   data-options="
                        singleSelect:true,
                        toolbar:'#toolbarFamilyDetail',
                        pagination:true,
                        rownumbers:true,
                        url:'<?= site_url('hr/get_family_address_json/' . $candidate['_id']) ?>',
                        method:'get'
                   ">
                <thead>
                    <tr>
                        
                        <th data-options="field:'relation', width:550">Description</th>
                        <th data-options="field:'number', width:500, align:'center'">Number</th>
                        <th data-options="field:'cohabit', width:550, align:'center'">Accompany</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarFamilyDetail" style="padding:8px;" class="d-flex justify-content-between align-items-center">
                <div>
                    <input id="searchFamilyDetail" class="easyui-searchbox" 
                           prompt="Search by Name or Relation" 
                           data-options="searcher:doSearchFamilyDetail" 
                           style="width:300px;">
                </div>
                <div>
                    <a href="<?= site_url('hr/listsummary') ?>" class="easyui-linkbutton" data-options="iconCls:'icon-back'">
                        Back to Summary List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function doSearchFamilyDetail(value) {
        $('#dgFamilyDetail').datagrid('load', {
            search_term: value 
        });
    }
</script>