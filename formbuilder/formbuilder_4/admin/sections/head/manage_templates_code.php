        <style>
        button { padding:7px; }
        button:hover { font-style: normal; font-weight: normal }
        
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        </style>
        
        <script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/edit_area/edit_area_full.js"></script>                
        
        <script type="text/javascript">
        
        // initialisation
		editAreaLoader.init({
			id: "file_css_contents"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "css"	
		});          

		editAreaLoader.init({
			id: "file_template_contents"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "html"	
		});    
             
        jQuery(document).ready(function($) { // When DOM is ready
            
            // Delete [Custom] Layout            
            $('a.delete').click(function(e) {
                
                var layout_name = $(this).parents('tr').children('td:first').html();

                if(confirm('Are you sure you wish to delete the layout `'+ layout_name +'`?'+ "\n" +'All the forms associated with it will be updated with the `Vertical Labels` layout?')) {
    		  
                    e.preventDefault();
                  
                    var layout_id = $(this).attr('rel');
                    
                    var selector = $(this).parents('tr').children('td');
        		
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/apps/delete-custom-layout.php',
                        data: 'layout_id=' + layout_id,
                        
                        beforeSend: function() {                        
                            selector.animate(
                                { backgroundColor:'#FF7373' }, 'fast'
                            ).fadeOut('fast', function() {
                        	       selector.slideUp('fast');
                            });
                        },
                        
                        success: function(response) {
                            //alert(response);
                        }
                    });
                }
                return false;
            });    
        });
        </script>
        
       