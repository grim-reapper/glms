<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$field_id = (isset($_REQUEST['field_id'])) ? $_REQUEST['field_id'] : '';

$app->checkField($field_id);

if( ! empty($_POST) ) {
    
    //echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
    
    if(isset($_POST['update_data'])) {
        $action = 'update';
    } elseif(isset($_POST['delete_selected'])) {
        $action = 'delete_options';
    } else {
        if(isset($_POST['action'])) {
            $action = $_POST['action'];
        }
    }
     
    switch ($action) {
        // Update Field
        case 'update':
        $output = $form_fields->update();
        break;
        
        // Import Countries
        case 'import_options':
        $form_fields->importOptions($field_id);
        break;
        
        // Import Options from Input
        case 'import_options_from_input':
        $form_fields->importInputOptions($field_id);
        break;
        
        // Delete (Selected) Options
        case 'delete_options':
        $form_fields->deleteOptions($_POST['del_o']);
        break;
        
        // Assign Parent Field (Select)
        case 'assign_parent_field':
        $form_fields->assignParentField();
        break;

        // Unassign Parent Field (Select)
        case 'unassign_parent_field':
        $form_fields->unassignParentField();
        break;
    }
}

$field_data = $form_fields->getData('', $field_id);

$title = $field_data['text'];
$name = $field_data['name']; 
$mandatory = $field_data['mandatory']; 
$columns = $field_data['columns'];
$type_id = $field_data['type_id'];
$parent_id = $field_data['parent_id'];

$before_content = $field_data['before_content'];
$after_content = $field_data['after_content'];

if($type_id == 6) {
    $default_value = $db->getOne("SELECT value FROM `".$afp_conf['db']['prefix']."fields_attributes` WHERE name='value' && field_id='".$field_id."'");
}

$page_title = 'Edit ['.$title.'] Field';

$edit_form_field_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(isset($output)) {
    
    $note_status = ($output['success'] == 1) ? 'ok' : 'error';
    ?>

    <div class="note_<?php echo $note_status; ?>"><?php echo $output['message']; ?></div>

<?php 
}

$form_id = $form->getFormId($field_id);
list($form_name, $form_description) = $form->getInfo($form_id);
?>

<div style="width:100%; clear:both;">
    <div style="float: left;"><h2><?php echo $form_name; ?></h2></div>
    <div style="float: right; margin:12px 0 0 0;"><strong><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>edit_form_fields.php?form_id=<?php echo $form_id; ?>">&laquo; Back to form's fields list</a></strong></div>
    <div style="clear: both;"></div>
</div>

<?php if($form_description) { ?>
    <div class="desc"><?php echo $form_description; ?></div>
<?php }

// Field Tyes
$field_types = $form_fields->getTypes();

// Show 'Add Attributes' for Input, Select & Textarea
$add_attr_list_types = array(1, 2, 3);

if(in_array($type_id, $add_attr_list_types)) {
    $show_attr = true;
}

// Show 'Add Options' for Selects, Checkboxes & Radios
$add_opt_list = array(2, 4, 5);

if(in_array($type_id, $add_opt_list)) {
    $show_options = true;
}

if(isset($_GET['success'])) {
    echo '<div class="note_ok">'.$afp_conf['msg']['success']['form_field_added'].'</div>';
}

// Check if there are already validations assigned to this field
$validations = $form_fields->getValidations($field_id);
$validation_types = $form_fields->getValidationTypes();

// Check the properties of this field
?>

<fieldset>
<legend><big>EDIT FIELD PROPERTIES</big></legend>
<p style="font-size: 14px;">Field Type: <em style="background-color: #f6f8d6;"><?php echo $field_types[$type_id]; ?></em></p>

<p><small>* make sure you click the "Update" button after you change the fields' values.</small></p>
   
   <?php   
   if($mandatory == 1) {
       if(empty($validations)) {
            $no_valid_s = 'block';
       } else {
            $no_valid_s = 'none';
       }
   } else {
       $no_valid_s = 'none'; 
   }
   ?>
   
   <div style="display:<?php echo $no_valid_s; ?>;" id="no_validation_notice" class="alert"><span class="notice important">Note</span> This field is marked as <strong>required</strong> but it doesn't have any validations assigned to it. Therefore, it is marked as <em><u>optional</u></em>. Click <a class="add_validation_type" href="#">here</a> to add a validation.</div>

   
    <form id="update_data" name="update_data_form" action="" method="post">
    
        <input type="hidden" name="field_id" value="<?php echo $field_id; ?>" />
    
        <input type="hidden" name="action" value="update" />
    
        <table id="table-fields" class="fields" width="100%">
        
            <tr>
                <td width="15%"><label for="field_title"><strong>Title</strong></label></td>
                <td><input id="field_title" size="25" type="text" name="text" value="<?php echo $title; ?>" /></td>
            </tr>

            <tr>
                <td width="15%"><label for="field_name"><strong>Name</strong></label></td>
                <td><input id="field_name" size="25" type="text" name="name" value="<?php echo $name; ?>" /></td>
            </tr>
    
            <?php
            if($type_id != 6) {
            ?>
    
            <tr>
                <td><label for="field_is_required"><strong>Required?</strong></label></td>
                <td><input id="field_is_required" type="checkbox" name="mandatory" <?php if($mandatory == 1) { echo 'checked="checked"'; } ?> value="1" />&nbsp;<label style="display:inline;" for="field_is_required"><small>* tick this checkbox to make this field mandatory</small></label></td>
            </tr>

            <?php
            }
            
            if($show_options) {
                
                if($type_id != 2) {
                ?>
                <tr>
                    <td><label for="columns_number"><strong>Columns</strong></label></td>
                    <td><input id="columns_number" size="2" type="text" name="columns" value="<?php echo $columns; ?>" /></td>
                </tr>
                <?php 
                }
            }
            
            if($type_id == 1 || $type_id == 3) {
                $default_value = $db->getOne("SELECT value FROM `".$afp_conf['db']['prefix']."fields_attributes` WHERE name='value' && field_id='".$field_id."'");
            }
            
            // Check if a default value is set (for input and textarea)
            if($type_id == 1) { # Input
                ?>
                <tr>
                    <td><label for="default_value"><strong>Default Value</strong></label></td>
                    <td><input size="25" type="text" id="default_value" name="default_value" value="<?php echo $default_value; ?>" /></td>
                </tr>
                <?php
            }
            if($type_id == 3) { # Textarea
                ?>
                <tr>
                    <td valign="top"><label for="default_value"><strong>Default Value</strong></label></td>
                    <td><textarea style="width:350px;" rows="4" id="default_value" name="default_value"><?php echo $default_value; ?></textarea></td>
                </tr>                
                <?php
            }
            
            if($type_id == 6) {
                ?>
                <tr>
                    <td valign="top"><label for="default_value"><strong>Value</strong></label></td>
                    <td><textarea style="width:350px;" rows="4" id="default_value" name="default_value"><?php echo $default_value; ?></textarea></td>
                </tr>                
                <?php
            }
            
            if($mandatory == 0) {
                $validation_row_s = 'style="display:none;"';
            } else {
                $validation_row_s = '';
            }
            
            if($type_id != 6) {
            ?>     
            <tr <?php echo $validation_row_s; ?> id="validation">
                <td valign="top"><strong>Validation</strong></td>
                <td>
                
                    <?php                    
                    if($type_id == 1 || $type_id == 3) { // Input & Textarea
                        unset($validation_types['min_selections']);
                    }

                    if($type_id == 2) {
                        $validation_types = array('basic' => $validation_types['basic'], 'min_selections' => $validation_types['min_selections']);
                    }
                    
                    if($type_id == 5) { // Radios
                        
                        $validation_types = array('basic' => $validation_types['basic']);
                        
                        echo '<p style="padding:5px; background-color: #FFFED5; border:1px solid #e7e7e7; line-height: 20px;">
                           The radio field needs a "Basic" validation as only one selection should be made.
                        </p>';
                        
                    } else if($type_id == 4) { // Checkboxes
                        
                        $validation_types = array('min_selections' => $validation_types['min_selections']);
                        
                        echo '<p style="padding:5px; background-color: #FFFED5; border:1px solid #e7e7e7; line-height: 20px;">
                           The checkboxes field(s) need a "Minimum Selection" validation. Set the minimum checkboxes that should be selected from the list (1 is added as default).
                        </p>';
                    }
                    //echo '<pre>'; print_r($validation_types); echo '</pre>';
                    ?>
                    
                        <div style="font-size: 11px;">
                            <table id="table-fields-validation" width="100%">
                                <tr>
                                    <td><strong>Type</strong></td>
                                    <td><strong>Error Message</strong></td>
                                    <td colspan="2"><strong>Value</strong></td>
                                </tr>
                                
                                <?php
                                if( ! empty($validations) ) {
                    
                                    foreach($validations as $value) {
                                        
                                        $validation_id = $value['id'];
                                        $type = $validation_types[$value['type']];
                                        $error_message = nl2br($value['message']);
                                        $v_value = nl2br($value['value']);
                                        
                                        if( ($value['type'] == 'basic' || $value['type'] == 'email' || $value['type'] == 'numeric')) {
                                            $v_value = '...';
                                            $no_value_input = true;
                                        } else {
                                            $no_value_input = false;
                                        }     
                                    ?>
                                        <tr id="validation-id-<?php echo $validation_id; ?>">
                                            <td valign="top" width="20%"><label for="v-text-<?php echo $validation_id; ?>"><?php echo $type; ?></label></td>
                                            <td valign="top"><textarea id="v-text-<?php echo $validation_id; ?>" style="width:330px;" rows="3" name="validation[error_message][<?php echo $validation_id; ?>]"><?php echo $error_message; ?></textarea></td>
                                            <td valign="top"><?php if(!$no_value_input) { ?><input size="8" type="text" name="validation[value][<?php echo $validation_id; ?>]" value="<?php echo $v_value; ?>" /><?php } else { echo $v_value; } ?></td>
                                            <td valign="top"><a class="delete_field_validation" href="#" rel="<?php echo $validation_id; ?>">Delete</a></td>
                                        </tr>
                                        
                                     <?php
                                    }
                                    
                                    }
                                ?>
                            </table>
                    
                        </div>
                                        
                    <a style="font-size: 13px; margin: 15px 0;" class="add_validation_type fancy-button-base light">+ Add Validation Type</a>
                </td>
            </tr>
            
            <?php
            }
            
            if($show_attr) {
            ?>
            
            <tr id="attributes">
                <td valign="top"><strong>Attributes</strong></td>
                <td>
                
                <?php
                $attributes = $form_fields->getAttributes($field_id);
                
                //echo '<pre>'; print_r($attributes); echo '</pre>';
                ?>
                
                    <div style="font-size: 11px;">

                        <div style="margin:10px 0 17px; font-weight:bold;"><a class="how_it_works" id='readme_field_attributes' href='#'>How it works?</a></div>
                        
                        <div id="field_attributes_desc" style="margin:10px 0; display:none;" class="desc">
                        <p>This is useful to add attributes for the field. Make sure you only add an attribute once. You can edit its values afterwards.</p>
                        <p>Example: name: <em>style</em> - value: <em>width:400px; height:100px</em> </p>
                        <p>This will turn the HTML field into something like: <code>&lt;input type=&quot;text&quot; name=&quot;field_name&quot; style=&quot;width:400px; height:100px;&quot;  /&gt;</code></p>
                        
                        <p><strong>DO NOT</strong> add the attributes "name", "type", "value", "id" as they are already assigned to the element. You can edit - on this page - the "Default Value" and "Name" for "value" and "name" attributes. The "id" is automatically assigned and it has an unique name (no matter how many forms and fields are in the page) and the "type" attribute is already added by the script, as it is either "select", "input", "radio" or "checkbox".</p>
                        
                        <span class="notice">Note</span> If you'd like to associate a datepicker with this field, create a "class" attribute with the value "datepicker". If you have 2 date range fields (e.g. "Check-In Date" and "Check-Out Date"), add the values "datepicker from" and "datepicker to" for each fields.</div>

                        <table id="table-fields-attributes" width="100%">
                            <tr>
                                <td width="15%"><strong>Name</strong></td>
                                <td colspan="2"><strong>Value</strong></td>
                            </tr>
                            
                            <?php
                            if( ! empty($attributes) ) {
                              
                                foreach($attributes as $value) {
                                    $attribute_id = $value['id'];
                                    $attribute_name = $value['name'];
                                    $attribute_value = $value['value'];
                                ?>
                        
                                    <tr id="attribute-id-<?php echo $attribute_id; ?>">
                                        <td><input size="10" type="text" name="attribute[name][<?php echo $attribute_id; ?>]" value="<?php echo $attribute_name; ?>" /></td>
                                        <td><input type="text" name="attribute[value][<?php echo $attribute_id; ?>]" value="<?php echo $attribute_value; ?>" /></td>
                                        <td><a class="delete_field_attribute" href="#" rel="<?php echo $attribute_id; ?>">Delete</a></td>
                                    </tr>
                                
                                <?php
                                }
                            } 
                            ?>
                            
                        </table>
                                                
                     </div> 
                     <a style="font-size: 13px; margin: 15px 0;" class="add_attribute fancy-button-base light">+ Add Attribute(s)</a>  
                </td>
            </tr>
            
            <?php
            }
                        
            if($show_options) {
            ?>
                <tr id="options">
                    <td valign="top"><a name="options_list"></a><strong>Options</strong></td>
                    <td>
                    
                    <?php
                    $options = $form_fields->getOptions($field_id);
                    
                    if($parent_id) {
                        $parent_options = $form_fields->getOptions($parent_id);
                    }
                    
                    //echo '<pre>'; print_r($attributes); echo '</pre>';
                    ?>
                    
                        <div style="font-size: 11px;">
                        
                            <div style="margin:10px 0 17px; font-weight:bold;"><a class="how_it_works" id='readme_field_options' href='#'>How it works?</a></div>
                            
                            <div id="field_options_desc" style="margin:10px 0; display:none;" class="desc">
                            <p>This is useful to add options for select fields, checkboxes and radios. You can even add attributes for specific options if you want. For example, you might want to have some checkboxes already checked or some options from a multiple select field already selected. Use the <img align="top" src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/add-attribute.png" width="22" height="22" alt="" /> icon if you wish to add attributes to an option.</p>
                            <p>Example: <code>checked="checked"</code> makes the checkbox selected; <code>selected="selected"</code> makes the option selected from the drop-down (multiple select field)</p>
                            <p>If you want to change the style of the option TEXT (in case of a checkbox or radio element) just add HTML code to the text field like this: <code>&lt;span style=&quot;color:red;&quot;&gt;Option Text Here&lt;/span&gt;</code></p>
                            
                            <p><strong>DO NOT</strong> add the attributes "name", "type" or "id" as they are already assigned to the element.</p></div>                        
                        
                            <table id="table-fields-options" width="100%">                                
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="3">&nbsp;<strong>Text</strong> / <strong>Value</strong> (optional) / <strong>Set Attributes</strong> (optional)</td>
                                </tr>                                
                                <?php
                                if( ! empty($options) ) {
                                ?>                             
                                <?php
                                    foreach($options as $value) {
                                        $option_id = $value['id'];
                                        $option_parent_id = $value['parent_id'];
                                        $option_text = $value['text'];
                                        $option_value = $value['value'];
                                        $option_attributes = $value['attributes'];
                                    ?>
                                        <tr id="option-id-<?php echo $option_id; ?>">
                                            <td width="7%"><img class="handle" src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/cursor-drag-arrow.png" width="16" height="16" /></td>
                                            <td>
                                                <div style="float:left; margin: 0 10px 0;">
                                                    <input size="25" type="text" name="option[text][<?php echo $option_id; ?>]" value="<?php echo htmlspecialchars($option_text); ?>" />&nbsp;<input size="8" type="text" name="option[value][<?php echo $option_id; ?>]" value="<?php echo $option_value; ?>" placeholder="value" />
                                                    <?php
                                                    if(isset($parent_options)) {
                                                    ?>
                                                    <select name="option[parent_id][<?php echo $option_id; ?>]">
                                                        <option value="">Select parent...</option>
                                                        <?php
                                                        foreach($parent_options as $val) {
                                                            if($option_parent_id == $val['id']) {
                                                                $selected = 'selected="selected"';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                            echo '<option '.$selected.' value="'.$val['id'].'">'.$val['text'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div style="float:left;"><a class="add_option_attribute" href="#" rel="<?php echo $option_id; ?>"><img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/add-attribute.png" width="22" height="22" alt="" /></a></div>
                                                 
                                                 <div id="attribute-area-option-id-<?php echo $option_id; ?>" style="display:<?php if($option_attributes != '') { echo 'block'; } else { echo 'none'; } ?>; clear:both; padding:10px 0 0 10px; font-weight:bold;">
                                                 Attribute: <textarea cols="10" rows="2" name="option[attribute][<?php echo $option_id; ?>]"><?php echo $option_attributes; ?></textarea>
                                                 </div>
                                                                                                      
                                            </td>
                                            <td><a class="delete_field_option" href="#" rel="<?php echo $option_id; ?>">Delete</a></td>
                                            <td><input class="option_id_checkbox" type="checkbox" name="del_o[]" value="<?php echo $option_id; ?>" /></td>
                                        </tr>
                                    <?php
                                    }
                                 } ?>

                             </table>                       
           
                            <div id="options_controls" <?php if(empty($options)) { echo 'style="display:none;"'; } ?> align="right"><a style="font-size: 11px;" class="toggle_checkboxes fancy-button-base light">Check All</a>&nbsp;<input type="submit" name="delete_selected" style="font-size: 11px;" class="delete_selected fancy-button-base red" value="Delete Selected" /></div>
                            
                            
                         </div> 
                         
                         <a style="font-size: 13px; margin: 15px 0;" class="add_option fancy-button-base light">+ Add Option</a>  
                       
                   
           <div class="accordion" id="accordion2">
            <div class="accordion-group">
            
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><strong>Import Options</strong></a>
              </div>
              
                    <div id="collapseOne" class="accordion-body collapse in">
                    
                        <div class="accordion-inner">
                 
                            <div align="left">
                            
                                     <?php
                                     if(isset($parent_options)) {
                                     ?>
                                        <select name="parent_id" id="import_parent_id_dd">
                                            <option value="">Select parent...</option>
                                            <?php
                                            foreach($parent_options as $parent_option) {
                                                echo '<option value="'.$parent_option['id'].'">'.$parent_option['text'].'</option>';
                                            }
                                            ?>
                                        </select> <small>* optional (it will assign all the imported options to the selected parent value)</small>                                   
                                     <?php
                                     }
                                     ?>
                           
                                <ul id="import_data_tab" class="nav nav-tabs">
                                    <li class="active merge"><a class="import_data" href="#import-data" data-toggle="tab">Import Data</a></li>
                                    <li><a class="import_data_from_input" href="#import-data-from-input" data-toggle="tab">Import from Input</a></li>
                                </ul> 
                
                                <div id="import-data-content" class="tab-content">
                                
                                     <div class="tab-pane active in" id="import-data">
                                        <?php
                                        $preset_data = glob("includes/options-data/*.txt");
                                        
                                        if( ! empty($preset_data) ) {
                                            foreach($preset_data as $file_name) {
                                                $file_name = basename($file_name);
                                                ?>
                                                <a style="font-size:12px;" class="fancy-button-base light import_options" rel="<?php echo $file_name; ?>" title="This will populate the options list with the data from <?php echo $file_name; ?>. Confirm to proceed." href="#"><?php echo $file_name; ?></a>
                                                <?php
                                            }
                                        } else {
                                            echo 'There are no .txt files in "options-data" with preset data.';
                                        }
                                        ?>
                                     </div>
                                        
                                     <div class="tab-pane" id="import-data-from-input">
                                        <div style="margin:5px 0;"><small>* you should add one option per line or the Select HTML code</small></div>
                                      
                                        <div style="width:100%;">
                                        
                                            <div style="margin: 0 0 0 8px; width:316px; float:left;">
                                                <form method="post" name="form_import_input_options" action="">
                                                    <textarea style="width:300px;" rows="8" name="options_from_input"></textarea>
                                                    <input style="font-size:13px;" type="submit" name="import" class="fancy-button-base light" value="Import" />
                                                    <input type="hidden" name="action" value="import_options_from_input" />
                                                    <input type="hidden" name="field_id" id="field_id" value="<?php echo $field_id; ?>" />
                                                </form>
                                            </div>
                                            
                                            <div style="width:350px; float:left;">
                                                <div class="desc"><small><span class="notice">Note</span> If you have lot of options and you want to import them fast - rather than adding them manually - you can type them each in one line OR copy &amp; paste an already generated HTML code with options. The script will strip the HTML tags and only insert the options.</small></div>
                                            </div>
                                            
                                            <div style="clear:both;"></div>
                                        </div>
                                
                                     </div> 
                                 
                                 </div>
                            </div>
                         
                         <div style="clear:both;"></div>
                         
                        </div>
                        
                    </div>
                    
                </div>  
            </div>            
                          
                    </td>
                </tr>
            <?php
            }

            // If SELECT -> Show a list with possible parent drop-downs
            if($type_id == 2) {
                ?>
                <tr>
                    <td nowrap="nowrap" valign="top"><a name="parent_field_status"></a><strong>Parent DropDown</strong></td>
                    <td>
                    
                    <?php
                    if($parent_id != 0) {
                        $parent_field_name = $db->getOne("SELECT text FROM `".$afp_conf['db']['prefix']."fields` WHERE id='".$parent_id."'");
                        ?>
                        
                        <?php echo $parent_field_name; ?> <button id="unassign_parent_dd" style="font-size: 11px;" class="fancy-button-base red">Unassign</button>
                          
                    <?php
                    } else {
                    ?>
                        <select name="parent_dd" id="parent_dd">
                        <option value="">none</option>
                        <?php
                        $selects = $form_fields->getPossibleParentSelects($form_id, array($field_id));
                        
                        foreach($selects as $value) {
                            if($parent_id == $value['id']) {
                                $selected = 'selected="selected"';
                            } else {
                                $selected = '';
                            }
                            echo '<option '.$selected.' value="'.$value['id'].'">'.$value['text'].'</option>';
                        }
                        ?>
                        </select>&nbsp;<a id="assign_parent_dd" class="fancy-button-base matte-blue" style="font-size:13px;">Assign</a>
                    <?php
                    }
                    ?>
                    
                    </td>
                </tr>
                <?php
            }
            ?>

        <tr>
            <td colspan="2"><div class="desc">Want to add something before/after the field's area? This is the place where you can do that!</div></td>
        </tr>

        <tr>
            <td nowrap="nowrap" valign="top"><strong>BEFORE Field Content</strong></td>
            <td><textarea name="before_content" rows="5"><?php echo $before_content; ?></textarea></td>
        </tr>

        <tr>
            <td nowrap="nowrap" valign="top"><strong>AFTER Field Content</strong></td>
            <td><textarea name="after_content" rows="5"><?php echo $after_content; ?></textarea></td>
        </tr>
              
                                
        </table>
        
        </form>
        
        
</fieldset>

    <!--[Start] Validation Type Dialog Box -->
    <div id="add-validation-type" title="Add Validation Type">
    	<form id="add_validation_type" method="post" action="">
        	<fieldset>
                <div id="response_note_validation"></div>
        		<label for="validation_type"><strong>Type</strong></label>
                <select class="validation_type" id="validation_type" name="validation[type]">
                    <?php
                    foreach($validation_types as $key_validation_type => $text_validation_type) {
                        echo '<option value="'.$key_validation_type.'">'.$text_validation_type.'</option>'."\n";
                    }
                    ?>
                </select>
                
        		<label for="error_message"><strong>Error Message</strong></label>
                <textarea id="error_message" name="validation[message]" rows="3"></textarea>

                <!-- Phone Number -->
                <div style="display:none; text-align:left;" id="phone_number_area">
                    <label for="phone_number_formats"><strong>Formats</strong></label>
                    <div class="desc"><small>e.g. type ###-####-#### to validate 123-5684-2357 or (###)###-### for (123)456-789. Consider eaplaining the format that should be entered in the error message.</small>
                    
                    <p><small><strong>Note:</strong> Separate each format by comma (if you want to have more than one) </small></p>
                    
                    <p><small>If you would like to accept ONLY numeric values for "Phone Number" than select 'Numeric' from the above dropdown.</small></p>
                    </div>
                    <textarea disabled="disabled" id="phone_number_formats" name="validation[value]" rows="3"></textarea>
                </div>
                
                <!-- Minimum Characters -->
                <div style="display:none;" id="minimum_characters_area">
                    <label for="minimum_characters">Minimum characters (<strong>numerical</strong> values only)</label>
                    <input class="numeric" disabled="disabled" id="minimum_characters" size="4" name="validation[value]" />
                    
                    <div class="desc"><small><strong>NOTE:</strong> In the "error message" field you can type something like "Your message should have at least [min_chars] characters.". [min_chars] will be replaced with the numerical value you fill above.</small></div>
                    
                </div>

                <!-- Minimum Selections -->
                <div <?php if( !$show_options && $type_id != 2 ) { ?> style="display:none;" <?php } ?> id="minimum_selections_area">
                    <label for="minimum_selections">Minimum selections (<strong>numerical</strong> values only)</label>
                    <input class="numeric" <?php if( ! $show_options) { ?> disabled="disabled" <?php } ?> id="minimum_selections" size="4" name="validation[value]" />
                    
                    <div class="desc"><small><strong>NOTE:</strong> In the "error message" field you can type something like "You should select at least [min_selections] options.". [min_selections] will be replaced with the numerical value you fill above.</small></div>
                    
                </div>
                          
            </fieldset>
            
            <input type="hidden" name="field_id" id="field_id" value="<?php echo $field_id; ?>" />
               
    	</form>
    </div>
    <!--[End] Validation Type Dialog Box -->

    <?php
    if($show_attr) {
    ?>

    <!--[Start] Attribute Dialog Box -->
    <div id="add-attribute" title="Add Attribute">
    	<form id="add_attribute" method="post" action="">
        	<fieldset>
            <div id="response_note_attribute"></div>
            
            <div style="float: left; width: 115px;">
        		<label style="display: inline;" for="attribute_name"><strong>Name</strong></label>
                <input style="display: inline;" id="attribute_name" size="8" name="attribute[name]" /> &nbsp;=&nbsp;
            </div>

            <div style="float: left; width: 115px;">   
        		<label style="display: inline;" for="attribute_value"><strong>Value</strong></label>
                <input style="display: inline;" id="attribute_value" size="10" name="attribute[value]" /> 
            </div>
                                        
            </fieldset>
            
            <div class="desc" style="width: 93%; margin:15px 0;"><small>Here are some examples: name = <strong>size</strong>, value = <strong>20</strong>
            <p>name = <strong>style</strong>, value = <strong>border: 1px solid blue;</strong> (in case you want to add bold font to the option's text)</p>
            <p>name = <strong>class</strong>, value = <strong>someDefinedClass</strong> (in case you want to add a style from the CSS stylesheet file) etc.</p>
            </p></small>
            </div>
            
            <input type="hidden" name="field_id" id="field_id" value="<?php echo $field_id; ?>" />
               
    	</form>
    </div>
    <!--[End] Attribute Dialog Box -->
    
    <?php
    }
    
    if($show_options) {
    ?>
    <!--[Start] Option Dialog Box -->
    <div id="add-option" title="Add Option">
    	<form id="add_option">
        	<fieldset>
            <div id="response_note_option"></div>

            <div style="float: left; width: auto;">
            
                <!-- Option Parent ID -->
                <?php
                if(isset($parent_options)) {
                ?>            
                
                <label style="display: inline;" for="option_parent_id"><strong>Select parent...</strong></label>
                <select name="parent_id" id="option_parent_id">
                    <option value="">...</option>
                    <?php
                    foreach($parent_options as $parent_option) {
                        echo '<option value="'.$parent_option['id'].'">'.$parent_option['text'].'</option>';
                    }
                    ?>
                </select>
                <?php
                }
                ?>  
                
                <div style="margin: 0 0 10px 0;"><a target="_blank" class="how_it_works" href="http://www.ajaxformpro.com/wiki/?p=424">How to fill these values?</a></div>
                
                <!-- Option Text -->      
        		<label for="option_text"><strong>Text</strong></label>
                <input id="option_text" size="15" name="text" /><br /><br />

                <!-- Option Value -->      
        		<label for="option_value"><strong>Value </strong>* <em>optional</em></label>
                <input id="option_value" size="15" name="value" /><br /><br />

                <!-- Option Attribute -->      
        		<label for="option_attributes"><strong>Attribute(s)</strong><img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/add-attribute.png" width="22" height="22" alt="" align="top" /> * <em>optional</em></label>
                <input id="option_attributes" size="25" name="attributes" />
                
            </div>
                                        
            </fieldset>
            
            <input type="hidden" name="field_id" id="field_id" value="<?php echo $field_id; ?>" />
               
    	</form>
    </div>
    <!--[End] Option Dialog Box -->    

    <!--[Start] Option Attribute Dialog Box -->
    <div id="add-option-attribute" title="Add Option Attribute">
    	<form id="add_option_attribute" method="post" action="">
        	<fieldset>
            <div id="response_note_option_attribute"></div>
            
            <div style="float: left; width: 115px;">
        		<label style="display: inline;" for="option_attribute_name"><strong>Name</strong></label>
                <input style="display: inline;" id="option_attribute_name" size="8" name="option_attribute[name]" /> &nbsp;=&nbsp;
            </div>

            <div style="float: left; width: 115px;">   
        		<label style="display: inline;" for="option_attribute_value"><strong>Value</strong></label>
                <input style="display: inline;" id="option_attribute_value" size="10" name="option_attribute[value]" /> 
            </div>
                                        
            </fieldset>
            
            <div class="desc" style="width: 93%; margin:15px 0;"><small>Here are some examples: name = <strong>size</strong>, value = <strong>20</strong>
            <p>name = <strong>style</strong>, value = <strong>font-weight: bold;</strong> (in case you want to add some CSS styling to the option element)</p>
            <p>name = <strong>class</strong>, value = <strong>someDefinedClass</strong> (in case you want to add a style from the CSS stylesheet file) etc.</p>
            </p></small>
            </div>
            
            <input type="hidden" name="option_id" id="option_id" value="" />
               
    	</form>
    </div>
    <!--[End] Option Attribute Dialog Box -->
    <?php        
    }
?>

<!-- Import Options Form -->
<form action="" method="post" name="form_import_options" id="form_import_options"><input type="hidden" name="action" value="import_options" /><input type="hidden" name="field_id" value="<?php echo $field_id; ?>" /><input type="hidden" id="import_file_name" name="import_file_name" value="" /><input type="hidden" id="import_parent_id" name="parent_id" value="" /></form>

<div style="bottom: 10px; margin: 10px 0 20px; position: fixed; right: 10px; width: 210px;">
    <div style="margin: 8px 0 8px; float:right; position:relative;"><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" class="fancy-button-base light preview2" style="font-size: 14px; padding: 5px 10px 6px 37px;"><img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/show-24x24.png" style="left: 12px; position: absolute; top: 4px;" />Preview Form</a></div>
    <div style="float:right;"><button id="update_fields_values_btn" name="update_data" class="fancy-button-base green">Update Field's Values</button></div>
</div>

<!-- Assign Parent Select Form -->
<form action="edit_form_field.php#parent_field_status" method="post" id="assign_parent_select_form" name="assign_parent_select_form">
    <input type="hidden" name="parent_id" id="parent_id_field" value="" />
    <input type="hidden" name="field_id" value="<?php echo $field_id; ?>" />
    <input type="hidden" name="action" value="assign_parent_field" />
</form>

<!-- Unassign Parent Select Form -->
<form action="edit_form_field.php#parent_field_status" method="post" id="unassign_parent_select_form" name="unassign_parent_select_form">
    <input type="hidden" name="field_id" value="<?php echo $field_id; ?>" />
    <input type="hidden" name="action" value="unassign_parent_field" />
</form>

<?php
include 'sections/footer.php';
?>