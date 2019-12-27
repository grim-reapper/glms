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
    function add_owner(id) {
        var counter = $('#'+id+'_counter').val();
        counter = parseInt(counter);
        counter=counter+1;
        var html = '';
        html += `
    <div class="rowElem  noborder flex" id="${id+'_'+counter}">
        <div class="flex-items">
        <label>Name of Owner (s):</label>
    <div class="formRight">
        <input type="text"   name="${id+'_name_'+counter}" value=""/>
        </div>
        </div>
        <div class="flex-items">
        <label>CNIC:</label>
    <div class="formRight">
        <input type="text" name="${id+'_cnic_'+counter}" value=""/>
        </div>
        </div>
        <div class="flex-items">
        <label>Contact No:</label>
    <div class="formRight">
        <input type="text" name="${id+'_contact_'+counter}" value="" />
        </div>
        </div>
        <div class="flex-items">
        <div class="remove1" onclick=remove_new("${id+'_'+counter}");></div><label></label><div class="formright" >
        </div>
        </div>`;
        $('#'+id).after(html);
        $('#'+id+'_counter').val(counter);
    }
    function add_public_path(id) {
        var counter = $('#'+id+'_counter').val();
        counter = parseInt(counter);
        counter=counter+1;
        var html = '';
        html += `
       <div class="rowElem  noborder flex" id="${id+'_'+counter}">
            <div class="flex-items">
                <label>Public Paths, Watercourses:</label>
                <div class="formRight">
                    <select  name="${'public_path_'+counter}" id="" style="width: 133px;">
                        <option value="">Select </option>
                        <option value="active_watercourse"> Active Watercourse</option>
                        <option value="inactive_watercourse">Inactive Watercourse</option>
                        <option value="active_public_path">Active Public Path</option>
                        <option value="inactive_public_path">Inactive Public Path</option>
                        <option value="water_pond">Water Pond</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="flex-items">
                <label>Ownership:</label>
                <div class="formRight">
                    <select name="${'public_path_ownership_'+counter}" id="" style="width: 133px;">
                        <option value="">Select </option>
                        <option value="ex-evacuee"> Ex-Evacuee</option>
                        <option value="provincial_govt">Provincial Govt</option>
                        <option value="village_common_land">Village Common Land</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="flex-items">
                <label>Khasra No:</label>
                <div class="formRight">
                    <input type="text" name="${'pp_khasra_no_'+counter}" value="" />
                </div>
            </div>
            <div class="flex-items">
                <label>Area (K-M-Sqft):</label>
                <div class="formRight">
                    <input type="text" name="${'pp_area_'+counter}" value="" />
                </div>
            </div>
            <div class="flex-items">
                 <div class="remove1" onclick=remove_new("${id+'_'+counter}");></div><label></label><div class="formright" >
        </div>
            </div>
        </div>`;
        $('#'+id).after(html);
        $('#'+id+'_counter').val(counter);
    }
    function add_khasra(id) {
        var counter = $('#'+id+'_counter').val();
        counter = parseInt(counter);
        counter=counter+1;
        var html = '';
        html += `
<div class="rowElem noborder flex" id="${id+'_'+counter}">
            <div class="flex-items">
                <label>Khasra No:</label>
                <div class="formRight">
                    <input type="text" name="${'khasra_no_'+counter}" value=""/>
                </div>
            </div>
            <div class="flex-items">
                <label>Area:</label>
                <div class="formRight">
                    <input type="text"   name="${'area_'+counter}" value=""/>
                </div>
            </div>
            <div class="flex-items">
                <label>Mouza:</label>
                <div class="formRight">
                    <input type="text"   name="${'mouza_'+counter}" value="" />
                </div>
            </div>
            <div class="flex-items">
                <div class="remove1" onclick=remove_new("${id+'_'+counter}");></div><label></label><div class="formright" >
        </div>
            </div>
        </div>`;
        $('#'+id).after(html);
        $('#'+id+'_counter').val(counter);
    }
    function remove_new(div)
    {
        //alert('sad');
        //var abc = JSON.stringify(div);
        // alert(abc);
        // alert(div);
        $('#'+div).remove();
        var rp = div.split('_');
        var vl = $('#'+rp[0]+'_counter');
        vl.val(vl.val() - 1);
        // $('#1education_'+counter).remove();

        //alert($('#1'+n));

    }



</script>
<?php $this->load->view("property/property_js");?>
<?php

$attributes = array('class' => 'mainForm');

echo form_open_multipart('registration/update', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Survey Add</h5>
        </div>
        <?php if(validation_errors()){ ?>
            <div class="errors">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
        <input type="hidden" name="survey_id" value="<?php echo $survey_list->id;?>">
        <div class="rowElem  noborder">
            <label>Name of Housing Scheme:</label>
            <div class="formRight">
                <input type="text"   name="housing_scheme" value="<?php echo $survey_list->housing_scheme;?>" />
            </div>

            <label>Choose Location</label>
            <div class="formRight">
                <input type="text"   name="location" value="<?php echo $survey_list->location;?>" />
            </div>
            <label>Choose File (Copy of plan)</label>
            <div class="formRight">
                <input type="file" name="copy_of_plan" value="" />
            </div>
            <div class="fix"></div>
        </div>
        <?php
            $owners = json_decode($survey_list->owners, true);
            $own_counter = count($owners);
        ?>
        <?php if(!empty($owners)) { ?>
        <input type="hidden" name="owner_counter" value="<?php echo $own_counter;?>" id="owner_counter">
        <?php
        $e = 1;
        foreach($owners as $owner) { ?>
                <div class="rowElem  noborder flex" id="owner_<?php echo $e?>">
                    <div class="flex-items">
                        <label>Name of Owner (s):</label>
                        <div class="formRight">
                            <input type="text"   name="owner_name_<?php echo $e?>" value="<?php echo $owner['name']?>"/>
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>CNIC:</label>
                        <div class="formRight">
                            <input type="text"   name="owner_cnic_<?php echo $e?>" value="<?php echo $owner['cnic']?>"/>
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>Contact No:</label>
                        <div class="formRight">
                            <input type="text"   name="owner_contact_<?php echo $e?>" value="<?php echo $owner['contact']?>" />
                        </div>
                    </div>
                </div>
        <?php $e++;}?>
        <?php }?>
        <div class="rowElem">
            <label>Name of Contact Person</label>
            <div class="formRight" style="width: 150px;">
                <div id="contact_person_name">
                    <input type="text"   name="contact_person_name" value="<?php echo $survey_list->contact_person_name;?>" id="contact_person_name" style="width: 150px;"/>
                </div>

            </div>
            <label style="width: 100px;">CNIC</label>
            <div class="formRight" style="width: 150px;">
                <div id="contact_person_cnic">
                    <input type="text"   name="contact_person_cnic" value="<?php echo $survey_list->contact_person_cnic;?>" id='contact_person_cnic' style="width: 150px;" />
                </div>

            </div>
            <label>Contact No</label>
            <div class="formRight" style="width: 150px;">
                <div id="contact_person_phone">
                    <input type="text"   name="contact_person_phone" value="<?php echo $survey_list->contact_person_phone;?>" id='contact_person_phone' style="width: 150px;" />
                </div>

            </div>
            <div class="fix"></div>
        </div>

        <div class="rowElem">
            <label style="width: 123px;">Category of Scheme</label>
            <div class="formRight" style="width:16%;">
                <select name="scheme" id="" style="width: 133px;">
                    <option value="">Select </option>
                    <option value="individual" <?php echo $survey_list->scheme == 'individual' ? 'selected="selected"' : ''?>> Individual</option>
                    <option value="corporate" <?php echo $survey_list->scheme == 'corporate' ? 'selected="selected"' : ''?>>Corporate </option>
                    <option value="cooperative" <?php echo $survey_list->scheme == 'cooperative' ? 'selected="selected"' : ''?>>Cooperative </option>
                </select>
            </div>
            <label style="margin-left: -35px;">Sanction Status of Scheme:</label>
            <div class="formRight" style="width:16%;">
                <select name="saction_status" id="saction_status" style="width: 133px;" >
                    <option value="">Select </option>
                    <option value="planning_permission" <?php echo $survey_list->sanction_status == 'planning_permission' ? 'selected="selected"' : ''?>>Planning Permission</option>
                    <option value="approved" <?php echo $survey_list->sanction_status == 'approved' ? 'selected="selected"' : ''?>>Approved </option>
                    <option value="illegal" <?php echo $survey_list->sanction_status == 'illegal' ? 'selected="selected"' : ''?>>Illegal </option>
                </select>

            </div>

            <div class="fix"></div>
        </div>
        <?php
        $khasras = json_decode($survey_list->khasra_details, true);
        $kh_counter = count($khasras);
        ?>
        <?php if(!empty($owners)) { ?>
        <input type="hidden" name="khasra_counter" id="khasra_counter" value="<?php echo $kh_counter;?>">
        <?php
        $e = 1;
        foreach($khasras as $khasra) { ?>
                <div class="rowElem noborder flex" id="khasra_<?php echo $e?>">
                    <div class="flex-items">
                        <label>Khasra No:</label>
                        <div class="formRight">
                            <input type="text" name="khasra_no_<?php echo $e?>" value="<?php echo $khasra['khasra_no']?>"/>
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>Area:</label>
                        <div class="formRight">
                            <input type="text" name="kanal_<?php echo $e?>" id="kanal_1" class="kanal_1" size="4" style=" width:20%" maxlength="5" value="<?php echo $khasra['kanal']?>">
                            :
                            <input type="text" name="marla_<?php echo $e?>" id="marla_1" class="marla_1" size="5" style=" width:25%" maxlength="2" value="<?php echo $khasra['marla']?>">
                            :
                            <input type="text" name="sqft_<?php echo $e?>" id="sqft_1" class="sqft_1" size="6" style=" width:25%" maxlength="3" value="<?php echo $khasra['sqft']?>">
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>Mouza:</label>
                        <div class="formRight">
                            <input type="text"   name="mouza_<?php echo $e?>" value="<?php echo $khasra['mouza']?>" />
                        </div>
                    </div>
                </div>
        <?php $e++;}?>
        <?php }?>

        <div class="rowElem">
            <label>Total area of Scheme(All Mouzas)</label>
            <div class="formRight">
                <div id="total_area">
                    <input type="text"   name="total_area_scheme" value="<?php echo $survey_list->total_area_scheme;?>" id="total_area" style="width: 282px;"/>
                </div>

            </div>
            <label>Vacant Area</label>
            <div class="formRight">
                <div id="vacant_area">
                    <input type="text"   name="vacant_area" value="<?php echo $survey_list->vacant_area;?>" id='vacant_area' style="width: 282px;" />
                </div>

            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Previous background of Record</label>
            <div class="formRight">
                <select name="pbo_land" id="" style="width: 133px;">
                    <option value="">Select </option>
                    <option value="land_reforms" <?php echo $survey_list->pbo_land == 'land_reforms' ? 'selected="selected"' : ''?>> Land Reforms</option>
                    <option value="provincial_govt" <?php echo $survey_list->pbo_land == 'provincial_govt' ? 'selected="selected"' : ''?>>Provincial Govt</option>
                    <option value="acquired_land" <?php echo $survey_list->pbo_land == 'acquired_land' ? 'selected="selected"' : ''?>>Acquired Land </option>
                    <option value="other" <?php echo $survey_list->other == 'land_reforms' ? 'selected="selected"' : ''?>>Other</option>
                </select>
            </div>
            <label>Khasra No</label>
            <div class="formRight">
                <div id="khasra_no">
                    <input type="text"   name="khasra_no_land" value="<?php echo $survey_list->khasra_no_land;?>" id='khasra_no_land'style="width: 282px;" />
                </div>

            </div>
            <div class="formRight">
                <label>Choose file (Copy of Mutation):</label>
                <div class="formRight">
                    <input type="file"   name="copy_of_mutation" value="" />
                </div>
            </div>
            <div class="fix"></div>
        </div>
<!--        public path-->
        <?php
        $public_path = json_decode($survey_list->public_path, true);
        $pp_counter = count($public_path);
        ?>
        <?php if(!empty($public_path)) { ?>
        <input type="hidden" name="pp_counter" value="<?php echo $pp_counter;?>" id="p_path_counter">
        <?php
        $e = 1;
        foreach($public_path as $pp) { ?>
                <div class="rowElem  noborder flex" id="p_path_<?php echo $e?>">
                    <div class="flex-items">
                        <label>Public Paths, Watercourses:</label>
                        <div class="formRight">
                            <select name="public_path_<?php echo $e?>" id="" style="width: 133px;">
                                <option value="">Select </option>
                                <option value="active_watercourse" <?php echo $pp['public_path'] == 'active_watercourse' ? 'selected="selected"' : '';?>> Active Watercourse</option>
                                <option value="inactive_watercourse" <?php echo $pp['public_path'] == 'inactive_watercourse' ? 'selected="selected"' : '';?>>Inactive Watercourse</option>
                                <option value="active_public_path" <?php echo $pp['public_path'] == 'active_public_path' ? 'selected="selected"' : '';?>>Active Public Path</option>
                                <option value="inactive_public_path" <?php echo $pp['public_path'] == 'inactive_public_path' ? 'selected="selected"' : '';?>>Inactive Public Path</option>
                                <option value="water_pond" <?php echo $pp['public_path'] == 'water_pond' ? 'selected="selected"' : '';?>>Water Pond</option>
                                <option value="other" <?php echo $pp['public_path'] == 'other' ? 'selected="selected"' : '';?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>Ownership:</label>
                        <div class="formRight">
                            <select name="public_path_ownership_<?php echo $e?>" id="" style="width: 133px;">
                                <option value="">Select </option>
                                <option value="ex-evacuee" <?php echo $pp['public_path_ownership'] == 'ex-evacuee' ? 'selected="selected"' : '';?>> Ex-Evacuee</option>
                                <option value="provincial_govt" <?php echo $pp['public_path_ownership'] == 'provincial_govt' ? 'selected="selected"' : '';?>>Provincial Govt</option>
                                <option value="village_common_land" <?php echo $pp['public_path_ownership'] == 'village_common_land' ? 'selected="selected"' : '';?>>Village Common Land</option>
                                <option value="other" <?php echo $pp['public_path_ownership'] == 'other' ? 'selected="selected"' : '';?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>Khasra No:</label>
                        <div class="formRight">
                            <input type="text" name="pp_khasra_no_<?php echo $e?>" value="<?php echo $pp['pp_khasra_no']?>" />
                        </div>
                    </div>
                    <div class="flex-items">
                        <label>Area (K-M-Sqft):</label>
                        <input type="text" name="pp_kanal_<?php echo $e?>" id="kanal" size="4" style=" width:20%" maxlength="5" value="<?php echo $pp['kanal']?>">
                        :
                        <input type="text" name="pp_marla_<?php echo $e?>" id="marla" size="5" style=" width:25%" maxlength="2" value="<?php echo $pp['marla']?>">
                        :
                        <input type="text" name="pp_sqft_<?php echo $e?>" id="sqft" size="6" style=" width:25%" maxlength="3" value="<?php echo $pp['sqft']?>">

                    </div>
                </div>
        <?php $e++;}?>
        <?php } ?>

        <div class="rowElem">
            <label>Total Area of Public Path etc. </label>
            <div class="formRight">
                <div id="total_area_public">
                    <input type="text"   name="total_area_public" value="<?php echo $survey_list->total_area_public;?>"  id='total_area_public' style="width: 282px;"/>
                </div>
            </div>

            <label>Choose File (Fard)</label>
            <div class="formRight">
                <div id="industries">
                    <input type="file"  name="fard_file" id='fard_file'style="width: 282px;" />
                </div>

            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem ">
            <label>Schedule Rate /Marla</label>
            <div class="formRight">
                <input type="text"   name="schedule_rate" value="<?php echo $survey_list->schedule_rate;?>" />
            </div>
            <label>Market Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="market_price" value="<?php echo $survey_list->market_rate;?>" />
            </div>
            <label>DPAC Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="dpac_price" value="<?php echo $survey_list->dpac_rate;?>" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <h3>Alternate Land Offered </h3>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Khasra No:</label>
            <div class="formRight">
                <input type="text" name="alt_khasra_no" value="<?php echo $survey_list->alt_khasra_no;?>">
            </div>
            <label>Area (K-M-Sqft):</label>
             <div class="formRight" style="width: 35%;">
            <input type="text" name="alt_kanal" id="alt_kanal" class="alt_kanal" size="4" style=" width:20%" maxlength="5" value="<?php echo $survey_list->alt_kanal ?>">
            :
            <input type="text" name="alt_marla" id="alt_marla" class="alt_marla" size="5" style=" width:25%" maxlength="2" value="<?php echo $survey_list->alt_marla ?>">
            :
            <input type="text" name="alt_sqft" id="alt_sqft" size="6" class="alt_sqft" style=" width:25%" maxlength="3" value="<?php echo $survey_list->alt_sqft ?>">
            </div>
            <label>Choose File (Fard):</label>
            <div class="formRight">
                <input type="file"  name="alt_fard" />
            </div>
            <label>Choose File (Site Plan):</label>
            <div class="formRight">
                <input type="file"  name="alt_site_plan" value="<?php echo $survey_list->alt_site_plan;?>" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem ">
            <label>Schedule Rate /Marla</label>
            <div class="formRight">
                <input type="text"   name="alt_schedule_rate" value="<?php echo $survey_list->alt_schedule_rate;?>" />
            </div>
            <label>Market Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="alt_market_price" value="<?php echo $survey_list->alt_market_price;?>" />
            </div>
            <label>DPAC Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="alt_dpac_price" value="<?php echo $survey_list->alt_dpac_price;?>" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem ">
            <label>Notes</label>
            <div class="formRight">
                <textarea name="notes" id="" cols="30" rows="10"><?php echo $survey_list->notes;?></textarea>
            </div>
            <div class="fix"></div>
        </div>
        <div id="form_main">
            <div class="rowElem">
                <label>Status of Exchange Approval</label>
                <div class="formRight">
                    <select name="exchange_approval" id="exchange_approval">
                        <option value=""> Select NA </option>
                        <option value="pending_with_bor" <?php echo $survey_list->exchange_approval == 'pending_with_bor' ? 'selected="selected"' : ''?>>Pending with BOR</option>
                        <option value="sanction_received" <?php echo $survey_list->exchange_approval == 'sanction_received'? 'selected="selected"' : ''?>>Sanction Received</option>
                        <option value="implemented" <?php echo $survey_list->exchange_approval == 'implemented' ? 'selected="selected"' : ''?>>Implemented</option>
                    </select>
                </div>
                <label>Choose File (Reference to BOR): </label>
                <div class="formRight">
                    <input type="file" name="ref_to_bor">
                </div>
                <div class="fix"></div>
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
    .flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
