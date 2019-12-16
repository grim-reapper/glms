<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dak extends CI_Controller { 
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
	 
	
		$this->load->helper('ckeditor');
		
		//Ckeditor's configuration
		$this->ck_data['ckeditor'] = array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'asset/ckeditor',
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> array(		//Setting a custom toolbar
					     'basicstyles'=>array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat', 'FontSize'),
						  'paragraph'   =>  array('NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-', 'JustifyLeft' ,'JustifyCenter','JustifyRight','JustifyBlock' ),
					     'document'    =>  array( 'Source','DocProps','Preview','Print','Templates' ),
						 'clipboard'   =>  array(  'Cut','Copy','-','Paste','PasteText','PasteFromWord','-','Undo','Redo' ),
						 'styles'      =>  array( 'Styles','Format','Font','FontSize'),
						 'insert'      =>  array( 'Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Iframe'),
						 'editing'     =>  array( 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ),
						 'colors'      =>  array( 'TextColor','BGColor'),
						 'links'       =>  array( 'Link','Unlink','Anchor' ),
						 'tools'       =>  array('Maximize', 'ShowBlocks' ),
 				),
				
				
				'width' 	           => 	"100%",	//Setting a custom width
				'height' 	           => 	'100px',	//Setting a custom height
				'skin'                 => 'office2003',
				'extraPlugins'         => 'tableresize',
				'extraPlugins'         => 'tabletools',
					 
			)
		);
		
	 
  }

public function index($type="fresh")
	{
		
	    $this->load->model("mdl_dak");	
		if($type=="fresh")
		{
		   $data["dak_list"] = $this->mdl_dak->get_fresh_dak_list();
		   $data["main"] = "dak/fresh_dak_list";
		}
		else if($type=="dealt")
		{
		  $data["dak_list"] = $this->mdl_dak->get_dealt_dak_list();
		  $data["main"] = "dak/dealt_dak_list";
		}
		else if($type=="archive")
		{
		  $data["dak_list"] = $this->mdl_dak->get_archive_dak_list();
		  $data["main"] = "dak/archive_dak_list";
		}
		
		$this->load->view('dak/template',$data);
	}

	


public function add()
	{
		    $this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="nNote nWarning  hideit"><p><strong>WARNING: </strong>', '</p></div>');
			
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('note', 'Note', 'required');
			$this->form_validation->set_rules('signtory', 'Signtory', 'required');
			$this->form_validation->set_rules('addressee', 'Addressee', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
				$this->load->model("mdl_dak");	
				$this->mdl_dak->save();
				redirect("dak");
			
			}
			else
			{
			  $data["main"] ="dak/add";
			  $data["ck"] =$this->ck_data;
			  $this->load->view('dak/template',$data);
			}
	}
public function view_dak($id=0)
	{
	   if($id==0)
	   {
		   redirect("dak");
	   }
	   else
	   {
		   $this->load->model("mdl_dak");	
		   $data["dak"] = $this->mdl_dak->get_dak($id);	
		   $data["dak_note_list"] = $this->mdl_dak->get_dak_note($id);
		   $data["ck"] =$this->ck_data;
		   $data["main"] ="dak/view_dak";
		   $this->load->view('dak/template',$data);		
	   }
	}
public function add_note($id=0)
	{
	   if($id==0)
	   {
		   redirect("dak");
	   }
	   else
	   {
		   $this->load->model("mdl_dak");	
		   $data["dak"] = $this->mdl_dak->get_dak($id);	
		   $data["dak_note_list"] = $this->mdl_dak->get_dak_note($id);
		   $data["ck"] =$this->ck_data;
		   $data["main"] ="dak/add_note";
		   $this->load->view('dak/template',$data);		
	   }
	}
public function save_note()
	{
		$this->load->model("mdl_dak");	
		$this->mdl_dak->add_note();
		
	  if( $this->input->post('addressee') =='')
	   {
		redirect("dak/index/dealt");	
	   }
	   else
	   {
		redirect("dak");	   
	   }	   
	
	}
	
	
public function update()
	{
		$this->load->model("mdl_dak");	
		$this->mdl_dak->update();
		if( $this->input->post('addressee') =='')
	   {
		redirect("dak/index/dealt");	
	   }
	   else
	   {
		redirect("dak");	   
	   }
	}
public function make_archives($id =0)
	{
		$this->load->model("mdl_dak");	
		$this->mdl_dak->make_archive($id);
	
		redirect("dak");	   
	}
	
public function print_dak($id=0)
	{
	   if($id==0)
	   {
		   redirect("dak");
	   }
	   else
	   {
		   $this->load->model("mdl_dak");	
		   $data["dak"]           = $this->mdl_dak->get_dak($id);	
		   $data["dak_note_list"] = $this->mdl_dak->get_dak_note($id);
		   $this->load->view('dak/print_dak',$data);		
	   }
	}
public function delete($id=0)
	{
	   if($id==0)
	   {
		    redirect("dak");
	   }
	   else
	   {
		   $this->load->model("mdl_dak");	
		   $this->mdl_dak->delete($id);	
		   redirect("dak"); 
	   }
	}
}