 <option value="0">Select Category</option>
    <?php foreach($category as $list) {?>
    <option value="<?php echo $list->case_category_id; ?>"><?php echo $list->case_category_name; ?></option>
    <?php } ?>