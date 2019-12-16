<?php
$prepare_values = false; // do not sanitize the data twice

include '../common.php';

if( ! empty($_POST) ) {
    
    $message_id = (int)$_POST['message_id'];
    
    if(!$message_id) exit;
    
    //echo '<pre>'; print_r($_POST); echo '</pre>';
        
    // -------- Name --------
    if(isset($_POST['from_whom'])) {
        include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.messages.php';
        $manage_messages = new Manage_Messages($afp_conf, $db);

        echo $app->DoJsonEncode($manage_messages->edit($message_id));
    }
}
?>