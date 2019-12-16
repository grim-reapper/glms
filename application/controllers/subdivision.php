<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subdivision extends CI_Controller {
	
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
	   
	    $this->load->model("mdl_subdivision");
		$data['subdivision_list'] = $this->mdl_subdivision->get_subdivision_list();
                $data['d_lists'] = $this->mdl_subdivision->division_list();
                $data['dis_lists'] = $this->mdl_subdivision->district_list();
		$data["main"] ="subdivision/home";
		$this->load->view('management/template',$data);
	}
   public function add()
   {
            $this->load->model('mdl_districts');
            $data['dist']=$this->mdl_districts->get_districts_list();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tehsil_name', 'Sub Division', 'required|is_unique[tbl_property_tehsils.tehsil_name]');
	   
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_subdivision");
		   $this->mdl_subdivision->get_subdivision_add();
		}
		else
		{
			$data["main"] ="subdivision/add";
			$this->load->view('management/template',$data);  
		}
   }

   public function edit($id = 0)
   {
	  
	   if($id==0  or $id == '')
	   {
		 redirect('subdivision');   
	   }
	   else
	   {
	    $this->load->model("mdl_subdivision");
		$data['subdivision'] = $this->mdl_subdivision->get_subdivision_by_id($id);
		$data["main"] ="subdivision/edit";
		$this->load->view('management/template',$data);   
	   }
   }
 
  public function update()
  {
 	    $this->load->library('form_validation');
        $this->form_validation->set_rules('tehsil_name', 'Sub Division', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_subdivision");
		   $this->mdl_subdivision->get_subdivision_update();
		}
  }
  public function delete($id=0)
  {
	 
	 if($id==0  or $id == '')
	   {
		   redirect('subdivision');   
	   }
	   else
	   {
		   $this->load->model("mdl_subdivision");
		   $this->mdl_subdivision->subdivision_delete($id);	 
	   }
  }
  
  public function ajax_property_list(){
      
                $this->load->model("mdl_subdivision");
		$data['district_list'] = $this->mdl_subdivision->get_ajax_list();
		$this->load->view('subdivision/ajax_file',$data);
      
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
			$this->load->view('subdivision/ajax_element',$data);
			break;
		}
        }
 }
}

