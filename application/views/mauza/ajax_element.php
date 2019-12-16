         <?php 
						  switch($type)
						  {
					        case 'division':
						  {
					?>
                          <option value=""> Select District</option>
                           <?php
						   foreach($district_list as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->district_id; ?>"><?php echo $qg_list->district_name; ?></option>
                           <?php 
						 
						     }
							   break;
						  }
                                                  ?>
                            <?php
					        case 'subdiv':
						  {
					?>
                          <option value=""> Select Tehsil</option>
                           <?php
						   foreach($subdiv_list as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->tehsil_id; ?>"><?php echo $qg_list->tehsil_name; ?></option>
                           <?php 
						 
						     }
							   break;
						  }
                                                  
                                                  
                                                  ?>
                            <?php
					        case 'qgcircle':
						  {
					?>
                          <option value=""> Select Qanungoi</option>
                           <?php   
                           
                           
						   foreach($main1 as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->q_id; ?>"><?php echo $qg_list->q_circle; ?></option>
                           <?php 
						 
						     }
							   break;
						  }
                                                 
                                                  
                                                    ?>
                            <?php
					        case 'patwar':
						  {
					?>
                          <option value=""> Select Patwar</option>
                           <?php   
                           
                           
						   foreach($patwar_list as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->p_id; ?>"><?php echo $qg_list->patwar_circle; ?></option>
                           <?php 
						 
						     }
							   break;
						  }
                                                 
                                                  }
                                                    ?>
                                                 
						   

