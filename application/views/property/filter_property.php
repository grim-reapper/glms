                  <?php 
						  switch($type)
						  {
					        case 'sub':
						  {
					?>
                           <option value="">Select Qanungoi Circle</option>
                           <?php
						   foreach($qanungoicircle_list as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->q_id; ?>"><?php echo $qg_list->q_circle; ?></option>
                           <?php 
						 print_r($property_list);
						     }
							   break;
						  }
						   ?>
                       <?php case 'pc': 
					         {
					   ?>
                  
                         <option value="">Select Patwar Circle</option>
                           <?php
						   foreach($patwarcircle_list as $pc_list) 
						    {
						    ?>
                            <option value="<?php echo $pc_list->p_id; ?>"><?php echo $pc_list->patwar_circle; ?></option>
                           <?php 
						   
						     }
							  break;
						  }
						   ?>
                           
                          <?php case 'mauza': 
					         {
					         ?>
                  
                         <option value="">Select Mauza</option>
                           <?php
						   foreach($mauza_list as $m_list) 
						    {
						    ?>
                            <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
                           <?php 
						   
						     }
							  break;
						  }
						   ?>
               
               
                <?php  }?>