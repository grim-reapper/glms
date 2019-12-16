<?php
include '../common.php';

//echo '<pre>'; print_r($_POST); echo '</pre>';

if(isset($_POST)) {
    
    $form_id = $_POST['form_id'];
    
    $fields_ids_list = array();

    foreach ($_POST['field'] as $position => $id) {
        $position = (int)$position + 1;
        $db->query("UPDATE `".$afp_conf['db']['prefix']."fields` SET position='".$position."' WHERE id='".$id."'");       
    }
    
    $fields_list = $form_fields->getData($form_id, '', true);      
    $merged_fields = $form_fields->getMergedFields($form_id);
            
    $options = $form_fields->getSingleRowsFields($fields_list, $merged_fields);
 
    $result = '';
        
    if( ! empty($options) ) {
        foreach($options as $value) {
            $result .= '<option value="'.$value['field_id'].'">'.$value['title'].'</option>';
        }
    }
    
    echo $result;
}
?>