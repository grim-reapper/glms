<div class="widget first_form">
    <div class="head"><h5 class="iFrames">Profiles <?php echo $group; ?></h5>
        <?php
        $attributes = array('class' => 'basicBtn header_button', 'style' => ' margin-right: 290px;');
        $attributes1 = array('class' => 'basicBtn header_button');
        echo anchor('profile/add/' . $group, 'Add Profile', $attributes);
        ?>
    </div>
    <div id="case_list">
        <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Present Posting</th>
                    <th>Stay</th>
                    <th>Domicile District</th>
                    <th>Computer No</th>
                    <th>Service Length</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Mobile No</th>
                    <th>Fallback</th>
                    <th>Detail</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($profile_data as $list) {

                    if ($list->posting_from_1 == NULL || $list->posting_from_1 == '0000-00-00 00:00:00') {
                        $years = '';
                        $months = '';
                    } else {
                        $current_date = date('Y-m-d');
                        $posting_date = date('Y-m-d', strtotime($list->posting_from_1));
                        //echo $posting_date;
                        $diff = strtotime($current_date) - strtotime($posting_date);
                        $years = floor($diff / (365 * 60 * 60 * 24));
                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        //echo $years.' '.$months;
                    }
                    if ($list->doe == NULL || $list->doe == '0000-00-00 00:00:00') {
                        $years = '';
                        $months = '';
                    } else {
                        $current_year = date('Y');
                        $year_service = date('Y', strtotime($list->doe));
                        $sevice_lenght = $current_year - $year_service;
                    }
                    ?>

                    <tr class="gradeA">
                        <td> <?php echo $list->profile_name; ?></td>
                        <td><?php echo $list->posting_district_1; ?></td>
                        <td><?php if ($list->posting_from_1 == NULL || $list->posting_from_1 == '0000-00-00 00:00:00') {
                    
                } else {
                    echo $years . ' Year' . $months . ' Months';
                }
                ?></td>
                        <td><?php echo $list->domicile_place; ?></td>
                        <td><?php echo $list->personal_comp_no; ?></td>
                        <td align="center"><?php  if ($list->doe == NULL || $list->doe == '0000-00-00 00:00:00') {
                        } else {echo $sevice_lenght; } ?></td>
                        
                        <td><?php echo $list->dob; ?></td>
                        <?php $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $list->home_address
                        );?>
                        <td><?php  echo anchor('#'.$list->profile_id,'View',$att); ?></td>
                        <td><?php echo $list->personal_m_no; ?></td>
                         <?php $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $list->fallbacak_no
                        );?>
                        <td align="center"><?php  echo anchor('#'.$list->profile_id,'View',$att); ?></td>
                        <td width="8"  align="center"> 

                            <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->profile_id ?>" onclick="list_action(<?php echo $list->profile_id ?>);"   />

                            <ul id="list_action" class="list_action_<?php echo $list->profile_id; ?>" style="margin-right: 9px;
                                margin-top: -6px;"   >

    <?php
    echo ' <li>';
    echo anchor('profile/view_profile/' . $list->profile_id, 'View');
    echo ' </li>';
    
    echo ' <li>';
    echo anchor('profile/edit_profile/' . $list->profile_id, 'Edit');
    echo ' </li>';
    echo ' <li>';
    echo anchor('profile/delete/' . $list->profile_id, 'Delete');
    echo ' </li>';
    ?>
                            </ul>



                        </td>


                    </tr>
<?php } ?>
            </tbody>

        </table>

    </div>
</div>


