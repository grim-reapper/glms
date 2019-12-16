<script>


    function names_by_district() {
        var form_data = {
            district_id: $('#d_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_branch_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#branch_id").html(msg);
                names_by_cat_circle();
               
               
            }
        });
    }
    function names_by_branch() {
        var form_data = {
            branch_id: $('#branch_id').val(),
            cat_id: $('#category_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_category_by_branch"); ?>',
            data: form_data,
            success: function(msg) {
                $("#category_id").html(msg);
            }
        });
    }
    function names_by_cat_circle() {
        var form_data = {
            district_id: $('#d_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("filescatalog/get_cat_by_district_add"); ?>',
            data: form_data,
            success: function(msg) {
                $("#category_id").html(msg);
            }
        });
    }
    		
       
</script>


<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open_multipart('filescatalog/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Files Add</h5>
        </div>
        <div class="rowElem  noborder">
            <label>District:</label>
            <div class="formRight">
                <select name="district" id="d_id" onchange="names_by_district();">

                    <?php foreach ($district as $d_list) { ?>
                     <?php if($this->session->userdata('selected_district_add')==$d_list->district_id){?>
                 <option selected="selected" value="<?php echo $d_list->district_id;?>"><?php echo $d_list->district_name;?></option>
                <?php }else{ ?>
                        <option value="<?php echo $d_list->district_id; ?>"><?php echo $d_list->district_name; ?></option>
                    <?php } }?>

                </select>
                <label style="margin-left: -184px; margin-top: 20px;">Branch:</label>
                <select name="branch" id="branch_id" style="margin-top: 20px;" onchange="names_by_branch();">
                    <?php foreach ($branch as $b_list) { ?>
                     <?php if($this->session->userdata('selected_branch')==$b_list->branch_id){?>
                   <option selected="selected" value="<?php echo $b_list->branch_id;?>"><?php echo $b_list->branch_name;?></option>
                 <?php }else{ ?>
                        <option value="<?php echo $b_list->branch_id; ?>"><?php echo $b_list->branch_name; ?></option>
                    <?php }} ?>
                </select>
                <label style="margin-left: -184px; margin-top: 20px;">Category:</label>
                <select name="categ" id="category_id" style="margin-top: 20px;" >
                    <?php foreach ($category as $c_list) { ?>
                    <?php if($this->session->userdata('selected_category')==$c_list->case_category_id){?>
                 <option selected="selected" value="<?php echo $c_list->case_category_id;?>"><?php echo $c_list->case_category_name;?></option>
                <?php }else{ ?>
                        <option value="<?php echo $c_list->case_category_id; ?>"><?php echo $c_list->case_category_name; ?></option>
                    <?php }} ?>
                </select>

            </div>

            <label>Subject:</label>
            <div class="formRight">
                <textarea rows="4" cols="" name="subject"  placeholder=""  ></textarea>

                <label style="margin-left: -182px;
                       margin-top: 8px;">Key Name:</label>

                <input type="text" name="name_occupant" value="" style="margin-top: 9px;">
            </div>
        </div>

        <div class="rowElem">
            <label>Start Year:</label>
            <div class="formRight">
                 <select name="start_year" id="" >
          <option value="">Select Year</option>
          <?php for( $y=1900 ; $y<=date('Y',time());$y++ ){?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } ?>
        </select>
            </div>
            <label>Select mauza:</label>
            <div class="formRight">
                <select name="mauza_id" id="mauza" >
                    <option value="0">Select Mauza</option>
                    <?php foreach ($mauza_list as $m_list) { ?>
                        <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Pages:</label>
            <div class="formRight">
                from 
                <input type="text" name="start"  id="s"  size="4" style=" width:15%" maxlength="3" />
                to
                <input type="text" name="end"  id="e"  size="5" style=" width:20%" maxlength="3" />
            </div>
            <label>File Old No:</label>
            <div class="formRight">
                <input type="text" name="file_old_no" value=""/>
            </div>
        </div>
        <div class="rowElem">
            <label style="width:160px">Almirah No:</label>
            <div class="formRight" style="width:100px">
                <input type="text" name="almirah_no" value="" style="width:100px"/>
            </div>
            <label style="width:100px">Rack No:</label>
            <div class="formRight" style="width:160px">
                <input type="text" name="rack_no" value="" style="width:100px"/>
            </div>
            <label style="margin-left: -40px; width: 123px;">Location Status:</label>
            <div class="formRight" style="width:16%;">
                <select name="location_status" id="" style="width: 133px;">
                    <option value="Available">Available </option>
                    <option value="Moved">Moved </option>
                </select>
            </div>
            <div class="fix"></div>

        </div>
        <div class="rowElem">
            <label>File Index:</label>
            <div class="formRight" style="width:20%;">
                <input type="file"   name="file_index" value="" />
            </div>

            <label><b>Note:</b></label>
            <div class="formRight">
                <textarea rows="4" cols="" name="note"  placeholder=""  ></textarea>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('filescatalog', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
