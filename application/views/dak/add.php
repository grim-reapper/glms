<?php 
$attributes = array('class' => 'mainForm');

echo  form_open_multipart('dak/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Add New Dak</h5>
</div>

<?php echo validation_errors(); ?>

<div class="rowElem  noborder">
  <label>Subject:</label>
  <div class="formRight" style="width: 71%;">
 
    <input type="text" name="subject" value=""  />
  
  </div>
 </div>  
 <div class="fix"></div>

<div class="rowElem  noborder">
  <label>PUC :</label>
  <div class="formRight"  style="width: 71%;">
    <input type="text"   name="puc" value="" />
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>Attach File :</label>
  <div class="formRight"  style="width: 71%;">
    <input type="file"   name="attach_file"  value=""/>
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>Note: </label>
  <div class="formRight"  style="width: 72%;">
     <div style="border:1px solid #D5D5D5;">
       <textarea name="note" rows="15" id="content" ></textarea>
       <?php echo display_ckeditor($ck["ckeditor"]); ?>
     </div>  
 </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
 <label></label>
  <div class="formRight" >
   <select name="addressee"  >
   <option value="">Select Addressee</option>
   <option value="Head Clerk (Nazul)">Head Clerk (Nazul)</option>
   <option value="Naib Tehsildar (N)">Naib Tehsildar (N)</option>
   <option value="General Assistant-I">General Assistant-I</option>
   <option value="General Assistant-II">General Assistant-II</option>
   <option value="Addl: District Collector">Addl: District Collector</option>
   <option value="District Collector">District Collector</option>
   </select>
  </div>
  <label></label>
  <div class="formRight"  >
   <select name="signtory"  style="width: 87%;">
   <option value="">Select Signatory</option>
   <option value="Head Clerk (Nazul)">Head Clerk (Nazul)</option>
   <option value="Naib Tehsildar (N)">Naib Tehsildar (N)</option>
   <option value="General Assistant-I">General Assistant-I</option>
   <option value="General Assistant-II">General Assistant-II</option>
   <option value="Addl: District Collector">Addl: District Collector</option>
   <option value="District Collector">District Collector</option>
   </select>
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label></label>
  <div class="formRight" style=" margin-top: 16px; text-align: center; width: 100%;">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('dak','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>
</div>
</div>
</fieldset>
</form>