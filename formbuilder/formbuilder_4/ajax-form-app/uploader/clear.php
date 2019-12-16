<?php
error_reporting(0);

// Directory containing the files
$dir  = $_POST['dir'];

// The actual file
$item = $_POST['item'];

$item = str_replace('&', '', $item);
$item = preg_replace('/\s{1,}/', '-', $item);
$item = preg_replace('/[^a-zA-Z0-9.\-_]+/i', '', $item);
$item = str_replace('^', '', $item);

// Full path to the file
$to_clear = getcwd() . '/uploads/'. $dir .'/'. $item;

//echo $to_clear;

// If the file exists, it will be removed
if(file_exists($to_clear)) {
    unlink($to_clear);    
}
?>