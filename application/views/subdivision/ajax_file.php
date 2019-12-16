 <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic" id="propertylist">
            	<thead>
                	<tr>
                        <td width="10%">Sr. No.</td>
                        <td width="56%">Sub Division</td>
                        <td width="20"> District</td>
                        <td width="14%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($district_list as $list){ ?>
                	<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->tehsil_name; ?></td>
                        <td><?php echo $list->district_name?> </td>
                        <td>&nbsp;&nbsp;<?php echo anchor('subdivision/edit/'.$list->tehsil_id,'Edit'); ?>
                            <?php echo anchor('subdivision/delete/'.$list->tehsil_id,'| Delete'); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<?php // echo anchor('subdivision/delete/'.$list->tehsil_id,'Delete'); ?></td>
                    </tr>
                <?php 
				$i++;
				} 
				?>	
                </tbody>
            </table>
