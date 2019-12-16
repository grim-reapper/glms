<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {  

public function index()
	{ 
	
	
     if($this->mdl_sessions->is_login())
		{
		  redirect("dashboard");	
		}
		else
		{
		  $this->login(); 	
		}
	}
  public function login()
  {
     
				
		    	$this->load->library('form_validation');
				
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
				
				if ($this->form_validation->run())
				{
					//echo $this->mdl_sessions->auth($this->input->post('username'), md5($this->input->post('password')));
					if($this->mdl_sessions->auth($this->input->post('username'), md5($this->input->post('password'))))
					{
						redirect("dashboard");
					}
					else
					{
				    	$this->load->view("sessions/login_form"); 
					}
				 
				}
				else
				{
			    	$this->load->view("sessions/login_form"); 	
			    }
	 
  }
  
  public function logout()
  {
	  $this->session->sess_destroy();

      $this->index();
  }
  
}

