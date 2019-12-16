 <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="5%">Sr. No.</td>
                        <td width="30%">Patwar Circle</td>
                        <td width="30%">Qanungoi Circle</td>
                        <td width="30%">Sub Division</td>
                        <td width="5%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($patwar as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $i; ?></td>
                         <td><?php echo $list->patwar_circle; ?></td>
                        <td><?php echo $list->q_circle; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('patwarcircle/edit/'.$list->p_id,'Edit'); ?>
                        </td>
                    </tr>
                <?php 
				$i++;
				 } 
				?>	
                </tbody>
            </table>
