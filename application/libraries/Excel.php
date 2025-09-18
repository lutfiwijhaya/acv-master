<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel {
    
    public function __construct() {
        // Load error suppression configuration
        $error_config = APPPATH . 'config/error_suppression.php';
        if (file_exists($error_config)) {
            require_once $error_config;
        }
        
        // Load PHPExcel configuration
        $config_path = FCPATH . 'phpexcel_config.php';
        if (file_exists($config_path)) {
            require_once $config_path;
        }
        
        // Temporarily disable deprecated warnings for PHPExcel
        $old_error_reporting = error_reporting();
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        
        // Load PHPExcel library
        $phpexcel_path = APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        if (file_exists($phpexcel_path)) {
            require_once $phpexcel_path;
        } else {
            // Fallback: try to load from vendor if using Composer
            $vendor_path = FCPATH . 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
            if (file_exists($vendor_path)) {
                require_once $vendor_path;
            } else {
                throw new Exception('PHPExcel library not found. Please install PHPExcel first. 
                Expected path: ' . $phpexcel_path . ' 
                Or install via Composer: composer require phpoffice/phpexcel');
            }
        }
        
        // Restore error reporting
        error_reporting($old_error_reporting);
    }
    
    /**
     * Read Excel file and return array of data
     */
  public function read_excel($file_path, $start_row = 2) {
    // Temporarily disable deprecated warnings
    $old_error_reporting = error_reporting();
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    
    try {
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data = [];
        
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        
        for ($row = $start_row; $row <= $highestRow; $row++) {
            $rowData = [];
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $cell = $sheet->getCellByColumnAndRow($col, $row);
                $cellValue = $cell->getValue();
                
                // Cek jika ini adalah format tanggal/waktu numerik Excel
                if (PHPExcel_Shared_Date::isDateTime($cell)) {
                    $excelTimestamp = PHPExcel_Shared_Date::ExcelToPHP($cellValue);
                    
                    // Cek apakah ini hanya waktu (nilai < 1) atau tanggal penuh
                    if ($cellValue < 1 && $cellValue > 0) {
                        // Ini adalah waktu saja, format sebagai JJ:MM tanpa terpengaruh timezone
                        $cellValue = gmdate('H:i', $excelTimestamp);
                    } else {
                        // Ini adalah tanggal, format sebagai YYYY-MM-DD
                        $cellValue = date('Y-m-d', $excelTimestamp);
                    }
                } 
                // Cek jika ini adalah string yang terlihat seperti waktu (contoh: '07:00')
                else if (is_string($cellValue) && preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($cellValue))) {
                     $cellValue = date('H:i', strtotime(trim($cellValue)));
                }

                $rowData[] = $cellValue;
            }
            
            // Hanya tambahkan baris jika tidak sepenuhnya kosong
            if (count(array_filter($rowData, function($x) { return !is_null($x) && $x !== ''; })) > 0) {
                $data[] = $rowData;
            }
        }
        
        return $data;
        
    } catch (Exception $e) {
        throw new Exception('Error reading Excel file: ' . $e->getMessage());
    } finally {
        // Restore error reporting
        error_reporting($old_error_reporting);
    }
}
    
    /**
     * Read Excel file with better time handling for timesheet
     */
    public function read_excel_timesheet($file_path, $start_row = 2) {
        // Temporarily disable deprecated warnings
        $old_error_reporting = error_reporting();
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        
        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file_path);
            $sheet = $objPHPExcel->getActiveSheet();
            $data = [];
            
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            
            for ($row = $start_row; $row <= $highestRow; $row++) {
                $rowData = [];
                for ($col = 0; $col < $highestColumnIndex; $col++) {
                    $cell = $sheet->getCellByColumnAndRow($col, $row);
                    $cellValue = $cell->getValue();
                    $calculatedValue = $cell->getCalculatedValue();
                    
                    // DEBUG LOG
                    error_log("Row $row, Col $col: Value=" . var_export($cellValue, true) . ", Calc=" . var_export($calculatedValue, true));
                    
                    // Handle different value types
                    if (PHPExcel_Shared_Date::isDateTime($cell)) {
                        $excelTimestamp = PHPExcel_Shared_Date::ExcelToPHP($cellValue);
                        
                        // Untuk kolom tanggal (biasanya kolom 2)
                        if ($col == 2) {
                            $cellValue = date('Y-m-d', $excelTimestamp);
                        } 
                        // Untuk kolom waktu (kolom 3 keatas)
                        else if ($col >= 3) {
                            // Jika nilai < 1, ini adalah waktu saja
                            if ($cellValue < 1 && $cellValue > 0) {
                                $cellValue = date('H:i:s', $excelTimestamp);
                            } else {
                                // Jika nilai >= 1, extract waktu dari datetime
                                $cellValue = date('H:i:s', $excelTimestamp);
                            }
                        }
                    }
                    // Handle string time format (07:00, 12:00, etc)
                    else if (is_string($cellValue) && preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($cellValue))) {
                        $cellValue = trim($cellValue);
                        // Tambahkan detik jika tidak ada
                        if (substr_count($cellValue, ':') == 1) {
                            $cellValue .= ':00';
                        }
                    }
                    
                    $rowData[] = $cellValue;
                }
                
                // Only add row if it has at least one non-empty value
                if (array_filter($rowData)) {
                    $data[] = $rowData;
                }
            }
            
            return $data;
            
        } catch (Exception $e) {
            throw new Exception('Error reading Excel file: ' . $e->getMessage());
        } finally {
            // Restore error reporting
            error_reporting($old_error_reporting);
        }
    }
    
    /**
     * Read CSV file and return array of data
     */
    public function read_csv($file_path, $start_row = 1) {
        try {
            $data = [];
            $handle = fopen($file_path, "r");
            
            if ($handle === FALSE) {
                throw new Exception('Cannot open CSV file');
            }
            
            $row_number = 0;
            while (($row = fgetcsv($handle)) !== FALSE) {
                $row_number++;
                if ($row_number >= $start_row) {
                    // Only add row if it has at least one non-empty value
                    if (array_filter($row)) {
                        $data[] = $row;
                    }
                }
            }
            
            fclose($handle);
            return $data;
            
        } catch (Exception $e) {
            throw new Exception('Error reading CSV file: ' . $e->getMessage());
        }
    }
    
    /**
     * Read XML file and return array of data
     */
    public function read_xml($file_path) {
        try {
            $xml = simplexml_load_file($file_path);
            
            if ($xml === false) {
                throw new Exception('Invalid XML file');
            }
            
            $data = [];
            
            // Handle different XML structures
            if (isset($xml->record)) {
                // Structure: <records><record><nik>...</nik><tgl_masuk>...</tgl_masuk><kehadiran>...</kehadiran></record></records>
                foreach ($xml->record as $record) {
                    $row = [];
                    foreach ($record->children() as $child) {
                        $row[] = (string)$child;
                    }
                    if (array_filter($row)) {
                        $data[] = $row;
                    }
                }
            } elseif (isset($xml->row)) {
                // Structure: <data><row><cell>...</cell><cell>...</cell></row></data>
                foreach ($xml->row as $row) {
                    $rowData = [];
                    foreach ($row->cell as $cell) {
                        $rowData[] = (string)$cell;
                    }
                    if (array_filter($rowData)) {
                        $data[] = $rowData;
                    }
                }
            } else {
                // Try to find any repeating elements
                $children = $xml->children();
                if (count($children) > 0) {
                    foreach ($children as $child) {
                        $row = [];
                        foreach ($child->children() as $grandchild) {
                            $row[] = (string)$grandchild;
                        }
                        if (array_filter($row)) {
                            $data[] = $row;
                        }
                    }
                }
            }
            
            return $data;
            
        } catch (Exception $e) {
            throw new Exception('Error reading XML file: ' . $e->getMessage());
        }
    }
    
    /**
     * Create Excel file from array data
     */
    public function create_excel($data, $headers = [], $filename = 'export.xlsx') {
        // Temporarily disable deprecated warnings
        $old_error_reporting = error_reporting();
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        
        try {
            $objPHPExcel = new PHPExcel();
            
            // Set document properties
            $objPHPExcel->getProperties()->setCreator("HR System")
                                         ->setLastModifiedBy("HR System")
                                         ->setTitle("Data Export")
                                         ->setSubject("Data Export from System")
                                         ->setDescription("Data exported from HR System");
            
            // Add headers if provided
            if (!empty($headers)) {
                $col = 0;
                foreach ($headers as $header) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col, 1, $header);
                    $col++;
                }
            }
            
            // Add data
            $start_row = empty($headers) ? 1 : 2;
            foreach ($data as $row_index => $row) {
                foreach ($row as $col_index => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col_index, $row_index + $start_row, $value);
                }
            }
            
            // Auto size columns
            $highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            }
            
            // Set active sheet
            $objPHPExcel->setActiveSheetIndex(0);
            
            // Create writer
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            
            // Set headers for download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            
            // Save to output
            $objWriter->save('php://output');
            
        } catch (Exception $e) {
            throw new Exception('Error creating Excel file: ' . $e->getMessage());
        } finally {
            // Restore error reporting
            error_reporting($old_error_reporting);
        }
    }
    
    /**
     * Validate file format
     */
    public function validate_file($file_path, $allowed_types = ['xlsx', 'xls', 'csv', 'xml']) {
        $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_types)) {
            throw new Exception('File format not supported. Allowed formats: ' . implode(', ', $allowed_types));
        }
        
        if (!file_exists($file_path)) {
            throw new Exception('File not found');
        }
        
        return true;
    }
}