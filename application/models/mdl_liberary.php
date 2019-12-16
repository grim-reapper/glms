<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_liberary extends CI_Model {

    var $gallery_path;

    function __construct() {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

//////////////////////////////// upload_file   //////////////////////////////////////////////		
    private function upload_file($file, $name, $overwrite = false) {
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

    public function get_lib_data() {
        return $this->db->select('*')
                        ->from('tbl_liberary')
                        ->get()
                        ->result();
    }

    public function save_book() {
        $unique_id='';
        $district_code = $this->db->select("*")
                ->from('tbl_property_districts')
                ->where('district_id',$this->input->post('district'))
                ->get()
                ->row();
//        $total=$this->db->select('COUNT(liberary_id) as no')
//                ->from('tbl_liberary')
//                ->where('ownership',$this->input->post('ownership'))
//                ->get()
//                ->row();
        $total1=$this->db->select('COUNT(liberary_id) as no')
                ->from('tbl_liberary')
                ->where('district_id',$this->input->post('district'))
                ->get()
                ->row();
        $no_of_books=$total1->no+1;
        if($this->input->post('ownership') == 'Government')
        {
            $unique_id .=$district_code->district_code;
             $book_no = sprintf("%07d", $no_of_books);
             $unique_id .=$book_no;
             $unique_id .='G';
            
        }
        else
        {
            $unique_id .=$district_code->district_code;
             $book_no = sprintf("%07d", $no_of_books);
             $unique_id .=$book_no;
             $unique_id .='P';
            
        }
        $data = array(
            'district_id' => $this->input->post('district'),
            'book_unique_id'=>$unique_id,
            'title_page' => $this->upload_file('title_page', 'title_page_'),
            'contents' => $this->upload_file('contents', 'contents_'),
            'ownership' => $this->input->post('ownership'),
            'owner_name' => $this->input->post('name_of_owner'),
            'contact_no' => $this->input->post('contact'),
            'book_title' => $this->input->post('book_title'),
            'book_author' => $this->input->post('author'),
            'book_edition' => $this->input->post('edition'),
            'book_category' => $this->input->post('category'),
            'pages' => $this->input->post('pages'),
            'book_condition' => $this->input->post('condition'),
            'almirah_no' => $this->input->post('almirah_no'),
            'box_no' => $this->input->post('box_no'),
            'status' => $this->input->post('status'),
            'price' => $this->input->post('price'),
            'availability' => $this->input->post('availability'),
            'note' => $this->input->post('note')
        );
        $this->db->insert('tbl_liberary', $data);
    }
    public function update_book()
    {
         $data = array(
            'district_id' => $this->input->post('district'),
            'ownership' => $this->input->post('ownership'),
            'owner_name' => $this->input->post('name_of_owner'),
            'contact_no' => $this->input->post('contact'),
            'book_title' => $this->input->post('book_title'),
            'book_author' => $this->input->post('author'),
            'book_edition' => $this->input->post('edition'),
            'book_category' => $this->input->post('category'),
            'pages' => $this->input->post('pages'),
            'book_condition' => $this->input->post('condition'),
            'almirah_no' => $this->input->post('almirah_no'),
            'box_no' => $this->input->post('box_no'),
            'status' => $this->input->post('status'),
            'price' => $this->input->post('price'),
            'availability' => $this->input->post('availability'),
            'note' => $this->input->post('note')
        );
         $this->db->where('liberary_id',$this->input->post('liberary_id'));
         $this->db->update('tbl_liberary', $data);
        
    }

    public function delete_book($id) {
        $this->db->where("liberary_id", $id);
        $this->db->delete('tbl_liberary');
    }
    public function get_district()
    {
        return $this->db->select("*")
                ->from('tbl_property_districts')
                ->get()
                ->result();
    }
    public function view_book($id)
    {
        return $this->db->select("*")
                ->from('tbl_liberary as l')
                ->join('tbl_property_districts as d','d.district_id=l.district_id')
                ->where('liberary_id',$id)
                ->get()
                ->row();
    }
    public function books_by_district()
    {
        if($this->input->post('district_id') == 0 || $this->input->post('district_id') == '')
        {
             return $this->db->select("*")
                ->from('tbl_liberary')
                ->get()
                ->result();
        }
        else
        {
        return $this->db->select("*")
                ->from('tbl_liberary')
                ->where('district_id',$this->input->post('district_id'))
                ->get()
                ->result();
        }
    }
    public function books_by_private()
    {
         return $this->db->select("*")
                ->from('tbl_liberary')
                ->where('ownership',$this->input->post('private'))
                ->get()
                ->result();
    }
    public function books_by_govt()
    {
         return $this->db->select("*")
                ->from('tbl_liberary')
                ->where('ownership','Government')
                ->get()
                ->result();
    }
    public function books_all()
    {
      return $this->db->select("*")
                ->from('tbl_liberary')
                ->get()
                ->result();  
    }
    public function get_content_book($id)
    {
        return $this->db->select('*')
                ->from('tbl_liberary')
                ->where('liberary_id',$id)
                ->get()
                ->row();
    }

}