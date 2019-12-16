<?php
    $iframe_src = $conf['url']['path_to_afp'].'ajax-form-app/standalone/generate.php?form_id='.$form_id;
    
    if($method == 'iframe') {
        
        $code = '<iframe scrolling="no" style="border:none; overflow:auto;" id="afp'.$form_id.'_afp_frame" src="'.$iframe_src.'" width="100%" height="100%"><p>Your browser does not support iframes.</p></iframe>';
        $code = htmlspecialchars($code);
        
    } else if($method == 'copy_php_code') {
           
       /* (Basic) Web Page - CODE */
       if($integration_type == 'web_page') {
           
           $type_title = '(Basic) Web Page';   
           
            $code_1 = '&lt;?php
            $get_form_info = 1;
            
            $form_id = '.$form_id.';
            
            include &#39;[PATH_TO_AJAX_FORM_PRO]/ajax-form-app/common.php&#39;;
            
            ?&gt;';
       
    
            $code_2 = '&lt;?php
            $afp-&gt;Init();
            ?&gt;';
       
            $code_3 = '&lt;div style=&quot;width:&lt;?php echo $area_width; ?&gt;;&quot;&gt;
            	&lt;div id=&quot;afp&lt;?php echo $form_id; ?&gt;_wrap&quot;&gt;
            
            	&lt;?php if($title) { ?&gt;
            		&lt;h1 style=&quot;height:48px; margin: 0; padding: 16px 0 0 59px; background: url(&#39;&lt;?php echo $afp_conf[&#39;url&#39;][&#39;path_to_images&#39;]; ?&gt;icon-mail.png&#39;) no-repeat scroll -5px 44% transparent;&quot;&gt;&lt;?php echo $title; ?&gt;&lt;/h1&gt;
            	&lt;?php }
            
            	/*
            	-----------------------
            	Include the AJAX Form
            	-----------------------
            	*/
            
            	$afp-&gt;ShowForm($form_id);
            	?&gt;
            
            	&lt;/div&gt;
            &lt;/div&gt;';
    
        /* 
        --------------------
        Lightbox - CODE 
        --------------------
        */
        
        } else if($integration_type == 'lightbox') {
            
            $type_title = 'Lightbox';
    
            $code_1 = '&lt;?php'."\n".'$get_form_info = 1;'."\n\n".'$form_id = '.$form_id.';'."\n\n".'include &#39;[PATH_TO_AJAX_FORM_PRO]/ajax-form-app/common.php&#39;;'."\n\n".'$afp-&gt;mLightbox = 1;'."\n".'?&gt;';
        
            $code_2 = '&lt;?php'."\n".'$afp-&gt;Init();'."\n".'?&gt;';
        
            $code_3 = htmlspecialchars('<button class=\'afp_lightbox afp<?php echo $form_id; ?>\' style=\'padding:10px;\'><?php echo $title; ?></button>');
            
            $code_4 = '&lt;div style=&quot;display:none; width:&lt;?php echo $area_width; ?&gt;;&quot;&gt;
            	&lt;div id=&quot;afp&lt;?php echo $form_id; ?&gt;_wrap&quot;&gt;
            
            	&lt;?php if($title) { ?&gt;
            		&lt;h1 style=&quot;height:48px; margin: 0; padding: 16px 0 0 59px; background: url(&#39;&lt;?php echo $afp_conf[&#39;url&#39;][&#39;path_to_images&#39;]; ?&gt;icon-mail.png&#39;) no-repeat scroll -5px 44% transparent;&quot;&gt;&lt;?php echo $title; ?&gt;&lt;/h1&gt;
            	&lt;?php }
            
            	/*
            	-----------------------
            	Include the AJAX Form
            	-----------------------
            	*/
            
            	$afp-&gt;ShowForm($form_id);
            	?&gt;
            
            	&lt;/div&gt;
            &lt;/div&gt;';
        
        /* 
        --------------------
        Slide-In Top Code
        --------------------
        */    
            
        } else if($integration_type == 'slide_in_top') {
            
            $type_title = 'Slide-In Top';
    
            $code_1 = '&lt;?php'."\n".'$get_form_info = 1;'."\n".'$form_id = '.$form_id.';
                
            include &#39;[PATH_TO_AJAX_FORM_PRO]/ajax-form-app/common.php&#39;;
            ?&gt;';
            
            $code_2 = '&lt;?php'."\n".'$afp-&gt;Init();'."\n".'?&gt;
            
            &lt;style type=&quot;text/css&quot;&gt;
            /* [start] Slide-In BOX */
            
            #backgroundMask { background: none repeat scroll 0 0 #000000; display: none; height: 100%; left: 0; position: fixed;  top: 0; width: 100%; z-index:11; }
            
            #top-container { -moz-box-shadow: 0 0 5px #E7E7E7; position: relative; z-index:12;  text-align:left; }
            #top-box-container { z-index:1; top:-8px; -moz-box-shadow: 0 0 5px white; -moz-border-radius: 0 0 0 5px; right: 0px; background-color:white; position: absolute; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; }
            
            #top-box { padding: 11px 0 0 3px; line-height:12px; moz-box-shadow: 0px 0px 1px #cdcdcd;display: none; background-color: #ffffff;  -moz-border-radius-bottomleft: 5px; }
            
            #top-button { font-size:13px; background-image: url(&#39;&lt;?php echo $afp_conf[&#39;url&#39;][&#39;path_to_images&#39;]; ?&gt;icon-contact.png&#39;); background-repeat: no-repeat; background-position: 10% 50%; -moz-box-shadow: 0 0 5px #E7E7E7; cursor: pointer; text-transform:uppercase; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; -moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px; padding: 10px 6px 10px 35px; background-color: #ffffff; color: #000000; position: absolute; right: -1px; bottom: -37px; width:83px; }
            #top-button a {font-weight: bold; text-decoration: none;}
            #top-button a:hover {text-decoration: none;}
            
            /* end Slide-In BOX */
            &lt;/style&gt;'
            
            ."&lt;script type=&quot;text/javascript&quot;&gt;
            &lt;!--
            var slideSpeed = 'fast';
            var doContactLoad;
            var doContactClose;
            
            var backgroundMask;
            var topBox;
            var topButton;
            
            jQuery(document).ready(function($) { // When DOM is ready
            
            ///// START SLIDE IN + MODAL /////
            
            $('body').prepend('&lt;div id=&quot;backgroundMask&quot;&gt;&lt;/div&gt;');
            
            topBox = $('#top-box');
            backgroundMask = $('#backgroundMask');
            topButton = $('#top-button');
            
            doContactLoad = function() {
            	   backgroundMask.css({'opacity':'0.3'}).fadeIn();
            	   topBox.slideDown(slideSpeed);
            	   topButton.css('-moz-box-shadow','0 0 5px white');
            };
            
            doContactClose = function() {
            	   topBox.slideUp(slideSpeed);
            	   backgroundMask.fadeOut(); 
            	   topButton.css('-moz-box-shadow','0 0 5px #E7E7E7');
            };
            
            topButton.click(function() {
            
                 if(topBox.is(':hidden')) {
                    doContactLoad();
                 } else {
            	    doContactClose();
                 }
            
            });
            
            // when the contact form loses focus
            backgroundMask.click(function() { doContactClose(); });
            
            // only need force for IE6  
            backgroundMask.css({'height': document.documentElement.clientHeight});
            
            ///// END SLIDE IN + MODAL /////
            
            });
            --&gt;
            &lt;/script&gt;";
    
            $code_3 = '&lt;!-- [START] TOP SLIDER CONTENT --&gt;
            	&lt;div id=&quot;top-container&quot;&gt;
            	  &lt;div id=&quot;top-box-container&quot;&gt;
            	     &lt;div id=&quot;top-box&quot;&gt;
                        &lt;div id=&quot;afp&lt;?php echo $form_id; ?&gt;_wrap&quot;&gt;
            
                          &lt;h1&gt;Contact Us&lt;/h1&gt;
                          &lt;?php
                          /*
                          -------------------------------
                          Include the AJAX Contact Form
                          -------------------------------
                          */
                          $afp-&gt;ShowForm($form_id);
                          ?&gt;
                          &lt;/div&gt;
            	     &lt;/div&gt;
            	   &lt;div id=&quot;top-button&quot;&gt;&lt;strong&gt;CONTACT US&lt;/strong&gt;&lt;/div&gt;
            
            	  &lt;/div&gt;
                 &lt;div class=&quot;clear&quot;&gt;&lt;/div&gt;
            	&lt;/div&gt;
                &lt;!-- [END] TOP SLIDER CONTENT --&gt;';
            
        /* 
        --------------------
        Slide-In Left Code
        --------------------
        */
        
        } else if($integration_type == 'slide_in_left') {
            
            $type_title = 'Slide-In Left';
    
            $code_1 = '&lt;?php
            $get_form_info = 1;
                
            $form_id = '.$form_id.';
                
            include &#39;[PATH_TO_AJAX_FORM_PRO]/ajax-form-app/common.php&#39;;
            ?&gt;';
    
            $code_2 = '&lt;?php'."\n".'$afp-&gt;Init();'."\n".'?&gt;
            
            &lt;style type=&quot;text/css&quot;&gt;
            /* [start] Slide-In BOX */
            
            #backgroundMask { background: none repeat scroll 0 0 #000000; display: none; height: 100%; left: 0; position: fixed;  top: 0; width: 100%; z-index:11; }
            
            #slider-container { width: &lt;?php echo $area_width; ?&gt;; display: none; left:0; -moz-box-shadow: 0 0 5px #E7E7E7;  position:fixed; top:7%; z-index:12; text-align:left; }
            #slider-box-container { left: 0; z-index:1; top:-1px; -moz-box-shadow: 0 0 5px white; -moz-border-radius: 0 0 0 5px; right: 0px; background-color:white; position: relative; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; }
            
            #slider-box { padding: 11px 0 0 3px; line-height:12px; moz-box-shadow: 0px 0px 1px #cdcdcd; background-color: #ffffff;  -moz-border-radius-bottomleft: 5px; }
            
            #slider-button-area { position: absolute; right: -83px; top: 24%; width:83px; }
            
            .slider_button { background: url(&#39;&lt;?php echo $afp_conf[&#39;url&#39;][&#39;path_to_images&#39;]; ?&gt;sprite-vertical-feedback-button.png&#39;) no-repeat -76px 0; border:none; display:block; cursor:pointer; width: 75px; height: 140px; }
            .slider_button:hover { background-position: 0 0; }
            .slider_button span { display: none; }
            
            /* end Slide-In BOX */
            &lt;/style&gt;
            
            &lt;script type=&quot;text/javascript&quot;&gt;
            &lt;!--
            '.
            "var slideSpeed = 'fast';
            var doContactLoad;
            var doContactClose;
            
            var backgroundMask;
            var topBox;
            var topButton;
            
            jQuery(document).ready(function($) { // When DOM is ready
            
            	///// START SLIDE IN + MODAL /////
            
            	$('body').prepend('&lt;div id=&quot;backgroundMask&quot;&gt;&lt;/div&gt;');
            
            	$.data(document.body, 'isLoaded', 0);
            
            	sliderContainer = $('#slider-container');
                sliderContainer.css({'left': '-' + sliderContainer.width() + 'px'}).show();    
                
            	sliderBoxContainer = $('#slider-box-container');
            	sliderBox = $('#slider-box');
            
            	backgroundMask = $('#backgroundMask');
            	sliderButton = $('#slider-button');
            
            	doContactLoad = function() {
            		   backgroundMask.css({'opacity':'0.3'}).fadeIn();
            		   
            		   sliderBoxContainer.show();
            				 
            		   sliderContainer.animate({&quot;left&quot;: '0'}, slideSpeed, function() { 
            			   $.data(document.body, 'isLoaded', 1);
            			   });
            	};
            
            	doContactClose = function() {
            		   sliderContainer.animate({'left': '-'+ (sliderBoxContainer.width() + 2) +'px'}, slideSpeed, function() { 
            			  $.data(document.body, 'isLoaded', 0);
            				});
            				
            		   backgroundMask.fadeOut(); 
            	};
            
            	sliderButton.click(function() {
            
            		 if($.data(document.body, 'isLoaded') == 0) {
            			doContactLoad();
            		 } else {
            			doContactClose();
            		 }
            		 
            		 return false;
            	});
            
            	// when the contact form loses focus
            	backgroundMask.click(function() { doContactClose(); });
            
            	// only need force for IE6  
            	backgroundMask.css({'height': document.documentElement.clientHeight});
            
            	///// END SLIDE IN + MODAL /////
            });"
            
            .'
            --&gt;
            &lt;/script&gt;';
            
            $code_3 = '&lt;!-- [START] LEFT SLIDER CONTENT --&gt;
            &lt;div id=&quot;slider-container&quot;&gt;
             
              &lt;div id=&quot;slider-box-container&quot;&gt;
                 &lt;div id=&quot;slider-box&quot;&gt;
                    &lt;div id=&quot;afp&lt;?php echo $form_id; ?&gt;_wrap&quot;&gt;
                      &lt;h1&gt;Contact Us&lt;/h1&gt;
                      &lt;?php
                      /*
                      -------------------------------
                      Include the AJAX Contact Form
                      -------------------------------
                      */
                      $afp-&gt;ShowForm($form_id);
                      ?&gt;
                      &lt;/div&gt;
                 &lt;/div&gt;
                
              &lt;/div&gt;
               
              &lt;div id=&quot;slider-button-area&quot;&gt;&lt;a class=&quot;slider_button&quot; id=&quot;slider-button&quot; href=&quot;#&quot;&gt;&lt;span&gt;Leave a feedback&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;
              
              
             &lt;div class=&quot;clear&quot;&gt;&lt;/div&gt;
            &lt;/div&gt;
            &lt;!-- [END] LEFT SLIDER CONTENT --&gt;';
        }
}
?>

<div style="width:100%; clear:both;">
    <div style="float: left;"><h2><?php echo $name; ?></h2></div>
    <div style="float: right; margin:12px 0 0 0;"><strong><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>manage_forms.php">&laquo; Back to forms' list</a></strong></div>
    <div style="clear: both;"></div>
</div>

<p><strong>GET INTEGRATION CODE</strong></p>

<h2><?php echo $type_title; ?></h2>

<?php
if($integration_type == 'slide_in_left') {
?>
    <div class="desc">
        Having trouble integrating PHP code into your website? Use the following link to see the "Slide-In Left" page in action and get the HTML source code from there.
        
        <p><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/pages/slide_in_left.php?form_id=<?php echo $form_id; ?>">&gt;&gt; See it in action</a></p>
        
    </div>
<?php
} else if($integration_type == 'slide_in_top') {
?>
    <div class="desc">
        Having trouble integrating PHP code into your website? Use the following link to see the "Slide-In Top" page in action and get the HTML source code from there.
        
        <p><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/pages/slide_top.php?form_id=<?php echo $form_id; ?>">&gt;&gt; See it in action</a></p>
        
    </div>
<?php    
} else if($integration_type == 'lightbox') {
?>
    <div class="desc">
        Having trouble integrating PHP code into your website? Use the following link to see this "Lightbox Form" in action and get the HTML source code from there:
        
        <p><a target="_blank" href="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/pages/lightbox.php?forms=<?php echo $form_id; ?>">&gt;&gt; See it in action</a></p>
        
    </div>
<?php
}
?>

<div style="background-color: #f2faf2; padding:10px; border:1px solid green;">

<iframe id="load_afp_page_afp<?php echo $form_id; ?>" scrolling="no" style="border:none; overflow:auto; width:1px; height:1px;" src="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" width="1" height="1"><p>Your browser does not support iframes.</p></iframe>

    <?php
    if($method == 'iframe') {
    ?>
    <p style="line-height: 20px; margin: 0 0 15px;">Copy &amp; Paste the following block of code where you want to have the form loaded. This can be integrated easily in any platform (such as Wordpress, Drupal, Joomla etc.) or .HTML page.</p>
    
    <div>
    <textarea style="padding:5px;" rows="2" cols="10" id="block_code_afp<?php echo $form_id; ?>"><?php echo $code; ?></textarea>
        <div style="margin: 10px 0 0 0; float: right;">
            <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
        </div>
        <div class="clear"></div>
    </div>
    <?php } else if($method == 'copy_php_code') { 
        
        if($integration_type == 'web_page') {
        ?>
    
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">1</div> Copy &amp; Paste the following block of code at the very beginning of your .PHP file.</p>
            
            <div class="warning">Update [PATH_TO_AJAX_FORM_PRO] with the path to 'ajax-form-pro' (or any - chosen - custom name) folder!</div>
            
            <div>
                <textarea rows="8"><?php echo $code_1; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>

            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">2</div> Copy &amp; Paste the following block of code between the <strong>&lt;head&gt;</strong> and <strong>&lt;/head&gt;</strong> tags of your page.</p>
            
            <div>
                <textarea rows="3"><?php echo $code_2; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
    
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">3</div> Copy &amp; Paste the following block of code where you want the form to show (between the <strong>&lt;body&gt;</strong> and <strong>&lt;/body&gt;</strong> tags of your page)</p>
            <div>
                <textarea rows="20"><?php echo $code_3; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
        
        <?php 
        } else if($integration_type == 'lightbox') {
        ?>
        
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">1</div> Copy &amp; Paste the following block of code at the very beginning of your .PHP file.</p>
            
            <div class="warning">Update [PATH_TO_AJAX_FORM_PRO] with the path to 'ajax-form-pro' (or any - chosen - custom name) folder!</div>
            
            <div>
            <textarea rows="9"><?php echo $code_1; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>  
              
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">2</div> Copy &amp; Paste the following block of code between the <strong>&lt;head&gt;</strong> and <strong>&lt;/head&gt;</strong> tags of your page.</p>
            
            <div>
            <textarea rows="3"><?php echo $code_2; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>    
            
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">3</div> When it is pressed the following button calls the Lightbox. You can put it anywhere you want in the page. You can also use a link (instead of a button) if you wish. Make sure it has the <strong>class</strong> attribute equal with <code>"afp_lightbox afp[FORM_ID]"</code>. You can either put the ID number or &lt;?php echo $form_id; ?&gt; to replace [FORM_ID].</p>
            
            <div>
            <textarea rows="2"><?php echo $code_3; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">4</div> Copy &amp; Paste the following block of code just before the <strong>&lt;/body&gt;</strong> tag of your page</p>
            
            <div>
            <textarea rows="15"><?php echo $code_4; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>          
        
        <?php
        } else if($integration_type == 'slide_in_left') {
        ?>
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">1</div> Copy &amp; Paste the following block of code at the very beginning of your .PHP file.</p>
            
            <div class="warning">Update [PATH_TO_AJAX_FORM_PRO] with the path to 'ajax-form-pro' (or any - chosen - custom name) folder!</div>
            
            <div>
            <textarea rows="7"><?php echo $code_1; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">2</div> Copy &amp; Paste the following blocks of code between the <strong>&lt;head&gt;</strong> and <strong>&lt;/head&gt;</strong> tags of your page.</p>
            
            <div>
            <textarea rows="20"><?php echo $code_2; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">3</div> Copy &amp; Paste the following block of code just before the <strong>&lt;/body&gt;</strong> tag of your page</p>
            
            <div>
            <textarea rows="20"><?php echo $code_3; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
        
        <?php
        } else if($integration_type == 'slide_in_top') {
        ?>
        
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">1</div> Copy &amp; Paste the following block of code at the very beginning of your .PHP file.</p>
            
            <div class="warning">Update [PATH_TO_AJAX_FORM_PRO] with the path to 'ajax-form-pro' (or any - chosen - custom name) folder!</div>
            
            <div>
            <textarea rows="7"><?php echo $code_1; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>
                
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">2</div> Copy &amp; Paste the following blocks of code between the <strong>&lt;head&gt;</strong> and <strong>&lt;/head&gt;</strong> tags of your page.</p>
            
            <div>
            <textarea rows="20"><?php echo $code_2; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>    
            
            <p style="line-height: 20px; margin: 0 0 15px;"><div class="step">3</div> Copy &amp; Paste the following block of code just before the <strong>&lt;/body&gt;</strong> tag of your page</p>
            
            <div>
            <textarea rows="15"><?php echo $code_3; ?></textarea>
                <div style="margin: 10px 0 0 0; float: right;">
                    <button class="fancy-button-base light copy_to_clipboard">Copy to Clipboard</button>
                </div>
                <div class="clear"></div>
            </div>          
        
        <?php
        }
    }
?>
  <div style="clear: both;"></div>
</div>