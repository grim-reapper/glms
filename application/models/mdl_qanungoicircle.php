<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_qanungoicircle extends CI_Model {
	 
	public function get_qanungoicircle_list() 
	{
		$this->db->order_by("q_circle", "ASC"); 
		$query = $this->db->get('tbl_property_qgoi');
		return $query->result();
	}
	
   public function get_qanungoicircle($q_id = 0) 
	{
		$this->db->where('q_id',$q_id);
        $query = $this->db->get('tbl_property_qgoi');
		return $query->row();
	} 
	
   public function get_qanungoicircle_list_with_qgoi($tehsil_id=0) 
	{
		$this->db->order_by("t.tehsil_name", "ASC"); 
		$this->db->select("q.*,t.*");
		$this->db->from('tbl_property_qgoi as q');
		$this->db->join('tbl_property_tehsils as t', 't.tehsil_id = q.tehsil_id');
		$query = $this->db->get();
		
		return $query->result();
	} 
	
	public function qanungoicircle_list_by_tehsil() 
	{
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
        }
 	public function qanungoicircle_list_by_tehsil_id($tehsil_id) 
	{
		$this->db->where("tehsil_id", $tehsil_id);
		$this->db->order_by("q_circle", "ASC"); 
		$query = $this->db->get('tbl_property_qgoi');
		return $query->result();
	}
	
   public function add()
   {
	$data = array(
				'q_circle'	=> $this->input->post('q_circle'), 
				'tehsil_id'	=> $this->input->post('tehsil_id'),
				);
	$this->db->insert('tbl_property_qgoi',$data);
   }
   
   public function update()
   { 
		$data = array(
				'q_circle'	=> $this->input->post('q_circle'), 
				'tehsil_id'	=> $this->input->post('tehsil_id'),
				);
		
		$this->db->where("q_id",$this->input->post("q_id"));   
		$this->db->update('tbl_property_qgoi',$data);
   }
    public function ajax_qanungoicircle_list()
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
                        $this->db->select('*');		
			$this->db->from('tbl_property_qgoi as q');
			$this->db->join('tbl_property_tehsils as t','t.tehsil_id=q.tehsil_id');
			$this->db->join('tbl_property_districts as d', 'd.district_id = t.district_id','left');
                        $this->db->join('tbl_property_divisions as di', 'di.division_id= d.division_id','left');
                        $query = $this->db->get();
                         return $query->result();
}
         public function tehsil_list_by_district() 
	{
		$district_id = $this->input->post("district_id");
                if($district_id==0)
                {
                    $this->db->order_by("tehsil_name", "ASC"); 
		$query = $this->db->get('tbl_property_tehsils');
		return $query->result();
                }
                else {
		$this->db->where("district_id", $district_id);
		$this->db->order_by("tehsil_name", "ASC"); 
		$query = $this->db->get('tbl_property_tehsils');
		return $query->result();
                }
	}
   
 
   
}

?>