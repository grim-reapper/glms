<?php /* Smarty version Smarty-3.1.7, created on 2012-12-27 10:00:48
         compiled from "D:\xampp\htdocs\formbuilder_4\ajax-form-app\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:980350dc0e401bde51-90511921%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24936606d0664a8b0ef6e790d34ec8a22e285432' => 
    array (
      0 => 'D:\\xampp\\htdocs\\formbuilder_4\\ajax-form-app\\templates\\header.tpl',
      1 => 1351918642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '980350dc0e401bde51-90511921',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'include_jquery' => 0,
    'c' => 0,
    'forms' => 0,
    'v' => 0,
    'enable_datepicker' => 0,
    'enable_lightbox' => 0,
    'enable_slide_in_left' => 0,
    'enable_uploader' => 0,
    'afp_settings' => 0,
    'post_data' => 0,
    'value' => 0,
    'datepicker_fields' => 0,
    '_key' => 0,
    '_identifier' => 0,
    '_field_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50dc0e405b639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc0e405b639')) {function content_50dc0e405b639($_smarty_tpl) {?><!-- [Ajax_Form_Pro] -->

<?php if ($_smarty_tpl->tpl_vars['include_jquery']->value){?>
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
<?php echo $_smarty_tpl->tpl_vars['c']->value['jquery_file'];?>
"></script>
<?php }?>

    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
jquery.tools.js"></script>

<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>

    <?php if (is_array($_smarty_tpl->tpl_vars['v']->value['custom'])){?>
        
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
style/custom/<?php echo $_smarty_tpl->tpl_vars['v']->value['custom']['style'];?>
?form_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" />
    <?php }else{ ?>

    
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
style/<?php echo $_smarty_tpl->tpl_vars['v']->value['css'];?>
?form_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" />
    
    <?php }?>

<?php } ?>


<link href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
style/fancy-buttons.css" rel="stylesheet" type="text/css" />
      
<?php if ($_smarty_tpl->tpl_vars['enable_datepicker']->value){?> 
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
style/themes/base/jquery.ui.all.css" type="text/css" media="all" />
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
ui/minified/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
ui/minified/jquery.ui.datepicker.min.js"></script>
<?php }?>



<?php if ($_smarty_tpl->tpl_vars['enable_lightbox']->value){?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
fancybox/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
fancybox/jquery.fancybox-1.3.4.js"></script>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['enable_slide_in_left']->value){?>
    
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['enable_uploader']->value){?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
style/attachment.css"  media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
colorbox/colorbox.css" media="screen" />
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
colorbox/jquery.colorbox.js"></script>
<?php }?>


<script type="text/javascript">
<!--
var afp_config = jQuery.parseJSON('<?php echo $_smarty_tpl->tpl_vars['afp_settings']->value;?>
');
var post_data = jQuery.parseJSON('<?php echo $_smarty_tpl->tpl_vars['post_data']->value;?>
');
-->
</script>

    <?php if ($_smarty_tpl->tpl_vars['c']->value['basic_php_form']==0){?>
        
        <!-- Include the Validation File(s) -->  
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
            <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
afp.init.php?form_id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
&amp;enabled=1"></script>    
        <?php } ?>
    <?php }?>

    <script type="text/javascript">
    <!--
    jQuery(document).ready(function($) { // When DOM is ready

        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
            // Select all desired input fields and attach tooltips to them
            $('div.wrap input:text[title!=""], div.wrap textarea[title!=""], div.wrap select[title!=""]').tooltip({
                // place tooltip on the right edge
                position: "center right",
                
                // a little tweaking of the position
                offset: [-2, 10]
            });
        <?php } ?>
        
      
      <?php if ($_smarty_tpl->tpl_vars['enable_lightbox']->value||$_smarty_tpl->tpl_vars['enable_uploader']->value){?>
    
         
         <?php if ($_smarty_tpl->tpl_vars['enable_lightbox']->value){?>
         
             
                     
            $('.afp_lightbox').click(function() {

                var elements = this.className.split(' ');
    		    var target_area = '#' + elements[1] + '_wrap';
    
                $.fancybox({
        	        'scrolling'		   : 'no',
        	        'titleShow'		   : false,
        	        'href'             : target_area,
                    'width': '500px',
                    'height': '75%',
        	        'centerOnScroll'   : true,
                    'speedIn'          : 300,
                    'speedOut'         : 300,
                    'transitionIn'	   : 'none',
                    'transitionOut'	   : 'none'    
                });
                            
            });
            
            
                                        
         <?php }?>
         
         
         <?php if ($_smarty_tpl->tpl_vars['enable_uploader']->value){?>
             
             $('.attach_file').click(function() {
                var obj = $.parseJSON(this.rel);
                $.colorbox( { href: afp_config.path_to_uploader_form + '?form_id='+ obj.form_id +'&s='+ obj.subfolder +'&c='+ obj.temp_dir_name, iframe:true, innerWidth:'60%', innerHeight:'75%' } );
                return false;
             }); 
               
             
             $('.parentFilesAttached').on('click', 'a.delete_attachment', function() {     
                    var obj = $.parseJSON(this.rel);     
                    var clicked_element = $(this);

                    $.ajax({
                       type: "POST",
                       url: "<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_uploader'];?>
delete.php",
                       data: "item_name="+ obj.item_name +"&subfolder="+ obj.subfolder +"&temp_dir_name="+ obj.temp_dir_name,
                       success: function(data){

                         if(data == 1) {
                             $(clicked_element).parent('td').parent('tr').fadeOut('fast').remove();
                             
                             if($('.delete_attachment').length == 0) {
                                $('#'+ obj.form_id +'_parentFilesAttached').html('');
                             }
                             
                             remove_errors(obj.form_id +'_attachment');
                             
                             window['afp<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
_afb_check_status'];
                                                          
                         }
                       }
                     });
                                                                  
                    return false;
             });              
              
          <?php }?>   
       
      <?php }?>
      
      
      
      <?php if ($_smarty_tpl->tpl_vars['enable_datepicker']->value){?>
            
            <?php  $_smarty_tpl->tpl_vars['_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_value']->_loop = false;
 $_smarty_tpl->tpl_vars['_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datepicker_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_value']->key => $_smarty_tpl->tpl_vars['_value']->value){
$_smarty_tpl->tpl_vars['_value']->_loop = true;
 $_smarty_tpl->tpl_vars['_key']->value = $_smarty_tpl->tpl_vars['_value']->key;
?>
                        
                <?php if ($_smarty_tpl->tpl_vars['_key']->value=='froms_tos'){?>
                
                    <?php  $_smarty_tpl->tpl_vars['_i_fields'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_i_fields']->_loop = false;
 $_smarty_tpl->tpl_vars['_identifier'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datepicker_fields']->value['froms_tos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_i_fields']->key => $_smarty_tpl->tpl_vars['_i_fields']->value){
$_smarty_tpl->tpl_vars['_i_fields']->_loop = true;
 $_smarty_tpl->tpl_vars['_identifier']->value = $_smarty_tpl->tpl_vars['_i_fields']->key;
?>
                    
                  	        var dates_<?php echo $_smarty_tpl->tpl_vars['_identifier']->value;?>
 = $('.<?php echo $_smarty_tpl->tpl_vars['_identifier']->value;?>
_from, .<?php echo $_smarty_tpl->tpl_vars['_identifier']->value;?>
_to').datepicker({
            			    
                            buttonImage: afp_config.path_to_images + 'icon-calendar.gif', 
            			    buttonImageOnly: true, 
            			    showOn: 'both',
                                             
            			    onSelect: function(selectedDate) {	             	
            			        var option = $(this).hasClass('<?php echo $_smarty_tpl->tpl_vars['_identifier']->value;?>
_from') ? 'minDate' : 'maxDate';
            				    var instance = $(this).data('datepicker');
            				
            				    var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            				    dates_<?php echo $_smarty_tpl->tpl_vars['_identifier']->value;?>
.not(this).datepicker('option', option, date);               
            		        },
                            
                              
                    	    onClose: function() {
                                
                                if($(this).val() != '') {
                                    
            				        $(this).parent('div').children('div.afb_error').slideUp("fast", function() { $(this).remove(); } );
            
            				        var datepickerObject = this;
                     
                				    function hideLabel()  {
                				        $(datepickerObject).parent('div').children('label').css({opacity:0, display:'none'});
                				    }
                                    
                			    	setTimeout(hideLabel, 0);
            				    }
            			   }
                           
            	           });
                            
            
                    <?php } ?>
                
                <?php }?>
                
                <?php if ($_smarty_tpl->tpl_vars['_key']->value=='simple'){?>
                
                    <?php  $_smarty_tpl->tpl_vars['_field_id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_field_id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datepicker_fields']->value['simple']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_field_id']->key => $_smarty_tpl->tpl_vars['_field_id']->value){
$_smarty_tpl->tpl_vars['_field_id']->_loop = true;
?>
                        
                            $('#<?php echo $_smarty_tpl->tpl_vars['_field_id']->value;?>
').datepicker({
                                buttonImage: afp_config.path_to_images + 'icon-calendar.gif', 
                			    buttonImageOnly: true, 
                			    showOn: 'both',
                               
                               
                               
                               onClose: function() {
                                
                                    if($(this).val() != '') {
                                        
                				        $(this).parent('div').children('div.afb_error').slideUp("fast", function() { $(this).remove(); } );
                
                				        var datepickerObject = this;
                         
                    				    function hideLabel()  {
                    				        $(datepickerObject).parent('div').children('label').css({opacity:0, display:'none'});
                    				    }
                                        
                			    	    setTimeout(hideLabel, 0);
                				    }
			                    }
                                
                                
                                
                            });
                       
                    <?php } ?>            
                <?php }?>
        
            <?php } ?>
        
      <?php }?>
      
      }); 
     -->
     </script>

<!-- [/Ajax_Form_Pro] --><?php }} ?>