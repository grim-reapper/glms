<?php 
$attributes = array('class' => 'mainForm');

echo form_open('qanungoicircle/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Qanungoi Circle Edit</h5>
</div>

<div class="rowElem  noborder">
  <label>Sub Division:</label>
  <div class="formRight">
 
  <select name="tehsil_id" id="tehsil">
    <?php foreach($subdivision_list as $sub_list) {?>
    <?php 
	     if($q_list->tehsil_id == $sub_list->tehsil_id){
			?>
        <option value="<?php echo $sub_list->tehsil_id; ?>" selected="selected"><?php echo $sub_list->tehsil_name; ?></option>     
		<?php  
        }else{
        ?>
    <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
    <?php 
		}
	} ?>
  </select>
  
  </div>
  
 <div class="fix"></div>
  
<div class="rowElem  noborder">
  <label>Qanungoi Circle:</label>
  <div class="formRight">
    <input type="text"   name="q_circle" value="<?php  echo $q_list->q_circle; ?>" />
    <input type="hidden"   name="q_id" value="<?php  echo $q_list->q_id; ?>" />
  </div>
  
  <div class="fix"></div>
</div>
<div class="rowElem  noborder">
  <label></label>
  <div class="formRight">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('qanungoicircle','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>
</div>
</div>
</fieldset>
</form>