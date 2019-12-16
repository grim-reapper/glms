<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');
echo form_open('profile/add_designation', $attributes);
?>
<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Designation Entry Form</h5>
        </div>
        <div class="rowElem noborder">
            <label>Designation Group:</label>
            <div class="formRight">
                <select name="designation_group">
                    <option value="">Select</option>
                    <option value="District Group">District Group</option>
                    <option value="Tehsil Group">Tehsil Group</option>
                    <option value="Qanoongoi Group">Qanoongoi Group</option>
                    <option value="Patwar Group">Patwar Group</option>
                    <option value="Staff Group">Staff Group</option>
                </select>
            </div>
            <label>Designation Name:</label>
            <div class="formRight">
                <input type="text" name="designation_name" value="" />
            </div>
              <div class="fix"></div>
            </div>
           <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('profile/admin', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
        </div>
    </fieldset>