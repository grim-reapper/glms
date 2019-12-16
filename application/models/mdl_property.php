<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_property extends CI_Model {
     var $gallery_path;
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');

	}
//////////////////////////////// upload_file   //////////////////////////////////////////////		
	private function upload_file($file,$name,$overwrite=false)
	{
		  $config = array();
		  $config = array(
				'allowed_types' => '*',
				'upload_path' => $this->gallery_path,
				'max_size' => 2048 ,
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
	
////////////////////////////////  genrate unique property   //////////////////////////////////////////////	
  private function genrate_unique_property($ownership,$mauza_id,$qitat,$unique_khasra)
	{
		$data = array();
		$unique_property = '';
		if($ownership=="Nazul")                { $own='NZ'; }
		else if($ownership=="Prov. Govt. Land"){ $own='PG'; }
		else if($ownership=="Prov. Deptt.")    { $own='PD'; }
		else if($ownership=="Fed. Deptt.")     { $own='FD'; }
		else if($ownership=="Evacuee")     	   { $own='EV'; }
		else if($ownership=="Fed. Govt. Land") { $own='FG'; }
		else if($ownership=="Ex-MCL")          { $own='EM'; }
		else if($ownership=="Other")           { $own='OT'; }
		
		 $data['own_short'] = $own;
		 
		    $unique_property  .= $own;
			$this->db->where("mauza_id",$mauza_id);
			$query = $this->db->get('tbl_property_mauza');
			$row = $query->row();
			$hadbast = $row->hadbast;
			
			$hadbast          =  sprintf("%03d",$hadbast);
			$unique_property .= '-'.$hadbast;
		
			$qitat            =  sprintf("%02d",$qitat);
			$unique_property .=  '-'.$qitat;
			
			$unique_khasra    =  sprintf("%05d",$unique_khasra);
			$unique_property .= '-'.$unique_khasra;

			$data['up_without_min'] = $unique_property;
			
            $this->db->order_by("unique_property", "desc"); 
			$this->db->where("up_without_min",$unique_property); 
			$this->db->limit(1);
			$query = $this->db->get('tbl_property');
			
			if ($query->num_rows() > 0)
			 {
			    $row = $query->row();
				$row->unique_property;
					if($row->unique_property==$unique_property.'-00')
					{
						$min = 2;
						$data = array(
								"unique_property"=>$unique_property.'-01'
							  );
						
						$this->db->where("unique_property",$row->unique_property);
						$this->db->update('tbl_property',$data);
				  }
				  else
				  {
						$min = substr($row->unique_property ,16 ,2);
						
						$min = (int)$min+1;
						
				  }
			 }
			 else
			 {
			    $min = 0;
			 }

	   $min   =  sprintf("%02d",$min);
	   $unique_property .=  '-'.$min;	
	   $data['unique_property'] = $unique_property;
	   return $data;
	}

 private function genrate_unique_property_update($ownership,$mauza_id,$qitat,$unique_khasra)
	{
			$data = array();
			$unique_property = '';
		
			if($ownership=="Nazul")                { $own='NZ'; }
			else if($ownership=="Prov. Govt. Land"){ $own='PG'; }
			else if($ownership=="Prov. Deptt.")    { $own='PD'; }
			else if($ownership=="Fed. Deptt.")     { $own='FD'; }
			else if($ownership=="Evacuee")     	   { $own='EV'; }
			else if($ownership=="Fed. Govt. Land") { $own='FG'; }
			else if($ownership=="Ex-MCL")          { $own='EM'; }
			else if($ownership=="Other")           { $own='OT'; }
		
		    $data['own_short'] = $own;
		
		    $unique_property  .= $own;
			$this->db->where("mauza_id",$mauza_id);
			$query = $this->db->get('tbl_property_mauza');
			$row = $query->row();
			$hadbast = $row->hadbast;
			
			$hadbast          =  sprintf("%03d",$hadbast);
			$unique_property .= '-'.$hadbast;
		
			$qitat            =  sprintf("%02d",$qitat);
			$unique_property .=  '-'.$qitat;
			
			$unique_khasra    =  sprintf("%05d",$unique_khasra);
			$unique_property .= '-'.$unique_khasra;
			
        if($this->input->post("up_without_min")!=$unique_property)
		  {
            
			$data['up_without_min'] = $unique_property;
			
            $this->db->order_by("unique_property", "desc"); 
			$this->db->where("up_without_min",$unique_property); 
			$this->db->limit(1);
			$query = $this->db->get('tbl_property');
			
			if ($query->num_rows() > 0)
			 {
			    $row = $query->row();
				$row->unique_property;
					if($row->unique_property==$unique_property.'-00')
					{
						$min = 2;
						$data = array(
								"unique_property"=>$unique_property.'-01'
							  );
						
						$this->db->where("unique_property",$row->unique_property);
						$this->db->update('tbl_property',$data);
				  }
				  else
				  {
						$min = substr($row->unique_property ,16 ,2);
						
						$min = (int)$min+1;
						
				  }
			 }
			 else
			 {
			    $min 			  = 0;
			 }

	   $min   =  sprintf("%02d",$min);
	   $unique_property .=  '-'.$min;	
	   $data['unique_property'] = $unique_property;
	   return $data;
	 }
	 else
	 {
	   $data['unique_property'] = $this->input->post('unique_property');
	   $data['up_without_min']  = $this->input->post('up_without_min');
	   return $data; 
	 }
 }

//////////////////////////////// save   //////////////////////////////////////////////		 
 public function save()
	{
 $unique  = $this->genrate_unique_property($this->input->post('ownership'),$this->input->post('mauza_id'),$this->input->post('qitat'), $this->input->post('unique_khasra')); 
 
	   $data = array(
                               'unique_property'	=> $unique['unique_property'],	  
				'up_without_min'	=> $unique['up_without_min'],
				'own_short'			=> $unique['own_short'],
			        'na_no'				=> $this->input->post('na_no'),  
				'pp_no'				=> $this->input->post('pp_no'),  
				'uc_no'				=> $this->input->post('uc_no'),  
				'police_station'	=> $this->input->post('police_station'), 
				'mauza_id'		    => $this->input->post('mauza_id'),  
				'occupation_type'	=> $this->input->post('occupation_type'),  
				'ownership'			=> $this->input->post('ownership'),  
				'disposable'	    => $this->input->post('disposable'),  
				'khasra_nos'		=> $this->input->post('khasra'),  
				'unique_khasra'		=> $this->input->post('unique_khasra'),  
				'qitat'		        => $this->input->post('qitat'),  
				'area_kanal'		=> $this->input->post('kanal'),  
				'area_marla'		=> $this->input->post('marla'),  
				'area_sqft'		    => $this->input->post('sqft'),  
				'locality'			=> $this->input->post('locality'), 
				'land_reservation'	=> $this->input->post('land_reservation'), 
				'reservation_name'	=> $this->input->post('reservation_name'), 
				'annual_rent'		=> $this->input->post('annual_rent'),  
				'duty_rate'		    => $this->input->post('duty_rate'),  
				'market_rate'		=> $this->input->post('market_rate'),   
				'electric_meter'    => $this->input->post('electric_meter'),  
				'sui_gas'		 	=> $this->input->post('sui_gas'),  
				'water_supply'		=> $this->input->post('water_supply'),  
				'remarks'	   	    => $this->input->post('remarks'),  
				'latitude'		    => $this->input->post('latitude'), 
				'longitude'		    => $this->input->post('longitude'), 
				'shajra_picture'    => $this->upload_file('shajra_picture','shajra_picture_'), 
				'site_picture'	   	=> $this->upload_file('site_picture' ,'site_picture_') ,
				'history'	     	=> $this->upload_file('history' ,'history_')
			    );
	  
	   
		$this->db->insert('tbl_property', $data); 
		$property_id = $this->db->insert_id();
		
		if($this->input->post('occupation_type') == 'lease_occupation')
		{
			  $data = array(
					'property_id'		   => $property_id,  
					'occupant_category'    => $this->input->post('lease_occupant_category'), 
					'period_of_lease'      => $this->input->post('period_of_lease'),  
					'leasing_authority'	   => $this->input->post('lease_leasing_authority'),  
					'occupation_year'	   => $this->input->post('lease_occupation_year'),  
					'usage'		           => $this->input->post('lease_occupant_usage'), 
					'franchise'		       => $this->input->post('lease_franchise'),
					'trade_name'		   => $this->input->post('lease_trade_name'), 
					'buying_option'		   => $this->input->post('lease_buying_option'),
					'payment_mode'		   => $this->input->post('lease_payment_mode'), 
					'remarks'		       => $this->input->post('lease_occupant_remarks') 
					);
			$this->db->insert('tbl_occupant', $data); 
			$occupant_id = $this->db->insert_id();

            for($i=1; $this->input->post('lease_occupant_counter') > $i  ; $i++ )
			 {
			  if(array_key_exists('lease_occupant_name_'.$i, $_POST)){
			   $data = array(
					'occupant_id'		      => $occupant_id,  
					'occupant_list_name'	  => $this->input->post('lease_occupant_name_'.$i),  
					'occupant_list_parentage' => $this->input->post('lease_occupant_parentage_'.$i),  
					'occupant_list_cnic'	  => $this->input->post('lease_occupant_cnic_'.$i),  
					'occupant_list_cell_no'	  => $this->input->post('lease_occupant_cell_'.$i),  
					'occupant_list_address'	  => $this->input->post('lease_occupant_address_'.$i),  
					'occupant_list_pic'		  => $this->upload_file('lease_occupant_pic_'.$i ,'lease_occupant_pic_'.$occupant_id.'_'.$i)
					);
			     $this->db->insert('tbl_occupant_list', $data); 
			   }
		   }	
		}
		
	   else if($this->input->post('occupation_type') == 'illegal_occupation')
		{
			 
			 $data = array(
					'property_id'		=> $property_id,  
					'occupant_category' => $this->input->post('illegal_occupant_category'),  
					'occupation_year'	=> $this->input->post('illegal_occupation_year'),  
					'usage'		        => $this->input->post('illegal_occupant_usage'), 
					'franchise'		    => $this->input->post('illegal_franchise'), 
					'trade_name'		=> $this->input->post('illegal_trade_name'),  
					'buying_option'		=> $this->input->post('illegal_buying_option'),  
					'payment_mode'		=> $this->input->post('illegal_payment_mode'),  
					'remarks'		    => $this->input->post('illegal_occupant_remarks') 
					);
			$this->db->insert('tbl_occupant', $data); 
			$occupant_id = $this->db->insert_id();

		      
			 for($i=1; $this->input->post('illegal_occupant_counter') > $i  ; $i++ )
			 {
			 
			 if(array_key_exists('illegal_occupant_name_'.$i, $_POST)){
				 
			   $data = array(
					'occupant_id'		      => $occupant_id,  
					'occupant_list_name'	  => $this->input->post('illegal_occupant_name_'.$i),  
					'occupant_list_parentage' => $this->input->post('illegal_occupant_parentage_'.$i),  
					'occupant_list_cnic'	  => $this->input->post('illegal_occupant_cnic_'.$i),  
					'occupant_list_cell_no'	  => $this->input->post('illegal_occupant_cell_'.$i),  
					'occupant_list_pic'		  => $this->upload_file('illegal_occupant_pic_'.$i ,'illegal_occupant_pic_'.$occupant_id.'_'.$i)
					);
			     $this->db->insert('tbl_occupant_list', $data); 
			   }
			 }
		   	
		}
		else if($this->input->post('occupation_type') == 'deptt_occupation')
		{
			$data = array(
					'property_id'		=> $property_id,  
					'deptt_domain'	   	=> $this->input->post('deptt_domain'),  
					'deptt_name'		=> $this->input->post('deptt_name'),  
					'deptt_status'	    => $this->input->post('deptt_status'),  
					'deptt_address'		=> $this->input->post('deptt_address'),  
					'deptt_contact_person' => $this->input->post('deptt_contact_person'),  
					'deptt_contact_no' => $this->input->post('deptt_contact_no'),  
					'occupation_year'  => $this->input->post('depp_occupation_year'),  
					'deptt_remarks'	   => $this->input->post('deptt_remarks') 
					);
			$this->db->insert('deptt_occupation', $data); 
		
		}
	}
	
//////////////////////////////// edit //////////////////////////////////////////////	 
  
  
  public function edit()
	{
		   $property_id = $this->input->post('property_id');
 $unique  = $this->genrate_unique_property_update($this->input->post('ownership'),$this->input->post('mauza_id'),$this->input->post('qitat'),  $this->input->post('unique_khasra')); 
		   $data = array(
                'unique_property'	=> $unique['unique_property'],	  
				'up_without_min'	=> $unique['up_without_min'],
				'own_short'			=> $unique['own_short'],
			    'na_no'				=> $this->input->post('na_no'),  
				'pp_no'				=> $this->input->post('pp_no'),  
				'uc_no'				=> $this->input->post('uc_no'),  
				'police_station'	=> $this->input->post('police_station'), 
				'mauza_id'		    => $this->input->post('mauza_id'),  
				'ownership'			=> $this->input->post('ownership'),    
				'disposable'	    => $this->input->post('disposal_status'),  
				'khasra_nos'		=> $this->input->post('khasra'),  
				'unique_khasra'		=> $this->input->post('unique_khasra'),  
				'qitat'		        => $this->input->post('qitat'), 
				'area_kanal'		=> $this->input->post('kanal'),  
				'area_marla'		=> $this->input->post('marla'),  
				'area_sqft'		    => $this->input->post('sqft'),  
				'locality'			=> $this->input->post('locality'), 
				'land_reservation'	=> $this->input->post('land_reservation'), 
				'reservation_name'	=> $this->input->post('reservation_name'), 
				'annual_rent'		=> $this->input->post('annual_rent'),  
				'duty_rate'		    => $this->input->post('duty_rate'),  
				'market_rate'		=> $this->input->post('market_rate'),   
				'electric_meter'    => $this->input->post('electric_meter'),  
				'sui_gas'		 	=> $this->input->post('sui_gas'),  
				'water_supply'		=> $this->input->post('water_supply'),  
				'remarks'	   	    => $this->input->post('remarks')
			    );
		  
		  if(strlen($_FILES['shajra_picture']['name']))
		   {
		     $data['shajra_picture'] =  $this->upload_file('shajra_picture','shajra_picture_'.$property_id ,true);
		   }
		   if(strlen($_FILES['site_picture']['name']))
		   {
		     $data['site_picture'] =  $this->upload_file('site_picture','site_picture_'.$property_id ,true);
		   }
		  if(strlen($_FILES['history']['name']))
		   {
		     $data['history'] =  $this->upload_file('history','history_'.$property_id ,true);
		   }	   
		   
		  	/*		'unique_property'	=> $this->genrate_unique_property($this->input->post('ownership'),$this->input->post('mauza_id'),$this->input->post('qitat'),  $this->input->post('unique_khasra')),*/ 
		  
			 
		$this->db->where('property_id',$this->input->post('property_id'));  
		$this->db->update('tbl_property', $data); 
		
		
 	if($this->input->post('occupation_type') == 'private_occupation')
		{
			  $data = array(
					'property_id'		=> $property_id,  
					'occupant_category' => $this->input->post('occupant_category'),  
					'status'	   		=> $this->input->post('occupant_status'),  
					'leasing_authority'	=> $this->input->post('leasing_authority'),  
					'occupation_year'	=> $this->input->post('occupation_year'),  
					'usage'		        => $this->input->post('occupant_usage'), 
					'franchise'		    => $this->input->post('franchise'), 
					'trade_name'		=> $this->input->post('trade_name'),  
					'buying_option'		=> $this->input->post('buying_option'),  
					'payment_mode'		=> $this->input->post('payment_mode'),  
					'remarks'		    => $this->input->post('occupant_remarks') 
					);
			$this->db->where('occupant_id',$this->input->post('p_occupant_id'));  
			$this->db->update('tbl_occupant', $data); 
			
			$occupant_id  = $this->input->post('p_occupant_id');
			
			 for($i=1; $this->input->post('p_occupant_counter') > $i; $i++ )
			 {
			  if($this->input->post('occupant_list_id_'.$i)) 
			  {
				   $data = array(
						'occupant_id'		      => $this->input->post('p_occupant_id'),  
						'occupant_list_name'	  => $this->input->post('private_occupant_name_'.$i),  
						'occupant_list_parentage' => $this->input->post('private_occupant_parentage_'.$i),  
						'occupant_list_cnic'	  => $this->input->post('private_occupant_cnic_'.$i),  
						'occupant_list_cell_no'	  => $this->input->post('private_occupant_cell_'.$i)
						);
				  if(strlen($_FILES['private_occupant_pic_'.$i]['name']))
				   {
					  $data['occupant_list_pic'] =  $this->upload_file('private_occupant_pic_'.$i ,'private_occupant_pic_'.$occupant_id.'_'.$i,true);
				   }
				   
					 $this->db->where('occupant_list_id',$this->input->post('occupant_list_id_'.$i));  
					 $this->db->update('tbl_occupant_list', $data); 
			   }
			   else
			   {
					 $data = array(
						'occupant_id'		      => $this->input->post('p_occupant_id'),  
						'occupant_list_name'	  => $this->input->post('private_occupant_name_'.$i),  
						'occupant_list_parentage' => $this->input->post('private_occupant_parentage_'.$i),  
						'occupant_list_cnic'	  => $this->input->post('private_occupant_cnic_'.$i),  
						'occupant_list_cell_no'	  => $this->input->post('private_occupant_cell_'.$i),  
						'occupant_list_pic'		  => $this->upload_file('private_occupant_pic_'.$i ,'private_occupant_pic_'.$occupant_id.'_'.$i)
						);
					 $this->db->insert('tbl_occupant_list', $data);     
			   }
		  }
			
			
	}
 	else if($this->input->post('occupation_type') == 'lease_occupation'){
			  $data = array(
					'property_id'		=> $property_id,  
					'occupant_category' => $this->input->post('occupant_category'),  
					'period_of_lease'	=> $this->input->post('period_of_lease'),  
					'leasing_authority'	=> $this->input->post('leasing_authority'),  
					'occupation_year'	=> $this->input->post('occupation_year'),  
					'usage'		        => $this->input->post('occupant_usage'), 
					'franchise'		    => $this->input->post('franchise'), 
					'trade_name'		=> $this->input->post('trade_name'),  
					'buying_option'		=> $this->input->post('buying_option'),  
					'payment_mode'		=> $this->input->post('payment_mode'),  
					'remarks'		    => $this->input->post('occupant_remarks') 
					);
			$this->db->where('occupant_id',$this->input->post('p_occupant_id'));  
			$this->db->update('tbl_occupant', $data); 
			
			$occupant_id  = $this->input->post('p_occupant_id');
			
			 for($i=1; $this->input->post('lease_occupant_counter') > $i; $i++ )
			 {
			  if($this->input->post('occupant_list_id_'.$i)) 
			  {
				   $data = array(
						'occupant_id'		      => $this->input->post('p_occupant_id'),  
						'occupant_list_name'	  => $this->input->post('lease_occupant_name_'.$i),  
						'occupant_list_parentage' => $this->input->post('lease_occupant_parentage_'.$i),  
						'occupant_list_cnic'	  => $this->input->post('lease_occupant_cnic_'.$i),  
						'occupant_list_cell_no'	  => $this->input->post('lease_occupant_cell_'.$i),
						'occupant_list_address'	  => $this->input->post('lease_occupant_address_'.$i)
						);
				  if(strlen($_FILES['lease_occupant_pic_'.$i]['name']))
				   {
					  $data['occupant_list_pic'] =  $this->upload_file('lease_occupant_pic_'.$i ,'lease_occupant_pic_'.$occupant_id.'_'.$i,true);
				   }
				   
					 $this->db->where('occupant_list_id',$this->input->post('occupant_list_id_'.$i));  
					 $this->db->update('tbl_occupant_list', $data); 
			   }
			   else
			   {
					 $data = array(
						'occupant_id'		      => $this->input->post('p_occupant_id'),  
						'occupant_list_name'	  => $this->input->post('lease_occupant_name_'.$i),  
						'occupant_list_parentage' => $this->input->post('lease_occupant_parentage_'.$i),  
						'occupant_list_cnic'	  => $this->input->post('lease_occupant_cnic_'.$i),  
						'occupant_list_cell_no'	  => $this->input->post('lease_occupant_cell_'.$i),  
						'occupant_list_pic'		  => $this->upload_file('lease_occupant_pic_'.$i ,'lease_occupant_pic_'.$occupant_id.'_'.$i)
						);
					 $this->db->insert('tbl_occupant_list', $data);     
			   }
		  }
			
			
	}else if($this->input->post('occupation_type') == 'illegal_occupation'){
			  $data = array(
					'property_id'		=> $property_id,  
					'occupant_category' => $this->input->post('occupant_category'),    
					'occupation_year'	=> $this->input->post('occupation_year'),  
					'usage'		        => $this->input->post('occupant_usage'), 
					'franchise'		    => $this->input->post('franchise'), 
					'trade_name'		=> $this->input->post('trade_name'),  
					'buying_option'		=> $this->input->post('buying_option'),  
					'payment_mode'		=> $this->input->post('payment_mode'),  
					'remarks'		    => $this->input->post('occupant_remarks') 
					);
			$this->db->where('occupant_id',$this->input->post('p_occupant_id'));  
			$this->db->update('tbl_occupant', $data); 
			
			$occupant_id  = $this->input->post('p_occupant_id');
			
			 for($i=1; $this->input->post('i_occupant_counter') > $i; $i++ )
			 {
			  if($this->input->post('occupant_list_id_'.$i)) 
			  {
				   $data = array(
						'occupant_id'		      => $this->input->post('p_occupant_id'),  
						'occupant_list_name'	  => $this->input->post('illegal_occupant_name_'.$i),  
						'occupant_list_parentage' => $this->input->post('illegal_occupant_parentage_'.$i),  
						'occupant_list_cnic'	  => $this->input->post('illegal_occupant_cnic_'.$i),  
						'occupant_list_cell_no'	  => $this->input->post('illegal_occupant_cell_'.$i),
						'occupant_list_address'	  => $this->input->post('illegal_occupant_address_'.$i)
						);
				  if(strlen($_FILES['illegal_occupant_pic_'.$i]['name']))
				   {
					  $data['occupant_list_pic'] =  $this->upload_file('illegal_occupant_pic_'.$i ,'illegal_occupant_pic_'.$occupant_id.'_'.$i,true);
				   }
				   
					 $this->db->where('occupant_list_id',$this->input->post('occupant_list_id_'.$i));  
					 $this->db->update('tbl_occupant_list', $data); 
			   }
			   else
			   {
					 $data = array(
						'occupant_id'		      => $this->input->post('p_occupant_id'),  
						'occupant_list_name'	  => $this->input->post('illegal_occupant_name_'.$i),  
						'occupant_list_parentage' => $this->input->post('illegal_occupant_parentage_'.$i),  
						'occupant_list_cnic'	  => $this->input->post('illegal_occupant_cnic_'.$i),  
						'occupant_list_cell_no'	  => $this->input->post('illegal_occupant_cell_'.$i),  
						'occupant_list_address'	  => $this->input->post('illegal_occupant_address_'.$i), 
						'occupant_list_pic'		  => $this->upload_file('illegal_occupant_pic_'.$i ,'illegal_occupant_pic_'.$occupant_id.'_'.$i)
						);
					 $this->db->insert('tbl_occupant_list', $data);     
			   }
		  }
			
			
	}else if($this->input->post('occupation_type') == 'deptt_occupation'){
			$data = array(
					'property_id'		=> $property_id,  
					'deptt_domain'	   	=> $this->input->post('deptt_domain'),  
					'deptt_name'		=> $this->input->post('deptt_name'),  
					'deptt_status'	    => $this->input->post('deptt_status'),  
					'deptt_address'		=> $this->input->post('deptt_address'),  
					'deptt_contact_person' => $this->input->post('deptt_contact_person'),  
					'deptt_contact_no' => $this->input->post('deptt_contact_no'),  
					'occupation_year'  => $this->input->post('depp_occupation_year'),  
					'deptt_remarks'	   => $this->input->post('deptt_remarks') 
					);
			 $this->db->where('deptt_occupation_id',$this->input->post('deptt_occupation_id'));  
			$this->db->update('deptt_occupation', $data); 
		
		}

	}
	
//////////////////////////////// properties   //////////////////////////////////////////////		
	
	public function properties($own_short)
	{      
	     
		  $user_level_property = array();
	          $user_level_property =  $this->user_level_property( $this->session->userdata('user_id') );
		  
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

   if($own_short!='common'){
     $this->db->where('p.own_short',$own_short );
   }
   
   $this->db->select('p.property_id ,p.unique_property, p.market_rate,p.duty_rate ,p.area_kanal, p.area_marla, p.area_sqft,p.occupation_type , m.mauza_id, m.mouza_name');
			
			$this->db->from('tbl_property as p');
			$this->db->join('tbl_property_mauza as m', 'm.mauza_id = p.mauza_id','left');
			$query = $this->db->get();
            return $query->result();
	}

 //////////////////////////////// get ajax property list   //////////////////////////////////////////////			
 public function get_ajax_property_list()
	{
		
        if($this->input->post('type')== 'div')
		  {
			if($this->input->post('division_id')!=''){
			  $this->db->where('dis.division_id',$this->input->post('division_id') );
			}
			else
			{
			  $this->db->where('dis.division_id !=',0); 
			}
		  }
        else if($this->input->post('type')== 'dist')
		  {
			if($this->input->post('district_id')!=''){
			  $this->db->where('t.district_id',$this->input->post('district_id') );
			}
			else
			{
			  $this->db->where('t.district_id !=',0); 
			}
		  }
       else if($this->input->post('type')== 'sub')
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

		  
          $this->db->select('p.property_id ,p.unique_property, p.market_rate ,p.area_kanal, p.area_marla,p.duty_rate, p.area_sqft,p.occupation_type , m.mauza_id, m.mouza_name');
			
			$this->db->from('tbl_property as p');
			$this->db->join('tbl_property_mauza as m', 'm.mauza_id = p.mauza_id','left');
                        $this->db->join('tbl_property_tehsils as t','t.tehsil_id=m.tehsil_id','left');
                        $this->db->join('tbl_property_districts as dis','dis.district_id=t.district_id','left');
                        $this->db->join('tbl_property_divisions as d','d.division_id=dis.division_id','left');
			$query = $this->db->get();
            return $query->result();
		
	}	
 //////////////////////////////// get_occupant_by_property  //////////////////////////////////////////////		
	
  public function get_occupant_by_property($property_id,$occupation_type='')
  {
	  if($occupation_type == 'illegal_occupation' or $occupation_type == 'lease_occupation' )
	  {
		    $this->db->where('o.property_id',$property_id);	
			$this->db->select('o.*,ol.*');
            $this->db->from('tbl_occupant as o');
			$this->db->join('tbl_occupant_list as ol', 'ol.occupant_id = o.occupant_id','left');
			$query = $this->db->get();
	     	$occupant  =  $query->row();
			
			if ($query->num_rows() > 0)
			{
				$data = array(
						'occupant_name'	   =>  $occupant->occupant_list_name,
						'occupant_status'  =>  $occupant->status,
						'occupant_usage'   =>  $occupant->usage ,
						'occupant_contact' =>  $occupant->occupant_list_cell_no,
						'occupation_year'  =>  $occupant->occupation_year
						);
				return $data;
			}
			else
			{
				$data = array(
					'occupant_name'	  =>  '',
					'occupant_status' =>  '' ,
					'occupant_usage' =>   '' ,
					'occupant_contact' => '',
					'occupation_year'  =>  ''
					);
				return $data;
			}
	  }
	  else if($occupation_type == 'deptt_occupation')
	  {
			$this->db->where('property_id',$property_id);	
			$query = $this->db->get('deptt_occupation');
	     	$occupant =  $query->row();	
			$data = array(
					'occupant_name'	  =>  $occupant->deptt_name,
					'occupant_status' =>  $occupant->deptt_status ,
					'occupant_usage' => '' ,
					'occupant_contact' =>  $occupant->deptt_contact_no,
					'occupation_year'  =>  $occupant->occupation_year
					);
			return $data;			
	  }
	  
     else if($occupation_type == 'vacant_land')
	  {
			$data = array(
					'occupant_name'	  =>  'Vacant Land',
					'occupant_status' =>  'Unallotted' ,
					'occupant_usage' =>   'Vacant Land' ,
					'occupant_contact' => 'Vacant Land',
					'occupation_year'  =>  'Vacant Land'
					);
			return $data;			  
	  }
	  
  }
 //////////////////////////////// private occupant //////////////////////////////////////////////
 public function private_occupant_by_property_id($property_id)
  {
	        $this->db->where('property_id',$property_id);	
			$query = $this->db->get('tbl_occupant');
	     	return $query->row();
  }
  
 public function p_occupant_list_by_occupant_id($occupant_id)
  {
	        $this->db->where('occupant_id',$occupant_id);	
			$query = $this->db->get('tbl_occupant_list');
	     	return $query->result();
  }
  //////////////////////////////// deptt. occupant //////////////////////////////////////////////
 public function deptt_occupation_by_property_id($property_id)
  {
	        $this->db->where('property_id',$property_id);	
			$query = $this->db->get('deptt_occupation');
	     	return $query->row();
  }
	
 //////////////////////////////// properties_detail //////////////////////////////////////////////
 
  public function properties_detail($id)
  {
	 		$this->db->select('p.*, m.*,pc.*,q.*,t.*');
			$this->db->from('tbl_property as p');
			$this->db->join('tbl_property_mauza as m', 'm.mauza_id = p.mauza_id','left');
			$this->db->join('tbl_property_patwarcircle as pc', 'pc.p_id = m.p_id','left');
			$this->db->join('tbl_property_qgoi as q', 'q.q_id = m.q_id','left');
			$this->db->join('tbl_property_tehsils as t', 't.tehsil_id = m.tehsil_id','left');
			$this->db->where('p.property_id',$id);
			$query = $this->db->get();

		return $query->row(); 
  }
  
  //////////////////////////////// properties_detail_edit //////////////////////////////////////////////
 
  public function properties_detail_edit($id)
  {
	 		$this->db->select('p.*, m.*');
			$this->db->from('tbl_property as p');
			$this->db->join('tbl_property_mauza as m', 'm.mauza_id = p.mauza_id','left');
			$this->db->where('p.property_id',$id);
			$query = $this->db->get();
	     	return $query->row(); 
  }
  
 
	
//////////////////////////////// Delete//////////////////////////////////////////////	
	
	
	 public function delete($id) 
	 {
		$this->db->where('property_id',$id);
		$this->db->delete('tbl_property');
		

		    
		$this->db->where('property_id',$id);
        $query = $this->db->get('tbl_occupant');
        $occupant = $query->row();
		
		if ($query->num_rows() > 0)
		{
			$this->db->where('occupant_id',$occupant->occupant_id);
			$this->db->delete('tbl_occupant_list'); 			
		}
		
		$this->db->where('property_id',$id);
		$this->db->delete('tbl_occupant');
		
		$this->db->where('property_id',$id);
		$this->db->delete('deptt_occupation'); 	
	 }

////////////////////////////////  user_level_property //////////////////////////////////////////////	

private function user_level_property($user_id = 0)
   {
	    $this->db->where('user_id',$user_id);
        $query = $this->db->get('users');
        $user = $query->row();
		$group_id = $user->group_id;
		$data = array();
		
		      if($group_id == 1)  //    Admin
			   {
				   $data['tehsil']   = 0 ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;  
				 
			   }
			   else if($group_id == 2)     // District Group 
			   {
				   $data['tehsil']   = 0 ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;    
			   }
			   else if($group_id == 3)     // Tehsil Group
			   {
				   $data['tehsil']   = $user->access_level_id ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;   
			   }
			   else if($group_id == 4)      // Qanungoi Group
			   {
				   $this->db->where('q_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_qgoi');
				   $qanungoi = $query->row();  
				   
				   $data['tehsil']   = $qanungoi->tehsil_id ;  
				   $data['qanungoi'] = $user->access_level_id ;   
				   $data['patwar']   = 0 ;   
			   }
			   else if($group_id == 5)     // Patwari Group
			   {
				    $this->db->where('p_id',$user->access_level_id);
				   $query = $this->db->get('tbl_property_patwarcircle');
				   $patwarcircle = $query->row(); 
				   
				   $data['tehsil']   = $patwarcircle->tehsil_id ;  
				   $data['qanungoi'] = $patwarcircle->q_id ;  
				   $data['patwar']   = $user->access_level_id ;  
			   }
			   else if($group_id == '')    // if group is not selected 
			   {
				   $data['tehsil']   = 0 ;  
				   $data['qanungoi'] = 0 ;  
				   $data['patwar']   = 0 ;  
			   }
			   
	       	return $data ;
	   
   }

}

?>