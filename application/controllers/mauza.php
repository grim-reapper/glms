<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mauza extends CI_Controller {

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
  
public function index()
	{
		
		$this->load->model('mdl_mauza');
                $this->load->model('mdl_patwarcircle');
                $this->load->model("mdl_subdivision");
                $this->load->model('mdl_qanungoicircle');
                $data['d_lists'] = $this->mdl_subdivision->division_list();
                $data['dis_lists'] = $this->mdl_subdivision->district_list();
                $data['subdiv_list'] = $this->mdl_subdivision->get_subdivision_list();
                $data['q_list'] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
		$data['patwarcircle_list'] = $this->mdl_patwarcircle->get_patwarcircle_list_with_detail();
		$data['mauza_list'] = $this->mdl_mauza->get_mauza_list_with_detail();
		$data["main"] ="mauza/home";
		$this->load->view('management/template',$data);
	}

	public function edit($mauza_id = 0)
	{
	   
		if($mauza_id == 0 or $mauza_id=='')
		{
			redirect("mauza");
		}
		else
		{
			$this->load->model("mdl_patwarcircle");
			$this->load->model("mdl_qanungoicircle");
			$this->load->model("mdl_subdivision");
			$this->load->model('mdl_mauza');
			
			$data["patwarcircle_list"]   = $this->mdl_patwarcircle->get_patwarcircle_list();
			$data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
			$data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
			$data["mauza_list"]          = $this->mdl_mauza->get_mauza($mauza_id);
			$data["main"] 				 = "mauza/edit";
			$this->load->view('management/template',$data);	
		}
 		
    }
	
 public function update()
  {
	   
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
	    $this->form_validation->set_rules('q_id', 'Qanungoi Circle', 'required');
	    $this->form_validation->set_rules('p_id', 'Patwar Circle', 'required');
		$this->form_validation->set_rules('mauza_name', 'Mauza Name', 'required');
		$this->form_validation->set_rules('fts_in_one_marla', 'Square Feet in Marla', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
	      $this->load->model("mdl_mauza");
		  $this->mdl_mauza->update();
		  redirect('mauza');
		}
		else
		{
		  redirect('mauza/edit/'.$this->input->post('mauza_id'));	
	    }
  }
  
 public function add()
  {
	        
	  		$this->load->model("mdl_patwarcircle");
			$this->load->model("mdl_qanungoicircle");
			$this->load->model("mdl_subdivision");
			$this->load->model('mdl_mauza');
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
			$this->form_validation->set_rules('q_id', 'Qanungoi Circle', 'required');
			$this->form_validation->set_rules('p_id', 'Patwar Circle', 'required');
			$this->form_validation->set_rules('mauza_name', 'Mauza Name', 'required|is_unique[tbl_property_mauza.mouza_name]');
			$this->form_validation->set_rules('fts_in_one_marla', 'Square Feet in Marla', 'required');
		//	$this->form_validation->set_rules('measurement_system', 'Measurement System', 'required');
		
			if ($this->form_validation->run() == TRUE)
			{
			  $this->mdl_mauza->save();
			  redirect('mauza');
			}
			else
			{
				$data["patwarcircle_list"]   = $this->mdl_patwarcircle->get_patwarcircle_list();
				$data["qanungoicircle_list"] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
				$data["subdivision_list"]    = $this->mdl_subdivision->get_subdivision_list();
				$data["main"] 				 = "mauza/add";
				$this->load->view('management/template',$data);	
			}
  }
  public function voice_mauza()
  {
   
	$mauza_id =  $this->input->post('mauza_id');
    $voice = new COM("SAPI.SpVoice");
    
	$this->db->where('mauza_id',$mauza_id);
	$query = $this->db->get('tbl_property_mauza');
    $m = 	$query->row();
	$voice->Speak($m->mouza_name );  
   }
    public function mauza_circle_ajax_list() 
    {
                        $this->load->model("mdl_mauza");
                        $data["mauza_list"] = $this->mdl_mauza->ajax_mauza_list();
			$this->load->view("mauza/ajax_file",$data);
    }
    public function mauza_detail($mauza_id = 0){
        
        if($mauza_id == 0 or $mauza_id=='')
		{
			redirect("mauza");
		}
		else
		{
                    $this->load->model('mdl_mauza');
                    $data['mauza']            =  $this->mdl_mauza->mauza_detail($mauza_id);
                    $data["main"]                =  "mauza/mauza_detail";
                    $this->load->view('management/template',$data);	  
                
                }
        
    }

    public function mauza_ajax_elements() {
      $data['type'] = $this->input->post("type");
	switch($this->input->post("type"))
	{
		case 'division':
		{
			$this->load->model("mdl_subdivision");
			$data["district_list"] = $this->mdl_subdivision->district_list_by_division();
			$this->load->view('mauza/ajax_element',$data);
			break;
		}
                case 'subdiv':
                {
                    $this->load->model("mdl_qanungoicircle");
                    $data["subdiv_list"] = $this->mdl_qanungoicircle->tehsil_list_by_district();
                    $this->load->view('mauza/ajax_element',$data);
                    break;
                }
                case 'qgcircle':
                {
                    $this->load->model("mdl_patwarcircle");
                    $data["main1"] = $this->mdl_patwarcircle->qgoicircle_list_by_tehsil();
                    $this->load->view('mauza/ajax_element',$data);
                   // echo  $data["qgoi_list"];
                    break;
                }
                case 'patwar':
                {
                    $this->load->model("mdl_mauza");
                    $data["patwar_list"] = $this->mdl_mauza->patwar_list_by_qgoi();
                    $this->load->view('mauza/ajax_element',$data);
                   // echo  $data["qgoi_list"];
                    break;
                }
      }
  }
}

