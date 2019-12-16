<div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Groups</h5> 
                    
                     <?php
                $attributes = array('class' => 'basicBtn header_button');
                echo anchor('court','Back',$attributes);
               // echo anchor('peshi_list','Update View',$attributes1);
                
                
             ?>
                    </div>
                    
                    
                     <div id="case_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic" style="width:600px; border-right: 1px solid #E7E7E7; ">
            	<thead>
                	<tr>
                        <th style="width:10px;">Sr.#</th>
                        <th>Group Name</th>
                        <th>Detail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php $i=1; foreach ($groups as $list) {
                                     ?>
                        <td style="text-align: center;"><?php echo $i;?></td>
                        <td><?php echo $list->group_name;?></td>
                        <td></td>
                        
                      </tr>
                    <?php $i++;}?>
                </tbody>
               
            </table>
        </div>
    <div class="head"><h5 class="iFrames">Proceedings</h5> 
                    </div>
     <div id="case_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic"  border-right: 1px solid #E7E7E7; ">
            	<thead>
                	<tr>
                        <th style="width:10px;">Sr.#</th>
                        <th>Territory</th>
                        <th>Proceedings Name</th>
                        <th>Group Name</th>
                        <th>Class of Cases</th>
                        <th>Court Category</th>
                        <th>Detail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php $i=1; foreach ($proceedings as $list) {
                                     ?>
                        <td style="text-align: center;"><?php echo $i;?></td>
                        <td><?php echo $list->district_name;?></td>
                        <td><?php echo $list->proceedings_name;?></td>
                        <td><?php echo $list->group_name;?></td>
                        <td><?php echo $list->class_cases;?></td>
                        <td><?php echo $list->court_category_name;?></td>
                        <td style="text-align: center;"><?php echo anchor('court/edit_proceedings/'.$list->proceedings_id,'Edit'); ?>
                                                <?php echo anchor('court/delete_proceedings/'.$list->proceedings_id,'|Delete'); ?></td>
                      </tr>
                    <?php $i++; }?>
                </tbody>
               
            </table>
        </div>
		<div class="head"><h5 class="iFrames">Case Category</h5> 
                    </div>
    <div id="case_list">
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic" style="border-right: 1px solid #E7E7E7; ">
            	<thead>
                	<tr>
                        <th style="width:10px;">Sr.#</th>
                        <th>Territory</th>
                        <th>Case Category Name</th>
                        <th>Class of Cases</th>
                        <th>Court Category</th>
                        <th>Detail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php $i=1; foreach ($case_category as $list) {
                                     ?>
                        <td style="text-align: center;"><?php echo $i;?></td>
                        <td><?php echo $list->district_name;?></td>
                        <td><?php echo $list->case_tittle_name;?></td>
                        <td><?php echo $list->class_cases;?></td>
                        <td><?php echo $list->court_category_name;?></td>
                        <td style="text-align: center;"><?php echo anchor('court/edit_case_category/'.$list->case_tittle_id,'Edit'); ?>
                                                <?php echo anchor('court/delete_category/'.$list->case_tittle_id,'|Delete'); ?></td>
                        </tr>
                    <?php $i++; }?>
                </tbody>
               
            </table>
        </div>
                   
                   
                  
    </div>
