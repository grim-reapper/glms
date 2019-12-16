<?php
include '../common.php';

//.echo '<pre>'; print_r($conf); echo '</pre>';

$message_id = (isset($_POST['message_id'])) ? (int)$_POST['message_id'] : false;

if($message_id) {

    include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.messages.php';

    $manage_messages = new Manage_Messages($afp_conf, $db);

    echo $manage_messages->delete($message_id);
}
?>