<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_users extends CI_Model {
	 

	public function get_users_list($group_id=0)
	{
		if($group_id!=0)
		{
		$this->db->where('g.group_id',$group_id);	
		}
		$this->db->order_by("u.username", "asc"); 
		$this->db->select('*');
		$this->db->from('users as u');
		$this->db->join('user_group as g', 'g.group_id = u.group_id','left');
		$query = $this->db->get();
        return $query->result();
	}
	public function get_user($user_id)
	{
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('users');
        return $query->row();
	}	
   public function get_group_list()
   {    
		$this->db->order_by("group_id", "asc"); 
        $query = $this->db->get('user_group');
        return $query->result();	   
   }
  	public function get_group($group_id)
	{

		$this->db->where('group_id',$group_id);
		$query = $this->db->get('user_group');
        return $query->row();
	
	}
	
   public function add_user()
   {
	   $data = array(
				'name' => $this->input->post('name'),
				'group_id ' => $this->input->post('group_id'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'phone_number ' => $this->input->post('mobile'),
				'block' => $this->input->post('active'),
				'registerDate' => date("Y-m-d H:i:s", time())
				 );
	   
	   if($this->input->post('group_id') == 1)         // Admin 
	   {
		   $data['access_level_id'] = 1 ;  
	   }
	   else if($this->input->post('group_id') == 2)    // District Group 
	   {
		 $data['access_level_id'] =  2 ;     
	   }
	   else if($this->input->post('group_id') == 3)     // Tehsil Group
	   {
		 $data['access_level_id'] =  $this->input->post('tehsil_id') ;     
	   }
	   else if($this->input->post('group_id') == 4)     // Qanungoi Group
	   {
		$data['access_level_id'] =  $this->input->post('q_id') ;    
	   }
	   else if($this->input->post('group_id') == 5)      // Patwari Group
	   {
		$data['access_level_id'] =  $this->input->post('p_id') ;    
	   }
	   else if($this->input->post('group_id') == '')     // if group is not selected 
	   {
		$data['access_level_id'] = '0' ;    
	   }
	   
	   
	   $this->db->insert('users',$data);
	   $user_id  =  $this->db->insert_id();
	   
	  foreach($_POST['chkpermission'] as $value)
	   {
		  $Data = array(
				  'user_roll' => $value,
				  'status' => 1,
				  'user_id' => $user_id 
				);  
		  $this->db->insert('user_roll',$Data);
	   }
   }
 
 
 public function update_user()
   {
	   $data = array(
				'name' => $this->input->post('name'),
				'group_id ' => $this->input->post('group_id'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'phone_number ' => $this->input->post('mobile'),
				'block' => $this->input->post('active'),
				'registerDate' => date("Y-m-d H:i:s", time())
			 );
	   
 
			   if($this->input->post('group_id') == 1)      // Admin 
			   {
				   $data['access_level_id'] = 1 ;
			   }
			   else if($this->input->post('group_id') == 2) // District Group 
			   {
				 $data['access_level_id'] =  2 ;     
			   }
			   else if($this->input->post('group_id') == 3) // Tehsil Group
			   {
				 $data['access_level_id'] =  $this->input->post('tehsil_id') ;     
			   }
			   else if($this->input->post('group_id') == 4)   // Qanungoi Group
			   {
				$data['access_level_id'] =  $this->input->post('q_id') ;    
			   }
			   else if($this->input->post('group_id') == 5)    // Patwari Group
			   {
				$data['access_level_id'] =  $this->input->post('p_id') ;    
			   }
			   else if($this->input->post('group_id') == '')    // if group is not selected 
			   {
				$data['access_level_id'] = '0' ;    
			   }

	   
			   if( strlen($this->input->post('password')) >= 3 )
			   {
			   $data['password'] = md5($this->input->post('password'));
			   }
			   
			   $this->db->where('user_id',$this->input->post('user_id'));
			   $this->db->update('users',$data);
			   
			   
			   // update users permissions start
			    if(!array_key_exists("chkpermission", $_POST)){
					    $data = array(
								  'status' =>0	   
								 );
						 $this->db->where('user_id',$this->input->post('user_id')); 
						 $this->db->update('user_roll',$data);  	
				}
			   
			   
			   if( array_key_exists("chkpermission", $_POST)){
			   $pre_per = array();
			   $pre_permission = $this->get_user_permission($this->input->post('user_id'));
			   foreach($pre_permission as $list )
			   {
				  $pre_per[] =   $list->user_roll;
				  if(!in_array($list->user_roll,$_POST['chkpermission']))
				  {
					 $data = array(
								'status' =>0	   
								 );
						 $this->db->where('user_id',$this->input->post('user_id'));
						 $this->db->where('user_roll',$list->user_roll);
						 $this->db->update('user_roll',$data);  
				  }
				  
				  
			   }
			  
			   
			     foreach($_POST['chkpermission'] as $value)
				   {
					 if(in_array($value, $pre_per))
					 {
						 $data = array(
								'status' =>1	   
								 );
						 $this->db->where('user_id',$this->input->post('user_id'));
						 $this->db->where('user_roll',$value);
						 $this->db->update('user_roll',$data);
					 } 
					 else 
					 {
					 
					 $Data = array(
							  'user_roll' => $value,
							  'status' => 1,
							  'user_id' => $this->input->post('user_id')
							);  
					  $this->db->insert('user_roll',$Data);
					}
				 }
				 
			   } // update users permissions start
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
				   $data['tehsil']   = 0 ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;  
				 
			   }
			   else if($group_id == 2)     // District Group 
			   {
				   $data['tehsil']   = 0 ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;    
			   }
			   else if($group_id == 3)     // Tehsil Group
			   {
				   $data['tehsil']   = $user->access_level_id ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;   
			   }
			   else if($group_id == 4)      // Qanungoi Group
			   {
				   $this->db->where('q_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_qgoi');
				   $qanungoi = $query->row();  
				   
				   $data['tehsil']   = $qanungoi->tehsil_id ;  
				   $data['qanungoi'] = $user->access_level_id ;   
				   $data['patwar']   = 0 ;   
			   }
			   else if($group_id == 5)     // Patwari Group
			   {
				    $this->db->where('p_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_patwarcircle');
				   $patwarcircle = $query->row(); 
				   
				   $data['tehsil']   = $patwarcircle->tehsil_id ;  
				   $data['qanungoi'] = $patwarcircle->q_id ;  
				   $data['patwar']   = $user->access_level_id ;  
			   }
			   else if($group_id == '')    // if group is not selected 
			   {
				   $data['tehsil']   = 0 ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;  
			   }
			   
	       	return $data ;
	   
   }
   public function get_user_permission($user_id)
   {
		$this->db->where('user_id',$user_id);
        $query = $this->db->get('user_roll');
        return $query->result();    
   }
  public function get_permission($permission ='')
   {
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('user_roll',$permission);
		$this->db->where('status',1);
        $query = $this->db->get('user_roll');
       if( $query->num_rows() > 0 )
	   {
		 return true;  
	   }
	   else
	   {
		return false;
	   }
		
   }
  
  public function delete_user($user_id)
  {
		$this->db->where('user_id',$user_id);
        $this->db->delete('users');	
		
	    $this->db->where('user_id',$user_id);
       $this->db->delete('user_log');	
		
	   $this->db->where('user_id',$user_id);
       $this->db->delete('user_roll');
  }
   public function get_user_log($user_id)
   {
        $this->db->select('l.*,u.*');
		$this->db->from('user_log as l');
		$this->db->join('users as u', 'u.user_id = l.user_id');
		$this->db->order_by("l.log_date_time", "desc"); 
		$this->db->where('l.user_id',$user_id);
		$query = $this->db->get();
        return $query->result();    
   }
   public function update_log($log='')
   {
	  $this->load->helper('date'); 
	   
	  $data = array(
					'log_detail' =>	$log,
					'user_id'    =>	 $this->session->userdata('user_id'),
					'log_date_time' =>now()
					);
    $this->db->insert('user_log',$data);  	  
	  
   } 
  public function update_pass()
  {

     if( strlen($this->input->post('password')) >= 3 )
	  {
		 $data['password'] = md5($this->input->post('password'));
	   }
			   
	$this->db->where('user_id',$this->input->post('user_id'));
	$this->db->update('users',$data);	  
  }
}

?>