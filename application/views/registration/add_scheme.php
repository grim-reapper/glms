<?php $this->load->view("property/property_js");?>
<?php

$attributes = array('class' => 'mainForm');

echo form_open_multipart('registration/add_scheme', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Add Scheme</h5>
        </div>
        <?php if(validation_errors()){ ?>
            <div class="errors">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
        <div class="rowElem  noborder">
            <label>Name of Housing Scheme:</label>
            <div class="formRight">
                <input type="text"   name="housing_scheme" value="" />
            </div>
            <label>Area of Scheme:</label>
            <div class="formRight">
                <input type="text"   name="scheme_area" value="" />
            </div>
        </div>
        <div class="rowElem">
            <label style="width: 123px;">Tehsil</label>
            <div class="formRight" style="width:16%;">
                <input type="text" name="tehsil_name" value="">
            </div>
            <label style="margin-left: -35px;">Mouaza:</label>
            <div class="formRight" style="width:16%;">
                <input type="text" name="mouza_name" value="">

            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label>Years of Approval:</label>
            <div class="formRight">
                <input type="text"   name="approval_year" value="" />
            </div>
            <label>Status:</label>
            <div class="formRight">
                <select name="status" id="status" style="width: 133px;" >
                    <option value="">Select </option>
                    <option value="approved">Approved </option>
                    <option value="illegal">Illegal </option>
                </select>
            </div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('registration/identified','Cancel',$attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
</fieldset>
</form>
<style>
    .errors{
        background: red;
        color: #fff;
        font-size: 13px;
        padding: 5px 15px;
        max-width: 700px;
        margin: 5px auto;
        border-radius: 5px;
    }
    .errors p{
        padding-top:0;
    }
    .flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
