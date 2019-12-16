<?php
$do_not_load_smarty = true;

include_once 'headers.php';
include_once 'common.php';

// Check if a 'form_id' was requested (each form has its own CAPTCHA)
if($_GET['form_id']) {
    
    $preview = isset($_GET['preview']) ? $_GET['preview'] : false;
    
    $form_id = $_GET['form_id'];
    $form_id = (int)preg_replace('/[^0-9+]/', '', $form_id);
    
    //echo $form_id; exit;
    
    // CAPTCHA Configuration
    $c = $afp->createFormConfig($form_id, 7);
    $c = $c['captcha'];
    
    //echo $afp_conf['local']['path_to_fonts'];
    
    //echo '<pre>'; print_r($c); echo '</pre>'; exit;
            
    //echo $afp_conf['local']['path_to_fonts'];
    
    // Was the ID set? Check if the form's file (associated with the id) actually exists
    if( ! empty($c) ) {

        // Show the CAPTCHA if it's enabled
        if($c['enabled'] || $preview) {

            include_once 'includes/class.captcha.php';

            $captcha = new Captcha();
            
            // Set CAPTCHA's Settings
            $captcha->charsNumber      = $c['chars_number'];
            $captcha->stringType       = $c['string_type'];
            $captcha->fontSize         = $c['font_size'];

            $captcha->textColor        = $afp->html2rgb($c['colors']['text']);
            $captcha->backgroundColor  = $afp->html2rgb($c['colors']['background']);

            $captcha->ttFont           = $afp_conf['local']['path_to_fonts'].$c['tt_font'];
            
            // Output the CAPTCHA
            $captcha->ShowImage($form_id, $c['width'], $c['height']);
        }
    }
}
?>