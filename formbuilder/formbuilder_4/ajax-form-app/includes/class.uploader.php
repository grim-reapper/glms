<?php
/**
 * Uploader
 * 
 * @package AJAX Form Pro
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
 
class Uploader {

	public $params;
    
    /**
     * Uploader::HandleUploads()
     * 
     * @param mixed $to_dir
     * @param mixed $params
     * @return
     */
    function HandleUploads($final_folder_path, $params) {
        
		$this->params = $params;

        if( ! empty($_FILES)) {
            
            $form_id = $params['form_id'];
            
            $subfolder = $params['subfolder'];
            $temp_dir_name = $params['temp_dir_name'];
            
            $maximum_files = $params['maximum_files'];

            $allowed_extensions = $params['allowed_extensions'];
            
			$maximum_size = $params['maximum_size'];
            
            $uploaded = array();
                        
            # echo '<pre>'; print_r($_FILES); echo '</pre>';
            
            // Check if the upload limit was already reached
            
            if(count($_SESSION['files_uploaded'][$temp_dir_name]) >= $maximum_files) {
                
                $uploaded['error']['limit_reached'][] = $_FILES['file_'.$form_id]['name'][0];
                $file_error = 1;  
                          
            } else {
                         
                $total_upload_fields = count($_FILES['file_'.$form_id]['name']);
                
                $j = 0;
                
                // [Total allowed uploads] minus [Current uploads] 
                $upload_limit = $this->GetUploadLimit($maximum_files, $temp_dir_name);
                
                for ($field_key = 0; $field_key < $total_upload_fields; $field_key++) {
                    
                    $file_name = $_FILES['file_'.$form_id]['name'][$field_key];
                    $new_file_name = $this->FilterFilename($file_name); // New Clean File Name
                    
                    $file_size = $_FILES['file_'.$form_id]['size'][$field_key];
                    $file_tmp_name = $_FILES['file_'.$form_id]['tmp_name'][$field_key];
                    
                    if($file_name != '') {
                        
                        // Set the uploads limit
                        $j++;
                        
                        if($j > $upload_limit) {
                            break;    
                        }                        
                        
                        $file_error = 0;
                        
                        // Check Extension
                        if( ! $this->HasAllowedExtension($file_name, $allowed_extensions)) {
                            $uploaded['error']['wrong_ext'][$field_key] = $file_name;
                            $file_error = 1;
                        }
                        
                        // Check Size
                        if( ! $this->CheckFileSize($file_size, $maximum_size) ) {
                            $uploaded['error']['maximum_size'][$field_key] = $file_name;
                            $file_error = 1;
                        }
                        
                        // Check File Type
                        $check_file_type = $this->checkFileType($file_tmp_name, $file_name);
                                                    
                        if( $check_file_type['success'] == 0 ) {
                            $uploaded['error'][$check_file_type['error']][$field_key] = $file_name;
                            $file_error = 1;                            
                        }
                        
                        // Check if a file with the same (clean) name already exists
                        
                        if(file_exists($final_folder_path . '/' . $new_file_name)) {
                            $uploaded['error']['dupe'][$field_key] = $new_file_name;
                            $file_error = 1;
                        }
                                            
                        // No errors? Move the uploaded file from the 'temp' directory to the folder it belongs
                        if($file_error == 0) {                        
                            if(move_uploaded_file($file_tmp_name, $final_folder_path .'/'. $new_file_name)) {
                                $uploaded['ok'][$field_key]['name'] = $new_file_name;
                                
                                $_SESSION['files_uploaded'][$temp_dir_name][] = $new_file_name;
                            }
                        }       
                    }
                }
            }
            
            if( ! empty($uploaded)) {
                return $uploaded;      
            }
        }
        return false;   
    }
    
    /**
     * Uploader::GetUploadLimit()
     * 
     * @param mixed $maximum_files
     * @param mixed $temp_dir_name
     * @return
     */
    function GetUploadLimit($maximum_files, $temp_dir_name) {
        // [Total allowed uploads] minus [Current uploads] 
        return ( $maximum_files - count($_SESSION['files_uploaded'][$temp_dir_name]) );
    } 
       
    /**
     * Uploader::HasAllowedExtension()
     * 
     * @param mixed $file
     * @param mixed $allowed_file_exts
     * @return
     */
    function HasAllowedExtension($file, $allowed_file_exts) {

        $file_ext = $this->getFileExtension($file);
         
        foreach($allowed_file_exts as $ext) {
            if(preg_match('/'.$file_ext.'/i', $ext)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Uploader::getFileExtension()
     * 
     * @param mixed $file
     * @return
     */
    function getFileExtension($file) {
        $file_ext = strrchr($file, '.');
        $file_ext = strtolower(str_replace('.', '', $file_ext));
        
        return $file_ext;      
    }
    
    /**
     * Uploader::CheckFileSize()
     * 
     * @param mixed $size
     * @param mixed $max_allowed_size
     * @return
     */
    function CheckFileSize($size, $max_allowed_size) {
        $file_mb_size = number_format( ( ($size / 1024) / 1024 ), 2);
        
        //echo $file_mb_size.'<br>';
        
        if($file_mb_size > $max_allowed_size) {
            return false;
        }
        return true;
    }

    /**
     * Uploader::checkFileType()
     * 
     * @param mixed $file_path
     * @return
     */
    function checkFileType($file_path, $file_name) {
        
        $file_ext = $this->getFileExtension($file_name); 
        
        $check_image_extensions = explode(',', $this->params['check_image_extensions']);
        
		//echo '<pre>'; print_r($this->params); echo '</pre>';

        foreach($check_image_extensions as $ext) {
			
			$ext = trim($ext);

			if($ext != '') {
				$ext = strtolower($ext);

				if($ext == $file_ext) {
					$size = getimagesize($file_path);
					
					if(!$size) {
						return array('success' => 0, 'error' => 'image_not_valid');
					}
				}

			}
        }
        
        return array('success' => 1);
    }
    
    /**
     * Uploader::FilterFilename()
     * 
     * @param mixed $item
     * @return
     */
    function FilterFilename($item) {
                
        $to_strip = array(
            '&', 
            '^', 
            '.php'
        );
        $item = str_replace(array_values($to_strip), '', $item);
        
        $to_strip_regex = array(
            '/\s{1,}/' => '-',
            '/[^a-zA-Z0-9.\-_]+/i' => ''
        );
        $item = preg_replace(array_keys($to_strip_regex), array_values($to_strip_regex), $item);
        
        return $item;
    }
}
?>