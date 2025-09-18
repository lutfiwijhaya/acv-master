<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    
    <title><?= isset($title) ? htmlspecialchars($title) : 'Daftar Kandidat' ?></title>
    <style>
        body {
            background-color: #f8f9fc;
     
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
            /* font-weight: bold; */
        }
        
        .btn-action {
            margin-right: 5px; /* Memberi sedikit jarak antar tombol */
        }
        .container-fluid {
          
            padding: 20px;
        }
     
       
       
        
        .dataTables_wrapper .dataTables_info {
            padding-top: 15px;
            font-weight: 500;
        }
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 10px;
        }
        /* Move the entries info to the bottom */
        .dataTables_wrapper .dataTables_length {
            float: left;
            margin-bottom: 15px;
        }
        .dataTables_wrapper .dataTables_filter {
            float: right;
            margin-bottom: 15px;
        }
        /* Create a footer area for the table */
        .table-footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #dee2e6;
        }
        
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-users me-2"></i>Daftar Kandidat</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
               <table id="candidateTable" class="table table-striped table-hover" style="width:100%;">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th style="white-space: nowrap;">Applying Occupation</th>
            <th style="white-space: nowrap;">Desired Salary</th>
            <th>Email</th>
            <th>KTP No.</th>
            <th>No. HP</th>
            <th style="white-space: nowrap;">Marital Status</th>
            <th>Sex</th>
            <th>Birthday</th>
            <th style="white-space: nowrap;">Place of Birth</th>
            <th style="white-space: nowrap;">Home Address</th>
            <th style="white-space: nowrap;">Current Address</th>
            <th style="white-space: nowrap;">NPWP No</th>
            <th style="white-space: nowrap;">BPJS No</th>
            <th style="white-space: nowrap;">Application Date</th>
            <th>Aksi</th> </tr>
    </thead>
    <tbody>
        <?php if (!empty($candidates)): ?>
            <?php $no = 1; ?>
            <?php foreach ($candidates as $candidate): ?>
                <tr data-id="<?= $candidate['_id'] ?>">
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($candidate['nama']); ?></td>
                    <td><?= htmlspecialchars($candidate['applying_occupation']); ?></td>
                    <td style="white-space: nowrap;">Rp. <?= number_format($candidate['desired_salary'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($candidate['email']); ?></td>
                    <td><?= htmlspecialchars($candidate['nik']); ?></td>
                    <td><?= htmlspecialchars($candidate['no_hp']); ?></td>
                    <td><?= htmlspecialchars($candidate['marital']); ?></td>
                    <td><?= htmlspecialchars($candidate['jk']); ?></td>
                    <td style="white-space: nowrap;"><?= !empty($candidate['tgl_lahir']) ? date('d-m-Y', strtotime($candidate['tgl_lahir'])) : '-'; ?></td>
                    <td><?= htmlspecialchars($candidate['tempat_lahir']); ?></td>
                    <td class="truncate" title="<?= htmlspecialchars($candidate['alamat']); ?>"><?= htmlspecialchars($candidate['alamat']); ?></td>
                    <td class="truncate" title="<?= htmlspecialchars($candidate['current_address']); ?>"><?= htmlspecialchars($candidate['current_address']); ?></td>
                    <td><?= !empty($candidate['npwp']) ? htmlspecialchars($candidate['npwp']) : '-'; ?></td>
                    <td><?= !empty($candidate['bpjs_kt']) ? htmlspecialchars($candidate['bpjs_kt']) : '-'; ?></td>
                    <td style="white-space: nowrap;"><?= date('d F Y', strtotime($candidate['created_at'])); ?></td>
                    <td style="white-space: nowrap;">
                        <a href="<?= site_url('hr/view_candidate/' . $candidate['_id']); ?>" class="btn btn-info btn-sm btn-action" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        <?php if (!empty($candidate['path_foto'])): ?>
                            <button type="button" class="btn btn-secondary btn-sm btn-action" title="Lihat Foto" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#photoModal" 
                                    data-name="<?= htmlspecialchars($candidate['nama']); ?>"
                                    data-photo-url="<?= base_url('uploads/hr_file/' . $candidate['path_foto']); ?>">
                                <i class="fas fa-camera"></i>
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="photoModalLabel">Foto Kandidat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="candidatePhoto" class="img-fluid" alt="Foto Kandidat" style="max-height: 400px; border-radius: 5px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/Silvacom/jquery.dataTables.colResize@master/dist/jquery.dataTables.colResize.js"></script>


<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    $('#candidateTable').DataTable({
        scrollY: '60vh',
        scrollX: true,
        scrollCollapse: true,
        paging: true
    });

    // --- LOGIKA UNTUK PEMILIHAN BARIS ---
    $('#candidateTable tbody').on('click', 'tr', function () {
        // ... Logika JavaScript Anda untuk memilih baris ...
    });
    

    // =============================================== -->
    //     SCRIPT UNTUK MENGATUR MODAL FOTO            -->
    // =============================================== -->
    var photoModal = document.getElementById('photoModal');
    photoModal.addEventListener('show.bs.modal', function (event) {
        // Tombol yang memicu modal
        var button = event.relatedTarget; 

        // Ambil data dari atribut data-* pada tombol
        var candidateName = button.getAttribute('data-name');
        var photoUrl = button.getAttribute('data-photo-url');

        // Cari elemen di dalam modal lalu update isinya
        var modalTitle = photoModal.querySelector('.modal-title');
        var candidatePhoto = photoModal.querySelector('#candidatePhoto');

        modalTitle.textContent = 'Foto: ' + candidateName;
        candidatePhoto.src = photoUrl;
    });
});
</script>

</body>
</html>