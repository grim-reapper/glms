<input type="hidden" name="temp_dir_name" value="{$temp_dir_name}" />
<input type="hidden" name="subfolder" value="{$subfolder}" />

<div id="{$form_id}_attachment_area" class="attachment_area">
<div style="margin:7px 0 7px 0;">{$c.attachments.intro_text}</div>

<div class="uploadWrapper">

{* This DIV element is filled while you upload/delete attachments *}
<div id="{$form_id}_parentFilesAttached" class="parentFilesAttached"></div>

    {if $c.basic_php_form eq 1}
        <a name="{$form_id}_add_attachment"></a>
        {section name=foo loop=$max_uploads}
            <div style="padding:3px 0 3px 0;"><input type="file" name="file_{$form_id}[]" /></div>
        {/section}
    {else}
        <p>
            <a href="#{$form_id}_add_attachment" class="attach_file" rel='{ldelim}"form_id": "{$form_id}", "subfolder": "{$subfolder}", "temp_dir_name": "{$temp_dir_name}"{rdelim}'>Add Attachment</a>
        </p>

        {* Is JavaScript disabled? No problem! The form will degrade gracefully and show all the upload fields available. *}
        <noscript>
        <a name="{$form_id}_add_attachment"></a>
        {section name=foo loop=$max_uploads}
            <div style="padding:3px 0 3px 0;"><input type="file" name="file_{$form_id}[]" /></div>
        {/section}
        </noscript>
    {/if}
</div>

</div><div style="clear:both;"></div>