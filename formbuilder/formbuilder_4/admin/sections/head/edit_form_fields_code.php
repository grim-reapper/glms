<script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/css/bootstrap/bootstrap.css" />

<style>
#lightbox_desc { display:none; }

#add-field { display:none; }
#select-integration { display:none; }

button { padding:7px; }

label, input[type=checkbox], input[type=radio] { cursor:pointer; }

label, input { margin: 5px 0 5px; }
.new_field { display:block; margin: 5px 0 10px; }
input.text { margin-bottom:12px; width:95%; }
fieldset { padding:0; border:0; margin-top:25px; }        

.stylish_fieldset { border:1px solid #cdcdcd; padding:15px; }
.stylish_legend { border:1px solid #cdcdcd; padding:10px; font-weight:bold; }

.ui-state-disabled { opacity: 1; cursor: text !important; }

.ui-sortable-placeholder { border: 1px dashed #cdcdcd; visibility: visible !important; height: 50px !important; }
.ui-sortable-placeholder * { visibility: hidden; }

#info_field_name_desc { display:none; }

#add_field_value_area { display:none; }
</style>

<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  jQuery(document).ready(function($) { // When DOM is ready

    // Readme for Field Attributes
    $('#info_field_name').click(function() {
        $('#info_field_name_desc').slideToggle('fast');
        return false;
    });
    
    $('#merge_fields_tab').tab('show');

    // Return a helper with preserved width of cells
    var fixHelper = function(e, ui) {
    	ui.children().each(function() {
    		$(this).width($(this).width());
    	});
    	return ui;
    };    
    
    $('.table-fields').sortable({
      items: 'tr:not(.ui-state-disabled)',
      helper: fixHelper,
      forceHelperSize: true,
      handle : '.handle',
      update : function(event, ui) {        
          $.post("<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/update-form-fields-positions.php", $(this).sortable("serialize") + '&form_id=<?php echo $form_id; ?>', function(result) { 
            //alert(result);
            $('#merge_set').html(result); // Update the field's list from the "Merge Rows" select
          });      
      }
    });

    // Delete Form Field            
    $('.table-fields').delegate('a.delete_field','click', function(e) {
        
        var selector_td = $(this).parents('tr').children('td');
        var selector_tr = $(this).parents('tr');
        
        var field_name = selector_tr.find('input.field_title').val();

        if(confirm('Are you sure you wish to delete the field `'+ field_name +'`'+ "\nand all its properties" +'?')) {
	  
            e.preventDefault();
            
            var field_id = selector_tr.find('input').eq(0).val();
		
            $.ajax({
                type: 'post',
                url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-field.php',
                data: 'field_id=' + field_id,
                
                beforeSend: function() {                        
                    selector_td.animate(
                        { backgroundColor:'#FF7373' }, 'fast'
                    ).fadeOut('fast', function() {
                	       selector_td.slideUp('fast');
                           selector_tr.remove();
                    });
                }
            });
        }
        return false;
    });            

    $("#add-field").dialog({
		autoOpen: false,
		height: 'auto',
		width: 300,
		modal: true,
        
		buttons: {
			"Add Field": function() {

                $.ajax({
                    type: 'post',
                    url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/add-field.php',
                    data: $("#add_field").serialize(),
                    success: function(response) {
                        
                        //alert(response);
                        
                        responseObj = $.parseJSON(response);
                        
                        var res_success    = responseObj.success;
                        var res_message    = responseObj.message;
                        
                        //alert(res_tr_content);
                        
                        if(res_success == 1) {
                            var note_type = 'ok';

                            window.location = 'edit_form_field.php?field_id=' + responseObj.field_id;
                            
                        } else {
                            var note_type = 'error';
                        }
                        
                        $('#response_note').html('<div class="note_'+ note_type +'">'+ res_message +'</div>');
                        
                    }        
                });
                
			},

            Close: function(event, ui) {
                
                $('#response_note').html(' ');                
                $('#webmaster_name, #webmaster_email').val('');

				$(this).dialog("close");                        
            }
		}
    });            

    $(".add_new_field").click(function() {
		$( "#add-field" ).dialog("open");
        return false;
        
    });

    //// ------------- INTEGRATION DIALOG ------------- ////

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
		width: 400,
		modal: true,
        
		buttons: {
			Continue: function() {
                window.location = '<?php echo $conf['url']['path_to_afp_admin']; ?>/get_code.php?forms='+ $('#form_id').val() +'&method='+ $('#integration_method').val() + '&integration_type='+ $('#integration_type').val();
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

    $(".delete_merged_row").click(function() {
        if(confirm('Are you sure?')) {
            var row_id = $(this).attr('rel');
            $('#row_id').val(row_id);
            
            $('#delete_merged_row').submit();
        }
        return false;
    });
    
    $('#field_type').change(function() {
        // Hidden field
        if($(this).val() == 6) {
            $('#add_field_required_area').hide();
            $('#add_field_value_area').show();
        } else {
            $('#add_field_required_area').show();
            $('#add_field_value_area').hide();
        }
    }).trigger('change');
     
  });      
</script>