<script type = "text/javascript">
      $(function(){
            // add suing party
			
            $("#add_suing_party").click(function(){
				 var i = $('#suing_counter').val();
				  i = parseInt(i);
                  var new_field = '<tr id="suing_row">';
                  new_field+='<td><input type="text" name="suing_name_'+i+'"  value=""  style="width:97%;" /></td>';
				  new_field+='<td><input type="text" name="suing_father_name_'+i+'"  value="" style="width:97%;" /></td>';
				  new_field+='<td> <input type="text" name="suing_address_'+i+'"  value=""   style="width:97%;" /></td>';
				  new_field+='</tr>';
				  i = i+1;
				  $('#suing_counter').val(i);
                  $("#suing_row").before(new_field);
				 
            });
			
			// add defending party
			
		   $("#add_defending_party").click(function(){
		          var i = $('#defending_counter').val();
				  i = parseInt(i);
                  var new_field = '<tr id="defending_row" class="def_'+i+'">';
                  new_field+='<td><input type="text" name="defending_name_'+i+'"  value=""  style="width:97%;" /></td>';
				  new_field+='<td> <input type="text" name="defending_address_'+i+'"  value=""   style="width:97%;" /></td>';
				  new_field+='</tr>';
				  i = i+1;
				  $('#defending_counter').val(i);
                  $("#defending_row").before(new_field);
            });
		   
		    
		   
      });
	  
	function remove_defending_party(i)
	{
	  i = parseInt(i);
	  $(".def_"+i).remove();
	  
    } 
	   
        
       
</script>
<!-- Form begins -->
<?php $this->load->view("property/property_js");?>
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('litigation/edit_litigation', $attributes);
?>
<!-- Input text fields -->

<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Litigation Edit Form</h5>
        <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('litigation/index/'.$litigation->litigation_category_id,'Close',$attributes);
       ?>
    </div>
    <?php 
	   if(validation_errors()){
	?>
    <div class="nNote nWarning hideit">
      <p><strong>WARNING: </strong><?php echo validation_errors(); ?></p>
    </div>
    <?php 
	   }
	  ?>
    <div class="rowElem  noborder">
      <label>Case Category:</label>
      <div class="formRight">
        <select name="category" id="category"  >
          <option value="">- - - - - - Select - - - - - -</option>
          <?php  if(  $litigation->category == 'Civil Suit'){ ?>
          <option value="Civil Suit" selected="selected">Civil Suit</option>
          <?php }else{?>
          <option value="Civil Suit">Civil Suit</option>
          <?php }?>
          <?php  if(  $litigation->category == 'Petition'){ ?>
          <option value="Petition" selected="selected">Petition</option>
          <?php }else{?>
          <option value="Petition">Petition</option>
          <?php }?>
          <?php  if(  $litigation->category == 'Review'){ ?>
          <option value="Review" selected="selected">Review</option>
          <?php }else{?>
          <option value="Review">Review</option>
          <?php }?>
          <?php  if(  $litigation->category == 'Appeal'){ ?>
          <option value="Appeal" selected="selected">Appeal</option>
          <?php }else{?>
          <option value="Appeal">Appeal</option>
          <?php }?>
          <?php  if(  $litigation->category == 'Revision'){ ?>
          <option value="Revision" selected="selected">Revision</option>
          <?php }else{?>
          <option value="Revision">Revision</option>
          <?php }?>
          <?php  if(  $litigation->category == 'Writ Petition'){ ?>
          <option value="Writ Petition" selected="selected">Writ Petition</option>
          <?php }else{?>
          <option value="Writ Petition">Writ Petition</option>
          <?php }?>
        </select>
      </div>
      <label>Court Name:</label>
      <div class="formRight">
      
        <select name="litigation_category_id" id="court" >
          <option value=""> - - - - - - Select - - - - - -</option>
          <?php  foreach($category_list as $list){ ?>
          <?php if( $list->litigation_category_id == $litigation->litigation_category_id){?>
          <option value=" <?php echo $list->litigation_category_id; ?>" selected="selected"><?php echo str_replace('Cases','', $list->category_name); ?>   </option>
         <?php }else{ ?>
         <option value=" <?php echo $list->litigation_category_id; ?>"><?php echo str_replace('Cases','', $list->category_name);?></option> 
          <?php } } ?>
        </select>
       
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem ">
      <label> Name of Judge:</label>
      <div class="formRight">
        <input type="text"   name="judge_name" value="<?php echo $litigation->name_of_judge; ?>" />
      </div>
      <label>No. of Case:</label>
      <div class="formRight">
        <input type="text"   name="case_number" value="<?php echo $litigation->case_number; ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem ">
      <label>Institution Date:</label>
      <div class="formRight">
        <input type="text" name="institution_date"  value="<?php echo $litigation->date_of_institution; ?>" class="datepicker" />
      </div>
      <label>Subject of Case:</label>
      <div class="formRight">
        <input type="text" name="title_of_case"  value="<?php echo $litigation->title_of_case; ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem ">
      <label>Summary of Case:</label>
      <div class="formRight">
        <textarea rows="2" cols="" name="case_summary"   ><?php echo $litigation->case_summary; ?></textarea>
      </div>
      <label>Description of Land:</label>
      <div class="formRight">
        <textarea rows="2" cols="" name="description_of_land"   ><?php echo $litigation->description_of_land; ?></textarea>
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Title of Property:</label>
      <div class="formRight">
        <select name="title_of_property" id="title_of_property" >
          <option value="">- - - - - - Select - - - - - -</option>
          <?php  if(  $litigation->property_title == 'Evacuee Land'){ ?>
          <option value="Evacuee Land" selected="selected">Evacuee Land</option>
          <?php }else{?>
          <option value="Evacuee Land">Evacuee Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Provincial Land'){ ?>
          <option value="Provincial Land" selected="selected">Provincial Land</option>
          <?php }else{?>
          <option value="Provincial Land">Provincial Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Ex-MCL Land'){ ?>
          <option value="Ex-MCL Land" selected="selected">Ex-MCL Land</option>
          <?php }else{?>
          <option value="Ex-MCL Land">Ex-MCL Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Federal Land'){ ?>
          <option value="Federal Land" selected="selected">Federal Land</option>
          <?php }else{?>
          <option value="Federal Land">Federal Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Army Land'){ ?>
          <option value="Army Land" selected="selected">Army Land</option>
          <?php }else{?>
          <option value="Army Land">Army Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Railway Land'){ ?>
          <option value="Railway Land" selected="selected">Railway Land</option>
          <?php }else{?>
          <option value="Railway Land">Railway Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Private Land'){ ?>
          <option value="Private Land" selected="selected">Private Land</option>
          <?php }else{?>
          <option value="Private Land">Private Land</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Muslim Auqaf'){ ?>
          <option value="Muslim Auqaf" selected="selected">Muslim Auqaf</option>
          <?php }else{?>
          <option value="Muslim Auqaf">Muslim Auqaf</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Evacuee Trust'){ ?>
          <option value="Evacuee Trust" selected="selected">Evacuee Trust</option>
          <?php }else{?>
          <option value="Evacuee Trust">Evacuee Trust</option>
          <?php }?>
          <?php  if(  $litigation->property_title == 'Other Lands'){ ?>
          <option value="Other Lands" selected="selected">Other Lands</option>
          <?php }else{?>
          <option value="Other Lands">Other Lands</option>
          <?php }?>
        </select>
      </div>
      <label>Area(K-M-SQFT):</label>
      <div class="formRight">
        <input type="text" name="kanal"  placeholder="Kanal" style=" width:25%" maxlength="5"  value="<?php echo $litigation->area_kanal; ?>" />
        :
        <input type="text" name="marla"  placeholder="Marla" maxlength="2" style=" width:25%" maxlength="5" value="<?php echo $litigation->area_marla; ?>" />
        :
        <input type="text" name="sqft"  placeholder="Sqft" maxlength="3" style=" width:25%" maxlength="10"  value="<?php echo $litigation->area_sqft; ?>"  />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Property Type:</label>
      <div class="formRight">
        <select name="property_category" id="property_category" >
          <option value=""> - - - - - - - Select - - - - - - </option>
          <?php  if(  $litigation->property_category	 == 'Commercial'){ ?>
          <option value="Commercial" selected="selected">Commercial</option>
          <?php }else{?>
          <option value="Commercial">Commercial</option>
          <?php }?>
          <?php  if(  $litigation->property_category	 == 'Residential'){ ?>
          <option value="Residential" selected="selected">Residential</option>
          <?php }else{?>
          <option value="Residential">Residential</option>
          <?php }?>
          <?php  if(  $litigation->property_category	 == 'Agricultural'){ ?>
          <option value="Agricultural" selected="selected">Agricultural</option>
          <?php }else{?>
          <option value="Agricultural">Agricultural</option>
          <?php }?>
        </select>
      </div>
      <label>Mauza:</label>
      <div class="formRight">
        <select name="mauza_id" id="mauza">
          <option value="">- - - - - - - Select - - - - - - -</option>
          <?php foreach($mauza_list as $m_list) {?>
          <?php if( $m_list->mauza_id == $litigation->mauza_id) {  ?>
          <option value="<?php echo $m_list->mauza_id; ?>" selected="selected"><?php echo $m_list->mouza_name; ?></option>
          <?php }else { ?>
          <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
          <?php } } ?>
        </select>
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Date of Hearing:</label>
      <div class="formRight">
        <input type="text" name="date_of_hearing"  value="<?php echo $litigation->date_of_hearing; ?>" class="datepicker" />
      </div>
      <label>Feedback No:</label>
      <div class="formRight">
        <input type="text" name="feedback_no"  value="<?php echo $litigation->feedback_no; ?>" />
      </div>
    </div>
    <div class="rowElem">
      <label>Dealing Official:</label>
      <div class="formRight">
        <input type="text" name="dealing_official"  value="<?php echo $litigation->official_concerned; ?>" />
      </div>
      <label>Contact No:</label>
      <div class="formRight">
        <input type="text" name="DO_contact_no"  value="<?php echo $litigation->contact_number; ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Name of Counsel : </label>
      <div class="formRight">
        <input type="text" name="name_of_counsel"  value="<?php echo $litigation->state_counsel; ?>" />
      </div>
      <label>Contact No: </label>
      <div class="formRight">
        <input type="text" name="contact_of_counsel"  value="<?php echo $litigation->sc_contact_number; ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <div class="widgets">
        <div class="widget"  style="margin:20px 5px 0;">
          <div class="head">
            <h5 class="iFull2">Suing Party</h5>
            <input type="button" name="add_suing_party" id="add_suing_party" value="Add Suing Party" class="basicBtn header_button" />
          </div>
          <input type="hidden" name="suing_counter" value="<?php echo count($suing_party)+1;?>" id="suing_counter"  />
          <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <td width="25%">Name</td>
                <td width="25%">Father Name</td>
                <td>Address</td>
              </tr>
            </thead>
            <tbody>
              <?php
			  $i = 1;
			  if(count($suing_party)>0)
			  {
			  foreach($suing_party as $list){?>
            
              <tr id="suing_row">
              
                <td>
                  <input type="hidden" name="suing_party_id_<?php echo $i;?>"  value="<?php echo $list->suing_party_id; ?>"  />
                <input type="text" name="suing_name_<?php echo $i;?>"  value="<?php echo $list->suing_party_name; ?>"  style="width:97%;" /></td>
                <td><input type="text" name="suing_father_name_<?php echo $i;?>"  value="<?php echo $list->suing_party_father_name; ?>" style="width:97%;" /></td>
                <td><input type="text" name="suing_address_<?php echo $i;?>"  value="<?php echo $list->suing_party_address; ?>"   style="width:97%;" /></td>
              </tr>
              <?php
			  $i++; 
			    } 
			  } else {
			  ?>
                 <tr id="suing_row">
              
                <td colspan="3"></td>
                </tr>
              <?php } ?>  
            </tbody>
          </table>
        </div>
        <div class="widget" style="margin:20px 5px 0;">
          <div class="head">
            <h5 class="iFull2">Defending Party</h5>
            <input type="button" name="add_defending_party" id="add_defending_party" value="Add Defending Party" class="basicBtn header_button" />
           
          </div>
           <input type="hidden" name="defending_counter" value="<?php echo count($defending_party)+1;?>" id="defending_counter"  />
          <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <td width="50%">Name</td>
                <td>Address</td>
              <!--  <td>Remove</td>-->
              </tr>
            </thead>
 <?php
	 $i = 1;
	 if(count($defending_party)>0){
	foreach($defending_party as $list){?>
              
  <tr id="defending_row" class="def_<?php echo  $i; ?>">
   <td>
    <input type="hidden" name="defending_party_id_<?php echo $i;?>"  value="<?php echo $list->defending_party_id; ?>"  />
   <input type="text" name="defending_name_<?php echo $i;?>"  value="<?php echo $list->defending_party_name; ?>"  style="width:97%;" /></td>
   <td><input type="text" name="defending_address_<?php echo $i;?>"  value="<?php echo $list->defending_party_address; ?>"  style="width:97%;" /></td>
    <?php /*?>   <td width="10">
        <img src="<?php echo base_url(); ?>asset/images/icons/notifications/exclamation.png" onclick="remove_defending_party(<?php echo  $i; ?>);" />
       </td><?php */?>
   </tr>
   <?php 
   $i++; } 
	 }
	 else{
   ?> 
      <tr id="defending_row">
       <td colspan="2"></td>
      </tr>
     <?php } ?>
            </tbody>
            
          </table>
        </div>
        <div class="fix"></div>
      </div>
      <div class="fix"></div>
    </div>
    <div class="fix"></div>
    <div class="fix"></div>
    <div class="rowElem">
      <div style="width:247px; margin:10px auto 0;">
        <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('litigation/index/'.$litigation->litigation_category_id,'Cancel',$attributes);
       ?>
        <input type="hidden" name="litigation-id"  value="<?php echo $litigation->litigation_id; ?>" />
        <input type="submit" value="Save" class="basicBtn submitForm" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="fix"></div>
  </div>
</fieldset>
<div class="fix"></div>
</form>
