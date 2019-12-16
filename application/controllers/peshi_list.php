<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peshi_list extends CI_Controller {

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
        $this->load->model("mdl_judicial_cases");
        $this->load->model("mdl_court");
        $data['case_proceedings']=$this->mdl_judicial_cases->get_cases_proceedings();
        $data['groups']= $this->mdl_court->get_groups();
        $data["main"] = "peshi/home";
        $this->load->view('judicial_work_template/template', $data);
    }
    public function get_proceedings_by_group_id()
    {   
        $this->load->model('mdl_judicial_cases');
        $id=$this->input->post('block_id');
        $data['proceedings']=$this->mdl_judicial_cases->get_peshi_data($id);
        $this->load->view('peshi/show_proceedings',$data);
        
    }
    public function generate_list()
    {
         $this->load->model('mdl_judicial_cases');
        $block[0]=$this->input->post('block_1');
        $block[1]=$this->input->post('block_2');
        $block[2]=$this->input->post('block_3');
        $block[3]=$this->input->post('block_4');
        $data['date']=$this->input->post('date');
        
        for($i=0; $i<count($block); $i++)
        {
            $groupname=$this->mdl_judicial_cases->get_group_id($block[$i]);
            $group_names[$i]=$groupname;
          //$group_id[$i]=$groupname->group_name;
           //echo $groupname;
        }
        $data['groups']=$group_names;
        
         $this->load->view('peshi/peshi_list',$data);
        
    }
    public function generate_list_court()
    {
         $this->load->model('mdl_judicial_cases');
        $block[0]=$this->input->post('block_1');
        $block[1]=$this->input->post('block_2');
        $block[2]=$this->input->post('block_3');
        $block[3]=$this->input->post('block_4');
        $data['date']=$this->input->post('date');
        
        for($i=0; $i<count($block); $i++)
        {
            $groupname=$this->mdl_judicial_cases->get_group_id($block[$i]);
            $group_names[$i]=$groupname;
          //$group_id[$i]=$groupname->group_name;
           //echo $groupname;
        }
        $data['groups']=$group_names;
        
         $this->load->view('peshi/peshi_list_court',$data);
        
    }
        
    }

