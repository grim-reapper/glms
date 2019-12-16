<?php
$attributes = array('class' => 'mainForm');

echo form_open('judicial_cases/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form"> 
        <div class="head">
            <h5 class="iList">Judicial Case Update Form</h5>
        </div>
        
        <div class="rowElem">
            
       
             <div class="label" style="width: 140px;">Case No:</div>
             <div class="cotent" style="width: 208px;"> <?php echo $case->case_no; ?> </div>
            <input type="hidden"   name="case_no" value="<?php  echo $case->case_no; ?>" />
          
      
           
       
             <div class="label" style="width: 140px;">Petitioner:</div>
             <div class="cotent" style="width: 130px;"> <?php echo $case->suing_party_name; ?> </div>
             <div class="label" style="width: 140px;">Respondant:</div>
             <div class="cotent" style="width: 130px;"> <?php echo $case->defending_party_name; ?> </div>
          <input type="hidden"   name="suing_party" value="<?php  echo $case->suing_party_name; ?>" />
          <input type="hidden"   name="suing_counsel" value="<?php  echo $case->suing_counsel; ?>" />
          <input type="hidden"   name="suing_contact" value="<?php  echo $case->suing_contact; ?>" />
          <input type="hidden"   name="mauza" value="<?php  echo $case->mauza_id; ?>" />
          <input type="hidden"   name="date_institution" value="<?php  echo $case->date_of_institution; ?>" />
          <input type="hidden"   name="case_title" value="<?php  echo $case->case_tittle_id; ?>" />
          <input type="hidden"   name="case_id" value="<?php  echo $case->case_id; ?>" />
          <input type="hidden"   name="note" value="<?php  echo $case->Notes; ?>" />
          
        </div>
            
            
          
        
        
        <div class="rowElem">
            
            <label style="width: 140px;"> Next Date:</label>
        <div class="formRight" style="width:210px">
             <input type="text"   name="date_hearing" class="datepicker" style="width:120px" value="<?php echo date('d', strtotime($case->date_of_hearing)); ?> <?php echo date('M', strtotime($case->date_of_hearing)); ?> <?php echo date('Y', strtotime($case->date_of_hearing)); ?> " />
          <input type="hidden"   name="defending_party" value="<?php  echo $case->defending_party_name; ?>" />
          <input type="hidden"   name="defending_counsel" value="<?php  echo $case->defending_party_counsel; ?>" />
          <input type="hidden"   name="defending_contact" value="<?php  echo $case->defending_contact; ?>" />
          
          
        </div>
                <label style="width:70px" >Priority:</label>
            <div class="formRight" style="width:145px" >
                <select name="Priority" id="mauza" >
                    
                    <?php if($case->priority== 'Average') {?>
                    <option value="Average" selected="selected"><?php echo $case->priority ;?></option>
                    <option value="High">High</option>
                    <option value="Time Limit">Time Limit</option>
                    <?php } else if($case->priority== 'High') {?>
                    <option value="Average" >Average</option>
                    <option value="High" selected="selected"><?php echo $case->priority ;?></option>
                    <option value="Time Limit">Time Limit</option>
                 
                    <?php } else if($case->priority== 'Time Limit') {?>
                    <option value="Average" >Average</option>
                    <option value="High" >High</option>
                    <option value="Time Limit" selected="selected"><?php echo $case->priority ;?></option>
                    <?php } else {?>
                     <option value="Average" >Average</option>
                    <option value="High" >High</option>
                    <option value="Time Limit">Time Limit</option>
                    <?php }?>
                    </select>
       
         </div>
             <label style="margin-left: 54px;
    width: 89px;" >Proceedings:</label>
            <div class="formRight" style="width:145px">
                <select name="case_proceedings" id="id">
                    <?php foreach ($case_proceedings as $list) { ?>
                        <?php if ($list->proceedings_id == $case->proceedings_id) { ?>
                            <option value="<?php echo $list->proceedings_id; ?>" selected="selected"><?php echo $list->proceedings_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->proceedings_id; ?>"><?php echo $list->proceedings_name; ?></option>
                    <?php }}?>
                </select>
            </div>
           <div class="fix"></div>     
        </div>
        
        <div class="rowElem">
     
          <label style="width: 140px;">Fate of Case:</label>
            <div class="formRight" style="width: 140px;" >
                <select name="fate_case" id="" >
                    <option value="0">Select</option>
                   <?php foreach ($fate_case as $list) {?>
                    <option value="<?php echo $list->fate_case_id;?>"><?php echo $list->fate_case_name;?></option>
                   <?php }?>
                 </select>
       
         </div>
          <div class="fix"></div>       
        </div>
       
         <div class="rowElem  noborder">
        <label></label>
         <div class="formRight">
          <input type="submit"   name="submit" value="Save" class="basicBtn"  />
			  <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('judicial_cases','Cancel',$attributes);
              ?>
        </div>
        <div class="fix"></div>
        
     
       
    </fieldset>
