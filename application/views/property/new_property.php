<script>
	$(function() {
		$( "#radio_button" ).buttonset();

        $("#add_lease_occupant").click(function(){
				 var i = $('#lease_occupant_counter').val();
				  i = parseInt(i);
                  var new_field = '<table  id="lease_occupantion" class="lease_'+i+'">';
                  new_field+='<tr> ';
                  new_field+='<td class="o_f_c">Name</td> ';
				  new_field+='<td ><input type="text"   name="lease_occupant_name_'+i+'" value="" /></td>';
				  new_field+='<td>Parentage</td>';
				  new_field+='<td><div class="remove" onclick="remove_lease('+i+');"></div><input type="text"   name="lease_occupant_parentage_'+i+'" value="" /></td> ';
				  new_field+='</tr>';
				  new_field+='<tr> ';
				  new_field+='<td class="o_f_c">CNIC</td>';
				  new_field+=' <td><input type="text"   name="lease_occupant_cnic_'+i+'" value="" /></td> ';
				  new_field+='<td>Cell No.</td> ';
				  new_field+='<td><input type="text"   name="lease_occupant_cell_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='<tr> ';
				  new_field+=' <td class="o_f_c">Address</td>';
		          new_field+='   <td><input type="text"   name="lease_occupant_address_'+i+'" value="" /></td>';
				  new_field+=' <td >Picture</td> ';
				  new_field+='<td><input type="file"   name="lease_occupant_pic_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='</table>';
				  i = i+1;
				  $('#lease_occupant_counter').val(i);
                  $("#lease_occupantion_table").before(new_field);
            });
		

		
        $("#add_illegal_occupant").click(function(){
				 var i = $('#i_occupant_counter').val();
				  i = parseInt(i);
                  var new_field = '<table  id="illegal_occupantion" class="illegal_'+i+'">';
                  new_field+='<tr> ';
                  new_field+='<td class="o_f_c">Name</td> ';
				  new_field+='<td ><input type="text"   name="illegal_occupant_name_'+i+'" value="" /></td>';
				  new_field+='<td>Parentage</td>';
				  new_field+='<td><div class="remove" onclick="remove_illegal('+i+');"></div><input type="text"   name="illegal_occupant_parentage_'+i+'" value="" /></td> ';
				  new_field+='</tr>';
				  new_field+='<tr> ';
				  new_field+='<td class="o_f_c">CNIC</td>';
				  new_field+=' <td><input type="text"   name="illegal_occupant_cnic_'+i+'" value="" /></td> ';
				  new_field+='<td>Cell No.</td> ';
				  new_field+='<td><input type="text"   name="illegal_occupant_cell_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='<tr> ';
				  new_field+='<td class="o_f_c">Address</td>';
		          new_field+='<td><input type="text"   name="illegal_occupant_address_'+i+'" value="" /></td>';
				  new_field+=' <td >Picture</td> ';
				  new_field+='<td><input type="file"   name="illegal_occupant_pic_'+i+'" value="" /></td>';
				  new_field+='</tr> ';
				  new_field+='</table>';
				  i = i+1;
				  $('#i_occupant_counter').val(i);
                  $("#illegal_occupantion_table").before(new_field);
				  
            });
			

			
		
	    $("#lease_occupation").click(function(){ 
												  
				$("#illegal_occupant_wrapper").hide();		
				$("#lease_occupation_wrapper").show();	
				$("#depp_occupant_wrapper").hide()
	     });	
	
	    $("#illegal_occupation").click(function(){ 
												  
				$("#illegal_occupant_wrapper").show();		
				$("#lease_occupation_wrapper").hide();	
				$("#depp_occupant_wrapper").hide()
	     });
	
	  $("#deptt_occupation").click(function(){ 
				
				$("#lease_occupation_wrapper").hide()
				$("#illegal_occupant_wrapper").hide();		
				$("#depp_occupant_wrapper").show();								  
	     });
		
     $("#vacant_land").click(function(){ 
												  
				$("#lease_occupation_wrapper").hide()
				$("#illegal_occupant_wrapper").hide();		
				$("#depp_occupant_wrapper").hide();								  
	    });
		
		
		
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
	
   function remove_illegal(n)
   {
		$(".illegal_"+n).remove();
   }
  
  function remove_lease(n)
   {
		$(".lease_"+n).remove();
   }
</script> 

 <script language="javascript" type="text/javascript">

    function GetValueFromChild(lat,lng)
    {
        document.getElementById("coordinates").value = lat+","+lng;
		document.getElementById("lat").value = lat;
		document.getElementById("lng").value = lng;
    }

</script>   
<!-- Form begins -->
<?php $this->load->view("property/property_js");?>
<?php 

$attributes = array('class' => 'mainForm');

echo form_open_multipart('property/save', $attributes);
?>
<!-- Input text fields -->
<?php 
	   if(validation_errors()){
	?>

<div class="nNote nWarning hideit">
  <p><strong>WARNING: </strong><?php echo validation_errors(); ?></p>
</div>
<?php  }  ?>
<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">New Property Form</h5>
      <div id="radio_button">
      
        <input type="radio" id="l_occupation" name="occupation_type" checked="checked"  value="lease_occupation" />
        <label for="l_occupation" id="lease_occupation">Licensed Occupation</label>
        
        <input type="radio" id="i_occupation" name="occupation_type"  value="illegal_occupation"/>
        <label for="i_occupation" id="illegal_occupation">Illegal Occupation</label>

        <input type="radio" id="d_occupation" name="occupation_type"  value="deptt_occupation"/>
        <label for="d_occupation" id="deptt_occupation">Deptt. Occupation</label>
        
        <input type="radio" id="v_land" name="occupation_type" value="vacant_land"  />
        <label for="v_land" id="vacant_land">Unoccupied Land</label>
      </div>
      
    </div>
  
     <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< LICENSED OCCUPATION >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
   <div id="lease_occupation_wrapper"  >
   
    <div class="rowElem  noborder">
      <h3 style="padding-left:100px">  LICENSED OCCUPATION  
        <input type="button" name="lease_occupant" id="add_lease_occupant" value="Add Party" class="basicBtn occupant_button" />
        <input type="hidden" name="lease_occupant_counter" value="2" id="lease_occupant_counter"  />
      </h3>
    </div>
    <div class="rowElem ">
      <table  id="lease_occupantion" class="lease_1">
        <tr>
          <td class="o_f_c">Name</td>
          <td ><input type="text"   name="lease_occupant_name_1" value="" /></td>
          <td>Parentage</td>
          <td><input type="text"   name="lease_occupant_parentage_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="lease_occupant_cnic_1" value="" /></td>
          <td>Cell No.</td>
          <td><input type="text"   name="lease_occupant_cell_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">Address</td>
		  <td><input type="text"   name="lease_occupant_address_1" value="" /></td>
          <td >Picture</td>
          <td ><input type="file"   name="lease_occupant_pic_1" value="" style="width:50%" /></td>
        </tr>
      </table>
       <div id="lease_occupantion_table"></div>
      <div class="fix"></div>
    </div>
 
    <div class="rowElem ">
      <label> Occupant Category:</label>
      <div class="formRight">
          <select name="lease_occupant_category" id="lease_occupant_category" >
          <option value="">Select Category</option>
          <option value="Orignal(s)">Orignal(s)</option>
          <option value="Legal Heir(s)">Legal Heir(s)</option>
          <option value="Transfree(s)">Transfree(s)</option>
     
        </select>
      </div>
      <label>Period of Lease:</label>
      <div class="formRight">      
		<input type="text"   name="period_of_lease" value="" />
      </div>
      <div class="fix"></div>
    </div>

    <div class="rowElem ">
     <label>Leasing Authority:</label>
      <div class="formRight">
       <select name="lease_leasing_authority" id="lease_leasing_authority" >
          <option value="">Select Authority</option>
          <option value="BOR">BOR</option>
          <option value="C&W ">C&W </option>
           <option value="Ex-MCL ">Ex-MCL</option>
           <option value="LDA">LDA</option>
          <option value="Army">Army</option>
         <option value="Other">Other</option>
        </select>
      </div>
      
      <label>Occupation Year:</label>
      <div class="formRight">
      
        <select name="lease_occupation_year" id="lease_occupation_year" >
          <option value="">Select Year</option>
          <?php for( $y=1900 ; $y<=date('Y',time());$y++ ){?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } ?>
        </select>
      </div>
 
      <div class="fix"></div>
    </div>
    

    <div class="rowElem ">
         <label>Usage:</label>
      <div class="formRight">
        <select name="lease_occupant_usage" id="lease_occupant_usage" >
          <option value="">Select Usage</option>
          <option value="Commercial">Commercial</option>
          <option value="Residential">Residential</option>
          <option value="Industrial">Industrial</option>
          <option value="Agricultural">Agricultural</option>
          <option value="Petrol Pump">Petrol Pump</option>
          <option value="Non-profit">Non-profit</option>
          <option value="other">Other</option>
        </select>
      </div>
    
      
      <label>Franchise:</label>
         <div class="formRight">
		<select name="lease_franchise" id="lease_franchise" >
          <option value="">Select Company</option>
          <option value="PSO">PSO</option>
          <option value="Shell">Shell</option>
           <option value="Total">Total</option>
           <option value="Attock">Attock</option>
          <option value="PARCO">PARCO</option>
          <option value="Caltex">Caltex</option>
         <option value="CNG">CNG</option>
         <option value="Others">Others</option>
        </select>
		
      </div>
     
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
       <label>Trade Name:</label>
      <div class="formRight">
        <input type="text"   name="lease_trade_name" value="" />
      </div>
      
     <label>Buying Option:</label>
         <div class="formRight">
		<select name="lease_buying_option" id="lease_buying_option" >
          <option value="">Select Option</option>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
     </div>

      
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
    
     <label>Mode of Payment:</label>
      <div class="formRight">
	     <select name="lease_payment_mode" id="lease_payment_mode" >
          <option value="">Select  Mode</option>
          <option value="Lump Sum">Lump Sum</option>
          <option value="Installments">Installments</option>
        </select>
		
      </div>
     <label>Remarks:</label>
      <div class="formRight">
        <textarea  name="lease_occupant_remarks" cols="" rows="3"></textarea>
      </div>
       <div class="fix"></div>
    </div>
 
  </div>
    
    

  <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<  Illegal OCCUPATION   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
   <div id="illegal_occupant_wrapper">
   
    <div class="rowElem  noborder">
      <h3 style="padding-left:100px">  Illegal Occupation
        <input type="button" name="illegal_occupant" id="add_illegal_occupant" value="Add Party" class="basicBtn occupant_button"  />
        <input type="hidden" name="illegal_occupant_counter" value="2" id="i_occupant_counter"  />
      </h3>
    </div>
    
   <div class="rowElem ">   
    
      <table  id="illegal_occupantion" class="illegal_1">
        <tr>
          <td class="o_f_c">Name</td>
          <td > <input type="text"   name="illegal_occupant_name_1" value="" /></td>
          <td>Parentage</td>
          <td><input type="text"   name="illegal_occupant_parentage_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">CNIC</td>
          <td><input type="text"   name="illegal_occupant_cnic_1" value="" /></td>
          <td>Cell No.</td>
          <td><input type="text"   name="illegal_occupant_cell_1" value="" /></td>
        </tr>
        <tr>
          <td class="o_f_c">Address</td>
		  <td><input type="text"   name="illegal_occupant_address_1" value="" /></td>
          <td >Picture</td>
          <td ><input type="file"   name="illegal_occupant_pic_1" value="" style="width:50%" /> </td>
        </tr>
      </table>
     <div id="illegal_occupantion_table"></div>
      <div class="fix"></div>
    </div>
 
    <div class="rowElem ">
      <label> Occupant Category:</label>
      <div class="formRight">
          <select name="illegal_occupant_category" id="illegal_occupant_category" >
          <option value="">Select Category</option>
          <option value="Orignal(s)">Orignal(s)</option>
          <option value="Legal Heir(s)">Legal Heir(s)</option>
          <option value="Transfree(s)">Transfree(s)</option>
          <option value="Grabber(s)">Grabber(s)</option>
        </select>
      </div>
    
    <label>Occupation Year:</label>
      <div class="formRight">
      
        <select name="illegal_occupation_year" id="illegal_occupation_year" >
          <option value="">Select Year</option>
          <?php for( $y=1900 ; $y<=date('Y',time());$y++ ){?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } ?>
        </select>
      </div>
      <div class="fix"></div>
    </div>

    <div class="rowElem ">
         <label>Usage:</label>
      <div class="formRight">
        <select name="illegal_occupant_usage" id="illegal_occupant_usage" >
          <option value="">Select Usage</option>
          <option value="Commercial">Commercial</option>
          <option value="Residential">Residential</option>
          <option value="Industrial">Industrial</option>
          <option value="Agricultural">Agricultural</option>
          <option value="Petrol Pump">Petrol Pump</option>
          <option value="Non-profit">Non-profit</option>
          <option value="other">Other</option>
        </select>
      </div>
    
      
      <label>Franchise:</label>
         <div class="formRight">
		<select name="illegal_franchise" id="illegal_franchise" >
          <option value="">Select Company</option>
          <option value="PSO">PSO</option>
          <option value="Shell">Shell</option>
           <option value="Total">Total</option>
           <option value="Attock">Attock</option>
          <option value="PARCO">PARCO</option>
          <option value="Caltex">Caltex</option>
         <option value="CNG">CNG</option>
         <option value="Others">Others</option>
        </select>
		
      </div>
     
      <div class="fix"></div>
    </div>
    
    <div class="rowElem ">
       <label>Trade Name:</label>
      <div class="formRight">
        <input type="text"   name="illegal_trade_name" value="" />
      </div>
      
     <label>Buying Option:</label>
         <div class="formRight">
		<select name="illegal_buying_option" id="illegal_buying_option" >
          <option value="">Select Option</option>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
     </div>

    <div class="fix"></div>
  </div>
    
    <div class="rowElem ">
    
     <label>Mode of Payment:</label>
      <div class="formRight">
	     <select name="illegal_payment_mode" id="illegal_payment_mode" >
          <option value="">Select  Mode</option>
          <option value="Lump Sum">Lump Sum</option>
          <option value="Installments">Installments</option>
        </select>
		
      </div>
     <label>Remarks:</label>
      <div class="formRight">
        <textarea  name="illegal_occupant_remarks" cols="" rows="3"></textarea>
      </div>
       <div class="fix"></div>
    </div>
  </div>
  
  <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Deptt. Occupation >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>--> 
  
  <div id="depp_occupant_wrapper">
   <div class="rowElem">
      <h3>Deptt. Occupation</h3>
    </div>
    <div class="rowElem">
      <label>Domain:</label>
      <div class="formRight">
         <select name="deptt_domain" id="domain" >
          <option value="">Select Domain</option>
          <option value="Federal">Federal</option>
          <option value="Provincial">Provincial</option>
		  <option value="Local Body">Local Body</option>
        </select>
      </div>
      <label>Name of Deptt:</label>
      <div class="formRight">
        <input type="text"   name="deptt_name" value="" id="Name" />
      </div>
      <div class="fix"></div>
    </div>
	
    <div class="rowElem">
    
      <label>Status of Occupation:</label>
      <div class="formRight">
        <select name="deptt_status" id="Status" >
          <option value="">Select Status</option>
          <option value="Perpatual">Perpatual</option>
          <option value="Termed Lease">Termed Lease</option>
		  <option value="Unverified">Unverified</option>
		   <option value="Illegal Occupant">Illegal Occupant</option>
        </select>
      </div>
     <label>Address:</label>
      <div class="formRight">
        <input type="text"   name="deptt_address" value="" />
      </div>
	  
      <div class="fix"></div>
    </div>
	
   <div class="rowElem">
      <label>Name of Contact Person:</label>
      <div class="formRight">
        <input type="text" value="" name="deptt_contact_person" />
     </div>
      
      <label>Contact No.</label>
      <div class="formRight">
        <input type="text" value="" name="deptt_contact_no" />
      </div>
      <div class="fix"></div>
    </div>
	
   <div class="rowElem">

     <label>Occupation Year:</label>
      <div class="formRight">
        
        <select name="depp_occupation_year">
          <option value="">Select Year</option>
          <?php for( $y=1850 ; $y<=date('Y',time());$y++ ){?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php } ?>
         </select> 
      </div>
       
      <label>Remarks:</label>
      <div class="formRight">
         <textarea rows="4" cols="" name="deptt_remarks"  placeholder="Remarks"  ></textarea>
      </div>

	 
      <div class="fix"></div>
    </div>	
		
   </div>
    <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Property Details >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    
    
    <div class="rowElem">
      <h3>Property Details </h3>
    </div>
        <div class="rowElem">
      <label>Shajra Picture:</label>
      <div class="formRight">
        <input type="file"   name="shajra_picture" value="" />
      </div>
      
       <label>Site Picture:</label>
      <div class="formRight">
         <input type="file"   name="site_picture" value="" />
      </div>
      
      <div class="fix"></div>
    </div>
    
    <div class="rowElem">
      <label>Ownership:</label>
      <div class="formRight">
       <select name="ownership" id="ownership">
          <option value="">Select Owner</option>
          <option value="Nazul">Nazul </option>
          <option value="Prov. Govt. Land">Prov. Govt. Land</option>
          <option value="Evacuee">Evacuee</option>
          <option value="Fed. Govt. Land">Fed. Govt. Land</option>
          <option value="Ex-MCL">Ex-MCL</option>
          <option value="Prov. Deptt.">Prov. Deptt.</option>
          <option value="Fed. Deptt.">Fed. Deptt.</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <label>Property History:</label>
      <div class="formRight">
             <input type="file"   name="history" value="" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="rowElem">

     <label>Disposal Status:</label>
      <div class="formRight">
        <select name="disposal_status" id="disposal_status" >
          <option value="">Select Status </option>
          <option value="Disposable">Disposable</option>
          <option value="Non-Disposable">Non-Disposable</option>
        </select>
      </div>
      
      <label>Locality:</label>
      <div class="formRight">
        <input type="text"   name="locality" value="" />
      </div>
      
      <div class="fix"></div>
    </div>
    <div class="rowElem">
        <label>Mauza:</label>
      <div class="formRight">
        <select name="mauza_id" id="mauza">
          <option value="">Select  Mauza</option>
          <?php foreach($mauza_list as $m_list) {?>
          <option value="<?php echo $m_list->mauza_id; ?>"><?php echo $m_list->mouza_name; ?></option>
          <?php } ?>
        </select>
      </div>
      <label>Khasra Nos.</label>
      <div class="formRight">
        <input type="text"   name="khasra" value="" />
      </div>  
       
   
      <div class="fix"></div>
    </div>
   
     <div class="rowElem">
       <label>Unique Khasra No.</label>
      <div class="formRight">
        <input type="text"   name="unique_khasra" value="" size="5" style=" width:25%" maxlength="5" /> 
      <div style="display: inline;font-size: 14px;margin-left: 29px;width: 20%;">  Qitat:</div>
        <input type="text"   name="qitat" value="" size="2" style=" width:25%" maxlength="2" />
      </div>  
      
       <label>Area(Kanal-Marla-Sqft):</label>
      <div class="formRight">
        <input type="text" name="kanal"  id="kanal"  size="4" style=" width:20%" maxlength="5" />
        :
        <input type="text" name="marla"  id="marla"  size="5" style=" width:25%" maxlength="2" />
        :
        <input type="text" name="sqft" id="sqft"  size="6" style=" width:25%" maxlength="3"  />
      </div>

      
      
     
      <div class="fix"></div>
    </div>
     
      <div class="rowElem">
       <label>Land Reservation:</label>
      <div class="formRight">
         <select name="land_reservation" id="land_reservation" >
          <option value=""> Select Allocation </option>
          <option value="Road">Road</option>
          <option value="Canal ">Canal</option>
           <option value="Drain">Drain</option>
           <option value="Railway ">Railway </option>
          <option value="Park">Park</option>
         <option value="Other">Other</option>
          
        </select>
      </div>
      
      <label> Reservation Name:</label>
      <div class="formRight">
        <input type="text" value="" name="reservation_name" />
      </div>
      <div class="fix"></div>
    </div>
      
    <div class="rowElem">

      <label>Duty Rate Per Marla:</label>
      <div class="formRight">
        <input type="text" value="" name="duty_rate" />
      </div>
     <label>Market Rate Per Marla:</label>
      <div class="formRight">
        <input type="text" value="" name="market_rate" />
      </div>
      
      <div class="fix"></div>
    </div>
    <div class="rowElem">

      <label>Annual Rent Per Marla:</label>
      <div class="formRight">
        <input type="text" value="" name="annual_rent" />
      </div>
     <label>Police Station:</label>
      <div class="formRight">
        <input type="text" value="" name="police_station" />
      </div>
      
      <div class="fix"></div>
    </div>
        

    
   <div id="form_main">  
   
    <div class="rowElem">
      <label>Union Council No.</label>
      <div class="formRight">
        <input type="text" value="" name="uc_no" />
      </div>
      
       <label>Punjab Provincial No.</label>
      <div class="formRight">
         <select name="pp_no" id="pp_no" >
          <option value=""> Select PP</option>
          <?php for($i=137; $i<=161 ; $i++){?>
          <option value="PP-<?php echo $i;?>">PP-<?php echo $i;?></option>
          <?php }?>
        </select>
      </div>
    
      <div class="fix"></div>
    </div>
    
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
   <label>Sui Gas: </label>
      <div class="formRight">
        <input type="radio" name="sui_gas" value="1" />
        <label>Yes</label>
        <input type="radio" name="sui_gas"  checked="checked" value="0"  />
        <label>No</label>
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
   <label>Coordinates:</label>
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
      
  <label>Remarks:</label>
    <div class="formRight">
      <textarea rows="4" cols="" name="remarks"  placeholder="Remarks"  ></textarea>
    </div>
    <div class="fix"></div>
  </div>
  
 </div>
 <div class="rowElem">
      <div style="width:247px; margin:10px auto 0;">
        <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('property','Cancel',$attributes);
       ?>
        <input type="submit" value="Save" class="basicBtn submitForm" />
      </div>
      <div class="fix"></div>
    </div> 
  </div>
 
</fieldset>
<div class="fix"></div>
</form>

