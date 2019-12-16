<?php
include '../common.php';

if( ! empty($_POST) ) {
    //echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
    
    $field_id = (int)$_POST['field_id'];
    
    $text = $_POST['text'];
    $value = $_POST['value'];
    
    $attributes = $_POST['attributes'];
    
    $parent_option_id = (int)$_POST['parent_id'];
    
    $params = array(
        'field_id'   => $field_id,
        'text'       => $text,
        'value'      => $value,
        'attributes' => $attributes,
        'parent_id'  => $parent_option_id
    );
    
    $output = $form_fields->addOption($params);
    
    $option_id = $output['option_id'];
    
    if( ! $output['success'] ) {
        exit($app->DoJsonEncode($output));
    }
    
    //echo '<pre>'; print_r($output); echo '</pre>';
}

if($option_id) { 

    ob_start();
    ?>

    <tr id="option-id-<?php echo $option_id; ?>" class="list_row">
        <td width="7%"><img class="handle" src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/cursor-drag-arrow.png" width="16" height="16" /></td>
        <td>

        <div style="float:left; margin: 0 10px 0;">
        
        <input size="25" type="text" name="option[value][<?php echo $option_id; ?>]" value="<?php echo $text; ?>" />&nbsp;<input size="8" type="text" name="option[value][<?php echo $option_id; ?>]" value="<?php echo $value; ?>" placeholder="value" />
        
        <?php
        $parent_field_id = $db->getOne("SELECT parent_id FROM `".$afp_conf['db']['prefix']."fields` WHERE id='".$field_id."'");
        
        if($parent_field_id) {
            $parent_options = $form_fields->getOptions($parent_field_id);
        }
        if(isset($parent_options)) {
        ?>
        
            <select name="option[parent_id][<?php echo $option_id; ?>]">
                <option value="">Select parent...</option>
                <?php
                foreach($parent_options as $parent_option) {
                    if($parent_option_id == $parent_option['id']) {
                        $selected = 'selected="selected"';
                    } else {
                        $selected = '';
                    }
                    echo '<option '.$selected.' value="'.$parent_option['id'].'">'.$parent_option['value'].'</option>';
                }
                ?>
            </select>
        <?php
        }
        ?>
        </div>
                                                 
        <div style="float:left;"><a class="add_option_attribute" href="#" rel="<?php echo $option_id; ?>"><img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/add-attribute.png" width="22" height="22" alt="" /></a></div>
         
         <div id="attribute-area-option-id-<?php echo $option_id; ?>" style="display:none; clear:both; padding:10px 0 0 10px; font-weight:bold;">
         Attribute: <textarea cols="10" rows="2" name="option[attribute][<?php echo $option_id; ?>]"><?php echo $attributes; ?></textarea>
         </div>
        
        </td>
        <td><a class="delete_field_option" href="#" rel="<?php echo $option_id; ?>">Delete</a></td>
        <td><input class="option_id_checkbox" type="checkbox" name="del_o[]" value="<?php echo $option_id; ?>" /></td>
    </tr>

    <?php
    $table_tr = ob_get_contents();
    
    $out = array('success'    => 1,
                 'message'    => $afp_conf['msg']['success']['option_added'],
                 'tr_content' => $table_tr);
                 
    ob_end_clean();
    
    echo $app->DoJsonEncode($out);
}
?>