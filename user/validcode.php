<?php

header("Content-Type:image/png");
session_start();

$code = "";
$arr = array();
for($i=0;$i<4;$i++){

    $arr[$i] = rand(0,9);
    $code .= (string)$arr[$i];
}

$_SESSION["validcode"] = $code;
$width = 100;
$height = 25;
$img = imagecreatetruecolor($width,$height);
$backcolor = imagecolorallocate($img,0,0,0);
imagefill($img,0,0,$backcolor);

for($i=0;$i<4;$i++){

    $textcolor = imagecolorallocate($img,rand(50,180),rand(50,180),rand(50,180));
    imagechar($img,12,7+$i*25,3,(string)$arr[$i],$textcolor);
}

imagepng($img);

imagedestroy($img);
?>