<?php
/**
 * Misc_Functions
 * 
 * @package AJAX Form Pro
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Misc_Functions extends Ajax_Form_Pro {

    /**
     * Misc_Functions::__construct()
     * 
     * @param mixed $db
     * @return void
     */
    public function __construct($form_fields, $db) {
        $this->form_fields = $form_fields;
        $this->db = $db;
    }
    
    /**
     * Misc_Functions::MakeDirectoryForUploads()
     * 
     * @param mixed $DirName
     * @return
     */
    function MakeDirectoryForUploads($path_to_dir) {             
        if(mkdir($path_to_dir, 0755)) {
            chmod($path_to_dir, 0755);
            return true;
        }
        return false;
    }
    
    /**
     * Misc_Functions::ParseFileExt()
     * 
     * @param mixed $array
     * @return
     */
    function ParseFileExt($array) {
        if(is_array($array)) {
            $list = '';
            
            foreach($array as $ext) {
                $list .= '*.'.str_replace('.', '', $ext).';';
            }
            
            return substr($list, 0, -1);
        }    
        return false;
    }
       
    /**
     * Misc_Functions::HasAllowedExtension()
     * 
     * @param mixed $file
     * @param mixed $allowed_file_exts
     * @return
     */
    function HasAllowedExtension($file, $allowed_file_exts) {
        $file_ext = strrchr($file, '.');
        $file_ext = str_replace('.', '', $file_ext);
         
        foreach($allowed_file_exts as $ext) {
            if(preg_match('/'.$file_ext.'/i', $ext)) {
                return true;
            }
        }
        return false;
    }  
       
       
    /**
     * Misc_Functions::HasAttachments()
     * 
     * @param mixed $path
     * @param mixed $allowed_file_exts
     * @return
     */
    function HasAttachments($path, $allowed_file_exts) {
    
        if(is_dir($path)) {
            
            if($handle = opendir($path)) {
             
                $files = array();
             
                while (false !== ($file = readdir($handle))) {      
                    if ($file != '.' && $file != '..') {
                        if($this->HasAllowedExtension($file, $allowed_file_exts)) {
                            $files[] = $file;
                        }
                    }
                }
                return $files;
           }
        }
    
    return false;
    }
   
   
    /**
     * Misc_Functions::RemoveDir()
     * 
     * @param mixed $Directory
     * @return
     */
    function RemoveDir($Directory) {
    
        if (is_dir($Directory)) { // Continue if the directory exists
            $dir_handle = opendir($Directory);
           
            if (!$dir_handle) { // return false if the directory can't be open
                return false;
            }
    
            while($file = readdir($dir_handle)) { // loop through the files from the directory
                if ($file != '.' && $file != '..') {
                    if (!is_dir($Directory.'/'.$file)) {
                        unlink($Directory.'/'.$file);
                    } else {
                        $this->RemoveDir($Directory.'/'.$file);   
                    } 
                }
            }
            closedir($dir_handle);
            rmdir($Directory);
        }
        return true;
    }
      
    /**
     * Misc_Functions::HasDatepickerClass()
     * 
     * @param mixed $fields
     * @return
     */
    function HasDatepickerClass($fields) {
        
        //echo '<pre>'; print_r($fields); echo '</pre>';
        
        foreach($fields as $fieldAttributes) {            
            if(isSet($fieldAttributes['attributes']['class'])) {                    
                if(preg_match('/datepicker/i', $fieldAttributes['attributes']['class'])) {
                    return true;
                }
            }
        }
        return false;
    }
   
    /**
     * Misc_Functions::ParseFields()
     * 
     * @param mixed $afbFormFields
     * @return
     */
    function ParseFields($afbFormFields) {
        
        foreach($afbFormFields as $key => $value) {
            
	        foreach($value['fields'] as $fieldName => $fieldAttributes) {
	            if($fieldAttributes['mandatory'] == 1 && !(isSet($fieldAttributes['validation']))) {
                    $afbFormFields[$key]['fields'][$fieldName]['validation'] = array('basic' => 1);
		        }
            }
            
            foreach($value['config']['attachments'] as $a_key => $a_value) {
                foreach($afbFormFields[$key]['config']['attachments']['errors'] as $error_key => $error_msg) {
                    $afbFormFields[$key]['config']['attachments']['errors'][$error_key] = str_replace('['.$a_key.']', $a_value, $afbFormFields[$key]['config']['attachments']['errors'][$error_key]);
                }
            }
            
        }
            
	    return $afbFormFields;
    }
    
    /**
     * Misc_Functions::ParseFieldsForJS()
     * 
     * @param mixed $form_fields
     * @return void
     */
    function ParseFieldsForJS($form_fields) {
           
        foreach($form_fields as $key => $value) {
            
            $field_db_id = $value['field_id'];
            
            $field_id = 'afp'.$this->mCurrentFormId.'_'.$key;
            
                // Loop through each form's field and create the validation for it
            
                    /* Set the field's target selector that will be later used for the validation
                       
                       Example: '#customer_newsletter > div > ul > li > input[type=radio]'
                                targets the radio input inside: <div id="customer_newsletter">
                                                                    <div>
                                                                        <ul>
                                                                            <li>[RADIO INPUTS HERE]</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                    */
                    
            	    if( !  empty($value['validation']['checkbox']) ) {
                        $form_fields[$key]['selector'] = '#'.$field_id.' > div > ul > li > input[type=checkbox]';
                    } else if( ! empty($value['validation']['radio']) ) {
                        $form_fields[$key]['selector'] = '#'.$field_id.' > div > ul > li > input[type=radio]';
                    } else {
                        $form_fields[$key]['selector'] = '#'.$field_id;
                    }
                    
                if( ($value['validation']['phone']['message']) && ($value['validation']['phone']['value']) ) {

                    $format_value = trim($value['validation']['phone']['value']);
                    $formats_list = explode(',', $format_value);
                    
                    foreach($formats_list as $format) {
                        $number_formats[] = trim($format);
                    }
                    
                    $form_fields[$key]['validation']['phone']['formats'] = '["'. implode('","', $number_formats) .'"]';        
                }    
                    
                if($value['mandatory'] == 1) { // Is the field required? Proceed with the validation
                    
                    /* The following snippet replaces text such as [min_selections] from the errors messages with the actual values
                      
                       Example: 'You must make [min_selection] minimum selections'
                                 
                                 becomes
                                 
                                'You must make 2 minimum selections'
                    */
                    
                        $min_selections    = (isSet($value['validation']['min_selections']['value'])) ? $value['validation']['min_selections']['value'] : 1;
                        $min_chars         = (isSet($value['validation']['min_chars']['value'])) ? $value['validation']['min_chars']['value'] : 1;
                        
                        $valueReplacements = array('[min_selections]' => $min_selections, 
                                                   '[min_chars]'      => $min_chars);
                        
                        foreach($form_fields[$key]['validation'] as $error_type => $error_array) {   
                            $error_message = addslashes(str_replace(array_keys($valueReplacements), array_values($valueReplacements), $error_array['message']));
                            
                            $error_message = nl2br($error_message);
                            $error_message = str_replace("\r\n", '', $error_message);
                            
                            $form_fields[$key]['validation'][$error_type]['message'] = $error_message;
                        }
                        
                        $toNext = (strpos($value['attributes']['class'], 'datepicker') !== false) ? 'next().' : '';
                        
                        $form_fields[$key]['toNext'] = $toNext;
                                                  
                } 
                
                $form_fields[$key]['field_id'] = $field_id;
                
                $form_fields[$key]['field_db_id'] = $field_db_id;   
            }
            
        return $form_fields;        
    }
    
    function SetMessageValuesFromPost($afb_form_fields) {
        // Construct the 'replacements' vector that will be later used to replace {value} from the message with the actual values
        $afb_replacements = array();
        
        foreach($_POST as $afb_p_key => $afb_p_value) {
    
            //echo '<pre>'; print_r($afb_form_fields[$afb_p_key]); echo '</pre>';
    
            $afb_p_key = str_replace('[]','', $afb_p_key);
            
            // 1) Set the replacement value

	        # For Checkboxes
	        if(is_array($afb_form_fields[$afb_p_key]['type']['checkboxes'])) {

                $chckValues = '';

                foreach($afb_p_value as $chckValue) {
                    $chckValues .= strip_tags($afb_form_fields[$afb_p_key]['type']['checkboxes'][$chckValue]['text']).', ';
                }

                $replacement = substr($chckValues, 0, -2);
	
	        # For Radios
	        } else if(is_array($afb_form_fields[$afb_p_key]['type']['radios'])) {

		        $replacement = strip_tags($afb_form_fields[$afb_p_key]['type']['radios'][$afb_p_value]['text']);	
    
	        # For Selects (Multiple)
	        } else if(isSet($afb_form_fields[$afb_p_key]['attributes']['multiple'])) {
               
                $selectValues = '';

                foreach($afb_p_value as $selectValue) {
                    $selectValues .= strip_tags($afb_form_fields[$afb_p_key]['type']['select'][$selectValue]['text']).', ';
                }
                
                $replacement = substr($selectValues, 0, -2);
                
            # Selects (Single)    
	        } else if(is_array($afb_form_fields[$afb_p_key]['type']['select']) && !isSet($afb_form_fields[$afb_p_key]['attributes']['multiple'])) {
	            
                $replacement = strip_tags($afb_form_fields[$afb_p_key]['type']['select'][$afb_p_value]['text']);
                
	        # For Inputs, Textareas
	        } else {
                $replacement = $afb_p_value;	
    	    }
                        
            // 2) Do the actual replace
            
            $afb_replacements['{'.$afb_p_key.'}'] = $replacement;
        }
        
        return $afb_replacements;        
    }
    
    function GetTotalRequiredInputs($form_fields) {
        // Determine total required inputs
        $total_required_inputs = ($this->mAfpConf['captcha']['enabled'] == 1) ? 1 : 0;
        
        if( ($this->mAfpConf['attachments']['enabled'] == 1) && ($this->mAfpConf['attachments']['mandatory'] == 1) ) {
            $total_required_inputs++;
        }
        
        foreach($form_fields as $value) {
            if($value['mandatory'] == 1 && !empty($value['validation'])) {
                $total_required_inputs++;
            }
        }
        
        return $total_required_inputs;
    }
        
    function SetGlobalConfig($afp_conf, $form_fields_config) {
        $afp_conf = array_merge($afp_conf, $form_fields_config);
        $afp_conf['errors_effect'] = (($afp_conf['errors_effect'] != 'slide')) ? 'none' : 'slide';
        
        return $afp_conf;
    }
    
    /**
     * Misc_Functions::MakeURLForAttachedFile()
     * 
     * @param mixed $url_path_to_uploader_get_file
     * @param mixed $params
     * @return
     */
    function MakeURLForAttachedFile($url_path_to_uploader_get_file, $params) {
        $url = $url_path_to_uploader_get_file.'?i='.$params['i'].'&f='.$params['f'];
        
        return $url;
    }
    
    /**
     * Misc_Functions::AddAttachmentsURLToMailMessage()
     * 
     * @param mixed $attachments_mail_body
     * @return
     */
    function AddAttachmentsURLToMailMessage($attachments_mail_body, $attachments, $temp_dir_name) {
        
        // Replace everything between {loop} and {/loop} with the list of the attached files
    
        preg_match_all("|{loop}(.*){/loop}|iU", $attachments_mail_body, $out, PREG_PATTERN_ORDER);
       
        $items_string_html = $items_string_text = '';
       
        foreach($attachments as $value) {
        
            // Item Name & Download Item URL         
            $patterns     = array('/{item_name}/i', '/{item_url}/i');
            $replacements = array($value, $this->MakeURLForAttachedFile($this->mAfpConf['url']['path_to_uploader_get_file'], array('i'=> urlencode($value), 'f' => $temp_dir_name)));
            
            $items_string_html .= preg_replace($patterns, $replacements, $out[1][0]);
            $items_string_text .= $replacements[1]."\n";
        }
       
        // Add the attachments list to the body mail message (for both HTML and plain text messages)
        
        return array(preg_replace('|'.$out[0][0].'|Ui', $items_string_html, $attachments_mail_body), 
                     preg_replace('|'.$out[0][0].'|Ui', $items_string_text, $attachments_mail_body));    
    }
  
  	/* Credits: http://roshanbh.com.np/2007/12/getting-real-ip-address-in-php.html */

	/**
	 * Misc_Functions::GetRealIpAddress()
	 * 
	 * @return
	 */
	function GetRealIpAddress() {

		// check ip from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		// to check ip is pass from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else {
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }

	    return $ip;
	} 
    
    // json_encode — Returns the JSON representation of a value

    /* This is an alternative json_encode() function in case you're using an older PHP Version (PHP 5 >= 5.2.0, PECL json >= 1.2.0) */

    /**
     * Misc_Functions::DoJsonEncode()
     * 
     * @param bool $a
     * @return
     */
    function DoJsonEncode($a=false)
    {
        if(function_exists('json_encode')) {
            return json_encode($a);
        } else {
            include 'class.services.json.php';
            
            // create a new instance of Services_JSON
            $json = new Services_JSON();
            return $json->encode($a, 0);
        }
    }
    
    // Source: http://www.anyexample.com/programming/php/php_convert_rgb_from_to_html_hex_color.xml
    
    function html2rgb($color)
    {
        if ($color[0] == '#')
            $color = substr($color, 1);
    
        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                                     $color[2].$color[3],
                                     $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;
    
        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
    
        return array('r' => $r, 'g' => $g, 'b' => $b);
    }
}
?>