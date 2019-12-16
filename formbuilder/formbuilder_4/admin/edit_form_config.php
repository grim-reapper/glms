<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$form_id = (isset($_REQUEST['form_id'])) ? $_REQUEST['form_id'] : '';

if(!$form_id) exit('No form id was requested!');

if( ! empty($_POST) ) {    
    $output = $form->updateConfigValues($form_id);    
}

$q = "SELECT fcv.field_id, fcn.group_id, fcg.name as group_name, fcg.position as group_position, fcn.field_name, fcn.field_type, fcn.name, fcn.info, fcv.value 

      FROM `".$afp_conf['db']['prefix']."config_values` fcv
      
      LEFT JOIN `".$afp_conf['db']['prefix']."config_names` fcn ON (fcv.field_id = fcn.id)
      LEFT JOIN `".$afp_conf['db']['prefix']."config_groups` fcg ON (fcg.id = fcn.group_id)

      WHERE fcv.form_id='".$form_id."'
      
      ORDER BY fcg.position ASC, fcn.position ASC";

$values = $db->getAll($q);   

//echo '<pre>'; print_r($values); echo '</pre>';

if(empty($values)) {
    exit('The requested form does not exist. Click <a href="manage_forms.php">here</a> to go to the forms list.');
}

$vals = array();
 
// Prepare for the Groups List Links 
foreach($values as $v) {
    $groups[$v['group_name']] = $v['group_id'];
} 
 
$groups_two = array_chunk($groups, 4, true);
 
//echo '<pre>'; print_r($groups); echo '</pre>';
 
// Prepare for the Groups & Corresponding Configs 
foreach($values as $v) {
    $vals[$v['group_name']][] = $v;
}

list($name, $description) = $form->getInfo($form_id);

$page_title = 'Manage ['.$name.'] Form Configuration';

$edit_config_page = 1;

include 'sections/header.php';

//echo '<pre>'; print_r($form->getFonts()); echo '</pre>';

include 'sections/navigation.php';

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

<div style="width:100%; clear:both;">
    <div style="float: left;"><h2>Form: <?php echo $name; ?></h2></div>
    <div style="float: right; margin:12px 0 0 0;"><strong><a href="edit_form_fields.php?form_id=<?php echo $form_id; ?>">Manage Form's Fields</a></strong> | <strong><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>manage_forms.php">&laquo; Back to forms' list</a></strong></div>
    <div style="clear: both;"></div>
</div>

<?php if($description) { ?>
    <div class="desc"><?php echo $description; ?></div>
<?php } 
// --- SHOW THE LINKS (TO THE ANCHORS) FOR EACH CONFIGURATION GROUP ---
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

    <input type="hidden" name="id" value="<?php echo $form_id; ?>" />

    <?php        
    //echo '<pre>'; print_r($vals); echo '</pre>';
    
    foreach($vals as $group_name => $values) {
        
        $group_id = $values[0]['group_id'];
        
        //echo $group_id;
        
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
        if($group_id == 10) { ?>
            <div class="desc important"><span class="notice important">Important</span> <small>If you do not select any fields for the "Sender Name" and "Sender E-Mail" (your form could miss both "Name" and "E-Mail" fields), make sure you edit the custom fields. Do not leave them with the default values becaue the message sent could end up in the SPAM/Junk folder.</small></div>
        <?php 
        }
        
        if($group_id == 17 && !in_array('curl', $loaded_extensions)) {
            ?>
            <div class="desc important"><span class="notice important">cURL Required</span> <small>In order to use this feature, you must have cURL extension enabled. <a target="_blank" href="http://www.google.com/search?q=php+install+curl&oq=php+install+curl&sugexp=chrome,mod=0&sourceid=chrome&ie=UTF-8">Google it</a></small></div>
            <?php
        } 
        
        if($group_id == 2) {
            $webmasters_list = $manage_webmasters->getList();
        
            if($values[0]['value'] == '' && empty($webmasters_list)) {
                echo '<div class="warning">Please add at least 1 recipient (e-mail address) so you can get the mail sent through the form.</div>';
            } else if($values[0]['value'] == '' && !empty($webmasters_list)) {
                echo '<div class="warning">In order to receive the form\'s data to an e-mail address, you must select at least one recipient from the list below.</div>';
            }            
        } 
        ?>
        
           <table id="table-fields-<?php echo $group_id; ?>" class="fields" cellspacing="0" cellpadding="0" width="100%"> 
           
           <?php 
           // Get Form Fields
           $fields = $form_fields->getData($form_id);
           
                //echo '<pre>'; print_r($values); echo '</pre>';
           
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
                        $field_type_obj = $app->DoJsonDecode($field_type);
                    } 
                                      
                    $field_id = $v_value['field_id'];
                    $field_value = $v_value['value'];
                    
                    $field_value = str_replace('\"', '"', $field_value);
                    $field_value = str_replace("\'", "'", $field_value);
                    
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
                            echo '<p><small>Open SSL is <em>not enabled</em>. You should have this extension enabled if you wish to send data to HTTPS pages.</small></p>';
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

                        $fields_ids = array(74, 75, 79, 82, 83, 84, 85);

                        if(in_array($field_id, $fields_ids)) { 
                         
                            echo '<select name="c['.$field_id.']">';
                            
                            echo '<option value="">...</option>';
                            
                            foreach($fields as $f_v) {
                                
                                $f_id = $f_v['id'];
                                $f_text = $f_v['text'];
                                
                                if($field_value == $f_id) {
                                    $selected = 'selected="selected"';
                                } else {
                                    $selected = '';
                                }
                                
                                echo '<option '.$selected.' value="'.$f_id.'">'.$f_text.'</option>';
                            }
                            
                            echo '</select> <small>* Field\'s Value</small>';
                            
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
                            <div style="margin:10px 0;" align="center"><img style="border: 1px solid #e7e7e7;" src="<?php echo $afp_conf['url']['path_to_script']; ?>captcha.php?form_id=<?php echo $form_id; ?>&x=<?php echo md5(microtime(time())); ?>&preview=1" alt="" /></div>
                            
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
    
        <div style="margin: 0; float:right;"><button class="fancy-button-base light toggle_all" style="font-size: 14px;">Expand / Contract All</button></div>
    
        <div style="margin: 8px 0 8px; float:right; position:relative;"><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" class="fancy-button-base light preview2" style="font-size: 14px; padding: 5px 10px 6px 37px;"><img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/show-24x24.png" style="left: 12px; position: absolute; top: 4px;" />Preview Form</a></div>
    
        <div style="float: right;"><input class="fancy-button-base green" style="font-size: 16px;" type="submit" name="submit" value="Update Form Configuration" /></div>
    
    </div>

</form>

<?php
include 'sections/footer.php';
?>