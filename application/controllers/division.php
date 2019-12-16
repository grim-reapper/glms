<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Division extends CI_Controller {
	
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
	   
	    $this->load->model("mdl_division");
		$data['lists'] = $this->mdl_division->get_division_list();
		$data["main"] ="divisions/home";
		$this->load->view('management/template',$data);
	}
   public function add()
   {
	$this->load->library('form_validation');
        $this->form_validation->set_rules('division_name', 'Divisions', 'required|is_unique[tbl_property_divisions.division_name]');
        $this->form_validation->set_rules('division_area', 'Area', 'required');
        $this->form_validation->set_rules('division_capital', 'Capital', 'required');
        $this->load->model('mdl_division');
        $data['province']=$this->mdl_division->get_province_list();
	   
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_division");
		   $this->mdl_division->get_division_add();
                   redirect('division');
		}
		else
		{
			$data["main"] ="divisions/add";
			$this->load->view('management/template',$data);  
		}
   }

   public function edit($id = 0)
   {
       
       
	  
	   if($id==0  or $id == '')
	   {
		 redirect('division');   
	   }
	   else
	   {
	    $this->load->model("mdl_division");
		$data['division'] = $this->mdl_division->get_division_by_id($id);
                 $data['province_list']=$this->mdl_division->get_province_list();
		$data["main"] ="divisions/edit";
		$this->load->view('management/template',$data); 
                
	   }
   }
 
  public function update()
  {
 	 $this->load->library('form_validation');
        $this->form_validation->set_rules('division_name', 'Divisions', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
		   $this->load->model("mdl_division");
		   $this->mdl_division->division_update();
		}
  }
  public function delete($id=0)
  {
	 
	 if($id==0  or $id == '')
	   {
		   redirect('division');   
	   }
	   else
	   {
		   $this->load->model("mdl_division");
		   $this->mdl_division->division_delete($id);	 
	   }
  }
}

