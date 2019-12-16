<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('court/add_proceedings', $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Add Proceedings</h5>
        </div>
        <div class="rowElem noborder">
            <label>District</label>
            <div class="formRight">
                <select name="district">
                    <option >Select</option>
                        <?php foreach ($district as $list) {?>
                       <option value="<?php echo $list->district_id;?>"><?php echo $list->district_name;?></option>
                        <?php }?>
                    </select>
                </div>
            <label>Court Category</label>
            <div class="formRight">
                <select name="category">
                    <option>Select</option>
                        <?php foreach ($category as $list) {?>
                       <option value="<?php echo $list->court_category_id;?>"><?php echo $list->court_category_name;?></option>
                        <?php }?>
                    </select>
                </div>
            <div class="clear"></div>
            </div>
        <div class="rowElem noborder">
            <label>Class of Cases</label>
            <div class="formRight">
                <select name="class_case">
                    <option>Select</option>
                    <option value="Revenue">Revenue</option>
                    <option value="General">General</option>
                    </select>
                
                </div>
            <label>Enter new Proceedings</label>
            <div class="formRight">
                <input type="text" name="proceeding_name" value="" />
                </div>
            <div class="clear"></div>
            </div>
        <div class="rowElem">
            <label>Group</label>
            <div class="formRight">
                <select name="group">
                    <option>Select</option>
                    <?php foreach ($groups as $list){?>
                    <option value="<?php echo $list->group_id;?>"><?php echo $list->group_name;?></option>
                    <?php }?>
                    </select>
                </div>
            <div class="clear"></div>
            </div>
        <div class="rowElem">
            <label style="width:275px;">
                View Groups,Proceedings,Case Category
                </label>
            <div class="formRight">
                <?php
                 echo anchor('court/groups_proceedings_category','Click Here');
                 ?>
                </div>
            </div>
        
         <div class="rowElem">
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
        