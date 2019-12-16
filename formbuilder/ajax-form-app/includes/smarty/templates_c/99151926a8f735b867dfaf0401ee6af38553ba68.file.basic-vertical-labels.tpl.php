<?php /* Smarty version Smarty-3.1.7, created on 2012-12-27 06:17:45
         compiled from "/home6/meraylog/public_html/formbuilder/ajax-form-app/templates/form-layouts/basic-vertical-labels.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29738095050dc4a79a522a6-87295463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99151926a8f735b867dfaf0401ee6af38553ba68' => 
    array (
      0 => '/home6/meraylog/public_html/formbuilder/ajax-form-app/templates/form-layouts/basic-vertical-labels.tpl',
      1 => 1356613901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29738095050dc4a79a522a6-87295463',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form_id' => 0,
    'form_status' => 0,
    'hide_form' => 0,
    'form_attributes' => 0,
    'fields' => 0,
    'same_row' => 0,
    'v' => 0,
    'k2' => 0,
    'v2' => 0,
    'key' => 0,
    'value' => 0,
    'same_row_fields' => 0,
    'option_key_value' => 0,
    'option_value' => 0,
    'c' => 0,
    'x' => 0,
    'recaptcha_output' => 0,
    'attachments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50dc4a79e635c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc4a79e635c')) {function content_50dc4a79e635c($_smarty_tpl) {?><!-- [Ajax_Form_Pro] -->

<a name="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_anchor"></a>

<div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_note" class="afb_note" <?php echo $_smarty_tpl->tpl_vars['form_status']->value['display'];?>
><?php echo $_smarty_tpl->tpl_vars['form_status']->value['message'];?>
</div>

<div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_fields">

<?php if (!$_smarty_tpl->tpl_vars['hide_form']->value){?>
    <form id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
" method="post" action="<?php echo $_smarty_tpl->tpl_vars['form_attributes']->value['action'];?>
" enctype="<?php echo $_smarty_tpl->tpl_vars['form_attributes']->value['enctype'];?>
">
    <input type="hidden" name="form_id" value="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
" />
    
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['same_row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> 
            <?php  $_smarty_tpl->tpl_vars['v2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v2']->_loop = false;
 $_smarty_tpl->tpl_vars['k2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v2']->key => $_smarty_tpl->tpl_vars['v2']->value){
$_smarty_tpl->tpl_vars['v2']->_loop = true;
 $_smarty_tpl->tpl_vars['k2']->value = $_smarty_tpl->tpl_vars['v2']->key;
?>                                                               
                <?php if ($_smarty_tpl->tpl_vars['k2']->value==0){?>
                    <?php if ($_smarty_tpl->tpl_vars['v2']->value['field_id']==$_smarty_tpl->tpl_vars['key']->value){?>
                        <?php echo $_smarty_tpl->tpl_vars['v2']->value['before_content'];?>
    
                        <!-- [start fields row zone]-->
                        <div class="wrap">
                    <?php }?>
                <?php }?>
            <?php } ?>
        <?php } ?>
        
        <?php if ($_smarty_tpl->tpl_vars['value']->value['type']!='hidden'){?>
        
            <?php if (!in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['same_row_fields']->value)){?>
                
                    <?php echo $_smarty_tpl->tpl_vars['value']->value['before_content'];?>

                
            <?php }?>
            
            <div class="wrap spacer <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['same_row_fields']->value)){?> small no_clear <?php }else{ ?> to_clear <?php }?>">

                <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['same_row_fields']->value)){?>
                    
                        <?php echo $_smarty_tpl->tpl_vars['value']->value['before_content'];?>

                    
                <?php }?>
            
                <?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>

            
                
                <?php if ($_smarty_tpl->tpl_vars['value']->value['type']=='input'){?>
                    <div><input <?php echo $_smarty_tpl->tpl_vars['value']->value['attributes_html'];?>
 type="text" name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
" value="<?php if ($_smarty_tpl->tpl_vars['value']->value['post_value']){?><?php echo $_smarty_tpl->tpl_vars['value']->value['post_value'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['value']->value['default_value'];?>
<?php }?>" /></div>
                <?php }?>
                
            
            
                
                <?php if (is_array($_smarty_tpl->tpl_vars['value']->value['type']['select'])){?>
                    <div>
                
                    <select <?php echo $_smarty_tpl->tpl_vars['value']->value['attributes_html'];?>
 name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
<?php echo $_smarty_tpl->tpl_vars['value']->value['add_multiple_sign'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
">
                
                        <option value="" style="color: #777;">...</option>
                
                    <?php  $_smarty_tpl->tpl_vars['option_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option_value']->_loop = false;
 $_smarty_tpl->tpl_vars['option_key_value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['value']->value['type']['select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option_value']->key => $_smarty_tpl->tpl_vars['option_value']->value){
$_smarty_tpl->tpl_vars['option_value']->_loop = true;
 $_smarty_tpl->tpl_vars['option_key_value']->value = $_smarty_tpl->tpl_vars['option_value']->key;
?>
            	        <option value="<?php echo $_smarty_tpl->tpl_vars['option_key_value']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['option_value']->value['selected'];?>
 <?php echo $_smarty_tpl->tpl_vars['option_value']->value['attr_html'];?>
><?php echo $_smarty_tpl->tpl_vars['option_value']->value['text'];?>
</option>
                    <?php } ?>
            
                    </select>
                    
                    </div>
                <?php }?>
                
             
             
                 
                <?php if ($_smarty_tpl->tpl_vars['value']->value['type']=='textarea'){?>
                    <div><textarea <?php echo $_smarty_tpl->tpl_vars['value']->value['attributes_html'];?>
 name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
"><?php if ($_smarty_tpl->tpl_vars['value']->value['post_value']){?><?php echo $_smarty_tpl->tpl_vars['value']->value['post_value'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['value']->value['default_value'];?>
<?php }?></textarea></div>
                <?php }?>
                
            
                
                <?php if (is_array($_smarty_tpl->tpl_vars['value']->value['type']['checkboxes'])){?>
                    <?php echo $_smarty_tpl->tpl_vars['value']->value['checkboxes_area'];?>
 
                <?php }?>
            
                
                <?php if (is_array($_smarty_tpl->tpl_vars['value']->value['type']['radios'])){?>
                    <?php echo $_smarty_tpl->tpl_vars['value']->value['radios_area'];?>

                <?php }?>

                <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['same_row_fields']->value)){?>
                    
                        <?php echo $_smarty_tpl->tpl_vars['value']->value['after_content'];?>

                    
                <?php }?>
            </div>
           
            <?php if (!in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['same_row_fields']->value)){?>
                
                    <?php echo $_smarty_tpl->tpl_vars['value']->value['after_content'];?>

                
            <?php }?>
            
        <?php }else{ ?>
            <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['default_value'];?>
" />
        <?php }?>

    
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['same_row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> 
            <?php  $_smarty_tpl->tpl_vars['v2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v2']->_loop = false;
 $_smarty_tpl->tpl_vars['k2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v2']->key => $_smarty_tpl->tpl_vars['v2']->value){
$_smarty_tpl->tpl_vars['v2']->_loop = true;
 $_smarty_tpl->tpl_vars['k2']->value = $_smarty_tpl->tpl_vars['v2']->key;
?>                                                               
                <?php if ($_smarty_tpl->tpl_vars['v2']->value['field_id']==$_smarty_tpl->tpl_vars['v']->value['last_field_id']){?>
                    <?php if ($_smarty_tpl->tpl_vars['v2']->value['field_id']==$_smarty_tpl->tpl_vars['key']->value){?>
                        <div style="clear:both;"></div>
                    </div>
                    <?php echo $_smarty_tpl->tpl_vars['v2']->value['after_content'];?>

                    <!-- [end fields row zone]-->
                    <?php }?>
                <?php }?>
            <?php } ?>
        <?php } ?>
                 
    <?php } ?>
    
    
    
    <?php if ($_smarty_tpl->tpl_vars['c']->value['captcha']['enabled']=='1'){?>
    
        <div class="wrap spacer" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_main_sec_div">
            <?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['text'];?>

            <div>
                <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_input_box_div"><input size="<?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['size'];?>
" class="required text <?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['class'];?>
" type="text" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code" name="security_code" /></div> 
                <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div"><img width="<?php echo $_smarty_tpl->tpl_vars['c']->value['captcha']['width'];?>
" height="<?php echo $_smarty_tpl->tpl_vars['c']->value['captcha']['height'];?>
" border="0" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha" class="afb_captcha_vertical" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
captcha.php?form_id=<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
&x=<?php echo $_smarty_tpl->tpl_vars['x']->value;?>
" alt="" />&nbsp;<a id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_refresh" href="#"><img id="afb_icon_refresh" border="0" alt="" width="16" height="16" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
images/icon-refresh.png" align="bottom" /></a></div>  
                <div class="clear"></div>
            </div>
        </div>
        
        <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sec_div_two">
          <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_verified"><?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['verified_text'];?>
</div>
        <div class="clear"></div>
        </div><br />
    
    <?php }?>
   
    <?php if ($_smarty_tpl->tpl_vars['c']->value['recaptcha']['enabled']=='1'){?>
        <script type="text/javascript">
        <?php if ($_smarty_tpl->tpl_vars['c']->value['recaptcha']['theme']=='custom'){?>
            var RecaptchaOptions = {
                theme : 'custom',
                custom_theme_widget: 'recaptcha_widget'
            };        
        <?php }else{ ?>
            var RecaptchaOptions = {
                theme : '<?php echo $_smarty_tpl->tpl_vars['c']->value['recaptcha']['theme'];?>
'
            };
        <?php }?>
        </script>
        
        <div class="wrap spacer">
            <div id="recaptcha_<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_output">
            
            
            <?php if ($_smarty_tpl->tpl_vars['c']->value['recaptcha']['theme']=='custom'){?>
            
            <style>
            #recaptcha_image img {
                width: 250px;
            }
            </style>
            
                <div id="recaptcha_widget" style="display:none">
                
                   <div id="recaptcha_image"></div>
                   <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
                
                   <span class="recaptcha_only_if_image">Enter the words above:</span>
                   <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>
                
                   <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                
                   <div><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
                   <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                   <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                
                   <div><a href="javascript:Recaptcha.showhelp()">Help</a></div>
                
                 </div>
                
                 <script type="text/javascript"
                    src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $_smarty_tpl->tpl_vars['c']->value['recaptcha']['public_key'];?>
">
                 </script>
                 <noscript>
                   <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $_smarty_tpl->tpl_vars['c']->value['recaptcha']['public_key'];?>
"
                        height="300" width="500" frameborder="0"></iframe><br />
                   <textarea name="recaptcha_challenge_field" rows="3" cols="40">
                   </textarea>
                   <input type="hidden" name="recaptcha_response_field"
                        value="manual_challenge" />
                 </noscript>
                                 
            <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['recaptcha_output']->value;?>

            <?php }?>
            </div>
        </div>
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['c']->value['escts']['enabled']=='1'){?>
        <div class="wrap">
        <div class="escts"><input class="chck" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_escts" type="checkbox" name="escts" value="1" />&nbsp;<label class="escts" for="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_escts"><?php echo $_smarty_tpl->tpl_vars['c']->value['escts']['text'];?>
</label></div>
        </div>
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['c']->value['attachments']['enabled']=='1'){?>
        <?php echo $_smarty_tpl->tpl_vars['attachments']->value;?>

    <?php }?>
    
    <div class="clear"></div>
    
    <input id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_submit_button" class="<?php echo $_smarty_tpl->tpl_vars['c']->value['submit']['class'];?>
" type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['c']->value['submit']['button_text'];?>
" /><div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_ajax_loading"><?php echo $_smarty_tpl->tpl_vars['c']->value['submit']['submitting_text'];?>
</div><br />
    
    <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_success_sent" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_success_sent" value="0" />
    
    </form>
<?php }?>

</div>

<!-- [/Ajax_Form_Pro] --><?php }} ?>