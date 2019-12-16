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

	<title>Slide-In</title>

<!-- AJAX_FORM_PRO -->

            <script type="text/javascript" src="<?php echo $afp_conf['url']['path_to_script']; ?>js/jquery-1.7.1.min.js"></script>
            
            <style type="text/css">
            /* [start] Slide-In BOX */
            
            #backgroundMask { background: none repeat scroll 0 0 #000000; display: none; height: 100%; left: 0; position: fixed;  top: 0; width: 100%; z-index:11; }
            
            #slider-container { width: <?php echo $area_width; ?>; background-color:white; display: none; left:0; -moz-box-shadow: 0 0 5px #E7E7E7;  position:fixed; top:7%; z-index:12; text-align:left; }
            #slider-box-container { border:none; overflow:auto; left: 0; z-index:1; top:-1px; -moz-box-shadow: 0 0 5px white; -moz-border-radius: 0 0 0 5px; right: 0px; background-color:white; position: relative; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; }
            
            #slider-box { padding: 11px 0 0 3px; line-height:12px; moz-box-shadow: 0px 0px 1px #cdcdcd; background-color: #ffffff;  -moz-border-radius-bottomleft: 5px; }
            
            #slider-button-area { position: absolute; right: -83px; top: 24%; width:83px; }
            
            .slider_button { background: url('<?php echo $afp_conf['url']['path_to_images']; ?>sprite-vertical-feedback-button.png') no-repeat -76px 0; border:none; display:block; cursor:pointer; width: 75px; height: 140px; }
            .slider_button:hover { background-position: 0 0; }
            .slider_button span { display: none; }
            
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

        	var doContactClose = function() {
        		   sliderContainer.animate({'left': '-'+ (sliderBoxContainer.width() + 2) +'px'}, slideSpeed, function() { 
        			  $.data(document.body, 'isLoaded', 0);
        				});
        				
        		   backgroundMask.fadeOut(); 
        	};
            
            jQuery(document).ready(function($) { // When DOM is ready
            
            	///// START SLIDE IN + MODAL /////
            
            	$('body').prepend('<div id="backgroundMask"></div>');
            
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
            				 
            		   sliderContainer.animate({"left": '0'}, slideSpeed, function() { 
            			   $.data(document.body, 'isLoaded', 1);
            			   });
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
            });
            -->
            </script>
<!-- /AJAX_FORM_PRO -->

</head>

<body>

<!-- AJAX_FORM_PRO -->

<!-- [START] LEFT SLIDER CONTENT -->
            <div id="slider-container">
             
              <div id="slider-box-container">
                 <div id="slider-box">
                    <div id="block_code_afp9"><iframe frameborder="no" scrolling="no" style="border:none; overflow:auto;" id="afp<?php echo $form_id; ?>_afp_frame" src="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" width="100%" height="441"><p>Your browser does not support iframes.</p></iframe></div>
                 </div>
              </div>
               
              <div id="slider-button-area"><a class="slider_button" id="slider-button" href="#"><span>Leave a feedback</span></a></div>
              
              
             <div class="clear"></div>
            </div>
            <!-- [END] LEFT SLIDER CONTENT -->
            
<!-- /AJAX_FORM_PRO -->

</body>
</html>