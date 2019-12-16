
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('filescatalog/add_branch', $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Branches Add</h5>
        </div>

        <div class="rowElem">
            <label>Branch Name:</label>
            <div class="formRight">
                <input type="text" name="name_branch" value="">
            </div>
            <div class="fix"></div>


        </div>

        <div class="rowElem">
            <label>Branch Code:</label>
            <div class="formRight">
                <input type="text" name="branch_code" value="">
            </div>
            <div class="fix"></div>


        </div>
        <div class="rowElem">
            <label>District:</label>
            <div class="formRight">
                 <select name="D_id" id="district" >
          <?php foreach($district as $d_list ) {?>
          <option value="<?php echo $d_list->district_id; ?>"><?php echo $d_list->district_name; ?></option>
          <?php } ?>
           </select>
            </div>
            <div class="fix"></div>


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

    </div>
