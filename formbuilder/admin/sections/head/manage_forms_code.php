        <script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/tooltip/jquery.tooltip.pack.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/tooltip/jquery.tooltip.css" />
        
        <style>
        button { padding:7px; }
        button:hover { font-style: normal; font-weight: normal }
        
        label, input { display:inline; }
		input.text { margin-bottom:12px; width:95%; }
		.input-medium { width:150px; }
        fieldset { padding:0; border:0; margin-top:25px; }
        
        #afp_wrap .full_desc { display:none; }
        
        #edit-form-info { display:none; }
        #select-integration { display:none; }
                
        #afp_wrap .list_row_over {
            background-color: #D0DBF4 !important;
        }
        </style>
        
        <script type="text/javascript">
        jQuery(document).ready(function($) { // When DOM is ready
            
            $('#export_messages_btn').click(function(e) {
                e.preventDefault();
                $('#export_messages_form').submit();
            });
            
            $('.list_row').mouseover(function() {
                $(this).find('td').addClass('list_row_over');
            }).mouseout(function() {
                $(this).find('td').removeClass('list_row_over');
            });
            
            // Show the full description (if it's too long)
            $('.desc').tooltip({
            	track: true,
            	delay: 0,
            	showURL: false,
            	fade: 250,
                extraClass: "pretty fancy",
                bodyHandler: function() { 
                    return $(this).parents('tr').find('span').html(); 
                } 
            });            
            
            // Clone Form
            $('#popitmenu').on("click", "a.clone", function(e) {
                
                e.preventDefault();
                
                if(confirm('This will create a new form with the same fields and properties as `'+ $(this).attr('title') +'`. Click OK to continue.')) {
                    
                    // Hide the pop it menu
                    $('#popitmenu').css('visibility', 'hidden');
                    
                    $('#clone_from_form_id').val($(this).attr('rel'));                
                    $('#clone_form').submit();
                }
            });
            
            // Delete Form            
            $('#popitmenu').on("click", "a.delete_f", function(e) {
                
                e.preventDefault();
                
                var form_name = $(this).attr('title');

                if(confirm('Are you sure you wish to delete the form `'+ form_name +'`?')) {
    		    
                    var form_id = $(this).attr('rel');
                    
                    var selector = $('#f-r-'+ form_id).children('td');
        		
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-form.php',
                        data: 'form_id=' + form_id,
                        
                        beforeSend: function() {
                            // Hide the pop it menu
                            $('#popitmenu').css('visibility', 'hidden');                         
                            
                            selector.animate(
                                { backgroundColor:'#FF7373' }, 'fast'
                            ).fadeOut('fast', function() {
                        	       selector.slideUp('fast');
                            });
                        },
                        
                        success: function(response) {
                            //alert(response);
                            $("#forms option[value='"+ form_id +"']").remove();
                            
                            if($('#forms option').length == 1) {
                                $("#forms option:first").attr('selected','selected');
                                $('#forms').trigger('change');
                            }
                        }
                    });
                }
                return false;
            });
            
            $("#edit-form-info").dialog({
    			autoOpen: false,
    			height: 320,
    			width: 450,
    			modal: true,
                
    			buttons: {
    				"Update": function() {
			             
                        var name = $('#name').val();
                        var description = $('#description').val();
                        
                        var selected_form_id = $.data(document.body, 'selected_form_id');

                        $.ajax({
                            type: 'post',
                            url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/edit-form-info.php',
                            data: $("#edit_form").serialize() + '&form_id='+ selected_form_id,
                            success: function(response) {
                                
                                //alert(response);
                                
                                responseObj = $.parseJSON(response);
                                
                                var res_success = responseObj.success;
                                var res_message = responseObj.message;
                                
                                if(res_success == 1) {
                                    var note_type = 'ok';

                                    // Update the name & description from the page
                                    $('#name-'+ selected_form_id).html(name);
                                    $('#description-'+ selected_form_id).html( description.substr(0, <?php echo $conf['short_desc_chars']; ?>) + '...'  );
                                    $('#description-full-'+ selected_form_id).html( description );

                                } else {
                                    var note_type = 'error';
                                }
                                
                                $('#response_note').html('<div class="note_'+ note_type +'">'+ res_message +'</div>');
                                
                            }        
                        });
                        
    				},
    				Cancel: function() {
    					$(this).dialog("close");
    				}
    			}
            });            

            $(".edit_info").click(function() {
            			 
                var clicked_form_id = $(this).attr('rel');
                
                // Update the form's fields
                $('#name').val( $('#name-'+ clicked_form_id).html() );
                $('#description').val( $('#description-full-'+ clicked_form_id).html() );
             
                $.data(document.body, 'selected_form_id', clicked_form_id);
             
    			$( "#edit-form-info" ).dialog("open");
                
                return false;
                
            });


//// ------------- INTEGRATION DIALOG ------------- ////

    // Forms Selection
    $('#forms').bind('change', function() {
        var total_selections = $('#forms option:selected').length;
        
        if(total_selections == 1) {
            
            // Remove them first, before adding them again (to avoid duplicates)
            $("#integration_type option[value='slide_in_top']").remove();
            $("#integration_type option[value='slide_in_left']").remove();
            
            var mySingleOptions = {
                'slide_in_top'  : 'Slide-In Top',
                'slide_in_left' : 'Slide-In Left'
            };
            
            $.each(mySingleOptions, function(val, text) {
                $('#integration_type').append( new Option(text, val) );
            });  
        } else if(total_selections > 1) {
            
            $("#integration_type option[value='slide_in_top']").remove();
            $("#integration_type option[value='slide_in_left']").remove();
            
        }

    });
    
    $('#forms').trigger('change');

    // For Integratin Selection
    $('#integration_method').bind('change', function() {
        
        if($(this).val() == 'iframe') {

            $('#iframe_info').show();
            $('#copy_php_code_info').hide();
            $('#lightbox_desc').hide();
            
        } else if($(this).val() == 'copy_php_code') {
            
            $('#copy_php_code_info').show();
            $('#iframe_info').hide();
            $('#lightbox_desc').show();
            
        }
        
        $("#select-integration").dialog("option", "position", "center");
        
    });
    
    $('#integration_method').trigger('change');

    $("#select-integration").dialog({
		autoOpen: false,
		height: 'auto',
		width: 500,
		modal: true,
        
		buttons: {
			Continue: function() {
                var total_selected_forms = $('#forms option:selected').length;
                
                if(total_selected_forms == 0) { // No form is selected? Alert the user
                    var no_form_alert_msg = '<?php echo str_replace("'", '', $afp_conf['msg']['error']['no_form_selected']); ?>';
                    $('#no_form_alert').html('<div class="note_error">'+ no_form_alert_msg +'</div>');
                } else {
                    var multipleForms  = $("#forms").val() || [];
                    var formsIdsList   = multipleForms.join(",");
                 
                    window.location = '<?php echo $conf['url']['path_to_afp_admin']; ?>get_code.php?forms='+ formsIdsList +'&method='+ $('#integration_method').val() + '&integration_type='+ $('#integration_type').val();
                }
            },

            Close: function(event, ui) {
				$(this).dialog("close");                        
            }
		}
    });            

    $(".integrate").click(function() {
		$( "#select-integration" ).dialog("open");
        return false;
        
    });
                     
        });
        </script>