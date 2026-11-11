<?php
$src = 'd:\xampp_new\htdocs\Dr.Mohamed Hamza El-Sheikh\public\front\assets\img\logo\Silver-blue.png';
$dest = 'd:\xampp_new\htdocs\Dr.Mohamed Hamza El-Sheikh\public\front\assets\img\favicon.png';

$img = imagecreatefrompng($src);
$info = getimagesize($src);
$w = $info[0];
$h = $info[1];
$size = max($w, $h);

$new = imagecreatetruecolor($size, $size);
imagealphablending($new, false);
imagesavealpha($new, true);
$trans = imagecolorallocatealpha($new, 255, 255, 255, 127);
imagefilledrectangle($new, 0, 0, $size, $size, $trans);

$x = ($size - $w) / 2;
$y = ($size - $h) / 2;
imagecopy($new, $img, $x, $y, 0, 0, $w, $h);

$final = imagecreatetruecolor(192, 192);
imagealphablending($final, false);
imagesavealpha($final, true);
imagefilledrectangle($final, 0, 0, 192, 192, $trans);
imagecopyresampled($final, $new, 0, 0, 0, 0, 192, 192, $size, $size);

imagepng($final, $dest);
echo 'Favicon created!';
