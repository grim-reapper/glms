<?php
$attributes = array('class' => 'mainForm');

echo form_open('court/update_case_category', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form"> 
        <div class="head">
            <h5 class="iList">Proceedings Edit Form</h5>
        </div>
        <div class="rowElem">
            <label>Proceeding Name</label>
            <div class="formRight">
                <input type="text" name="case_category" value="<?php echo $c_category->case_tittle_name;?>">
                <input type="hidden" name="id" value="<?php echo $c_category->case_tittle_id;?>">
                </div>
            <label>Class Of Cases</label>
            <div class="formRight">
                 <select name="class_case">
                    <?php if($c_category->class_cases == 'Revenue'){?>
                    <option value="Revenue" selected="selected">Revenue</option>
                    <option value="General">General</option>
                    <?php } else {?>
                    <option value="Revenue">Revenue</option>
                    <option value="General" selected="selected">General</option>
                    <?php }?>
                    </select>
                
                </div>
            <div class="clear"></div>
            </div>
        <div class="rowElem">
            <label>District</label>
            <div class="formRight">
                  <select name="district" >
                    <?php foreach ($district as $list) { ?>
                        <?php if ($list->district_id == $c_category->district_id) { ?>
                            <option value="<?php echo $list->district_id; ?>" selected="selected"><?php echo $list->district_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
                    <?php }}?>
                </select>
                
                </div>
            <label>Court Category</label>
            <div class="formRight">
                  <select name="category" >
                    <?php foreach ($category as $list) { ?>
                        <?php if ($list->court_category_id == $c_category->court_category_id) { ?>
                            <option value="<?php echo $list->court_category_id; ?>" selected="selected"><?php echo $list->court_category_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->court_category_id; ?>"><?php echo $list->court_category_name; ?></option>
                    <?php }}?>
                </select>
                
                </div>
            <div class="clear"></div>
            </div>
         <div class="rowElem  noborder">
        <label></label>
         <div class="formRight">
          <input type="submit"   name="submit" value="Save" class="basicBtn"  />
			  <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('court/groups_proceedings_category','Cancel',$attributes);
              ?>
        </div>
        <div class="fix"></div>
        </div>
            
            </div>
        
      
    </fieldset>
        