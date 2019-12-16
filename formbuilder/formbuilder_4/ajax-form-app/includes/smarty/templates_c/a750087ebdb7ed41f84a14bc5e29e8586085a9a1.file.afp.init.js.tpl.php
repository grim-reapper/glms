<?php /* Smarty version Smarty-3.1.7, created on 2012-12-27 10:00:49
         compiled from "D:\xampp\htdocs\formbuilder_4\ajax-form-app\templates\js\afp.init.js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:222650dc0e4119abb7-17911534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a750087ebdb7ed41f84a14bc5e29e8586085a9a1' => 
    array (
      0 => 'D:\\xampp\\htdocs\\formbuilder_4\\ajax-form-app\\templates\\js\\afp.init.js.tpl',
      1 => 1352009082,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '222650dc0e4119abb7-17911534',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total_required_inputs' => 0,
    'form_id' => 0,
    'is_basic_php_form' => 0,
    'c' => 0,
    'afb_form_fields' => 0,
    'afb_value' => 0,
    'afb_key' => 0,
    'enable_datepicker' => 0,
    'is_ie' => 0,
    'all_fields' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50dc0e421e69f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc0e421e69f')) {function content_50dc0e421e69f($_smarty_tpl) {?>
jQuery(document).ready(function($) {
    
    resize_frame();    

    
    var total_required_inputs = <?php echo $_smarty_tpl->tpl_vars['total_required_inputs']->value;?>
; 
    
    
    
    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_submit_button').before('<div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_place_for_security_code"></div>');
    
    
    <?php if (!$_smarty_tpl->tpl_vars['is_basic_php_form']->value){?>
    
        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
').submit(function() {
                    
            var form_id = $(this).attr("id");
        
            
            <?php if ($_smarty_tpl->tpl_vars['c']->value['js_realtime_validator']=='1'){?>	
        	
                <?php  $_smarty_tpl->tpl_vars['afb_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['afb_value']->_loop = false;
 $_smarty_tpl->tpl_vars['afb_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['afb_form_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['afb_value']->key => $_smarty_tpl->tpl_vars['afb_value']->value){
$_smarty_tpl->tpl_vars['afb_value']->_loop = true;
 $_smarty_tpl->tpl_vars['afb_key']->value = $_smarty_tpl->tpl_vars['afb_value']->key;
?>
                    <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['mandatory']=='1'&&!empty($_smarty_tpl->tpl_vars['afb_value']->value['validation'])){?>
                        check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_key']->value;?>
('', 'none', '1');
                    <?php }?>
                <?php } ?>
    
    	    <?php if ($_smarty_tpl->tpl_vars['c']->value['captcha']['enabled']=='1'){?>        
    		check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code('<?php echo $_smarty_tpl->tpl_vars['c']->value['errors_effect'];?>
');
    	    <?php }?>
                
                <?php if ($_smarty_tpl->tpl_vars['c']->value['attachments']['enabled']=='1'&&$_smarty_tpl->tpl_vars['c']->value['attachments']['mandatory']=='1'){?>
                    check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment('<?php echo $_smarty_tpl->tpl_vars['c']->value['errors_effect'];?>
');
                <?php }?>
                
                $('html, body').animate({ scrollTop:$("#"+ form_id + "_wrap").offset().top - 10}, 500, function() {
                    <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
    	        });
    		
    		    if($(".afb_ok").length < total_required_inputs) {
    			    return false;
    	        }
                
            <?php }?>
            
            
            $('#'+ form_id +'_afb_submit_button').hide();
    
            
            $('#'+ form_id +'_afb_ajax_loading').show();   
            
            var formData = $(this).serialize(); 
                    
            $.ajax( {
                type: 'POST',
                url: afp_config.path_to_php_process_file,
                data: formData,
                                         
                success: function(response) {
    	    
    	  	        
                    <?php if ($_smarty_tpl->tpl_vars['c']->value['debug']=='1'){?>
    		            $('#'+ form_id +'_afb_note').after('<div class="afb_debug"><strong>Debug mode</strong><br /><p>'+ response +'</p></div>');
    		        <?php }?>
            
                    var possible_error = 'Could not instantiate mail function.';
    
    	            if(response.search(possible_error) != '-1') {
    	                var result = '<div class="afb_notification_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['notifications']['mail_cannot_be_sent_e'];?>
<br /><br />'+ possible_error +'</div>';
    
    	                <?php if ($_smarty_tpl->tpl_vars['c']->value['hide_form_after_submit']=='1'){?>
                            $("#"+ form_id +"_afb_fields").hide();
    	                <?php }?>
            
                    } else {
            
                        try {
                            responseObj = $.parseJSON(response);
                        } catch (e) {
                            <?php if ($_smarty_tpl->tpl_vars['c']->value['debug']=='0'){?>    
                                $('#'+ form_id +'_afb_note').after('<div class="afb_debug"><p>An internal error has occured. To view it, please enable the <em>Debug</em> mode from the form\'s configuration page, then re-submit this form.</p></div>');
                            <?php }?>
                        }
 
    	                var status = responseObj.status;
                        var result = responseObj.status_output;
                
                        if(status == 0) { 
                        
                            <?php if ($_smarty_tpl->tpl_vars['c']->value['custom_thank_you']['enabled']==0){?>
    
                            $('#'+ form_id +'_afb_success_sent').val(1);
                            
                                <?php if ($_smarty_tpl->tpl_vars['c']->value['hide_form_after_submit']=='1'){?>
    
                                    $('#'+ form_id +'_afb_fields').hide();
    
                                <?php }else{ ?>
                                
                                    <?php if ($_smarty_tpl->tpl_vars['c']->value['clear_fields_after_success_submit']=='1'){?>
                                    
                                        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
')[0].reset();
                                        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
 :input:not(:hidden)').removeClass('afb_ok afb_error');
    			                        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_fields label.in_field').css({'opacity':'1'}).show();
                                        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_fields label.in_field').keypress(function() { <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
(this).css({'opacity':'0'}); } );
    		                            
                                        
                                        $('.files_attached_area').hide();
                                        
                                        $('a.delete_attachment').each(function(index, value) {    
                                            var obj = $.parseJSON(this.rel);     
                    
                                            $.ajax({
                                               type: "POST",
                                               url: "<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_uploader'];?>
clear-all.php",
                                               data: "temp_dir_name="+ obj.temp_dir_name,
                                               success: function(response) {
                                                   //alert(response); 
                                               }
                                            });
                                            
                                        });                                    
                                        
                                    <?php }?>
                                    
    			                <?php }?>
                            
                            <?php }else{ ?>
                                parent.window.location.replace("<?php echo $_smarty_tpl->tpl_vars['c']->value['custom_thank_you']['url'];?>
");
                            <?php }?>
                            
                            <?php if ($_smarty_tpl->tpl_vars['c']->value['close_ajax_form_box']=='1'){?>
                       
    		                    if($('#fancybox-overlay', parent.document).length > 0) {
    		                        setTimeout('parent.$.fancybox.close()', <?php echo $_smarty_tpl->tpl_vars['c']->value['close_ajax_form_box_time'];?>
);
    		                    }
    
    			                if (typeof parent.backgroundMask !== 'undefined') {
    			                    if(parent.backgroundMask.is(':visible')) {
                                        setTimeout(window.parent.doContactClose, <?php echo $_smarty_tpl->tpl_vars['c']->value['close_ajax_form_box_time'];?>
);	
                                    }		    
    			                }
                                
                            <?php }?>
                            
                        } 
                        else if(status == 1) {  
                                                   
                            <?php  $_smarty_tpl->tpl_vars['afb_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['afb_value']->_loop = false;
 $_smarty_tpl->tpl_vars['afb_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['afb_form_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['afb_value']->key => $_smarty_tpl->tpl_vars['afb_value']->value){
$_smarty_tpl->tpl_vars['afb_value']->_loop = true;
 $_smarty_tpl->tpl_vars['afb_key']->value = $_smarty_tpl->tpl_vars['afb_value']->key;
?>
    			                <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['mandatory']=='1'){?> 
    		                        if(responseObj.<?php echo $_smarty_tpl->tpl_vars['afb_key']->value;?>
) {
    		                            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_key']->value;?>
').addClass('afb_error').removeClass('afb_ok');
    		                        } else {
                                        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_key']->value;?>
').addClass('afb_ok').removeClass('afb_error')
    		                        }
    				            <?php }?>
                            <?php } ?>
                                                    
                            if(responseObj.security_code) { 
                            
                                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').addClass('afb_error').removeClass('afb_ok');
                            
                            } else {
                    
                                var validCode = $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').val();
    
                              $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error').remove();
                
                              $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').blur().remove();
        					   
        					  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').hide(); 
        					  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_main_sec_div').hide(); 					  
        
                              $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sec_div_two').fadeIn('fast', function() {  
                              
                              $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_place_for_security_code').html('<input class="afb_ok" type="hidden" name="security_code" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code" value="'+ validCode +'" />');
                                          						     
    						  });
                					  
                                $('div').removeClass("afb_highlighted");
    					 
                            }
    
                        
                        } else if(status == 2) {
                            <?php if ($_smarty_tpl->tpl_vars['c']->value['hide_form_after_submit']=='1'){?>
                                $("#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_fields").hide(); 
                            <?php }?>
                             
                        } else {
                            $('#'+ form_id +'_afb_note').after('<div class="afb_debug">'+ response +'</div>');
                        }
    
                    }
                    
                    
    	            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_ajax_loading').hide();
    	         
    	            
    	            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_submit_button').show();
    
    			    $('html, body').animate({scrollTop: $("#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_wrap").offset().top - 10}, 500, function() {
    			        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_note').html(result).slideDown('fast', function() {
    		                resize_frame(); 
    			        });
    			    });
                    
                }
    
            });
            
            <?php if ($_smarty_tpl->tpl_vars['c']->value['recaptcha']['enabled']){?>
                Recaptcha.reload();
            <?php }?>
            
            return false; 
    
        });
        
    <?php }?>
    	
    <?php if ($_smarty_tpl->tpl_vars['c']->value['js_realtime_validator']=='1'&&!$_smarty_tpl->tpl_vars['is_basic_php_form']->value){?>
       
    
        <?php  $_smarty_tpl->tpl_vars['afb_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['afb_value']->_loop = false;
 $_smarty_tpl->tpl_vars['afb_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['afb_form_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['afb_value']->key => $_smarty_tpl->tpl_vars['afb_value']->value){
$_smarty_tpl->tpl_vars['afb_value']->_loop = true;
 $_smarty_tpl->tpl_vars['afb_key']->value = $_smarty_tpl->tpl_vars['afb_value']->key;
?>
        
            <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['mandatory']=='1'&&!empty($_smarty_tpl->tpl_vars['afb_value']->value['validation'])){?>
        
                var check_<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
 = function(event, show_type, is_submit) {
                
                var forSlideStyle = (show_type == 'slide') ? 'style="display:none;"' : '';

                

                <?php if ($_smarty_tpl->tpl_vars['enable_datepicker']->value&&!$_smarty_tpl->tpl_vars['is_ie']->value){?>
                    if($('.ui-datepicker').css('left').search('-') == -1 && $('.ui-datepicker').css('display') != 'none') {
                       return false;
                    }
                <?php }?> 

                <?php if (is_array($_smarty_tpl->tpl_vars['afb_value']->value['type']['select'])&&$_smarty_tpl->tpl_vars['afb_value']->value['attributes']['multiple']){?>

                    var total_selections_selector = $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
 option:selected');
                    var total_valid_selections = total_selections_selector.length;

                    $(total_selections_selector).each(function() {
                        if($(this).val() == '') { total_valid_selections--; }
                    });
                    
                    if(is_submit === undefined) {
                        if( event.type != 'focusout' && (total_valid_selections < <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['value'];?>
) ) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok');
                            return false;
                        }
                    }

                <?php }?>


                

                <?php if (is_array($_smarty_tpl->tpl_vars['afb_value']->value['type']['checkboxes'])&&$_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['message']!=''){?>

                    var <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
 = $('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
');
                    var total_valid_selections = <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
.find('input[type=checkbox]:checked').length;
                
                    if(is_submit === undefined) {
                        if(total_valid_selections < <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['value'];?>
 && total_valid_selections > 0) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok');
                            return false;
                        }
                    }
                
                    if(total_valid_selections < <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['value'];?>
) {
                
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['message'];?>
</div>';
                
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error').slideDown('fast');
                        }
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
                        return false;
                    
                    }
                
                <?php }?> 

                

                <?php if (is_array($_smarty_tpl->tpl_vars['afb_value']->value['type']['radios'])&&$_smarty_tpl->tpl_vars['afb_value']->value['validation']['basic']['message']!=''){?>
                
                    var radios_length = $('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
').find('input[type=radio]:checked').length;
                                                                                                                                                         
                    if(radios_length == 0) {
                                    
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['basic']['message'];?>
</div>';
                
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error').slideDown('fast');
                        }
                
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
                        return false;
                        
                    }
                
                <?php }?>

                
                
                <?php if (($_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['value']>0)&&(isSet($_smarty_tpl->tpl_vars['afb_value']->value['attributes']['multiple']))&&($_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['message']!='')){?>
                
                    if(total_valid_selections < <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['value'];?>
) { 
                
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_min_selections" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_selections']['message'];?>
</div>';
                
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_min_selections').slideDown('fast');
                        }
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
                        return false;
                    
                    }
                
                <?php }?>

                
           
                <?php if (($_smarty_tpl->tpl_vars['afb_value']->value['validation']['basic']['value']=='1')&&(!isSet($_smarty_tpl->tpl_vars['afb_value']->value['attributes']['multiple']))&&($_smarty_tpl->tpl_vars['afb_value']->value['validation']['basic']['message']!='')&&!is_array($_smarty_tpl->tpl_vars['afb_value']->value['type']['radios'])){?>
                
                    if($('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
').val() == '') {
                
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                    
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['basic']['message'];?>
</div>';
                    
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['toNext'];?>
after(afterField); 
                    
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error').slideDown('fast');
                        }
                    
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                    
                        return false;
                    
                    }
                
                <?php }?> 

                
                                
                <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['validation']['numeric']['value']=='1'&&$_smarty_tpl->tpl_vars['afb_value']->value['validation']['numeric']['message']!=''){?>
                                    
                    if( ! jQuery.isNumeric($('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
').val()) ) {
                
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                    
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['numeric']['message'];?>
</div>';
                    
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['toNext'];?>
after(afterField); 
                    
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error').slideDown('fast');
                        }
                    
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                    
                        return false;
                    
                    }
                
                <?php }?> 

                
                
                <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['validation']['email']['value']=='1'&&$_smarty_tpl->tpl_vars['afb_value']->value['validation']['email']['message']!=''){?>
                
                     var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i; 
                
                    if (!filter.test($('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
').val())) {
                
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_invalid" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['email']['message'];?>
</div>';
                
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_invalid').slideDown('fast');
                        }
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
                        return false;
                        
                    }
                
                <?php }?>

                
                
                <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['validation']['phone']['value']&&($_smarty_tpl->tpl_vars['afb_value']->value['validation']['phone']['message']!='')){?>
                
                    var valid_phone = 0;
                    var phone_number_formats = <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['phone']['formats'];?>
;
                    
                    var to_search = $('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
').val().replace(/#/g, '')
                                                                    .replace(/[0-9]/g, "#")
                                                                    .replace(/^\s*|\s*$/,"");
                                        
                         //alert(to_search);
                                             
                    for (var i=0, len=phone_number_formats.length; i < len; ++i) {                                                  
                        if(phone_number_formats[i] == to_search) {
                            valid_phone = 1;
                            break;
                        }                 
                    }
                    
                    
                    if(valid_phone == 0) { 
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_invalid" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['phone']['message'];?>
</div>';
                
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_invalid').slideDown('fast');
                        }
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
                        return false;  
                    }      
                              
                <?php }?>
                
                
                
                <?php if ($_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_chars']['value']>0&&$_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_chars']['message']!=''){?>
                
                    if($('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['selector'];?>
').val().length < <?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_chars']['value'];?>
) { 
                
                        remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
', 'no_slide');
                
                        var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_min_chars" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['afb_value']->value['validation']['min_chars']['message'];?>
</div>';
                
                        $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_ok').after(afterField); 
                
                        if(forSlideStyle) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
_error_min_chars').slideDown('fast');
                        }
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
                        return false;
                    }
                
                <?php }?>

                
                
                else {
                    remove_errors('<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
');
                
                    $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').removeClass('afb_error').addClass('afb_ok');
                
                    <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                }
                
                };
                
                
                    $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').bind('change focusout', function(event) { 
                
                        check_<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
(event, '<?php echo $_smarty_tpl->tpl_vars['c']->value['errors_effect'];?>
'); 
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                    
                    });
                
                    $('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').bind('blur', function(event) {
                
                        if($('#<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
').val()) { 
                            check_<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_id'];?>
(event, '<?php echo $_smarty_tpl->tpl_vars['c']->value['errors_effect'];?>
'); 
                        } 
                
                        <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                        
                        return false;
                       
                    });                                        
            <?php }?>
        <?php } ?>
        
        <?php if ($_smarty_tpl->tpl_vars['c']->value['attachments']['enabled']=='1'&&$_smarty_tpl->tpl_vars['c']->value['attachments']['mandatory']=='1'){?>
        
        
        
        var check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment = function(show_type) {
            var forSlideStyle = (show_type == 'slide') ? 'style="display:none;"' : '';
            
            
            if($('.attach_for_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
').length == 0) {
                remove_errors('<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment', 'no_slide');
                
                var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_error_no_upload" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['attachments']['errors']['no_upload'];?>
</div>';
                
                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_area').after(afterField).removeClass('afb_ok'); 
                
                if(forSlideStyle) {              
                    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_error_no_upload').slideDown('fast');
                }
                
            }
            
            
            else if($('.attach_for_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
').length < <?php echo $_smarty_tpl->tpl_vars['c']->value['attachments']['minimum_files'];?>
) {
                remove_errors('<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment', 'no_slide');
                
                var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_error_min_files" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['attachments']['errors']['minimum_files'];?>
</div>';
                
                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_area').after(afterField).removeClass('afb_ok'); 
                
                if(forSlideStyle) {              
                    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_error_min_files').slideDown('fast');
                }
                
            } 
            
            else {
            
                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment_area').addClass('afb_ok');
            
                remove_errors('<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment');
                <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                    
                }            
            
            <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
            
            return false;
            
        };
        
        <?php }?>
        
        
        <?php if ($_smarty_tpl->tpl_vars['c']->value['captcha']['enabled']=='1'){?>
        
        
        var check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code = function(show_type) {
        
        var forSlideStyle = (show_type == 'slide') ? 'style="display:none;"' : '';
        
        if ($('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').is(':visible')) {
        
            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error').remove();
            
            if($('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').val() == '') {
            
                remove_errors('<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code', 'no_slide');
                
                
                var afterField = '<div '+ forSlideStyle +' id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['notifications']['security_code_e'];?>
</div>';
                
                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').after(afterField); 
                
                
                if(forSlideStyle) {              
                    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error').slideDown('fast');
                }
                
                <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                
            } else {
            
                var c_currentTime = new Date();
                var c_miliseconds = c_currentTime.getTime();
                
                var validCode = $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').val();
        
                /* [Start] AJAX Call */
                                
                $.ajax({ url: afp_config.path_to_script + 'verify-code.php?form_id=<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
&x='+ c_miliseconds, 
                	     data: "security_code="+ validCode,
                	     type: 'post', 
                	     datatype: 'html', 
                	     success: function(outData) { 
                
                                    //alert(outData);
                
                	      	          if(outData != 1) {
                
                	      	            if($("#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error.afb_error").length == 0) {
                
                	      	                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').addClass('afb_error').removeClass('afb_ok');
                
                							if(show_type == 'none') {
                	      	                
                							    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').after('<div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['notifications']['security_code_i_e'];?>
</div>');
                							
                							} else if(show_type == 'slide') {
                							
                 							    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').after('<div style="display:none;" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error" class="afb_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['notifications']['security_code_i_e'];?>
</div>');      
                							    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error').slideDown('fast');
                
                							}
                
                							    <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                	      	            }
                
                	      	          } else {
                
                                          $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').blur().remove();
                
                					      $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').hide(); 
                					      $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_main_sec_div').hide(); 
                
                                          $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sec_div_two').fadeIn('fast', function() { 
                					      $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_place_for_security_code').html('<input class="afb_ok" type="hidden" name="security_code" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code" value="'+ validCode +'" />'); 
							      
							      
                					  
							});
                					  
                				  }
                					  
                		      }, 
                
                	     
                
                error: function(errorMsg) { alert('Error occured: ' + errorMsg); }});
                
                /* [End] AJAX Call */
                
                }
                
                }
                
                return false;
                
                };
                
                
        
            var check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_SecurityCodeLive = function() {
            
            var c_currentTime = new Date();
            var c_miliseconds = c_currentTime.getTime();
            
            var validCode = $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').val();
            
            /* [Start] AJAX Call */
            
            $.ajax({ url: afp_config.path_to_script + 'verify-code.php?form_id=<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
&x='+ c_miliseconds, 
            	     data: "security_code="+ validCode,
            	     type: 'post', 
            	     datatype: 'html', 
            	     success: function(outData) { 
            
            	      	          if(outData == 1) { 
            
            					  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sc_error').remove();
            
                                  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').blur().remove();
            					   
            					  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div').hide(); 
            					  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_main_sec_div').hide(); 					  
            
                                  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sec_div_two').fadeIn('fast', function() {  
                                  
                                  $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_place_for_security_code').html('<input class="afb_ok" type="hidden" name="security_code" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code" value="'+ validCode +'" />');
                                              						     
						  });
            					  
            					  $('div').removeClass("afb_highlighted");
            
            					  <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();                                                        
            
            					  }
            					  
            		              }, 
            
            
            	     error: function(errorMsg) { alert('Error occured: ' + errorMsg); }});
            
            /* [End] AJAX Call */
            
            };
            
            
            
            var check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_SecurityCodeIfNotNULL = function() {
            if($('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').val()) { check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code('<?php echo $_smarty_tpl->tpl_vars['c']->value['errors_effect'];?>
'); }
            };
            
            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').bind('change', function() { check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code('<?php echo $_smarty_tpl->tpl_vars['c']->value['errors_effect'];?>
'); });
            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').blur(check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_SecurityCodeIfNotNULL);
            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').keyup(check_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_SecurityCodeLive);
            
            <?php }?>
            
            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
 :input.required').bind('change blur keyup', <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status);
            
    
    <?php }?>
    
    
    <?php if ($_smarty_tpl->tpl_vars['c']->value['captcha']['enabled']=='1'){?>
        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_refresh').bind('click', function() {
        
        var c_currentTime = new Date();
        var c_miliseconds = c_currentTime.getTime();
        
        document.getElementById('<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha').src = afp_config.path_to_script + 'captcha.php?x='+ c_miliseconds +'&form_id=<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
';
        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').val('');
        
        return false;
        });
        
        
        $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_refresh').show();
    <?php }?>
    
    
    <?php if ($_smarty_tpl->tpl_vars['c']->value['highlight_field_zone']=='1'){?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['all_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['value']->value['field_id']=='{$form_id}_security_code'){?>
                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code').focusin(function() { $(this).closest('div.wrap').addClass("afb_highlighted"); }).focusout(function() { $(this).closest('div.wrap').removeClass("afb_highlighted"); });
            <?php }elseif($_smarty_tpl->tpl_vars['value']->value['validation']['checkbox']=='1'||$_smarty_tpl->tpl_vars['value']->value['validation']['radio']=='1'){?>
                $('#<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
 ul li :input').focusin(function() { $('#<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
').closest('div.wrap').addClass("afb_highlighted"); }).focusout(function() { $('#<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
').closest('div.wrap').removeClass("afb_highlighted"); });
            <?php }else{ ?>
                $('#<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
').focusin(function() { $(this).closest('div.wrap').addClass("afb_highlighted"); }).focusout(function() { $(this).closest('div.wrap').removeClass("afb_highlighted"); });
            <?php }?>
        <?php } ?>
    <?php }?>
    
    
    try {
    
        if(typeof(parent.document.getElementById("load_afp_page_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
")) !== 'undefined' && parent.document.getElementById("load_afp_page_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
") != null) {
        
            if(typeof(parent.document.getElementById("block_code_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
")) !== 'undefined' && parent.document.getElementById("block_code_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
") != null) {
            
                var form_area = $("#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_wrap").parent('div');
                var form_area_height = form_area.height();
                var form_area_width = form_area.width();
                                
                var iframe_html_code = parent.document.getElementById("block_code_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
").innerHTML;
                
                var new_iframe_html_code = iframe_html_code.replace('height="100%"', 'height="'+ form_area_height +'"').replace('width="100%"', 'width="'+ form_area_width +'"');
                    
                $("#block_code_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
", parent.document.body).html(new_iframe_html_code);
    
                }
                
            }
            
    } catch(e) { }

        <?php  $_smarty_tpl->tpl_vars['afb_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['afb_value']->_loop = false;
 $_smarty_tpl->tpl_vars['afb_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['afb_form_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['afb_value']->key => $_smarty_tpl->tpl_vars['afb_value']->value){
$_smarty_tpl->tpl_vars['afb_value']->_loop = true;
 $_smarty_tpl->tpl_vars['afb_key']->value = $_smarty_tpl->tpl_vars['afb_value']->key;
?>
            <?php if (is_array($_smarty_tpl->tpl_vars['afb_value']->value['type']['select'])&&$_smarty_tpl->tpl_vars['afb_value']->value['child_id']!=''){?>
            
                $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_key']->value;?>
').bind('change keyup fill', function() {
                    var post_data_to_send = 'option_value='+ $(this).val() +'&field_id=<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['field_db_id'];?>
';
                    //alert(post_data_to_send);
                    
                    try {
                        if(post_data.<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['child_id'];?>
) {
                            post_data_to_send = post_data_to_send + '&selected_child_id='+ post_data.<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['child_id'];?>
;
                        }    
                    } catch(e) {}                  
              
                    // Disable the parent field until the child field loads
                    $(this).attr('disabled', true);
                    
                    $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['child_id'];?>
').hide().after('<div class="loading_spinner" style="margin: 10px 0;"><img src="'+ afp_config.path_to_images + 'icon-ajax-loader.gif" width="16" height="16" />&nbsp;Loading...</div>');
                    
                    $.ajax({
                        type: 'post',
                        url: afp_config.path_to_script + 'includes/get/child-field-options.php',
                        data: post_data_to_send,
                        success: function(response) {
                            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_value']->value['child_id'];?>
').show().html(response).trigger('fill').next('div').remove();
                            $('.loading_spinner').remove(); // make sure there is no spinner left after the drop-down fills
                            
                            <?php if (!$_smarty_tpl->tpl_vars['is_basic_php_form']->value){?>
                                <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();
                            <?php }?>
                                                        
                            $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['afb_key']->value;?>
').attr('disabled', false);   
                        }
                    });             
                }).trigger('fill');   
                 
            <?php }?>
        <?php } ?>

});

    function do_resize_iframe() {
    
        var parentIframe = parent.document.getElementById("<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afp_frame");
        var resizeTo = $("body").height() + 35;
                 
        parentIframe.height = resizeTo; 
        
    }
    
    function resize_frame(timing) {
    
        try {
             
            if(typeof(parent.document.getElementById("<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afp_frame")) !== 'undefined' && parent.document.getElementById("<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afp_frame") != null) {
                if (typeof timing == 'undefined') { timing = '500'; } 
                setTimeout(do_resize_iframe, timing);
            }
        
        } catch(e) { }
        
    }

function <?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status() {

    
    
    if($('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_success_sent').val() == 1) { 
          $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_note').slideUp('slow');
    	  
          $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_note').html('');
    
          $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_success_sent').val(0); 
    	  return true; 
    } 
    
    if($("div.afb_error").length > 0) { 
    
    	
    	$('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_note').html('<div class="afb_notification_error"><?php echo $_smarty_tpl->tpl_vars['c']->value['notifications']['correct_errors_e'];?>
</div>').<?php if ($_smarty_tpl->tpl_vars['c']->value['errors_effect']=='slide'){?>slideDown('slow')<?php }else{ ?>show()<?php }?>;
    
    }
    
    if($("div.afb_error").length == 0) { 
    	$('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_note').<?php if ($_smarty_tpl->tpl_vars['c']->value['errors_effect']=='slide'){?>slideUp('slow')<?php }else{ ?>hide()<?php }?>; 
    }
    
    resize_frame();
    
    return true;
};


function remove_errors(keyField, mode) {
    
    var selector = $('div[id^="'+ keyField +'_error"]');
    
    if(mode == 'no_slide') {
        selector.remove();
    } else {
        selector.<?php if ($_smarty_tpl->tpl_vars['c']->value['errors_effect']=='slide'){?>slideUp('fast', function() { $(this).remove();});<?php }else{ ?>remove();<?php }?>
    }
}



img1 = new Image(18, 15);
img1.src = afp_config.path_to_images + 'icon-ajax-loader.gif';

img2 = new Image(22, 22);
img2.src = afp_config.path_to_images + 'icon-dialog-error.png';

img3 = new Image(22, 22);
img3.src = afp_config.path_to_images + 'icon-button-ok.png';<?php }} ?>