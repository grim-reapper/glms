<?php
error_reporting (E_ALL ^ E_NOTICE);

include 'config.php';

$local_path_to_afp = dirname(__FILE__).'/';

$url_path_to_afp = 'http://localhost/formbuilder_4/';

$conf['url']['path_to_afp'] = $url_path_to_afp; // in most cases would be like 'http://www.yourdomain.com/ajax-form-pro/'

// Path to the admin panel
$conf['url']['path_to_afp_admin'] = $url_path_to_afp.'admin/';

// Short Description Char Limit (in case it's too long)
$conf['short_desc_chars'] = 87;

$afp_conf = array();

/* [start] DB Info */
$afp_conf['db'] = array(

    // Database Connection
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'formbuilder',
    
    // Tables Prefix
    'prefix' => 'afp_'
);
/* [end] DB Info */


/* 
---------------------
Configure URL paths
---------------------
*/

// URL to the 'ajax-form-app' folder (e.g. the final generated path could be like: http://www.yourwebsite.com/ajax-form-app/)
$script_path = $url_path_to_afp.'ajax-form-app/';

$afp_conf['url'] = array(
    'path_to_afp'               => $url_path_to_afp,
    'path_to_afp_admin'         => $url_path_to_afp.'admin/',
    'path_to_root'              => $root_path,
    'path_to_script'            => $script_path,
    'path_to_php_process_file'  => $script_path.'parse.php',
    'path_to_style'             => $script_path.'style/',    
    'path_to_images'            => $script_path.'images/',      
    'path_to_js'                => $script_path.'js/',
    'path_to_uploader'          => $script_path.'uploader/',
    'path_to_uploader_form'     => $script_path.'uploader/do.upload.php',
    'path_to_uploader_get_file' => $script_path.'uploader/get.php',
    'path_to_uploader_uploads'  => $script_path.'uploader/uploads/'
);

/* 
-----------------------
Configure Server paths
-----------------------
*/

$path_to_afp = $local_path_to_afp;
$path_to_app = $local_path_to_afp.'ajax-form-app/';

$afp_conf['local'] = array(
    'path_to_afp'              => $path_to_afp, // Path to to 'ajax-form-pro' folder
    'path_to_afp_admin'        => $path_to_afp.'admin/', // Path to to 'admin' folder
    'path_to_app'              => $path_to_app, // Path to 'ajax-form-app' folder
    'path_to_php_process_file' => $path_to_app.'parse.php',
    'path_to_templates'        => $path_to_app.'templates/',
    'path_to_style'            => $path_to_app.'style/',    
    'path_to_forms'            => $path_to_app.'forms_config/',
    'path_to_uploader'         => $path_to_app.'uploader/',    
    'path_to_uploader_uploads' => $path_to_app.'uploader/uploads/',
    'path_to_uploader_class'   => $path_to_app.'includes/class.uploader.php',
    'path_to_fonts'            => $path_to_app.'includes/fonts/' // Path to `Fonts` folder
);

$afp_conf['local']['path_to_app_layouts'] = $afp_conf['local']['path_to_templates'] . 'form-layouts/';

/* 
--------------------------------
 - Local path to the templates
 - Template names & paths
--------------------------------
*/

$path_to_templates = $afp_conf['local']['path_to_templates'];

$afp_conf['templates']['header'] = $path_to_templates.'header.tpl';
$afp_conf['templates']['footer'] = $path_to_templates.'footer.tpl';
$afp_conf['templates']['js_init'] = $path_to_templates.'js/afp.init.js.tpl';

//echo $afp_conf['templates']['header'];

// In the 'layouts' folder you can make layout changes
$local_path_to_app_layouts = $afp_conf['local']['path_to_app_layouts'];

$afp_conf['templates']['form_layouts'] = $local_path_to_app_layouts;

// The template within the ajax form
$afp_conf['templates']['parent_attachments'] = $local_path_to_app_layouts.'attachments/parent-attachments.tpl';

// The template from the popup box
$afp_conf['templates']['iframe_attachments'] = $local_path_to_app_layouts.'attachments/iframe-attachments.tpl';

// jQuery File
$afp_conf['jquery_file'] = 'jquery-1.7.1.min.js';

// If a wrong call is made the appropiate error is shown.
// This is rare, indeed since you have to mistakenly call for the wrong form, but it's good just in case

$afp_conf['status_notifications'] = array('no_active_form'          => 'The form is not active or does not exist.',
                                          'webmaster_info_not_set'  => 'The webmaster\'s information is not set in form\'s configuration (name & email).');

// Delete attachments after form submit (this does not apply if files are kept on the server and the user gets the links to the files instead of actual attachments)
$afp_conf['del_attach_after_submit'] = true;

$afp_security_key_file = $path_to_app.'afp-security-key.php';

$afp_conf['afp_security_key_file'] = $afp_security_key_file;

include $afp_security_key_file;

define('ENABLE_PHP_INSIDE_SMARTY', 0);

// Determine domain name
// get host name from URL
preg_match('@^(?:http://)?([^/]+)@i', URL_PATH_TO_AFP, $afp_matches);
$afp_host = $afp_matches[1];

// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $afp_host, $afp_matches);

define('AFP_DOMAIN', $afp_matches[0]);

$loaded_extensions = get_loaded_extensions();

//echo '<pre>'; print_r($loaded_extensions); echo '</pre>';
?>