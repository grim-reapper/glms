
<fieldset>  
<div class="widget first_form"> 

<div class="head " >
    <h5>Revenue Record Detail</h5>
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('revenue','Close',$attributes);
       ?>
  </div>
    
    </div>
    
     <div class="body">
         <div class="rowElem Odd">
             <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
         <thead>
        <tr>
        <th>District</th>
        <th>Subdivision</th>
        <th>Mauza</th>
        <th>Category</th>
        <th>Year</th>
        </tr>
       </thead>
       <tbody>
           <tr style="text-align: center;">
               <td><?php echo $file->district_name;?></td>
               <td><?php echo $file->tehsil_name;?></td>
               <td><?php echo $file->mouza_name;?></td>
               <td><?php if($file->revenue_category =='PR'){ echo 'Periodical';}
                        elseif ($file->revenue_category=='SR') { echo 'Settlement';}
                        elseif ($file->revenue_category=='CR') {echo 'Consolidation';}?></td>
               <td><?php echo $file->revenue_year;?></td>
           </tr>
       </tbody>
       </table>
             
             <div class="rowElem Odd">
      <h3 style="background: white; color: #2B6893;">Details</h3>
    </div>
    
      <div class="rowElem">
      <div class="label">No. of Volumes:</div>
      <div class="cotent"> <?php echo $file->volumes;?> </div>
      <div class="label">Consignment Date:</div>
      <div class="cotent"><?php echo date('d', strtotime($file->consign_date)); ?>
                            <?php echo date('M', strtotime($file->consign_date)); ?> 
                            <?php echo date('Y', strtotime($file->consign_date)); ?> 
          
      
      </div>
       </div>
      <div class="rowElem">
      <div class="label">No. of Mutations: </div>
      <div class="cotent"> <?php echo $file->no_of_mutations; ?> </div>
      <div class="label">No. Of Khatas:</div>
      <div class="cotent"> <?php echo $file->no_of_khatas; ?> </div>
       </div>
      <div class="rowElem">
      <div class="label">No of Khatoonis: </div>
      <div class="cotent"> <?php echo $file->no_of_khatoonis; ?> </div>
      <div class="label">Area:</div>
      <div class="cotent"> <?php echo $file->area_kanal.'-'.$file->area_marla.'-',$file->area_sqft; ?></div>
       </div>
      <div class="rowElem">
      <div class="label">Rack no: </div>
      <div class="cotent"> <?php echo $file->rack_no; ?> </div>
      <div class="label">Row no: </div>
      <div class="cotent"> <?php echo $file->row_no; ?> </div>
      </div>
      <div class="rowElem">
      <div class="label">Column no: </div>
      <div class="cotent"> <?php echo $file->column_no; ?> </div>
      <div class="label">Record Detail: </div>
      <div class="cotent"> <?php echo $file->detail; ?> </div>
      </div>
             <div class="rowElem">
              </div>
             
             <div class="fix"></div>
             
             
         </div>
         </div>
    
    
   
    </fieldset>
