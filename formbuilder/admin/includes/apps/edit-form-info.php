<?php
include '../common.php';

if( ! empty($_POST) ) {
    
    $form_id = (int)$_POST['form_id'];
    
    if(!$form_id) exit;
    
    //echo '<pre>'; print_r($_POST); echo '</pre>';
        
    // -------- Name --------
    if(isset($_POST['name'])) {
        echo $app->DoJsonEncode($form->updateInfo());
    }
}
?>