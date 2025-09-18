<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="dgDocumentDetail" class="easyui-datagrid"
                   title="Document List for: <?= htmlspecialchars($candidate['nama']) ?>"
                   style="width:100%;height:450px"
                   data-options="
                        singleSelect:true,
                        toolbar:'#toolbarDocumentDetail',
                        pagination:true,
                        rownumbers:true,
                        url:'<?= site_url('hr/get_document_json/' . $candidate['_id']) ?>',
                        method:'get'
                   ">
                <thead>
                    <tr>
                        <th data-options="field:'document_type', width:800">Document Type</th>
                        <th data-options="field:'file_name', width:800, formatter:formatFileLink">File Name</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarDocumentDetail" style="padding:8px;" class="d-flex justify-content-end align-items-center">
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
    function formatFileLink(value, row, index) {
        if (value) {
            var url = '<?= base_url('uploads/documents/') ?>' + value;
            return '<a href="' + url + '" target="_blank">' + value + '</a>';
        }
        return 'N/A';
    }
</script>