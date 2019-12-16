<?php 
$attributes = array('class' => 'mainForm');

echo form_open('filescatalog/update_branch', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Branch Edit</h5>
</div>
    <div class="rowElem  noborder">
  <label>Branch name:</label>
  <div class="formRight">
    <input type="text"   name="branch_name" value="<?php  echo $branch->branch_name; ?>" />
    <input type="hidden"   name="branch_id" value="<?php  echo $branch->branch_id; ?>" />
    
  </div>
  
  <div class="fix"></div>
</div>
    <div class="rowElem  noborder">
  <label>Branch Code:</label>
  <div class="formRight">
    <input type="text"   name="branch_code" value="<?php  echo $branch->branch_code; ?>" />
    
  </div>
  
  <div class="fix"></div>
</div>
    <div class="rowElem  noborder">
  <label>Category Name:</label>
  <div class="formRight">
    <input type="text"   name="category_name" value="<?php  echo $category->case_category_name; ?>" />
    <input type="hidden"   name="category_id" value="<?php  echo $category->case_category_id; ?>" />
    
  </div>
  
  <div class="fix"></div>
</div>
    <div class="rowElem  noborder">
  <label>Category Code:</label>
  <div class="formRight">
    <input type="text"   name="category_code" value="<?php  echo $category->case_category_code; ?>" />
  
    
  </div>
  
  <div class="fix"></div>
</div>
    <div class="rowElem  noborder"> 
  <label>District:</label>
  <div class="formRight">
    <select name="D_id" id="district">
      <?php foreach($district as $d_list) {?>
      <?php  if($d_list->district_id == $branch->district_id){ ?>
      <option value="<?php echo $d_list->district_id; ?>" selected="selected"><?php echo $d_list->district_name; ?></option>
      <?php   }else{   ?>
      <option value="<?php echo $d_list->district_id; ?>"><?php echo $d_list->district_name; ?></option>
      <?php } } ?>
    </select>
  </div>
  </div>
    
    <div class="rowElem  noborder">
  <label></label>
  <div class="formRight">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('filescatalog/branch','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>