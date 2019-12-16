<?php
include 'includes/common.php';

$is_banned = ($auth->checkIfBanned()) ? 1 : 0;

$wrapper_width = ($is_banned) ? '590px' : '376px';
$h1_style = ($is_banned) ? 'style="left: 11%; z-index:0;"' : '';

$go_to = (isset($_GET['go_to'])) ? urldecode($_GET['go_to']) : $conf['url']['path_to_afp_admin'].'manage_forms.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title>Member Login</title>

<link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/assets/stylesheets/master.css" />

<script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/jquery-ui-1.7.1.custom.min.js"></script>

<script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/login.init.php"></script>

</head>
<body>

<div id="wrapper" style="width:<?php echo $wrapper_width; ?>;">

	<div id="wrapper_section">
	
	<h1 <?php echo $h1_style; ?> class="login">AJAX Form Pro</h1>

	<div id="form_login_area">

	<?php if($is_banned) { ?>

	<div id="ms_login_note" style="display: block; padding: 8px; margin: 10px 0pt 0pt;" class="no_bg_icon">Your access to this form has been temporarily restricted due to multiple failed login attempts.</div>

	<?php } else { ?>
	
	<div id="ms_login_note"></div>

	<form id="login_form" action="<?php echo $conf['url']['path_to_afp_admin']; ?>login.php" method="post">

			<p>
					<label for="text">Username</label>
					<br />
					<input size="30" type="text" id="username" name="username" />
			</p>

			<p>
					<label for="text">Password</label>
					<br />
					<input size="30" type="password" id="password" name="password" />
			</p>

            <p>
                <input type="checkbox" name="remember_me" id="remember_me" value="1" />&nbsp;<label for="remember_me">Remember Me</label>
            </p>

			<?php
			$captcha_area_css_display = ($auth->captchaForLogin()) ? 'block' : 'none';	
			?>

			<div id="captcha_area" style="margin-bottom:10px; display:<?php echo $captcha_area_css_display; ?>;">
					<label for="text">Security Code</label>
					<br />
					
					<div style="margin: 0 0 3px 0;"><img width="<?php echo $ms_conf['captcha_image_width']; ?>" height="<?php echo $ms_conf['captcha_image_height']; ?>" border="0" id="ms_captcha" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/show-captcha.php" alt="" />&nbsp;<a id="ms_captcha_refresh" href="#"><img id="ms_icon_refresh" border="0" alt="" width="16" height="16" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/assets/images/icon-refresh.png" align="bottom" /></a></div>
					
					<input class="required" type="text" id="security_code" name="security_code" />
			</div>	

			<div style="width:200px; margin: 0 0 17px 0;">

			<div style="float:left;"><input type="submit" value="LOGIN" /></div> 

			<div style="float:right;"><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>reset_password.php" name="reset" id="reset_pass">I forgot my password</a></div>

			<div style="clear:both;"></div>
			
			</div>
            
            <input type="hidden" id="go_to" name="go_to" value="<?php echo $go_to; ?>" />
	</form>

	<?php } ?>

	</div>
 </div>
</div>

</body>
</html>