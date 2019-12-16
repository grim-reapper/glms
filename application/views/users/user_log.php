
        <!-- Static table -->
        <div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Users Logs</h5>
        </div>
             <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="5%">Sr. No.</td>
                        <td width="60%">Log Detail</td>
                        <td width="20%">Date</td>
                        <td width="15%">Username</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$i = 1;
				foreach($user_log as $list){
				?>
                	<tr>
                       <td><?php echo $i ;?></td>
                        <td><?php echo $list->log_detail ;?></td>                 
                        <td>
						<?php
						 $datestring = "%d %M %Y - %h:%i:%s %A";
						 $time = gmt_to_local($list->log_date_time,'UP5',TRUE);
						 echo mdate($datestring, $time); 
						 ?></td>
                        <td><?php echo $list->username ;?></td>
                    </tr>
               <?php 
			   $i++;
			   } ?> 	
                </tbody>
            </table>
        </div>
        