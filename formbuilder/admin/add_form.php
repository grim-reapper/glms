<?php
include 'includes/common.php';

//echo '<pre>'; print_r($_SESSION); echo '</pre>'; exit;

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

if( ! empty($_POST) ) {
    
    $output = $form->add();
    
    // Set the default form fields and redirect to the form configuration page
    
    if($output['success'] == 1) {
        
        $form_id = $output['form_id'];
        
        $form_fields->addDefaults($form_id);
        
        $app->redirect($conf['url']['path_to_afp_admin'].'edit_form_config.php?form_id='.$form_id);
    }
}

$page_title = 'New Form';

include 'sections/header.php';

include 'sections/navigation.php';
?>
    
    <h2>Add Form</h2>

    <?php
    if(isset($output)) {
        if( ! $output['success'] ) {
            echo '<div class="note_error">'.$output['message'].'</div>';
        }
    }
    ?>
    
    <form action="" method="post">
    
        <table class="fields" width="100%">
        
            <tr>
                <td width="20%">Name:</td>
                <td><input type="text" name="name" />&nbsp; <small>(for reference - e.g. "Contact Us", "Reservation Form", "Send Your Enquiry")</small></td>
            </tr>
            
            <tr>
                <td valign="top">Description:<br /><div style="margin:5px 0 0 0;"><small>* optional</small></div></td>
                <td><textarea style="width:60%;" name="description" cols="3" rows="3"></textarea></td>
            </tr>    
            
            <tr>
                <td>&nbsp;</td>
                <td><input class="fancy-button-base light" style="font-size:14px;" type="submit" name="submit" value="&raquo; Continue" /></td>
            </tr>         
            
        </table>
    
    </form>

<?php
include 'sections/footer.php';
?>