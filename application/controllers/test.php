<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
 public function __construct()
  {
    parent::__construct();
	
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
	
 	if(!$this->mdl_sessions->is_login())
	 {
	   redirect('sessions/login');
	 }
  }

 public function msg($id)
	{
		    $list = json_decode(  
                           file_get_contents('http://www.meraylog.com/api/sms/property/id/'.$id.'/format/json')  
	                );  
      
           print_r( $list );	

	}
	
public function data()
{
    $this->load->model('mdl_litigation');
	$litigation =  $this->mdl_litigation->get_sms();
	echo "<pre>";
	print_r($litigation);
	echo "</pre>";
}

public function prop()
	{
		$this->db->where('status','Illegal Occupant');
		$query = $this->db->get("tbl_occupant");
		foreach($query->result() as $row)
		{
		   echo	$row->property_id."<br />";
		   $this->db->where('property_id',$row->property_id);
		   $data = array(
					  'occupation_type' => 'illegal_occupation'	 
				  );
		   $this->db->update("tbl_property",$data);
	    }
		
	}
 
}

