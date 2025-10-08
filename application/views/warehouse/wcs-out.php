<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>WAREHOUSE</title>
    <style>
        body {
            min-height: 100vh;
            font-size: 0.75rem;
            /* Reduced font size */
        }

        .card {
            border: none;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 5px;
            /* Reduced margin */
        }

        .btn-primary {
            background: #1cc88a;
            border: none;
        }

        .btn-primary:hover {
            background: #17a673;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 2px;
            /* Reduced padding */
            vertical-align: middle;
            white-space: nowrap;
            /* Prevent text wrapping */
        }

        .photo-placeholder {
            width: 100%;
            height: 200px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 15px;
            /* Reduced margin */
        }

        .photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #photo-preview {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        #photo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .upload-photo-btn {
            width: 100%;
            text-align: center;
            padding: 1px;
            /* Reduced padding */
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2px;
            /* Reduced gap */
            font-size: 0.65rem;
            /* Reduced font size */
        }

        .upload-photo-btn:hover {
            background-color: #e9ecef;
        }

        .section-title {
            background-color: #f8f9fa;
            padding: 3px;
            /* Reduced padding */
            margin-bottom: 3px;
            /* Reduced margin */
            font-weight: bold;
            border-left: 3px solid #1cc88a;
            font-size: 0.75rem;
            /* Reduced font size */
        }

        .form-control,
        .form-select {
            padding: 0.15rem 0.25rem;
            /* Reduced padding */
            font-size: 0.7rem;
            /* Reduced font size */
            min-height: 22px;
            /* Reduced height */
            height: calc(1.4em + 0.3rem + 2px);
            /* Reduced height */
        }

        .card-header {
            padding: 0.25rem 0.4rem;
            /* Reduced padding */
        }

        .card-body {
            padding: 0.25rem;
            /* Reduced padding */
        }

        .mb-4 {
            margin-bottom: 0.4rem !important;
            /* Reduced margin */
        }

        .mb-3 {
            margin-bottom: 0.25rem !important;
            /* Reduced margin */
        }

        .mb-2 {
            margin-bottom: 0.15rem !important;
            /* Reduced margin */
        }

        .mt-2 {
            margin-top: 0.15rem !important;
            /* Reduced margin */
        }

        .mt-3 {
            margin-top: 0.25rem !important;
            /* Reduced margin */
        }

        textarea.form-control {
            min-height: 35px;
            /* Reduced height */
            padding-bottom: 15px;
            /* Space for checkbox */
        }

        .table>:not(caption)>*>* {
            padding: 0.15rem;
            /* Reduced padding */
        }

        .btn {
            padding: 0.1rem 0.25rem;
            /* Reduced padding */
            font-size: 0.65rem;
            /* Reduced font size */
        }

        .btn-lg {
            padding: 0.2rem 0.4rem;
            /* Reduced padding */
            font-size: 0.75rem;
            /* Reduced font size */
        }

        .mt-5,
        .mb-5 {
            margin: 0.5rem 0 !important;
            /* Reduced margin */
        }

        .row {
            margin-right: -2px;
            margin-left: -2px;
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            padding-right: 2px;
            padding-left: 2px;
        }

        .form-check {
            min-height: 0.9rem;
            margin-bottom: 0;
        }

        .form-check-input {
            width: 0.7em;
            height: 0.7em;
            margin-top: 0.15em;
        }

        .form-check-label {
            font-size: 0.65rem;
            /* Reduced font size */
        }

        .input-group-text {
            padding: 0.15rem 0.25rem;
            /* Reduced padding */
            font-size: 0.7rem;
            /* Reduced font size */
            height: calc(1.4em + 0.3rem + 2px);
            /* Reduced height */
        }

        .table-responsive {
            margin-bottom: 0;
        }

        .fas {
            font-size: 0.75em;
        }

        #photo-preview .fas {
            font-size: 2em;
        }

        #photo-preview p {
            font-size: 0.65rem;
            /* Reduced font size */
            margin-bottom: 0;
        }

        .card-header h4 {
            font-size: 0.8rem;
            /* Reduced font size */
            margin-bottom: 0;
        }

        .table th {
            font-size: 0.7rem;
            /* Reduced font size */
            font-weight: 600;
        }

        .table td {
            font-size: 0.7rem;
            /* Reduced font size */
        }

        .table thead th {
            padding: 1px;
            /* Reduced padding */
        }

        /* Reduce the height of the motivation reason textarea */
        #motivation_reason {
            min-height: 60px;
            /* Reduced height */
        }

        /* Make the card headers more compact */
        .card-header.section-title {
            padding: 2px 5px;
            /* Reduced padding */
        }

        /* Reduce the height of the form header */
        .card-header.text-dark.text-center {
            padding: 2px !important;
            /* Reduced padding */
        }

        /* Reduce the size of the logo */
        .card-header img {
            height: 18px !important;
            /* Reduced height */
        }

        /* Reduce the spacing between sections */
        .card.mb-4 {
            margin-bottom: 0.3rem !important;
            /* Reduced margin */
        }

        /* Reduce the spacing for the "Add More" buttons */
        .d-grid.gap-2.d-md-flex.justify-content-md-end.mt-2 {
            margin-top: 0.1rem !important;
            /* Reduced margin */
        }

        /* Make the table headers more compact */
        .table-light th {
            padding: 1px !important;
            /* Reduced padding */
        }

        /* Reduce the height of date inputs */
        input[type="date"],
        input[type="month"] {
            height: calc(1.4em + 0.3rem + 2px);
            /* Reduced height */
        }

        /* Reduce the overall page margins */
        .mt-3.mb-3 {
            margin-top: 0.25rem !important;
            margin-bottom: 0.25rem !important;
        }

        /* Make the card body padding even smaller */
        .card-body.p-3 {
            padding: 0.2rem !important;
            /* Reduced padding */
        }

        /* Reduce the height of the submit button area */
        .d-grid.gap-2.d-md-flex.justify-content-md-end.mt-3 {
            margin-top: 0.2rem !important;
            /* Reduced margin */
        }

        /* Mobile responsive improvements */
        @media (max-width: 767.98px) {
            body {
                font-size: 0.7rem;
            }

            .container,
            .container-fluid {
                padding-right: 5px;
                padding-left: 5px;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive table {
                width: 100% !important;
            }

            .table-responsive th,
            .table-responsive td {
                min-width: 80px;
                /* Ensure minimum width for cells */
            }

            /* Adjust photo placeholder for mobile */
            /* .photo-placeholder {
            height: 80px;
        } */

            /* Make form controls slightly larger for touch */
            .form-control,
            .form-select,
            .btn {
                font-size: 0.75rem;
                min-height: 28px;
            }

            /* Improve table scrolling experience */
            .table-responsive::-webkit-scrollbar {
                height: 4px;
            }

            .table-responsive::-webkit-scrollbar-thumb {
                background-color: rgba(0, 0, 0, .2);
                border-radius: 2px;
            }

            /* Fix photo preview on mobile */
            #photo-preview img {
                max-height: 80px;
            }

            /* Make sure buttons are large enough to tap */
            .btn {
                padding: 0.25rem 0.5rem;
                min-height: 30px;
            }

            /* Improve spacing for the "Same as Home" checkbox */
            .form-check-label {
                font-size: 0.7rem;
            }

            /* Ensure table headers are visible */
            .table thead th {
                position: sticky;
                top: 0;
                background-color: #f8f9fa;
                z-index: 1;
            }
        }
    </style>
</head>

<body>
    <div class="mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header text-dark text-center d-flex justify-content-center align-items-center">
                        <img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="Logo"
                            style="height: 18px; margin-right: 8px;">
                        <h4 class="mb-0">
                            WAREHOUSE CONTROL SHEET OUT
                        </h4>
                    </div>
                    <div class="card-body p-3">
                        <?php
                        // Tentukan URL action berdasarkan mode (tambah baru atau edit)
                        $action_url = isset($is_edit)
                            ? site_url('hr/update_candidate/' . $candidate['_id'])
                            : site_url('hr/submit_application');
                        ?>
                        <form id="form-user" action="<?= $action_url ?>" method="POST" enctype="multipart/form-data">




                            <!-- Request Information -->
<div class="card mb-4">
    <div class="card-header section-title">1. REQUEST INFORMATION</div>
    <div class="card-body p-3">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th style="width: 25%">Request Number</th>
                        <td style="width: 45%">
                            <input type="text" class="form-control" id="request_number" name="request_number"
                                value="<?= isset($request['request_number']) ? $request['request_number'] : '' ?>"
                                required>
                        </td>
                        <th style="width: 10%">Incharge</th>
                        <td style="width: 20%">
                            <input type="text" class="form-control" id="incharge" name="incharge"
                                value="<?= isset($request['incharge']) ? $request['incharge'] : '' ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Position Incharge</th>
                        <td>
                            <input type="text" class="form-control" id="position_incharge" name="position_incharge"
                                value="<?= isset($request['position_incharge']) ? $request['position_incharge'] : '' ?>"
                                required>
                        </td>
                        <th>Category</th>
                        <td>
                            <select class="form-select" id="request_category" name="request_category" required>
                                <option value="">Select Category</option>
                                <option value="Consumable"
                                    <?= (isset($request['request_category']) && $request['request_category'] == 'Consumable') ? 'selected' : '' ?>>
                                    Consumable
                                </option>
                                <option value="Asset"
                                    <?= (isset($request['request_category']) && $request['request_category'] == 'Asset') ? 'selected' : '' ?>>
                                    Asset
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Request Date</th>
                        <td>
                            <input type="date" class="form-control" id="request_date" name="request_date"
                                value="<?= htmlspecialchars($request['request_date'] ?? '') ?>" required>
                        </td>
                        <th>For Date</th>
                        <td>
                            <input type="date" class="form-control" id="for_date" name="for_date"
                                value="<?= htmlspecialchars($request['for_date'] ?? '') ?>" required>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Requested Items -->
<div class="card mb-4">
    <div class="card-header section-title">2. REQUESTED ITEMS</div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-bordered mb-0" id="request-items-table">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%; white-space: nowrap;">No</th>
                        <th style="width: 15%; white-space: nowrap;">Item Code</th>
                        <th style="width: 15%; white-space: nowrap;">Category</th>
                        <th style="width: 13%; white-space: nowrap;">Level 1</th>
                        <th style="width: 13%; white-space: nowrap;">Level 2</th>
                        <th style="width: 13%; white-space: nowrap;">Level 3</th>
                        <th style="width: 13%; white-space: nowrap;">Level 4</th>
                    </tr>
                </thead>
                <tbody id="request-items-body">
                    <?php
                    $existing_items = isset($request_items) ? $request_items : [];
                    $row_count = max(1, count($existing_items));
                    ?>

                    <?php for ($i = 0; $i < $row_count; $i++): ?>
                        <?php $item = $existing_items[$i] ?? null; ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <input type="text" class="form-control" name="item_code[]"
                                    value="<?= htmlspecialchars($item['item_code'] ?? '') ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="category[]"
                                    value="<?= htmlspecialchars($item['category'] ?? '') ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="level1[]"
                                    value="<?= htmlspecialchars($item['level1'] ?? '') ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="level2[]"
                                    value="<?= htmlspecialchars($item['level2'] ?? '') ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="level3[]"
                                    value="<?= htmlspecialchars($item['level3'] ?? '') ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="level4[]"
                                    value="<?= htmlspecialchars($item['level4'] ?? '') ?>">
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                <button type="button" class="btn btn-outline-primary btn-sm" id="add-request-item-row">
                    <i class="fas fa-plus"></i> Add More Item
                </button>
            </div>
        </div>
    </div>
</div>



                            <!-- Submit Button -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <button type="reset" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="button" class="btn btn-primary" onclick="submitFormUser()">
                                    <i class="fas fa-paper-plane"></i> Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function submitFormUser() {
            // Ambil form
            var form = document.getElementById('form-user'); // Pastikan form Anda punya id="form-user"
            var formData = new FormData(form);

            // tampilan buat loading
            Swal.fire({
                title: 'Processing...',
                text: 'Saving data and sending notification, please wait.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            //end buat loading

            // Kirim data menggunakan AJAX
            $.ajax({
                url: form.action, // URL diambil dari atribut 'action' form
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.success) {
                        // Jika sukses, kembali ke halaman daftar
                        window.location.href = "<?= site_url('hr/listcandidate') ?>";
                    } else {
                        // Tutup loading lalu tampilkan error
                        Swal.close();
                        alert('Error: ' + (result.errorMsg || result.message));
                    }
                },
                error: function() {
                    // Tutup loading lalu tampilkan error
                    Swal.close();
                    alert('An unexpected error occurred.');
                }
            });
        }
        //
        // api wilayah id
        const savedPlaceOfBirth =
            "<?= isset($candidate['tempat_lahir']) ? htmlspecialchars($candidate['tempat_lahir']) : '' ?>";

        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                const placeOfBirthSelect = document.getElementById('place_of_birth');
                placeOfBirthSelect.innerHTML = '<option value="">Select Province</option>'; // Kosongkan dulu

                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.name;
                    option.textContent = province.name;

                    // --- TAMBAHKAN LOGIKA INI ---
                    if (province.name === savedPlaceOfBirth) {
                        option.selected = true;
                    }
                    // --- AKHIR LOGIKA BARU ---

                    placeOfBirthSelect.appendChild(option);
                });
            })
            .catch(error => console.log('Error fetching provinces:', error));

        document.getElementById('place_of_birth').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const selectedProvince = selectedOption.textContent;

            document.getElementById('tempat_lahir').value = selectedProvince;
        });
        //end api

        // Fungsi untuk menghitung durasi antara dua tanggal
        const careerTableBody = document.getElementById('career-table-body');

        // Fungsi untuk menghitung durasi PADA SATU BARIS
        function calculateRowDuration(row) {
            const startDateInput = row.querySelector('.period-start');
            const endDateInput = row.querySelector('.period-end');
            const durationInput = row.querySelector('.career-duration');

            // Pastikan semua elemen ada sebelum melanjutkan
            if (!startDateInput || !endDateInput || !durationInput) return;

            const startValue = startDateInput.value;
            const endValue = endDateInput.value;

            if (startValue && endValue) {
                const startDate = new Date(startValue + '-01');
                const endDate = new Date(endValue + '-01');

                if (endDate >= startDate) {
                    let months = (endDate.getFullYear() - startDate.getFullYear()) * 12;
                    months -= startDate.getMonth();
                    months += endDate.getMonth();

                    const totalMonths = months < 0 ? 0 : months + 1;

                    const years = Math.floor(totalMonths / 12);
                    const remainingMonths = totalMonths % 12;

                    durationInput.value = `${years} years, ${remainingMonths} months`;
                } else {
                    durationInput.value = '';
                }
            } else {
                durationInput.value = '';
            }
        }

        // Pasang SATU event listener di parent (tbody)
        careerTableBody.addEventListener('change', function(event) {
            // Cek apakah yang diubah adalah input tanggal
            if (event.target.classList.contains('period-start') || event.target.classList.contains('period-end')) {
                // Temukan baris (tr) dari input yang diubah, lalu hitung durasinya
                const row = event.target.closest('tr');
                calculateRowDuration(row);
            }
        });
        //end untuk perhitung durasi

        // Panggil fungsi ini setiap kali baris baru ditambahkan
        document.getElementById('add-career-row').addEventListener('click', function() {
            var tbody = document.getElementById('career-table-body');
            var newRow = tbody.insertRow(); // Langsung insert ke tbody
            // ... (kode Anda untuk insertCell)
            // Pastikan input-input yang baru dibuat juga memiliki class yang sama
            cell3.innerHTML = '<input type="month" class="form-control period-start" name="period_star[]">';
            cell4.innerHTML = '<input type="month" class="form-control period-end" name="period_end[]">';
            cell5.innerHTML = '<input type="text" class="form-control career-duration" name="career[]" readonly>';
            // ...

            // Panggil kembali fungsi kalkulasi untuk baris baru
            calculateDuration();
        });
        //

        document.querySelectorAll('#career-table-body tr').forEach(calculateRowDuration);

        //
        function previewPhoto(input) {
            const preview = document.getElementById('photo-preview');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Buat image element untuk deteksi orientasi
                    const img = new Image();
                    img.onload = function() {
                        const aspectRatio = this.width / this.height;
                        let orientationClass = '';
                        let imgStyle = '';

                        // Deteksi orientasi foto
                        if (aspectRatio > 1.3) {
                            // Landscape
                            orientationClass = 'landscape';
                            imgStyle = 'width: 100%; height: auto; object-fit: cover; max-height: 100%;';
                        } else if (aspectRatio < 0.8) {
                            // Portrait
                            orientationClass = 'portrait';
                            imgStyle = 'width: auto; height: 100%; max-width: 100%; object-fit: contain;';
                        } else {
                            // Square-ish
                            orientationClass = 'square';
                            imgStyle = 'width: 100%; height: 100%; object-fit: cover;';
                        }

                        // Update preview dengan style yang sesuai
                        preview.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Photo Preview" 
                         class="${orientationClass}"
                         style="${imgStyle} border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                `;
                    };
                    img.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        function previewPhotoContain(input) {
            const preview = document.getElementById('photo-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = `
                <img src="${e.target.result}" 
                     alt="Photo Preview" 
                     style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            `;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Function untuk auto-resize container berdasarkan foto
        function previewPhotoAdaptive(input) {
            const preview = document.getElementById('photo-preview');
            const container = preview.closest('.photo-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const aspectRatio = this.width / this.height;

                        // Sesuaikan tinggi container untuk portrait
                        if (aspectRatio < 0.8) {
                            container.style.height = '280px'; // Lebih tinggi untuk portrait
                        } else {
                            container.style.height = '200px'; // Normal untuk landscape/square
                        }

                        preview.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Photo Preview" 
                         style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; border-radius: 6px;">
                `;
                    };
                    img.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Event listener untuk click pada preview (optional)
        document.addEventListener('DOMContentLoaded', function() {
            const photoPreview = document.getElementById('photo-preview');
            if (photoPreview) {
                photoPreview.addEventListener('click', function() {
                    document.getElementById('photo').click();
                });
            }
        });

        function copyAddress() {
            var sameAddressCheckbox = document.getElementById('same_address');
            var homeAddress = document.getElementById('alamat');
            var currentAddress = document.getElementById('current_address');

            if (sameAddressCheckbox.checked) {
                currentAddress.value = homeAddress.value;
                currentAddress.style.paddingBottom = '20px'; // Add padding to avoid text overlapping with checkbox
            } else {
                currentAddress.style.paddingBottom = ''; // Reset padding
                // Don't clear the value when unchecked to improve user experience
            }
        }


        document.getElementById('add-education-row').addEventListener('click', function() {
            var tbody = document.getElementById('education-table-body');
            var newRow = tbody.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = '<input type="date" class="form-control" name="graduation[]">';
            cell2.innerHTML = '<input type="text" class="form-control" name="registered_school_name[]">';
            cell3.innerHTML = '<input type="text" class="form-control" name="location[]">';
            cell4.innerHTML = '<input type="text" class="form-control" name="jurusan[]">';
        });
        //

        //
        document.getElementById('add-certificate-row').addEventListener('click', function() {
            var table = document.getElementById('certificate-table').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            cell1.innerHTML = '<input type="date" class="form-control" name="acquisition[]">';
            cell2.innerHTML = '<input type="text" class="form-control" name="certificate[]">';
            cell3.innerHTML = '<input type="text" class="form-control" name="authority[]">';
            cell4.innerHTML = '<input type="text" class="form-control" name="issue_location[]">';
            cell5.innerHTML = '<input type="text" class="form-control" name="certificate_no[]">';
        });

        document.getElementById('add-career-row').addEventListener('click', function() {
            var table = document.getElementById('career-table').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            cell1.innerHTML = '<input type="text" class="form-control" name="company_name[]">';
            cell2.innerHTML = '<input type="text" class="form-control" name="position[]">';
            cell3.innerHTML =
                '<input type="month" class="form-control" name="period_star[]">';
            cell4.innerHTML =
                '<input type="month" class="form-control" name="period_end[]">';
            cell5.innerHTML = '<input type="text" class="form-control" name="career[]">';

        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('swal_icon')): ?>
                Toast.fire({
                    icon: '<?php echo $this->session->flashdata('swal_icon'); ?>',
                    title: '<?php echo $this->session->flashdata('swal_text'); ?>'
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>