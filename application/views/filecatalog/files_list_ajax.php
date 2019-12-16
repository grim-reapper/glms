
            <table cellpadding="0" cellspacing="0" width="100%" class="display" >
            	<thead>
                	<tr>
                        <th>File ID</th>
                        <th>Key Name</th>
                        <th>Category</th>
                        <th>Subject</th>
                        <th>Mouza</th>
                        <th>Status</th>
                        <th>Age</th>
                        <th>Almirah No</th>
                        <th>Rack No</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php foreach ($f_lists as $lists) {
                                     ?>
                        <td style="text-align: center;"><?php echo anchor('filescatalog/file_view/'.$lists->file_id,$lists->unique_file);?></td>
                        <td><?php echo $lists->file_occupant_name; ?></td>
                        <td><?php echo $lists->case_category_name; ?> </td>
                        <?php $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $lists->Subject
                        );?>
                        <td style="text-align: center;"><?php  echo anchor('filescatalog/file_view/'.$lists->file_id,'View',$att); ?></td>
                        <td><?php if($lists->mauza_id==0) { echo 'Universal';} else { echo $lists->mouza_name;} ?></td>
                        <td><?php echo $lists->file_availability ?></td>
                        <td style="text-align: center;"><?php if($lists->start_year== 0 or $lists->start_year ==''){
        echo '';} else { echo  date('Y', time())- $lists->start_year;}?></td>
                        <td style="text-align: center;"><?php echo $lists->file_almirah_no; ?></td>
                        <td style="text-align: center;"><?php echo $lists->file_rack_no; ?></td>
                        <td> <?php echo anchor('filescatalog/file_view/'.$lists->file_id,'view');?>
                        <?php echo anchor('filescatalog/delete/'.$lists->file_id,'|delete');?>
                        
                        </td>
                        
                        
                        
                    </tr>
                    <?php }?>
                </tbody>
               
            </table>
