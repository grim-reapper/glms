<script type="text/javascript">

$(function() {	
	$("#signtory").change(function(){
      var signtory = $(this).val();
	  if(signtory !="")
	  {
		  $("#add_note").show();
		  $("#date_abc").show();
		  
		  $("#note_label").html(signtory);
		  $("#note_label2").html(signtory);
	  }
	  else
	  {
		 $("#add_note").hide();  
	  }
    }); 
 }); 
</script>
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('dak/save_note', $attributes);
?>
<!-- Input text fields -->

<fieldset>
<div class="widget first_form">
<div class="head">
  <h5 class="iList">View Dak</h5>
</div>

<?php echo validation_errors(); ?>

<div class="rowElem  noborder">
  <label><strong>Subject:</strong></label>
  <div class="formRight" style="width: 68%;">
 
   <p><?php echo $dak->subject; ?></p>
  
  </div>
 </div>  
 <div class="fix"></div>

<div class="rowElem  ">
  <label><strong>P.U.C :</strong> <a rel="prettyPhoto" href="<?php echo base_url().'uploads/dak/'.$dak->file; ?>" style="text-decoration:underline;">View</a></label>
  <div class="formRight"  style="width: 72%;">
  <p><?php echo $dak->puc; ?></p>

  </div>
  
  <div class="fix"></div>
</div>


<div class="rowElem  ">
  <label><strong>Note:</strong></label>
  <div class="formRight"  style="width: 72%; text-align:justify">
     <?php echo $dak->note; ?>
 </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label></label>
  <div class="formRight"  style="width: 72%; text-align:right; font-weight:bold;">
  <br /> 
  <br /> 
     <?php echo $dak->signtory; ?>  <br /> 
     <?php echo mdate("%d - %m - %Y",$dak->date); ?> 
     
 </div>
  
  <div class="fix"></div>
</div>
<?php foreach($dak_note_list as $list){?>

<div class="rowElem  ">
  <label><strong><?php echo $list->addressee; ?> :</strong></label>
  <div class="formRight"  style="width: 72%; text-align:justify">
     <?php echo $list->dak_pad_note; ?>
 </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label></label>
  <div class="formRight"  style="width: 72%; text-align:right; font-weight:bold;">
  <br /> 
  <br /> 
     <?php echo $list->addressee; ?> <br /> 
     <?php echo mdate("%d - %m - %Y",$list->dak_pad_note_date); ?> 
     
 </div>
  
  <div class="fix"></div>
</div>
<?php } ?>


<div class="rowElem  noborder">
<label></label>
  <div class="formRight" >
   <select name="addressee"  >
   <option value="">Select Addressee</option>
   <option value="Head Clerk (Nazul)">Head Clerk (Nazul)</option>
   <option value="Naib Tehsildar (N)">Naib Tehsildar (N)</option>
   <option value="General Assistant-I">General Assistant-I</option>
   <option value="General Assistant-II">General Assistant-II</option>
   <option value="Addl: Collector">Addl: Collector</option>
   <option value="District Collector">District Collector</option>
   </select>
  </div>
  
  <label></label>
  <div class="formRight"  >
   <select name="signtory"  id="signtory"  style="width: 87%;">
   <option value="">Select Signatory</option>
   <option value="Head Clerk (Nazul)">Head Clerk (Nazul)</option>
   <option value="Naib Tehsildar (N)">Naib Tehsildar (N)</option>
   <option value="General Assistant-I">General Assistant-I</option>
   <option value="General Assistant-II">General Assistant-II</option>
   <option value="Addl: Collector">Addl: Collector</option>
   <option value="District Collector">District Collector</option>
   </select>
  </div>
  
 
  <div class="fix"></div>
</div>

<div class="rowElem  noborder" id="add_note" style="display:none;">
  <label id="note_label"></label>
  <div class="formRight"  style="width: 72%;">
     <div style="border:1px solid #D5D5D5;">
       <textarea name="ac_note" rows="15" id="content"  ></textarea>
       <?php echo display_ckeditor($ck["ckeditor"]); ?>
     </div>  
 </div>
  
  <div class="fix"></div>
</div>

<div class="rowElem  noborder" style="display:none;" id="date_abc">
  <label></label>
  <div class="formRight"  style="width: 72%; text-align:right; font-weight:bold;">
  <br /> 
    <div id="note_label2"></div>
     <?php echo mdate("%d - %m - %Y",time()); ?>   
   </div>
  <div class="fix"></div>
</div>

<div class="rowElem  noborder">
  <label></label>
  <div class="formRight " style=" margin-top: 16px; text-align: center; width: 100%;">
    <input type="hidden" name="dak_pad_id" value="<?php echo $dak->dak_pad_id; ?>" />
    
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