
 <div class="leftNav">
    	<ul id="menu">
       
           
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <?php foreach($law_categories as $list){?>
            <li class="dash"><?php echo anchor("laws/index/".$list->law_category_id,"<span>$list->law_category_name</span>"); ?></li>
            
            <?php } ?>  
            <li class="dash"><?php echo anchor("laws","<span>Reports</span>"); ?></li>       
        </ul>
    </div>
