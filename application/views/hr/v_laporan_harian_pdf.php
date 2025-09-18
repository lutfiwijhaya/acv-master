<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }

         /* === CSS BARU UNTUK KOTAK PERSETUJUAN === */
         .approval-box .signature {
        height: 40px; /* Tinggikan sedikit jika 40px tidak cukup */
        vertical-align: middle; /* Pusatkan gambar secara vertikal */
        padding: 2px; /* Beri sedikit padding agar gambar tidak terlalu mepet */
    }
    .approval-box .signature img {
        max-width: 100%; /* Gambar tidak akan melebihi lebar sel */
        max-height: 100%; /* Gambar tidak akan melebihi tinggi sel */
        height: auto; /* Pertahankan rasio aspek */
        display: block; /* Agar margin auto bekerja untuk centering horizontal */
        margin: 0 auto; /* Pusatkan gambar secara horizontal */
        object-fit: contain; /* Memastikan gambar sepenuhnya terlihat dalam sel tanpa terpotong */
    }
    .approval-box {
         /* Mengambang di atas konten lain */
        top: 10px; /* Jarak dari atas */
        right: 0; /* Rata kanan */
         width: 280px;
        border: 1px solid black;
        font-size: 10px;
        text-align: center;
          margin: 0 0 8px auto; /* dorong ke kanan */
  display: table;  
    }
    .approval-box th, .approval-box td {
        border: 1px solid black;
        padding: 5px;
    }
    
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 6px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .table tfoot td { font-weight: bold; background-color: #f9f9f9; }
        h1, h2 { text-align: center; margin: 5px 0; }
        h3 { margin-top: 25px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <?php
    // BAGIAN 1: Mengelompokkan dan Menghitung Data Absensi untuk laporan harian
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
    <h2>Tanggal: <?= $tanggal_laporan; ?></h2>
    <br>
<table class="approval-box" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Prepared</th>
            <th>Reviewed</th>
            <th>Reviewed 2</th>
            <th>Approved</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="signature">
            <?php if (!empty($approval_data['prepared_ttd'])): ?>
                <img src="<?= FCPATH . 'uploads/signatures/' . $approval_data['prepared_ttd'] ?>">
            <?php endif; ?>
        </td>
        <td class="signature">
            <?php if (!empty($approval_data['reviewed_ttd'])): ?>
                <img src="<?= FCPATH . 'uploads/signatures/' . $approval_data['reviewed_ttd'] ?>">
            <?php endif; ?>
        </td>
        <td class="signature">
            <?php if (!empty($approval_data['reviewed_2_ttd'])): ?>
                <img src="<?= FCPATH . 'uploads/signatures/' . $approval_data['reviewed_2_ttd'] ?>">
            <?php endif; ?>
        </td>
        <td class="signature">
            <?php if (!empty($approval_data['approved_ttd'])): ?>
                <img src="<?= FCPATH . 'uploads/signatures/' . $approval_data['approved_ttd'] ?>">
            <?php endif; ?>
        </td>
        </tr>
        <tr class="name-row">
            <td><?= $approval_data['prepared_by'] ?? ''; ?></td>
            <td><?= $approval_data['reviewed_by'] ?? ''; ?></td>
            <td><?= $approval_data['reviewed_2_by'] ?? ''; ?></td>
            <td><?= $approval_data['approved_by'] ?? ''; ?></td>
        </tr>
        <tr class="date-row">
            <td><?= $approval_data['prepared_at'] ?? ''; ?></td>
            <td><?= $approval_data['reviewed_at'] ?? ''; ?></td>
            <td><?= $approval_data['reviewed_2_at'] ?? ''; ?></td>
            <td><?= $approval_data['approved_at'] ?? ''; ?></td>
        </tr>
    </tbody>
</table>
    
    <br>
    <?php if (empty($groupedData)): ?>
        <p style="text-align:center;">Tidak ada data absensi untuk ditampilkan.</p>
    <?php else: ?>
        <h3>Rekapitulasi Berdasarkan Lokasi & Posisi</h3>
        <?php foreach ($groupedData as $location => $positions): ?>
            <h4 style="margin-bottom: 5px;">Lokasi Kerja: <?= htmlspecialchars($location); ?></h4>
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
        <h3>Detail Data Absensi Harian</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th> 
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Team</th>
                    <th>Lokasi Kerja</th>
                    <th>Kehadiran</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor_detail = 1; ?>
                <?php foreach ($absensi as $row): ?>
                    <tr>
                        <td><?= $nomor_detail++; ?></td> 
                        <td><?= htmlspecialchars($row['nik']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['position']); ?></td>
                        <td><?= htmlspecialchars($row['team']); ?></td>
                        <td><?= htmlspecialchars($row['work_location']); ?></td>
                        <td><?= htmlspecialchars($row['kehadiran']); ?></td>
                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>