
 <div class="leftNav">
    	<ul id="menu">
           <?php   if($this->mdl_users->get_permission('litigation_view')){ ?>
           
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <?php foreach($category_list as $list ){?>
            <li class="typo"><?php echo anchor("litigation/index/".$list->litigation_category_id 	,"<span>".$list->category_name."</span>"); ?> </li>
            <?php } ?>
<?php /*?>  <li class="typo"><?php echo anchor("litigation","<span>HC Cases</span>"); ?> </li>
            <li class="typo"><?php echo anchor("litigation","<span>BOR Cases</span>"); ?> </li>
            <li class="typo"><?php echo anchor("litigation","<span>Ombudsman Cases</span>"); ?> </li>
            <li class="typo"><?php echo anchor("litigation","<span>Civil Cases</span>"); ?> </li>
            <li class="typo"><?php echo anchor("litigation","<span>Other Cases</span>"); ?> </li><?php */?>
            
            <li class="typo"><?php echo anchor("litigation","<span>Common List</span>"); ?> </li>
            <li class="typo"><?php echo anchor("litigation/calendar/".mdate("%Y/%m", time()),"<span>Litigation Calendar</span>"); ?> </li>
            <li class="typo"><?php echo anchor("litigation","<span>Reports</span>"); ?> </li>
       <?php } ?>
        </ul>
    </div>