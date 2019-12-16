<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
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

	public function index($group_id = 0)
	{ 
	  if(!$this->mdl_users->get_permission('users_view'))
	  {
		 redirect('dashboard'); 
	  }	
		$this->load->model("mdl_users");
		$this->mdl_users->update_log('View Users List');
		if($group_id != 0)
		{
		$user_group =  $this->mdl_users->get_group($group_id);	
		  $data["user_group"] 	 = 	$user_group->group_name; 
		}
		else
		{
		  $data["user_group"] 	 = 'Common List';	
		}
		
		$data["user_group_list"] = $this->mdl_users->get_group_list();
		$data["users_list"]		 = $this->mdl_users->get_users_list($group_id);
		$data["main"]            =  "users/home" ;
		$this->load->view('users/template',$data);
	}
	
	public function add_user()
	{
	
	 if(!$this->mdl_users->get_permission('users_add'))
	  {
		 redirect('dashboard'); 
	  }	
		$this->load->model("mdl_users");
 		$this->load->library('form_validation');
	    $this->load->model("mdl_qanungoicircle");
		$this->load->model("mdl_subdivision");
		
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				
		if ($this->form_validation->run())
		{	
		    $name = $this->input->post('username');
		  	$this->mdl_users->update_log('add user with usernam:'.$name);
			$this->mdl_users->add_user();
			redirect('users');
		}
		else
		{
                    $data["user_group_list"] = $this->mdl_users->get_group_list();
	            $data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
		    $data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
		    $data["group_list"] = $this->mdl_users->get_group_list();
		   $data["main"] = "users/add_user";
		   $this->load->view('users/template',$data);  
		}
	}
	
	public function view_detail($user_id = 0)
	{
	  
	  if(!$this->mdl_users->get_permission('users_view'))
	  {
		 redirect('dashboard'); 
	  }
	  
		if($user_id == 0)
		{
			redirect('users');
	    }
		else
		{
			$this->load->model("mdl_users");
			$user = $this->mdl_users->get_user($user_id);
			
			$this->mdl_users->update_log('view user profile of '.$user->username);  // log 
			
			$user_level_property = $this->mdl_users->user_level_property($user_id);
			$group_id = $user->group_id; 	
			  if($group_id == 1)  //    Admin
			   {
				   $data['access_level']   = 'Admin Group' ;  
			   }
			   else if($group_id == 2)     // District Group 
			   {
				     $data['access_level']   = 'District Group ' ;  
			   }
			   else if($group_id == 3)     // Tehsil Group
			   {
					 $query = $this->db->get_where('tbl_property_tehsils',array('tehsil_id' => $user->access_level_id)); 
					 $tehil = $query->row();
					 $data['tehsil_name'] = $tehil->tehsil_name; 
					 $data['access_level']   = 'Tehsil Group' ;  
					 
			   }
			   else if($group_id == 4)     // Qanungoi Group
			   {
					 $query = $this->db->get_where('tbl_property_qgoi',array('q_id' => $user->access_level_id)); 
					 $qanungoi = $query->row();
					 $data['qanungoi_name'] = $qanungoi->q_circle; 
					 
				     $data['access_level']   = 'Qanungoi Group' ;  
			   }
			   else if($group_id == 5)    // Patwari Group
			   {
					 $query        = $this->db->get_where('tbl_property_patwarcircle',array('p_id' => $user->access_level_id)); 
					 $patwarcircle = $query->row();
					 $data['patwarcircle'] = $patwarcircle->patwar_circle; 
				     $data['access_level']   = 'Patwari Group' ;    
			   }
			   
                       $data["user_group_list"] = $this->mdl_users->get_group_list();
		       $data["user"]		            =  $this->mdl_users->get_user($user_id);
		       $data["user_level_property"]    =  $user_level_property;
		       $data["user_permission"]		=  $this->mdl_users->get_user_permission($user_id);
	     	       $data["main"] = "users/detail";
			$this->load->view('users/template',$data);  	
		}
		
    }
	
	public function edit_user($user_id = 0)
	{
	  
	 if(!$this->mdl_users->get_permission('users_edit'))
	  {
		 redirect('dashboard'); 
	  }
		
		if($user_id == 0)
		{
			redirect('users');
	    }
		else
		{
		  
		   $this->load->model("mdl_users");
		   $this->load->model("mdl_patwarcircle");
		   $this->load->model("mdl_qanungoicircle");
		   $this->load->model("mdl_subdivision");
		   $user  = $this->mdl_users->get_user($user_id);
           $this->mdl_users->update_log('Edit user profile of '.$user->username );

		   $data["patwarcircle_list"]   = $this->mdl_patwarcircle->get_patwarcircle_list();
		   $data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
		   $data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();	
		   $data["group_list"]          = $this->mdl_users->get_group_list();
		   $data["user"]		        = $this->mdl_users->get_user($user_id);
		   $data["user_level"]		    = $this->mdl_users->user_level_property($user_id);
		   $data["user_permission"]		= $this->mdl_users->get_user_permission($user_id);
		   $data["main"]	            = "users/update_user";
		   $data["user_group_list"] = $this->mdl_users->get_group_list();
		   $this->load->view('users/template',$data);  
		   
		}	
		
		
    }
	public function chnage_pass($user_id = 0)
	{
		if($user_id == 0)
		{
			redirect('dashboard');
	    }
		else
		{
			$this->load->model("mdl_users");
		   $user            = $this->mdl_users->get_user($user_id);
		   $data["user"]    = $this->mdl_users->get_user($user_id);
		   $data["main"]	= "users/change_pass";
		   
		   $this->load->view('users/template',$data); 		   
		}
    }

  public function update_pass()
  {
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run())
		{	
		   $name = $this->input->post('username');
		   $this->mdl_users->update_log($name. 'change own password' );
		   $this->mdl_users->update_pass();
		   redirect('dashboard');
		}  
  }
	
	public function update_user()
	{
	        
		     $this->load->model("mdl_users");	
			 $this->mdl_users->update_user();
			 redirect('users');
	}
	
	public function delete_user($user_id = 0)
	{
	 
	 if(!$this->mdl_users->get_permission('users_delete'))
	  {
		 redirect('dashboard'); 
	  }
	  
		if($user_id == 0)
		{
			redirect('users');
	    }
		else
		{
			
			 $this->load->model("mdl_users");	
			 $user  = $this->mdl_users->get_user($user_id);
             $this->mdl_users->update_log('Deleted user  '.$user->username);
		   
			 $this->mdl_users->delete_user($user_id);
			 redirect('users');
			
		}		
		
    }
	public function log_view($user_id = 0)
	{
	
	 if(!$this->mdl_users->get_permission('users_log'))
	  {
		 redirect('dashboard'); 
	  }	
	  
		if($user_id == 0)
		{
			redirect('users');
	    }
		else
		{
		    $this->load->model("mdl_users");
			$user  = $this->mdl_users->get_user($user_id);
			$this->mdl_users->update_log('viewed  user log  of '.$user->username);
		    $data["user_log"]		=  $this->mdl_users->get_user_log($user_id);
	     	$data["main"]           = "users/user_log";
                $data["user_group_list"] = $this->mdl_users->get_group_list();
			$this->load->view('users/template',$data); 
		}		
		
		
    }
}

