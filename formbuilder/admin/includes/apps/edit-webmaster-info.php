<?php
include '../common.php';

if( ! empty($_POST) ) {
    
    $webmaster_id = (int)$_POST['webmaster_id'];
    
    if(!$webmaster_id) exit;

    include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.webmasters.php';
    
    $manage_webmasters = new Manage_Webmasters($afp_conf, $db);
            
    // -------- Name --------
    if(isset($_POST['name']) && isset($_POST['email'])) {
    
        //echo '<pre>'; print_r($_POST); echo '</pre>';
    
        echo $app->DoJsonEncode($manage_webmasters->update());
    }
}
?>