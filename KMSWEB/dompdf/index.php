<?php
use Dompdf\Dompdf;
 
require 'vendor/autoload.php';
 
$dompdf = new Dompdf();
$dompdf->loadHtml('สารัช SET A4 Landscape');
// Paper Size
$dompdf->setPaper('A4', 'landscape');
 
$dompdf->render();
$dompdf->stream('Landscape.pdf', array('Attachment'=>false));
 
?>