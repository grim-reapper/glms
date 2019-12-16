<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Sessions extends CI_Model {
	 

	public function auth($username, $password) {
		
		$this->db->where('username', $username);
		$this->db->where('block', 0);
		$this->db->where('password', $password);
        
		$query = $this->db->get('users');

		if ($query->num_rows() == 1)
		{
			  $user = $query->row();
			  
			  $this->set_data($user->user_id);
			  return true;
			
        }
        else 
		{
			  $this->session->set_userdata('custom_error', 'Either your username or password is incorrect.');
			  redirect('sessions/login');

		}

	}

	
	public function is_login()
	{
       
		  $logged_in = $this->session->userdata('logged_in');
		  $guest     = $this->session->userdata('guest');
		  if($logged_in ==1  and  $guest == 0)
		  {
			 
			 return true;
			  
		  }	
		  else
		  { 
		  
			 return false;  
		  }
		  
	}
   public function set_data($id = 1){
	   
	    $this->load->helper('date');
		
	   
	    $this->db->where('user_id', $id);
		$query = $this->db->get('users');
		$user = $query->row();
		
	    $group =  $this->user_level_property($id);
		
		  $newdata = array(
					   'user_id'  => $id,
					   'logged_in' => 1,
					   'name' => $user->name ,
					   'username' => $user->username,
					   'email' => $user->email,
					   'block ' => $user->block,
					   'group_id' => $user->group_id,
					   'group_name' => $group['name'],
					   'group_level' => $group['level'],
					   'guest' => 0
					 );
	
		  $this->session->set_userdata($newdata);
		  
		  
			 $data = array('lastvisitDate'  => now());
			 $this->db->where('user_id', $id);
			 $this->db->update('users',$data); 
		
	
	   
	   }
	   
	   
 public function user_level_property($user_id)
   {
	    $this->db->where('user_id',$user_id);
        $query = $this->db->get('users');
        $user = $query->row();
		$group_id = $user->group_id;
		$data = array();
		
		      if($group_id == 1)  //    Admin
			   {
				   $data['name']     = '';  
				   $data['level']    = 'Admin Group' ;  
				
				 
			   }
			   else if($group_id == 2)     // District Group 
			   {
	               $data['name']     = '';  
				   $data['level']    = 'District Group' ;     
			   }
			   else if($group_id == 3)     // Tehsil Group
			   {
				   $this->db->where('tehsil_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_tehsils');
				   $tehsil = $query->row();  
				   
	               $data['name']     = $tehsil->tehsil_name;  
				   $data['level']    ='Tehsil Group' ;   
			   }
			   else if($group_id == 4)      // Qanungoi Group
			   {
				   $this->db->where('q_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_qgoi');
				   $qanungoi = $query->row();
				   
		           $data['name']     = $qanungoi->q_circle;  
				   $data['level']    ='Qanungoi Group';   
				   
			   }
			   else if($group_id == 5)     // Patwari Group
			   {
				    $this->db->where('p_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_patwarcircle');
				   $patwarcircle = $query->row();
				   
		           $data['name']     = $patwarcircle->patwar_circle;  
				   $data['level']    ='Patwari Group';   				   

			   }
			   else if($group_id == '')    // if group is not selected 
			   {
		           $data['name']     ='';  
				   $data['level']    ='';   
			   }
			   
	       	return $data ;
	   
   }
  
	public function logout()
	{
			 
		$data = array();
		$this->session->set_userdata($data);
		$this->session->sess_destroy(); 
	  
	}

}

?>