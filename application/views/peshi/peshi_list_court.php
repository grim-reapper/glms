 <?php $c=1;?>
            <table cellpadding="0" cellspacing="0" width="100%" class="display" style="background-color: white; font-family: 'Arial Narrow';  font-size: 15px;"  >
            	<thead>
                    <tr style="height: 40px;">
                       
                        <th colspan="2" style="border:1px solid; font-size: 16px;"><?php echo date("d M Y", strtotime($date)) ;?></th>
                        <th style="border:1px solid; font-size: 16px;"><?php echo date("l", strtotime($date)) ;?></th>
                        <th colspan="7" style="border:1px solid; font-size: 16px;">Time 10:00 AM</th>
                       
                    
                        
                        
                        
                        </tr>
                	<tr style="">
                        <th style="border:1px solid; width: 3%;  height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Sr.#</th>
                        <th style="border:1px solid; width: 15%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Mauza</th>
                        <th style="border:1px solid; width: 9%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Petitioner</th>
                        <th style="border:1px solid; width: 9%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Name of Lawyer</th>
                        <th style="border:1px solid; width: 9%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Contact</th>
                        <th style="border:1px solid; width: 9%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Respondent</th>
                        <th style="border:1px solid; width: 9%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Name of Lawyer</th>
                        <th style="border:1px solid; width: 9%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Contact</th>
                        <th style="border:1px solid; width: 15%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Proceedings</th>
                        <th style="border:1px solid; width: 13%; height: 23px; font-family: 'Arial Narrow';  font-size: 15px;">Remarks</th>
                       
                    </tr>
                   
                 </thead>
                
                
                
                <tbody>
                  
                    <?php  
                    foreach($groups as $group){?>
                   
                    <tr style="color: blue; font-size: 18px; height: 40px;">
                       <td colspan="10" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top:none; "> <?php echo $group->group_name;?></td>
                     </tr>
                    
                   
                        <?php
                        $this->load->model('mdl_judicial_cases');
                       $cases=$this->mdl_judicial_cases->generate_list($group->group_id,$date);
                      
                       foreach ($cases as $case) {
                       ?>
                    <tr class="gradeA" style="border: 1px solid; height: 40px;">
                       
                        <td style="text-align: center; border: 1px solid; text-align: center;"><?php echo $c;?></td>
                        <td style="border:1px solid;"><?php echo $case->mouza_name;?></td>
                        <td style="border:1px solid;"> <?php echo $case->suing_party_name;?></td>
                        <td style="border:1px solid;"> </td>
                        <td style="border:1px solid;"> </td>
                        <td style="border:1px solid;"><?php echo $case->defending_party_name;?></td>
                        <td style="border:1px solid;"></td>
                        <td style="border:1px solid;"></td>
                        <td style="border:1px solid;"><?php echo $case->proceedings_name;?></td>
                        <td style="text-align: center; border:1px solid;"><?php echo '  ';?></td>
                      
                        
                        
                        
                    </tr>
                       <?php $c++;}?>
                    <?php }?>
                </tbody>
               
            </table>
 
  
