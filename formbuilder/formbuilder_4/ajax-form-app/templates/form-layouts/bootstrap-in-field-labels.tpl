<!-- [Ajax_Form_Pro] -->

<a name="{$form_id}_anchor"></a>

<div id="{$form_id}_afb_note" class="afb_note" {$form_status.display}>{$form_status.message}</div>

<div id="{$form_id}_afb_fields">

{if !$hide_form}

    <form id="{$form_id}" name="{$form_id}" method="post" action="{$form_attributes.action}" enctype="{$form_attributes.enctype}">
    <input type="hidden" name="form_id" value="{$form_id}" />
    
    {foreach from=$fields key=key item=value}
    
        {foreach from=$same_row key=k item=v} 
            {foreach from=$v key=k2 item=v2 name="fields"}                                                               
                {if $k2 eq 0}
                    {if $v2.field_id eq $key}
                        {$v2.before_content}    
                        <!-- [start fields row zone]-->
                        <div class="wrap">
                    {/if}
                {/if}
            {/foreach}
        {/foreach}
        
        {if $value.type neq 'hidden'}

            {if !in_array($key, $same_row_fields)}
                {* (Before Field Zone) *}
                    {$value.before_content}
                {* (/Before Field Zone) *}
            {/if}
    
            <div class="wrap spacer {if in_array($key, $same_row_fields)} small no_clear {else} to_clear {/if}">

                {if in_array($key, $same_row_fields)}
                    {* (Before Field Zone) *}
                        {$value.before_content}
                    {* (/Before Field Zone) *}
                {/if}
        
                {* [START] INPUT FIELD *}
                {if $value.type eq 'input'}
                    <label class="in_field" for="{$value.field_id}">{$value.text}</label><input {$value.attributes_html} type="text" name="{$value.name}" id="{$value.field_id}" value="{if $value.post_value}{$value.post_value}{else}{$value.default_value}{/if}" />
                {/if}
                {* [END] INPUT FIELD *}
            
            
                {* [START] SELECT FIELD *}
                {if is_array($value.type.select)}        
                    <select {$value.attributes_html} name="{$value.name}{$value.add_multiple_sign}" id="{$value.field_id}">
                
                        <option value="" style="color: #777;">{$key} (select)...</option>
                
                    {foreach from=$value.type.select key=option_key_value item=option_value}
            	        <option value="{$option_key_value}" {$option_value.selected} {$option_value.attr_html}>{$option_value.text}</option>
                    {/foreach}
            
                    </select>
                {/if}
                {* [END] SELECT FIELD *}
             
             
                 {* [START] TEXTAREA FIELD *}
                {if $value.type eq 'textarea'}
                    <label class="in_field" for="{$value.field_id}">{$value.text}</label><textarea {$value.attributes_html} name="{$value.name}" id="{$value.field_id}">{if $value.post_value}{$value.post_value}{else}{$value.default_value}{/if}</textarea>
                {/if}
                {* [END] TEXTAREA FIELD *}
            
                {* Checkboxes *}
                {if is_array($value.type.checkboxes) }
                    <span class="fieldTitle">{$value.text}</span>
                    {$value.checkboxes_area} 
                {/if}
            
                {* Radios *}
                {if is_array($value.type.radios) }
                    <span class="fieldTitle">{$value.text}</span>
                    {$value.radios_area}
                {/if}

                {if in_array($key, $same_row_fields)}
                    {* (After Field Zone) *}
                        {$value.after_content}
                    {* (/After Field Zone) *}
                {/if} 
            
            </div>

            {if !in_array($key, $same_row_fields)}
                {* (After Field Zone) *}
                    {$value.after_content}
                {* (/After Field Zone) *}
            {/if}
    
        {else}
            <input type="hidden" name="{$value.name}" value="{$value.default_value}" />
        {/if}
            
        {foreach from=$same_row key=k item=v} 
            {foreach from=$v key=k2 item=v2 name="fields"}                                                               
                {if $v2.field_id eq $v.last_field_id}
                    {if $v2.field_id eq $key}
                        <div style="clear:both;"></div>
                    </div>
                    {$v2.after_content}
                    <!-- [end fields row zone]-->
                    {/if}
                {/if}
            {/foreach}
        {/foreach}   
    
    {/foreach}
    
    {* Security Code *}
    
    {if $c.captcha.enabled eq '1'}
    
        <div class="wrap" id="{$form_id}_afb_main_sec_div">
            <div id="{$form_id}_afb_input_box_div">
            <label class="in_field security_code" for="{$form_id}_security_code">{$c.security_code.text}</label>
            <input size="{$c.security_code.size}" class="required text {$c.security_code.class}" type="text" id="{$form_id}_security_code" name="security_code" />
            </div>
        
            <div id="{$form_id}_afb_captcha_div"><img width="{$c.captcha.width}" height="{$c.captcha.height}" border="0" id="{$form_id}_afb_captcha" class="afb_captcha" src="{$c.url.path_to_script}captcha.php?form_id={$form_id}" alt="" />&nbsp;<a id="{$form_id}_afb_captcha_refresh" href="#"><img id="{$form_id}_afb_icon_refresh" border="0" alt="" width="16" height="16" src="{$c.url.path_to_script}images/icon-refresh.png" align="bottom" /></a></div>  
            <div class="clear"></div>
        </div>
        
        <div id="{$form_id}_afb_sec_div_two">
            <div id="{$form_id}_afb_verified">{$c.security_code.verified_text}</div>
            <div class="clear"></div>
        </div>
    
    {/if}
    
    {if $c.recaptcha.enabled eq '1'}
        <script type="text/javascript">
        {if $c.recaptcha.theme eq 'custom'}
            var RecaptchaOptions = {ldelim}
                theme : 'custom',
                custom_theme_widget: 'recaptcha_widget'
            {rdelim};        
        {else}
            var RecaptchaOptions = {ldelim}
                theme : '{$c.recaptcha.theme}'
            {rdelim};
        {/if}
        </script>
        
        <div class="wrap spacer">
            <div id="recaptcha_{$form_id}_output">
            
            {* Custom Theme *}
            {if $c.recaptcha.theme eq 'custom'}
            
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
                    src="http://www.google.com/recaptcha/api/challenge?k={$c.recaptcha.public_key}">
                 </script>
                 <noscript>
                   <iframe src="http://www.google.com/recaptcha/api/noscript?k={$c.recaptcha.public_key}"
                        height="300" width="500" frameborder="0"></iframe><br />
                   <textarea name="recaptcha_challenge_field" rows="3" cols="40">
                   </textarea>
                   <input type="hidden" name="recaptcha_response_field"
                        value="manual_challenge" />
                 </noscript>
                                 
            {else}
                {$recaptcha_output}
            {/if}
            </div>
        </div>
    {/if}        
        
    {if $c.escts.enabled eq '1'}
        <div class="afp_wrap">
        <div class="escts"><input class="chck" id="{$form_id}_escts" type="checkbox" name="escts" value="1" />&nbsp;<label class="escts" for="{$form_id}_escts">{$c.escts.text}</label></div>
        </div>
    {/if}
    
    {if $c.attachments.enabled eq '1'}
        {$attachments}
    {/if}
    
    <div class="afp_wrap">
    <input id="{$form_id}_afb_submit_button" class="{$c.submit.class}" type="submit" name="submit" value="{$c.submit.button_text}" /><div id="{$form_id}_afb_ajax_loading">{$c.submit.submitting_text}</div>
<input type="hidden" name="{$form_id}_afb_success_sent" id="{$form_id}_afb_success_sent" value="0" />
</div>
    </form>
{/if}
</div>

{* In-FIELD Label*}

<script type="text/javascript" src="{$c.url.path_to_js}jquery.infieldlabel.js" charset="utf-8"></script>
<script type="text/javascript">
<!--
jQuery(document).ready(function($) {ldelim} // When DOM is ready   
    $('.afb_captcha').css('margin', '14px 0 0');
    $('label.in_field').inFieldLabels({ldelim} fadeOpacity:0.3, fadeDuration:200 {rdelim});
{rdelim});
-->
</script>

<!-- [/Ajax_Form_Pro] -->