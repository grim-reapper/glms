<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_litigation extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }

    public function get_list($litigation_category_id = 0)
	{
		  $user_level_property = array();
	      $user_level_property =  $this->mdl_users->user_level_property( $this->session->userdata('user_id') );
		  
		  if($this->session->userdata('group_id')== 1 || $this->session->userdata('group_id')== 2 )
		  {
			
		  }
		  else if($this->session->userdata('group_id')== 3)
		  {
			  $this->db->where('m.tehsil_id',$user_level_property['tehsil'] );
		  }
		  else if($this->session->userdata('group_id')== 4)
		  {
			  $this->db->where('m.q_id',$user_level_property['qanungoi'] );
		  }
		  else if($this->session->userdata('group_id')== 5)
		  {
			  $this->db->where('m.p_id',$user_level_property['patwar'] );
		  }	
		  
		$this->db->select("l.*,m.*,c.*");
		$this->db->from('tbl_litigation as l');
		$this->db->join('tbl_property_mauza as m','m.mauza_id = l.mauza_id','left');
		$this->db->join('tbl_litigation_category as c','c.litigation_category_id = l.litigation_category_id','left');
		if($litigation_category_id != 0)
		{
		    $this->db->where("l.litigation_category_id", $litigation_category_id); 
		}
			$this->db->order_by("l.case_number", "ASC"); 
			$query = $this->db->get();
			return $query->result();
		
	}
	
	
  public function get_list_by_ajax()
	{
		
        if($this->input->post('type')== 'sub')
		  {
			if($this->input->post('tehsil_id')!=''){
			  $this->db->where('m.tehsil_id',$this->input->post('tehsil_id') );
			}
			else
			{
			  $this->db->where('m.tehsil_id !=',0); 
			}
		  }
		  else if($this->input->post('type')== 'qanungoi')
		  {
			 if($this->input->post('q_id')!='')
			 {
                $this->db->where('m.q_id',$this->input->post('q_id'));
			 } 
			 else
			 {
			    $this->db->where('m.q_id !=',0); 
			 }
		  }
		  else if($this->input->post('type')== 'patwar')
		  {
			  if($this->input->post('p_id') !='')
			  {
			     $this->db->where('m.p_id',$this->input->post('p_id') );
			  }
			  else
			  {
				  $this->db->where('m.p_id !=',0 );  
			  }
		  }
		  else if($this->input->post('type')== 'mauza')
		  {
			  if($this->input->post('mauza_id') !='')
			  {
			     $this->db->where('m.mauza_id',$this->input->post('mauza_id') );
			  }
			  else
			  {
			     $this->db->where('m.mauza_id !=',0); 
			  }
		  }

		  
		$this->db->select("l.*,m.*,c.*");
		$this->db->from('tbl_litigation as l');
		$this->db->join('tbl_property_mauza as m','m.mauza_id = l.mauza_id','left');
		$this->db->join('tbl_litigation_category as c','c.litigation_category_id = l.litigation_category_id','left');
		$this->db->order_by("l.case_number", "ASC"); 
		$query = $this->db->get();
		return $query->result();
		
	}	
	
	
  public function get_litigation($id)
	{
		$this->db->select("l.*,m.*,c.*");
		$this->db->from('tbl_litigation as l');
		$this->db->join('tbl_property_mauza as m','m.mauza_id = l.mauza_id','left');
		$this->db->join('tbl_litigation_category as c','c.litigation_category_id = l.litigation_category_id','left');
		$this->db->where('l.litigation_id',$id);
		$query = $this->db->get();
		return $query->row();
		
	}
  public function get_litigation_action($id)
  {
	 $this->db->order_by("litigation_action_id", "DESC"); 
	 $this->db->where('litigation_id',$id);
	$query = $this->db->get('tbl_litigation_action');
	return $query->result(); 
  }
  
  
	public function get_cal()
	{
		$conf = array(
               'start_day'    => 'monday',
               'month_type'   => 'long',
               'day_type'     => 'long',
			   'show_next_prev'=> 'true',
			'next_prev_url' => site_url('litigation/calendar')
		);
		
		$conf['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}
			
			{heading_row_start}<tr class="header">{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">Prev Month</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">Next Month</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr class="day_names">{/week_row_start}
			{week_day_cell}<td class="top_day">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';
		$this->load->library('calendar',$conf);	
	
      $data = $this->calendar_data($this->uri->segment(3), $this->uri->segment(4));
		
     return  $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4),$data);
	 
	}


public function calendar_data($year,$month)
  {
	   
	      $user_level_property = array();
	      $user_level_property =  $this->mdl_users->user_level_property( $this->session->userdata('user_id') );
		  
		  if($this->session->userdata('group_id')== 1 || $this->session->userdata('group_id')== 2 )
		  {
			
		  }
		  else if($this->session->userdata('group_id')== 3)
		  {
			  $this->db->where('m.tehsil_id',$user_level_property['tehsil'] );
		  }
		  else if($this->session->userdata('group_id')== 4)
		  {
			  $this->db->where('m.q_id',$user_level_property['qanungoi'] );
		  }
		  else if($this->session->userdata('group_id')== 5)
		  {
			  $this->db->where('m.p_id',$user_level_property['patwar'] );
		  }	
		  
		$date = $year.'-'.$month;
		$this->db->like('a.next_date',$date, 'after');
		
	    $this->db->select("l.*,a.*,c.*,m.*,t.*");
		$this->db->from('tbl_litigation as l');
		$this->db->join('tbl_litigation_action as a','a.litigation_id = l.litigation_id','left');
		$this->db->join('tbl_property_mauza as m','m.mauza_id = l.mauza_id','left');
		$this->db->join('tbl_property_tehsils as t','t.tehsil_id = m.tehsil_id','left');
		$this->db->join('tbl_litigation_category as c','c.litigation_category_id  = l.litigation_category_id','left');
		

		$query = $this->db->get();
		$litigation = $query->result();
		
		$data = array();
		
	foreach($litigation as $list)
		{	
		   $key = substr($list->next_date,8,2);
		   $key= (int)$key;
		   
		   if(array_key_exists($key,$data))
			{
				 if($list->litigation_category_id == 1)
				 {
					 $class = 'sc';
				 }
				 else if($list->litigation_category_id == 2)
				 {
					 $class = 'hc';
				 }
				 else if($list->litigation_category_id == 3)
				 {
					 $class = 'bor';
				 }
				 else if($list->litigation_category_id == 4)
				 {
					 $class = 'ombudsman';
				 }
				 else if($list->litigation_category_id == 5)
				 {
					 $class = 'civil';
				 }
				 else if($list->litigation_category_id == 6)
				 {
					 $class = 'etpb';
				 }
				 else if($list->litigation_category_id == 7)
				 {
					 $class = 'other';
				 }
				 
				  $k = substr($list->next_date,8,2);
				  $k= (int)$k;
				  $pre_item = $data[$k];
				  
				
				  
				  if(strlen($list->name_of_judge)!=0)
				  {
				    $t = 'Before  '.$list->name_of_judge.' , ';
				  }
				  else
				  {
					$t = 'Before  '.str_replace('Cases','',$list->category_name).' , ';  
				  }
				  $t .= 'Mauza : '.$list->mouza_name.' , ';
				  $t .= 'Sub Division : '.$list->tehsil_name.' , ';
				  $t .= 'CP : '.$list->official_concerned.' , ';
				  $t .= 'Cell: '.$list->contact_number;
				 
				  $a = 	str_replace('Cases','',$list->category_name).'('.$list->case_number.')';
				  $item = "<div class='data_item rightDir  $class ' title='$t' >".anchor('litigation/view_detail/'.$list->litigation_id,$a)."</div>";
				 
				 $pre_item .=  $item;
				 $key = substr($list->next_date,8,2);
				 $key= (int)$key;
				 $data[$key] = $pre_item ;
			 
	
			}
			else
			{
				 if($list->litigation_category_id == 1)
				 {
					 $class = 'sc';
				 }
				 else if($list->litigation_category_id == 2)
				 {
					 $class = 'hc';
				 }
				 else if($list->litigation_category_id == 3)
				 {
					 $class = 'bor';
				 }
				 else if($list->litigation_category_id == 4)
				 {
					 $class = 'ombudsman';
				 }
				 else if($list->litigation_category_id == 5)
				 {
					 $class = 'civil';
				 }
				 else if($list->litigation_category_id == 6)
				 {
					 $class = 'etpb';
				 }
				 else if($list->litigation_category_id == 7)
				 {
					 $class = 'other';
				 }

		 
			       if(strlen($list->name_of_judge)!=0)
					  {
						 $t = 'Before  '.$list->name_of_judge.' , ';
					  }
					  else
					  {
						$t = 'Before  '.str_replace('Cases','',$list->category_name).' , ';  
					  }
					  
				  $t .= 'Mauza : '.$list->mouza_name.' , ';
				  $t .= 'Sub Division : '.$list->tehsil_name.' , ';
				  $t .= 'CP : '.$list->official_concerned.' , ';
				  $t .= 'Cell: '.$list->contact_number;
				  $a = str_replace('Cases','',$list->category_name).'('.$list->case_number.')';
				  $item = "<div class='data_item rightDir  $class ' title='$t' >".anchor('litigation/view_detail/'.$list->litigation_id,$a)."</div>";		
				  $key = substr($list->next_date,8,2);
				  $key= (int)$key;
				  $data[$key] = $item ;	
		    }
			
		}  
		
		return $data;
	  
  }

public function save()
  {
		$data = array(
				'category'     			=> $this->input->post('category'),
				'litigation_category_id'=> $this->input->post('litigation_category_id'),
				'name_of_court'         => $this->input->post('name_of_court'),
				'name_of_judge'	 		=> $this->input->post('judge_name'),
				'case_number'			=> $this->input->post('case_number'),
				'date_of_institution'	=> date("Y-m-d",strtotime($this->input->post('institution_date'))), 
				'title_of_case'			=> $this->input->post('title_of_case'),
				'case_summary'			=> $this->input->post('case_summary'),
				'property_title'		=> $this->input->post('title_of_property'), 
				'property_category'		=> $this->input->post('property_category'), 
				'description_of_land'	=> $this->input->post('description_of_land'),
				'area_kanal' 			=> $this->input->post('kanal'),
				'area_marla'			=> $this->input->post('marla'),
				'area_sqft'				=> $this->input->post('sqft'),
				'mauza_id'				=> $this->input->post('mauza_id'), 
				'date_of_hearing'     	=> date("Y-m-d",strtotime( $this->input->post('date_of_hearing'))),
				'official_concerned'	=> $this->input->post('dealing_official'),
				'contact_number'		=> $this->input->post('DO_contact_no'),
				'state_counsel'     	=> $this->input->post('name_of_counsel'),
				'sc_contact_number' 	=> $this->input->post('contact_of_counsel'), 
				'feedback_no'		    => $this->input->post('feedback_no'), 
				'further_action'     	=> $this->input->post('further_action')
				 );
		
		$this->db->insert('tbl_litigation',$data);
		$litigation_id = $this->db->insert_id();
		for($i=1; $this->input->post('suing_counter')>$i ; $i++)
		{
			$data = array(
             
				'suing_party_name' 	       => $this->input->post('suing_name_'.$i),
				'suing_party_father_name'  => $this->input->post('suing_father_name_'.$i),
				'suing_party_address'      => $this->input->post('suing_address_'.$i),
				'litigation_id'		       => $litigation_id
			   );
		 if( strlen($this->input->post('suing_name_'.$i))>2){
		    $this->db->insert('tbl_suing_party',$data);
		  }
		}
		
	 for($i=1; $this->input->post('defending_counter')>$i ; $i++)
		{
			$data = array(
             
				'defending_party_name' 	   => $this->input->post('defending_name_'.$i),
				'defending_party_address'  => $this->input->post('defending_address_'.$i),
				'litigation_id'		       => $litigation_id
			   );
		 if( strlen($this->input->post('defending_name_'.$i))>2){
		   $this->db->insert('tbl_defending_party',$data);
		 }
		}
		
  }
public function save_action()
  {
		$data = array(
             	'next_date'     	 => date("Y-m-d",strtotime( $this->input->post('next_day_of_hearing'))),
				'proceedings_taken'  => $this->input->post('proceedings_taken'),
				'appointed_for'      => $this->input->post('appointed_for'),
				'reply_status'	     => $this->input->post('reply_status'),
				'injuction_status'	 => $this->input->post('injuction_status'),
				'final_out_come'     => $this->input->post('final_out_come'),
				'remarks'			 => $this->input->post('remarks'),
				'litigation_id'		 => $this->input->post('litigation_id')
			   );
		
		$this->db->insert('tbl_litigation_action',$data);
  }

public function save_suing()
  {
		$data = array(
             
				'suing_party_name' 	       => $this->input->post('name'),
				'suing_party_father_name'  => $this->input->post('father_name'),
				'suing_party_address'      => $this->input->post('address'),
				'litigation_id'		       => $this->input->post('litigation_id')
			   );
		
		$this->db->insert('tbl_suing_party',$data);
  }

public function save_defending()
  {
		$data = array(
				'defending_party_name' 	   => $this->input->post('name'),
				'defending_party_address'  => $this->input->post('address'),
				'litigation_id'		       => $this->input->post('litigation_id')
			   );
		
		$this->db->insert('tbl_defending_party',$data);
  }
 public function get_defending_party($id)
  {
	 $this->db->where('litigation_id',$id);
	$query = $this->db->get('tbl_defending_party');
	return $query->result(); 
  }
  public function get_suing_party($id)
  {
	 $this->db->where('litigation_id',$id);
	$query = $this->db->get('tbl_suing_party');
	return $query->result(); 
  }
  
  public function suing_party_name_by_litigation($id)
  {
	 $this->db->select('suing_party_name');
	 $this->db->where('litigation_id',$id);
	$query = $this->db->get('tbl_suing_party');
	if($query->num_rows()> 0){
		$suing = $query->row(); 
		return $suing->suing_party_name;
	}
	else
	{
	    return '';
	}
  }
  
  public function next_date_by_litigation($id)
  {
	 $this->db->select('next_date');
	 $this->db->order_by("litigation_action_id", "desc"); 
	 $this->db->limit(1);
	 $this->db->where('litigation_id',$id);
	$query = $this->db->get('tbl_litigation_action');
	if($query->num_rows()> 0){
		$date = $query->row(); 
		return $date->next_date;
	}
	else
	{
	    return '1970-01-01';
	}
  }
  
  
public function edit()
  {
		$data = array(
				'category'     			=> $this->input->post('category'),
				'litigation_category_id'=> $this->input->post('litigation_category_id'),
				'name_of_judge'	 		=> $this->input->post('judge_name'),
				'case_number'			=> $this->input->post('case_number'),
				'date_of_institution'	=> date("Y-m-d",strtotime($this->input->post('institution_date'))), 
				'title_of_case'			=> $this->input->post('title_of_case'),
				'case_summary'			=> $this->input->post('case_summary'),
				'property_title'		=> $this->input->post('title_of_property'), 
				'property_category'		=> $this->input->post('property_category'), 
				'description_of_land'	=> $this->input->post('description_of_land'),
				'area_kanal' 			=> $this->input->post('kanal'),
				'area_marla'			=> $this->input->post('marla'),
				'area_sqft'				=> $this->input->post('sqft'),
				'mauza_id'				=> $this->input->post('mauza_id'), 
				'date_of_hearing'     	=> date("Y-m-d",strtotime( $this->input->post('date_of_hearing'))),
				'official_concerned'	=> $this->input->post('dealing_official'),
				'contact_number'		=> $this->input->post('DO_contact_no'),
				'state_counsel'     	=> $this->input->post('name_of_counsel'),
				'sc_contact_number' 	=> $this->input->post('contact_of_counsel'), 
				'feedback_no'		    => $this->input->post('feedback_no'), 
				'further_action'     	=> $this->input->post('further_action')
				 );
		$this->db->where('litigation_id',$this->input->post('litigation-id'));
		$this->db->update('tbl_litigation',$data);
		 
		 
 // update defending party
		for($i=1;$this->input->post('suing_counter') > $i ; $i++)
		{
			$data = array(
					'suing_party_name'         =>  $this->input->post('suing_name_'.$i),
					'suing_party_father_name'  =>  $this->input->post('suing_father_name_'.$i),
					'suing_party_address'      =>  $this->input->post('suing_address_'.$i),
					'litigation_id'            =>  $this->input->post('litigation-id')
	            	);
			
		if(strlen($this->input->post('suing_name_'.$i))>2)
		{
			if($this->input->post('suing_party_id_'.$i))
			{
				$this->db->where('suing_party_id',$this->input->post('suing_party_id_'.$i));
				$this->db->update('tbl_suing_party',$data);	
			}
			else
			{
				 $this->db->insert('tbl_suing_party',$data);	
			}
		}
	 }
	 // update defending party
    for($i=1;$this->input->post('defending_counter') > $i ; $i++)
		{
			$data = array(
					'defending_party_name'     =>  $this->input->post('defending_name_'.$i),
					'defending_party_address'  =>  $this->input->post('defending_address_'.$i),
					'litigation_id'            =>  $this->input->post('litigation-id')
				   );
		if(strlen($this->input->post('defending_name_'.$i))>2)
		{
			if($this->input->post('defending_party_id_'.$i))
			{
				$this->db->where('defending_party_id',$this->input->post('defending_party_id_'.$i));
				$this->db->update('tbl_defending_party',$data);	
			}
			else
			{
				 $this->db->insert('tbl_defending_party',$data);	
			}
		}
	 }
  }
  public function delete($id) {
		$this->db->where('litigation_id',$id);
		$this->db->delete('tbl_litigation');
		
		$this->db->where('litigation_id',$id);
		$this->db->delete('tbl_defending_party');
		
		$this->db->where('litigation_id',$id);
		$this->db->delete('tbl_suing_party');
		
		$this->db->where('litigation_id',$id);
		$this->db->delete('tbl_litigation_action');
  }
 public function get_litigation_category($id = 0)
  {
     $this->db->where('litigation_category_id',$id); 
	 $query = $this->db->get('tbl_litigation_category');
	 return $query->row(); 
  }
  public function get_category_list()
  {
	 $this->db->order_by("category_order", "ASC"); 
	 $query = $this->db->get('tbl_litigation_category');
	 return $query->result(); 
  }
 
 public function get_suing_party_by_litigation_id($litigation_id)
  {
	 $this->db->order_by("suing_party_id", "ASC"); 
	 $this->db->limit(1);
	 $this->db->where('litigation_id',$litigation_id);
	 $this->db->select('suing_party_name');
	 $query = $this->db->get('tbl_suing_party');
	 $suing_party =  $query->row(); 
	 return  $suing_party->suing_party_name;
  }
  public function get_sms()
  {
	    $date = date("Y-m-d",time());
		$this->db->where('a.next_date',$date);
	    $this->db->select("l.name_of_court,l.litigation_id,l.contact_number,l.feedback_no,a.next_date,m.mouza_name");
		$this->db->from('tbl_litigation_action as a');
		$this->db->join('tbl_litigation as l','l.litigation_id = a.litigation_id','left');
		$this->db->join('tbl_property_mauza as m','m.mauza_id = l.mauza_id','left');
		 
		$query = $this->db->get();
        $litigation = $query->result();
	   $data = array();
	   foreach($litigation as  $list)
	   {
		  $item = array( 
			  'name_of_court'  =>    $list->name_of_court,
			  'contact_number' =>    $list->contact_number,
			  'feedback_no'    =>    $list->feedback_no,
			  'next_date'      =>    $list->next_date,
			  'mouza_name'     =>    $list->mouza_name,
			  'suing_party'    =>    $this->get_suing_party_by_litigation_id($list->litigation_id),
		  );
		  $data[] = $item ;
	   }
		
   return $data;
  } 
 
}

?>