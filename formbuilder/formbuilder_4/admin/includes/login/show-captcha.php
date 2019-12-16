<?php
include_once '../common.php';
include_once $path_to_app.'includes/class.captcha.php';

$captcha = new Captcha();

$path_to_captcha_font = $path_to_app.'includes/fonts/verdana.ttf'; 

$captcha->charsNumber = 5;
$captcha->stringType = 2;
$captcha->fontSize = 13;

$captcha->textColor = array('r' => 191, 'g' => 120, 'b' => 120);
$captcha->backgroundColor = array('r' => 255, 'g' => 255, 'b' => 255);

$captcha->ttFont = $path_to_captcha_font;

$captcha->showImage(ADMIN_SALT_KEY.'login', 130, 46);
?>