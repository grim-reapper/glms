<?php
include '../common.php';
include '../headers.php';

error_reporting(0);

// Item Name
$item_name = $_POST['item_name'];

// Temp Dir Name
$temp_dir_name = $_POST['temp_dir_name'];

// Sub-folder
$subfolder = $_POST['subfolder'];

// Full path to the file
$to_clear = $afp_conf['local']['path_to_uploader_uploads'] . $subfolder . '/'. $temp_dir_name . '/' . $item_name;

// If the file exists, it will be removed
if(file_exists($to_clear)) {
    unlink($to_clear);   
    echo 1;
}

//echo '<pre>'; print_r($_SESSION); echo '</pre>';

foreach($_SESSION['files_uploaded'][$temp_dir_name] as $file_session_key => $file_session_name) {
    
    //echo $file_session_key.'<br />';
    
    if($file_session_name == $item_name) {
        unset($_SESSION['files_uploaded'][$temp_dir_name][$file_session_key]);
    }
}
?>