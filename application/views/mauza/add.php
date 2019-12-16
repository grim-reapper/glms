<script type="text/javascript">  

  
function add_feed(id)  
{  
     var counter = $('#'+id+'_counter').val();
     counter = parseInt(counter);
    // alert(counter);

   //var counter = 2;
   var html = '';
   html+='<div id="1'+id+'_'+counter+'" class="rowElem  noborder"><div class="remove1" onclick=remove_new("'+id+'_'+counter+'");></div><label></label><div class="formright" ><input type="text" name="'+id+'_'+counter+'"  id="'+id+'_'+counter+'" style=" margin-top:3px; width: 282px;"/>';
   html+='</div></div>';
   $('#'+id).append(html);
   counter=counter+1;
   $('#'+id+'_counter').val(counter);
  
  } 
    function remove_new(div)
    {
        //alert('sad');
       //var abc = JSON.stringify(div);
       // alert(abc);
       // alert(div);
      $('#1'+div).remove();
      
       // $('#1education_'+counter).remove();
       
       //alert($('#1'+n));
        
    }
     
   

</script> 
<?php $this->load->view("property/property_js");?>
<?php

$attributes = array('class' => 'mainForm');

echo form_open_multipart('mauza/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
  <div class="widget first_form"> 
  <div class="head">
    <h5 class="iList">Mauza Add</h5>
  </div>
  <?php if(validation_errors()){ ?>
    <div class="errors">
      <?php echo validation_errors(); ?>
    </div>
  <?php } ?>
  <div class="rowElem  noborder"> 
  <label>Sub Division:</label>
  <div class="formRight">
    <select name="tehsil_id" id="tehsil" onchange="get_qanungoi_circle();">
      <option value="">Select Sub Division</option>
      <?php foreach($subdivision_list as $sub_list) {?>
      <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
      <?php } ?>
    </select>
  </div>
  
    <label>Qanungoi Circle:</label>
    <div class="formRight">
      <select name="q_id" id="qanungoi"  onchange="get_patwar_circle();" >
         <option value="">Select Qanungoi Circle</option>
        <?php foreach($qanungoicircle_list as $q_list ) {?>
        <option value="<?php echo $q_list->q_id; ?>"><?php echo $q_list->q_circle; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="fix"></div>
    </div>
    
    <div class="rowElem  noborder">
      <label>Patwar Circle:</label>
      <div class="formRight">
       <select name="p_id" id="patwar_circle"  >
         <option value="">Select Patwar Circle</option>
          <?php foreach($patwarcircle_list as $pt_list ) {?>
          <option value="<?php echo $pt_list->p_id; ?>"><?php echo $pt_list->patwar_circle; ?></option>
          <?php  } ?>
        </select>
      </div>
      
        <label>Mauza Name:</label>
        <div class="formRight">
          <input type="text"   name="mauza_name" value="" />
        </div>
        <div class="fix"></div>
      </div>
    
      <div class="rowElem">
        <label>Square Feet in Marla:</label>
         <div class="formRight" style=" width: 10%">
              <input type="text" name="fts_in_one_marla" style=" width: 54%" />
      </div>
     <label style="margin-left: -40px; width: 123px;">Measurement System:</label>
        <div class="formRight" style="width:16%;">
          <select name="kishtwari_Square" id="" style="width: 133px;">
             <option value="Not selected">Select System </option>
             <option value="kishtwari">Kishtwari </option>
             <option value="Square">Square </option>
         </select>
        </div>
     <label style="margin-left: -35px; width: 45px;">Location:</label>
     <div class="formRight" style="width:16%;">
         <select name="rural_urban" id="rural_urban" style="width: 133px;" >
             <option value="Not selected">Select Location </option>
             <option value="Rural">Rural </option>
             <option value="Urban">Urban </option>
         </select>
         
     </div>

<div class="formRight" style="width:16%; margin-left: 40px;">
    <input type="checkbox" name="BAC" value="BAC"/>
   <label style="float:none; display: inline-block;">BAC</label>
    
</div>

        <div class="fix"></div>
      </div>
     <div class="rowElem ">
        <label>Hadbast No.</label>
        <div class="formRight">
          <input type="text"   name="hadbast" value="" />
        </div>
        <label>Last Khasra or Square No.</label>
        <div class="formRight">
          <input type="text"   name="khasra_square_no" value="" />
        </div>
        <div class="fix"></div>
      </div>
      <div class="rowElem">
       <label>Populace:</label>
       <div class="formRight">
           <table class="population_table">
               <tr>
           <th>Male </th>
           <th>Female</th>
           <th>Total</th>
           </tr>
           <tr>
           <td><input type="text" name="Male" value=""></td>
           <td><input type="text" name="Female" value=""></td>
           <td><input type="text" name="Total" value=""></td>
           </tr>
           </table>
           </div>
        <label>Short History:</label>
         <div class="formRight">
      <textarea rows="4" cols="" name="short_history"  placeholder=""  ></textarea>
    </div>
    <div class="fix"></div>
       </div>
    <div class="rowElem">
        <h3>Important places </h3>
        </div>
    <div class="rowElem">
      <label>Educational Institutes</label>
        <div class="formRight">
            <div id="education">
          <input type="text"   name="education_1" value="" id="education_1" style="width: 282px;"/>
          <input type="hidden"   name="education_counter" value="2" id="education_counter" />
          <input type="button" onclick="add_feed('education')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
           </div>
        
        </div>
         <label>Hospitals</label>
        <div class="formRight">
            <div id="Hospitals">
          <input type="text"   name="Hospitals_1" value="" id='Hospitals_1' style="width: 282px;" />
          <input type="hidden"   name="Hospitals_counter" value="2" id="Hospitals_counter" />
           <input type="button" onclick="add_feed('Hospitals')" name="add"  class="addbutton" style="margin-top: 0px;"/>
           </div>
        
        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
      <label>Markets</label>
        <div class="formRight">
            <div id="markets">
          <input type="text"   name="markets_1" value="" id='market_1'style="width: 282px;" />
          <input type="hidden"   name="markets_counter" value="2" id='markets_counter' />
           <input type="button" onclick="add_feed('markets')" name="add" value="" class="addbutton" style="margin-top: 0px;" />
           </div>
        
        </div>
         <label>Roads</label>
        <div class="formRight">
            <div id="roads">
          
          <input type="text"   name="roads_1" value="" id='roads_1'style="width: 282px;" />
          <input type="hidden"   name="roads_counter" value="2" id='roads_counter' />
           <input type="button" onclick="add_feed('roads')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
           
            </div>
        
        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
      <label>Archeological Sites: </label>
        <div class="formRight">
            <div id="Asites">
         <input type="text"   name="Asites_1" value=""  id='Asites_1' style="width: 282px;"/>
         <input type="hidden"   name="Asites_counter" value="2"  id='Asites_counter'/>
          <input type="button" onclick="add_feed('Asites')" name="add" value="" class="addbutton" style="margin-top: 0px;" />
         </div>
           
       </div>
      
         <label>Industries</label>
        <div class="formRight">
            <div id="industries">
           
          <input type="text"   name="industries_1" value="" id='industries_1'style="width: 282px;" />
          <input type="hidden"   name="industries_counter" value="2" id='industries_counter' />
           <input type="button" onclick="add_feed('industries')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
                      </div>
        
        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
      <label>Rivers And Canals:</label>
        <div class="formRight">
            <div id="randc">
           
          <input type="text"   name="randc_1" value="" id='randc_1' style="width: 282px;"/>
          <input type="hidden"   name="randc_counter" value="2" id='randc_counter' />
              <input type="button" onclick="add_feed('randc')" name="add" value="" class="addbutton"style="margin-top: 0px;" />
           
            </div>
     
        </div>
         <label>Others</label>
        <div class="formRight">
            <div id="others">
           
          <input type="text"   name="others_1" value="" id='other_1'style="width: 282px;" />
          <input type="hidden"   name="others_counter" value="2" id='others_counter' />
            <input type="button" onclick="add_feed('others')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
          
            </div>
       
        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
        <h3>Mauza Detail </h3>
        <div class="fix"></div>
        </div>
     <div class="rowElem">
      <label>Mussavies Picture:</label>
      <div class="formRight">
        <input type="file"   name="Massive_picture" value="" />
      </div>
      <label>Photos:</label>
      <div class="formRight">
         <input type="file"   name="Photos" value="" />
      </div>
      
      <div class="fix"></div>
    </div>
     <div class="rowElem">
      <label>Documents:</label>
      <div class="formRight">
        <input type="file"   name="Document" value="" />
      </div>
      <label>Index Map:</label>
      <div class="formRight">
         <input type="file"   name="index_map" value="" />
      </div>
     <div class="fix"></div>
    </div>
    <div class="rowElem ">
        <label>Events And Festivals.</label>
        <div class="formRight">
          <input type="text"   name="events_fest" value="" />
        </div>
        <label>Celebrities</label>
        <div class="formRight">
          <input type="text"   name="celebrities" value="" />
        </div>
        <div class="fix"></div>
      </div>
    <div class="rowElem ">
        <label>Lambardars.</label>
        <div class="formRight">
          <input type="text"   name="lambardras" value="" />
        </div>
        <label>Contact No.</label>
        <div class="formRight">
          <input type="text"   name="Contact_no" value="" />
        </div>
        <div class="fix"></div>
      </div>
    <div id="form_main">
     <div class="rowElem">
     <label>National Assembly No.</label>
      <div class="formRight">
          <select name="na_no" id="na_no" >
          <option value=""> Select NA </option>
          <?php for($i=118; $i<=130 ; $i++){?>
          <option value="NA-<?php echo $i;?>">NA-<?php echo $i;?></option>
          <?php }?>
        </select>
      </div>
     <label>Electricity: </label>
      <div class="formRight">
        <input type="radio" name="electric_meter"  value="1" />
        <label>Yes</label>
        <input type="radio" name="electric_meter" checked="checked"  value="0" />
        <label>No</label>
      </div>
    <div class="fix"></div>
    </div>
     <div class="rowElem">
      <label>Punjab Provincial No.</label>
      <div class="formRight">
         <select name="pp_no" id="pp_no" >
          <option value=""> Select PP</option>
          <?php for($i=137; $i<=161 ; $i++){?>
          <option value="PP-<?php echo $i;?>">PP-<?php echo $i;?></option>
          <?php }?>
        </select>
      </div>
      <label>Sui Gas: </label>
      <div class="formRight">
        <input type="radio" name="sui_gas" value="1" />
        <label>Yes</label>
        <input type="radio" name="sui_gas"  checked="checked" value="0"  />
        <label>No</label>
      </div>
      <div class="fix"></div>
      </div>
        <div class="rowElem">
           <label>UC No.</label>
            <div class="formRight">
            <input type="text" name="uc" />
             </div>
             <label>Water Supply: </label>
         <div class="formRight">
        <input type="radio" name="water_supply"   value="1"/>
        <label>Yes</label>
        <input type="radio" name="water_supply" checked="checked" value="0"  />
        <label>No</label>
    </div>
              <div class="fix"></div>
             </div>
        <div class="rowElem">
            <label>Police Station</label>
            <div class="formRight">
                <input type="text" name="ps" />
                </div>
            <label> Google Cordinates: </label>
             <div class="formRight">
        <input type="text" value="" name="coordinates"  readonly="readonly" id="coordinates"/>
        <input type="hidden" value="" name="latitude"   id="lat" />
        <input type="hidden" value="" name="longitude" id="lng" /> 
        <br />
    
       <?php 
	   $atts = array(
              'width'      => '960',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );
           echo anchor_popup('map/new_property_map', 'Add Coordinates', $atts);
		?>
     </div>
           </div>
        </div>
     <div id="new_1" style=" display:none" >  
           <div class="formright" style=" margin-top: 3px;">  
            <input type="text" name="name_" value=""  size="50">  
        </div> 
         <div class="fix"></div>
        </div>
     <div class="rowElem  noborder">
        <label></label>
        <div class="formRight">
          <input type="submit"   name="submit" value="Save" class="basicBtn"  />
			  <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('mauza','Cancel',$attributes);
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
</style>