<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('court/add_group', $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Add Group</h5>
        </div>
        
        <div class="rowElem noborder">
            <label>
                Name of Group
                </label>
            <div class="formRight">
                <input type="text" name="group" value=""/>
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
