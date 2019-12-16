<style>
#edit-message-details {
    display:none;
}

#export-submitted-fields-box {
    display:none;
}

.message_area {
    display:none;
}

table.message_list tr.ml_r td {
    border: 1px solid #CDCDCD !important;
    padding: 10px 10px 10px 10px !important;
}

tr.header_list td {
    background-color: #E5EBFA !important;
    border: 1px solid #CDCDCD !important;
    padding: 10px 10px 10px 10px !important;
}

.message_cell {
    border: 1px solid #cdcdcd !important;
    padding: 10px !important;
}

.message_cell table td {
    padding: 5px !important;
}

button { padding:7px; }
button:hover { font-style: normal; font-weight: normal }

label { display:block; margin: 0 0 5px; font-weight:bold; cursor:pointer; }
input { display:block; margin: 0 0 5px; }

input.text { margin-bottom:12px; width:95%; }
fieldset { padding:0; border:0; margin-top:25px; }

td.list_row_selected { background-color: #FBD1D3 !important; }

#afp_wrap .list_row_over {
    background-color: #D0DBF4 !important;
}
</style>

<link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/tinyeditor/tinyeditor.css" />
<script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/tinyeditor/tiny.editor.packed.js"></script>                
        
<script type="text/javascript">
jQuery(document).ready(function($) { // When DOM is ready

    $('.list_row').mouseover(function() {
        $(this).find('td').addClass('list_row_over');
    }).mouseout(function() {
        $(this).find('td').removeClass('list_row_over');
    });
  
    $('.toggle_msg').click(function() {
        var row_id = $(this).attr('rel');
        
        $('#r-m-message-'+ row_id).toggle();
        
        return false;
    });

    // Delete Message     
    
    $('#popitmenu').on("click", "a.del_msg", function(e) {       
        e.preventDefault();
        
        var message_id = $(this).attr('rel');
        var from_whom = $('#from-whom-' + message_id).text();
    
        if(confirm('Are you sure you wish to delete the message from `'+ from_whom +'`?')) {
            
            var form_id = $(this).attr('rel');
            var selectors = $('#r-m-info-'+ message_id +' td, #r-m-message-'+ message_id+' td, #r-m-submitted-fields-'+ message_id +' td');
    	
            $.ajax({
                type: 'post',
                url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-message.php',
                data: 'message_id=' + message_id,
                
                beforeSend: function() {
                    selectors.animate(
                        { backgroundColor:'#FF7373' }, 'fast'
                    ).fadeOut('fast', function() {
                	       selectors.slideUp('fast');
                    });
                },
                
                success: function(response) {
                }
            });
        }
        return false;
    });
    
    // Delete All Msg
    $('#delete_selected_btn').click(function(e) {
        e.preventDefault();
        
        if(!confirm('Are you sure you want to remove the selected messages?')) {
            return false;
        } else {
            $('#delete_selected_msg_form').submit();
        }
    })
    
    // Export Submitted Fields
    $('#export-submitted-fields-box').dialog({
		autoOpen: false,
		height: 'auto',
		width: 580,
		modal: true,
        
		buttons: {
			"Export to CSV": function() {
                $('#export_submitted_fields_form').submit();
			},
			Cancel: function() {
				$(this).dialog("close");
			}
		}           
    });
    
    $('#export_stored_msg_fields_btn').click(function(e) {
        e.preventDefault();
        $('#export-submitted-fields-box').dialog('open');
    });
    
    $('#export_messages_btn').click(function(e) {
        e.preventDefault();
        $('#export_messages_form').submit();
    });
    
    // Edit Message Details
    $("#edit-message-details").dialog({
		autoOpen: false,
		height: 'auto',
		width: '580',
		modal: true,
        
		buttons: {
			"Update": function() {
			  
                var from_whom = $('#from_whom').val();
                var subject = $('#subject').val();
                
                var message = $("iframe").contents().find("#editor").html();
                $('#message').val(message);
                
                var selected_message_id = $.data(document.body, 'selected_message_id');
     
                $.ajax({
                    type: 'post',
                    url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/edit-message-details.php',
                    data: $("#edit_message").serialize() + '&message_id='+ selected_message_id,
                    success: function(response) {
                        
                        //alert(response);
                        
                        responseObj = $.parseJSON(response);
                        
                        var res_success = responseObj.success;
                        var res_message = responseObj.message;
                        
                        //alert(res_message);
                        
                        if(res_success == 1) {
                            var note_type = 'ok';

                            // Update the name & description from the page
                            $('#from-whom-'+ selected_message_id).html(from_whom);
                            $('#subject-'+ selected_message_id).html(subject);
                            $('#message-content-'+ selected_message_id).html(message);

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
              
    $('#popitmenu').on("click", "a.edit", function(e) {
        e.preventDefault()
	 
        var clicked_message_id = $(this).attr('rel');
                
        // Update the form's fields
        $('#from_whom').val( $('#from-whom-'+ clicked_message_id).html() );
        $('#subject').val( $('#subject-'+ clicked_message_id).html() );
        $('#message').val( $('#message-content-'+ clicked_message_id).html() );
     
        $.data(document.body, 'selected_message_id', clicked_message_id);
     
		$( "#edit-message-details" ).dialog("open");
        
        $('.tinyeditor').after('<textarea name="message" id="message" rows="9" class="text ui-widget-content ui-corner-all"></textarea>').remove();

        // Trigger WYSIWYG editor
        var editor = new TINY.editor.edit('editor', {
        	id: 'message',
        	width: 550,
        	height: 160,
        	cssclass: 'tinyeditor',
        	controlclass: 'tinyeditor-control',
        	rowclass: 'tinyeditor-header',
        	dividerclass: 'tinyeditor-divider',
        	controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
        		'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
        		'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
        		'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
        	footer: true,
        	fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
        	xhtml: true,
        	cssfile: 'custom.css',
        	bodyid: 'editor',
        	footerclass: 'tinyeditor-footer',
        	toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
        	resize: {cssclass: 'resize'}
        });

        $("iframe").contents().find('#editor').html($('#message-content-'+ clicked_message_id).html());     
    });

    $('.toggle_checkboxes').toggle(function() {
        
        $('.msg_chk').attr('checked','checked');
        $('#message_list').find('td').not(':first').addClass('list_row_selected');
        
        $(this).html('Uncheck All');
        
    }, function(){
        
         $('.msg_chk').removeAttr('checked');
         $('#message_list').find('td').not(':first').removeClass('list_row_selected');
         
        $(this).html('Check All');      
    });

    $('#message_list').delegate('.msg_chk','click', function(e) {
        if($(this).attr('checked')) {            
            $('#r-m-info-'+ $(this).val()).find('td').addClass('list_row_selected');
        } else {
            $('#r-m-info-'+ $(this).val()).find('td').removeClass('list_row_selected');
        }
    });
});
</script>