<script>
    function names_by_district(){
				var form_data = {
				district_id : $("#district").val()
                               
                              //  type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("filescatalog/view_by_district"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#file_list").html(msg);
                                    names_by_mauza_circle();
                                    names_by_district_circle();
                                    names_by_cat_circle();
                                    
                                    
                                    
                                        }
			});	
			}
    function names_by_mauza(){
				var form_data = {
				mauza_id : $("#mauza_id").val()
                               
                              //  type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("filescatalog/view_by_mauza"); ?>',
				data: form_data,
				success : function(msg){
                                    $("#file_list").html(msg)
                                    }
			});	
			}
    function names_by_branch(){
				var form_data = {
				branch_id : $("#branch_id").val()
                               
                              //  type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("filescatalog/view_by_branch"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#file_list").html(msg);
                                    names_by_branch_circle();
                                    
                                    
                                        }
			});	
			}
    function names_by_cat(){
				var form_data = {
				cat_id : $("#category_id").val()
                               
                              //  type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("filescatalog/view_by_cat"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#file_list").html(msg)
                                   }
			});
                       // alert($("#category_id").val());
			}
        function names_by_branch_circle() {
        var form_data = {
            branch_id: $('#branch_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_category_by_branch"); ?>',
            data: form_data,
            success: function(msg) {
                $("#category_id").html(msg);
            }
        });
    }
    function names_by_district_circle() {
        var form_data = {
            district_id: $('#district').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_branch_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#branch_id").html(msg);
            }
        });
    }
    function names_by_mauza_circle() {
        var form_data = {
            district_id: $('#district').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_mauza_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#mauza_id").html(msg);
            }
        });
    }
    function names_by_cat_circle() {
        var form_data = {
            district_id: $('#district').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_cat_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#category_id").html(msg);
            }
        });
    }
    </script>

<div id="sub_bar">
    
      <select name="district" id="district" onchange="names_by_district();">
    <option value="0">Select District</option>
    <?php foreach($district as $list) {?>
    <?php if($this->session->userdata('selected_district')==$list->district_id){?>
    <option selected="selected" value="<?php echo $list->district_id;?>"><?php echo $list->district_name;?></option>
    <?php }else{ ?>
    <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
    <?php }} ?>
    
    </select>
      <select name="mauza" id="mauza_id" onchange="names_by_mauza();">
    <option value="">Select Mauza</option>
    <?php foreach($mauza_list as $list) {?>
    <option value="<?php echo $list->mauza_id; ?>"><?php echo $list->mouza_name; ?></option>
    <?php } ?>
    </select>
      <select name="branch" id="branch_id" onchange="names_by_branch();">
    <option value="">Select Branch</option>
    <?php foreach($branch as $list) {?>
    <option value="<?php echo $list->branch_id; ?>"><?php echo $list->branch_name; ?></option>
    <?php } ?>
    </select>
      <select name="category" id="category_id" onchange="names_by_cat();">
    <option value="0">Select Category</option>
    <?php foreach($category as $list) {?>
    <option value="<?php echo $list->case_category_id; ?>"><?php echo $list->case_category_name; ?></option>
    <?php } ?>
   
    </select>
</div>      


<div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Files Catalog</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                echo anchor('filescatalog/add','Add File',$attributes);
             ?>
    </div>
    <div id="file_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist" >
            	<thead>
                	<tr>
                        <th>File ID</th>
                        <th>Key Name</th>
                        <th>Category</th>
                        <th>Subject</th>
                        <th>Mouza</th>
                        <th>Status</th>
                        <th>Age</th>
                        <th>Almirah No</th>
                        <th>Rack No</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php foreach ($f_lists as $lists) {
                                     ?>
                        <td style="text-align: center;"><?php echo anchor('filescatalog/file_view/'.$lists->file_id,$lists->unique_file);?></td>
                        <td><?php echo $lists->file_occupant_name; ?></td>
                        <td><?php echo $lists->case_category_name; ?> </td>
                        <?php $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $lists->Subject
                        );?>
                        <td style="text-align: center;"><?php  echo anchor('filescatalog/file_view/'.$lists->file_id,'View',$att); ?></td>
                        <td><?php if($lists->mauza_id==0) { echo 'Universal';} else { echo $lists->mouza_name;} ?></td>
                        <td><?php echo $lists->file_availability ?></td>
                        <td style="text-align: center;"><?php if($lists->start_year== 0 or $lists->start_year ==''){
        echo '';} else { echo  date('Y', time())- $lists->start_year;}?></td>
                        <td style="text-align: center;"><?php echo $lists->file_almirah_no; ?></td>
                        <td style="text-align: center;"><?php echo $lists->file_rack_no; ?></td>
                        <td> <?php echo anchor('filescatalog/file_view/'.$lists->file_id,'view');?>
                        <?php echo anchor('filescatalog/delete/'.$lists->file_id,'|delete');?>
                        
                        </td>
                        
                        
                        
                    </tr>
                    <?php }?>
                </tbody>
               
            </table>
        </div>
        </div>
        