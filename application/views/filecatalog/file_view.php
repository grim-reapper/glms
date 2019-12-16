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
    <h5>File Detail</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('filescatalog','Close',$attributes);
       ?>
  </div>
    
    </div>
    
     <div class="body">
         <div class="rowElem Odd">
             <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
         <thead>
        <tr>
        <th>Key Name</th>
        <th>Branch Name</th>
        <th>Mauza Name</th>
        <th>Subject</th>
        </tr>
       </thead>
       <tbody>
           <tr style="text-align: center;">
               <td><?php echo $file->file_occupant_name;?></td>
               <td><?php echo $file->branch_name;?></td>
               <td><?php echo $file->mouza_name;?></td>
               <td><?php echo $file->Subject;?></td>
           </tr>
       </tbody>
       </table>
             
             <div class="rowElem Odd">
      <h3 style="background: white; color: #2B6893;">Details</h3>
    </div>
      <div class="rowElem">
      <div class="label">Detail of land: </div>
      <div class="cotent"> <?php echo $file->land_detail; ?> </div>
      <div class="label">Category: </div>
      <div class="cotent"> <?php echo $file->case_category_name; ?> </div>
      
       </div>
      <div class="rowElem">
      <div class="label">Age Of the File:</div>
      <div class="cotent"> <?php if($file->start_year== 0 or $file->start_year ==''){
        echo '';} else { echo  date('Y', time())- $file->start_year;} ?> </div>
      <div class="label">File Add (Date & time):</div>
      <div class="cotent"><?php echo date('d', strtotime($file->time_date)); ?>
                            <?php echo date('M', strtotime($file->time_date)); ?> 
                            <?php echo date('Y', strtotime($file->time_date)); ?> 
          (<?php echo date('h', strtotime($file->time_date)); ?>
          :<?php echo date('i', strtotime($file->time_date)); ?>
          :<?php echo date('s', strtotime($file->time_date)); ?>
          )
      
      </div>
       </div>
      <div class="rowElem">
      <div class="label">Pages: </div>
      <div class="cotent"> <?php echo $file->pages_from."-".$file->pages_to; ?> </div>
      <div class="label">File Old No:</div>
      <div class="cotent"> <?php echo $file->file_old_no; ?> </div>
       </div>
      <div class="rowElem">
      <div class="label">File Amirah No: </div>
      <div class="cotent"> <?php echo $file->file_almirah_no; ?> </div>
      <div class="label">File Rack No:</div>
      <div class="cotent"> <?php echo $file->file_rack_no; ?> </div>
       </div>
      <div class="rowElem">
      <div class="label">Location Status: </div>
      <div class="cotent"> <?php echo $file->file_availability; ?> </div>
      
      
       </div>
             <div class="rowElem">
              </div>
             
             <div class="fix"></div>
             
             
         </div>
         </div>
    
    
    <div class="widget"   >
    <div class="head " style="background: white;" >
    <h5 style="background: white;">File PROFILE</h5>
     <div id="profile_options">
        <?php if($file->file_index=='file_index'){ ?>
         
        <a class="disable_link"  href="#" > File Index </a>
        <?php }else{?>
        
        <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$file->file_index; ?>" > File Index </a>
        <?php } ?>
</div>
    </div>
        </div>
    </fieldset>
