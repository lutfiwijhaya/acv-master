<?php
require_once FCPATH . 'vendor/autoload.php';


use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib {
    protected $dompdf;

    public function __construct() {
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html) {
        $this->dompdf->loadHtml($html);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf", $options = ["Attachment" => false]) {
        $this->dompdf->stream($filename, $options);
    }

    public function output() {
        return $this->dompdf->output();
    }
}
