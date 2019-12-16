<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('districts/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">District Add</h5>
</div>
<div class="rowElem  noborder">
  <label>District:</label>
  <div class="formRight">
    <input type="text"   name="district_name" value="" />
  </div>
  <div class="fix"></div>
</div >
<div class="rowElem  noborder">
  <label>District Code:</label>
  <div class="formRight">
    <input type="text"   name="district_code" value="" />
  </div>
  <div class="fix"></div>
</div >
    <div class="rowElem  noborder">
        <label>Division:</label>
        <div class="formRight">
            <select name="D_id" id="divisions" >
     <?php foreach($divisions as $d_list ) {?>
          <option value="<?php echo $d_list->division_id; ?>"><?php echo $d_list->division_name; ?></option>
          <?php } ?>
           </select>
        </div>
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
