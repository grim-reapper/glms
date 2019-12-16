<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_filescatalog extends CI_Model {

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

    public function get_files_list() {
       
       // $status=$this->session->userdata('selected_district');
        
         if ($this->session->userdata('selected_district') == 0) {
            $this->db->order_by("f.unique_file", "ASC");
            $this->db->select("*");
            $this->db->from('tbl_property_filescatalog as f');
            $this->db->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left');
            $this->db->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left');
            // $this->db->where('f.district_id',$this->session->userdata('selected_district'));
            $query = $this->db->get();

            return $query->result();
        } 
 else {
            $this->db->order_by("f.unique_file", "ASC");
            $this->db->select("*");
            $this->db->from('tbl_property_filescatalog as f');
            $this->db->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left');
            $this->db->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left');
            $this->db->where('f.district_id',$this->session->userdata('selected_district'));
            $query = $this->db->get();
            return $query->result();
     
 }
    }

    public function get_land_status() {
        // $this->db->order_by("occupancy_status_type");
        $this->db->select("*");
        $this->db->from('tbl_filescatalog_land_status');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_occupancy_status() {
        // $this->db->order_by("occupancy_status_type");
        $this->db->select("*");
        $this->db->from('tbl_filescatalog_occupancy');
        $query = $this->db->get();
        return $query->result();
    }

    public function save() {

        $unique_id = '';
        $almirah_no = $this->input->post('almirah_no');
        $rack_no = $this->input->post('rack_no');
       // $file_no = $this->input->post('file_old_no');
        ////////////////////////////////////////////
     
         $this->db->select('COUNT(serial_no) as num_serial_No');
         $this->db->from('tbl_property_filescatalog');
         $this->db->where('file_almirah_no',$this->input->post('almirah_no'));
         $this->db->where('file_rack_no',$this->input->post('rack_no'));
         $serial_no=$this->db->get();
         $sr_no=$serial_no->row();
         
        ///////////////////////////////////////////////
       
        /////////////////////////////////////////////////////////////////////
       $branch_code= $this->db->select("*")
                ->from('tbl_property_branch')
                ->where('branch_id',$this->input->post('branch'))
                ->get()
                ->row();
       $cat_code= $this->db->select("*")
                ->from('tbl_branch_case_categories')
                ->where('case_category_id',$this->input->post('categ'))
                ->get()
                ->row();
        ////////////////////////////////////////////////////////////////////
        // $code=$branch_code->branch_code;
        $serial=$sr_no->num_serial_No +1;
       
        $unique_id .= $branch_code->branch_code;
        $almirah_no = sprintf("%02d", $almirah_no);
        $unique_id .= '-' . $almirah_no;
        $rack_no = sprintf("%02d", $rack_no);
        $unique_id .= '-' . $rack_no;
        $file_no = sprintf("%03d", $serial);
        $unique_id .= '-' .$file_no;
        $unique_id .='-' . $cat_code->case_category_code;




        $data = array(
            'unique_file'        => $unique_id,
            'file_occupant_name' => $this->input->post('name_occupant'),
            'Subject'            => $this->input->post('subject'),
            'mauza_id'           => $this->input->post('mauza_id'),
            'district_id'           => $this->input->post('district'),
            'branch_id'          => $this->input->post('branch'),
            'case_category_id'   => $this->input->post('categ'),
            'serial_no'          =>$file_no,
            'land_detail'        => $this->input->post('note'),
            'pages_from'         => $this->input->post('start'),
            'pages_to'           => $this->input->post('end'),
            'start_year'         => $this->input->post('start_year'),
            'time_date'          => date('Y-m-d h:i:s', time()),
            'file_old_no'        => $this->input->post('file_old_no'),
            'file_rack_no'       => $this->input->post('rack_no'),
            'file_almirah_no'    => $this->input->post('almirah_no'),
            'file_availability'  => $this->input->post('location_status'),
            
            'file_index' => $this->upload_file('file_index', 'file_index')
        );
        $this->db->insert('tbl_property_filescatalog', $data);
    }

    public function file_detail($id) {

        $this->db->select("*");
        $this->db->from('tbl_property_filescatalog as f');
        $this->db->join('tbl_property_mauza as m', 'm.mauza_id=f.mauza_id', 'left');
        $this->db->join('tbl_property_branch as b', 'b.branch_id=f.branch_id', 'left');
         $this->db->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left');
        $this->db->where('f.file_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_branch() {
        
        if($this->session->userdata('selected_district')==0)
        {
            return $this->db->select("*")
                   ->from('tbl_property_branch')
                    ->get()
                    ->result();
        }
        else {
        return $this->db
                        ->order_by("d.district_name", "ASC")
                        ->order_by("b.branch_name", "ASC")
                        ->select("*")
                        ->from('tbl_property_branch as b')
                        ->join('tbl_property_districts as d', 'd.district_id=b.district_id', 'left')
                        ->where('b.district_id',$this->session->userdata('selected_district'))
                        ->get()
                        ->result();
        }
    }
    public function get_branch_simple() {
        
       
        return $this->db
                        ->order_by("d.district_name", "ASC")
                        ->order_by("b.branch_name", "ASC")
                        ->select("*")
                        ->from('tbl_property_branch as b')
                        ->join('tbl_property_districts as d', 'd.district_id=b.district_id', 'left')
                        
                        ->get()
                        ->result();
        
    }
    public function get_branch_add() {
        
        
        return $this->db
                        ->order_by("d.district_name", "ASC")
                        ->order_by("b.branch_name", "ASC")
                        ->select("*")
                        ->from('tbl_property_branch as b')
                        ->join('tbl_property_districts as d', 'd.district_id=b.district_id', 'left')
                        ->where('b.district_id',$this->session->userdata('selected_district_add'))
                        ->get()
                        ->result();
        
    }

    public function save_branch() {
        $this->db->select("*");
        $this->db->from('tbl_property_districts');
        $this->db->where('district_id', $this->input->post('D_id'));
        $query = $this->db->get();
        $code = $query->row();
        $branch_code = '';
        if ($code->district_code == NULL) {
            $branch_code .= 'XX';
        } else {
            $branch_code .= $code->district_code;
        }
        $branch_code .= '-' . $this->input->post('branch_code');

        $data = array(
            'branch_name' => $this->input->post('name_branch'),
            'branch_code' => $branch_code,
            'district_id' => $this->input->post('D_id')
        );
        $this->db->insert('tbl_property_branch', $data);
    }

    public function get_branch_by_id($id) {
        return $this->db->select("*")
                        ->from('tbl_property_branch as b')
                        ->join('tbl_property_districts as d', 'd.district_id=b.district_id', 'left')
                        ->where('b.branch_id', $id)
                        ->get()
                        ->row();
    }

    public function branch_update() {


        $data = array(
            'branch_name' => $this->input->post('branch_name'),
            'branch_code' => $this->input->post('branch_code'),
            'district_id' => $this->input->post('D_id')
        );
        $this->db->where('branch_id', $this->input->post('branch_id'));
        $this->db->update('tbl_property_branch', $data);

        $data2 = array(
            'case_category_name' => $this->input->post('category_name'),
            'case_category_code' => $this->input->post('category_code')
        );

        $this->db->where('case_category_id', $this->input->post('category_id'));
        $this->db->update('tbl_branch_case_categories', $data2);
    }

    public function branch_update1() {


        $data = array(
            'branch_name' => $this->input->post('branch_name'),
            'branch_code' => $this->input->post('branch_code'),
            'district_id' => $this->input->post('D_id')
        );
        $this->db->where('branch_id', $this->input->post('branch_id'));
        $this->db->update('tbl_property_branch', $data);
    }

    public function branch_delete($id) {
        $this->db->where("branch_id", $id);
        $this->db->delete('tbl_property_branch');
        redirect('filescatalog/branch');
    }

    public function branch_by_district() {
        if ($this->input->post('district_id') == 0) {
            return $this->db->select("*")
                            ->from('tbl_property_branch')
                            ->get()
                            ->result();
        } else {
            return $this->db->select("*")
                            ->from('tbl_property_branch')
                            ->where('district_id', $this->input->post('district_id'))
                            ->get()
                            ->result();
        }
    }
    public function category_by_branch() {
        if ($this->input->post('branch_id') == 0) {
            return $this->db->select("*")
                            ->from('tbl_branch_case_categories')
                            ->get()
                            ->result();
        } else {
            return $this->db->select("*")
                            ->from('tbl_branch_case_categories')
                            ->where('branch_id', $this->input->post('branch_id'))
                            ->get()
                            ->result();
        }
    }

    ///////////////////////////////Section Category/////////////////////////////

    public function save_category() {
        $data = array(
            'case_category_name' => $this->input->post('category_name'),
            'case_category_code' => $this->input->post('category_code'),
            'branch_id' => $this->input->post('branch')
        );
        $this->db->insert('tbl_branch_case_categories', $data);
    }

    public function get_case_category($branch_id) {
        $this->db->select("*");
        $this->db->from('tbl_branch_case_categories as c');
        $this->db->join('tbl_property_branch as b', 'b.branch_id=c.branch_id', 'left');
        $this->db->join('tbl_property_districts as d', 'd.district_id=b.district_id', 'left');
        $this->db->where('c.branch_id', $branch_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_category_by_id($id) {
        return $this->db->select("*")
                        ->from('tbl_branch_case_categories')
                        ->where('case_category_id', $id)
                        ->get()
                        ->row();
    }
    public function get_category()
    {
        return $this->db->select("*")
                ->from('tbl_branch_case_categories')
                 ->get()
                ->result();
    }
    public function get_category_add()
    {
        return $this->db->select("*")
                ->from('tbl_branch_case_categories')
                ->where('branch_id',$this->session->userdata('selected_branch'))
                ->get()
                ->result();
    }


    public function file_delete($id) {
        $this->db->where("file_id", $id);
        $this->db->delete('tbl_property_filescatalog');
        redirect('filescatalog');
    }
    
    public function file_view_by_district()
    {
         if ($this->input->post('district_id') == 0) {
           return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->get()
                ->result();
        } else {
        return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->where('f.district_id',$this->session->userdata('selected_district'))
                ->where('f.district_id',$this->input->post('district_id'))
                ->get()
                ->result();
    }
    }
    public function file_view_by_mauza()
    {
        if ($this->input->post('mauza_id') == 0) {
           return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->get()
                ->result();
        } else {
        return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->where('f.mauza_id',$this->input->post('mauza_id'))
                ->get()
                ->result();
        
    }
    }
     public function file_view_by_branch()
    {
         if ($this->input->post('branch_id') == 0) {
           return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->get()
                ->result();
        } else {
        return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->where('f.branch_id',$this->input->post('branch_id'))
                ->get()
                ->result();
        
    }
        
    }
     public function file_view_by_cat()
    {
         if ($this->input->post('cat_id') == 0) {
           return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id','left')
                ->get()
                ->result();
        } else {
        return $this->db->select("*")
                ->from('tbl_property_filescatalog as f')
                ->join('tbl_property_mauza as m', 'f.mauza_id = m.mauza_id','left')
                ->join('tbl_branch_case_categories as c','c.case_category_id=f.case_category_id')
                ->where('f.case_category_id',$this->input->post('cat_id'))
                ->get()
                ->result();
        
    }
        
    }
     public function filter_mauza_by_district()
    {
         if ($this->input->post('district_id') == 0) {
           return $this->db->select("*")
                ->from('tbl_property_mauza')
                ->get()
                ->result();
        } else {
        return $this->db->select("*")
                ->from('tbl_property_mauza as m')
                ->join('tbl_property_tehsils as t', 't.tehsil_id = m.tehsil_id','left')
                ->join('tbl_property_districts as d','d.district_id=t.district_id','left')
                ->where('d.district_id',$this->session->userdata('selected_district'))
                ->where('d.district_id',$this->input->post('district_id'))
                ->get()
                ->result();
        
    }
        
    }
     public function filter_cat_by_district()
    {
         if ($this->input->post('district_id') == 0) {
           return $this->db->select("*")
                ->from('tbl_branch_case_categories')
                ->get()
                ->result();
        } else {
        return $this->db->select("*")
                ->from('tbl_branch_case_categories as c')
                ->join('tbl_property_branch as b', 'b.branch_id = c.branch_id','left')
                ->join('tbl_property_districts as d','d.district_id=b.district_id','left')
                ->where('d.district_id',$this->session->userdata('selected_district'))
                ->where('d.district_id',$this->input->post('district_id'))
                ->get()
                ->result();
        
    }
        
    }
     public function filter_cat_by_district_add()
    {
        
        return $this->db->select("*")
                ->from('tbl_branch_case_categories as c')
                ->join('tbl_property_branch as b', 'b.branch_id = c.branch_id','left')
                ->join('tbl_property_districts as d','d.district_id=b.district_id','left')
                ->where('d.district_id',$this->session->userdata('selected_district_add'))
                
                ->get()
                ->result();
        
    }
        
    

}
