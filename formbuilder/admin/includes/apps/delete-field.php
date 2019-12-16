<?php
include '../common.php';

$field_id = (isset($_POST['field_id'])) ? (int)$_POST['field_id'] : false;

if($field_id) {
    echo $form_fields->delete($field_id);
}
?>