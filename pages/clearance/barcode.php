<?php

require_once ("../../tcpdf_barcodes_2d.php");

$value =  $_GET['clr'];

$type = "PDF417";

$barcodeobj = new TCPDF2DBarcode($value, $type);

$barcodeobj->getBarcodePNG();

?>
