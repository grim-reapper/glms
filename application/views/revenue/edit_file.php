<?php
$attributes = array('class' => 'mainForm');

echo form_open('revenue/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form"> 
        <div class="head">
            <h5 class="iList">Revenue Records Edit Form</h5>
        </div>
        <div class="rowElem  noborder">
            <label>District:</label>
            <div class="formRight">
                <select name="district" id="d_id">
                    <?php foreach ($district as $list) { ?>
                        <?php if ($list->district_id == $file->district_id) { ?>
                            <option value="<?php echo $list->district_id; ?>" selected="selected"><?php echo $list->district_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
    <?php }
} ?>
                </select>
            </div>
            <label>Subdivision:</label>
            <div class="formRight">
                <select name="subdiv" id="subdiv_id"  >
                    <?php foreach ($subdiv as $list) { ?>
                        <?php if ($list->tehsil_id == $file->tehsil_id) { ?>
                            <option value="<?php echo $list->tehsil_id; ?>" selected="selected"><?php echo $list->tehsil_name; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $list->tehsil_id; ?>"><?php echo $list->tehsil_name; ?></option>
    <?php }
} ?>
                </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
      <label>Mauza:</label>
      <div class="formRight">
       <select name="mauza" id="mauza_id"  >
         
          <?php foreach($mauza as $list ) {?>
          <?php  if($list->mauza_id == $file->mauza_id){ ?>
          <option value="<?php echo $list->mauza_id; ?>" selected="selected"><?php echo $list->mouza_name; ?></option>
          <?php    } else { ?>
          <option value="<?php echo $list->mauza_id; ?>"><?php echo $list->mouza_name; ?></option>
          <?php } } ?>
        </select>
      </div>
      <label>Category:</label>
      <div class="formRight">
       <select name="category" id=""  >
         
         
          <option value="<?php echo $file->revenue_category; ?>" selected="selected"><?php if($file->revenue_category =='PR'){ echo 'Periodical';}
                        elseif ($file->revenue_category=='SR') { echo 'Settlement';}
                        elseif ($file->revenue_category=='CR') {echo 'Consolidation';}?></option>
          <option value="PR">Periodical</option>
          <option value="SR">Settlement</option>
          <option value="CR">Consolidation</option>
         
        </select>
      </div>
      <div class="fix"></div>
      </div>
        <div class="rowElem  noborder">
            <label>Year:</label>
      <div class="formRight">
       <select name="year" id=""  >
         
         
          <option value="<?php echo $file->revenue_year; ?>" selected="selected"><?php echo $file->revenue_year; ?></option>
                    <option value="1860-61">1860-61</option>
                    <option value="1861-62">1861-62</option>
                    <option value="1862-63">1862-63</option>
                    <option value="2015-16">2015-16</option>
         
        </select>
      </div>
             <label>Volumes:</label>
        <div class="formRight">
          <input type="text"   name="volumes" value="<?php  echo $file->volumes; ?>" />
          <input type="hidden"   name="revenue_id" value="<?php  echo $file->revenue_id; ?>" />
          
        </div>
        <div class="fix"></div>
            
            
        </div>
        <div class="rowElem noborder">
            <label>Consignment Date:</label>
        <div class="formRight">
          <input type="text"   name="date" class="datepicker" value="<?php echo date('d', strtotime($file->consign_date)); ?> <?php echo date('M', strtotime($file->consign_date)); ?> <?php echo date('Y', strtotime($file->consign_date)); ?> " />
          
        </div>
        <label>No. of Mutations:</label>
        <div class="formRight">
          <input type="text"   name="no_of_mutations" value="<?php  echo $file->no_of_mutations; ?>" />
          
        </div>
                   <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>No. of Khats:</label>
        <div class="formRight">
          <input type="text"   name="no_of_khatas" value="<?php  echo $file->no_of_khatas; ?>" />
          
        </div>
            <label>No. of khatoonis:</label>
        <div class="formRight">
          <input type="text"   name="no_of_khatoonis" value="<?php  echo $file->no_of_khatoonis; ?>" />
          
        </div>
            
          <div class="fix"></div>   
        </div>
        <div class="rowElem noborder">
            <label>Area(Kanal-Marla-Sqft):</label>
             <div class="formRight">
        <input type="text" name="kanal"  id="kanal"  size="4" style=" width:20%" maxlength="5" value="<?php echo $file->area_kanal;?>" />
        :
        <input type="text" name="marla"  id="marla"  size="5" style=" width:25%" maxlength="2" value="<?php echo $file->area_marla;?>"/>
        :
        <input type="text" name="sqft" id="sqft"  size="6" style=" width:25%" maxlength="3" value="<?php echo $file->area_sqft;?>"  />
      </div>
            <label>Rack No:</label>
        <div class="formRight">
          <input type="text"   name="rack_no" value="<?php  echo $file->rack_no; ?>" />
          
        </div>
           <div class="fix"></div>    
        </div>
        <div class="rowElem noborder">
             <label>Row No:</label>
        <div class="formRight">
          <input type="text"   name="row_no" value="<?php  echo $file->row_no; ?>" />
          
        </div>
              <label>Column No:</label>
        <div class="formRight">
          <input type="text"   name="column_no" value="<?php  echo $file->column_no; ?>" />
          
        </div>
            <div class="fix"></div>     
        </div>
        <div class="rowElem noborder">
            
           <label>Detail:</label>
        <div class="formRight">
          <input type="text"   name="note" value="<?php  echo $file->detail; ?>" />
          
        </div> 
           <div class="fix"></div>     
        </div>
         <div class="rowElem  noborder">
        <label></label>
        <div class="formRight">
          <input type="submit"   name="submit" value="Save" class="basicBtn"  />
			  <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('revenue','Cancel',$attributes);
              ?>
        </div>
        <div class="fix"></div>
        
      </div>
        </div>
    </fieldset>