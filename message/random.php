<?php
session_start();
$width=60;
$height=25;
$r=mt_rand(0,180);
$g=mt_rand(0,180);
$b=mt_rand(0,180);
$x=mt_rand(1,23);
$y=mt_rand(1,10);
$x1=mt_rand(5,15);
$y1=mt_rand(0,25);
$x2=mt_rand(45,55);
$y2=mt_rand(0,25);
$random=mt_rand(1000,9999);
$_SESSION['random']=$random;
$image=imagecreatetruecolor($width,$height);
$bg_color=imagecolorallocate($image,255,204,153);
$border_color=imagecolorallocate($image,255,51,0);
$pix_color=imagecolorallocate($image,255,255,255);
$font_color=imagecolorallocate($image,$r,$g,$b);
$line_color=imagecolorallocate($image,$g,$r,$b);
imagefilledrectangle($image,0,0,$width,$height,$bg_color);
for ($i=1;$i<500;$i++)
    {
     imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),$pix_color);
     }
imagerectangle($image,0,0,$width-1,$height-1,$border_color);
imageline($image,$x1,$y1,$x2,$y2,$line_color);
imagestring($image,5,$x,$y,$random,$font_color);
header("Content-type: image/png");
imagepng($image);
?>