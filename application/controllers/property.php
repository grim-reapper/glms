<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {
	
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

 public function index($owner='common')
	{
		 if(!$this->mdl_users->get_permission('property_view'))
		  {
			 redirect('dashboard'); 
		  }	 
		$this->load->model("mdl_property");
		$this->load->model("mdl_mauza");
		$this->load->model("mdl_patwarcircle");
		$this->load->model("mdl_qanungoicircle");
		$this->load->model("mdl_subdivision");
                $data['d_lists'] = $this->mdl_subdivision->division_list();
                $data['dis_lists'] = $this->mdl_subdivision->district_list();
		
		
$user_level = $this->mdl_users->user_level_property($this->session->userdata('user_id'));
		$data["user_level"]   = $user_level;
		
		
		if($this->session->userdata('group_id') == 1 or  $this->session->userdata('group_id') == 2)
		{
			$data["mauza_list"]             = $this->mdl_mauza->get_mauza_list();
			$data["patwarcircle_list"]      = $this->mdl_patwarcircle->get_patwarcircle_list();
			$data["qanungoicircle_list"]    = $this->mdl_qanungoicircle->get_qanungoicircle_list();
			$data["subdivision_list"]       = $this->mdl_subdivision->get_subdivision_list();
						
		}
		else if($this->session->userdata('group_id') == 3)
		{
			$data["mauza_list"]             = $this->mdl_mauza->mauza_list_by_tehsil_id($user_level['tehsil']);
			$data["patwarcircle_list"]      = $this->mdl_patwarcircle->patwarcircle_list_by_tehsil_id($user_level['tehsil']);
			$data["qanungoicircle_list"]    = $this->mdl_qanungoicircle->qanungoicircle_list_by_tehsil_id($user_level['tehsil']);
			$data["subdivision_list"]       = $this->mdl_subdivision->get_subdivision_by_id($user_level['tehsil']);
		}
		else if($this->session->userdata('group_id') == 4)
		{
			$data["mauza_list"]             = $this->mdl_mauza->mauza_list_by_q_id($user_level['qanungoi']);
			$data["patwarcircle_list"]      = $this->mdl_patwarcircle->patwarcircle_list_by_qanungoicircle_id($user_level['qanungoi']);
			$data["qanungoicircle_list"]    = $this->mdl_qanungoicircle->get_qanungoicircle($user_level['qanungoi']);
			$data["subdivision_list"]       = $this->mdl_subdivision->get_subdivision_by_id($user_level['tehsil']);
		}
		else if($this->session->userdata('group_id') == 5)
		{
			$data["mauza_list"]             = $this->mdl_mauza->mauza_list_by_patwarcircle_id($user_level['patwar']);
			$data["patwarcircle_list"]      = $this->mdl_patwarcircle->get_patwarcircle($user_level['patwar']);
			$data["qanungoicircle_list"]    = $this->mdl_qanungoicircle->get_qanungoicircle($user_level['qanungoi']);
			$data["subdivision_list"]       = $this->mdl_subdivision->get_subdivision_by_id($user_level['tehsil']);
		}

		
		
		$data['property_list']       =  $this->mdl_property->properties($owner);
		$data["main"] ="property/home";
		$this->load->view('property/template',$data);
	}
	
 public function ajax_property_list()
	{
		$this->load->model("mdl_property");
		$data['property_list']       = $this->mdl_property->get_ajax_property_list();
		$this->load->view('property/property_ajax_list',$data);
	}
	
 public function new_property()
	{
		$this->load->model("mdl_mauza");
		$this->load->model("mdl_patwarcircle");
		$this->load->model("mdl_qanungoicircle");
		$this->load->model("mdl_subdivision");
		
		
		$data["mauza_list"]          = $this->mdl_mauza->get_mauza_list();
		$data["patwarcircle_list"]   = $this->mdl_patwarcircle->get_patwarcircle_list();
		$data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
		$data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
		
		$data["main"] ="property/new_property";
		
		$this->load->view('property/template',$data);
	}
 public function save()
 {

		$this->load->model("mdl_property");
		$this->mdl_property->save();
		redirect("property");
	
 }
 
 
 public function property_ajax_elements()
 {
	$data['type'] = $this->input->post("type");
	
	switch($this->input->post("type"))
	{
		case 'district':
		{
			$this->load->model("mdl_subdivision");
			$data["district_list"] = $this->mdl_subdivision->district_list_by_division();
			$this->load->view('property/property_ajax_element',$data);
			break;
		}
		case 'subdiv':
		{
			$this->load->model("mdl_qanungoicircle");
                        $data["subdiv_list"] = $this->mdl_qanungoicircle->tehsil_list_by_district();
			$this->load->view('property/property_ajax_element',$data);
			break;
		}
		case 'qc':
		{
			$this->load->model("mdl_qanungoicircle");
			$data["qanungoicircle_list"] = $this->mdl_qanungoicircle->qanungoicircle_list_by_tehsil();
			$this->load->view('property/property_ajax_element',$data);
			break;
		}
		case 'pc':
		{
			$this->load->model("mdl_patwarcircle");
			$data["patwarcircle_list"] = $this->mdl_patwarcircle->patwarcircle_list_by_qanungoicircle();
			$this->load->view('property/property_ajax_element',$data);
			break;			
		}
	   case 'mauza':
		{
			$this->load->model("mdl_mauza");
			$data["mauza_list"] = $this->mdl_mauza->mauza_list_by_patwarcircle();
			$this->load->view('property/property_ajax_element',$data);
			
			break;			
		}
	}
 }
 
 
 public function property_detail($id = 0)
 {
	    if($id == 0)
		{
			redirect("property");
		}
		
		
		$this->load->model("mdl_property");
		$this->load->model("mdl_mauza");
		
		$property = $this->mdl_property->properties_detail($id);
		
		if($property->occupation_type =='illegal_occupation')
		{
		  $data['private_occupant']    =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $private_occupant            =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $data['p_occupant_list']     =  $this->mdl_property->p_occupant_list_by_occupant_id($private_occupant->occupant_id);
		  
		}
	    else if($property->occupation_type =='lease_occupation')
		{
		  $data['private_occupant']    =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $private_occupant            =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $data['p_occupant_list']     =  $this->mdl_property->p_occupant_list_by_occupant_id($private_occupant->occupant_id);
		  
		}
	   else if($property->occupation_type =='private_occupation')
		{
		  $data['private_occupant']    =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $private_occupant            =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $data['p_occupant_list']    =  $this->mdl_property->p_occupant_list_by_occupant_id($private_occupant->occupant_id);
		  
		}
		else if($property->occupation_type =='deptt_occupation')
		{
		 $data['deptt_occupation']   =  $this->mdl_property->deptt_occupation_by_property_id($id);	
		}
		
		$data['property']            =  $this->mdl_property->properties_detail($id);
		$data["main"]                =  "property/detail";
		  
		$this->load->view('property/template',$data);	  
	 
 }
 
 public function edit_property($id=0)
 {
	   if($id == 0)
		{
			redirect("property");
		}
		
		$this->load->model("mdl_property");
		$this->load->model("mdl_mauza");
		
		$property = $this->mdl_property->properties_detail_edit($id);
		
		if($property->occupation_type =='illegal_occupation')
		{
		  $data['private_occupant']    =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $private_occupant            =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $data['p_occupant_list']    =  $this->mdl_property->p_occupant_list_by_occupant_id($private_occupant->occupant_id);
		  
		}
	    else if($property->occupation_type =='lease_occupation')
		{
		  $data['lease_occupation']    =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $lease_occupation            =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $data['l_occupant_list']    =  $this->mdl_property->p_occupant_list_by_occupant_id($lease_occupation->occupant_id);
		  
		}
		
		else if($property->occupation_type =='private_occupation')
		{
		  $data['private_occupant']    =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $private_occupant            =  $this->mdl_property->private_occupant_by_property_id($id);
		  
		  $data['p_occupant_list']    =  $this->mdl_property->p_occupant_list_by_occupant_id($private_occupant->occupant_id);
		  
		}
		else if($property->occupation_type =='deptt_occupation')
		{
		 $data['deptt_occupation']   =  $this->mdl_property->deptt_occupation_by_property_id($id);	
		}
		
		$data["mauza_list"]          = $this->mdl_mauza->get_mauza_list();
		$data['property']            =  $this->mdl_property->properties_detail_edit($id);
		$data["main"]                =  "property/edit_property";
		  
		$this->load->view('property/template',$data);	  
	 
 }
  public function edit()
 {

		$this->load->model("mdl_property");
		$this->mdl_property->edit();
		redirect("property");
	
 }

 
 public function delete_property($id) {
	 
	    $this->load->model('mdl_property');
        $this->mdl_property->delete($id);

		redirect('property');
    }

 
}

