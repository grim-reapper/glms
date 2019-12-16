<script>
    
    function names_by_district() {
        var form_data = {
            district_id: $('#district').val(),
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_branch_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#branch_id").html(msg)
            }
            
        });
        
    }
    </script>
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('filescatalog/add_category', $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Case Category Add</h5>
        </div>
        
         <div class="rowElem">
            <label>District:</label>
            <div class="formRight">
                 <select name="d_id" id="district" onchange="names_by_district();">
          <?php foreach($district as $d_list ) {?>
          <option value="<?php echo $d_list->district_id; ?>"><?php echo $d_list->district_name; ?></option>
          <?php } ?>
           </select>
            </div>
            <div class="fix"></div>


        </div>

        <div class="rowElem">
            <label>Branch:</label>
            <div class="formRight">
          <select name="branch" id="branch_id" >
          <?php foreach($branch as $b_list ) {?>
          <option value="<?php echo $b_list->branch_id; ?>"><?php echo $b_list->branch_name; ?></option>
          <?php } ?>
           </select>
            </div>
            <div class="fix"></div>


        </div>
           <div class="rowElem">
            <label>Case Category Name:</label>
            <div class="formRight">
                <input type="text" name="category_name" value="">
            </div>
            <div class="fix"></div>


        </div>

        <div class="rowElem">
            <label>Case Category Code:</label>
            <div class="formRight">
                <input type="text" name="category_code" value="">
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

