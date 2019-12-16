<div class="widget first_form">
        	<div class="head"><h5 class="iFrames">District Courts</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                $attributes1 = array('class' => 'basicBtn header_button','style' => 'margin-right: 4px;');
                echo anchor('court/add_divisional_court','Add Court',$attributes);
                echo anchor('court/add_proceedings','Add Proceedings',$attributes1);
                echo anchor('court/add_case_category','Add Case Category',$attributes1);
                echo anchor('court/add_group','Add Group',$attributes1);
               // echo anchor('peshi_list','Update View',$attributes1);
                
                
             ?>
                   
                   
                  
    </div>
    
     <div id="case_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <th>Sr.#</th>
                        <th>District</th>
                        <th>Court Category</th>
                        <th>Name of Presiding Office</th>
                        <th>Working Days</th>
                        <th>Station</th>
                        <th>No of Cases</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                      
                           <?php $i=1; foreach ($courts as $list) {?>
                        <td style="text-align: center;"><?php echo $i;?></td>
                        <td><?php echo $list->district_name;?></td>
                        <td><?php echo $list->court_category_name; ?></td>
                        <td><?php echo $list->name_officer; ?></td>
                         <?php if($list->working_days == NULL)
                      {
                          $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> 'Required'
                              );
                      }
                     else {
                        $att =array(
                            'class'=>" leftDir mr20 ml20",
                            'title'=> $list->working_days
                        );}?>
                        <td style="text-align: center;"><?php  echo anchor('#'.$list->court_id,'View',$att); ?></td>
                        
                         <td><?php echo $list->station; ?></td>
                      
                        <td></td>
                        <td style="text-align: center;"><?php echo anchor('court/delete_court/'.$list->court_id,'Delete'); ?></td>
                     
                        
                      
                        
                       
                        
                          
                        
                    </tr>
                     <?php $i++; }?>
                  
                </tbody>
               
            </table>
        </div>
        </div>