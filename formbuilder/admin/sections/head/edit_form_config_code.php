<style>
    	.column { width: 100%; }
    	.portlet { margin: 0 0 1em 0; }
    	.portlet-header { margin: 0.3em; padding: 7px; }
    	.portlet-header .ui-icon { float: right; }
    	.portlet-content { padding: 0.4em; }
    	.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
    	.ui-sortable-placeholder * { visibility: hidden; }
    	</style>

        <script type="text/javascript">
          // When the document is ready set up our sortable with it's inherant function(s)
          jQuery(document).ready(function($) { // When DOM is ready

            <?php
            if(!in_array('curl', $loaded_extensions)) {
                ?>
                $('#group_17').find('select, input, textarea').attr('disabled', true);
                <?php
            }
            ?>
            
            $('[id^="table-fields-"]').sortable({
              items: 'tr',
              handle : '.handle-c',
              update : function(event, ui) {        
                  $.post("<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/update-form-configs-positions.php", $(this).sortable("serialize"));      
              }
            });
            
            $(".column").sortable({
                connectWith: ".column",
                items: '.portlet',
                handle : '.portlet-header',
                update: function(event, ui) {                   
                    $.post("<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/update-groups-positions.php", $(this).sortable("serialize"));      
                }        
                
            });
        
        	$(".portlet").addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
        		.find(".portlet-header")
        			.addClass("ui-widget-header ui-corner-all")
        			.prepend("<span class='ui-icon ui-icon-minusthick'></span>")
        			.end()
        		.find( ".portlet-content" );
        
        	$( ".portlet-header .ui-icon" ).click(function() {
        		$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
        		$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
        	});
    
        	$( ".toggle_all" ).click(function() {
        		$( ".portlet-header .ui-icon" ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
        		$( ".portlet-header .ui-icon" ).parents( ".portlet" ).find( ".portlet-content" ).toggle();
        	
                return false;
            });
            
     
            
            $('.group_link').click(function() {
                
                var group_id = $(this).attr('rel');
                
                //alert(group_id);
                $( ".portlet-header .ui-icon" ).removeClass("ui-icon-plusthick").addClass('ui-icon-minusthick');
                $("#group_"+ group_id).find(".portlet-content").slideDown('fast');
                
                $('html, body').animate({ scrollTop: $("#efc" + group_id).offset().top - 10}, 500);
                
                return false;
            });
            
            
            // For SMTP Configuration
            $('#enable_smtp_configuration').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.smtp_configuration:not(:first)").show();    
                } else {
                    $("tr.smtp_configuration:not(:first)").hide();
                }           
            });

            // For CAPTCHA
            $('#enable_captcha').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.captcha:not(:first)").show();    
                } else {
                    $("tr.captcha:not(:first)").hide();
                }           
            });

            // For reCAPTCHA
            $('#enable_recaptcha').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.recaptcha:not(:first)").show();    
                } else {
                    $("tr.recaptcha:not(:first)").hide();
                }           
            });

            // For Remote POST
            $('#enable_remote_post').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.remote_post:not(:first)").show();    
                } else {
                    $("tr.remote_post:not(:first)").hide();
                }           
            });

            // For Attachments
            $('#enable_attachments').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.attachments:not(:first)").show();    
                } else {
                    $("tr.attachments:not(:first)").hide();
                }           
            });

            // For Attachments
            $('#enable_auto_responder').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.auto_responder:not(:first)").show();    
                } else {
                    $("tr.auto_responder:not(:first)").hide();
                }           
            });
            
            // For Custom Thank you page
            $('#enable_custom_thank_you_page').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.custom_thank_you_page:not(:first)").show();    
                } else {
                    $("tr.custom_thank_you_page:not(:first)").hide();
                }           
            });

            // For 'Enable Send Copy E-mail to Sender'
            $('#enable_escts').bind('change', function() {
                if($(this).val() == 1) {
                    $("tr.escts:not(:first)").show();    
                } else {
                    $("tr.escts:not(:first)").hide();
                }           
            });
            
            // For (Attach files to the mail?)
            $('#attach_2_mail').bind('change', function() {
                if($(this).val() == 1) {
                    $("#add_links_2_the_files").val(0).parent('tr.attachments').hide();    
                } else {
                    $("#add_links_2_the_files").val(1).parent('tr.attachments').show();
                }           
            });

            // For (Add links to the files?)
            $('#add_links_2_the_files').bind('change', function() {
                if($(this).val() == 1) {
                    $("#attach_2_mail").val(0);    
                } else {
                    $("#attach_2_mail").val(1);
                }           
            });
                        
            $('#enable_smtp_configuration, #enable_captcha, #enable_recaptcha, #enable_attachments, #enable_auto_responder, #enable_custom_thank_you_page, #enable_escts, #attach_2_mail, #add_links_2_the_files, #enable_remote_post').trigger('change');
                                 
          });
        </script>    