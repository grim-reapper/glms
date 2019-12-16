<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('judicial_cases/update_file', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Judicial Case Form</h5>
        </div>
        
         <div class="rowElem">
            <label style="width:163px" >Mauza:</label>
            <div class="formRight" style="width:120px">
                <select name="mauza" id="id"  >
                     
                    <?php foreach ($mauza as $list) { ?>
                    <?php if($list->mauza_id == $case->mauza_id) {?>
                     <option value="<?php echo $list->mauza_id; ?>" selected="selected"><?php echo $list->mouza_name; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $list->mauza_id; ?>"><?php echo $list->mouza_name; ?></option>
                    <?php }} ?>
                </select>
            </div>
            <label style="width:120px">Case No:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="case_no" value="<?php echo $case->case_no;?>"/>
                <input type="hidden" name="case_id" value="<?php echo $case->case_id;?>"/>
            </div>
            <label style="width:120px">Date of Institution:</label>
            <div class="formRight" style="width:208px">
               <input type="text" name="date_institution" value="<?php echo date('d', strtotime($case->date_of_institution)); ?> <?php echo date('M', strtotime($case->date_of_institution)); ?> <?php echo date('Y', strtotime($case->date_of_institution)); ?>" class="datepicker"/>
            </div>

            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label style="width:163px" >Petitioner:</label>
            <div class="formRight" style="width:120px">
                <input type="text" name="suing_party" value="<?php echo $case->suing_party_name;?>" />
            </div>
            <label style="width:120px">Counsel:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="suing_counsel" value="<?php echo $case->suing_counsel;?>"/>
            </div>
            <label style="width:120px">Contact:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="suing_contact" value="<?php echo $case->suing_contact;?>"/>
            </div>

            <div class="fix"></div>
        </div>
       
        <div class="rowElem">
            <label style="width:163px" >Respondant:</label>
            <div class="formRight" style="width:120px">
                <input type="text" name="defending_party" value="<?php echo $case->defending_party_name;?>" />
            </div>
            <label style="width:120px">Counsel:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="defending_counsel" value="<?php echo $case->defending_party_counsel;?>"/>
            </div>
            <label style="width:120px">Contact:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="defending_contact" value="<?php echo $case->defending_contact;?>"/>
            </div>

            <div class="fix"></div>
        </div>
        
         <div class="rowElem  noborder">
            <label style="width:163px">Case Categories:</label>
            <div class="formRight" style="width:120px">
                <select name="case_title" id="id" >
                    
                    <?php foreach ($case_tittle as $list) { ?>
                    <?php if($list->case_tittle_id == $case->case_tittle_id) {?>
                     <option value="<?php echo $list->case_tittle_id; ?>" selected="selected"><?php echo $list->case_tittle_name; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $list->case_tittle_id; ?>"><?php echo $list->case_tittle_name; ?></option>
                    <?php }} ?>

                </select>
            </div>

            <label style="width:120px">Case Proceedings:</label>
            <div class="formRight" style="width:150px">
                <select name="case_proceedings" id="id"  >
                     
                    <?php foreach ($case_proceedings as $list) { ?>
                     <?php if($list->proceedings_id == $case->proceedings_id) {?>
                     <option value="<?php echo $list->proceedings_id; ?>" selected="selected"><?php echo $list->proceedings_name; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $list->proceedings_id; ?>"><?php echo $list->proceedings_name; ?></option>
                    <?php } }?>
                </select>
            </div>
            <label style="width:120px">Priority:</label>
            <div class="formRight" style="width:150px">
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
                 </select>
       
         </div>
            <div class="fix"></div>
        </div>
      
        <div class="rowElem">
           
            
            <label>Date of Hearing:</label>
            <div class="formRight">
                <input type="text" name="date_hearing" value="<?php echo date('d', strtotime($case->date_of_hearing)); ?> <?php echo date('M', strtotime($case->date_of_hearing)); ?> <?php echo date('Y', strtotime($case->date_of_hearing)); ?>" class="datepicker"/>
            </div>
             <label>Case Fate:</label>
            <div class="formRight" style="width:150px">
                <select name="Priority" id="mauza" >
                    <option value="">Select</option>
                    <option value="">Accepted</option>
                    <option value="">Dismissed</option>
                    <option value="">Adj Sine Die</option>
                 </select>
       
         </div>
            
             <div class="fix"></div>
             </div>
         <div class="rowElem">
          <label><b>Summary of the Case:</b></label>
            <div class="formRight">
                <textarea rows="4" cols="" name="note"  placeholder="" style="width:775px;" ><?php echo $case->Notes;?></textarea>
            </div>
  <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('judicial_cases', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>

       
