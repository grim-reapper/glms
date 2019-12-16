<!-- [Ajax_Form_Pro] -->

{if $include_jquery}
    {* Include the local jQuery File *}
    <script type="text/javascript" src="{$c.url.path_to_js}{$c.jquery_file}"></script>
{/if}

    {* Requires JQuery *}
    <script type="text/javascript" src="{$c.url.path_to_js}jquery.tools.js"></script>

{foreach from=$forms item=v}

    {if is_array($v.custom)}
        {* Include the CSS Files *}
        <link rel="stylesheet" type="text/css" href="{$c.url.path_to_script}style/custom/{$v.custom.style}?form_id={$v.id}" />
    {else}

    {* Include the CSS Files *}
    <link rel="stylesheet" type="text/css" href="{$c.url.path_to_script}style/{$v.css}?form_id={$v.id}" />
    
    {/if}

{/foreach}

{* Fancy CSS Buttons *}
<link href="{$c.url.path_to_script}style/fancy-buttons.css" rel="stylesheet" type="text/css" />
      
{if $enable_datepicker} 
    <link rel="stylesheet" href="{$c.url.path_to_script}style/themes/base/jquery.ui.all.css" type="text/css" media="all" />
    <script type="text/javascript" src="{$c.url.path_to_js}ui/minified/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="{$c.url.path_to_js}ui/minified/jquery.ui.datepicker.min.js"></script>
{/if}

{* 
Is the Fancybox used in any of the active form? Enable it! 

It will be enabled whether the lightbox is used or the attachments are enabled!
*}

{if $enable_lightbox}
    <link rel="stylesheet" type="text/css" href="{$c.url.path_to_js}fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    {* INCLUDE THE JS FILES RELATED TO FANCYBOX *}
    <script type="text/javascript" src="{$c.url.path_to_js}fancybox/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="{$c.url.path_to_js}fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="{$c.url.path_to_js}fancybox/jquery.fancybox-1.3.4.js"></script>
{/if}

{if $enable_slide_in_left}
    
{/if}

{if $enable_uploader}
    <link rel="stylesheet" type="text/css" href="{$c.url.path_to_script}style/attachment.css"  media="all" />
    <link rel="stylesheet" type="text/css" href="{$c.url.path_to_js}colorbox/colorbox.css" media="screen" />
    <script type="text/javascript" src="{$c.url.path_to_js}colorbox/jquery.colorbox.js"></script>
{/if}

{* Contains the URL paths set in common.php *}
<script type="text/javascript">
<!--
var afp_config = jQuery.parseJSON('{$afp_settings}');
var post_data = jQuery.parseJSON('{$post_data}');
-->
</script>

    {if $c.basic_php_form eq 0}
        {* Include the core JavaScript files (for the AJAX call and validation) *}
        <!-- Include the Validation File(s) -->  
        {foreach from=$forms item=value}
            <script type="text/javascript" src="{$c.url.path_to_js}afp.init.php?form_id={$value.id}&amp;enabled=1"></script>    
        {/foreach}
    {/if}

    <script type="text/javascript">
    <!--
    jQuery(document).ready(function($) {ldelim} // When DOM is ready

        {foreach from=$forms item=value}
            // Select all desired input fields and attach tooltips to them
            $('div.wrap input:text[title!=""], div.wrap textarea[title!=""], div.wrap select[title!=""]').tooltip({
                // place tooltip on the right edge
                position: "center right",
                
                // a little tweaking of the position
                offset: [-2, 10]
            });
        {/foreach}
        
      {* Code for 'Lightbox' and the 'Uploader' *}
      {if $enable_lightbox || $enable_uploader}
    
         {* The following code is for the forms inside Lightboxes *}
         {if $enable_lightbox}
         
            {* The following function gets triggered each time someone click on an element with the "afp_lightbox" class *} 
            {literal}         
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
            
            {/literal}
                                        
         {/if}
         
         {* The following code is for the forms with files attachments enabled *}
         {if $enable_uploader}
             {literal}
             $('.attach_file').click(function() {
                var obj = $.parseJSON(this.rel);
                $.colorbox( { href: afp_config.path_to_uploader_form + '?form_id='+ obj.form_id +'&s='+ obj.subfolder +'&c='+ obj.temp_dir_name, iframe:true, innerWidth:'60%', innerHeight:'75%' } );
                return false;
             }); 
             {/literal}  
             
             $('.parentFilesAttached').on('click', 'a.delete_attachment', function() {ldelim}     
                    var obj = $.parseJSON(this.rel);     
                    var clicked_element = $(this);

                    $.ajax({ldelim}
                       type: "POST",
                       url: "{$c.url.path_to_uploader}delete.php",
                       data: "item_name="+ obj.item_name +"&subfolder="+ obj.subfolder +"&temp_dir_name="+ obj.temp_dir_name,
                       success: function(data){ldelim}

                         if(data == 1) {ldelim}
                             $(clicked_element).parent('td').parent('tr').fadeOut('fast').remove();
                             
                             if($('.delete_attachment').length == 0) {ldelim}
                                $('#'+ obj.form_id +'_parentFilesAttached').html('');
                             {rdelim}
                             
                             remove_errors(obj.form_id +'_attachment');
                             
                             window['afp{$value.id}_afb_check_status'];
                                                          
                         {rdelim}
                       {rdelim}
                     {rdelim});
                                                                  
                    return false;
             {rdelim});              
              
          {/if}   
       
      {/if}
      
      {* Code for the 'Datepicker' *}
      
      {if $enable_datepicker}
            
            {foreach $datepicker_fields as $_key => $_value}
                        
                {if $_key eq 'froms_tos'}
                
                    {foreach $datepicker_fields.froms_tos as $_identifier => $_i_fields}
                    
                  	        var dates_{$_identifier} = $('.{$_identifier}_from, .{$_identifier}_to').datepicker({ldelim}
            			    
                            buttonImage: afp_config.path_to_images + 'icon-calendar.gif', 
            			    buttonImageOnly: true, 
            			    showOn: 'both',
                                             
            			    onSelect: function(selectedDate) {ldelim}	             	
            			        var option = $(this).hasClass('{$_identifier}_from') ? 'minDate' : 'maxDate';
            				    var instance = $(this).data('datepicker');
            				
            				    var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            				    dates_{$_identifier}.not(this).datepicker('option', option, date);               
            		        {rdelim},
                            
                            {literal}  
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
                            {/literal}
            
                    {/foreach}
                
                {/if}
                
                {if $_key eq 'simple'}
                
                    {foreach $datepicker_fields.simple as $_field_id}
                        
                            $('#{$_field_id}').datepicker({ldelim}
                                buttonImage: afp_config.path_to_images + 'icon-calendar.gif', 
                			    buttonImageOnly: true, 
                			    showOn: 'both',
                               
                               {literal}
                               
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
                                
                                {/literal}
                                
                            {rdelim});
                       
                    {/foreach}            
                {/if}
        
            {/foreach}
        
      {/if}
      
      {rdelim}); 
     -->
     </script>

<!-- [/Ajax_Form_Pro] -->