<?php $this->load->view("property/property_js");?>
<?php

$attributes = array('class' => 'mainForm');

echo form_open('mauza/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
  <div class="widget first_form"> 
  <div class="head">
    <h5 class="iList">Mauza Edit</h5>
  </div>
  
  <div class="rowElem  noborder"> 
  <label>Sub Division:</label>
  <div class="formRight">
    <select name="tehsil_id" id="tehsil" onchange="get_qanungoi_circle();">
      <?php foreach($subdivision_list as $sub_list) {?>
      <?php  if($sub_list->tehsil_id == $mauza_list->tehsil_id){ ?>
      <option value="<?php echo $sub_list->tehsil_id; ?>" selected="selected"><?php echo $sub_list->tehsil_name; ?></option>
      <?php   }else{   ?>
      <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
      <?php } } ?>
    </select>
  </div>
  <div class="fix"></div>
  
  <div class="rowElem  noborder">
    <label>Qanungoi Circle:</label>
    <div class="formRight">
      <select name="q_id" id="qanungoi"  onchange="get_patwar_circle();" >
        <?php foreach($qanungoicircle_list as $q_list ) {?>
        <?php 
	     if($q_list->q_id == $mauza_list->q_id){?>
        <option value="<?php echo $q_list->q_id; ?>" selected="selected"><?php echo $q_list->q_circle; ?></option>
        <?php   }else{ ?>
        <option value="<?php echo $q_list->q_id; ?>"><?php echo $q_list->q_circle; ?></option>
        <?php } } ?>
      </select>
    </div>
    <div class="fix"></div>
    
    <div class="rowElem  noborder">
      <label>Patwar Circle:</label>
      <div class="formRight">
       <select name="p_id" id="patwar_circle"  >
         <option value="">Select Patwar Circle</option>
          <?php foreach($patwarcircle_list as $pt_list ) {?>
          <?php  if($pt_list->p_id == $mauza_list->p_id){ ?>
          <option value="<?php echo $pt_list->p_id; ?>" selected="selected"><?php echo $pt_list->patwar_circle; ?></option>
          <?php    } else { ?>
          <option value="<?php echo $pt_list->p_id; ?>"><?php echo $pt_list->patwar_circle; ?></option>
          <?php } } ?>
        </select>
      </div>
      <div class="fix"></div>
      
      <div class="rowElem  noborder">
        <label>Mauza Name:</label>
        <div class="formRight">
          <input type="text"   name="mauza_name" value="<?php  echo $mauza_list->mouza_name; ?>" />
          <input type="hidden"   name="mauza_id" value="<?php  echo $mauza_list->mauza_id; ?>" />
        </div>
        <div class="fix"></div>
      </div>
    
      <div class="rowElem  noborder">
        <label>Square Feet in Marla:</label>
             <div class="formRight">
         
 <input type="radio" name="fts_in_one_marla" value="1" <?php if($mauza_list->fts_in_one_marla == 1){echo "checked='checked'";} ?> />
 <label style="float:none; display: inline-block;">225 SQFT</label>
 <input type="radio" name="fts_in_one_marla"  value="0" <?php if($mauza_list->fts_in_one_marla == 0 ){echo "checked='checked'";} ?> />
 <label style="float:none; display: inline-block;"> 272 SQFT</label>
        </div>
        <div class="fix"></div>
      </div>

       <div class="rowElem  noborder">
        <label>Hadbast No.</label>
        <div class="formRight">
          <input type="text"   name="hadbast" value="<?php  echo $mauza_list->hadbast; ?>" />
        </div>
        <div class="fix"></div>
      </div>
            
      <div class="rowElem  noborder">
        <label></label>
        <div class="formRight">
          <input type="submit"   name="submit" value="Save" class="basicBtn"  />
			  <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('mauza','Cancel',$attributes);
              ?>
        </div>
        <div class="fix"></div>
        
      </div>
    </div>
  </div>
</fieldset>
</form>
