<table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="5%">Sr. No.</td>
                        <td width="15%">Mauza</td>
                        <td width="10%">Hadbast No.</td>
                        <td width="15%">Patwar Circle</td>
                        <td width="20%">Qanungoi Circle</td>
                        <td width="20%">Sub Division</td>
                        <td width="5%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($mauza_list as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->mouza_name; ?></td>
                        <td><?php echo $list->hadbast; ?></td>
                         <td><?php echo $list->patwar_circle; ?></td>
                        <td><?php echo $list->q_circle; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('mauza/edit/'.$list->mauza_id,'Edit'); ?>
                            <?php echo anchor('mauza/mauza_detail/'.$list->mauza_id,'|view'); ?>
                        </td>
                    </tr>
                <?php 
				$i++;
				 } 
				?>	
                </tbody>
            </table>
