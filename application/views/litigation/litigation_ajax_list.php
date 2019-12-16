           <?php if(count($litigation_list)>0){ ?>
            <?php foreach($litigation_list as $list){ ?>
                <?php
				
				if( $this->mdl_litigation->next_date_by_litigation($list->litigation_id)< date("Y-m-d",time()))
				{
					$style='color:red;';
				}
				else
				{
					$style='';
			    }
				?>
                	<tr class="gradeA" >
                        <td><?php echo $list->case_number; ?></td>
                         <td><?php  echo str_replace('Cases','',$list->category_name); ?></td>
                        <td>
						<?php echo $this->mdl_litigation->suing_party_name_by_litigation($list->litigation_id); ?>
                        </td> 
                        <td><?php echo $list->property_title; ?></td>
                        <td align="right" width="90">
                            <div class='kanal'> <?php echo $list->area_kanal; ?></div> 
                            <div class='kanal'> <?php echo $list->area_marla; ?> </div> 
                            <div class='sqft'><?php echo $list->area_sqft; ?></div>
                        </td>
                        
                        <td><?php echo $list->mouza_name; ?></td>
                        <td><?php echo $list->official_concerned; ?></td>
                        <td><?php echo $list->contact_number; ?></td>
                        <td class="<?php echo $style;?>">
						<?php
						    if( $this->mdl_litigation->next_date_by_litigation($list->litigation_id)!='1970-01-01' ){
							$datestring = "%d - %m - %y";
						    $time = strtotime($this->mdl_litigation->next_date_by_litigation($list->litigation_id));
							echo mdate($datestring, $time);
							}else
							{
							 echo "Not Fixed"; 	
							}
						 ?>
                       </td>
                        <td align="center">
<img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->litigation_id?>" onclick="list_action(<?php echo $list->litigation_id?>);"   />
                        <ul id="list_action" class="list_action_<?php echo $list->litigation_id; ?>"   >
                        
						<?php
						 if($this->mdl_users->get_permission('litigation_view')){
							echo ' <li>';
					    	echo anchor('litigation/view_detail/'.$list->litigation_id,'View');
							echo ' </li>';
						 }
						  if($this->mdl_users->get_permission('litigation_update')){
                          echo ' <li>';
                          echo anchor('litigation/action/'.$list->litigation_id,'Update');
						  echo ' </li>';
	                     }
						if($this->mdl_users->get_permission('litigation_edit')){
							echo ' <li>';
					    	echo anchor('litigation/edit/'.$list->litigation_id,'Edit');
							echo ' </li>';
						 }
						
						if($this->mdl_users->get_permission('litigation_delete')){
							echo ' <li>';
					    	echo anchor('litigation/delete_litigation/'.$list->litigation_id,'Delete');
							echo ' </li>';
						 }
						?>
                       </ul>
                        </td>
                    </tr>
                <?php 
				
				 } 
		   }
		   else
		   { ?>	
           <tr>
           <td colspan="10" align="center"> No Records Found</td>
           </tr>
    <?php  } ?>