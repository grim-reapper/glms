<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$mode = (isset($_POST['mode'])) ? $_POST['mode'] : '';

if($mode == 'clone') {
    $form_id = (int)$_POST['form_id'];
    $new_form_id = $form->cloneData($form_id);
}

if($mode == 'export_messages') {
    include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.messages.php';
    
    $manage_messages = new Manage_Messages($afp_conf, $db);
    $manage_messages->export_messages();
}

$page_title = 'Manage Forms';

$manage_forms_page = 1;

include 'includes/classes/class.pagination.php';

$pagination = new Pagination($db);

$pagination->main_url = $conf['url']['path_to_afp_admin'].'manage_forms.php';
$pagination->max_results = 10; // Results per page

$forms_query_all = "SELECT id, name, description FROM `".$afp_conf['db']['prefix']."forms` ";

$keyword = filter_input(INPUT_POST | INPUT_GET, 'keyword', FILTER_SANITIZE_SPECIAL_CHARS);
$search_by = (isset($_REQUEST['search_by'])) ? $_REQUEST['search_by'] : '';

if($keyword && $search_by) {
    
    $keyword = trim($keyword);
    
    $q_part = "WHERE ";
     
    switch ($search_by) { 
    	case 'form_id':
            $q_part .= "id='".(int)$keyword."'";
    	break;
    
    	case 'form_name':
            $q_part .= "name REGEXP '".$keyword."'";
    	break;
    
    	case 'form_description':
            $q_part .= "description REGEXP '".$keyword."'";
    	break;
    }
} else {
    $q_part = '';
}

$forms_query_all .= $q_part." ORDER BY date_added DESC";

$pagination->all_query = $forms_query_all;

$pagination_result = $pagination->Generate();

$pagination_html = $pagination_result['pagination'];
$db_current_forms_query = $pagination_result['current_query'];

$forms = $db->getAll($db_current_forms_query);

include 'sections/header.php';
include 'sections/navigation.php';

if(isset($output)) {
    if( ! $output['success'] ) {
        echo '<div class="note_error">'.$output['message'].'</div>';
    }
}
?>
    
    <h2>Manage Forms</h2>
    
    <form action="manage_forms.php" method="get">
    <div style="margin: 0 0 15px 0; float:right; width:490px;">Keyword: <input class="input-medium" type="text" name="keyword" value="<?php echo $keyword; ?>" />&nbsp; by <strong>Form</strong>
    &nbsp;
    
    <select name="search_by">
        <option <?php if($search_by == 'form_id') { echo 'selected="selected"'; } ?> value="form_id">ID</option>
        <option <?php if($search_by == 'form_name') { echo 'selected="selected"'; } ?> value="form_name">Name</option>
        <option <?php if($search_by == 'form_description') { echo 'selected="selected"'; } ?> value="form_description">Description</option>
    </select>
    &nbsp;
    
    <input class="fancy-button-base light" style="font-size:13px;" type="submit" name="search" value="Search" /></div>
    </form>
    
    <div style="clear:both;"></div>
    
    <?php    
    if( ! empty($forms) ) {
    ?>
    
        <table class="fields" width="100%">
        
            <tr class="heading">
                <td width="5%" style="border:none; background-color:white !important;">&nbsp;</td>
                <td><strong>ID</strong></td>
                <td width="25%"><strong>NAME</strong></td>
                <td width="37%"><strong>DESCRIPTION</strong></td>
                <td><strong>MANAGE</strong></td>
            </tr>
            
            <?php                    
            foreach($forms as $v_value) {
                
                $form_id = $v_value['id'];
                $name = $v_value['name'];
                $description = $v_value['description'];
                
                if($description) {
                    if(strlen($description) < $conf['short_desc_chars']) {
                        $description_short = $description;
                        $is_shorten = false;
                    } else {
                        $is_shorten = true;
                        $description_short = substr($description, 0, $conf['short_desc_chars']).'...';
                    }
                    
                    $description_full = $description;
                    
                } else {
                    $is_shorten = false;
                    $description_short = '<em>none</em>';
                    $description_full = '';
                }
            ?>
                <tr class="list_row" id="f-r-<?php echo $form_id; ?>">
                    <td><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" title="Preview"><img src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/images/icons/show-24x24.png" width="24" height="24" alt="" border="0" /></a></td>
                    <td><?php echo $form_id; ?></td>
                    <td id="name-<?php echo $form_id; ?>"><?php echo $name; ?> <?php if(isset($new_form_id) && $new_form_id == $form_id) { echo ' - <font color="green">form created successfully</font>'; } ?></td>
                    <td <?php if($is_shorten) { ?> class="desc" <?php } ?> id="description-<?php echo $form_id; ?>"><?php echo $description_short; ?></td>
                    <td><span class="full_desc" id="description-full-<?php echo $form_id; ?>"><?php echo $description_full; ?></span><a class="manage_fields" href="<?php echo $conf['url']['path_to_afp_admin'].'edit_form_fields.php?form_id='.$form_id; ?>">Fields</a><a class="edit_config" href="<?php echo $conf['url']['path_to_afp_admin'].'edit_form_config.php?form_id='.$form_id; ?>">Configs</a><a class="edit_info" href="#" rel="<?php echo $form_id; ?>">Info</a><a class="messages" href="manage_messages.php?form_id=<?php echo $form_id; ?>">Messages</a><a class="more" href="#" rel="<?php echo ($form_id + 10); ?>">More</a></td>
                </tr>    
            <?php
            }
            ?>
                    
        </table>
        
        <br />
        
        <div id="afp_pg"><?php echo $pagination_html; ?></div>

    <div class="bottom_nav" align="right">
        <a id="export_messages_btn" class="export_all" href="#"><strong>Export All Messages</strong></a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="integrate" href="#"><strong>Integrate Form(s) Into My Web Page</strong></a>    
    </div>    
    
    <?php } else { ?>
    
    <div>
    
    <?php
    if($keyword) {
    ?>
        No forms were found matching your search criteria.
    <?php
    } else {  
    ?>
        There are no forms to manage. Click <a href="<?php echo $conf['url']['path_to_afp_admin']; ?>add_form.php"><strong>here</strong></a> to add one.
    <?php
    }
    ?>
    </div>
    
    <?php } ?>
    
    <!-- [START] EDIT FORM INFORMATION DIALOG -->
    <div id="edit-form-info" title="Edit Form Information">
    	<form id="edit_form">
        	<fieldset>
            
            <div id="response_note"></div>
        
        		<label for="name">Name</label>
        		<input name="name" id="name" type="text" class="text ui-widget-content ui-corner-all" />
                
        		<label for="email">Description</label>
        		<textarea name="description" id="description" rows="3" cols="2" class="text ui-widget-content ui-corner-all"></textarea>
            </fieldset>
            
            <input type="hidden" name="form_id" id="form_id" value="" />
               
    	</form>
    </div>
    <!-- [END] EDIT FORM INFORMATION DIALOG -->
    
    <!-- [START] INTEGRATE FORM DIALOG -->
    <div id="select-integration" title="How to Integrate the Form(s)?">
    	<form id="select_integration">
        	<fieldset>

                <div style="width:100%;">
                    
                    <div id="no_form_alert"></div>
                        
                    <div style="float:left; margin: 0 25px 0 0;">
                        <p>Select the form(s):</p>
                        <select style="min-width:160px; max-width: 265px;" multiple="multiple" id="forms" name="forms[]">
                            <?php
                            $total_forms = count($forms);
                            
                            foreach($forms as $v_value) {
                                $selected = ($total_forms == 1) ? 'selected="selected"' : '';
                                echo '<option '.$selected.' value="'.$v_value['id'].'">'.$v_value['name'].'</option>'."\n";
                            }
                            ?>
                        </select>  
                    </div>
                    
                    <div style="float:left; margin: 0 25px 0 0;">
                    <p>Method:</p>             
                        <select id="integration_method" name="integration_method">
                            <option value="iframe">iFrame(s)</option>
                            <option value="copy_php_code">Copy PHP Code(s)</option>
                        </select>    
                    </div>
                    
                    <div style="clear: both;"></div>
                    
                    <div style="margin:5px 0 0 0;">* <small>Hold Ctrl and use the left-mouse button to select multiple forms (in case you wish to add more than 1 form in the same page)</small></div>
                    
                </div>
                                            
                <div class="desc" style="font-size: 11px; margin: 10px 0 0 0; width: 94%;">
                    <div style="display:none;" id="iframe_info"><span class="notice">Note</span> This is the easiest and convenient method to integrate the form(s). You just have to copy &amp; paste the provided HTML code(s) into your webpage (you can even copy it in .HTML pages; the PHP code will load inside the iFrame(s)).</div>
                    <div style="display:none;" id="copy_php_code_info"><span class="notice">Note</span> This is a bit more advanced way of integrating the form(s) as it requires you to copy blocks of code into your .php pages.</div>
                </div>       

                <div id="lightbox_desc">
                    <div style="width:100%; margin: 12px 0 12px;">
                        Type: <select id="integration_type" name="integration_type">
                        <option value="web_page">Web page</option>
                        <option value="lightbox">Lightbox</option>
                        </select>
                    </div>
                    
                   
                    <div style="clear:both;"></div>
                    
                </div>
                
            </fieldset>
                           
    	</form>
    </div>
    <!-- [END] INTEGRATE FORM DIALOG -->

    <!-- Clone Form -->
    <form name="clone_form" id="clone_form" action="manage_forms.php" method="post">
        <input type="hidden" name="mode" value="clone" />    
        <input type="hidden" name="form_id" id="clone_from_form_id" value="" />
    </form>

    <form id="export_messages_form" name="export_messages_form" action="" method="post">
        <input type="hidden" name="mode" value="export_messages" />
    </form>

<?php
include 'sections/footer.php';
?>