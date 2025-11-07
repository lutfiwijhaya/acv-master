<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Function to update the account balance based on the transaction type (debit/credit)
function update_balance($coa_id, $debit, $credit)
{
    $CI =& get_instance();
    $CI->load->model('Journal_model');

    // Get the current balance of the account from the 'accounting_bank' table
    $current_balance = $CI->Journal_model->get_balance($coa_id);
    if ($current_balance === null) {
        $current_balance = 0;
    }

    // Get the category ID of the COA
    $category_id = $CI->Journal_model->get_category_id($coa_id);  // Assuming this method exists
    $category = $CI->Journal_model->get_category($category_id);  // Assuming this method exists

    // Adjust the balance based on the category and the transaction type (debit or credit)
    switch ($category) {
        case 'Assets':  // Aktiva (Assets)
            // Increase with Debit, Decrease with Credit
            if ($debit > 0) {
                $new_balance = $current_balance + $debit;
            } else {
                $new_balance = $current_balance - $credit;
            }
            break;
        
        case 'Liabilities':  // Kewajiban (Liabilities)
            // Increase with Credit, Decrease with Debit
            if ($credit > 0) {
                $new_balance = $current_balance + $credit;
            } else {
                $new_balance = $current_balance - $debit;
            }
            break;

        case 'Equity':  // Modal (Equity)
            // Increase with Credit, Decrease with Debit
            if ($credit > 0) {
                $new_balance = $current_balance + $credit;
            } else {
                $new_balance = $current_balance - $debit;
            }
            break;

        case 'Revenue':  // Penghasilan (Revenue)
            // Increase with Credit, Decrease with Debit
            if ($credit > 0) {
                $new_balance = $current_balance + $credit;
            } else {
                $new_balance = $current_balance - $debit;
            }
            break;

        case 'Expenditure':  // Beban (Expenditure)
            // Increase with Debit, Decrease with Credit
            if ($debit > 0) {
                $new_balance = $current_balance + $debit;
            } else {
                $new_balance = $current_balance - $credit;
            }
            break;

        default:
            // If the category is unknown, return false as an error
            return false;
    }

    // Update the balance in the accounting_bank table using the new balance
    return $CI->Journal_model->update_balance($coa_id, $new_balance);
}



// Function to create a journal entry
function create_journal_entry($journal_data, $journal_details_data)
{
    // Load the database object
    $CI =& get_instance();

    // Load the Journal model
    $CI->load->model('Journal_model');
    
    // Insert the journal header into the journal table
    $journal_id = $CI->Journal_model->insert_journal($journal_data);

    // Insert the journal details
    foreach ($journal_details_data as $detail) {
        $detail['journal_id'] = $journal_id;
        $CI->Journal_model->insert_journal_detail($detail);
        
        // Update the account balances after each entry (Debit or Credit)
        update_balance($detail['coa_id'], $detail['debit'], $detail['credit']);
    }

    return $journal_id;
}
