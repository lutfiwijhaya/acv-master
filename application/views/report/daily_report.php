<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title; ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <!-- Filter Card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter"></i> Filter Options</h3>
            </div>
            <div class="card-body">
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="report_date">Select Date <span class="text-danger">*</span></label>
                                <input type="date" 
                                       id="report_date" 
                                       name="report_date" 
                                       class="form-control" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="date_field">Filter By</label>
                                <select id="date_field" name="date_field" class="form-control">
                                    <option value="request_date" selected>Request Date</option>
                                    <option value="bill_date">Bill Date</option>
                                    <option value="approval_date">Approval Date</option>
                                    <option value="company_payment_date">Payment Date</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> Apply & Preview
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-secondary btn-block" onclick="resetFilter()">
                                        <i class="fas fa-redo"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Status Summary Cards -->
        <div id="statusCardsSection" style="display:none;">
            <div class="row" id="statusCards">
                <!-- Cards will be dynamically generated here -->
            </div>
        </div>

        <!-- Report Table Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-table"></i> Daily RPA Report</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" onclick="printReport()" id="btnPrint" disabled>
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button type="button" class="btn btn-info btn-sm" onclick="exportExcel()" id="btnExport" disabled>
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Summary Info -->
                <div id="summaryInfo" class="alert alert-info" style="display:none;">
                    <i class="fas fa-info-circle"></i> <span id="summaryText"></span>
                </div>

                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table id="rpaTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 3%;">No</th>
                                <th style="width: 10%;">Invoice No</th>
                                <th style="width: 9%;">Charge Code</th>
                                <th style="width: 12%;">Supplier</th>
                                <th style="width: 8%;">Bill Date</th>
                                <th style="width: 8%;">Request Date</th>
                                <th style="width: 8%;">Approval Date</th>
                                <th style="width: 8%;">Payment Date</th>
                                <th style="width: 5%;">Cat</th>
                                <th style="width: 7%;">Status</th>
                                <th style="width: 5%;">Posted</th>
                                <th style="width: 9%;">Created By</th>
                                <th style="width: 9%;">Approved By</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody id="rpaTableBody">
                            <tr>
                                <td colspan="14" class="text-center text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Please select a date and click "Apply & Preview" to view the report.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Status Cards Styling */
.status-card {
    border-radius: 10px;
    padding: 20px;
    color: white;
    text-align: center;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: transform 0.2s;
}

.status-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.status-card h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 0;
    padding: 10px 0;
}

.status-card p {
    font-size: 1rem;
    margin: 5px 0;
    text-transform: uppercase;
    font-weight: 600;
}

.status-card small {
    font-size: 0.85rem;
    opacity: 0.9;
}

/* Card Colors */
.card-new { background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%); }
.card-waiting { background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: #333 !important; }
.card-approved { background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); }
.card-rejected { background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%); }
.card-paid { background: linear-gradient(135deg, #6c757d 0%, #545b62 100%); }

/* Status Badge */
.badge-status {
    font-size: 0.75rem;
    padding: 5px 10px;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 4px;
}

.badge-new { background-color: #17a2b8; color: white; }
.badge-waiting { background-color: #ffc107; color: #333; }
.badge-approved { background-color: #28a745; color: white; }
.badge-rejected { background-color: #dc3545; color: white; }
.badge-paid { background-color: #6c757d; color: white; }

/* Posted Status */
.posted-yes { color: #28a745; font-weight: bold; }
.posted-no { color: #dc3545; font-weight: bold; }

/* Table Styling */
#rpaTable {
    font-size: 0.9rem;
    white-space: nowrap;
}

#rpaTable thead th {
    background-color: #343a40;
    color: white;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    position: sticky;
    top: 0;
    z-index: 10;
}

#rpaTable tbody td {
    vertical-align: middle;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .status-card h2 {
        font-size: 2rem;
    }
    
    #rpaTable {
        font-size: 0.8rem;
    }
    
    .card-tools .btn {
        margin-bottom: 5px;
    }
}

/* Loading State */
.loading-overlay {
    position: relative;
}

.loading-overlay::after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.7);
    z-index: 1000;
}

/* Print Styles */
@media print {
    .content-header,
    .card-header .card-tools,
    .btn,
    #filterForm,
    .no-print {
        display: none !important;
    }
    
    .card {
        border: none;
        box-shadow: none;
    }
    
    #rpaTable {
        font-size: 10pt;
    }
    
    #rpaTable thead th {
        background-color: #343a40 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

<script type="text/javascript">
let currentReportDate = '';
let currentDateField = 'request_date';
let reportData = [];

$(document).ready(function() {
    // Set today's date as default
    const today = new Date().toISOString().split('T')[0];
    $('#report_date').val(today);
    $('#report_date').attr('max', today); // Prevent future dates
    
    // Form submit handler
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        applyFilter();
    });
    
    // Debug: Check if jQuery is loaded
    console.log('jQuery version:', $.fn.jquery);
});

// Apply Filter Function
function applyFilter() {
    const reportDate = $('#report_date').val();
    const dateField = $('#date_field').val();
    
    if (!reportDate) {
        alert('Please select a date');
        return;
    }
    
    console.log('Applying filter with date:', reportDate, 'field:', dateField);
    
    currentReportDate = reportDate;
    currentDateField = dateField;
    
    // Show loading
    $('#rpaTableBody').html(
        '<tr><td colspan="14" class="text-center">' +
        '<i class="fas fa-spinner fa-spin"></i> Loading data...' +
        '</td></tr>'
    );
    
    // AJAX Request
    $.ajax({
        url: '<?= base_url("report/get_daily_report_data") ?>',
        type: 'POST',
        data: {
            report_date: reportDate,
            date_field: dateField
        },
        dataType: 'json',
        beforeSend: function() {
            console.log('Sending AJAX request...');
        },
        success: function(response) {
            console.log('Response received:', response);
            
            // Check if response is successful and has data
            if (response.success === true) {
                if (response.rows && response.rows.length > 0) {
                    reportData = response.rows;
                    displayTable(response.rows);
                    displaySummary(response);
                    displayStatusCards(response.summary);
                    
                    // Enable action buttons
                    $('#btnPrint, #btnExport').prop('disabled', false);
                } else {
                    // No data found
                    showNoData();
                }
            } else {
                // Error response
                showError(response.message || 'Failed to load data');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
            
            showError('Failed to load data. Please try again.');
        }
    });
}

// Display Table Data
function displayTable(data) {
    console.log('Displaying table with', data.length, 'rows');
    
    if (!data || data.length === 0) {
        showNoData();
        return;
    }
    
    let html = '';
    
    $.each(data, function(index, row) {
        html += '<tr>';
        html += '<td class="text-center">' + (index + 1) + '</td>';
        html += '<td>' + (row.invoice_no || '-') + '</td>';
        html += '<td>' + (row.charge_code || '-') + '</td>';
        html += '<td>' + (row.supplier_name || '-') + '</td>';
        html += '<td class="text-center">' + (row.bill_date || '-') + '</td>';
        html += '<td class="text-center">' + (row.request_date || '-') + '</td>';
        html += '<td class="text-center">' + (row.approval_date || '-') + '</td>';
        html += '<td class="text-center">' + (row.company_payment_date || '-') + '</td>';
        html += '<td class="text-center">' + (row.category || '-') + '</td>';
        html += '<td class="text-center">' + formatStatus(row.status) + '</td>';
        html += '<td class="text-center">' + formatPosted(row.is_posted) + '</td>';
        html += '<td>' + (row.created_by_name || '-') + '</td>';
        html += '<td>' + (row.approved_by_name || '-') + '</td>';
        html += '<td>' + (row.note || '-') + '</td>';
        html += '</tr>';
    });
    
    $('#rpaTableBody').html(html);
}

// Format Status
function formatStatus(status) {
    if (!status) return '-';
    
    const statusLower = status.toLowerCase();
    const statusUpper = status.toUpperCase();
    
    return '<span class="badge badge-status badge-' + statusLower + '">' + statusUpper + '</span>';
}

// Format Posted
function formatPosted(value) {
    // Handle different value types
    if (value == 1 || value == '1' || value === true) {
        return '<span class="posted-yes"><i class="fas fa-check-circle"></i> Yes</span>';
    } else {
        return '<span class="posted-no"><i class="fas fa-times-circle"></i> No</span>';
    }
}

// Display Summary
function displaySummary(response) {
    if (!response.summary || response.summary.length === 0) {
        $('#summaryInfo').hide();
        return;
    }
    
    let summaryText = '<strong>Report Date:</strong> ' + response.report_date + ' | ';
    summaryText += '<strong>Total Records:</strong> ' + response.total_records + ' | ';
    
    $.each(response.summary, function(index, item) {
        summaryText += '<strong>' + item.status.toUpperCase() + ':</strong> ' + item.total_records + ' ';
        summaryText += '(Posted: ' + item.posted_count + ') | ';
    });
    
    // Remove last separator
    summaryText = summaryText.slice(0, -3);
    
    $('#summaryText').html(summaryText);
    $('#summaryInfo').slideDown();
}

// Display Status Cards
function displayStatusCards(summary) {
    if (!summary || summary.length === 0) {
        $('#statusCardsSection').hide();
        return;
    }
    
    const cardColors = {
        'new': 'card-new',
        'waiting': 'card-waiting',
        'approved': 'card-approved',
        'rejected': 'card-rejected',
        'paid': 'card-paid'
    };
    
    const colSize = Math.max(Math.floor(12 / summary.length), 2);
    let cardsHTML = '';
    
    $.each(summary, function(index, item) {
        const statusLower = item.status.toLowerCase();
        const colorClass = cardColors[statusLower] || 'card-new';
        
        cardsHTML += '<div class="col-lg-' + colSize + ' col-md-4 col-sm-6">';
        cardsHTML += '  <div class="status-card ' + colorClass + '">';
        cardsHTML += '    <h2>' + item.total_records + '</h2>';
        cardsHTML += '    <p>' + item.status.toUpperCase() + '</p>';
        cardsHTML += '    <small>Posted: ' + item.posted_count + ' | Unposted: ' + item.unposted_count + '</small>';
        cardsHTML += '  </div>';
        cardsHTML += '</div>';
    });
    
    $('#statusCards').html(cardsHTML);
    $('#statusCardsSection').slideDown();
}

// Show No Data Message
function showNoData() {
    $('#rpaTableBody').html(
        '<tr><td colspan="14" class="text-center text-muted">' +
        '<i class="fas fa-info-circle"></i> No data found for the selected date.' +
        '</td></tr>'
    );
    $('#summaryInfo').hide();
    $('#statusCardsSection').hide();
    $('#btnPrint, #btnExport').prop('disabled', true);
}

// Show Error Message
function showError(message) {
    $('#rpaTableBody').html(
        '<tr><td colspan="14" class="text-center text-danger">' +
        '<i class="fas fa-exclamation-triangle"></i> ' + message +
        '</td></tr>'
    );
    $('#summaryInfo').hide();
    $('#statusCardsSection').hide();
    $('#btnPrint, #btnExport').prop('disabled', true);
}

// Reset Filter
function resetFilter() {
    $('#filterForm')[0].reset();
    const today = new Date().toISOString().split('T')[0];
    $('#report_date').val(today);
    $('#date_field').val('request_date');
    
    $('#rpaTableBody').html(
        '<tr><td colspan="14" class="text-center text-muted">' +
        '<i class="fas fa-info-circle"></i> Please select a date and click "Apply & Preview" to view the report.' +
        '</td></tr>'
    );
    
    $('#summaryInfo').hide();
    $('#statusCardsSection').hide();
    $('#btnPrint, #btnExport').prop('disabled', true);
    
    currentReportDate = '';
    currentDateField = 'request_date';
    reportData = [];
}

// Print Report
function printReport() {
    if (!currentReportDate) {
        alert('Please select a date and apply filter first');
        return;
    }
    
    const printUrl = '<?= base_url("report/print_daily_report") ?>?date=' + 
                     currentReportDate + '&date_field=' + currentDateField;
    window.open(printUrl, '_blank', 'width=1200,height=800');
}

// Export to Excel
function exportExcel() {
    if (!currentReportDate) {
        alert('Please select a date and apply filter first');
        return;
    }
    
    const exportUrl = '<?= base_url("report/export_daily_report") ?>?date=' + 
                      currentReportDate + '&date_field=' + currentDateField;
    window.location.href = exportUrl;
}
</script>
