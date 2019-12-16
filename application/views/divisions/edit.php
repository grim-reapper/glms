<?php 
$attributes = array('class' => 'mainForm');

echo form_open('division/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Division Edit</h5>
</div>
<div class="rowElem  noborder">
  <label>Division:</label>
  <div class="formRight">
    <input type="text"   name="division_name" value="<?php  echo $division->division_name; ?>" />
    
    <input type="hidden"   name="division_id" value="<?php  echo $division->division_id; ?>" />
  </div>
  <label>Capital:</label>
   <div class="formRight">
  <input type="text"   name="division_capital" value="<?php  echo $division->division_capital; ?>" />
  </div>
  <label>Area km&sup2:</label>
   <div class="formRight">
  <input type="text"   name="division_area" value="<?php  echo $division->division_area; ?>" />
  </div>
 
  
  <div class="fix"></div>
</div>
<div class="rowElem  noborder">
  <label></label>
  <div class="formRight">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('division','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>
</div>
</fieldset>
</form>