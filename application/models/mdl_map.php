<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_map extends CI_Model {
    
	function __construct()
	{
		parent::__construct();
	}
 public function get_property_position($propery_id)
 {
    $this->db->select("latitude,longitude,locality");
    $this->db->where("property_id",$propery_id); 
	$query = $this->db->get('tbl_property');
			
	 if ($query->num_rows() > 0)
	 {
	   return $row = $query->row();
	 }
	 else
	 {
		 return false;
	 }	
 }

public function update_map_marker()
{
	if($this->input->post("latitude") !="" || $this->input->post("longitude") !="" )
	{
  	$data = array(
			'latitude'=> $this->input->post("latitude"),  
			'longitude'=> $this->input->post("longitude")
			);
    $this->db->where('property_id',$this->input->post("property_id"));
	$this->db->update("tbl_property",$data);
	 return 1;
	}
	else
	{
	  return 0;
	}
}

}

?>