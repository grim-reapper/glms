<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$form_id = (isset($_REQUEST['form_id'])) ? $_REQUEST['form_id'] : '';

if(!$form_id) exit('No form id was requested!');

list($name, $description) = $form->getInfo($form_id);

//echo '<pre>'; print_r($_POST); echo '</pre>';

if(isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    
    include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.messages.php';
    
    $manage_messages = new Manage_Messages($afp_conf, $db);
    
    switch ($action) {
        case 'delete_selected_msg':
            $manage_messages->delete_all();
        break;
        
        case 'export_submitted_fields':
            $manage_messages->export_submitted_fields();
        break;

        case 'export_messages':
            $manage_messages->export_messages($_POST['form_id']);
        break;
        
        case 'edit_submitted_fields_values':
            $output = $manage_messages->edit_submitted_fields_values();
        break;
    }    
}

$page_title = 'Manage Form ['.$name.'] Messages';

$manage_messages_page = 1;

include 'includes/classes/class.pagination.php';

$pagination = new Pagination($db);

$pagination->main_url = $conf['url']['path_to_afp_admin'].'manage_messages.php';
$pagination->max_results = 20; // Results per page

$query_all = "SELECT id, from_whom, subject, message, ip, date_added FROM `".$afp_conf['db']['prefix']."data` WHERE form_id='".$form_id."' ORDER BY date_added DESC";
$pagination->all_query = $query_all;

$pagination_result = $pagination->Generate();

$pagination_html = $pagination_result['pagination'];
$db_current_query = $pagination_result['current_query'];

$messages = $db->getAll($db_current_query);

include 'sections/header.php';

include 'sections/navigation.php';
?>

<div style="width:100%; clear:both;">
    <div style="float: left;"><h2><?php echo $name; ?></h2></div>
    <div style="float: right; margin:12px 0 0 0;"><strong><a href="edit_form_fields.php?form_id=<?php echo $form_id; ?>">Manage Form's Fields</a></strong> | <strong><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>manage_forms.php">&laquo; Back to forms' list</a></strong></div>
    <div style="clear: both;"></div>
</div>

<?php if($description) { ?>
    <div class="desc"><?php echo $description; ?></div>
<?php } ?>


    <div class="column">
        
    <p><strong>MANAGE FORM MESSAGES</strong></p>


        <?php
        if( ! empty($messages) ) {
        ?>
            <form name="delete_selected_msg_form" id="delete_selected_msg_form" action="" method="post">
            
                <input type="hidden" name="action" value="delete_selected_msg" />
            
                <table class="message_list" id="message_list" width="100%">
                
                    <tr class="header_list">
                        <td>#</td>
                        <td><strong>From Whom?</strong></td>
                        <td><strong>Subject</strong></td>
                        <td><strong>Message</strong></td>
                        <td><strong>IP Address</strong></td>
                        <td><strong>Date Recorded</strong></td>
                        <td><strong>Actions</strong></td>
                    </tr>
                    
                    <?php   
                    foreach($messages as $v_value) {
                        $row_id = $v_value['id'];
                        $from_whom = $v_value['from_whom'];
                        $subject = $v_value['subject'];
                        $message = $v_value['message'];
                        $ip = $v_value['ip'];
                        $date_added = date('d/m/Y H:i:s', $v_value['date_added']);
                    ?>
                        <tr class="ml_r list_row" id="r-m-info-<?php echo $row_id; ?>">
                            <td><a name="row_id_<?php echo $row_id; ?>"></a><input class="checkbox msg_chk" type="checkbox" name="message_id[]" value="<?php echo $row_id; ?>" /></td>
                            <td valign="top"><span id="from-whom-<?php echo $row_id; ?>"><?php echo $from_whom; ?></span></td>
                            <td valign="top"><span id="subject-<?php echo $row_id; ?>"><?php echo $subject; ?></span></td>
                            <td valign="top"><a class="toggle_msg" rel="<?php echo $row_id; ?>" href="#"><strong>Toggle</strong></a></td>
                            <td valign="top"><a class="show" target="_blank" href="http://cqcounter.com/whois/?query=<?php echo $ip; ?>"><?php echo $ip; ?></a></td>
                            <td valign="top"><?php echo $date_added; ?></td>
                            <td valign="top"><a class="more" href="#" rel="<?php echo ($row_id + 10); ?>">More</a></td>
                        </tr>   
                        <tr id="r-m-message-<?php echo $row_id; ?>" class="message_area">
                            <td class="message_cell" colspan="7"><div id="message-content-<?php echo $row_id; ?>" style="width:auto; padding:12px;"><?php echo $message; ?></div></td>
                        </tr>
                        
                        <?php
                        $message_id = (int)$_REQUEST['message_id'];
                        
                        if(in_array($action, array('show_submitted_fields', 'edit_submitted_fields_values')) && $message_id && $message_id == $row_id) {
                            ?>
                            <tr id="r-m-submitted-fields-<?php echo $row_id; ?>">
                                <td colspan="7" class="message_cell">
                                
                                <?php
                                if(isset($output)) {
                                    
                                    $note_status = ($output['success'] == 1) ? 'ok' : 'error';
                                    ?>
                                    <div class="note_<?php echo $note_status; ?>"><?php echo $output['message']; ?></div>
                                <?php 
                                }
                                ?>                                
                                                            
                                <form action="" method="post">
                                
                                    <?php
                                    $q = $db->query("SELECT f.text as title, df.value, df.id FROM `".$afp_conf['db']['prefix']."data_fields` df
                                    LEFT JOIN `".$afp_conf['db']['prefix']."fields` f ON (f.id = df.field_id)
                                    WHERE df.message_id='".$message_id."' ORDER BY f.position");
                                    
                                    while($row = $db->fetch($q)) {
                                        echo '<p><label for="row_id_'.$row['id'].'">'.$row['title'].'</label></p>
                                        <p><textarea style="width:40%;" rows="4" id="row_id_'.$row['id'].'" name="row_id['.$row['id'].']">'.$row['value'].'</textarea></p>';  
                                    }
                                    ?>
                                    
                                    <input type="hidden" name="action" value="edit_submitted_fields_values" />
                                    <input class="fancy-button-base green" type="submit" name="submit" value="Edit Submitted Fields' Values" />
                                
                                </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        
                    <?php
                    }
                    ?>
                            
                </table>
            </form>
            
            <div style="width:100%;">
                <div style="margin: 20px 0 0 0; width:50%; float:left;">Export All Form's &nbsp;&nbsp; <a class="export" id="export_stored_msg_fields_btn" href="#">Submitted Fields</a> &nbsp;&nbsp; <a class="export" id="export_messages_btn" href="#">Messages</a></div>
                <div style="margin: 20px 0 0 0; width:23%; float:right;"><a class="toggle_checkboxes" href="#">Check All</a>&nbsp;<a class="del_all_msg" id="delete_selected_btn" href="#">Delete Checked</a></div>
            </div>
            
            <div style="clear: both;"></div>
            
            <br />
            
            <div id="afp_pg"><?php echo $pagination_html; ?></div>
        
        <?php
        } else {
        ?>
        <div class="desc">No submissions were made for this form, yet!</div>
        <?php
    }
    ?>
    
    </div>
 
    <!-- [START] EDIT MESSAGE DETAILS DIALOG -->
    <div id="edit-message-details" title="Edit Message Details">
    	<form id="edit_message">
        	<fieldset>
            
            <div id="response_note"></div>
        
        		<label for="name">From Whom?</label>
        		<input name="from_whom" id="from_whom" type="text" class="text ui-widget-content ui-corner-all" />

        		<label for="name">Subject</label>
        		<input name="subject" id="subject" type="text" class="text ui-widget-content ui-corner-all" />
                
        		<label for="email">Description</label>
        		<textarea name="message" id="message" rows="9" class="text ui-widget-content ui-corner-all"></textarea>
            </fieldset>
                          
    	</form>
    </div>
    <!-- [END] EDIT MESSAGE DETAILS DIALOG -->   

    <!-- [START] EXPORT SUBMITTED FIELDS -->
    <div id="export-submitted-fields-box" title="Export Submitted Fields">
    	<form id="export_submitted_fields_form" action="" method="post">
            
            <input type="hidden" name="action" value="export_submitted_fields" />
            <input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
            
            <em>* Hold Ctrl and use the left-mouse button to select the fields you wish to export (all fields are already selected by default)</em>
        	<fieldset>
                <select style="max-height:300px;" name="fields_to_export[]" multiple="multiple">
                    <?php
                    $query_fields = $db->query("SELECT id, text FROM `".$afp_conf['db']['prefix']."fields` WHERE form_id='".$form_id."' ORDER BY `position` ASC");
                
                    while($value = $db->fetch($query_fields)) {
                        echo '<option selected="selected" value="'.$value['id'].'">'.$value['text'].'</option>';
                    }
                    ?>
                </select>
            </fieldset>                 
    	</form>
    </div>
    <!-- [END] EXPORT SUBMITTED FIELDS -->   
    
    <form id="export_messages_form" name="export_messages_form" action="" method="post">
        <input type="hidden" name="action" value="export_messages" />
        <input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
    </form>
    
<?php
include 'sections/footer.php';
?>