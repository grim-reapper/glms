<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

if( !empty($_POST) ) {
    $output = $auth->changeSecurityKey();
}

$page_title = 'Change Security Key';

$change_salt_key_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(is_array($output)) {
    $class = ( ! $output['success'] ) ? 'warning' : 'note_ok';
    echo '<div class="'.$class.'">'.$output['message'].'</div>';
}
?>
    
    <h2>Change Security Key</h2>
    
    <div style="margin:0 0 10px 0;" class="desc">
        <span class="notice">Note</span> This is like a super password used to encrypt some sensitive information that is stored in the database.    
    </div>
    
    <p><small>* the key must contain betweeen 10 and 20 characters (any spaces will be stripped)</small></p>
    
    <?php        
    if( ! is_writable($afp_conf['afp_security_key_file']) ) {
        
        $cfg_file_perms_error = str_replace('{PATH_TO_CONFIG_FILE}', $afp_conf['afp_security_key_file'], $afp_conf['msg']['error']['config_file_not_writable']);
        
        echo '<div class="warning">'.$cfg_file_perms_error.'</div>';
        
        $disable_update_button = true;
    }  
    ?>
    
    <form action="" method="post">
    
        <table class="fields" width="100%">
                                
            <tr>  
                <td><strong>New Key:</strong></td>
                <td><input type="text" name="new_key" size="38" /></td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" <?php if(!$disable_update_button) { ?> class="fancy-button-base matte-blue" <?php } else { ?> disabled="disabled" class="fancy-button-base light" <?php } ?> value="Update" /></td>
            </tr>
       
        </table>
    
    </form>
    
<?php
include 'sections/footer.php';
?>