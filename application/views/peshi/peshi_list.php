 <?php $c=1;?>
            <table cellpadding="0" cellspacing="0" width="100%" class="display" style="background-color: white; font-family: 'Arial Narrow';  font-size: 15px;"  >
            	<thead>
                    <tr style="height: 40px;">
                       
                        <th colspan="2" style="border:1px solid; font-size: 16px; color: black;"><?php echo date("d M Y", strtotime($date)) ;?></th>
                        <th style="border:1px solid; font-size: 16px; color: black;"><?php echo date("l", strtotime($date)) ;?></th>
                         <th colspan="3" style="border:1px solid; font-size: 16px; color: black;">Time 10:00 AM</th>
                       
                    
                        
                        
                        
                        </tr>
                	<tr style="">
                        <th style="border:1px solid; width: 3%;  height: 23px;  font-size: 16px; color: black;">Sr.#</th>
                        <th style="border:1px solid; width: 17%; height: 23px;  font-size: 16px; color: black;">Mauza</th>
                        <th style="border:1px solid; width: 17%; height: 23px;   font-size: 16px; color: black;">Petitioner</th>
                        <th style="border:1px solid; width: 20%; height: 23px;  font-size: 16px; color: black;">Respondent</th>
                        <th style="border:1px solid; width: 18%; height: 23px;  font-size: 16px; color: black;">Proceedings</th>
                        <th style="border:1px solid; width: 25%; height: 23px;  font-size: 16px; color: black;">Remarks</th>
                       
                    </tr>
                   
                 </thead>
                
                
                
                <tbody>
                  
                    <?php  
                    foreach($groups as $group){?>
                   
                  
                   
                        <?php
                        $this->load->model('mdl_judicial_cases');
                       $cases=$this->mdl_judicial_cases->generate_list($group->group_id,$date);
                       if(count($cases) > 0) {
                       ?>
                       <tr style="color: blue; font-size: 18px; height: 40px;">
                       <td colspan="6" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top:none; "><b> <?php echo $group->group_name;?></b></td>
                     </tr>
                    
                      
                      <?php foreach ($cases as $case) {
                       ?>
                    <tr class="gradeA" style="border: 1px solid; height: 40px;">
                       
                        <td style="text-align: center; border: 1px solid; text-align: center; color: black; font-size: 15px;"><?php echo $c;?></td>
                        <td style="border:1px solid; color: black; font-size: 15px; font-family: 'Arial Narrow'"><?php echo $case->mouza_name;?></td>
                        <td style="border:1px solid; color: black; font-size: 15px; font-family: 'Arial Narrow'"> <?php echo $case->suing_party_name;?></td>
                        <td style="border:1px solid; color: black; font-size: 15px; font-family: 'Arial Narrow'"><?php echo $case->defending_party_name;?></td>
                        <td style="border:1px solid; color: black; font-size: 15px; font-family: 'Arial Narrow'"><?php echo $case->proceedings_name;?></td>
                        <td style="text-align: center; border:1px solid; color: black; font-size: 15px;"><?php echo '  ';?></td>
                      
                        
                        
                        
                    </tr>
                       <?php $c++;}?>
                       <?php }}?>
                </tbody>
               
            </table>
 
  
