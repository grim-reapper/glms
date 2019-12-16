<script>
	$(function() {
		$( "#radio_button" ).buttonset();

        $("#add_lease_occupant").click(function(){
				 var i = $('#lease_occupant_counter').val();
				  i = parseInt(i);
                  var new_field = '<table  id="lease_occupantion" class="lease_'+i+'">';
                  new_field+='<tr> ';
                  new_field+='<td class="o_f_c">Name</td> ';
				  new_field+='<td ><input type="text"   name="lease_occupant_name_'+i+'" value="" /></td>';
				  new_field+='<td>Parentage</td>';
				  new_field+='<td><div class="remove" onclick="remove_lease('+i+');"></div><input type="text"   name="lease_occupant_parentage_'+i+'" value="" /></td> ';
				  new_field+='</tr>';
				  new_field+='<tr> ';
				  new_field+='<td class="o_f_c">CNIC</td>';
				  new_field+=' <td><input type="text"   name="lease_occupant_cnic_'+i+'" value="" /></td> ';
				  new_field+='<td>Cell No.</td> ';
				  new_field+='<td><input type="text"   name="lease_occupant_cell_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='<tr> ';
				  new_field+=' <td class="o_f_c">Address</td>';
		          new_field+='   <td><input type="text"   name="lease_occupant_address_'+i+'" value="" /></td>';
				  new_field+=' <td >Picture</td> ';
				  new_field+='<td><input type="file"   name="lease_occupant_pic_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='</table>';
				  i = i+1;
				  $('#lease_occupant_counter').val(i);
                  $("#lease_occupantion_table").before(new_field);
            });
		

		
        $("#add_illegal_occupant").click(function(){
				 var i = $('#i_occupant_counter').val();
				  i = parseInt(i);
                  var new_field = '<table  id="illegal_occupantion" class="illegal_'+i+'">';
                  new_field+='<tr> ';
                  new_field+='<td class="o_f_c">Name</td> ';
				  new_field+='<td ><input type="text"   name="illegal_occupant_name_'+i+'" value="" /></td>';
				  new_field+='<td>Parentage</td>';
				  new_field+='<td><div class="remove" onclick="remove_illegal('+i+');"></div><input type="text"   name="illegal_occupant_parentage_'+i+'" value="" /></td> ';
				  new_field+='</tr>';
				  new_field+='<tr> ';
				  new_field+='<td class="o_f_c">CNIC</td>';
				  new_field+=' <td><input type="text"   name="illegal_occupant_cnic_'+i+'" value="" /></td> ';
				  new_field+='<td>Cell No.</td> ';
				  new_field+='<td><input type="text"   name="illegal_occupant_cell_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='<tr> ';
				  new_field+='<td class="o_f_c">Address</td>';
		          new_field+='<td><input type="text"   name="illegal_occupant_address_'+i+'" value="" /></td>';
				  new_field+=' <td >Picture</td> ';
				  new_field+='<td><input type="file"   name="illegal_occupant_pic_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='</table>';
				  i = i+1;
				  $('#i_occupant_counter').val(i);
                  $("#illegal_occupantion_table").before(new_field);
				  
            });
			

			
		
	    $("#lease_occupation").click(function(){ 
												  
				$("#illegal_occupant_wrapper").hide();		
				$("#lease_occupation_wrapper").show();	
				$("#depp_occupant_wrapper").hide()
	     });	
	
	    $("#illegal_occupation").click(function(){ 
												  
				$("#illegal_occupant_wrapper").show();		
				$("#lease_occupation_wrapper").hide();	
				$("#depp_occupant_wrapper").hide()
	     });
	
	  $("#deptt_occupation").click(function(){ 
				
				$("#lease_occupation_wrapper").hide()
				$("#illegal_occupant_wrapper").hide();		
				$("#depp_occupant_wrapper").show();								  
	     });
		
     $("#vacant_land").click(function(){ 
												  
				$("#lease_occupation_wrapper").hide()
				$("#illegal_occupant_wrapper").hide();		
				$("#depp_occupant_wrapper").hide();								  
	    });
		
		
		
		$('#sqft').change(function(){
	      
		  var kanal = 0 ;
		  var sqft = 0;
		  var marla = 0;
		  sqft = $("#sqft").val()
		  
		  if(sqft>225)
		  {
		    marla = $("#marla").val();
			kanal = $("#kanal").val();
			
		    marla = Number(marla) + parseInt((sqft / 225)); 
		    kanal = Number(kanal) + parseInt((marla / 20)); 
			s = sqft % 225;
			m = marla %20;

		  	$("#marla").val(m);
			$("#sqft").val(s);
			$("#kanal").val(kanal);
		  }

		});
		
		 $("#marla").change(function(){
		  var kanal = 0 ;
		  var marla = 0;     
		   
		  marla = $("#marla").val()
		  
		  if(marla>20)
		  {
		    marla = $("#marla").val();
			kanal = $("#kanal").val();
			
		    kanal = Number(kanal) + parseInt((marla / 20)); 
			m = marla % 20;

		  	$("#marla").val(m);
			$("#kanal").val(kanal);
		  }	    
		 
		 });	
	
	});
	
   function remove_illegal(n)
   {
		$(".illegal_"+n).remove();
   }
  
  function remove_lease(n)
   {
		$(".lease_"+n).remove();
   }
</script>

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
<style type="text/css">
.pp_details{ display:none;}
</style>

<!-- Form begins -->
<?php $this->load->view("property/property_js");?>
<?php 

$attributes = array('class' => 'mainForm');

echo form_open_multipart('property/edit', $attributes);
?>
<!-- Input text fields -->
<?php 
	   if(validation_errors()){
	?>


<div class="nNote nWarning hideit">
  <p><strong>WARNING: </strong><?php echo validation_errors(); ?></p>
</div>
<?php  }  ?>
<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Edit Property Form</h5>
   </div>
    
  <input type="hidden"  name="occupation_type"  value="<?php echo $property->occupation_type;?>" />  

    <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< PRIVATE OCCUPATION >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
  <?php if( $property->occupation_type =='private_occupation'){?>  
   <div id="private_occupant_wrapper"  >
   
    <div class="rowElem  noborder">
      <h3 style="padding-left:230px">  PRIVATE OCCUPATION  
        <input type="button" name="private_occupant" id="add_private_occupant" value="Add Party" class="basicBtn occupant_button" />
        <input type="hidden" name="p_occupant_counter" value="<?php if(count($p_occupant_list)>0){ echo count($p_occupant_list)+1;} else {echo 2;}?>" id="p_occupant_counter"  />
      </h3>
    </div>
    <div class="rowElem ">
      <?php 
	  if(count($p_occupant_list)>0){
	  $i=1;
	  foreach($p_occupant_list as $o_list)
	  {?>    
     
      <table  id="private_occupantion">
        <tr>
          <td class="o_f_c">Name</td>
          <td >
            <input type="text"   name="private_occupant_name_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_name;?>" />
           <input type="hidden"   name="occupant_list_id_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_id;?>" />
          </td>
          <td>Parentage</td>
          <td><input type="text"   name="private_occupant_parentage_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_parentage;?>" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="private_occupant_cnic_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_cnic;?>" id="cnic"/></td>
          <td>Cell No.</td>
          <td><input type="text"   name="private_occupant_cell_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_cell_no;?>" /></td>
        </tr>
        <tr>
          <td class="o_f_c"></td>
		  <td> <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$o_list->occupant_list_pic; ?>">View Picture</a></td>
          <td >Picture</td>
          <td ><input type="file"   name="private_occupant_pic_<?php echo $i;?>"  /></td>

        </tr>
      </table>
      <?php
	       $i++; 
	    }
   } else {
	  ?>
       <table  id="private_occupantion">
        <tr>
          <td class="o_f_c">Name</td>
          <td ><input type="text"   name="private_occupant_name_1" value="" /></td>
          <td>Parentage</td>
          <td><input type="text"   name="private_occupant_parentage_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="private_occupant_cnic_1" value=""  id="cnic_1" /></td>
          <td>Cell No.</td>
          <td><input type="text"   name="private_occupant_cell_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c"></td>
		  <td></td>
          <td >Picture</td>
          <td ><input type="file"   name="private_occupant_pic_1" value="" /></td>

        </tr>
      </table>
      <?php } ?>
      <div class="fix"></div>
    </div>
    <input type="hidden"   name="p_occupant_id" value="<?php echo $private_occupant->occupant_id ;?>" />
 
    <div class="rowElem ">
      <label> Occupant Category:</label>
      <div class="formRight">
    <select name="occupant_category" id="occupant_category" >
      <option value="">Select Category</option>
      <option value="Orignal(s)" <?php if($private_occupant->occupant_category=='Orignal(s)'){echo 'selected="selected"';}?> >Orignal(s)</option>
      <option value="Legal Heir(s)"<?php if($private_occupant->occupant_category=='Legal Heir(s)'){echo 'selected="selected"';}?>>Legal Heir(s)</option>
      <option value="Transfree(s)" <?php if($private_occupant->occupant_category=='Transfree(s)'){echo 'selected="selected"';}?>>Transfree(s)</option>
      <option value="Grabber(s)" <?php if($private_occupant->occupant_category=='Grabber(s)'){echo 'selected="selected"';}?>>Grabber(s)</option>
   </select>
      </div>
      <label>Status of Occupant:</label>
      <div class="formRight">
              
        <select name="occupant_status" id="occupant_status" >
          <option value="">Select Status</option>
          <option value="Lessee"  <?php if($private_occupant->status =='Lessee'){echo 'selected="selected"';}?>>Lessee</option>
          <option value="Expired Lease" <?php if($private_occupant->status =='Expired Lease'){echo 'selected="selected"';}?>>Expired Lease</option>
     <option value="Illegal Occupant" <?php if($private_occupant->status =='Illegal Occupant'){echo 'selected="selected"';}?>>Illegal Occupant</option>
        </select>
        
      </div>
      <div class="fix"></div>
    </div>

    <div class="rowElem ">
     <label>Leasing Authority:</label>
      <div class="formRight">
       <select name="leasing_authority" id="leasing_authority" >
          <option value="">Select Authority</option>
          <option value="BOR" <?php if($private_occupant->leasing_authority =='BOR'){echo 'selected="selected"';}?>>BOR</option>
          <option value="C&W" <?php if($private_occupant->leasing_authority =='C&W'){echo 'selected="selected"';}?>>C&W </option>
           <option value="Ex-MCL" <?php if($private_occupant->leasing_authority =='Ex-MCL'){echo 'selected="selected"';}?>>Ex-MCL</option>
           <option value="LDA" <?php if($private_occupant->leasing_authority =='LDA'){echo 'selected="selected"';}?>>LDA</option>
          <option value="Army" <?php if($private_occupant->leasing_authority =='Army'){echo 'selected="selected"';}?>>Army</option>
         <option value="Other" <?php if($private_occupant->leasing_authority =='Other'){echo 'selected="selected"';}?>>Other</option>
        </select>
      </div>
      
      <label>Occupation Year:</label>
      <div class="formRight">
      
        <select name="occupation_year" id="occupation_year" >
          <option value="">Select Year</option>
          <?php for( $y=1900 ; $y<=date('Y',time());$y++ ){?>
          <?php if($private_occupant->occupation_year ==$y){?>
          <option value="<?php echo $y;?>" selected="selected"><?php echo $y;?></option>
          <?php }else{?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } } ?>
        </select>
      </div>
 
      <div class="fix"></div>
    </div>
    

    <div class="rowElem ">
         <label>Usage:</label>
      <div class="formRight">
        <select name="occupant_usage" id="occupant_usage" >
          <option value="">Select Usage</option>
          <option value="Commercial" <?php if($private_occupant->usage =='Commercial'){echo 'selected="selected"';}?>>Commercial</option>
          <option value="Residential" <?php if($private_occupant->usage =='Residential'){echo 'selected="selected"';}?>>Residential</option>
          <option value="Industrial" <?php if($private_occupant->usage =='Industrial'){echo 'selected="selected"';}?>>Industrial</option>
          <option value="Agricultural" <?php if($private_occupant->usage =='Agricultural'){echo 'selected="selected"';}?>>Agricultural</option>
          <option value="Petrol Pump" <?php if($private_occupant->usage =='Petrol Pump'){echo 'selected="selected"';}?>>Petrol Pump</option>
          <option value="Non-profit" <?php if($private_occupant->usage =='Non-profit'){echo 'selected="selected"';}?>>Non-profit</option>
          <option value="other" <?php if($private_occupant->usage =='other'){echo 'selected="selected"';}?> >Other</option>
        </select>
      </div>
    
      
      <label>Franchise:</label>
         <div class="formRight">
		<select name="franchise" id="franchise" >
          <option value="">Select Company</option>
          <option value="PSO" <?php if($private_occupant->franchise =='PSO'){echo 'selected="selected"';}?>>PSO</option>
          <option value="Shell"  <?php if($private_occupant->franchise =='Shell'){echo 'selected="selected"';}?>>Shell</option>
           <option value="Total"  <?php if($private_occupant->franchise =='Total'){echo 'selected="selected"';}?>>Total</option>
           <option value="Attock"  <?php if($private_occupant->franchise =='Attock'){echo 'selected="selected"';}?>>Attock</option>
          <option value="PARCO"  <?php if($private_occupant->franchise =='PARCO'){echo 'selected="selected"';}?>>PARCO</option>
          <option value="Caltex"  <?php if($private_occupant->franchise =='Caltex'){echo 'selected="selected"';}?>>Caltex</option>
         <option value="CNG"  <?php if($private_occupant->franchise =='CNG'){echo 'selected="selected"';}?>>CNG</option>
         <option value="Others"  <?php if($private_occupant->franchise =='Others'){echo 'selected="selected"';}?>>Others</option>
        </select>
		
      </div>
     
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
       <label>Trade Name:</label>
      <div class="formRight">
        <input type="text"   name="trade_name" value="<?php echo $private_occupant->trade_name ;?>" />
      </div>
      
     <label>Buying Option:</label>
         <div class="formRight">
		<select name="buying_option" id="buying_option" >
          <option value="">Select Option</option>
          <option value="1" <?php if($private_occupant->buying_option ==1){echo 'selected="selected"';}?>>Yes</option>
          <option value="0" <?php if($private_occupant->buying_option ==0){echo 'selected="selected"';}?>>No</option>
        </select>
     </div>

      
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
    
     <label>Mode of Payment:</label>
      <div class="formRight">
	     <select name="payment_mode" id="payment_mode" >
          <option value="">Select  Mode</option>
          <option value="Lump Sum" <?php if($private_occupant->payment_mode =="Lump Sum"){echo 'selected="selected"';}?> >Lump Sum</option>
          <option value="Installments" <?php if($private_occupant->payment_mode =="Installments"){echo 'selected="selected"';}?> >Installments</option>
        </select>
		
      </div>
     <label>Remarks:</label>
      <div class="formRight">
        <textarea  name="occupant_remarks" cols="" rows="3"><?php echo $private_occupant->remarks ; ?></textarea>
      </div>
       <div class="fix"></div>
    </div>
 
  </div>
  
  
 <?php } else if( $property->occupation_type =='lease_occupation'){?> 
   <div id="lease_occupation_wrapper"  >
   
    <div class="rowElem  noborder">
      <h3 style="padding-left:230px">  LICENSED OCCUPATION  
        <input type="button" name="add_lease_occupant" id="add_lease_occupant" value="Add Party" class="basicBtn occupant_button" />
        <input type="hidden" name="lease_occupant_counter" value="<?php if(count($l_occupant_list)>0){ echo count($l_occupant_list)+1;} else {echo 2;}?>" id="lease_occupant_counter"  />
      </h3>
    </div>
    <div class="rowElem ">
      <?php 
	  if(count($l_occupant_list)>0){
	  $i=1;
	  foreach($l_occupant_list as $o_list)
	  {?>    
      
       <table  id="lease_occupantion" class="lease_<?php echo $i;?>">
        <tr>
          <td class="o_f_c">Name</td>
          <td>
          <input type="text"   name="lease_occupant_name_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_name;?>" />
          <input type="hidden"   name="occupant_list_id_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_id;?>" />
          </td>
          <td>Parentage</td>
          <td><input type="text"   name="lease_occupant_parentage_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_parentage;?>" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="lease_occupant_cnic_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_cnic;?>" /></td>
          <td>Cell No.</td>
          <td><input type="text"   name="lease_occupant_cell_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_cell_no;?>" /></td>
        </tr>
        <tr>
          <td class="o_f_c">Address</td>
		  <td><input type="text"   name="lease_occupant_address_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_address ;?>" /></td>
          <td >Picture</td>
          <td >
          <input type="file"   name="lease_occupant_pic_<?php echo $i;?>"  /> <br />
          <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$o_list->occupant_list_pic; ?>">View Picture</a>
          </td>
        </tr>
      </table>
      <?php
			  $i++; 
			}
		  }
	  ?>

       <div id="lease_occupantion_table"></div>
      <div class="fix"></div>
    </div>
    <input type="hidden"   name="p_occupant_id" value="<?php echo $lease_occupation->occupant_id ;?>" />
 
    <div class="rowElem ">
      <label> Occupant Category:</label>
      <div class="formRight">
    <select name="occupant_category" id="occupant_category" >
      <option value="">Select Category</option>
      <option value="Orignal(s)" <?php if($lease_occupation->occupant_category=='Orignal(s)'){echo 'selected="selected"';}?> >Orignal(s)</option>
      <option value="Legal Heir(s)"<?php if($lease_occupation->occupant_category=='Legal Heir(s)'){echo 'selected="selected"';}?>>Legal Heir(s)</option>
      <option value="Transfree(s)" <?php if($lease_occupation->occupant_category=='Transfree(s)'){echo 'selected="selected"';}?>>Transfree(s)</option>
      <option value="Grabber(s)" <?php if($lease_occupation->occupant_category=='Grabber(s)'){echo 'selected="selected"';}?>>Grabber(s)</option>
   </select>
      </div>
      <label>Period of Lease:</label>
      <div class="formRight">      
		<input type="text"   name="period_of_lease" value="<?php echo $lease_occupation->period_of_lease ;?>"/>
      </div>
      <div class="fix"></div>
    </div>

    <div class="rowElem ">
     <label>Leasing Authority:</label>
      <div class="formRight">
       <select name="leasing_authority" id="leasing_authority" >
          <option value="">Select Authority</option>
          <option value="BOR" <?php if($lease_occupation->leasing_authority =='BOR'){echo 'selected="selected"';}?>>BOR</option>
          <option value="C&W" <?php if($lease_occupation->leasing_authority =='C&W'){echo 'selected="selected"';}?>>C&W </option>
           <option value="Ex-MCL" <?php if($lease_occupation->leasing_authority =='Ex-MCL'){echo 'selected="selected"';}?>>Ex-MCL</option>
           <option value="LDA" <?php if($lease_occupation->leasing_authority =='LDA'){echo 'selected="selected"';}?>>LDA</option>
          <option value="Army" <?php if($lease_occupation->leasing_authority =='Army'){echo 'selected="selected"';}?>>Army</option>
         <option value="Other" <?php if($lease_occupation->leasing_authority =='Other'){echo 'selected="selected"';}?>>Other</option>
        </select>
      </div>
      
      <label>Occupation Year:</label>
      <div class="formRight">
      
        <select name="occupation_year" id="occupation_year" >
          <option value="">Select Year</option>
          <?php for( $y=1900 ; $y<=date('Y',time());$y++ ){?>
          <?php if($lease_occupation->occupation_year ==$y){?>
          <option value="<?php echo $y;?>" selected="selected"><?php echo $y;?></option>
          <?php }else{?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } } ?>
        </select>
      </div>
 
      <div class="fix"></div>
    </div>
    

    <div class="rowElem ">
         <label>Usage:</label>
      <div class="formRight">
        <select name="occupant_usage" id="occupant_usage" >
          <option value="">Select Usage</option>
          <option value="Commercial" <?php if($lease_occupation->usage =='Commercial'){echo 'selected="selected"';}?>>Commercial</option>
          <option value="Residential" <?php if($lease_occupation->usage =='Residential'){echo 'selected="selected"';}?>>Residential</option>
          <option value="Industrial" <?php if($lease_occupation->usage =='Industrial'){echo 'selected="selected"';}?>>Industrial</option>
          <option value="Agricultural" <?php if($lease_occupation->usage =='Agricultural'){echo 'selected="selected"';}?>>Agricultural</option>
          <option value="Petrol Pump" <?php if($lease_occupation->usage =='Petrol Pump'){echo 'selected="selected"';}?>>Petrol Pump</option>
          <option value="Non-profit" <?php if($lease_occupation->usage =='Non-profit'){echo 'selected="selected"';}?>>Non-profit</option>
          <option value="other" <?php if($lease_occupation->usage =='other'){echo 'selected="selected"';}?> >Other</option>
        </select>
      </div>
    
     <label>Franchise:</label>
         <div class="formRight">
		<select name="franchise" id="franchise" >
          <option value="">Select Company</option>
          <option value="PSO" <?php if($lease_occupation->franchise =='PSO'){echo 'selected="selected"';}?>>PSO</option>
          <option value="Shell"  <?php if($lease_occupation->franchise =='Shell'){echo 'selected="selected"';}?>>Shell</option>
           <option value="Total"  <?php if($lease_occupation->franchise =='Total'){echo 'selected="selected"';}?>>Total</option>
           <option value="Attock"  <?php if($lease_occupation->franchise =='Attock'){echo 'selected="selected"';}?>>Attock</option>
          <option value="PARCO"  <?php if($lease_occupation->franchise =='PARCO'){echo 'selected="selected"';}?>>PARCO</option>
          <option value="Caltex"  <?php if($lease_occupation->franchise =='Caltex'){echo 'selected="selected"';}?>>Caltex</option>
         <option value="CNG"  <?php if($lease_occupation->franchise =='CNG'){echo 'selected="selected"';}?>>CNG</option>
         <option value="Others"  <?php if($lease_occupation->franchise =='Others'){echo 'selected="selected"';}?>>Others</option>
        </select>
		
      </div>
     
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
       <label>Trade Name:</label>
      <div class="formRight">
        <input type="text"   name="trade_name" value="<?php echo $lease_occupation->trade_name ;?>" />
      </div>
      
     <label>Buying Option:</label>
         <div class="formRight">
		<select name="buying_option" id="buying_option" >
          <option value="">Select Option</option>
          <option value="1" <?php if($lease_occupation->buying_option ==1){echo 'selected="selected"';}?>>Yes</option>
          <option value="0" <?php if($lease_occupation->buying_option ==0){echo 'selected="selected"';}?>>No</option>
        </select>
     </div>

      
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
    
     <label>Mode of Payment:</label>
      <div class="formRight">
	     <select name="payment_mode" id="payment_mode" >
          <option value="">Select  Mode</option>
          <option value="Lump Sum" <?php if($lease_occupation->payment_mode =="Lump Sum"){echo 'selected="selected"';}?> >Lump Sum</option>
          <option value="Installments" <?php if($lease_occupation->payment_mode =="Installments"){echo 'selected="selected"';}?> >Installments</option>
        </select>
		
      </div>
     <label>Remarks:</label>
      <div class="formRight">
        <textarea  name="occupant_remarks" cols="" rows="3"><?php echo $lease_occupation->remarks ; ?></textarea>
      </div>
       <div class="fix"></div>
    </div>
  </div>
 
 <?php } else if( $property->occupation_type =='illegal_occupation'){?> 

    <div class="rowElem  noborder">
      <h3 style="padding-left:230px">  Illegal Occupation
        <input type="button" name="add_illegal_occupant" id="add_illegal_occupant" value="Add Party" class="basicBtn occupant_button" />
        <input type="hidden" name="i_occupant_counter" value="<?php if(count($p_occupant_list)>0){ echo count($p_occupant_list)+1;} else {echo 2;}?>" id="i_occupant_counter"  />
      </h3>
    </div>
    <div class="rowElem ">
      <?php 
	  if(count($p_occupant_list)>0){
	  $i=1;
	  foreach($p_occupant_list as $o_list)
	  {?>    
      <table  id="illegal_occupantion">
        <tr>
          <td class="o_f_c">Name</td>
          <td >
            <input type="text"   name="illegal_occupant_name_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_name;?>" />
           <input type="hidden"   name="occupant_list_id_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_id;?>" />
          </td>
          <td>Parentage</td>
          <td><input type="text"   name="illegal_occupant_parentage_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_parentage;?>" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="illegal_occupant_cnic_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_cnic;?>" id="cnic"/></td>
          <td>Cell No.</td>
          <td><input type="text"   name="illegal_occupant_cell_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_cell_no;?>" /></td>
        </tr>
        <tr>
          <td class="o_f_c"> Address </td>
		  <td> <input type="text"   name="illegal_occupant_address_<?php echo $i;?>" value="<?php echo $o_list->occupant_list_address;?>" /></td>
          <td >Picture</td>
          <td >
          <input type="file"   name="illegal_occupant_pic_<?php echo $i;?>"  /><br />
          <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$o_list->occupant_list_pic; ?>">View Picture</a>
          </td>

        </tr>
      </table>
      <?php
	       $i++; 
	    }
   } else {
	  ?>
       <table  id="illegal_occupantion">
        <tr>
          <td class="o_f_c">Name</td>
          <td ><input type="text"   name="illegal_occupant_name_1" value="" /></td>
          <td>Parentage</td>
          <td><input type="text"   name="illegal_occupant_parentage_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="illegal_occupant_cnic_1" value=""   /></td>
          <td>Cell No.</td>
          <td><input type="text"   name="illegal_occupant_cell_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">Address</td>
		  <td><input type="text"   name="illegal_occupant_address_1" value="" /></td>
          <td>Picture</td>
          <td><input type="file"   name="illegal_occupant_pic_1" value="" /></td>
        </tr>
      </table>
       
      <?php } ?>
       <div id="illegal_occupantion_table"></div>
      <div class="fix"></div>
    </div>
    <input type="hidden"   name="p_occupant_id" value="<?php echo $private_occupant->occupant_id ;?>" />
 
    <div class="rowElem ">
      <label> Occupant Category:</label>
      <div class="formRight">
    <select name="occupant_category" id="occupant_category" >
     <option value="">Select Category</option>
     <option value="Orignal(s)" <?php if($private_occupant->occupant_category=='Orignal(s)'){echo 'selected="selected"';}?> >Orignal(s)</option>
     <option value="Legal Heir(s)"<?php if($private_occupant->occupant_category=='Legal Heir(s)'){echo 'selected="selected"';}?>>Legal Heir(s)</option>
     <option value="Transfree(s)" <?php if($private_occupant->occupant_category=='Transfree(s)'){echo 'selected="selected"';}?>>Transfree(s)</option>
     <option value="Grabber(s)" <?php if($private_occupant->occupant_category=='Grabber(s)'){echo 'selected="selected"';}?>>Grabber(s)</option>
   </select>
      </div>
     
      <label>Occupation Year:</label>
      <div class="formRight">
      
        <select name="occupation_year" id="occupation_year" >
          <option value="">Select Year</option>
          <?php for( $y=1900 ; $y<=date('Y',time());$y++ ){?>
          <?php if($private_occupant->occupation_year ==$y){?>
          <option value="<?php echo $y;?>" selected="selected"><?php echo $y;?></option>
          <?php }else{?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } } ?>
        </select>
      </div>
 
      <div class="fix"></div>
    </div>
    

    <div class="rowElem ">
         <label>Usage:</label>
      <div class="formRight">
        <select name="occupant_usage" id="occupant_usage" >
          <option value="">Select Usage</option>
          <option value="Commercial" <?php if($private_occupant->usage =='Commercial'){echo 'selected="selected"';}?>>Commercial</option>
          <option value="Residential" <?php if($private_occupant->usage =='Residential'){echo 'selected="selected"';}?>>Residential</option>
          <option value="Industrial" <?php if($private_occupant->usage =='Industrial'){echo 'selected="selected"';}?>>Industrial</option>
          <option value="Agricultural" <?php if($private_occupant->usage =='Agricultural'){echo 'selected="selected"';}?>>Agricultural</option>
          <option value="Petrol Pump" <?php if($private_occupant->usage =='Petrol Pump'){echo 'selected="selected"';}?>>Petrol Pump</option>
          <option value="Non-profit" <?php if($private_occupant->usage =='Non-profit'){echo 'selected="selected"';}?>>Non-profit</option>
          <option value="other" <?php if($private_occupant->usage =='other'){echo 'selected="selected"';}?> >Other</option>
        </select>
      </div>
    
      
      <label>Franchise:</label>
         <div class="formRight">
		<select name="franchise" id="franchise" >
          <option value="">Select Company</option>
          <option value="PSO" <?php if($private_occupant->franchise =='PSO'){echo 'selected="selected"';}?>>PSO</option>
          <option value="Shell"  <?php if($private_occupant->franchise =='Shell'){echo 'selected="selected"';}?>>Shell</option>
           <option value="Total"  <?php if($private_occupant->franchise =='Total'){echo 'selected="selected"';}?>>Total</option>
           <option value="Attock"  <?php if($private_occupant->franchise =='Attock'){echo 'selected="selected"';}?>>Attock</option>
          <option value="PARCO"  <?php if($private_occupant->franchise =='PARCO'){echo 'selected="selected"';}?>>PARCO</option>
          <option value="Caltex"  <?php if($private_occupant->franchise =='Caltex'){echo 'selected="selected"';}?>>Caltex</option>
         <option value="CNG"  <?php if($private_occupant->franchise =='CNG'){echo 'selected="selected"';}?>>CNG</option>
         <option value="Others"  <?php if($private_occupant->franchise =='Others'){echo 'selected="selected"';}?>>Others</option>
        </select>
		
      </div>
     
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
       <label>Trade Name:</label>
      <div class="formRight">
        <input type="text"   name="trade_name" value="<?php echo $private_occupant->trade_name ;?>" />
      </div>
      
     <label>Buying Option:</label>
         <div class="formRight">
		<select name="buying_option" id="buying_option" >
          <option value="">Select Option</option>
          <option value="1" <?php if($private_occupant->buying_option ==1){echo 'selected="selected"';}?>>Yes</option>
          <option value="0" <?php if($private_occupant->buying_option ==0){echo 'selected="selected"';}?>>No</option>
        </select>
     </div>

      
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
    
     <label>Mode of Payment:</label>
      <div class="formRight">
	     <select name="payment_mode" id="payment_mode" >
          <option value="">Select  Mode</option>
          <option value="Lump Sum" <?php if($private_occupant->payment_mode =="Lump Sum"){echo 'selected="selected"';}?> >Lump Sum</option>
          <option value="Installments" <?php if($private_occupant->payment_mode =="Installments"){echo 'selected="selected"';}?> >Installments</option>
        </select>
		
      </div>
     <label>Remarks:</label>
      <div class="formRight">
        <textarea  name="occupant_remarks" cols="" rows="3"><?php echo $private_occupant->remarks ; ?></textarea>
      </div>
       <div class="fix"></div>
    </div>
 

  
 <?php } else if( $property->occupation_type =='deptt_occupation'){?> 
  <input type="hidden"   name="deptt_occupation_id" value="<?php echo $deptt_occupation->deptt_occupation_id; ?>"/>
  
   <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Deptt. Occupation >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>--> 
  <div id="depp_occupant_wrapper2">
   <div class="rowElem">
      <h3>Deptt. Occupation</h3>
    </div>
    <div class="rowElem">
    
      <label>Domain:</label>
      <div class="formRight">
         <select name="deptt_domain" id="domain" >
          <option value="">Select Domain</option>
          <option value="Federal"<?php if($deptt_occupation->deptt_domain =="Federal"){echo 'selected="selected"';}?>>Federal</option>
          <option value="Provincial" <?php if($deptt_occupation->deptt_domain =="Provincial"){echo 'selected="selected"';}?>>Provincial</option>
		  <option value="Local Body" <?php if($deptt_occupation->deptt_domain =="Local Body"){echo 'selected="selected"';}?>>Local Body</option>
        </select>
      </div>
      <label>Name of Deptt:</label>
      <div class="formRight">
        <input type="text"   name="deptt_name" value="<?php echo $deptt_occupation->deptt_name 	 ;?>" id="Name" />
      </div>
      <div class="fix"></div>
    </div>
	
    <div class="rowElem">
    
      <label>Status of Occupation:</label>
      <div class="formRight">
   <select name="deptt_status" id="Status" >
    <option value="">Select Status</option>
    <option value="Perpatual" <?php if($deptt_occupation->deptt_status =="Perpatual"){echo 'selected="selected"';}?>>Perpatual</option>
    <option value="Termed Lease" <?php if($deptt_occupation->deptt_status =="Termed Lease"){echo 'selected="selected"';}?>>Termed Lease</option>
    <option value="Unverified" <?php if($deptt_occupation->deptt_status =="Unverified"){echo 'selected="selected"';}?>>Unverified</option>
<option value="Illegal Occupant" <?php if($deptt_occupation->deptt_status =="Illegal Occupant"){echo 'selected="selected"';}?>>Illegal Occupant</option>
   </select>
      </div>
     <label>Address:</label>
      <div class="formRight">
        <input type="text"   name="deptt_address" value="<?php echo $deptt_occupation->deptt_address ;?>" />
      </div>
	  
      <div class="fix"></div>
    </div>
	
   <div class="rowElem">
      <label>Name of Contact Person:</label>
      <div class="formRight">
        <input type="text" value="<?php echo $deptt_occupation->deptt_contact_person ;?>" name="deptt_contact_person" />
     </div>
      
      <label>Contact No.</label>
      <div class="formRight">
        <input type="text" value="<?php echo $deptt_occupation->deptt_contact_no ;?>" name="deptt_contact_no" />
      </div>
      <div class="fix"></div>
    </div>
	
   <div class="rowElem">

     <label>Occupation Year:</label>
      <div class="formRight">
        
        <select name="depp_occupation_year">
          <option value="">Select Year</option>
          <?php
		  for( $y=1850 ; $y<=date('Y',time());$y++ ){
			  if($deptt_occupation->occupation_year == $y )
			  {
		  ?>
           <option value="<?php echo $y;?>" selected="selected"><?php echo $y;?></option>
          <?php } else {?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } }?>
         </select> 
      </div>
       
      <label>Remarks:</label>
      <div class="formRight">
         <textarea rows="4" cols="" name="deptt_remarks"  ><?php echo $deptt_occupation->deptt_remarks ;?></textarea>
      </div>

	 
      <div class="fix"></div>
    </div>	
		
   </div>
  <?php } ?> 
    <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Property Details >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    
       <input type="hidden" value="<?php echo $property->property_id;?>" name="property_id" /> 
      <input type="hidden" value="<?php echo $property->up_without_min;?>" name="up_without_min" /> 
      <input type="hidden" value="<?php echo $property->unique_property;?>" name="unique_property" /> 
    <div class="rowElem">
      <h3>Property Details </h3>
    </div>
           <div class="rowElem">
      <label></label>
      <div class="formRight">
        <div style=" border: 1px solid #366CA2;  padding: 6px; width:300px; height: 200px;">
        <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$property->shajra_picture; ?>">
          <img  height="200" width="300" src="<?php echo base_url().'uploads/'.$property->shajra_picture; ?>" />
        </a>
        </div> 
      </div>
       <label></label>
      <div class="formRight">
        <div style=" border: 1px solid #366CA2;  padding: 6px;  width:300px; height: 200px;">
          <a rel="prettyPhoto" href="<?php echo base_url().'uploads/'.$property->site_picture; ?>">
           <img height="200" width="300" src="<?php echo base_url();?>/uploads/<?php echo $property->site_picture; ?>" />
           </a>
        </div>
      </div>
      
      <div class="fix"></div>
    </div>
    
        <div class="rowElem">
      <label>Shajra Picture:</label>
      <div class="formRight">
        <input type="file"   name="shajra_picture" value="" />
      </div>
      
       <label>Site Picture:</label>
      <div class="formRight">
         <input type="file"   name="site_picture" value="" />
      </div>
      
      <div class="fix"></div>
    </div>
    
    <div class="rowElem">
      <label>Ownership:</label>
      <div class="formRight">
      
       <select name="ownership" id="ownership">
          <option value="">Select Owner </option>
          
          <option value="Nazul"  <?php if( $property->ownership=='Nazul'){echo 'selected="selected"';} ?> >Nazul </option>
          <option value="Prov:Govt."<?php if( $property->ownership=='Prov:Govt.'){echo 'selected="selected"';} ?> >Prov:Govt.</option>
          <option value="Evacuee" <?php if( $property->ownership=='Evacuee'){echo 'selected="selected"';} ?> >Evacuee</option>
          <option value="Federal Govt." <?php if( $property->ownership=='Federal Govt.'){echo 'selected="selected"';} ?> >Federal Govt.</option>
          <option value="Ex-MCL" <?php if( $property->ownership=='Ex-MCL'){echo 'selected="selected"';} ?> >Ex-MCL</option>
          <option value="Other" <?php if( $property->ownership=='Other'){echo 'selected="selected"';} ?> >Other</option>
        </select>
      </div>
      <label>Property History:</label>
      <div class="formRight">
             <input type="file"   name="history" value="" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
  
       <label>Disposal Status:</label>
      <div class="formRight">
    <select name="disposal_status" id="disposal_status" >
      <option value="">Select Status </option>
      <option value="Disposable" <?php if( $property->disposable=='Disposable'){echo 'selected="selected"';} ?> >Disposable</option>
      <option value="Non-Disposable" <?php if( $property->disposable=='Non-Disposable'){echo 'selected="selected"';} ?> >Non-Disposable</option>
    </select>
      </div>
     
      
      <label>Locality:</label>
      <div class="formRight">
        <input type="text"   name="locality" value="<?php echo $property->locality; ?>" />
      </div>
      
      <div class="fix"></div>
    </div>
    <div class="rowElem">
        <label>Mauza:</label>
      <div class="formRight">
        <select name="mauza_id" id="mauza">
          <option value="">Select  Mauza</option>
          <?php foreach($mauza_list as $m_list) {?>
          <?php if( $property->mauza_id== $m_list->mauza_id){?>
          <option value="<?php echo $m_list->mauza_id; ?>" selected="selected"><?php echo $m_list->mouza_name; ?></option>
          <?php }else{?>
          <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
          <?php } } ?>
        </select>
      </div>
      <label>Khasra Nos.</label>
      <div class="formRight">
        <input type="text"   name="khasra" value="<?php echo $property->khasra_nos; ?>" />
      </div>  
       
   
      <div class="fix"></div>
    </div>
   
     <div class="rowElem">
       <label>Unique Khasra No.</label>
      <div class="formRight">
       <input type="text"   name="unique_khasra" value="<?php echo $property->unique_khasra; ?>" size="5" style=" width:25%" maxlength="5" /> 
      <div style="display: inline;font-size: 14px;margin-left: 29px;width: 20%;">  Qitat:</div>
       <input type="text"   name="qitat" value="<?php echo $property->qitat; ?>" size="2" style=" width:25%" maxlength="2" />
      </div>  
      
       <label>Area(Kanal-Marla-Sqft):</label>
      <div class="formRight">
        <input type="text" name="kanal"  id="kanal"  size="4" style=" width:20%" maxlength="5"  value="<?php echo $property->area_kanal; ?>"/>
        :
        <input type="text" name="marla"  id="marla"  size="5" style=" width:25%" maxlength="2" value="<?php echo $property->area_marla; ?>" />
        :
        <input type="text" name="sqft" id="sqft"  size="6" style=" width:25%" maxlength="3"  value="<?php echo $property->area_sqft; ?>" />
      </div>

      
      
     
      <div class="fix"></div>
    </div>
     
      <div class="rowElem">
       <label>Land Reservation:</label>
      <div class="formRight">
       <select name="land_reservation" id="land_reservation" >
         <option value=""> Select Allocation </option>
         <option value="Road" <?php if( $property->land_reservation=='Road'){echo 'selected="selected"';} ?>>Road</option>
         <option value="Canal"<?php if( $property->land_reservation=='Canal'){echo 'selected="selected"';} ?>>Canal</option>
         <option value="Drain" <?php if( $property->land_reservation=='Drain'){echo 'selected="selected"';} ?>>Drain</option>
         <option value="Railway"<?php if( $property->land_reservation=='Railway'){echo 'selected="selected"';} ?>>Railway </option>
         <option value="Park" <?php if( $property->land_reservation=='Park'){echo 'selected="selected"';} ?>>Park</option>
         <option value="Other" <?php if( $property->land_reservation=='Other'){echo 'selected="selected"';} ?>>Other</option>
          
        </select>
      </div>
      
      <label> Reservation Name:</label>
      <div class="formRight">
        <input type="text" value="<?php echo $property->reservation_name; ?>" name="reservation_name" />
      </div>
      <div class="fix"></div>
    </div>
      
    <div class="rowElem">

      <label>Duty Rate Per Marla:</label>
      <div class="formRight">
        <input type="text" value="<?php echo $property->duty_rate; ?>" name="duty_rate" />
      </div>
     <label>Market Rate Per Marla:</label>
      <div class="formRight">
        <input type="text" value="<?php echo $property->market_rate; ?>" name="market_rate" />
      </div>
      
      <div class="fix"></div>
    </div>
    <div class="rowElem">

      <label>Annual Rent Per Marla:</label>
      <div class="formRight">
        <input type="text" value="<?php echo $property->annual_rent; ?>" name="annual_rent" />
      </div>
     <label>Police Station:</label>
      <div class="formRight">
        <input type="text" value="<?php echo $property->police_station; ?>" name="police_station" />
      </div>
      
      <div class="fix"></div>
    </div>
        

    
   <div id="form_main">  
   
    <div class="rowElem">
      <label>Union Council No.</label>
      <div class="formRight">
        <input type="text" value="<?php echo $property->uc_no; ?>" name="uc_no" />
      </div>
      
       <label>Punjab Provincial No.</label>
      <div class="formRight">
         <select name="pp_no" id="pp_no" >
          <option value=""> Select PP</option>
          <?php for($i=137; $i<=161 ; $i++){?>
          <?php if($property->pp_no =="PP-".$i ){?>
          <option value="PP-<?php echo $i;?>" selected="selected">PP-<?php echo $i;?></option>
          <?php }else{?>
          <option value="PP-<?php echo $i;?>">PP-<?php echo $i;?></option>
          <?php }}?>
        </select>
      </div>
      
     
     
      <div class="fix"></div>
    </div>
    
    <div class="rowElem">
     <label>National Assembly No.</label>
      <div class="formRight">
          <select name="na_no" id="na_no" >
          <option value=""> Select NA </option>
          <?php for($i=118; $i<=130 ; $i++){?>
          <?php if($property->na_no =="NA-".$i ){?>
          <option value="NA-<?php echo $i;?>" selected="selected">NA-<?php echo $i;?></option>
          <?php }else{?>
          <option value="NA-<?php echo $i;?>">NA-<?php echo $i;?></option>
          <?php }}?>
        </select>
      </div>
     
      <label>Electricity: </label>
      <div class="formRight">
        <input type="radio" name="electric_meter"  value="1" <?php if( $property->electric_meter==1){echo 'checked="checked"';} ?>/>
        <label>Yes</label>
        <input type="radio" name="electric_meter"  value="0" <?php if( $property->electric_meter==0){echo 'checked="checked"';} ?>/>
        <label>No</label>
      </div>
      
     
      
      <div class="fix"></div>
    </div>

  <div class="rowElem">
   <label>Sui Gas: </label>
      <div class="formRight">
        <input type="radio" name="sui_gas" value="1" <?php if( $property->sui_gas==1){echo 'checked="checked"';} ?> />
        <label>Yes</label>
        <input type="radio" name="sui_gas" value="0" <?php if( $property->sui_gas==0){echo 'checked="checked"';} ?> />
        <label>No</label>
      </div>
     
     
     <label>Water Supply: </label>
      <div class="formRight">
        <input type="radio" name="water_supply"   value="1" <?php if( $property->water_supply==1 ){echo 'checked="checked"';} ?> />
        <label>Yes</label>
        <input type="radio" name="water_supply"  value="0" <?php if( $property->water_supply==0){echo 'checked="checked"';} ?>  />
        <label>No</label>
       </div> 
 
    <div class="fix"></div>
  </div>
  <div class="rowElem"> 
   <label>Coordinates:</label>
     <div class="formRight">
           <?php 
	$atts = array(
              'width'      => '900',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );
           echo anchor_popup('map/set_map_marker/'.$property->property_id , 'Add Coordinates', $atts);
		?>
    </div>
      
  <label>Remarks:</label>
    <div class="formRight">
      <textarea rows="4" cols="" name="remarks"  ><?php echo $property->remarks; ?></textarea>
    </div>
    <div class="fix"></div>
  </div>
  <div class="rowElem">
      <div style="width:247px; margin:10px auto 0;">
        <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('property','Cancel',$attributes);
       ?>
        <input type="submit" value="Save" class="basicBtn submitForm" />
      </div>
      <div class="fix"></div>
    </div>  
 </div>

  </div>
 
</fieldset>
<div class="fix"></div>
</form>
