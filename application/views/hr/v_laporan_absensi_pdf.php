<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 6px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .table tfoot td { font-weight: bold; background-color: #f9f9f9; }
        h1 { text-align: center; margin-bottom: 0; }
        h2 { margin-top: 25px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .print-info { text-align: center; margin-top: 5px; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <?php
    // BAGIAN 1: Mengelompokkan dan Menghitung Data Absensi
    $groupedData = [];
    if (!empty($absensi)) {
        foreach ($absensi as $row) {
            $location = $row['work_location'] ?: 'Uncategorized';
            $position = $row['position'] ?: 'Unassigned';
            if (!isset($groupedData[$location])) { $groupedData[$location] = []; }
            if (!isset($groupedData[$location][$position])) { $groupedData[$location][$position] = ['masuk' => 0, 'tidak_masuk' => 0]; }
            if (strtolower($row['kehadiran']) == 'hadir') {
                $groupedData[$location][$position]['masuk']++;
            } else {
                $groupedData[$location][$position]['tidak_masuk']++;
            }
        }
    }
    ?>

    <h1><?= $title; ?></h1>
    <p class="print-info">Tanggal Cetak: <?= date('d F Y H:i:s'); ?></p>

    <?php if (empty($groupedData)): ?>
        <p style="text-align:center;">Tidak ada data absensi untuk ditampilkan.</p>
    <?php else: ?>
        <?php foreach ($groupedData as $location => $positions): ?>
            <h2>Rekapitulasi Lokasi Kerja: <?= htmlspecialchars($location); ?></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:5%;">No.</th>
                        <th>Posisi</th>
                        <th style="width:20%;">Jumlah Hadir</th>
                        <th style="width:20%;">Jumlah Tidak Hadir</th>
                        <th style="width:20%;">Total Karyawan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    $totalHadirPerLokasi = 0;
                    $totalTidakHadirPerLokasi = 0;
                    ksort($positions);
                    foreach ($positions as $position => $summary):
                        $totalKaryawanPerPosisi = $summary['masuk'] + $summary['tidak_masuk'];
                        $totalHadirPerLokasi += $summary['masuk'];
                        $totalTidakHadirPerLokasi += $summary['tidak_masuk'];
                    ?>
                        <tr>
                            <td><?= $nomor++; ?></td>
                            <td><?= htmlspecialchars($position); ?></td>
                            <td><?= $summary['masuk']; ?></td>
                            <td><?= $summary['tidak_masuk']; ?></td>
                            <td><?= $totalKaryawanPerPosisi; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align:right;">Total <?= htmlspecialchars($location); ?></td>
                        <td><?= $totalHadirPerLokasi; ?></td>
                        <td><?= $totalTidakHadirPerLokasi; ?></td>
                        <td><?= $totalHadirPerLokasi + $totalTidakHadirPerLokasi; ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php endforeach; ?>

        <div class="page-break"></div>
        <h2>Detail Data Absensi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th> 
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Posisi</th>
                    <th>Team</th>
                    <th>Lokasi Kerja</th>
                    <th>Keterangan</th>
                    <th>Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor_detail = 1; ?>
                <?php foreach ($absensi as $row): ?>
                    <tr>
                        <td><?= $nomor_detail++; ?></td> 
                        <td><?= htmlspecialchars($row['nik']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['tgl_masuk']); ?></td>
                        <td><?= htmlspecialchars($row['position']); ?></td>
                        <td><?= htmlspecialchars($row['team']); ?></td>
                        <td><?= htmlspecialchars($row['work_location']); ?></td>
                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                        <td><?= htmlspecialchars($row['kehadiran']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>