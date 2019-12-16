<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Judicial_cases extends CI_Controller {

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
        $this->load->model('mdl_mauza');
        $this->load->model('mdl_subdivision');
        $this->load->model("mdl_judicial_cases");
        $this->load->model('mdl_districts');
        $this->load->model('mdl_court');
      
        
        $data['mauza'] = $this->mdl_mauza->get_mauza_list();
        $data['subdiv'] = $this->mdl_subdivision->get_subdivision_list();
        $data['district'] = $this->mdl_court->get_districts();
        $data['patwar']=$this->mdl_court->get_patwar();
        $data['court']=$this->mdl_court->get_court_category();
//       $data['count']=$this->mdl_judicial_cases->get_cases_count();
        $data["main"] = "judicail_cases/home";
        $this->load->view('judicial_work_template/template', $data);
    }
    
    public function add()
    {
          $this->load->model("mdl_judicial_cases");
          $this->load->model('mdl_mauza');
        
          $this->load->library('form_validation');
          $this->form_validation->set_rules('suing_party', 'Suing Party', 'required');
          $this->form_validation->set_rules('defending_party', 'Defending Party', 'required');
          $this->form_validation->set_rules('case_no', 'Case No', 'required');
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_judicial_cases->save_case();
            $this->index();
        } 
        else 
            
            {
        $data['mauza'] = $this->mdl_mauza->get_mauza_list();
        $data['case_title']=$this->mdl_judicial_cases->get_cases_title();
        $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
        $data["main"] = "judicail_cases/add";
        $this->load->view('judicial_work_template/template', $data);
    }
}
      public function delete($id = 0) {

        if ($id == 0 or $id == '') {
            redirect('judicial_cases');
        } else {
                 $this->load->model("mdl_judicial_cases");
                 $this->mdl_judicial_cases->case_delete($id);
        }
        }
        public function get_cases_by_date()
        {
            $this->session->set_userdata(array('selected_date'=>$this->input->post('date')));
            $this->session->userdata('selected_date');
            $this->load->model("mdl_judicial_cases");
            $data['cases']=$this->mdl_judicial_cases->case_by_date();
            $this->load->view('judicail_cases/view_file_ajax',$data);
            
        }
        
        public function edit($id=0)
        {
            if($id==0 || $id == '')
            {
                redirect('judicial_cases');
            }
            else
            {
                $this->load->model("mdl_judicial_cases");
                $data['case']=$this->mdl_judicial_cases->get_case_by_id($id);
                $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
                $data['fate_case']=$this->mdl_judicial_cases->get_fate_cases();
                $data["main"] = "judicail_cases/edit";
                $this->load->view('judicial_work_template/template', $data);
                
            }
        }
        
        public function edit_file($id)
        {
            
            if($id==0 || $id == '')
            {
                redirect('judicial_cases');
            }
            else
            {
                $this->load->model("mdl_judicial_cases");
                $this->load->model('mdl_mauza');
                $data['mauza'] = $this->mdl_mauza->get_mauza_list();
                $data['case']=$this->mdl_judicial_cases->get_case_by_id($id);
                $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
                $data['case_tittle']=$this->mdl_judicial_cases->get_cases_title();
                $data["main"] = "judicail_cases/edit_file";
                $this->load->view('judicial_work_template/template', $data);
                
            }
            
        }

         public function update()
        {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('suing_party', 'Suing Party', 'required');
          $this->form_validation->set_rules('defending_party', 'Defending Party', 'required');
          $this->form_validation->set_rules('case_no', 'Case No', 'required');
          if ($this->form_validation->run() == TRUE) 
        {
            $this->load->model("mdl_judicial_cases");
            $this->mdl_judicial_cases->update();
            $this->index();
        }
        else 
        {
            redirect('judicial_cases/edit/'.$this->input->post('case_id'));
        }
            
        }
        public function update_file()
        {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('suing_party', 'Suing Party', 'required');
          $this->form_validation->set_rules('defending_party', 'Defending Party', 'required');
          $this->form_validation->set_rules('case_no', 'Case No', 'required');
          if ($this->form_validation->run() == TRUE) 
        {
            $this->load->model("mdl_judicial_cases");
            $this->mdl_judicial_cases->update_file();
            //$this->index();
            redirect('judicial_cases');
        }
            
        }

                public function list_by_tehsil()
        {
            $this->load->model("mdl_judicial_cases");
            $data['cases']=$this->mdl_judicial_cases->get_list_by_tehsil();
           // print_r($data);
            $this->load->view('judicail_cases/view_file_ajax',$data);
        }
        public function list_by_mauza()
        {
            $this->load->model("mdl_judicial_cases");
            $data['cases']=$this->mdl_judicial_cases->get_list_by_mauza();
           // print_r($data);
            $this->load->view('judicail_cases/view_file_ajax',$data);
        }
        
        public function update_view_ajax()
        {
            $this->load->model("mdl_judicial_cases");
            $data['cases']=$this->mdl_judicial_cases->get_cases_date();
            $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
            $this->load->view('judicail_cases/update_view_ajax',$data);
            
        }
        
        public function update_view()
        {
            $this->load->model("mdl_judicial_cases");
            $this->mdl_judicial_cases->save_update_view();
            redirect('judicial_cases');
            
        }
        public function get_cases_court_and_district()
        {
            //$data['cases']=array();
            $this->session->set_userdata(array('selected_district_rev'=>$this->input->post('district_id')));
           // $this->session->userdata('selected_district_rev');
            $this->session->set_userdata(array('selected_court_rev'=>$this->input->post('court_id')));
            //$this->session->userdata('selected_court_rev');
            $this->load->model("mdl_court");
            $data['cases']=$this->mdl_court->cases_by_courtcategory_and_district();
          
            $this->load->view('judicail_cases/view_file_ajax',$data);
             $this->output->enable_profiler(TRUE);
//            }
//            else
//            {
//                echo '';
//            }
            
        }
      
 }