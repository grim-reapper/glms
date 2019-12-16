<script type="text/javascript">


function get_district_circle(){
	  var form_data = {
        division_id : $('#division').val(),
		type : 'district'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
				 $("#district").html(msg)
				}
		});
	}
function get_tehsil_circle(){
	  var form_data = {
        district_id : $('#district').val(),
		type : 'subdiv'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
				 $("#tehsil").html(msg)
				}
		});

	}
function get_qanungoi_circle(){
	  var form_data = {
        tehsil_id : $('#tehsil').val(),
		type : 'qc'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
				 $("#qanungoi").html(msg)
				}
		});
	}
function get_patwar_circle(){
	  var form_data = {
        qanungoi_id : $('#qanungoi').val(),
		type : 'pc'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
				 $("#patwar_circle").html(msg)
				}
		});

	}
	
function get_mauza(){
	  var form_data = {
        patwar_circle_id : $('#patwar_circle').val(),
		type : 'mauza'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
			//	alert(msg);
			  $("#mauza").html(msg)
				}
		});

	}
	
function voice_mauza(){
	  var form_data = {
        mauza_id : $('#mauza').val(),
		type : 'maauza_voice'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("mauza/voice_mauza"); ?>',
			data: form_data,
			success : function(msg){
			//	alert(msg);
			 
				}
		});

	}	
	
function filter_by_subdivision(){
	  var form_data = {
        tehsil_id : $('#tehsil').val(),
		type : 'sub'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_filter"); ?>',
			data: form_data,
			success : function(msg){
			$("#propertylist").fadeOut("fast").fadeIn('fast');
			$("#qanungoi").html(msg);
		
			}
			
		});
	
	}
	
function filter_by_qanungoi_circle(){
	  var form_data = {
        qanungoi_id : $('#qanungoi').val(),
		type : 'qc'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
				 $("#patwar_circle").html(msg)
				}
		});


	}
function filter_by_patwar_circle(){
	  var form_data = {
        patwar_circle_id : $('#patwar_circle').val(),
		type : 'pc'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
			//	alert(msg);
			  $("#mauza").html(msg)
				}
		});
	}
	
function filter_by_mauza(){
	  var form_data = {
        patwar_circle_id : $('#patwar_circle').val(),
		type : 'mauza'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("property/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
			//	alert(msg);
			  $("#mauza").html(msg)
				}
		});

	}
</script>
