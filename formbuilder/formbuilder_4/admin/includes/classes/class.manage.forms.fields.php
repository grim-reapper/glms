<?php
/**
 * Manage_Forms_Fields
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Manage_Forms_Fields {
    
    /**
     * Manage_Forms_Fields::__construct()
     * 
     * @param mixed $conf
     * @param mixed $db
     * @return void
     */
    public function __construct($conf, $db) {
        $this->conf = $conf;
        $this->db = $db;
    }    
    
    /**
     * Manage_Forms_Fields::add()
     * 
     * @return
     */
    public function add() {
        
        $error = false;
        
        $form_id   = (int)$_POST['form_id'];
        $text      = $_POST['text'];
        $name      = $_POST['name'];
        $mandatory = (int)$_POST['mandatory'];
        $value     = $_POST['value'];
        
        $type_id   = (int)$_POST['type_id'];
        
        $columns = ($type_id == 4 || $type_id == 5) ? 1 : 0;
        
        if( ! $text ) {
            $error = $this->conf['msg']['success']['form_field_no_name_add_error'];
        }
        
        if( ! $error ) { // No error? Continue
            
            // If the Admin User entered a 'name', it still has to be filtered in order to follow the attribute name conventions
            //$generate_name_from = ($name) ? $name : $text;
            
            //$name = $this->generateFieldName($generate_name_from);
            
            // 0 - for hidden field; - the last one for other type of fields
            $field_position = ($type_id != 6) ? ($this->db->getOne("SELECT MAX(position) as max_position FROM `".$this->conf['db']['prefix']."fields` WHERE form_id='".$form_id."'") + 1) : 0;
             
            $data = array(
                'form_id'    => $form_id,
                'text'       => $text,
                'name'       => '',
                'mandatory'  => $mandatory,
                'columns'    => $columns,
                'type_id'    => $type_id,
                'position'   => $field_position,
                'parent_id'  => 0
            );
            
            $insert = $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields', $data));
            
            $field_id = $this->db->insertId();

            // Insert/Update Default Value
            if($value != '') {
                $this->doDefaultValue($value, $field_id);
            }
            
            $success = 1;
            $message = $this->conf['msg']['success']['form_field_added'];
                                   
        } else {
            $success = 0;
            $message = $error;
            $field_id = false;
        }
        
        $output = array('success'  => $success,
                        'message'  => $message,
                        'field_id' => $field_id);

        return $output;
    }

    /**
     * Manage_Forms_Fields::update()
     * 
     * @return
     */
    public function update() {
                
        $error = false; // default
    
        $field_id = $_POST['field_id'];
        
        $text = $_POST['text'];
        $name = $_POST['name'];
        $mandatory = (int)$_POST['mandatory'];
        $default_value = $_POST['default_value'];
        
        $columns = (int)$_POST['columns'];
        
        if($columns < 1) {
            $columns = 1;
        }
        
        $before_content = $_POST['before_content'];
        $after_content = $_POST['after_content'];
        
        if($name) {
            $name = $this->generateFieldName($name);
        
            // now check if the name is already assigned to other field for this form
            $form_id = $this->db->getOne("SELECT form_id FROM `".$this->conf['db']['prefix']."fields` WHERE id='".$field_id."'");
            
            if($this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."fields` WHERE name='".$name."' && id != '".$field_id."' && form_id='".$form_id."'")) {
                $name .= '1'; // append 'd' to the name to make it unique
            }
        }

        $data = array('text'      => $text,
                      'name'      => $name,
                      'mandatory' => $mandatory,
                      'columns'   => $columns);
        
        $this->db->doSanitize = false; // data is already sanitized (do not sanitize it again)
                   
        if( ! $this->db->query( $this->db->prepareUpdate($this->conf['db']['prefix'].'fields', $data, "WHERE id='".$field_id."'") ) ) {
            $error = true;
        }
        
        // --------- Update Before/Content ---------
        
        $field_extras = array();
        
        $this->db->query("DELETE FROM `".$this->conf['db']['prefix']."fields_extras` WHERE name IN ('before_content', 'after_content') && field_id='".$field_id."'");
        
        $field_extras[] = array(
            'field_id' => $field_id,
            'name'     => 'before_content',
            'value'    => $before_content
        );
    
        $field_extras[] = array(
            'field_id' => $field_id,
            'name'     => 'after_content',
            'value'    => $after_content
        );                
        
        foreach($field_extras as $field_extra) {
            $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields_extras', $field_extra));                
        }
        
        // Update Validations
        $validations = $_POST['validation'];
        
        if(is_array($validations) && !empty($validations)) {
            
            foreach($validations as $key => $valoare) {
                if($key == 'error_message') {
                    if( ! empty($valoare) ) {                        
                        foreach($valoare as $validation_id => $error_message) {
                            $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields_validations` SET message='".$error_message."' WHERE id='".$validation_id."'");
                        }
                    }
                }
                if($key == 'value') {
                    if( ! empty($valoare) ) {
                        foreach($valoare as $validation_id => $value) {
                            $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields_validations` SET value='".$value."' WHERE id='".$validation_id."'");
                        }
                    }                        
                }
            }
        }
        
        // Update Options
        $options = $_POST['option'];
        
        if(is_array($options['text']) && !empty($options['text'])) {
            
            foreach($options['text'] as $option_id => $option_text) {
                
                $option_id = (int)$option_id;
                
                $option_value = $options['value'][$option_id];
                $option_attributes = $options['attribute'][$option_id];
                $option_parent_id = (int)$options['parent_id'][$option_id];
                
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields_options` SET text='".$option_text."', value='".$option_value."', attributes='".$option_attributes."', parent_id='".$option_parent_id."' WHERE id='".$option_id."'");
            }
            
        }
        
        // Update Attributes
        $attributes = $_POST['attribute'];

        if(is_array($attributes) && !empty($attributes)) {
            
            foreach($attributes as $key => $valoare) {
                if($key == 'name') {
                    if( ! empty($valoare) ) {                        
                        foreach($valoare as $attribute_id => $name) {
                            $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields_attributes` SET name='".$name."' WHERE id='".$attribute_id."'");
                        }
                    }
                }
                if($key == 'value') {
                    if( ! empty($valoare) ) {
                        foreach($valoare as $attribute_id => $value) {
                            $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields_attributes` SET value='".$value."' WHERE id='".$attribute_id."'");
                        }
                    }                        
                }
            }
        }
        
        // Insert/Update Default Value
        if($default_value != '') {
            $this->doDefaultValue($default_value, $field_id);
        }
        
        if( ! $error ) {
            $output = array('success' => 1, 'message' => $this->conf['msg']['success']['field_updated']);
        } else {
            $output = array('success' => 0, 'message' => $this->conf['msg']['error']['field_not_updated']);
        }
        
        return $output; 
    }

    /**
     * Manage_Forms_Fields::updateAll()
     * 
     * @return
     */
    public function updateAll() {
    
        //echo '<pre>'; print_r($_POST); echo '</pre>';
        
        $error = false; // default
        
        $no_fields = count($_POST['text']);
        
        for ($i = 0; $i < $no_fields; $i++) {
	
            $field_id = $_POST['field_id'][$i];

            if($_POST['name'][$i] != '') {
                $name = $this->generateFieldName($_POST['name'][$i]);
            
                // now check if the name is already assigned to other field for this form
                $form_id = $this->db->getOne("SELECT form_id FROM `".$this->conf['db']['prefix']."fields` WHERE id='".$field_id."'");
                
                if($this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."fields` WHERE name='".$name."' && id != '".$field_id."' && form_id='".$form_id."'")) {
                    $name .= '1'; // append '1' to the name to make it unique
                }
            } else {
                $name = '';
            }
    
            $data = array('text'      => $_POST['text'][$i],
                          'name'      => $name,
                          'mandatory' => (int)$_POST['mandatory'][$field_id]);
            
            $this->db->doSanitize = false; // data is already sanitized
            
            if( ! $this->db->query( $this->db->prepareUpdate($this->conf['db']['prefix'].'fields', $data, "WHERE id='".$field_id."'") ) ) {
                $error = true;
            }

            // Insert/Update Default Value
            if(isset($_POST['value'][$i])) {
                $default_value = $_POST['value'][$i];
                $this->doDefaultValue($default_value, $field_id);
            }
        }
        
        if(!$error) {
            $output = array('success' => 1, 'message' => $this->conf['msg']['success']['fields_updated']);
        } else {
            $output = array('success' => 0, 'message' => $this->conf['msg']['error']['fields_not_updated']);
        }
        
        return $output; 
    }

    /**
     * Manage_Forms_Fields::updateMergedFieldsArea()
     * 
     * @param mixed $row_id
     * @return
     */
    public function updateMergedFieldsArea($row_id) {
        
        $before_content = $_POST['before_content'];
        $after_content = $_POST['after_content'];
        
        $data = array(
            'before_content' => $before_content,
            'after_content'  => $after_content
        );
        
        $this->db->query( $this->db->prepareUpdate($this->conf['db']['prefix'].'rows', $data, "WHERE id='".$row_id."'") );
    
        $output = array('success' => 1, 'message' => $this->conf['msg']['success']['merged_fields_area_updated']);
        
        return $output;
    }
    
    /**
     * Manage_Forms_Fields::addDefaults()
     * 
     * @param mixed $form_id
     * @return void
     */
    public function addDefaults($form_id) {
        
        $form_fields = $this->getDefaults();
        
        $i = 0;
        
        foreach($form_fields as $field_key => $value) {
            
            // ----- Insert field -----
            $data = array('form_id'   => $form_id,
                          'text'      => $value['text'],
                          'name'      => '',
                          'mandatory' => (int)$value['mandatory'],
                          'columns'   => 0,
                          'type_id'   => $value['type'],
                          'position'  => ($i + 1));

            $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields', $data));
            
            $field_id = $this->db->insertId();
            
            if($field_key == 'sender_name') {
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."config_values` SET value='".$field_id."' WHERE field_id IN(74,83) && form_id='".$form_id."'");
            }
            
            if($field_key == 'sender_email') {
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."config_values` SET value='".$field_id."' WHERE field_id IN(75,82) && form_id='".$form_id."'");
            }
            
            // Insert Attributes
            if(is_array($value['attributes'])) {
                $this->addAttributes($field_id, $value['attributes'], 0);
            }
            
            // Insert Validations
            if(is_array($value['validation'])) {
                
                foreach($value['validation'] as $type => $valoare) {
                    
                    $validation_array = array(
                        'type'    => $type,
                        'message' => $valoare['message'],
                        'value'   => $valoare['value']
                    );
                    
                    $this->addValidation($field_id, $validation_array);
                }
                
            }
            
            $i++;    
        } 
    }
    
    /**
     * Manage_Forms_Fields::doDefaultValue()
     * 
     * @param mixed $value
     * @param mixed $field_id
     * @return void
     */
    public function doDefaultValue($value, $field_id) {
        $dv_id = $this->db->getOne("SELECT id FROM `".$this->conf['db']['prefix']."fields_attributes` WHERE name='value' && field_id='".$field_id."'");
        
        if($dv_id) {
            $query = "UPDATE `".$this->conf['db']['prefix']."fields_attributes` SET value='".$value."' WHERE id='".$dv_id."'";
        } else {
            $query = $this->db->prepareInsert($this->conf['db']['prefix'].'fields_attributes', array('field_id' => $field_id, 'name' => 'value', 'value' => $value));
        }
        
        $this->db->query($query);        
    }

    /**
     * Manage_Forms_Fields::mergeFields()
     * 
     * @return void
     */
    public function mergeFields() {
        
        $form_id = $_POST['form_id'];
        $merge_set = $_POST['merge_set'];

        if(!empty($merge_set)) {

            $this->db->query("INSERT INTO `".$this->conf['db']['prefix']."rows` (form_id) VALUES ('".$form_id."')");
            
            $row_id = $this->db->insertId();
            
            foreach($merge_set as $field_id) {
                
                $data = array(
                    'field_id'   => $field_id,
                    'row_id'     => $row_id,
                    'properties' => ''
                );
                
                $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'rows_fields', $data));
            }
        }
    }

    /**
     * Manage_Forms_Fields::getMergedFields()
     * 
     * @param mixed $form_id
     * @return
     */
    public function getMergedFields($form_id) {
        
        $q = "SELECT f.text as field_name, r.id, rf.field_id FROM `".$this->conf['db']['prefix']."rows_fields` rf
        LEFT JOIN `".$this->conf['db']['prefix']."rows` r ON (rf.row_id = r.id)
        LEFT JOIN `".$this->conf['db']['prefix']."fields` f ON (rf.field_id = f.id)
        WHERE r.form_id=".$form_id;
        
        $merged_fields = $this->db->getAll($q);
        
        if(!empty($merged_fields)) {
            
            $final_merged_fields = array();
            
            foreach($merged_fields as $value) {
                $final_merged_fields[$value['id']][] = array(
                    'field_id' => $value['field_id'], 
                    'field_name' => $value['field_name']
                );    
            }
            //echo '<pre>'; print_r($final_merged_fields); echo '</pre>';
            
            return $final_merged_fields;
        }
        
        return array();
    }
    
    /**
     * Manage_Forms_Fields::deleteMergedFieldsRow()
     * 
     * @return void
     */
    public function deleteMergedFieldsRow() {
        $row_id = (int)$_POST['row_id'];
        $this->db->delete($this->conf['db']['prefix'].'rows', array('id' => $row_id));
    }

    /**
     * Manage_Forms_Fields::getSingleRowsFields()
     * 
     * @param mixed $fields_list
     * @param mixed $merged_fields
     * @return
     */
    public function getSingleRowsFields($fields_list, $merged_fields) {

        if( ! empty($fields_list) ) {
            
            $merged_fields_list = array();
            
            foreach($merged_fields as $v_m) {
                foreach($v_m as $v_m2) {
                    $merged_fields_list[] = $v_m2['field_id'];
                }
            }
            
            $options = array();
            
            foreach($fields_list as $v_value) {
                
                $field_id = $v_value['id'];
                
                if(in_array($field_id, $merged_fields_list)) {
                    continue;
                }
                
                $options[] = array('title' => $v_value['text'], 'field_id' => $field_id, 'type_id' => $v_value['type_id']);
            } 
        } 
       
        return $options;
    }
        
    /**
     * Manage_Forms_Fields::addAttributes()
     * 
     * @return void
     */
    public function addAttributes($field_id, $field_attributes, $one = 1) {
        
        $success = true;
        
        $banned_attributes = array('type', 'id', 'value', 'name');
        
        if($one == 1) { // Prepare the array for 1 attribute to be added
        
            $attribute_name = trim($field_attributes['name']);
            
            if(in_array($attribute_name, $banned_attributes)) {
                
                $success = false;
                $message = $this->conf['msg']['error']['attribute_in_ban_list'];
                
                return array('success' => $success, 'message' => $message);                     
            }
            
            $attribute_value = trim($field_attributes['value']);
            $attribute_value = str_replace('"', "'", stripslashes($attribute_value));
        
            $field_attributes = array($attribute_name => $attribute_value);
        }
        
        // echo '<pre>'; print_r($field_attributes); echo '</pre>';
        
        foreach($field_attributes as $name => $value) {
            
            if(in_array($attribute_name, $banned_attributes)) {
                continue;
            }
            
            $value = str_replace('"', "'", stripslashes($value));
            
            $data = array(
                'field_id' => $field_id,
                'name'     => $name,
                'value'    => $value
            );
         
            $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields_attributes', $data));               
        }
        
        $attribute_id = $this->db->insertId();
        
        return array('success'       => $success,
                     'message'       => $message,
                     'attribute_id'  => $attribute_id);                     
    }

    /**
     * Manage_Forms_Fields::addOption()
     * 
     * @param mixed $field_id
     * @param mixed $text
     * @param mixed $value
     * @param integer $parent_id
     * @return
     */
    public function addOption($params) {
        
        $field_id = $params['field_id'];
        $text = $params['text'];
        $value = $params['value'];
        $attributes = $params['attributes'];
        $parent_id = (int)$params['parent_id'];
        
        $success = true;
        
        $position = ($this->db->getOne("SELECT MAX(position) as max_position FROM `".$this->conf['db']['prefix']."fields_options` WHERE field_id='".$field_id."'") + 1);
        
        $data = array(
            'field_id'   => $field_id,
            'text'       => $text,
            'value'      => $value,
            'attributes' => $attributes,
            'position'   => $position,
            'parent_id'  => (int)$parent_id,
        );
        
        $success = $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields_options', $data));
        
        $option_id = $this->db->insertId();
        
        $message = $this->conf['msg']['success']['option_added'];

        return array('success'   => $success,
                     'message'   => $message, 
                     'option_id' => $option_id);
    }
        
    /**
     * Manage_Forms_Fields::addValidation()
     * 
     * @param mixed $field_id
     * @param mixed $validation
     * @return
     */
    public function addValidation($field_id, $validation) {
            
            $success = true;
            
            $type = $validation['type'];
            $message = $validation['message'];
            $value = $validation['value'];

            if($message == '') {
                $success = false;
                $message = $this->conf['msg']['error']['validation_message_not_added'];  
            }
            
            switch ($type) { 
            	case 'min_chars': // Minimum characters
                    if( ! ctype_digit($value) ) {
                        $success = false;
                        $message = $this->conf['msg']['error']['validation_value_not_numeric'];  
                    }
            	break;
                
            	case 'min_selections': // Minimum selections
                    if($value == '') {
                        $success = false;
                        $message = $this->conf['msg']['error']['validation_no_min_selection_value'];                         
                    }
            	break;  
                          
            	case 'phone': // Phone Number (a pattern must me typed)
                    if($value == '') {
                        $success = false;
                        $message = $this->conf['msg']['error']['validation_no_value'];                         
                    }
            	break;
            }
                        
            if($success) {
                
                $value = ($value) ? $value : 1;
            
                $data = array(
                    'field_id' => $field_id,
                    'type'     => $type,
                    'message'  => $message,
                    'value'    => $value
                );
                
                $this->db->query($this->db->prepareInsert($this->conf['db']['prefix'].'fields_validations', $data));
                $validation_id = $this->db->insertId();
                
                // Mark the field as required (if it's the case)
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields` SET mandatory='1' WHERE id='".$field_id."'");
                
            } else {
                $validation_id = false;
            }
            
            $output = array('success'       => $success,
                            'message'       => $message,
                            'validation_id' => $validation_id);
            
            //echo '<pre>'; print_r($output); echo '</pre>';
            
            return $output;
                         
    }
    

    /**
     * Manage_Forms_Fields::getData()
     * 
     * @param string $form_id
     * @param string $field_id
     * @return
     */
    public function getData($form_id = '', $field_id = '', $no_hidden = false) {
        
        if($form_id && $field_id == '') { // By Form ID
            
            $sql = "SELECT 
            
            f.id, 
            f.text, 
            f.name, 
            f.mandatory, 
            f.columns, 
            f.type_id, 
            f.parent_id,
            
            (SELECT value FROM `".$this->conf['db']['prefix']."fields_attributes` WHERE name='value' && field_id=f.id) as default_value,
            
            (SELECT value FROM `".$this->conf['db']['prefix']."fields_extras` WHERE name='before_content' && field_id=f.id) as before_content, 
            (SELECT value FROM `".$this->conf['db']['prefix']."fields_extras` WHERE name='after_content' && field_id=f.id) as after_content            
            
            FROM `".$this->conf['db']['prefix']."fields` f
            
            WHERE ";
            
            if($no_hidden) {
                $sql .= " f.type_id != '6' && ";
            }
            
            $sql .= "f.form_id='".(int)$form_id."'";
            
            $sql .= " ORDER BY position";
            
            return $this->db->getAll($sql);
        
        } else if($field_id && $form_id == '') { // By Field ID
             
            $sql = "SELECT
            
            f.text, f.name, f.mandatory, f.columns, f.type_id, f.parent_id,
            
            (SELECT value FROM `".$this->conf['db']['prefix']."fields_attributes` WHERE name='value' && field_id=f.id) as default_value,
            
            (SELECT value FROM `".$this->conf['db']['prefix']."fields_extras` WHERE name='before_content' && field_id=f.id) as before_content, 
            (SELECT value FROM `".$this->conf['db']['prefix']."fields_extras` WHERE name='after_content' && field_id=f.id) as after_content
            
            FROM `".$this->conf['db']['prefix']."fields` f
            
            WHERE f.id='".(int)$field_id."'";
                                                                                                                                 
            return $this->db->getRow($sql);
            
        } else {
            return false;
        }
    }
        
    /**
     * Manage_Forms_Fields::delete()
     * 
     * @param mixed $field_id
     * @return
     */
    public function delete($field_id) {
                    
        // Remove the form's field
        $this->db->delete($this->conf['db']['prefix'].'fields', array('id' => $field_id));
        
        return true;    
    }

    /**
     * Manage_Forms_Fields::deleteValidation()
     * 
     * @param mixed $validation_id
     * @return
     */
    public function deleteValidation($validation_id) {
        
        // Get field id
        $field_id = $this->db->getOne("SELECT field_id FROM `".$this->conf['db']['prefix']."fields_validations` WHERE id='".$validation_id."'");
        
        $this->db->delete($this->conf['db']['prefix'].'fields_validations', array('id' => $validation_id));
        
        // Get total (remaining) validations (if any)
        $remaining_valids = $this->db->getCount("SELECT id FROM `".$this->conf['db']['prefix']."fields_validations` WHERE field_id='".$field_id."'");
        
        return $remaining_valids;
    }

    /**
     * Manage_Forms_Fields::deleteAttribute()
     * 
     * @param mixed $attribute_id
     * @return
     */
    public function deleteAttribute($attribute_id) {
        $q = $this->db->delete($this->conf['db']['prefix'].'fields_attributes', array('id' => $attribute_id));
        return $q;
    }

    /**
     * Manage_Forms_Fields::deleteOption()
     * 
     * @param mixed $option_id
     * @return
     */
    public function deleteOption($option_id) {
        
        $field_id = $this->db->getOne("SELECT field_id FROM `".$this->conf['db']['prefix']."fields_options` WHERE id='".$option_id."'");
                
        $this->db->delete($this->conf['db']['prefix'].'fields_options', array('id' => $option_id));

        // Get total (remaining) validations (if any)
        $remaining_valids = $this->db->getCount("SELECT id FROM `".$this->conf['db']['prefix']."fields_options` WHERE field_id='".$field_id."'");        
        
        return $remaining_valids;  
    }

    /**
     * Manage_Forms_Fields::deleteOptions()
     * 
     * @param mixed $option
     * @return void
     */
    public function deleteOptions($option) {    
        if( ! empty($option) ) {
            foreach($option as $option_id) {
                $this->deleteOption($option_id);
            }
        }
    }
        
    /**
     * Manage_Forms_Fields::getTypes()
     * 
     * @return
     */
    public function getTypes() {
        
        $types = array(1 => 'input',
                       2 => 'select',
                       3 => 'textarea',
                       4 => 'checkboxes',
                       5 => 'radios',
                       6 => 'hidden');
                       
        return $types;
        
    }
    
    /*
     * Manage_Forms_Fields::getValidationTypes()
     * 
     * @return
     */
    public function getValidationTypes() {
        
        $validation_types = array(
            'basic'          => 'Basic',
            'email'          => 'E-Mail (RegExp)',
            'numeric'        => 'Numerical',
            'phone'          => 'Phone Number',
            'min_chars'      => 'Minimum Characters',
            'min_selections' => 'Minimum Selections'
        );
        
        return $validation_types;
    }
    
    /**
     * Manage_Forms_Fields::getValidations()
     * 
     * @param mixed $field_id
     * @return
     */
    public function getValidations($field_id) {
        
        $q = $this->db->getAll("SELECT id, type, message, value FROM `".$this->conf['db']['prefix']."fields_validations` WHERE field_id='".$field_id."'");
        
        return $q;
    }

    /**
     * Manage_Forms_Fields::getAttributes()
     * 
     * @param mixed $field_id
     * @return
     */
    public function getAttributes($field_id) {
        $q = $this->db->getAll("SELECT id, name, value FROM `".$this->conf['db']['prefix']."fields_attributes` WHERE field_id='".$field_id."' && name NOT IN ('value', 'type', 'name')");
        return $q;
    }

    /**
     * Manage_Forms_Fields::getOptions()
     * 
     * @param mixed $field_id
     * @return
     */
    public function getOptions($field_id) {
        $q = $this->db->getAll("SELECT id, text, value, attributes, parent_id FROM `".$this->conf['db']['prefix']."fields_options` WHERE field_id='".$field_id."' ORDER BY position");
        return $q;
    }
    
    /**
     * Manage_Forms_Fields::getDefaults()
     * 
     * @return
     */
    public function getDefaults() {
        
        $defaults = array(
             
            # Name 
            'sender_name' => array(
                'text'        => 'Name',
                'mandatory'   => 1,
                'type'        => 1, // Input
                'validation'  => array('basic' => array('message' => 'Fill your name', 
                                                        'value'   => 1)
                ),
            ),
            
            # E-Mail
            'sender_email'   => array(
                'text'        => 'E-Mail',
        		'mandatory'   => 1,
                'type'        => 1, // Input
          
                'validation'  => array('basic' => array('message' => 'Fill an e-mail address', 
                                                        'value'   => 1),
                                                         
                                       'email' => array('message' => 'Fill a valid e-mail address',
                                                        'value'   => 1)),  
            ),
            
            # Message                           
            'sender_message' => array(
                'text'        => 'Message',
                'mandatory'   => 1,
                'type'        => 3, // Textarea
                
                'validation'  => array('basic'     => array('message' => 'Fill your message', 
                                                            'value'   => 1), 
                                                            
                                       'min_chars' => array('message' => 'Your message should have at least [min_chars] characters.',
                                                            'value'   => 15)),

        		'attributes'  => array('rows'  => 5, 'cols'  => 35)
            )	
        );
        
        return $defaults;       
    }

    /**
     * Manage_Forms_Fields::getPossibleParentSelects()
     * 
     * @param mixed $select_field_id
     * @param mixed $exclude
     * @return
     */
    public function getPossibleParentSelects($form_id, $exclude = array()) {
        
        // Add to the exclude list the existing parent fields
        $existing_parents = $this->db->getAll("SELECT parent_id FROM `".$this->conf['db']['prefix']."fields` WHERE parent_id != '0'");
        
        foreach($existing_parents as $value) {
            $exclude[] = $value['parent_id'];
        }
         
        $exclude_q = implode(',', $exclude);
        
        $q = "SELECT id, text FROM `".$this->conf['db']['prefix']."fields`
             WHERE type_id='2' && form_id='".$form_id."' ";
        
        if(!empty($exclude)) {
            $q .= " && id NOT IN (".$exclude_q.")";
        }
        
        //echo $q;
        
        $parent_selects = $this->db->getAll($q);
        
        return $parent_selects;
    }
    
    /**
     * Manage_Forms_Fields::importOptions()
     * 
     * @param mixed $field_id
     * @return void
     */
    public function importOptions($field_id) {
        
        $file_name = $_POST['import_file_name'];
        $parent_id = (int)$_POST['parent_id'];
        
        $path_to_options_file = dirname(dirname(__FILE__)).'/options-data/'.$file_name;
        
        if($path_to_options_file) {
            $options = file($path_to_options_file);
            
            foreach($options as $option) {
                
                $params = array(
                    'field_id' => $field_id,
                    'text' => $option,
                    'value' => '',
                    'attributes' => '',
                    'parent_id' => $parent_id
                );
                
                $this->addOption($params);
            }
        }
    }
    
    /**
     * Manage_Forms_Fields::importInputOptions()
     * 
     * @param mixed $field_id
     * @return void
     */
    public function importInputOptions($field_id) {
        
        $parent_id = $_POST['parent_id'];
        $options_from_input = $GLOBALS['_post_data']['options_from_input'];

        include 'class.simple.html.dom.php';
        
        if($options_from_input) {
        
            $html = str_get_html($options_from_input);        
    
            $options = array();
            
            foreach($html->find('option') as $element) {
                $option_text = trim($element->innertext);
                $option_value = trim($element->value);
                
                if($option_text) {
                    $options[] = array('text' => $option_text, 'value' => $option_value);
                }
            }
            
            if(empty($options)) {        
                $options = explode("\n", $options_from_input);
            }
            
            foreach($options as $option) {
                
                if(is_array($option)) {
                    $option_text = $option['text'];
                    $option_value = $option['value'];
                } else {
                    $option_text = trim(strip_tags($option));
                    $option_value = '';                    
                }
                
                if($option_text) {
                    
                    $params = array(
                        'field_id'   => $field_id,
                        'text'       => $option_text,
                        'value'      => $option_value,
                        'attributes' => '',
                        'parent_id'  => $parent_id
                    );
                    
                    $this->addOption($params);
                }
            }
        }
    }
    
    /**
     * Manage_Forms_Fields::assignParentField()
     * 
     * @return void
     */
    public function assignParentField() {
        $field_id = (int)$_POST['field_id'];
        $parent_id = (int)$_POST['parent_id'];
        
        $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields` SET parent_id='".$parent_id."' WHERE id='".$field_id."' && parent_id='0'");
    }

    /**
     * Manage_Forms_Fields::unassignParentField()
     * 
     * @return void
     */
    public function unassignParentField() {
        $field_id = (int)$_POST['field_id'];
        
        // for parent id
        $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields` SET parent_id='0' WHERE id='".$field_id."'");
    
        // for field's options
        $this->db->query("UPDATE `".$this->conf['db']['prefix']."fields_options` SET parent_id='0' WHERE field_id='".$field_id."'");
    }
    
    /**
     * Manage_Forms_Fields::generateFieldName()
     * 
     * @param mixed $field_text
     * @return
     */
    public function generateFieldName($string) {
        
        // Replace Non Alpha-Numeric Characters with space(s)
        $string = preg_replace("/[^A-Za-z0-9_]/", " ", $string);    
    
        // Strip additional space and underscores
        $string = preg_replace('/\s+/', '_', $string);
        
        // Trim any underscore
        $string = trim($string, '_');
        
        // Remove multiple underscores
        $string = preg_replace('/\_+/', '_', $string);
        
        // Lower Case
        $string = strtolower($string);
        
        return $string;
    }
}
?>