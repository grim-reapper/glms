<script type="text/javascript">


		   // search property by tehsil

  function names_by_division(){
				var form_data = {
				division_id : $("#division").val(),
                                type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
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
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
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
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
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
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
                                         get_patwar_circle();

				 }

			});
    }
  function names_by_patwarcircle(){
                               // alert($("#patwar").val());
				var form_data = {
				p_id : $("#patwar").val(),
				type : 'patwar'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)

				 }

			});
    }
    </script>

<div class="table">
  <div class="head">
    <h5 class="iFrames">Identified Schemes</h5>
          	 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('registration/add_scheme','Add Scheme',$attributes);
             ?>
  </div>
    <div id="d_list">
     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="15%">Name of Housing Scheme</td>
                        <td width="10%">Tehsil</td>
                        <td width="10%">Area of Scheme</td>
                        <td width="15%">Mouza</td>
                        <td width="20%">Years of Approval</td>
                        <td width="15%">Status</td>
                        <td width="10%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($schemes as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $list->housing_scheme; ?></td>
                        <td><?php echo $list->scheme_area; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td><?php echo $list->mouza_name; ?></td>
                        <td><?php echo $list->approval_year; ?></td>
                        <td><?php echo $list->status; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('registration/edit_scheme/'.$list->id,'Edit'); ?>
<!--                            --><?php //echo anchor('mauza/mauza_detail/'.$list->mauza_id,'|view'); ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
           </div>
          </div>



