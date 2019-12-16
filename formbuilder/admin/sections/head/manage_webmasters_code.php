  <style>
        button { padding:7px; font-size: 15px !important; }
        
        label, input { display:block; margin: 0 0 5px; }
		input.text { margin-bottom:12px; width:95%; }
		fieldset { padding:0; border:0; margin-top:25px; }
        
        #afp_wrap .full_desc { display:none; }
        
        #edit-webmaster-info, #add-new-webmaster-info { display:none; }
        </style>
        
        <script type="text/javascript">
        jQuery(document).ready(function($) { // When DOM is ready
                        
            ////// DELETE WEBMASTER INFO //////             
            $('#webmasters-list').delegate('a.delete','click', function(e) {
                
                var webmaster_name = $(this).parents('tr').children('td:first').html();

                if(confirm('Are you sure you wish to delete the webmaster\'s record for `'+ webmaster_name +'`?'+ "\n It will be deleted from the forms` configurations too!")) {
    		  
                    e.preventDefault();
                  
                    var webmaster_id = $(this).attr('rel');
                    
                    var selector = $(this).parents('tr').children('td');
        		
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-webmaster-info.php',
                        data: 'webmaster_id=' + webmaster_id,
                        
                        beforeSend: function() {                        
                            selector.animate(
                                { backgroundColor:'#FF7373' }, 'fast'
                            ).fadeOut('fast', function() {
                        	       selector.slideUp('fast');
                            });
                        },
                        
                        success: function(response) {
                            //alert(response);
                        }
                    });
                }
                return false;
            });
            
            ////// EDIT WEBMASTER INFO //////
            $("#edit-webmaster-info").dialog({
                
    			autoOpen: false,
    			height: 'auto',
    			width: 280,
    			modal: true,
                
    			buttons: {
    				Update: function() {
                                                
                        var selected_webmaster_id = $.data(document.body, 'selected_webmaster_id');
                        
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/edit-webmaster-info.php',
                            data: $("#edit_webmaster").serialize() + '&webmaster_id='+ selected_webmaster_id,
                            success: function(reply) {
                                   
                                o_responseObj = $.parseJSON(reply);
                                
                                var o_success = o_responseObj.success;
                                var o_message = o_responseObj.message;
                         
                                if(o_success == 1) {   
                                    
                                    var edit_name = $('#name').val();
                                    var edit_email = $('#email').val();

                                    var note_type = 'ok';

                                    // Update the name & description from the page
                                    $('#name-'+ selected_webmaster_id).html( edit_name );
                                    $('#email-'+ selected_webmaster_id).html( edit_email );

                                } else {
                                    var note_type = 'error';   
                                }
                                                                
                                $('#response_note_edit').html('<div class="note_'+ note_type +'">'+ o_message +'</div>'); 
                            }        
                        });  
    				},
    				Cancel: function() {
    				    
                        // Update the form's fields
                        $('#response_note_edit').html(' ');
                        
    					$(this).dialog("close");
    				}
    			}
            });         

            $('#webmasters-list').delegate('.edit_webmaster', 'click', function(e) {
	 
                e.preventDefault();
     
                var clicked_webmaster_id = $(this).attr('rel');
                
                $.data(document.body, 'selected_webmaster_id', clicked_webmaster_id);
                    		 
                // Update the form's fields
                $('#name').val( $('#name-'+ clicked_webmaster_id).html() );
                $('#email').val( $('#email-'+ clicked_webmaster_id).html() );
             
    			$( "#edit-webmaster-info" ).dialog("open");
                return false;
                
            });
               
            ////// ADD NEW WEBMASTER INFO //////
            $("#add-new-webmaster-info").dialog({
    			autoOpen: false,
    			height: 'auto',
    			width: 280,
    			modal: true,
                resize: 'auto',
                autoResize: true,       
                         
    			buttons: {
    				"ADD": function() {
                        
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/add-webmaster-info.php',
                            data: $("#add_new_webmaster_info").serialize(),
                            success: function(response) {
                                
                                //alert(response);
                                
                                responseObj = $.parseJSON(response);
                                
                                var res_success    = responseObj.success;
                                var res_message    = responseObj.message;
                                var res_tr_content = responseObj.tr_content;
                                
                                //alert(res_tr_content);
                                
                                if(res_success == 1) {
                                    var note_type = 'ok';
                                    
                                    $('#webmasters-list tr').eq(-1).after(res_tr_content);
                                    
                                } else {
                                    var note_type = 'error';
                                }
                                
                                $('#response_note_add').html('<div class="note_'+ note_type +'">'+ res_message +'</div>');
                                
                            }        
                        }); 
    				},
    				Cancel: function() {
    				    
                        $('#response_note_add').html(' ');
                        $('#webmaster_name, #webmaster_email').val(' ');
                        
    					$(this).dialog("close");
    				}
    			},
            });

            $(".add_new_webmaster_info").click(function() {
    			$( "#add-new-webmaster-info" ).dialog("open");
                return false;
                
            });
                     
        });
        </script>