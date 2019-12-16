<?php
include '../common.php';

$attribute_id = (isset($_POST['attribute_id'])) ? (int)$_POST['attribute_id'] : false;

//echo '<pre>'; print_r($_POST); echo '</pre>';

if($attribute_id) {
    echo $form_fields->deleteAttribute($attribute_id);
}
?>