<?php
$include_class_auth_initial = true;

include 'includes/common.php';

$is_banned = ($auth->checkIfBanned()) ? 1 : 0;

$wrapper_width = ($is_banned) ? '590px' : '376px';
$h1_style = ($is_banned) ? 'style="left: 6%; z-index:0;"' : '';

if( ! empty($_POST) ) {
    
    $action = $_POST['action'];
    
    if($action == 'reset') {
        $output = $auth->sendResetPasswordMail(); 
    }
}

// Reset Password Action
if(isset($_GET['id']) && isset($_GET['key'])) {
    
    $key_id = $_GET['id'];
    $key = $_GET['key'];
    
    $output = $auth->resetPassword($key_id, $key);  
}

//echo '<pre>'; print_r($output); echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Member Login</title>

<link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/assets/stylesheets/master.css" />

</head>
<body>

<div id="wrapper" style="width:<?php echo $wrapper_width; ?>;">

	<div id="wrapper_section">
	
	<h1 <?php echo $h1_style; ?> class="login">Reset Password</h1>

	<div id="form_login_area">
    
        <?php 
        if( ! empty($output) ) {
            if($output['success'] == 1) { ?>
                <div class="notification_ok" style="background:none; border-radius: 5px 5px 5px 5px; height: auto; line-height: 19px; margin: 10px; padding: 8px; text-align: left; border: 1px solid green;"><?php echo $output['message']; ?></div>
            <?php } else { ?>
                <div class="notification_error" style="background:none; background-color: #FDF4F5; border-radius: 5px; height: auto; line-height: 19px; margin: 10px; padding: 8px 0 8px 11px; text-align: left; border: 1px solid #C47773;"><?php echo $output['message']; ?></div>
            <?php } 
        } 
        ?>

	<?php if($is_banned) { ?>

	   <div id="ms_login_note" style="display: block; padding: 8px; margin: 10px 0pt 0pt;" class="no_bg_icon">Your access to this form has been temporarily restricted due to multiple failed login attempts.</div>

	<?php } else { ?>
	
    	<div id="ms_login_note"></div>
    
    	<form id="login_form" action="reset_password.php" method="post">
    
    			<p>
    					<label for="text">E-Mail</label>
    					<br />
    					<input size="30" type="text" id="email" name="email" />
    			</p>
    
    			<div style="width:100%; margin: 0 0 17px 0;">
    
    			<div style="float:left;"><input type="submit" value="Continue" /><input type="hidden" name="action" value="reset" /></div> 
    
    			<div style="float:right; margin: 0 0 0 10px;"><a href="login.php">&larr; Back</a></div>
    
    			<div style="clear:both;"></div>
    			
    			</div>
    	</form>

	<?php } ?>

	</div>
 </div>
</div>

</body>
</html>