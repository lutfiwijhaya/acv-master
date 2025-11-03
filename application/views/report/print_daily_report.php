<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian - <?= htmlspecialchars($report_date_short ?? ''); ?></title>
    <style>
        /* Reset & Base Styles */
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: Arial, Helvetica, sans-serif; font-size:8pt; line-height:1.2; color:#000; background:#fff; padding:8mm; }
        @page { size: A4 portrait; margin:8mm; }

        .report-container { width:100%; max-width:194mm; }

        .report-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; padding-bottom:5px; border-bottom:2px solid #000; }
        .logo-section { width:18%; }
        .logo-section img { height:35px; width:auto; }
        .title-section { width:64%; text-align:center; }
        .title-section h1 { font-size:14pt; font-weight:bold; margin:0; letter-spacing:.5px; }

        .signature-box { width:100%; border:1px solid #000; margin-bottom:6px; display:table; }
        .signature-cell { display:table-cell; width:25%; padding:4px 2px; text-align:center; border-right:1px solid #000; height:32px; vertical-align:middle; font-size:7pt; font-weight:600; }
        .signature-cell:last-child { border-right:none; }

        .company-name { font-size:10pt; font-weight:bold; margin-bottom:4px; }
        .date-info { text-align:right; margin-bottom:6px; font-weight:bold; font-size:8pt; }

        table { width:100%; border-collapse:collapse; margin-bottom:8px; }
        table th, table td { border:1px solid #000; padding:2px 3px; font-size:7pt; word-wrap:break-word; }
        table th { background:#d9d9d9; font-weight:bold; text-align:center; line-height:1.1; }
        table td { text-align:left; }
        .text-right { text-align:right !important; }
        .text-center { text-align:center !important; }
        .text-left { text-align:left !important; }

        .summary-table th { font-size:6.5pt; padding:2px; vertical-align:middle; }
        .summary-table td { text-align:right; padding:2px 3px; font-size:7pt; }
        .summary-table .total-row { background:#e8e8e8; font-weight:bold; }

        .section-title { font-size:9pt; font-weight:bold; margin:8px 0 3px 0; padding:3px 4px; border-bottom:2px solid #000; background:#f5f5f5; }

        .detail-table th { font-size:6.5pt; padding:2px; }
        .detail-table td { font-size:6.5pt; padding:2px 3px; }
        .detail-table .total-row { background:#e8e8e8; font-weight:bold; }

        @media print {
            body { padding:0; margin:0; }
            .no-print { display:none !important; }
            .report-container { max-width:100%; }
            table, tr, .section-title { page-break-inside:avoid; page-break-after:avoid; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; color-adjust: exact !important; }
        }

        .print-button { position:fixed; top:15px; right:15px; padding:12px 24px; background:#007bff; color:#fff; border:none; border-radius:6px; cursor:pointer; font-size:14px; font-weight:600; box-shadow:0 3px 8px rgba(0,0,0,.2); z-index:1000; transition:all .3s ease; }
        .print-button:hover { background:#0056b3; transform:translateY(-2px); box-shadow:0 5px 12px rgba(0,0,0,.3); }
        .print-button:active { transform:translateY(0); }

        @media screen {
            body { background:#e5e5e5; }
            .report-container { background:#fff; box-shadow:0 2px 15px rgba(0,0,0,.15); padding:15px; margin:20px auto; }
        }
    </style>
</head>
<body>
<button class="print-button no-print" onclick="window.print();">🖨️ Print Report</button>

<div class="report-container">
    <!-- Header -->
    <div class="report-header">
        <div class="logo-section">
            <?php if (defined('FCPATH') && file_exists(FCPATH.'assets/images/logo.png')): ?>
                <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Company Logo">
            <?php else: ?>
                <div style="border:1px solid #999; padding:6px; text-align:center; font-size:7pt;">LOGO</div>
            <?php endif; ?>
        </div>
        <div class="title-section"><h1>LAPORAN HARIAN</h1></div>
        <div style="width:18%;"></div>
    </div>

    <!-- Signature Box -->
    <div class="signature-box">
        <div class="signature-cell">Incharge</div>
        <div class="signature-cell">Mengetahui</div>
        <div class="signature-cell">Mengetahui</div>
        <div class="signature-cell">Director</div>
    </div>

    <!-- Company & Date -->
    <div class="company-name">PT. Achivon Prestasi Abadi</div>
    <div class="date-info">Date: <?= htmlspecialchars($report_date_short ?? ''); ?></div>

    <?php
    // =======================
    // Helper functions (view-scope)
    // =======================
    if (!function_exists('fmt')) {
        function fmt($n) { return number_format((float)$n, 0, ',', '.'); }
    }
    if (!function_exists('acc_name')) {
        function acc_name($alias, $bank_accounts) {
            if ($alias === 'cash') return 'Uang Tunai';
            return $bank_accounts[$alias]['label'] ?? $bank_accounts[$alias]['name'] ?? strtoupper($alias);
        }
    }

    // Pastikan struktur dasar tersedia
    $bank_accounts = $bank_accounts ?? [];
    $summary = $summary ?? [];
    $transactions = $transactions ?? ['income'=>['items'=>[]], 'expense'=>['items'=>[]]];

    // Susun daftar akun yang akan ditampilkan di ringkasan:
    //  - semua bank aktif
    //  - tambahkan 'cash' bila ada di summary/transactions
    $accounts = array_keys($bank_accounts);
    $hasCash = isset($summary['cash']) ||
               isset($transactions['income']['cash']) ||
               isset($transactions['expense']['cash']) ||
               // fallback: cek apakah ada payment_method 'cash' di items
               (isset($transactions['income']['items']) && array_filter($transactions['income']['items'], fn($it)=>($it['payment_method']??'')==='cash')) ||
               (isset($transactions['expense']['items']) && array_filter($transactions['expense']['items'], fn($it)=>($it['payment_method']??'')==='cash'));
    if ($hasCash && !in_array('cash', $accounts, true)) {
        $accounts[] = 'cash';
    }

    // Hitung total ringkasan
    $total_opening = 0; $total_income = 0; $total_expense = 0; $total_closing = 0;

    // Date labels
    $previous_day_short = htmlspecialchars($previous_day_short ?? '');
    $report_date_short = htmlspecialchars($report_date_short ?? '');
    ?>

    <!-- Summary Table -->
    <table class="summary-table">
        <thead>
        <tr>
            <th></th>
            <th>Saldo Sisa<br/><?= $previous_day_short; ?></th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Saldo Sisa<br/><?= $report_date_short; ?></th>
            <th>Komentar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($accounts as $alias): 
            $open  = (float)($summary[$alias]['opening'] ?? 0);
            $inc   = (float)($summary[$alias]['income']  ?? 0);
            $exp   = (float)($summary[$alias]['expense'] ?? 0);
            $close = (float)($summary[$alias]['closing'] ?? ($open + $inc - $exp));

            $total_opening += $open;
            $total_income  += $inc;
            $total_expense += $exp;
            $total_closing += $close;
        ?>
            <tr>
                <td class="text-left"><strong><?= htmlspecialchars(acc_name($alias, $bank_accounts)); ?></strong></td>
                <td class="text-right"><?= fmt($open); ?></td>
                <td class="text-right"><?= fmt($inc); ?></td>
                <td class="text-right"><?= fmt($exp); ?></td>
                <td class="text-right"><?= fmt($close); ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td class="text-center"><strong>Total</strong></td>
            <td class="text-right"><strong><?= fmt($total_opening); ?></strong></td>
            <td class="text-right"><strong><?= fmt($total_income); ?></strong></td>
            <td class="text-right"><strong><?= fmt($total_expense); ?></strong></td>
            <td class="text-right"><strong><?= fmt($total_closing); ?></strong></td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <?php
    // Peta label akun (untuk tampilan di detail)
    $aliasToLabel = [];
    foreach ($bank_accounts as $alias => $info) {
        $aliasToLabel[$alias] = acc_name($alias, $bank_accounts);
    }
    $aliasToLabel['cash'] = 'Uang Tunai';

    // Fungsi ambil total per akun dari items
    $getTotalsByAccount = function(array $items) {
        $tot = [];
        foreach ($items as $it) {
            $acc = $it['payment_method'] ?? 'cash';
            $amt = (float)($it['amount'] ?? 0);
            if (!isset($tot[$acc])) $tot[$acc] = 0;
            $tot[$acc] += $amt;
        }
        return $tot;
    };

    $incomeItems  = $transactions['income']['items']  ?? [];
    $expenseItems = $transactions['expense']['items'] ?? [];

    $incomeTotalsByAcc  = $getTotalsByAccount($incomeItems);
    $expenseTotalsByAcc = $getTotalsByAccount($expenseItems);

    // fungsi nama akun aman
    $labelAcc = function($acc) use ($aliasToLabel) {
        return $aliasToLabel[$acc] ?? strtoupper($acc);
    };
    ?>

    <!-- MASUK Section -->
    <div class="section-title">MASUK</div>
    <table class="detail-table">
        <thead>
        <tr>
            <th style="width:4%;">No</th>
            <th style="width:44%;">DESCRIPTION</th>
            <th style="width:16%;">Akun Pembayaran</th>
            <th style="width:16%;">Jumlah</th>
            <th style="width:10%;">RPA No</th>
            <th style="width:10%;">Invoice</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($incomeItems)): ?>
            <?php $no=1; foreach ($incomeItems as $item): 
                $desc = $item['description'] ?? '';
                $acc  = $item['payment_method'] ?? 'cash';
                $amt  = (float)($item['amount'] ?? 0);
                $rpa  = $item['rpa_no'] ?? '';
                $inv  = $item['invoice_no'] ?? '';
            ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-left"><?= htmlspecialchars($desc); ?></td>
                <td class="text-left"><?= htmlspecialchars($labelAcc($acc)); ?></td>
                <td class="text-right"><?= fmt($amt); ?></td>
                <td class="text-center"><?= htmlspecialchars($rpa); ?></td>
                <td class="text-center"><?= htmlspecialchars($inv); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">No income transactions</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Rekap MASUK per Akun -->
    <table class="detail-table">
        <thead>
        <tr>
            <th class="text-left">Akun</th>
            <th class="text-right" style="width:25%;">Total Masuk</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sumIncome = 0;
        foreach ($accounts as $alias):
            $val = (float)($incomeTotalsByAcc[$alias] ?? 0);
            $sumIncome += $val;
        ?>
            <tr>
                <td class="text-left"><?= htmlspecialchars(acc_name($alias, $bank_accounts)); ?></td>
                <td class="text-right"><?= fmt($val); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td class="text-center"><strong>TOTAL</strong></td>
            <td class="text-right"><strong><?= fmt($sumIncome); ?></strong></td>
        </tr>
        </tbody>
    </table>

    <!-- KELUAR Section -->
    <div class="section-title">KELUAR</div>
    <table class="detail-table">
        <thead>
        <tr>
            <th style="width:4%;">No</th>
            <th style="width:44%;">DESCRIPTION</th>
            <th style="width:16%;">Akun Pembayaran</th>
            <th style="width:16%;">Jumlah</th>
            <th style="width:10%;">RPA No</th>
            <th style="width:10%;">Invoice</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($expenseItems)): ?>
            <?php $no=1; foreach ($expenseItems as $item): 
                $desc = $item['description'] ?? '';
                $acc  = $item['payment_method'] ?? 'cash';
                $amt  = (float)($item['amount'] ?? 0);
                $rpa  = $item['rpa_no'] ?? '';
                $inv  = $item['invoice_no'] ?? '';
            ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-left"><?= htmlspecialchars($desc); ?></td>
                <td class="text-left"><?= htmlspecialchars($labelAcc($acc)); ?></td>
                <td class="text-right"><?= fmt($amt); ?></td>
                <td class="text-center"><?= htmlspecialchars($rpa); ?></td>
                <td class="text-center"><?= htmlspecialchars($inv); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">No expense transactions</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Rekap KELUAR per Akun -->
    <table class="detail-table">
        <thead>
        <tr>
            <th class="text-left">Akun</th>
            <th class="text-right" style="width:25%;">Total Keluar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sumExpense = 0;
        foreach ($accounts as $alias):
            $val = (float)($expenseTotalsByAcc[$alias] ?? 0);
            $sumExpense += $val;
        ?>
            <tr>
                <td class="text-left"><?= htmlspecialchars(acc_name($alias, $bank_accounts)); ?></td>
                <td class="text-right"><?= fmt($val); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td class="text-center"><strong>TOTAL</strong></td>
            <td class="text-right"><strong><?= fmt($sumExpense); ?></strong></td>
        </tr>
        </tbody>
    </table>
</div>

<script>
window.onload = function(){ document.body.focus(); };
document.addEventListener('keydown', function(e){
    if (e.ctrlKey && e.key === 'p') { e.preventDefault(); window.print(); }
});
</script>
</body>
</html>
