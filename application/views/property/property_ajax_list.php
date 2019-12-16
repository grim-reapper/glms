    <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
    <thead>
      <tr>
        <th>Property ID</th>
        <th>Occupied By</th>
        <th>Status</th>
        <th>Mauza</th>
        <th >K-M-SQFT</th>
        <th>Usage</th>
        <th>M.Value</th>
         <th>DC.Value</th>
        <th>Period</th>
        <th>Contact</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
   <?php 
 	  $dc_value = 0;
	  $s_value 	= 0;
	  $t_marla  = 0;
	  $t_kanal  = 0;
	  $t_sqft   = 0;
   if(count($property_list)>0){ ?>
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
        <td style="text-align:right; padding-right:4px;">
         <?php  printf("%02d", $list->area_kanal); echo '-'; printf("%02d", $list->area_marla); echo '-'; printf("%03d", $list->area_sqft); ?> 
         <?php 
		      $t_kanal  += $list->area_kanal;
		      $t_marla  += $list->area_marla;
		      $t_sqft   += $list->area_sqft;
		 ?>
         </td>
        <td><?php echo $occ['occupant_usage'];?></td>
        
        <td style="text-align:right; padding-right:4px;">
		  <?php echo round((($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->market_rate ,0);?>
          <?php $s_value += (($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->market_rate ;?>
        </td>
          <td style="text-align:right; padding-right:4px;">
             <?php echo round((($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->duty_rate ,0);?>
             <?php  $dc_value +=(($list->area_kanal*20)+$list->area_marla+($list->area_sqft)/225) * $list->duty_rate ; ?>
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
	</tbody>
      <tfoot> 
       <tr>
          <td colspan="3" align="center"><strong>Total Area(K-M-SQFT)</strong> </td>
          <td colspan="4" align="center"><strong>Total Market Value</strong> </td>
          <td colspan="5" align="center"><strong>Total DC.Value</strong> </td>
      </tr>
       <tr>
          <?php 
		   $sq	   = $t_sqft%225;
		   $mr 	   = $t_sqft / 225;
		   $m      = $t_marla + (int)$mr ;
		   $marla  = $m % 20 ;
		   $k      = $m / 20 ;
		   $t_kanal +=  (int)$k ;
		  ?>    
          <td colspan="3" align="center"><strong> 
		   <?php printf("%02d", $t_kanal); echo '-'; printf("%02d", $marla); echo '-'; printf("%03d", $sq); ?>
          </strong> </td>
          <td colspan="4" align="center"><strong> <?php echo  number_format ($s_value);?></strong> </td>
          <td colspan="5" align="center"><strong> <?php echo  number_format ($dc_value);?></strong> </td>
      </tr>
    </tfoot>
  </table>