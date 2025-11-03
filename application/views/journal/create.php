<section class="content-header"></section>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">

            <form id="ff" method="post">
                <input type="hidden" name="id">
                <div style="margin-bottom:15px">
                    <label>Project:</label>
                    <input class="form-control" name="project" required>
                </div>
                <div style="margin-bottom:15px">
                    <label>No Reference:</label>
                    <input class="form-control" name="reference" required>
                </div>
                <div style="margin-bottom:15px">
                    <label>Supplier:</label>
                    <select class="form-control" id="supplier_id" name="supplier_id" style="width:100%" required>
                        <option value="">-- Select Supplier --</option>
                    </select>
                </div>
            </form>

            <!-- Detail Table -->
            <div class="table-responsive"><!-- ✅ Responsive wrapper -->
                <table id="detailTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>COA</th>
                            <th>Type</th>
                            <th>Description</th>                            
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- First row -->
                        <tr>
                            
                            <td>
                                <select name="coa_id[]" class="form-control coa-select" style="width:100%" required></select>
                            </td>
                            <td>
                                <select name="type[]" class="form-control type-select" required>
                                    <option value="">--Select--</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                </select>
                            </td>
                            <td><input type="text" name="description[]" class="form-control" required></td>
                            <td><input type="number" step="0.01" name="debit[]" class="form-control debit-input" disabled></td>
                            <td><input type="number" step="0.01" name="credit[]" class="form-control credit-input" disabled></td>
                            <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-primary" id="addRow">+ Add Row</button>

            <!-- Buttons -->
            <div style="text-align:right;padding:10px 0">
                <button type="button" class="btn btn-success" onclick="submitJournal()">Simpan</button>
                <button type="reset" class="btn btn-secondary">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Select2 CSS + JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap 4 -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Select2 Bootstrap4 Theme -->
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet">

<script>
$(document).ready(function(){

    // Init select2 for Supplier
    initSupplierSelect($('#supplier_id'));

    // Init select2 for existing COA row
    initCoaSelect($('.coa-select'));

    // Enable Debit OR Credit depending on type
    $(document).on('change','.type-select',function(){
        let row = $(this).closest('tr');
        if($(this).val() === 'debit'){
            row.find('.debit-input').prop('disabled', false).attr('required', true);
            row.find('.credit-input').prop('disabled', true).val('');
        }else if($(this).val() === 'credit'){
            row.find('.credit-input').prop('disabled', false).attr('required', true);
            row.find('.debit-input').prop('disabled', true).val('');
        }else{
            row.find('.debit-input,.credit-input').prop('disabled', true).val('');
        }
    });

    // Add new row
    $('#addRow').click(function(){
        let newRow = `
        <tr>
            <td>
                <select name="coa_id[]" class="form-control coa-select" style="width:100%" required></select>
            </td>
            <td>
                <select name="type[]" class="form-control type-select" required>
                    <option value="">--Select--</option>
                    <option value="debit">Debit</option>
                    <option value="credit">Credit</option>
                </select>
            </td>
            <td><input type="text" name="description[]" class="form-control" required></td>
            <td><input type="number" step="0.01" name="debit[]" class="form-control debit-input" disabled></td>
            <td><input type="number" step="0.01" name="credit[]" class="form-control credit-input" disabled></td>
            <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
        </tr>`;
        $('#detailTable tbody').append(newRow);

        // Init select2 for new row
        initCoaSelect($('#detailTable tbody tr:last').find('.coa-select'));
    });

    // Remove row
    $(document).on('click','.removeRow',function(){
        $(this).closest('tr').remove();
    });

});

// ✅ Init Select2 for Supplier
function initSupplierSelect(el){
    el.select2({
        placeholder: "-- Select Supplier --",
        width: '100%',
        theme: "bootstrap4",
        ajax: {
            url: "<?= base_url('admin/getSupplier') ?>",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.rows, function (item) {
                        return { 
                            id: item.id, 
                            text: item.nama + ' - ' + item.rek_bank
                        }
                    })
                };
            },
            cache: true
        }
    });
}

// ✅ Fixed Select2 inside table for COA
function initCoaSelect(el){
    el.select2({
        placeholder: "-- Select COA --",
        width: '100%', // make it full width of td
        theme:"bootstrap4",
        dropdownParent: el.closest('td'), // ensures dropdown is not clipped
        ajax: {
            url: "<?= base_url('coa/getDataCoaOption') ?>",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { search: params.term }; // send search query to backend
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return { id: item.id, text: item.text }
                    })
                };
            },
            cache: true
        }
    });
}

// Submit form
function submitJournal(){
    let formData = $('#ff').serializeArray();
    let details = $('#detailTable').find('input, select').serializeArray();

    $.post("<?= base_url('journal/saveJournal') ?>", formData, function(headerResp){
        if(headerResp.errorMsg){
            Toast.fire({icon:'error',title:headerResp.errorMsg});
        }else{
            $.post("<?= base_url('journal/saveJournalDetail') ?>", details, function(resp){
                if(resp.errorMsg){
                    Toast.fire({icon:'error',title:resp.errorMsg});
                }else{
                    Toast.fire({icon:'success',title:resp.message});
                }
            }, 'json');
        }
    }, 'json');
}
</script>