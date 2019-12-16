<fieldset>  
    <div class="widget first_form"> 

        <div class="head " >
            <h5><?php echo $profile_data->profile_name ;?>Profile Detail</h5>
            <?php
            $attributes = array('class' => 'basicBtn header_button');
            echo anchor('liberary', 'Close', $attributes);
            ?>
        </div>

    </div>
    
      <div class="body">
          <div class="rowElem Odd">
              <div class="rowElem">
                <div class="label">Name </div>
                <div class="cotent"> <?php echo $profile_data->profile_name; ?> </div>
                <div class="label">Photo</div>
                <div class="cotent"><?php if($profile_data->pic == 'profile_pic_') {?>
                <img src="<?php echo base_url() . 'uploads/no-image.png' ;?> " width="160"> 
                    <?php } else { ?>
                    <img src="<?php echo base_url() . 'uploads/'. $profile_data->pic ;?> " width="160">
                    <?php }?>
                </div>

            </div>
               <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Details</h3>
            </div>
              <div class="rowElem">
                <div class="label">Father Name </div>
                <div class="cotent"> <?php echo $profile_data->father_name; ?> </div>
                <div class="label">CNIC </div>
                <div class="cotent"> <?php echo $profile_data->CNIC; ?> </div>
              </div>
              <div class="rowElem">
                <div class="label">Martial Status </div>
                <div class="cotent"> <?php if($profile_data->meritial_status == 'yes'){echo 'Married';} else
                  if($profile_data->meritial_status == 'no') {
                   echo ' Single'; } else { echo '';} 
                    ?> </div>
                <div class="label">Date of Birth </div>
                <div class="cotent"> <?php echo date('M Y d', strtotime($profile_data->dob)); ?> </div>
              </div>
               <div class="rowElem">
                <div class="label">Caste</div>
                <div class="cotent"> <?php echo $profile_data->caste; ?> </div>
                <div class="label">Spouse Name</div>
                <div class="cotent"> <?php echo $profile_data->spouse_name; ?> </div>
              </div>
               <div class="rowElem">
                <div class="label">Designation</div>
                <div class="cotent"> <?php echo $profile_data->designation_name; ?> </div>
                <div class="label">Personal Computer No</div>
                <div class="cotent"> <?php echo $profile_data->personal_comp_no; ?> </div>
              </div>
              <div class="rowElem">
                <div class="label">Domicile Place</div>
                <div class="cotent"> <?php echo $profile_data->domicile_place; ?> </div>
                <div class="label">Mobile No</div>
                <div class="cotent"> <?php echo $profile_data->personal_m_no; ?> </div>
              </div>
              <div class="rowElem">
                <div class="label">Email</div>
                <div class="cotent"> <?php echo $profile_data->m_no_2; ?> </div>
                <div class="label">Office Contact No</div>
                <div class="cotent"> <?php echo $profile_data->office_contact_no; ?> </div>
              </div>
              <div class="rowElem">
                <div class="label">Qualification</div>
                <div class="cotent"> <?php echo $profile_data->qualifications; ?> </div>
                <div class="label">Computer Proficiency</div>
                <div class="cotent"> <?php echo $profile_data->computer_proficiency; ?> </div>
              </div>
             
               <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Other Information</h3>
            </div>
              <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>District Name</th>
                        <th>Tehsil Name</th>
                        <th>Mauza Name</th>
                        <th>Fall Back no</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <td><?php echo $profile_data->district_name; ?></td>
                        <td><?php echo $profile_data->tehsil_name; ?></td>
                        <td><?php echo $profile_data->mouza_name; ?></td>
                        <td><?php echo $profile_data->fallbacak_no; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Last Postings</h3>
            </div>
              <div class="rowElem">
                <div class="label">Place</div>
                <div class="cotent"> <?php echo $profile_data->posting_district_1; ?> </div>
                <div class="label"> From </div>
                <div class="cotent"> <?php if($profile_data->posting_from_1 == '0000-00-00 00:00:00') 
                {
                    
                    echo 'Date Required';
                }   
                      
                    else { echo date('M Y', strtotime($profile_data->posting_from_1)).'       '; ?> <b>To</b> 
                
                <?php echo '      '.date('M Y', strtotime($profile_data->posting_to_1));} ?>
                </div>
              </div>
              <div class="rowElem">
                <div class="label">Place</div>
                <div class="cotent"> <?php echo $profile_data->posting_district_2; ?> </div>
                <div class="label"> From </div>
                <div class="cotent"> <?php if($profile_data->posting_from_2 == '0000-00-00 00:00:00') 
                {
                    
                    echo 'Date Required';
                }   
                      
                    else { echo date('M Y', strtotime($profile_data->posting_from_2)).'       '; ?> <b>To</b> 
                
                <?php echo '      '.date('M Y', strtotime($profile_data->posting_to_2));} ?>
                </div>
              </div>
              <div class="rowElem">
                <div class="label">Place</div>
                <div class="cotent"> <?php echo $profile_data->posting_district_3; ?> </div>
                <div class="label"> From </div>
                <div class="cotent"> <?php if($profile_data->posting_from_3 == '0000-00-00 00:00:00') 
                {
                    
                    echo 'Date Required';
                }   
                      
                    else { echo date('M Y', strtotime($profile_data->posting_from_3)).'       '; ?> <b>To</b> 
                
                <?php echo '      '.date('M Y', strtotime($profile_data->posting_to_3));} ?>
                </div>
              </div>
              <div class="rowElem Odd">
                  
              </div>
               </div>
          </div>
         
