<script type="text/javascript">
 
           
		   // search litigation by tehsil
		   
  function litigation_by_tehsil(){
				var form_data = {
				tehsil_id : $("#tehsil").val(),
				type : 'sub'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("litigation/litigation_ajax"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
					
					get_qanungoi_circle();

					}
			});	
    }
		   // search litigation by qanungoi
  function litigation_by_qanungoi(){
				var form_data = {
				q_id : $("#qanungoi").val(),
				type : 'qanungoi'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("litigation/litigation_ajax"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
					
					get_patwar_circle();
					
				 }
			});
    }
    // search litigation by patwar circle
  function litigation_by_patwar(){
				var form_data = {
				p_id : $("#patwar_circle").val(),
				type : 'patwar'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("litigation/litigation_ajax"); ?>',
				data: form_data,
				success : function(msg){
					 $("#l_list").html(msg)
					
					get_mauza();
				 }
			});
    }
  
  // search litigation by mauza 
  function litigation_by_mauza(){
				var form_data = {
				mauza_id : $("#mauza").val(),
				type     : 'mauza'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("litigation/litigation_ajax"); ?>',
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
 <!-- get_qanungoi_circle();-->
  <select name="tehsil_id" id="tehsil" onchange="litigation_by_tehsil();">
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
  <select name="q_id" id="qanungoi"  onchange="litigation_by_qanungoi();" >
    <option value="">Select Qanungoi Circle</option>
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
  <select name="p_id" id="patwar_circle" onchange="litigation_by_patwar();" >
    <option value="">Select Patwar Circle</option>
    <?php foreach($patwarcircle_list as $pc_list) {?>
    <option value="<?php echo $pc_list->p_id; ?>"><?php echo $pc_list->patwar_circle; ?></option>
    <?php } ?>
  </select>
   <?php }else{ ?>
  <div class="bar_item"> <?php echo 'Patwar Circle:<span class="item_data">'.$patwarcircle_list->patwar_circle.'</span>' ; ?></div>
  <?php } ?>
   
  <select name="mauza_id" id="mauza" onchange="litigation_by_mauza();" >
    <option value="">Select  Mauza</option>
    <?php foreach($mauza_list as $m_list) {?>
    <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
    <?php } ?>
  </select>
  
</div>

<?php
	if($litigation_category_id !=0)
	{
	  $c = $litigation_category->category_name;
	}
	else
	{
	  $c = 'Common List';
	}
?>
<div class="table">
  <div class="head">
  
      <h5 class="iFrames">Litigation Management (<?php echo $c ?>)</h5>
          	 <?php
			 if($this->mdl_users->get_permission('litigation_add') && $litigation_category_id !=0){
				 $c = substr($c,0,(strlen($c) - 1) );
                $attributes = array('class' => 'blueBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('litigation/add/'.$litigation_category_id,'Add New '.$c,$attributes);
			 }
				$this->load->model('mdl_litigation');
             ?>
  </div> 

     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td>Case No.</td>
                        <td >Court Name</td>
                        <td >Suing Party</td>
                        <td >Property Title</td>
                        <td >Area (K-M-S)</td>
                        <td >Mauza</td>
                        <td >Conducting Official</td>
                        <td >Contact No.</td>
                        <td >Next Date</td>
                        <td >Action</td>
                    </tr>
                </thead>
                <tbody id="l_list">
                
                <?php foreach($litigation_list as $list){ ?>
                <?php
				
				if( $this->mdl_litigation->next_date_by_litigation($list->litigation_id)< date("Y-m-d",time()))
				{
					$style='color:red;';
				}
				else
				{
					$style='';
			    }
				?>
                	<tr class="gradeA" >
                        <td><?php echo $list->case_number; ?></td>
                         <td><?php  echo str_replace('Cases','',$list->category_name); ?></td>
                        <td>
						<?php echo $this->mdl_litigation->suing_party_name_by_litigation($list->litigation_id); ?>
                        </td> 
                        <td><?php echo $list->property_title; ?></td>
                        <td align="right" width="90">
                            <div class='kanal'> <?php echo $list->area_kanal; ?></div> 
                            <div class='kanal'> <?php echo $list->area_marla; ?> </div> 
                            <div class='sqft'><?php echo $list->area_sqft; ?></div>
                        </td>
                        
                        <td><?php echo $list->mouza_name; ?></td>
                        <td><?php echo $list->official_concerned; ?></td>
                        <td><?php echo $list->contact_number; ?></td>
                        <td  style=" <?php echo $style;?> ">
						<?php
						    if( $this->mdl_litigation->next_date_by_litigation($list->litigation_id)!='1970-01-01' ){
							$datestring = "%d - %m - %y";
						    $time = strtotime($this->mdl_litigation->next_date_by_litigation($list->litigation_id));
							echo mdate($datestring, $time);
							}else
							{
							 echo "Not Fixed"; 	
							}
						 ?>
                       </td>
                        <td align="center">
<img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->litigation_id?>" onclick="list_action(<?php echo $list->litigation_id?>);"   />
                        <ul id="list_action" class="list_action_<?php echo $list->litigation_id; ?>"   >
                        
						<?php
						 if($this->mdl_users->get_permission('litigation_view')){
							echo ' <li>';
					    	echo anchor('litigation/view_detail/'.$list->litigation_id,'View');
							echo ' </li>';
						 }
						  if($this->mdl_users->get_permission('litigation_update')){
                          echo ' <li>';
                          echo anchor('litigation/action/'.$list->litigation_id,'Update');
						  echo ' </li>';
	                     }
						if($this->mdl_users->get_permission('litigation_edit')){
							echo ' <li>';
					    	echo anchor('litigation/edit/'.$list->litigation_id,'Edit');
							echo ' </li>';
						 }
						
						if($this->mdl_users->get_permission('litigation_delete')){
							echo ' <li>';
					    	echo anchor('litigation/delete_litigation/'.$list->litigation_id,'Delete');
							echo ' </li>';
						 }
						?>
                       </ul>
                        </td>
                    </tr>
                <?php 
				
				 } 
				?>	
                </tbody>
            </table>

           </div>
        </div>
        
        
  