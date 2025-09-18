<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="dgDisciplinaryDetail" class="easyui-datagrid"
                   title="Disciplinary Status for: <?= htmlspecialchars($candidate['nama']) ?>"
                   style="width:100%;height:450px"
                   data-options="
                        singleSelect:true,
                        toolbar:'#toolbarDisciplinaryDetail',
                        pagination:true,
                        rownumbers:true,
                        fitColumns:true,
                        url:'<?= site_url('hr/get_disciplinary_json/' . $candidate['_id']) ?>',
                        method:'get'
                   ">
                <thead>
                    <tr>
                        <th data-options="field:'description', width:250">Description</th>
                        <th data-options="field:'disciplinary_date', width:120">Date</th>
                        <th data-options="field:'disciplinary_period_star', width:120">Period Start</th>
                        <th data-options="field:'disciplinary_period_end', width:120">Period End</th>
                        <th data-options="field:'disciplinary_result', width:200">Result</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarDisciplinaryDetail" style="padding:8px;" class="d-flex justify-content-end align-items-center">
                <div>
                    <a href="<?= site_url('hr/listsummary') ?>" class="easyui-linkbutton" data-options="iconCls:'icon-back'">
                        Back to Summary List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>