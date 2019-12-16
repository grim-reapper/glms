<?php
include '../common.php';

//.echo '<pre>'; print_r($conf); echo '</pre>';

$webmaster_id = (isset($_POST['webmaster_id'])) ? (int)$_POST['webmaster_id'] : false;

if($webmaster_id) {

    include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.webmasters.php';

    $manage_webmasters = new Manage_Webmasters($afp_conf, $db);

    echo $manage_webmasters->delete($webmaster_id);
}
?>