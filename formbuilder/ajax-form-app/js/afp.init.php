<?php
/* 
Author: Gabriel Comarita
Author's Website: http://www.bitrepository.com/

Copyright (c) BitRepository.com - You do not have rights to reproduce, republish, redistribute or resell this product without permission from the author or payment of the appropiate royalty of reuse.

* Keep this notice intact for legal use *
*/

/* 
Important notice: This is the file that handles the AJAX validation. It is made after the way the form is constructed - using $form_fields in common.php - in contact-script.php

Please make sure you know what you are doing before editing this file!
*/
include '../common.php';

if(isSet($_GET['form_id'])) {
    $form_id = ($_GET['form_id']) ? $_GET['form_id'] : 0;
    $form_id = (int)preg_replace('/[^0-9+]/', '', $form_id);
    
    $enabled = ($_GET['enabled']) ? $_GET['enabled'] : 0;
} else {
    exit;
}

//echo $form_id;

// Check if the form_id exists; Otherwise exit the script
$afp->CheckFormStatus($form_id, 1);

// Include the file that has the form's configuration
$AfbFormFields = $afp->GetFormData($form_id);

//echo '<pre>'; print_r($AfbFormFields); echo '</pre>';

// Set current form id
$afp->mCurrentFormId = $form_id;

// Construct the Form Fields array
$AfbFormFields = $afp->ParseFields($AfbFormFields);

//echo '<pre>'; print_r($form_fields); echo '</pre>';

// Merge script and form's configuration
$afp_conf = $afp->mAfpConf 
          = $afp->SetGlobalConfig($afp_conf, $AfbFormFields[$form_id]['config']);
          
$form_fields = $afp->ParseFieldsForJS($AfbFormFields[$form_id]['fields']);

//echo '<pre>'; print_r($AfbFormFields[$form_id]['fields']); echo '</pre>';

header("Content-type: application/x-javascript");
?>

/* 
Author: Gabriel Comarita
Author's Website: http://www.bitrepository.com/

Copyright (c) BitRepository.com
*/

<?php
$is_basic_php_form = ($afp_conf['basic_php_form'] == 1) ? true : false;
$smarty->assign('is_basic_php_form', $is_basic_php_form);

$do_pack_js = ($afp_conf['debug'] == 0) ? true : false;

//echo '<pre>'; print_r($afp_conf); echo '</pre>';
$element_form_id = 'afp'.$form_id;

$do_pack_js = false;

if($do_pack_js) { 
    include_once '../includes/javascript.packer/class.JavaScriptPacker.'. ( (version_compare(PHP_VERSION, '5.0.0', '<')) ? 'php4' : 'php5' ) .'.php';
    ob_start("JavaScriptCompress"); 
}

//echo '<pre>'; print_r($form_fields); echo '</pre>';

$smarty->assign('total_required_inputs',  $afp->GetTotalRequiredInputs($form_fields));
$smarty->assign('form_id',                $element_form_id);
$smarty->assign('enable_datepicker',      ($afp->HasDatepickerClass($AfbFormFields[$form_id]['fields'])));

$smarty->assign('afb_form_fields',        $form_fields);

// [start] highlight field zone

if($afp_conf['highlight_field_zone'] == 1) { 
	   
    $form_fields['security_code'] = array('field_id' => $element_form_id.'_security_code');
    $form_fields['escts']         = array('field_id' => $element_form_id.'_escts');

    $all_fields = $form_fields;
    
    $smarty->assign('all_fields', $all_fields);
} 

// [end] highlight field zone

$smarty->assign('c', $afp_conf); // Assign the config variable

// Check if the browser is IE9
$user_agent = $_SERVER['HTTP_USER_AGENT'];

$is_ie = (stripos($user_agent, 'MSIE') === false) ? false : true;

$smarty->assign('is_ie', $is_ie);

$smarty->display($afp_conf['templates']['js_init']);

ob_end_flush();

function JavaScriptCompress($buffer) {
    $myPacker = new JavaScriptPacker($buffer);
    return $myPacker->pack();
}
?>