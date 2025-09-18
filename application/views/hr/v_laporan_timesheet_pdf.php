<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style>
        body { font-family: sans-serif; font-size: 9px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 5px; }
        .table th { background-color: #f2f2f2; text-align: center; }
        h2, h3 { text-align: center; margin: 5px 0; }
    </style>
</head>
<body>
    <h2><?= $title; ?></h2>
    <h3>Tanggal: <?= $tanggal_laporan; ?></h3>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Masuk</th>
                <th>Istirahat Keluar</th>
                <th>Istirahat Masuk</th>
                <th>Pulang</th>
                <th>Keluar Lembur</th>
                <th>Masuk Lembur</th>
                <th>Pulang Lembur</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($timesheet)): $nomor = 1; ?>
                <?php foreach ($timesheet as $row): ?>
                    <tr>
                        <td style="text-align:center;"><?= $nomor++; ?></td>
                        <td><?= htmlspecialchars($row['nik']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['time_in']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['break_out']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['break_in']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['time_out']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['break_overtime_out']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['break_overtime_in']); ?></td>
                        <td style="text-align:center;"><?= htmlspecialchars($row['overtime_out']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" style="text-align:center;">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>