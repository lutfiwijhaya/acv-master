<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #4e73df, #1cc88a);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: #1cc88a;
            border: none;
        }

        .btn-primary:hover {
            background: #17a673;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0"><i class="fas fa-file-invoice"></i> Form Input Voucher</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="process.php" method="post">
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
                                    <input type="text" class="form-control" name="incharge" required>
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
                                        <th>Qty</th>
                                        <th>Remark</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="spec[]" required></td>
                                        <td><input type="number" class="form-control" name="qty[]" required></td>
                                        <td><input type="text" class="form-control" name="remark[]"></td>
                                        <td><input type="number" class="form-control" name="amount[]" step="0.01" required></td>
                                        <td><input type="number" class="form-control" name="total[]" step="0.01" required></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success mt-2" onclick="addRow()">
                                <i class="fas fa-plus"></i> Tambah Baris
                            </button>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <small>&copy; 2025 - Sistem Voucher</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addRow() {
            let table = document.getElementById("dataTable").getElementsByTagName('tbody')[0];
            let row = table.insertRow();
            row.innerHTML = `
                <td><input type="text" class="form-control" name="spec[]" required></td>
                <td><input type="number" class="form-control" name="qty[]" required></td>
                <td><input type="text" class="form-control" name="remark[]"></td>
                <td><input type="number" class="form-control" name="amount[]" step="0.01" required></td>
                <td><input type="number" class="form-control" name="total[]" step="0.01" required></td>
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
    </script>
</body>
</html>
