<?php

namespace App\Service;
use Dompdf\Dompdf;

class PdfGenerator
{
    private Dompdf $dompdf;

    public function __construct(Dompdf $dompdf)
    {
        $this->dompdf = $dompdf;
    }

    public function generatePdfFromHtml(string $html): string
    {
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF to a string
        return $this->dompdf->output();
    }

}