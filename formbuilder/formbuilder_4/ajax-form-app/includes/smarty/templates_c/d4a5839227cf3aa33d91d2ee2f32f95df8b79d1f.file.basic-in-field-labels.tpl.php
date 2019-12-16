<?php /* Smarty version Smarty-3.1.7, created on 2012-12-27 10:02:45
         compiled from "D:\xampp\htdocs\formbuilder_4\ajax-form-app\templates\form-layouts\basic-in-field-labels.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2794050dc0eb5cc60f3-19991617%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4a5839227cf3aa33d91d2ee2f32f95df8b79d1f' => 
    array (
      0 => 'D:\\xampp\\htdocs\\formbuilder_4\\ajax-form-app\\templates\\form-layouts\\basic-in-field-labels.tpl',
      1 => 1348335614,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2794050dc0eb5cc60f3-19991617',
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
    'recaptcha_output' => 0,
    'attachments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50dc0eb62e34f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc0eb62e34f')) {function content_50dc0eb62e34f($_smarty_tpl) {?><!-- [Ajax_Form_Pro] -->

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
        
                
                <?php if ($_smarty_tpl->tpl_vars['value']->value['type']=='input'){?>
                    <label class="in_field" for="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>
</label><input <?php echo $_smarty_tpl->tpl_vars['value']->value['attributes_html'];?>
 type="text" name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
" value="<?php if ($_smarty_tpl->tpl_vars['value']->value['post_value']){?><?php echo $_smarty_tpl->tpl_vars['value']->value['post_value'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['value']->value['default_value'];?>
<?php }?>" />
                <?php }?>
                
            
            
                
                <?php if (is_array($_smarty_tpl->tpl_vars['value']->value['type']['select'])){?>        
                    <select <?php echo $_smarty_tpl->tpl_vars['value']->value['attributes_html'];?>
 name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
<?php echo $_smarty_tpl->tpl_vars['value']->value['add_multiple_sign'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
">
                
                        <option value="" style="color: #777;"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 (select)...</option>
                
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
                <?php }?>
                
             
             
                 
                <?php if ($_smarty_tpl->tpl_vars['value']->value['type']=='textarea'){?>
                    <label class="in_field" for="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>
</label><textarea <?php echo $_smarty_tpl->tpl_vars['value']->value['attributes_html'];?>
 name="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['field_id'];?>
"><?php if ($_smarty_tpl->tpl_vars['value']->value['post_value']){?><?php echo $_smarty_tpl->tpl_vars['value']->value['post_value'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['value']->value['default_value'];?>
<?php }?></textarea>
                <?php }?>
                
            
                
                <?php if (is_array($_smarty_tpl->tpl_vars['value']->value['type']['checkboxes'])){?>
                    <span class="fieldTitle"><?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['value']->value['checkboxes_area'];?>
 
                <?php }?>
            
                
                <?php if (is_array($_smarty_tpl->tpl_vars['value']->value['type']['radios'])){?>
                    <span class="fieldTitle"><?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>
</span>
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
    
        <div class="wrap" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_main_sec_div">
            <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_input_box_div">
            <label class="in_field security_code" for="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code"><?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['text'];?>
</label>
            <input size="<?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['size'];?>
" class="required text <?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['class'];?>
" type="text" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_security_code" name="security_code" />
            </div>
        
            <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_div"><img width="<?php echo $_smarty_tpl->tpl_vars['c']->value['captcha']['width'];?>
" height="<?php echo $_smarty_tpl->tpl_vars['c']->value['captcha']['height'];?>
" border="0" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha" class="afb_captcha" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
captcha.php?form_id=<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
" alt="" />&nbsp;<a id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_captcha_refresh" href="#"><img id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_icon_refresh" border="0" alt="" width="16" height="16" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_script'];?>
images/icon-refresh.png" align="bottom" /></a></div>  
            <div class="clear"></div>
        </div>
        
        <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_sec_div_two">
            <div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_verified"><?php echo $_smarty_tpl->tpl_vars['c']->value['security_code']['verified_text'];?>
</div>
            <div class="clear"></div>
        </div>
    
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
        <div class="afp_wrap">
        <div class="escts"><input class="chck" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_escts" type="checkbox" name="escts" value="1" />&nbsp;<label class="escts" for="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_escts"><?php echo $_smarty_tpl->tpl_vars['c']->value['escts']['text'];?>
</label></div>
        </div>
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['c']->value['attachments']['enabled']=='1'){?>
        <?php echo $_smarty_tpl->tpl_vars['attachments']->value;?>

    <?php }?>
    
    <div class="afp_wrap">
    <input id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_submit_button" class="<?php echo $_smarty_tpl->tpl_vars['c']->value['submit']['class'];?>
" type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['c']->value['submit']['button_text'];?>
" /><div id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_ajax_loading"><?php echo $_smarty_tpl->tpl_vars['c']->value['submit']['submitting_text'];?>
</div>
<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_success_sent" id="<?php echo $_smarty_tpl->tpl_vars['form_id']->value;?>
_afb_success_sent" value="0" />
</div>
    </form>
<?php }?>
</div>



<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c']->value['url']['path_to_js'];?>
jquery.infieldlabel.js" charset="utf-8"></script>
<script type="text/javascript">
<!--
jQuery(document).ready(function($) { // When DOM is ready   
    $('.afb_captcha').css('margin', '14px 0 0');
    $('label.in_field').inFieldLabels({ fadeOpacity:0.3, fadeDuration:200 });
});
-->
</script>

<!-- [/Ajax_Form_Pro] --><?php }} ?>