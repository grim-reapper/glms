<?php
include '../common.php';
include '../headers.php';

$form_id = $_REQUEST['form_id'];
$subfolder = $_REQUEST['s'];
$temp_dir_name = $_REQUEST['c'];

if($form_id) { 
    
    $path_to_upload_dir  = $afp_conf['local']['path_to_uploader_uploads'] .  $subfolder . '/' . $temp_dir_name;
    
    //echo $path_to_upload_dir;
    
    if(is_dir($path_to_upload_dir)) {
        
        $AfbFormFields = array();
        
        $int_form_id = str_replace('afp', '', $form_id);
            
        $attachments = $afp->createFormConfig($int_form_id, 4);
        
        if(empty($attachments)) { exit; } // Exit the script if $attachments is empty
        
        //echo '<pre>'; print_r($attachments); echo '</pre>';
        
        $attachments = $attachments['attachments'];
        
        $allowed_extensions = explode(',', $attachments['allowed_extensions']);
                       
        $params = array('form_id'            => $form_id,
                        'subfolder'          => $subfolder,
                        'temp_dir_name'      => $temp_dir_name,
                        'allowed_extensions' => $allowed_extensions,
						'check_image_extensions' => $attachments['check_image_extensions'],
                        'maximum_size'       => $attachments['maximum_size'],
                        'maximum_files'      => $attachments['maximum_files']);
        
        include $afp_conf['local']['path_to_uploader_class'];
                
        $uploader = new Uploader;     
                                    
        if( ! empty($_FILES) ) {                                                
            $uploaded = $uploader->HandleUploads($path_to_upload_dir, $params);    
        }
    
        $notes = $attachments['notes'];
        
        foreach($params as $key => $value) {
            
            if($key == 'allowed_extensions') {
                $value = implode(', ', $value);    
            }            
            
            $notes = str_replace('['.$key.']', $value, $notes);
        }
    
        $smarty->assign('notes', $notes);
        
        // Are files uploaded?
        $SessionUploadDir = $_SESSION['files_uploaded'][$temp_dir_name];
    
        if(is_array($SessionUploadDir)) {
        
            $files_uploaded_to_dir = array();
            
            foreach($SessionUploadDir as $file_uploaded_key => $file_uploaded_name) {
                      
                $files_uploaded_to_dir[$file_uploaded_key] = array('file_name' => $file_uploaded_name,
                                                                   'row_class' => ( ($file_uploaded_key % 2) ? 'row_odd' : 'row_even' ));
            }
            
            $smarty->assign('files_uploaded_to_dir', $files_uploaded_to_dir);
        }
            
        // Are there any errors?
        if(is_array($uploaded['error'])) {
            
            $upload_errors = array();
            
            foreach($uploaded['error'] as $error_type => $value) {
                
                $err_file_name = array_values($value);
                
                $upload_errors[] = array('file_name' => $err_file_name[0],
                                         'error'     => $attachments['errors'][$error_type]);
            }
            
            # echo '<pre>'; print_r($upload_errors); echo '</pre>';
            
            $smarty->assign('upload_errors', $upload_errors);
        }
    
        if(is_array($uploaded['ok'])) {            
            $smarty->assign('uploaded_ok', true);
            $smarty->assign('upload_oks', $uploaded['ok']);
        }
    
        $smarty->assign('form_id', $form_id); // Form ID
        $smarty->assign('subfolder', $subfolder); // Subfolder from the "Uploads" directory
        $smarty->assign('temp_dir_name', $temp_dir_name); // Temporary Upload Directory
        
        $smarty->assign('upload_limit', $uploader->GetUploadLimit($attachments['maximum_files'], $temp_dir_name) );
                       
        $smarty->assign('c', $afp_conf); // Global and Form Configuration variables
        
        // Load the 'Iframe' Upload Template
        $smarty->display($afp_conf['templates']['iframe_attachments']);    
    }
}
?>