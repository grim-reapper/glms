<?php /* Smarty version Smarty-3.1.7, created on 2012-12-27 09:13:39
         compiled from "/home6/meraylog/public_html/formbuilder/ajax-form-app/templates/form-layouts/attachments/iframe-attachments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207784965350dc73b33ca777-26501490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '607c2da9d05f3bdf6fd705c0b80c2eb677580a98' => 
    array (
      0 => '/home6/meraylog/public_html/formbuilder/ajax-form-app/templates/form-layouts/attachments/iframe-attachments.tpl',
      1 => 1356613901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207784965350dc73b33ca777-26501490',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'c' => 0,
    'upload_limit' => 0,
    'form_id' => 0,
    'upload_errors' => 0,
    'error_value' => 0,
    'uploaded_ok' => 0,
    'upload_oks' => 0,
    'ok_value' => 0,
    'temp_dir_name' => 0,
    'subfolder' => 0,
    'notes' => 0,
    'files_uploaded_to_dir' => 0,
    'file' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50dc73b36e9db',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc73b36e9db')) {function content_50dc73b36e9db($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    	<title>File Uploader</title>
        
        <link href="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_style'];?>
attachment.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
<?php echo $_smarty_tpl->tpl_vars['c']->value['jquery_file'];?>
"></script>
        
        <script type="text/javascript">
        <!--
        img1 = new Image(16, 16);
        img1.src = '<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_images'];?>
icon-add.png'; 
        
        img2 = new Image(16, 16);
        img2.src = '<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_images'];?>
icon-remove.png';
    
        jQuery(document).ready(function($) {
            
            
            $('a.delete_attachment').click(function() {
                
                var obj = $.parseJSON(this.rel);
                
                var item_name = $(this).attr('rel');
                var clicked_element = $(this);
                
                $.ajax({
                   type: "POST",
                   url: "<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_uploader'];?>
delete.php",
                   data: "item_name="+ obj.item_name +"&subfolder="+ obj.subfolder +"&temp_dir_name="+ obj.temp_dir_name,
                   success: function(data) {
                     if(data == 1) {
                         $(clicked_element).parent('td').parent('tr').fadeOut('fast').remove();
                         parent.jQuery('a[title="'+ obj.item_name +'"]').parent('td').parent('tr').fadeOut('fast').remove();
                         
                         if($('.delete_attachment').length == 0) {          
                             $('#'+ obj.form_id +'_files_attached_area').html('');
                             parent.jQuery('#'+ obj.form_id +'_parentFilesAttached').html('');
                         }
                         
                     }
                   }
                 });

                return false;
            });
            
            
            $('#add_more').click(function() {
                
                var total_file_selects = $(':input[type=file]').length;
                
                if(total_file_selects >= <?php echo $_smarty_tpl->tpl_vars['upload_limit']->value;?>
) {
                    $('#add_more_err_msg').html('&nbsp;<em>&raquo; Total attachments limit was reached.</em>');
                    return false;
                }
                
                $('#select_area tbody:last').append('<tr class="upload_item">' + 
                                                        '<td><input type="file" name="file_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
[]" /></td>' +
                                                        '<td><a class="remove_item" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_images'];?>
icon-remove.png" border="0" width="16" height="16" alt="" /></a></td>' +
                                                    '</tr>');
            });
            
            
            $('#select_area').delegate('a.remove_item','click', function() {
                $(this).parent('td').parent('tr').fadeOut('fast').remove();
                $('#add_more_err_msg').html('');                       
            });            
               
        });
        -->
        </script>
    </head>
    
    <body>
    <div>
        
        <?php if ($_smarty_tpl->tpl_vars['upload_errors']->value){?>  
            <div class="notification_error" style="margin-bottom: 15px; margin-left: auto; margin-right: auto; width: 89%;">The following errors occured:
            <?php  $_smarty_tpl->tpl_vars['error_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error_value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['upload_errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error_value']->key => $_smarty_tpl->tpl_vars['error_value']->value){
$_smarty_tpl->tpl_vars['error_value']->_loop = true;
?>
               File [<?php echo $_smarty_tpl->tpl_vars['error_value']->value['file_name'];?>
]: <?php echo $_smarty_tpl->tpl_vars['error_value']->value['error'];?>
<br />
            <?php } ?>
            </div>
        <?php }?>
        
        <?php if ($_smarty_tpl->tpl_vars['uploaded_ok']->value){?>
            <?php  $_smarty_tpl->tpl_vars['ok_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ok_value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['upload_oks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ok_value']->key => $_smarty_tpl->tpl_vars['ok_value']->value){
$_smarty_tpl->tpl_vars['ok_value']->_loop = true;
?>
                <div class="notification_ok" style="margin-bottom: 15px; margin-left: auto; margin-right: auto; width: 89%;">The file <strong><?php echo $_smarty_tpl->tpl_vars['ok_value']->value['name'];?>
</strong> has been successfuly uploaded.</div>
            <?php } ?>
        <?php }?>
            
            <div class="attach_zone">
            
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="form_id" value="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
" />
                    <input type="hidden" name="c" value="<?php echo $_smarty_tpl->tpl_vars['temp_dir_name']->value;?>
" />
                    <input type="hidden" name="s" value="<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
" />
                               
                    <div style="width:95%;">
                    
                        <div style="float:left; clear:both;"><?php echo $_smarty_tpl->tpl_vars['notes']->value;?>
</div>
                        
                        <div style="float:left; clear:both;">
                        
                        <table id="select_area">
                            <tbody>
                                <tr class="upload_item">
                                    <td><input type="file" name="file_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
[]" /></td>
                                    <td><a id="add_more" href="#"><img border="0" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_images'];?>
icon-add.png" width="16" height="16" alt="" /></a><span id="add_more_err_msg"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table>
                            <tr>
                                <td><input type="submit" name="submit" value="Upload File(s)" /></td>
                            </tr>
                        </table>
                        
                        </div>
                        
                        <div style="clear:both;"></div>
                    </div> 
                </form>
            </div><br />
            
            <div style="width:90%; margin:0 auto;">Note: After you upload the files, close this box to get back to the form and submit the uploads.</div>
        
        <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_files_attached_area">
                        
        <?php if ($_smarty_tpl->tpl_vars['files_uploaded_to_dir']->value){?>
            <table class="files_attached_area" cellpadding='6' cellspacing='0' id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_files_attached" width="96%">    
               <?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['files_uploaded_to_dir']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
                    <tr class="<?php echo $_smarty_tpl->tpl_vars['file']->value['row_class'];?>
">
                        <td width="70%"><?php echo $_smarty_tpl->tpl_vars['file']->value['file_name'];?>
</td>
                        <td><a href="#" class="delete_attachment attach_for_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
" rel='{"form_id": "<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
", "item_name": "<?php echo $_smarty_tpl->tpl_vars['file']->value['file_name'];?>
", "subfolder": "<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
", "temp_dir_name": "<?php echo $_smarty_tpl->tpl_vars['temp_dir_name']->value;?>
"}' title='<?php echo $_smarty_tpl->tpl_vars['file']->value['file_name'];?>
'><img border="0" width="16" height="16" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_images'];?>
icon-trash-can-delete.png" /></a></td>
                    </tr>
               <?php } ?>
            </table>     
        <?php }?>
        </div>
    
    </div>
    
    
    
   <?php if ($_smarty_tpl->tpl_vars['uploaded_ok']->value){?>
        <script type="text/javascript">
        <!--
        jQuery(document).ready(function($) {
        
            // Attached files list from the iframe
            var iframe_files_attached = '<table class="files_attached_area" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_files_attached" width="100%">' + $('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_files_attached').html() + '</table>';
                        
            parent.jQuery('#<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_parentFilesAttached').html(iframe_files_attached);
            
            parent.remove_errors('<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_attachment');
            parent.<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_check_status();     
     
        });
        -->
        </script>
    <?php }?>
    </body>
    
    </html><?php }} ?>