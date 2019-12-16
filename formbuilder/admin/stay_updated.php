<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

if( !empty($_POST) ) {
    $output = $auth->changeSecurityKey();
}

$page_title = 'Change Security Key';

$change_salt_key_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(is_array($output)) {
    $class = ( ! $output['success'] ) ? 'warning' : 'note_ok';
    echo '<div class="'.$class.'">'.$output['message'].'</div>';
}
?>
    
    <h2>Get the Latest Updates!</h2>
    
    <div style="margin:0 0 10px 0;" class="desc">
        <span class="notice">Note</span> Fill the form below to subscribe to our newsletter! You will only receive mails regarding AJAX Form Pro and promotional discounts for future products.
    </div>
    
    <iframe src="http://www.bitrepository.com/apps/newsletter/subscribe/4/0" height="500px" allowtransparency="true" frameborder="0" border="0" style="border:0 none;" width="100%" scrolling="auto"></iframe>
    
<?php
include 'sections/footer.php';
?>