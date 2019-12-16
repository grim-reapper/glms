<?php $this->load->view("property/property_js");?>

<?php
$attributes = array('class' => 'mainForm');
echo form_open('patwarcircle/add', $attributes);
?>

<fieldset>
 <div  class="widget first_form">
  <div class="head">
    <h5 class="iList">Patwar Circle Edit</h5>
  </div>
  <div class="rowElem  noborder">
    <label>Sub Division:</label>
    <div class="formRight">
      <select name="tehsil_id" id="tehsil" onchange="get_qanungoi_circle();">
        <?php foreach($subdivision_list as $sub_list) {?>
        <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
        <?php  }  ?>
      </select>
    </div>
    <div class="fix"></div>
    <div class="rowElem  noborder">
      <label>Qanungoi Circle:</label>
      <div class="formRight">
      <select name="q_id" id="qanungoi" >
          <?php foreach($qanungoicircle_list as $q_list ) {?>
          <option value="<?php echo $q_list->q_id; ?>"><?php echo $q_list->q_circle; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="fix"></div>
      <div class="rowElem  noborder">
        <label>Patwar Circle:</label>
        <div class="formRight">
          <input type="text"   name="patwar_circle" value="" />
        </div>
        <div class="fix"></div>
      </div>
      <div class="rowElem  noborder">
        <label></label>
        <div class="formRight">
          <input type="submit"   name="submit" value="Save" class="basicBtn"  />
          <?php
				$attributes = array('class' => 'basicBtn a_button');
				echo anchor('patwarcircle','Cancel',$attributes);
			?>
        </div>
        <div class="fix"></div>
      </div>
    </div>
  </div>
</fieldset>
</form>
