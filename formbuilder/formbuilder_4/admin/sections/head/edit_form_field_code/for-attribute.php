        // ------- [start] "Add Field Attribute" -------
    
        $("#add-attribute").dialog({
    			autoOpen: false,
    			height: 'auto',
    			width: $('#add-attribute').width(),
    			modal: true,
                resize: 'auto',
                autoResize: true,
                
    			buttons: {
    				"Add Attribute": function() {
    
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/add-attribute.php',
                            data: $("#add_attribute").serialize(),
                            success: function(response) {
                                
                                //alert(response);
                                
                                responseObj = $.parseJSON(response);
                                
                                var res_success    = responseObj.success;
                                var res_message    = responseObj.message;
                                var res_tr_content = responseObj.tr_content;
                                
                                //alert(res_tr_content);
                                
                                if(res_success == 1) {
                                    var note_type = 'ok';
                                    
                                    $('#table-fields-attributes tr').eq(-1).after(res_tr_content);
                                    
                                } else {
                                    var note_type = 'error';
                                }
                                
                                $('#response_note_attribute').html('<div class="note_'+ note_type +'">'+ res_message +'</div>');
                            }        
                        });
    				},
    
                    Close: function(event, ui) {
                        
                        $('#response_note_attribute').html(' ');
                        
                        $('#attribute_name').val('');
                        $('#attribute_value').val('');
    
    					$(this).dialog("close");                        
                    }
    			}
        });      

        $(".add_attribute").click(function() {
			$( "#add-attribute" ).dialog("open");
            return false;
        });        
        
        // ------- [end] "Add Field Attribute" -------


        // Delete Form Field Attribute          
        $('#table-fields-attributes').delegate('a.delete_field_attribute','click', function(e) {
            
            var attribute_id = $(this).attr('rel');
            
            var selector_tr = $('#attribute-id-' + attribute_id);
            var selector_td = selector_tr.children('td');
            
            var field_title = $('#field_title').val();
            var field_attribute_name = selector_td.find('input').val();

            if(confirm('Are you sure you wish to delete the `'+ field_attribute_name +'` attribute '+ "\n for the field `"+ field_title +'`?')) {
		  
                e.preventDefault();
                
                $.ajax({
                    type: 'post',
                    url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-field-attribute.php',
                    data: 'attribute_id=' + attribute_id,
                    
                    beforeSend: function() {                        
                        selector_td.animate(
                            { backgroundColor:'#FF7373' }, 'fast'
                        ).fadeOut('fast', function() {
                    	       selector_td.slideUp('fast');
                               selector_tr.remove();
                        });
                    },
                    
                    success: function(response) {
                        //alert(response);
                    }
                });
            }
            return false;
        }); 