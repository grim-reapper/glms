<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

if( !empty($_POST) ) {
    $output = $auth->changeEmail();
}

$page_title = 'Change Password';

$change_password_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(isset($output)) {
    $class = ( ! $output['success'] ) ? 'warning' : 'note_ok';
    echo '<div class="'.$class.'">'.$output['message'].'</div>';
}

// Get current email
$initial = $db->getOne("SELECT email FROM `".$afp_conf['db']['prefix']."users` WHERE id='".$ses->get('user_id')."'");
?>
    
    <h2>Change E-Mail</h2>
    
    <form action="" method="post">
    
        <table class="fields" width="100%">
        
            <tr>
                <td><strong>Current:</strong></td>
                <td><strong><?php echo $initial; ?></strong></td>
            </tr>
            
            <tr>
                <td style="border:none;" colspan="2"><div style="margin:0;" class="desc"><span class="notice">Note</span> The e-mail address is used in case you forget the [login] password and you need to reset it. Therefore, make sure you type correctly the new email that will be associated with your account.</div></td>
            </tr>
            
            <tr>  
                <td><strong>New:</strong></td>
                <td><input type="text" name="new" size="28" /></td>
            </tr>
            
            <tr>  
                <td><strong>Confirm:</strong></td>
                <td><input type="text" name="new_confirm" size="28" /></td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" class="fancy-button-base matte-blue" value="Change" /></td>
            </tr>
       
        </table>
    
    </form>
    
<?php
include 'sections/footer.php';
?>