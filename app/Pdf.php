<?php
use Illuminate\Support\Facades\View;

namespace App;

use Dompdf\Dompdf;

class Pdf
{
    protected $pdf;
    
    public function __construct() {
        $this->pdf = new Dompdf;
    }

    public function generateInvoice($invoice, $customer, $projects) 
    {
        $this->pdf->loadHtml(
            view('print.index', compact('invoice', 'customer', 'projects'))->render()
        );
        $this->pdf->render();
        return $this->pdf->output();
    }
}