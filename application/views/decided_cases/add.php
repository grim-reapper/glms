<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('decided_cases/add_case', $attributes);
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
                     <option value="0">Select</option>
                    <?php foreach ($mauza as $list) { ?>
                        <option value="<?php echo $list->mauza_id; ?>"><?php echo $list->mouza_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <label style="width:120px">Case No:</label>
            <div class="formRight" style="width:150px">
               <input type="text" name="case_no" value=""/>
            </div>
            <label style="width:120px">Date of Institution:</label>
            <div class="formRight" style="width:208px">
               <input type="text" name="date_institution" value="" class="datepicker"/>
            </div>

            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label style="width:163px" >Petitioner:</label>
            <div class="formRight" style="width:120px">
                <input type="text" name="suing_party" value="" />
            </div>
            <label style="width:120px">Counsel:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="suing_counsel" value=""/>
            </div>
            <label style="width:120px">Contact:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="suing_contact" value=""/>
            </div>

            <div class="fix"></div>
        </div>
       
        <div class="rowElem">
            <label style="width:163px" >Respondant:</label>
            <div class="formRight" style="width:120px">
                <input type="text" name="defending_party" value="" />
            </div>
            <label style="width:120px">Counsel:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="defending_counsel" value=""/>
            </div>
            <label style="width:120px">Contact:</label>
            <div class="formRight" style="width:150px">
                <input type="text" name="defending_contact" value=""/>
            </div>

            <div class="fix"></div>
        </div>
        
         <div class="rowElem  noborder">
            <label style="width:163px">Case Categories:</label>
            <div class="formRight" style="width:120px">
                <select name="case_title" id="id" >
                    <option value="0">Select</option>
                    <?php foreach ($case_title as $list) { ?>
                        <option value="<?php echo $list->case_tittle_id; ?>"><?php echo $list->case_tittle_name; ?></option>
                    <?php } ?>

                </select>
            </div>

            <label style="width:120px">Case Proceedings:</label>
            <div class="formRight" style="width:150px">
                <select name="case_proceedings" id="id"  >
                     <option value="0">Select</option>
                    <?php foreach ($case_proceedings as $list) { ?>
                        <option value="<?php echo $list->proceedings_id; ?>"><?php echo $list->proceedings_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <label style="width:120px">Priority:</label>
            <div class="formRight" style="width:150px">
                <select name="Priority" id="mauza" >
                    <option value="0">Select Priority</option>
                    <option value="Average">Average</option>
                    <option value="High">High</option>
                    <option value="Time Limit">Time Limit</option>
                 </select>
       
         </div>
            <div class="fix"></div>
        </div>
      
        <div class="rowElem">
           
            
            <label>Date of Hearing:</label>
            <div class="formRight">
                <input type="text" name="date_hearing" value="" class="datepicker"/>
            </div>
             <label>Case Fate:</label>
            <div class="formRight" style="width:150px">
                <select name="decided_fate" id="mauza" >
                    <option value="">Select</option>
                    <option value="1">Accepted</option>
                    <option value="2">Dismissed</option>
                    <option value="3">Adj Sine Die</option>
                 </select>
       
         </div>
            
             <div class="fix"></div>
             </div>
         <div class="rowElem">
          <label><b>Summary of the Case:</b></label>
            <div class="formRight">
                <textarea rows="4" cols="" name="note"  placeholder="" style="width:775px;" ></textarea>
            </div>
  <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('decided_cases', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>

       
