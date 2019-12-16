<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Districts extends CI_Controller {
	
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
	   
	    $this->load->model("mdl_districts");
		$data['lists'] = $this->mdl_districts->get_districts_list();
		$data['d_lists'] = $this->mdl_districts->division_list();
                
		$data["main"] ="districts/home";
		$this->load->view('management/template',$data);
	}
   public function add()
   {
             $this->load->model("mdl_districts");
             $data['divisions'] = $this->mdl_districts->division_list();
	    $this->load->library('form_validation');
        $this->form_validation->set_rules('district_name', 'Districts', 'required|is_unique[tbl_property_districts.district_name]');
	   
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_districts");
		   $this->mdl_districts->districts_add();
		}
		else
		{
			$data["main"] ="districts/add";
			$this->load->view('management/template',$data);  
		}
   }

   public function edit($id = 0)
   {
	  
	   if($id==0  or $id == '')
	   {
		 redirect('districts');   
	   }
	   else
	   {
	    $this->load->model("mdl_districts");
		$data['dist'] = $this->mdl_districts->get_districts_by_id($id);
		$data["main"] ="districts/edit";
		$this->load->view('management/template',$data);   
	   }
   }
 
  public function update()
  {
 	    $this->load->library('form_validation');
        $this->form_validation->set_rules('district_name', 'Districts', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_districts");
		   $this->mdl_districts->districts_update();
		}
  }
  
  public function ajax_property_list() {
      
                $this->load->model("mdl_districts");
		$data['division_list'] = $this->mdl_districts->get_ajax_property_list();
		$this->load->view('districts/property_ajax_list',$data);
  }

  public function delete($id=0)
  {
	 
	 if($id==0  or $id == '')
	   {
		   redirect('districts');   
	   }
	   else
	   {
		   $this->load->model("mdl_districts");
		   $this->mdl_districts->districts_delete($id);	 
	   }
  }
}

