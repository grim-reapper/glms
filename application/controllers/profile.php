<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

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
        $this->load->model("mdl_profile");
        $data['group'] = 'Districts';
        $data['profile_data'] = $this->mdl_profile->get_profile_data();
        $data["main"] = "profile/home";
        $this->load->view('profilemanagement/template', $data);
    }

    public function tehsil_group() {
        $this->load->model("mdl_profile");
        $data['group'] = 'Tehsil';
        $data["main"] = "profile/home";
        $data['profile_data'] = $this->mdl_profile->get_profile_data_tehsil_group();
        $this->load->view('profilemanagement/template', $data);
    }

    public function Staff_group() {
        $this->load->model("mdl_profile");
        $data['group'] = 'Staff';
        $data["main"] = "profile/home";
        $data['profile_data'] = $this->mdl_profile->get_profile_data_staff_group();
        $this->load->view('profilemanagement/template', $data);
    }

    public function Qanoongo_group() {
        $this->load->model("mdl_profile");
        $data['group'] = 'Qanoongo';
        $data["main"] = "profile/home";
        $data['profile_data'] = $this->mdl_profile->get_profile_data_qanoon_group();
        $this->load->view('profilemanagement/template', $data);
    }

    public function Patwar_group() {
        $this->load->model("mdl_profile");
        $data['group'] = 'Patwar';
        $data["main"] = "profile/home";
        $data['profile_data'] = $this->mdl_profile->get_profile_data_patwar_group();
        $this->load->view('profilemanagement/template', $data);
    }

    public function add($group = '') {
        $this->load->model('mdl_liberary');
        $this->load->model('mdl_subdivision');
        $this->load->model("mdl_mauza");
        $this->load->model("mdl_profile");

        $data['district'] = $this->mdl_liberary->get_district();
        $data['subdiv'] = $this->mdl_subdivision->get_subdivision_list();
        $data['mauza_list'] = $this->mdl_mauza->get_mauza_list();
        if ($group == 'Tehsil') {
            $data['group'] = 'Tehsil';
            $data['designation'] = $this->mdl_profile->get_designation_tehsil();
        } else if ($group == 'Districts') {
            $data['group'] = 'Districts';
            $data['designation'] = $this->mdl_profile->get_designations();
        } else if ($group == 'Staff') {
            $data['group'] = 'Staff';
            $data['designation'] = $this->mdl_profile->get_designation_staff();
        } else if ($group == 'Qanoongo') {
            $data['group'] = 'Qanoongo';
            $data['designation'] = $this->mdl_profile->get_designation_qanoongo();
        } else if ($group == 'Patwar') {
            $data['group'] = 'Patwar';
            $data['designation'] = $this->mdl_profile->get_designation_patwar();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->mdl_profile->save_profile();
            if ($group == 'Tehsil') {
                $this->tehsil_group();
            } else if ($group == 'Districts') {
                $this->index();
            } else if ($group == 'Staff') {
                $this->Staff_group();
            } else if ($group == 'Qanoongo') {
                $this->Qanoongo_group();
            } else if ($group == 'Patwar') {
                $this->Patwar_group();
            }
        } else {
            $data["main"] = "profile/add";
            $this->load->view('profilemanagement/template', $data);
        }
    }

    public function delete($id) {
        $this->load->model('mdl_profile');
        $this->mdl_profile->delete_profile($id);
        redirect('profile');
    }

    public function admin() {
        $data["main"] = "profile/admin";
        $this->load->view('profilemanagement/template', $data);
    }

    public function add_designation() {
        $this->load->model("mdl_profile");
        $this->load->library('form_validation');
        $this->form_validation->set_rules('designation_name', 'Designation', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->mdl_profile->save_designation();
            $this->admin();
        } else {
            $data["main"] = "profile/admin_add";
            $this->load->view('profilemanagement/template', $data);
        }
    }

    public function view_designation() {
        $this->load->model("mdl_profile");
        $data['designation'] = $this->mdl_profile->get_designation();
        $data["main"] = "profile/admin_view";
        $this->load->view('profilemanagement/template', $data);
    }
    public function view_profile($id)
    {
        $this->load->model("mdl_profile");
        $data['profile_data'] = $this->mdl_profile->get_profile_view($id);
        $data["main"] = "profile/profile_view";
        $this->load->view('profilemanagement/template', $data);
        
    }
    
    public function edit_profile($id)
    {
        $data["main"] = "profile/edit";
        $this->load->view('profilemanagement/template', $data);
    }

}

?>