<script type="text/javascript">

           
		   // search property by tehsil
		   
  function names_by_division(){
				var form_data = {
				division_id : $("#division").val(),
                                type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("patwarcircle/patwar_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#d_list").html(msg)
                                    get_district_circle();
                                        }
			});	
			}
  function names_by_district(){
				var form_data = {
				district_id : $("#district").val(),
				type : 'dist'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("patwarcircle/patwar_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
                                          get_tehsil_circle();
					
					
					
				 }
			});
    }
  function names_by_subdivision(){
				var form_data = {
				tehsil_id : $("#subdivision").val(),
				type : 'subdiv'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("patwarcircle/patwar_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
                                         get_qgoicircle_circle();
				
				 }
			});
    }
  function names_by_qgoicircle(){
                                //alert($("#qcircle").val());
				var form_data = {
				q_id : $("#qcircle").val(),
				type : 'qgcircle'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("patwarcircle/patwar_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
					
				 }
                                
			});
    }

//alert();

    </script>     

<div id="sub_bar">
     <?php $this->load->view("patwarcircle/patwarcircle_js");?>
            
                        
    <select name="division_id" id="division" onchange="names_by_division();">
    <option value="">Select Division</option>
    <?php foreach($d_lists as $list) {?>
    <option value="<?php echo $list->division_id; ?>"><?php echo $list->division_name; ?></option>
    <?php } ?>
    </select>
    <select name="district_id" id="district" onchange="names_by_district();">
    <option value="">Select District</option>
    <?php foreach($dis_lists as $list) {?>
    <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
    <?php } ?>
    </select>
    <select name="tehsil_id" id="subdivision" onchange="names_by_subdivision();">
    <option value="">Select Tehsil</option>
    <?php foreach($subdiv_list as $list) {?>
    <option value="<?php echo $list->tehsil_id; ?>"><?php echo $list->tehsil_name; ?></option>
    <?php } ?>
    </select>
    <select name="q_id" id="qcircle" onchange="names_by_qgoicircle();">
    <option value="">Select Qanungoicircle</option>
    <?php foreach($q_list as $list) {?>
    <option value="<?php echo $list->q_id; ?>"><?php echo $list->q_circle; ?></option>
    <?php } ?>
    </select>
             
                    </div>

<div class="table">
  <div class="head">
    <h5 class="iFrames">Patwar Circle</h5>
          	 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('patwarcircle/add','Add Patwar Circle',$attributes);
             ?>
  </div> 
    <div id="d_list">
     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="5%">Sr. No.</td>
                        <td width="30%">Patwar Circle</td>
                        <td width="30%">Qanungoi Circle</td>
                        <td width="30%">Sub Division</td>
                        <td width="5%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($patwarcircle_list as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $i; ?></td>
                         <td><?php echo $list->patwar_circle; ?></td>
                        <td><?php echo $list->q_circle; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('patwarcircle/edit/'.$list->p_id,'Edit'); ?>
                        </td>
                    </tr>
                <?php 
				$i++;
				 } 
				?>	
                </tbody>
            </table>
           </div>
          </div>
      
      
        
  