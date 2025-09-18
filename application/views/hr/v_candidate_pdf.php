<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Candidate Application</title>
    <style>
    body {
        font-family: sans-serif;
        font-size: 10px;
    }

    .card {
        border: 1px solid #eee;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .card-header {
        background-color: #f7f7f7;
        padding: 5px 10px;
        font-weight: bold;
        border-bottom: 1px solid #eee;
    }

    .card-body {
        padding: 10px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #ccc;
        padding: 4px;
        vertical-align: top;
    }

    .table th {
        background-color: #f2f2f2;
        width: 25%;
    }

    .photo {
       width: 120px;
        height: 200px;
        border: 1px solid #ccc;
        text-align: center;
        padding: 0;
        
    }

    .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        
    }

    .page-break {
        page-break-after: always;
    }
    </style>
</head>

<body>
    <?php foreach ($candidates as $index => $candidate): ?>
    <div class="card">
        <div style="text-align: center; width: 100%; padding-top: 20px;">
            <img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="Logo"
                style="height: 30px; margin-right: 15px; vertical-align: middle;">

            <h2 style="display: inline-block; vertical-align: middle; margin: 0;">
                CANDIDATE APPLICATION
            </h2>
        </div>
        <div class="card-body">
            <!-- Job Application Details Section -->
            <div class="card-header">JOB APPLICATION DETAILS</div>
            <table class="table">
                <tr>
                    <th style="width: 25%;">Applying Occupation</th>
                    <td style="width: 25%;"><?= htmlspecialchars($candidate['main']['applying_occupation'] ?? '-') ?>
                    </td>
                    <th style="width: 25%;">Desired Salary</th>
                    <td style="width: 15%;">IDR
                        <?= number_format($candidate['main']['desired_salary'] ?? 0, 0, ',', '.') ?></td>
                </tr>
            </table>

            <div class="card-header">1. BASIC INFORMATION</div>
            <table class="table">
                <tr>
                    <td rowspan="8" style="width: 100px; padding: 0;">
                       <?php if (!empty($candidate['main']['photo_base64'])): ?>
                            <div class="photo">
                                <img src="<?= $candidate['main']['photo_base64'] ?>"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        <?php else: ?>
                            <div class="photo" style="display: flex; align-items: center; justify-content: center;">
                                No Photo
                            </div>
                        <?php endif; ?>
                    </td>
                    <th>Name</th>
                    <td><?= htmlspecialchars($candidate['main']['nama']) ?></td>
                    <th>Sex</th>
                    <td><?= ($candidate['main']['jk'] == 'L') ? 'Male' : 'Female' ?></td>
                </tr>
                <tr>
                    <th>KTP No.</th>
                    <td><?= htmlspecialchars($candidate['main']['nik']) ?></td>
                    <th>Birthday</th>
                    <td><?= htmlspecialchars($candidate['main']['tgl_lahir']) ?></td>
                </tr>
                <tr>
                    <th>Marital Status</th>
                    <td><?= htmlspecialchars($candidate['main']['marital']) ?></td>
                    <th>Place of Birth</th>
                    <td><?= htmlspecialchars($candidate['main']['tempat_lahir']) ?></td>
                </tr>
                <tr>
                    <th>Home Address</th>
                    <td colspan="3"><?= nl2br(htmlspecialchars($candidate['main']['alamat'])) ?></td>
                </tr>
                <tr>
                    <th>Current Address</th>
                    <td colspan="3"><?= nl2br(htmlspecialchars($candidate['main']['current_address'])) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($candidate['main']['email']) ?></td>
                    <th>Religion</th>
                    <td><?= htmlspecialchars($candidate['main']['religion'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Mobile No.</th>
                    <td><?= htmlspecialchars($candidate['main']['no_hp']) ?></td>
                    <th>BPJS KS</th>
                    <td><?= htmlspecialchars($candidate['main']['bpjs_ks'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>NPWP No.</th>
                    <td><?= htmlspecialchars($candidate['main']['npwp'] ?? '-') ?></td>
                    <th>BPJS KT</th>
                    <td><?= htmlspecialchars($candidate['main']['bpjs_kt'] ?? '-') ?></td>
                </tr>
            </table>

            <div class="card-header">2. ACADEMIC/EDUCATION STATUS</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Graduation</th>
                        <th>School Name</th>
                        <th>Location</th>
                        <th>Major</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidate['academics'] as $edu): ?>
                    <tr>
                        <td><?= htmlspecialchars($edu['graduation']) ?></td>
                        <td><?= htmlspecialchars($edu['registered_school_name']) ?></td>
                        <td><?= htmlspecialchars($edu['location']) ?></td>
                        <td><?= htmlspecialchars($edu['jurusan']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Skill Authorized Certificates Section -->
            <div class="card-header">3. SKILL AUTHORIZED CERTIFICATES</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Acquisition</th>
                        <th>Name of The Certificate</th>
                        <th>Issue Authority Name</th>
                        <th>Issue Location</th>
                        <th>Certificate No.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($candidate['certificates']) && is_array($candidate['certificates'])): ?>
                    <?php foreach ($candidate['certificates'] as $cert): ?>
                    <tr>
                        <td><?= htmlspecialchars($cert['acquisition'] ?? '') ?></td>
                        <td><?= htmlspecialchars($cert['certificate'] ?? '') ?></td>
                        <td><?= htmlspecialchars($cert['authority'] ?? '') ?></td>
                        <td><?= htmlspecialchars($cert['issue_location'] ?? '') ?></td>
                        <td><?= htmlspecialchars($cert['certificate_no'] ?? '') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No certificate data available</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Summary of Career Status Section -->
            <div class="card-header">4. SUMMARY OF CAREER STATUS</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Job Position</th>
                        <th>Period Start</th>
                        <th>Period End</th>
                        <th>Career</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($candidate['careers']) && is_array($candidate['careers'])): ?>
                    <?php foreach ($candidate['careers'] as $career): ?>
                    <tr>
                        <td><?= htmlspecialchars($career['company_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($career['position'] ?? '') ?></td>
                        <td><?= !empty($career['period_star']) ? date('M Y', strtotime($career['period_star'])) : '' ?>
                        </td>
                        <td><?= !empty($career['period_end']) ? date('M Y', strtotime($career['period_end'])) : '' ?>
                        </td>
                        <td><?= htmlspecialchars($career['career'] ?? '') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No career data available</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Motivation Reason for Application Section -->
            <div class="card-header">5. MOTIVATION REASON FOR APPLICATION</div>
            <div style="border: 1px solid #ccc; padding: 10px; min-height: 100px; margin-bottom: 10px;">
                <?= nl2br(htmlspecialchars($candidate['motivation']['motivation_reason'] ?? '')) ?>
            </div>

        </div>
    </div>

    <?php if ($index < count($candidates) - 1): ?>
    <div class="page-break"></div>
    <?php endif; ?>
    <?php endforeach; ?>
</body>

</html>