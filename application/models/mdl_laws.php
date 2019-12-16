<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_laws extends CI_Model {
     var $gallery_path;
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/laws');
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
			if($this->upload->do_upload($file))
                        {
			  $image_data = $this->upload->data();
                          $data = array(
                              'file_name' => $image_data["file_name"],
                              'condition' => 1                            
                          );                       
                        }
                      else
                       {
                         $data = array(                            
                                  'condition' => 0                            
                                 );   
                       }
			   return  $data;
	}

  public function save()
  {
		$data = array( 
				'law_title'             => $this->input->post('law_title'), 
				'law_category_id'       => $this->input->post('law_category_id'),
				'law_passing_date'	=> $this->input->post('passing_date'),
				'law_detail'	        => $this->input->post('law_detail'),
				); 
                
                
		$this->db->insert('tbl_laws',$data);
                $law_id =   $this->db->insert_id();
                
                $img_file = $this->upload_file('img_file','law_img_'.$law_id);
                if($img_file['condition'])
                {
                    $data2['img_file'] =  $img_file['file_name'];
                }
                
                $pdf_file = $this->upload_file('pdf_file','law_pdf_'.$law_id);
                if($pdf_file['condition'])
                {
                    $data2['pdf_file'] =  $pdf_file['file_name'];
                }
                
                $this->db->where("law_id",$law_id);   
		$this->db->update('tbl_laws',$data2);   
                
 }
  

	public function get_law_categories() 
	{  
		$query = $this->db->get('tbl_law_category');
		return $query->result();
	}
	
	public function get_law_by_categories($law_category_id=0) 
	{ 
	    if($law_category_id != 0)
		{
		  $this->db->where("law_category_id",$law_category_id);	
		} 
		$query = $this->db->get('tbl_laws');
		return $query->result();
	}
	public function get_law_by_id($law_id) 
	{ 
	         $this->db->where("law_id",$law_id);	
                 $this->db->select('*');
                 $this->db->from('tbl_laws as l');
                 $this->db->join('tbl_law_category as c','c.law_category_id = l.law_category_id','left');
		 $query = $this->db->get();
		return $query->row();
	}
	
   public function edit()
   { 
		$data = array( 
		                'law_title'         => $this->input->post('law_title'), 
				'law_category_id'   => $this->input->post('law_category_id'),
				'law_passing_date'  => $this->input->post('passing_date'),
				'law_detail'	    => $this->input->post('law_detail'),                    
				); 
		 $img_file = $this->upload_file('img_file','law_img_'.$this->input->post("law_id"));
                if($img_file['condition'])
                {
                    $data['img_file'] =  $img_file['file_name'];
                }
                
                $pdf_file = $this->upload_file('pdf_file','law_pdf_'.$this->input->post("law_id"));
                if($pdf_file['condition'])
                {
                    $data['pdf_file'] =  $pdf_file['file_name'];
                }
                
		$this->db->where("law_id",$this->input->post("law_id"));   
		$this->db->update('tbl_laws',$data);
   }
   

  
  public function delete($law_id)
  {
	$this->db->where('law_id',$law_id);
	$this->db->delete('tbl_laws'); 
  }
}

?>