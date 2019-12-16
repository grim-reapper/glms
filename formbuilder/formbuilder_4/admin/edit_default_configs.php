<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$form->field_prefix = 'c';

if( ! empty($_POST) ) {    
    $output = $form->updateDefaultConfigValues($id);    
}

$q = "SELECT fcn.id as field_id, 
             fcn.group_id, 
             fcn.field_name, 
             fcn.field_type, 
             fcn.name, 
             fcn.default_value as value,
             fcn.info, 
             fcg.name as group_name

      FROM `".$afp_conf['db']['prefix']."config_names` fcn
      
      LEFT JOIN `".$afp_conf['db']['prefix']."config_groups` fcg ON (fcg.id = fcn.group_id)
      
      ORDER BY fcg.position ASC, fcn.position ASC";

$values = $db->getAll($q);

$vals = array();

// Prepare for the Groups List Links 
foreach($values as $v) {
    $groups[$v['group_name']] = $v['group_id'];
} 
 
$groups_two = array_chunk($groups, 4, true);

foreach($values as $v) {
    $vals[$v['group_name']][] = $v;
}

$page_title = 'Manage Default Form Configuration';
$edit_config_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';
?>

<h2>Edit Default - Form - Configuration</h2>

<div class="desc"><span class="notice">NOTICE</span> These are the default values that will be applied to any new form that is added into the database. It's easy to setup the common values here including the webmaster's email (where you will get the form's results), the SMTP configuration, the CAPTCHA settings, the mail's subject and message etc.</div>

<?php
if(isset($output)) {
    
    $note_status = ($output['success'] == 1) ? 'ok' : 'error';
    ?>

    <div class="note_<?php echo $note_status; ?>"><?php echo $output['message']; ?></div>

<?php 
}

// Start [Webmasters]

include $afp_conf['local']['path_to_afp_admin'].'includes/classes/class.manage.webmasters.php';

$manage_webmasters = new Manage_Webmasters($afp_conf, $db);

// End [Webmasters]
?>

<div style="width:100%;">
    <?php
    foreach($groups_two as $group) {
        ?>
        <div style="float:left;">
            <ul class="nav_link_groups">
            <?php
            foreach($group as $group_name => $group_id) {
            ?>
                <li><a class="group_link" href="#efc<?php echo $group_id; ?>" rel="<?php echo $group_id; ?>"><?php echo $group_name; ?></a></li>
            <?php
            }
            ?>
            </ul>
        </div>
        <?php
    }
    ?>
    <div style="clear: both;"></div>
</div>


    <div class="column">    

<form name="config_values" method="post" action="">

    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <?php        
    foreach($vals as $group_name => $values) {
        
        $group_id = $values[0]['group_id'];
        
        switch ($group_id) { 
            
        	case 6:
            $tr_class = 'smtp_configuration';
        	break;
        
        	case 7:
            $tr_class = 'captcha';
        	break;
        
        	case 4:
            $tr_class = 'attachments';
        	break;
            
            case 3:
            $tr_class = 'auto_responder';
            break;
            
            case 9:
            $tr_class = 'custom_thank_you_page';
            break;

            case 14:
            $tr_class = 'escts';
            break;

            case 16:
            $tr_class = 'recaptcha';
            break;

            case 17:
            $tr_class = 'remote_post';
            break;
            
        	default:
            $tr_class = '';
        } 
        
        //echo $tr_class; 
    ?>
               
    <a name="efc<?php echo $group_id; ?>" id="efc<?php echo $group_id; ?>"></a>
                
    <div id="group_<?php echo $group_id; ?>" class="portlet">    
       
       <div class="portlet-header"><?php echo $group_name; ?></div>
        
        <div class="portlet-content">
        
        <?php
        if($group_id == 17 && !in_array('curl', $loaded_extensions)) {
        ?>
            <div class="desc important"><span class="notice important">cURL Required</span> <small>In order to use this feature, you must have cURL extension enabled. <a target="_blank" href="http://www.google.com/search?q=php+install+curl&oq=php+install+curl&sugexp=chrome,mod=0&sourceid=chrome&ie=UTF-8">Google it</a></small></div>
        <?php
        }
        ?>
        
           <table id="table-fields-<?php echo $group_id; ?>" class="fields" cellspacing="0" cellpadding="0" width="100%"> 
              
           
           <?php
                $webmasters_list = $manage_webmasters->getList();
           
                foreach($values as $v_value) {
                    
                    $group_name = $v_value['group_name'];
                    
                    $title = $v_value['name'];
                    
                    $field_name = $v_value['field_name'];
                    $field_type = $v_value['field_type'];
                    
                    //echo $field_name;
                    
                    if($field_name == 'captcha[tt_font]') {
                        $field_type = $app->DoJsonEncode(array('type' => 'select', 'options' => $form->getFonts()));
                    }
                    
                    if($field_name == 'webmasters') {
                        
                        //echo '<pre>'; print_r($webmasters_list); echo '</pre>';
                        
                        if( ! empty($webmasters_list) ) {
                        
                            $field_type = $app->DoJsonEncode(
                                array('type'       => 'select', 
                                      'attributes' => array('multiple' => 'multiple'),
                                      'options'    => $webmasters_list)
                            );
                            
                            $webmasters_list_empty = false;
                                   
                        } else {
                            
                            $field_type = $app->DoJsonEncode(
                                    array('type' => 'select')
                            );
                                                        
                            $webmasters_list_empty = true;
                        }
                    }

                    if($field_name == 'layout') {
                        $field_type = $app->DoJsonEncode(
                                array('type' => 'select')
                        );                        
                    }

                    if($field_type != '') {
                        $field_type_obj = json_decode($field_type);
                    } 
                                    
                    //echo '<pre>'; print_r($field_type_obj); echo '</pre>'; 
                                        
                    $field_id = $v_value['field_id'];
                    $field_value = $v_value['value'];
                    
                    $info = $v_value['info'];
                    
                    // Set the field's attributes
                    $attributes_html = '';
                    
                    if(isset($field_type_obj->attributes)) {
                        foreach($field_type_obj->attributes as $attribute_name => $attribute_value) {
                            $attributes_html .= $attribute_name.'="'.$attribute_value.'" ';
                        }
                    } else {
                        $attributes_html .= '';
                    }
                    
                ?>
                
                <tr <?php if($tr_class) { echo 'class="'.$tr_class.'"'; } ?> id="row_<?php echo $field_id; ?>">
                    <td valign="top" width="35%"><span class="handle-c"><?php echo $title; ?></span>
                    
                    <?php
                    if($field_id == 95) {
                        if(in_array('openssl', $loaded_extensions)) {
                            echo '<p><small>Open SSL is <font color="green">enabled</font>. You can send the POST Data to HTTPS pages as well.</small></p>';
                        } else {
                            echo '<p><small>Open SSL is <em>not enabled</em>. If you wish to send the POST Data to a HTTPS page, you should install this extension. <a target="_blank" href="http://php.net/manual/en/book.openssl.php">Read more</a></small></p>';
                        }
                    }
                    ?>
                    
                    </td>
                    <td valign="top" width="35%">
                    
                    <?php
                    if($field_type_obj->type == 'text') {
                        
                        if($field_id == 68) {
                            $type = 'password';
                            $field_value = ''; // Leave empty
                        } else {
                            $type = 'text';
                        }
                        
                        ?>
                            <input type="<?php echo $type; ?>" name="<?php echo 'c['.$field_id.']'; ?>" value="<?php echo $field_value; ?>" <?php echo $attributes_html; ?> />
                        <?php
                    }
                    
                    if($field_type_obj->type == 'textarea') {
                    ?>
                        <textarea name="<?php echo 'c['.$field_id.']'; ?>" <?php echo $attributes_html; ?>><?php echo $field_value; ?></textarea>
                    <?php
                    
                    }
                    
                    if($field_type_obj->type == 'select') {
                        
                        $not_available_fields_ids = array(74, 75, 79, 82, 83, 84, 85);
                      
                        if(in_array($field_id, $not_available_fields_ids)) { 
                            echo '<small><em>* not available for the default configs (viewable when you edit a form\'s config)</em></small>'; 
                        } else {
                        
                        switch ($field_id) { 
                            
                        	case 63:
                            $element_id = 'enable_smtp_configuration';
                        	break;
                        
                        	case 8:
                            $element_id = 'enable_captcha';
                        	break;
                        
                        	case 45:
                            $element_id = 'enable_attachments';
                        	break;

                        	case 42:
                            $element_id = 'enable_auto_responder';
                        	break;

                        	case 17:
                            $element_id = 'enable_custom_thank_you_page';
                        	break;

                        	case 19:
                            $element_id = 'enable_escts';
                        	break;
                            
                            case 47:
                            $element_id = 'attach_2_mail';
                            break;

                            case 48:
                            $element_id = 'add_links_2_the_files';
                            break;

                            case 90:
                            $element_id = 'enable_recaptcha';
                            break;

                            case 95:
                            $element_id = 'enable_remote_post';
                            break;
                                                    
                        	default:
                            $element_id = '';
                        } 
                        
                        //echo '<pre>'; print_r($field_type_obj->options); echo '</pre>';
                        
                        $field_name = 'c['.$field_id.']';
                        
                        if($field_id == 41) {
                            $field_name .= '[]';
                        }
                        
                        //echo $field_name;
                        
                        if($webmasters_list_empty && $field_id == 41) {
                            
                            echo 'There are no recipients (e-mail addresses) added. Click <a target="_blank" href="manage_webmasters.php"><strong>here</strong></a> to add.';
                        
                        } else {
                    ?>
                        <select <?php if($element_id) { echo 'id="'.$element_id.'"'; } ?> name="<?php echo $field_name; ?>" <?php echo $attributes_html; ?>>
                                
                                <?php
                                
                                if($field_id == 73) {
                                    
                                    $defaults_t = array();
                                    $customs_t = array();
                                    
                                    $templates = $db->getAll("SELECT id, name, custom FROM `".$afp_conf['db']['prefix']."layouts`");
                                    
                                    foreach($templates as $t) {
                                        
                                        $val = array('id' => $t['id'], 'name' => $t['name']);
                                    
                                        if($t['custom'] == 0) {
                                            $defaults_t[] = $val;
                                        } else {
                                            $customs_t[] = $val;
                                        }
                                    }
                                    
                                    // Show Defaults & Customers
                                    $html_select = '<optgroup label="Defaults">';
                                    
                                    foreach($defaults_t as $v) {
                                        $selected = ($field_value == $v['id']) ? 'selected="selected"' : '';
                                        $html_select .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['name'].'</option>'."\n";
                                    }
                                    
                                    $html_select .= '</optgroup>';
                                    
                                    if( ! empty($customs_t) ) {
                                        $html_select .= '<optgroup label="Customs">';
    
                                        foreach($customs_t as $v) {
                                            $selected = ($field_value == $v['id']) ? 'selected="selected"' : '';
                                            $html_select .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['name'].'</option>'."\n";
                                        }
                                        
                                        $html_select .= '</optgroup>';
                                    }
                                    
                                    echo $html_select;
                                    
                                } else {
                                    
                                $field_options = $field_type_obj->options;
                                
                                if($field_id == 41) {
                                    $field_values = (array)$app->DoJsonDecode($field_value);
                                }
                               
                                foreach($field_options as $key_value => $text_value) {
                                    
                                    //echo '<pre>'; print_r($key_value); echo '</pre>';
                                      
                                      if($field_id == 41) {                                
                                          $selected = (in_array($key_value, $field_values)) ? 'selected' : '';                                      
                                      } else {
                                          $selected = ($field_value == $key_value) ? 'selected' : '';
                                      }
                                    ?>
                                    <option <?php echo $selected; ?> value="<?php echo $key_value; ?>"><?php echo $text_value; ?></option>
                                    <?php
                                }
                                
                                }
                                ?>
                            </select>
                    <?php
                    }
                    
                    }
                    
                    }
                    
                    // Radio Type
                    if($field_type_obj->type == 'radio') {
                        $field_options = $field_type_obj->options;
                        
                        foreach($field_options as $key_value => $text_value) {
                        ?>
                            <input <?php if($field_value == $key_value) { echo 'checked="checked"'; } ?> type="radio" name="<?php echo 'c['.$field_id.']'; ?>" value="<?php echo $key_value; ?>" />&nbsp;<?php echo $text_value; ?>&nbsp;&nbsp;
                        <?php
                        }
                    }
                    ?>
                    </td>
                             
                    <?php
                    if($field_id != 13) {
                    ?>
                             
                    <td <?php if($info) { ?> class="info" <?php } if($field_id == 12) { echo 'rowspan="2"'; } ?> valign="top" width="30%">
                        <?php
                        if($info) {                    
                            echo $info;
                        }
                        
                        if($field_id == 12) {
                            
                            //echo '<pre>'; print_r($afp_conf); echo "</pre>";
                            
                            ?>
                            
                            <div align="center"><strong>CAPTCHA Preview</strong></div>
                            <div style="margin:10px 0;" align="center"><img style="border: 1px solid #e7e7e7;" src="<?php echo $afp_conf['url']['path_to_script']; ?>captcha.php?form_id=default&x=<?php echo md5(microtime(time())); ?>&preview=1" alt="" /></div>
                            
                            <div><small>Edit the CAPTCHA settings then click "Update Form Configuration" to see the new preview.</small></div>
                            
                            <?php
                        }
                        ?>
                    </td>
                    
                    <?php } ?>
                </tr>
                        
                <?php    
                }
                ?>
                </table>
            </div>
</div>
            

      
    <?php
    }
    ?>
    
    
</div> 

 <div style="clear: both;"></div>
 
    <div style="margin:10px 0 20px 0; position:fixed; bottom: 10px; right:10px; width: 254px;">
    
        <div style="margin: 8px 0; float:right;"><button class="fancy-button-base light toggle_all" style="font-size: 14px;">Expand / Contract All</button></div>
    
        <div style="float: right;"><input class="fancy-button-base green" style="font-size: 16px;" type="submit" name="submit" value="Update Default Configuration" /></div>
    
    </div>
 
</form>
 
<?php
include 'sections/footer.php';
?>