<?php
//echo '<pre>'; print_r($_POST); echo '</pre>'; exit;

if( ! empty($_POST) ) {

    $prepare_values = false;
    
    include '../common.php';    
    
    $field_id = $_POST['field_id'];
    $validation = $_POST['validation'];
    
    //echo '<pre>'; print_r($validation); echo '</pre>'; exit;
    
    $output = $form_fields->addValidation($field_id, $validation);
    
    $validation_id = $output['validation_id'];
    
    if( ! $output['success'] ) {
        exit($app->DoJsonEncode($output));
    }
    
    //echo '<pre>'; print_r($output); echo '</pre>';
}

if($validation_id) { 
    
    $type = $validation['type'];
    $validation_types = $form_fields->getValidationTypes();    
    $validation_type_text = $validation_types[$type];
    
    $error_message = stripslashes($validation['message']);
    $value = (!$validation['value']) ? '...' : $validation['value'];

    if( ($type == 'basic' || $type == 'email' || $type == 'numeric')) {
        $value = '...';
        $no_value_input = true;
    } else {
        $no_value_input = false;
    } 
    
    ob_start();
    ?>

<tr id="validation-id-<?php echo $validation_id; ?>">
    <td valign="top" width="20%"><?php echo $type; ?></td>
    <td valign="top"><textarea style="width:330px;" rows="3" name="validation[error_message][<?php echo $validation_id; ?>]"><?php echo $error_message; ?></textarea></td>
    <td valign="top"><?php if(!$no_value_input) { ?><input size="8" type="text" name="validation[value][<?php echo $validation_id; ?>]" value="<?php echo $value; ?>" /><?php } else { echo $value; } ?></td>
    <td valign="top"><a class="delete_field_validation" href="#" rel="<?php echo $validation_id; ?>">Delete</a></td>
</tr>

    <?php
    $table_tr = ob_get_contents();
    
    $out = array('success'    => 1,
                 'message'    => $afp_conf['msg']['success']['validation_added'],
                 'tr_content' => $table_tr);
                 
    ob_end_clean();
    
    echo $app->DoJsonEncode($out);
}
?>