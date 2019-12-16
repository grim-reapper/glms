<?php
$attributes = array('class' => 'mainForm');

echo form_open('court/update', $attributes);
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
                <input type="text" name="proceeding_name" value="<?php echo $proceedings->proceedings_name;?>">
                <input type="hidden" name="id" value="<?php echo $proceedings->proceedings_id;?>">
                </div>
            <label>Group</label>
            <div class="formRight">
                <select name="group" >
                    <?php foreach ($groups as $list) { ?>
                        <?php if ($list->group_id == $proceedings->group_id) { ?>
                            <option value="<?php echo $list->group_id; ?>" selected="selected"><?php echo $list->group_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->group_id; ?>"><?php echo $list->group_name; ?></option>
                    <?php }}?>
                </select>
                </div>
            <div class="clear"></div>
            </div>
        <div class="rowElem">
            <label>District</label>
            <div class="formRight">
                  <select name="district" >
                    <?php foreach ($district as $list) { ?>
                        <?php if ($list->district_id == $proceedings->district_id) { ?>
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
                        <?php if ($list->court_category_id == $proceedings->court_category_id) { ?>
                            <option value="<?php echo $list->court_category_id; ?>" selected="selected"><?php echo $list->court_category_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->court_category_id; ?>"><?php echo $list->court_category_name; ?></option>
                    <?php }}?>
                </select>
                
                </div>
            <div class="clear"></div>
            </div>
        
        <div class="rowElem">
            <label>Class of Case</label>
            <div class="formRight">
                <select name="class_case">
                    <?php if($proceedings->class_cases == 'Revenue'){?>
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
        