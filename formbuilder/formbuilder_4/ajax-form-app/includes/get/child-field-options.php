<?php
$path = dirname(dirname(dirname(__FILE__))).'/common.php';
include $path;

$option_value = $_POST['option_value'];
$field_id = (int)$_POST['field_id'];
$selected_child_id = $_POST['selected_child_id'];

echo '<option value="">...</option>';

if(!$option_value) exit;

// Get Option ID
$option_id = $db->getOne("SELECT id FROM `".$afp_conf['db']['prefix']."fields_options` WHERE field_id='".$field_id."' && value='".$option_value."'");

if(!$option_id) {
    $option_id = (int)str_replace('o', '', $option_value);
}

if($option_id != 0) {
    $child_field_options = $db->getAll("SELECT id, text, value, attributes FROM `".$afp_conf['db']['prefix']."fields_options` WHERE parent_id='".$option_id."'");
    
    foreach($child_field_options as $row) {
        $attributes = $row['attributes'];
        $text = $row['text'];
        $value = ($row['value']) ? $row['value'] : 'o'.$row['id'];
        
        if($selected_child_id == $value) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }
        
        echo '<option '.$selected.' '.$attributes.' value="'.$value.'">'.$text.'</option>'."\n";
    }
}
?>