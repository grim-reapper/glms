<script type="text/javascript" charset="utf-8">
 $(function() {
   $("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			
		});
   
  });
</script>

<fieldset>  
<div class="widget first_form"> 

<div class="head " >
    <h5>Mauza Detail</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('mauza','Close',$attributes);
       ?>
  </div>
    </div>
      
    <div class="body">
<div class="rowElem Odd">
    
         <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
         <thead>
        <tr>
        <th>Mauza Name</th>
        <th>Patwar Circle</th>
        <th>Qanungoi Circle</th>
        <th>Subdivision</th>
        </tr>
       </thead>
       <tbody>
           <tr style="text-align: center;">
               <td><?php echo $mauza->mouza_name;?></td>
               <td><?php echo $mauza->patwar_circle;?></td>
               <td><?php echo $mauza->q_circle;?></td>
               <td><?php echo $mauza->tehsil_name;?></td>
           </tr>
       </tbody>
       </table>
      
       <div class="rowElem Odd">
      <h3 style="background: white; color: #2B6893;">Details</h3>
    </div>
      
      <div class="rowElem">
      <div class="label">Square Feet In Marla: </div>
      <div class="cotent"> <?php echo $mauza->fts_in_one_marla; ?> </div>
      <div class="label">Measurement System:</div>
      <div class="cotent"> <?php echo $mauza->measurement_system; ?> </div>
       </div>
      <div class="rowElem">
      <div class="label">Location: </div>
      <div class="cotent"> <?php echo $mauza->rural_urban; ?> </div>
      <div class="label">BAC:</div>
      <div class="cotent"> <?php $i= $mauza->BAC;
       if($i==0) { echo 'none';}
       else { echo 'yes';}?> </div>
       </div>
     <div class="rowElem">
      <div class="label">Hadbast NO: </div>
      <div class="cotent"> <?php echo $mauza->hadbast; ?> </div>
      <div class="label">Square OR Khasra No:</div>
      <div class="cotent"> <?php echo $mauza->khasra_square_no; ?> </div>
       </div>
     <div class="rowElem">
      <div class="label">Populace: </div><div class="label" style="width:32px;">Male: </div>
      <div class="cotent" style="margin-top: 8px; width: 25px;"> <?php echo $mauza->Male; ?> </div>
      <div class="label" style="width:32px;">Female: </div>
      <div class="cotent" style="margin-top: 8px; width: 25px;"> <?php echo $mauza->Female; ?> </div>
      <div class="label" style="width:32px;">Total: </div>
      <div class="cotent" style="margin-top: 8px; width: 25px;"> <?php echo $mauza->total; ?> </div>
       <div class="label">Short History: </div>
      <div class="cotent"> <?php echo $mauza->short_history; ?> </div>
       </div>
      
        <div class="rowElem Odd">
      <h3 style="background: white; color: #2B6893;">Important Places</h3>
    </div>
     <div class="rowElem">
      <div class="label">Educational Institute: </div>
      <div class="cotent"> <?php $var = json_decode($mauza->educational_institute); $temp=1; 
            for($i=0; $i<  count($var); $i++) {  echo $temp."-".$var[$i]."</br>"; $temp++; }?> </div>
      <div class="label">Hospitals:</div>
      <div class="cotent"> <?php 
      $var=array();
      $var = json_decode($mauza->Hospitals);
      if(count($var)>0)
      {
       foreach ($var as $list):
        echo $list."</br>";
      endforeach; } else { echo ''; }?> </div>
       </div>
     <div class="rowElem">
      <div class="label">Markets: </div>
      <div class="cotent"> <?php
      $var=array();
      $var = json_decode($mauza->Markets); $temp=1; 
      if(count($var)>0)
      {
           foreach ($var as $list):
        echo $temp."-".$list."</br>";
           $temp++;
      endforeach;} else {
        echo '';}?> </div>
      <div class="label">Roads:</div>
      <div class="cotent"> <?php 
      $var=array();
      $var = json_decode($mauza->Roads); $temp=1;
      if(count($var)>0) {
      foreach ($var as $list):
        echo $temp."-".$list."</br>";
       $temp++;
      endforeach;} else{
        echo '';} ?> </div>
       </div>
     <div class="rowElem">
      <div class="label">Archeological_Sites: </div>
      <div class="cotent"> <?php 
      $var=array();
      $var = json_decode($mauza->Archeological_Sites); $temp=1; 
   if(count($var)>0){
      foreach ($var as $list):
        echo $temp."-".$list."</br>";
           $temp++;
   endforeach;} else {
        echo '';}?> </div>
      <div class="label">Industries:</div>
      <div class="cotent"> <?php
      $var=array();
      $var = json_decode($mauza->Industries); $temp=1;
      if(count($var)>0){
      foreach ($var as $list):
        echo $temp."-".$list."</br>";
       $temp++;
      endforeach;} else {
        echo '';} ?> </div>
       </div>
     <div class="rowElem">
      <div class="label">River and Canals: </div>
      <div class="cotent"> <?php 
      $var=array();
      $var = json_decode($mauza->Rivers_Canals); $temp=1; 
      if(count($var)>0){
      foreach ($var as $list):
        echo $temp."-".$list."</br>";
           $temp++;
      endforeach;} else {    echo '';}?> </div>
      <div class="label">Others:</div>
      <div class="cotent"> <?php 
      $var=array();
      $var = json_decode($mauza->others); $temp=1;
      if(count($var)>0){
      foreach ($var as $list):
        echo $temp."-".$list."</br>";
       $temp++;
      endforeach;} else {    echo '';} ?> </div>
       </div>
    
    <div class="fix"></div>
   
    <div class="widget"   >
    <div class="head " style="background: white;" >
    <h5 style="background: white;">PROPERTY PROFILE</h5>
     <div id="profile_options">
        <?php if($mauza->massive_uploads=='Massive_picture_pic'){ ?>
        <a class="disable_link"  href="#" > Mussavie </a>
        <?php }else{?>
        <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$mauza->massive_uploads; ?>" > Mussavie </a>
        <?php } ?>
        <?php if($mauza->photos=="photos_pic"){ ?>
        <a class="disable_link" href="#">Photos</a>
        <?php }else {?>
         <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$mauza->photos; ?>"> Photos</a>
        <?php } ?>
         
          <?php 
		if( $mauza->latitude !='' and $mauza->longitude !='' )
		{
		$atts = array(
              'width'      => '900',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '20',
              'screeny'    => '20'
            );
           echo anchor_popup('map/property_map_marker/'.$mauza->mauza_id, 'Google Map', $atts);
		}else{
		?>
       <a class="disable_link"  href="#">Google Map</a> 
       <?php } ?>
       
       <?php if($mauza->documents=='document_'){ ?>
        <a class="disable_link"  href="#" > Documents </a>
        <?php }else{?>
        <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$mauza->documents; ?>" > Document </a>
        <?php } ?>
       <?php if($mauza->index_map=='index_map_'){ ?>
        <a class="disable_link"  href="#" > Index map </a>
        <?php }else{?>
        <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$mauza->index_map; ?>" > Index Map </a>
        <?php } ?>
         </div>
    </div>
        </div>
    
      <div class="rowElem">
      <div class="label">Events And Festivals: </div>
      <div class="cotent"> <?php echo $mauza->events_festivals; ?> </div>
      <div class="label">Celebrities:</div>
      <div class="cotent"> <?php echo $mauza->celebrities; ?> </div>
       </div>
      <div class="rowElem">
      <div class="label">Lambardas: </div>
      <div class="cotent"> <?php echo $mauza->lambardras; ?> </div>
      <div class="label">Contact No:</div>
      <div class="cotent"> <?php echo $mauza->contact_no; ?> </div>
       </div>
      <div class="rowElem">
      <div class="label">NA No: </div>
      <div class="cotent"> <?php echo $mauza->na_no; ?> </div>
      <div class="label">Electricity:</div>
      <div class="cotent"> <?php $status= $mauza->electricity; if($status==0){echo 'NO';} else { echo'YES';}?> </div>
       </div>
      <div class="rowElem">
      <div class="label">PP No: </div>
      <div class="cotent"> <?php echo $mauza->pp_no; ?> </div>
      <div class="label">Sui Gas:</div>
      <div class="cotent"> <?php $status= $mauza->sui_gas; if($status==0){echo 'NO';} else { echo'YES';}?> </div>
       </div>
      <div class="rowElem">
      <div class="label">UC No: </div>
      <div class="cotent"> <?php echo $mauza->uc_no; ?> </div>
      <div class="label">Water Supply:</div>
      <div class="cotent"> <?php $status= $mauza->water_supply; if($status==0){echo 'NO';} else if($status==1){ echo'YES';} else {echo'';}?> </div>
       </div>
    <div class="rowElem">
      <div class="label">Police Station: </div>
      <div class="cotent"> <?php echo $mauza->police_station; ?> </div>
      </div>
  
        <div class="fix"></div>
      </div>
        </div>
    
      
</fieldset>
      
   
        
 
  