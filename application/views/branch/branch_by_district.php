<option value=""> Select Branch </option>
<?php
foreach ($branch as $b_list) {
    ?>
    <option value="<?php echo $b_list->branch_id; ?>"><?php echo $b_list->branch_name; ?></option>
    <?php
}