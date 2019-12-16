<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    	<title>File Uploader</title>
        
        <link href="{$c.url.path_to_style}attachment.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="{$c.url.path_to_js}{$c.jquery_file}"></script>
        
        <script type="text/javascript">
        <!--
        img1 = new Image(16, 16);
        img1.src = '{$c.url.path_to_images}icon-add.png'; 
        
        img2 = new Image(16, 16);
        img2.src = '{$c.url.path_to_images}icon-remove.png';
    
        jQuery(document).ready(function($) {ldelim}
            
            {* Delete attachment *}
            $('a.delete_attachment').click(function() {ldelim}
                
                var obj = $.parseJSON(this.rel);
                
                var item_name = $(this).attr('rel');
                var clicked_element = $(this);
                
                $.ajax({ldelim}
                   type: "POST",
                   url: "{$c.url.path_to_uploader}delete.php",
                   data: "item_name="+ obj.item_name +"&subfolder="+ obj.subfolder +"&temp_dir_name="+ obj.temp_dir_name,
                   success: function(data) {ldelim}
                     if(data == 1) {ldelim}
                         $(clicked_element).parent('td').parent('tr').fadeOut('fast').remove();
                         parent.jQuery('a[title="'+ obj.item_name +'"]').parent('td').parent('tr').fadeOut('fast').remove();
                         
                         if($('.delete_attachment').length == 0) {ldelim}          
                             $('#'+ obj.form_id +'_files_attached_area').html('');
                             parent.jQuery('#'+ obj.form_id +'_parentFilesAttached').html('');
                         {rdelim}
                         
                     {rdelim}
                   {rdelim}
                 {rdelim});

                return false;
            {rdelim});
            
            {* Add more [input select file] *}
            $('#add_more').click(function() {ldelim}
                
                var total_file_selects = $(':input[type=file]').length;
                
                if(total_file_selects >= {$upload_limit}) {ldelim}
                    $('#add_more_err_msg').html('&nbsp;<em>&raquo; Total attachments limit was reached.</em>');
                    return false;
                {rdelim}
                
                $('#select_area tbody:last').append('<tr class="upload_item">' + 
                                                        '<td><input type="file" name="file_{$form_id}[]" /></td>' +
                                                        '<td><a class="remove_item" href="#"><img src="{$c.url.path_to_images}icon-remove.png" border="0" width="16" height="16" alt="" /></a></td>' +
                                                    '</tr>');
            {rdelim});
            
            {* Remove Input Select File *}
            $('#select_area').delegate('a.remove_item','click', function() {ldelim}
                $(this).parent('td').parent('tr').fadeOut('fast').remove();
                $('#add_more_err_msg').html('');                       
            {rdelim});            
               
        {rdelim});
        -->
        </script>
    </head>
    
    <body>
    <div>
        {* Are there any upload errors? *}
        {if $upload_errors}  
            <div class="notification_error" style="margin-bottom: 15px; margin-left: auto; margin-right: auto; width: 89%;">The following errors occured:
            {foreach from=$upload_errors item=error_value}
               File [{$error_value.file_name}]: {$error_value.error}<br />
            {/foreach}
            </div>
        {/if}
        
        {if $uploaded_ok}
            {foreach from=$upload_oks item=ok_value}
                <div class="notification_ok" style="margin-bottom: 15px; margin-left: auto; margin-right: auto; width: 89%;">The file <strong>{$ok_value.name}</strong> has been successfuly uploaded.</div>
            {/foreach}
        {/if}
            
            <div class="attach_zone">
            
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="form_id" value="{$form_id}" />
                    <input type="hidden" name="c" value="{$temp_dir_name}" />
                    <input type="hidden" name="s" value="{$subfolder}" />
                               
                    <div style="width:95%;">
                    
                        <div style="float:left; clear:both;">{$notes}</div>
                        
                        <div style="float:left; clear:both;">
                        
                        <table id="select_area">
                            <tbody>
                                <tr class="upload_item">
                                    <td><input type="file" name="file_{$form_id}[]" /></td>
                                    <td><a id="add_more" href="#"><img border="0" src="{$c.url.path_to_images}icon-add.png" width="16" height="16" alt="" /></a><span id="add_more_err_msg"></span></td>
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
        
        <div id="{$form_id}_files_attached_area">
        {* The list with the uploaded files *}                
        {if $files_uploaded_to_dir}
            <table class="files_attached_area" cellpadding='6' cellspacing='0' id="{$form_id}_files_attached" width="96%">    
               {foreach from=$files_uploaded_to_dir item=file}
                    <tr class="{$file.row_class}">
                        <td width="70%">{$file.file_name}</td>
                        <td><a href="#" class="delete_attachment attach_for_{$form_id}" rel='{ldelim}"form_id": "{$form_id}", "item_name": "{$file.file_name}", "subfolder": "{$subfolder}", "temp_dir_name": "{$temp_dir_name}"{rdelim}' title='{$file.file_name}'><img border="0" width="16" height="16" src="{$c.url.path_to_images}icon-trash-can-delete.png" /></a></td>
                    </tr>
               {/foreach}
            </table>     
        {/if}
        </div>
    
    </div>
    
    {* Was the file uploaded? Add it to the parent page *}
    
   {if $uploaded_ok}
        <script type="text/javascript">
        <!--
        jQuery(document).ready(function($) {ldelim}
        
            // Attached files list from the iframe
            var iframe_files_attached = '<table class="files_attached_area" id="{$form_id}_files_attached" width="100%">' + $('#{$form_id}_files_attached').html() + '</table>';
                        
            parent.jQuery('#{$form_id}_parentFilesAttached').html(iframe_files_attached);
            
            parent.remove_errors('{$form_id}_attachment');
            parent.{$form_id}_afb_check_status();     
     
        {rdelim});
        -->
        </script>
    {/if}
    </body>
    
    </html>