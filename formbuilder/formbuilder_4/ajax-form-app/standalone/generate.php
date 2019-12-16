<?php
ini_set('display_errors', 'on');

$form_id = isset($_POST['form_id']) ? $_POST['form_id'] : $_GET['form_id'];
$form_id = str_replace('afp', '', $form_id);

if($form_id == '') {
    exit;
}

$no_title = isset($_GET['no_title']) ? $_GET['no_title'] : false;

$path_to_afp = dirname(dirname(__FILE__)).'/';

$get_form_info = 1;

include $path_to_afp.'common.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title><?php echo $title; ?></title>
<?php
$afp->Init();
?>
</head>

<body>

    <div style="width:<?php echo $area_width; ?>;">
    	<div id="afp<?php echo $form_id; ?>_wrap">
    
    	<?php if($title && !$no_title) { ?>
    		<h1 style="height:48px; margin: 0; padding: 16px 0 0 59px; background: url('<?php echo $afp_conf['url']['path_to_images']; ?>icon-mail.png') no-repeat scroll -5px 44% transparent;"><?php echo $title; ?></h1>
    	<?php }
    
    	/*
    	-------------------------------
    	Include the AJAX Contact Form
    	-------------------------------
    	*/
    
    	$afp->ShowForm($form_id);
    	?>
    
    	</div>
    </div>

</body>
</html>