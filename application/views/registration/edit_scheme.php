<?php $this->load->view("property/property_js");?>
<?php

$attributes = array('class' => 'mainForm');

echo form_open_multipart('registration/update_scheme', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Add Scheme</h5>
        </div>
        <?php if(validation_errors()){ ?>
            <div class="errors">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
        <input type="hidden" value="<?php echo $scheme->id;?>" name="id">
        <div class="rowElem  noborder">
            <label>Name of Housing Scheme:</label>
            <div class="formRight">
                <input type="text"   name="housing_scheme" value="<?php echo $scheme->housing_scheme?>" />
            </div>
            <label>Area of Scheme:</label>
            <div class="formRight">
                <input type="text" name="kanal"  id="kanal"  size="4" style=" width:20%" maxlength="5"  value="<?php echo $scheme->kanal; ?>"/>
                :
                <input type="text" name="marla"  id="marla"  size="5" style=" width:25%" maxlength="2" value="<?php echo $scheme->marla; ?>" />
                :
                <input type="text" name="sqft" id="sqft"  size="6" style=" width:25%" maxlength="3"  value="<?php echo $scheme->sqft; ?>" />
            </div>
        </div>
        <div class="rowElem">
            <label>Tehsil</label>
            <div class="formRight">
                <input type="text" name="tehsil_name" value="<?php echo $scheme->tehsil_name?>">
            </div>
            <label>Mouaza:</label>
            <div class="formRight">
                <input type="text" name="mouza_name" value="<?php echo $scheme->mouza_name?>">

            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label>Years of Approval:</label>
            <div class="formRight">
                 <select name="approval_year" id="approval_year">
                    <option value="">Select </option>
                    <?php for($i = date('Y'); $i >= 1950; $i--){ ?>
                        <option value="<?php echo $i; ?>" <?php echo $i == $scheme->approval_year ? 'selected' : '' ?>><?php echo $i; ?> </option>
                    <?php } ?>
                </select>
            </div>
            <label>Status:</label>
            <div class="formRight">
                <select name="status" id="status">
                    <option value="">Select </option>
                    <option value="approved" <?php echo $scheme->status == 'approved' ? 'selected="selected"' : ''?>>Approved </option>
                    <option value="illegal" <?php echo $scheme->status == 'illegal' ? 'selected="selected"' : ''?>>Illegal </option>
                </select>
            </div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('registration/identified','Cancel',$attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
</fieldset>
</form>
<style>
    .errors{
        background: red;
        color: #fff;
        font-size: 13px;
        padding: 5px 15px;
        max-width: 700px;
        margin: 5px auto;
        border-radius: 5px;
    }
    .errors p{
        padding-top:0;
    }
    .flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
<script>
    $(function() {
    $('#sqft').change(function(){
          
          var kanal = 0 ;
          var sqft = 0;
          var marla = 0;
          sqft = $("#sqft").val()
          
          if(sqft>225)
          {
            marla = $("#marla").val();
            kanal = $("#kanal").val();
            
            marla = Number(marla) + parseInt((sqft / 225)); 
            kanal = Number(kanal) + parseInt((marla / 20)); 
            s = sqft % 225;
            m = marla %20;

            $("#marla").val(m);
            $("#sqft").val(s);
            $("#kanal").val(kanal);
          }

        });
        
         $("#marla").change(function(){
          var kanal = 0 ;
          var marla = 0;     
           
          marla = $("#marla").val()
          
          if(marla>20)
          {
            marla = $("#marla").val();
            kanal = $("#kanal").val();
            
            kanal = Number(kanal) + parseInt((marla / 20)); 
            m = marla % 20;

            $("#marla").val(m);
            $("#kanal").val(kanal);
          }     
         
         });    
     });
</script>