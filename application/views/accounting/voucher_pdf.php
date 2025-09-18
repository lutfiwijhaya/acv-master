<!DOCTYPE html>
<html>

<head>
    <title>Voucher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Mengatur logo */
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            height: 80px;
            width: auto;
            margin: 0 20px;
        }

        /* Garis pemisah */
        .line {
            border-bottom: 2px solid black;
            margin: 10px 0;
        }

        .info {
            font-size: 14px;
            margin-bottom: 8px;
        }

        /* Kolom dua bagian */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }

        .column25 {
            float: left;
            width: 25%;
            padding: 10px;
            text-align: center;
        }

        /* Clear floats */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }
    </style>
</head>

<body>

    <!-- Logo -->
    <div class="logo">
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents(FCPATH . 'assets/images/image.png')) ?>" alt="Kop Perusahaan">
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents(FCPATH . 'assets/images/knan.png')) ?>" alt="Kop Perusahaan">
    </div>

    <div class="line"></div> <!-- Garis pemisah -->

    <!-- Section utama -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Kolom kiri -->
                <div class="column">
                    <div class="info"><strong>Doc No:</strong> <?= $voucher->no_doc ?? '-' ?></div>
                    <div class="info"><strong>Account:</strong> <?= $voucher->account ?? '-' ?></div>
                    <div class="info"><strong>Date:</strong> <?= $voucher->date ?? '-' ?></div>
                    <div class="info"><strong>Status:</strong> <?= $voucher->status ?? '-' ?></div>
                </div>

                <!-- Kolom kanan (Incharge & Approval) -->
                <div class="column25">
                    <div><strong>Incharge</strong></div>
                    <div><?= $voucher->sign ?? '-' ?></div>
                    <div><?= $voucher->incharge ?? '-' ?></div>
                </div>

                <div class="column25">
                    <div><strong>Approval</strong></div>
                    <div><?= $voucher->approval ?? '-' ?></div>
                    <div><?= $voucher->approval_date ?? '-' ?></div>
                </div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Table untuk Voucher Spec -->
        <div class="container">
            <h3>Voucher Specification</h3>
            <table>
                <tr>
                    <th>No</th>
                    <th>Specification</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Amount</th>
                </tr>
                <?php if (!empty($voucherspec)) : ?>
                    <?php $no = 1;
                    $totalAmount = 0; ?>
                    <?php foreach ($voucherspec as $spec) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $spec->spec ?? '-' ?></td>
                            <td>IDR <?= number_format($spec->price ?? 0, 0, ',', '.') ?></td>
                            <td><?= $spec->qty ?? '-' ?></td>
                            <td>IDR <?= number_format($spec->amount ?? 0, 0, ',', '.') ?></td>
                        </tr>
                        <?php $totalAmount += $spec->amount ?? 0; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" style="text-align:right; font-weight:bold;">Total Amount:</td>
                        <td style="font-weight:bold;">IDR <?= number_format($totalAmount, 0, ',', '.') ?></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No data available</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

       


        <div class="container">
            <div class="row">
                <!-- Kolom kiri -->
                <div class="column">
                    <div class="info"><strong>Recipient:</strong> <?= $voucher->recipient ?? '-' ?></div>
                    <div class="info"><strong>Recipient Bank :</strong> <?= $voucher->recipient_bank ?? '-' ?></div>
                    <div class="info"><strong>Bank Account:</strong> <?= $voucher->bank_account ?? '-' ?></div>
                    <div class="info"><strong>Due Date:</strong> <?= $voucher->due_date ?? '-' ?></div>
                </div>

             
            </div>
        </div>

    </section>

</body>

</html>