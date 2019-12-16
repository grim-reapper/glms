<?php
/* 
Author: Gabriel Comarita
Author's Website: http://www.bitrepository.com/

Copyright (c) BitRepository.com - You do not have rights to reproduce, republish, redistribute or resell this product without permission from the author or payment of the appropiate royalty of reuse.

* Keep this notice intact for legal use *
*/
define('LOAD_ALL_SELECT_OPTIONS', 1);

$isAjaxUsed = ( (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) ? true : false;

//echo '<pre>'; print_r($_REQUEST); echo '</pre>';

if ($isAjaxUsed) {
    include_once 'headers.php';
    include_once 'common.php';
} else {
    if(!isset($this)) {
        exit;   
    }
    $app = $this->app;
    $db = $this->db;
}

// Load the files depending on the PHP version that is used

$php_mailer_dir = 'includes/php.mailer/';

include_once $php_mailer_dir.'class.phpmailer.php';
include_once $php_mailer_dir.'class.pop3.php';


// Was the method "POST" used? Continue

if(!empty($_POST)) {
    $original_post = $_POST;
    
    extract($_POST);
    
    $form_id = (int)preg_replace('/[^0-9+]/', '', $form_id); 
     
    //echo '<pre>'; print_r($_POST); echo '</pre>';
    
    include 'includes/class.validation.php';
    
    $validate = new Validation;
    
    $_POST[$form_id] = $_POST;
        
    if(!$afp->CheckFormStatus($form_id)) exit;

    $afp->mCurrentFormId = $form_id;

    $AfbFormFields = $afp->GetFormData($form_id);
    
    //echo '<pre>'; print_r($AfbFormFields); echo '</pre>'; exit;
    
    
    $AfbFormFields = $afp->ParseFields($AfbFormFields);
    
    $afp_conf = $afp->mAfpConf = $afp->SetGlobalConfig($afp_conf, $AfbFormFields[$form_id]['config']);
           
    $afb_error = array();

    $afb_form_fields = $AfbFormFields[$form_id]['fields'];
    
    //echo '<pre>'; print_r($afb_form_fields); echo '</pre>';
    
    
    // Starts empty (no error) as default (if there are errors this variable will be filled)
    $errors_list = array();

    /* 
    -------------------------------------------
    Validate all the inputs except the CAPTCHA
    -------------------------------------------
    */
    
    foreach($afb_form_fields as $afb_key => $afb_value) {
        
        $afb_key = str_replace('[]','', $afb_key);

        if($afb_value['mandatory'] == 1) { // Mandatory?        
                
            $response_type = $validate->DoValidate($_POST[$afb_key], $afb_key, $afb_value['validation']);
                                        
            if($response_type != 1) {
              
                if( isSet($afb_value['validation'][$response_type]['message']) && ($response_type) ) {
                    
                    $afb_error[$afb_key] = $response_type;
                    
                    $errors_list[] = str_replace('['.$response_type.']', 
                                                 $afb_value['validation'][$response_type]['value'], 
                                                 $afb_value['validation'][$response_type]['message']);
                }
            }
        }        
    }
    
    /* 
    -------------------
    Validate CAPTCHA
    -------------------
    */
    
    if($afp_conf['captcha']['enabled'] == 1) {
        
        // Security Code submitted by the user
        $afb_security_code = strtolower($_POST['security_code']);
        
        // Was any security code entered?
        if($afb_security_code == '') {

            $afb_error['security_code'] = 1;
            
            $errors_list[] = $afp_conf['notifications']['security_code_e'];
        
        // Compare the security codes
        } else {

            $afb_token = ($_SESSION[$form_id.'_captcha_security_code'] == '') ? $_COOKIE[$form_id.'_captcha_security_code'] 
                                                                              : $_SESSION[$form_id.'_captcha_security_code'];
                                                                                  
            if(md5($afb_security_code) != $afb_token) {
                $afb_error['security_code'] = 2;
                
                $errors_list[] = $afp_conf['notifications']['security_code_i_e'];
            }
        }
    }
    
    /* 
    --------------------
    Validate reCAPTCHA
    --------------------
    */     
    
    if($afp_conf['recaptcha']['enabled'] == 1) {
        require_once('includes/recaptchalib.php');
        
        $recaptcha_private_key = $afp_conf['recaptcha']['private_key'];
        
        $recaptcha_response = recaptcha_check_answer ($recaptcha_private_key, $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        if ( ! $recaptcha_response->is_valid ) {
            $afb_error['security_code'] = 2;
            
            $recaptcha_response_error = $recaptcha_response->error;
            
            if($recaptcha_response_error == 'incorrect-captcha-sol') {
                $errors_list[] = $afp_conf['notifications']['recaptcha_solution_error'];
            } else {
                $errors_list[] = 'reCAPTCHA error: '.$recaptcha_response->error;
            }
        }  
    }
    
    /* 
    ----------------------
    Validate Attachments
    ----------------------
    */   
    
    //echo $afp_conf['attachments']['enabled']; 
    
    //echo $form_id;
    

    //echo '<pre>'; print_r($afp_conf['attachments']); echo '</pre>';
    
    if( $afp_conf['attachments']['enabled'] == 1 )  {
        
        $attach = $afp_conf['attachments'];
        $attach['allowed_extensions'] = explode(',', $attach['allowed_extensions']);
        
			// Tipically called when JavaScript is disabled and therefore the AJAX call was NOT made
			if( ! $isAjaxUsed) {  
			
				// Handle File Uploads (this is triggered if JavaScript is disabled)
				include 'includes/class.uploader.php';    
									
					$path_to_temp_dir_upload = $afp_conf['local']['path_to_uploader_uploads'] . $subfolder . '/' . $temp_dir_name;
					
					$afb_uploader = new Uploader;
					
					$params = array('form_id'            => 'afp'.$form_id,
                                    'subfolder'          => $subfolder,
									'temp_dir_name'      => $temp_dir_name,
									'allowed_extensions' => $attach['allowed_extensions'],
									'maximum_size'       => $attach['maximum_size'],
									'maximum_files'      => $attach['maximum_files']);
					
					$handle_file_uploads = $afb_uploader->HandleUploads($path_to_temp_dir_upload, $params);
									
                    ///echo '<pre>'; print_r($handle_file_uploads); echo '</pre>';
                                    
					if(is_array($handle_file_uploads['error'])) {
						
						foreach($handle_file_uploads['error'] as $error_key => $error_value) {            
							
							$upload_err_msg = $attach['errors'][$error_key];                 
							
							if($error_key == 'maximum_size') {
								$upload_err_msg = str_replace('[max_size]', $attach['maximum_size'], $upload_err_msg);
							}
							
							$files_list = '<ul>';
							
							foreach($error_value as $file_name) {
								$files_list .= '<li>'.$file_name.'</li>';
							}
							
							$files_list .= '</ul>';
							
							$errors_list[] = $upload_err_msg.': <br />'.$files_list;
						}
					}                  
				
				$path_to_temp_dir_upload = $afp_conf['local']['path_to_uploader_uploads'] . $subfolder . '/' . $temp_dir_name;
							  
				$attachments = $afp->HasAttachments($path_to_temp_dir_upload, $attach['allowed_extensions']);
								   
			} else { // Is AJAX used?
				$attachments = $_SESSION['files_uploaded'][$temp_dir_name];
			}
	    
			$total_attachments = count($attachments);

			if($afp_conf['attachments']['mandatory'] == 1) {
        
				if($total_attachments == 0) {
					$afb_error['attachments'] = 1;
					$errors_list[] = $attach['errors']['no_upload'];
				}
				
				if($total_attachments < $attach['minimum_files']) {
					$afb_error['attachments'] = 2;
					$errors_list[] = $attach['errors']['minimum_files'];
				}
			}
    }
    
    //echo $afp->ShowErrors($afp_conf['notifications']['correct_errors_e'], $errors_list);
    
    if( isset($errors_list) && !empty($errors_list) ) {
        $afb_error['status']['output'] = $afp->ShowErrors($afp_conf['notifications']['correct_errors_e'], $errors_list);
    }
    
    /* 
    --------------------------------
    No errors were found? Proceed!
    --------------------------------
    */        
        
    if(empty($afb_error)) {
        
        // Send the Post Data to a Remote URL?
        $remote_post = $afp_conf['remote_post']['enabled'];
        
        if($remote_post == 1) {
            $remote_url = $afp_conf['remote_post']['url'];
            $afp->SendPostData($original_post, $remote_url);
        }
        
        $mail_headers = $afp_conf['mail_headers'];        
        $mail_contents = $afp_conf['mail_contents'];

        // Get the message
        $final_message = $mail_contents['message'];
        
        // Get user's IP address
        $ip_address = $afp->GetRealIpAddress();
        
        // Get AutoResponder's Mail Subject and Message

        $ar_subject = $afp_conf['ar_subject'];
        $ar_message = $afp_conf['ar_message'];
        $ar_message = nl2br($ar_message);
        
        // Do the necessary replacements in the mail message for the POST fields
        // e.g. {sender_company} will be replaced with the actual value filled in the form for the field 'sender_company'
        $afb_replacements = $afp->SetMessageValuesFromPost($afb_form_fields);
        
        // Make {value} replacements in the mail subject and message
        $afb_replacements['{sender_ip_address}'] = $ip_address;
        $afb_replacements['{sender_hostname}'] = gethostbyaddr($ip_address);
        
        // Make the necessary replacements        
        $in = compact('sender_subject', 'ar_subject', 'final_message', 'ar_message');
        extract( str_replace(array_keys($afb_replacements), array_values($afb_replacements), $in) );

        // Is the body message containing {ALL_FIELDS}? Then replace it with the submitted form input values

        if(strpos($final_message, '{ALL_FIELDS}') !== false) {

            $ALL_FIELDS = "<table>";

            foreach($_POST as $afb_p_key => $afb_p_value) {
	            $afb_p_key = str_replace('[]','', $afb_p_key);

	            if(isSet($afb_form_fields[$afb_p_key]['text'])) {
                    $ALL_FIELDS .= '<tr><td valign="top"><strong>'.$afb_form_fields[$afb_p_key]['text'].":</strong>&nbsp;&nbsp;</td><td>".nl2br($afb_replacements['{'.$afb_p_key.'}'])."</td></tr>";
                }
            }

            $ALL_FIELDS .= "</table>";

            $final_message = str_replace('{ALL_FIELDS}', $ALL_FIELDS, $final_message);
        }
                
        $sender_subject = ($_POST['f'.$mail_contents['subject']] != '') ? $_POST['f'.$mail_contents['subject']] : $mail_contents['custom_subject'];

        //echo '<pre>'; print_r($mail_contents); echo '</pre>';

        $sender_name  = ($_POST['f'.$mail_headers['sender_name']] != '')  ? $_POST['f'.$mail_headers['sender_name']] : $mail_headers['custom_sender_name'];
        $sender_email  = ($_POST['f'.$mail_headers['sender_email']] != '')  ? $_POST['f'.$mail_headers['sender_email']] : $mail_headers['custom_sender_email'];
                                                        
        // defaults to using php "mail()"
        $afb_mail = new PHPMailer(); 

        // Initial value is null
        $sendMailError = '';
                
        if($afp_conf['deliverability']['send_message'] == 1) { // Should the message be sent?
                
            if( ! empty($afp_conf['webmasters']) ) {
                
                // Go through the list of the webmasters and send the mail to each one
                foreach($afp_conf['webmasters'] as $afp_conf_webmaster) {
        
                    if($afp_conf['smtp']['enabled'] == 1) {
        
                        $afb_mail->IsSMTP();                                      // telling the class to use SMTP
        
                        if($afp_conf['smtp']['auth']) {
                            $afb_mail->SMTPAuth   = true;                             // enable SMTP authentication
                        }
        
                        $afb_mail->SMTPSecure = $afp_conf['smtp']['secure'];                 // sets the prefix to the server
        
                        $afb_mail->Host       = $afp_conf['smtp']['host'];        // sets the SMTP server
                        $afb_mail->Port       = $afp_conf['smtp']['port'];        // set the SMTP port for the GMAIL server
                        $afb_mail->Username   = $afp_conf['smtp']['username'];    // SMTP account username
                        $afb_mail->Password   = $app->decrypt(AFP_SECURITY_KEY, $afp_conf['smtp']['password']); // SMTP account password
        
                    }
        
                    /*
                    ---------------------------------
                    Handle File Attachments (if any)
                    ---------------------------------
                    */
        
                    if($afp_conf['attachments']['enabled'] == 1) {
        
                        if( ! empty($attachments)) {
                            
                            // There are 2 cases: either the files are sent as attachments or the urls to the files are inserted in the mail body message
            
                            if($afp_conf['attachments']['files_on_mail'] == 1) {
            
                                foreach($attachments as $value) {
                                    
                                    $afb_mail->AddAttachment($afp_conf['local']['path_to_uploader_uploads']. $subfolder . '/' . $temp_dir_name.'/'.$value); 
                                }
              
                            } else if($afp_conf['attachments']['link_to_files'] == 1) {
                                
        						$add_attach_to_mail_body = ''; 
        						$add_attach_to_mail_body_text = '';
                               
                                $attachments_mail_body = $afp_conf['attachments']['mail_text'];
                               
                                // Add the attachments list to the body mail message (for both HTML and plain text messages)
                                 
                                $url_to_attachments = $afp->AddAttachmentsURLToMailMessage($attachments_mail_body, $attachments, $subfolder . '/' . $temp_dir_name);
                                        
                                $add_attach_to_mail_body      .= $url_to_attachments[0];
                                $add_attach_to_mail_body_text .= $url_to_attachments[1];
                            }
                        } 
                    }
                    
                    $final_message = str_replace('&lt;br /&gt;rn', '<br />', $final_message);
                    
                    $new_final_message = $final_message . $add_attach_to_mail_body;
        
                    $webmaster_name  = $afp_conf_webmaster['name'];
                    $webmaster_email = $afp_conf_webmaster['email'];
        
                    if($sender_email && $sender_name) {
                        $afb_mail->From     = $sender_email;
                        $afb_mail->FromName = $sender_name;
                    }
                    
                    $afb_mail->Subject  = $sender_subject;
                    
                    $afb_mail->MsgHTML($new_final_message);
        
                    $afb_mail->AltBody  = strip_tags(preg_replace('#<br\s*/?>#i', "\n", $new_final_message));
        
                    $afb_mail->CharSet  = $mail_headers['charset'];
        
                    $afb_mail->AddAddress($webmaster_email, $webmaster_name);
        
                    if(!$afb_mail->Send()) {
                        $sendMailError = 1;
                    }
        
                    $afb_mail->ClearAddresses();
        			$afb_mail->ClearAttachments();
                }
            
           }
        }

        /* --- Send the mail (and autoresponder) if no (mail send) errors were found --- */

        if($sendMailError == '') {
            
            if($afp_conf['deliverability']['save_message'] == 1) { // Should the message be saved in the database?
                
                // Add attachments links as well to the database message
                if( ! empty($attachments) ) {
                    foreach($attachments as $value) {
    					$attachments_zone = ''; 
                        $attachments_mail_body = $afp_conf['attachments']['mail_text'];
                       
                        // Add the attachments list to the body mail message
                        $url_to_attachments = $afp->AddAttachmentsURLToMailMessage($attachments_mail_body, $attachments, $subfolder . '/' . $temp_dir_name);
                        
                        $attachments_zone .= $url_to_attachments[0];                        
                    }
                }
                
                // Insert the form data into the database
                $form_data = array(
                    'form_id'    => $form_id,
                    'from_whom'  => $sender_email,
                    'subject'    => $sender_subject,
                    'message'    => $final_message.$attachments_zone,
                    'ip'         => $afp->GetRealIpAddress(),
                    'date_added' => time()
                );
                
                $db->query($db->prepareInsert($afp_conf['db']['prefix'].'data', $form_data));
                
                $message_id = $db->insertId();
                
                foreach($_POST as $afb_p_key => $afb_p_value) {
                    $afb_p_key = str_replace('[]','', $afb_p_key);
                    
                    $field_id = $afb_form_fields[$afb_p_key]['field_id'];
                    $field_value = $afb_replacements['{'.$afb_p_key.'}'];
                    
                    if(!$field_id) {
                        continue;
                    }
                    
                    $field_data = array(
                        'form_id'    => $form_id,
                        'message_id' => $message_id,
                        'field_id'   => $field_id,
                        'value'      => $field_value
                    );
                    
                    $db->query($db->prepareInsert($afp_conf['db']['prefix'].'data_fields', $field_data));
                }
            }
            
            $afb_error['status'] = 0; // Mail sent
            $afb_error['status_output'] = $afp->ShowSuccess($afp_conf['notifications']['message_sent_s']);
            
            // Send a copy of the mail to the sender?

            $escts_to_email = $_POST['f'.$afp_conf['escts']['to_email']];
            $escts_to_name = $_POST['f'.$afp_conf['escts']['to_name']];
            
            if(($escts == 1 && $afp_conf['escts']['text']) && $validate->ValidateEmail($escts_to_email)) { 

                if($sender_email) {
      
    	            $afb_mail->ClearAddresses();

	                $afb_mail->From     = $sender_email;
                    $afb_mail->FromName = $sender_name;

                    $afb_mail->AddAddress($escts_to_email, $escts_to_name);

                    $afb_mail->Subject  = $sender_subject;
                    
                    $afb_mail->MsgHTML($final_message);
                    
                    $afb_mail->AltBody  = strip_tags(preg_replace('#<br\s*/?>#i', "\n", $final_message));
                    
                    $afb_mail->CharSet  = $afp_conf['mail_charset'];

                    $afb_mail->Send();
                }
            }
            
            // Is the Auto Responder enabled? Use it!
            
            $auto_res_to_email = $_POST['f'.$afp_conf['auto_responder']['to_email']];
            $auto_res_to_name = $_POST['f'.$afp_conf['auto_responder']['to_name']];

            if( ($afp_conf['auto_responder']['enabled'] == 1) && ($validate->ValidateEmail($auto_res_to_email)) && ($auto_res_to_email != '') && ($afp_conf['auto_responder']['from_email'] != '') && ($afp_conf['auto_responder']['from_name'] != '') ) { 

                $ar_subject = $afp_conf['auto_responder']['subject'];
                $ar_message = $afp_conf['auto_responder']['message'];

	            $afb_mail->ClearAddresses();
                $afb_mail->ClearAttachments();

                $afb_mail->From     = $afp_conf['auto_responder']['from_email'];
                $afb_mail->FromName = $afp_conf['auto_responder']['from_name'];

                $afb_mail->AddAddress($auto_res_to_email, $auto_res_to_name);

                $afb_mail->Subject  = $ar_subject;
                
                $afb_mail->MsgHTML($ar_message);
                
                $afb_mail->AltBody  = strip_tags(preg_replace('#<br\s*/?>#i', "\n", $ar_message));
        
                $afb_mail->CharSet  = $afp_conf['mail_charset'];

                $afb_mail->Send();
            }
            
            // Remove the attachment files from the server after mail is sent?

            if($afp_conf['del_attach_after_submit'] && !$afp_conf['attachments']['link_to_files']) {
                $afp->RemoveDir($path_to_temp_dir_upload);
            }

        } else {
            $afb_error['status'] = 2; // Mail cannot be sent (internal error)
            $afb_error['status_output'] = $afp->ShowErrors($afp_conf['notifications']['mail_cannot_be_sent_e']);
        }

    } else {
        
        //echo '<pre>'; print_r($errors_list); echo '</pre>';
                
        $afb_error['status'] = 1; // Errors found
        $afb_error['status_output'] = $afp->ShowErrors($afp_conf['notifications']['correct_errors_e'], $errors_list);
    }
        
    /*
    ----------------------------------------------------------------------------------------
    Output JSON data for AJAX calls and set the $form_status variable for non-AJAX calls
    ----------------------------------------------------------------------------------------
    */    

    // Is (AJAX) JavaScript Enabled? (note that around 3% of the users have JS disabled)

    if($isAjaxUsed) {
          
        echo $afp->DoJsonEncode($afb_error); // output the result that will be processed by afp.init.php (via AJAX call)

    } else { // Action if JavaScript is disabled
      
      // If errors were found and the user has JS disabled, the security code is re-generated
      if( ! empty($errors_list) ) {
          $errors_list[] = $afp_conf['notifications']['security_code_e_re'];
      }

      if(empty($errors_list)) { // No errors?

          if($afb_error['status'] == 0) { // Mail sent

              $afb_success_submit = 1;

              $form_status = $afp->ShowSuccess($afp_conf['notifications']['message_sent_s']);

          } elseif($afb_error['status'] == 2) { // Mail not sent due to internal error (usually happens when the script is tested on localhost)
              
              $form_status = $afp->ShowErrors($afp_conf['notifications']['mail_cannot_be_sent_e']); // Mail cannot be sent (internal error)
          }   
   
      } else { // Show errors
	      $form_status = $afb_error['status_output']; // Errors found
      }
      
    }
}
?>