<div class="table">
  <div class="head">
    <h5 class="iFrames"><?php echo "Dealt Dak List";?></h5>

  </div> 
     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="5%">Sr. No.</td>
                        <td width="78%">subject</td>
                        <td width="10%">Date</td>
                        <td width="5%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach($dak_list as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $list->subject; ?></td>
                        <td><?php echo mdate("%d - %m - %Y",$list->date); ?></td>
                         <td align="center">
<img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $list->dak_pad_id ?>" onclick="list_action(<?php echo $list->dak_pad_id ?>);"   />
                        <ul id="list_action" class="list_action_<?php echo $list->dak_pad_id ; ?>"   >
                        
						<?php
						
					   if($this->mdl_users->get_permission('dak_view')){
							echo ' <li>';
					    	echo anchor('dak/view_dak/'.$list->dak_pad_id  ,'View');
							echo ' </li>';
						 }	
						 if($this->mdl_users->get_permission('dak_note')){
							echo ' <li>';
					    	echo anchor('dak/add_note/'.$list->dak_pad_id  ,'Note');
							echo ' </li>';
						 }	
						
						 if($this->mdl_users->get_permission('dak_print')){
							echo ' <li>';
							$atts = array(
								  'width'      => '900',
								  'height'     => '700',
								  'scrollbars' => 'yes',
								  'status'     => 'yes',
								  'resizable'  => 'yes',
								  'screenx'    => '20',
								  'screeny'    => '20'
								);
					    	echo anchor_popup('dak/print_dak/'.$list->dak_pad_id  ,'Print', $atts);
							echo ' </li>';
						 }
				

						 if($this->mdl_users->get_permission('dak_archive')){
							echo ' <li>';
					    	echo anchor('dak/make_archives/'.$list->dak_pad_id  ,'Archive');
							echo ' </li>';
						 }		 
						 
						?>
                       </ul>
                        </td>
                    </tr>
                <?php 
				$i++;
				 } 
				?>	
                </tbody>
            </table>
           </div>
        </div>
        
        
  