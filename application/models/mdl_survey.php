<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_survey extends CI_Model
{


    public $gallery_path;

    function __construct()
    {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH.'../uploads');

    }

//////////////////////////////// upload_file   //////////////////////////////////////////////
    private function upload_file($file, $name, $overwrite = false)
    {
        $config = array();
        $config = array(
            'allowed_types' => '*',
            'upload_path' => $this->gallery_path,
            'max_size' => 2048,
            'file_name' => $name,
            'overwrite' => $overwrite
        );


        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $image_data = $this->upload->data();

        return $image_data["file_name"];
        $image_data = array();
    }


    public function get_mauza_list()
    {
        $this->db->order_by("mouza_name", "ASC");
        $query = $this->db->get('tbl_property_mauza');
        return $query->result();
    }

    public function mauza_list_by_patwarcircle()
    {
        $patwar_circle_id = $this->input->post("patwar_circle_id");
        if ($patwar_circle_id == 0) {
            $this->db->order_by("mouza_name", "ASC");
            $query = $this->db->get('tbl_property_mauza');
            return $query->result();
        } else {
            $this->db->where("p_id", $patwar_circle_id);
            $this->db->order_by("mouza_name", "ASC");
            $query = $this->db->get('tbl_property_mauza');
            return $query->result();
        }
    }

    public function mauza_list_by_patwarcircle_id($patwar_circle_id)
    {
        $this->db->where("p_id", $patwar_circle_id);
        $this->db->order_by("mouza_name", "ASC");
        $query = $this->db->get('tbl_property_mauza');
        return $query->result();
    }

    public function mauza_list_by_tehsil_id($tehsil_id)
    {
        $this->db->where("tehsil_id", $tehsil_id);
        $this->db->order_by("mouza_name", "ASC");
        $query = $this->db->get('tbl_property_mauza');
        return $query->result();
    }

    public function mauza_list_by_q_id($q_id)
    {
        $this->db->where("q_id", $q_id);
        $this->db->order_by("mouza_name", "ASC");
        $query = $this->db->get('tbl_property_mauza');
        return $query->result();
    }

    public function get_all_survey()
    {

        $this->db->select("*");
        $this->db->from('survey_form');
        $this->db->order_by("created_at", "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_survey($survey_id = 0)
    {
        $this->db->where('id', $survey_id);
        $query = $this->db->get('survey_form');
        return $query->row();

    }

    public function update()
    {
        $owner = array();
        $c = $this->input->post('owner_counter');
        for ($i = 1; $i <= $c; $i++) {
            $owner[$i - 1]['name'] = $this->input->post('owner_name_'.$i);
            $owner[$i - 1]['cnic'] = $this->input->post('owner_cnic_'.$i);
            $owner[$i - 1]['contact'] = $this->input->post('owner_contact_'.$i);
        }
        $owners = json_encode(array_filter($owner));
        ////////////////////////////////////////
        $public_path = array();
        $c1 = $this->input->post('pp_counter');
        for ($i = 1; $i <= $c1; $i++) {
            $public_path[$i - 1]['public_path'] = $this->input->post('public_path_'.$i);
            $public_path[$i - 1]['public_path_ownership'] = $this->input->post('public_path_ownership_'.$i);
            $public_path[$i - 1]['pp_khasra_no'] = $this->input->post('pp_khasra_no_'.$i);
            $public_path[$i - 1]['pp_area'] = $this->input->post('pp_area_'.$i);
        }
        $public_paths = json_encode(array_filter($public_path));

        ///////////////////////////////////////////
        $khasra_detail = array();
        $c2 = $this->input->post('khasra_counter');
        for ($i = 1; $i <= $c2; $i++) {
            $khasra_detail[$i - 1]['khasra_no'] = $this->input->post('khasra_no_'.$i);
            $khasra_detail[$i - 1]['area'] = $this->input->post('area_'.$i);
            $khasra_detail[$i - 1]['mouza'] = $this->input->post('mouza_'.$i);
        }
        $khasra_details = json_encode(array_filter($khasra_detail));
        $data = array(
            'housing_scheme' => $this->input->post('housing_scheme'),
            'location' => $this->input->post('location'),
            'owners' => $owners,
            'contact_person_name' => $this->input->post('contact_person_name'),
            'contact_person_cnic' => $this->input->post('contact_person_cnic'),
            'contact_person_phone' => $this->input->post('contact_person_phone'),
            'scheme' => $this->input->post('scheme'),
            'sanction_status' => $this->input->post('saction_status'),
            'khasra_details' => $khasra_details,
            'total_area_scheme' => $this->input->post('total_area_scheme'),
            'vacant_area' => $this->input->post('vacant_area'),
            'pbo_land' => $this->input->post('pbo_land'),
            'khasra_no_land' => $this->input->post('khasra_no_land'),
            'public_path' => $public_paths,
            'total_area_public' => $this->input->post('total_area_public'),
            'schedule_rate' => $this->input->post('schedule_rate'),
            'market_rate' => $this->input->post('market_price'),
            'dpac_rate' => $this->input->post('dpac_price'),
            'alt_khasra_no' => $this->input->post('alt_khasra_no'),
            'alt_schedule_rate' => $this->input->post('alt_schedule_rate'),
            'alt_market_price' => $this->input->post('alt_market_price'),
            'alt_dpac_price' => $this->input->post('alt_dpac_price'),
            'notes' => $this->input->post('notes'),
            'exchange_approval' => $this->input->post('exchange_approval'),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        if (!empty($_FILES['copy_of_plan']['tmp_name'])) {
            $data['copy_of_plan'] = $this->upload_file('copy_of_plan', 'copy_of_plan');

        }
        if (!empty($_FILES['copy_of_mutation']['tmp_name'])) {
            $data['copy_of_mutation'] = $this->upload_file('copy_of_mutation', 'copy_of_mutation_');
        }
        if (!empty($_FILES['fard_file']['tmp_name'])) {
            $data['fard_file'] = $this->upload_file('fard_file', 'fard_file');
        }
        if (!empty($_FILES['alt_fard']['tmp_name'])) {
            $data['alt_fard'] = $this->upload_file('alt_fard', 'alt_fard');
        }
        if (!empty($_FILES['alt_site_plan']['tmp_name'])) {
            $data['alt_site_plan'] = $this->upload_file('alt_site_plan', 'alt_site_plan');
        }
        if (!empty($_FILES['ref_to_bor']['tmp_name'])) {
            $data['ref_to_bor'] = $this->upload_file('ref_to_bor', 'ref_to_bor');
        }
        $this->db->where("id", $this->input->post("survey_id"));
        $this->db->update('survey_form', $data);
    }

    public function save()
    {

        $owner = array();
        $c = $this->input->post('owner_counter');
        for ($i = 1; $i <= $c; $i++) {
            $owner[$i - 1]['name'] = $this->input->post('owner_name_'.$i);
            $owner[$i - 1]['cnic'] = $this->input->post('owner_cnic_'.$i);
            $owner[$i - 1]['contact'] = $this->input->post('owner_contact_'.$i);
        }
        $owners = json_encode(array_filter($owner));
        ////////////////////////////////////////
        $public_path = array();
        $c1 = $this->input->post('pp_counter');
        for ($i = 1; $i <= $c1; $i++) {
            $public_path[$i - 1]['public_path'] = $this->input->post('public_path_'.$i);
            $public_path[$i - 1]['public_path_ownership'] = $this->input->post('public_path_ownership_'.$i);
            $public_path[$i - 1]['pp_khasra_no'] = $this->input->post('pp_khasra_no_'.$i);
            $public_path[$i - 1]['pp_area'] = $this->input->post('pp_area_'.$i);
        }
        $public_paths = json_encode(array_filter($public_path));

        ///////////////////////////////////////////
        $khasra_detail = array();
        $c2 = $this->input->post('khasra_counter');
        for ($i = 1; $i <= $c2; $i++) {
            $khasra_detail[$i - 1]['khasra_no'] = $this->input->post('khasra_no_'.$i);
            $khasra_detail[$i - 1]['area'] = $this->input->post('area_'.$i);
            $khasra_detail[$i - 1]['mouza'] = $this->input->post('mouza_'.$i);
        }
        $khasra_details = json_encode(array_filter($khasra_detail));

        {
            $data = array(
                'housing_scheme' => $this->input->post('housing_scheme'),
                'location' => $this->input->post('location'),
                'owners' => $owners,
                'contact_person_name' => $this->input->post('contact_person_name'),
                'contact_person_cnic' => $this->input->post('contact_person_cnic'),
                'contact_person_phone' => $this->input->post('contact_person_phone'),
                'scheme' => $this->input->post('scheme'),
                'sanction_status' => $this->input->post('saction_status'),
                'khasra_details' => $khasra_details,
                'total_area_scheme' => $this->input->post('total_area_scheme'),
                'vacant_area' => $this->input->post('vacant_area'),
                'pbo_land' => $this->input->post('pbo_land'),
                'khasra_no_land' => $this->input->post('khasra_no_land'),
                'public_path' => $public_paths,
                'total_area_public' => $this->input->post('total_area_public'),
                'schedule_rate' => $this->input->post('schedule_rate'),
                'market_rate' => $this->input->post('market_price'),
                'dpac_rate' => $this->input->post('dpac_price'),
                'alt_khasra_no' => $this->input->post('alt_khasra_no'),
                'alt_schedule_rate' => $this->input->post('alt_schedule_rate'),
                'alt_market_price' => $this->input->post('alt_market_price'),
                'alt_dpac_price' => $this->input->post('alt_dpac_price'),
                'notes' => $this->input->post('notes'),
                'exchange_approval' => $this->input->post('exchange_approval'),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            );

            if (!empty($_FILES['copy_of_plan']['tmp_name'])) {
                $data['copy_of_plan'] = $this->upload_file('copy_of_plan', 'copy_of_plan');

            }
            if (!empty($_FILES['copy_of_mutation']['tmp_name'])) {
                $data['copy_of_mutation'] = $this->upload_file('copy_of_mutation',
                    'copy_of_mutation_');
            }
            if (!empty($_FILES['fard_file']['tmp_name'])) {
                $data['fard_file'] = $this->upload_file('fard_file', 'fard_file');
            }
            if (!empty($_FILES['alt_fard']['tmp_name'])) {
                $data['alt_fard'] = $this->upload_file('alt_fard', 'alt_fard');
            }
            if (!empty($_FILES['alt_site_plan']['tmp_name'])) {
                $data['alt_site_plan'] = $this->upload_file('alt_site_plan', 'alt_site_plan');
            }
            if (!empty($_FILES['ref_to_bor']['tmp_name'])) {
                $data['ref_to_bor'] = $this->upload_file('ref_to_bor', 'ref_to_bor');
            }

            $this->db->insert('survey_form', $data);
        }
    }

    public function save_scheme()
    {
        $data = array(
            'housing_scheme' => $this->input->post('housing_scheme'),
            'scheme_area' => $this->input->post('scheme_area'),
            'tehsil_name' => $this->input->post('tehsil_name'),
            'mouza_name' => $this->input->post('mouza_name'),
            'approval_year' => $this->input->post('approval_year'),
            'status' => $this->input->post('status'),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('housing_schemes', $data);
    }

    public function update_scheme()
    {
        $data = array(
            'housing_scheme' => $this->input->post('housing_scheme'),
            'scheme_area' => $this->input->post('scheme_area'),
            'tehsil_name' => $this->input->post('tehsil_name'),
            'mouza_name' => $this->input->post('mouza_name'),
            'approval_year' => $this->input->post('approval_year'),
            'status' => $this->input->post('status'),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('housing_schemes', $data);
    }

    public function getSchemes()
    {
        $query = $this->db->query("SELECT * from housing_schemes ORDER BY id DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function getSchemeById($id)
    {
        $query = $this->db->query("SELECT * from housing_schemes WHERE id = $id");
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function get_tehsil_etc_by_mauza($mauza_id = 0)
    {
        $data = array();
        $this->db->where('mauza_id', $mauza_id);
        $query = $this->db->get('tbl_property_mauza');
        $m = $query->row();

        $this->db->where('p_id', $m->p_id);
        $query = $this->db->get('tbl_property_patwarcircle');
        $p = $query->row();
        $data["patwarcircle"] = $p->patwar_circle;
        $this->db->where('q_id', $m->q_id);
        $query = $this->db->get('tbl_property_qgoi');
        $q = $query->row();
        $data["q_circle"] = $q->q_circle;
        $this->db->where('tehsil_id', $m->tehsil_id);
        $query = $this->db->get('tbl_property_tehsils');
        $t = $query->row();
        $data["tehsils"] = $t->tehsil_name;
        return $data;
    }

    public function ajax_mauza_list()
    {

        if ($this->input->post('type') == 'div') {

            if ($this->input->post('division_id') != '') {
                $this->db->where('di.division_id', $this->input->post('division_id'));
            } else {
                $this->db->where('di.division_id !=', 0);
            }
        } else {
            if ($this->input->post('type') == 'dist') {
                if ($this->input->post('district_id') != '') {
                    $this->db->where('t.district_id', $this->input->post('district_id'));
                } else {
                    $this->db->where('t.district_id !=', 0);
                }
            } else {
                if ($this->input->post('type') == 'subdiv') {
                    if ($this->input->post('tehsil_id') != '') {
                        $this->db->where('q.tehsil_id', $this->input->post('tehsil_id'));
                    } else {
                        $this->db->where('q.tehsil_id !=', 0);
                    }
                } else {
                    if ($this->input->post('type') == 'qgcircle') {
                        if ($this->input->post('q_id') != '') {
                            $this->db->where('p.q_id', $this->input->post('q_id'));
                        } else {
                            $this->db->where('p.q_id !=', 0);
                        }
                    } else {
                        if ($this->input->post('type') == 'patwar') {
                            if ($this->input->post('p_id') != '') {
                                $this->db->where('m.p_id', $this->input->post('p_id'));
                            } else {
                                $this->db->where('m.p_id !=', 0);
                            }
                        }
                    }
                }
            }
        }
        $this->db->select('*');
        $this->db->from('tbl_property_mauza as m');
        $this->db->join('tbl_property_patwarcircle as p', 'p.p_id=m.p_id', 'left');
        $this->db->join('tbl_property_qgoi as q', 'q.q_id=p.q_id', 'left');
        $this->db->join('tbl_property_tehsils as t', 't.tehsil_id=q.tehsil_id', 'left');
        $this->db->join('tbl_property_districts as d', 'd.district_id = t.district_id', 'left');
        $this->db->join('tbl_property_divisions as di', 'di.division_id= d.division_id', 'left');
        $query = $this->db->get();
        return $query->result();

    }

    public function patwar_list_by_qgoi()
    {
        $q_id = $this->input->post("q_id");
        if ($q_id == 0) {
            $this->db->order_by("patwar_circle", "ASC");
            $query = $this->db->get('tbl_property_patwarcircle');
            return $query->result();
        } else {
            $this->db->where("q_id", $q_id);
            $this->db->order_by("patwar_circle", "ASC");
            $query = $this->db->get('tbl_property_patwarcircle');
            return $query->result();
        }
    }

    public function mauza_detail($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_property_mauza as m');
        $this->db->join('tbl_property_patwarcircle as p', 'p.p_id = m.p_id', 'left');
        $this->db->join('tbl_property_qgoi as q', 'q.q_id = m.q_id', 'left');
        $this->db->join('tbl_property_tehsils as t', 't.tehsil_id = m.tehsil_id', 'left');
        $this->db->where('m.mauza_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

}

?>
