<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class htmltopdf extends Controller
{
    public function htmlpdf()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $html="<p>Adobe Systems<br/> made the PDF</p>";
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
