<?php
/**
 * Manage_Templates
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Manage_Templates extends Application {
       
    public function __construct($conf, $db) {
        $this->conf = $conf;
        $this->db = $db;
    }
    
    /**
     * Manage_Templates::add()
     * 
     * @return
     */
    public function add() {
        
        $success = true;
        
        $template_name = $_POST['template_name'];
        $template_base = $_POST['template_base'];
        
        // -- It's verification time! --
        
        // Check if a name was typed
        if( ! $template_name ) {
            $success = false;
            $message = $this->conf['msg']['error']['template_name_required'];
        }
        
        // Check if the name already exists in the database
        $f = $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."layouts` WHERE name='".$template_name."'");
        
        if($f) {
            $success = false;
            $message = $this->conf['msg']['error']['template_name_exists'];
        }
    
        // No errors? Add the template into the database
        if( $success ) {
        
            $filename = $this->createFilenameFromInput($template_name);
                    
            $data = array(
                'name'          => $template_name,
                'file_template' => $filename['file_template'],
                'file_css'      => $filename['file_css'],
                'custom'        => 1
            );
        
            $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'layouts', $data));
        
            $layout_id = $this->db->insertId();
        
            // Create template files (TPL and CSS)
            $params = $filename;
            $params['template_base_id'] = $template_base;
            
            $create_filenames = $this->createFilenames($params);
            
            $message = $this->conf['msg']['success']['template_added'];
        }
                
        return array('success'   => $success,
                     'message'   => $message,
                     'layout_id' => $layout_id);
                
    }

    /**
     * Manage_Templates::delete()
     * 
     * @param mixed $layout_id
     * @return
     */
    public function delete($layout_id) {

        list($custom_file_template, $custom_file_css) = $this->db->getRow("SELECT file_template, file_css FROM `".$this->conf['db']['prefix']."layouts` WHERE id='".$layout_id."' && custom='1'");        
        
        $this->db->delete(
            $this->conf['db']['prefix'].'layouts', array('id' => $layout_id, 'custom' => 1)
        );
        
        $this->db->query("UPDATE ".$this->conf['db']['prefix']."config_values SET value='2' WHERE value='".$layout_id."' && field_id='73'");
        
        // Delete Custom Template's Files (tpl & css)        
        $path_to_form_layouts = $this->conf['templates']['form_layouts'];
        @unlink($path_to_form_layouts . 'custom/' . $custom_file_template);
        
        $path_to_form_css = $this->conf['local']['path_to_style'];        
        @unlink($path_to_form_css . 'custom/' . $custom_file_css);
        
        return true;
        
    }
    
    /**
     * Manage_Templates::createFilenameFromInput()
     * 
     * @param mixed $string
     * @return
     */
    public function createFilenameFromInput($string) {
        
        $new_string = preg_replace('/[^A-Za-z0-9]/', '', $string);
        
        $filename = $new_string.'.'.uniqid();
                
        return array(
            'file_template' => $filename.'.tpl',
            'file_css'      => $filename.'.css.php'
        );
    }
    
    /**
     * Manage_Templates::createFilanames()
     * 
     * @param mixed $list
     * @return void
     */
    private function createFilenames($list) {
        
        // Get Base Template File name(s) for TPL & CSS
        list($base_file_template, $base_file_css) = $this->db->getRow("SELECT file_template, file_css FROM `".$this->conf['db']['prefix']."layouts` WHERE id='".$list['template_base_id']."'");
        
        $path_to_form_layouts = $this->conf['templates']['form_layouts'];
        $path_to_form_css = $this->conf['local']['path_to_style'];
        
        //echo $path_to_form_layouts;

		$original_tpl = $path_to_form_layouts . $base_file_template;
		$new_tpl      = $path_to_form_layouts . 'custom/' . $list['file_template'];
        
        // Copy the TPL
        copy( $original_tpl, $new_tpl );
		
		$original_css = $path_to_form_css . $base_file_css;
		$new_css      = $path_to_form_css . 'custom/' . $list['file_css'];			  

        // Copy the CSS
        copy( $original_css, $new_css );

		// Update the relative path to the 'images' folder in the Custom CSS File
		$new_contents = file_get_contents($new_css);
		$new_contents = str_replace('../images/', '../../images/', $new_contents);
		file_put_contents($new_css, $new_contents);									

    }
    
    /**
     * Manage_Templates::update()
     * 
     * @return void
     */
    public function update() {
        
        $message['error'] = array();
        $message['done'] = array();
        
        $layout_id = (int)$_POST['layout_id'];
        $template_name = $_POST['template_name'];
        $custom = $_POST['custom'];
        
        if($custom == 1) {
            // --------- UPDATE NAME ---------
            $check_template_name = $this->db->getOne("SELECT name FROM `".$this->conf['db']['prefix']."layouts` WHERE name='".$template_name."' && id != '".$layout_id."'");
            
            if($check_template_name) {
                $message['error'][] = 'The name `<strong>'.$check_template_name.'</strong>` is already assigned to another template. Please choose another name.';
            } else {
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."layouts` SET name='".$template_name."' WHERE id='".$layout_id."'");
                $message['done'][] = 'The template\'s name has been updated.';
            }
        }
        
        list($file_template, $file_css) = 
        $this->db->getRow("SELECT file_template, file_css FROM `".$this->conf['db']['prefix']."layouts` WHERE id='".$layout_id."'");

        $custom_path = ($custom == 1) ? 'custom/' : '';
        
        // --------- EDIT TEMPLATE ---------
        $file_template_contents = $_POST['file_template_contents'];
		
		$to_replace = array('\"' => '"', "\'" => "'");
		$file_template_contents = str_replace(array_keys($to_replace), array_values($to_replace), $file_template_contents);

        if(ENABLE_PHP_INSIDE_SMARTY != 1) {
            $file_template_contents = preg_replace('/{php}(.*?){\/php}/is', "", $file_template_contents);
        }
        
        if($file_template_contents) {
            $path_to_form_layouts = $this->conf['templates']['form_layouts'];
            $path_to_template = $path_to_form_layouts . $custom_path . $file_template;
            
            $do_tpl_update = @file_put_contents($path_to_template, $file_template_contents);
                                                                
    		if( ! $do_tpl_update ) {
    		    $message['error'][] = 'The file '.$path_to_template.' could not be updated. Check if it has the right writting permissions!';  
    		} else {
          		$message['done'][] = 'The template layout has been updated.';
    		}        
        }
        
        // --------- EDIT CSS ---------
        $file_css_contents = $_POST['file_css_contents'];
		$to_replace = array('\"' => '"', "\'" => "'");
		$file_css_contents = str_replace(array_keys($to_replace), array_values($to_replace), $file_css_contents);
		
        if($file_css_contents) {
            
            $beginning = '<?php'."\n".
            'header("Content-Type: text/css");'."\n\n".
            
            '$form_id = (isSet($_GET[\'form_id\'])) ? $_GET[\'form_id\'] : \'\';'."\n\n".
            
            'if($form_id == \'\') exit;'."\n".
            '?>'."\n";
            
            $path_to_form_css = $this->conf['local']['path_to_style'];
            $path_to_css = $path_to_form_css . $custom_path . $file_css;
            
            $css_replacements = array(
                '{id}' => '<?php echo $form_id; ?>'
            );
            
            
            $file_css_contents = $beginning . str_replace(array_keys($css_replacements), array_values($css_replacements), $file_css_contents);
            
            $do_css_update = @file_put_contents($path_to_css, $file_css_contents);
            
    		if( ! $do_css_update ) {
  		        $message['error'][] = 'The file '.$path_to_css.' could not be updated. Check if it has the right writting permissions!';
    		} else {
    		    $message['done'][] = 'The Layout\'s CSS File has been updated.';
    		}
        }
        return $message;
    }
}
?>