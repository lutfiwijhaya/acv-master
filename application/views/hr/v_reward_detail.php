<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="dgRewardDetail" class="easyui-datagrid"
                   title="Reward Status for: <?= htmlspecialchars($candidate['nama']) ?>"
                   style="width:100%;height:450px"
                   data-options="
                        singleSelect:true,
                        toolbar:'#toolbarRewardDetail',
                        pagination:true,
                        rownumbers:true,
                        fitColumns:true,
                        url:'<?= site_url('hr/get_reward_json/' . $candidate['_id']) ?>',
                        method:'get'
                   ">
                <thead>
                    <tr>
                        <th data-options="field:'reward_name', width:200">Reward Name</th>
                        <th data-options="field:'reward_date', width:100">Date</th>
                        <th data-options="field:'reward_result', width:200">Result</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarRewardDetail" style="padding:8px;" class="d-flex justify-content-end align-items-center">
                <div>
                    <a href="<?= site_url('hr/listsummary') ?>" class="easyui-linkbutton" data-options="iconCls:'icon-back'">
                        Back to Summary List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>