<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_judicial_cases extends CI_Model {
    
     var $gallery_path;
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');

	}
    
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
	


        
    public function get_cases()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->join('tbl_fate_of_cases as f','f.fate_case_id=c.fate_case_id','left')
                ->where('c.fate_case_id',0)
                ->get()
                ->result();
        
    }
//    public function get_cases_count()
//    {
//        return $this->db->select("count(case_id) as total")
//                ->from('tbl_judicail_cases')
//                ->where('fate_case_id',0)
//                ->get()
//                ->row();
//        
//    }
    public function get_cases_date()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->join('tbl_fate_of_cases as f','f.fate_case_id=c.fate_case_id','left')
                ->where('c.fate_case_id',0)
                ->where('date_of_hearing',$this->session->userdata('selected_date'))
                ->get()
                ->result();
        
    }
//    public function get_cases_date_count()
//    {
//        return $this->db->select("*")
//                ->from('tbl_judicail_cases as c')
//                ->where('date_of_hearing',$this->session->userdata('selected_date'))
//                ->where('fate_case_id',0)
//                ->get()
//                ->result();
//        
//    }

    

    public function get_cases_title()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_tittle')
                ->get()
                ->result();        
    }
    public function get_cases_proceedings()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_proceedings')
                ->get()
                ->result();        
    }
    
    public function save_case()
    {
        $data=array(
            
           'case_no'                  => $this->input->post('case_no'),
            'mauza_id'                => $this->input->post('mauza'),
            'case_tittle_id'          => $this->input->post('case_title'),
            'proceedings_id'          => $this->input->post('case_proceedings'),
            'suing_party_name'        => $this->input->post('suing_party'),
            'suing_counsel'           => $this->input->post('suing_counsel'),
            'suing_contact'           => $this->input->post('suing_contact'),
            'defending_party_name'    => $this->input->post('defending_party'),
            'defending_party_counsel' => $this->input->post('defending_counsel'),
            'defending_contact'       => $this->input->post('defending_contact'),
            'date_of_institution'     => date("Y-m-d",strtotime($this->input->post('date_institution'))),
            'date_of_hearing'         => date("Y-m-d",strtotime($this->input->post('date_hearing'))),
            'priority'                => $this->input->post('Priority'),
            'district_id'             =>$this->session->userdata('selected_district_rev'),
            'court_category_id'       =>$this->session->userdata('selected_court_rev'),
            'fate_case_id'            => 0,
            'Notes'                   => $this->input->post('note')
             
        );
         $this->db->insert('tbl_judicail_cases', $data);
    }
    
    public function update()
    {
         $data=array(
            
           'case_no'                  => $this->input->post('case_no'),
            'mauza_id'                => $this->input->post('mauza'),
            'case_tittle_id'          => $this->input->post('case_title'),
            'proceedings_id'          => $this->input->post('case_proceedings'),
            'suing_party_name'        => $this->input->post('suing_party'),
            'suing_counsel'           => $this->input->post('suing_counsel'),
            'suing_contact'           => $this->input->post('suing_contact'),
            'defending_party_name'    => $this->input->post('defending_party'),
            'defending_party_counsel' => $this->input->post('defending_counsel'),
            'defending_contact'       => $this->input->post('defending_contact'),
            'date_of_institution'     => date("Y-m-d",strtotime($this->input->post('date_institution'))),
            'date_of_hearing'         => date("Y-m-d",strtotime($this->input->post('date_hearing'))),
            'priority'                => $this->input->post('Priority'),
            'fate_case_id'            =>$this->input->post('fate_case'),
            'Notes'                   => $this->input->post('note')
             
        );
                $this->db->where("case_id",$this->input->post("case_id"));   
		$this->db->update('tbl_judicail_cases',$data);
        
    }
    public function update_file()
    {
         $data=array(
            
            'case_no'                  => $this->input->post('case_no'),
            'mauza_id'                => $this->input->post('mauza'),
            'case_tittle_id'          => $this->input->post('case_title'),
            'proceedings_id'          => $this->input->post('case_proceedings'),
            'suing_party_name'        => $this->input->post('suing_party'),
            'suing_counsel'           => $this->input->post('suing_counsel'),
            'suing_contact'           => $this->input->post('suing_contact'),
            'defending_party_name'    => $this->input->post('defending_party'),
            'defending_party_counsel' => $this->input->post('defending_counsel'),
            'defending_contact'       => $this->input->post('defending_contact'),
            'date_of_institution'     => date("Y-m-d",strtotime($this->input->post('date_institution'))),
            'date_of_hearing'         => date("Y-m-d",strtotime($this->input->post('date_hearing'))),
            'priority'                => $this->input->post('Priority'),
            'fate_case_id'            =>$this->input->post('fate_case'),
            'Notes'                   => $this->input->post('note')
             
        );
                $this->db->where("case_id",$this->input->post("case_id"));   
		$this->db->update('tbl_judicail_cases',$data);
        
    }
    
    public function save_decided_case()
    {
         $data=array(
            
           'case_no'                  => $this->input->post('case_no'),
            'mauza_id'                => $this->input->post('mauza'),
            'case_tittle_id'          => $this->input->post('case_title'),
            'proceedings_id'          => $this->input->post('case_proceedings'),
            'suing_party_name'        => $this->input->post('suing_party'),
            'suing_counsel'           => $this->input->post('suing_counsel'),
            'suing_contact'           => $this->input->post('suing_contact'),
            'defending_party_name'    => $this->input->post('defending_party'),
            'defending_party_counsel' => $this->input->post('defending_counsel'),
            'defending_contact'       => $this->input->post('defending_contact'),
            'date_of_institution'     => date("Y-m-d",strtotime($this->input->post('date_institution'))),
            'date_of_hearing'         => date("Y-m-d",strtotime($this->input->post('date_hearing'))),
            'priority'                => $this->input->post('Priority'),
            'district_id'             =>$this->session->userdata('selected_district_rev'),
            'court_category_id'       =>$this->session->userdata('selected_court_rev'),
            'fate_case_id'            => $this->input->post('decided_fate'),
            'Notes'                   => $this->input->post('note')
             
        );
         $this->db->insert('tbl_judicail_cases', $data);
        
    }
    public function update_decided_case()
    {
        $data=array(
            
            'case_no'                  => $this->input->post('case_no'),
            'mauza_id'                => $this->input->post('mauza'),
            'case_tittle_id'          => $this->input->post('case_title'),
            'proceedings_id'          => $this->input->post('case_proceedings'),
            'suing_party_name'        => $this->input->post('suing_party'),
            'suing_counsel'           => $this->input->post('suing_counsel'),
            'suing_contact'           => $this->input->post('suing_contact'),
            'defending_party_name'    => $this->input->post('defending_party'),
            'defending_party_counsel' => $this->input->post('defending_counsel'),
            'defending_contact'       => $this->input->post('defending_contact'),
            'date_of_institution'     => date("Y-m-d",strtotime($this->input->post('date_institution'))),
            'date_of_hearing'         => date("Y-m-d",strtotime($this->input->post('date_hearing'))),
            'priority'                => $this->input->post('Priority'),
            'fate_case_id'            =>$this->input->post('fate_case'),
            'Notes'                   => $this->input->post('note')
             
        );
                $this->db->where("case_id",$this->input->post("case_id"));   
		$this->db->update('tbl_judicail_cases',$data);
        
    }

    public function case_delete($id)
    {
        $this->db->where("case_id", $id);
        $this->db->delete('tbl_judicail_cases');
        redirect('judicial_cases');
    }
    public function case_decided_delete($id)
    {
         $this->db->where("case_id", $id);
        $this->db->delete('tbl_judicail_cases');
        redirect('decided_cases');
        
    }

        public function case_by_date()
    {
        if($this->input->post('date')== NULL)
        {
         return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->get()
                ->result();
        
            
        }
        else
        {
       return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->join('tbl_fate_of_cases as f','f.fate_case_id=c.fate_case_id','left')
                ->where('date_of_hearing',$this->input->post('date'))
                ->where('c.fate_case_id',0)
               
                ->get()
                ->result();
        }
    }
    
    public function get_case_by_id($id)
    {
         return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->where('case_id',$id)
                ->get()
                ->row();
        
    }
    
    public function get_list_by_tehsil()
    {
         if($this->input->post('tehsil_id')== 0)
        {
             return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                //->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left')
                ->join('tbl_judicail_cases_tittle as ti','ti.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->get()
                ->result();
            
        }
        else
        {
         return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                //->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left')
                ->join('tbl_judicail_cases_tittle as ti','ti.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->where('m.tehsil_id',$this->input->post('tehsil_id'))
                ->get()
                ->result();
        }
    }
    public function get_list_by_mauza()
    {
         if($this->input->post('mauza_id')== 0)
        {
             return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                //->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left')
                ->join('tbl_judicail_cases_tittle as ti','ti.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->get()
                ->result();
            
        }
        else
        {
         return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                //->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left')
                ->join('tbl_judicail_cases_tittle as ti','ti.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->where('c.mauza_id',$this->input->post('mauza_id'))
                ->get()
                ->result();
        }
    }
    
    public function save_update_view()
    {
       $cases= $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->where('date_of_hearing',$this->session->userdata('selected_date'))
                ->get()
                ->result();
        $i=0;
       foreach($cases as $list)
       {
        $pro[$i]= $this->input->post('case_proceedings_'.$list->case_id);
       
        
        if($this->input->post('update_date_'.$list->case_id) == NULL)
        {
            $date[$i]= $this->input->post('update_date1_'.$list->case_id);
        }
        else
        {
            $date[$i]= date("Y-m-d",strtotime($this->input->post('update_date_'.$list->case_id)));
        }
        
        $data=array(
            
            'proceedings_id'=>$pro[$i],
            'date_of_hearing' =>$date[$i]
        );
         $this->db->where('case_id',$list->case_id);
        $this->db->update('tbl_judicail_cases',$data);
        $i++;
       }
       
       
    }
    public function save_judgement()
        {
            
             $cases= $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->join('tbl_fate_of_cases as f','f.fate_case_id=c.fate_case_id')
                ->get()
                ->result();
            $i=0;
        foreach ($cases as $list)
        {
           
           
             $pro[$i]= $this->upload_file('judeg_'.$list->case_id ,'judeg__');
             if($pro[$i] == 'judeg__')
             {
                 
             }
             else
             {
            $data=array(
             'judgement'=> $pro[$i]
                );
            $this->db->where('case_id',$list->case_id)
                    ->update('tbl_judicail_cases',$data);
             }
                   
        
         $i++;
        }
       
        }
    
    public function get_fate_cases()
    {
        return $this->db->select("*")
                ->from('tbl_fate_of_cases')
                ->get()
                ->result();
    }
    
    public function get_decided_cases()
    {
         return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->join('tbl_fate_of_cases as f','f.fate_case_id=c.fate_case_id')
                ->get()
                ->result();
        
    }
    
    public function get_count()
    {
          return $this->db->select("count(c.case_id) as total")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_fate_of_cases as f','f.fate_case_id=c.fate_case_id')
                ->get()
                ->row();
        
    }
    
    public function get_peshi_data($id)
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_proceedings')
                ->where('group_id',$id)
                ->get()
                ->result();
        
    }
    
    public function get_group_id($id)
    {
        return $this->db->select("*")
                ->from('tbl_proceedings_group')
                ->where('group_id',$id)
                ->get()
                ->row();
        
            
    
    }
    public function generate_list($id,$date)
    {
        return $this->db->select("*")
                ->from(' tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->where('p.group_id',$id)
                ->where('c.date_of_hearing',$date)
                ->get()
                ->result();
    }
    
}