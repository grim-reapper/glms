<?php 
echo validation_errors();

$attributes = array('class' => 'mainForm');
echo form_open('division/add', $attributes);

?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Division Add</h5>
</div>
<div class="rowElem  noborder">
  <label>Division:</label>
  <div class="formRight">
    <input type="text"   name="division_name" value="" />
  </div>
  
  

  </div>
    <div class="rowElem  noborder">
    
  <label>Area km&sup2:</label>
   <div class="formRight">
    <input type="text"   name="division_area" value="" />
  </div>
  <div class="fix"></div>
</div>
  <div class="rowElem  noborder">
   <label>Capital:</label>
  
    <div class="formRight">
    
 
  
    <input type="text"   name="division_capital" value="" />
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
