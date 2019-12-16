<?php
include '../common.php';

if( ! empty($_POST) ) {
    
    //echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
    
    $field_id = $_POST['field_id'];
    $attribute = $_POST['attribute'];
    
    //echo '<pre>'; print_r($attribute); echo '</pre>';
    
    $output = $form_fields->addAttributes($field_id, $attribute, 1);
    
    $attribute_id = $output['attribute_id'];
    
    if( ! $output['success'] ) {
        exit($app->DoJsonEncode($output));
    }
    
    //echo '<pre>'; print_r($output); echo '</pre>';
}

if($attribute_id) { 
    
    $attribute_name = $attribute['name'];
    $attribute_value = $attribute['value'];
    
    ob_start();
    ?>                                   
    <tr id="attribute-id-<?php echo $attribute_id; ?>">
          <td><input size="10" type="text" name="attribute[name][<?php echo $attribute_id; ?>]" value="<?php echo $attribute_name; ?>" /></td>
          <td><input type="text" name="attribute[value][<?php echo $attribute_id; ?>]" value="<?php echo $attribute_value; ?>" /></td>
          <td><a class="delete_field_attribute" href="#" rel="<?php echo $attribute_id; ?>">Delete</a></td>
    </tr>

    <?php
    $table_tr = ob_get_contents();
    
    $out = array('success'    => 1,
                 'message'    => $afp_conf['msg']['success']['attribute_added'],
                 'tr_content' => $table_tr);
                 
    ob_end_clean();
    
    echo $app->DoJsonEncode($out);
}
?>