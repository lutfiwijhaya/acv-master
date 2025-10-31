<section class="content-header"></section>
<div class="col-12">
  <div class="card">
    <div class="easyui-panel" style="position:relative;overflow:auto;">
      <div class="card-body">
        <div class="easyui-layout">
            <div class="col-sm-12 text-right mb-3">
                      <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-print" onclick="print()">Print</a>
                      <a href="javascript:void(0);" class="easyui-linkbutton" onclick="exportExcel()">Export To Excel</a>
                  </div>
          <table id="dgGrid" title="<?= $title;?>" 
            toolbar="#toolbar" 
            class="easyui-datagrid" 
            rowNumbers="true" 
            pagination="false"
            url="<?= base_url('report/get_balance_sheet_data') ?>" 
            nowrap="true" 
            showFooter="true"
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="coa_code" width="15%">COA Code</th>
                      <th field="coa_name" width="30%">Account Name</th>
                      <th field="debit" width="15%" align="right">Debit</th>
                      <th field="credit" width="15%" align="right">Credit</th>
                      <th field="balance" width="15%" align="right">Balance</th>
                  </tr>
              </thead>
          </table>

          <div id="toolbar" style="padding:10px">
            <div class="row align-items-center">
                <div class="col-md-auto">
                    <label for="start_date" class="mb-0 mr-2 font-weight-bold">Start Date:</label>
                    <input type="date" id="start_date" class="form-control d-inline-block" style="width:150px;">
                </div>
                <div class="col-md-auto">
                    <label for="end_date" class="mb-0 mr-2 font-weight-bold">End Date:</label>
                    <input type="date" id="end_date" class="form-control d-inline-block" style="width:150px;">
                </div>
                <div class="col-md-auto">
                    <select id="filter_quick" class="form-control" style="min-width:130px;">
                        <option value="">--Quick Filter--</option>
                        <option value="1day">1 Day</option>
                        <option value="1week">1 Week</option>
                        <option value="1month">1 Month</option>
                        <option value="1year">1 Year</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">Apply</a>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart Section -->
<div class="row mt-4">
  <!-- Bar Chart -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><h5 class="card-title">Balance Sheet - Bar Chart</h5></div>
      <div class="card-body">
        <canvas id="balanceBarChart" height="250"></canvas>
      </div>
    </div> 
  </div>

  <!-- Pie Chart -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><h5 class="card-title">Balance Sheet - Pie Chart</h5></div>
      <div class="card-body">
        <canvas id="balancePieChart" height="250"></canvas>
      </div>
    </div>
  </div>
</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
let barChart, pieChart;

$(document).ready(function(){
    $('#dgGrid').datagrid({
        minHeight:450,
        maxHeight:520,
        onLoadSuccess: function(data){
            if(data && data.rows){
                renderCharts(data);
            }
        }
    });
});

// fungsi apply filter
function doSearch(){
    $('#dgGrid').datagrid('load',{
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        filter: $('#filter_quick').val()
    });
}

// export excel
function exportExcel(){
    $('#dgGrid').datagrid('toExcel',{
        filename:'Balance_Sheet_Report.xls'
    });
}

function print(){
    $('#dgGrid').datagrid('print','DataGrid');
}

// =============== Render Charts =================
function renderCharts(data){
    const rows = data.rows;
    const footer = data.footer ? data.footer[0] : {};

    // ---- Data untuk Bar Chart ----
    const labels = rows.map(r => r.coa_name);
    const debitData = rows.map(r => parseFloat((r.debit || "0").replace(/,/g,'')));
    const creditData = rows.map(r => parseFloat((r.credit || "0").replace(/,/g,'')));

    // ---- Total untuk Pie Chart ----
    const totalDebit = parseFloat((footer.total_debit || "0").replace(/,/g,'')) || debitData.reduce((a,b)=>a+b,0);
    const totalCredit = parseFloat((footer.total_credit || "0").replace(/,/g,'')) || creditData.reduce((a,b)=>a+b,0);

    // Destroy chart lama biar nggak dobel
    if(barChart) barChart.destroy();
    if(pieChart) pieChart.destroy();

    // Bar Chart
    const ctxBar = document.getElementById('balanceBarChart').getContext('2d');
    barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                { label: 'Debit', data: debitData, backgroundColor: 'rgba(75, 192, 192, 0.6)' },
                { label: 'Credit', data: creditData, backgroundColor: 'rgba(255, 99, 132, 0.6)' }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Debit vs Credit per Account' },
                tooltip: { callbacks: {
                    label: function(context){
                        return context.dataset.label + ': ' + new Intl.NumberFormat().format(context.raw);
                    }
                }}
            },
            scales: {
                y: { ticks: { callback: function(v){ return new Intl.NumberFormat().format(v); } } }
            }
        }
    });

    // Pie Chart
    const ctxPie = document.getElementById('balancePieChart').getContext('2d');
    pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Total Debit','Total Credit'],
            datasets: [{
                data: [totalDebit, totalCredit],
                backgroundColor: ['#36A2EB','#FF6384']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Total Debit vs Credit' },
                tooltip: { callbacks: {
                    label: function(context){
                        return context.label + ': ' + new Intl.NumberFormat().format(context.raw);
                    }
                }}
            }
        }
    });
}
</script>
