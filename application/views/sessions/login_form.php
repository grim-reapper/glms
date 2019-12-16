<?php 

 if($this->mdl_sessions->is_login())
	{
		redirect("dashboard");	
	}
	else
	{
		$newdata = array(
					   'guest'  =>1,
					   'logged_in' => 0
					   
				   );
	
		  $this->session->set_userdata($newdata);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GLMS</title>

<?php  $this->load->view("template/head"); ?>

</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
           
            <div class="userNav">
                <ul>
                    <li><span></span></li>
                  
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>
        
<!-- Login form area -->
<div class="loginWrapper">
     <?php
	
	 if($this->session->userdata('custom_error')!='') {?>
        <div class="nNote nFailure hideit">
                    <p> <?php echo $this->session->userdata('custom_error'); ?></p>
        </div>
  <?php } ?>
  
	
    <div class="loginPanel">
        <div class="head"><h5 class="iUser">Login</h5></div>
    
        <?php 
		 $attributes = array('class' => 'mainForm', 'id' => 'valid');

         echo form_open('sessions/login', $attributes);
		?>
            <fieldset>
                <div class="loginRow noborder">
                    <label for="req1">Username:</label>
                    <div class="loginInput"><input type="text" name="username" class="validate[required]" id="req1" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <label for="req2">Password:</label>
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="req2" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                   
                    <input type="submit" value="Log me in" class="basicBtn submitForm" />
                    <div class="fix"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>



</body>
</html>
<?php 
 }
?>