<?php
/**
 * Ajax_Form_Pro
 * 
 * @package   
 * @author Gabriel Comarita
 * @copyright (c) BitRepository.com - You do not have rights to reproduce, republish, redistribute or resell this product without permission from the author or payment of the appropiate royalty of reuse.
 * @access public

 * Keep this notice intact for legal use *
 */
 
class Ajax_Form_Pro {
    
    var $db;
    
    var $app;

    var $mAfpConf;
    
    var $mSmarty;

    var $mAfbFormFields = array();
  
    var $mFormsIncluded = true;
  
    var $mMyForms = array();
                                         
    var $mCurrentFormId;
  
    // Lightbox
    var $mLightbox = false;

    // Slide-In Left
    var $mSlideInLeft = false;

    var $mIncludeJQuery = true;
        
    /**
    * Ajax_Form_Pro::Init()
    * 
    * @return
    */
    function Init($output = 1) {
        
      $this->conf = $this->mAfpConf;  
        
      unset($_SESSION['files_uploaded']);
        
      $this->mAfbFormFields = $this->GetFormData();
      
      //echo '<pre>'; print_r($this->mAfbFormFields); echo '</pre>';
                  
      //echo '<pre>'; print_r($this->mMyForms); echo '</pre>'; exit;             
                  
      if(is_array($this->mAfbFormFields)) { 
          $this->mFormsIncluded = true; 
      }
    
      $forms = array();
      $in_fields = false; // initial value
            
      foreach($this->mMyForms as $form_id => $form_values) {
        
         // if($form_values['enabled'] == 1) {
      
              if($form_values['layout'] == 'in-field-labels') {
    	          $in_fields = true;
    	      }
           
              $forms[] = array('id'      => 'afp'.$form_id,
                               'layout'  => $form_values['layout'],
                               'css'     => $form_values['css'],
                               'custom'  => $form_values['custom']);     
          //} 
      }
      
      //echo '<pre>'; print_r($forms); echo '</pre>';
            
      // Declare and Assign values to the HEADER template
      $assigns = array('forms'                => $forms,
                       'in_fields'            => $in_fields,
                       'is_ie'                => ((strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'msie') !== false) ? true : false),
                       'include_jquery'       => $this->mIncludeJQuery,
                       'enable_datepicker'    => $this->EnableDatepicker(),
                       'enable_uploader'      => $this->EnableUploader(),
                       'enable_lightbox'      => $this->mLightbox,
                       'enable_slide_in_left' => $this->mSlideInLeft);
      
      foreach($assigns as $key_name => $key_value) {
          $this->mSmarty->assign($key_name, $key_value);
      }
      
      //echo '<pre>'.print_r($this->mAfpConf).'</pre>';
      
      $this->mSmarty->assign('c', $this->mAfpConf);
                  
      $this->mSmarty->assign('afp_settings', $this->DoJsonEncode($this->mAfpConf['url'])); 
      
      if( ! empty($_POST) ) {
        $this->mSmarty->assign('post_data', $this->DoJsonEncode($_POST));               
      }
      //echo '<pre>'; print_r($this->mAfbFormFields); echo '</pre>'; exit;
      
      $datepicker_fields = $this->getDatepickerFields();
      
      //echo '<pre>'; print_r($datepicker_fields); echo '</pre>'; exit;
           
      $this->mSmarty->assign('datepicker_fields', $datepicker_fields);
      
      if($output == 1) {
          // Load the HEADER template
          $this->mSmarty->display($this->mAfpConf['templates']['header']);
      }	else {
          return $this->mSmarty->fetch($this->mAfpConf['templates']['header']);
      }  
    }
                                       
    /**
    * Ajax_Form_Pro::FilterArray()
    * 
    * @param mixed $str
    * @return
    */
    function FilterArray($str) {
		return is_array($str) ? array_map(array('Ajax_Form_Pro', 'FilterArray'), $str) : trim(stripslashes(htmlspecialchars($str)));
    }
    
    /**
    * Ajax_Form_Pro::FilterArray2()
    * 
    * @param mixed $str
    * @return
    */
    function FilterArray2($str) {
		return is_array($str) ? array_map(array('Ajax_Form_Pro', 'FilterArray2'), $str) : trim(stripslashes($str));
    }
    
    /**
    * Ajax_Form_Pro::ShowForm()
    * 
    * @param string $form_id
    * @return
    */
    function ShowForm($form_id = '', $output = 1) {
      
      //echo '<pre>'; print_r($this->mMyForms); echo '</pre>';
            
      if($_POST['form_id']) {
          $_POST['form_id'] = str_replace('afp', '', $_POST['form_id']);
          $form_id          = $_POST['form_id'];
      } else {
          $form_id = str_replace('afp', '', $form_id);
      }
           
      // If no form id is requested? Try to get the latest one
      
      if($form_id == '') {
        $form_id = $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."forms` ORDER BY date_added DESC LIMIT 1");
      }
      
      //echo $form_id;
      
      if(!$this->CheckFormStatus($form_id)) {
          return false;
      }

      if(is_array($this->mMyForms[$form_id]['custom'])) {
        $layout = $this->mMyForms[$form_id]['custom']['template'];
      } else {       
        $layout = $this->mMyForms[$form_id]['layout'];
      }
                  
      $app = $this->app;
      $afp_conf = $this->mAfpConf;
      
      
      $form_fields = $this->mAfbFormFields[$form_id]['fields'];
      $form_config = $this->mAfbFormFields[$form_id]['config'];
      
      $this->mCurrentFormId = $form_id;
  
      //echo '<pre>'; print_r($form_fields); echo '</pre>';
      
      // This conditional IF is used in case JavaScript is disabled (it passed the post values to the fields' values)
    
      if($form_id == $_POST['form_id']) {
          $afp = $this;
          $form_post = $_POST;
                            
          include $this->mAfpConf['local']['path_to_php_process_file'];
          
    	  if( (isSet($afb_success_submit) && $afb_success_submit == 1) && ($form_config['clear_fields_after_success_submit'] == 1)) {
    	      $_POST = $form_post = array();
    	  }
      } else {
          $form_post = array();
      }
      
      $params = array('form_status'  => $form_status,
                      'form_config'  => $form_config,
                      'form_post'    => $form_post,
		              'form_submit'  => $afb_success_submit,
                      'same_row'     => $this->mMyForms[$form_id]['same_row']);
                  
      if($output) { 
        $this->ParseForm($form_id, $layout, $form_fields, $params);
      } else {        
        return $this->ParseForm($form_id, $layout, $form_fields, $params, 0);
      }
      
      return true;
    }
    
    /**
     * Ajax_Form_Pro::ShowErrors()
     * 
     * @param mixed $errors
     * @return void
     */
    function ShowErrors($errors_notice, $errors_list = array()) {
        
        $errors_output = stripslashes($this->mAfpConf['notifications']['errors_output']);
        
        $errors_output = str_replace('\"', '"', $errors_output);
        $errors_output = str_replace("\'", "'", $errors_output);    
                        
        $errors_output = preg_replace('|{errors_notice}|Ui', $errors_notice, $errors_output);
        $errors_output = preg_replace(array('|{errors_zone}|Ui', '|{/errors_zone}|Ui'), '', $errors_output);
        
        //echo $errors_output;
        
        if( ! empty($errors_list) ) {
            
            //echo '<pre>'; print_r($errors_list); echo '</pre>';
            
            preg_match_all("|{loop}(.*){/loop}|iU", $errors_output, $out, PREG_PATTERN_ORDER);
            
            //echo $errors_output; echo '<pre>'; print_r($out); echo '</pre>';
            
            $errors_string_html = '';
           
            foreach($errors_list as $value) {
            
                // Replace {error} with the actual error       
                $patterns     = array('/{error}/i');
                $replacements = array($value);
                
                $errors_string_html .= preg_replace($patterns, $replacements, $out[1][0]);
            }        
            
            $errors_output = preg_replace('|'.$out[0][0].'|Ui', $errors_string_html, $errors_output);
        }
        
        //echo $errors_output;
        
        return $errors_output;
    }
    
    /**
     * Ajax_Form_Pro::ShowSuccess()
     * 
     * @param mixed $success_notice
     * @return
     */
    function ShowSuccess($success_notice) {
        $success_output = $this->mAfpConf['notifications']['success_output'];
        
        $success_output = str_replace('\"', '"', $success_output);
        $success_output = str_replace("\'", "'", $success_output);
        
        return preg_replace('|{success_notice}|Ui', $success_notice, $this->mAfpConf['notifications']['success_output']);
    }
    
    /**
     * Ajax_Form_Pro::ParseForm()
     * 
     * @param mixed $form_id
     * @param mixed $form_layout
     * @param mixed $form_fields
     * @param mixed $config
     * @return void
     */
    function ParseForm($form_id, $form_layout, $form_fields, $params, $output = 1) {
                
        $form_id_no = $form_id;                        
        $form_id = 'afp'.$form_id;;
  
        //echo '<pre>'; print_r($form_fields); echo '</pre>';
  
        $form_status = $params['form_status'];
        $form_config = $params['form_config'];
        $form_post   = $params['form_post'];
                
        $global_config = $this->SetGlobalConfig($this->mAfpConf, $form_config);
        
        if( ($form_config['hide_form_after_submit']) && ($params['form_submit'] == 1) ) {
            $hide_form = true;
        }
               
        if( ! isSet($hide_form) ) { // Show the form if it was not set to be hidden after successful submit
                
            $field_count = 0;
            
            /* 
            -----------------------------------------
            [START] Looping through each form field 
            -----------------------------------------
            */   
            
            
            foreach($form_fields as $key => $value) {
                
                $field_id = $form_id.'_'.$key;
                
                $field_name = ($value['name']) ? $value['name'] : $key;
                
                $mandatory = $value['mandatory'];
                $type = $value['type'];
                
                if(isset($value['attributes']['value'])) {
                    unset($value['attributes']['value']);
                }
                
                $attributes = $value['attributes'];
                
                $attributes_html = '';
                
                //echo $type;
                
                //echo '<pre>'; print_r($attributes); echo '</pre>';
                
                $text_class_set = false;
                
                // Were field attributes defined? Set them!
                if( is_array($attributes) && !empty($attributes) ) {
                
                	foreach($attributes as $attribute_name => $attribute_value) {
                
                	     if($attribute_name == 'class') { 
                             
                             if($mandatory == 1) {
                                $attribute_value .= ' required'; 
                             }
                             
                             if($type == 'input') {
                                $attribute_value .= ' text';
                                $text_class_set = true;
                             }
                             
                        }
                                        
                        $attributes_html .= $attribute_name.'="'.$attribute_value.'" ';
                	}
                    
                    if($type == 'input' && !in_array('class', $attributes) && !$text_class_set) {
                        $attributes_html .= ' class="text" ';
                    }                    
                
                } else if($type == 'input') {
                    $attributes_html .= ' class="text" ';
                }
                    
                
                //echo $attributes_html."<br />";
                
                $form_fields[$key]['attributes_html'] = $attributes_html;
                
                // Add [] to the select field name if the 'multiple' attribute is used; this way, all the selected options will be posted to the parse page ;-)
                $addMultipleSign = (isSet($attributes['multiple'])) ? '[]' : '';
                
                /* Select Field (Set whether it should be selected or not: usually if the form is submitted and JavaScript disabled)*/
                if(is_array($type['select'])) {
                   
                    foreach($type['select'] as $select_key_value => $select_value) {
                        
                        if($addMultipleSign == '') {
                            $option_selected = ($form_post[$field_name] == $select_key_value) ? ' selected ' : '';
                        } else {
                            $option_selected = (isSet($form_post[$field_name])) ? ( (in_array($select_key_value, $form_post[$field_name])) ? ' selected ' : '' ) : '';
                        }
                        
                        $attr_html = $select_value['attributes'];
                        
                        // If the form is submitted do not show the form with the default 'checks'                            
                        if( ! empty($_POST)) {
                            $attr_html = preg_replace('/selected=("|\'|)selected("|\'|)/i', '', $attr_html);
                        }
                        
                        $form_fields[$key]['type']['select'][$select_key_value]['attr_html'] = $attr_html;                            
                        $form_fields[$key]['type']['select'][$select_key_value]['selected'] = $option_selected;
                    }
                }   
                
                
                
                /* 
                --------------------------
                [START] CHECKBOXES Layout 
                --------------------------
                */
                
                if(is_array($type['checkboxes'])) {
                    
                    $checkboxes_area = '<div class="spacer" id="'.$field_id.'"><div class="afb_checkboxes_area_col"><ul>';
                    
                    $afb_c_i = 1;
    
                    $afb_column_one_num = ceil(count($form_fields[$key]['type']['checkboxes']) / $form_fields[$key]['columns']);
                    
                    $c_array = array();
                    
                    for ($c_i = 1; $c_i <= $form_fields[$key]['columns']; $c_i++) { $c_array[] = ($afb_column_one_num * $c_i) + 1; }
                    
                    $posted_values = ($form_post[$field_name] != '') ? array_values($form_post[$field_name]) : array();
                    
                    foreach($form_fields[$key]['type']['checkboxes'] as $checkbox_key_value => $checkbox_value) {
                      
                        if( in_array($afb_c_i, $c_array ) ) {
                    
                    	    $afb_is_split = true;
                    
                            $checkboxes_area .= '</ul></div>'."\n\n".'<div class="afb_checkboxes_area_col"><ul>'."\n";
                        }
                    
                        $is_checked = in_array($checkbox_key_value, $posted_values) ? " checked='checked' " : '';

                        $attr_html = $form_fields[$key]['type']['checkboxes'][$checkbox_key_value]['attributes'];
                    
                        // If the form is submitted do not show the form with the default 'checks'                            
                        if( ! empty($_POST)) {
                            $attr_html = preg_replace('/checked=("|\'|)checked("|\'|)/i', '', $attr_html);
                        }                 
                    
                        $checkboxes_area .= '<li><input '. $is_checked . $attr_html .' class="chck" type="checkbox" name="'.$field_name.'[]" value="'.$checkbox_key_value.'" id="chk_'.$form_id.$field_count.$afb_c_i.$checkbox_key_value.'" /><label class="afb_labelfor" for="chk_'.$form_id.$field_count.$afb_c_i.$checkbox_key_value.'">'.$checkbox_value['text'].'</label></li>'."\n";         
                    
                        $afb_c_i++;
                    }
                    
                    if($afb_is_split == 1) { $checkboxes_area .= '</ul></div><div class="clear"></div></div>'."\n"; } else { $checkboxes_area .= '</ul></div><div class="clear"></div></div>'; }
                                        
                    $form_fields[$key]['checkboxes_area'] = $checkboxes_area;
                }
                
                /* 
                --------------------------
                [END] CHECKBOXES Layout 
                --------------------------
                */
                
                
                /* 
                -----------------------
                [START] RADIOS Layout 
                -----------------------
                */                
                                       
                if(is_array($type['radios'])) {
                
                    $radios_area = '<div class="spacer" id="'.$field_id.'"><div class="afb_radios_area_col"><ul>';
                    
                    $afb_r_i = 1;
    
                    $afb_column_one_num = ceil(count($form_fields[$key]['type']['radios']) / $form_fields[$key]['columns']);
                    
                    $r_array = array();
                    
                    for ($r_i = 1; $r_i <= $form_fields[$key]['columns']; $r_i++) { $r_array[] = ($afb_column_one_num * $r_i) + 1; }
                    
                    foreach($form_fields[$key]['type']['radios'] as $radio_key_value => $radio_value) {
                      
                        if( in_array($afb_r_i, $r_array ) ) {
                    
                    	    $afb_is_split = true;
                    
                            $radios_area .= '</ul></div>'."\n\n".'<div class="afb_radios_area_col"><ul>'."\n";
                        }
                    
                        $is_checked = (isSet($form_post[$field_name]) && ($form_post[$field_name] == $radio_key_value)) ? " checked='checked' " : '';
                        
                        $attr_html = $form_fields[$key]['type']['radios'][$radio_key_value]['attributes'];

                        // If the form is submitted do not show the form with the default 'checks'                            
                        if( ! empty($_POST)) {
                            $attr_html = preg_replace('/checked=("|\'|)checked("|\'|)/i', '', $attr_html);
                        } 

                        $radios_area .= '<li><input '. $is_checked . $attr_html .' class="rad" type="radio" name="'.$field_name.'" value="'.$radio_key_value.'" id="rad_'.$form_id.$field_count.$afb_r_i.$radio_key_value.'" /><label class="afb_labelfor" for="rad_'.$form_id.$field_count.$afb_r_i.$radio_key_value.'">'.$radio_value['text'].'</label></li>'."\n";         
                    
                        $afb_r_i++;
                    }
                    
                    if($afb_is_split == 1) { $radios_area .= '</ul></div><div class="clear"></div></div>'."\n"; } else { $radios_area .= '</ul></div><div class="clear"></div></div>'; }
                                        
                    $form_fields[$key]['radios_area'] = $radios_area;
                }
    
                /* 
                -----------------------
                [END] RADIOS Layout 
                -----------------------
                */  
    
                $field_count++;
                
                $form_fields[$key]['add_multiple_sign'] = $addMultipleSign;
                $form_fields[$key]['field_id'] = $field_id;
                $form_fields[$key]['post_value'] = $form_post[$field_name];
            }
            
            //echo '<pre>'; print_r($form_fields); echo '</pre>';
            
            /* 
            -----------------------------------------
            [END] Looping through each form field 
            -----------------------------------------
            */ 
				
			$this->mSmarty->assign('fields', $form_fields); // Form Fields           

            $same_rows = array();
            
            $merged_rows = $this->db->getAll(
                "SELECT rf.row_id, rf.field_id, f.name, r.before_content, r.after_content FROM `".$this->conf['db']['prefix']."rows_fields` rf
                LEFT JOIN `".$this->conf['db']['prefix']."rows` r ON (r.id = rf.row_id)
                LEFT JOIN `".$this->conf['db']['prefix']."fields` f ON (f.id = rf.field_id)
                WHERE r.form_id=".(int)$form_id_no
            );
            
            //echo '<pre>'; print_r($merged_rows); echo '</pre>';
            
            if( ! empty($merged_rows) ) {
                foreach($merged_rows as $r_value) {
                    
                    if($r_value['name'] != '') {
                        $field_id = $r_value['name'];
                    } else {
                        $field_id = 'f'.$r_value['field_id'];
                    }
                    
                    $same_rows[$r_value['row_id']][] = array(
                        'field_id'       => $field_id,
                        'before_content' => $r_value['before_content'],
                        'after_content'  => $r_value['after_content'],
                        
                    );
                }
                
                foreach($same_rows as $row_id => $v) {
                    
                    $last_key = count($same_rows[$row_id]) - 1;
                                        
                    $same_rows[$row_id]['last_field_id'] = $same_rows[$row_id][$last_key]['field_id'];
                }                
                
                $this->mAfbFormFields[$form_id]['same_row'] = $same_rows;
                
                //echo '<pre>'; print_r($this->mAfbFormFields[$form_id]['same_row']); echo '</pre>';
            }
            
            if(isSet($this->mAfbFormFields[$form_id]['same_row'])) {
            
                $same_row = $this->mAfbFormFields[$form_id]['same_row'];
                
                //echo '<pre>'; print_r($same_row); echo '</pre>';
                
                $this->mSmarty->assign('same_row', $same_row);
                
                $same_row_fields = array();
                
                foreach($same_row as $k => $v) {
                	foreach($v as $s) {
                		$same_row_fields[] = $s['field_id'];
                	}
                }  
            } else {
                $same_row_fields = array();
            }
        
        $this->mSmarty->assign('same_row_fields', $same_row_fields);        
                                
        // Set form's attributes
        
        $form_attributes = array('action' => '#'.$form_id.'_anchor');
        
        //echo '<pre>'; print_r($this->mAfbFormFields[$form_id_no]['config']); echo '</pre>';
        
        // Add the enctype tag is file attachments are used (when JS is disabled)
        if($this->mAfbFormFields[$form_id_no]['config']['attachments']['enabled'] == 1) {
            $form_attributes['enctype'] = 'multipart/form-data';  
        }
        
        $this->mSmarty->assign('form_attributes', $form_attributes); // Global and Form Configuration variables
        }


		$this->mSmarty->assign('form_status', array('display' => ( (isSet($form_status)) ? 'style="display: block;"' : '' ), // Show it or not
                                                    'message' => ( (isSet($form_status)) ? $form_status : '' ))); // Status message
               
                       
        $this->mSmarty->assign('x', md5(microtime(time()))); // for the captcha (to prevent caching)
        
                                                        
		$this->mSmarty->assign('form_id',     $form_id); // Form ID                    
		$this->mSmarty->assign('c',           $global_config); // Global and Form Configuration variables
        
        $this->mSmarty->assign('hide_form',   $hide_form);
        
        //echo is_array($this->mMyForms[$form_id]['custom']);
        //$form_id = str_replace('afp', '', $form_id);  
                      
        // Layout Template
        $layout_file = (is_array($this->mMyForms[$form_id_no]['custom'])) ? 'custom/'.$form_layout : $form_layout.'.tpl';
                                 
        if(strrchr($layout_file, '.') != '.tpl') { # add the .tpl extension if it's not in the string
            $layout_file .= '.tpl';
        }
  
        $layout_template = $this->mAfpConf['templates']['form_layouts'].$layout_file;
        
        // Attachments Template
        $layout_attachments = $this->mAfpConf['templates']['parent_attachments'];
        
        if($form_config['attachments']['enabled'] == 1) {
            $this->ParseAttachment($form_id_no);
        }
        
        $this->mSmarty->assign('attachments', $this->mSmarty->fetch($layout_attachments));
        
        // reCaptcha
        if($form_config['recaptcha']['enabled'] == 1) {
            require_once('recaptchalib.php');
            
            $recaptcha_public_key = $form_config['recaptcha']['public_key'];
            $this->mSmarty->assign('recaptcha_output', recaptcha_get_html($recaptcha_public_key));
        }        
        
        if($output == 1) {        
            $this->mSmarty->display($layout_template);
        } else {
            return $this->mSmarty->fetch($layout_template);    
        }
    }
    
    /**
     * Ajax_Form_Pro::ParseAttachment()
     * 
     * @param mixed $form_id
     * @param mixed $config
     * @return void
     */
    function ParseAttachment($form_id) {
        
        $session_id = session_id();
        
        $subfolder = date('Y.m.d.G'); // date and hour (to easy browse folders in the main uploads folder)
        $path_to_subfolder = $this->mAfpConf['local']['path_to_uploader_uploads'] . $subfolder;
        
        if( ! is_dir($path_to_subfolder)) {
            $this->MakeDirectoryForUploads($path_to_subfolder);
        }
        
        $temp_dir_name = $form_id.'_'.uniqid('', true).$session_id;
        
        $this->MakeDirectoryForUploads($path_to_subfolder . '/' . $temp_dir_name);
                 
        $this->mSmarty->assign('subfolder', $subfolder);
        
        $this->mSmarty->assign('temp_dir_name', $temp_dir_name);
        
        $this->mSmarty->assign('max_uploads',   $this->mAfbFormFields[$form_id]['config']['attachments']['maximum_files']);
        $this->mSmarty->assign('file_ext',      $this->ParseFileExt($this->mAfbFormFields[$form_id]['config']['attachments']['allowed_extensions']));
        $this->mSmarty->assign('file_desc',     $this->mAfbFormFields[$form_id]['config']['attachments']['extensions_text']);  
    }
    
    /**
    * Ajax_Form_Pro::GetFormData()
    * 
    * @return
    */
    function GetFormData($formId = '') {
            
      $AfbFormData = array();
    
      $included = 0;
      
      if($formId) {
         $forms = array($formId);
      } else {
         $forms = array_keys($this->mMyForms);
      }
      
      //echo '<pre>'; print_r($forms); echo '</pre>';
    
      foreach($forms as $formId) { // Loop through the form used in the page
    
             // Create the Form CONFIG
             $AfbFormData[$formId]['config'] = $this->createFormConfig($formId);
             
             // Create the Form Fields
             $AfbFormData[$formId]['fields'] = $this->createFormFields($formId);
          
             $included = 1;
      }
      
      //echo '<pre>'; print_r($AfbFormData); echo '</pre>'; exit;
      
      if($included == 1) {
          return $AfbFormData;
      }
      
      return false;
    }
    
    public function createFormConfig($form_id, $group_id = '') {
        
        $main = array();
    
        $replacements = array('[' => "['", ']' => "']");
        
        if($form_id != 'default') { 
             
            $q = "SELECT fcn.field_name, fcv.value as field_value
                    
                FROM `".$this->conf['db']['prefix']."config_values` fcv
                          
                LEFT JOIN `".$this->conf['db']['prefix']."config_names` fcn ON (fcv.field_id = fcn.id)
                    
                WHERE fcv.form_id='".$form_id."'";
                
            if($group_id) {
                $group_id = (int)$group_id;
                $q .= " && fcn.group_id='".$group_id."'";
            }   
            
        } else { // For Captcha Preview
            $q = "SELECT field_name, default_value as field_value FROM `".$this->conf['db']['prefix']."config_names` WHERE group_id='7'";
        }
        
        $results = $this->db->getAll($q);
    
        foreach($results as $c_v) {
                               
            $c_name     = $c_v['field_name'];
            
            $c_value    = $c_v['field_value'];
            $c_value = str_replace('\"', '"', $c_value);
            $c_value = str_replace("\'", "'", $c_value);    
            

            if(preg_match('/\[/', $c_name)) {
                
                $c_name = str_replace(array('[',']'), '|', $c_name);
                $c_name = str_replace('||', '|', $c_name);
                $c_name = trim($c_name, '|');
                                
                $i = 1;
                
                $c_name_list = explode('|', $c_name);
                
                $count = count($c_name_list);
                
                if($count == 2) {
                    $main[$c_name_list[0]][$c_name_list[1]] = $c_value;
                } elseif($count == 3) {
                    $main[$c_name_list[0]][$c_name_list[1]][$c_name_list[2]] = $c_value;
                }
                            
            } else {
                $main[$c_name] = $c_value;
            }
        }
         
        $main = $this->FilterArray2($main);
                
        // FOR RECIPIENTS' LIST
        
        if($main['webmasters'] != '') {
            
            $selected_list = (array)json_decode(stripslashes($main['webmasters']));
            $selected_list = implode(',', $selected_list);
            
            //echo '<pre>'; print($selected_list); echo '</pre>';
            
            // Get the list with the selected webmasters/recipients
            $recipients_list = $this->db->getAll("SELECT name, email FROM `".$this->conf['db']['prefix']."webmasters` WHERE id IN(".$selected_list.")");
            
            $list_array = array();
            
            foreach($recipients_list as $value) {
                $list_array[] = array(
                    'name'  => $value['name'],
                    'email' => $value['email']
                );
            }
            
            $main['webmasters'] = $list_array;
        }
        
        //echo '<pre>'; print_r($main); echo '</pre>';
        
        return $main;        
    }

    public function createFormFields($formId) {
        
        $field_types = $this->form_fields->getTypes();
        
        $fields = $this->form_fields->getData($formId);
        
        //echo '<pre>'; print_r($fields); echo '</pre>'; exit;
        
        $main = array();
        
        foreach($fields as $value) {
            
            $element_id = 'f'.$value['id'];
            
            $field_id = $value['id'];
    
            // Get default value (if any)
            $default_value = $this->db->getOne("SELECT value FROM `".$this->conf['db']['prefix']."fields_attributes` WHERE name='value' && field_id='".$field_id."'");
    
            // Build Validation
            $validations = array();
            
            $v_all = $this->db->getAll("SELECT type, message, value FROM `".$this->conf['db']['prefix']."fields_validations` WHERE field_id='".$field_id."'");
    
            if( ! empty($v_all) ) {
                foreach($v_all as $v) {
                    $validations[$v['type']] = array(
                        'message' => $v['message'],
                        'value'   => $v['value']
                    );
                }
            }

            // Build Attributes
            $attributes = array();
            
            $a_all = $this->db->getAll("SELECT name, value FROM `".$this->conf['db']['prefix']."fields_attributes` WHERE field_id='".$field_id."'");
    
            if( ! empty($a_all) ) {
                foreach($a_all as $a) {
                    $attributes[$a['name']] = $a['value'];
                }
            }
            
            if($value['type_id'] == 4) { 
                $op_t = 'checkboxes';
            } else if($value['type_id'] == 5) {
                $op_t = 'radios';
            } else if($value['type_id'] == 2) {
                $op_t = 'select';
            }
            
            $parent_id = $value['parent_id'];
            
            // See if the select has descendants/childs
            $getChildInfo = $this->db->getRow("SELECT id, name FROM `".$this->conf['db']['prefix']."fields` WHERE parent_id='".(int)$field_id."'");
            
            $child_id = $getChildInfo['name'];
            if(!$child_id) $child_id = ($getChildInfo['id']) ? 'f'.$getChildInfo['id'] : '';
            
            if($op_t == 'select' && $parent_id != 0 && !defined('LOAD_ALL_SELECT_OPTIONS')) {
                $type['select'] = array();
            } else {
                $opt_a = array();   
                             
                // Build Options
                $options = array();
                
                $q = "SELECT id, text, value, attributes FROM `".$this->conf['db']['prefix']."fields_options` WHERE field_id='".$field_id."'";
                
                /*
                if( !empty($_POST) ) {
                    $parent_id_current_child = $this->db->getOne("SELECT parent_id FROM `".$this->conf['db']['prefix']."fields` WHERE id='".$field_id."'");
                    //echo $parent_id_current_child.'<br />';
                    
                    $getParentInfo = $this->db->getRow("SELECT id, name FROM `".$this->conf['db']['prefix']."fields` WHERE id='".(int)$parent_id_current_child."'");
                    
                    $child_parent_id_field_name = $getParentInfo['name'];
                    if(!$child_parent_id_field_name) $child_parent_id_field_name = 'f'.$getParentInfo['id'];
                    
                    //echo $child_parent_id_field_name.'<br />';
                    
                    if($_POST[$child_parent_id_field_name] != '') {
                        $child_option_parent_id = str_replace('o', '', $_POST[$child_parent_id_field_name]);
                        $q .= " && parent_id='".$child_option_parent_id."' ";
                    }  
                }
                */
                
                $q .= " ORDER BY `position`";
                //echo $q;
                
                $o_all = $this->db->getAll($q);
                
                if( ! empty($o_all) ) {
                    
                    foreach($o_all as $o) {
                        $option_value = ($o['value']) ? $o['value'] : 'o'.$o['id'];
                        
                        $opt_a[$option_value] = array('text' => $o['text'], 'attributes' => $o['attributes']);
                    }
                        
                    $options_all = array(
                        $op_t => $opt_a
                    );
                    
                    $type = $options_all;
                    
                } else {
                    $type = $field_types[$value['type_id']];
                }
            }     
            
            if($value['name']) {
                $element_id = $name = $value['name'];
            } else {
                $name = $element_id;
            }
            
            $main[$element_id] = array(
                'field_id'       => $value['id'],
                'text'           => $value['text'],
                'name'           => $name,
                'mandatory'      => $value['mandatory'],
                'default_value'  => $default_value,
                'columns'        => $value['columns'],
                'type'           => $type,
                'validation'     => $validations,
                'attributes'     => $attributes,
                'before_content' => $value['before_content'],
                'after_content'  => $value['after_content'],
                'child_id'       => $child_id // if any
            );
        }           
               
        //echo '<pre>'; print_r($main); echo '</pre>'; exit;
        
        return $main; 
    }
    
    /**
    * Ajax_Form_Pro::CheckFormStatus()
    * 
    * @param mixed $formId
    * @return
    */
    function CheckFormStatus($form_id, $just_active = 0) {
    
      // Check if the ID exists in the database
      $active = $this->db->getOne("SELECT active FROM `".$this->conf['db']['prefix']."forms` WHERE id='".$form_id."'");
            
      if( $active == 0 ) {
        
          if($just_active == 1) { return false; }
          
          echo $this->mAfpConf['status_notifications']['no_active_form'];
          return false;
      }
      
      //echo '<pre>'; print_r($this->mAfbFormFields[$formId]['config']); echo '</pre>';
            
      /*
      if($just_active == 0) {     
            
          $webmasters_list = (array)json_decode(stripslashes($this->db->getOne("SELECT value FROM `".$this->conf['db']['prefix']."config_values` WHERE form_id='".$form_id."' && field_id='41'")));
            
          if(empty($webmasters_list)) {
              echo $this->mAfpConf['status_notifications']['webmaster_info_not_set'];
              return false;
          }
      }
      */
      
      return true;            
    }      
    
    /**
    * Ajax_Form_Pro::EnableDatepicker()
    * 
    * @return
    */
    function EnableDatepicker() {
        
       foreach(array_keys($this->mMyForms) as $form_id) {
       
           if($this->HasDatepickerClass($this->mAfbFormFields[$form_id]['fields'])) {
               return true;
           }
       }
       return false;
    }
    
    /**
     * Ajax_Form_Pro::getDatepickerFields()
     * 
     * @return
     */
    function getDatepickerFields() {
        
        $datepickers = array();
        
        foreach(array_keys($this->mMyForms) as $form_id) {
            
            foreach($this->mAfbFormFields[$form_id]['fields'] as $field_id => $value) {
                
                $check_in = ' '.$value['attributes']['class'].' ';
                
                if(preg_match('/datepicker/i', $check_in)) {
                
                    $from_or_to = false;
                                                          
                    if(preg_match('/\s([^\s]+)_from/i', $check_in, $output)) {
                        $identifier = $output[1];
                        $datepickers['froms_tos'][$identifier]['from'] = 'afp'.$form_id.'_'.$field_id;
                        $from_or_to = true;
                    }
    
                    if(preg_match('/\s([^\s]+)_to/i', $check_in, $output)) {
                        $identifier = $output[1];
                        $datepickers['froms_tos'][$identifier]['to'] = 'afp'.$form_id.'_'.$field_id;
                        $from_or_to = true;
                    }
                    
                    if( ! $from_or_to ) {
                        $datepickers['simple'][] = 'afp'.$form_id.'_'.$field_id;
                    }
                }
            }    
        }

		return $datepickers;
    }
    
    /**
    * Ajax_Form_Pro::EnableUploader()
    * 
    * @return
    */
    function EnableUploader() {
       foreach($this->mAfbFormFields as $value) {
           if($value['config']['attachments']['enabled'] == 1) {
               return true;
           }
       }
       return false;
    }
    
    function SendPostData($_p, $remote_url) {
        $remote_url = trim($remote_url);
        
        $is_https = (substr($remote_url, 0, 5) == 'https') ? true : false;
        
        // Prepare the fields to send to a remote page (if active)
        $fields = array();
        
        foreach($_p as $afb_p_key => $afb_p_value) {
            $afb_p_key = str_replace('[]','', $afb_p_key);
            
            $fields[$afb_p_key] = $afb_p_value;
        }
        
        $fields_string = http_build_query($fields);
        
        if(function_exists('curl_init')) {
            
            // create a new cURL resource
            $ch = curl_init();
            
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_URL, $remote_url);
            
            if($is_https) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            }
            
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);            
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            // grab URL and pass it to the browser
            curl_exec($ch);
            
            // close cURL resource, and free up system resources
            curl_close($ch);
            
        }
    }
}
?>