<?php
include '../common.php';
include '../headers.php';

error_reporting(0);

// Temp Dir Name
$temp_dir_name = $_POST['temp_dir_name'];

foreach($_SESSION['files_uploaded'][$temp_dir_name] as $file_session_key => $file_session_name) {    
    unset($_SESSION['files_uploaded'][$temp_dir_name][$file_session_key]);
}
?>