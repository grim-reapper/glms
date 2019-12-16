<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_mauza extends CI_Model {
    
    
     public $gallery_path;
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');

	}
//////////////////////////////// upload_file   //////////////////////////////////////////////		
	private function upload_file($file,$name,$overwrite=false)
	{
		  $config = array();
		  $config = array(
				'allowed_types' => '*',
				'upload_path' => $this->gallery_path,
				'max_size' => 2048 ,
				'file_name' => $name,
				'overwrite' => $overwrite
			);
		  
		
			$this->load->library('upload');
			$this->upload->initialize($config);
			$this->upload->do_upload($file);
			$image_data = $this->upload->data();
			
			return $image_data["file_name"];
			$image_data = array();
	}
	
	 

	public function get_mauza_list() 
	{
		$this->db->order_by("mouza_name", "ASC"); 
		$query = $this->db->get('tbl_property_mauza');
		return $query->result();
	}
    public function mauza_list_by_patwarcircle() 
	{
		$patwar_circle_id = $this->input->post("patwar_circle_id");
                if($patwar_circle_id==0)
                {
                $this->db->order_by("mouza_name", "ASC"); 
		$query = $this->db->get('tbl_property_mauza');
		return $query->result();
                }
                else {
		$this->db->where("p_id", $patwar_circle_id);
		$this->db->order_by("mouza_name", "ASC"); 
		$query = $this->db->get('tbl_property_mauza');
		return $query->result();
	}
        }
  public function mauza_list_by_patwarcircle_id($patwar_circle_id) 
	{
		$this->db->where("p_id", $patwar_circle_id);
		$this->db->order_by("mouza_name", "ASC"); 
		$query = $this->db->get('tbl_property_mauza');
		return $query->result();
	}
	
  public function mauza_list_by_tehsil_id($tehsil_id) 
	{
		$this->db->where("tehsil_id", $tehsil_id);
		$this->db->order_by("mouza_name", "ASC"); 
		$query = $this->db->get('tbl_property_mauza');
		return $query->result();
	}
	
    public function mauza_list_by_q_id($q_id) 
	{
		$this->db->where("q_id", $q_id);
		$this->db->order_by("mouza_name", "ASC"); 
		$query = $this->db->get('tbl_property_mauza');
		return $query->result();
	}

   public function get_mauza_list_with_detail()
	{
	    
		$this->db->select("m.*,p.*,q.*,t.*");
		$this->db->from('tbl_property_mauza as m');
		$this->db->join('tbl_property_patwarcircle as p','p.p_id = m.p_id','left');
		$this->db->join('tbl_property_qgoi as q','q.q_id = m.q_id','left');
		$this->db->join('tbl_property_tehsils as t','t.tehsil_id = m.tehsil_id','left');
		$this->db->order_by("t.tehsil_name", "ASC"); 
		$this->db->order_by("q.q_circle", "ASC"); 
		$this->db->order_by("p.patwar_circle", "ASC"); 
		$this->db->order_by("m.mouza_name", "ASC"); 
		$query = $this->db->get();
		return $query->result();
	}
   public function get_mauza($mauza_id = 0)
   {
	   	$this->db->where('mauza_id',$mauza_id);
		$query = $this->db->get('tbl_property_mauza');
		return $query->row();
	   
   }
   
   public function update()
   { 
		$new2 = array();
            $c= $this->input->post('education_counter');
            for($i=1; $i<= $c; $i++) 
            {
             $new2[]=$this->input->post('education_'.$i); 
            }
            $Educational_institute= serialize(array_filter($new2));

            ////////////////////////////////////////
            $new3 = array();
            $c1= $this->input->post('Hospitals_counter');
            for($i=1; $i<= $c1; $i++) 
            {
             $new3[]=$this->input->post('Hospitals_'.$i); 
            }
            $Hospitals= serialize(array_filter($new3));
            ///////////////////////////////////////////
            $new4 = array();
            $c2= $this->input->post('markets_counter');
            for($i=1; $i<= $c2; $i++) 
            {
             $new4[]=$this->input->post('markets_'.$i); 
            }
            $markets= serialize(array_filter($new4));
            ///////////////////////////////////////////
            $new5 = array();
            $c3= $this->input->post('roads_counter');
            for($i=1; $i<= $c3; $i++) 
            {
             $new5[]=$this->input->post('roads_'.$i); 
            }
            $roads= serialize(array_filter($new5));
            ///////////////////////////////////////////
            $new6 = array();
            $c4= $this->input->post('Asites_counter');
            for($i=1; $i<= $c4; $i++) 
            {
             $new6[]=$this->input->post('Asites_'.$i); 
            }
            $Archelogical_sites= serialize(array_filter($new6));
            ///////////////////////////////////////////
            $new7 = array();
            $c5= $this->input->post('industries_counter');
            for($i=1; $i<= $c5; $i++) 
            {
             $new7[]=$this->input->post('industries_'.$i); 
            }
            $industries= serialize(array_filter($new7));
            ///////////////////////////////////////////
            $new8 = array();
            $c6= $this->input->post('randc_counter');
            for($i=1; $i<= $c6; $i++) 
            {
             $new8[]=$this->input->post('randc_'.$i); 
            }
            $river_and_canals= serialize(array_filter($new8));
            ///////////////////////////////////////////
            $new9 = array();
            $c7= $this->input->post('others_counter');
            for($i=1; $i<= $c7; $i++) 
            {
             $new9[]=$this->input->post('others_'.$i); 
            }
            $others= serialize(array_filter($new9));
            ///////////////////////////////////////////
            $male=$this->input->post('Male');
            $female=  $this->input->post('Female');
      
		$data = array(
			'q_id'	=> $this->input->post('q_id'), 
			'tehsil_id'	=> $this->input->post('tehsil_id'),
			'p_id'	=> $this->input->post('p_id'),
			'mouza_name'	=> $this->input->post('mauza_name'),
			'fts_in_one_marla'	=> $this->input->post('fts_in_one_marla'),
			'hadbast'	=> $this->input->post('hadbast'),
                            'measurement_system' => $this->input->post('kishtwari_Square'),
                            'rural_urban' => $this->input->post('rural_urban'),
                            'BAC' => $this->input->post('BAC'),
                            'khasra_square_no' => $this->input->post('khasra_square_no'),
                            'Male' => $this->input->post('Male'),
                            'Female' => $this->input->post('Female'),
                            'total' => $male+$female,
                            'short_history' => $this->input->post('short_history'),
                            'educational_institute' => $Educational_institute,
                            'Hospitals' => $Hospitals,
                            'Markets' => $markets,
                            'Roads' => $roads,
                            'Archeological_Sites' => $Archelogical_sites,
                            'Industries' => $industries,
                            'Rivers_Canals' => $river_and_canals,
                            'others' => $others,
                            'events_festivals' => $this->input->post('events_fest'),
                            'celebrities' => $this->input->post('celebrities'),
                            'lambardras' => $this->input->post('lambardras'),
                            'contact_no' => $this->input->post('Contact_no'),
                            'na_no' => $this->input->post('na_no'),
                            'pp_no' => $this->input->post('pp_no'),
                            'electricity' => $this->input->post('electric_meter'),
                            'sui_gas' => $this->input->post('sui_gas'),
                            'water_supply' => $this->input->post('water_supply'),
                            'uc_no' => $this->input->post('uc'),
                            'police_station' => $this->input->post('ps'),
                            'latitude' => $this->input->post('latitude'),
                            'longitude' => $this->input->post('longitude')
			);
		if(!empty($_FILES['Massive_picture']['tmp_name'])){
			$data['massive_uploads'] = $this->upload_file('Massive_picture','Massive_picture_pic');

		}
		if(!empty($_FILES['Photos']['tmp_name'])){
        	$data['photos'] = $this->upload_file('Photos' ,'photos_pic_');
	    }
	    if(!empty($_FILES['Document']['tmp_name'])){
	        $data['documents'] = $this->upload_file('Document' ,'document_');
	    }
	    if(!empty($_FILES['index_map']['tmp_name'])){
	        $data['index_map'] = $this->upload_file('index_map' ,'index_map_');
	    }
	    
		$this->db->where("mauza_id",$this->input->post("mauza_id"));   
		$this->db->update('tbl_property_mauza',$data);
   }
  public function save()
  {
          
            $new2 = array();
            $c= $this->input->post('education_counter');
            for($i=1; $i< $c; $i++) 
            {
             $new2[]=$this->input->post('education_'.$i); 
            }
            $Educational_institute= serialize(array_filter($new2));
            ////////////////////////////////////////
            $new3 = array();
            $c1= $this->input->post('Hospitals_counter');
            for($i=1; $i< $c1; $i++) 
            {
             $new3[]=$this->input->post('Hospitals_'.$i); 
            }
            $Hospitals= serialize(array_filter($new3));
            ///////////////////////////////////////////
            $new4 = array();
            $c2= $this->input->post('markets_counter');
            for($i=1; $i< $c2; $i++) 
            {
             $new4[]=$this->input->post('markets_'.$i); 
            }
            $markets= serialize(array_filter($new4));
            ///////////////////////////////////////////
            $new5 = array();
            $c3= $this->input->post('roads_counter');
            for($i=1; $i< $c3; $i++) 
            {
             $new5[]=$this->input->post('roads_'.$i); 
            }
            $roads= serialize(array_filter($new5));
            ///////////////////////////////////////////
            $new6 = array();
            $c4= $this->input->post('Asites_counter');
            for($i=1; $i< $c4; $i++) 
            {
             $new6[]=$this->input->post('Asites_'.$i); 
            }
            $Archelogical_sites= serialize(array_filter($new6));
            ///////////////////////////////////////////
            $new7 = array();
            $c5= $this->input->post('industries_counter');
            for($i=1; $i< $c5; $i++) 
            {
             $new7[]=$this->input->post('industries_'.$i); 
            }
            $industries= serialize(array_filter($new7));
            ///////////////////////////////////////////
            $new8 = array();
            $c6= $this->input->post('randc_counter');
            for($i=1; $i< $c6; $i++) 
            {
             $new8[]=$this->input->post('randc_'.$i); 
            }
            $river_and_canals= serialize(array_filter($new8));
            ///////////////////////////////////////////
            $new9 = array();
            $c7= $this->input->post('others_counter');
            for($i=1; $i< $c7; $i++) 
            {
             $new9[]=$this->input->post('others_'.$i); 
            }
            $others= serialize(array_filter($new9));
            ///////////////////////////////////////////
            $male=$this->input->post('Male');
            $female=  $this->input->post('Female');
      
          
  {
		$data = array(
				'q_id'	=> $this->input->post('q_id'), 
				'tehsil_id'	=> $this->input->post('tehsil_id'),
				'p_id'	=> $this->input->post('p_id'),
				'mouza_name'	=> $this->input->post('mauza_name'),
				'fts_in_one_marla'	=> $this->input->post('fts_in_one_marla'),
				'hadbast'	=> $this->input->post('hadbast'),
                                'measurement_system' => $this->input->post('kishtwari_Square'),
                                'rural_urban' => $this->input->post('rural_urban'),
                                'BAC' => $this->input->post('BAC'),
                                'khasra_square_no' => $this->input->post('khasra_square_no'),
                                'Male' => $this->input->post('Male'),
                                'Female' => $this->input->post('Female'),
                                'total' => $male+$female,
                                'short_history' => $this->input->post('short_history'),
                                'educational_institute' => $Educational_institute,
                                'Hospitals' => $Hospitals,
                                'Markets' => $markets,
                                'Roads' => $roads,
                                'Archeological_Sites' => $Archelogical_sites,
                                'Industries' => $industries,
                                'Rivers_Canals' => $river_and_canals,
                                'others' => $others,
                                'events_festivals' => $this->input->post('events_fest'),
                                'celebrities' => $this->input->post('celebrities'),
                                'lambardras' => $this->input->post('lambardras'),
                                'contact_no' => $this->input->post('Contact_no'),
                                'na_no' => $this->input->post('na_no'),
                                'pp_no' => $this->input->post('pp_no'),
                                'electricity' => $this->input->post('electric_meter'),
                                'sui_gas' => $this->input->post('sui_gas'),
                                'water_supply' => $this->input->post('water_supply'),
                                'uc_no' => $this->input->post('uc'),
                                'police_station' => $this->input->post('ps'),
                                'latitude' => $this->input->post('latitude'),
                                'longitude' => $this->input->post('longitude')
				);
		
		if(!empty($_FILES['Massive_picture']['tmp_name'])){
			$data['massive_uploads'] = $this->upload_file('Massive_picture','Massive_picture_pic');

		}
		if(!empty($_FILES['Photos']['tmp_name'])){
        	$data['photos'] = $this->upload_file('Photos' ,'photos_pic_');
	    }
	    if(!empty($_FILES['Document']['tmp_name'])){
	        $data['documents'] = $this->upload_file('Document' ,'document_');
	    }
	    if(!empty($_FILES['index_map']['tmp_name'])){
	        $data['index_map'] = $this->upload_file('index_map' ,'index_map_');
	    }
		
		$this->db->insert('tbl_property_mauza',$data);
  }
  }
  
  public function get_tehsil_etc_by_mauza($mauza_id = 0)
   {
	    $data  = array();
	    $this->db->where('mauza_id',$mauza_id);
		$query = $this->db->get('tbl_property_mauza');
		$m = $query->row();
		
	   	$this->db->where('p_id',$m->p_id);
		$query = $this->db->get('tbl_property_patwarcircle');
		$p = $query->row();
		$data["patwarcircle"] = $p->patwar_circle;
		$this->db->where('q_id',$m->q_id);
		$query = $this->db->get('tbl_property_qgoi');
		$q = $query->row();
		$data["q_circle"] = $q->q_circle;
		$this->db->where('tehsil_id',$m->tehsil_id);
		$query = $this->db->get('tbl_property_tehsils');
		$t = $query->row();
		$data["tehsils"] = $t->tehsil_name;
	   return $data;
   }
   
   public function ajax_mauza_list(){
       
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
                  else if($this->input->post('type')== 'patwar') {
                       if($this->input->post('p_id')!='')
			 {
                           $this->db->where('m.p_id',$this->input->post('p_id'));
			 } 
			 else
			 {
			    $this->db->where('m.p_id !=',0); 
			 }
                  }
                        $this->db->select('*');		
			$this->db->from('tbl_property_mauza as m');
			$this->db->join('tbl_property_patwarcircle as p','p.p_id=m.p_id','left');
			$this->db->join('tbl_property_qgoi as q','q.q_id=p.q_id','left');
			$this->db->join('tbl_property_tehsils as t','t.tehsil_id=q.tehsil_id','left');
			$this->db->join('tbl_property_districts as d', 'd.district_id = t.district_id','left');
                        $this->db->join('tbl_property_divisions as di', 'di.division_id= d.division_id','left');
                        $query = $this->db->get();
                        return $query->result();
       
   }
   
   public function patwar_list_by_qgoi()
   {
                $q_id = $this->input->post("q_id");
                if($q_id==0)
                {
                $this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
                }
                else{
		$this->db->where("q_id", $q_id);
		$this->db->order_by("patwar_circle", "ASC"); 
		$query = $this->db->get('tbl_property_patwarcircle');
		return $query->result();
                }
   }
    public function mauza_detail($id)
  {
	 		$this->db->select('*');
			$this->db->from('tbl_property_mauza as m');
			$this->db->join('tbl_property_patwarcircle as p', 'p.p_id = m.p_id','left');
			$this->db->join('tbl_property_qgoi as q', 'q.q_id = m.q_id','left');
			$this->db->join('tbl_property_tehsils as t', 't.tehsil_id = m.tehsil_id','left');
			$this->db->where('m.mauza_id',$id);
			$query = $this->db->get();

		return $query->row(); 
  }
   
}

?>