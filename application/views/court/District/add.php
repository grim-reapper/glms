<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<script type="text/javascript">
$(function(){
	$("#select").multiselect();
});

function GetValueFromChild(lat,lng)
    {
        document.getElementById("coordinates").value = lat+","+lng;
		document.getElementById("lat").value = lat;
		document.getElementById("lng").value = lng;
    }

</script>
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('court/add_divisional_court', $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Add District Court Form</h5>
        </div>
        <div class="rowElem">
            <label>District</label>
            <div class="formRight">
                <select name="territory">
                    <option value="0">Select</option>
                    <?php foreach ($district as $list){?>
                    <option value="<?php echo $list->district_id;?>"><?php echo $list->district_name;?></option>
                    <?php }?>
                    </select>
                </div>
            <label>Station
                </label>
            <div class="formRight">
                <input type="text" name="station" value=""/>
                </div>
            <div class="clear"></div>
            </div>
    
    <div class="rowElem noborder">
        <label>Category of Court</label>
        <div class="formRight">
        <select name="category">
            <option value="0">Select</option>
            <?php foreach ($category as $list){?>
            <option value="<?php echo $list->court_category_id;?>"><?php echo $list->court_category_name;?></option>
            <?php }?>
        </select>
            </div>
        <label>Class of Cases</label>
        <div class="formRight">
            <select name="class_case">
                <option value="Revenue">Revenue</option>
                <option value="General">General</option>
            </select>
            </div>
        <div class="clear"></div>
        </div>
        
        <div class="rowElem noborder">
            <label>Name of Officer</label>
            <div class="formRight">
                <input type="text" name="name_of_officer" value="" />
                </div>
            <label>Date of Posting</label>
            <input type="text" name="DOP" value="" class="datepicker" />
            <div class="clear"></div>
            </div>
        <div class="rowElem noborder">
            <label>DOB</label>
            <div class="formRight">
                <input type="text" name="DOB" value="" />
                </div>
            <label>Start Time</label>
            <div class="formRight">
            <input type="text" name="ST" value=""  />
            </div>
            <div class="clear"></div>
            </div>
        
    
       
        <div class="rowElem noborder">
            <label>Working Days</label>
            
            <div class="formRight">
        
        <select title="Basic example" multiple="multiple" id="select" name="working[]" size="5" style="width:325px;">
	<option value="Monday">Every Monday</option>
	<option value="Tuesday">Every Tuesday</option>
	<option value="Wednesday">Every Wednesday</option>
	<option value="Thursday">Every Thursday</option>
	<option value="Friday">Every Friday</option>
	<option value="Saturday">Every Saturday</option>
	<option value="Sunday">Every Sunday</option>
	</select>
                </div>
            <label>Contact</label>
            <div class="formRight">
                <input type="text" name="contact" value="" />
              </div>
            <div class="clear"></div>
            </div>
        <div class="rowElem noborder">
            <label>Address of Court</label>
            <div class="formRight">
                <textarea rows="4" cols="" name="address"  placeholder=""  ></textarea>
                </div>
            <label>Google Coordinates</label>
            <div class="formRight">
       <input type="text" value="" name="coordinates"  readonly="readonly" id="coordinates"/>
        <input type="hidden" value="" name="latitude"   id="lat" />
        <input type="hidden" value="" name="longitude" id="lng" /> 
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
            <div class="clear"></div>
        </div>
        
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
        <?php echo form_close();?>
       
    
    </div>
    </fieldset>
