<?php //



echo form_open_multipart('decided_cases/add_judgement');
?>
<div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Decided Cases:<?php echo '  '.$count->total;?></h5>
                    <?php
                    $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                    echo anchor('decided_cases/add_case','Add Case',$attributes);
			?>
                  
    </div>
 <div id="case_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <th>Sr.#</th>
                        <th>Date</th>
                        <th>Case.#</th>
                        <th>Mauza</th>
                        <th>Petitioner</th>
                        <th>Respondant</th>
                        <th>Case Category</th>
                        <th>Fate of Case</th>
                        <th>Judgement</th>
                        <th>Detail</th>
                       
                       
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php $i=1; foreach ($cases as $list) {
                                     ?>
                        <td style="text-align: center;"><?php echo $i++;?></td>
                        <td style="text-align: center;"><?php echo date('d', strtotime($list->date_of_hearing)); ?>
                            <?php echo date('M', strtotime($list->date_of_hearing)); ?> 
                            <?php echo date('y', strtotime($list->date_of_hearing)); ?> </td>
                        <td style="text-align: center;"><?php echo $list->case_no;?></td>
                        <td><?php echo $list->mouza_name;?></td>
                        
                       <?php if($list->suing_counsel == NULL)
                        {
                          
                            $class =" leftDir mr20 ml20 lawyerbutton";
                            $title= ' Advocate name required';
                            
                        } else {
                              
                            $class=" leftDir mr20 ml20 lawyerbutton";
                            $title= $list->suing_counsel ;
                        
                            
                            
                        }
                       ?>
                        
                        <td><?php echo $list->suing_party_name ;?><div class="<?php echo $class;?>" title="<?php echo $title;?>"> Vie</div></td>
                        
                       
                         
                          <?php if( $list->defending_party_counsel == NULL)
                        {
                          
                            $class=" leftDir mr20 ml20 lawyerbutton";
                            $title= ' Advocate name required';
                            
                        } else {
                             
                            $class =" leftDir mr20 ml20 lawyerbutton";
                            $title=  $list->defending_party_counsel;
                       
                            
                            
                        }
                       ?>
                         <td ><?php echo $list->defending_party_name ;?><div class="<?php echo $class;?>" title="<?php echo $title;?>"> Vie</div></td>
                      
                        <td ><?php echo $list->case_tittle_name  ;?></td>
                        <td ><?php echo $list->fate_case_name ;?></td>
                      <?php if($list->Notes == NULL)
                      {
                          $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> 'Required'
                              );
                      }
                     else {
                        $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $list->Notes
                        );}?>
                        
                        <td style="text-align: center;">
                            <?php if($list->judgement){?>
                            <a href="<?php echo base_url();?>uploads/<?php echo $list->judgement;?>" target="_blank"><img src="<?php echo base_url();?>asset/images/pdf.png" /></a>
                            <?php } else {?>
                              <input type="file"  name="judeg_<?php echo $list->case_id;?>" value="upload file" />
                            <?php }?>
                          
                           </td>
                           <td>
                               <?php echo anchor('decided_cases/edit/'.$list->case_id,'Edit');?>
                               <?php echo anchor('decided_cases/delete/'.$list->case_id,'|Delete');?>
                               </td>
                          
                       
                      </tr>
                    <?php }?>
                </tbody>
               
            </table>
      <input type="submit"   name="submit" value="Save" class="basicBtn"  />
      <?php form_close();?>
        </div>
    
     
    </div>