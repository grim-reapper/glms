<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_patwarcircle extends CI_Model {
	 

	public function get_patwarcircle_list() 
	{  
	    $this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
	}
	public function get_patwarcircle_list_with_detail()
	{
	    
		$this->db->select("p.*,q.*,t.*");
		$this->db->from('tbl_property_patwarcircle as p');
		$this->db->join('tbl_property_qgoi as q','q.q_id = p.q_id','left');
		$this->db->join('tbl_property_tehsils as t','t.tehsil_id = p.tehsil_id','left');
		$this->db->order_by("t.tehsil_name", "ASC"); 
		$this->db->order_by("q.q_circle", "ASC"); 
		$this->db->order_by("p.patwar_circle", "ASC"); 
		$query = $this->db->get();
		return $query->result();
	}
	public function get_patwarcircle($p_id = 0)
	{
		$this->db->where("p_id", $p_id);
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->row();
		
    }
	public function patwarcircle_list_by_qanungoicircle() 
	{
		$qanungoi_id = $this->input->post("qanungoi_id");
                if($qanungoi_id==0)
                {
                    $this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
                }
                else {
		$this->db->where("q_id", $qanungoi_id);
		$this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
	}
        }
	
	public function patwarcircle_list_by_qanungoicircle_id($qanungoi_id) 
	{
		$this->db->where("q_id", $qanungoi_id);
		$this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
	}

   public function patwarcircle_list_by_tehsil_id($tehsil_id) 
	{
		
		$this->db->where("tehsil_id", $tehsil_id);
		$this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
	}

   public function update()
   { 
		$data = array(
				'q_id'	=> $this->input->post('q_id'), 
				'tehsil_id'	=> $this->input->post('tehsil_id'),
				'patwar_circle'	=> $this->input->post('patwar_circle')
				);
		
		$this->db->where("p_id",$this->input->post("p_id"));   
		$this->db->update('tbl_property_patwarcircle',$data);
   }
  public function add()
    {
		$data = array(
				'q_id'	=> $this->input->post('q_id'), 
				'tehsil_id'	=> $this->input->post('tehsil_id'),
				'patwar_circle'	=> $this->input->post('patwar_circle')
				); 
		$this->db->insert('tbl_property_patwarcircle',$data);
    }
    
    public function qgoicircle_list_by_tehsil() {
                
                $tehsil_id = $this->input->post("tehsil_id");
		if($tehsil_id==0)
                {
                $this->db->order_by("q_circle", "ASC"); 
		$query = $this->db->get('tbl_property_qgoi');
                return $query->result();                
                }
                else {
                $this->db->where("tehsil_id", $tehsil_id);
		$this->db->order_by("q_circle", "ASC"); 
		$query = $this->db->get('tbl_property_qgoi');
		return $query->result();
                }
               //  return $this->db->last_query();
    }
    public function ajax_patwarcircle_list()
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
                  else if($this->input->post('type')== 'subdiv') {
                       if($this->input->post('tehsil_id')!='')
			 {
                           $this->db->where('q.tehsil_id',$this->input->post('tehsil_id'));
			 } 
			 else
			 {
			    $this->db->where('q.tehsil_id !=',0); 
			 }
                  }
                  else if($this->input->post('type')== 'qgcircle') {
                       if($this->input->post('q_id')!='')
			 {
                           $this->db->where('p.q_id',$this->input->post('q_id'));
			 } 
			 else
			 {
			    $this->db->where('p.q_id !=',0); 
			 }
                  }
                        $this->db->select('*');		
			$this->db->from('tbl_property_patwarcircle as p');
			$this->db->join('tbl_property_qgoi as q','q.q_id=p.q_id','left');
			$this->db->join('tbl_property_tehsils as t','t.tehsil_id=q.tehsil_id','left');
			$this->db->join('tbl_property_districts as d', 'd.district_id = t.district_id','left');
                        $this->db->join('tbl_property_divisions as di', 'di.division_id= d.division_id','left');
                        $query = $this->db->get();
                        return $query->result();
}
	
}

?>