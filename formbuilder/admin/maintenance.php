<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$upload_dir = $afp_conf['local']['path_to_uploader_uploads'];

if( !empty($_POST) ) {
    
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
    
    switch ($action) { 
        
    	case 'delete_past_uploaded_files':
        
            $past_days = $_POST['past_days'];
    
            if($past_days >= 0) {
                $days_in_seconds = (3600 * 24 * $past_days);
                $delete_before_date = time() - $days_in_seconds;        
                
                $app->deleteFromUploads($upload_dir, $delete_before_date, 1);
                
                $output = array('success' => 1, 'message' => $afp_conf['msg']['success']['delete_uploaded_files_done']);
        	}
        break;
    }
}

$page_title = 'Maintenance';

$maintenance_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(is_array($output)) {
    $class = ( ! $output['success'] ) ? 'warning' : 'note_ok';
    echo '<div class="'.$class.'">'.$output['message'].'</div>';
    
    if($output['success'] == 1) {
        echo '<div class="desc"><small>Note: If there are undeleted files, then the script didn\'t have enough permission to perform the deletion (e.g. file (belonging to other apache user) that was changed since it was uploaded).</small></div>';
    }
}

$upload_dir_from_root = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir);
?>
    
    <h2>Maintenance</h2>
    
    <div style="margin:0 0 10px 0;" class="desc">
        <span class="notice">Note</span> After a while you can delete the 'attachment' files uploaded in "uploads", as they can take lot of disk space. If you don't need the old ones or all, you can do some cleanup by removing them. Each form has its own folder, created each time the form - with attachment option - was loaded. By using the following option, the folders having files older than (X) days will get deleted. You can delete all by setting the days value to '0'.
    </div>
    
    <form action="" method="post" name="proceed_delete_past_uploaded_files" id="proceed_delete_past_uploaded_files">
        <input type="hidden" name="action" value="delete_past_uploaded_files" />
        <table class="list" width="100%">
            <tr>
                <td>"Uploads" Directory Location:</td>
                <td><em><?php echo $upload_dir_from_root; ?></em></td>
            </tr>
            <tr>
                <td>Delete files older than:</td>
                <td><input type="text" name="past_days" value="" />&nbsp;days<div style="margin:10px 0 0;"><small>Note: Values such as '0.5' (half a day), '0.04166' (approximation of 1 hour) are also accepted.</small></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input class="fancy-button-base matte-blue" type="submit" name="submit" value="Proceed" /></td>
            </tr>
        </table>
    </form>
    
<?php
include 'sections/footer.php';
?>