<?php
include '../common.php';

$layout_id = (isset($_POST['layout_id'])) ? (int)$_POST['layout_id'] : false;

if($layout_id) {
    
    include '../classes/class.manage.templates.php';

    $manage_layouts = new Manage_Templates($afp_conf, $db);    
    
    echo $manage_layouts->delete($layout_id);
}
?>