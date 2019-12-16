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
    function add_owner(id)
    {
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
        <div class="rowElem  noborder">
            <label>Name of Housing Scheme:</label>
            <div class="formRight">
                <input type="text"   name="housing_scheme" value="" />
            </div>

            <label>Choose Location</label>
            <div class="formRight">
                <input type="text"   name="location" value="" />
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
                    <input type="text"   name="owner_cnic_1" value=""/>
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
                <div id="contact_person_cnic">
                    <input type="text"   name="contact_person_cnic" value="" id='contact_person_cnic' style="width: 150px;" />
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
                <select name="rural_urban" id="rural_urban" style="width: 133px;" >
                    <option value="">Select </option>
                    <option value="planning_permission">Planning Permission</option>
                    <option value="approved">Approved </option>
                    <option value="illegal">Illegal </option>
                </select>

            </div>

            <div class="fix"></div>
        </div>

        <div class="rowElem">
            <label>Khasra Nos.</label>
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
                <label>Status of Exchange Approval</label>
                <div class="formRight">
                    <select name="exchange_approval" id="exchange_approval" >
                        <option value=""> Select NA </option>
                        <option value="pending_with_bor">Pending with BOR</option>
                        <option value="sanction_received">Sanction Received</option>
                        <option value="implemented">Implemented</option>
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
    .flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
