<script type="text/javascript">
 
           
		   // search property by tehsil
  function property_by_division(){
				var form_data = {
				division_id : $("#division").val(),
                                type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("property/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#l_list").html(msg)
                                    get_district_circle();
                                    }
			});	
			}
  function property_by_district(){
				var form_data = {
				district_id : $("#district").val(),
				type : 'dist'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("property/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
                                          get_tehsil_circle();
                             }
			});
    }		   
  function property_by_tehsil(){
				var form_data = {
				tehsil_id : $("#tehsil").val(),
				type : 'sub'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("property/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
				    $("#l_list").html(msg)
					get_qanungoi_circle();

					}
			});	
    }
		   // search property by qanungoi
  function property_by_qanungoi(){
				var form_data = {
				q_id : $("#qanungoi").val(),
				type : 'qanungoi'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("property/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
					
					get_patwar_circle();
					
				 }
			});
    }
    // search property by patwar circle
  function property_by_patwar(){
				var form_data = {
				p_id : $("#patwar_circle").val(),
				type : 'patwar'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("property/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
					
					get_mauza();
				 }
			});
    }
  
  // search property by mauza 
  function property_by_mauza(){
				var form_data = {
				mauza_id : $("#mauza").val(),
				type     : 'mauza'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("property/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
				 }
			});
    }

</script>

<div id="sub_bar">
<?php $this->load->view("property/property_js");?>

<?php 	
   if($this->session->userdata('group_id') == 1 or  $this->session->userdata('group_id') == 2)
	 {
  ?>
  <select name="division_id" id="division" onchange="property_by_division();">
    <option value="">Select Division</option>
    <?php foreach($d_lists as $list) {?>
    <option value="<?php echo $list->division_id; ?>"><?php echo $list->division_name; ?></option>
    <?php } ?>
  </select>
  <select name="district_id" id="district" onchange="property_by_district();">
    <option value="">Select District</option>
    <?php foreach($dis_lists as $list) {?>
    <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
    <?php } ?>
  </select>
  <select name="tehsil_id" id="tehsil" onchange="property_by_tehsil();">
    <option value="">Select Sub Division</option>
    <?php foreach($subdivision_list as $sub_list) {?>
    <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
    <?php } ?>
  </select>
  <?php }else{ ?>
  <div class="bar_item"> <?php echo 'Sub Division: <span class="item_data">'.$subdivision_list->tehsil_name.'</span>' ; ?></div>
  <?php } ?>
  
<?php 	
   if($this->session->userdata('group_id') == 1 or  $this->session->userdata('group_id') == 2 or $this->session->userdata('group_id') == 3)
	 {
  ?>
  <select name="q_id" id="qanungoi"  onchange="property_by_qanungoi();" >
    <option value="">Select Qanungoi</option>
    <?php foreach($qanungoicircle_list as $qg_list) {?>
    <option value="<?php echo $qg_list->q_id; ?>"><?php echo $qg_list->q_circle; ?></option>
    <?php } ?>
  </select>
  
  <?php }else{ ?>
  <div class="bar_item"> <?php echo 'Qanungoi Circle :<span class="item_data">'.$qanungoicircle_list->q_circle.'</span>' ; ?></div>
  <?php } ?>
    
 <?php 	
   if($this->session->userdata('group_id') == 1 or  $this->session->userdata('group_id') == 2 or $this->session->userdata('group_id') == 3 or $this->session->userdata('group_id') == 4)
	 {
  ?> 
  <select name="p_id" id="patwar_circle" onchange="property_by_patwar();" >
    <option value="">Select Patwar</option>
    <?php foreach($patwarcircle_list as $pc_list) {?>
    <option value="<?php echo $pc_list->p_id; ?>"><?php echo $pc_list->patwar_circle; ?></option>
    <?php } ?>
  </select>
   <?php }else{ ?>
  <div class="bar_item"> <?php echo 'Patwar Circle:<span class="item_data">'.$patwarcircle_list->patwar_circle.'</span>' ; ?></div>
  <?php } ?>
   
  <select name="mauza_id" id="mauza" onchange="property_by_mauza();" >
    <option value="">Select  Mauza</option>
    <?php foreach($mauza_list as $m_list) {?>
    <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
    <?php } ?>
  </select>
  
</div>
<div class="table">
  <div class="head">
    <h5 class="iFrames">Government Land List</h5>
     <?php   if($this->mdl_users->get_permission('property_add')){ ?>
     <?php 
		  $attributes = array('class' => 'blueBtn header_button','style' => ' margin-right: 290px;' );
    	  echo anchor("property/new_property","Add New Property",$attributes); ?>
     <?php } ?>   
  </div>
  <div  id="l_list">
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
    <thead>
      <tr>
        <!-- <th>Property ID</th>-->
        <th>Property ID</th>
        <th>Occupied By</th>
        <th>Status</th>
        <th>Mauza</th>
        <th >K-M-SQFT</th>
        <th>Usage</th>
        <th>M.Value</th>
         <th>DC.Value</th>
        <th>Period</th>
        <th>Contact</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
	  $dc_value = 0;
	  $s_value 	= 0;
	  $t_marla  = 0;
	  $t_kanal  = 0;
	  $t_sqft   = 0;
	 foreach($property_list as $list)
	 {
	   $occ = $this->mdl_property->get_occupant_by_property($list->property_id,$list->occupation_type );

	  ?>
      <tr class="gradeA">
      
        <td><?php echo $list->unique_property ;?></td>
        <td><?php echo $occ['occupant_name'];?></td>
        <td>
		<?php 
		  if( $list->occupation_type=='illegal_occupation')
			{
				echo "Illegal Occupant";
			}
		   else if( $list->occupation_type=='lease_occupation')
			{
				echo "Lease Occupation";
			}
		  else if( $list->occupation_type=='deptt_occupation')
			{
				echo "deptt. Occupant";
			}
		  else if( $list->occupation_type=='vacant_land')
			{
				echo "Unoccupied Land";
			}
		?></td>
        <td><?php echo $list->mouza_name;?></td>
        <td style="text-align:right; padding-right:4px;">
         <?php  printf("%02d", $list->area_kanal); echo '-'; printf("%02d", $list->area_marla); echo '-'; printf("%03d", $list->area_sqft); ?> 
         <?php 
		      $t_kanal  += $list->area_kanal;
		      $t_marla  += $list->area_marla;
		      $t_sqft   += $list->area_sqft;
		 ?>
         </td>
        <td><?php echo $occ['occupant_usage'];?></td>
        
        <td style="text-align:right; padding-right:4px;">
		  <?php echo round((($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->market_rate ,0);?>
           
           <?php $s_value += (($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->market_rate ;?>
        </td>
        <td style="text-align:right; padding-right:4px;">
         <?php echo round((($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->duty_rate ,0);?>
         <?php  $dc_value +=(($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->duty_rate ; ?>
         </td>
        <td style="text-align:center; "><?php 
       if($list->occupation_type!="Vacant Land")
		{       
			if($occ['occupation_year']==0)
			{
				echo "Required";
			}
			else
			{
			   echo  date('Y',time())- $occ['occupation_year'];
			}
		}
		else
		{
			echo "Vacant Land";
		}

		?></td>
        
        <td><?php echo $occ['occupant_contact'];?></td>
        
        <td width="8"  align="center">
 <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->property_id?>" onclick="list_action(<?php echo $list->property_id ?>);"   />
        
        <ul id="list_action" class="list_action_<?php echo $list->property_id; ?>"   >
                        
                 	<?php
						 if($this->mdl_users->get_permission('property_view')){
							echo ' <li>';
						    echo anchor('property/property_detail/'.$list->property_id,'View');
							echo ' </li>';
						 }
		                if($this->mdl_users->get_permission('property_edit')){
							echo ' <li>';
						    echo anchor('property/edit_property/'.$list->property_id,'Edit');
							echo ' </li>';
						 } 
			        	if($this->mdl_users->get_permission('property_delete')){
							echo ' <li>';
						    echo  anchor('property/delete_property/'.$list->property_id,'Delete');
							echo ' </li>';
						 }
						 ?>
              </ul>
        </td>
      </tr>
      <?php } ?>
      
    </tbody>
   <tfoot> 
       <tr>
          <td colspan="3" align="center"><strong>Total Area(K-M-SQFT)</strong> </td>
          <td colspan="4" align="center"><strong>Total Market Value</strong> </td>
          <td colspan="5" align="center"><strong>Total DC.Value</strong> </td>
      </tr>
       <tr>
          <?php 
		   $sq	   = $t_sqft%225;
		   $mr 	   = $t_sqft / 225;
		   $m      = $t_marla + (int)$mr ;
		   $marla  = $m % 20 ;
		   $k      = $m / 20 ;
		   $t_kanal +=  (int)$k ;
		  ?>    
          <td colspan="3" align="center"><strong> 
		   <?php printf("%02d", $t_kanal); echo '-'; printf("%02d", $marla); echo '-'; printf("%03d", $sq); ?>
          </strong> </td>
          <td colspan="4" align="center"><strong> <?php echo  number_format ($s_value);?></strong> </td>
          <td colspan="5" align="center"><strong> <?php echo  number_format ($dc_value);?></strong> </td>
      </tr>
    </tfoot>
  </table>
  </div>
</div>
</div>
<div class="fix"></div>
