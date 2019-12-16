

<div class="widget ">

  <div class="head">
    <h5>USER PROFILE</h5>
  </div>
 
    <div class="rowElem noborder">
      <div class="label"> Name: </div>
      <div class="cotent"><?php echo $user->name; ?> </div>
      <div class="label"> Picture: </div>
      <div class="pic"> <img src="<?php echo base_url();?>/asset/images/avatar.png"  /></div>
    </div>
     <div class="rowElem ">
      <div class="label">Group Name: </div>
      <div class="cotent"> <?php echo $access_level; ?> </div>
      <div class="label">Access Level: </div>
      <div class="cotent">
       <?php 
	  if($user->group_id == 1 || $user->group_id == 2)
	  {
		 echo 'All'; 
	  }
	  
	  else if($user->group_id  == 3)
	  {
		 echo $tehsil_name; 
	  }
	  
	  elseif($user->group_id  == 4)
	  {
		 echo $qanungoi_name;   
	  }
	  elseif($user->group_id  == 5)
	  {
		 echo $patwarcircle;  
	  }
	  ?> 
      </div>
    </div>
    
    <div class="rowElem Odd">
      <div class="label">Username : </div>
      <div class="cotent"> <?php echo $user->username; ?> </div>
      <div class="label"> Email: </div>
      <div class="cotent"> <?php echo $user->email; ?> </div>
    </div>
    <div class="rowElem">
      <div class="label"> Register Date: </div>
      <div class="cotent">
       <?php 
	            $datestring = "d M Y - h:i:s A";
				$time = strtotime($user->registerDate);
				echo date($datestring, $time); 
	  ?> 
      </div>
      <div class="label"> Last Visiting Date: </div>
      <div class="cotent">
          <?php 
	  	        $datestring = "d M Y - h:i:s A";
				$time = strtotime($user->lastvisitDate);
				echo date($datestring, $time); 
	      ?>
       </div>
    </div>
    <div class="rowElem Odd">
      <div class="label">Phone Number: </div>
      <div class="cotent"> <?php echo $user->phone_number; ?> </div>
      <div class="label">Block: </div>
      <div class="cotent"> <?php if($user->block == 0){ echo 'No'; }else{ echo 'Yes';} ?> </div>
    </div>
    
 <div class="fix"></div>
    <div class="rowElem ">
     <h3>User's Permissions </h3>
    </div>
    <div class="rowElem Odd">
     <table class="tableStatic" cellspacing="0" cellpadding="0" width="100%">
        <thead>
          <tr>
            <th width="10%"> Sr. No. </th>
            <th> Permissions </th>
            <th  width="20%"> status </th>
           
           
          </tr>
        </thead>
        <tbody>
     <?php
	  $i = 1;
		foreach($user_permission as $list)
		{
	 ?>
           <tr>
            <td  align="center">  <?php echo $i ;?> </th>
            <td style="text-transform:capitalize;"> <?php echo str_replace("_","  ",$list->user_roll);?> </td>
            <td align="center" > 
			<?php if($list->status == 1) 
			{
				$scr = 'accept.png';
			}
			else
			{
			    $scr = 'exclamation.png';	
			}
			?> 
            <img src="<?php echo base_url().'/asset/images/icons/notifications/'.$scr ; ?>"  />
            </td>
           
          </tr>
     <?php $i++; } ?>
        </tbody>
      </table>
    </div>   
    
 <div class="fix"></div>
  </div>
  <div class="fix"></div>

  

