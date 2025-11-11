<section class="content-header">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>
            </div>
            <div class="card-body">
            <!-- Upload Form -->
            <form id="importForm" enctype="multipart/form-data" method="post" style="display: flex; justify-content: space-between; align-items: center;">
                <div style="flex: 1;">
                    <input type="file" name="file_excel" id="file_excel" accept=".xls,.xlsx" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Upload & Preview</button>
                    <!-- Download Template Button -->
                    <a href="<?= base_url('uploads/Template_Import_Journal.xlsx'); ?>" download>
                        <button type="button" class="btn btn-success" style="margin-left: 10px;"> <i class="fas fa-file-excel"></i> Download Template</button>
                    </a>
                </div>
            </form>

            <!-- Loading -->
            <div id="loading" style="display:none;text-align:center;margin:15px;">
                <img src="<?= base_url('assets/images/loading.gif') ?>" width="50">
                <p>Processing file, please wait...</p>
            </div>

            <!-- Datagrid -->
            <table id="dgPreview" title="Preview Import"
                class="easyui-datagrid"
                rowNumbers="true"
                singleSelect="true"
                pagination="false"
                style="width:100%;height:400px;display:none;">
                <thead>
                    <tr>
                        <th field="journal_date" width="8%">Date</th>
                        <th field="project_code" width="8%">Project Code</th>
                        <th field="reference" width="8%">Reference</th>
                        <th field="coa_code" width="7%">COA Code</th>
                        <th field="coa_name" width="10%">COA Name</th>
                        <th field="npwp" width="10%">NPWP</th>
                        <th field="supplier" width="10%">Supplier</th>
                        <th field="invoice_number" width="9%">Invoice Number</th>
                        <th field="invoice_date" width="8%">Invoice Date</th>
                        <th field="description" width="12%">Description</th>
                        <th field="debit" width="7%" align="right">Debit</th>
                        <th field="credit" width="7%" align="right">Credit</th>
                        <th field="status" width="6%" align="center">Status</th>
                        <th field="status_journal" width="7%" align="center">Status Journal</th>
                    </tr>
                </thead>
            </table>

            <!-- Save Button -->
            <div id="saveBtn" style="display:none;margin-top:15px;">
                <button onclick="saveImport()" class="btn btn-success">Save Valid Data</button>
            </div>
        </div>
        </div>
    </div>
</section>

<script>
    // Styling invalid row
    function statusStyler(value, row, index) {
        if (value === 'INVALID' || value === 'INVALID_DATE') {
            return 'background-color:#f8d7da;color:#721c24;';
        }
        return '';
    }

    // Format number for debit and credit
    function formatCurrency(value) {
        if (!value || value == 0) return '0';
        return parseFloat(value).toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Upload form
    $("#importForm").on("submit", function(e) {
        e.preventDefault();
        $("#loading").show();
        $("#dgPreview").hide();
        $("#saveBtn").hide();

        var formData = new FormData(this);
        $.ajax({
            url: "<?= base_url('journal/importPreview') ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(result) {
                $("#loading").hide();
                if(result.error) {
                    Toast.fire({ icon: 'error', title: result.error });
                    $("#dgPreview").hide();
                } else if(result.rows) {
                    $("#dgPreview").datagrid({
                        data: result.rows,
                        columns: [[
                            {field:'journal_date', title:'Date', width:'8%'},
                            {field:'project_code', title:'Project Code', width:'8%'},
                            {field:'reference', title:'Reference', width:'8%'},
                            {field:'coa_code', title:'COA Code', width:'7%'},
                            {field:'coa_name', title:'COA Name', width:'10%'},
                            {field:'npwp', title:'NPWP', width:'10%'},
                            {field:'supplier', title:'Supplier', width:'10%'},
                            {field:'invoice_number', title:'Invoice Number', width:'9%'},
                            {field:'invoice_date', title:'Invoice Date', width:'8%'},
                            {field:'description', title:'Description', width:'12%'},
                            {field:'debit', title:'Debit', width:'7%', align:'right', formatter: formatCurrency},
                            {field:'credit', title:'Credit', width:'7%', align:'right', formatter: formatCurrency},
                            {field:'status', title:'Status', width:'6%', align:'center', styler: statusStyler},
                            {field:'status_journal', title:'Status Journal', width:'7%', align:'center'}
                        ]],
                        rowStyler: function(index, row) {
                            if (row.status === 'INVALID' || row.status === 'INVALID_DATE') {
                                return 'background-color:#f8d7da;';
                            }
                        }
                    });
                    $("#dgPreview").show();
                    $("#saveBtn").show();
                } else {
                    Toast.fire({ icon: 'error', title: 'Gagal memproses file' });
                    $("#dgPreview").hide();
                }
            },
            error: function(xhr) {
                $("#loading").hide();
                var errorMsg = 'Error saat upload';
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        errorMsg = response.error;
                    }
                } catch(e) {}
                Toast.fire({ icon: 'error', title: errorMsg });
            }
        });
    });

    // Save only valid data
    function saveImport() {
        var data = $("#dgPreview").datagrid('getData').rows;
        
        // Filter hanya data yang valid
        var validData = data.filter(function(row) {
            return row.status === 'VALID';
        });

        if (validData.length === 0) {
            Toast.fire({ icon: 'warning', title: 'Tidak ada data valid untuk disimpan' });
            return;
        }

        $.ajax({
            url: "<?= base_url('journal/importSave') ?>",
            type: "POST",
            data: {rows: JSON.stringify(validData)},
            dataType: "json",
            success: function(res) {
                if(res.success){
                    Toast.fire({ icon: 'success', title: res.message });
                    $('#dgPreview').datagrid('reload');
                    // Reset form
                    $('#importForm')[0].reset();
                    $('#dgPreview').hide();
                    $('#saveBtn').hide();
                } else {
                    Toast.fire({ icon: 'error', title: res.message });
                }
            },
            error: function() {
                Toast.fire({ icon: 'error', title: 'Error saat menyimpan data' });
            }
        });
    }
</script>

<style>
    /* Styling for status column */
    .datagrid-cell[field="status"] {
        text-align: center;
        font-weight: bold;
    }

    /* Styling for status journal column */
    .datagrid-cell[field="status_journal"] {
        text-align: center;
        color: #000;
        font-weight: bold;
        background-color: transparent;
    }

    /* Make sure the table cells are properly aligned */
    .datagrid-cell {
        padding: 5px 10px;
    }

    /* Invalid row styling */
    .datagrid-row[style*="background-color:#f8d7da"] .datagrid-cell {
        color: #721c24;
    }
</style>