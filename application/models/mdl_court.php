<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_court extends CI_Model {

    var $gallery_path;

    function __construct() {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }
    
    public function get_court_data()
    {
        return $this->db->select("*")
                ->from('tbl_courts as c')
                ->join('tbl_property_districts as d','d.district_id=c.district_id','left')
                ->join('tbl_court_category as y','y.court_category_id=c.court_category_id','left')
                ->get()
                ->result();
    }
    
    public function cases_by_courtcategory_and_district()
    {
        
        return $this->db->select("*")
                ->from('tbl_judicail_cases as c')
                ->join('tbl_property_mauza as m','m.mauza_id=c.mauza_id','left')
                ->join('tbl_property_districts as ds','ds.district_id=c.district_id','left')
                ->join('tbl_judicail_cases_tittle as t','t.case_tittle_id=c.case_tittle_id','left')
                ->join('tbl_judicail_cases_proceedings as p','p.proceedings_id=c.proceedings_id','left')
                ->join('tbl_court_category as y','y.court_category_id=c.court_category_id','left')
                ->where('c.court_category_id',$this->session->userdata('selected_court_rev'))
                ->where('ds.district_id',$this->session->userdata('selected_district_rev'))
                ->where('c.fate_case_id',0)
                ->get()
                ->result();
         
       
    }

    public function get_court_category()
    {
        return $this->db->select("*")
                ->from('tbl_court_category')
                ->where('territory_id',2)
                ->get()
                ->result();
    }
    public function save_group()
    {
        $data=array(
            
            'group_name'=>$this->input->post('group')
        );
        
        $this->db->insert('tbl_proceedings_group',$data);
    }
    
    public function save_proceeding()
    {
        $data=array(
            'proceedings_name'=>$this->input->post('proceeding_name'),
            'group_id'=>$this->input->post('group'),
            'district_id'=>$this->input->post('district'),
            'court_category_id' =>$this->input->post('category'),
            'class_cases' =>$this->input->post('class_case')
        );
         $this->db->insert('tbl_judicail_cases_proceedings',$data);
    }

        public function get_groups()
    {
        return $this->db->select("*")
                ->from('tbl_proceedings_group')
                ->get()
                ->result();
    }
    
    public function get_proceedings()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_proceedings as p')
                ->join('tbl_proceedings_group as g','g.group_id=p.group_id','left')
                ->join('tbl_property_districts as d', 'd.district_id=p.district_id','left')
                ->join('tbl_court_category as c','c.court_category_id=p.court_category_id','left')
                ->get()
                ->result();
    }
    public function get_proceedings_by_id($id)
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_proceedings')
                ->where('proceedings_id',$id)
                ->get()
                ->row();
        
    }
    public function update_proceedings()
    {
        $data=array(
            'proceedings_name'=>$this->input->post('proceeding_name'),
            'group_id'=>$this->input->post('group'),
            'district_id'=>$this->input->post('district'),
            'court_category_id' =>$this->input->post('category'),
            'class_cases' =>$this->input->post('class_case')
        );
        $this->db->where('proceedings_id',$this->input->post('id'));
        $this->db->update('tbl_judicail_cases_proceedings',$data);
        
    }
    
    public function proceedings_delete($id)
    {
         $this->db->where("proceedings_id", $id);
         $this->db->delete('tbl_judicail_cases_proceedings');
         redirect('court/groups_proceedings_category');
        
    }
    public function court_delete($id)
    {
        $this->db->where("court_id", $id);
         $this->db->delete('tbl_courts');
         redirect('court');
    }

    public function get_case_category()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_tittle as t')
                ->join('tbl_property_districts as d', 'd.district_id=t.district_id','left')
                ->join('tbl_court_category as c','c.court_category_id=t.court_category_id','left')
                ->get()
                ->result();
        
    }
    public function save_case_category()
    {
        
        $data=array(
            'case_tittle_name'=>$this->input->post('case_category'),
            'district_id'=>$this->input->post('district'),
            'court_category_id' =>$this->input->post('category'),
            'class_cases' =>$this->input->post('class_case')
        );
         $this->db->insert('tbl_judicail_cases_tittle',$data);
        
    }
    public function get_category_by_id($id)
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_tittle')
                ->where('case_tittle_id',$id)
                ->get()
                ->row();
        
    }
    public function update_category()
    {
         $data=array(
            'case_tittle_name'=>$this->input->post('case_category'),
            'district_id'=>$this->input->post('district'),
            'court_category_id' =>$this->input->post('category'),
            'class_cases' =>$this->input->post('class_case')
        );
        $this->db->where('case_tittle_id',$this->input->post('id'));
        $this->db->update('tbl_judicail_cases_tittle',$data);
    }
    public function case_category_delete($id)
    {
        $this->db->where("case_tittle_id", $id);
         $this->db->delete('tbl_judicail_cases_tittle');
         redirect('court/groups_proceedings_category');
        
    }
    public function get_case_category_rev()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_tittle')
                ->where('class_cases','Revenue')
                ->get()
                ->result();
    }
    public function get_proceedings_rev()
    {
        return $this->db->select("*")
                ->from('tbl_judicail_cases_proceedings')
                ->where('class_cases','Revenue')
                ->get()
                ->result();
    }
    public function get_patwar()
    {
        return $this->db->select("*")
                ->from('tbl_property_patwarcircle')
                ->get()
                ->result();
    }
    public function get_districts()
    {
        return $this->db->distinct()
                ->from('tbl_property_districts as d')
                ->join('tbl_courts as c','c.district_id=d.district_id')
                ->group_by('d.district_name')
                ->get()
                ->result();
    }

    public function save_court()
    {
        
        $working_days='';
        $data1 =$this->input->post('working');
        if($data1 == NULL)
        {
            $working_days='';
        }
        else
        {
        foreach ($data1 as $e)
        {
            $working_days .= $e.',';
        }
        }
        $data=array(
            'district_id'       =>$this->input->post('territory'),
            'station'           =>$this->input->post('station'),
            'court_category_id' =>$this->input->post('category'),
            'class_cases'       =>$this->input->post('class_case'),
            'name_officer'      =>$this->input->post('name_of_officer'),
            'date_posting'      =>date("Y-m-d",strtotime($this->input->post('DOP'))),
            'DOB'               =>$this->input->post('DOB'),
            'start_time'        =>$this->input->post('ST'),
            'working_days'      =>$working_days,
            'proceedings_id_rev'=>0,
            'proceedings_id_gen'=> 0,
            'case_category_rev' =>0,
            'case_category_gen' => 0,
            'address_court'     =>$this->input->post('address'),
            'contact'           =>$this->input->post('contact'),
            'latitude'          =>$this->input->post('latitude'),
            'longitude'         =>$this->input->post('longitude')
            
            
        );
        $this->db->insert('tbl_courts',$data);
    }
}
?>
