<?php 
$attributes = array('class' => 'mainForm');

echo  form_open_multipart('laws/save', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Add Law</h5>
</div>

<?php echo validation_errors(); ?>

<div class="rowElem  noborder">
  <label>Law Title:</label>
  <div class="formRight" style="width: 71%;">
 
    <input type="text" name="law_title" value=""  />
  
  </div>
 </div>  
 <div class="fix"></div>
 
<div class="rowElem  noborder">
  <label>Law Category:</label>
  <div class="formRight" style="width: 20%;">
    <select name="law_category_id">
     <option value="" selected="selected" >Select</option>
     <?php foreach($law_categories as $list){?>
     <option value="<?php echo $list->law_category_id; ?>"><?php echo $list->law_category_name; ?></option>
     <?php } ?>
    </select>
  
  </div>
 </div>  
 <div class="fix"></div>
 
<div class="rowElem  noborder">
  <label>Passing Date :</label>
  <div class="formRight" style="width: 20%;" >
      <select name="passing_date">
          <?php  for($i =1800; $i<=date('Y');$i++){ ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
      </select>
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>Image File(png,jpg,gif) :</label>
  <div class="formRight"  style="width: 71%;">
    <input type="file"   name="img_file" />
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>PDF File :</label>
  <div class="formRight"  style="width: 71%;">
    <input type="file"   name="pdf_file" />
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>Note: </label>
  <div class="formRight"  style="width: 72%;">
     <div style="border:1px solid #D5D5D5;">
       <textarea name="law_detail" rows="15" id="content" ></textarea>
       <?php echo display_ckeditor($ck["ckeditor"]); ?>
     </div>  
 </div>
  
  <div class="fix"></div>
</div>



<div class="rowElem  noborder">
  <label></label>
  <div class="formRight" style=" margin-top: 16px; text-align: center; width: 100%;">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
   <?php
	$attributes = array('class' => 'basicBtn a_button');
	echo anchor('law','Cancel',$attributes);
	?>
  </div>

  <div class="fix"></div>
</div>
</div>
</div>
</fieldset>
</form>