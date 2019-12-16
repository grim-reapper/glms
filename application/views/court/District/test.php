<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<script type="text/javascript">
$(function(){
	$("#select").multiselect();
});
</script>

<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('court/test1', $attributes);
?>

   <select title="Basic example" multiple="multiple" id="select" name="working[]" size="5" style="width:325px;">
	<option value="Monday">Every Monday</option>
	<option value="Tuesday">Every Tuesday</option>
	<option value="Wednesday">Every Wednesday</option>
	<option value="Thursday">Every Thursday</option>
	<option value="Friday">Every Friday</option>
	<option value="Saturday">Every Saturday</option>
	<option value="Sunday">Every Sunday</option>
	</select>

 <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('court', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>