<?php


		if(!$this->mdl_sessions->is_login())
	
		{
		    redirect('sessions/login');
		}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GLMS</title>

<?php  $this->load->view("property/head"); ?>

</head>

<body>
<!-- Top navigation bar -->
<?php  $this->load->view("template/top_nav"); ?>
<div class="dash_wrapper">
<!-- Header -->
<?php  $this->load->view("property/header"); ?>

<!-- Content wrapper -->
<div class="wrapper">
	
	<!-- Left navigation -->
   <?php  $this->load->view("property/left_nav"); ?>
    
    <!-- Content -->
    <div class="content">
    	<?php 
		
		 $this->load->view($main); 
		 
		 ?>
    </div>
    <div class="fix"></div>
</div>
</div>
<!-- Footer -->
<?php  $this->load->view("template/footer"); ?>

</body>
</html>
