



<div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Revenue Records</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                echo anchor('revenue/add','Add Revenue Record',$attributes);
             ?>
    </div>
    <div id="file_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <th>Code No</th>
                        <th>Mauza</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Volumes</th>
                        <th>Consign.Date</th>
                        <th>Area</th>
                        <th>Rack No</th>
                        <th>Row No</th>
                        <th>Col No</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php foreach ($revenue_files as $lists) {
                                     ?>
                        <td style="text-align: center;"><?php echo anchor('revenue/file_view/'.$lists->revenue_id,$lists->revenue_code);?></td>
                        <td><?php echo $lists->mouza_name; ?></td>
                        <td style="text-align: center;"><?php echo $lists->revenue_year; ?> </td>
                        <td style="text-align: center;"><?php if($lists->revenue_category =='PR'){ echo 'Periodical';}
                        elseif ($lists->revenue_category=='SR') { echo 'Settlement';}
                        elseif ($lists->revenue_category=='CR') {echo 'Consolidation';}?></td>
                        <td style="text-align: center;"><?php echo $lists->volumes; ?></td>
                        <td style="text-align: center;"><?php  echo date('d', strtotime($lists->consign_date )); ?>
                            <?php echo date('M', strtotime($lists->consign_date )); ?> 
                            <?php echo date('Y', strtotime($lists->consign_date )); ?>  </td>
                        <td style="text-align: center;"><?php echo $lists->area_kanal.'-'.$lists->area_marla.'-',$lists->area_sqft; ?></td>
                        <td style="text-align: center;"><?php echo $lists->rack_no; ?></td>
                        <td style="text-align: center;"><?php echo $lists->row_no; ?></td>
                        <td style="text-align: center;"><?php echo $lists->column_no; ?></td>
                       
                       
                        <td align="center">
                       <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $lists->revenue_id?>" onclick="list_action(<?php echo $lists->revenue_id ?>);"   />
                        <ul id="list_action" class="list_action_<?php echo $lists->revenue_id;  ?>">
                        
                 	<?php
						 
							echo ' <li>';
						    echo anchor('revenue/file_view/'.$lists->revenue_id,'View');
							echo ' </li>';
						
		               
							echo ' <li>';
						    echo anchor('revenue/edit/'.$lists->revenue_id,'Edit');
							echo ' </li>';
							
                                                        echo ' <li>';
                                                       echo anchor('revenue/delete/'.$lists->revenue_id,'Delete');
							echo ' </li>';
						
			        	
						 
						 ?>
              </ul>
                        </td>
                        
                       
                        
                        
                        
                    </tr>
                    <?php }?>
                </tbody>
               
            </table>
        </div>
        </div>
        