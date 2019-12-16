<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_revenue extends CI_Model {
    
    
    public function get_revenue_records()
    {
        return $this->db->select("*")
                ->from('tbl_filescatalog_revenue as r')
                ->join('tbl_property_mauza as m','m.mauza_id=r.mauza_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left')
                ->join('tbl_property_districts as d','d.district_id=t.district_id','left')
                ->get()
                ->result();
    }
    
    public function save_revenue_file()
    {
        
        $unique_code = '';
        
        $dist_code= $this->db->select("*")
                ->from('tbl_property_districts')
                ->where('district_id',$this->input->post('district'))
                ->get()
                ->row();
        $hadbast= $this->db->select("*")
                ->from('tbl_property_mauza')
                ->where('mauza_id',$this->input->post('mauza'))
                ->get()
                ->row();
        
        $unique_code .= $dist_code->district_code;
        $unique_code .= '-'.$hadbast->hadbast;
        $unique_code .= '-'.$this->input->post('year');
        $unique_code .= '-'.$this->input->post('category');
        $data=array(
            
            'revenue_code'    =>$unique_code,
            'district_id'     =>$this->input->post('district'),
            'tehsil_id'       =>$this->input->post('subdiv'),
            'mauza_id'        =>$this->input->post('mauza'),
            'revenue_category'=>$this->input->post('category'),
            'revenue_year'    =>$this->input->post('year'),
            'volumes'         =>$this->input->post('volumes'),
            'consign_date'    =>date("Y-m-d",strtotime($this->input->post('date'))),
            'area_kanal'      =>$this->input->post('kanal'),
            'area_marla'      =>$this->input->post('marla'),
            'area_sqft'       =>$this->input->post('sqft'),
            'no_of_mutations' =>$this->input->post('no_of_mutations'),
            'no_of_khatas'    =>$this->input->post('no_of_khatas'),
            'no_of_khatoonis' =>$this->input->post('no_of_khatoonis'),
            'rack_no'         =>$this->input->post('rack_no'),
            'row_no'          =>$this->input->post('row_no'),
            'column_no'       =>$this->input->post('column_no'),
            'detail'          =>$this->input->post('note'),
            
        );
         $this->db->insert('tbl_filescatalog_revenue', $data);
    }
    public function update_revenue_file()
    {
         
        $unique_code = '';
        
        $dist_code= $this->db->select("*")
                ->from('tbl_property_districts')
                ->where('district_id',$this->input->post('district'))
                ->get()
                ->row();
        $hadbast= $this->db->select("*")
                ->from('tbl_property_mauza')
                ->where('mauza_id',$this->input->post('mauza'))
                ->get()
                ->row();
        
        $unique_code .= $dist_code->district_code;
        $unique_code .= '-'.$hadbast->hadbast;
        $unique_code .= '-'.$this->input->post('year');
        $unique_code .= '-'.$this->input->post('category');
        $data=array(
            
            'revenue_code'    =>$unique_code,
            'district_id'     =>$this->input->post('district'),
            'tehsil_id'       =>$this->input->post('subdiv'),
            'mauza_id'        =>$this->input->post('mauza'),
            'revenue_category'=>$this->input->post('category'),
            'revenue_year'    =>$this->input->post('year'),
            'volumes'         =>$this->input->post('volumes'),
            'consign_date'    =>date("Y-m-d",strtotime($this->input->post('date'))),
            'area_kanal'      =>$this->input->post('kanal'),
            'area_marla'      =>$this->input->post('marla'),
            'area_sqft'       =>$this->input->post('sqft'),
            'no_of_mutations' =>$this->input->post('no_of_mutations'),
            'no_of_khatas'    =>$this->input->post('no_of_khatas'),
            'no_of_khatoonis' =>$this->input->post('no_of_khatoonis'),
            'rack_no'         =>$this->input->post('rack_no'),
            'row_no'          =>$this->input->post('row_no'),
            'column_no'       =>$this->input->post('column_no'),
            'detail'          =>$this->input->post('note'),
            
        );
        
                $this->db->where("revenue_id",$this->input->post("revenue_id"));   
		$this->db->update('tbl_filescatalog_revenue',$data);
        
    }

        public function get_file_by_id($id)
    {
        return $this->db->select("*")
                ->from('tbl_filescatalog_revenue as r')
                ->join('tbl_property_mauza as m','m.mauza_id=r.mauza_id','left')
                ->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left')
                ->join('tbl_property_districts as d','d.district_id=t.district_id','left')
                ->where('r.revenue_id',$id)
                ->get()
                ->row();
    }

        public function revenue_file_delete($id)
    {
        $this->db->where("revenue_id", $id);
        $this->db->delete('tbl_filescatalog_revenue');
        redirect('revenue');
    }
    
    public function subdiv_by_district()
    {
        if($this->input->post('district_id')==0)
        {
            return $this->db->select("*")
                ->from('tbl_property_tehsils ')
                    ->get()
                    ->result();
            
        }
        else {
        return $this->db->select("*")
                ->from('tbl_property_tehsils as t')
                ->join('tbl_property_districts as d','d.district_id=t.district_id')
                ->where('t.district_id',$this->input->post('district_id'))
                ->get()
                ->result();
        }
    }
    public function mauza_by_subdiv()
    {
        if($this->input->post('subdiv_id')==0)
        {
            return $this->db->select("*")
                ->from('tbl_property_mauza ')
                    ->get()
                    ->result();
            
        }
        else {
        return $this->db->select("*")
                ->from('tbl_property_mauza as m')
                ->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id')
                ->where('m.tehsil_id',$this->input->post('subdiv_id'))
                ->get()
                ->result();
        }
    }

}