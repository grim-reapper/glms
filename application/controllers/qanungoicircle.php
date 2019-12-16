<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qanungoicircle extends CI_Controller {
	
 public function __construct()
  {
    parent::__construct();

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		
 	if(!$this->mdl_sessions->is_login())
	 {
	   redirect('sessions/login');
	 }
   }
        public function index()
	{
			$this->load->model("mdl_qanungoicircle");
                        $this->load->model("mdl_subdivision");
                        $data['d_lists'] = $this->mdl_subdivision->division_list();
                        $data['dis_lists'] = $this->mdl_subdivision->district_list();
                        $data['subdiv_list'] = $this->mdl_subdivision->get_subdivision_list();
			$data["q_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list_with_qgoi();
			$data["main"] ="qanungoicircle/home";
			$this->load->view('management/template',$data);
	}

	public function edit($q_id = 0)
	{
		if($q_id== 0 or $q_id == '')
		{
		    redirect('qanungoicircle');	
		}
		else
		{
			$this->load->model("mdl_subdivision");
			$this->load->model("mdl_qanungoicircle");
                        $data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
			$data["q_list"]              = $this->mdl_qanungoicircle->get_qanungoicircle($q_id);
			$data["main"]                = "qanungoicircle/edit";
			$this->load->view('management/template',$data);		
		}
    }
  public function update()
  {
	  	$this->load->library('form_validation');
                $this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
                $this->form_validation->set_rules('q_circle', 'Qanungoi Circle', 'required');
		if ($this->form_validation->run() == TRUE)
		{
                  $this->load->model("mdl_qanungoicircle");
		  $this->mdl_qanungoicircle->update();
		  redirect('qanungoicircle');
		}
  }
   
   public function add()
   {
	   	$this->load->library('form_validation');
                $this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
                $this->form_validation->set_rules('q_circle', 'Qanungoi Circle', 'required');
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_qanungoicircle");
		   $this->mdl_qanungoicircle->add();
		   redirect('qanungoicircle');
		}
		else
		{
			$this->load->model("mdl_subdivision");	
			$data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
			$data["main"]				 = "qanungoicircle/add";
			$this->load->view('management/template',$data);	
		}
   }
   
   public function qanungoi_circle_ajax_list()
	{
			$this->load->model("mdl_qanungoicircle");
                        $data["qanungoi"] = $this->mdl_qanungoicircle->ajax_qanungoicircle_list();
			$this->load->view("qanungoicircle/ajax_file",$data);
	}
         public function property_ajax_elements()
 {
	$data['type'] = $this->input->post("type");
	switch($this->input->post("type"))
	{
		case 'division':
		{
			$this->load->model("mdl_subdivision");
			$data["district_list"] = $this->mdl_subdivision->district_list_by_division();
			$this->load->view('qanungoicircle/ajax_element',$data);
			break;
		}
                case 'subdiv':
                {
                    $this->load->model("mdl_qanungoicircle");
                    $data["subdiv_list"] = $this->mdl_qanungoicircle->tehsil_list_by_district();
                    $this->load->view('qanungoicircle/ajax_element',$data);
                    break;
                }
      }
 }
}

