<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Filescatalog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        if (!$this->mdl_sessions->is_login()) {
            redirect('sessions/login');
        }
    }

////////////////////////////////File Section///////////////////////////////
    public function index() {
        $this->load->model("mdl_filescatalog");
        $this->load->model('mdl_districts');
         $this->load->model("mdl_mauza");
        $data['f_lists'] = $this->mdl_filescatalog->get_files_list();
        $data['district'] = $this->mdl_districts->get_districts_list();
        $data['mauza_list'] = $this->mdl_mauza->get_mauza_list();
        $data['branch'] = $this->mdl_filescatalog->get_branch();
        $data['category'] = $this->mdl_filescatalog->get_category();
        $data["main"] = "filecatalog/home";
        $this->load->view('catalogmanagement/template', $data);
    }

    public function add() {

        $this->load->model("mdl_filescatalog");
        $this->load->model("mdl_mauza");
        $this->load->model('mdl_districts');
        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('name_occupant', 'Occupant Name', 'required');
       // $this->form_validation->set_rules('file_old_no', 'File Old NO', 'required');
        $this->form_validation->set_rules('almirah_no', 'Almirah NO', 'required');
        $this->form_validation->set_rules('rack_no', 'Rack NO', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->mdl_filescatalog->save();
            redirect('filescatalog');
        } else {

            $data['district'] = $this->mdl_districts->get_districts_list();
            $data['mauza_list'] = $this->mdl_mauza->get_mauza_list();
            $data['land_status'] = $this->mdl_filescatalog->get_land_status();
            $data['occupancy_status'] = $this->mdl_filescatalog->get_occupancy_status();
            $data['branch'] = $this->mdl_filescatalog->get_branch_add();
            $data['category'] = $this->mdl_filescatalog->get_category_add();
            $data["main"] = "filecatalog/add";
            $this->load->view('catalogmanagement/template', $data);
        }
    }

    public function file_view($file_id = 0) {

        if ($file_id == 0 or $file_id == '') {
            redirect("filescatalog");
        } else {
            $this->load->model('mdl_filescatalog');
            $data['file'] = $this->mdl_filescatalog->file_detail($file_id);
            $data["main"] = "filecatalog/file_view";
            $this->load->view('catalogmanagement/template', $data);
        }
    }

/////////////////////////////////Branch Section /////////////////////////////////////
    public function branch() {
        $this->load->model('mdl_filescatalog');
        $data['branch'] = $this->mdl_filescatalog->get_branch_simple();
        $data["main"] = "branch/home";
        $this->load->view('catalogmanagement/template', $data);
    }

    public function add_branch() {
        $this->load->model('mdl_filescatalog');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_branch', 'Branch Name', 'required');
        $this->form_validation->set_rules('branch_code', 'Branch Code', 'required|is_unique[tbl_property_branch.branch_code]');
        if ($this->form_validation->run() == TRUE) {
            $this->mdl_filescatalog->save_branch();
            $this->branch();
        } else {

            $this->load->model('mdl_districts');
            $data['district'] = $this->mdl_districts->get_districts_list();
            $data["main"] = "branch/add";
            $this->load->view('catalogmanagement/template', $data);
        }
    }

    public function delete_branch($id = 0) {

        if ($id == 0 or $id == '') {
            redirect('filescatalog/branch');
        } else {
            $this->load->model("mdl_filescatalog");
           // $this->mdl_filescatalog->branch_delete($id);
        }
    }

    public function edit_branch($id=0, $id2=0) {

        if ($id == 0 or $id == '') {
            redirect('filescatalog/branch');
        } else {
            $this->load->model("mdl_filescatalog");
            $this->load->model('mdl_districts');
            $data['district'] = $this->mdl_districts->get_districts_list();
            $data['branch'] = $this->mdl_filescatalog->get_branch_by_id($id);
            $data['category']=$this->mdl_filescatalog->get_category_by_id($id2);
            $data["main"] = "branch/edit";
            $this->load->view('catalogmanagement/template', $data);
        }
    }
    public function edit_branch1($id=0) {

        if ($id == 0 or $id == '') {
            redirect('filescatalog/branch');
        } else {
            $this->load->model("mdl_filescatalog");
            $this->load->model('mdl_districts');
            $data['district'] = $this->mdl_districts->get_districts_list();
            $data['branch'] = $this->mdl_filescatalog->get_branch_by_id($id);
           
            $data["main"] = "branch/edit_branch";
            $this->load->view('catalogmanagement/template', $data);
        }
    }

    public function update_branch() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
        $this->form_validation->set_rules('branch_code', 'Branch Code', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->model("mdl_filescatalog");
            $this->mdl_filescatalog->branch_update();
            $this->branch();
        }
 else {
     
     
 }
    }
    public function update_branch1() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
        $this->form_validation->set_rules('branch_code', 'Branch Code', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->model("mdl_filescatalog");
            $this->mdl_filescatalog->branch_update1();
            $this->branch();
        }
 else {
     
     
 }
    }

    public function get_branch_by_district() {
        $this->session->set_userdata(array('selected_district_add'=>$this->input->post('district_id')));
        $this->session->userdata('selected_district_add');
        $this->load->model("mdl_filescatalog");
        $data['branch'] = $this->mdl_filescatalog->branch_by_district();
        $this->load->view('branch/branch_by_district', $data);
    }
    public function get_category_by_branch() {
        $this->session->set_userdata(array('selected_branch'=>$this->input->post('branch_id')));
        $this->session->userdata('selected_branch');
         $this->session->set_userdata(array('selected_category'=>$this->input->post('cat_id')));
        $this->session->userdata('selected_category');
        $this->load->model("mdl_filescatalog");
        $data['category'] = $this->mdl_filescatalog->category_by_branch();
        $this->load->view('filecatalog/category_by_branch', $data);
    }

//////////////////////////////////// Case Category Section/////////////////////////////////////////

    public function add_category() {
        $this->load->model('mdl_filescatalog');
        $this->load->model('mdl_districts');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        $this->form_validation->set_rules('category_code', 'Category Code', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->mdl_filescatalog->save_category();
            $this->branch();
        } else {
            $data['district'] = $this->mdl_districts->get_districts_list();
            $data['branch'] = $this->mdl_filescatalog->get_branch();
            $data["main"] = "branch/add_category";
            $this->load->view('catalogmanagement/template', $data);
        }
    }
    ///////////////////////////////////////
    public function view_by_district()
    {
         $this->session->set_userdata(array('selected_district'=>$this->input->post('district_id')));
          $this->session->userdata('selected_district');
         $this->load->model("mdl_filescatalog");
        $data['f_lists'] = $this->mdl_filescatalog->file_view_by_district();
        $this->load->view('filecatalog/files_list_ajax', $data);
        
    }
    public function view_by_mauza()
    {
         $this->load->model("mdl_filescatalog");
        $data['f_lists'] = $this->mdl_filescatalog->file_view_by_mauza();
        $this->load->view('filecatalog/files_list_ajax', $data);
        
    }
    public function view_by_branch()
    {
         $this->load->model("mdl_filescatalog");
        $data['f_lists'] = $this->mdl_filescatalog->file_view_by_branch();
        $this->load->view('filecatalog/files_list_ajax', $data);
        
    }
    public function view_by_cat()
    {
         $this->load->model("mdl_filescatalog");
        $data['f_lists'] = $this->mdl_filescatalog->file_view_by_cat();
        $this->load->view('filecatalog/files_list_ajax', $data);
        
    }
    public function get_mauza_by_district()
    {
         $this->load->model("mdl_filescatalog");
        $data['mauza_list'] = $this->mdl_filescatalog->filter_mauza_by_district();
        $this->load->view('filecatalog/filter_mauza_by_district', $data);
        
    }
    public function get_cat_by_district()
    {
         $this->load->model("mdl_filescatalog");
        $data['category'] = $this->mdl_filescatalog->filter_cat_by_district();
        $this->load->view('filecatalog/filter_cat_by_district', $data);
        
    }
    public function get_cat_by_district_add()
    {
         $this->load->model("mdl_filescatalog");
        $data['category'] = $this->mdl_filescatalog->filter_cat_by_district_add();
        $this->load->view('filecatalog/filter_cat_by_district', $data);
        
    }
    //////////////////////////////////////
    

    public function delete($id = 0) {

        if ($id == 0 or $id == '') {
            redirect('filescatalog');
        } else {
            $this->load->model("mdl_filescatalog");
            $this->mdl_filescatalog->file_delete($id);
        }
    }

}