        <div class="widget first_form">
        	<div class="head"><h5 class="iFrames">Laws</h5>  
			 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;');
                echo anchor('laws/add','Add Law',$attributes);
             ?>
    </div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        
                        <td width="80%">Law title </td>
                        <td width="8%">Passing Date</td>
                        <td width="12%">Action</td>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach($law_list as $list){ ?>
                    <tr>                      
                        <td><?php echo anchor('laws/view/'.$list->law_id,"$list->law_title"); ?></td>
                        <td><?php echo $list->law_passing_date; ?></td>
                        <td><?php echo anchor('laws/view/'.$list->law_id,'View').' | '. anchor('laws/edit/'.$list->law_id,'Edit').' | '. anchor('laws/delete/'.$list->law_id,'Delete'); ?> </td>
                    </tr>
                <?php } ?>	
                </tbody>
            </table>
        </div>
        