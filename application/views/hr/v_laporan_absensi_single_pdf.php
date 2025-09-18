<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style> /* ... (CSS Anda) ... */ </style>
</head>
<body>
    <h1>Detail Laporan Absensi</h1>
    <p>Tanggal Cetak: <?= date('d F Y'); ?></p>
    <hr>
    <h3>Informasi Karyawan</h3>
    <p>
        <strong>NIK:</strong> <?= $absensi['nik']; ?><br>
        <strong>Nama:</strong> <?= $absensi['nama']; ?><br>
        <strong>Posisi:</strong> <?= $absensi['position']; ?><br>
        <strong>Lokasi Kerja:</strong> <?= $absensi['work_location']; ?>
    </p>
    <h3>Detail Kehadiran</h3>
    <p>
        <strong>Tanggal:</strong> <?= date('d F Y', strtotime($absensi['tgl_masuk'])); ?><br>
        <strong>Status Kehadiran:</strong> <?= $absensi['kehadiran']; ?><br>
        <strong>Keterangan:</strong> <?= $absensi['keterangan']; ?><br>
        <strong>Status Laporan:</strong> <?= $absensi['status']; ?>
    </p>
</body>
</html>