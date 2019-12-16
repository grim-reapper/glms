<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$forms = (isset($_REQUEST['forms'])) ? $_REQUEST['forms'] : '';

$method = (isset($_REQUEST['method'])) ? $_REQUEST['method'] : 'iframe'; // iFrame is used as default
$integration_type = (isset($_REQUEST['integration_type'])) ? $_REQUEST['integration_type'] : 'web_page';


if( ! preg_match('/,/', $forms) ) { // One Form
    
    $one = true;
    $form_id = $forms;
    list($name, $description) = $form->getInfo($form_id);
    
    $page_title = 'Single Form Integration';
    
} else { // Multiple Forms
    
    $multiple = true;
    $forms = explode(',', $forms);

    $page_title = 'Multiple Forms Integration';
}

$get_code_page = 1;

include 'sections/header.php';
include 'sections/navigation.php';

if(isset($one)) {
    include 'get_code/single.php';    
} else if(isset($multiple)) {
    include 'get_code/multiple.php';
}
?>

<?php
include 'sections/footer.php';
?>
