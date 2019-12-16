<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	function index()
	{
		
		$this->load->view('welcome_message');
	}
	
  public function test()
 {
    $list = json_decode(  
      //  file_get_contents(site_url('api/example/users'))  
	'  {"id":1,"name":"Ghulam Mustafa","email":"info.9objects@gmail.com","fact":"Programming"}'
    );  
      
    echo $list->name;  	
 }
}
