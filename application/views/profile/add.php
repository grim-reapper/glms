<script type="text/javascript">


function GetValueFromChild(lat,lng)
    {
        document.getElementById("coordinates").value = lat+","+lng;
		document.getElementById("lat").value = lat;
		document.getElementById("lng").value = lng;
                document.getElementById("coordinates_1").value = lat+","+lng;
		document.getElementById("lat_1").value = lat;
		document.getElementById("lng_1").value = lng;
    }

</script>
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open_multipart('profile/add/'.$group, $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Profile Entry Form</h5>
        </div>
       
    <div class="rowElem noborder">
            <label style="width:163px">Name</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="name" value="" />
            </div>
            <label style="width:40px">Picture</label>
            <div class="formRight" style="width:150px">
                <input type="file" name="pic" value="" />
            </div>
            <label style="width:120px">CNIC</label>
            <div class="formRight" style="width:200px">
                <input type="text" name="cnic" value="" />
            </div>
            <div class="fix"></div>
        </div>
    <div class="rowElem noborder">
            <label>Father Name</label>
            <div class="formRight">
                <input type="text" name="f_name" value="" />
            </div>
            <label>Caste</label>
            <div class="formRight">
                <input type="text" name="caste" value="" />
            </div>
            <div class="fix"></div>
        </div>
    <div class="rowElem noborder">
            <label>Date of Entry in Service</label>
            <div class="formRight">
                <input type="text" name="doe" value="" class="datepicker" />
            </div>
            <label>Merital Status </label>
            <div class="formRight">
                <select name="m_status">
                    <option value="">Select</option>
                    <option value="yes">Single</option>
                    <option value="no">Married</option>
                    </select>
            </div>
            <div class="fix"></div>
        </div>
        
          <div class="rowElem noborder">
            <label>Spouse Name</label>
            <div class="formRight">
                <input type="text" name="s_name" value="" />
            </div>
            <label>Personal Computer No</label>
            <div class="formRight">
                <input type="text" name="pcn" value="" />
            </div>
            <div class="fix"></div>
        </div>
          <div class="rowElem noborder">
            <label>DOB</label>
            <div class="formRight">
                <input type="text" name="dob" value="" class="datepicker" />
            </div>
            <label>Qualifications</label>
            <div class="formRight">
                <input type="text" name="qualifications" value="" />
            </div>
            <div class="fix"></div>
        </div>
          <div class="rowElem noborder">
            <label>Designation</label>
            <div class="formRight">
                <select name="designation">
                    <option>Select</option>
                    <?php foreach($designation as $list) {?>
                    <option value="<?php echo $list->designation_id;?>"><?php echo $list->designation_name;?></option>
                    <?php }?>
                    </select>
            </div>
            <label>Computer Proficiency</label>
            <div class="formRight">
               <select name="computer_proeficeincy">
                   <option value="">Select</option>
                   <option value="yes">Yes</option>
                   <option value="no">No</option>
                   </select>
            </div>
            <div class="fix"></div>
        </div>
          <div class="rowElem noborder">
            <label>Domicile Place</label>
            <div class="formRight">
                <select name="dp" id="id"  >
                    <option value="0">Select</option>
                    <?php foreach ($district as $list) { ?>
                        <option value="<?php echo $list->district_name; ?>"><?php echo $list->district_name; ?></option>
                    <?php } ?>
                </select>
                
            </div>
            <label>District</label>
            <div class="formRight">
                <select name="district" id="id"  >
                    <option value="0">Select</option>
                    <?php foreach ($district as $list) { ?>
                        <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="fix"></div>
        </div>
          <div class="rowElem noborder">
            <label>Tehsil</label>
            <div class="formRight">
               <select name="tehsil" id="id"  >
                    <option value="0">Select</option>
                    <?php foreach ($subdiv as $list) { ?>
                        <option value="<?php echo $list->tehsil_id; ?>"><?php echo $list->tehsil_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <label>Mauza</label>
            <div class="formRight">
                <select name="mauza" id="id"  >
                    <option value="0">Select</option>
                    <?php foreach ($mauza_list as $list) { ?>
                        <option value="<?php echo $list->mauza_id; ?>"><?php echo $list->mouza_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="fix"></div>
        </div>
         <div class="rowElem noborder">
            <label style="width:163px">Personal Mob No. 1</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="personal_m_no" value="" />
            </div>
            <label style="width:120px">Email</label>
            <div class="formRight" style="width:150px">
              <input type="text" name="m_no_2" value="" /> 
            </div>
            <label style="width:120px">Fallback No.</label>
            <div class="formRight" style="width:150px">
              <input type="text" name="fallback" value="" /> 
            </div>
            <div class="fix"></div>
        </div>
         <div class="rowElem noborder">
            <label>Office Contact No.</label>
            <div class="formRight">
                <input type="text" name="office_contact_no" value="" />
            </div>
            <label>Home Contact No.</label>
            <div class="formRight">
              <input type="text" name="home_contact_no" value="" /> 
            </div>
            <div class="fix"></div>
        </div>
         <div class="rowElem noborder">
            <label>Office Address</label>
            <div class="formRight">
                <textarea rows="4" cols="" name="office_address"  placeholder=""  ></textarea>
            </div>
            <label>Home Address</label>
            <div class="formRight">
              <textarea rows="4" cols="" name="home_address"  placeholder=""  ></textarea>
            </div>
            <div class="fix"></div>
        </div>
        
        
        <div class="rowElem noborder">
          <label>Office Coordinates</label>
            <div class="formRight">
       <input type="text" value="" name="coordinates"  readonly="readonly" id="coordinates"/>
        <input type="hidden" value="" name="o_latitude"   id="lat" />
        <input type="hidden" value="" name="o_longitude" id="lng" /> 
        <br />
    
       <?php 
	   $atts = array(
              'width'      => '960',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );
           echo anchor_popup('map/new_property_map', 'Add Coordinates', $atts);
		?>
                </div>
           <label>Home Coordinates</label>
               <div class="formRight">
       <input type="text" value="" name="coordinates_1"  readonly="readonly" id="coordinates"/>
        <input type="hidden" value="" name="h_latitude"   id="lat_1" />
        <input type="hidden" value="" name="h_longitude" id="lng_1" /> 
        <br />
    
       <?php 
	   $atts = array(
              'width'      => '960',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );
           echo anchor_popup('map/new_property_map', 'Add Coordinates', $atts);
		?>
                </div>
             <div class="fix"></div>
          </div>
        <div class="rowElem noborder">
            <label>Last Three Postings</label>
             <div class="formRight" style="width:78%;">
                 <input type="text" name="district_posting_1" value="" style="width: 41%;"  />
                &nbsp;&nbsp; From
                   <input type="text" name="posting_from_1" value="" class="datepicker" />
                  &nbsp;&nbsp; To
                    <input type="text" name="posting_to_1" value="" class="datepicker" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label></label>
             <div class="formRight" style="width:78%;">
                 <input type="text" name="district_posting_2" value="" style="width: 41%;"  />
                    &nbsp;&nbsp; From
                   <input type="text" name="posting_from_2" value="" class="datepicker" />
                  &nbsp;&nbsp; To
                    <input type="text" name="posting_to_2" value="" class="datepicker" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label></label>
             <div class="formRight" style="width:78%;">
                 <input type="text" name="district_posting_3" value="" style="width: 41%;"  />
                &nbsp;&nbsp; From
                   <input type="text" name="posting_from_3" value="" class="datepicker" />
                  &nbsp;&nbsp; To
                    <input type="text" name="posting_to_3" value="" class="datepicker" />
            </div>
            <div class="fix"></div>
        </div>
         <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('profile', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
         </div>
    </fieldset>