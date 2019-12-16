<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$page_title = 'Manage Webmasters';

$manage_webmasters_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';
?>
        
    <h2>Manage Webmasters (Recipients)</h2>
    
    <?php
    $webmasters = $db->getAll("SELECT id, name, email FROM `".$afp_conf['db']['prefix']."webmasters` ORDER BY id DESC");
    ?>
   
    
        <table id="webmasters-list" class="list" width="100%">
        
            <tr>
                <td width="22%"><strong>Name</strong></td>
                <td width="37%"><strong>E-Mail</strong></td>
                <td colspan="2"><strong>MANAGE</strong></td>
            </tr>
            
            <?php
            if( ! empty($webmasters) ) {
                  
                foreach($webmasters as $v_value) {
                    
                    $webmaster_id = $v_value['id'];
                    $webmaster_name = $v_value['name'];
                    $webmaster_email = $v_value['email'];
                ?>
                    <tr>
                        <td id="name-<?php echo $webmaster_id; ?>"><?php echo $webmaster_name; ?></td>
                        <td id="email-<?php echo $webmaster_id; ?>"><?php echo $webmaster_email; ?></td>
                        <td><a class="edit_info2 edit_webmaster" href="#" rel="<?php echo $webmaster_id; ?>">Change</a></td>
                        <td><a class="delete" rel="<?php echo $webmaster_id; ?>" href="#">Delete</a></td>
                    </tr>    
                <?php
                }
                
            }
            ?>
                      
        </table>
    
        <?php if( empty($webmasters) ) { ?>
    
        <div style="margin: 20px 0 0 0;"><span class="notice important">IMPORTANT</span> There are no recipients (e-mail addresses) added. Make sure you add at least one where the forms' information will be sent.</div>
    
        <?php } ?>

    <div style="margin: 20px 0 0 0;"><button class="add_new_webmaster_info fancy-button-base green">Add Recipient</button></div>

    <!-- [Start] Edit Webmaster Info -->
    <div id="edit-webmaster-info" title="Edit Webmaster's Details">
    	<form id="edit_webmaster">
        	<fieldset>
            
            <div id="response_note_edit"></div>
        
        		<label for="name">Name</label>
        		<input name="name" id="name" type="text" class="text ui-widget-content ui-corner-all" />
                
        		<label for="email">E-Mail</label>
        		<input name="email" id="email" type="text" class="text ui-widget-content ui-corner-all" />
            </fieldset>
            
            <input type="hidden" name="webmaster_id" id="webmaster_id" value="" />
               
    	</form>
    </div>
    <!-- [End] Edit Webmaster Info -->

    <!-- [Start] Add New Webmaster Info -->    
    <div id="add-new-webmaster-info" title="Add New Webmaster Info">
    	<form id="add_new_webmaster_info">
        	<fieldset>
            
            <div id="response_note_add"></div>
        
        		<label for="name">Name</label>
        		<input name="name" id="webmaster_name" type="text" class="text ui-widget-content ui-corner-all" />
                
        		<label for="email">E-Mail</label>
        		<input name="email" id="webmaster_email" type="text" class="text ui-widget-content ui-corner-all" />
            </fieldset>
            
            <input type="hidden" name="webmaster_id" id="webmaster_id" value="" />
               
    	</form>
    </div>
    <!-- [End] Add New Webmaster Info -->
    
<?php
include 'sections/footer.php';
?>