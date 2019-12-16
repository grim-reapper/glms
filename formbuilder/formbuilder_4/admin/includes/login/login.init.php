<?php
include '../common.php';
header('Content-type: application/x-javascript');
?>
jQuery(document).ready(function($) {
    
    img1 = new Image(160, 24);
    img1.src = '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/assets/images/preloader-fading-squares.gif';

    $('#login_form').submit(function() {
    
        var formData = $(this).serialize(); // Serializes a set of input elements into a string data (example: first_name=John&last_name=Doe)
       
        $.ajax({
          type: 'POST',
          url: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/do-ajax-login.php',
          data: formData + '&jsEnabled=1',
          success: function(response) {
            
              // alert(response);
                     	  
              // RESPONSES:
        
              // 1 - Both username and password must be entered
              // 2 - Incorrect Login
              // 3 - Incorrect &amp; Enable CAPTCHA
              // 4 - Locked/Banned
              // 5 - Successful Login
              
              var login_status = '';
              
        	  var go_to = $('#go_to').val();
              
              //alert(go_to);
              
              if(response == 1) {
        
        	      login_status += 'The login credentials are required.<br />';
        	  
        	  } else if(response == 2) {
        
        	      login_status += 'The login info is incorrect.<br />';
        
        	  } else if(response == 3) {
        	  
        	      login_status += 'The login info is incorrect. Please type the security code as well to authenticate.<br />';
        
                  $('#captcha_area').show();
        
        	  } else if(response == 4) {
        
        	      login_status += 'The security code was incorrect.<br />';
        
        	  } else if(response == 5) {
        
        	      login_status += 'Your access to this form has been temporarily restricted due to multiple failed login attempts.';
        
        	      $('#login_form').hide();
        
        	      $('#wrapper').css({ 'width':'590px'});
        	      $('h1.login').css({ 'left':'6%'});
        
        	      $('#ms_login_note').addClass('no_bg_icon').css({'padding':'8px', 'margin':'10px 0 0 0'});
        
        	  } else if(response == 6) { // Are the login credentials valid?
        
        	      $('#form_login_area').addClass('login_preloader').html('Logging in...<br /><img src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/assets/images/preloader-fading-squares.gif" />');   
                               
 	              window.location = go_to;
        
        	      return false;
        	  }
        
        	  $('#wrapper_section').effect('shake', { distance:20, times:2 }, 70);
              $('#ms_login_note').html(login_status).slideDown();
    	  }
        });
    
        return false; // prevent the form from being submitted in the classical way
    
    });

    $('#ms_captcha_refresh').bind('click', new_captcha);

    // Show the 'Refresh' Icon: This will work if JavaScript is enabled!
    $('#ms_captcha_refresh').show(); 

    function new_captcha() {
        var c_currentTime = new Date();
        var c_miliseconds = c_currentTime.getTime();
    
        document.getElementById('ms_captcha').src = '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/login/show-captcha.php?x='+ c_miliseconds;
    
        return false;
    };

});