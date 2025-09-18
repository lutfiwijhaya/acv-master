<div class="card">
    <div class="card-body">
        <table id="dgCareer" class="easyui-datagrid" 
               title="Career History for: <?= htmlspecialchars($candidate['nama']) ?>" 
               style="width:100%;height:450px"
               data-options="
                    singleSelect:true,
                    toolbar:'#toolbarCareer',
                    pagination:true,
                    rownumbers:true,
                    url:'<?= site_url('hr/get_career_json/' . $candidate['_id']) ?>',  
                    method:'get'
                ">
            <thead>
                <tr>
                    <th data-options="field:'company_name',width:400">Company Name</th>
                    <th data-options="field:'position',width:200">Job Position</th>
                    <th data-options="field:'period_star',width:300">Period Start</th>
                    <th data-options="field:'period_end',width:350">Period End</th>
                    <th data-options="field:'career',width:400">Career (year or month)</th>
                </tr>
            </thead>
        </table>

        
        <div id="toolbarCareer" style="padding:8px;" class="d-flex justify-content-between align-items-center">

    <div>
        <input id="searchCareer" class="easyui-searchbox" 
               prompt="Search by Company or Position" 
               data-options="searcher:doSearchCareer" 
               style="width:400px;">
    </div>

    <div>
        <a href="<?= site_url('hr/listcandidate') ?>" class="easyui-linkbutton btn-custom-blue" data-options="iconCls:'icon-back'">
            Back
        </a>
    </div>

</div>

      
    </div>
</div>

<script>
  

     function doSearchCareer(value) {
        // Memuat ulang datagrid karir dengan parameter baru
        $('#dgCareer').datagrid('load', {
            search_term: value 
        });
    }

    

    // Fungsi untuk format tanggal
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
</script>