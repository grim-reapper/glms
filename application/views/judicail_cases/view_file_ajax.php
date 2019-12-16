<table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <th>S#</th>
                        <th>Date</th>
                        <th>Case#</th>
                        <th>Mauza</th>
                        <th>Petitioner</th>
                        <th>Respondant</th>
                        <th>Case Category</th>
                        <th>Proceedings</th>
                        <th>Summary</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                     <?php if(count($cases)>0)
                     { ?>
                    <tr class="gradeA">
                       
                        
                        <?php $i=1; foreach ($cases as $list) {
                                     ?>
                        <td style="text-align: center;"><?php echo $i++;?></td>
                        <td style="text-align: center;"><?php echo date('d', strtotime($list->date_of_hearing)); ?>
                            <?php echo date('M', strtotime($list->date_of_hearing)); ?> 
                            <?php echo date('y', strtotime($list->date_of_hearing)); ?> </td>
                        <td style="text-align: center;"><?php echo $list->case_no;?></td>
                        <td><?php echo $list->mouza_name;?></td>
                        
                       <?php if($list->suing_counsel == NULL)
                        {
                          $att =array(
                            'class'=>" leftDir mr20 ml20 lawyerbutton",
                            'title'=> 'Required',
                            
                        );} else {
                              $att =array(
                            'class'=>" leftDir mr20 ml20 lawyerbutton",
                            'title'=> $list->suing_counsel
                        );
                            
                            
                        }
                       ?>
                        
                        <td><?php echo $list->suing_party_name ;?><?php  echo anchor('#'.$list->case_id,'vei',$att); ?></td>
                        
                       
                         
                          <?php if( $list->defending_party_counsel == NULL)
                        {
                          $att =array(
                            'class'=>" leftDir mr20 ml20 lawyerbutton",
                            'title'=> 'Required',
                            
                        );} else {
                              $att =array(
                            'class'=>" leftDir mr20 ml20 lawyerbutton",
                            'title'=>  $list->defending_party_counsel
                        );
                            
                            
                        }
                       ?>
                         <td ><?php echo $list->defending_party_name ;?><?php  echo anchor('#'.$list->case_id,'View',$att); ?></td>
                      
                        <td ><?php echo $list->case_tittle_name  ;?></td>
                        <td ><?php echo $list->proceedings_name ;?></td>
                       
                       <?php $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $list->Notes
                        );?>
                        
                       <td style="text-align: center;"><?php  echo anchor('#'.$list->case_id,'View',$att); ?></td>
                        <td align="center">
                       <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->case_id?>" onclick="list_action(<?php echo $list->case_id ?>);"   />
                        <ul id="list_action" class="list_action_<?php echo $list->case_id;  ?>">
                        
                 	<?php
					
                                                       echo ' <li>';
						       echo anchor('judicial_cases/edit/'.$list->case_id,'Update');
							echo ' </li>';
							
                                                        echo ' <li>';
                                                       echo anchor('judicial_cases/delete/'.$list->case_id,'Delete');
							echo ' </li>';
                                                        echo ' <li>';
                                                       echo anchor('judicial_cases/edit_file/'.$list->case_id,'Edit');
							echo ' </li>';
						
			        	
						 
						 ?>
              </ul>
                        </td>
                        
                        
                       
                        
                        
                        
                    </tr>
                        <?php }}else {?>
                    <tr>
                        <td colspan="6">Yet No records Found</td>
                        </tr>
                        <?php }?>
                </tbody>
               
            </table>
