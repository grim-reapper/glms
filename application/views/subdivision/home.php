<script type="text/javascript">

           
		   // search property by tehsil
		   
  function names_by_division(){
				var form_data = {
				division_id : $("#division").val(),
                                type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("subdivision/ajax_property_list"); ?>',
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
				url : '<?php echo site_url("subdivision/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
					
					
					
				 }
			});
    }

//alert();
$(function(){
    names_by_division();
})
    </script>        

            
              <div id="sub_bar">
                  <?php $this->load->view("subdivision/subdivision_js");?>
                        
   <select name="division_id" id="division" onchange="names_by_division();">
    <!-- <option value="">Select Division</option> -->
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
                    </div>
    <div class="table">
        	<div class="head"><h5 class="iFrames">Sub Division</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                echo anchor('subdivision/add','Add Sub Division',$attributes);
             ?>
    </div>
    <div id='d_list'>
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic" id='propertylist'>
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="56%">Sub Division</td>
                        <td width="20"> District</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($subdivision_list as $list){ ?>
                	<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td><?php echo $list->district_name?> </td>
                        <td>&nbsp;&nbsp;<?php echo anchor('subdivision/edit/'.$list->tehsil_id,'Edit'); ?>
                            <?php echo anchor('subdivision/delete/'.$list->tehsil_id,'| Delete'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<?php // echo anchor('subdivision/delete/'.$list->tehsil_id,'Delete'); ?></td>
                    </tr>
                <?php 
				$i++;
				} 
				?>	
                </tbody>
            </table>
        </div>
        </div>
 
    <div class="fix"></div>
        