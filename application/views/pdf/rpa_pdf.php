<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PROPOSAL PAYMENT - <?php echo $rpa->invoice_no; ?></title>
    <style>
        @page {
            margin: 20px;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 10px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .document-title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .info-section {
            margin-bottom: 15px;
        }
        
        .info-row {
            margin-bottom: 5px;
        }
        
        .info-label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        
        .info-value {
            display: inline-block;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        table, th, td {
            border: 1px solid #000;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            padding: 8px 5px;
            text-align: center;
            font-size: 9px;
        }
        
        td {
            padding: 6px 5px;
            font-size: 9px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-left {
            text-align: left;
        }
        
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        
        .signature-section {
            margin-top: 30px;
            width: 100%;
        }
        
        .signature-box {
            width: 23%;
            text-align: center;
            vertical-align: top;
            margin-right: 1%;
            float: left;
        }
        
        .signature-title {
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }
        
        .signature-image {
            height: 50px;
            margin: 10px 0;
        }
        
        .signature-name {
            font-size: 9px;
            font-weight: bold;
            margin-top: 5px;
        }
        
        .signature-date {
            font-size: 8px;
            margin-top: 3px;
        }
        
        .transfer-info {
            margin-top: 20px;
            border: 1px solid #000;
            padding: 10px;
        }
        
        .transfer-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 8px;
        }
        
        .amount-box {
            background-color: #f0f0f0;
            padding: 8px;
            margin-top: 10px;
            text-align: right;
            font-weight: bold;
            font-size: 11px;
        }
        
        .note-section {
            margin-top: 10px;
            font-size: 9px;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            font-style: italic;
            clear: both;
        }
        
        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-name">PT. ACHIVON PRESTASI ABADI</div>
        <div class="document-title">PROPOSAL PAYMENT</div>
        <div style="font-size: 9px; margin-top: 5px;">
            NOMOR DOKUMEN AKUNTING: <?php echo $rpa->invoice_no; ?>
        </div>
    </div>

    <!-- Info Section -->
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Location:</span>
            <span class="info-value">Project KN</span>
        </div>
        <div class="info-row">
            <span class="info-label">Section:</span>
            <span class="info-value">Accounting &amp; Finance</span>
        </div>
        <div class="info-row">
            <span class="info-label">Date:</span>
            <span class="info-value"><?php echo date('d-M-y', strtotime($rpa->bill_date)); ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Request Date:</span>
            <span class="info-value"><?php echo date('d-M-y', strtotime($rpa->request_date)); ?></span>
        </div>
        <?php if ($rpa->approval_date): ?>
        <div class="info-row">
            <span class="info-label">Approval Date:</span>
            <span class="info-value"><?php echo date('d-M-y', strtotime($rpa->approval_date)); ?></span>
        </div>
        <?php endif; ?>
        <?php if ($rpa->company_payment_date): ?>
        <div class="info-row">
            <span class="info-label">Payment Date:</span>
            <span class="info-value"><?php echo date('d-M-y', strtotime($rpa->company_payment_date)); ?></span>
        </div>
        <?php endif; ?>
    </div>

    <!-- Purpose Section -->
    <div style="margin-bottom: 10px;">
        <strong>PURPOSE:</strong><br>
        <?php 
        // Gunakan supplementary_desc dari detail pertama atau key_text sebagai purpose
        echo isset($rpa_details[0]->supplementary_desc) && $rpa_details[0]->supplementary_desc 
            ? $rpa_details[0]->supplementary_desc 
            : (isset($rpa_details[0]->key_text) ? $rpa_details[0]->key_text : 'Payment Request'); 
        ?>
    </div>

    <!-- Transaction Detail Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">NO</th>
                <th style="width: 30%;">DESKRIPSI</th>
                <th style="width: 10%;">ACCOUNT CODE</th>
                <th style="width: 13%;">AMOUNT DEBIT</th>
                <th style="width: 13%;">AMOUNT CREDIT</th>
                <th style="width: 13%;">TO BE PAID</th>
                <th style="width: 13%;">ACTUAL EXP</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($rpa_details as $detail): 
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-left"><?php echo $detail->key_text ?: $detail->coa_name; ?></td>
                <td class="text-center"><?php echo $detail->coa_code; ?></td>
                <td class="text-right"><?php echo number_format($detail->debit_amount, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo number_format($detail->credit_amount, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo number_format($detail->to_be_paid_internal, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo number_format($detail->actual_expenditure, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
            
            <!-- Total Row -->
            <tr class="total-row">
                <td colspan="3" class="text-center">TOTAL</td>
                <td class="text-right"><?php echo number_format($total_debit, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo number_format($total_credit, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo number_format($total_to_be_paid, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo number_format($total_actual_expenditure, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Transfer Information -->
    <div class="transfer-info">
        <div class="transfer-title">Please, Transfer to:</div>
        <div class="info-row">
            <span class="info-label">Penerima:</span>
            <span class="info-value"><?php echo $rpa->supplier_name ?: '-'; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Account No.:</span>
            <span class="info-value"><?php echo $rpa->rek_bank ?: '-'; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Bank:</span>
            <span class="info-value"><?php echo $rpa->bank_account ?: '-'; ?></span>
        </div>
        <?php if (isset($rpa->supplier_address) && $rpa->supplier_address): ?>
        <div class="info-row">
            <span class="info-label">Address:</span>
            <span class="info-value"><?php echo $rpa->supplier_address; ?></span>
        </div>
        <?php endif; ?>
        <div class="info-row">
            <span class="info-label">Biaya Bank:</span>
            <span class="info-value">IDR 5.000</span>
        </div>
        
        <div class="amount-box">
            TOTAL HARUS DIBAYAR: Rp. <?php echo number_format($total_to_be_paid, 0, ',', '.'); ?>
        </div>
    </div>

    <!-- Notes - jika ada remark di detail pertama -->
    <?php if (isset($rpa_details[0]->remark) && $rpa_details[0]->remark): ?>
    <div class="note-section">
        <strong>Note:</strong> <?php echo $rpa_details[0]->remark; ?>
    </div>
    <?php endif; ?>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-title">Drafter</div>
            <?php if ($rpa->created_by_signature): ?>
                <?php
                // Gunakan FCPATH untuk absolute path
                $image_path = FCPATH . $rpa->created_by_signature;
                if (file_exists($image_path)) {
                    // Convert to base64 for better compatibility
                    $image_data = base64_encode(file_get_contents($image_path));
                    $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                    $mime_type = 'image/' . ($image_ext == 'jpg' ? 'jpeg' : $image_ext);
                    ?>
                    <img src="data:<?php echo $mime_type; ?>;base64,<?php echo $image_data; ?>" class="signature-image" alt="Signature">
                <?php } else { ?>
                    <div style="height: 50px;"></div>
                <?php } ?>
            <?php else: ?>
                <div style="height: 50px;"></div>
            <?php endif; ?>
            <div class="signature-name"><?php echo $rpa->created_by_name ?: '__________'; ?></div>
            <div class="signature-date"><?php echo date('d/m/Y', strtotime($rpa->request_date)); ?></div>
        </div>
        
        <div class="signature-box">
            <div class="signature-title">PIC</div>
            <div style="height: 50px;"></div>
            <div class="signature-name">__________</div>
            <div class="signature-date">__ / __ / __</div>
        </div>
        
        <div class="signature-box">
            <div class="signature-title">Confirm</div>
            <div style="height: 50px;"></div>
            <div class="signature-name">__________</div>
            <div class="signature-date">__ / __ / __</div>
        </div>
        
        <div class="signature-box">
            <div class="signature-title">Approval</div>
            <?php if ($rpa->approved_by_signature && strtolower($rpa->status) == 'approved'): ?>
                <?php
                $image_path = FCPATH . $rpa->approved_by_signature;
                if (file_exists($image_path)) {
                    $image_data = base64_encode(file_get_contents($image_path));
                    $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                    $mime_type = 'image/' . ($image_ext == 'jpg' ? 'jpeg' : $image_ext);
                    ?>
                    <img src="data:<?php echo $mime_type; ?>;base64,<?php echo $image_data; ?>" class="signature-image" alt="Signature">
                <?php } else { ?>
                    <div style="height: 50px;"></div>
                <?php } ?>
            <?php else: ?>
                <div style="height: 50px;"></div>
            <?php endif; ?>
            <div class="signature-name"><?php echo $rpa->approved_by_name ?: '__________'; ?></div>
            <div class="signature-date">
                <?php echo $rpa->approval_date ? date('d/m/Y', strtotime($rpa->approval_date)) : '__ / __ / __'; ?>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <!-- Footer -->
    <div class="footer">
        Thank you
    </div>
</body>
</html>
