<h4 class="mt-4 text-center" style="font-weight: bold;">Form Voucher</h4>

<div class="col-12">
	<div class="card">
		<div class="easyui-panel" style="position:relative;overflow:auto;">
			<div class="card-body">
				<form id="formVoucher" action="<?= base_url('accounting/saveVoucher') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<label class="form-label">No Doc</label>
							<input type="text" class="form-control" name="no_doc" required>
						</div>
						<div class="col-md-6">
							<label class="form-label">Account</label>
							<input type="text" class="form-control" name="account" required>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-6">
							<label class="form-label">Incharge</label>
							<input type="text" id="incharge" class="form-control" name="incharge" required readonly>
						</div>
						<div class="col-md-6">
							<label class="form-label">Date</label>
							<input type="date" class="form-control" name="date" required>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-6">
							<label class="form-label">Recipient</label>
							<input type="text" class="form-control" name="recipient" required>
						</div>
						<div class="col-md-6">
							<label class="form-label">Recipient Bank</label>
							<input type="text" class="form-control" name="recipient_bank" required>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-6">
							<label class="form-label">Bank Account</label>
							<input type="text" class="form-control" name="bank_account" required>
						</div>
						<div class="col-md-6">
							<label class="form-label">Due Date</label>
							<input type="date" class="form-control" name="due_date" required>
						</div>
					</div>

					<h4 class="mt-4">Detail Items</h4>
					<table class="table table-bordered mt-3 text-center" id="dataTable">
						<thead class="table-dark">
							<tr>
								<th>Spec</th>
								<th style="width: 10%">Qty</th>
								<th>Price</th>
								<th>Amount</th>
								<th style="width: 20%">Qty</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="spec[]" required></td>
								<td><input type="number" class="form-control" name="qty[]" required oninput="calculateAmount(this)"></td>
								<td><input type="number" class="form-control" name="price[]" required oninput="calculateAmount(this)"></td>
								<td><input type="number" class="form-control" name="amount[]" step="0.01" required readonly></td>
								<td><input type="file" class="form-control" name="invoice[]" accept=".pdf,.jpg,.png" required></td>
								<td>
									<button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
					<button type="button" class="btn btn-success mt-2" onclick="addRow()">
						<i class="fas fa-plus"></i> Add Row
					</button>
					<div class="d-flex justify-content-between mt-4">
						<button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back()">
							<i class="fas fa-arrow-left"></i> Back
						</button>
						<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function() {

		var namaUser = "<?= $this->session->userdata('nama'); ?>";

		// Set nilai input incharge secara otomatis
		$('#incharge').val(namaUser);


		$("#formVoucher").submit(function(e) {
			e.preventDefault(); // Mencegah form submit langsung

			var formData = new FormData(this);

			$.ajax({
				url: "<?= base_url('accounting/saveVoucher'); ?>",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					try {
						var result = JSON.parse(response);
						if (result.status === 'success') {
							Swal.fire({
								title: "Sukses!",
								text: result.message,
								icon: "success",
								timer: 2000,
								showConfirmButton: true
							}).then(function() {
								window.location.href = result.redirect;
							});
						} else {
							Swal.fire("Error!", "Gagal menyimpan data!", "error");
						}
					} catch (error) {
						Swal.fire("Error!", "Respons server tidak valid!", "error");
					}
				},
				error: function() {
					Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
				}
			});
		});
	});
</script>

<script>
	function addRow() {
		let table = document.getElementById("dataTable").getElementsByTagName('tbody')[0];
		let row = table.insertRow();
		row.innerHTML = `
            <td><input type="text" class="form-control" name="spec[]" required></td>
            <td><input type="number" class="form-control" name="qty[]" required oninput="calculateAmount(this)"></td>
            <td><input type="number" class="form-control" name="price[]" required oninput="calculateAmount(this)"></td>
            <td><input type="number" class="form-control" name="amount[]" step="0.01" required readonly></td>
            <td><input type="file" class="form-control" name="invoice[]" accept=".pdf,.jpg,.png" required></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
	}

	function removeRow(button) {
		let row = button.closest('tr');
		row.remove();
	}

	function calculateAmount(input) {
		let row = input.closest('tr');
		let qty = row.querySelector('input[name="qty[]"]').value;
		let price = row.querySelector('input[name="price[]"]').value;
		let amount = row.querySelector('input[name="amount[]"]');
		if (qty && price) {
			amount.value = (qty * price).toFixed(0);
		} else {
			amount.value = '';
		}
	}
</script>