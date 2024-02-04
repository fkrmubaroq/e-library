<?php

use mikehaertl\pdftk\Pdf;
// Set background from another PDF (first page repeated)
function Pdftk($file)
{

    $pdf = new Pdf($file);
    $result = $pdf->background('./assets/img/logo.png')
        ->saveAs('./assets/watermarked.pdf');
    if ($result === false) {
        $error = $pdf->getError();
    }

    echo $error;
}
