<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

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

		$this->load->model('mdl_survey');
		$data['survey_list'] = $this->mdl_survey->get_all_survey();
		$data["main"] ="registration/home";
		$this->load->view('registration/template',$data);
	}

	public function edit($survey_id = 0)
	{

		if($survey_id == 0 or $survey_id=='')
		{
			redirect("registration");
		}
		else
		{
			$this->load->model('mdl_survey');

			$data["survey_list"]          = $this->mdl_survey->get_survey($survey_id);
			$data["main"] 				 = "registration/edit";
			$this->load->view('management/template',$data);
		}

    }

 public function update()
  {

//		$this->load->library('form_validation');
//		$this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
//	    $this->form_validation->set_rules('q_id', 'Qanungoi Circle', 'required');
//	    $this->form_validation->set_rules('p_id', 'Patwar Circle', 'required');
//		$this->form_validation->set_rules('mauza_name', 'Mauza Name', 'required');
//		$this->form_validation->set_rules('fts_in_one_marla', 'Square Feet in Marla', 'required');

		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
	      $this->load->model("mdl_survey");
		  $this->mdl_survey->update();
		  redirect('registration');
		}
		else
		{
		  redirect('registration/edit/'.$this->input->post('survey_id'));
	    }
  }

 public function add()
  {

			$this->load->model('mdl_survey');

//			$this->load->library('form_validation');
//			$this->form_validation->set_rules('tehsil_id', 'Sub Division', 'required');
//			$this->form_validation->set_rules('q_id', 'Qanungoi Circle', 'required');
//			$this->form_validation->set_rules('p_id', 'Patwar Circle', 'required');
//			$this->form_validation->set_rules('mauza_name', 'Mauza Name', 'required|is_unique[tbl_property_mauza.mouza_name]');
//			$this->form_validation->set_rules('fts_in_one_marla', 'Square Feet in Marla', 'required');
		//	$this->form_validation->set_rules('measurement_system', 'Measurement System', 'required');

			if ($this->input->server('REQUEST_METHOD') == 'POST')
			{
			    if(empty($this->input->post('housing_scheme_id'))){
			        $this->session->set_flashdata('error', 'Please complete the form below');
                    redirect('registration/add');
                }
			  $this->mdl_survey->save();
			  redirect('registration');
			}
			else
			{
                $data['schemes'] = $this->mdl_survey->getSchemes();
				$data["main"] 				 = "registration/add";
				$this->load->view('registration/template',$data);
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
                        $this->load->model("mdl_survey");
                        $data["mauza_list"] = $this->mdl_survey->ajax_mauza_list();
			$this->load->view("mauza/ajax_file",$data);
    }
    public function mauza_detail($mauza_id = 0){

        if($mauza_id == 0 or $mauza_id=='')
		{
			redirect("mauza");
		}
		else
		{
                    $this->load->model('mdl_survey');
                    $data['mauza']            =  $this->mdl_survey->mauza_detail($mauza_id);
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
                    $this->load->model("mdl_survey");
                    $data["patwar_list"] = $this->mdl_survey->patwar_list_by_qgoi();
                    $this->load->view('mauza/ajax_element',$data);
                   // echo  $data["qgoi_list"];
                    break;
                }
      }
  }

  public function identified()
  {

      $this->load->model("mdl_survey");
      $data['schemes'] = $this->mdl_survey->getSchemes();

      $data["main"] ="registration/view_schemes";
      $this->load->view('registration/template',$data);
  }

    public function add_scheme()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
//			    echo '<pre>';
//			    print_r($this->input->post());die;
            $this->load->model("mdl_survey");
            $this->mdl_survey->save_scheme();
            redirect('registration/identified');
        }
        else {
//            $this->load->model('mdl_mauza');
//            $this->load->model("mdl_qanungoicircle");
//
//            $data['tehsil_lists'] = $this->mdl_qanungoicircle->get_qanungoicircle_list();
//            $data['mauza_list'] = $this->mdl_mauza->get_mauza_list_with_detail();

            $data["main"] = "registration/add_scheme";
            $this->load->view('registration/template', $data);
        }
    }

    public function edit_scheme($scheme_id = 0)
    {

        if($scheme_id == 0 or $scheme_id=='')
        {
            redirect("registration");
        }
        else
        {
            $this->load->model('mdl_survey');
            $data["scheme"]          = $this->mdl_survey->getSchemeById($scheme_id);
            $data["main"] 				 = "registration/edit_scheme";
            $this->load->view('management/template',$data);
        }

    }

    public function update_scheme()
    {

        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $this->load->model("mdl_survey");
            $this->mdl_survey->update_scheme();
            redirect('registration/identified');
        }
        else
        {
            redirect('registration/edit_scheme/'.$this->input->post('id'));
        }
    }
}

