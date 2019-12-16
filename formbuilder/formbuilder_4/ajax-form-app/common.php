<?php
$local_path_to_afp = dirname ( dirname(__FILE__) ).'/';

//echo $local_path_to_afp;

include_once $local_path_to_afp.'/base.php';

include_once $local_path_to_afp.'admin/includes/classes/class.application.php';

$app = new Application;

include_once $local_path_to_afp.'admin/includes/classes/class.database.php';

//echo '<pre>'; print_r($afp_conf['db']); echo '</pre>'; exit;

// Initialize the database connection
$db = new DB($afp_conf['db']['host'], 
             $afp_conf['db']['user'], 
             $afp_conf['db']['pass'],
             $afp_conf['db']['name']);

// Include the Manage Form Fields Class
include_once $local_path_to_afp.'admin/includes/classes/class.manage.forms.fields.php';

$form_fields = new Manage_Forms_Fields($afp_conf, $db);

if($get_form_info == 1) {
    
    // Include the Manage Form Fields Class
    include_once $local_path_to_afp.'admin/includes/classes/class.manage.forms.php';
    
    $manage_forms = new Manage_Forms($afp_conf, $db);    
}

// Include the main script's class
include 'includes/class.ajax.form.pro.php';

// Include the misc. functions class (it will extend the Ajax_Form_Pro class)
include 'includes/class.misc.functions.php';

$afp = new Misc_Functions($form_fields, $db);

// Assign the configuration
//echo '<pre>'; print_r($afp_conf); echo '</pre>';

$afp->mAfpConf = $afp_conf;
$afp->conf = $afp_conf;

$afp->app = $app;

if( ! isset($do_not_load_smarty) && $do_not_load_smarty != 1 ) {

    /*
    -------------------
    Initialize Smarty
    -------------------
    */
    
	if(ENABLE_PHP_INSIDE_SMARTY == 1) {
		require 'includes/smarty/SmartyBC.class.php';
		$smarty = new SmartyBC();
	} else {
		require 'includes/smarty/Smarty.class.php';
		$smarty = new Smarty();		
	}

    $smarty->setTemplateDir($path_to_templates);
    $smarty->setCompileDir($afp_conf['local']['path_to_app'] . 'includes/smarty/templates_c');
    $smarty->setCacheDir($afp_conf['local']['path_to_app'] . 'includes/smarty/cache');
    $smarty->setConfigDir($afp_conf['local']['path_to_app'] . 'includes/smarty/configs');
        
    $afp->mSmarty = $smarty;
    $afp->mSmarty->assign('c', $afp_conf);
     
    /* --------------------- */
}


$_POST = (!empty($_POST)) ? $afp->FilterArray($_POST) : $_POST;

/* 
---------------------------------------------------------
USE THE FOLLOWING CODE IN CASE A 'FORM ID' IS REQUESTED
---------------------------------------------------------
*/

if(isset($form_id) && is_numeric($form_id) && !isset($forms)) {
    $forms = array($form_id);
}

//echo $get_form_info;

//echo '<pre>'; print_r($forms); echo '</pre>';

if( ($get_form_info == 1) && is_array($forms) ) {
    
    //echo 1;
        
    $MyForms = array();
    
    foreach($forms as $form_id) {  
    
        $f_info = $manage_forms->getFormData($form_id);
        
        //echo '<pre>'; print_r($f_info); echo '</pre>';
         
        $title = $f_info['title'];
        $custom = $f_info['custom'];
         
        $area_width = $f_info['area_width'];
        
        $layout_name = substr($f_info['file_template'], 0, -4);
         
        $MyForms[$form_id] = array(
            'layout'     => $layout_name,
            'css'        => $f_info['file_css'],
            'area_width' => $area_width
        );
                  
        if($custom == 1) {
            $MyForms[$form_id]['custom'] = array(
                'template' => $layout_name.'.tpl',
                'style'    => $layout_name.'.css.php'
            );
        }
    }
     
    $afp->mMyForms = $MyForms;    
}
//echo '<pre>'; print_r($afp->mMyForms); echo '</pre>';
?>