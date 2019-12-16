   <?php if(count($property_list)>0){ ?>
   <?php 
	 foreach($property_list as $list)
	 {
	   $occ = $this->mdl_property->get_occupant_by_property($list->property_id,$list->occupation_type );

	  ?>
      <tr class="gradeA">
      
        <td><?php echo $list->unique_property ;?></td>
        <td><?php echo $occ['occupant_name'];?></td>
        <td><?php echo $occ['occupant_status'];?></td>
        <td><?php echo $list->mouza_name;?></td>
        <td  align="right"> 
        <div class='kanal'> <?php echo $list->area_kanal; ?></div> 
        <div class='kanal'> <?php echo $list->area_marla; ?> </div> 
        <div class='sqft'><?php echo $list->area_sqft; ?></div>
        </td>
        <td><?php echo $occ['occupant_usage'];?></td>
        
        <td>
		  <?php echo round((($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->market_rate ,0);?>
        </td>
        <td><?php 
       if($list->occupation_type!="Vacant Land")
		{       
			if($occ['occupation_year']==0)
			{
				echo "Required";
			}
			else
			{
			   echo  date('Y',time())- $occ['occupation_year'];
			}
		}
		else
		{
			echo "Vacant Land";
		}

		?></td>
        <td><?php echo $list->property_id;?></td>
        <td><?php echo $occ['occupant_contact'];?></td>
        
        <td width="8"  align="center">
 <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->property_id?>" onclick="list_action(<?php echo $list->property_id ?>);"   />
        
        <ul id="list_action" class="list_action_<?php echo $list->property_id; ?>"   >
                        
                 	<?php
						 if($this->mdl_users->get_permission('property_view')){
							echo ' <li>';
						    echo anchor('property/property_detail/'.$list->property_id,'View');
							echo ' </li>';
						 }
		                if($this->mdl_users->get_permission('property_edit')){
							echo ' <li>';
						    echo anchor('property/edit_property/'.$list->property_id,'Edit');
							echo ' </li>';
						 } 
			        	if($this->mdl_users->get_permission('property_delete')){
							echo ' <li>';
						    echo  anchor('property/delete_property/'.$list->property_id,'Delete');
							echo ' </li>';
						 }
						 ?>
              </ul>
        </td>
      </tr>
      <?php } } else { ?>
           <tr>
           <td colspan="10" align="center"> No Records Found</td>
           </tr>
    <?php  } ?>