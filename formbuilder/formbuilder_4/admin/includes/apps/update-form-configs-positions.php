<?php
include '../common.php';

//echo '<pre>'; print_r($_POST); echo '</pre>';

if(isset($_POST)) {

    foreach ($_POST['row'] as $position => $id) {
        
        $position = (int)$position + 1;
        
        $db->query("UPDATE `".$afp_conf['db']['prefix']."config_names` SET `position`='".$position."' WHERE `id`=".$id);   
        
    }
}
?>