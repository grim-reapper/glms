<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    exit;
}
?>
$(".collapse").collapse();
$('#import_data_tab').tab('show');

// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
}; 

$('#table-fields-options').sortable({
  items: 'tr:not(.ui-state-disabled)',
  helper: fixHelper,
  forceHelperSize: true,  
  handle : '.handle',
  update : function(event, ui) {        
      $.post("<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/update-form-field-options-positions.php", $(this).sortable("serialize"));      
  }
});

        // --------------- [START] ADD OPTIONS --------------- //

        $("#add-option").dialog({
    			autoOpen: false,
    			height: 'auto',
    			width: '300',
    			modal: true,
                resize: 'auto',
                autoResize: true,
                
    			buttons: {
    				"Add Option": function() {
    
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/add-option.php',
                            data: $("#add_option").serialize(),
                            success: function(response) {
                                
                                //alert(response);
                                                                
                                responseObj = $.parseJSON(response);
                                
                                var res_success    = responseObj.success;
                                var res_message    = responseObj.message;
                                var res_tr_content = responseObj.tr_content;
                                                                
                                if(res_success == 1) {
                                    var note_type = 'ok';
                                    
                                    $('#table-fields-options tr').eq(-1).after(res_tr_content);
                                    $('#options_controls').fadeIn();
                                    
                                } else {
                                    var note_type = 'error';
                                }
                                
                                $('#response_note_option').html('<div class="note_'+ note_type +'">'+ res_message +'</div>');
                                
                                $("#add-option").dialog("option", "position", "center");
                            }        
                        });
    				},
    
                    Close: function(event, ui) {
                        
                        $('#response_note_option').html(' ');
                        
                        $('#option_text, #option_value, #option_attributes').val('');
    
    					$(this).dialog("close");                        
                    }
    			}
        });      

        $(".add_option").click(function() {
			$( "#add-option" ).dialog("open");
            return false;
        });        

    // --------------- [END] ADD OPTIONS --------------- //     
    
    // Delete Form Field Option          
        $('#table-fields-options').delegate('a.delete_field_option','click', function(e) {
            
            var option_id = $(this).attr('rel');
            
            var selector_tr = $('#option-id-' + option_id);
            var selector_td = selector_tr.children('td');
            
            var field_title = $('#field_title').val();
            var field_option_value = selector_td.find('input').val();

            if(confirm('Are you sure you wish to delete the `'+ field_option_value +'` option '+ "\n for the field `"+ field_title +'`?')) {
		  
                e.preventDefault();
                
                $.ajax({
                    type: 'post',
                    url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-field-option.php',
                    data: 'option_id=' + option_id,
                    
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
                            $('#options_controls').fadeOut();
                        }
                    }
                });
            }
            return false;
        }); 

    /* ----- [Start] Import Options ----- */

    $('.import_options').click(function() {
        
        var confirm_message = $(this).attr('title');
        var import_file_name = $(this).attr('rel');
        
        if(confirm(confirm_message)) {
            document.getElementById('import_file_name').value = import_file_name;
            document.getElementById('import_parent_id').value = $('#import_parent_id_dd').val();
            document.getElementById('form_import_options').submit();
        }
        return false;
    });

    /* ----- [End] Import Options ----- */

    $('.toggle_checkboxes').toggle(function() {
        
        $('.option_id_checkbox').attr('checked','checked');
        $('#table-fields-options').find('td').not(':first').addClass('list_row_selected');
        
        $(this).html('Uncheck All');
        
    }, function(){
        
         $('.option_id_checkbox').removeAttr('checked');
         $('#table-fields-options').find('td').not(':first').removeClass('list_row_selected');
         
        $(this).html('Check All');      
    });


    <?php
    $begins_with = 'import';
    
    if( is_array($_POST['del_o']) || ($begins_with == substr($action, 0, strlen($begins_with))) ) {
        ?>
            $('html, body').animate({ scrollTop: $("#options").offset().top - 10}, 800);
        <?php
    }
    ?>
    
    $('#table-fields-options').delegate('a.add_option_attribute','click', function() {
        $('#attribute-area-option-id-'+ $(this).attr('rel')).slideToggle('fast');
        return false;
    });
    
    $('#table-fields-options').delegate('.option_id_checkbox','click', function(e) {
        if($(this).attr('checked')) {            
            $('#option-id-'+ $(this).val()).find('td').addClass('list_row_selected');
        } else {
            $('#option-id-'+ $(this).val()).find('td').removeClass('list_row_selected');
        }
    });
    
    $('.delete_selected').click(function() {
        return confirm('Are you sure you wish to delete the selected options?');
    });
    
    
    // Assign Parent Select
    $('#assign_parent_dd').click(function(e) {
        e.preventDefault();
        
        var parent_dd_field_id = $('#parent_dd').val();
        
        if(parent_dd_field_id != '') {
            $('#parent_id_field').val(parent_dd_field_id);
            $('#assign_parent_select_form').submit();
        } else {
            alert('Please make a selection!');
        }
    });
    
    // Unassign Parent Select
    $('#unassign_parent_dd').click(function() {
        if(confirm('Are you sure you want to unassign this parent field? All the dependencies will be removed.')) {
            $('#unassign_parent_select_form').submit();            
        }
        return false;
    });    