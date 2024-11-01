<?php session_start(); 
header ("Content-type: image/jpeg"); 
$im = @imagecreate(100, 30); 
$color_fondo = imagecolorallocate ($im, 240, 240, 240); 
$color_texto = imagecolorallocate ($im, 0, 128, 6); 
imagestring ($im, 25, 25, 5, $_SESSION["codigos"], $color_texto); 
imagejpeg ($im);
