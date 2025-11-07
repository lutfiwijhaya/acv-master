<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <!-- Filter Section: Date Range & COA -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="start_date">Start Date:</label>
                    <input type="text" id="start_date" class="easyui-datebox" style="width:100%" data-options="required:true">
                </div>
                <div class="col-sm-4">
                    <label for="end_date">End Date:</label>
                    <input type="text" id="end_date" class="easyui-datebox" style="width:100%" data-options="required:true">
                </div>
                <div class="col-sm-4">
                    <label for="coa_filter">COA:</label>
                    <select id="coa_filter" class="easyui-combobox" style="width:100%" data-options="required:false">
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 text-center">
                    <a href="javascript:void(0);" id="filter_btn" class="easyui-linkbutton" iconCls="icon-search" onclick="doFilter()">Filter</a>
                </div>
            </div>

            <!-- Table for General Ledger -->
            <table id="dgJournal" class="easyui-datagrid" style="width:100%;"
                pagination="true"
                pageSize="10"
                pageList="[10,20,50,75,100,125,150,200]"
                nowrap="true"
                singleSelect="true"
                idField="id"
                showFooter="true">
                <thead>
                    <tr>
                        <th field="journal_date" width="12%">Date</th>
                        <th field="coa_code" width="12%">COA Code</th>
                        <th field="description" width="30%">Description</th>
                        <th field="reference" width="12%">Reference</th>
                        <th field="total_debit" width="12%" align="right" formatter="formatCurrency">Debit</th>
                        <th field="total_credit" width="12%" align="right" formatter="formatCurrency">Credit</th>
                        <th field="saldo" width="12%" align="right" formatter="formatCurrency">Saldo</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Function to filter the General Ledger (Buku Besar) based on date range and optional COA selection
    function doFilter() {
        var start_date = $('#start_date').datebox('getValue');
        var end_date = $('#end_date').datebox('getValue');
        var coa_id = $('#coa_filter').combobox('getValue'); // Optional COA

        if (!start_date || !end_date) {
            $.messager.alert('Warning', 'Please select both start date and end date.');
            return;
        }

        $('#dgJournal').datagrid('load', {
            start_date: start_date,
            end_date: end_date,
            coa_id: coa_id
        });
    }

    // Format currency in Rupiah
    function formatCurrency(value) {
        if (value == null || value == '') return '';
        return 'Rp ' + parseFloat(value).toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Initialize the COA filter dropdown (optional)
    $(function() {
        $.ajax({
            url: "<?= base_url('coa/getCoaDataOption') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data && data.rows) {
                    // Format the data for combobox with both code and name
                    var formattedData = data.rows.map(function(item) {
                        item.displayText = item.code + ' - ' + item.name; // Combining code and name for display
                        return item;
                    });

                    $('#coa_filter').combobox({
                        data: formattedData,
                        valueField: 'id',
                        textField: 'displayText', // Display both code and name
                        panelHeight: 'auto',
                        filter: function(q, row) { // Custom filter to allow searching by code or name
                            var opts = $(this).combobox('options');
                            var text = row[opts.textField].toLowerCase();
                            return text.indexOf(q.toLowerCase()) >= 0;
                        }
                    });
                }
            }
        });
    });

    // Initialize the General Ledger table (Datagrid)
    $('#dgJournal').datagrid({
        method: 'get',
        loader: function(param, success, error) {
            $.ajax({
                url: "<?= base_url('report/get_buku_besar_data') ?>",
                type: "GET",
                data: {
                    start_date: param.start_date,
                    end_date: param.end_date,
                    coa_id: param.coa_id,  // COA filter is optional
                    page: param.page,
                    rows: param.rows
                },
                dataType: "json",
                success: function(data) {
                    success({
                        total: data.total,
                        rows: data.rows,
                        footer: data.footer
                    });
                },
                error: function() {
                    error.apply(this, arguments);
                }
            });
        }
    });
</script>
