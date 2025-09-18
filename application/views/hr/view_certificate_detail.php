<div class="card">
    <div class="card-body">
        <table id="dgCertificates" class="easyui-datagrid"
            title="Skill Authorized Certificates For: <?= htmlspecialchars($candidate['nama']) ?>"
            style="width:100%;height:450px" data-options="
                    singleSelect:true,
                    toolbar:'#toolbarCertificates',
                    pagination:true,
                    rownumbers:true,
                    url:'<?= site_url('hr/get_certificates_json/' . $candidate['_id']) ?>',  
                    method:'get'
                ">
            <thead>
                <tr>
                    <th data-options="field:'acquisition',width:250">Acquisition </th>
                    <th data-options="field:'certificate',width:450">Name of The Certificate</th>
                    <th data-options="field:'authority',width:250">Issue Authority Name</th>
                    <th data-options="field:'issue_location',width:450">Issue Location</th>
                    <th data-options="field:'certificate_no',width:250">Certificate No.</th>
                </tr>
            </thead>
        </table>

        <div id="toolbarCertificates" style="padding:8px;" class="d-flex justify-content-between align-items-center">
            <div>
                <input id=searchCertificates" class="easyui-searchbox" prompt="Search Certificate"
                    data-options="searcher:doSearchCertificates" style="width:400px;">
            </div>

            <div>
                <a href="<?= $back_url ?>" class="easyui-linkbutton" data-options="iconCls:'icon-back'">
                    Back
                </a>
            </div>
        </div>


    </div>
</div>

<script>
function doSearchCertificates(value) {
    $('#dgCertificates').datagrid('load', {
        search_term: value
    });
}
// Fungsi format tanggal untuk datebox
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
</script>