                  <?php 
						  switch($type)
						  {
					        case 'district':
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
					        case 'subdiv':
						  {
					?>
                          <option value=""> Select Subdivision</option>
                           <?php
						   foreach($subdiv_list as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->tehsil_id; ?>"><?php echo $qg_list->tehsil_name; ?></option>
                           <?php 
						 
						     }
							   break;
						  }
					        case 'qc':
						  {
					?>
                          <option value=""> Select Qanungoi</option>
                           <?php
						   foreach($qanungoicircle_list as $qg_list) 
						    {
						    ?>
                            <option value="<?php echo $qg_list->q_id; ?>"><?php echo $qg_list->q_circle; ?></option>
                           <?php 
						 
						     }
							   break;
						  }
						   ?>
                       <?php case 'pc': 
					         {
					   ?>
                  
                         <option value="">Select Patwar</option>
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
                  
                        <option value=""> Select  Mauza</option>
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