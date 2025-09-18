<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><?= $title ?></h3>
                <a href="<?= site_url('hr/listsummary') ?>" class="easyui-linkbutton"
                    data-options="iconCls:'icon-back'">
                    Back to Summary List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table id="dgHired" class="easyui-datagrid" title="Initial Hired Status"
                        style="width:100%;height:400px" data-options="
                                singleSelect:true,
                                fitColumns:true,
                                url:'<?= site_url('hr/get_hired_json/' . $candidate['_id']) ?>'
                           ">
                        <thead>
                            <tr>
                                <th data-options="field:'intial', width:150">Description</th>
                                <th data-options="field:'value', width:200">Value</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="col-md-6">
                    <table id="dgSalary" class="easyui-datagrid" title="Salary Details" style="width:100%;height:400px"
                        data-options="
                                singleSelect:true,
                                fitColumns:true,
                                url:'<?= site_url('hr/get_salary_json/' . $candidate['_id']) ?>'
                           ">
                        <thead>
                            <tr>
                                <th data-options="field:'allowances', width:150">Allowances</th>
                                <th
                                    data-options="field:'salary', width:150, align:'right', formatter:formatSalaryDetail">
                                    Salary</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function formatSalaryDetail(value, row, index) {
    if (value && !isNaN(value)) {
        return 'IDR ' + new Intl.NumberFormat('id-ID').format(value);
    }
    return value;
}
</script>