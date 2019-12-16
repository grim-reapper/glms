<?php
class Pagination {

    public $main_url;
    public $all_query;
    public $max_results = 10;

    public function __construct($db) {
        $this->db = $db;
    }

    public function Generate() {

        // If current page number, use it 

        // if not, set one! 
        $page = (!isset($_GET['page'])) ? 1 : $_GET['page']; 


        // Define the number of results per page
        $max_results = $this->max_results; 

        // Figure out the limit for the query based 
        // on the current page number. 
        $from = (($page * $max_results) - $max_results);  

        // Figure out the total number of results in DB
        $total_results = $this->db->getCount($this->all_query); 

        // Set the limits per page
        $current_query = $this->all_query;
        $current_query .= " LIMIT ".$from.", ".$max_results;

        // Figure out the total number of pages. Always round up using ceil() 
        $total_pages = ceil($total_results / $max_results); 

        /* ------------- PAGINATION ------------- */

        if($total_pages > 1) {

            $query_string = $_SERVER['QUERY_STRING'].'&';
            
            parse_str($query_string, $new_query_string_array);

            unset($new_query_string_array['page']);

            $new_query_string = http_build_query($new_query_string_array, '', '&amp;');
            
            if($new_query_string != '') $new_query_string .= '&amp;';

            $pagination = '';

        	// Build Previous Link 
        	if($page > 1){ 
        		$prev = ($page - 1);
        		$pagination .= '<a href="'.$this->main_url.'?'.$new_query_string.'page='.$prev.'">&laquo; '.$lang_text['previous'].'</a>&nbsp;'; 
        	} else {
        		$pagination .= '<span class="disabled">&laquo; '.$lang_text['previous'].'</span>&nbsp;';
        	}

        	for($i = 1; $i <= $total_pages; $i++){ 
        		if(($page) == $i){ 
        			$pagination .= '<span class="current">'.$i.'</span>&nbsp;'; 
                } else { 
        			$pagination .= "<a href=\"".$this->main_url."?".$new_query_string."page=$i\">$i</a>&nbsp;"; 
        		} 
        	} 

        	// Build Next Link 

        	if($page < $total_pages){ 
        		$next = ($page + 1); 
        		$pagination .= "<a href=\"".$this->main_url."?".$new_query_string."page=$next\">".$lang_text['next']." &raquo;</a>&nbsp;"; 
        	} else {
        		$pagination .= '<span class="disabled">'.$lang_text['next'].' &raquo;</span>&nbsp;';     
        	}
        }  
        return array('pagination' => $pagination, 'current_query' => $current_query);
    }
}
?>