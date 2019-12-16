<?php
error_reporting (E_ALL ^ E_NOTICE);

include 'headers.php';
//echo '<pre>'; print_r($_POST); echo '</pre>';
//echo '<pre>'; print_r($_SESSION); echo '</pre>';

if(isSet($_GET['form_id'])) {
    $form_id = $_GET['form_id'];
    $form_id = (int)preg_replace('/[^0-9+]/', '', $form_id);
    
    if(isSet($_POST['security_code'])) {
    
        $to_check = md5( strtolower(trim($_POST['security_code'])) );
        $token = ($_SESSION[$form_id.'_captcha_security_code'] == '') ? $_COOKIE[$form_id.'_captcha_security_code'] : $_SESSION[$form_id.'_captcha_security_code'];
        
        //echo $to_check;
        
        echo ( ($to_check == $token) ? 1 : '' ); 
    }
}
?>