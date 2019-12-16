<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Map extends CI_Controller { 
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
	 
	 $this->load->model("mdl_map");
	 
  }

 public function set_map_marker($property_id=0)
 {
    
	$pos = $this->mdl_map->get_property_position($property_id);
	$data['pos'] = $pos;
	
	if( $pos->latitude !='' && $pos->longitude !='' )
	{
	$this->load->library('googlemaps');
	$config['center']      =  $pos->latitude.",".$pos->longitude;
	$config['zoom']        = '17';
	$config['map_height']  = '95%';
	$config['map_type'] = 'ROADMAP';
	$this->googlemaps->initialize($config);
	
	
	$marker = array();
	$marker['position'] =  $pos->latitude.",".$pos->longitude;
	if($pos->locality !='')
	{
	  $marker['infowindow_content'] = $pos->locality;
	}
	$marker['draggable'] = TRUE;
	$marker['animation'] = 'DROP';
	
	$ondragend  = 'var pos = marker_0.getPosition();';
	$ondragend .= ' document.getElementById("lat").value = pos.lat();'; 
	$ondragend .= 'document.getElementById("lng").value = pos.lng();'; 
	
	$marker['ondragend'] = $ondragend ;
	$this->googlemaps->add_marker($marker);

	}
	else 
	{
	$this->load->library('googlemaps');

	  $config['center']      = 'lahore, pakistan';	
	  $config['zoom']        = '12';
	  $config['map_height']  = '95%';
	  $config['map_type'] = 'ROADMAP';
	  $this->googlemaps->initialize($config);
	
	
	$marker = array();

	$marker['position'] = '31.544724055695074, 74.33785173234946';
	$marker['draggable'] = TRUE;
	$marker['animation'] = 'DROP';
	
	$ondragend  = 'var pos = marker_0.getPosition();';
	$ondragend .= ' document.getElementById("lat").value = pos.lat();'; 
	$ondragend .= 'document.getElementById("lng").value = pos.lng();'; 
	
	$marker['ondragend'] = $ondragend ;
	$this->googlemaps->add_marker($marker);
	
    }
           
	$data['map']         = $this->googlemaps->create_map();
	$data['property_id'] = $property_id;
	$this->load->view('map/map', $data);
 
 }
 
public function update_map_marker()
{
   if($this->mdl_map->update_map_marker())
   {
       echo "The Map location has been saved successfully!";
   }
   else
   {
	   echo "Please select the Location first!";
	
   }
}


public function property_map_marker($property_id=0)
 {
    
	$pos = $this->mdl_map->get_property_position($property_id);
	
	$this->load->library('googlemaps');
	$config['center']      =  $pos->latitude.",".$pos->longitude;
	$config['zoom']        = '18';
	$config['map_height']  = '100%';
	$config['map_type'] = 'ROADMAP';
	$this->googlemaps->initialize($config);
	
	
	$marker = array();
	
   if($pos->locality !='')
	{
	  $marker['infowindow_content'] = $pos->locality;
	}
	$marker['position'] =  $pos->latitude.",".$pos->longitude;
	$marker['draggable'] = FALSE;
	$this->googlemaps->add_marker($marker);


	$data['map'] = $this->googlemaps->create_map();
	$this->load->view('map/property_map', $data);
 
 }

public function new_property_map()
 {
    
    $this->load->library('googlemaps');

    $config['center']      = 'lahore, pakistan';	
	$config['zoom']        = '12';
	$config['map_height']  = '95%';
	$config['map_type'] = 'ROADMAP';
	$this->googlemaps->initialize($config);
	
	
	$marker = array();

	$marker['position'] = '31.544724055695074, 74.33785173234946';
	$marker['draggable'] = TRUE;
	$marker['animation'] = 'DROP';
	
	$ondragend  = 'var pos = marker_0.getPosition();';
	$ondragend .= ' document.getElementById("lat").value = pos.lat();'; 
	$ondragend .= 'document.getElementById("lng").value = pos.lng();'; 
	
	$marker['ondragend'] = $ondragend ;
	$this->googlemaps->add_marker($marker);
	

	$data['map']         = $this->googlemaps->create_map();
	$this->load->view('map/new_property_map', $data);
 
 
 }

}