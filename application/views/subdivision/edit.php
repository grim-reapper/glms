<?php 
$attributes = array('class' => 'mainForm');

echo form_open('subdivision/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Sub Division Edit</h5>
</div>
<div class="rowElem  noborder">
  <label>Sub Division:</label>
  <div class="formRight">
    <input type="text"   name="tehsil_name" value="<?php  echo $subdivision->tehsil_name; ?>" />
    <input type="hidden"   name="tehsil_id" value="<?php  echo $subdivision->tehsil_id; ?>" />
  </div>
  
  <div class="fix"></div>
</div>
<div class="rowElem  noborder">
  <label></label>
  <div class="formRight">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('subdivision','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>
</div>
</fieldset>
</form>