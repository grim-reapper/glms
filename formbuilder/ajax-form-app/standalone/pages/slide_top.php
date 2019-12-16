<?php
$get_form_info = 1;
    
$form_id = (isset($_REQUEST['form_id'])) ? $_REQUEST['form_id'] : '';

include dirname(dirname(dirname(__FILE__))).'/common.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Gabriel Comarita" />

	<title>Slide Top</title>

<!-- AJAX_FORM_PRO -->

            <script type="text/javascript" src="<?php echo $afp_conf['url']['path_to_script']; ?>js/jquery-1.7.1.min.js"></script>
            
            <style type="text/css">
            /* [start] Slide-In BOX */
            
            #backgroundMask { background: none repeat scroll 0 0 #000000; display: none; height: 100%; left: 0; position: fixed;  top: 0; width: 100%; z-index:11; }
            
            #top-container { -moz-box-shadow: 0 0 5px #E7E7E7; position: relative; z-index:12;  text-align:left; }
            #top-box-container { z-index:1; top:-8px; -moz-box-shadow: 0 0 5px white; -moz-border-radius: 0 0 0 5px; right: 0px; background-color:white; position: absolute; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; }
            
            #top-box { width: <?php echo $area_width; ?>; padding: 11px 0 0 3px; line-height:12px; moz-box-shadow: 0px 0px 1px #cdcdcd;display: none; background-color: #ffffff;  -moz-border-radius-bottomleft: 5px; }
            
            #top-button { font-size:13px; background-image: url('<?php echo $afp_conf['url']['path_to_images']; ?>icon-contact.png'); background-repeat: no-repeat; background-position: 10% 50%; -moz-box-shadow: 0 0 5px #E7E7E7; cursor: pointer; text-transform:uppercase; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; -moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px; padding: 10px 6px 10px 35px; background-color: #ffffff; color: #000000; position: absolute; right: -1px; bottom: -37px; width:83px; }
            #top-button a {font-weight: bold; text-decoration: none;}
            #top-button a:hover {text-decoration: none;}
            
            /* end Slide-In BOX */
            </style>
            
            <script type="text/javascript">
            <!--
            var slideSpeed = 'fast';
            var doContactLoad;
            
            var doContactClose;
            
            var backgroundMask;
            var topBox;
            var topButton;
            
            jQuery(document).ready(function($) { // When DOM is ready
            
            ///// START SLIDE IN + MODAL /////
            
            $('body').prepend('<div id="backgroundMask"></div>');
            
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
            -->
            </script>
<!-- /AJAX_FORM_PRO -->

</head>

<body>

<div style="margin: 0 auto; border:1px solid #cdcdcd; padding: 0 20px 0 0; height:500px; width: 60%;">

<!-- AJAX_FORM_PRO -->

<!-- [START] TOP SLIDER CONTENT -->
            	<div id="top-container">
            	  <div id="top-box-container">
            	     <div id="top-box">
                        <div id="block_code_afp9"><iframe frameborder="no" scrolling="no" style="border:none; overflow:auto;" id="afp<?php echo $form_id; ?>_afp_frame" src="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" width="100%" height="441"><p>Your browser does not support iframes.</p></iframe></div>
            	     </div>
            	   <div id="top-button"><strong>CONTACT US</strong></div>
            
            	  </div>
                 <div class="clear"></div>
            	</div>
                <!-- [END] TOP SLIDER CONTENT -->
            
<!-- /AJAX_FORM_PRO -->

    <div style="clear:both;"></div>

</div>

</body>
</html>