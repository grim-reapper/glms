<?php
include '../common.php';

if(isSet($_GET['f']) && isSet($_GET['i'])) { // Are all the parameters sent?
    
    $f = $_GET['f']; // Folder path name
    $i = $_GET['i']; // Item/File name
    
    $full_path_to_file = $afp_conf['local']['path_to_uploader_uploads']. $f . '/' . $i;
    
    // Check if the file exists before attempting to download it
    // Both parameters sent to this file ('f' and 'i') must be correct
    
    if(file_exists($full_path_to_file)) { 
    
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        
        header("Content-Description: File Transfer");
        
        header("Content-Type: application/save");
        
        header("Content-Length: ".filesize($full_path_to_file));
        header("Content-Disposition: attachment; filename=".$i); 
        header("Content-Transfer-Encoding: binary");
        
        readfile($full_path_to_file);
        exit;
    }
    
}
?>