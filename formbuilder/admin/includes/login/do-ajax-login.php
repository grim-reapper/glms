<?php
include '../common.php';

$post = (!empty($_POST)) ? true : false;

if($post) {

    extract($_POST);
    
    /* 
    
    RESPONSES:
    
    1 - Both username and password must be entered
    2 - Incorrect Login
    3 - Incorrect & Enable CAPTCHA
    
    4 - Security Code was not typed correctly
    
    5 - Locked/Banned
    
    6 - Successful Login
    
    */
    
    if(!$username || !$password) {
        echo 1;
    } else {
    
        $credentials = array('username'       => $username,
        	                 'password'       => $password,
                             'remember_me'    => $remember_me,
        	                 'security_code'  => $security_code);
                             
        $response = $auth->checkLogin($credentials);
        
        if($response == 'is_valid') {
            echo 6;
        } elseif($response == 'banned') {
            echo 5;
        } elseif($response == 'incorrect_captcha') {
            echo 4;
        } elseif($response == 'incorrect_enable_captcha') {
            echo 3;
        } else {
            echo 2;
        }
    }
}
?>