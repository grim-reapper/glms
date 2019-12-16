<script type="text/javascript">

           
		   // search property by tehsil
		   
  function names_by_division(){
				var form_data = {
				division_id : $("#division").val(),
                                type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("qanungoicircle/qanungoi_circle_ajax_list"); ?>',
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
				url : '<?php echo site_url("qanungoicircle/qanungoi_circle_ajax_list"); ?>',
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
				url : '<?php echo site_url("qanungoicircle/qanungoi_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
					
					
					
				 }
			});
    }

//alert();

    </script>        

<div id="sub_bar">
             <?php $this->load->view("qanungoicircle/qanungoicircle_js");?>
                        
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
    
             
                    </div>
<div id="d_list">
<div class="table">
  <div class="head">
    <h5 class="iFrames">Qanungoi Circle List</h5>
          	 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('qanungoicircle/add','Add Qanungoi Circle',$attributes);
             ?>
  </div> 
     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="38%">Qanungoi Circle</td>
                        <td width="38%">Sub Division</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($q_list as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->q_circle; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('qanungoicircle/edit/'.$list->q_id,'Edit'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<?php // echo anchor('subdivision/delete/'.$list->tehsil_id,'Delete'); ?>
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
        </div>
        
        
  