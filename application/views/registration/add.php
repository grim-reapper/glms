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
        <input type="text" name="${id+'_cnic_'+counter}" value="" class="owner_cnic"/>
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
                    <input type="text" name="${'pp_kanal_'+counter}" id="kanal" class="kanal" size="4" style=" width:20%" maxlength="5">
                    :
                    <input type="text" name="${'pp_marla_'+counter}" id="marla" class="marla" size="5" style=" width:25%" maxlength="2">
                    :
                    <input type="text" name="${'pp_sqft_'+counter}" id="sqft" class="sqft" size="6" style=" width:25%" maxlength="3">
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
                <label>Area (K-M-Sqft):</label>
                    <input type="text" name="${'kanal_'+counter}" id="kanal_1" class="kanal_1" size="4" style=" width:20%" maxlength="5">
                    :
                    <input type="text" name="${'marla_'+counter}" id="marla_1" class="marla_1" size="5" style=" width:25%" maxlength="2">
                    :
                    <input type="text" name="${'sqft_'+counter}" id="sqft_1" size="6" class="sqft_1" style=" width:25%" maxlength="3">

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

echo form_open_multipart('registration/add', $attributes);
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
        <?php if($this->session->flashdata('error')) { ?>
            <div class="errors">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>
        <div class="rowElem  noborder">
            <label>Name of Housing Scheme:</label>
            <div class="formRight">
                <select name="housing_scheme_id" id="">
                    <?php if(!empty($schemes)) { ?>
                        <option value="">Select scheme</option>
                        <?php foreach($schemes as $scheme) {?>
                            <option value="<?php echo $scheme->id?>"><?php echo $scheme->housing_scheme;?></option>
                        <?php }?>
                    <?php }?>
                </select>
            </div>

            <label>Choose Location</label>
            <div class="formRight">
                <input type="text"   name="location" value="" />
            </div>
            <label>Choose File (Copy of plan)</label>
            <div class="formRight">
                <input type="file" name="copy_of_plan" value="" />
            </div>
            <div class="fix"></div>
        </div>
        <input type="hidden" name="owner_counter" value="1" id="owner_counter">
        <div class="rowElem  noborder flex" id="owner">
            <div class="flex-items">
                <label>Name of Owner (s):</label>
                <div class="formRight">
                    <input type="text"   name="owner_name_1" value=""/>
                </div>
            </div>
            <div class="flex-items">
                <label>CNIC:</label>
                <div class="formRight">
                    <input type="text"   name="owner_cnic_1" value="" class="owner_cnic"/>
                </div>
            </div>
            <div class="flex-items">
                <label>Contact No:</label>
                <div class="formRight">
                    <input type="text"   name="owner_contact_1" value="" />
                </div>
            </div>
            <div class="flex-items">
                <input type="button" onclick="add_owner('owner')" name="add" value="" class="addbutton" style="margin-top: 0px;">
            </div>
        </div>
        <div class="rowElem">
            <label>Name of Contact Person</label>
            <div class="formRight" style="width: 150px;">
                <div id="contact_person_name">
                    <input type="text"   name="contact_person_name" value="" id="contact_person_name" style="width: 150px;"/>
                </div>

            </div>
            <label style="width: 100px;">CNIC</label>
            <div class="formRight" style="width: 150px;">
                <div id="contact_person_cnicc">
                    <input type="text" name="contact_person_cnic" value="" id='contact_person_cnic' style="width: 150px;" />
                </div>

            </div>
            <label>Contact No</label>
            <div class="formRight" style="width: 150px;">
                <div id="contact_person_phone">
                    <input type="text"   name="contact_person_phone" value="" id='contact_person_phone' style="width: 150px;" />
                </div>

            </div>
            <div class="fix"></div>
        </div>

        <div class="rowElem">
            <label style="width: 123px;">Category of Scheme</label>
            <div class="formRight" style="width:16%;">
                <select name="scheme" id="" style="width: 133px;">
                    <option value="">Select </option>
                    <option value="individual"> Individual</option>
                    <option value="corporate">Corporate </option>
                    <option value="cooperative">Cooperative </option>
                </select>
            </div>
            <label style="margin-left: -35px;">Sanction Status of Scheme:</label>
            <div class="formRight" style="width:16%;">
                <select name="saction_status" id="saction_status" style="width: 133px;" >
                    <option value="">Select </option>
                    <option value="planning_permission">Planning Permission</option>
                    <option value="approved">Approved </option>
                    <option value="illegal">Illegal </option>
                </select>

            </div>

            <div class="fix"></div>
        </div>
        <input type="hidden" name="khasra_counter" id="khasra_counter" value="1">
        <div class="rowElem noborder flex" id="khasra">
            <div class="flex-items">
                <label>Khasra No:</label>
                <div class="formRight">
                    <input type="text" name="khasra_no_1" value=""/>
                </div>
            </div>
            <div class="flex-items">
                <label>Area:</label>
                <div class="formRight">
                    <label>Area (K-M-Sqft):</label>
                    <input type="text" name="kanal_1" id="kanal_1" class="kanal_1" size="4" style=" width:20%" maxlength="5">
                    :
                    <input type="text" name="marla_1" id="marla_1" class="marla_1" size="5" style=" width:25%" maxlength="2">
                    :
                    <input type="text" name="sqft_1" id="sqft_1" size="6" class="sqft_1" style=" width:25%" maxlength="3">
                </div>
            </div>
            <div class="flex-items">
                <label>Mouza:</label>
                <div class="formRight">
                    <input type="text"   name="mouza_1" value="" />
                </div>
            </div>
            <div class="flex-items">
                <input type="button" onclick="add_khasra('khasra')" name="add" value="" class="addbutton" style="margin-top: 0px;">
            </div>
        </div>
        <div class="rowElem">
            <label>Total area of Scheme(All Mouzas)</label>
            <div class="formRight">
                <div id="total_area">
                    <input type="text"   name="total_area_scheme" value="" id="total_area" readonly style="width: 282px;"/>
                </div>

            </div>
            <label>Vacant Area</label>
            <div class="formRight">
                <div id="vacant_area">
                    <input type="text"   name="vacant_area" value="" id='vacant_area' style="width: 282px;" />
                </div>

            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Previous background of Record</label>
            <div class="formRight">
                <select name="pbo_land" id="" style="width: 133px;">
                    <option value="">Select </option>
                    <option value="land_reforms"> Land Reforms</option>
                    <option value="provincial_govt">Provincial Govt</option>
                    <option value="acquired_land">Acquired Land </option>
                    <option value="other">Other</option>
                </select>
            </div>
            <label>Khasra No</label>
            <div class="formRight">
                <div id="khasra_no">
                    <input type="text"   name="khasra_no_land" value="" id='khasra_no_land'style="width: 282px;" />
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
        <input type="hidden" name="pp_counter" value="1" id="p_path_counter">
        <div class="rowElem  noborder flex" id="p_path">
            <div class="flex-items">
                <label>Public Paths, Watercourses:</label>
                <div class="formRight">
                    <select name="public_path_1" id="" style="width: 133px;">
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
                    <select name="public_path_ownership_1" id="" style="width: 133px;">
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
                    <input type="text" name="pp_khasra_no_1" value="" />
                </div>
            </div>
            <div class="flex-items">
                    <label>Area (K-M-Sqft):</label>
                    <input type="text" name="pp_kanal_1" id="kanal" class="kanal" size="4" style=" width:20%" maxlength="5">
                    :
                    <input type="text" name="pp_marla_1" id="marla" class="marla" size="5" style=" width:25%" maxlength="2">
                    :
                    <input type="text" name="pp_sqft_1" id="sqft" size="6" class="sqft" style=" width:25%" maxlength="3">

            </div>
            <div class="flex-items">
                <input type="button" onclick="add_public_path('p_path')" name="add" value="" class="addbutton" style="margin-top: 0px;">
            </div>
        </div>
        <div class="rowElem">
            <label>Total Area of Public Path etc. </label>
            <div class="formRight">
                <div id="total_area_public">
                    <input type="text"   name="total_area_public" value=""  id='total_area_public' readonly style="width: 282px;"/>
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
                <input type="text"   name="schedule_rate" value="" />
            </div>
            <label>Market Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="market_price" value="" />
            </div>
            <label>DPAC Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="dpac_price" value="" />
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
                <input type="text" name="alt_khasra_no">
            </div>
             <label>Area (K-M-Sqft):</label>
             <div class="formRight" style="width: 35%;">
            <input type="text" name="alt_kanal" id="alt_kanal" class="alt_kanal" size="4" style=" width:20%" maxlength="5">
            :
            <input type="text" name="alt_marla" id="alt_marla" class="alt_marla" size="5" style=" width:25%" maxlength="2">
            :
            <input type="text" name="alt_sqft" id="alt_sqft" size="6" class="alt_sqft" style=" width:25%" maxlength="3">
            <input type="text" id="alt_total_area" name="alt_total_area" style="width:15%;" readonly>
             </div>
            <label>Choose File (Fard):</label>
            <div class="formRight">
                <input type="file"  name="alt_fard" value="" />
            </div>
            <label>Choose File (Site Plan):</label>
            <div class="formRight">
                <input type="file"  name="alt_site_plan" value="" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem ">
            <label>Schedule Rate /Marla</label>
            <div class="formRight">
                <input type="text"   name="alt_schedule_rate" value="" />
            </div>
            <label>Market Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="alt_market_price" value="" />
            </div>
            <label>DPAC Price/Marla</label>
            <div class="formRight">
                <input type="text"   name="alt_dpac_price" value="" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem ">
            <label>Notes</label>
            <div class="formRight">
                <textarea name="notes" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="fix"></div>
        </div>
        <div id="form_main">
            <div class="rowElem">
                <label>Status of Exchange Approval</label>
                <div class="formRight">
                    <select name="exchange_approval" id="exchange_approval">
                        <option value=""> Select NA </option>
                        <option value="pending_with_bor">Pending with BOR</option>
                        <option value="sanction_received">Sanction Received</option>
                        <option value="implemented">Implemented</option>
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
<script>
    $(function() {
            $("#contact_person_cnic,.owner_cnic").mask("99999-9999999-9");
        $('.sqft').live('change',function(){
            var parent = $(this).parents('.flex-items');
            // total_area_public
            var kanal = 0 ;
            var sqft = 0;
            var marla = 0;
            sqft = $(this).val();

            if(sqft>225)
            {
                marla = parent.find(".marla").val();
                kanal = parent.find(".kanal").val();

                marla = Number(marla) + parseInt((sqft / 225));
                kanal = Number(kanal) + parseInt((marla / 20));
                s = sqft % 225;
                m = marla %20;

                parent.find(".marla").val(m);
                parent.find(".sqft").val(s);
                parent.find(".kanal").val(kanal);
            }
            var kanal_val = 0;
            var marla_val = 0;
            var sqft_val = 0;
            $('.kanal').each(function() {
                var k = $(this).val();
                kanal_val += parseInt(k);
            });
            $('.marla').each(function() {
                var m = $(this).val();
                if(m != ''){
                    marla_val += parseInt(m);
                }
            });
            $('.sqft').each(function() {
                var s = $(this).val();
                if(s != ''){
                    sqft_val += parseInt(s);
                }
            });
            var total_val = kanal_val + '-' + marla_val + '-' + sqft_val;
            $('.widget').find('#total_area_public').val(total_val);
        });

        $('.marla').live('change',function(){
            var parent = $(this).parents('.flex-items');
            var kanal = 0 ;
            var marla = 0;

            marla = parent.find(".marla").val()

            if(marla>20)
            {
                marla = parent.find(".marla").val();
                kanal = parent.find(".kanal").val();

                kanal = Number(kanal) + parseInt((marla / 20));
                m = marla % 20;

                parent.find(".marla").val(m);
                parent.find(".kanal").val(kanal);
            }

            var kanal_val = 0;
            var marla_val = 0;
            var sqft_val = 0;
            $('.kanal').each(function() {
                var k = $(this).val();
                kanal_val += parseInt(k);
            });
            $('.marla').each(function() {
                var m = $(this).val();
                if(m != ''){
                    marla_val += parseInt(m);
                }
            });
            $('.sqft').each(function() {
                var s = $(this).val();
                if(s != '') {
                    sqft_val += parseInt(s);
                }
            });
            var total_val = kanal_val + '-' + marla_val + '-' + sqft_val;
            $('.widget').find('#total_area_public').val(total_val);

        });



        // khasra area start
        $('.sqft_1').live('change',function(){
            var parent = $(this).parents('.flex-items');
            // total_area_public
            var kanal = 0 ;
            var sqft = 0;
            var marla = 0;
            sqft = $(this).val();

            if(sqft>225)
            {
                marla = parent.find(".marla_1").val();
                kanal = parent.find(".kanal_1").val();

                marla = Number(marla) + parseInt((sqft / 225));
                kanal = Number(kanal) + parseInt((marla / 20));
                s = sqft % 225;
                m = marla %20;

                parent.find(".marla_1").val(m);
                parent.find(".sqft_1").val(s);
                parent.find(".kanal_1").val(kanal);
            }
            var kanal_val = 0;
            var marla_val = 0;
            var sqft_val = 0;
            $('.kanal_1').each(function() {
                var k = $(this).val();
                kanal_val += parseInt(k);
            });
            $('.marla_1').each(function() {
                var m = $(this).val();
                if(m != ''){
                    marla_val += parseInt(m);
                }
            });
            $('.sqft_1').each(function() {
                var s = $(this).val();
                if(s != ''){
                    sqft_val += parseInt(s);
                }
            });
            var total_val = kanal_val + '-' + marla_val + '-' + sqft_val;
            $('.widget').find('#total_area').val(total_val);
        });

        $('.marla_1').live('change',function(){
            var parent = $(this).parents('.flex-items');
            var kanal = 0 ;
            var marla = 0;

            marla = parent.find(".marla_1").val();

            if(marla>20)
            {
                marla = parent.find(".marla_1").val();
                kanal = parent.find(".kanal_1").val();

                kanal = Number(kanal) + parseInt((marla / 20));
                m = marla % 20;

                parent.find(".marla_1").val(m);
                parent.find(".kanal_1").val(kanal);
            }

            var kanal_val = 0;
            var marla_val = 0;
            var sqft_val = 0;
            $('.kanal_1').each(function() {
                var k = $(this).val();
                kanal_val += parseInt(k);
            });
            $('.marla_1').each(function() {
                var m = $(this).val();
                if(m != ''){
                    marla_val += parseInt(m);
                }
            });
            $('.sqft_1').each(function() {
                var s = $(this).val();
                if(s != '') {
                    sqft_val += parseInt(s);
                }
            });
            var total_val = kanal_val + '-' + marla_val + '-' + sqft_val;
            $('.widget').find('#total_area').val(total_val);

        });

        // alternative area
        
        // khasra area start
        $('.alt_sqft').live('change',function(){
            var parent = $(this).parents('.flex-items');
            // total_area_public
            var kanal = 0 ;
            var sqft = 0;
            var marla = 0;
            sqft = $(this).val();

            if(sqft>225)
            {
                marla = $("#alt_marla").val();
                kanal = $("#alt_kanal").val();

                marla = Number(marla) + parseInt((sqft / 225));
                kanal = Number(kanal) + parseInt((marla / 20));
                s = sqft % 225;
                m = marla %20;

                $("#alt_marla").val(m);
                $("#alt_sqft").val(s);
                $("#alt_kanal").val(kanal);
            }
            var kanal_val = 0;
            var marla_val = 0;
            var sqft_val = 0;
            $('#alt_kanal').each(function() {
                var k = $(this).val();
                kanal_val += parseInt(k);
            });
            $('#alt_marla').each(function() {
                var m = $(this).val();
                if(m != ''){
                    marla_val += parseInt(m);
                }
            });
            $('#alt_sqft').each(function() {
                var s = $(this).val();
                if(s != ''){
                    sqft_val += parseInt(s);
                }
            });
            var total_val = kanal_val + '-' + marla_val + '-' + sqft_val;
            $('.widget').find('#alt_total_area').val(total_val);
        });

        $('#alt_marla').live('change',function(){
            var parent = $(this).parents('.flex-items');
            var kanal = 0 ;
            var marla = 0;

            marla = $("#alt_marla").val();

            if(marla>20)
            {
                marla = $("#alt_marla").val();
                kanal = $("#alt_kanal").val();

                kanal = Number(kanal) + parseInt((marla / 20));
                m = marla % 20;

                $("#alt_marla").val(m);
                $("#alt_kanal").val(kanal);
            }

            var kanal_val = 0;
            var marla_val = 0;
            var sqft_val = 0;
            $('#alt_kanal').each(function() {
                var k = $(this).val();
                kanal_val += parseInt(k);
            });
            $('#alt_marla').each(function() {
                var m = $(this).val();
                if(m != ''){
                    marla_val += parseInt(m);
                }
            });
            $('#alt_sqft').each(function() {
                var s = $(this).val();
                if(s != '') {
                    sqft_val += parseInt(s);
                }
            });
            var total_val = kanal_val + '-' + marla_val + '-' + sqft_val;
            $('.widget').find('#alt_total_area').val(total_val);

        });
    })
</script>
