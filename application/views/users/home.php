
        <!-- Static table -->
        <div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Users Management (<?php echo $user_group; ?>)</h5>
             <?php
			  if($this->mdl_users->get_permission('users_add')){
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('users/add_user','Add New',$attributes);
			  }
			  ?>
            </div>
             <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td >Sr. No.</td>
                        <td>Name</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Group Name</td>
                        <td>Last Time Visit</td>
                        <td>Phone Number</td>
                        <td>Block</td>
                        <?php if($this->mdl_users->get_permission('users_log')){ ?>
                        <td>Log Details</td>
                         <?php } ?>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$i = 1;
				foreach($users_list as $list){
				?>
                	<tr>
                       <td><?php echo $i ;?></td>
                        <td><?php echo $list->name ;?></td>
                        <td><?php echo $list->username ;?></td>
                        <td><?php echo $list->email ;?></td>
                        <td><?php echo $list->group_name ;?></td>
                        <td>
						<?php
						 $datestring = "%d %M %Y - %h:%i:%s %A";
						 $time = gmt_to_local($list->lastvisitDate,'UP5',TRUE);
						 echo mdate($datestring, $time); 
						 ?></td>
                        <td><?php echo $list->phone_number ;?></td>
                        <td><?php if( $list->block == 0) {echo "No";} else {echo "Yes";} ?></td>
                        
                        <?php if($this->mdl_users->get_permission('users_log')){ ?>
                        
                        <td><?php echo anchor("users/log_view/".$list->user_id,'View') ;?></td>
                        
                        <?php } ?>
                        
                        <td><?php 
						 if($this->mdl_users->get_permission('users_view')){
						echo anchor("users/view_detail/".$list->user_id,'View') ;
						 }
					   if($this->mdl_users->get_permission('users_edit')){
						echo ' | ';
						echo anchor("users/edit_user/".$list->user_id,'Edit') ;
					   }
					    if($this->mdl_users->get_permission('users_delete')){
						echo ' | ';
						echo anchor("users/delete_user/".$list->user_id,'Delete') ;
						}
						?></td>
                    </tr>
               <?php 
			   $i++;
			   } ?> 	
                </tbody>
            </table>
        </div>
        