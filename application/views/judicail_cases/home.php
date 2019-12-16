 <script type="text/javascript"> 
    
          $(document).ready(function() {
     
        if($('#d_id').val())
            {
                
                var form_data = {
            district_id: $('#d_id').val(),
            court_id: $('#court_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("judicial_cases/get_cases_court_and_district"); ?>',
            data: form_data,
            success: function(msg) {
                  $('#case_list').html(msg);
                  names_by_district();
                
                  $('#msg').hide();
                    oTable = $('#propertylist').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
		
                   });
                    
                
               
               
            }
        });
            
            }
           
            
        $('#d_id').change(function(){
        var form_data = {
            district_id: $('#d_id').val(),
            court_id: $('#court_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("judicial_cases/get_cases_court_and_district"); ?>',
            data: form_data,
            success: function(msg) {
                  $('#case_list').html(msg);
                  names_by_district();
                 
                  $('#msg').hide();
                   oTable = $('#propertylist').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
		
                   });
                    
                
               
               
            }
        });
        });
        
        });
         
     
     function names_by_district() {
        var form_data = {
            district_id: $('#d_id').val(),
            court_id: $('#court_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("revenue/get_subdiv_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#tehsil_id").html(msg);
                 names_by_mauza_circle();
                
               
               
            }
        });
    }
     
     function search_by_date()
     {
        var form_data = {
            date: $('#txtDate').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("judicial_cases/get_cases_by_date"); ?>',
            data: form_data,
            success: function(msg) {
        
                $("#case_list").html(msg);
            }
        });
      
     }
     function list_by_tehsil()
     {
        var form_data = {
            tehsil_id: $('#tehsil_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("judicial_cases/list_by_tehsil"); ?>',
            data: form_data,
            success: function(msg) {
        
                $("#case_list").html(msg);
                mauza_list_by_subdiv();
                    oTable = $('#propertylist').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""f>t<"F"lp>'
	      });
                
            }
        });
      
     }
     
     function mauza_list_by_subdiv() {
        var form_data = {
            subdiv_id: $('#tehsil_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("revenue/get_mauza_by_subdiv"); ?>',
            data: form_data,
            success: function(msg) {
                $("#mauza_id").html(msg);
                   
                
               
               
            }
        });
    }
    function list_by_mauza()
     {
        var form_data = {
            mauza_id: $('#mauza_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("judicial_cases/list_by_mauza"); ?>',
            data: form_data,
            success: function(msg) {
        
                $("#case_list").html(msg);
                    oTable = $('#propertylist').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""f>t<"F"lp>'
	      });
                
            }
            
        });
      
     }
      function names_by_mauza_circle() {
        var form_data = {
            district_id: $('#d_id').val()
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
      function update_view() {
        
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("judicial_cases/update_view_ajax"); ?>',
            //data: form_data,
            success: function(msg) {
                $("#case_list").html(msg);
                
                $( ".datepicker" ).datepicker({ 
                  defaultDate: +7,
                  autoSize: true,
                  appendText: '(dd-mm-yyyy)',
                  dateFormat: 'dd-mm-yy',
                  changeMonth: true,
                  changeYear: true
               });
               
           
                
            }
        });
       
       
    }

            $(document).ready(function() {

                $("#txtDate").datepicker({
                    showOn: 'button',
                    //buttonText: 'View Date',
                    buttonImage: "<?php echo base_url();?>asset/images/calender.png",
                    buttonImageOnly: true,
                    dateFormat: 'yy-mm-dd'
                    
                });

                $(".ui-datepicker-trigger").mouseover(function() {
                    $(this).css('cursor', 'pointer');
                    $(this).css('margin-left','5px');
                    
                });

            });

        </script>

<div id="sub_bar">
             <select name="court" id="court_id"  >
                    <option value="0">Court Category</option>
                    <?php foreach ($court as $list) { ?>
                     <?php if($this->session->userdata('selected_court_rev')==$list->court_category_id){?>
                     <option selected="selected" value="<?php echo $list->court_category_id;?>"><?php echo $list->court_category_name;?></option>
                        <?php }else{ ?>
                         <option value="<?php echo $list->court_category_id; ?>"><?php echo $list->court_category_name; ?></option>
                    <?php }} ?>
                </select>
                 <select name="district" id="d_id"  >
                    <option value="0">Select District</option>
                    <?php foreach ($district as $list) { ?>
                     <?php if($this->session->userdata('selected_district_rev')==$list->district_id){?>
                     <option selected="selected" value="<?php echo $list->district_id;?>"><?php echo $list->district_name;?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
                    <?php }} ?>

                </select>
                <select name="tehsil" id="tehsil_id"  onchange="list_by_tehsil();">
                    <option value="0">Select Tehsil</option>
                    <?php foreach ($subdiv as $list) { ?>
                        <option value="<?php echo $list->tehsil_id; ?>"><?php echo $list->tehsil_name; ?></option>
                    <?php } ?>

                 </select>
                <select name="tehsil" id="tehsil_id" >
                    <option value="0">Select Patwar Circle</option>
                    <?php foreach ($patwar as $list) { ?>
                        <option value="<?php echo $list->p_id; ?>"><?php echo $list->patwar_circle; ?></option>
                    <?php } ?>

                 </select>
                <select name="mauza" id="mauza_id"  onchange="list_by_mauza();">
                    <option value="0">Select Mauza</option>
                    <?php foreach ($mauza as $list) { ?>
                        <option value="<?php echo $list->mauza_id; ?>"><?php echo $list->mouza_name; ?></option>
                    <?php } ?>

                </select>
               
    
    
</div>
<div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Judicial Cases</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                $attributes1 = array('class' => 'basicBtn header_button','style' => 'margin-right: 4px;');
                echo anchor('judicial_cases/add','Add Case',$attributes);
                echo anchor('#','Calender',$attributes1);
                ?>
                    <div id="new">
                    View Date:<input type='text' id='txtDate'   onchange="search_by_date();" />
                     <div class="clear"></div>
                     </div>
                <?php
                echo anchor('peshi_list','Cause List',$attributes1);
               // echo anchor('peshi_list','Update View',$attributes1);
                
                
             ?>
   <button class="basicBtn header_button" style=" margin-right: 3px;" onclick="update_view()">Update View</button>
                   
      <h5 class="iFrames" id="msg">Please First Select Court Category and then District</h5>            
    </div>
    
    <div id="case_list" style="display: block;">
       
           
        </div>
        </div>
        
