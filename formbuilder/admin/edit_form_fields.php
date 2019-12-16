<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$form_id = (isset($_REQUEST['form_id'])) ? $_REQUEST['form_id'] : '';

$form_info = $form->getInfo($form_id, 1);
    
list($name, $description) = $form_info;

if( ! empty($_POST) ) {
    
    //echo '<pre>'; print_r($_POST); echo '</pre>';
    
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
          
    switch ($action) {
        
        case 'update':
        $output = $form_fields->updateAll();
        break;
        
        case 'merge_fields':
        $output = $form_fields->mergeFields();
        break;
        
        case 'delete_merged_fields_row':
        $form_fields->deleteMergedFieldsRow();
        break;
    }
}

$edit_form_fields_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(isset($output)) {
    
    $note_status = ($output['success'] == 1) ? 'ok' : 'error';
    ?>

    <div class="note_<?php echo $note_status; ?>"><?php echo $output['message']; ?></div>

<?php 
}
?>

<div style="width:100%; clear:both;">
    <div style="float: left;"><h2>Form: <?php echo $name; ?></h2></div>
    <div style="float: right; margin:12px 0 0 0;"><strong><a href="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>manage_forms.php">&laquo; Back to forms' list</a></strong></div>
    <div style="clear: both;"></div>
</div>

<p><strong>MANAGE FORM'S FIELDS</strong></p>

<?php if($description) { ?>
    <div class="desc"><?php echo $description; ?></div>
<?php } ?>

<div id="info_field_name_desc" class="desc notice">
<small>
<p>In the "Name" column you can fill the field's name that will appear in the <code>name=&quot;[field name here]&quot;</code> part of the field tag.</p>

<p>It's not mandatory as a name will be automatically assigned to the field in case you don't fill it. This feature is useful if you need to need to generate the forms and use them in a 3rd party application (e.g. copy &amp; paste the generated HTML source somewhere else), unrelated with AJAX Form Pro.</p>

<p>This is especially useful for developers that want to have specific names for the form's fields, since the values will be catched based on that name.</p>

<p>More information about this can be found here: <a href="http://www.w3schools.com/php/php_post.asp">http://www.w3schools.com/php/php_post.asp</a></p>

<p><strong>Note:</strong> If you only use this form to receive its field values to your e-mail address, then you can leave the "Name" fields empty, as it will not affect the functionality of the form.</p>

</small>


</div>

    <form action="" method="post">
    
        <input type="hidden" name="action" value="update" />
    
        <table class="fields table-fields" width="100%">
        
            <tr class="ui-state-disabled">
                <td width="7%" style="border:none;">&nbsp;</td>
                <td width="30%"><strong>Title</strong></td>
                <td><strong>Name</strong>&nbsp;<a href="#" id="info_field_name" title="Click to Show/Hide the Information Note"><img border="0" width="22" height="22" src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/help-20x20.png" alt="" /></a></td>
                <td width="10%"><strong>Required?</strong></td>
                <td width="17%"><strong>Type</strong></td>
                <td width="25%"><strong>ACTIONS</strong></td>
            </tr>
            
            <?php
            // Field Tyes
            $field_types = $form_fields->getTypes();
            //echo '<pre>'; print_r($field_types); echo '</pre>';
            
            // Fields associated with this form
            $fields_list = $form_fields->getData($form_id);      
            
            $hidden_fields = array();    
                         
            foreach($fields_list as $v_value) {
                
                $type_id = $v_value['type_id'];
                
                if($type_id == 6) {
                    $hidden_fields[] = $v_value;
                    continue;
                }
                
                $field_id = $v_value['id'];
                $title = $v_value['text'];
                $name = $v_value['name'];
                $mandatory = $v_value['mandatory'];
                $validations = $form_fields->getValidations($field_id);
                
                if(empty($validations) && $mandatory == 1) {
                    $show_alert = true;
                    $no_validation_for_required = true;
                } else {
                    $no_validation_for_required = false;
                } 
                
                /*
                if(!$name) {
                    $name = $form_fields->generateFieldName($title);
                }
                */
            ?>
                <tr id="field-<?php echo $field_id; ?>">
                    <td><input type="hidden" name="field_id[]" value="<?php echo $field_id; ?>" /><input type="hidden" value="" name="value[]" /><img class="handle" src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/cursor-drag-arrow.png" width="16" height="16" /></td>
                    <td><input size="32" type="text" name="text[]" value="<?php echo $title; ?>" class="field_title" /><?php if($no_validation_for_required) { ?> &nbsp;<img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/exclamation.png" width="16" height="16" alt="" /> <?php } ?></td>
                    <td><input size="10" type="text" name="name[]" value="<?php echo $name; ?>" /></td>
                    <td><input type="checkbox" name="mandatory[<?php echo $field_id; ?>]" <?php if($type_id == 6) { echo 'disabled="disabled"'; } else if($mandatory == 1) { echo 'checked="checked"'; } ?> value="1" /></td>
                    <td><?php echo $field_types[$type_id]; ?></td>
                    <td><a class="edit_field_info" href="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>edit_form_field.php?field_id=<?php echo $field_id; ?>">Edit</a><a class="delete_field" href="#">Delete</a></td>
                </tr>  
                <?php  
                }
                if($show_alert) { ?>
                    <tr>
                    <td colspan="5" style="border:none;"><div class="alert">Any <strong>required</strong> field marked with <img src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/exclamation.png" width="16" height="16" alt="" /> doesn't have a validation added. Therefore, it's automatically set as <em><u>optional</u></em>. To activate the validation checker, you should "Edit" the field and add at least one validation method for that field.</div></td>
                    </tr>
                <?php } ?>
            
            </table>
           <?php 
            // Are there any hidden fields?
            if(!empty($hidden_fields)) {
                ?>  
                
               <div style="margin:20px 0;">* <em>Hidden Fields</em></div>
                         
            <table class="fields table-fields">
  
                <tr class="ui-state-disabled">
                    <td width="30%"><strong>Title</strong></td>
                    <td width="30%"><strong>Value</strong></td>
                    <td><strong>Name</strong></td>
                    <td width="25%"><strong>ACTIONS</strong></td>
                </tr>
                         
                <?php
                foreach($hidden_fields as $v_value) {
                    $field_id = $v_value['id'];
                    $title = $v_value['text'];
                    $name = $v_value['name'];
                    $default_value = $v_value['default_value'];
                ?>
                <tr class="ui-state-disabled" id="field-<?php echo $field_id; ?>">
                    <td><input type="hidden" name="field_id[]" value="<?php echo $field_id; ?>" /><input size="32" type="text" name="text[]" class="field_title" value="<?php echo $title; ?>" /></td>
                    <td><textarea cols="5" rows="3" name="value[]"><?php echo $default_value; ?></textarea></td>
                    <td><input size="10" type="text" name="name[]" value="<?php echo $name; ?>" /></td>
                    <td><a class="delete_field" href="#">Delete</a></td>
                </tr>                 
                <?php
                }
                ?>
                </table>
            <?php
            }
            ?>   
                
                <div style="width:100%; margin: 20px 0;">
                    <div style="float: left; margin: 0 20px 0 0;"><input class="fancy-button-base light" type="submit" name="submit" value="Update" />&nbsp;<small>* updates title, name, value (for hidden fields) &amp; required status</small></div>
                    <div style="float: right;"><a class="fancy-button-base green add_new_field">Add Field</a></div>
                </div>
                 
                 <div style="clear:both;"></div>
                  
                </tr>  
                    
        </table>
    
    </form>
    
    <div>
    <fieldset class="stylish_fieldset">
    <legend class="stylish_legend">Merge Fields into the Same Row</legend>
        <!-- MERGE ROWS -->
        <form name="merge_fields" action="#current_merged_fields" method="post">
        
        <div style="width:100%">
        
            <div style="float: left; width:250px; margin: 0 30px 0 0;">
            
            <div style="margin: 0 0 5px 0;"><em>Fields in Single Rows</em></div>
            <?php
            $merged_fields = $form_fields->getMergedFields($form_id);
            
            $options = $form_fields->getSingleRowsFields($fields_list, $merged_fields);  
                
                if( ! empty($options) ) {           
            ?>
            
                <select id="merge_set" name="merge_set[]" style="height:100px; width:200px;" multiple="multiple">
                      
                      <?php
                      foreach($options as $option) {
                         if($option['type_id'] == 6) { continue; } // Do not show "Hidden" Fields in this list
                         echo '<option value="'.$option['field_id'].'">'.$option['title'].'</option>';
                      }
                      ?>
                                
                </select>
        
                <div style="margin:10px 0;"><input style="font-size:13px;" class="fancy-button-base light" type="submit" name="do_merge_fields" value="Merge Fields" /></div>
                
                <?php 
                } else {
                    echo '<div style="line-height:20px;"><small>* there are no mergeable fields to add.<br /> All of them have been used. <br /> Delete the existing ones (right-side) if you wish to add new ones.</small></div>';
                } 
                ?>
        
            </div>
        
            <div style="float:left; <?php if( empty($options) ) { echo 'margin: -29px 0 0;'; } ?>">
            <a name="current_merged_fields"></a>   
            <ul id="merge_fields_tab" class="nav nav-tabs">
                <li class="active merge"><a class="merge" href="#current-merged-fields" data-toggle="tab">Current Merged Fields</a></li>
                <li><a class="readme" href="#merged-fields-readme" data-toggle="tab">Readme</a></li>
            </ul>
            
            <div id="merge-fields-tab-content" class="tab-content">
            
                <div class="tab-pane active in" id="current-merged-fields">
                <?php
                if( ! empty($merged_fields) ) {
                    
                    $field_names_html = '<ul class="rows">';
                    
                    $i = 0;
                    
                    foreach($merged_fields as $row_id => $v_m) {
                        
                        $field_names_html .= '<li>';
                        
                        $field_names_list = '';
                        
                        foreach($v_m as $v_m2) {
                            $field_names_list .= $v_m2['field_name'].', ';
                        }
                        
                        $field_names_list = trim($field_names_list, ', ');
                        $field_names_list .= '&nbsp;(<a href="edit_merged_fields_area.php?row_id='.$row_id.'">Edit Before/After Content</a> | <a class="delete_merged_row" rel="'.$row_id.'" href="#">Remove merge</a>)';
                        
                        $field_names_html .= $field_names_list;
                        
                        $field_names_html .= '</li>';
                    }
                    
                    $i++;
                    
                    $field_names_html .= '</ul>';
                                
                    echo $field_names_html;
                } else {
                    echo '<div style="margin:10px 0 0 0;" class="desc">There are no merged fields in the same row.</div>';
                }
                ?>
                </div>
                
                <div class="tab-pane" id="merged-fields-readme"><div style="width:auto; font-size:12px; width:550px; margin:10px 0 0 0;" class="desc"><span class="notice">Note</span> To have 2 or more fields merged in same row, they must be positioned one after another. For example: "State" and "Zip Code". If the former is followed by the later in their fields position, then they will be merged in the same row. The order of the fields in the form can be updated using the <img class="handle" src="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>includes/images/icons/cursor-drag-arrow.png" width="16" height="16" /> icons to drag and drop the row into the desired position.</div></div>
 
            </div>
            
            <div style="clear:both;"></div>
            
        </div>
        
        <div style="margin:10px; clear:both;"></div>
        
        <input type="hidden" name="action" value="merge_fields" />
        
        <input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />
        
        </form>
        <!-- /MERGE ROWS -->
        
        <?php
        if( ! empty($merged_fields) ) {
        ?>
        <form name="delete_merged_row" id="delete_merged_row" action="edit_form_fields.php?form_id=<?php echo $form_id; ?>#current_merged_fields" method="post">
            <input type="hidden" name="action" value="delete_merged_fields_row" />
            <input type="hidden" name="row_id" id="row_id" value="" />
        </form>
        <?php } ?> 
        
        
    </div>
    </fieldset>

    <div class="bottom_nav" align="right">
    
        <a target="_blank" class="preview" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>"><strong>Preview Form</strong></a>
        <a class="configs" href="<?php echo $afp_conf['url']['path_to_afp_admin']; ?>edit_form_config.php?form_id=<?php echo $form_id; ?>"><strong>Configs</strong></a>
        <a class="integrate" href="#"><strong>Integrate Form Into My Web Page</strong></a>
    
    </div>

    <!-- [START] ADD NEW FIELD FORM DIALOG -->
    <div id="add-field" title="Add New Field">
    	<form id="add_field">
        	<fieldset>
            
            <div id="response_note"></div>
        
        		<label for="title"><strong>Title</strong></label>
        		<input name="text" id="title" type="text" class="text ui-widget-content ui-corner-all" />
                
                <div id="add_field_required_area">
        		    <label for="required"><strong>Required?</strong></label>                
                    <div class="new_field"><input style="margin:0px;" type="checkbox" name="mandatory" id="required" value="1" /> <label for="required"><small>* tick to make this field mandatory</small></label></div>
                </div>
                
                <div id="add_field_value_area">
        		    <label for="title"><strong>Value</strong></label>
        		    <input name="default_value" id="field_value" type="text" class="text ui-widget-content ui-corner-all" />
                </div>
                
        		<label for="field_type"><strong>Field Type</strong></label>
                <select class="new_field" id="field_type" name="type_id">
                    <?php
                    foreach($field_types as $type_id => $type_name) {
                        echo '<option value="'.$type_id.'">'.$type_name.'</option>'."\n";
                    }
                    ?>
                </select>            
                
            </fieldset>
            
            <input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>" />
               
    	</form>
    </div>
    <!-- [END] ADD NEW FIELD FORM DIALOG -->


    <!-- [START] INTEGRATE FORM DIALOG -->
    <div id="select-integration" title="How to Integrate the Form?">
    	<form id="select_integration">
        	<fieldset>
                
                <select id="integration_method" name="integration_method">
                    <option value="iframe">iFrame</option>
                    <option value="copy_php_code">Copy PHP Code</option>
                </select>    
                                
                <div class="desc" style="font-size: 11px; margin: 10px 0 0 0; width: 94%;">
                    <div style="display:none;" id="iframe_info">This is the easiest and convenient method to integrate the forms. You just have to copy &amp; paste the provided HTML code into your webpage (you can even copy it in .HTML pages; the PHP code will load inside the iFrame).</div>
                    <div style="display:none;" id="copy_php_code_info">This is a bit more advanced way of integrating the form as it requires you to copy blocks of code into your .php pages.</div>
                </div>       

                <div id="lightbox_desc">
                    <div style="width:100%; margin: 12px 0 12px;">
                        Type: <select id="integration_type" name="integration_type">
                        <option value="web_page">Web page</option>
                        <option value="lightbox">Lightbox</option>
                        <option value="slide_in_top">Slide-In Top</option>
                        <option value="slide_in_left">Slide-In Left</option>
                        </select>
                    </div>
                    
                    <div style="clear:both;"></div>
                    
                </div>
                
            </fieldset>
                           
    	</form>
    </div>
    <!-- [END] INTEGRATE FORM DIALOG -->

<?php
include 'sections/footer.php';
?>