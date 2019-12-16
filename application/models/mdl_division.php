<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_division extends CI_Model {
	 
	public function get_division_list() 
	{
		  $this->db->order_by("division_name", "ASC"); 
		$query = $this->db->get('tbl_property_divisions');
		return $query->result();
	}
        public function get_province_list()
        {
                 $this->db->order_by("province_id", "ASC"); 
		$query = $this->db->get('tbl_property_province');
		return $query->result();
        }
	

	public function get_division_by_id($id=0) 
	{
		if($id==0  or $id == '')
		{
			redirect('divisions');
		}
		else
		{
                      $this->db->where("division_id", $id); 
			$query = $this->db->get('tbl_property_divisions');
			return $query->row();
		}
		
	}
	public function division_update() 
	{
           $data = array(
					 'division_name' => $this->input->post('division_name'),
					 'division_capital' => $this->input->post('division_capital'),
					 'division_area' => $this->input->post('division_area')
					
			   );
			$this->db->where("division_id", $this->input->post('division_id')); 
			$this->db->update('tbl_property_divisions', $data);
            
redirect('division');
	}

	public function get_division_add() 
	{
           $data = array(
					 'division_name' => $this->input->post('division_name'),
					 'division_area' => $this->input->post('division_area'),
					 'division_capital' => $this->input->post('division_capital'),
                                         'province_id' =>$this->input->post('p_id')
			   );
			$this->db->insert('tbl_property_divisions', $data);
            
	}
	public function division_delete($id)
	{
		    $this->db->where("division_id", $id); 
		    $this->db->delete('tbl_property_divisions');
            redirect('division');
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