<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{
	
	function test_get()
	{
	     if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }	
	  $query = $this->db->get("tbl_property_mauza");

     $mauza = $query->result_array();

	
		$mauza = @$mauza[$this->get('id')];
	
	if($mauza)
        {
            $this->response($mauza, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
		
	}
	
	function all_mauza_get()
	{
	 $query = $this->db->get("tbl_property_mauza");

     $mauza = $query->result_array();
	 
	    if($mauza)
        {
            $this->response($mauza, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any mauza!'), 404);
        }
	
	}
	
	function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	$users = array(
			1 => array('id' => 1, 'name' => 'Ghulam Mustafa', 'email' => 'info.9objects@gmail.com', 'fact' => 'Programming'),
			2 => array('id' => 2, 'name' => 'Farhan Tanveer', 'email' => 'info.9objects@gmail.com', 'fact' => 'Programming')
			
		);
		
    	$user = @$users[$this->get('id')];
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
	
	
    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
    	$users = array(
			1 => array('id' => 1, 'name' => 'Ghulam Mustafa', 'email' => 'info.9objects@gmail.com', 'fact' => 'Programming'),
			2 => array('id' => 2, 'name' => 'Farhan Tanveer', 'email' => 'info.9objects@gmail.com', 'fact' => 'Programming')
			
		);
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
  function put_user_get()
    {
		$users = array(
			1 => array('id' => 1, 'name' => 'Ghulam Mustafa', 'email' => 'info.9objects@gmail.com', 'fact' => 'Programming'),
			2 => array('id' => 2, 'name' => 'Farhan Tanveer', 'email' => 'info.9objects@gmail.com', 'fact' => 'Programming')
			
		);
		
		if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

      $this->put($this->get('id'));
	  
	     if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
	}
	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}