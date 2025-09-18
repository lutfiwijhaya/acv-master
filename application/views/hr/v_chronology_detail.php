<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="dgChronologyDetail" class="easyui-datagrid"
                   title="Chronology Status for: <?= htmlspecialchars($candidate['nama']) ?>"
                   style="width:100%;height:450px"
                   data-options="
                        singleSelect:true,
                        toolbar:'#toolbarChronologyDetail',
                        pagination:true,
                        rownumbers:true,
                        fitColumns:true,
                        url:'<?= site_url('hr/get_chronology_json/' . $candidate['_id']) ?>',
                        method:'get'
                   ">
                <thead>
                    <tr>
                        <th data-options="field:'subject', width:200">Subject</th>
                        <th data-options="field:'employee_date_start', width:120">Start Date</th>
                        <th data-options="field:'employee_date_end', width:120">Finish Date</th>
                        <th data-options="field:'position', width:150">Position</th>
                        <th data-options="field:'work_location', width:200">Work Location / Project</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbarChronologyDetail" style="padding:8px;" class="d-flex justify-content-end align-items-center">
                <div>
                    <a href="<?= site_url('hr/listsummary') ?>" class="easyui-linkbutton" data-options="iconCls:'icon-back'">
                        Back to Summary List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>