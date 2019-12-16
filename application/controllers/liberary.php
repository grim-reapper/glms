<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Liberary extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        if (!$this->mdl_sessions->is_login()) {
            redirect('sessions/login');
        }
    }

    public function index() {
        $this->load->model('mdl_liberary');
        
        $data['district'] = $this->mdl_liberary->get_district();
        $data['lib_data'] = $this->mdl_liberary->get_lib_data();
        $data["main"] = "liberary/home";
        $this->load->view('catalogmanagement/template', $data);
    }

    public function add_book() {
        $this->load->model('mdl_districts');
        $this->load->model('mdl_liberary');


        $this->load->library('form_validation');
        $this->form_validation->set_rules('ownership', 'Owner Ship', 'required');
        $this->form_validation->set_rules('book_title', 'Book Title', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->mdl_liberary->save_book();
            $this->index();
        } else {
            $data['district'] = $this->mdl_districts->get_districts_list();
            $data["main"] = "liberary/add";
            $this->load->view('catalogmanagement/template', $data);
        }
    }
    
    public function delete($id)
    {
        $this->load->model('mdl_liberary');
        $this->mdl_liberary->delete_book($id);
        redirect('liberary');
    }
    public function view($id)
    {
        $this->load->model('mdl_liberary');
        $data['book']=$this->mdl_liberary->view_book($id);
         $data["main"] = "liberary/view";
            $this->load->view('catalogmanagement/template', $data);
        
        
    }
    public function edit($id)
    {
        $this->load->model('mdl_liberary');
        $data['district'] = $this->mdl_liberary->get_district();
        $data['book']=$this->mdl_liberary->get_content_book($id);
         $data["main"] = "liberary/edit";
            $this->load->view('catalogmanagement/template', $data);
    }
    
    public function update_book()
    {
         $this->load->model('mdl_liberary');


        $this->load->library('form_validation');
        $this->form_validation->set_rules('ownership', 'Owner Ship', 'required');
        $this->form_validation->set_rules('book_title', 'Book Title', 'required');
           if ($this->form_validation->run() == TRUE) {
            $this->mdl_liberary->update_book();
            redirect('liberary');
        } 
        
    }

    public function books_by_district()
    {
       $this->load->model('mdl_liberary');
        $data['lib_data']=$this->mdl_liberary->books_by_district(); 
        $this->load->view('liberary/book_district',$data);
    }
    public function books_by_private()
    {
       $this->load->model('mdl_liberary');
        $data['lib_data']=$this->mdl_liberary->books_by_private(); 
        $this->load->view('liberary/book_district',$data);
    }
    public function books_by_govt()
    {
       $this->load->model('mdl_liberary');
        $data['lib_data']=$this->mdl_liberary->books_by_govt(); 
        $this->load->view('liberary/book_district',$data);
    }
    public function books_all()
    {
       $this->load->model('mdl_liberary');
        $data['lib_data']=$this->mdl_liberary->books_all(); 
        $this->load->view('liberary/book_district',$data);
    }

}

?>
