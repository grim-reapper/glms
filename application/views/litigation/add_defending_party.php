
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('litigation/add_defending', $attributes);
?>
<!-- Input text fields -->

<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Defending Party</h5>
    </div>
  <table width="100%" border="1" class="details_view">
      <tr >
        <td id="title">Case Category:</td>
        <td id="detail"><?php echo $litigation->category; ?></td>
        <td id="title">Court Name:</td>
        <td id="detail"><?php echo $litigation->name_of_court ; ?></td>
        <td id="title">Name of Judge:</td>
        <td id="detail"><?php echo $litigation->name_of_judge; ?></td>
      </tr>
      <tr >
        <td id="title">No. of Case:</td>
        <td id="detail"><?php echo $litigation->case_number ; ?></td>
        <td id="title">Institution Date:</td>
        <td id="detail"><?php echo $litigation->date_of_institution; ?></td>
        <td id="title">Subject of Case:</td>
        <td id="detail"><?php echo $litigation->title_of_case ; ?></td>
      </tr>
      <tr >

        <td id="title">Title of Property:</td>
        <td id="detail" colspan="5"><?php echo $litigation->property_title; ?></td>
      </tr>
  </table>
    <div class="rowElem">
      <label>Defending Party:</label>
        <div class="formRight">
          <input type="text" name="name"  value=""   />
        </div>
      <label></label>
      <div class="formRight">
     
      </div>
      <div class="fix"></div>
    </div>
     <div class="rowElem">
    
      <label>Address:</label>
      <div class="formRight">
       <textarea rows="2" cols="" name="address"   ></textarea>
      </div>
        <label></label>
        <div class="formRight">
         
        </div>
      <div class="fix"></div>
    </div>
        <div class="rowElem">
    
      <label></label>
      <div class="formRight">
      <input type="hidden" name="litigation_id"  value="<?php echo $litigation->litigation_id; ?>" />
      <input type="submit" value="Submit form" class="greyishBtn submitForm" />
    
      </div>
        <label></label>
        <div class="formRight">
         
        </div>
      <div class="fix"></div>
    </div>
  
 
  

</fieldset>
<div class="fix"></div>
</form>
