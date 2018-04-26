<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$random = md5(rand());
$captcha = substr($random, 0, 7);
$_SESSION['captcha'] = $captcha;

$layer = imagecreatetruecolor(70, 30); // image identifier
$background = imagecolorallocate($layer, 255, 160, 119);
imagefill($layer, 0, 0, $background);
$textColor = imagecolorallocate($layer, 0, 0, 0);
imagestring($layer, 5, 5, 5, $captcha, $textColor);
header("Content-type: image/jpeg");
imagejpeg($layer);