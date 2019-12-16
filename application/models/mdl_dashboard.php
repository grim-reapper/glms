<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_dashboard extends CI_Model {
	 

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
		  $guest = $this->session->userdata('guest');
		  if($logged_in ==1  and  $guest == 0)
		  {
			  return 1;
		  }	
		  else
		  {
		     return 0;  
		  }
		  
	}
   public function set_data($id = 1){
	   
	    $this->db->where('user_id', $id);
		$query = $this->db->get('users');
		$user = $query->row();
		
		  $newdata = array(
					   'user_id'  => $id,
					   'logged_in' => 1,
					   'name' => $user->name ,
					   'username' => $user->username,
					   'email' => $user->email,
					   'usertype' => $user->usertype,
					   'block ' => $user->block,
					   'guest' => 0
					 );
	
		  $this->session->set_userdata($newdata);
	   }
	public function login_user_list()
	{
		$this->db->where('',);
		$query = $this->db->get("ci_sessions");
		
		
    }
	public function logout()
	{
	   $this->session->sess_destroy();
	}

}

?>