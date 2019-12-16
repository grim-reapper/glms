<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_districts extends CI_Model {
	 
	public function get_districts_list() 
	{
		$this->db->order_by("d.district_name", "ASC"); 
                $this->db->select("*");
		$this->db->from('tbl_property_districts as d');
		$this->db->join('tbl_property_divisions as di', 'd.division_id = di.division_id');
                
		$query = $this->db->get();
		
		return $query->result();
	}
        public function division_list() 
	{
		$this->db->where('status', 1);
		$this->db->order_by("division_id", "ASC"); 
		$query = $this->db->get('tbl_property_divisions');
		return $query->result();
	}
	

	public function get_districts_by_id($id=0) 
	{
		if($id==0  or $id == '')
		{
			redirect('districts');
		}
		else
		{
			$this->db->where("district_id", $id); 
			$query = $this->db->get('tbl_property_districts');
			return $query->row();
		}
		
	}
	public function districts_update() 
	{
           $data = array(
					 'district_name' => $this->input->post('district_name'),
					 'district_code' => $this->input->post('district_code')
			   );
			$this->db->where("district_id", $this->input->post('district_id')); 
			$this->db->update('tbl_property_districts', $data);
            redirect('districts');

	}

	public function districts_add() 
	{
            
           $data = array(
					 'district_name' => $this->input->post('district_name'),
                                         'division_id' => $this->input->post('D_id'),
                                         'district_code' => $this->input->post('district_code')
                                         
                                          
			   );
			$this->db->insert('tbl_property_districts', $data);
            redirect('districts');
	}
	public function districts_delete($id)
	{
		    $this->db->where("district_id", $id); 
		    $this->db->delete('tbl_property_districts');
            redirect('districts');
    }
    public function get_ajax_property_list()
	{
		
			if($this->input->post('division_id')!=''){
			  $this->db->where('d.division_id',$this->input->post('division_id') );
			}
			else
			{
			  $this->db->where('d.division_id !=',0); 
			}
		  
		  
		  
          $this->db->select('*');
			
			$this->db->from('tbl_property_districts as di');
			$this->db->join('tbl_property_divisions as d', 'd.division_id = di.division_id','left');
			$query = $this->db->get();
                return $query->result();
		
	}	
	
/*	public function filter_subdivision_list() 
	{
		$tehsil_id = $this->input->post("tehsil_id");
		$this->db->where("tehsil_id", $tehsil_id);
		$this->db->order_by("q_circle", "ASC"); 
		$query = $this->db->get('tbl_property_qgoi');
		$data['qgoi_list'] = $query->result();
		
		
	    $this->db->select('p.property_id , p.area_kanal, p.area_marla, p.area_sqft, o.occupant_id , o.name, o.parentage,o.land_use ,       o.status_of_occupant , o.mob_number, m.mauza_id, m.mouza_name');
			
		$this->db->from('tbl_property as p');
		$this->db->join('tbl_occupant as o', 'o.property_id = p.property_id','left');
		$this->db->join('tbl_property_mauza as m', 'm.mauza_id = p.mauza_id','left');
		$this->db->join('tbl_property_tehsils as t', 't.tehsil_id = p.tehsil_id','left');
		$this->db->where('p.tehsil_id',$tehsil_id);
	   $query = $this->db->get();
       $data['property'] = $query->result();
		return $data;
		
	}*/
}

?>