<?php
/**
 * Manage_Forms
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Manage_Forms extends Application {
       
    public function __construct($conf, $db) {
        $this->conf = $conf;
        $this->db = $db;
    }
    
    /**
     * Create_Form::add()
     * 
     * @return void
     */
    public function add() {
        
        $name = $_POST['name'];
        $description = $_POST['description'];
        
        if( ! $name ) {
            return array('success' => false,
                         'message' => $this->conf['msg']['error']['form_not_added']);
        }
        
        $date_added = time();
        
        $data = array(
            'name'         => $name,
            'description'  => $description,
            'date_added'   => $date_added,
            'active'       => 1
        );
        
        $q = $this->db->query(
            $this->db->prepareInsert($this->conf['db']['prefix'].'forms', $data)
        );
        
        $form_id = $this->db->insertId();
        
        $this->copyConfigValues('default', $form_id);
        
        $recipients = $this->db->getOne("SELECT value FROM `".$this->conf['db']['prefix'].'config_values'."` WHERE form_id='".$form_id."' && field_id='41'");
            
        if($recipients == '') {
            // Add the first recipient (if no recipients were added)
            $recipient_id = $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."webmasters` ORDER BY id ASC LIMIT 1");
            
            if($recipient_id > 0) {
                $this->db->query($this->db->prepareUpdate($this->conf['db']['prefix'].'config_values', array('value' => '["'.$recipient_id.'"]'), "WHERE form_id='".$form_id."' && field_id='41'"));    
            }
        }
                
        return array('success' => 1,
                     'message' => $this->conf['msg']['success']['form_added'],
                     'form_id' => $form_id);
                
    }

    /**
     * Manage_Forms::cloneData()
     * 
     * @param mixed $form_id
     * @return
     */
    public function cloneData($form_id) {
        
        // Get form & fields details
        $form_details = $this->db->getRow('SELECT name, description, active FROM `'.$this->conf['db']['prefix'].'forms` WHERE id='.$form_id);
        
        # New Form Basic Info
        $new_form_details = array();
        
        if(empty($form_details)) { 
            return false;
        } else {
            $new_form_id = $this->db->getOne('SELECT MAX(id) FROM `'.$this->conf['db']['prefix'].'forms`') + 1;
                        
            $new_form_details = array(
                'id'          => $new_form_id,
                'name'        => $form_details['name'].' ['.$new_form_id.']',
                'description' => $form_details['description'],
                'date_added'  => time(),
                'active'      => $form_details['active']
            );
        }
    
        # New Form Fields
        $form_fields = $this->db->getAll('SELECT id, text, mandatory, columns, type_id, position FROM `'.$this->conf['db']['prefix'].'fields` WHERE form_id='.$form_id);
        
        $new_form_fields = array();
        
        if( ! empty($form_fields) ) {
            
            $merged_fields = array();
        
            foreach($form_fields as $row) {
                
                $field_id = $row['id'];
                
                $row_id = $this->db->getOne('SELECT row_id FROM `'.$this->conf['db']['prefix'].'rows_fields` WHERE field_id='.$field_id);
                
                if($row_id) {
                    $merged_fields[$row_id][] = $field_id;
                }
                
                # ---- New Form Attributes ----
                $form_attributes = $this->db->getAll('SELECT name, value FROM `'.$this->conf['db']['prefix'].'fields_attributes` WHERE field_id='.$field_id);
                
                $new_form_attributes = array();
                
                if( ! empty($form_attributes) ) {
                    foreach($form_attributes as $row_a) {
                        $new_form_attributes[] = $row_a; }
                }
                
                $row['attributes'] = $new_form_attributes;
    
                # ---- New Form Options ----
                $form_options = $this->db->getAll('SELECT text, attributes, position FROM `'.$this->conf['db']['prefix'].'fields_options` WHERE field_id='.$field_id);
                
                $new_form_options = array();
                if( ! empty($form_options) ) {
                    foreach($form_options as $row_o) {
                        $new_form_options[] = $row_o;
                    }
                }
                $row['options'] = $new_form_options;
    
                # ---- New Form Validations ----
                $form_validations = $this->db->getAll('SELECT type, message, value FROM `'.$this->conf['db']['prefix'].'fields_validations` WHERE field_id='.$field_id);
                
                $new_form_validations = array();
                if( ! empty($form_validations) ) { 
                    foreach($form_validations as $row_v) { 
                        $new_form_validations[] = $row_v; 
                    } 
                }
                $row['validations'] = $new_form_validations;
                
                $new_form_fields[] = $row;
            }
        }
        
        //echo '<pre>'; print_r($merged_fields); echo '</pre>'; exit;
        
        
        
        // Start inserting the new form data into the database
        
        # Form Details
        $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'forms', $new_form_details));
                
        $new_form_fields_data = array();
        
        foreach($new_form_fields as $value) {
            
            $new_form_fields_data = array(
                'form_id'   => $new_form_id,
                'text'      => $value['text'],
                'mandatory' => $value['mandatory'],
                'columns'   => $value['columns'],
                'type_id'   => $value['type_id'],
                'position'  => $value['position'],
                'parent_id' => 0
            );
            
            $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields', $new_form_fields_data));
            
            $form_field_id = $this->db->insertId();
                        
            // Check the merged fields and do the update (if any) 
            if( ! empty($merged_fields) ) {
                foreach($merged_fields as $g_id => $g_array) {
                    foreach($g_array as $k_id => $initial_field_id) {
                        if($initial_field_id == $value['id']) {
                            $merged_fields[$g_id][$k_id] = $form_field_id;
                        }
                    }
                }
            }
            
            // Fill the field's attributes (if any)
            if( ! empty($value['attributes']) ) {
                foreach($value['attributes'] as $r_a) {
                    $attributes_data = array(
                        'field_id' => $form_field_id,
                        'name'     => $r_a['name'],
                        'value'    => $r_a['value']
                    );
                    $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields_attributes', $attributes_data));
                }
            }

            // Fill the field's options (if any)
            if( ! empty($value['options']) ) {
                foreach($value['options'] as $r_a) {
                    $options_data = array(
                        'field_id'   => $form_field_id,
                        'text'       => $r_a['text'],
                        'attributes' => $r_a['attributes'],
                        'position'   => $r_a['position']
                    );
                    $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields_options', $options_data));
                }
            }

            // Fill the field's options (if any)
            if( ! empty($value['validations']) ) {
                
                //echo '<pre>'; print_r($row['validations']); echo '</pre>';
                
                foreach($value['validations'] as $r_a) {
                    $validations_data = array(
                        'field_id' => $form_field_id,
                        'type'     => $r_a['type'],
                        'message'  => $r_a['message'],
                        'value'    => $r_a['value']
                    );
                    
                    $validation_insert_query = $this->db->prepareInsert($this->conf['db']['prefix'].'fields_validations', $validations_data);
                    $this->db->query($validation_insert_query);
                }
            }
        }
        
        // Add the merged rows (if any)
        if( ! empty($merged_fields) ) {
            
            $merged_fields = array_values($merged_fields);
            
            for($i = 0; $i < count($merged_fields); $i++) {          
                $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'rows', array('form_id' => $new_form_id)));
                $row_id = $this->db->insertId();
                
                foreach($merged_fields[$i] as $merged_field_id) {
                    $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'rows_fields', array('row_id' => $row_id, 'field_id' => $merged_field_id)));                               
                }
            }  
        }
        
        // Copy Form Configuration
        $this->copyConfigValues($form_id, $new_form_id);
        
        // Create the template files (if the initial form had a custom layout)
        $is_custom_layout = $this->db->getRow('SELECT l.custom, l.name, l.file_template, l.file_css FROM `'.$this->conf['db']['prefix'].'layouts` l LEFT JOIN `'.$this->conf['db']['prefix'].'config_values` cv ON (cv.field_id = 73) WHERE cv.form_id='.$form_id.' && l.id=cv.value');
        
        //echo '<pre>'; print_r($is_custom_layout); echo '</pre>';
        
        if($is_custom_layout['custom'] == 1) {
            
            $file_base_name = $is_custom_layout['name'];
            $file_template = $is_custom_layout['file_template'];
            $file_css = $is_custom_layout['file_css'];
            
            $path_to_custom_template_folder = $this->conf['local']['path_to_app_layouts'] . 'custom';
            $path_to_custom_style_folder = $this->conf['local']['path_to_style'] . 'custom';
                        
            if(is_writable($path_to_custom_template_folder) && 
               file_exists($path_to_custom_template_folder.'/'.$file_template) && 
               is_writable($path_to_custom_style_folder) && 
               file_exists($path_to_custom_style_folder.'/'.$file_css)) {
                
                $new_file_template = str_replace('.tpl', '['.$new_form_id.'].tpl', $file_template);
                $new_file_css = str_replace('.css.php', '['.$new_form_id.'].css.php', $file_css);
                
                copy($path_to_custom_template_folder.'/'.$file_template, $path_to_custom_template_folder.'/'.$new_file_template);
                copy($path_to_custom_style_folder.'/'.$file_css, $path_to_custom_style_folder.'/'.$new_file_css);
            
                $data = array(
                    'name'          => $file_base_name.' ['.$new_form_id.']',
                    'file_template' => $new_file_template,
                    'file_css'      => $new_file_css,
                    'custom'        => 1
                );
            
                $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'layouts', $data));
                
                $new_layout_id = $this->db->insertId();
                
                // Update the layout id for the new duplicated form
                $this->db->query('UPDATE `'.$this->conf['db']['prefix'].'config_values` SET value='.$new_layout_id.' WHERE field_id=73 && form_id='.$new_form_id);     
            }
        }
        return $new_form_id;
    }
	
    /**
     * Create_Form::copyConfigValues()
     * 
     * @param mixed $form_id
     * @return void
     */
    public function copyConfigValues($from = 'default', $to) {
        
        if($from == 'default') {
            $query = "SELECT id, default_value as value FROM `".$this->conf['db']['prefix']."config_names`";
        } else {
            $query = "SELECT field_id as id, value FROM `".$this->conf['db']['prefix']."config_values` WHERE form_id='".$from."'";
        }
        
        $q_all = $this->db->getAll($query);
        
        foreach($q_all as $r) {
            
            $id = $r['id'];
            $value = $r['value'];
                        
            $data = array('form_id'  => $to,
                          'field_id' => $id,
                          'value'    => addslashes($value));
            
            $i = $this->db->query( $this->db->prepareInsert($this->conf['db']['prefix'].'config_values', $data) );               
        }     
    }
    
    /**
     * Manage_Forms::updateDefaultConfigValues()
     * 
     * @return
     */
    public function updateDefaultConfigValues() {
        
        $c = $_POST['c'];
        
        if(!isset($c[41])) {
            $c[41] = '';
        }
        
        $update_query = 'UPDATE `'.$this->conf['db']['prefix'].'config_names` SET default_value = CASE id ';
        
        $ids = array();
        
        foreach($c as $id => $default_value) {

            // Encrypt [Password]                   
            if($id == 68 && $default_value) {
                $default_value = $this->encrypt(AFP_SECURITY_KEY, $default_value);
            } else if($id == 68 && $default_value == '') {
                continue;
            }

            if(is_array($default_value)) {
                $default_value = $this->DoJsonEncode($default_value);
            }
            
            $update_query .= sprintf(" WHEN '%d' THEN '%s' ", $id, $default_value);
            $ids[] = $id;
        }
        
        $field_ids = implode(',', array_values($ids));
          
        $update_query .= 'END WHERE id IN ('.$field_ids.')';
        
        $this->db->query($update_query);

        return array('success' => 1,
                     'message' => $this->conf['msg']['success']['form_default_config_edited']);
                            
    }
    
    /**
     * Manage_Forms::updateConfigValues()
     * 
     * @param mixed $form_id
     * @return void
     */
    public function updateConfigValues($form_id) {
                
        $c = $_POST['c'];

        if(!isset($c[41])) {
            $c[41] = '';
        }
        
        $update_query = 'UPDATE `'.$this->conf['db']['prefix'].'config_values` SET value = CASE field_id ';
        
        $ids = array();
        
        foreach($c as $field_id => $field_value) {
            
            // Encrypt [Password]                   
            if($field_id == 68 && $field_value) {
                $field_value = $this->encrypt(AFP_SECURITY_KEY, $field_value);
            } else if($field_id == 68 && $field_value == '') {
                continue;
            }
                        
            if(is_array($field_value)) {
                $field_value = $this->DoJsonEncode($field_value);
            }
            
            $update_query .= sprintf(" WHEN '%d' THEN '%s' ", $field_id, $field_value);
            $ids[] = $field_id;
        }
        
        $field_ids = implode(',', array_values($ids));
          
        $update_query .= 'END WHERE field_id IN ('.$field_ids.') && form_id='.$form_id;
        
        $this->db->query($update_query);

        return array('success' => 1,
                     'message' => $this->conf['msg']['success']['form_config_edited']);
        
    }
    
    /**
     * Manage_Forms::getInfo()
     * 
     * @param mixed $form_id
     * @param string $check_id
     * @return
     */
    public function getInfo($form_id, $check_id = '') {
        
        if($check_id) {
            if(!$form_id) { 
                exit('No form id was requested!');
            } 
        }
        
        $form_info = $this->db->getRow("SELECT name, description FROM `".$this->conf['db']['prefix']."forms` WHERE id='".$form_id."'");  
        
        if($check_id) {
            if( empty($form_info) ) {
                exit("The Requested Form ID is not valid. Click <a href='manage_forms.php'>here</a> to go to the forms list.");
            }     
        }    
        return $form_info;
    }
    

    /**
     * Manage_Forms::updateInfo()
     * 
     * @return
     */
    public function updateInfo() {
                        
        // -------- Name & Description --------
             
        if(isset($_POST['name']) && isset($_POST['form_id'])) {
                        
            $name = $_POST['name'];
            $description = $_POST['description'];
            
            $form_id = (int)$_POST['form_id'];
            
            // check if the name already exists in the database
            $q = $this->db->query("SELECT id FROM `".$this->conf['db']['prefix']."forms` WHERE name='".$name."' && id != '".$form_id."'");
            
            if($this->db->getNumRows($q) > 0) {
        
                $output = array('success' => 0, 'message' => $this->conf['msg']['error']['form_name_dupe']);
                
            } else {
                
                $q = $this->db->prepareUpdate($this->conf['db']['prefix'].'forms', array('name' => $name, 'description' => $description), "WHERE id='".$form_id."'");
                
                //echo $q;
                
                $update = $this->db->query($q);
                
                if($update) {
                    $output = array('success' => 1, 'message' => $this->conf['msg']['success']['form_edited']);
                }
            }
            
            return $output;
        }     
    }

    /**
     * Manage_Forms::getFormId()
     * 
     * @param mixed $field_id
     * @return
     */
    public function getFormId($field_id) {
        return $this->db->getOne("SELECT form_id FROM `".$this->conf['db']['prefix']."fields` WHERE id='".$field_id."'");
    }

    /**
     * Manage_Forms::delete()
     * 
     * @param mixed $form_id
     * @return
     */
    public function delete($form_id) {
        
        // Remove the form
        $this->db->delete($this->conf['db']['prefix'].'forms', array('id' => $form_id));
        
        return true;    
    }
    
    /**
     * Manage_Forms::getFonts()
     * 
     * @return
     */
    public function getFonts() {
        
        //echo "<pre>"; print_r($this->conf['url']); echo '</pre>';
        
        $path_to_fonts = $this->conf['local']['path_to_fonts'];
        
        //echo $path_to_fonts;
                
        if(is_dir($path_to_fonts)) {
            
            $fonts = glob($path_to_fonts.'*.ttf');
            $fonts = array_map('basename', $fonts);
            
            asort($fonts);
            
            $main = array();
            
            foreach($fonts as $value) {
                $main[$value] = $value;
            }
            
            return $main;  
            
        } else {
            return false;
        }
    }
    
    /**
     * Manage_Forms::getFormData()
     * 
     * @param mixed $form_id
     * @return
     */
    public function getFormData($form_id) {

        $query = "SELECT f.name AS title, GROUP_CONCAT(fcv.value SEPARATOR '|') AS Value, l.file_template, l.file_css, l.custom

        FROM `".$this->conf['db']['prefix']."forms` f
        
        LEFT JOIN `".$this->conf['db']['prefix']."config_values` fcv ON (fcv.form_id = ".$form_id.")
        LEFT JOIN `".$this->conf['db']['prefix']."layouts` l ON (l.id = SUBSTRING_INDEX(Value, '|', 1))
        
        WHERE f.id='".$form_id."' && fcv.field_id IN (73, 81)
        
        GROUP BY f.id";
        
        //echo $query;
        
        $fetch = $this->db->getRow($query);
        
        list(,$area_width) = explode('|', $fetch['Value']);
        
        $fetch['area_width'] = $area_width;
        
        return $fetch;
    }
}
?>