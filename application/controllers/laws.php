<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laws extends CI_Controller {
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

 public function index($law_category_id=0)
	{
	    $this->load->model('mdl_laws');
		$data["law_categories"] = $this->mdl_laws->get_law_categories();
		$data["law_list"] = $this->mdl_laws->get_law_by_categories($law_category_id);
		
		$data["main"] ="laws/home";
		$this->load->view('laws/template',$data);
	}

 public function add()
	{
	    $this->load->model('mdl_laws');
		$data["law_categories"] = $this->mdl_laws->get_law_categories();
		$data["ck"]             = $this->ck_data;
		$data["main"]           = "laws/add";
		$this->load->view('laws/template',$data);
	}
 public function view($law_id=0)
         {
                if($law_id == 0)
                {
                    redirect('laws');
                }
               $this->load->model('mdl_laws');
               $data["law_categories"] = $this->mdl_laws->get_law_categories();
               $data["law"]            = $this->mdl_laws->get_law_by_id($law_id) ;
               $data["main"]           = "laws/view";
               $this->load->view('laws/template',$data);
        }		
 public function save()
  {
	   $this->load->model('mdl_laws');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('law_category_id', 'Law Category', 'required');
	   $this->form_validation->set_rules('law_title', 'Law Title', 'required');
			
			
			if ($this->form_validation->run() == TRUE)
			{
	           $this->mdl_laws->save();
	           redirect('laws'); 
			}else{
			   redirect('laws/add');	
			}
			
    }
    public function edit($law_id)
    {
           $this->load->model('mdl_laws');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('law_category_id', 'Law Category', 'required');
	   $this->form_validation->set_rules('law_title', 'Law Title', 'required');
			
	    if ($this->form_validation->run() == TRUE)
	      {
	          $this->mdl_laws->edit();
	           redirect('laws'); 
	      }else{
                 
	        $data["law_categories"] = $this->mdl_laws->get_law_categories();
	        $data["law"]            = $this->mdl_laws->get_law_by_id($law_id) ;
		$data["ck"]             = $this->ck_data;
		$data["main"]           = "laws/edit";
		$this->load->view('laws/template',$data);
	     }
    }
   
    public function delete($law_id)
    {
           $this->load->model('mdl_laws');	   
           $this->mdl_laws->delete($law_id) ;
           redirect('laws');	
    }
   
}

