<?php
include '../common.php';

$form_id = (isset($_POST['form_id'])) ? (int)$_POST['form_id'] : false;

if($form_id) {
    echo $form->delete($form_id);
}
?>