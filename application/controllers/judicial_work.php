<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Judicial_work extends CI_Controller {

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

////////////////////////////////File Section///////////////////////////////
    public function index() {
       
        $data["main"] = "judicial_work_template/home";
        $this->load->view('judicial_work_template/template', $data);
    }
}
?>