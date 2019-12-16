        <div class="widget first_form">
           
        	<div class="head"><h5 class="iFrames">Division</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button');
                echo anchor('division/add','Add Division',$attributes);
             ?>
    </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="20%">Divisions</td>
                        <td width="20%">Area KM&sup2</td>
                        <td width="20%">Capital</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($lists as $list){ ?>
                	<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->division_name; ?></td>
                        <td><?php echo $list->division_area." Km&sup2"?></td>
                        <td><?php echo $list->division_capital?></td>
              
                        <td>&nbsp;&nbsp;<?php echo anchor('division/edit/'.$list->division_id,'Edit'); ?>
                                                <?php echo anchor('division/delete/'.$list->division_id,'|Delete'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<?php // echo anchor('subdivision/delete/'.$list->tehsil_id,'Delete'); ?></td>
                    </tr>
                <?php 
				$i++;
				} 
				?>	
                </tbody>
            </table>
        </div>
        