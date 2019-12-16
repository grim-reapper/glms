<?php
/**
 * Manage_Messages
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Manage_Messages extends Application {
       
    public function __construct($conf, $db) {
        $this->conf = $conf;
        $this->db = $db;
    }
    
    public function edit($message_id) {
        $from_whom = $_POST['from_whom'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $data = array(
            'from_whom' => $from_whom,
            'subject'   => $subject,
            'message'   => $message
        );
        
        $success = $this->db->query($this->db->prepareUpdate($this->conf['db']['prefix'].'data', $data, 'WHERE id='.$message_id));
        
        return array('success' => $success, 'message' => $this->conf['msg']['success']['message_edited']);
    }
    
    /**
     * Manage_Messages::delete()
     * 
     * @param mixed $message_id
     * @return
     */
    public function delete($message_id) {
        return $this->db->delete($this->conf['db']['prefix'].'data', array('id' => $message_id));    
    }

    /**
     * Manage_Messages::delete_all()
     * 
     * @return void
     */
    public function delete_all() {
        //echo '<pre>'; print_r($_POST); echo "</pre>";
        
        $message_id_box = $_POST['message_id'];
        
        if(!empty($message_id_box)) {
            foreach($message_id_box as $message_id) {
                $this->db->delete($this->conf['db']['prefix'].'data', array('id' => $message_id));    
            }
        }
    }
    
    /**
     * Manage_Messages::export_submitted_fields()
     * 
     * @return void
     */
     
     // Export to CSV: http://code.stephenmorley.org/php/creating-downloadable-csv-files/
     
    public function export_submitted_fields() {
        
        $form_id = (int)$_POST['form_id'];
        $fields_to_export = $_POST['fields_to_export'];
        
        if( ! empty($fields_to_export) && $form_id ) {
            
            $messages = $this->db->getCol("SELECT id FROM `".$this->conf['db']['prefix']."data` WHERE form_id='".$form_id."'");
            
            $form_title = preg_replace('#\W#', '', $this->db->getOne("SELECT name FROM `".$this->conf['db']['prefix']."forms` WHERE id='".$form_id."'"));
            
            $csv_file_name = $form_title.'-'.date('d.m.Y-h.m').'.csv';
            
            if( ! empty($messages) ) {
                
                $fields_list = implode(',', $fields_to_export);
                
                // output headers so that the file is downloaded rather than displayed
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename='.$csv_file_name);

                // create a file pointer connected to the output stream
                $output = fopen('php://output', 'w');

                // output the column headings
                $column_headings = $this->db->getCol("SELECT text FROM `".$this->conf['db']['prefix']."fields` WHERE id IN (".$fields_list.");");
                fputcsv($output, $column_headings);

                foreach($messages as $message_id) {
                    
                    $q = "SELECT value FROM ".$this->conf['db']['prefix']."data_fields
                          WHERE field_id IN (".$fields_list.") && message_id='".$message_id."'
                          ORDER BY id ASC";
                    
                    //echo $q;
                    
                    $rows = $this->db->getCol($q);
                    
                    if( ! empty($rows) ) {
                        fputcsv($output, $rows);
                    }
                
                }
                
                fclose($output);
              
                exit;
            }
        }
    }
    
    /**
     * Manage_Messages::export_messages()
     * 
     * @param string $form_id
     * @return void
     */
    public function export_messages($form_id = '') {
        
        if($form_id) $form_id = (int)$form_id;
        
        // Check if there are any messages for this form
        $q = "SELECT m.form_id, m.from_whom, m.subject, m.message, m.ip, m.date_added FROM `".$this->conf['db']['prefix']."data` m ";
        
        if($form_id) {
            $form_title = preg_replace('#\W#', '', $this->db->getOne("SELECT name FROM `".$this->conf['db']['prefix']."forms` WHERE id='".$form_id."'"));
            $csv_file_name = $form_title.'-'.date('d.m.Y-h.m').'.csv';
            
            $q .= " WHERE m.form_id='".$form_id."'";
        } else {
            $csv_file_name = 'All-Messages-'.date('d.m.Y-h.m').'.csv';
        }
        
        //echo $q; exit;
        
        $messages = $this->db->getAll($q);
        
        if( ! empty($messages) ) {
                       
            // output headers so that the file is downloaded rather than displayed
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$csv_file_name);

            // create a file pointer connected to the output stream
            $output = fopen('php://output', 'w');
            
            $column_headings = array('From Whom?', 'Subject', 'Message', 'IP Address', 'Date Recorded');
            
            if( $form_id == '' ) {
                array_unshift($column_headings, 'Form');
            }
            
            fputcsv($output, $column_headings);

            foreach($messages as $value) {
                $row = array($value['from_whom'], $value['subject'], $value['message'], $value['ip'], date('d-F-Y H:i:s', $value['date_added']));
                
                if( $form_id == '' ) {
                    $form_title = $this->db->getOne("SELECT name FROM `".$this->conf['db']['prefix']."forms` WHERE id='".$value['form_id']."'");
                    array_unshift($row, $form_title);
                }
                
                fputcsv($output, $row);
            }
            
            fclose($output);
          
            exit;
        }
    }
    
    public function edit_submitted_fields_values() {
        $row_id = $_POST['row_id'];
        
        if(!empty($row_id)) {
            foreach($row_id as $id => $value) {
                $this->db->query("UPDATE `".$this->conf['db']['prefix']."data_fields` SET value='".$value."' WHERE id='".$id."'");
            }
        }
        
        return array('success' => 1, 'message' => $this->conf['msg']['success']['submitted_fields_values_edited']);
    }
}
?>