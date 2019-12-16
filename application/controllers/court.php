<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Court extends CI_Controller {

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
    public function index()
    {
        $this->load->model('mdl_court');
        $data['courts']=$this->mdl_court->get_court_data();
        $data["main"] = "court/District/home";
        $this->load->view('judicial_work_template/template', $data);
        
    }
//    public function divisional()
//    {
//       
//             $data["main"] = "court/Divisional/home";
//        $this->load->view('judicial_work_template/template', $data);   
//    }
    public function district()
    {
        $this->load->model('mdl_court');
        $data['courts']=$this->mdl_court->get_court_data();
        $data["main"] = "court/District/home";
        $this->load->view('judicial_work_template/template', $data);   
    }
//    public function tehsil()
//    {
//       
//        $data["main"] = "court/Tehsil/home";
//        $this->load->view('judicial_work_template/template', $data);   
//    }
    public function add_divisional_court()
    {
         $this->load->model('mdl_districts');
         $this->load->model('mdl_court');
         
         $this->load->library('form_validation');
          $this->form_validation->set_rules('station', 'Station Name', 'required');
          $this->form_validation->set_rules('name_of_officer', 'Name of Officer', 'required');
          
          if ($this->form_validation->run() == TRUE) 
   {
            $this->mdl_court->save_court();
            $this->index();
   } 
  else 
            
    {
         $data['district'] = $this->mdl_districts->get_districts_list();
         $data['category'] = $this->mdl_court->get_court_category();
         $data['c_category'] = $this->mdl_court->get_case_category_rev();
         $data['proceedings_rev'] = $this->mdl_court->get_proceedings_rev();
         $data["main"] = "court/District/add";
         $this->load->view('judicial_work_template/template', $data);
    }
    }
            
    function add_group()
    {
         $this->load->model('mdl_court');
         $this->load->library('form_validation');
          $this->form_validation->set_rules('group', 'Group Name', 'required');
          
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_court->save_group();
            $this->index();
        } 
        else 
            
            {
          $data["main"] = "court/group/add";
          $this->load->view('judicial_work_template/template', $data);
        
    }
    }
    function add_proceedings()
    {
         $this->load->model('mdl_districts');
         $this->load->model('mdl_court');
          $this->load->library('form_validation');
          $this->form_validation->set_rules('proceeding_name', 'Please Enter Proceeding Name', 'required');
          
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_court->save_proceeding();
            $this->groups_proceedings_category();
        } 
        else 
            
            {
         $data['district'] = $this->mdl_districts->get_districts_list();
         $data['category'] = $this->mdl_court->get_court_category();
         $data['groups'] = $this->mdl_court->get_groups();
         $data["main"] = "court/add_proceedings";
         $this->load->view('judicial_work_template/template', $data);
        
    }
    }
    
    public function edit_proceedings($id)
    {
        
         
       
        $this->load->model('mdl_court');
        $this->load->model('mdl_districts');
        $data['proceedings']=$this->mdl_court->get_proceedings_by_id($id);
        $data['groups'] = $this->mdl_court->get_groups();
        $data['category'] = $this->mdl_court->get_court_category();
         $data['district'] = $this->mdl_districts->get_districts_list();
        $data["main"] = "court/edit_proceedings";
        $this->load->view('judicial_work_template/template', $data);
        
    
    }
    
    public function update()
    {
         $this->load->model('mdl_court');
         $this->load->library('form_validation');
         $this->form_validation->set_rules('proceeding_name', 'Please Enter Proceeding Name', 'required');
          
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_court->update_proceedings();
            $this->groups_proceedings_category();
        } 
        
    }
    
    public function delete_proceedings($id)
    {
         if ($id == 0 or $id == '') {
            redirect('court');
        } else {
                 $this->load->model("mdl_court");
                 $this->mdl_court->proceedings_delete($id);
        }
        
    }
    function add_case_category()
    {
         $this->load->model('mdl_districts');
         $this->load->model('mdl_court');
         $this->load->library('form_validation');
          $this->form_validation->set_rules('case_category', 'Please Enter Category Name', 'required');
          
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_court->save_case_category();
            $this->groups_proceedings_category();
        } 
        else 
            
       {
         $data['district'] = $this->mdl_districts->get_districts_list();
         $data['category'] = $this->mdl_court->get_court_category();
         $data["main"] = "court/add_case_category";
         $this->load->view('judicial_work_template/template', $data);
        
    }
    }
    
    public function edit_case_category($id)
    {
         $this->load->model('mdl_court');
        $this->load->model('mdl_districts');
        $data['c_category']=$this->mdl_court->get_category_by_id($id);
        $data['category'] = $this->mdl_court->get_court_category();
         $data['district'] = $this->mdl_districts->get_districts_list();
        $data["main"] = "court/edit_case_category";
        $this->load->view('judicial_work_template/template', $data);
        
    }
    
    public function update_case_category()
    {
         $this->load->model('mdl_court');
         $this->load->library('form_validation');
         $this->form_validation->set_rules('case_category', 'Please Enter Proceeding Name', 'required');
          
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_court->update_category();
            $this->groups_proceedings_category();
        } 
        
    }

    public function groups_proceedings_category()
    {
        $this->load->model('mdl_court');
        $data['groups']=$this->mdl_court->get_groups();
        $data['proceedings']=$this->mdl_court->get_proceedings();
        $data['case_category']=$this->mdl_court->get_case_category();
        $data["main"] = "court/groups_proceedings_category";
        $this->load->view('judicial_work_template/template', $data);
        
    }
    public function delete_category($id)
    {
        
         if ($id == 0 or $id == '') {
            redirect('court');
        } else {
                 $this->load->model("mdl_court");
                 $this->mdl_court->case_category_delete($id);
        }
        
    }
    public function delete_court($id)
    {
          if ($id == 0 or $id == '') {
            redirect('court');
        } else {
                 $this->load->model("mdl_court");
                 $this->mdl_court->court_delete($id);
        }
        
    }

    


    public function test()
    {
         $data["main"] = "court/District/test";
         $this->load->view('judicial_work_template/template', $data);
        
    }
    public function test1()
    {
        $data =$this->input->post('working');
        foreach ($data as $e)
        {
            echo $e;
        }
           
       
        
//        foreach ($data as $e)
//        {
//            echo $e;
//        }
    }
}