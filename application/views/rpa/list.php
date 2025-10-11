<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="easyui-panel" style="position:relative;overflow:auto;">
            <div class="card-body">
                <div class="easyui-layout">
                    <table id="dgRpa" 
                        toolbar="#toolbar"
                        class="easyui-treegrid"
                        rownumbers="true"
                        pagination="true"
                        pageSize="50"
                        pageList="[10,20,50,75,100,125,150,200]"
                        nowrap="true"
                        singleSelect="true"
                        idField="id"
                        treeField="invoice_no"
                        animate="true"
                        showFooter="false">
                        <thead>
                            <tr>
                                <th field="row_number" width="5%" align="center">No</th>
                                <th field="invoice_no" width="12%">Invoice No</th>
                                <th field="charge_code" width="10%">Charge Code</th>
                                <th field="bill_date" width="10%">Bill Date</th>
                                <th field="request_date" width="10%">Request Date</th>
                                <th field="approval_date" width="10%">Approval Date</th>
                                <th field="company_payment_date" width="12%">Company Payment Date</th>
                                <th field="status" width="8%">Status</th>
                                <th field="supplier_name" width="12%">Supplier</th>
                                <th field="coa_code" width="10%">COA Code</th>
                                <th field="coa_name" width="15%">COA Name</th>
                                <th field="currency" width="6%">Currency</th>
                                <th field="request_amount" width="12%" align="right" formatter="formatCurrency">Request Amount</th>
                                <th field="approved_amount" width="12%" align="right" formatter="formatCurrency">Approved Amount</th>
                                <th field="difference_amount" width="12%" align="right" formatter="formatCurrency">Difference</th>
                                <th field="remark_tax_income" width="12%">Remark Tax Income</th>
                                <th field="to_be_paid_internal" width="12%">To Be Paid Internal</th>
                                <th field="actual_expenditure" width="12%">Actual Expenditure</th>
                                <th field="action" width="8%" align="center" formatter="actionFormatter">Action</th>
                            </tr>
                        </thead>
                    </table>


                    <!-- Toolbar -->
                    <div id="toolbar" style="padding: 10px">
                        <div class="row ml-1 d-flex justify-content-between align-items-center">
                            <!-- Left menu -->
                            <div class="col-sm-6 text-menu">
                                <nav class="toolbar-menu">
                                    <a href="javascript:void(0);" onclick="newRpa()">Add</a>
                                    <a href="javascript:void(0);" onclick="editRpa()">Edit</a>
                                    <a href="javascript:void(0);" onclick="destroyRpa()">Delete</a>
                                    <a href="javascript:void(0);" onclick="expandAll()">Expand All</a>
                                    <a href="javascript:void(0);" onclick="collapseAll()">Collapse All</a>
                                </nav>
                            </div>


                            <!-- Right search and view detail -->
                            <div class="col-sm-6 text-right">
                                <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-search" onclick="viewDetail()" style="margin-right:10px;">View Detail</a>
                                <input id="searchRpa" placeholder="Search RPA..." style="width:50%;" />
                                <a href="javascript:void(0);" id="btn_search" onclick="doSearch()">Search</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Form RPA Dialog -->
<div id="dialog-rpa" class="easyui-window" title="Form RPA"
    data-options="modal:true,closed:true,iconCls:'icon-save',inline:false,onResize:function(){$(this).window('hcenter');}"
    style="width:90%;max-width:1000px;padding:20px;max-height:600px;overflow-y:auto;">


    <!-- Header form -->
    <form id="formRpa" class="easyui-form" method="post" data-options="novalidate:false">
        <input type="hidden" name="rpa_id" id="rpa_id">
        <div style="margin-bottom:10px">
            <input class="easyui-textbox" name="invoice_no" id="invoice_no" style="width:48%" data-options="label:'Invoice No:',required:true">
            <input class="easyui-datebox ml-3" name="request_date" id="request_date" style="width:48%" data-options="label:'Request Date:',required:true,formatter:dateFormatter,parser:dateParser">
        </div>
        <div style="margin-bottom:10px">
            <input class="easyui-datebox" name="bill_date" id="bill_date" style="width:48%" data-options="label:'Bill Date:',required:true,formatter:dateFormatter,parser:dateParser">


            <!-- Supplier Combogrid -->
            <input class="easyui-combogrid ml-3" name="supplier_id" id="supplier_id" style="width:48%" 
                data-options="
                    label:'Supplier:',
                    panelWidth:650,
                    panelHeight:350,
                    idField:'supplier_id',
                    textField:'supplier_name',
                    url:'<?= base_url('admin/getSupplierOption') ?>',
                    method:'get',
                    mode:'remote',
                    loadMsg:'Loading...',
                    pagination:false,
                    columns:[[
                        {field:'supplier_id',title:'ID',width:60},
                        {field:'supplier_name',title:'Supplier Name',width:200},
                        {field:'bank_account',title:'Nama Bank',width:120},
                        {field:'rek_bank',title:'Rek Bank',width:150}
                    ]],
                    fitColumns:true,
                    onBeforeLoad:function(param){
                        if(!param.q){
                            return true;
                        }
                    },
                    onShowPanel:function(){
                        var grid = $(this).combogrid('grid');
                        var opts = $(this).combogrid('options');
                        if(grid.datagrid('getRows').length == 0){
                            grid.datagrid('load', {});
                        }
                    }
                ">
        </div>
    </form>
 
    <hr>
    <h4>RPA Details</h4>
    <table id="dgRpaDetail" class="easyui-datagrid" style="width:100%;height:300px" 
        data-options="singleSelect:false,rownumbers:false,fitColumns:true,toolbar:'#toolbarDetail'">
        <thead>
            <tr>
                <th field="ck" checkbox="true"></th>
                <th field="coa_code" width="15%" 
                    editor="{
                        type:'combogrid',
                        options:{
                            required:true,
                            panelWidth:500,
                            panelHeight:350,
                            idField:'code',
                            textField:'code',
                            url:'<?= base_url('coa/getCoaDataOption') ?>',
                            method:'get',
                            mode:'remote',
                            loadMsg:'Loading...',
                            pagination:false,
                            columns:[[
                                {field:'code',title:'COA Code',width:120},
                                {field:'name',title:'COA Name',width:300},
                                {field:'currency',title:'Currency',width:80}
                            ]],
                            fitColumns:true,
                            onBeforeLoad:function(param){
                                if(!param.q){
                                    return true;
                                }
                            },
                            onShowPanel:function(){
                                var grid = $(this).combogrid('grid');
                                if(grid.datagrid('getRows').length == 0){
                                    grid.datagrid('load', {});
                                }
                            }
                        }
                    }">COA Code</th>


                <th field="name" width="20%" editor="{type:'textbox',options:{required:true,readonly:true}}">COA Name</th> 
                <th field="currency" width="8%" editor="{type:'textbox',options:{required:true,readonly:true}}">Currency</th>
                <th field="debit" width="15%" align="right" editor="{type:'numberbox',options:{precision:2}}">Debit</th>
                <th field="credit" width="15%" align="right" editor="{type:'numberbox',options:{precision:2}}">Credit</th>
                <th field="remark" width="27%" editor="{type:'textbox'}">Remark</th>
            </tr>
        </thead>
    </table>


    <div id="toolbarDetail"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addDetailRow()">Add Row</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeDetailRow()">Delete Row</a>
    </div>


    <div style="margin-top:20px;text-align:right">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveRpa()">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-rpa').window('close')">Batal</a>
    </div>
</div>


<!-- View Detail Dialog with Approve/Reject -->
<div id="dialog-view-detail" class="easyui-dialog" title="RPA Detail"
    data-options="modal:true,closed:true,iconCls:'icon-info',inline:false,buttons:'#detail-buttons'"
    style="width:95%;max-width:1200px;padding:20px;max-height:700px;">
    
    <div style="margin-bottom:20px;">
        <h3 style="margin-bottom:15px;border-bottom:2px solid #ddd;padding-bottom:10px;">Header Information</h3>
        <table class="detail-info-table" style="width:100%;border-collapse:collapse;">
            <tr>
                <td class="label-col"><strong>Invoice No:</strong></td>
                <td class="value-col" id="detail_invoice_no"></td>
                <td class="label-col"><strong>Status:</strong></td>
                <td class="value-col"><span id="detail_status" class="status-badge"></span></td>
            </tr>
            <tr>
                <td class="label-col"><strong>Supplier:</strong></td>
                <td class="value-col" id="detail_supplier_name"></td>
                <td class="label-col"><strong>Charge Code:</strong></td>
                <td class="value-col" id="detail_charge_code"></td>
            </tr>
            <tr>
                <td class="label-col"><strong>Bill Date:</strong></td>
                <td class="value-col" id="detail_bill_date"></td>
                <td class="label-col"><strong>Request Date:</strong></td>
                <td class="value-col" id="detail_request_date"></td>
            </tr>
            <tr>
                <td class="label-col"><strong>Approval Date:</strong></td>
                <td class="value-col" id="detail_approval_date"></td>
                <td class="label-col"><strong>Payment Date:</strong></td>
                <td class="value-col" id="detail_payment_date"></td>
            </tr>
        </table>
    </div>


    <div style="margin-bottom:20px;">
        <h3 style="margin-bottom:15px;border-bottom:2px solid #ddd;padding-bottom:10px;">Detail Items</h3>
        <table id="dgViewDetail" class="easyui-datagrid" style="width:100%;height:300px"
            data-options="singleSelect:true,fitColumns:true,rownumbers:true,showFooter:true">
            <thead>
                <tr>
                    <th field="coa_code" width="15%">COA Code</th>
                    <th field="coa_name" width="25%">COA Name</th>
                    <th field="currency" width="8%">Currency</th>
                    <th field="debit_amount" width="13%" align="right" formatter="formatCurrency">Debit</th>
                    <th field="credit_amount" width="13%" align="right" formatter="formatCurrency">Credit</th>
                    <th field="difference_amount" width="13%" align="right" formatter="formatCurrency">Difference</th>
                    <th field="remark" width="13%">Remark</th>
                </tr>
            </thead>
        </table>
    </div>


    <div style="margin-bottom:20px;">
        <h3 style="margin-bottom:15px;border-bottom:2px solid #ddd;padding-bottom:10px;">Summary</h3>
        <table class="detail-info-table" style="width:100%;">
            <tr>
                <td class="label-col"><strong>Total Debit:</strong></td>
                <td class="value-col" id="detail_total_debit" style="color:#27ae60;font-weight:bold;"></td>
                <td class="label-col"><strong>Total Credit:</strong></td>
                <td class="value-col" id="detail_total_credit" style="color:#e74c3c;font-weight:bold;"></td>
            </tr>
            <tr>
                <td class="label-col"><strong>Total Difference:</strong></td>
                <td class="value-col" id="detail_total_difference" style="color:#3498db;font-weight:bold;"></td>
                <td class="label-col"><strong>Balance Check:</strong></td>
                <td class="value-col"><span id="detail_balance_check" style="font-weight:bold;"></span></td>
            </tr>
        </table>
    </div>


    <div style="margin-bottom:15px;">
        <label for="approval_remarks"><strong>Approval Remarks:</strong></label>
        <textarea id="approval_remarks" style="width:100%;height:80px;padding:8px;border:1px solid #ddd;border-radius:4px;" 
            placeholder="Enter remarks for approval or rejection..."></textarea>
    </div>
</div>


<div id="detail-buttons" style="text-align:right;padding:10px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="approveRpa()" style="width:100px;background:#27ae60;color:white;">Approve</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="rejectRpa()" style="width:100px;background:#e74c3c;color:white;margin-left:10px;">Reject</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-back" onclick="$('#dialog-view-detail').dialog('close')" style="width:100px;margin-left:10px;">Close</a>
</div>


<!-- NEW: Rejection Reason Dialog -->
<div id="dialog-reject-reason" class="easyui-dialog" title="Rejection Reason"
    data-options="modal:true,closed:true,iconCls:'icon-cancel',buttons:'#reject-buttons'"
    style="width:550px;padding:20px;">
    <div style="margin-bottom:15px;">
        <p style="margin-bottom:10px;color:#e74c3c;font-weight:bold;font-size:14px;">
            <i class="fa fa-exclamation-triangle"></i> 
            You are about to reject RPA: <span id="reject-invoice-no" style="color:#333;"></span>
        </p>
        <p style="margin-bottom:15px;font-size:13px;color:#666;">
            Please provide a detailed reason for rejection. This field is mandatory and requires at least 10 characters.
        </p>
    </div>
    
    <div style="margin-bottom:10px;">
        <label for="reject-reason-input" style="display:block;margin-bottom:5px;font-weight:bold;color:#333;">
            Rejection Reason: <span style="color:#e74c3c;">*</span>
        </label>
        <textarea id="reject-reason-input" 
            style="width:100%;height:120px;padding:10px;border:1px solid #ddd;border-radius:4px;font-size:13px;font-family:Arial, sans-serif;resize:vertical;" 
            placeholder="Enter detailed reason for rejection (minimum 10 characters)..."></textarea>
        <div id="reject-char-count" style="text-align:right;font-size:11px;color:#999;margin-top:3px;">
            0 / 10 characters (minimum)
        </div>
    </div>
    
    <p id="reject-reason-error" style="color:#e74c3c;margin-top:5px;font-size:12px;display:none;padding:8px;background:#ffe6e6;border-radius:4px;">
        <i class="fa fa-times-circle"></i> <span id="reject-error-text">Rejection reason is required (minimum 10 characters)</span>
    </p>
</div>

<div id="reject-buttons" style="text-align:right;padding:10px;background:#f9f9f9;border-top:1px solid #ddd;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" 
        onclick="submitRejection()" 
        style="width:120px;">Submit Rejection</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" 
        onclick="$('#dialog-reject-reason').dialog('close')" 
        style="width:100px;margin-left:10px;">Cancel</a>
</div>


<style>
    /* Text menu style */
    .text-menu a,
    #btn_search {
        margin-right: 15px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
    } 


    .text-menu a:hover,
    #btn_search:hover {
        color: #007bff;
        text-decoration: underline;
    }


    /* Detail info table styles */
    .detail-info-table {
        border-collapse: collapse;
    }


    .detail-info-table td {
        padding: 8px 12px;
        border-bottom: 1px solid #f0f0f0;
    }


    .detail-info-table .label-col {
        width: 18%;
        color: #666;
        font-size: 14px;
    }


    .detail-info-table .value-col {
        width: 32%;
        color: #333;
        font-size: 14px;
        font-weight: 500;
    }


    .status-badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }


    .status-badge.pending {
        background-color: #ffeaa7;
        color: #d63031;
    }


    .status-badge.approved {
        background-color: #55efc4;
        color: #00b894;
    }


    .status-badge.rejected {
        background-color: #fab1a0;
        color: #d63031;
    }


    /* Print button style */
    .btn-print {
        display: inline-block;
        padding: 4px 10px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        font-size: 11px;
        font-weight: 600;
        transition: background-color 0.3s;
    }


    .btn-print:hover {
        background-color: #2980b9;
        color: white;
        text-decoration: none;
    }


    .btn-print i {
        margin-right: 3px;
    }

    /* NEW: Rejection Dialog Styling */
    #dialog-reject-reason .dialog-content {
        padding: 20px;
    }

    #reject-reason-input {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.5;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    #reject-reason-input:focus {
        border-color: #e74c3c;
        outline: none;
        box-shadow: 0 0 5px rgba(231, 76, 60, 0.3);
    }

    #reject-reason-error {
        animation: shake 0.3s;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* Character counter styling */
    #reject-char-count {
        transition: color 0.3s;
    }

    #reject-char-count.valid {
        color: #27ae60;
        font-weight: bold;
    }
</style>


<script>
// Date formatter untuk datebox
function dateFormatter(date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    return y + '-' + (m < 10 ? '0' + m : m) + '-' + (d < 10 ? '0' + d : d);
}


function dateParser(s) {
    if (!s) return new Date();
    var ss = s.split('-');
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
    } else {
        return new Date();
    }
}


// Action column formatter - tampilkan Print button hanya jika status approved
function actionFormatter(value, row, index) {
    // Hanya tampilkan tombol Print untuk parent row (yang memiliki rpa_id) dan status approved
    if (row.rpa_id && row.status && row.status.toLowerCase() === 'approved') {
        return '<a href="javascript:void(0)" class="btn-print" onclick="printRpa(' + row.rpa_id + ')"><i class="fa fa-print"></i>Print</a>';
    }
    return ''; // Tidak tampilkan apapun jika bukan parent atau status bukan approved
}


// Function untuk print RPA
function printRpa(rpaId) {
    if (!rpaId) {
        $.messager.alert('Warning', 'Invalid RPA ID', 'warning');
        return;
    }
    
    // Buka PDF di tab baru
    var printUrl = "<?= base_url('pdf/generate_rpa/') ?>" + rpaId;
    window.open(printUrl, '_blank');
}


// Function untuk download RPA (alternative)
function downloadRpa(rpaId) {
    if (!rpaId) {
        $.messager.alert('Warning', 'Invalid RPA ID', 'warning');
        return;
    }
    
    // Download PDF
    var downloadUrl = "<?= base_url('pdf/download_rpa/') ?>" + rpaId;
    window.location.href = downloadUrl;
}


// TreeGrid initialization dengan custom loader dan custom row numbering
$('#dgRpa').treegrid({
    method: 'get',
    animate: true,
    rownumbers: false, // Matikan default rownumbers
    loader: function(param, success, error) {
        $.ajax({
            url: "<?= base_url('rpa/getRpaData') ?>",
            type: "GET",
            data: {
                page: param.page,
                rows: param.rows,
                search_data: $('#searchRpa').val()
            },
            dataType: "json",
            success: function(data) {
                var transformedData = [];
                var parentCounter = 0;


                // Fungsi rekursif untuk memproses children dengan penomoran hierarki
                function processChildren(children, parentId, parentNumber) {
                    children.forEach(function(child, index) {
                        var childId = 'child_' + child.child_id;
                        var childNumber = parentNumber + '.' + (index + 1);


                        var childRow = {
                            id: childId,
                            row_number: childNumber,
                            invoice_no: 'Detail - ' + child.coa_code,
                            charge_code: '',
                            bill_date: '',
                            request_date: '',
                            approval_date: '',
                            company_payment_date: '',
                            status: '',
                            supplier_name: '',
                            coa_code: child.coa_code || '',
                            coa_name: child.coa_name || '',
                            currency: child.currency || '',
                            request_amount: parseFloat(child.debit_amount) || 0,
                            approved_amount: parseFloat(child.credit_amount) || 0,
                            difference_amount: parseFloat(child.difference_amount) || 0,
                            remark_tax_income: child.remark_tax_income || '',
                            to_be_paid_internal: child.to_be_paid_internal || '',
                            actual_expenditure: child.actual_expenditure || '',
                            _parentId: parentId,
                            child_id: child.child_id,
                            action: '' // Child row tidak punya action
                        };
                        transformedData.push(childRow);


                        // Jika ada sub-children (nested)
                        if(child.children && child.children.length > 0) {
                            processChildren(child.children, childId, childNumber);
                        }
                    });
                }


                if(data.rows) {
                    data.rows.forEach(function(parent) {
                        parentCounter++;
                        var parentId = 'parent_' + parent.rpa_id;
                        var parentNumber = parentCounter.toString();
                        
                        // Hitung total dari children
                        var totalDebit = 0;
                        var totalCredit = 0;
                        var totalDifference = 0;
                        
                        if(parent.children && parent.children.length > 0) {
                            parent.children.forEach(function(child) {
                                totalDebit += parseFloat(child.debit_amount) || 0;
                                totalCredit += parseFloat(child.credit_amount) || 0;
                                totalDifference += parseFloat(child.difference_amount) || 0;
                            });
                        }


                        var parentRow = {
                            id: parentId,
                            row_number: parentNumber,
                            invoice_no: parent.invoice_no,
                            charge_code: parent.charge_code || '',
                            bill_date: parent.bill_date || '',
                            request_date: parent.request_date || '',
                            approval_date: parent.approval_date || '',
                            company_payment_date: parent.company_payment_date || '',
                            status: parent.status || '',
                            supplier_name: parent.supplier_name || '',
                            coa_code: '',
                            coa_name: 'Total: ' + (parent.children ? parent.children.length : 0) + ' entries',
                            currency: '',
                            request_amount: totalDebit,
                            approved_amount: totalCredit,
                            difference_amount: totalDifference,
                            remark_tax_income: '',
                            to_be_paid_internal: '',
                            actual_expenditure: '',
                            state: 'closed',
                            _parentId: null,
                            rpa_id: parent.rpa_id,
                            action: '' // Will be formatted by actionFormatter
                        };
                        transformedData.push(parentRow);


                        // Proses children secara rekursif
                        if(parent.children && parent.children.length > 0) {
                            processChildren(parent.children, parentId, parentNumber);
                        }
                    });
                }


                success({
                    total: data.total,
                    rows: transformedData
                });
            },
            error: function() {
                error.apply(this, arguments);
            }
        });
    }
});


// Enter key untuk search
$('#searchRpa').keypress(function(e) {
    if (e.which == 13) {
        doSearch();
    }
});


function doSearch() {
    $('#dgRpa').treegrid('load', {
        page: 1,
        rows: $('#dgRpa').treegrid('options').pageSize
    });
}


function expandAll() {
    $('#dgRpa').treegrid('expandAll');
}


function collapseAll() {
    $('#dgRpa').treegrid('collapseAll');
}


function formatCurrency(value) {
    if (value == null || value === '') return '';
    return 'Rp ' + parseFloat(value).toLocaleString('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}


function getEditingIndex(){
    var dg = $('#dgRpaDetail');
    var rows = dg.datagrid('getRows');
    for (var i = 0; i < rows.length; i++){
        var editors = dg.datagrid('getEditors', i);
        if(editors.length){ 
            return i; 
        }
    }
    return undefined;
}


function newRpa() {
    $('#dialog-rpa').window('open').window('setTitle', 'Create RPA');
    $('#formRpa').form('clear');
    $('#rpa_id').val('');
    $('#dgRpaDetail').datagrid('loadData', []);
}


function editRpa() {
    var row = $('#dgRpa').treegrid('getSelected');
    if (row && row.rpa_id) {
        $('#dialog-rpa').window('open').window('setTitle', 'Edit RPA');
        $('#formRpa').form('load', row);
        $('#rpa_id').val(row.rpa_id);


        // Load detail data
        $.get("<?= base_url('rpa/getRpaDetail/') ?>" + row.rpa_id, function(data) {
            $('#dgRpaDetail').datagrid('loadData', data);
        }, 'json').fail(function() {
            $.messager.alert('Error', 'Failed to load RPA details', 'error');
        });
    } else {
        $.messager.alert('Warning', 'Please select a parent record to edit', 'warning');
    }
}


function destroyRpa() {
    var row = $('#dgRpa').treegrid('getSelected');
    if (row && row.rpa_id) {
        $.messager.confirm('Confirm', 'Are you sure want to delete RPA: ' + row.invoice_no + '?', function(r) {
            if (r) {
                $.post("<?= base_url('rpa/delete') ?>/" + row.rpa_id, function(result) {
                    if (result.success) {
                        $.messager.show({
                            title: 'Success',
                            msg: result.message || 'Data berhasil dihapus'
                        });
                        $('#dgRpa').treegrid('reload');
                    } else {
                        $.messager.alert('Error', result.message || 'Failed to delete data', 'error');
                    }
                }, 'json').fail(function() {
                    $.messager.alert('Error', 'Failed to delete data', 'error');
                });
            }
        });
    } else {
        $.messager.alert('Warning', 'Please select a parent record to delete', 'warning');
    }
}


// View Detail Function with all information
function viewDetail() {
    var row = $('#dgRpa').treegrid('getSelected');
    if (row && row.rpa_id) {
        // Populate header information
        $('#detail_invoice_no').text(row.invoice_no || '-');
        $('#detail_supplier_name').text(row.supplier_name || '-');
        $('#detail_charge_code').text(row.charge_code || '-');
        $('#detail_bill_date').text(row.bill_date || '-');
        $('#detail_request_date').text(row.request_date || '-');
        $('#detail_approval_date').text(row.approval_date || '-');
        $('#detail_payment_date').text(row.company_payment_date || '-');
        
        // Set status with badge
        var statusText = row.status || 'Pending';
        var statusClass = 'pending';
        if(statusText.toLowerCase() === 'approved') {
            statusClass = 'approved';
        } else if(statusText.toLowerCase() === 'rejected') {
            statusClass = 'rejected';
        }
        $('#detail_status').text(statusText).removeClass().addClass('status-badge ' + statusClass);
        
        // Clear remarks
        $('#approval_remarks').val('');


        // Load detail items with footer totals
        $.get("<?= base_url('rpa/getRpaDetail/') ?>" + row.rpa_id, function(data) {
            var totalDebit = 0;
            var totalCredit = 0;
            var totalDifference = 0;


            // Calculate totals
            data.forEach(function(item) {
                totalDebit += parseFloat(item.debit_amount) || 0;
                totalCredit += parseFloat(item.credit_amount) || 0;
                totalDifference += parseFloat(item.difference_amount) || 0;
            });


            // Add footer row for totals
            var footerData = [{
                coa_code: '<strong>TOTAL</strong>',
                coa_name: '',
                currency: '',
                debit_amount: totalDebit,
                credit_amount: totalCredit,
                difference_amount: totalDifference,
                remark: ''
            }];


            $('#dgViewDetail').datagrid('loadData', {
                total: data.length,
                rows: data,
                footer: footerData
            });


            // Update summary section
            $('#detail_total_debit').text(formatCurrency(totalDebit));
            $('#detail_total_credit').text(formatCurrency(totalCredit));
            $('#detail_total_difference').text(formatCurrency(totalDifference));
            
            // Balance check
            var balance = totalDebit - totalCredit;
            if(Math.abs(balance) < 0.01) {
                $('#detail_balance_check').text('✓ Balanced').css('color', '#27ae60');
            } else {
                $('#detail_balance_check').text('✗ Unbalanced (Diff: ' + formatCurrency(balance) + ')').css('color', '#e74c3c');
            }


            // Open dialog
            $('#dialog-view-detail').dialog('open');
            
        }, 'json').fail(function() {
            $.messager.alert('Error', 'Failed to load RPA details', 'error');
        });
    } else {
        $.messager.alert('Warning', 'Please select a parent record to view details', 'warning');
    }
}


// Approve RPA Function
function approveRpa() {
    var row = $('#dgRpa').treegrid('getSelected');
    var remarks = $('#approval_remarks').val();
    
    if (!row || !row.rpa_id) {
        $.messager.alert('Warning', 'No RPA selected', 'warning');
        return;
    }


    $.messager.confirm('Confirm', 'Are you sure you want to approve this RPA: ' + row.invoice_no + '?', function(r) {
        if (r) {
            $.messager.progress({
                title: 'Please wait',
                msg: 'Approving RPA...'
            });
            
            $.ajax({
                url: "<?= base_url('rpa/approve') ?>",
                type: 'POST',
                data: {
                    rpa_id: row.rpa_id,
                    note: remarks
                },
                dataType: 'json',
                success: function(result) {
                    $.messager.progress('close');
                    
                    if (result.success) {
                        $.messager.show({
                            title: 'Success',
                            msg: result.message || 'RPA approved successfully',
                            timeout: 3000,
                            showType: 'slide'
                        });
                        $('#dialog-view-detail').dialog('close');
                        $('#dgRpa').treegrid('reload');
                    } else {
                        $.messager.alert('Error', result.message || 'Failed to approve RPA', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    $.messager.progress('close');
                    $.messager.alert('Error', 'Failed to approve RPA: ' + error, 'error');
                }
            });
        }
    });
}


// NEW: Reject RPA Function with Mandatory Reason Popup
function rejectRpa() {
    var row = $('#dgRpa').treegrid('getSelected');
    
    if (!row || !row.rpa_id) {
        $.messager.alert('Warning', 'No RPA selected', 'warning');
        return;
    }
    
    // Set invoice number in rejection dialog
    $('#reject-invoice-no').text(row.invoice_no);
    
    // Clear previous input and error
    $('#reject-reason-input').val('');
    $('#reject-reason-error').hide();
    $('#reject-char-count').text('0 / 10 characters (minimum)').removeClass('valid');
    
    // Store current row data for submission
    $('#dialog-reject-reason').data('currentRow', row);
    
    // Close view detail dialog
    $('#dialog-view-detail').dialog('close');
    
    // Open rejection reason dialog
    $('#dialog-reject-reason').dialog('open');
    
    // Focus on textarea
    setTimeout(function() {
        $('#reject-reason-input').focus();
    }, 300);
}


// NEW: Character counter for rejection textarea
$(document).on('input', '#reject-reason-input', function() {
    var length = $(this).val().length;
    var counter = $('#reject-char-count');
    
    counter.text(length + ' / 10 characters (minimum)');
    
    if (length >= 10) {
        counter.addClass('valid');
        $('#reject-reason-error').hide();
    } else {
        counter.removeClass('valid');
    }
});


// NEW: Submit Rejection Function
function submitRejection() {
    var reason = $('#reject-reason-input').val().trim();
    var row = $('#dialog-reject-reason').data('currentRow');
    
    // Validate reason (minimum 10 characters)
    if (!reason || reason.length < 10) {
        $('#reject-error-text').text('Rejection reason must be at least 10 characters long (current: ' + reason.length + ')');
        $('#reject-reason-error').show();
        $('#reject-reason-input').focus();
        return;
    }
    
    // Hide error if validation passes
    $('#reject-reason-error').hide();
    
    // Close rejection dialog
    $('#dialog-reject-reason').dialog('close');
    
    // Confirm rejection with preview of reason
    var reasonPreview = reason.length > 100 ? reason.substring(0, 100) + '...' : reason;
    
    $.messager.confirm('Confirm Rejection', 
        '<div style="max-width:400px;">' +
        '<p>Are you sure you want to reject RPA: <strong>' + row.invoice_no + '</strong>?</p>' +
        '<div style="margin-top:10px;padding:10px;background:#f9f9f9;border-left:3px solid #e74c3c;border-radius:3px;">' +
        '<strong>Reason:</strong><br>' + reasonPreview +
        '</div></div>',
        function(r) {
            if (r) {
                // Show loading
                $.messager.progress({
                    title: 'Please wait',
                    msg: 'Rejecting RPA...'
                });
                
                $.ajax({
                    url: "<?= base_url('rpa/reject') ?>",
                    type: 'POST',
                    data: {
                        rpa_id: row.rpa_id,
                        note: reason
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.messager.progress('close');
                        
                        if (result.success) {
                            $.messager.show({
                                title: 'Success',
                                msg: result.message || 'RPA rejected successfully',
                                timeout: 3000,
                                showType: 'slide'
                            });
                            $('#dgRpa').treegrid('reload');
                        } else {
                            $.messager.alert('Error', result.message || 'Failed to reject RPA', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        $.messager.progress('close');
                        $.messager.alert('Error', 'Failed to reject RPA: ' + error, 'error');
                    }
                });
            } else {
                // If user cancels confirmation, reopen rejection dialog
                $('#dialog-reject-reason').dialog('open');
            }
        }
    );
}


function addDetailRow() {
    // End editing pada row sebelumnya
    var editingIndex = getEditingIndex();
    if (editingIndex !== undefined) {
        if (!$('#dgRpaDetail').datagrid('endEdit', editingIndex)) {
            return;
        }
    }
    
    // Append row baru
    $('#dgRpaDetail').datagrid('appendRow', {
        coa_code: '',
        name: '',
        currency: 'IDR',
        debit: 0,
        credit: 0,
        remark: ''
    });
    
    var newIndex = $('#dgRpaDetail').datagrid('getRows').length - 1;
    $('#dgRpaDetail').datagrid('beginEdit', newIndex);
    
    // Setup event handler untuk combogrid di row ini
    setTimeout(function(){
        var ed = $('#dgRpaDetail').datagrid('getEditor', {index: newIndex, field: 'coa_code'});
        if (ed) {
            var target = $(ed.target);
            
            // Bind event onSelect untuk row ini
            target.combogrid('grid').datagrid({
                onClickRow: function(rowIndex, rowData) {
                    target.combogrid('setValue', rowData.code);
                    target.combogrid('setText', rowData.code);
                    
                    var edName = $('#dgRpaDetail').datagrid('getEditor', {index: newIndex, field:'name'});
                    var edCurrency = $('#dgRpaDetail').datagrid('getEditor', {index: newIndex, field:'currency'});
                    
                    if(edName){ 
                        $(edName.target).textbox('setValue', rowData.name); 
                    }
                    if(edCurrency){ 
                        $(edCurrency.target).textbox('setValue', rowData.currency); 
                    }
                    
                    target.combogrid('hidePanel');
                }
            });
            
            target.combogrid('textbox').focus();
        }
    }, 100);
}


function removeDetailRow() {
    var row = $('#dgRpaDetail').datagrid('getSelected');
    if (row) {
        var index = $('#dgRpaDetail').datagrid('getRowIndex', row);
        $('#dgRpaDetail').datagrid('deleteRow', index);
    } else {
        $.messager.alert('Warning', 'Pilih detail yang mau dihapus', 'warning');
    }
}


function saveRpa() {
    // Validate form
    var isValid = $('#formRpa').form('validate');
    if (!isValid) {
        $.messager.alert('Warning', 'Mohon lengkapi semua field yang wajib diisi', 'warning');
        return false;
    }


    // End all editing rows
    var rows = $('#dgRpaDetail').datagrid('getRows');
    for (var i = 0; i < rows.length; i++) {
        $('#dgRpaDetail').datagrid('endEdit', i);
    }


    // Get detail data
    var detailData = $('#dgRpaDetail').datagrid('getRows');
    
    // Validate detail
    if (detailData.length === 0) {
        $.messager.alert('Warning', 'Minimal harus ada 1 detail RPA', 'warning');
        return false;
    }


    // Validate each detail row
    for (var i = 0; i < detailData.length; i++) {
        if (!detailData[i].coa_code || !detailData[i].name) {
            $.messager.alert('Warning', 'Detail baris ke-' + (i + 1) + ' - COA Code belum dipilih', 'warning');
            return false;
        }
        
        var debit = parseFloat(detailData[i].debit) || 0;
        var credit = parseFloat(detailData[i].credit) || 0;
        
        if (debit === 0 && credit === 0) {
            $.messager.alert('Warning', 'Detail baris ke-' + (i + 1) + ' - Debit atau Credit harus diisi', 'warning');
            return false;
        }
        
        if (debit > 0 && credit > 0) {
            $.messager.alert('Warning', 'Detail baris ke-' + (i + 1) + ' - Debit dan Credit tidak boleh diisi bersamaan', 'warning');
            return false;
        }
    }


    // Serialize form data
    var formData = $('#formRpa').serialize();
    formData += '&details=' + encodeURIComponent(JSON.stringify(detailData));


    // Submit data
    $.ajax({
        url: "<?= base_url('rpa/save') ?>",
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(result) {
            if (result.success) {
                $.messager.show({
                    title: 'Success',
                    msg: result.message || 'Data berhasil disimpan'
                });
                $('#dialog-rpa').window('close');
                $('#dgRpa').treegrid('reload');
            } else {
                $.messager.alert('Error', result.message || 'Gagal menyimpan data', 'error');
            }
        },
        error: function() {
            $.messager.alert('Error', 'Terjadi kesalahan saat menyimpan data', 'error');
        }
    });
}
</script>
