<?php 
$attributes = array('class' => 'mainForm');

echo  form_open_multipart('laws/edit', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">Edit Law</h5>
</div>

<?php echo validation_errors(); ?>

<div class="rowElem  noborder">
  <label>Law Title:</label>
  <div class="formRight" style="width: 71%;">
 
    <input type="text" name="law_title" value="<?php echo $law->law_title;?>"  />

  </div>
 </div>  
 <div class="fix"></div>
 
<div class="rowElem  noborder">
  <label>Law Category:</label>
  <div class="formRight" style="width: 20%;">
    <select name="law_category_id">
     <option value="" selected="selected" >Select</option>
     <?php foreach($law_categories as $list){?>
     <?php  if($law->law_category_id == $list->law_category_id){ ?>
        <option value="<?php echo $list->law_category_id; ?>" selected="selected"><?php echo $list->law_category_name; ?></option>   
     <?php }  else { ?>
        <option value="<?php echo $list->law_category_id; ?>"><?php echo $list->law_category_name; ?></option>
     <?php } } ?>
    </select>
  
  </div>
 </div>  
 <div class="fix"></div>
 
<div class="rowElem  noborder">
  <label>Passing Year :</label>
  <div class="formRight" style="width: 20%;" >
      <select name="passing_date">
          <?php  for($i =1800; $i<=date('Y');$i++){ ?>
           <?php if($law->law_passing_date == $i) {?>
            <option value="<?php echo $i; ?>" selected="selected" ><?php echo $i; ?></option>
            <?php } else { ?>
             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } } ?>
      </select>
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>Image File(png,jpg,gif) :</label>
  <div class="formRight"  style="width: 71%;">
      <?php if($law->img_file !='' ){  echo anchor('uploads/laws/'.$law->img_file,$law->img_file,array('target'=>'_blank')); } ?>
      <br />
    <input type="file"   name="img_file" />
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>PDF File :</label>
  <div class="formRight"  style="width: 71%;">
      
       <?php if($law->pdf_file !='' ){ echo anchor('uploads/laws/'.$law->pdf_file , $law->pdf_file ,array('target'=>'_blank') ); }?>
      <br />
    <input type="file"   name="pdf_file" />
  </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label>Note: </label>
  <div class="formRight"  style="width: 72%;">
     <div style="border:1px solid #D5D5D5;">
       <textarea name="law_detail" rows="15" id="content" > <?php echo $law->law_detail;?> </textarea>
       <?php echo display_ckeditor($ck["ckeditor"]); ?>
     </div>  
 </div>
  
  <div class="fix"></div>
</div>



<div class="rowElem  noborder">
  <label></label>
  <div class="formRight" style=" margin-top: 16px; text-align: center; width: 100%;">
    <input type="submit"   name="submit" value="Save" class="basicBtn"  />
    <input type="hidden" name="law_id" value="<?php echo $law->law_id;?>">
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