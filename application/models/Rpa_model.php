<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpa_model extends CI_Model {

    public function get_all($search = null, $status = null, $limit = 100, $offset = 0)
    {
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.status,
            r.category,
            s.nama as supplier_name
        ");
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");

        // Filter pencarian berdasarkan invoice_no, charge_code, atau supplier_name
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("r.invoice_no", $search);
            $this->db->or_like("r.charge_code", $search);
            $this->db->or_like("s.nama", $search);
            $this->db->group_end();
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $this->db->where("r.status", $status);
        }

        $this->db->limit($limit, $offset);
        $this->db->order_by("r.id", "DESC");

        // Ambil data utama
        $main_records = $this->db->get()->result_array();

        // Ambil data detail untuk setiap RPA
        foreach ($main_records as &$record) {
            $this->db->select("
                d.id as child_id,
                d.seq_no,
                d.coa_id,
                d.payment_by,
                d.currency,
                d.debit_amount,
                d.credit_amount,
                d.difference_amount,
                d.remark_tax_income,
                d.to_be_paid_internal,
                d.actual_expenditure,
                d.key_text,
                c.code as coa_code,
                c.name as coa_name
            ");
            $this->db->from("rpa_detail d");
            $this->db->join("coa c", "c.id = d.coa_id", "left");
            $this->db->where("d.rpa_id", $record['rpa_id']);
            $children = $this->db->get()->result_array();

            // Menambahkan data anak ke dalam record utama
            $record['children'] = $children;
        }

        return $main_records;
    }


   public function count_all($search = null, $status = null)
    {
        $this->db->from("rpa r");
        $this->db->join("rpa_detail d", "d.rpa_id = r.id", "left");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");

        // Filter pencarian berdasarkan invoice_no, charge_code, atau supplier_name
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("r.invoice_no", $search);
            $this->db->or_like("r.charge_code", $search);
            $this->db->or_like("s.nama", $search);
            $this->db->group_end();
        }

        // Filter berdasarkan status
        if (!empty($status)) {
            $this->db->where("r.status", $status);
        }

        $this->db->distinct();
        $this->db->select("r.id");

        // Hitung jumlah data yang ditemukan
        return $this->db->count_all_results();
    }

    
    public function get_by_id($id)
    {
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.status,
            r.category,
            r.supplier_id,
            r.approved_by,
            r.note,
            s.nama as supplier_name,
            s.bank_account,
            s.rek_bank
        ");
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
        $this->db->where("r.id", $id);
        
        return $this->db->get()->row_array();
    }

    public function get_detail_by_rpa_id($rpa_id)
    {
        $this->db->select("
            d.id as detail_id,
            d.rpa_id,
            d.seq_no,
            d.coa_id,
            d.payment_by,
            d.currency,
            d.debit_amount,
            d.credit_amount,
            d.difference_amount,
            d.remark_tax_income,
            d.to_be_paid_internal,
            d.actual_expenditure,
            d.key_text,
            d.remark,
            c.code as coa_code,
            c.name as coa_name
        ");
        $this->db->from("rpa_detail d");
        $this->db->join("coa c", "c.id = d.coa_id", "left");
        $this->db->where("d.rpa_id", $rpa_id);
        $this->db->order_by("d.seq_no", "ASC");
        
        return $this->db->get()->result_array();
    }

    public function get_with_details($id)
    {
        $header = $this->get_by_id($id);
        
        if (!$header) {
            return null;
        }
        
        $details = $this->get_detail_by_rpa_id($id);
        $header['details'] = $details;
        $header['children'] = $details;
        
        return $header;
    }

    public function insert($data, $details)
    {
        $this->db->insert("rpa", $data);
        $rpa_id = $this->db->insert_id();
        if (is_array($details)) {
            foreach ($details as $detail) {
                $detail['rpa_id'] = $rpa_id;
                 // Remove 'difference' if it exists in the array
                unset($detail['difference']);
                if (isset($detail['coa_code'])) {
                    $coa = $this->db->get_where('coa', ['code' => $detail['coa_code']])->row();
                    $detail['coa_id'] = $coa ? $coa->id : null;
                    unset($detail['coa_code']);
                }
                if (isset($detail['debit'])) {
                    $detail['debit_amount'] = $detail['debit'];
                    unset($detail['debit']);
                }
                if (isset($detail['credit'])) {
                    $detail['credit_amount'] = $detail['credit'];
                    unset($detail['credit']);
                }
                if (isset($detail['name'])) {
                    unset($detail['name']);
                }
                if (isset($detail['remark'])) {
                    $detail['remark_tax_income'] = $detail['remark'];
                    unset($detail['remark']);
                }
                $this->db->insert("rpa_detail", $detail); 
            }
        }
        return $rpa_id;
    }

    public function update($id, $data, $details)
    {
        $this->db->where("id", $id);
        $this->db->update("rpa", $data);

        $this->db->where("rpa_id", $id)->delete("rpa_detail");
        foreach ($details as $detail) {
            $detail['rpa_id'] = $id;
            unset($detail['difference']);
            $this->db->insert("rpa_detail", $detail);
        }

        return true;
    }

    public function update_status($id, $status)
    {
        $this->db->where("id", $id);
        $this->db->update("rpa", ["status" => $status]);
        return true;
    }

    public function delete($id)
    {
        $this->db->where("rpa_id", $id)->delete("rpa_detail");
        $this->db->where("id", $id)->delete("rpa");
        return true;
    }

    public function approve($rpa_id, $note = '', $approved_by = null)
    {
        if (!$rpa_id) {
            return false;
        }
        
        $data = [
            'status' => 'Approved',
            'approval_date' => date('Y-m-d'),
            'note' => $note,
            'approved_by' => $approved_by,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $rpa_id);
        $this->db->update('rpa', $data);
        
        return $this->db->affected_rows() > 0;
    }

    public function reject($rpa_id, $note, $approved_by = null)
    {
        if (!$rpa_id || empty($note)) {
            return false;
        }
        
        $data = [
            'status' => 'Rejected',
            'approval_date' => date('Y-m-d'),
            'note' => $note,
            'approved_by' => $approved_by,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $rpa_id);
        $this->db->update('rpa', $data);
        
        return $this->db->affected_rows() > 0;
    }

    public function print_rpa_by_id($rpa_id)
    {
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.status,
            r.category,
            r.supplier_id,
            r.is_posted,
            r.posted_journal_id,
            r.approved_by,
            r.created_by,
            s.nama as supplier_name,
            s.PIC_name as supplier_pic,
            s.email as supplier_email,
            s.phone as supplier_phone,
            s.address as supplier_address,
            s.bank_account,
            s.rek_bank,
            s.tax as supplier_tax,
            s.status as supplier_status,
            approved_user.nama as approved_by_name, 
            approved_user.path_ttd as approved_by_signature,
            approved_posisi.posisi as approved_by_position,
            approved_user.email as approved_by_email,
            created_user.nama as created_by_name, 
            created_user.path_ttd as created_by_signature,
            created_posisi.posisi as created_by_position,
            created_user.email as created_by_email
        ");
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
        $this->db->join("tbl_user as approved_user", "r.approved_by = approved_user._id", "left");
        $this->db->join("tbl_posisi as approved_posisi", "approved_user.posisi = approved_posisi._id", "left");
        $this->db->join("tbl_user as created_user", "r.created_by = created_user._id", "left");
        $this->db->join("tbl_posisi as created_posisi", "created_user.posisi = created_posisi._id", "left");
        $this->db->where("r.id", $rpa_id);
        
        return $this->db->get()->row();
    }

    public function get_rpa_details_for_print($rpa_id)
    {
        $this->db->select("
            d.id as detail_id,
            d.rpa_id,
            d.seq_no,
            d.coa_id,
            d.payment_by,
            d.currency,
            d.debit_amount,
            d.credit_amount,
            d.difference_amount,
            d.remark_tax_income,
            d.to_be_paid_internal,
            d.actual_expenditure,
            d.tax_income_classification,
            d.key_text,
            d.supplementary_desc,
            d.remark,
            c.code as coa_code,
            c.name as coa_name,
            c.code,
            c.name
        ");
        $this->db->from("rpa_detail d");
        $this->db->join("coa c", "c.id = d.coa_id", "left");
        $this->db->where("d.rpa_id", $rpa_id);
        $this->db->order_by("d.seq_no", "ASC");
        
        return $this->db->get()->result();
    }

    public function get_supplier_for_print($supplier_id)
    {
        if (!$supplier_id) {
            return null;
        }
        
        $this->db->select("
            id,
            nama,
            PIC_name,
            email,
            phone,
            address,
            bank_account,
            rek_bank,
            tax,
            status
        ");
        $this->db->from("tbl_supplier");
        $this->db->where("id", $supplier_id);
        
        return $this->db->get()->row();
    }

    // ========== BANK MANAGEMENT METHODS ==========
    
    public function get_active_banks()
    {
        $this->db->select('
            ab.id,
            ab.name,
            ab.account_bank,
            ab.balance as initial_balance,
            ab.coa_id,
            c.code as coa_code,
            c.name as coa_name
        ');
        $this->db->from('accounting_bank ab');
        $this->db->join('coa c', 'c.id = ab.coa_id', 'left');
        $this->db->order_by('ab.id', 'ASC');
        
        return $this->db->get()->result_array();
    }

    private function get_bank_alias($bank_name, $account_number = '')
    {
        $name_lower = strtolower(trim($bank_name));
        $account_lower = strtolower(trim($account_number));
        
        $name_clean = preg_replace('/[^a-z0-9]/i', '', $name_lower);
        $account_clean = preg_replace('/[^0-9]/i', '', $account_lower);
        
        // Mandiri 273
        if ((strpos($name_lower, 'mandiri') !== false && strpos($account_clean, '273') !== false) ||
            strpos($name_lower, 'mandiri273') !== false ||
            strpos($name_lower, 'mandiri 273') !== false) {
            return 'mandiri273';
        }
        
        // Mandiri 721
        if ((strpos($name_lower, 'mandiri') !== false && strpos($account_clean, '721') !== false) ||
            strpos($name_lower, 'mandiri721') !== false ||
            strpos($name_lower, 'mandiri 721') !== false) {
            return 'mandiri721';
        }
        
        // Other banks
        if (strpos($name_lower, 'bca') !== false) return 'bca';
        if (strpos($name_lower, 'bri') !== false) return 'bri';
        if (strpos($name_lower, 'bni') !== false) return 'bni';
        if (strpos($name_lower, 'tunai') !== false || strpos($name_lower, 'cash') !== false) return 'cash';
        
        return substr($name_clean, 0, 15);
    }

    public function get_all_opening_balances($date)
    {
        $previous_day = date('Y-m-d', strtotime($date . ' -1 day'));
        $banks = $this->get_active_banks();
        
        $balances = [];
        
        foreach ($banks as $bank) {
            $alias = $this->get_bank_alias($bank['name'], $bank['account_bank']);
            $balance = $this->calculate_bank_balance_until_date($bank['coa_id'], $previous_day);
            $balances[$alias] = $balance;
        }
        
        return $balances;
    }

    private function calculate_bank_balance_until_date($coa_id, $date)
    {
        // Get initial balance from accounting_bank
        $bank = $this->db->select('balance')
                        ->from('accounting_bank')
                        ->where('coa_id', $coa_id)
                        ->get()
                        ->row();
        
        $initial_balance = $bank ? floatval($bank->balance) : 0;
        
        // Calculate total debit (money in) until date
        $total_debit = $this->db->select('COALESCE(SUM(rd.debit_amount), 0) AS total')
                                ->from('rpa_detail rd')
                                ->join('rpa r', 'r.id = rd.rpa_id', 'inner')
                                ->where('rd.coa_id', $coa_id)
                                ->where('r.company_payment_date <=', $date)
                                ->where('r.status', 'paid')
                                ->get()
                                ->row()
                                ->total;
        
        // Calculate total credit (money out) until date
        $total_credit = $this->db->select('COALESCE(SUM(rd.credit_amount), 0) AS total')
                                ->from('rpa_detail rd')
                                ->join('rpa r', 'r.id = rd.rpa_id', 'inner')
                                ->where('rd.coa_id', $coa_id)
                                ->where('r.company_payment_date <=', $date)
                                ->where('r.status', 'paid')
                                ->get()
                                ->row()
                                ->total;
        
        // Final balance formula
        return $initial_balance + floatval($total_debit) - floatval($total_credit);
    }

    public function identify_payment_method($payment_by, $coa_id)
    {
        if (!empty($payment_by)) {
            $payment_lower = strtolower(trim($payment_by));
            
            if (strpos($payment_lower, 'mandiri273') !== false || 
                strpos($payment_lower, 'mandiri 273') !== false ||
                strpos($payment_lower, '273') !== false) {
                return 'mandiri273';
            } elseif (strpos($payment_lower, 'mandiri721') !== false || 
                      strpos($payment_lower, 'mandiri 721') !== false ||
                      strpos($payment_lower, '721') !== false) {
                return 'mandiri721';
            } elseif (strpos($payment_lower, 'bca') !== false) {
                return 'bca';
            } elseif (strpos($payment_lower, 'bri') !== false) {
                return 'bri';
            } elseif (strpos($payment_lower, 'bni') !== false) {
                return 'bni';
            } elseif (strpos($payment_lower, 'tunai') !== false || 
                      strpos($payment_lower, 'cash') !== false) {
                return 'cash';
            }
        }
        
        if (!empty($coa_id)) {
            $bank = $this->db->select('ab.name, ab.account_bank')
                            ->from('accounting_bank ab')
                            ->where('ab.coa_id', $coa_id)
                            ->get()
                            ->row();
            
            if ($bank) {
                return $this->get_bank_alias($bank->name, $bank->account_bank);
            }
        }
        
        return 'cash';
    }

    public function get_daily_report($date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.category,
            r.status,
            r.supplier_id,
            r.is_posted,
            r.note,
            s.nama as supplier_name
        ");
        
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
        $this->db->where("DATE(r.{$date_field})", $date);
        $this->db->order_by("r.{$date_field}", "ASC");
        $this->db->order_by("r.id", "ASC");
        
        $results = $this->db->get()->result_array();
        
        foreach ($results as &$record) {
            $record['details'] = $this->get_detail_by_rpa_id_enhanced($record['rpa_id']);
        }
        
        return $results;
    }

    private function get_detail_by_rpa_id_enhanced($rpa_id)
    {
        $this->db->select("
            rd.*,
            c.code as coa_code,
            c.name as coa_name,
            c.category_code,
            ab.name as bank_name,
            ab.account_bank
        ");
        $this->db->from("rpa_detail rd");
        $this->db->join("coa c", "c.id = rd.coa_id", "left");
        $this->db->join("accounting_bank ab", "ab.coa_id = c.id", "left");
        $this->db->where("rd.rpa_id", $rpa_id);
        $this->db->order_by("rd.seq_no", "ASC");
        
        return $this->db->get()->result_array();
    }

    /**
     * Get RPA summary for a specific date
     */
    public function get_rpa_summary($date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        // Get all RPAs for the date
        $rpas = $this->get_daily_report($date, $date_field);
        
        if (empty($rpas)) {
            return [
                'total_rpa' => 0,
                'total_income' => 0,
                'total_expense' => 0,
                'by_status' => [],
                'by_bank' => []
            ];
        }
        
        $summary = [
            'total_rpa' => count($rpas),
            'total_income' => 0,
            'total_expense' => 0,
            'by_status' => [],
            'by_bank' => []
        ];
        
        // Process each RPA
        foreach ($rpas as $rpa) {
            // Count by status
            $status = strtolower($rpa['status']);
            if (!isset($summary['by_status'][$status])) {
                $summary['by_status'][$status] = 0;
            }
            $summary['by_status'][$status]++;
            
            // Sum income and expense by bank
            if (!empty($rpa['details'])) {
                foreach ($rpa['details'] as $detail) {
                    $debit = (float)($detail['debit_amount'] ?? 0);
                    $credit = (float)($detail['credit_amount'] ?? 0);
                    
                    // Identify payment method
                    $payment_method = $this->identify_payment_method(
                        $detail['payment_by'] ?? '',
                        $detail['coa_id'] ?? null
                    );
                    
                    // Initialize bank totals if not exists
                    if (!isset($summary['by_bank'][$payment_method])) {
                        $summary['by_bank'][$payment_method] = [
                            'income' => 0,
                            'expense' => 0
                        ];
                    }
                    
                    // Add to totals
                    if ($debit > 0) {
                        $summary['total_income'] += $debit;
                        $summary['by_bank'][$payment_method]['income'] += $debit;
                    } elseif ($credit > 0) {
                        $summary['total_expense'] += $credit;
                        $summary['by_bank'][$payment_method]['expense'] += $credit;
                    }
                }
            }
        }
        
        return $summary;
    }

    public function get_daily_report_summary($date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $this->db->select("
            r.status,
            COUNT(r.id) as total_records,
            SUM(CASE WHEN r.is_posted = 1 THEN 1 ELSE 0 END) as posted_count,
            SUM(CASE WHEN r.is_posted = 0 THEN 1 ELSE 0 END) as unposted_count
        ");
        
        $this->db->from("rpa r");
        $this->db->where("DATE(r.{$date_field})", $date);
        $this->db->group_by("r.status");
        $this->db->order_by("r.status", "ASC");
        
        return $this->db->get()->result_array();
    }

    public function get_daily_report_financial_summary($date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $this->db->select("
            COUNT(DISTINCT r.id) as total_rpa,
            COUNT(d.id) as total_detail_items,
            COALESCE(SUM(d.debit_amount), 0) as total_debit,
            COALESCE(SUM(d.credit_amount), 0) as total_credit,
            COALESCE(SUM(d.difference_amount), 0) as total_difference,
            COALESCE(SUM(d.to_be_paid_internal), 0) as total_to_be_paid,
            COALESCE(SUM(d.actual_expenditure), 0) as total_actual_expenditure
        ");
        
        $this->db->from("rpa r");
        $this->db->join("rpa_detail d", "d.rpa_id = r.id", "left");
        $this->db->where("DATE(r.{$date_field})", $date);
        
        $summary = $this->db->get()->row();
        
        if ($summary) {
            $summary->opening_balances = $this->get_opening_balance($date);
            $summary->closing_balances = $this->get_closing_balance($date);
        }
        
        return $summary;
    }

    public function get_opening_balance($date)
    {
        $previous_day = date('Y-m-d', strtotime($date . ' -1 day'));
        $banks = $this->get_active_banks();
        
        $balances = [
            'bank1' => 0,
            'bank2' => 0,
            'cash' => 0,
            'total' => 0,
            'banks' => []
        ];
        
        foreach ($banks as $bank) {
            $bank_balance = $this->calculate_bank_balance_until_date($bank['coa_id'], $previous_day);
            $bank_name_lower = strtolower($bank['name']);
            
            if (strpos($bank_name_lower, 'mandiri273') !== false || strpos($bank['account_bank'], '273') !== false) {
                $balances['bank1'] = $bank_balance;
                $balances['banks']['mandiri273'] = [
                    'id' => $bank['id'],
                    'name' => $bank['name'],
                    'balance' => $bank_balance
                ];
            } elseif (strpos($bank_name_lower, 'mandiri721') !== false || strpos($bank['account_bank'], '721') !== false) {
                $balances['bank2'] = $bank_balance;
                $balances['banks']['mandiri721'] = [
                    'id' => $bank['id'],
                    'name' => $bank['name'],
                    'balance' => $bank_balance
                ];
            } elseif (strpos($bank_name_lower, 'tunai') !== false || strpos($bank_name_lower, 'cash') !== false) {
                $balances['cash'] = $bank_balance;
                $balances['banks']['cash'] = [
                    'id' => $bank['id'],
                    'name' => $bank['name'],
                    'balance' => $bank_balance
                ];
            }
            
            $balances['total'] += $bank_balance;
        }
        
        return $balances;
    }

    public function get_closing_balance($date)
    {
        return $this->get_opening_balance(date('Y-m-d', strtotime($date . ' +1 day')));
    }

    public function get_daily_report_by_status($date, $status, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $allowed_statuses = ['new', 'waiting', 'approved', 'rejected', 'paid'];
        if (!in_array(strtolower($status), $allowed_statuses)) {
            return [];
        }
        
        $this->db->select("
            r.id as rpa_id,
            r.invoice_no,
            r.charge_code,
            r.bill_date,
            r.request_date,
            r.approval_date,
            r.company_payment_date,
            r.category,
            r.status,
            r.supplier_id,
            r.is_posted,
            r.note,
            s.nama as supplier_name,
            approved_user.nama as approved_by_name,
            created_user.nama as created_by_name
        ");
        
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
        $this->db->join("tbl_user as approved_user", "r.approved_by = approved_user._id", "left");
        $this->db->join("tbl_user as created_user", "r.created_by = created_user._id", "left");
        
        $this->db->where("DATE(r.{$date_field})", $date);
        $this->db->where("r.status", $status);
        $this->db->order_by("r.id", "ASC");
        
        return $this->db->get()->result_array();
    }

    public function get_daily_report_range($start_date, $end_date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $this->db->select("
            DATE(r.{$date_field}) as report_date,
            COUNT(r.id) as total_rpa,
            SUM(CASE WHEN r.status = 'new' THEN 1 ELSE 0 END) as status_new,
            SUM(CASE WHEN r.status = 'waiting' THEN 1 ELSE 0 END) as status_waiting,
            SUM(CASE WHEN r.status = 'approved' THEN 1 ELSE 0 END) as status_approved,
            SUM(CASE WHEN r.status = 'rejected' THEN 1 ELSE 0 END) as status_rejected,
            SUM(CASE WHEN r.status = 'paid' THEN 1 ELSE 0 END) as status_paid,
            SUM(CASE WHEN r.is_posted = 1 THEN 1 ELSE 0 END) as posted_count
        ");
        
        $this->db->from("rpa r");
        $this->db->where("DATE(r.{$date_field}) >=", $start_date);
        $this->db->where("DATE(r.{$date_field}) <=", $end_date);
        $this->db->group_by("DATE(r.{$date_field})");
        $this->db->order_by("DATE(r.{$date_field})", "ASC");
        
        return $this->db->get()->result_array();
    }

    public function has_daily_report_data($date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $this->db->from("rpa r");
        $this->db->where("DATE(r.{$date_field})", $date);
        $count = $this->db->count_all_results();
        
        return $count > 0;
    }

    public function get_daily_report_for_export($date, $date_field = 'request_date')
    {
        $allowed_date_fields = ['request_date', 'bill_date', 'approval_date', 'company_payment_date'];
        if (!in_array($date_field, $allowed_date_fields)) {
            $date_field = 'request_date';
        }
        
        $this->db->select("
            r.id,
            r.invoice_no,
            r.charge_code,
            DATE_FORMAT(r.bill_date, '%d/%m/%Y') as bill_date,
            DATE_FORMAT(r.request_date, '%d/%m/%Y') as request_date,
            DATE_FORMAT(r.approval_date, '%d/%m/%Y') as approval_date,
            DATE_FORMAT(r.company_payment_date, '%d/%m/%Y') as payment_date,
            r.category,
            r.status,
            CASE WHEN r.is_posted = 1 THEN 'Posted' ELSE 'Not Posted' END as posting_status,
            s.nama as supplier,
            approved_user.nama as approved_by,
            created_user.nama as created_by,
            r.note
        ");
        
        $this->db->from("rpa r");
        $this->db->join("tbl_supplier s", "s.id = r.supplier_id", "left");
        $this->db->join("tbl_user as approved_user", "r.approved_by = approved_user._id", "left");
        $this->db->join("tbl_user as created_user", "r.created_by = created_user._id", "left");
        
        $this->db->where("DATE(r.{$date_field})", $date);
        $this->db->order_by("r.id", "ASC");
        
        return $this->db->get()->result_array();
    }

    public function get_rpa_details($rpa_id)
    {
        // Select necessary columns from the rpa_detail table
        $this->db->select('rpa_detail.coa_id, rpa_detail.debit_amount, rpa_detail.credit_amount, rpa_detail.supplementary_desc');
        $this->db->from('rpa_detail');
        $this->db->where('rpa_detail.rpa_id', $rpa_id);

        // Optionally, you can join with other tables if needed, for example:
        // $this->db->join('coa', 'coa.id = rpa_detail.coa_id');

        // Execute the query and return the results
        $query = $this->db->get();

        return $query->result_array();  // Return the result as an array
    }


     // Function to update the journal_id for a specific RPA
    public function update_journal_id($rpa_id, $journal_id)
    {
        // Update the journal_id for the specified RPA ID
        $data = ['posted_journal_id' => $journal_id];
        
        // Apply the update query
        $this->db->where('id', $rpa_id);
        return $this->db->update('rpa', $data);
    }

}
