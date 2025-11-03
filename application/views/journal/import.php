<div class="col-12">
    <div class="card">
        <div class="card-body">
            <!-- Upload Form -->
            <form id="importForm" enctype="multipart/form-data" method="post">
                <input type="file" name="file_excel" id="file_excel" accept=".xls,.xlsx" required>
                <button type="submit" class="btn btn-primary">Upload & Preview</button>
            </form>

            <!-- Loading -->
            <div id="loading" style="display:none;text-align:center;margin:15px;">
                <img src="<?= base_url('assets/images /loading.gif') ?>" width="50">
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
                        <th field="journal_date" width="15%">Date</th>
                        <th field="coa_code" width="15%">COA Code</th>
                        <th field="coa_name" width="20%">COA Name</th>
                        <th field="description" width="30%">Description</th>
                        <th field="debit" width="10%" align="right">Debit</th>
                        <th field="credit" width="10%" align="right">Credit</th>
                        <th field="status" width="10%" styler="statusStyler">Status</th>
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

<script>
    // Styling invalid row
    function statusStyler(value, row, index) {
        if (value === 'INVALID') {
            return 'background-color:#f8d7da;color:#721c24;';
        }
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
                if(result.rows) {
                    $("#dgPreview").datagrid({
                        data: result.rows
                    });
                    $("#dgPreview").show(); // Tampilkan setelah data di-set
                    $("#saveBtn").show();
                } else {
                    Toast.fire({ icon: 'error', title: 'Gagal memproses file' });
                    $("#dgPreview").hide(); // Tetap sembunyikan jika gagal
                }
            },
            error: function() {
                $("#loading").hide();
                Toast.fire({ icon: 'error', title: 'Error saat upload' });
            }
        });
    });

    // Save only valid data
    function saveImport() {
        var data = $("#dgPreview").datagrid('getData').rows;
        $.ajax({
            url: "<?= base_url('journal/importSave') ?>",
            type: "POST",
            data: {rows: JSON.stringify(data)},
            dataType: "json",
            success: function(res) {
                if(res.success){
                    Toast.fire({ icon: 'success', title: res.message });
                    $('#dgPreview').datagrid('reload');
                } else {
                    Toast.fire({ icon: 'error', title: res.message });
                }
            }
        });
    }
</script>
