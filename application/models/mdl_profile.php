<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_profile extends CI_Model {
     var $gallery_path;

    function __construct() {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

//////////////////////////////// upload_file   //////////////////////////////////////////////		
    private function upload_file($file, $name, $overwrite = false) {
        $config = array();
        $config = array(
            'allowed_types' => '*',
            'upload_path' => $this->gallery_path,
            'max_size' => 2048,
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

    public function get_profile_data()
    {
        return $this->db->select("*")
                ->from('tbl_profile as p')
                ->join('tbl_property_districts as d','d.district_id=p.district_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=p.tehsil_id','left')
                ->join('tbl_property_mauza as m','m.mauza_id=p.mauza_id','left')
                ->join('tbl_profile_designation as de','de.designation_id=p.designation_id','left')
                ->where('de.designation_group','District Group')
                ->get()
                ->result();
    }

    public function get_designations()
    {
        return $this->db->select("*")
                ->from('tbl_profile_designation')
                ->where('designation_group','District Group')
                ->get()
                ->result();
    }
    public function save_profile()
    {
     
           
            $doe =date("Y-m-d",strtotime($this->input->post('doe')));
            
        $data=array(
            'profile_name' => $this->input->post('name'),
            'CNIC' => $this->input->post('cnic'),
            'caste' => $this->input->post('caste'),
            'doe' => $doe,
            'meritial_status' => $this->input->post('m_status'),
            'spouse_name' => $this->input->post('s_name'),
            'personal_comp_no' => $this->input->post('pcn'),
            'dob' => date("Y-m-d",strtotime($this->input->post('dob'))),
            'qualifications' => $this->input->post('qualifications'),
            'designation_id' => $this->input->post('designation'),
            'computer_proficiency' => $this->input->post('computer_proeficeincy'),
            'domicile_place' => $this->input->post('dp'),
            'district_id' => $this->input->post('district'),
            'mauza_id' => $this->input->post('mauza'),
            'tehsil_id' => $this->input->post('tehsil'),
            'personal_m_no' => $this->input->post('personal_m_no'),
            'm_no_2' => $this->input->post('m_no_2'),
            'fallbacak_no' => $this->input->post('fallback'),
            'office_contact_no' => $this->input->post('office_contact_no'),
            'home_contact_no' => $this->input->post('home_contact_no'),
            'office_address' => $this->input->post('office_address'),
            'home_address' => $this->input->post('home_address'),
            'o_latitude' => $this->input->post('o_latitude'),
            'o_longitude' => $this->input->post('o_longitude'),
            'h_latitude' => $this->input->post('h_latitude'),
            'h_longitude' => $this->input->post('h_longitude'),
            'posting_district_1' => $this->input->post('district_posting_1'),
            'posting_district_2' => $this->input->post('district_posting_2'),
            'posting_district_3' => $this->input->post('district_posting_3'),
            'posting_from_1' => date("Y-m-d",strtotime($this->input->post('posting_from_1'))),
            'posting_from_2' => date("Y-m-d",strtotime($this->input->post('posting_from_2'))),
            'posting_from_3' => date("Y-m-d",strtotime($this->input->post('posting_from_3'))),
            'posting_to_1'   => date("Y-m-d",strtotime($this->input->post('posting_to_1'))),
            'posting_to_2'   => date("Y-m-d",strtotime($this->input->post('posting_to_2'))),
            'posting_to_3'   => date("Y-m-d",strtotime($this->input->post('posting_to_3'))),
            'pic' => $this->upload_file('pic', 'profile_pic_')
        );
         $this->db->insert('tbl_profile', $data);
    }
    
    public function delete_profile($id)
    {
         $this->db->where("profile_id", $id);
        $this->db->delete('tbl_profile');
    }
    public function save_designation()
    {
        $data=array(
            'designation_group' => $this->input->post('designation_group'),
            'designation_name' => $this->input->post('designation_name')
        );
        $this->db->insert('tbl_profile_designation',$data);
    }
    public function get_designation()
    {
        return $this->db->select("*")
                ->order_by("designation_group","desc")
                ->from('tbl_profile_designation')
                ->get()
                ->result();
    }
    public function get_designation_tehsil()
    {
        return $this->db->select("*")
                ->order_by("designation_group","desc")
                ->from('tbl_profile_designation')
                ->where('designation_group','Tehsil Group')
                ->get()
                ->result();
    }
    public function get_designation_staff()
    {
        return $this->db->select("*")
                ->order_by("designation_group","desc")
                ->from('tbl_profile_designation')
                ->where('designation_group','Staff Group')
                ->get()
                ->result();
    }
    public function get_designation_qanoongo()
    {
        return $this->db->select("*")
                ->order_by("designation_group","desc")
                ->from('tbl_profile_designation')
                ->where('designation_group','Qanoongoi Group')
                ->get()
                ->result();
    }
    public function get_designation_patwar()
    {
        return $this->db->select("*")
                ->order_by("designation_group","desc")
                ->from('tbl_profile_designation')
                ->where('designation_group','Patwar Group')
                ->get()
                ->result();
    }
    public function get_profile_data_tehsil_group()
    {
        return $this->db->select("*")
                ->from('tbl_profile as p')
                ->join('tbl_property_districts as d','d.district_id=p.district_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=p.tehsil_id','left')
                ->join('tbl_property_mauza as m','m.mauza_id=p.mauza_id','left')
                ->join('tbl_profile_designation as de','de.designation_id=p.designation_id','left')
                ->where('de.designation_group','Tehsil Group')
                ->get()
                ->result();
    }
    public function get_profile_data_staff_group()
    {
        return $this->db->select("*")
                ->from('tbl_profile as p')
                ->join('tbl_property_districts as d','d.district_id=p.district_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=p.tehsil_id','left')
                ->join('tbl_property_mauza as m','m.mauza_id=p.mauza_id','left')
                ->join('tbl_profile_designation as de','de.designation_id=p.designation_id','left')
                ->where('de.designation_group','Staff Group')
                ->get()
                ->result();
    }
    public function get_profile_data_qanoon_group()
    {
        return $this->db->select("*")
                ->from('tbl_profile as p')
                ->join('tbl_property_districts as d','d.district_id=p.district_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=p.tehsil_id','left')
                ->join('tbl_property_mauza as m','m.mauza_id=p.mauza_id','left')
                ->join('tbl_profile_designation as de','de.designation_id=p.designation_id','left')
                ->where('de.designation_group','Qanoongoi Group')
                ->get()
                ->result();
    }
    public function get_profile_data_patwar_group()
    {
        return $this->db->select("*")
                ->from('tbl_profile as p')
                ->join('tbl_property_districts as d','d.district_id=p.district_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=p.tehsil_id','left')
                ->join('tbl_property_mauza as m','m.mauza_id=p.mauza_id','left')
                ->join('tbl_profile_designation as de','de.designation_id=p.designation_id','left')
                ->where('de.designation_group','Patwar Group')
                ->get()
                ->result();
    }
    public function get_profile_view($id)
    {
         return $this->db->select("*")
                ->from('tbl_profile as p')
                ->join('tbl_property_districts as d','d.district_id=p.district_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=p.tehsil_id','left')
                ->join('tbl_property_mauza as m','m.mauza_id=p.mauza_id','left')
                ->join('tbl_profile_designation as de','de.designation_id=p.designation_id','left')
                ->where('p.profile_id', $id)
                ->get()
                ->row();
        
        
    }
}
?>