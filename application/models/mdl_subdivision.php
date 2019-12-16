<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_subdivision extends CI_Model {
	 
	public function get_subdivision_list() 
	{
		$this->db->order_by("t.tehsil_name", "ASC"); 
                $this->db->select("*");
		$this->db->from('tbl_property_tehsils as t');
		$this->db->join('tbl_property_districts as d', 'd.district_id = t.district_id');
                
		$query = $this->db->get();
		return $query->result();
	}
	

	public function get_subdivision_by_id($id=0) 
	{
		if($id==0  or $id == '')
		{
			redirect('subdivision');
		}
		else
		{
			$this->db->where("tehsil_id", $id); 
			$query = $this->db->get('tbl_property_tehsils');
			return $query->row();
		}
		
	}
	public function get_subdivision_update() 
	{
           $data = array(
					 'tehsil_name' => $this->input->post('tehsil_name')
			   );
			$this->db->where("tehsil_id", $this->input->post('tehsil_id')); 
			$this->db->update('tbl_property_tehsils', $data);
            redirect('subdivision');

	}

	public function get_subdivision_add() 
	{
           $data = array(
					 'tehsil_name' => $this->input->post('tehsil_name'),
                                         'district_id' => $this->input->post('d_id')
			   );
			$this->db->insert('tbl_property_tehsils', $data);
            redirect('subdivision');
	}
	public function subdivision_delete($id)
	{
		    $this->db->where("tehsil_id", $id); 
		    $this->db->delete('tbl_property_tehsils');
                    redirect('subdivision');
        }
        public function division_list() 
	{
		$this->db->where('status', 1);
		$this->db->order_by("division_id", "ASC"); 
		$query = $this->db->get('tbl_property_divisions');
		return $query->result();
	}
        public function district_list() 
	{
		$this->db->order_by("district_id", "ASC"); 
		$query = $this->db->get('tbl_property_districts');
		return $query->result();
	}
	
         public function get_ajax_list()
	{
              if($this->input->post('type')== 'div')
		  {
		
			if($this->input->post('division_id')!=''){
			  $this->db->where('di.division_id',$this->input->post('division_id') );
			}
			else
			{
			  $this->db->where('di.division_id !=',0); 
			}
                  }
                  else if( $this->input->post('type')== 'dist') {
                       if($this->input->post('district_id')!='')
			 {
                $this->db->where('t.district_id',$this->input->post('district_id'));
			 } 
			 else
			 {
			    $this->db->where('t.district_id !=',0); 
			 }
                  }
             
                        $this->db->select('*');		
			$this->db->from('tbl_property_tehsils as t');
			$this->db->join('tbl_property_districts as d', 'd.district_id = t.district_id','left');
                        $this->db->join('tbl_property_divisions as di', 'di.division_id= d.division_id','left');
                       
			$query = $this->db->get();
                return $query->result();
		
	}
        public function district_list_by_division() 
	{
		$division_id = $this->input->post("division_id");
                
                if($division_id==0)
                {
                $this->db->order_by("district_name", "ASC"); 
		$query = $this->db->get('tbl_property_districts');
		return $query->result();
                }
                else {
		$this->db->where("division_id", $division_id);
		$this->db->order_by("district_name", "ASC"); 
		$query = $this->db->get('tbl_property_districts');
		return $query->result();
                }
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