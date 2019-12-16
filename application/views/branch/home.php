<div class="widget first_form">
    <div class="head"><h5 class="iFrames">Branch</h5>  
        <?php
        $attributes = array('class' => 'basicBtn header_button');
        echo anchor('filescatalog/add_branch', 'Add Branch', $attributes);
        echo anchor('filescatalog/add_category', 'Add Category', $attributes);
        ?>
    </div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
        <thead>
            <tr>
                <th width="10%">Sr No </th>
                <th width="15%">District</th>
                <th width="20%">Branch Name</th>
                <th width="15%" >Branch Code</th>
                <th width="15%">Category Name</th>
                <th width="15%">Category Code</th>
                `<th width="10%">Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $i = 0;
                foreach ($branch as $lists) {
                    $this->load->model('mdl_filescatalog');
                    $case_category = $this->mdl_filescatalog->get_case_category($lists->branch_id);
                    if (count($case_category)) {

                        foreach ($case_category as $lists) {
                            ?>
                            <td style="text-align: center ;"><?php echo++$i; ?></td>
                            <td><?php echo $lists->district_name; ?></td>
                            <td><?php echo $lists->branch_name; ?></td>
                            <td style="text-align: center ;"><?php echo $lists->branch_code ?> </td>
                            <td> <?php echo $lists->case_category_name; ?></td>
                            <td> <?php echo $lists->case_category_code; ?></td>
                            <td  style="text-align: center ;"> <?php echo anchor('filescatalog/edit_branch/' . $lists->branch_id . '/' . $lists->case_category_id, 'Edit'); ?>
                          </td>
                         </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td style="text-align: center ;"><?php echo++$i; ?></td>
                        <td><?php echo $lists->district_name; ?></td>
                        <td><?php echo $lists->branch_name; ?></td>
                        <td style="text-align: center ;"><?php echo $lists->branch_code ?> </td>
                        <td></td>
                        <td></td>
                        <td  style="text-align: center ;"> <?php echo anchor('filescatalog/edit_branch1/' . $lists->branch_id, 'Edit'); ?>

                       </td>
                    </tr>

                <?php } ?>
            <?php } ?>
        </tbody>

    </table>
</div>
