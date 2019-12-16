<?php
include '../common.php';

$option_id = (isset($_POST['option_id'])) ? (int)$_POST['option_id'] : false;

//echo '<pre>'; print_r($_POST); echo '</pre>';

if($option_id) {
    echo $form_fields->deleteOption($option_id);
}
?>