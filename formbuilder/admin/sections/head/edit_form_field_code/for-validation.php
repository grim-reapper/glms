<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    exit;
}
?>        
        // For Validation
        $('#field_is_required').bind('click change', function() {
            if($(this).is(':checked')) {
                $("#validation").show();    
            } else {
                $("#validation").hide();
            }           
        }).trigger('change');
        
        <?php
        if($type_id != 5) { // if it's not radio
        ?>
        
        // For Validation (Dialog Box)
        $('#validation_type').bind('change', function() {
            
            
            <?php
            if($type_id != 2) { // If it's not select
            ?>
            
                if($(this).val() == 'phone') {
                    
                    // Show the phone number area and hide the minimum characters area
                    
                    $('#minimum_characters_area').hide();
                    $('#minimum_characters').attr('disabled', true);
                    
                    $('#phone_number_area').show();
                    $('#phone_number_formats').attr('disabled', false);
                    
                } else if($(this).val() == 'min_chars') {
                    
                    // Show the minimum characters area and hide the phone number area
                    
                    $('#phone_number_area').hide();
                    $('#phone_number_formats').attr('disabled', true);
                    
                    $('#minimum_characters_area').show();
                    $('#minimum_characters').attr('disabled', false);
                    
                } else {
                    $('#minimum_characters_area, #phone_number_area').hide();
                }
            
            <?php
            } else {
            ?>
                
                if($(this).val() == 'basic') {
                                      
                    $('#minimum_selections_area').hide();
                    $('#minimum_selections').attr('disabled', true);
                    
                } else if($(this).val() == 'min_selections') {
                    
                    $('#minimum_selections_area').show();
                    $('#minimum_selections').attr('disabled', false);
                    
                }  
                
                
            <?php } ?>
            
            $("#add-validation-type").dialog("option", "position", "center");
            
        }).trigger('change');
        
        <?php } else { ?>
            $('#minimum_selections_area').hide();
            $('#minimum_selections').attr('disabled', true);        
        <?php } ?>

        $(window).resize(function() {
            $("#add-validation-type").dialog("option", "position", "center");
        });

        // Delete Form Field Validation          
        $('#table-fields-validation').delegate('a.delete_field_validation','click', function(e) {
            
            var validation_id = $(this).attr('rel');
            
            var selector_tr = $('#validation-id-' + validation_id);
            var selector_td = selector_tr.children('td');
            
            var field_title = $('#field_title').val();
            var field_validation_name = selector_td.first().text();

            if(confirm('Are you sure you wish to delete the `'+ field_validation_name +'` validation '+ "\n for the field `"+ field_title +'`?')) {
		  
                e.preventDefault();
                
                $.ajax({
                    type: 'post',
                    url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-field-validation.php',
                    data: 'validation_id=' + validation_id,
                    
                    beforeSend: function() {                        
                        selector_td.animate(
                            { backgroundColor:'#FF7373' }, 'fast'
                        ).fadeOut('fast', function() {
                    	       selector_td.slideUp('fast');
                               selector_tr.remove();
                        });
                    },
                    
                    success: function(response) {
                        if(response == 0) {
                            $('#no_validation_notice').fadeIn();
                        }
                    }
                });
            }
            return false;
        }); 
        
        $("#add-validation-type").dialog({
			autoOpen: false,
			height: 'auto',
			width: $('#add-validation-type').width(),
			modal: true,
            resize: 'auto',
            autoResize: true,
            
			buttons: {
				"Add Validator": function() {
				    
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/add-validation.php',
                        data: $("#add_validation_type").serialize(),
                        success: function(response) {
                                                      
                            //alert(response);
                            
                            responseObj = $.parseJSON(response);
                            
                            var res_success    = responseObj.success;
                            var res_message    = responseObj.message;
                            var res_tr_content = responseObj.tr_content;
                            
                            //alert(res_tr_content);
                            
                            if(res_success == 1) {
                                var note_type = 'ok';
                                
                                $('#table-fields-validation tr').eq(-1).after(res_tr_content);
                                
                                $('#no_validation_notice').fadeOut();
                                
                            } else {
                                var note_type = 'error';
                            }
                            
                            $('#response_note_validation').html('<div class="note_'+ note_type +'">'+ res_message +'</div>');
                        }        
                    });
				},

                Close: function(event, ui) {
                    
                    $('#response_note_validation').html(' ');
                    
                    $("#validation_type option[value='basic']").attr('selected', 'selected');
                    
                    $('#minimum_characters').val('');
                    $('#error_message').val('');
                    
                    $('#minimum_characters_area, #phone_number_area').hide();

					$(this).dialog("close");                        
                }
			}
        });            

        $(".add_validation_type").click(function() {            
			$( "#add-validation-type" ).dialog("open");
            return false;
        });