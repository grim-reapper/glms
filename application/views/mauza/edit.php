<script type="text/javascript">

function add_feed(id)
{
     var counter = $('#'+id+'_counter').val();
     counter = parseInt(counter);
    // alert(counter);

   //var counter = 2;
   counter=counter+1;
   var html = '';
   html+='<div id="1'+id+'_'+counter+'" class="rowElem  noborder"><div class="remove1" onclick=remove_new("'+id+'_'+counter+'");></div><label></label><div class="formright" ><input type="text" name="'+id+'_'+counter+'"  id="'+id+'_'+counter+'" style=" margin-top:3px; width: 282px;"/>';
   html+='</div></div>';
   $('#'+id).append(html);
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

echo form_open_multipart('mauza/update', $attributes);
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
      <?php foreach($subdivision_list as $sub_list) {?>
      <?php  if($sub_list->tehsil_id == $mauza_list->tehsil_id){ ?>
      <option value="<?php echo $sub_list->tehsil_id; ?>" selected="selected"><?php echo $sub_list->tehsil_name; ?></option>
      <?php   }else{   ?>
      <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
      <?php } } ?>
    </select>
  </div>

    <label>Qanungoi Circle:</label>
    <div class="formRight">
      <select name="q_id" id="qanungoi"  onchange="get_patwar_circle();" >
        <?php foreach($qanungoicircle_list as $q_list ) {?>
        <?php
       if($q_list->q_id == $mauza_list->q_id){?>
        <option value="<?php echo $q_list->q_id; ?>" selected="selected"><?php echo $q_list->q_circle; ?></option>
        <?php   }else{ ?>
        <option value="<?php echo $q_list->q_id; ?>"><?php echo $q_list->q_circle; ?></option>
        <?php } } ?>
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
          <?php  if($pt_list->p_id == $mauza_list->p_id){ ?>
          <option value="<?php echo $pt_list->p_id; ?>" selected="selected"><?php echo $pt_list->patwar_circle; ?></option>
          <?php    } else { ?>
          <option value="<?php echo $pt_list->p_id; ?>"><?php echo $pt_list->patwar_circle; ?></option>
          <?php } } ?>
        </select>
      </div>

        <label>Mauza Name:</label>
        <div class="formRight">
          <input type="text"   name="mauza_name" value="<?php  echo $mauza_list->mouza_name; ?>" />
          <input type="hidden"   name="mauza_id" value="<?php  echo $mauza_list->mauza_id; ?>" />
        </div>
        <div class="fix"></div>
      </div>

      <div class="rowElem">
        <label>Square Feet in Marla:</label>
         <div class="formRight" style=" width: 10%">
              <input type="text" name="fts_in_one_marla" style=" width: 54%" value="<?php echo $mauza_list->fts_in_one_marla ?>" />
      </div>
     <label style="margin-left: -40px; width: 123px;">Measurement System:</label>
        <div class="formRight" style="width:16%;">
          <select name="kishtwari_Square" id="" style="width: 133px;">
             <option value="Not selected">Select System </option>
             <option value="kishtwari" <?php echo $mauza_list->measurement_system == 'kishtwari' ? 'selected ="selected"' : '' ?>>Kishtwari </option>
             <option value="Square" <?php echo $mauza_list->measurement_system == 'Square' ? 'selected ="selected"' : '' ?>>Square </option>
         </select>
        </div>
     <label style="margin-left: -35px; width: 45px;">Location:</label>
     <div class="formRight" style="width:16%;">
         <select name="rural_urban" id="rural_urban" style="width: 133px;" >
             <option value="Not selected">Select Location </option>
             <option value="Rural" <?php echo $mauza_list->rural_urban == 'Rural' ? 'selected ="selected"' : '' ?>>Rural </option>
             <option value="Urban" <?php echo $mauza_list->rural_urban == 'Urban' ? 'selected ="selected"' : '' ?>>Urban </option>
         </select>

     </div>

<div class="formRight" style="width:16%; margin-left: 40px;">
    <input type="checkbox" name="BAC" value="BAC" <?php echo $mauza_list->BAC == 'BAC' ? 'checked ="checked"' : '' ?>/>
   <label style="float:none; display: inline-block;">BAC</label>

</div>

        <div class="fix"></div>
      </div>
     <div class="rowElem ">
        <label>Hadbast No.</label>
        <div class="formRight">
          <input type="text"   name="hadbast" value="<?php  echo $mauza_list->hadbast; ?>" />
        </div>
        <label>Last Khasra or Square No.</label>
        <div class="formRight">
          <input type="text" name="khasra_square_no" value="<?php echo $mauza_list->khasra_square_no ?>" />
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
           <td><input type="text" name="Male" value="<?php echo $mauza_list->Male; ?>"></td>
           <td><input type="text" name="Female" value="<?php echo $mauza_list->Female; ?>"></td>
           <td><input type="text" name="Total" value="<?php echo $mauza_list->total; ?>"></td>
           </tr>
           </table>
           </div>
        <label>Short History:</label>
         <div class="formRight">
      <textarea rows="4" cols="" name="short_history"  placeholder=""><?php echo $mauza_list->short_history ?></textarea>
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
              <?php
                $educational = unserialize($mauza_list->educational_institute);
                $edu_counter = count($educational);
               ?>
          <?php if(!empty($educational)) { ?>
            <input type="hidden"   name="education_counter" value="<?php echo $edu_counter; ?>" id="education_counter" />
            <?php
            $e = 1;
            foreach($educational as $edu) { ?>
              <?php if($e == 1){ ?>
                <input type="text" name="education_1" value="<?php echo $edu?>" id="education_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('education')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1education_<?php echo $e?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('education_<?php echo $e?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="education_<?php echo $e?>" id="education_<?php echo $e?>" value ="<?php echo $edu?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $e++;} ?>
      <?php }else { ?>
        <input type="hidden"   name="education_counter" value="1" id="education_counter" />
        <input type="text"   name="education_1" value="" id="education_1" style="width: 282px;"/>
        <input type="button" onclick="add_feed('education')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
      <?php }?>
           </div>

        </div>
         <label>Hospitals</label>
        <div class="formRight">
            <div id="Hospitals">
              <?php
                $hospital = unserialize($mauza_list->Hospitals);
                $hos_counter = count($hospital);
               ?>
          <?php if(!empty($hospital)) { ?>
            <input type="hidden" name="Hospitals_counter" value="<?php echo $hos_counter; ?>" id="Hospitals_counter" />
            <?php
            $h = 1;
            foreach($hospital as $hosp) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="Hospitals_1" value="<?php echo $hosp?>" id="Hospitals_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('Hospitals')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1Hospitals_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('Hospitals_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="Hospitals_<?php echo $h?>" id="Hospitals_<?php echo $h?>" value ="<?php echo $hosp?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
        <input type="text"   name="Hospitals_1" value="" id='Hospitals_1' style="width: 282px;" />
          <input type="hidden"   name="Hospitals_counter" value="1" id="Hospitals_counter" />
           <input type="button" onclick="add_feed('Hospitals')" name="add"  class="addbutton" style="margin-top: 0px;"/>
      <?php }?>
           </div>

        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
      <label>Markets</label>
        <div class="formRight">
            <div id="markets">
              <?php
                $markets = unserialize($mauza_list->Markets);
                $mr_counter = count($markets);
               ?>
          <?php if(!empty($markets)) { ?>
            <input type="hidden" name="markets_counter" value="<?php echo $mr_counter; ?>" id="markets_counter" />
            <?php
            $h = 1;
            foreach($markets as $mark) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="markets_1" value="<?php echo $mark?>" id="markets_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('markets')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1markets_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('markets_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="markets_<?php echo $h?>" id="markets_<?php echo $h?>" value ="<?php echo $mark?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
         <input type="text"   name="markets_1" value="" id='market_1'style="width: 282px;" />
          <input type="hidden"   name="markets_counter" value="1" id='markets_counter' />
           <input type="button" onclick="add_feed('markets')" name="add" value="" class="addbutton" style="margin-top: 0px;" />
      <?php }?>

           </div>

        </div>
         <label>Roads</label>
        <div class="formRight">
            <div id="roads">
           <?php
                $roads = unserialize($mauza_list->Roads);
                $rd_counter = count($roads);
               ?>
          <?php if(!empty($roads)) { ?>
            <input type="hidden" name="roads_counter" value="<?php echo $rd_counter; ?>" id="roads_counter" />
            <?php
            $h = 1;
            foreach($roads as $rd) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="roads_1" value="<?php echo $rd?>" id="roads_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('roads')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1roads_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('roads_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="roads_<?php echo $h?>" id="roads_<?php echo $h?>" value ="<?php echo $rd?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
         <input type="text"   name="roads_1" value="" id='roads_1'style="width: 282px;" />
          <input type="hidden"   name="roads_counter" value="1" id='roads_counter' />
           <input type="button" onclick="add_feed('roads')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
      <?php }?>

            </div>

        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
      <label>Archeological Sites: </label>
        <div class="formRight">
            <div id="Asites">
               <?php
                $archeological = unserialize($mauza_list->Archeological_Sites);
                $arch_counter = count($archeological);
               ?>
          <?php if(!empty($archeological)) { ?>
            <input type="hidden" name="Asites_counter" value="<?php echo $arch_counter; ?>" id="Asites_counter" />
            <?php
            $h = 1;
            foreach($archeological as $arch) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="Asites_1" value="<?php echo $arch?>" id="Asites_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('Asites')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1Asites_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('Asites_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="Asites_<?php echo $h?>" id="Asites_<?php echo $h?>" value ="<?php echo $arch?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
         <input type="text"   name="Asites_1" value=""  id='Asites_1' style="width: 282px;"/>
         <input type="hidden"   name="Asites_counter" value="1"  id='Asites_counter'/>
          <input type="button" onclick="add_feed('Asites')" name="add" value="" class="addbutton" style="margin-top: 0px;" />
      <?php }?>
         </div>

       </div>

         <label>Industries</label>
        <div class="formRight">
            <div id="industries">
            <?php
                $industries = unserialize($mauza_list->Industries);
                $ind_counter = count($industries);
               ?>
          <?php if(!empty($industries)) { ?>
            <input type="hidden" name="industries_counter" value="<?php echo $ind_counter; ?>" id="industries_counter" />
            <?php
            $h = 1;
            foreach($industries as $ind) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="industries_1" value="<?php echo $ind?>" id="industries_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('industries')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1industries_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('industries_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="industries_<?php echo $h?>" id="industries_<?php echo $h?>" value ="<?php echo $ind?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
          <input type="text"   name="industries_1" value="" id='industries_1'style="width: 282px;" />
          <input type="hidden"   name="industries_counter" value="1" id='industries_counter' />
           <input type="button" onclick="add_feed('industries')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
      <?php }?>

                      </div>

        </div>
         <div class="fix"></div>
        </div>
    <div class="rowElem">
      <label>Rivers And Canals:</label>
        <div class="formRight">
            <div id="randc">
           <?php
                $randc = unserialize($mauza_list->Rivers_Canals);
                $rc_counter = count($randc);
               ?>
          <?php if(!empty($randc)) { ?>
            <input type="hidden" name="randc_counter" value="<?php echo $rc_counter; ?>" id="randc_counter" />
            <?php
            $h = 1;
            foreach($randc as $rc) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="randc_1" value="<?php echo $rc?>" id="randc_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('randc')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1randc_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('randc_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="randc_<?php echo $h?>" id="randc_<?php echo $h?>" value ="<?php echo $rc?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
          <input type="text"   name="randc_1" value="" id='randc_1' style="width: 282px;"/>
          <input type="hidden"   name="randc_counter" value="1" id='randc_counter' />
          <input type="button" onclick="add_feed('randc')" name="add" value="" class="addbutton"style="margin-top: 0px;" />
      <?php }?>
            </div>

        </div>
         <label>Others</label>
        <div class="formRight">
            <div id="others">
           <?php
                $others = unserialize($mauza_list->others);
                $oth_counter = count($others);
               ?>
          <?php if(!empty($others)) { ?>
            <input type="hidden" name="others_counter" value="<?php echo $oth_counter; ?>" id="others_counter" />
            <?php
            $h = 1;
            foreach($others as $oth) { ?>
              <?php if($h == 1){ ?>
                <input type="text" name="others_1" value="<?php echo $oth?>" id="others_1" style="width: 282px;"/>
                <input type="button" onclick="add_feed('others')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
              <?php } else{ ?>
              <div id="1others_<?php echo $h?>" class="rowElem  noborder">
                <div class="remove1" onclick="remove_new('others_<?php echo $h?>');"></div>
                <label></label>
                <div class="formright">
                  <input type="text" name="others_<?php echo $h?>" id="others_<?php echo $h?>" value ="<?php echo $oth?>" style=" margin-top:3px; width: 282px;">
                </div>
              </div>
            <?php } ?>
        <?php $h++;} ?>
      <?php }else { ?>
          <input type="text"   name="others_1" value="" id='other_1'style="width: 282px;" />
          <input type="hidden"   name="others_counter" value="1" id='others_counter' />
          <input type="button" onclick="add_feed('others')" name="add" value="" class="addbutton" style="margin-top: 0px;"/>
      <?php }?>
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
          <input type="text"   name="events_fest" value="<?php echo $mauza_list->events_festivals; ?>" />
        </div>
        <label>Celebrities</label>
        <div class="formRight">
          <input type="text" name="celebrities" value="<?php echo $mauza_list->celebrities; ?>" />
        </div>
        <div class="fix"></div>
      </div>
    <div class="rowElem ">
        <label>Lambardars.</label>
        <div class="formRight">
          <input type="text"   name="lambardras" value="<?php echo $mauza_list->lambardras; ?>" />
        </div>
        <label>Contact No.</label>
        <div class="formRight">
          <input type="text" name="Contact_no" value="<?php echo $mauza_list->contact_no; ?>" />
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
          <option value="NA-<?php echo $i;?>" <?php echo 'NA-'.$i == $mauza_list->na_no ? 'selected="selected"' : '' ?>>NA-<?php echo $i;?></option>
          <?php }?>
        </select>
      </div>
     <label>Electricity: </label>
      <div class="formRight">
        <input type="radio" name="electric_meter"  value="1" <?php echo $mauza_list->electricity == 1 ? 'checked="checked"' : '' ?>/>
        <label>Yes</label>
        <input type="radio" name="electric_meter" <?php echo $mauza_list->electricity != 1 ? 'checked="checked"' : '' ?>  value="0" />
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
          <option value="PP-<?php echo $i;?>" <?php echo 'PP-'.$i == $mauza_list->pp_no ? 'selected="selected"' : '' ?>>PP-<?php echo $i;?></option>
          <?php }?>
        </select>
      </div>
      <label>Sui Gas: </label>
      <div class="formRight">
        <input type="radio" name="sui_gas" value="1" <?php echo $mauza_list->sui_gas == 1 ? 'checked="checked"' : '' ?>/>
        <label>Yes</label>
        <input type="radio" name="sui_gas"  <?php echo $mauza_list->sui_gas != 1 ? 'checked="checked"' : '' ?> value="0"  />
        <label>No</label>
      </div>
      <div class="fix"></div>
      </div>
        <div class="rowElem">
           <label>UC No.</label>
            <div class="formRight">
            <input type="text" name="uc" value="<?php echo $mauza_list->uc_no ?>" />
             </div>
             <label>Water Supply: </label>
         <div class="formRight">
        <input type="radio" name="water_supply"   value="1" <?php echo $mauza_list->water_supply == 1 ? 'checked="checked"' : '' ?>/>
        <label>Yes</label>
        <input type="radio" name="water_supply" <?php echo $mauza_list->water_supply != 1 ? 'checked="checked"' : '' ?>s value="0"  />
        <label>No</label>
    </div>
              <div class="fix"></div>
             </div>
        <div class="rowElem">
            <label>Police Station</label>
            <div class="formRight">
                <input type="text" name="ps" value="<?php echo $mauza_list->police_station ?>" />
                </div>
            <label> Google Cordinates: </label>
             <div class="formRight">
        <input type="text" value="<?php echo $mauza_list->latitude ?> <?php echo $mauza_list->longitude ?>" name="coordinates"  readonly="readonly" id="coordinates"/>
        <input type="hidden" value="<?php echo $mauza_list->latitude ?>" name="latitude"   id="lat" />
        <input type="hidden" value="<?php echo $mauza_list->longitude ?>" name="longitude" id="lng" />
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
                echo anchor('registration','Cancel',$attributes);
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
