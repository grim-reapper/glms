<script type="text/javascript" charset="utf-8">
 $(function() {
   $("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			
		});
   
  });
</script>
<style type="text/css">
.pp_social{ display:none;}
</style>

<div class="widget ">
  <!-- OCCUPANT PROFILE begin -->
 <?php if($property->occupation_type =='private_occupation') {?> 
  <div class="head " >
    <h5>Private Occupant</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('property','Close',$attributes);
       ?>
  </div>
  </div>
  <div class="body">
     <div class="rowElem Odd">
   <?php 
	  if(count($p_occupant_list)>0){
	  $i=1;
	  ?>
        <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
         <thead>
        <tr>
        <th >Name</th>
        <th>Parentage</th>
        <th >CNIC</th>
        <th >Cell No.</th>
        <th >Picture</th>
        </tr>
       </thead>
       <tbody>
      <?php 
	  foreach($p_occupant_list as $o_list)
	  {?>    
     
    
         <tr style="text-align: center;">
        
          
          <td><?php echo $o_list->occupant_list_name;?> </td>
          
          <td><?php echo $o_list->occupant_list_parentage;?></td>
          
          <td><?php echo $o_list->occupant_list_cnic;?></td>
          
          <td><?php echo $o_list->occupant_list_cell_no;?></td>
          <td> <a  rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$o_list->occupant_list_pic; ?>">View</a></td>
        </tr>
    
         <?php  $i++;  }?>
         </tbody>
	    </table>
	  <?php }?>
    <div class="rowElem Odd">
      <h3>Details</h3>
    </div>
  
    <div class="rowElem Odd">
      <div class="label">Occupant Category: </div>
      <div class="cotent"> <?php echo $private_occupant->occupant_category; ?> </div>
      <div class="label"> Status of Occupant:</div>
      <div class="cotent"> <?php echo $private_occupant->status; ?> </div>
    </div>
    <div class="rowElem">
      <div class="label"> Leasing Authority: </div>
      <div class="cotent"> <?php echo $private_occupant->leasing_authority; ?> </div>
      <div class="label"> Occupation Year: </div>
      <div class="cotent"> <?php echo  $private_occupant->occupation_year;?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Usage:</div>
      <div class="cotent"> <?php echo $private_occupant->usage; ?> </div>
      <div class="label">Franchise: </div>
      <div class="cotent"> <?php echo $private_occupant->franchise; ?> </div>
    </div>
    <div class="rowElem ">
      <div class="label">Trade Name: </div>
      <div class="cotent"> <?php echo $private_occupant->trade_name;?> </div>
      <div class="label">Buying Option:</div>
      <div class="cotent"> <?php if($private_occupant->buying_option==1){echo "Yes";}else{ echo "No";}?> </div>
    </div>
     <div class="rowElem ">
      <div class="label">Mode of Payment:</div>
      <div class="cotent"> <?php echo $private_occupant->payment_mode;?> </div>
      <div class="label">Remarks:</div>
      <div class="cotent"> <?php echo $private_occupant->remarks; ?> </div>
    </div>
    
  </div>
  <div class="fix"></div>
  <!-- OCCUPANT PROFILE END-->
  
   <!-- Lease_occupation PROFILE begin -->
 <?php }else if($property->occupation_type =='lease_occupation') {?> 
  <div class="head " >
    <h5>Lease Occupant</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('property','Close',$attributes);
       ?>
  </div>
  <div class="body">
     <div class="rowElem Odd">
   <?php 
	  if(count($p_occupant_list)>0){
	  $i=1;
	  ?>
        <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
         <thead>
        <tr>
        <th >Name</th>
        <th>Parentage</th>
        <th >CNIC</th>
        <th >Cell No.</th>
        <th >Picture</th>
        </tr>
       </thead>
       <tbody>
      <?php 
	  foreach($p_occupant_list as $o_list)
	  {?>    
     
    
         <tr style="text-align: center;">
        
          
          <td><?php echo $o_list->occupant_list_name;?> </td>
          
          <td><?php echo $o_list->occupant_list_parentage;?></td>
          
          <td><?php echo $o_list->occupant_list_cnic;?></td>
          
          <td><?php echo $o_list->occupant_list_cell_no;?></td>
          <td> <a  rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$o_list->occupant_list_pic; ?>">View</a></td>
        </tr>
    
         <?php  $i++;  }?>
         </tbody>
	    </table>
	  <?php }?>
    <div class="rowElem Odd">
      <h3>Details</h3>
    </div>
  
    <div class="rowElem Odd">
      <div class="label">Occupant Category: </div>
      <div class="cotent"> <?php echo $private_occupant->occupant_category; ?> </div>
      <div class="label"> Status of Occupant:</div>
      <div class="cotent"> <?php echo $private_occupant->status; ?> </div>
    </div>
    <div class="rowElem">
      <div class="label"> Leasing Authority: </div>
      <div class="cotent"> <?php echo $private_occupant->leasing_authority; ?> </div>
      <div class="label"> Occupation Year: </div>
      <div class="cotent"> <?php echo  $private_occupant->occupation_year;?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Usage:</div>
      <div class="cotent"> <?php echo $private_occupant->usage; ?> </div>
      <div class="label">Franchise: </div>
      <div class="cotent"> <?php echo $private_occupant->franchise; ?> </div>
    </div>
    <div class="rowElem ">
      <div class="label">Trade Name: </div>
      <div class="cotent"> <?php echo $private_occupant->trade_name;?> </div>
      <div class="label">Buying Option:</div>
      <div class="cotent"> <?php if($private_occupant->buying_option==1){echo "Yes";}else{ echo "No";}?> </div>
    </div>
     <div class="rowElem ">
      <div class="label">Mode of Payment:</div>
      <div class="cotent"> <?php echo $private_occupant->payment_mode;?> </div>
      <div class="label">Remarks:</div>
      <div class="cotent"> <?php echo $private_occupant->remarks; ?> </div>
    </div>
    
  </div>
  <div class="fix"></div>
  <!-- OCCUPANT PROFILE END-->
  
  
   <!-- Illegal occupation   PROFILE begin -->
 <?php } else if($property->occupation_type =='illegal_occupation') {?> 
  <div class="head " >
    <h5>Illegal Occupant</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('property','Close',$attributes);
       ?>
  </div>
  <div class="body">
     <div class="rowElem Odd">
   <?php 
	  if(count($p_occupant_list)>0){
	  $i=1;
	  ?>
        <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
         <thead>
        <tr>
        <th >Name</th>
        <th>Parentage</th>
        <th >CNIC</th>
        <th >Cell No.</th>
        <th >Picture</th>
        </tr>
       </thead>
       <tbody>
      <?php 
	  foreach($p_occupant_list as $o_list)
	  {?>    
     
    
         <tr style="text-align: center;">
        
          
          <td><?php echo $o_list->occupant_list_name;?> </td>
          
          <td><?php echo $o_list->occupant_list_parentage;?></td>
          
          <td><?php echo $o_list->occupant_list_cnic;?></td>
          
          <td><?php echo $o_list->occupant_list_cell_no;?></td>
          <td> <a  rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$o_list->occupant_list_pic; ?>">View</a></td>
        </tr>
    
         <?php  $i++;  }?>
         </tbody>
	    </table>
	  <?php }?>
    <div class="rowElem Odd">
      <h3>Details</h3>
    </div>
  
    <div class="rowElem Odd">
      <div class="label">Occupant Category: </div>
      <div class="cotent"> <?php echo $private_occupant->occupant_category; ?> </div>
      <div class="label"> Status of Occupant:</div>
      <div class="cotent"> <?php echo $private_occupant->status; ?> </div>
    </div>
    <div class="rowElem">
      <div class="label"> Leasing Authority: </div>
      <div class="cotent"> <?php echo $private_occupant->leasing_authority; ?> </div>
      <div class="label"> Occupation Year: </div>
      <div class="cotent"> <?php echo  $private_occupant->occupation_year;?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Usage:</div>
      <div class="cotent"> <?php echo $private_occupant->usage; ?> </div>
      <div class="label">Franchise: </div>
      <div class="cotent"> <?php echo $private_occupant->franchise; ?> </div>
    </div>
    <div class="rowElem ">
      <div class="label">Trade Name: </div>
      <div class="cotent"> <?php echo $private_occupant->trade_name;?> </div>
      <div class="label">Buying Option:</div>
      <div class="cotent"> <?php if($private_occupant->buying_option==1){echo "Yes";}else{ echo "No";}?> </div>
    </div>
     <div class="rowElem ">
      <div class="label">Mode of Payment:</div>
      <div class="cotent"> <?php echo $private_occupant->payment_mode;?> </div>
      <div class="label">Remarks:</div>
      <div class="cotent"> <?php echo $private_occupant->remarks; ?> </div>
    </div>
    
  </div>
  <div class="fix"></div>
  <!-- OCCUPANT PROFILE END-->
  <?php
  }
   else if($property->occupation_type =='deptt_occupation')
  {
  ?>
   <div class="head">
    <h5>Deptt. Occupation</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('property','Close',$attributes);
       ?>
   </div>
  <div class="body">
    <div class="rowElem noborder">
      <div class="label"> Domain: </div>
      <div class="cotent"><?php echo $deptt_occupation->deptt_domain; ?> </div>
      <div class="label"> Name of Deptt: </div>
      <div class="cotent"> <?php echo $deptt_occupation->deptt_name; ?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Status of Occupation: </div>
      <div class="cotent"> <?php echo $deptt_occupation->deptt_status ; ?> </div>
      <div class="label"> Address: </div>
      <div class="cotent"> <?php echo $deptt_occupation->deptt_address; ?> </div>
    </div>
    <div class="rowElem">
      <div class="label"> Name of Contact Person: </div>
      <div class="cotent"> <?php echo $deptt_occupation->deptt_contact_person ; ?> </div>
      <div class="label">Contact No: </div>
      <div class="cotent"> <?php echo $deptt_occupation->deptt_contact_no; ?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Occupation Year: </div>
      <div class="cotent"> <?php echo $deptt_occupation->occupation_year; ?> </div>
      <div class="label">Remarks: </div>
      <div class="cotent"> <?php echo $deptt_occupation->deptt_remarks; ?> </div>
    </div>
  </div>
  <div class="fix"></div>
  <!-- Deptt. Occupation PROFILE END-->
  <?php } ?>
  
  <!-- PROPERTY PROFILEE begin -->
  <div class="head " >
    <h5>PROPERTY PROFILE</h5>
        <div id="profile_options">
        <?php if($property->shajra_picture=='shajra_picture_'){ ?>
        <a class="disable_link"  href="#" > Aks Shajra </a>
        <?php }else{?>
        <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$property->shajra_picture; ?>" > Aks Shajra </a>
        <?php } ?>
        <?php if($property->site_picture=="site_picture_"){ ?>
        <a class="disable_link" href="#"> Site View</a>
        <?php }else {?>
         <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$property->site_picture; ?>"> Site View</a>
        <?php } ?>
        
        <?php 
		if( $property->latitude !='' and $property->longitude !='' )
		{
		$atts = array(
              'width'      => '900',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '20',
              'screeny'    => '20'
            );
           echo anchor_popup('map/property_map_marker/'.$property->property_id, 'Google Map', $atts);
		}else{
		?>
       <a class="disable_link"  href="#">Google Map</a> 
       <?php } ?>
        
        <?php if($property->history=='history_'){ ?>
          <a class="disable_link"  href="#"> View History</a> 
       <?php } else {?>
       <a  href="<?php echo base_url().'uploads/'.$property->history ; ?>" target="_blank"> View History</a> 
       <?php }?>
       
     </div>
  </div>
  <div class="body">
   
    <div class="rowElem noborder">
      <div class="label"> Ownership: </div>
      <div class="cotent"><?php echo $property->ownership; ?> </div>
      <div class="label"> Nature: </div>
      <div class="cotent"><?php echo $property->nature; ?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Disposal Status: </div>
      <div class="cotent"> <?php echo $property->disposable; ?> </div>
      <div class="label"> Locality: </div>
      <div class="cotent"> <?php echo $property->locality; ?> </div>
    </div>
    <div class="rowElem ">
      <div class="label"> Mauza: </div>
      <div class="cotent"> <?php echo $property->mouza_name; ?> </div>
      <div class="label"> Patwar Circle: </div>
      <div class="cotent"> <?php echo $property->patwar_circle; ?> </div>
    </div>
     <div class="rowElem ">    
     <div class="label"> Qanungoi Circle: </div>
      <div class="cotent"> <?php echo $property->q_circle; ?> </div>
      <div class="label"> Sub Division</div>

      <div class="cotent"> <?php echo $property->tehsil_name; ?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Khasra No:</div>
      <div class="cotent"> <?php echo $property->khasra_nos; ?> </div>
      <div class="label">Unique Khasra No: </div>
      <div class="cotent"><?php echo $property->unique_khasra; ?>  </div>
    </div>
    <div class="rowElem">
      <div class="label"> Area(Kanal-Marla-Sqft):</div>
      <div class="cotent"> 
       <?php $property_str = $property->area_kanal.'-'.$property->area_marla.'-'.$property->area_sqft; ?>
      <?php echo $property_str; ?> 
      </div>
      <div class="label">Land Reservation:</div>
      <div class="cotent"> <?php echo $property->land_reservation; ?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label"> Reservation Name:</div>
      <div class="cotent"> <?php echo $property->reservation_name; ?> </div>
      <div class="label">Duty Rate Per Marla:</div>
      <div class="cotent"> <?php echo $property->duty_rate ; ?> </div>
    </div>
    <div class="rowElem">
      <div class="label">Market Rate Per Marla:</div>
      <div class="cotent">
       <?php echo $property->market_rate; ?> 
      </div>
      <div class="label"> Annual Rent Per Marla:</div>
      <div class="cotent">
      <?php echo $property->annual_rent; ?> 
      </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Police Station: </div>
      <div class="cotent">
        <?php echo $property->police_station; ?> 
      </div>
      <div class="label"> Union Council No:  </div>
      <div class="cotent"> <?php echo $property->uc_no; ?> </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Punjab Provincial No:</div>
      <div class="cotent"> <?php echo $property->pp_no; ?> </div>
      <div class="label">National Assembly No:</div>
      <div class="cotent"><?php echo $property->na_no; ?>  </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Electricity: </div>
      <div class="cotent">   <?php if($property->electric_meter == 1) { echo "Yes"; }else { echo "No" ; }?>  </div>
      <div class="label">Sui Gas:</div>
      <div class="cotent"> <?php if($property->sui_gas == 1) { echo "Yes"; }else { echo "No" ; }?></div>
    </div>
   <div class="rowElem Odd">
      <div class="label">Water Supply:</div>
      <div class="cotent"> <?php if($property->water_supply == 1) { echo "Yes"; }else { echo "No" ;}?>  </div>
      <div class="label">Remarks: </div>
      <div class="cotent"> <?php echo $property->remarks; ?> </div>
   </div>
      
  </div>
  <div class="fix"></div>
  <!-- PROPERTY PROFILE END-->
  <!-- ACTION PROFILE begin -->
  <div class="head opened" id="toggleOpened">
    <h5>ACTION PROFILE</h5>
  </div>
  <div class="body">
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
      <thead>
        <tr>
          <td >Action Status</td>
          <td>Abated Initiated</td>
          <td >Order</td>
          <td >Pend Print</td>
          <td >Ejetment</td>
          <td >In Process Executed</td>
          <td >Retension</td>
          <td >Divised Not Devised </td>
          <td >Note</td>
        </tr>
      </thead>
      <tbody>
        <tr>
           <td>----</td>
           <td>----</td>
           <td>----</td>
           <td>----</td>
           <td>----</td>
           <td>----</td>
           <td>----</td>
          <td>----</td>
          <td align="center">----</td>

        </tr>
       
      </tbody>
    </table>
  </div>
</div>
<!-- ACTION PROFILE END-->
<div class="fix"></div>
