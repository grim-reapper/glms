 <table cellpadding="0" cellspacing="0"  border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="36%">Districts</td>
                        <td width="360">Divisions</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($division_list as $list){ ?>
                	<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->district_name; ?></td>
                        <td><?php echo $list->division_name; ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('districts/edit/'.$list->district_id,'Edit'); ?>
                            <?php echo anchor('districts/delete/'.$list->district_id,'|Delete'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<?php // echo anchor('subdivision/delete/'.$list->tehsil_id,'Delete'); ?></td>
                    </tr>
                <?php 
				$i++;
				} 
				?>	
                </tbody>
            </table>