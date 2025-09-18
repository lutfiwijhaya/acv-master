<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Summary Status Employee</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 10px;
        margin: 15px;
        line-height: 1.3;
    }

    .header-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px 0;
}

    .header-logo img {
        height: 25px;
        vertical-align: middle;
        margin-right: 8px;
    }

    .header-title {
        font-size: 14px;
        font-weight: bold;
        display: inline-block;
        vertical-align: middle;
    }

    .card {
        border: 1px solid #000;
        margin-bottom: 15px;
    }

    .card-header {
        background-color: #f2f2f2;
        font-weight: bold;
        padding: 8px;
        text-align: center;
        font-size: 12px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 4px;
        vertical-align: top;
        font-size: 9px;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .sub-header {
        font-weight: bold;
        text-align: center;
        background-color: #e9ecef;
        font-size: 10px;
    }

    .bg-light {
        background-color: #f8f9fa;
    }

    .fw-bold {
        font-weight: bold;
    }

    .text-center {
        text-align: center;
    }

    .page-break {
        page-break-after: always;
    }

    .small-text {
        font-size: 8px;
    }

    .currency {
        text-align: right;
    }

    /* Specific width styling */
    .w-15 {
        width: 15%;
    }

    .w-20 {
        width: 20%;
    }

    .w-25 {
        width: 25%;
    }

    .w-30 {
        width: 30%;
    }

    .w-35 {
        width: 35%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    /* Family table specific styling */
    .family-table th {
        font-size: 8px;
        padding: 3px;
        vertical-align: middle;
    }

    .family-table td {
        font-size: 8px;
        padding: 3px;
        vertical-align: middle;
    }

    .address-cell {
        width: 32.5%;
        vertical-align: top;
        height: 20px;
        font-size: 8px;
        padding: 3px;
    }


    /* Specific styling for family status columns */
    .family-status-cell {
        vertical-align: middle;
        text-align: center;
        height: 20px;
    }
    </style>
</head>

<body>
    <?php foreach ($summaries as $index => $summary): ?>
    <div class="card">
        <!-- Header with Logo -->
        <div class="header-logo">
            <img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="Logo">
            <span class="header-title">SUMMARY STATUS – EMPLOYEE</span>
        </div>

        <!-- A. CANDIDATE INFORMATION -->

        <table class="table">
            <tr>
                <td colspan="6" class="sub-header"><b>A. CANDIDATE INFORMATION</b></td>
            </tr>
            <tr>
                <td class="w-15"><b>Name</b></td>
                <td colspan="2" class="w-35">
                    <b><?= htmlspecialchars($summary['main']['nama']) ?></b>
                    (<?= $summary['main']['jk'] == 'L' ? 'male' : 'female' ?>)
                </td>
                <td class="w-15"><b>Discipline</b></td>
                <td colspan="2" class="w-35">
                    <?= htmlspecialchars($summary['main']['summary_discipline'] ?? '-') ?>
                </td>
            </tr>
            <tr>
                <td><b>Birthday</b></td>
                <td colspan="2">
                    <b><?= date('d F Y', strtotime($summary['main']['tgl_lahir'])) ?></b>
                    (Age: <?= htmlspecialchars($summary['main']['summary_age_years'] ?? '0') ?> years,
                    <?= htmlspecialchars($summary['main']['summary_age_months'] ?? '0') ?> months)
                </td>
                <td><b>Position <br>Applying Occupation</b></td>
                <td colspan="2">
                    <?= htmlspecialchars($summary['main']['position_name'] ?? '-') ?><br>
                    <?= htmlspecialchars($summary['main']['applying_occupation'] ?? '-') ?>
                </td>
            </tr>
            <tr>
                <td><b>KTP No.</b></td>
                <td colspan="2"><b><?= htmlspecialchars($summary['main']['nik']) ?></b></td>
                <td><b>Marriage Status</b></td>
                <td colspan="2"><b><?= htmlspecialchars($summary['main']['marital']) ?></b></td>
            </tr>
            <tr>
                <td><b>Last Education</b></td>
                <td colspan="2">
                    Name: <?= htmlspecialchars($summary['last_education']['registered_school_name'] ?? '-') ?><br>
                    Location: <?= htmlspecialchars($summary['last_education']['location'] ?? '-') ?>
                </td>
                <td><b>Class Grade</b></td>
                <td colspan="2">
                    <?= htmlspecialchars($summary['main']['summary_class_grade'] ?? '-') ?>
                </td>
            </tr>
            <tr>
                <td><b>Mobile No.</b></td>
                <td colspan="2"><b><?= htmlspecialchars($summary['main']['no_hp']) ?></b></td>
                <td><b>E-mail</b></td>
                <td colspan="2"><b><?= htmlspecialchars($summary['main']['email']) ?></b></td>
            </tr>
            <tr>
                <td><b>Expected Salary</b></td>
                <td colspan="2">
                    <?php if (!empty($summary['main']['desired_salary'])): ?>
                    IDR <?= number_format($summary['main']['desired_salary'], 0, ',', '.') ?>
                    <?php else: ?>
                    -
                    <?php endif; ?>
                </td>
                <td><b>Career</b></td>
                <td colspan="2">
                    <?= htmlspecialchars($summary['main']['summary_career_years'] ?? '0') ?> years,
                    <?= htmlspecialchars($summary['main']['summary_career_months'] ?? '0') ?> months
                </td>
            </tr>
        </table>


        <!-- B. STATUS - FAMILY AND ADDRESS -->
        <table class="table family-table">
            <thead>
                <tr>
                    <th colspan="5" class="sub-header">B. STATUS - FAMILY AND ADDRESS</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-center bg-light">Family Status</th>
                    <th colspan="2" class="text-center bg-light">Address</th>
                </tr>
                <tr>
                    <th class="w-15">Description</th>
                    <th class="w-10">Number</th>
                    <th class="w-10">Accompany</th>
                    <th class="address-cell text-center">Home</th>
                    <th class="address-cell text-center">Current</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Grand Parent</td>
                    <td class="text-center"><?= $summary['family']['grandparent']['number'] ?? '0' ?></td>
                    <td class="text-center"><?= $summary['family']['grandparent']['accompany'] ?? 'No' ?></td>
                    <td rowspan="5" class="address-cell">
                        <?= htmlspecialchars($summary['main']['address_home'] ?? $summary['main']['alamat'] ?? '-') ?>
                    </td>
                    <td rowspan="5" class="address-cell">
                        <?= htmlspecialchars($summary['main']['address_current'] ?? $summary['main']['current_address'] ?? '-') ?>
                    </td>
                </tr>
                <tr>
                    <td>Parent</td>
                    <td class="text-center"><?= $summary['family']['parent']['number'] ?? '0' ?></td>
                    <td class="text-center"><?= $summary['family']['parent']['accompany'] ?? 'No' ?></td>
                </tr>
                <tr>
                    <td>Wife</td>
                    <td class="text-center"><?= $summary['family']['wife']['number'] ?? '0' ?></td>
                    <td class="text-center"><?= $summary['family']['wife']['accompany'] ?? 'No' ?></td>
                </tr>
                <tr>
                    <td>Son</td>
                    <td class="text-center"><?= $summary['family']['son']['number'] ?? '0' ?></td>
                    <td class="text-center"><?= $summary['family']['son']['accompany'] ?? 'No' ?></td>
                </tr>
                <tr>
                    <td>Daughter</td>
                    <td class="text-center"><?= $summary['family']['daughter']['number'] ?? '0' ?></td>
                    <td class="text-center"><?= $summary['family']['daughter']['accompany'] ?? 'No' ?></td>
                </tr>
            </tbody>
        </table>
        <!--  -->

        <!-- C. CHECK LIST – DOCUMENT SUBMISSION -->
        <table class="table">
            <thead>
                <tr>
                    <th colspan="4" class="sub-header">C. CHECK LIST – DOCUMENT SUBMISSION</th>
                </tr>
                <tr>
                    <th class="w-25">Before Hiring Announcement</th>
                    <th class="w-15 text-center">Status</th>
                    <th class="w-25">After Hiring Announcement</th>
                    <th class="w-15 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-light">Resume</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Resume']) ? 'Complete' : 'Incomplete' ?>
                    </td>
                    <td class="bg-light">Medical Check Up Result</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Medical Check Up']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light">KTP</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['KTP']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                    <td class="bg-light">Bank Account Information</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Bank Account']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                </tr>
                <td class="bg-light">Photo (5EA, 3.5cm x 4.5cm)</td>
                <td class="text-center">
                    <?= isset($summary['documents']['Photo 3.5x4.5']) ? 'Complete✓' : 'Incomplete✗' ?>
                </td>
                <td class="bg-light">Family Relation Certificate</td>
                <td class="text-center">
                    <?= isset($summary['documents']['Family Relation Certificate']) ? 'Complete✓' : 'Incomplete✗' ?>
                </td>
                </tr>
                <tr>
                    <td class="bg-light">SKCK</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['SKCK']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                    <td class="bg-light">Tax ID Card (NPWP)</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Tax ID Card (NPWP)']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light">Academic Certificate</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Academic Certificate']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                    <td class="bg-light">BPJS Ketenagakerjaan</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['BPJS Ketenagakerjaan']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light">Career Certificate (Proof Stamp)</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Career Certificate']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                    <td class="bg-light">BPJS Kesehatan</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['BPJS Kesehatan']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light">Self Introduction</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Self Introduction']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                    <td class="bg-light">Family Contact Point & No.</td>
                    <td class="text-center">
                        <?= isset($summary['documents']['Family Contact']) ? 'Complete✓' : 'Incomplete✗' ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Certificate Section -->
        <?php if (!empty($summary['certificates'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="4" class="sub-header">CERTIFICATES</th>
                </tr>
                <tr>
                    <th class="w-25 text-center bg-light">Name Certificate</th>
                    <th class="w-25 text-center bg-light">Certified Authority</th>
                    <th class="w-25 text-center bg-light">Certificate No.</th>
                    <th class="w-25 text-center bg-light">Certificate Date</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <?php if (!empty($summary['certificates']['name_'.$i])): ?>
                <tr>
                    <td><?= htmlspecialchars($summary['certificates']['name_'.$i]) ?></td>
                    <td><?= htmlspecialchars($summary['certificates']['authority_'.$i] ?? '-') ?></td>
                    <td><?= htmlspecialchars($summary['certificates']['no_'.$i] ?? '-') ?></td>
                    <td><?= $summary['certificates']['date_'.$i] ? date('d-M-Y', strtotime($summary['certificates']['date_'.$i])) : '-' ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endfor; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <!-- end -->

        <!-- D. INITIAL HIRED STATUS -->
        <?php 
            // Pastikan data hired_status dan salary ada
            $hired_status = $summary['hired_status'] ?? [];
            $salary_data = $summary['salary'] ?? [];
            ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="4" class="sub-header">D. INITIAL HIRED STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-light fw-bold w-20">Type of Hired</td>
                    <td class="w-30"><?= htmlspecialchars($hired_status['hired_type'] ?? 'Permanent') ?></td>
                    <td colspan="2" class="bg-light fw-bold text-center w-50">Salary</td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Salary Type</td>
                    <td><?= htmlspecialchars($hired_status['salary_type'] ?? 'All Day, Hourly') ?></td>
                    <td class="bg-light">Basic</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_basic'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Hired Contract No.</td>
                    <td><?= htmlspecialchars($hired_status['hired_contract_no'] ?? $hired_status['contract_no'] ?? '-') ?>
                    </td>
                    <td class="bg-light">O/T Allowance</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_ot_allowance'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Position ID No.</td>
                    <td><?= htmlspecialchars($hired_status['position_id_no'] ?? $hired_status['position_id'] ?? '-') ?>
                    </td>
                    <td class="bg-light">Site Allowance</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_site_allowance'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Company Join Date</td>
                    <td>
                        <?php if (!empty($hired_status['company_join_date']) && $hired_status['company_join_date'] !== '0000-00-00'): ?>
                        <?= date('d-M-Y', strtotime($hired_status['company_join_date'])) ?>
                        <?php elseif (!empty($hired_status['join_date']) && $hired_status['join_date'] !== '0000-00-00'): ?>
                        <?= date('d-M-Y', strtotime($hired_status['join_date'])) ?>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </td>
                    <td class="bg-light">Meal</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_meal'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Contract Finish Date</td>
                    <td>
                        <?php if (!empty($hired_status['contract_finish_date']) && $hired_status['contract_finish_date'] !== '0000-00-00'): ?>
                        <?= date('d-M-Y', strtotime($hired_status['contract_finish_date'])) ?>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </td>
                    <td class="bg-light">Transportation</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_transportation'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Probation Period</td>
                    <td><?= htmlspecialchars($hired_status['probation_period'] ?? '-') ?></td>
                    <td class="bg-light">Role Allowance</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_role_allowance'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Work Location</td>
                    <td><?= htmlspecialchars($hired_status['work_location'] ?? $hired_status['hired_work_location'] ?? '-') ?>
                    </td>
                    <td class="bg-light">Accommodation</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_accommodation'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light fw-bold">Team</td>
                    <td><?= htmlspecialchars($hired_status['team'] ?? '-') ?></td>
                    <td class="bg-light">Sunday/Holiday</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_sunday_holiday'] ?? 0, 0, ',', '.') ?> / >=7hr
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="bg-light">Hourly Rate</td>
                    <td class="currency">
                        IDR <?= number_format($salary_data['salary_hourly_rate'] ?? 0, 0, ',', '.') ?> / Hr
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- end bagian intial -->

        <!-- star buat reward status -->
        <?php if (!empty($summary['rewards'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="sub-header">E. REWARD STATUS</th>
                </tr>
                <tr>
                    <th class="w-40 text-center bg-light">Reward Name</th>
                    <th class="w-30 text-center bg-light">Date</th>
                    <th class="w-30 text-center bg-light">Result</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <?php if (!empty($summary['rewards']['name_'.$i])): ?>
                <tr>
                    <td><?= htmlspecialchars($summary['rewards']['name_'.$i]) ?></td>
                    <td><?= $summary['rewards']['date_'.$i] ? date('d-M-Y', strtotime($summary['rewards']['date_'.$i])) : '-' ?>
                    </td>
                    <td><?= htmlspecialchars($summary['rewards']['result_'.$i] ?? '-') ?></td>
                </tr>
                <?php endif; ?>
                <?php endfor; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <!-- end buat rewad -->

        <!-- star buat disciplinary -->
        <?php if (!empty($summary['disciplinary'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5" class="sub-header">F. DISCIPLINARY STATUS</th>
                </tr>
                <tr>
                    <th class="w-30 text-center bg-light">Description</th>
                    <th class="w-15 text-center bg-light">Date</th>
                    <th class="w-15 text-center bg-light">Period Start</th>
                    <th class="w-15 text-center bg-light">Period End</th>
                    <th class="w-25 text-center bg-light">Result</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summary['disciplinary'] as $item): ?>
                <?php if (!empty($item['description'])): ?>
                <tr>
                    <td><?= htmlspecialchars($item['description']) ?></td>
                    <td><?= $item['disciplinary_date'] ? date('d-M-Y', strtotime($item['disciplinary_date'])) : '-' ?>
                    </td>
                    <td><?= $item['disciplinary_period_star'] ? date('d-M-Y', strtotime($item['disciplinary_period_star'])) : '-' ?>
                    </td>
                    <td><?= $item['disciplinary_period_end'] ? date('d-M-Y', strtotime($item['disciplinary_period_end'])) : '-' ?>
                    </td>
                    <td><?= htmlspecialchars($item['disciplinary_result'] ?? '-') ?></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <!-- end untuk disciplinary -->

        <!-- star chronology -->
        <?php if (!empty($summary['chronology'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5" class="sub-header">G. Chronology Status As Employee</th>
                </tr>
                <tr>
                    <th class="w-25 text-center bg-light">Subject</th>
                    <th class="w-15 text-center bg-light">Star Date</th>
                    <th class="w-15 text-center bg-light">Finish Date</th>
                    <th class="w-20 text-center bg-light">Position</th>
                    <th class="w-25 text-center bg-light">Work Location</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($summary['chronology'] as $item): ?>
             <?php if (!empty($item['subject'])): ?>
                <tr>
                    <td><?= htmlspecialchars($item['subject']) ?></td>
                    <td><?= $item['employee_date_start'] ? date('d-m-y', strtotime($item['employee_date_start'])) : '-' ?></td>
                    <td><?= $item['employee_date_end'] ? date('d-m-y', strtotime($item['employee_date_end'])) : '-' ?></td>
                    <td><?= htmlspecialchars($item['position'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['work_location'] ?? '-')?></td>
                </tr>
              <?php endif; ?>  
             <?php endforeach ?>   
            </tbody>
        </table>  
        <?php endif; ?>  
        <!-- end chronology -->
        <?php if ($index < count($summaries) - 1): ?>
        <div class="page-break"></div>
        <?php endif; ?>
        <?php endforeach; ?>
</body>

</html>