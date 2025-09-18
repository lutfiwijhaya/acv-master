<h4 class="mt-4 text-center" style="font-weight: bold;">Input Daily Report</h4>

<!-- Tabel Accounting Bank -->
<div class="col-12">
	<div class="card">
		<div class="easyui-panel" style="position:relative;overflow:auto;">
			<div class="card-body">
				<h5 class="mb-3">List Bank</h5>
				<table id="bankGrid" class="easyui-datagrid" style="width:auto; height:auto;"
					pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
					<thead>
						<tr>
							<th field="id" width="auto" hidden="true">id</th>
							<th field="name" width="auto">Bank</th>
							<th field="account_bank" width="auto">Account Number</th>
							<th field="balance" width="auto">Start Balance</th>
							<th field="end_balance" width="auto">End Balance</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Form Input Daily Report -->
<div class="col-12 mt-4">
	<div class="card">
		<div class="easyui-panel" style="position:relative;overflow:auto;">
			<div class="card-body">
				<form id="formVoucher" action="<?= base_url('accounting/saveDailyReport') ?>" method="post" enctype="multipart/form-data">
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

					<h4 class="mt-4">Description</h4>
					<table class="table table-bordered mt-3 text-center" id="dataTable">
						<thead class="table-dark">
							<tr>
								<th>Description</th>
								<th>Bank</th>
								<th>In/Out</th>
								<th>Amount</th>
								<th>Remark</th>
								<th>File</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="desc[]" required></td>
								<td>
									<select class="form-control bank-select" name="bank_id[]" required>
										<option value="">Select Bank</option>
									</select>
								</td>
								<td>
									<select class="form-control bank-select" name="in_out[]" required>
										<option value="">Select In/Out</option>
										<option value="In">In</option>
										<option value="Out">Out</option>
									</select>
								</td>
								<td><input type="number" class="form-control" name="amount[]" step="1" required></td>
								<td><input type="text" class="form-control" name="remark[]" required></td>
								<td><input type="file" class="form-control" name="file[]" accept=".pdf,.jpg,.png" required></td>
								<td>
									<button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="d-flex justify-content-between mt-4">
						<button type="button" class="btn btn-success mt-2" onclick="addRow()">
							<i class="fas fa-plus"></i> Add Row
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

			// Ambil data dari bankGrid
			var bankGridData = $('#bankGrid').datagrid('getRows');

			console.log(bankGridData);

			// Tambahkan data bankGrid ke FormData
			formData.append('bank_data', JSON.stringify(bankGridData));

			$.ajax({
				url: "<?= base_url('accounting/saveDailyReport'); ?>",
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

		loadBankOptions();

		// // Jika tombol "Add Row" ditekan, isi dropdown di baris baru
		// $(document).on('click', '.btn-success', function() {
		// 	setTimeout(loadBankOptions, 100); // Tunggu sebentar agar row baru terbuat dulu
		// });







	});
</script>

<script>
	let bankBalances = {}; // Simpan saldo awal tiap bank

	function loadBankOptions() {
		$.ajax({
			url: "<?= base_url('accounting/getBank') ?>",
			type: "GET",
			dataType: "json",
			success: function(response) {
				if (response.rows && response.rows.length > 0) {
					bankBalances = {}; // Reset saldo awal
					$(".bank-select").each(function() {
						let selectElement = $(this);
						if (selectElement.children("option").length <= 1) {
							response.rows.forEach(bank => {
								selectElement.append(
									`<option value="${bank.id}">${bank.name} - ${bank.account_bank}</option>`
								);
								bankBalances[bank.id] = parseFloat(bank.balance); // Simpan saldo awal
							});
						}
					});
					updateBankTable(); // Update tabel setelah saldo awal terisi
				}
			},
			error: function() {
				console.log("Gagal mengambil data bank.");
			}
		});
	}

	function updateEndBalance() {
		let tempBalances = {
			...bankBalances
		}; // Duplikat saldo awal

		$("#dataTable tbody tr").each(function() {
			let bankId = $(this).find('select[name="bank_id[]"]').val();
			let type = $(this).find('select[name="in_out[]"]').val();
			let amount = parseFloat($(this).find('input[name="amount[]"]').val()) || 0;

			if (bankId && type && amount > 0) {
				if (type === "In") {
					tempBalances[bankId] += amount;
				} else if (type === "Out") {
					tempBalances[bankId] -= amount;
				}
			}
		});

		updateBankTable(tempBalances);
	}

	function updateBankTable(updatedBalances = bankBalances) {
    let rows = Object.keys(updatedBalances).map(bankId => {
        let bankText = $(`.bank-select option[value="${bankId}"]`).first().text();
        let bankName = bankText.split(" - ")[0]; // Ambil nama bank
        let bankAccount = bankText.split(" - ")[1];
        return {
            id: bankId,
            name: bankName,
            account_bank: bankAccount,
            balance: bankBalances[bankId], // Tetap dalam format angka asli
            end_balance: updatedBalances[bankId] // Tetap dalam format angka asli
        };
    });

    $("#bankGrid").datagrid("loadData", {
        total: rows.length,
        rows: rows
    });
}

	function formatNumber(number) {
		return new Intl.NumberFormat('id-ID').format(number);
	}

	$(document).on("change", 'select[name="bank_id[]"], select[name="in_out[]"], input[name="amount[]"]', function() {
		updateEndBalance();
	});






	function selectBank(value, row, index) {
		return `<button type="button" class="btn btn-primary btn-sm" onclick="setBankData('${row.account_number}', '${row.bank_name}')">
					<i class="fas fa-check"></i> Select
				</button>`;
	}

	function setBankData(accountNumber, bankName) {
		$('#bank_account').val(accountNumber);
		$('#recipient_bank').val(bankName);
	}

	function addRow() {
		let table = document.getElementById("dataTable").getElementsByTagName('tbody')[0];
		let row = table.insertRow();
		row.innerHTML = `
		<td><input type="text" class="form-control" name="desc[]" required></td>
		<td>
			<select class="form-control bank-select" name="bank_id[]" required>
				<option value="">Select Bank</option>
			</select>
		</td>
		<td>
			<select class="form-control bank-select" name="in_out[]" required>
				<option value="">Select In/Out</option>
				<option value="In">In</option>
				<option value="Out">Out</option>
			</select>
		</td>
		<td><input type="number" class="form-control" name="amount[]" step="0.01" required></td>
		<td><input type="text" class="form-control" name="remark[]" required></td>
		<td><input type="file" class="form-control" name="file[]" accept=".pdf,.jpg,.png" required></td>
		<td>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
				<i class="fas fa-trash"></i>
			</button>
		</td>
	`;

		// Isi dropdown bank pada baris yang baru ditambahkan
		let newBankSelect = row.querySelector('.bank-select');
		populateBankDropdown(newBankSelect);
	}

	function populateBankDropdown(selectElement) {
		$.ajax({
			url: "<?= base_url('accounting/getBank') ?>",
			type: "GET",
			dataType: "json",
			success: function(response) {
				if (response.rows && response.rows.length > 0) {
					selectElement.innerHTML = '<option value="">Select Bank</option>'; // Reset opsi
					response.rows.forEach(bank => {
						let option = document.createElement('option');
						option.value = bank.id;
						option.textContent = `${bank.name} - ${bank.account_bank}`;
						selectElement.appendChild(option);
					});
				}
			},
			error: function() {
				console.log("Gagal mengambil data bank.");
			}
		});
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