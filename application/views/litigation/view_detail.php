
<div class="widget">
  <div class="head">
    <h5 class="iFull2">Litigation Details of Case # <?php echo $litigation->case_number; ?> </h5>
        <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('litigation/index/'.$litigation->litigation_category_id,'Close',$attributes);
       ?>
  </div>
  <div class="body aligncenter">
    <table width="100%" border="1" class="details_view">
      <tr class="odd">
        <td id="title" width="10%" >Case Category:</td>
        <td id="detail" width="20%"><?php echo $litigation->category; ?></td>
        <td id="title" width="10%">Court Name:</td>
        <td id="detail" width="20%"><?php echo str_replace('Cases','',$litigation->category_name) ; ?></td>
        <td id="title" width="10%">Name of Judge:</td>
        <td id="detail" width="30%"><?php echo $litigation->name_of_judge; ?></td>
      </tr>
      <tr class="even">
        <td id="title">No. of Case:</td>
        <td id="detail"><?php echo $litigation->case_number ; ?></td>
        <td id="title">Institution Date:</td>
        <td id="detail"><?php
		                    if($litigation->date_of_institution !='1970-01-01')
							{
						     $datestring = "d - m - y";
						    $time = strtotime($litigation->date_of_institution);
							echo date($datestring, $time);
							}
							else
							{
							  echo 'Required';	
							}
							?></td>
        <td id="title">Subject of Case:</td>
        <td id="detail"><?php echo $litigation->title_of_case ; ?></td>
      </tr>
      <tr class="odd">
        <td id="title">Dealing Official:</td>
        <td id="detail"><?php echo $litigation->official_concerned; ?></td>
        <td id="title">Contact No:</td>
        <td id="detail"><?php echo $litigation->contact_number; ?></td>
                
         <td id="title">Feedback No:</td>
        <td id="detail"><?php echo $litigation->feedback_no; ?></td>
       
      </tr>
      <tr class="even">
        <td id="title">Property Type:</td>
        <td id="detail"><?php echo $litigation->property_category; ?></td>
           <td id="title">Title of Property:</td>
        <td id="detail"><?php echo $litigation->property_title; ?></td>
         <td id="title">Description of Land:</td>
        <td id="detail"><?php echo $litigation->description_of_land; ?></td>



      </tr>
        <tr class="odd">
        <td id="title">Area(K-M-SQFT):</td>
        <td id="detail"><?php echo $litigation->area_kanal."-".$litigation->area_marla."-".$litigation->area_sqft; ?></td>
        <td id="title">Mauza:</td>
        <td id="detail"><?php echo $litigation->mouza_name; ?></td>
     
        <td id="title">Patwar Circle:</td>
        <td id="detail"><?php echo $get_tehsil_etc_by_mauza["patwarcircle"]; ?></td>  
     
      </tr>
      
      <tr class="even">


         <td id="title">Qanungoi Circle: </td>
        <td id="detail"><?php echo $get_tehsil_etc_by_mauza["q_circle"]; ?></td>
          <td id="title">Sub Division: </td>
        <td id="detail"><?php echo $get_tehsil_etc_by_mauza["tehsils"]; ?></td>
        <td id="title">Name of Counsel :</td>
        <td id="detail"><?php echo $litigation->state_counsel; ?></td>
      </tr>
      <tr class="odd">
      
        <td id="title">Contact No:</td>
        <td id="detail"><?php echo $litigation->sc_contact_number; ?></td>
        <td id="title">Summary of Case:</td>
        <td id="detail"  colspan="3"><?php echo $litigation->case_summary ; ?></td>
      </tr>
      <tr class="even">
        <td >&nbsp;</td>
        <td colspan="5">&nbsp;</td>
       
      </tr>
    </table>
 
  </div>
  <div class="fix"></div>
</div>
<br />
<div class="widgets">
  
    <div class="widget">
      <div class="head">
        <h5 class="iFull2">Suing Party</h5>
     
      </div>
      
      <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <td width="25%">Name</td>
                 <td width="25%">Father Name</td>
                <td>Address</td>
              </tr>
            </thead>
            <tbody>
           <?php foreach($suing_party as $list){ ?> 
              <tr>
                <td ><?php echo $list->suing_party_name; ?></td>
                <td ><?php echo $list->suing_party_father_name; ?></td>
                <td><?php echo $list->suing_party_address ; ?></td>
              </tr>
        <?php  } ?>  
            </tbody>
          </table>
      
   
  </div>
  
    <div class="widget" style="margin-top:20px">
      <div class="head">
        <h5 class="iFull2">Defending Party</h5>
 
      </div>
      
      <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <td width="50%">Name</td>
                <td>Address</td>
              </tr>
            </thead>
            <tbody>
        <?php foreach($defending_party as $list){ ?> 
              <tr>
                <td><?php echo $list->defending_party_name; ?></td>
                <td><?php echo $list->defending_party_address; ?></td>
              </tr>
        <?php  } ?>        
            </tbody>
          </table>
      
 
  </div>
   <div class="fix"></div>
</div>
 <div class="fix"></div>
<br />
<div class="widget">
  <div class="head">
    <h5 class="iFull2">Proceedings History</h5>
    <?php
	/*if($this->mdl_users->get_permission('litigation_update')){
            $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('litigation/action/'.$litigation->litigation_id,'Update Litigation',$attributes);
	  }*/
    ?>
  </div>
  <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <td width="9%">Date of Hearing</td>
        <td  width="20%">Proceedings Taken</td>
        <td  width="8%">Reply Status</td>
        <td  width="20%">Appointed For</td>
        <td  width="11%">Injuction Status</td>
        <td width="8%" >Final OutCome</td>
       
        <td  width="25%">Remarks</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($litigation_action as $list){ ?>
      <tr class="gradeA" >
        <td><?php
	
		if($list->next_date !='1970-01-01')
		{
		$datestring = "d - m - y";
	   $time = strtotime($list->next_date);
		echo date($datestring, $time);
		}
		else
		{
			echo "Not Fixed";
	    }
		 ?></td>
        <td><?php echo $list->proceedings_taken; ?></td>
        <td><?php echo $list->reply_status; ?></td>
        <td><?php echo $list->appointed_for; ?></td>
        <td><?php echo $list->injuction_status; ?></td>
        <td><?php echo $list->final_out_come ; ?></td>
        
        <td><?php echo $list->remarks; ?></td>
      </tr>
      <?php  } ?>
    </tbody>
  </table>
</div>
