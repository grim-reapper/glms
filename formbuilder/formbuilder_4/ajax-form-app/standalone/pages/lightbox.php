<?php
$get_form_info = 1;

$get_forms = (isset($_REQUEST['forms'])) ? $_REQUEST['forms'] : '';

$all_forms = array();

if(strpos($get_forms, ',') !== false) {
    foreach(explode(',', $get_forms) as $form_id) {
        if($form_id) {
            $all_forms[] = $form_id;
        }
    }
    $forms = $all_forms;
} else {
    $all_forms[] = $get_forms;
}


//echo '<pre>'; print_r($forms); echo '</pre>';

include dirname(dirname(dirname(__FILE__))).'/common.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Gabriel Comarita" />
	<title>Lightbox Form(s)</title>

    <script type="text/javascript" src="<?php echo $afp_conf['url']['path_to_script']; ?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $afp_conf['url']['path_to_script']; ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link href="<?php echo $afp_conf['url']['path_to_script']; ?>js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $afp_conf['url']['path_to_script']; ?>style/fancy-buttons.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
    <!--
    jQuery(document).ready(function($) { // When DOM is ready
  
        $('.afp_lightbox').click(function() {
            var elements = this.className.split(' ');
            var target_area = '#' + elements[1] + '_wrap';
        
            $.fancybox({
                'scrolling'		   : 'no',
                'titleShow'		   : false,
                'href'             : target_area,
                'width': '100%',
                'height': '75%',
                'centerOnScroll'   : true,
                'speedIn'          : 300,
                'speedOut'         : 300,
                'transitionIn'	   : 'none',
                'transitionOut'	   : 'none',
                'iframeInContent'  : true
             });               
          });
      }); 
     -->
     </script>

</head>

<body>
    
    <?php
    foreach($all_forms as $form_id) {
        
        $f_info = $manage_forms->getFormData($form_id);
        
        $title = $f_info['title'];
        $area_width = $f_info['area_width'];
        
        if(strpos($area_width, 'px') !== false) {
            $iframe_area_width = str_replace('px', '', $area_width);
        } else {
            $iframe_area_width = $area_width;
        }
        
        ?>
        <!--
        The first 2 values of the 'class' attribute should be:
        
        1. afp_lightbox
        2. afp[FORM_ID_HERE]
        
        'fancy-button-base light' is optional and only used for styling these buttons
        -->
        
        <button class='afp_lightbox afp<?php echo $form_id; ?> fancy-button-base light' style='padding:10px;'><?php echo $title; ?></button>

            <!-- [START] <?php echo $title; ?> -->
            <div style="display:none; width:<?php echo $area_width; ?>;">
                <div id="afp<?php echo $form_id; ?>_wrap">
                    
                    <div id="block_code_afp<?php echo $form_id; ?>">
                        <iframe scrolling="no" style="border:none; overflow:auto;" id="afp<?php echo $form_id; ?>_afp_frame" src="<?php echo $afp_conf['url']['path_to_script']; ?>standalone/generate.php?form_id=<?php echo $form_id; ?>" width="<?php echo $iframe_area_width; ?>" height="100%"><p>Your browser does not support iframes.</p></iframe>
                    </div>
                    
                </div>
            </div>
            <!-- [END] <?php echo $title; ?> -->
            
        <hr />
        <?php
    }
    ?>

</body>
</html>