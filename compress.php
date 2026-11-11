<?php
$src = 'd:\xampp_new\htdocs\Dr.Mohamed Hamza El-Sheikh\public\front\assets\img\dr.jpg';
$dest = 'd:\xampp_new\htdocs\Dr.Mohamed Hamza El-Sheikh\public\front\assets\img\dr_og.jpg';
$info = getimagesize($src);
$img = imagecreatefromjpeg($src);
$w = $info[0];
$h = $info[1];
$max = 800;

if ($w > $max || $h > $max) {
    if ($w > $h) {
        $nw = $max;
        $nh = floor($h * ($max / $w));
    } else {
        $nh = $max;
        $nw = floor($w * ($max / $h));
    }
    $newImg = imagecreatetruecolor($nw, $nh);
    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
    imagejpeg($newImg, $dest, 75);
    imagedestroy($newImg);
} else {
    imagejpeg($img, $dest, 75);
}
imagedestroy($img);
echo 'Compressed successfully to ' . filesize($dest) . ' bytes.';
