<?php
$prepare_values = false;

include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

include 'includes/classes/class.manage.templates.php';

$manage_templates = new Manage_Templates($afp_conf, $db);

if( ! empty($_POST) ) {
    
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if($action == 'new') {
        
        $output = $manage_templates->add();
        $layout_id = $output['layout_id'];
        
    } else if($action == 'edit') {
        $edit_output = $manage_templates->update();
    }    
}

if(isset($_REQUEST['mode'])) {
    $mode = $_REQUEST['mode'];
} else {
    $mode = 'main';
}

$page_title = 'Manage Templates';

$manage_templates_page = 1;

include 'sections/header.php';
include 'sections/navigation.php';
?>
    
    <?php
    if(isset($output)) {
        
        $note_status = ($output['success'] == 1) ? 'ok' : 'error';
        ?>
        <div class="note_<?php echo $note_status; ?>"><?php echo $output['message']; ?></div>
    <?php 
    }
    ?>
    
    <h2>Manage Templates</h2>
    
    <?php
    if($mode == 'main') {
    ?>
    
    <p>- <strong>Defaults</strong></p>
    
        <table class="list" width="100%">
        
            <tr>
                <td width="45%"><strong>Name</strong></td>
                <td><strong>MANAGE</strong></td>
            </tr>
            
            <?php
            $main = array();
            
            $templates = $db->getAll("SELECT id, name, custom FROM `".$afp_conf['db']['prefix']."layouts`");
                    
            foreach($templates as $v_value) { 
                
                $id = $v_value['id'];
                $name = $v_value['name'];
                $custom = ($v_value['custom'] == 1) ? 'custom' : 'default';
                
                $main[$custom][] = array('id' => $id, 
                                         'name' => $name);
            }
            
            //echo '<pre>'; print_r($main); echo '</pre>';
                
            // Show the defaults one first    
            foreach($main['default'] as $v_value) {
            ?>
                <tr>
                    <td><?php echo $v_value['name']; ?></td>
                    <td><a class="edit_info2" href="manage_templates.php?mode=edit&layout_id=<?php echo $v_value['id']; ?>">Edit</a> </td>
                </tr>    
            <?php
            }            
            ?>
            </table>
            
            <?php
            if( ! empty($main['custom'])) {
            ?>
            
            <p>- <strong>Customs</strong></p>
            
                <table class="list" width="100%">
                <?php
                foreach($main['custom'] as $v_value) {
                    $custom_id = $v_value['id'];
                    $custom_name = $v_value['name'];
                ?>
                    <tr>
                        <td><?php echo $custom_name; ?></td>
                        <td><a class="edit_info2" href="manage_templates.php?mode=edit&layout_id=<?php echo $v_value['id']; ?>">Edit</a><a class="delete" rel="<?php echo $custom_id; ?>" href="#">Delete</a></td>
                    </tr>                
                <?php    
                }
                ?>
                </table>
            
            <?php
            }
            
            $custom_writing_permission = array();
            
            $path_to_custom_template_folder = $local_path_to_app_layouts . 'custom';
                        
            if(!is_writable($path_to_custom_template_folder)) {
                $custom_writing_permission[] = $path_to_custom_template_folder;
            }

            $path_to_custom_style_folder = $afp_conf['local']['path_to_style'] . 'custom';
                        
            if(!is_writable($path_to_custom_style_folder)) {
                $custom_writing_permission[] = $path_to_custom_style_folder;
            }
            ?>
        
        <div style="padding: 10px;">
            <h3>Create Custom Template</h3>
            
            <?php
            if( !empty($custom_writing_permission) ) {
                
                $disable_create_button = true;
                
                $p_error_msg = '<div class="warning">In order to create a new custom template, the following folder'.((count($custom_writing_permission) > 1) ? 's' : '').' must have the right writing permissions:'."\n";
                
                $p_error_msg .= '<ul>';
                
                foreach($custom_writing_permission as $path_to_c_f) {
                    $p_error_msg .= '<li><strong>'.$path_to_c_f.'</strong></li>';
                }
                
                $p_error_msg .= '</ul>';
                
                $p_error_msg .= '</div>';
                
                echo $p_error_msg;
            }
            ?>
            
            <div style="margin: 20px 0;">
            
                <form action="" method="post">
            
                <input type="hidden" name="action" value="new" />
            
                    <table cellpadding="2" cellspacing="2" id="create_custom_template">
                    
                        <tr>
                            <td width="20%">Name:</td>
                            <td><input type="text" name="template_name" /> <small>(TIP: The template's name can be similar with a form's name that will use this template)</small></td>
                        </tr>
                        
                        <tr>
                            <td>Base Template:</td>
                            <td><select name="template_base">
                                <?php
                                foreach($main['default'] as $v_d) {
                                    echo '<option value="'.$v_d['id'].'">'.$v_d['name'].'</option>'."\n";            
                                }        
                                ?>
                            </select></td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                            <td><input style="font-size:13px;" <?php if( ! isset($disable_create_button)) { ?> class="fancy-button-base light" <?php } else { ?> disabled="disabled" <?php } ?> type="submit" name="submit" value="Create" /></td>
                        </tr>
                        
                    </table>
                
                </form>
                
            </div>
        
            <div style="margin: 20px 0; font-size:11px;" class="desc">
                <span class="notice">How it works?</span>
            
                If you preffer to have a custom template/layout and CSS style for a form, then the easiest way is to duplicate any of the default templates and change them. 
                For example, you might want to alter the 'Vertical Labels' style for a specific form. Type the name of the new layout, select "Vertical Labels" then click "Create". You will be taken to a new page where you will be able to customize the new form design as you wish (HTML &amp; CSS).
            
            </div>
    
        </div>
    
    <?php
    } else if($mode == 'edit') {
        
        $layout_id = $_REQUEST['layout_id'];
        
        list($name, $file_template, $file_css, $custom) = 
        $db->getRow("SELECT name, file_template, file_css, custom FROM `".$afp_conf['db']['prefix']."layouts` WHERE id='".$layout_id."'");

        if($custom == 1) {
            $status = 'Custom';
        } else {
            $status = 'Default';
        }
        
        $custom_path = ($custom == 1) ? 'custom/' : '';
                
        $path_to_form_layouts = $afp_conf['templates']['form_layouts'];
        $path_to_template = $path_to_form_layouts . $custom_path . $file_template;
        
        if(!is_writable($path_to_template) && $custom != 1) {
            $tpl_file_perms_error = 'In order to be editable, <strong>'.$path_to_template.'</strong> must have the right writing permissions.';
        }  
             
        $file_template_contents = htmlspecialchars( file_get_contents($path_to_template) );
        
        $path_to_form_css = $afp_conf['local']['path_to_style'];
        $path_to_css = $path_to_form_css . $custom_path . $file_css;
                
        if(!is_writable($path_to_css) && $custom != 1) {
            $css_file_perms_error = 'In order to be editable, <strong>'.$path_to_css.'</strong> must have the right writing permissions.';
        }
        
        $file_css_contents = file_get_contents($path_to_css);
        $file_css_contents = str_replace('<?php echo $form_id; ?>', '{id}', $file_css_contents);
        $file_css_contents = preg_replace("#<\?php(.*)\?>#Uis", '', $file_css_contents);
        
        $file_css_contents = htmlspecialchars ( $file_css_contents );
        
        if(isset($tpl_file_perms_error) && isset($css_file_perms_error)) {
            $disable_update_button = $disable_update_button = 1;
        }
        
        if(isset($edit_output) && !empty($edit_output) && is_array($edit_output)) {
            
            if( ! empty($edit_output['error']) ) {
                echo '<div class="warning"><ul>';
                
                foreach($edit_output['error'] as $error) {
                    echo '<li>'.$error.'</li>';
                }
                
                echo '</ul></div>';
            }
            
            if( ! empty($edit_output['done']) ) {
                echo '<div class="note_ok"><ul>';
                
                foreach($edit_output['done'] as $success) {
                    echo '<li>'.$success.'</li>';
                }
                
                echo '</ul></div>';
            }
                        
        }
        
    ?>
    
    <form name="edit_files" action="" method="post">
    
    
    <?php
    if($custom == 1) {
    ?>
        Name: <input type="text" name="template_name" value="<?php echo $name; ?>" />
    <?php } ?>
        
        <div style="margin: 20px 0; font-weight:bold;"><span style="text-decoration:underline;">EDIT TEMPLATE:</span> <?php echo $name; ?></div>
        
        <div>
            <ul>
                <li>This is the HTML code for the form layout. Take care when you edit it, as it contains essential variables to make it work correctly.            
                <li>Template powered by <a href="http://www.smarty.net/docs/en/">Smarty</a></li>
            </ul>
        </div>        
        
        <?php
        if(isset($tpl_file_perms_error)) {            
            echo '<div class="warning">'.$tpl_file_perms_error.'</div>';
        }
        ?>
        
        <div><textarea <?php if(isset($tpl_file_perms_error)) { echo 'disabled'; } else { echo 'id="file_template_contents"'; } ?> name="file_template_contents" rows="30"><?php echo $file_template_contents; ?></textarea></div>

        <div style="margin: 20px 0; font-weight:bold; text-decoration:underline;">EDIT CSS</div>
        
        <div>
            <ul>
                <li>{id} gets replaced with the form id (it's needed for reference so take care when you edit the contents).</li>
            </ul>
        </div>

        <?php
        if(isset($css_file_perms_error)) {
            echo '<div class="warning">'.$css_file_perms_error.'</div>';
        }
        ?>
        
        <div><textarea <?php if(isset($css_file_perms_error)) { echo 'disabled="disabled"'; } else { echo 'id="file_css_contents"'; } ?> name="file_css_contents" rows="30"><?php echo $file_css_contents; ?></textarea></div>
        
        <div style="margin:20px 0;"><input type="submit" value="Update File(s) Contents" name="submit" <?php if(!$disable_update_button) { ?> class="fancy-button-base green" <?php } else { ?> disabled="disabled" class="fancy-button-base light" <?php } ?> /><?php if($disable_update_button) { echo '&nbsp;<small>* both files are non-editable (view notifications above)</small>'; } ?></div>
    
    <input type="hidden" name="custom" value="<?php echo $custom; ?>" />    
    <input type="hidden" name="layout_id" value="<?php echo $layout_id; ?>" />
    <input type="hidden" name="action" value="edit" />
        
    </form>
            
    <?php
    }
include 'sections/footer.php';
?>