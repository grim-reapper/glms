
<script>
    
    function names_by_district() {
        var form_data = {
            district_id: $('#d_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("revenue/get_subdiv_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                $("#subdiv_id").html(msg);
                
               
               
            }
        });
    }
    function names_by_subdiv() {
        var form_data = {
            subdiv_id: $('#subdiv_id').val()
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("revenue/get_mauza_by_subdiv"); ?>',
            data: form_data,
            success: function(msg) {
                $("#mauza_id").html(msg);
                
               
               
            }
        });
    }
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

<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open_multipart('revenue/add', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Records Of Rights Entry Form</h5>
        </div>
        <div class="rowElem  noborder">
            <label>District:</label>
            <div class="formRight">
                <select name="district" id="d_id" onchange="names_by_district();">
                    <option value="0">Select District</option>
                    <?php foreach ($district as $d_list) { ?>
                        <option value="<?php echo $d_list->district_id; ?>"><?php echo $d_list->district_name; ?></option>
                    <?php } ?>

                </select>
            </div>

            <label>Subdivision:</label>
            <div class="formRight">
                <select name="subdiv" id="subdiv_id" onchange="names_by_subdiv();" >
                     <option value="0">Select Tehsil</option>
                    <?php foreach ($subdiv as $c_list) { ?>
                        <option value="<?php echo $c_list->tehsil_id; ?>"><?php echo $c_list->tehsil_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="fix"></div>
        </div>

        <div class="rowElem">
            <label>Mauza:</label>
            <div class="formRight">
                <select name="mauza" id="mauza_id" >
                     <option value="0">Select Mauza</option>
                    <?php foreach ($mauza as $b_list) { ?>
                        <option value="<?php echo $b_list->mauza_id; ?>"><?php echo $b_list->mouza_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <label>Select Category:</label>
            <div class="formRight">
                <select name="category" id="" >
                    <option value="">Select Category</option>

                    <option value="PR">Periodical</option>
                    <option value="SR">Settlement</option>
                    <option value="CR">Consolidation</option>

                </select>
            </div>

            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Select year:</label>
            <div class="formRight">
                <select name="year" id="mauza" >
                    <option value="0">Select Year</option>
                    <option value="1860-61">1860-61</option>
                    <option value="1861-62">1861-62</option>
                    <option value="1862-63">1862-63</option>
                    <option value="2015-16">2015-16</option>

                </select>
            </div>
            <label>No of Volumes:</label>
            <div class="formRight">
                <input type="text" name="volumes" value=""/>
            </div>

        </div>
        <div class="rowElem">
            <label >Consignment Date:</label>
            <div class="formRight" >
                <input type="text" name="date" value="" class="datepicker"/>
            </div>
            <label>No. of Mutations:</label>
            <div class="formRight">
                <input type="text" name="no_of_mutations" value=""/>
            </div>

            <div class="fix"></div>

        </div>
        <div class="rowElem">
            <label >No. of Khatas:</label>
            <div class="formRight" >
                <input type="text" name="no_of_khatas" value=""/>
            </div>
            <label>No. of Khatoonis:</label>
            <div class="formRight">
                <input type="text" name="no_of_khatoonis" value=""/>
            </div>

            <div class="fix"></div>

        </div>
        <div class="rowElem">
            <label>Area(Kanal-Marla-Sqft):</label>
      <div class="formRight">
        <input type="text" name="kanal"  id="kanal"  size="4" style=" width:20%" maxlength="5" />
        :
        <input type="text" name="marla"  id="marla"  size="5" style=" width:25%" maxlength="2" />
        :
        <input type="text" name="sqft" id="sqft"  size="6" style=" width:25%" maxlength="3"  />
      </div>
            <label>Rack No:</label>
            <div class="formRight">
                <input type="text" name="rack_no" value=""/>
            </div>

            <div class="fix"></div>

        </div>
        <div class="rowElem">
            <label >Row No:</label>
            <div class="formRight" >
                <input type="text" name="row_no" value=""/>
            </div>
            <label>Column No:</label>
            <div class="formRight">
                <input type="text" name="column_no" value=""/>
            </div>

            <div class="fix"></div>

        </div>
        <div class="rowElem">


            <label><b>Note:</b></label>
            <div class="formRight">
                <textarea rows="4" cols="" name="note"  placeholder=""  ></textarea>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('revenue', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
