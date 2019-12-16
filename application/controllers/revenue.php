<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Revenue extends CI_Controller {

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
    
     public function index() {
         
         $this->load->model("mdl_revenue");
         $data["revenue_files"]=$this->mdl_revenue->get_revenue_records();
          $data["main"] = "revenue/home";
        $this->load->view('catalogmanagement/template', $data);
     }
     public function add()
     {
          $this->load->model("mdl_revenue");
          $this->load->model('mdl_filescatalog');
          $this->load->model('mdl_districts');
          $this->load->model('mdl_mauza');
          $this->load->model('mdl_subdivision');
          $this->load->library('form_validation');
          $this->form_validation->set_rules('no_of_mutations', 'Mutations', 'required');
          if ($this->form_validation->run() == TRUE) {
            $this->mdl_revenue->save_revenue_file();
            $this->index();
        } else {
          $data['district'] = $this->mdl_districts->get_districts_list();
          $data['mauza'] = $this->mdl_mauza->get_mauza_list();
          $data['subdiv'] = $this->mdl_subdivision->get_subdivision_list();
          $data["main"] = "revenue/add";
          $this->load->view('catalogmanagement/template', $data);
         
     }
     }
     public function file_view($id)
     {
         if ($id == 0 or $id == '') {
            redirect("revenue");
        } else {
          $this->load->model("mdl_revenue");
          $data['file']=$this->mdl_revenue->get_file_by_id($id);
          $data["main"] = "revenue/file_view";
            $this->load->view('catalogmanagement/template', $data);
        }
     }

          public function delete($id = 0) {

        if ($id == 0 or $id == '') {
            redirect('revenue');
        } else {
                 $this->load->model("mdl_revenue");
                 $this->mdl_revenue->revenue_file_delete($id);
        }
    }
    
    public function edit($id=0)
    {
        if($id == 0 or $id=='')
		{
			redirect("revenue");
		}
		else
		{
                    $this->load->model('mdl_districts');
                    $this->load->model("mdl_revenue");
                    $this->load->model('mdl_mauza');
                    $this->load->model('mdl_subdivision');
                    $data['mauza'] = $this->mdl_mauza->get_mauza_list();
                    $data['subdiv'] = $this->mdl_subdivision->get_subdivision_list();
                    $data['district'] = $this->mdl_districts->get_districts_list();
                    $data["file"] =$this->mdl_revenue->get_file_by_id($id);
                    $data["main"] = "revenue/edit_file";
                    $this->load->view('catalogmanagement/template', $data);
                    
                }
                
        
    }
    
    public function update()
    {
        $this->load->model("mdl_revenue");
         $this->load->library('form_validation');
          $this->form_validation->set_rules('no_of_mutations', 'Mutations', 'required');
          if ($this->form_validation->run() == TRUE) {
            $this->mdl_revenue->update_revenue_file();
            $this->index();
        } else {
             redirect('revenue/edit/'.$this->input->post('revenue_id'));
            
        }
    }
    
    public function get_subdiv_by_district()
    {
        $this->load->model("mdl_revenue");
        $data['subdiv'] = $this->mdl_revenue->subdiv_by_district();
        $this->load->view('revenue/subdiv_by_district', $data);
    }
    public function get_mauza_by_subdiv()
    {
        $this->load->model("mdl_revenue");
        $data['mauza'] = $this->mdl_revenue->mauza_by_subdiv();
        $this->load->view('revenue/mauza_by_subdiv', $data);
    }
}
