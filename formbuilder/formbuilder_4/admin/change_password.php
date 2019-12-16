<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

if( !empty($_POST) ) {
    $output = $auth->changePassword();
}

$page_title = 'Change Password';

$change_password_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(isset($output)) {
    $class = ( ! $output['success'] ) ? 'warning' : 'note_ok';
    echo '<div class="'.$class.'">'.$output['message'].'</div>';
}
?>
    
    <h2>Change Password</h2>
    
    <form action="" method="post">
    
        <table class="fields" width="100%">
        
            <tr>
                <td><strong>Current:</strong></td>
                <td><input type="password" name="initial" /></td>
            </tr>
            
            <tr>
                <td style="border:none;" colspan="2"><hr style="border:1px solid #e7e7e7;" /></td>
            </tr>
            
            <tr>  
                <td><strong>New:</strong></td>
                <td><input type="password" name="new" /></td>
            </tr>
            
            <tr>  
                <td><strong>Confirm:</strong></td>
                <td><input type="password" name="new_confirm" /></td>
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