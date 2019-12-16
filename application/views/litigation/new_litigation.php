<script type = "text/javascript">
      $(function(){
            
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
			
		   $("#add_defending_party").click(function(){
		          var i = $('#defending_counter').val();
				  i = parseInt(i);
                  var new_field = '<tr id="suing_row">';
                  new_field+='<td><input type="text" name="defending_name_'+i+'"  value=""  style="width:97%;" /></td>';
				  new_field+='<td> <input type="text" name="defending_address_'+i+'"  value=""   style="width:97%;" /></td>';
				  new_field+='</tr>';
				  i = i+1;
				  $('#defending_counter').val(i);
                  $("#defending_row").before(new_field);
            });
      });
</script>


<!-- Form begins -->
<?php $this->load->view("property/property_js");?>
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('litigation/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Litigation Entery Form </h5>
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
          <option value="Civil Suit">Civil Suit</option>
          <option value="Petition">Petition</option>
          <option value="Review">Review</option>
          <option value="Appeal">Appeal</option>
          <option value="Revision">Revision</option>
          <option value="Writ Petition">Writ Petition</option>
        </select>
      </div>
      <label>Court Name:</label>
      <div class="formRight">
        <?php if(false){?>
        <select name="litigation_category_id" id="court" >
          <option value=""> - - - - - - Select - - - - - -</option>
          <?php  foreach($category_list as $list){ ?>
          <option value=" <?php echo $list->litigation_category_id; ?>"><?php echo $list->category_name; ?></option>
          <?php } ?>
        </select>
        <?php } else { ?>
        <input type="hidden" name="litigation_category_id" value=" <?php echo $litigation_category->litigation_category_id; ?>" />
        <?php echo "<strong>".$litigation_category->category_name."</strong>"; ?>
        <?php } ?>
      
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem ">
      <label> Name of Judge:</label>
      <div class="formRight">
        <input type="text"   name="judge_name" value="<?php echo set_value('judge_name'); ?>" />
      </div>
      <label>No. of Case:</label>
      <div class="formRight">
        <input type="text"   name="case_number" value="<?php echo set_value('case_number'); ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem ">
      <label>Institution Date:</label>
      <div class="formRight">
        <input type="text" name="institution_date"  value="<?php echo set_value('institution_date'); ?>" class="datepicker" />
      </div>
      <label>Subject of Case:</label>
      <div class="formRight">
        <input type="text" name="title_of_case"  value="<?php echo set_value('title_of_case'); ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem ">
      <label>Summary of Case:</label>
      <div class="formRight">
        <textarea rows="2" cols="" name="case_summary"   ><?php echo set_value('case_summary'); ?></textarea>
      </div>
      <label>Description of Land:</label>
      <div class="formRight">
        <textarea rows="2" cols="" name="description_of_land"   ><?php echo set_value('description_of_land'); ?></textarea>
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Title of Property:</label>
      <div class="formRight">
        <select name="title_of_property" id="title_of_property" >
          <option value="">- - - - - - Select - - - - - -</option>
          <option value="Evacuee Land">Evacuee Land</option>
          <option value="Provincial Land">Provincial Land</option>
          <option value="Ex-MCL Land">Ex-MCL Land</option>
          <option value="Federal Land">Federal Land</option>
          <option value="Army Land">Army Land</option>
          <option value="Railway Land">Railway Land</option>
          <option value="Private Land">Private Land</option>
          <option value="Muslim Auqaf">Muslim Auqaf</option>
          <option value="Evacuee Trust">Evacuee Trust</option>
          <option value="Other Lands">Other Lands</option>
        </select>
      </div>
      <label>Area:</label>
      <div class="formRight">
        <input type="text" name="kanal"  placeholder="Kanal" size="4" style=" width:20%" maxlength="5"  value="<?php echo set_value('kanal'); ?>" />
        :
        <input type="text" name="marla"  placeholder="Marla" size="5" style=" width:25%" maxlength="5" value="<?php echo set_value('marla'); ?>" />
        :
        <input type="text" name="sqft"  placeholder="Sqft" size="6" style=" width:25%" maxlength="10"  value="<?php echo set_value('sqft'); ?>"  />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Property Category:</label>
      <div class="formRight">
        <select name="property_category" id="property_category" >
          <option value=""> - - - - - - - Select - - - - - -</option>
          <option value="Commercial">Commercial</option>
          <option value="Residential">Residential</option>
          <option value="Agricultural">Agricultural</option>
        </select>
      </div>
      <label>Mauza:</label>
      <div class="formRight">
        <select name="mauza_id" id="mauza">
          <option value="">- - - - - - - Select - - - - - - -</option>
          <?php foreach($mauza_list as $m_list) {?>
          <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Date of Hearing:</label>
      <div class="formRight">
        <input type="text" name="date_of_hearing"  value="<?php echo set_value('date_of_hearing'); ?>" class="datepicker" />
      </div>
      <label>Feedback No:</label>
      <div class="formRight">
        <input type="text" name="feedback_no"  value="<?php echo set_value('feedback'); ?>" />
      </div>
    </div>
    <div class="rowElem">
      <label>Dealing Official:</label>
      <div class="formRight">
        <input type="text" name="dealing_official"  value="<?php echo set_value('dealing_official'); ?>" />
      </div>
      <label>Contact No:</label>
      <div class="formRight">
        <input type="text" name="DO_contact_no"  value="<?php echo set_value('DO_contact_no'); ?>" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">
      <label>Name of Counsel : </label>
      <div class="formRight">
        <input type="text" name="name_of_counsel"  value="<?php echo set_value('name_of_counsel'); ?>" />
      </div>
      <label>Contact No: </label>
      <div class="formRight">
        <input type="text" name="contact_of_counsel"  value="<?php echo set_value('contact_of_counsel'); ?>" />
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
            <input type="hidden" name="suing_counter" value="2" id="suing_counter"  />
            <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <td width="25%">Name</td>
                  <td width="25%">Father Name</td>
                  <td>Address</td>
                </tr>
                
              </thead>
              <tbody>
                <tr id="suing_row">
                  <td><input type="text" name="suing_name_1"  value=""  style="width:97%;" /></td>
                  <td><input type="text" name="suing_father_name_1"  value="" style="width:97%;" /></td>
                  <td> <input type="text" name="suing_address_1"  value=""   style="width:97%;" /></td>
                </tr>
              </tbody>
            </table>
         
        </div>
      
          <div class="widget" style="margin:20px 5px 0;">
            <div class="head">
              <h5 class="iFull2">Defending Party</h5>
 
        <input type="button" name="add_defending_party" id="add_defending_party" value="Add Defending Party" class="basicBtn header_button" />
        <input type="hidden" name="defending_counter" value="2" id="defending_counter"  />
            </div>
            <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <td width="40%">Name</td>
                  <td>Address</td>
                </tr>
              </thead>
              
                <tr id="defending_row">
                  <td><input type="text" name="defending_name_1"  value=""  style="width:97%;" /></td>
                  <td><input type="text" name="defending_address_1"  value=""  style="width:97%;" /></td>
                </tr>
              </tbody>
            </table>
     
        </div>
        <div class="fix"></div>
      </div>
      <div class="fix"></div>
    </div>
    <div class="fix"></div>
    <div class="rowElem">
      <div style="width:247px; margin:10px auto 0;">
        <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('litigation','Cancel',$attributes);
       ?>
        <input type="submit" value="Submit" class="basicBtn submitForm" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="fix"></div>
  </div>
</fieldset>
<div class="fix"></div>
</form>
