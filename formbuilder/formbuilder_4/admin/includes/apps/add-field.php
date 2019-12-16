<?php
include '../common.php';

if( ! empty($_POST) ) {
    
    //echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
    
    $output = $form_fields->add();
    
    $field_id = $output['field_id'];
    
    if( ! $output['success'] ) {
        exit($app->DoJsonEncode($output));
    }
    
    //echo '<pre>'; print_r($output); echo '</pre>';


if(isset($field_id)) { 
    $out = array('success'    => 1,
                 'message'    => $afp_conf['msg']['success']['form_field_added'],
                 'field_id'   => $field_id);
                 
    echo $app->DoJsonEncode($out);
}

}
?>