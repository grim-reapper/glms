<?php
$afp_conf['msg']['success'] = array(
    'form_added' => 'The new form was created successfully.',
    'form_edited' => 'The form was edited successfully.',
    
    'form_config_edited' => 'The form configuration was edited successfully.',
    
    'form_default_config_edited' => 'The default (form) configuration was edited successfully.',
    
    'form_field_added' => 'The new form field was created.',
    
    'form_field_no_name_add_error' => 'The field title is required.',
    
    'fields_updated' => 'The fields\' title and required status were updated.',

    'field_updated' => 'The field was updated.',

    'merged_fields_area_updated' => 'The content has been updated for the before/after area of these merged fields.',

    'message_edited' => 'The message was edited successfully.',
    
    'submitted_fields_values_edited' => 'The values of the submitted fields where edited.',
    
    // Add Validation
    'validation_added' => 'The validation was added.',
    
    // Add Attribute
    'attribute_added' => 'The attribute was added.',

    // Add Option Attribute
    'option_attribute_added' => 'The option attribute was added.',

    // Add Option
    'option_added' => 'The option was added.',
    
    // Add/Edit Webmaster
    'webmaster_added' => 'The webmaster\'s information was added.',
    'webmaster_info_edited' => 'The recipient\'s information was updated.',
    
    'template_added' => 'The <strong>custom</strong> form template was created and it\'s ready to be edited.',

    // E-Mail
    'email_changed' => 'The email address was updated.',
    
    'pass_changed' => 'The password has been updated.', 
   
    // ------- LOGIN AREA -------
    'mail_reset_pass_sent' => htmlspecialchars('Please check your mail to complete the <Reset Password> request.'),
    'new_pass_mail_sent' => 'The new password has been sent to your email address.',
    'email_changed' => 'The email address was updated.',
    
    'security_key_file_updated' => 'The security key has been updated.',
    
    'delete_uploaded_files_done' => 'The past uploaded files were successfully deleted.'
);

$afp_conf['msg']['error'] = array(
    'form_not_added' => 'The "name" field is required. Please add a reference [form] name before continuing.',
    
    'form_name_dupe' => 'This name already exists in the database.',
    
    // No form is selected
    'no_form_selected' => 'Select at least 1 form then press "Continue".',
    
    'fields_not_updated' => 'The fields\' title and required status could not be updated. Please try again later!',
    'field_not_updated' => 'The field could not be updated. Please try again later!',

    // Add Validation
    'validation_value_not_numeric' => 'Please type a numeric value.',
    'validation_no_value' => 'Please type a value.',
    'validation_no_min_selection_value' => 'Please type a value for minimum selections.',
    
    'validation_message_not_added' => 'Please enter an error message that should appear if the field is not validated.',
    
    'attribute_in_ban_list' => 'The attribute you\'ve entered is not allowed as it is already set by the script (e.g. type, input, value, id). Check the "How it works?" link on this page for more information.',
    
    // Add Template
    'template_name_required' => 'Please type a template name.',
    'template_name_exists' => 'The template name already exists in the database. Please choose a different one.',
    
    'both_webmaster_fields_required' => 'Both the name and the email are required.',
    'webmaster_email_dupe' => 'The email is already assigned to another webmaster',
    
    // E-Mail
    'emails_do_not_match' => 'Both the `new` and the `confirm` fields should match the same values.',
    'email_not_valid' => 'The new e-mail does not seem to be a valid one. Please re-type it!',
    'email_is_empty' => 'Both fields are required.',
    'email_dupe_in_db' => 'The email address you\'ve entered is already assigned to other user.',
        
    // ------- LOGIN AREA -------
    
    // Password change (all fields required) 
    'all_fields_must_fill' => 'You must complete all fields.',
    'initial_wrong'        => 'The current password is not correct. Please retry or reset it!',
    'confirm_not_match'    => 'The new passwords do not match.',
        
    'email_not_in_db' => 'The email you entered does not match the one from our records.',
    'mail_reset_pass_not_sent' => 'The reset password mail could not be sent due to an internal error.',
    'new_pass_mail_not_sent' => 'The new password could not be sent due to an internal error. Your password was not changed.',
    'reset_url_incorrect' => htmlspecialchars('The <Reset Password> URL seems to be incorrect. Please use the same URL you got in your mail.'),
    
    'too_many_ip_requests' => 'A similar request was made in the past hour. Please check your mail.',
	'reset_pass_link_used' => 'This URL has already been used in the past hour. Please check your mail.',
    
	'access_denied' => 'Access Denied',
    
    'security_key_wrong_length' => 'The security key must have the length between 10 and 20 characters.',
    'config_file_not_writable' => 'In order to be editable, <strong>{PATH_TO_CONFIG_FILE}</strong> must be writable. Please change its permissions before trying to edit it.',

    'security_key_file_not_updated' => 'The security key has not been updated due to an internal error.'
);
?>