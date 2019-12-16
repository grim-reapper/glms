<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_dak extends CI_Model {
     var $gallery_path;
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/dak');
	}
//////////////////////////////// upload_file   //////////////////////////////////////////////		
	private function upload_file($file,$name)
	{
		  $config = array(
				'allowed_types' => '*',
				'upload_path' => $this->gallery_path,
				'max_size' => 2048 ,
				'file_name' => $name
			);
		  
			$this->load->library('upload');
			$this->upload->initialize($config);
			$this->upload->do_upload($file);
			$image_data = $this->upload->data();
			
			return $image_data["file_name"];
	}

  public function save()
  {
		$data = array(
				'subject'    	=> $this->input->post('subject'), 
				'puc'	        => $this->input->post('puc'),
				'note'	        => $this->input->post('note'),
				'signtory'	    => $this->input->post('signtory'),
				'is_fresh_dak'	=> 1,
				'is_dealt_dak'  => 0,
				'date'	        => now()
				); 
		$this->db->insert('tbl_dak_pad',$data);
		$dak_pad_id = $this->db->insert_id();
		
///----------------------------------------		
		
		$data = array(
				'file' => $this->upload_file('attach_file','dak_'.$dak_pad_id)
			   );
		$this->db->where('dak_pad_id',$dak_pad_id);
		$this->db->update('tbl_dak_pad',$data);

///----------------------------------------


			$data = array(
				'dak_pad_id'    	=>$dak_pad_id, 
				'addressee'	        => $this->input->post('addressee')
				); 
		$this->db->insert('tbl_dak_pad_note',$data);
  }
  

	public function get_fresh_dak_list() 
	{  
	    $this->db->order_by("dak_pad_id", "DESC"); 
		$this->db->where('is_fresh_dak',1);
		$this->db->where('is_dealt_dak',0);
		$query = $this->db->get('tbl_dak_pad');
		return $query->result();
	}
	
	public function get_dealt_dak_list() 
	{  
	    $this->db->order_by("dak_pad_id", "DESC"); 
		$this->db->where('is_fresh_dak',0);
		$this->db->where('is_dealt_dak',1);
		$query = $this->db->get('tbl_dak_pad');
		return $query->result();
	}
	public function get_archive_dak_list() 
	{  
	    $this->db->order_by("dak_pad_id", "DESC"); 
		$this->db->where('is_fresh_dak',0);
		$this->db->where('is_dealt_dak',0);
		$query = $this->db->get('tbl_dak_pad');
		return $query->result();
	}
	
	public function get_dak($dak_pad_id)
	{  
		$this->db->where('dak_pad_id',$dak_pad_id);
		$query = $this->db->get('tbl_dak_pad');
		return $query->row();
	}
	public function get_dak_note($dak_pad_id)
	{  
		$this->db->order_by("dak_pad_note_id", "ASC"); 
		$this->db->where('dak_pad_id',$dak_pad_id);
		$query = $this->db->get('tbl_dak_pad_note');
		return $query->result();
	}
		
   public function edit()
   { 
	   $data = array(
				'subject'    	=> $this->input->post('subject'), 
				'puc'	        => $this->input->post('puc'),
				'note'	        => $this->input->post('note'),
				'is_fresh_dak'	=> 1,
				'is_dealt_dak'  => 0
				); 
		
		$this->db->where("dak_pad_id",$this->input->post("dak_pad_id"));   
		$this->db->update('tbl_dak_pad',$data);
   }
   
   ///////////////////////////////////////////////
  public function update()
   { 
	   $data = array(
				'dak_pad_note'	         => $this->input->post('ac_note'),
				'dak_pad_note_date '     => now()
				);
	
		$this->db->where("dak_pad_note_id",$this->input->post("dak_pad_note_id"));   
		$this->db->update('tbl_dak_pad_note',$data);
  
 $data = array();
 if( $this->input->post('addressee') =='')
	   {
			 $data['is_fresh_dak'] = 0;
			 $data['is_dealt_dak'] = 1;
	   }
	   else
	   {
		 	 $data['is_fresh_dak'] = 1;
			 $data['is_dealt_dak'] = 0;     
	   }
	$this->db->where("dak_pad_id",$this->input->post("dak_pad_id"));   
	$this->db->update('tbl_dak_pad',$data);	
	
 if( $this->input->post('addressee') !='')
	   {
       	$data = array(
				'dak_pad_id'    	=>$this->input->post("dak_pad_id"), 
				'addressee'	        => $this->input->post('addressee')
				); 
		$this->db->insert('tbl_dak_pad_note',$data);
	
	   }	
	
   }
   
 public function add_note()
   { 
	   $data = array(
				'dak_pad_note'	         => $this->input->post('ac_note'),
				'dak_pad_note_date '     => now(),
				'addressee'	             => $this->input->post('signtory'),
				'dak_pad_id'	         => $this->input->post('dak_pad_id')
				);
		$this->db->insert('tbl_dak_pad_note',$data);
  
 $data = array();
 if( $this->input->post('addressee') =='')
	   {
			 $data['is_fresh_dak'] = 0;
			 $data['is_dealt_dak'] = 1;
	   }
	   else
	   {
		 	 $data['is_fresh_dak'] = 1;
			 $data['is_dealt_dak'] = 0;     
	   }
	$this->db->where("dak_pad_id",$this->input->post("dak_pad_id"));   
	$this->db->update('tbl_dak_pad',$data);	
	
 if( $this->input->post('addressee') !='')
	   {
       	$data = array(
				'dak_pad_id'    	=>$this->input->post("dak_pad_id"), 
				'addressee'	        => $this->input->post('addressee')
				); 
		$this->db->insert('tbl_dak_pad_note',$data);
	
	   }	
	
   }
   
   
 ////////////////////////////////////////////////////////////  
 
 public function make_archive($id)
 {
        $data['is_fresh_dak'] = 0;
		$data['is_dealt_dak'] = 0;	
		$this->db->where("dak_pad_id",$id);   
		$this->db->update('tbl_dak_pad',$data);	
 }
   

  
  public function delete($dak_pad_id)
  {
	$this->db->where('dak_pad_id',$dak_pad_id);
	$this->db->delete('tbl_dak_pad'); 
	
    $this->db->where('dak_pad_id',$dak_pad_id);
	$this->db->delete('tbl_dak_pad_note'); 
  }
}

?>