<div class="table">
  <div class="head">
    <h5 class="iFrames">Qanungoi Circle List</h5>
          	 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('qanungoicircle/add','Add Qanungoi Circle',$attributes);
             ?>
  </div> 
     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="38%">Qanungoi Circle</td>
                        <td width="38%">Sub Division</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($qanungoi as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->q_circle; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('qanungoicircle/edit/'.$list->q_id,'Edit'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<?php // echo anchor('subdivision/delete/'.$list->tehsil_id,'Delete'); ?>
                        </td>
                    </tr>
                <?php 
				$i++;
				 } 
				?>	
                </tbody>
            </table>