<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Litigation extends CI_Controller {

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
  
	public function index($litigation_category_id =0)
	{
	  if(!$this->mdl_users->get_permission('litigation_view'))
	  {
		 redirect('dashboard'); 
	  }	 
	  
	  	$this->load->model('mdl_litigation');
	    $this->load->model("mdl_mauza");
		$this->load->model("mdl_patwarcircle");
		$this->load->model("mdl_qanungoicircle");
		$this->load->model("mdl_subdivision");
		
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

	
			$data['litigation_category_id'] = $litigation_category_id;
			$data['litigation_category']    = $this->mdl_litigation->get_litigation_category($litigation_category_id);
			$data['category_list']          = $this->mdl_litigation->get_category_list();
			$data['litigation_list']        = $this->mdl_litigation->get_list($litigation_category_id);
			$data["main"]                   = "litigation/home";
			
			$this->load->view('litigation/template',$data);
	}

 public function litigation_ajax()
 {
	      $this->load->model('mdl_litigation');
		  $data["litigation_list"] = $this->mdl_litigation->get_list_by_ajax();
		  $this->load->view('litigation/litigation_ajax_list',$data);
 }	
	
  public function view_detail($litigation_id = 0)
   {
	  if(!$this->mdl_users->get_permission('litigation_view'))
	  {
		 redirect('dashboard'); 
	  }		
	
	if($litigation_id == 0 or $litigation_id == '' )
	   {
		    redirect('litigation');
	   }
	   else
	   {
			$this->load->model('mdl_litigation');
			$this->load->model('mdl_mauza');
			
			$litigation =  $this->mdl_litigation->get_litigation($litigation_id);
			
			$data['get_tehsil_etc_by_mauza'] =  $this->mdl_mauza->get_tehsil_etc_by_mauza($litigation->mauza_id );
			
			$data['category_list']     = $this->mdl_litigation->get_category_list();
			$data['litigation']        = $this->mdl_litigation->get_litigation($litigation_id);
			$data['litigation_action'] = $this->mdl_litigation->get_litigation_action($litigation_id);
			$data['defending_party']   = $this->mdl_litigation->get_defending_party($litigation_id);
			$data['suing_party']       = $this->mdl_litigation->get_suing_party($litigation_id);
			$data["main"]              ="litigation/view_detail";
			
			$this->load->view('litigation/template',$data);
	   }
   }
   public function edit($litigation_id = 0)
   {
	  if(!$this->mdl_users->get_permission('litigation_edit'))
	  {
		 redirect('dashboard'); 
	  }	

      if($litigation_id == 0 or $litigation_id == '' )
	   {
		  redirect('litigation');	
	   }
	   else
	   {
		
		    $this->load->model('mdl_litigation');
			$this->load->model('mdl_mauza');
			$data['category_list']     = $this->mdl_litigation->get_category_list();
			$data["mauza_list"]        = $this->mdl_mauza->get_mauza_list();
			$data['litigation']        = $this->mdl_litigation->get_litigation($litigation_id);
			$data['litigation_action'] = $this->mdl_litigation->get_litigation_action($litigation_id);
			$data['defending_party']   = $this->mdl_litigation->get_defending_party($litigation_id);
			$data['suing_party']       = $this->mdl_litigation->get_suing_party($litigation_id);
			$data["main"]              ="litigation/edit_litigation";
			
			$this->load->view('litigation/template',$data);
	   }
   }

   public function delete($litigation_id = 0)
   {
	  if(!$this->mdl_users->get_permission('litigation_delete'))
	  {
		 redirect('dashboard'); 
	  }	

      if($litigation_id == 0 or $litigation_id == '' )
	   {
		    redirect('litigation');
	   }
	   else
	   {
		  redirect('litigation');
	   }
   }
	public function calendar()
	{
			
		$this->load->model('mdl_litigation');
		
		$data['cal'] = $this->mdl_litigation->get_cal();
		$data['category_list'] = $this->mdl_litigation->get_category_list();
		$data["main"] ="litigation/cal";
		$this->load->view('litigation/template',$data);
	}
   public function add($litigation_category_id =0)
   {
	      
	  if(!$this->mdl_users->get_permission('litigation_add'))
	  {
		 redirect('dashboard'); 
	  }		
	        $this->load->model('mdl_litigation');
			
		    $this->load->library('form_validation');
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('case_number', 'No. of Case', 'required');
			
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$this->mdl_litigation->save();
			    redirect('litigation');
			}
			else
			{
				$this->load->model('mdl_mauza');
				$data['litigation_category_id'] = $litigation_category_id ;
				$data['litigation_category']    = $this->mdl_litigation->get_litigation_category($litigation_category_id);
				$data['category_list']          = $this->mdl_litigation->get_category_list();
				$data["mauza_list"]             = $this->mdl_mauza->get_mauza_list();
				$data["main"] 				    = "litigation/new_litigation";
				$this->load->view('litigation/template',$data);  
			}
		
	   
	}


  public function action($litigation_id)
  {
	if(!$this->mdl_users->get_permission('litigation_update'))
	  {
		 redirect('dashboard'); 
	  }		 
	 
	 if($litigation_id == 0)
		 {
			    redirect("litigation"); 
		 }
		 else
		 {
				$this->load->model('mdl_litigation');
				$data['category_list'] = $this->mdl_litigation->get_category_list();
				$data['litigation'] = $this->mdl_litigation->get_litigation($litigation_id);
				$data["main"] ="litigation/litigation_action";
				$this->load->view('litigation/template',$data);
		 }
  }
 public function litigation_add_action()
 {

		        $this->load->model('mdl_litigation');
				$this->mdl_litigation->save_action();
			    redirect('litigation'); 
	 
 }
  
 public function add_defending_party($litigation_id = 0)
 {
	if(!$this->mdl_users->get_permission('litigation_edit'))
	  {
		 redirect('dashboard'); 
	  }	
	  
	if($litigation_id == 0)
	 {
	 	      redirect("litigation");  
	 }
	 else
	 {
          	$this->load->model('mdl_litigation');
			$data['litigation'] = $this->mdl_litigation->get_litigation($litigation_id);
			$data['category_list'] = $this->mdl_litigation->get_category_list();
			$data["main"] ="litigation/add_defending_party";
			$this->load->view('litigation/template',$data);
	 }
 }
 
public function add_defending()
{
		    $this->load->model('mdl_litigation');
		    $this->mdl_litigation->save_defending();
			redirect('litigation/view_detail/'.$this->input->post('litigation_id')); 	  
}

 public function add_suing_party($litigation_id = 0)
 {
	if(!$this->mdl_users->get_permission('litigation_edit'))
	  {
		 redirect('dashboard'); 
	  }	
	  
   if($litigation_id == 0)
	 {
	 	      redirect("litigation");  
	 }
	 else
	 {
          	$this->load->model('mdl_litigation');
			$data['litigation'] = $this->mdl_litigation->get_litigation($litigation_id);
			$data['category_list'] = $this->mdl_litigation->get_category_list();
			$data["main"] ="litigation/add_suing_party";
			$this->load->view('litigation/template',$data);
	 }
	
 }
public function add_suing()
{
		    $this->load->model('mdl_litigation');
		    $this->mdl_litigation->save_suing();
			redirect('litigation/view_detail/'.$this->input->post('litigation_id')); 	  
}

public function edit_litigation()
{
            $this->load->model('mdl_litigation');
		    $this->mdl_litigation->edit();
			redirect('litigation'); 
}
public function delete_litigation($id) {
	        $this->load->model('mdl_litigation');
		    $this->mdl_litigation->delete($id);
			redirect('litigation');
			
			

 }

}
