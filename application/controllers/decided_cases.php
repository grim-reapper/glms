<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Decided_cases extends CI_Controller {

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
        $this->load->model('mdl_judicial_cases');
         $data['cases']=$this->mdl_judicial_cases->get_decided_cases();
         $data['count']=$this->mdl_judicial_cases->get_count();
        $data["main"] = "decided_cases/home";
        $this->load->view('judicial_work_template/template', $data);
    }
    public function add_judgement()
    {
        $this->load->model('mdl_judicial_cases');
        $this->mdl_judicial_cases->save_judgement();
        redirect('decided_cases');
    }
    public function add_case()
    {
         $this->load->model("mdl_judicial_cases");
          $this->load->model('mdl_mauza');
        
          $this->load->library('form_validation');
          $this->form_validation->set_rules('suing_party', 'Suing Party', 'required');
          $this->form_validation->set_rules('defending_party', 'Defending Party', 'required');
          $this->form_validation->set_rules('case_no', 'Case No', 'required');
          $this->form_validation->set_rules('decided_fate', 'Case Fate', 'required');
          if ($this->form_validation->run() == TRUE) 
        {
            $this->mdl_judicial_cases->save_decided_case();
            $this->index();
        } 
        else 
            
            {
        $data['mauza'] = $this->mdl_mauza->get_mauza_list();
        $data['case_title']=$this->mdl_judicial_cases->get_cases_title();
        $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
        $data["main"] = "decided_cases/add";
        $this->load->view('judicial_work_template/template', $data);
    }
    }
    public function delete($id = 0)
    {
        if ($id == 0 or $id == '') {
            redirect('decided_cases');
        } else {
                 $this->load->model("mdl_judicial_cases");
                 $this->mdl_judicial_cases->case_decided_delete($id);
        }
    }
    
    public function edit($id)
    {
                $this->load->model("mdl_judicial_cases");
                $this->load->model('mdl_mauza');
                $data['fate_case']=$this->mdl_judicial_cases->get_fate_cases();
                $data['mauza'] = $this->mdl_mauza->get_mauza_list();
                $data['case']=$this->mdl_judicial_cases->get_case_by_id($id);
                $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
                $data['case_tittle']=$this->mdl_judicial_cases->get_cases_title();
                $data["main"] = "decided_cases/edit";
                $this->load->view('judicial_work_template/template', $data);
    }
    public function update_file()
    {
        $this->load->model("mdl_judicial_cases");
       $this->mdl_judicial_cases->update_decided_case();
       redirect('decided_cases');
    }
}

?>