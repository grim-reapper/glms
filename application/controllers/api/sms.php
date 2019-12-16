<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Sms extends REST_Controller
{
	
  function litigation_get()
	{
	 $this->load->model('mdl_litigation');
	$litigation =  $this->mdl_litigation->get_sms();
		
	if($litigation)
        {
		   
            $this->response($litigation, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 1), 404);
        }
		
	}
		

}