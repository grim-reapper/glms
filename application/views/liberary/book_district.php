 <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <th>Book ID</th>
                        <th>Book Category</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Edition</th>
                        <th>Ownership</th>
                        <th>Availability</th>
                        <th>Note</th>
                        <th>Detail</th>
                       
                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lib_data as $data) {?>
                    <tr class="gradeA">
                        <td style="text-align: center;"><?php echo $data->book_unique_id;?></td>
                        <td><?php echo $data->book_category;?></td>
                        <td><?php echo $data->book_title;?></td>
                        <td><?php echo $data->book_author;?></td>
                        <td style="text-align: center;"><?php echo $data->book_edition;?></td>
                        <td><?php echo $data->ownership;?></td>
                        <td><?php echo $data->availability;?></td>
                          <?php $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $data->note
                        );?>
                        <td style="text-align: center;"><?php  echo anchor('#','View',$att); ?></td>
                        
                        <td>
                           <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $data->liberary_id ?>" onclick="list_action(<?php echo $data->liberary_id ?>);"   />

                            <ul id="list_action" class="list_action_<?php echo $data->liberary_id; ?>" style="margin-right: 9px;
                                margin-top: -6px;"   >

                                <?php
                                echo ' <li>';
                                echo anchor('liberary/view/' . $data->liberary_id, 'View');
                                echo ' </li>';


                                echo ' <li>';
                                echo anchor('mauza/delete/' . $data->liberary_id, 'Delete');
                                echo ' </li>';
                                ?>
                            </ul>


                       
                      </tr>
                    <?php }?>
                </tbody>
               
            </table>