<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('File_model');
        $this->load->helper('file');
    }

    /**
     * API Endpoint untuk menghapus file di folder 'dr_files'
     * berdasarkan status is_aktiv = '1' di database.
     * Mengizinkan akses melalui metode GET dan POST (UNTUK TESTING SAJA).
     *
     * @return JSON response
     */
    public function delete_active_files()
    {
       
        if ($this->input->method() !== 'post') {
            $this->output
                 ->set_content_type('application/json')
                 ->set_status_header(405) // Method Not Allowed
                 ->set_output(json_encode(['status' => 'error', 'message' => 'Method Not Allowed. Only POST requests are allowed.']));
            return;
        }
        

       
        $files_to_delete = $this->File_model->get_active_files_for_deletion();

        if (empty($files_to_delete)) {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['status' => 'success', 'message' => 'No active files found for deletion.']));
            return;
        }

        $deleted_count = 0;
        $failed_deletions = [];

        foreach ($files_to_delete as $file) {
            $file_path = FCPATH . 'dr_files/' . $file->name_file;

            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    if ($this->File_model->delete_file_record($file->id)) {
                        $deleted_count++;
                    } else {
                        $failed_deletions[] = [
                            'id' => $file->id,
                            'name_file' => $file->name_file,
                            'reason' => 'Failed to delete database record after physical file deletion.'
                        ];
                    }
                } else {
                    $failed_deletions[] = [
                        'id' => $file->id,
                        'name_file' => $file->name_file,
                        'reason' => 'Failed to delete physical file.'
                    ];
                }
            } else {
                if ($this->File_model->delete_file_record($file->id)) {
                    $deleted_count++;
                } else {
                    $failed_deletions[] = [
                        'id' => $file->id,
                        'name_file' => $file->name_file,
                        'reason' => 'Physical file not found, but failed to delete database record.'
                    ];
                }
            }
        }

        if ($deleted_count > 0 && empty($failed_deletions)) {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['status' => 'success', 'message' => "$deleted_count file(s) successfully deleted."]));
        } elseif ($deleted_count > 0 && !empty($failed_deletions)) {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode([
                     'status' => 'partial_success',
                     'message' => "$deleted_count file(s) deleted. However, " . count($failed_deletions) . " file(s) failed to delete.",
                     'failed_files' => $failed_deletions
                 ]));
        } else {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode([
                     'status' => 'error',
                     'message' => 'No files were deleted.',
                     'failed_files' => $failed_deletions
                 ]));
        }
    }
}