<?php
/**
 * Manage_Webmasters
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Manage_Webmasters extends Application {
       
    public function __construct($conf, $db) {
        $this->conf = $conf;
        $this->db = $db;
    }
    
    /**
     * Manage_Webmasters::add()
     * 
     * @return void
     */
    public function add() {
        
        $success = true;
        
        $webmaster_name = $_POST['name'];
        $webmaster_email = $_POST['email'];
        
        if( !$webmaster_name || !$webmaster_email ) {
            $success = 0;
            $message = $this->conf['msg']['error']['both_webmaster_fields_required'];
        }
        
        if( $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."webmasters` WHERE email='".$webmaster_email."'") ) {
            $success = 0;
            $message = $this->conf['msg']['error']['webmaster_email_dupe'];            
        }
        
        if($success) {
            
            $success = 1;
            $message = $this->conf['msg']['success']['webmaster_added'];
        
            $data = array(
                'name'   => $webmaster_name,
                'email'  => $webmaster_email,
            );
            
            $q = $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'webmasters', $data));
            
            $webmaster_id = $this->db->insertId();
        } else {
            $webmaster_id = false;
        }
        
        return array('success'      => $success,
                     'message'      => $message,
                     'webmaster_id' => $webmaster_id);
                
    }
	
    /**
     * Manage_Webmasters::update()
     * 
     * @return
     */
    public function update() {
                        
        // -------- Name & E-Mail --------
             
        if(isset($_POST['name']) && isset($_POST['email'])) {
                        
            $name = $_POST['name'];
            $email = $_POST['email'];
            
            $webmaster_id = (int)$_POST['webmaster_id'];
            
            // check if the name already exists in the database
            $q = $this->db->query("SELECT id FROM `".$this->conf['db']['prefix']."webmasters` WHERE email='".$email."' && id != '".$webmaster_id."'");
            
            if($this->db->getNumRows($q) > 0) {
        
                $output = array('success' => false, 'message' => $this->conf['msg']['error']['webmaster_email_dupe']);
                
            } else {
                
                $q = $this->db->prepareUpdate($this->conf['db']['prefix'].'webmasters', array('name' => $name, 'email' => $email), "WHERE id='".$webmaster_id."'");
                                
                $update = $this->db->query($q);
                
                if($update) {
                    $output = array('success' => 1, 'message' => $this->conf['msg']['success']['webmaster_info_edited']);
                }
            }
            
            return $output;
        }     
    }


    /**
     * Manage_Webmasters::delete()
     * 
     * @param mixed $form_id
     * @return
     */
    public function delete($webmaster_id) {
    
        $query = $this->db->delete($this->conf['db']['prefix'].'webmasters', array('id' => $webmaster_id));
        
        // Remove the webmaster info from the default configs and the forms' configs (if any)
        
        # For the Default Configs
        $default_webmasters_list = $this->db->getOne("SELECT default_value FROM `".$this->conf['db']['prefix']."config_names` WHERE id='41'");
        
        if($default_webmasters_list != '' && $default_webmasters_list != '[]') {
            
            $d_list = $this->DoJsonDecode($default_webmasters_list);
            
            foreach($d_list as $key => $w_id) {
            
                if($w_id == $webmaster_id) {
                    unset($d_list[$key]);
                }
            }
            
            $this->db->getOne("UPDATE `".$this->conf['db']['prefix']."config_names` SET default_value='".$this->DoJsonEncode($d_list)."' WHERE id='41'");
        }
        
        # For all the forms
        $all = $this->db->query("SELECT id, value FROM `".$this->conf['db']['prefix']."config_values`");
        
        foreach($all as $valori) {
            $id = $valori['id'];
            $form_webmasters_list = $valori['value'];

            if($form_webmasters_list != '' && $form_webmasters_list != '[]') {
                
                $f_list = $this->DoJsonDecode($form_webmasters_list);
                
                foreach($f_list as $key => $w_id) {
                
                    if($w_id == $webmaster_id) {
                        unset($f_list[$key]);
                    }
                }
                $this->db->getOne("UPDATE `".$this->conf['db']['prefix']."config_values` SET value='".$this->DoJsonEncode($f_list)."' WHERE id='".$id."'");
            }
        }
        
        return $query;    
    }
    
    /**
     * Manage_Webmasters::getList()
     * 
     * @return
     */
    public function getList() {
        $f = $this->db->getAll("SELECT id, name, email FROM `".$this->conf['db']['prefix']."webmasters`");
    
        $main = array();
    
        if( ! empty($f) ) {
            foreach($f as $r) {
                $main[$r['id']] = '&lt;'.$r['name'].'&gt; '.$r['email'];
            }
            
            return $main;
        }
    }
}
?>