
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('litigation/litigation_add_action', $attributes);
?>
<!-- Input text fields -->

<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Litigation Update Form</h5>
         <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('litigation','Close',$attributes);
        ?>
    </div>
  <table width="100%" border="1" class="details_view">
      <tr >
        <td id="title" width="9%">Case Category:</td>
        <td id="detail" width="12%"><?php echo $litigation->category; ?></td>
        <td id="title">Court Name:</td>
        <td id="detail" width="11%"><?php echo $litigation->name_of_court ; ?></td>
        <td id="title" width="18%">Name of Judge:</td>
        <td id="detail" ><?php echo $litigation->name_of_judge; ?></td>
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
        <td id="detail" ><?php echo $litigation->property_title; ?></td>
        <td id="title">Dealing Official:</td>
        <td id="detail"><?php echo $litigation->official_concerned; ?></td>
        <td id="title">Contact No:</td>
        <td id="detail"><?php echo $litigation->contact_number ; ?></td>
      </tr>
  </table>
     <div id="form_main">
    <div class="rowElem">
      <label>Proceedings Taken Today:</label>
      <div class="formRight">
        <input type="text" name="proceedings_taken"  value="" />
      </div>
           <label>Reply Status:</label>
        <div class="formRight">
          <input type="radio" name="reply_status"  value="Filed" />
          <label>Filed</label>
          <input type="radio" name="reply_status" value="Not Filed" checked="checked" />
          <label>Not Filed</label>
     
      <div class="fix"></div>
    </div>
   
      <div class="rowElem">
       <label>Next Day of Hearing:</label>
        <div class="formRight">
          <input type="text" name="next_day_of_hearing"  value=""  class="datepicker" />
        </div>
        <label>Appointed For:</label>
        <div class="formRight">
          <input type="text" name="appointed_for"  value="" />
        </div>
    
        </div>
        <div class="fix"></div>
      </div>
   
    <div class="rowElem">
       <label>Injunction Status:</label>
        <div class="formRight">
        <select name="injuction_status" id="injuction_status">
          <option value="" class="option_center">                  - - - - - - Select - - - - - -                </option>
        
          <option value="Stay Order Granted">Stay Order Granted</option>
          <option value="No Stay Order">No Stay Order</option>
          <option value="Stay Vacated">Stay Vacated</option>
        </select>
        </div>
      <label>Final Outcome:</label>
      <div class="formRight">
        <select name="final_out_come" id="final_out_come">
          <option value="" class="option_center"> - - - - - - Select - - - - - -  </option>
           <option value="Continued">Continued</option>
          <option value="Dismissed">Dismissed</option>
          <option value="Decreed">Decreed</option>
          <option value="Disposed Of">Disposed Of</option>
        </select>
      </div>
      <div class="fix"></div>
    </div>
       
        <div class="rowElem">
      <label>Priority</label>
      <div class="formRight">
        <input type="radio" name="priority"  value="High" />
          <label>High</label>
          <input type="radio" name="priority" value="Normal" checked="checked" />
          <label>Normal</label>
      </div>
      <label>Remarks:</label>
      <div class="formRight">
     <textarea rows="2" cols="" name="remarks"   ></textarea>
      </div>
    
      <div class="fix"></div>
    </div>
     <div class="rowElem" style="text-align:center;">
     <label></label>
     
      <div class="formRight" >
      
     <input type="hidden" name="litigation_id"  value="<?php echo $litigation->litigation_id; ?>" />
    <input type="submit" value="Update" class="basicBtn submitForm" />
     <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('litigation/view_detail/'.$litigation->litigation_id,'Cancel',$attributes);
       ?>
 </div>
 <div class="fix"></div>
</div>
 
   </div>

</fieldset>
<div class="fix"></div>
</form>
