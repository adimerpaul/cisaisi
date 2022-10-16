<?php

include('phpqrcode/qrlib.php'); 

$content = "Adimer paul chambi ajata";
QRcode::png($content,"hola.png",QR_ECLEVEL_L,10,2);
//echo "<img src='hola.png'/>";
?>

