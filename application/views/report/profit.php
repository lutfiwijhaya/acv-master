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
          <table id="dgGrid" title="Profit & Loss Report" 
            toolbar="#toolbar" 
            class="easyui-datagrid" 
            rowNumbers="true" 
            pagination="false"
            url="<?= base_url('report/get_profit_loss_data') ?>" 
            nowrap="true"
            singleSelect="true">
              <thead>
                  <tr>
                      <th field="category" width="25%">Category</th>
                      <th field="code" width="15%">COA Code</th>
                      <th field="name" width="40%">Account Name</th>
                      <th field="amount" width="20%" align="right">Amount</th>
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
      <div class="card-header"><h5 class="card-title">Profit & Loss - Comparison Chart</h5></div>
      <div class="card-body">
        <canvas id="profitBarChart" height="250"></canvas>
      </div>
    </div> 
  </div>

  <!-- Pie Chart -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><h5 class="card-title">Revenue vs Expenses Distribution</h5></div>
      <div class="card-body">
        <canvas id="profitPieChart" height="250"></canvas>
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
        },
        rowStyler: function(index, row){
            // Style untuk header kategori (PENDAPATAN, BEBAN)
            if(row.is_header){
                return 'background-color:#e3f2fd;font-weight:bold;font-size:13px;';
            }
            // Style untuk subtotal (TOTAL PENDAPATAN, TOTAL BEBAN)
            if(row.is_subtotal){
                return 'background-color:#fff3e0;font-weight:bold;border-top:2px solid #ff9800;';
            }
            // Style untuk total akhir (LABA/RUGI BERSIH)
            if(row.is_total){
                return 'background-color:#c8e6c9;font-weight:bold;font-size:15px;border-top:3px solid #4caf50;';
            }
            return '';
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
        filename:'Profit_Loss_Report.xls'
    });
}

function print(){
    $('#dgGrid').datagrid('print','DataGrid');
}

// =============== Render Charts =================
function renderCharts(data){
    const summary = data.summary;
    
    if(!summary) return;

    // Parse nilai dari format string ke float
    const parseAmount = (str) => parseFloat((str || "0").replace(/,/g,''));

    const totalRevenue = parseAmount(summary.total_revenue);
    const totalExpenses = parseAmount(summary.total_expenses);
    const netProfit = parseAmount(summary.net_profit);

    // Destroy chart lama
    if(barChart) barChart.destroy();
    if(pieChart) pieChart.destroy();

    // ---- Bar Chart: Revenue vs Expenses vs Net Profit ----
    const ctxBar = document.getElementById('profitBarChart').getContext('2d');
    barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Total Revenue', 'Total Expenses', 'Net Profit/(Loss)'],
            datasets: [{
                label: 'Amount (IDR)',
                data: [totalRevenue, totalExpenses, netProfit],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',  // Revenue - Hijau
                    'rgba(255, 99, 132, 0.7)',  // Expenses - Merah
                    netProfit >= 0 ? 'rgba(54, 162, 235, 0.7)' : 'rgba(255, 159, 64, 0.7)' // Profit/Loss
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    netProfit >= 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { 
                    display: true, 
                    text: 'Profit & Loss Summary',
                    font: { size: 16 }
                },
                legend: { display: false },
                tooltip: { 
                    callbacks: {
                        label: function(context){
                            return 'Amount: ' + new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: { 
                        callback: function(v){ 
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                notation: 'compact',
                                maximumFractionDigits: 1
                            }).format(v); 
                        } 
                    } 
                }
            }
        }
    });

    // ---- Pie Chart: Revenue vs Expenses ----
    const ctxPie = document.getElementById('profitPieChart').getContext('2d');
    pieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Total Revenue', 'Total Expenses'],
            datasets: [{
                data: [totalRevenue, totalExpenses],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',  // Revenue
                    'rgba(255, 99, 132, 0.8)'   // Expenses
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { 
                    display: true, 
                    text: 'Revenue vs Expenses',
                    font: { size: 16 }
                },
                legend: {
                    position: 'bottom'
                },
                tooltip: { 
                    callbacks: {
                        label: function(context){
                            const total = context.dataset.data.reduce((a,b) => a+b, 0);
                            const percentage = ((context.raw / total) * 100).toFixed(2);
                            return context.label + ': ' + new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(context.raw) + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
}
</script>