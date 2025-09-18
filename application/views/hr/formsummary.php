<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Form Summary' ?></title>
    <style>
    /* Compact base styles */
    body {
        font-size: 0.75rem;
        line-height: 1.2;
    }
    
    .image-upload-container {
        position: relative;
        cursor: pointer;
        display: inline-block;
        overflow: hidden; /* Penting untuk border-radius jika ada */
    }
    .image-upload-container .border {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 0.8rem;
        color: #6c757d;
        background-color: #f8f9fa;
    }
    .image-upload-container .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .3s ease;
        background-color: rgba(0,0,0,0.5);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 0.8rem;
        text-align: center;
    }
    .image-upload-container:hover .overlay {
        opacity: 1;
    }

    /* Compact table styles */
    .table-bordered td,
    .table-bordered th {
        vertical-align: middle;
        font-size: 0.75rem;
        padding: 0.25rem 0.3rem;
        line-height: 1.1;
    }

    /* Compact form controls */
    .form-control, .form-select {
        font-size: 0.75rem;
        padding: 0.15rem 0.25rem;
        min-height: 24px;
        height: auto;
    }
    
    .form-control-sm, .form-select-sm {
        font-size: 0.7rem;
        padding: 0.1rem 0.2rem;
        min-height: 22px;
        height: auto;
    }
    
    /* Reduce card padding */
    .card {
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        margin-bottom: 0.5rem;
    }

    .card-header {
        padding: 0.3rem 0.5rem;
        border-radius: 6px 6px 0 0 !important;
    }

    .card-body {
        padding: 0.5rem !important;
    }

    /* Compact tables */
    .table {
        margin-bottom: 0.3rem;
    }
    
    /* Reduce spacing between tables */
    .mt-4 {
        margin-top: 0.5rem !important;
    }
    
    .mt-3 {
        margin-top: 0.3rem !important;
    }
    
    .mt-2 {
        margin-top: 0.2rem !important;
    }
    
    .mt-1 {
        margin-top: 0.1rem !important;
    }
    
    /* Compact container */
    .container {
        max-width: 100% !important;
        padding-left: 5px;
        padding-right: 5px;
    }
    
    /* Compact input groups */
    .input-group-sm>.form-control,
    .input-group-sm>.input-group-text {
        padding: 0.1rem 0.2rem;
        font-size: 0.7rem;
        min-height: 22px;
    }
    
    /* Compact inline form elements */
    .d-inline-block {
        margin-right: 0.1rem;
    }
    
    /* Compact file inputs */
    input[type="file"].form-control {
        padding: 0.1rem 0.2rem;
        font-size: 0.7rem;
    }
    
    /* Compact links */
    a.text-success.small {
        padding: 0;
        margin: 0;
        line-height: 1;
        font-size: 0.7rem;
    }
    
    /* Compact buttons */
    .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    /* Compact headings */
    h4 {
        font-size: 1rem;
        margin-bottom: 0;
    }
    
    /* Compact textareas */
    textarea.form-control {
        min-height: 60px;
    }
    
    /* Reduce table cell spacing */
    .table>:not(caption)>*>* {
        padding: 0.25rem 0.3rem;
    }
    
    /* Compact form groups */
    .mb-3 {
        margin-bottom: 0.3rem !important;
    }
    
    /* Compact badges and labels */
    .badge {
        padding: 0.2em 0.4em;
        font-size: 0.7em;
    }
    
    /* Compact select elements */
    select.form-select {
        padding-right: 1.5rem;
    }
    
    /* Compact SweetAlert */
    .swal2-popup {
        font-size: 0.75rem !important;
        padding: 0.5em !important;
    }
    
    .swal2-title {
        font-size: 1em !important;
        padding: 0.5em 1em 0 !important;
    }
    
    .swal2-content {
        font-size: 0.9em !important;
        padding: 0 1em !important;
    }
    
    .swal2-actions {
        margin: 0.5em auto 0 !important;
    }
    
    /* Compact icons */
    .fas, .fa {
        font-size: 0.8rem;
    }
    
    /* Compact table headers */
    th {
        font-weight: 600;
        white-space: nowrap;
    }
    
    /* Reduce spacing between form rows */
    .row {
        margin-right: -5px;
        margin-left: -5px;
    }
    
    .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, 
    .col-sm, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
    .col-md, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        padding-right: 5px;
        padding-left: 5px;
    }
    </style>
</head>

<body>
    <div class="container mt-2 mb-2">
        <div class="card">
            <div class="card-header text-center text-dark d-flex justify-content-center align-items-center py-1">
                <img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="Logo"
                    style="height: 20px; margin-right: 8px;">
                <h4 class="mb-0">SUMMARY STATUS – EMPLOYEE</h4>
            </div>
            <div class="card-body p-2">
                <!-- tabel masuk -->
                <form action="<?= site_url('hr/submit_summary'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?= $candidate['_id'] ?>">
                    <input type="hidden" name="academic_id"
                        value="<?= isset($last_education) ? $last_education['id'] : '' ?>">

                
                    <!-- tabel masuk -->
                    <table class="table table-bordered mt-4">
    <tr>
        <th colspan="4" class="fw-bold bg-light">A. CANDIDATE INFORMATION</th>
        <td colspan="2" class="bg-light">
            (Religion:
            <input type="text" class="form-control form-control-sm d-inline-block" name="religion"
                   style="width: 70%;" value="<?= htmlspecialchars($candidate['religion'] ?? '') ?>">)
        </td>
    </tr>

    <tr>
        <td colspan="4" class="p-2">
            <table class="table table-borderless mb-0">
                <tr>
                    <td style="width:25%;">Name</td>
                    <td style="width:75%;"><b><?= htmlspecialchars($candidate['nama']) ?></b> (<?= $candidate['jk'] == 'L' ? 'Male' : 'Female' ?>)</td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td><b><?= date('d F Y', strtotime($candidate['tgl_lahir'])) ?></b>
                        (Age:
                        <input type="number" class="form-control form-control-sm d-inline-block" name="summary_age_years" style="width: 60px;"> years
                        <input type="number" class="form-control form-control-sm d-inline-block" name="summary_age_months" style="width: 60px;"> months)
                    </td>
                </tr>
                 <tr>
                    <td>KTP No.</td>
                    <td><b><?= htmlspecialchars($candidate['nik']) ?></b></td>
                </tr>
                <tr>
                    <td>Last Education</td>
                    <td>
                        Name: <input type="text" class="form-control form-control-sm" name="summary_education_name" value="<?= isset($last_education) ? htmlspecialchars($last_education['registered_school_name']) : '' ?>"><br>
                        Location: <input type="text" class="form-control form-control-sm mt-1" name="summary_education_location" value="<?= isset($last_education) ? htmlspecialchars($last_education['location']) : '' ?>">
                    </td>
                </tr>
                 <tr>
                    <td>Mobile No.</td>
                    <td><b><?= htmlspecialchars($candidate['no_hp']) ?></b></td>
                </tr>
                 <tr>
                    <td>Expected Salary</td>
                    <td>
                        IDR <input type="number" class="form-control form-control-sm d-inline-block" name="summary_expected_salary" style="width: 80%;" value="<?= $candidate['desired_salary'] ?>">
                    </td>
                </tr>
            </table>
        </td>
       <td class="text-center align-middle p-2">
    <div id="photo-upload-container" class="image-upload-container">
        <img id="photo-preview" src="<?= !empty($candidate['path_foto']) ? base_url('uploads/hr_file/' . $candidate['path_foto']) : '' ?>" alt="Photo Preview" class="border" style="width: 120px; height: 150px; object-fit: cover; <?= empty($candidate['path_foto']) ? 'display:none;' : '' ?>">
        <div id="photo-placeholder" class="border" style="width: 120px; height: 150px; display: <?= empty($candidate['path_foto']) ? 'flex;' : 'none;' ?>;">
            <span>Photo</span>
        </div>
        <div class="overlay">
            <i class="fas fa-camera"></i><br>
            Change Photo
        </div>
    </div>
    <input type="file" class="form-control" name="photo" id="photo-input" accept="image/*" style="display: none;">
</td>
<td class="text-center align-middle p-2">
    <div id="signature-upload-container" class="image-upload-container">
        <img id="signature-preview" src="<?= !empty($candidate['path_ttd']) ? base_url('uploads/signatures/' . $candidate['path_ttd']) : '' ?>" alt="Signature Preview" class="border" style="width: 120px; height: 80px; object-fit: contain; <?= empty($candidate['path_ttd']) ? 'display:none;' : '' ?>">
        <div id="signature-placeholder" class="border" style="width: 120px; height: 80px; display: <?= empty($candidate['path_ttd']) ? 'flex;' : 'none;' ?>;">
            <span>Signature</span>
        </div>
        <div class="overlay">
            <i class="fas fa-edit"></i><br>
            Change
        </div>
    </div>
    <input type="file" class="form-control" name="signature" id="signature-input" accept="image/*" style="display: none;">
</td>
    </tr>
    
    <tr>
        <td>Discipline</td>
        <td colspan="2">
            <input type="text" class="form-control form-control-sm" name="summary_discipline" value="<?= htmlspecialchars($candidate['summary_discipline'] ?? '') ?>">
        </td>
        <td>Marriage Status</td>
        <td colspan="2"><b><?= htmlspecialchars($candidate['marital']) ?></b></td>
    </tr>
    <tr>
       <td>Position <br>
                                Applying Occupation
                            </td>
                            <td colspan="2">
                                <select class="form-select form-select-sm" name="posisi_id">
                                    <option value="">Select Position</option>
                                    <?php if (!empty($positions)): ?>
                                    <?php foreach ($positions as $pos): ?>
                                    <option value="<?= $pos['_id'] ?>"
                                        <?= ($candidate['posisi'] == $pos['_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($pos['posisi']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <input type="text" class="form-control form-control-sm mt-1" name="applying_occupation"
                                    placeholder="Or enter custom occupation"
                                    value="<?= htmlspecialchars($candidate['applying_occupation']) ?>">
                            </td>
        <td>e-mail</td>
        <td colspan="2"><b><?= htmlspecialchars($candidate['email']) ?></b></td>
    </tr>
     <tr>
        <td>Class Grade</td>
        <td colspan="2">
            <input type="text" class="form-control form-control-sm" name="summary_class_grade" value="<?= htmlspecialchars($candidate['summary_class_grade'] ?? '') ?>">
        </td>
        <td>Career</td>
        <td colspan="2">
            <input type="number" class="form-control form-control-sm d-inline-block" name="summary_career_years" style="width: 60px;"> years
            <input type="number" class="form-control form-control-sm d-inline-block" name="summary_career_months" style="width: 60px;"> months
        </td>
    </tr>
</table>
                    <!-- end tebel masuk -->


                    <!-- star status family -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th colspan="6" class="fw-bold text-center ">B. STATUS - FAMILY AND ADDRESS</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center bg-light">Family Status</th>
                                <th colspan="2" class="text-center bg-light">Address</th>
                            </tr>
                            <tr>
                                <th style="width:15%;">Description</th>
                                <th style="width:10%;">Number</th>
                                <th style="width:10%;">Accompany</th>
                                <th style="width:32.5%;" class="text-center">Home</th>
                                <th style="width:32.5%;" class="text-center">Current</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Grand Parent</td>
                                <td><input type="number" class="form-control form-control-sm"
                                        name="family_grandparent_number" min="0"
                                        value="<?= $family_summary['grandparent']['number'] ?? 0 ?>"></td>
                                <td>
                                    <select class="form-select form-select-sm" name="family_grandparent_accompany">
                                        <option value="No"
                                            <?= ($family_summary['grandparent']['accompany'] == 'No') ? 'selected' : '' ?>>
                                            No</option>
                                        <option value="Yes"
                                            <?= ($family_summary['grandparent']['accompany'] == 'Yes') ? 'selected' : '' ?>>
                                            Yes</option>
                                    </select>
                                </td>
                                <td rowspan="5">
                                    <textarea class="form-control" name="address_home" rows="10"
                                        style="height: 100%;"><?= htmlspecialchars($candidate['alamat']) ?></textarea>
                                </td>
                                <td rowspan="5">
                                    <textarea class="form-control" name="address_current" rows="10"
                                        style="height: 100%;"><?= htmlspecialchars($candidate['current_address']) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Parent</td>
                                <td><input type="number" class="form-control form-control-sm"
                                        name="family_parent_number" min="0"
                                        value="<?= $family_summary['parent']['number'] ?? 0 ?>"></td>
                                <td>
                                    <select class="form-select form-select-sm" name="family_parent_accompany">
                                        <option value="No"
                                            <?= ($family_summary['parent']['accompany'] == 'No') ? 'selected' : '' ?>>No
                                        </option>
                                        <option value="Yes"
                                            <?= ($family_summary['parent']['accompany'] == 'Yes') ? 'selected' : '' ?>>
                                            Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Wife</td>
                                <td><input type="number" class="form-control form-control-sm" name="family_wife_number"
                                        min="0" value="<?= $family_summary['wife']['number'] ?? 0 ?>"></td>
                                <td>
                                    <select class="form-select form-select-sm" name="family_wife_accompany">
                                        <option value="No"
                                            <?= ($family_summary['wife']['accompany'] == 'No') ? 'selected' : '' ?>>No
                                        </option>
                                        <option value="Yes"
                                            <?= ($family_summary['wife']['accompany'] == 'Yes') ? 'selected' : '' ?>>Yes
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Son</td>
                                <td><input type="number" class="form-control form-control-sm" name="family_son_number"
                                        min="0" value="<?= $family_summary['son']['number'] ?? 0 ?>"></td>
                                <td>
                                    <select class="form-select form-select-sm" name="family_son_accompany">
                                        <option value="No"
                                            <?= ($family_summary['son']['accompany'] == 'No') ? 'selected' : '' ?>>No
                                        </option>
                                        <option value="Yes"
                                            <?= ($family_summary['son']['accompany'] == 'Yes') ? 'selected' : '' ?>>Yes
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Daughter</td>
                                <td><input type="number" class="form-control form-control-sm"
                                        name="family_daughter_number" min="0"
                                        value="<?= $family_summary['daughter']['number'] ?? 0 ?>"></td>
                                <td>
                                    <select class="form-select form-select-sm" name="family_daughter_accompany">
                                        <option value="No"
                                            <?= ($family_summary['daughter']['accompany'] == 'No') ? 'selected' : '' ?>>
                                            No</option>
                                        <option value="Yes"
                                            <?= ($family_summary['daughter']['accompany'] == 'Yes') ? 'selected' : '' ?>>
                                            Yes</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <!-- Document Submission Checklist -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th colspan="4" class="fw-bold text-center">C. CHECK LIST – DOCUMENT SUBMISSION</th>
                            </tr>
                            <tr>
                                <th style="width:25%;">Before Hiring Announcement</th>
                                <th style="width:15%;" class="text-center">Receiving Status</th>
                                <th style="width:25%;">After Hiring Announcement</th>
                                <th style="width:15%;" class="text-center">Receiving Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bg-light">Resume</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_resume">

                                    <?php if (isset($documents['Resume'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Resume']['file_name']) ?>"
                                        target="_blank" class="text-success small">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td class="bg-light">Medical Check Up Result</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_medical">

                                    <?php if (isset($documents['Medical Check Up'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Medical Check Up']['file_name']) ?>"
                                        target="_blank" class="text-success small">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">KTP</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_ktp">
                                    <?php if (isset($documents['KTP'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['KTP']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td class="bg-light">Bank Account Information</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_bank">
                                    <?php if (isset($documents['Bank Account'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Bank Account']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">Photo (5EA, 3.5cm x 4.5cm)</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_photo"
                                        accept=".jpg,.jpeg,.png">
                                    <?php if (isset($documents['Photo 3.5x4.5'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Photo 3.5x4.5']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">

                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif;?>
                                </td>
                                <td class="bg-light">Family Relation Certificate</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_family_cert"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['Family Relation Certificate'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Fammily Relation Certificate']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">SKCK</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_skck"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['SKCK'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['SKCK']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td class="bg-light">Tax ID Card (NPWP)</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_npwp"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['Tax ID Card (NPWP)'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Tax ID Card (NPWP)']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">Academic Certificate</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_academic"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['Academic Certificate'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Academic Certificate']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td class="bg-light">BPJS Ketenagakerjaan</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_bpjs_tk"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['BPJS Ketenagakerjaan'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['BPJS Ketenagakerjaan']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">Career Certificate (Proof Stamp)</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_career"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['Career Certificate'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Career Certificate']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td class="bg-light">BPJS Kesehatan</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_bpjs_kes"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['BPJS Kesehatan'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['BPJS Kesehatan']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">Self Introduction</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_self_intro"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['Self Introduction'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Self Introduction']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td class="bg-light">Family Contact Point & No.</td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" name="doc_family_contact"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <?php if (isset($documents['Family Contact'])): ?>
                                    <a href="<?= base_url('uploads/documents/' . $documents['Family Contact']['file_name']) ?>"
                                        target="_blank" class="text-success small d-block mt-1">
                                        <i class="fas fa-check-circle"></i> Lihat File
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- end untukk bagian  document -->

                    <!-- star untuk sertifikat -->
                    <table class="table table-bordered mt-4">
                        <thead>

                            <tr>
                                <th style="width:25%;" class="text-center bg-light">Name Certificate</th>
                                <th style="width:25%;" class="text-center bg-light">Certified Authority</th>
                                <th style="width:25%;" class="text-center bg-light">Certificate No.</th>
                                <th style="width:25%;" class="text-center bg-light">Certificate Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="certificate_id_<?= $i ?>"
                                        value="<?= $certificate_data['id_'.$i] ?? '' ?>">

                                    <input type="text" class="form-control form-control-sm"
                                        name="certificate_name_<?= $i ?>"
                                        value="<?= htmlspecialchars($certificate_data['name_'.$i] ?? '') ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm"
                                        name="certificate_authority_<?= $i ?>"
                                        value="<?= htmlspecialchars($certificate_data['authority_'.$i] ?? '') ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm"
                                        name="certificate_no_<?= $i ?>"
                                        value="<?= htmlspecialchars($certificate_data['no_'.$i] ?? '') ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm"
                                        name="certificate_date_<?= $i ?>"
                                        value="<?= $certificate_data['date_'.$i] ?? '' ?>">
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <!-- end certificate table -->



                    <!-- star Initial Hired Status Table -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th colspan="4" class="fw-bold text-center">D. INITIAL HIRED STATUS</th>
                            </tr>
                        </thead>
                        <tr>
                            <td style="width:20%;" class="bg-light fw-bold">Type of Hired</td>
                            <td style="width:30%;">
                                <input type="hidden" name="hired_type" value="Permanent">
                                <span class="form-control form-control-sm bg-light border-0">Permanent</span>
                            </td>
                            <td colspan="2" style="width:50%;" class="bg-light fw-bold text-center">Salary</td>

                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Salary Type</td>
                            <td>
                                <input type="hidden" name="salary_type" value="All Day, Hourly">
                                <span class="form-control form-control-sm bg-light border-0">All Day, Hourly</span>
                            </td>
                            <td class="bg-light">Basic</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_basic"
                                        value="<?= $salary_data['salary_basic'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Hired Contract No.</td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="contract_no"
                                    value="<?= htmlspecialchars($hired_status['hired_contract_no'] ?? '') ?>">
                            </td>
                            <td class="bg-light">O/T Allowance</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_ot_allowance"
                                        value="<?= $salary_data['salary_ot_allowance'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Position ID No.</td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="position_id"
                                    value="<?= htmlspecialchars($hired_status['position_id_no'] ?? '') ?>">
                            </td>
                            <td class="bg-light">Site Allowance</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_site_allowance"
                                        value="<?= $salary_data['salary_site_allowance'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Company Join Date</td>
                            <td>
                                <input type="date" class="form-control form-control-sm" name="join_date"
                                    value="<?= $hired_status['company_join_date'] ?? '' ?>">
                            </td>
                            <td class="bg-light">Meal</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_meal"
                                        value="<?= $salary_data['salary_meal'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Contract Finish Date</td>
                            <td>
                                <input type="date" class="form-control form-control-sm" name="contract_finish_date"
                                    value="<?= $hired_status['contract_finish_date'] ?? '' ?>">
                            </td>
                            <td class="bg-light">Transportation</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_transportation"
                                        value="<?= $salary_data['salary_transportation'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Probation Period</td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="probation_period"
                                    value="<?= htmlspecialchars($hired_status['probation_period'] ?? '') ?>"
                                    placeholder="e.g., 3 months">
                            </td>
                            <td class="bg-light">Role Allowance</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_role_allowance"
                                        value="<?= $salary_data['salary_role_allowance'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Work Location</td>
                            <td>
                                <select class="form-select form-select-sm" name="hired_work_location">
                                    <option value="">Select Location</option>
                                    <option value="HO"
                                        <?= (($hired_status['work_location'] ?? '') == 'HO') ? 'selected' : '' ?>>
                                        HO
                                    </option>
                                    <option value="KN Project"
                                        <?= (($hired_status['work_location'] ?? '') == 'KN Project') ? 'selected' : '' ?>>
                                        KN Project
                                    </option>
                                </select>
                            </td>
                            <td class="bg-light">Accommodation</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_accommodation"
                                        value="<?= $salary_data['salary_accommodation'] ?? '' ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Team</td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="team"
                                    value="<?= htmlspecialchars($hired_status['team'] ?? '') ?>">
                            </td>
                            <td class="bg-light">Sunday/Holiday</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_sunday_holiday"
                                        value="<?= $salary_data['salary_sunday_holiday'] ?? '' ?>">
                                    <span class="input-group-text">/ >=7hr</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="bg-light">Hourly Rate</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" class="form-control" name="salary_hourly_rate"
                                        value="<?= $salary_data['salary_hourly_rate'] ?? '' ?>">
                                    <span class="input-group-text">/ Hr</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- end initial hired status table -->

                    <!-- Reward Status Table -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th colspan="3" class="fw-bold text-center">E. REWARD STATUS</th>
                            </tr>
                            <tr>
                                <th style="width:40%;" class="text-center bg-light">Reward Name</th>
                                <th style="width:30%;" class="text-center bg-light">Date</th>
                                <th style="width:30%;" class="text-center bg-light">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="reward_id_<?= $i ?>"
                                        value="<?= $reward_data['id_'.$i] ?? '' ?>">
                                    <input type="text" class="form-control form-control-sm" name="reward_name_<?= $i ?>"
                                        value="<?= htmlspecialchars($reward_data['name_'.$i] ?? '') ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm" name="reward_date_<?= $i ?>"
                                        value="<?= $reward_data['date_'.$i] ?? '' ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm"
                                        name="reward_result_<?= $i ?>"
                                        value="<?= htmlspecialchars($reward_data['result_'.$i] ?? '') ?>">
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <!-- end reward status table -->

                    <!-- Disciplinary Status Table -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold text-center">F. DISCIPLINARY STATUS</th>
                            </tr>
                            <tr>
                                <th style="width:30%;" class="text-center bg-light">Description</th>
                                <th style="width:15%;" class="text-center bg-light">Date<br>(dd-mmm-yyyy)</th>
                                <th style="width:15%;" class="text-center bg-light">Period Star<br>(dd-mmm-yyyy)</th>
                                <th style="width:15%;" class="text-center bg-light">Period End<br>(dd-mmm-yyyy)</th>
                                <th style="width:25%;" class="text-center bg-light">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="disciplinary_id_<?= $i ?>"
                                        value="<?= $disciplinary_data['id_'.$i] ?? '' ?>">
                                    <input type="hidden" name="disciplinary_user_id_<?= $i ?>"
                                        value="<?= $disciplinary_data['user_id_'.$i] ?? $candidate['_id'] ?>">
                                    <input type="text" class="form-control form-control-sm"
                                        name="disciplinary_description_<?= $i ?>"
                                        value="<?= htmlspecialchars($disciplinary_data['description_'.$i] ?? '') ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm"
                                        name="disciplinary_date_<?= $i ?>"
                                        value="<?= $disciplinary_data['date_'.$i] ?? '' ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm"
                                        name="disciplinary_date_start_<?= $i ?>"
                                        value="<?= $disciplinary_data['date_start_'.$i] ?? '' ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm"
                                        name="disciplinary_date_end_<?= $i ?>"
                                        value="<?= $disciplinary_data['date_end_'.$i] ?? '' ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm"
                                        name="disciplinary_result_<?= $i ?>"
                                        value="<?= htmlspecialchars($disciplinary_data['result_'.$i] ?? '') ?>">
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <!-- end disciplinary status table -->


                    <!-- Chronology Status Table -->
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold text-center">G. CHRONOLOGY STATUS AS EMPLOYEE</th>
                            </tr>
                            <tr>
                                <td colspan="5" class="small">
                                    Please record all of status each Subject such as hiring, promotion, change of job
                                    location, job
                                    relocation/movement, and retirement (excluding reward and disciplinary action)
                                </td>
                            </tr>
                            <tr>
                                <th style="width:25%;" class="text-center bg-light">Subject</th>
                                <th colspan="2" class="text-center bg-light">Date</th>
                                <th style="width:25%;" class="text-center bg-light">Position</th>
                                <th style="width:25%;" class="text-center bg-light">Work Location<br>or Project</th>
                            </tr>
                            <tr>
                                <th class="text-center bg-light"></th>
                                <th style="width:12.5%;" class="text-center bg-light">Start</th>
                                <th style="width:12.5%;" class="text-center bg-light">Finish</th>
                                <th class="text-center bg-light"></th>
                                <th class="text-center bg-light"></th>
                            </tr>
                            <!-- ERORRR -->
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php 
                            // Ambil data untuk baris saat ini (indeks 0, 1, 2, 3, 4)
                            $current_data = $chronology_data[$i] ?? null; 
                        ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="chronology_id[]"
                                        value="<?= $current_data['id'] ?? '' ?>">
                                    <input type="text" class="form-control form-control-sm" name="chronology_subject[]"
                                        value="<?= htmlspecialchars($current_data['subject'] ?? '') ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm" name="employee_date_start[]"
                                        value="<?= $current_data['employee_date_start'] ?? '' ?>">
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm" name="employee_date_end[]"
                                        value="<?= $current_data['employee_date_end'] ?? '' ?>">
                                </td>
                                <td>
                                    <select class="form-select form-select-sm" name="position[]">
                                        <option value="">Select Position</option>
                                        <?php if (!empty($positions)): ?>
                                        <?php foreach ($positions as $pos): ?>
                                        <option value="<?= htmlspecialchars($pos['posisi']) ?>"
                                            <?= (isset($current_data) && $current_data['position'] == $pos['posisi']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($pos['posisi']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm"
                                        name="chronology_work_location[]"
                                        value="<?= htmlspecialchars($current_data['work_location'] ?? '') ?>">
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <!-- end chronology status table -->

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="submit" class="btn btn-primary" id="saveBtn">
                            <i class="fas fa-save me-2"></i> Save Summary
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. LOGIKA UNTUK MENGHITUNG UMUR OTOMATIS ---
        try {
            const birthDateString = "<?= $candidate['tgl_lahir'] ?? null ?>";
            if (birthDateString && birthDateString !== '0000-00-00') {
                const birthDate = new Date(birthDateString);
                const today = new Date();
                let years = today.getFullYear() - birthDate.getFullYear();
                let months = today.getMonth() - birthDate.getMonth();
                if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
                    years--;
                    months = 12 + months;
                }
                document.querySelector('input[name="summary_age_years"]').value = years;
                document.querySelector('input[name="summary_age_months"]').value = months;
            }
        } catch (e) {
            console.error("Error calculating age:", e);
        }
        //end

        $('#photo-upload-container').on('click', function() {
        $('#photo-input').click(); 
    });

    // Saat file dipilih, tampilkan preview-nya
    $('#photo-input').on('change', function(evt) {
        const [file] = evt.target.files;
        if (file) {
            $('#photo-preview').attr('src', URL.createObjectURL(file)).show();
            $('#photo-placeholder').hide();
        }
    });

    // --- Logika untuk upload tanda tangan ---
    // Saat wadah tanda tangan diklik, picu input file yang tersembunyi
    $('#signature-upload-container').on('click', function() {
        $('#signature-input').click();
    });

    // Saat file dipilih, tampilkan preview-nya
    $('#signature-input').on('change', function(evt) {
        const [file] = evt.target.files;
        if (file) {
            $('#signature-preview').attr('src', URL.createObjectURL(file)).show();
            $('#signature-placeholder').hide();
        }
    });

        //Preview untuk Foto
    document.getElementById('photo-input').onchange = evt => {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('photo-preview').src = URL.createObjectURL(file);
            document.getElementById('photo-preview').style.display = 'block';
            document.getElementById('photo-placeholder').style.display = 'none';
        }
    };

    // Preview untuk Tanda Tangan
    document.getElementById('signature-input').onchange = evt => {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('signature-preview').src = URL.createObjectURL(file);
            document.getElementById('signature-preview').style.display = 'block';
            document.getElementById('signature-placeholder').style.display = 'none';
        }
    };
    //

        // --- LOGIKA UNTUK MENGHITUNG TOTAL KARIR OTOMATIS (DENGAN DEBUGGING) ---
        try {
            const birthDateString = "<?= $candidate['tgl_lahir'] ?? null ?>";
            if (birthDateString && birthDateString !== '0000-00-00') {
                const birthDate = new Date(birthDateString);
                const today = new Date();
                let years = today.getFullYear() - birthDate.getFullYear();
                let months = today.getMonth() - birthDate.getMonth();
                if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
                    years--;
                    months = 12 + months;
                }
                document.querySelector('input[name="summary_age_years"]').value = years;
                document.querySelector('input[name="summary_age_months"]').value = months;
            }
        } catch (e) {
            console.error("Error calculating age:", e);
        }

        // --- 2. LOGIKA UNTUK MENGHITUNG TOTAL KARIR OTOMATIS (DIPERBAIKI) ---
        try {
            const careersData = <?= json_encode($careers ?? []) ?>;
            let totalMonths = 0;

            if (careersData && careersData.length > 0) {
                careersData.forEach(function(career) {

                    // DIUBAH DI SINI: dari career.period_start menjadi career.period_star
                    if (career.period_star && career.period_end && career.period_end !== '0000-00-00') {

                        // DIUBAH DI SINI: dari career.period_start menjadi career.period_star
                        const startDate = new Date(career.period_star);
                        const endDate = new Date(career.period_end);

                        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                            let monthsDiff = (endDate.getFullYear() - startDate.getFullYear()) * 12;
                            monthsDiff -= startDate.getMonth();
                            monthsDiff += endDate.getMonth();
                            totalMonths += (monthsDiff < 0 ? 0 : monthsDiff) + 1;
                        }
                    }
                });
            }

            const totalCareerYears = Math.floor(totalMonths / 12);
            const totalCareerMonths = totalMonths % 12;

            document.querySelector('input[name="summary_career_years"]').value = totalCareerYears;
            document.querySelector('input[name="summary_career_months"]').value = totalCareerMonths;

        } catch (e) {
            console.error("Error calculating career duration:", e);
        }
    });
    </script>

    <!-- Tambahkan SweetAlert2 dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Form submission with SweetAlert loading
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Show enhanced loading alert
        Swal.fire({
            title: '✅ Saving Summary...',
            text: 'Please wait while we save your data',
            icon: 'info',
            position: 'top-end',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            toast: true,
            width: '380px',
            background: 'linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%)',
            color: '#1976d2',
            customClass: {
                popup: 'swal2-border-radius swal2-loading-theme'
            },
            didOpen: () => {
                Swal.showLoading();
                // Add custom loading animation
                const loader = Swal.getHtmlContainer().querySelector('.swal2-loader');
                if (loader) {
                    loader.style.borderColor = '#007bff transparent #007bff transparent';
                }
            }
        });

        // Submit the form after a short delay
        setTimeout(() => {
            this.submit();
        }, 500);
    });

    // Display success/error messages with enhanced styling
    <?php if ($this->session->flashdata('swal_icon')): ?>
    Swal.fire({
        icon: '<?= $this->session->flashdata('swal_icon') ?>',
        title: '<?= $this->session->flashdata('swal_title') ?? 'Notification' ?>',
        text: '<?= $this->session->flashdata('swal_text') ?>',
        position: 'top-end',
        showConfirmButton: true,
        confirmButtonText: '✓ OK',
        timer: 5000,
        timerProgressBar: true,
        toast: true,
        width: '400px',
        showClass: {
            popup: 'animate__animated animate__fadeInRight animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutRight animate__faster'
        },
        customClass: {
            popup: 'swal2-border-radius swal2-enhanced-theme',
            title: 'swal2-enhanced-title',
            content: 'swal2-enhanced-content',
            confirmButton: 'swal2-enhanced-confirm'
        },
        buttonsStyling: false,
        didOpen: (popup) => {
            // Add sparkle effect for success
            if ('<?= $this->session->flashdata('swal_icon') ?>' === 'success') {
                popup.style.background = 'linear-gradient(145deg, #ffffff 0%, #f0fff4 100%)';
            }
        }
    });
    <?php endif; ?>
    </script>

</body>

</html>