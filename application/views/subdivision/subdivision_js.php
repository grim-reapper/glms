<script type="text/javascript">


function get_district_circle(){
	  var form_data = {
        division_id : $('#division').val(),
		type : 'division'
	   }
		$.ajax({
			type : 'POST',
			url : '<?php echo site_url("subdivision/property_ajax_elements"); ?>',
			data: form_data,
			success : function(msg){
				 $("#district").html(msg)
				}
		});
	}
        </script>
