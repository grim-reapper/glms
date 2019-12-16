
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('users/update_pass', $attributes);
?>


<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Change Password</h5>
    </div>
    <?php 
	   if(validation_errors()){
	?>
    <div class="nNote nWarning hideit">
      <p><strong>WARNING: </strong><?php echo validation_errors(); ?></p>
    </div>
    <?php 
	   }
	  ?>

  <div class="rowElem  noborder">
      <label>Username:</label>
      <div class="formRight">
      <strong> <?php echo $user->username; ?></strong>
      </div>
      <label>Email:</label>
      <div class="formRight">
        <strong> <?php echo $user->email; ?></strong>
      </div>
      <div class="fix"></div>
    </div>
    
     <div class="rowElem  noborder">
      <label>Password:</label>
      <div class="formRight">
        <input type="password" name="password"   value=""/>
      </div>
      <label>Confirm Password:</label>
      <div class="formRight">
        <input type="password" name="passconf"   value=""/>
      </div>
      <div class="fix"></div>
     </div>
    

 
   
    <div class="fix"></div>
    <div class="rowElem">
      <div style="width:247px; margin:10px auto 0;">
        <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('dashboard','Cancel',$attributes);
       ?>
        <input type="hidden" name="user_id"   value="<?php echo $user->user_id; ?>"/>
        <input type="hidden" name="username"   value="<?php echo $user->username; ?>"/>
        <input type="submit" value="Submit" class="basicBtn submitForm" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="fix"></div>
  </div>
</fieldset>
<div class="fix"></div>
</form>
