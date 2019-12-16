<?php 
$attributes = array('class' => 'mainForm');

echo form_open('districts/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Districts Edit</h5>
</div>
<div class="rowElem  noborder">
  <label>District:</label>
  <div class="formRight">
    <input type="text"   name="district_name" value="<?php  echo $dist->district_name; ?>" />
    <input type="hidden"   name="district_id" value="<?php  echo $dist->district_id; ?>" />
  </div>
  
  <div class="fix"></div>
</div>
<div class="rowElem  noborder">
  <label></label>
  <div class="formRight">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('districts','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>
</div>
</fieldset>
</form>