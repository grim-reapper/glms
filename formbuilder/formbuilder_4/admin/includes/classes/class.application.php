<?php
/**
 * Application
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Application {

    public function __construct($conf = array(), $db = array()) {
        $this->conf = $conf;
        $this->db = $db;
    }
    
    /**
     * Application::redirect()
     * 
     * @param mixed $to
     * @return void
     */
    public function redirect($to) {
        header('Location: '.$to);
        exit;
    }
	/**
	 * PrepareValues()
	 * 
	 * @param mixed $data
	 * @return
	 */
	public function PrepareValues($data) {
    	if (is_array($data)) {
    	    $data = array_map(array('Application', 'PrepareValues'), $data); 
    	} else {
            // remove whitespaces (not a must though)
            $data = trim($data); 
                        
            // apply stripslashes if magic_quotes_gpc is enabled
            if(get_magic_quotes_gpc()) {
                $data = stripslashes($data);
            }
                      
            // a mySQL connection is required before using this function
            $data = mysql_real_escape_string($data);
    	}
        
        return $data;
	}   
    
    /**
     * Application::DoJsonEncode()
     * 
     * @param bool $a
     * @return
     */
    function DoJsonEncode($a=false)
    {
        if(!$a) return false;
        
        if(function_exists('json_encode')) {
            return json_encode($a);
        } else {
            include $this->conf['url']['path_to_script'].'includes/class.services.json.php';
            
            // create a new instance of Services_JSON
            $json = new Services_JSON();
            return $json->encode($a, 0);
        }
    }       

    /**
     * Application::DoJsonDecode()
     * 
     * @param bool $a
     * @return
     */
    function DoJsonDecode($a=false)
    {
        if(!$a) return false;
        
        if(function_exists('json_decode')) {
            return json_decode($a);
        } else {
            include $this->conf['url']['path_to_script'].'includes/class.services.json.php';
            
            // create a new instance of Services_JSON
            $json = new Services_JSON();
            return $json->decode($a, 0);
        }
    }
    
    /**
     * Application::encrypt()
     * 
     * @param mixed $key
     * @param mixed $string
     * @return
     */
    function encrypt($key, $string) {
        if(function_exists('mcrypt_encrypt') && function_exists('mcrypt_decrypt')) {
            $return = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        } else {
            include 'class.encryption.php';        
            $crypt = new encryption_class;
            $return = $crypt->encrypt($key, $string, 30);
        }
        return $return;
    }        

    /**
     * Application::decrypt()
     * 
     * @param mixed $key
     * @param mixed $encrypted
     * @return
     */
    function decrypt($key, $encrypted) {
        if(function_exists('mcrypt_encrypt') && function_exists('mcrypt_decrypt')) {
            $return = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        } else {
            include 'class.encryption.php';
            $crypt = new encryption_class;
            $return = $crypt->decrypt($key, $encrypted);
        }
        return $return;
    }            

    /**
     * Application::checkField()
     * 
     * @param mixed $field_id
     * @return void
     */
    public function checkField($field_id) {
        if(!$field_id) {     
            exit('No field id was requested!');
        } else {
            // Check if the field exist
            if( ! $this->db->getCount("SELECT id FROM `".$this->conf['db']['prefix']."fields` WHERE id='".$field_id."'")) {
                exit('The Requested Field ID does not exist in the records. Click <a href="manage_forms.php">here</a> to go to the forms list.');
            }
        }        
    }

    /**
     * Application::checkMergedFieldsRowID()
     * 
     * @param mixed $row_id
     * @return void
     */
    public function checkMergedFieldsRowID($row_id) {
        if( ! $row_id ) {     
            exit('No Row ID was requested!');
        } else {
            // Check if the field exist
            if( ! $this->db->getCount("SELECT id FROM `".$this->conf['db']['prefix']."rows` WHERE id='".$row_id."'")) {
                exit('The Requested Row ID does not exist in the records. Click <a href="manage_forms.php">here</a> to go to the forms list.');
            }
        }        
    }
    
    /**
     * Application::deleteFromUploads()
     * 
     * @param mixed $dir
     * @return void
     */
    public function deleteFromUploads($dir, $delete_before_date, $main_folder = 1) {
                
    	$list = @scandir($dir);
    
    	if( ! empty($list) ) { // Are there any files/folders in the directory?
    
            //echo date ("F d Y H:i:s.", $delete_before_date).'<br />';
    
            //echo '<pre>'; print_r($list); echo '</pre>';
    
    		foreach($list as $location) {
    		  
   			    if ($location != '.' && $location != '..') {
    
    				if(is_dir($dir.$location)) // Is the location a directory?
    				{
    				    
    					if(!@rmdir($dir.$location)) // Empty directory? Remove it
    					{
    						$this->deleteFromUploads($dir.$location.'/', $delete_before_date, 0); // Not empty? Delete the files inside it
    					}
                        
    				} else {
    				    
                        //echo $dir.$location.'<br />';
    				    
    			       // Only delete files within folders located in the directories created by the "Upload Attachment" feature
                       if($main_folder == 0) { 
                        
                           // File Modified Time > Delete Before Date
                           $file_modification_time = @filemtime($dir.$location);
                           //echo date ("F d Y H:i:s.", $file_modification_time).'<br />';
                           
                           if($file_modification_time) { 
                               $proceed = ($delete_before_date > $file_modification_time) ? true : false;
                                        
                               if($proceed) {         
    			                   @unlink($dir.$location); // Delete the file
        			           }
                           }
                       }
                       
                    }
    			}
    		}
    	}
        
        // Remove empty sub-folders, but do not remove the 'uploads' folder.
        if($main_folder == 0) {
            @rmdir($dir);
        }
    }
}
?>