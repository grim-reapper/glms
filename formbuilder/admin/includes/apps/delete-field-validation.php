<?php
include '../common.php';

$validation_id = (isset($_POST['validation_id'])) ? (int)$_POST['validation_id'] : false;

//echo '<pre>'; print_r($_POST); echo '</pre>';

if($validation_id) {
    echo $form_fields->deleteValidation($validation_id);
}
?>