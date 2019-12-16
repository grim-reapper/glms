<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patwarcircle extends CI_Controller {
	
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
	   
		$this->load->model('mdl_patwarcircle');
                $this->load->model("mdl_qanungoicircle");
                $this->load->model("mdl_subdivision");
                $data['d_lists'] = $this->mdl_subdivision->division_list();
                $data['dis_lists'] = $this->mdl_subdivision->district_list();
                $data['subdiv_list'] = $this->mdl_subdivision->get_subdivision_list();
                $data["q_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list_with_qgoi();
		$data['patwarcircle_list'] = $this->mdl_patwarcircle->get_patwarcircle_list_with_detail();
		$data["main"] ="patwarcircle/home";
		$this->load->view('management/template',$data);
	}
	public function add()
	{
	    
		$this->load->model("mdl_patwarcircle");
		$this->load->model("mdl_qanungoicircle");
		$this->load->model("mdl_subdivision");
		
		$this->load->library('form_validation');
        $this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
	    $this->form_validation->set_rules('q_id', 'Qanungoi Circle', 'required');
	    $this->form_validation->set_rules('patwar_circle', 'Patwar Circle', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
		 $this->mdl_patwarcircle->add();
		 redirect("patwarcircle");
		}
		else
		{
			$data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
			$data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
			$data["main"] ="patwarcircle/add";
			$this->load->view('management/template',$data);
		}
    }

	public function edit($p_id = 0)
	{
		
		if($p_id == 0 or $p_id=='')
		{
			redirect("patwarcircle");
		}
		else
		{
			$this->load->model("mdl_patwarcircle");
			$this->load->model("mdl_qanungoicircle");
			$this->load->model("mdl_subdivision");
			
			$data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
			$data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
			$data["p_list"]              = $this->mdl_patwarcircle->get_patwarcircle($p_id);
			$data["main"] 				 = "patwarcircle/edit";
			$this->load->view('management/template',$data);	
		}
 		
    }
	
 public function update()
  {
	   
       	    $this->load->library('form_validation');
            $this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
	    $this->form_validation->set_rules('q_id', 'Qanungoi Circle', 'required');
	    $this->form_validation->set_rules('patwar_circle', 'Patwar Circle', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
                  $this->load->model("mdl_patwarcircle");
		  $this->mdl_patwarcircle->update();
		  redirect('patwarcircle');
		}
		else
		{
		  redirect('patwarcircle/edit/'.$this->input->post('p_id'));	
	    }
  }
  
  public function patwar_circle_ajax_list() {
                        $this->load->model("mdl_patwarcircle");
                        $data["patwar"] = $this->mdl_patwarcircle->ajax_patwarcircle_list();
			$this->load->view("patwarcircle/ajax_file",$data);
  }
  
  public function patwar_ajax_elements() {
      $data['type'] = $this->input->post("type");
	switch($this->input->post("type"))
	{
		case 'division':
		{
			$this->load->model("mdl_subdivision");
			$data["district_list"] = $this->mdl_subdivision->district_list_by_division();
			$this->load->view('patwarcircle/ajax_element',$data);
			break;
		}
                case 'subdiv':
                {
                    $this->load->model("mdl_qanungoicircle");
                    $data["subdiv_list"] = $this->mdl_qanungoicircle->tehsil_list_by_district();
                    $this->load->view('patwarcircle/ajax_element',$data);
                    break;
                }
                case 'qgcircle':
                {
                    $this->load->model("mdl_patwarcircle");
                    $data["main1"] = $this->mdl_patwarcircle->qgoicircle_list_by_tehsil();
                    $this->load->view('patwarcircle/ajax_element',$data);
                   // echo  $data["qgoi_list"];
                    break;
                }
      }
  }
  
}

