<?php
ini_set('display_errors', 'on');

error_reporting(E_ALL ^ E_NOTICE);

define('ADMIN_SALT_KEY', '80d8aa1fd6e5589dda055a1d1f413762_');

include 'classes/class.sessions.php';
include 'classes/class.application.php';
include 'classes/class.auth.php';
include 'classes/class.database.php';

include 'classes/class.manage.forms.php';
include 'classes/class.manage.forms.fields.php';

$path_to_config = dirname( dirname ( dirname(__FILE__) ) ); // Go up to 'ajax-form-pro' directory

include $path_to_config.'/base.php';
include $path_to_config.'/admin/includes/messages.php';

// Start the session
$ses =  new Sessions;
$ses->start();

// Initialize the database connection
$db = new DB($afp_conf['db']['host'], 
             $afp_conf['db']['user'],
             $afp_conf['db']['pass'],
             $afp_conf['db']['name']);
             
// Initiate the common application class
$app = new Application($afp_conf, $db);             

// Init Auth
$auth = new Auth($afp_conf, $db, $ses, $app);

if($ses->get('user_id') == '') {
    $auth->autoLogin();
}

$form = new Manage_Forms($afp_conf, $db);
$form_fields = new Manage_Forms_Fields($afp_conf, $db);

//echo '<pre>'; print_r($_POST); echo '</pre>';

$self = basename($_SERVER['PHP_SELF']);

$prepare_values = isset($prepare_values) ? $prepare_values : true; 

//echo $prepare_values;

if($prepare_values) {
    $_post_data = $_POST;
    $_POST = $app->PrepareValues($_POST);
    $_GET = $app->PrepareValues($_GET);
    $_REQUEST = $app->PrepareValues($_REQUEST);
}

//echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>