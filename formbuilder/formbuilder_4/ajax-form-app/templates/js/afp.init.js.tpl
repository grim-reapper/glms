{* When DOM is ready *}
jQuery(document).ready(function($) {ldelim}
    
    resize_frame();    

    {* Important for JS validation *}
    var total_required_inputs = {$total_required_inputs}; {* (usually name, email, subject, message & security code) *}
    
    {*
    -------------------------------------------------
    Is the form submitted?
    -------------------------------------------------
    *}
    
    $('#{$form_id}_afb_submit_button').before('<div id="{$form_id}_place_for_security_code"></div>');
    
    {* Is Basic PHP Form Disabled? Enable AJAX Validation *}
    {if !$is_basic_php_form}
    
        $('#{$form_id}').submit(function() {ldelim}
                    
            var form_id = $(this).attr("id");
        
            {* Code to use if the Realtime Live Validator is enabled *}
            {if $c.js_realtime_validator eq '1'}	
        	
                {foreach from=$afb_form_fields key=afb_key item=afb_value}
                    {if $afb_value.mandatory eq '1' && !empty($afb_value.validation)}
                        check_{$form_id}_{$afb_key}('', 'none', '1');
                    {/if}
                {/foreach}
    
    	    {if $c.captcha.enabled eq '1'}        
    		check_{$form_id}_security_code('{$c.errors_effect}');
    	    {/if}
                
                {if $c.attachments.enabled eq '1' && $c.attachments.mandatory eq '1'}
                    check_{$form_id}_attachment('{$c.errors_effect}');
                {/if}
                
                $('html, body').animate({ldelim} scrollTop:$("#"+ form_id + "_wrap").offset().top - 10{rdelim}, 500, function() {ldelim}
                    {$form_id}_afb_check_status();
    	        {rdelim});
    		
    		    if($(".afb_ok").length < total_required_inputs) {ldelim}
    			    return false;
    	        {rdelim}
                
            {/if}
            
            {* Hide 'Submit' Button *}
            $('#'+ form_id +'_afb_submit_button').hide();
    
            {* Show GIF Spinning Rotator *}
            $('#'+ form_id +'_afb_ajax_loading').show();   
            
            var formData = $(this).serialize(); {* Serializes a set of input elements into a string data (example: first_name=John&last_name=Doe) *}
                    
            $.ajax( {ldelim}
                type: 'POST',
                url: afp_config.path_to_php_process_file,
                data: formData,
                                         
                success: function(response) {ldelim}
    	    
    	  	        {* Show the output from parse.php if debug is enabled *}
                    {if $c.debug eq '1'}
    		            $('#'+ form_id +'_afb_note').after('<div class="afb_debug"><strong>Debug mode</strong><br /><p>'+ response +'</p></div>');
    		        {/if}
            
                    var possible_error = 'Could not instantiate mail function.';
    
    	            if(response.search(possible_error) != '-1') {ldelim}
    	                var result = '<div class="afb_notification_error">{$c.notifications.mail_cannot_be_sent_e}<br /><br />'+ possible_error +'</div>';
    
    	                {if $c.hide_form_after_submit eq '1'}
                            $("#"+ form_id +"_afb_fields").hide();
    	                {/if}
            
                    {rdelim} else {ldelim}
            
                        try {
                            responseObj = $.parseJSON(response);
                        } catch (e) {
                            {if $c.debug eq '0'}    
                                $('#'+ form_id +'_afb_note').after('<div class="afb_debug"><p>An internal error has occured. To view it, please enable the <em>Debug</em> mode from the form\'s configuration page, then re-submit this form.</p></div>');
                            {/if}
                        }
 
    	                var status = responseObj.status;
                        var result = responseObj.status_output;
                
                        if(status == 0) {ldelim} {* Message sent *}
                        
                            {if $c.custom_thank_you.enabled eq 0}
    
                            $('#'+ form_id +'_afb_success_sent').val(1);
                            
                                {if $c.hide_form_after_submit eq '1'}
    
                                    $('#'+ form_id +'_afb_fields').hide();
    
                                {else}
                                
                                    {if $c.clear_fields_after_success_submit eq '1'}
                                    
                                        $('#{$form_id}')[0].reset();
                                        $('#{$form_id} :input:not(:hidden)').removeClass('afb_ok afb_error');
    			                        $('#{$form_id}_afb_fields label.in_field').css({ldelim}'opacity':'1'{rdelim}).show();
                                        $('#{$form_id}_afb_fields label.in_field').keypress(function() {ldelim} {$form_id}(this).css({ldelim}'opacity':'0'{rdelim}); {rdelim} );
    		                            
                                        {* Clear Attachments (if any) *}
                                        $('.files_attached_area').hide();
                                        
                                        $('a.delete_attachment').each(function(index, value) {ldelim}    
                                            var obj = $.parseJSON(this.rel);     
                    
                                            $.ajax({ldelim}
                                               type: "POST",
                                               url: "{$c.url.path_to_uploader}clear-all.php",
                                               data: "temp_dir_name="+ obj.temp_dir_name,
                                               success: function(response) {ldelim}
                                                   //alert(response); 
                                               {rdelim}
                                            {rdelim});
                                            
                                        {rdelim});                                    
                                        
                                    {/if}
                                    
    			                {/if}
                            
                            {else}
                                parent.window.location.replace("{$c.custom_thank_you.url}");
                            {/if}
                            
                            {if $c.close_ajax_form_box eq '1'}
                       
    		                    if($('#fancybox-overlay', parent.document).length > 0) {ldelim}
    		                        setTimeout('parent.$.fancybox.close()', {$c.close_ajax_form_box_time});
    		                    {rdelim}
    
    			                if (typeof parent.backgroundMask !== 'undefined') {ldelim}
    			                    if(parent.backgroundMask.is(':visible')) {ldelim}
                                        setTimeout(window.parent.doContactClose, {$c.close_ajax_form_box_time});	
                                    {rdelim}		    
    			                {rdelim}
                                
                            {/if}
                            
                        {rdelim} 
                        else if(status == 1) {ldelim} {* Were errors found? *} 
                                                   
                            {foreach from=$afb_form_fields key=afb_key item=afb_value}
    			                {if $afb_value.mandatory eq '1'} 
    		                        if(responseObj.{$afb_key}) {ldelim}
    		                            $('#{$form_id}_{$afb_key}').addClass('afb_error').removeClass('afb_ok');
    		                        {rdelim} else {ldelim}
                                        $('#{$form_id}_{$afb_key}').addClass('afb_ok').removeClass('afb_error')
    		                        {rdelim}
    				            {/if}
                            {/foreach}
                                                    
                            if(responseObj.security_code) {ldelim} 
                            
                                $('#{$form_id}_security_code').addClass('afb_error').removeClass('afb_ok');
                            
                            {rdelim} else {ldelim}
                    
                                var validCode = $('#{$form_id}_security_code').val();
    
                              $('#{$form_id}_afb_sc_error').remove();
                
                              $('#{$form_id}_security_code').blur().remove();
        					   
        					  $('#{$form_id}_afb_captcha_div').hide(); 
        					  $('#{$form_id}_afb_main_sec_div').hide(); 					  
        
                              $('#{$form_id}_afb_sec_div_two').fadeIn('fast', function() {ldelim}  
                              
                              $('#{$form_id}_place_for_security_code').html('<input class="afb_ok" type="hidden" name="security_code" id="{$form_id}_security_code" value="'+ validCode +'" />');
                                          						     
    						  {rdelim});
                					  
                                $('div').removeClass("afb_highlighted");
    					 
                            {rdelim}
    
                        {* Mail cannot be sent? *}
                        {rdelim} else if(status == 2) {ldelim}
                            {if $c.hide_form_after_submit eq '1'}
                                $("#{$form_id}_afb_fields").hide(); 
                            {/if}
                             
                        {rdelim} else {ldelim}
                            $('#'+ form_id +'_afb_note').after('<div class="afb_debug">'+ response +'</div>');
                        {rdelim}
    
                    {rdelim}
                    
                    {* Hide GIF Spinning Rotator *}
    	            $('#{$form_id}_afb_ajax_loading').hide();
    	         
    	            {* Show 'Submit' Button *}
    	            $('#{$form_id}_afb_submit_button').show();
    
    			    $('html, body').animate({ldelim}scrollTop: $("#{$form_id}_wrap").offset().top - 10{rdelim}, 500, function() {ldelim}
    			        $('#{$form_id}_afb_note').html(result).slideDown('fast', function() {ldelim}
    		                resize_frame(); 
    			        {rdelim});
    			    {rdelim});
                    
                {rdelim}
    
            {rdelim});
            
            {if $c.recaptcha.enabled}
                Recaptcha.reload();
            {/if}
            
            return false; {* prevent the form from being submitted in the classical way *}
    
        {rdelim});
        
    {/if}
    	
    {if $c.js_realtime_validator eq '1' && !$is_basic_php_form}
    {* [START RealTime Validation] *}   
    
        {foreach from=$afb_form_fields key=afb_key item=afb_value}
        
            {if $afb_value.mandatory eq '1' && !empty($afb_value.validation)}
        
                var check_{$afb_value.field_id} = function(event, show_type, is_submit) {ldelim}
                
                var forSlideStyle = (show_type == 'slide') ? 'style="display:none;"' : '';

                {* In case the 'datepicker' box is used, stop the live check of the field while the user selects the date *}

                {if $enable_datepicker && !$is_ie}
                    if($('.ui-datepicker').css('left').search('-') == -1 && $('.ui-datepicker').css('display') != 'none') {ldelim}
                       return false;
                    {rdelim}
                {/if} 

                {if is_array($afb_value.type.select) and $afb_value.attributes.multiple}

                    var total_selections_selector = $('#{$afb_value.field_id} option:selected');
                    var total_valid_selections = total_selections_selector.length;

                    $(total_selections_selector).each(function() {ldelim}
                        if($(this).val() == '') {ldelim} total_valid_selections--; {rdelim}
                    {rdelim});
                    
                    if(is_submit === undefined) {ldelim}
                        if( event.type != 'focusout' && (total_valid_selections < {$afb_value.validation.min_selections.value}) ) {ldelim}
                            $('#{$afb_value.field_id}').removeClass('afb_ok');
                            return false;
                        {rdelim}
                    {rdelim}

                {/if}


                {*
                ---------------------------------------------------------
                Handle Checkbox Validation (minimum required checkboxes)
                ---------------------------------------------------------
                *}

                {if is_array($afb_value.type.checkboxes) && $afb_value.validation.min_selections.message neq ''}

                    var {$afb_value.field_id} = $('{$afb_value.selector}');
                    var total_valid_selections = {$afb_value.field_id}.find('input[type=checkbox]:checked').length;
                
                    if(is_submit === undefined) {ldelim}
                        if(total_valid_selections < {$afb_value.validation.min_selections.value} && total_valid_selections > 0) {ldelim}
                            $('#{$afb_value.field_id}').removeClass('afb_ok');
                            return false;
                        {rdelim}
                    {rdelim}
                
                    if(total_valid_selections < {$afb_value.validation.min_selections.value}) {ldelim}
                
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error" class="afb_error">{$afb_value.validation.min_selections.message}</div>';
                
                        $('#{$afb_value.field_id}').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error').slideDown('fast');
                        {rdelim}
                
                        {$form_id}_afb_check_status();
                
                        return false;
                    
                    {rdelim}
                
                {/if} 

                {*
                ------------------------------------------------------------------------
                Handle Radio Validation (if no radio button was checked from its group)
                ------------------------------------------------------------------------
                *}

                {if is_array($afb_value.type.radios) && $afb_value.validation.basic.message neq ''}
                
                    var radios_length = $('{$afb_value.selector}').find('input[type=radio]:checked').length;
                                                                                                                                                         
                    if(radios_length == 0) {ldelim}
                                    
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error" class="afb_error">{$afb_value.validation.basic.message}</div>';
                
                        $('#{$afb_value.field_id}').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error').slideDown('fast');
                        {rdelim}
                
                
                        {$form_id}_afb_check_status();
                
                        return false;
                        
                    {rdelim}
                
                {/if}

                {*
                -------------------------------------------
                Handle Select Field (Multiple) Validation
                -------------------------------------------
                *}
                
                {if ($afb_value.validation.min_selections.value > 0) && (isSet($afb_value.attributes.multiple)) && ($afb_value.validation.min_selections.message neq '')}
                
                    if(total_valid_selections < {$afb_value.validation.min_selections.value}) {ldelim} 
                
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error_min_selections" class="afb_error">{$afb_value.validation.min_selections.message}</div>';
                
                        $('#{$afb_value.field_id}').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error_min_selections').slideDown('fast');
                        {rdelim}
                
                        {$form_id}_afb_check_status();
                
                        return false;
                    
                    {rdelim}
                
                {/if}

                {*
                ----------------------------------------------------------
                Handle Basic Validation (if nothing was entered/selected)
                ----------------------------------------------------------
                *}
           
                {if ($afb_value.validation.basic.value eq '1') && (!isSet($afb_value.attributes.multiple)) && ($afb_value.validation.basic.message neq '') && !is_array($afb_value.type.radios)}
                
                    if($('{$afb_value.selector}').val() == '') {ldelim}
                
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                    
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error" class="afb_error">{$afb_value.validation.basic.message}</div>';
                    
                        $('#{$afb_value.field_id}').removeClass('afb_ok').{$afb_value.toNext}after(afterField); 
                    
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error').slideDown('fast');
                        {rdelim}
                    
                        {$form_id}_afb_check_status();
                    
                        return false;
                    
                    {rdelim}
                
                {/if} 

                {*
                -----------------------------------------------------
                Handle Numeric Validation (if the input is a number)
                -----------------------------------------------------
                *}
                                
                {if $afb_value.validation.numeric.value eq '1' && $afb_value.validation.numeric.message neq ''}
                                    
                    if( ! jQuery.isNumeric($('{$afb_value.selector}').val()) ) {ldelim}
                
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                    
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error" class="afb_error">{$afb_value.validation.numeric.message}</div>';
                    
                        $('#{$afb_value.field_id}').removeClass('afb_ok').{$afb_value.toNext}after(afterField); 
                    
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error').slideDown('fast');
                        {rdelim}
                    
                        {$form_id}_afb_check_status();
                    
                        return false;
                    
                    {rdelim}
                
                {/if} 

                {* 
                ---------------------------------------------------------------------
                Handle E-Mail Validation (if it's according to the standards or not)
                ---------------------------------------------------------------------
                *}
                
                {if $afb_value.validation.email.value eq '1' && $afb_value.validation.email.message neq ''}
                
                    {literal} var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i; {/literal}
                
                    if (!filter.test($('{$afb_value.selector}').val())) {ldelim}
                
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error_invalid" class="afb_error">{$afb_value.validation.email.message}</div>';
                
                        $('#{$afb_value.field_id}').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error_invalid').slideDown('fast');
                        {rdelim}
                
                        {$form_id}_afb_check_status();
                
                        return false;
                        
                    {rdelim}
                
                {/if}

                {* 
                ---------------------------------------------------------------------
                Handle Phone Validation (based on its format)
                ---------------------------------------------------------------------
                *}
                
                {if $afb_value.validation.phone.value && ($afb_value.validation.phone.message neq '')}
                
                    var valid_phone = 0;
                    var phone_number_formats = {$afb_value.validation.phone.formats};
                    
                    var to_search = $('{$afb_value.selector}').val().replace(/#/g, '')
                                                                    .replace(/[0-9]/g, "#")
                                                                    .replace(/^\s*|\s*$/,"");
                                        
                         //alert(to_search);
                                             
                    for (var i=0, len=phone_number_formats.length; i < len; ++i) {ldelim}                                                  
                        if(phone_number_formats[i] == to_search) {ldelim}
                            valid_phone = 1;
                            break;
                        {rdelim}                 
                    {rdelim}
                    
                    
                    if(valid_phone == 0) {ldelim} 
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error_invalid" class="afb_error">{$afb_value.validation.phone.message}</div>';
                
                        $('#{$afb_value.field_id}').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error_invalid').slideDown('fast');
                        {rdelim}
                
                        {$form_id}_afb_check_status();
                
                        return false;  
                    {rdelim}      
                              
                {/if}
                
                {*  
                ----------------------------------------------------------------------------------------
                Handle Minimum Characters Validation (the minimum characters a field value should have)
                ----------------------------------------------------------------------------------------
                *}
                
                {if $afb_value.validation.min_chars.value > 0 && $afb_value.validation.min_chars.message neq ''}
                
                    if($('{$afb_value.selector}').val().length < {$afb_value.validation.min_chars.value}) {ldelim} {* if the message's legth is less than [min] characters *}
                
                        remove_errors('{$afb_value.field_id}', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="{$afb_value.field_id}_error_min_chars" class="afb_error">{$afb_value.validation.min_chars.message}</div>';
                
                        $('#{$afb_value.field_id}').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {ldelim}
                            $('#{$afb_value.field_id}_error_min_chars').slideDown('fast');
                        {rdelim}
                
                        {$form_id}_afb_check_status();
                
                        return false;
                    {rdelim}
                
                {/if}

                {* 
                ------------------------------------------------------
                Is the Form Element Validated? Remove the errors ;-)
                ------------------------------------------------------
                *}
                
                else {ldelim}
                    remove_errors('{$afb_value.field_id}');
                
                    $('#{$afb_value.field_id}').removeClass('afb_error').addClass('afb_ok');
                
                    {$form_id}_afb_check_status();
                {rdelim}
                
                {rdelim};
                
                
                    $('#{$afb_value.field_id}').bind('change focusout', function(event) {ldelim} 
                
                        check_{$afb_value.field_id}(event, '{$c.errors_effect}'); 
                
                        {$form_id}_afb_check_status();
                    
                    {rdelim});
                
                    $('#{$afb_value.field_id}').bind('blur', function(event) {ldelim}
                
                        if($('#{$afb_value.field_id}').val()) {ldelim} 
                            check_{$afb_value.field_id}(event, '{$c.errors_effect}'); 
                        {rdelim} 
                
                        {$form_id}_afb_check_status();
                        
                        return false;
                       
                    {rdelim});                                        
            {/if}
        {/foreach}
        
        {if $c.attachments.enabled eq '1' && $c.attachments.mandatory eq '1'}
        
        {* 
        -------------------------------------------------
        Validate Attachment (if it is set as mandatory)
        -------------------------------------------------
        *}
        
        var check_{$form_id}_attachment = function(show_type) {ldelim}
            var forSlideStyle = (show_type == 'slide') ? 'style="display:none;"' : '';
            
            {* No file attached? *}
            if($('.attach_for_{$form_id}').length == 0) {ldelim}
                remove_errors('{$form_id}_attachment', 'no_slide');
                
                var afterField = '<div '+ forSlideStyle +' id="{$form_id}_attachment_error_no_upload" class="afb_error">{$c.attachments.errors.no_upload}</div>';
                
                $('#{$form_id}_attachment_area').after(afterField).removeClass('afb_ok'); 
                
                if(forSlideStyle) {ldelim}              
                    $('#{$form_id}_attachment_error_no_upload').slideDown('fast');
                {rdelim}
                
            {rdelim}
            
            {* User should upload a minimum number of files *}
            else if($('.attach_for_{$form_id}').length < {$c.attachments.minimum_files}) {ldelim}
                remove_errors('{$form_id}_attachment', 'no_slide');
                
                var afterField = '<div '+ forSlideStyle +' id="{$form_id}_attachment_error_min_files" class="afb_error">{$c.attachments.errors.minimum_files}</div>';
                
                $('#{$form_id}_attachment_area').after(afterField).removeClass('afb_ok'); 
                
                if(forSlideStyle) {ldelim}              
                    $('#{$form_id}_attachment_error_min_files').slideDown('fast');
                {rdelim}
                
            {rdelim} 
            
            else {ldelim}
            
                $('#{$form_id}_attachment_area').addClass('afb_ok');
            
                remove_errors('{$form_id}_attachment');
                {$form_id}_afb_check_status();
                    
                {rdelim}            
            
            {$form_id}_afb_check_status();
            
            return false;
            
        {rdelim};
        
        {/if}
        
        
        {if $c.captcha.enabled eq '1'}
        {*
        -----------------
        Security Code
        -----------------
        *}
        
        var check_{$form_id}_security_code = function(show_type) {ldelim}
        
        var forSlideStyle = (show_type == 'slide') ? 'style="display:none;"' : '';
        
        if ($('#{$form_id}_afb_captcha_div').is(':visible')) {ldelim}
        
            $('#{$form_id}_afb_sc_error').remove();
            
            if($('#{$form_id}_security_code').val() == '') {ldelim}
            
                remove_errors('{$form_id}_security_code', 'no_slide');
                
                
                var afterField = '<div '+ forSlideStyle +' id="{$form_id}_afb_sc_error" class="afb_error">{$c.notifications.security_code_e}</div>';
                
                $('#{$form_id}_afb_captcha_div').after(afterField); 
                
                
                if(forSlideStyle) {ldelim}              
                    $('#{$form_id}_afb_sc_error').slideDown('fast');
                {rdelim}
                
                {$form_id}_afb_check_status();
                
            {rdelim} else {ldelim}
            
                var c_currentTime = new Date();
                var c_miliseconds = c_currentTime.getTime();
                
                var validCode = $('#{$form_id}_security_code').val();
        
                /* [Start] AJAX Call */
                                
                $.ajax({ldelim} url: afp_config.path_to_script + 'verify-code.php?form_id={$form_id}&x='+ c_miliseconds, 
                	     data: "security_code="+ validCode,
                	     type: 'post', 
                	     datatype: 'html', 
                	     success: function(outData) {ldelim} 
                
                                    //alert(outData);
                
                	      	          if(outData != 1) {ldelim}
                
                	      	            if($("#{$form_id}_afb_sc_error.afb_error").length == 0) {ldelim}
                
                	      	                $('#{$form_id}_security_code').addClass('afb_error').removeClass('afb_ok');
                
                							if(show_type == 'none') {ldelim}
                	      	                
                							    $('#{$form_id}_afb_captcha_div').after('<div id="{$form_id}_afb_sc_error" class="afb_error">{$c.notifications.security_code_i_e}</div>');
                							
                							{rdelim} else if(show_type == 'slide') {ldelim}
                							
                 							    $('#{$form_id}_afb_captcha_div').after('<div style="display:none;" id="{$form_id}_afb_sc_error" class="afb_error">{$c.notifications.security_code_i_e}</div>');      
                							    $('#{$form_id}_afb_sc_error').slideDown('fast');
                
                							{rdelim}
                
                							    {$form_id}_afb_check_status();
                	      	            {rdelim}
                
                	      	          {rdelim} else {ldelim}
                
                                          $('#{$form_id}_security_code').blur().remove();
                
                					      $('#{$form_id}_afb_captcha_div').hide(); 
                					      $('#{$form_id}_afb_main_sec_div').hide(); 
                
                                          $('#{$form_id}_afb_sec_div_two').fadeIn('fast', function() {ldelim} 
                					      $('#{$form_id}_place_for_security_code').html('<input class="afb_ok" type="hidden" name="security_code" id="{$form_id}_security_code" value="'+ validCode +'" />'); 
							      
							      
                					  
							{rdelim});
                					  
                				  {rdelim}
                					  
                		      {rdelim}, 
                
                {literal}	     
                
                error: function(errorMsg) { alert('Error occured: ' + errorMsg); }});
                
                /* [End] AJAX Call */
                
                }
                
                }
                
                return false;
                
                };
                
                {/literal}
        
            var check_{$form_id}_SecurityCodeLive = function() {ldelim}
            
            var c_currentTime = new Date();
            var c_miliseconds = c_currentTime.getTime();
            
            var validCode = $('#{$form_id}_security_code').val();
            
            /* [Start] AJAX Call */
            
            $.ajax({ldelim} url: afp_config.path_to_script + 'verify-code.php?form_id={$form_id}&x='+ c_miliseconds, 
            	     data: "security_code="+ validCode,
            	     type: 'post', 
            	     datatype: 'html', 
            	     success: function(outData) {ldelim} 
            
            	      	          if(outData == 1) {ldelim} 
            
            					  $('#{$form_id}_afb_sc_error').remove();
            
                                  $('#{$form_id}_security_code').blur().remove();
            					   
            					  $('#{$form_id}_afb_captcha_div').hide(); 
            					  $('#{$form_id}_afb_main_sec_div').hide(); 					  
            
                                  $('#{$form_id}_afb_sec_div_two').fadeIn('fast', function() {ldelim}  
                                  
                                  $('#{$form_id}_place_for_security_code').html('<input class="afb_ok" type="hidden" name="security_code" id="{$form_id}_security_code" value="'+ validCode +'" />');
                                              						     
						  {rdelim});
            					  
            					  $('div').removeClass("afb_highlighted");
            
            					  {$form_id}_afb_check_status();                                                        
            {literal}
            					  }
            					  
            		              }, 
            
            
            	     error: function(errorMsg) { alert('Error occured: ' + errorMsg); }});
            
            /* [End] AJAX Call */
            
            };
            
            {/literal}
            
            var check_{$form_id}_SecurityCodeIfNotNULL = function() {ldelim}
            if($('#{$form_id}_security_code').val()) {ldelim} check_{$form_id}_security_code('{$c.errors_effect}'); {rdelim}
            {rdelim};
            
            $('#{$form_id}_security_code').bind('change', function() {ldelim} check_{$form_id}_security_code('{$c.errors_effect}'); {rdelim});
            $('#{$form_id}_security_code').blur(check_{$form_id}_SecurityCodeIfNotNULL);
            $('#{$form_id}_security_code').keyup(check_{$form_id}_SecurityCodeLive);
            
            {/if}
            
            $('#{$form_id} :input.required').bind('change blur keyup', {$form_id}_afb_check_status);
            
    {* [END RealTime Validation] *}
    {/if}
    
    
    {if $c.captcha.enabled eq '1'}
        $('#{$form_id}_afb_captcha_refresh').bind('click', function() {ldelim}
        
        var c_currentTime = new Date();
        var c_miliseconds = c_currentTime.getTime();
        
        document.getElementById('{$form_id}_afb_captcha').src = afp_config.path_to_script + 'captcha.php?x='+ c_miliseconds +'&form_id={$form_id}';
        $('#{$form_id}_security_code').val('');
        
        return false;
        {rdelim});
        
        {* Show the 'Refresh' Icon: This will work if JavaScript is enabled! *}
        $('#{$form_id}_afb_captcha_refresh').show();
    {/if}
    
    {* [START] Highlight Fieldzone Area on Focus *}
    {if $c.highlight_field_zone eq '1'}
        {foreach from=$all_fields key=key item=value}
            {if $value.field_id == '{$form_id}_security_code'}
                $('#{$form_id}_security_code').focusin(function() {ldelim} $(this).closest('div.wrap').addClass("afb_highlighted"); {rdelim}).focusout(function() {ldelim} $(this).closest('div.wrap').removeClass("afb_highlighted"); {rdelim});
            {elseif $value.validation.checkbox eq '1' || $value.validation.radio eq '1'}
                $('#{$value.field_id} ul li :input').focusin(function() {ldelim} $('#{$value.field_id}').closest('div.wrap').addClass("afb_highlighted"); {rdelim}).focusout(function() {ldelim} $('#{$value.field_id}').closest('div.wrap').removeClass("afb_highlighted"); {rdelim});
            {else}
                $('#{$value.field_id}').focusin(function() {ldelim} $(this).closest('div.wrap').addClass("afb_highlighted"); {rdelim}).focusout(function() {ldelim} $(this).closest('div.wrap').removeClass("afb_highlighted"); {rdelim});
            {/if}
        {/foreach}
    {/if}
    {* [END] Highlight Fieldzone Area on Focus *}
    
    try {ldelim}
    
        if(typeof(parent.document.getElementById("load_afp_page_{$form_id}")) !== 'undefined' && parent.document.getElementById("load_afp_page_{$form_id}") != null) {ldelim}
        
            if(typeof(parent.document.getElementById("block_code_{$form_id}")) !== 'undefined' && parent.document.getElementById("block_code_{$form_id}") != null) {ldelim}
            
                var form_area = $("#{$form_id}_wrap").parent('div');
                var form_area_height = form_area.height();
                var form_area_width = form_area.width();
                                
                var iframe_html_code = parent.document.getElementById("block_code_{$form_id}").innerHTML;
                
                var new_iframe_html_code = iframe_html_code.replace('height="100%"', 'height="'+ form_area_height +'"').replace('width="100%"', 'width="'+ form_area_width +'"');
                    
                $("#block_code_{$form_id}", parent.document.body).html(new_iframe_html_code);
    
                {rdelim}
                
            {rdelim}
            
    {rdelim} catch(e) {ldelim} {rdelim}

        {foreach from=$afb_form_fields key=afb_key item=afb_value}
            {if is_array($afb_value.type.select) && $afb_value.child_id neq ''}
            
                $('#{$form_id}_{$afb_key}').bind('change keyup fill', function() {
                    var post_data_to_send = 'option_value='+ $(this).val() +'&field_id={$afb_value.field_db_id}';
                    //alert(post_data_to_send);
                    
                    try {
                        if(post_data.{$afb_value.child_id}) {
                            post_data_to_send = post_data_to_send + '&selected_child_id='+ post_data.{$afb_value.child_id};
                        }    
                    } catch(e) {}                  
              
                    // Disable the parent field until the child field loads
                    $(this).attr('disabled', true);
                    
                    $('#{$form_id}_{$afb_value.child_id}').hide().after('<div class="loading_spinner" style="margin: 10px 0;"><img src="'+ afp_config.path_to_images + 'icon-ajax-loader.gif" width="16" height="16" />&nbsp;Loading...</div>');
                    
                    $.ajax({
                        type: 'post',
                        url: afp_config.path_to_script + 'includes/get/child-field-options.php',
                        data: post_data_to_send,
                        success: function(response) {
                            $('#{$form_id}_{$afb_value.child_id}').show().html(response).trigger('fill').next('div').remove();
                            $('.loading_spinner').remove(); // make sure there is no spinner left after the drop-down fills
                            
                            {if !$is_basic_php_form}
                                {$form_id}_afb_check_status();
                            {/if}
                                                        
                            $('#{$form_id}_{$afb_key}').attr('disabled', false);   
                        }
                    });             
                }).trigger('fill');   
                 
            {/if}
        {/foreach}

{rdelim});

    function do_resize_iframe() {ldelim}
    
        var parentIframe = parent.document.getElementById("{$form_id}_afp_frame");
        var resizeTo = $("body").height() + 35;
                 
        parentIframe.height = resizeTo; 
        
    {rdelim}
    
    function resize_frame(timing) {ldelim}
    
        try {ldelim}
             
            if(typeof(parent.document.getElementById("{$form_id}_afp_frame")) !== 'undefined' && parent.document.getElementById("{$form_id}_afp_frame") != null) {ldelim}
                if (typeof timing == 'undefined') {ldelim} timing = '500'; {rdelim} 
                setTimeout(do_resize_iframe, timing);
            {rdelim}
        
        {rdelim} catch(e) {ldelim} {rdelim}
        
    {rdelim}

function {$form_id}_afb_check_status() {ldelim}

    {* Necessary if the form was reseted *}
    
    if($('#{$form_id}_afb_success_sent').val() == 1) {ldelim} 
          $('#{$form_id}_afb_note').slideUp('slow');
    	  
          $('#{$form_id}_afb_note').html('');
    
          $('#{$form_id}_afb_success_sent').val(0); 
    	  return true; 
    {rdelim} 
    
    if($("div.afb_error").length > 0) {ldelim} 
    
    	{* Show the top notice error *}
    	$('#{$form_id}_afb_note').html('<div class="afb_notification_error">{$c.notifications.correct_errors_e}</div>').{if $c.errors_effect eq 'slide'}slideDown('slow'){else}show(){/if};
    
    {rdelim}
    
    if($("div.afb_error").length == 0) {ldelim} 
    	$('#{$form_id}_afb_note').{if $c.errors_effect eq 'slide'}slideUp('slow'){else}hide(){/if}; {* Hide the top notice error using a 'slide' effect (if necessary) *}
    {rdelim}
    
    resize_frame();
    
    return true;
{rdelim};


function remove_errors(keyField, mode) {ldelim}
    
    var selector = $('div[id^="'+ keyField +'_error"]');
    
    if(mode == 'no_slide') {ldelim}
        selector.remove();
    {rdelim} else {ldelim}
        selector.{if $c.errors_effect eq 'slide'}slideUp('fast', function() {ldelim} $(this).remove();{rdelim});{else}remove();{/if}
    {rdelim}
{rdelim}

{* Preload Icons
   This way they will show instantly without waiting for the browser to load them (for instance the 'ajax loading spinner') *}

img1 = new Image(18, 15);
img1.src = afp_config.path_to_images + 'icon-ajax-loader.gif';

img2 = new Image(22, 22);
img2.src = afp_config.path_to_images + 'icon-dialog-error.png';

img3 = new Image(22, 22);
img3.src = afp_config.path_to_images + 'icon-button-ok.png';