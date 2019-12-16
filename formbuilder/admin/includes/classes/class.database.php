<?php
/**
 * DB
 * 
 * @package AJAX Form Pro v2
 * @author Gabriel Comarita
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class DB {
    
    public $doSanitize = true; // Sanitizes the data for DB::prepareInsert, DB::prepareUpdate
    public $doFilterData = true;
    
    /**
     * DB::__construct()
     * 
     * @info This method is called automatically when the class is instantiated
     * @param mixed $db_host
     * @param mixed $db_user
     * @param mixed $db_pass
     * @param mixed $db_name
     * @return void
     */
    public function __construct($db_host, $db_user, $db_pass, $db_name) {
        $connect = mysql_connect($db_host, $db_user, $db_pass) or die ('Could not connect to database server.');
        $select_db = mysql_select_db($db_name) or die('Could not select database.');
		mysql_set_charset('utf8', $connect);
    }
    
    /**
     * DB::query()
     * 
     * @param mixed $sql
     * @return
     */
    public function query($sql) {
        $query = mysql_query($sql) or die('SQL Query: '.$sql. ' Error: '.mysql_error());
        return $query;
    }
    
    /**
     * DB::getOne()
     * 
     * @param mixed $sql
     * @return
     */
    public function getOne($sql) {
        $query = $this->query($sql);
        $fetch = mysql_fetch_row($query);
        return $this->filterData($fetch[0]);
    }
    
    /**
     * DB::getRow()
     * 
     * @param mixed $sql
     * @return
     */
    public function getRow($sql) {
        $query = $this->query($sql);
        $array = mysql_fetch_array($query);
        
        return $this->filterData($array);
    }
    
    /**
     * DB::fetch()
     * 
     * @param mixed $query
     * @return
     */
    public function fetch($query) {
        $array = mysql_fetch_array($query);
        return $this->filterData($array);
    }
    
    /**
     * DB::getAll()
     * 
     * @param mixed $sql
     * @return
     */
    public function getAll($sql) {
        
        $query = $this->query($sql);
        
        $results = array();
        
        while($row = mysql_fetch_array($query)) {
            $results[] = $this->filterData($row);    
        }
        
        return $results;
    }

    /**
     * DB::getCol()
     * 
     * @param mixed $sql
     * @return
     */
    public function getCol($sql) {
        
        // Determine Column
        $col = $this->extractUnit($sql, 'select', 'from');
        $col = trim($col, '`');
        
        $query = $this->query($sql);
        
        $results = array();
        
        while($row = mysql_fetch_array($query)) {
            $results[] = $row[$col];
        }
        
        return $results;
    }
    
    /**
     * DB::getCount()
     * 
     * @param mixed $sql
     * @return
     */
    public function getCount($sql) {
        $query = $this->query($sql);
        
        return mysql_num_rows($query);
    }
    
    /**
     * DB::getNumRows()
     * 
     * @param mixed $query
     * @return
     */
    public function getNumRows($query) {
        return mysql_num_rows($query);
    }
    
    /**
     * DB::insertId()
     * 
     * @return
     */
    public function insertId() {
        return mysql_insert_id();
    }
    
    /**
     * DB::delete()
     * 
     * @param mixed $table
     * @param mixed $params
     * @return
     */
    public function delete($table, $params) {
        
        $sql = 'DELETE FROM `'.$table.'` WHERE '; 
        
        $and = ' && ';
        
        foreach($params as $field_name => $field_value) {
            $sql .= $field_name."='".$this->sanitize($field_value)."'".$and;
        }
        
        $sql = trim($sql, $and);
        
        return $this->query($sql);
    }
    
    /**
     * DB::prepareInsert()
     * 
     * @param mixed $table
     * @param mixed $data
     * @return
     */
    public function prepareInsert($table, $data) {
    
        // Fields' Names
        $names = '';
        
        foreach (array_keys($data) as $fieldName) {
            $names .= '`'.$fieldName.'`, ';            
        }
        
        $names = trim($names, ', ');
        
        // Fields' Values
        
        $values = '';
        
        foreach($data as $value) {        
            
            if($value == 'now()') {
                $str_value = $value;
            } else {
                $str_value = "'".trim($this->sanitize($value))."'";
            }
            
            $values .= $str_value.',';
        }
        
        $values = trim($values, ',');
        
        $sql = 'INSERT INTO `'.$table.'` ('.$names.') VALUES ('.$values.');';
        
        return $sql;  
    }
    
    /**
     * DB::prepareUpdate()
     * 
     * @param mixed $table
     * @param mixed $data
     * @param string $end_query
     * @return
     */
    public function prepareUpdate($table, $data, $end_query = '') {

        $str_data = '';
        
        foreach($data as $name => $value) {        
            
            if($value == 'now()') {
                $str_value = $value;
            } else {
                $final_val = trim($this->sanitize($value));      
                $str_value = "'".$final_val."'";
            }
            
            $str_data .= $name.'='.$str_value.',';
        }
        
        $str_data = trim($str_data, ',');
        
        $sql = trim('UPDATE `'.$table.'` SET '.$str_data.' '.$end_query);
        
        //echo $sql;
        
        return $sql;
    }
    
	/**
	 * DB::sanitize()
	 * 
	 * @param mixed $data
	 * @return
	 */
	public function sanitize($data) {
	   
	   if($this->doSanitize) {
       
        	if (is_array($data)) {
        	    $data = array_map(array('DB', 'sanitize'), $data); 
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
        
        }
        
        return $data;
	}
    
	/**
	 * DB::filterData()
	 * 
	 * @param mixed $data
	 * @return
	 */
	public function filterData($data) {
	   
	   if($this->doFilterData) {
    
        	if (is_array($data)) {
        	    $data = array_map(array('DB', 'filterData'), $data); 
        	} else {
                // remove whitespaces (not a must though)
                $data = trim($data); 
                
                $replacements = array(
                    '\"' => '"',
                    "\'" => "'"
                );
                
                $data = str_replace(array_keys($replacements), array_values($replacements), $data);
        	}
        }
        
        return $data;
	}
    
    /**
     * DB::extractUnit()
     * 
     * @param mixed $string
     * @param mixed $start
     * @param mixed $end
     * @return
     */
    public function extractUnit($string, $start, $end) {
        
        $pos = stripos($string, $start);
        
        $str = substr($string, $pos);
        $str_two = substr($str, strlen($start));
        
        $second_pos = stripos($str_two, $end);    
        $str_three = substr($str_two, 0, $second_pos);
        
        $unit = trim($str_three); // remove whitespaces
        
        return $unit;
    }   
}
?>