<?php
include '../common.php';

if( ! empty($_POST) ) {
    
    include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.webmasters.php';
    
    $manage_webmasters = new Manage_Webmasters($afp_conf, $db);
    
    $output = $manage_webmasters->add();
    
    $webmaster_id = $output['webmaster_id'];
    
    //echo '<pre>'; print_r($output); echo '</pre>';
    
    if( ! $webmaster_id ) {
        exit($app->DoJsonEncode($output));
    }
}

if(isset($webmaster_id)) { 
    
    $webmaster_name = $_POST['name'];
    $webmaster_email = $_POST['email'];
        
    ob_start();
    ?>

    <tr>
        <td id="name-<?php echo $webmaster_id; ?>"><?php echo $webmaster_name; ?></td>
        <td id="email-<?php echo $webmaster_id; ?>"><?php echo $webmaster_email; ?></td>
        <td><a class="edit_info2 edit_webmaster" href="#" rel="<?php echo $webmaster_id; ?>">Change</a></td>
        <td><a class="delete" rel="<?php echo $webmaster_id; ?>" href="#">Delete</a></td>
    </tr> 

<?php
$table_tr = ob_get_contents();

$out = array('success'    => 1,
             'message'    => $afp_conf['msg']['success']['webmaster_added'],
             'tr_content' => $table_tr);
       
ob_end_clean();

echo $app->DoJsonEncode($out);
}
?>