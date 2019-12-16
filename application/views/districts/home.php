       
<script type="text/javascript">

           
		   // search property by tehsil
		   
  function property_by_division(){
				var form_data = {
				division_id : $("#division").val()
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("districts/ajax_property_list"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#l_list").html(msg);
                                        }
			});	
			}	
$(function(){
                property_by_division();
            });
//alert();

    </script>

<div class="widget first_form">
             <div id="sub_bar">
                        
   <select name="division_id" id="division" onchange="property_by_division();">
    <!-- <option value="">Select Division</option> -->
    <?php foreach($d_lists as $list) {?>
    <option value="<?php echo $list->division_id; ?>"><?php echo $list->division_name; ?></option>
    <?php } ?>
  </select>
                    </div>
        	<div class="head"><h5 class="iFrames">Districts</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                echo anchor('districts/add','Add Districts',$attributes);
             ?>
                   
    </div >
    <div id="l_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic" id="propertylist">
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="36%">Districts</td>
                        <td width="10%">Districts Code</td>
                        <td width="360">Divisions</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($lists as $list){ ?>
                	<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->district_name; ?></td>
                        <td><?php echo $list->district_code; ?></td>
                        <td><?php echo $list->division_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('districts/edit/'.$list->district_id,'Edit'); ?>
                            <?php echo anchor('districts/delete/'.$list->district_id,'|Delete'); ?>
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
        