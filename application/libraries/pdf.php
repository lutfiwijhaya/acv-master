<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter DomPDF Library
 * 
 * Generate PDF's from HTML in CodeIgniter
 * 
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Your Name
 * @license         MIT License
 * @link            https://github.com/dompdf/dompdf
 */

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    /**
     * Get an instance of CodeIgniter
     *
     * @return CI_Controller
     */
    protected function ci()
    {
        return get_instance();
    }
    
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @param string $view The view to load
     * @param array $data The view data
     * @param string $filename The PDF filename
     * @param bool $stream TRUE to stream, FALSE to download
     * @param array $paper Paper size array or string
     * @param string $orientation Portrait or Landscape
     * @return void
     */
    public function load_view($view, $data = array(), $filename = 'document.pdf', $stream = true, $paper = 'A4', $orientation = 'portrait')
    {
        // Load HTML from view
        $html = $this->ci()->load->view($view, $data, TRUE);
        
        // Instantiate and configure dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('defaultFont', 'Arial');
        
        $dompdf = new Dompdf($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper($paper, $orientation);
        
        // Render the PDF
        $dompdf->render();
        
        // Output the generated PDF
        if ($stream) {
            // Stream to browser (inline display)
            $dompdf->stream($filename, array("Attachment" => false));
        } else {
            // Force download
            $dompdf->stream($filename, array("Attachment" => true));
        }
    }
    
    /**
     * Generate PDF and save to file
     *
     * @param string $view The view to load
     * @param array $data The view data
     * @param string $filepath Full path where to save the PDF
     * @param string $paper Paper size
     * @param string $orientation Portrait or Landscape
     * @return bool
     */
    public function save_view($view, $data = array(), $filepath = './document.pdf', $paper = 'A4', $orientation = 'portrait')
    {
        // Load HTML from view
        $html = $this->ci()->load->view($view, $data, TRUE);
        
        // Instantiate and configure dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('defaultFont', 'Arial');
        
        $dompdf = new Dompdf($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper($paper, $orientation);
        
        // Render the PDF
        $dompdf->render();
        
        // Get output and save to file
        $output = $dompdf->output();
        return file_put_contents($filepath, $output);
    }
    
    /**
     * Generate PDF from HTML string
     *
     * @param string $html The HTML content
     * @param string $filename The PDF filename
     * @param bool $stream TRUE to stream, FALSE to download
     * @param string $paper Paper size
     * @param string $orientation Portrait or Landscape
     * @return void
     */
    public function load_html($html, $filename = 'document.pdf', $stream = true, $paper = 'A4', $orientation = 'portrait')
    {
        // Instantiate and configure dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('defaultFont', 'Arial');
        
        $dompdf = new Dompdf($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper($paper, $orientation);
        
        // Render the PDF
        $dompdf->render();
        
        // Output the generated PDF
        if ($stream) {
            // Stream to browser (inline display)
            $dompdf->stream($filename, array("Attachment" => false));
        } else {
            // Force download
            $dompdf->stream($filename, array("Attachment" => true));
        }
    }
}
