<?php 
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('subdivision/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Sub Division Add</h5>
</div>
    
     
     
     
<div class="rowElem  noborder">
  <label>Districts:</label>
  <div class="formRight">
      <select name="d_id" id="dist" >
     <?php foreach($dist as $d_list ) {?>
          <option value="<?php echo $d_list->district_id; ?>"><?php echo $d_list->district_name; ?></option>
          <?php } ?>
           </select>
  </div>
  <div class="fix"></div>
</div>
<div class="rowElem  noborder">
  <label>Sub Division:</label>
  <div class="formRight">
    <input type="text"   name="tehsil_name" value="" />
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
