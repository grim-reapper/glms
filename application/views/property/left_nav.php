
 <div class="leftNav">
    	<ul id="menu">
           <?php  if($this->mdl_users->get_permission('property_view')){ ?> 
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <li class="graphs"><?php echo anchor("property/index/NZ","<span>Nazul Land</span>");  ?></li>
            <li class="forms"><?php echo anchor("property/index/PG","<span>Prov. Govt. Land</span>"); ?></li>
            <li class="login"><?php echo anchor("property/index/EV","<span>Evacuee Land</span>"); ?></li>
            <li class="forms"><?php echo anchor("property/index/FG","<span>Fed. Govt. Land</span>"); ?></li>
            <li class="typo"><?php echo anchor("property/index/EM","<span>Ex-MCL Land</span>"); ?></li>
            <li class="typo"><?php echo anchor("property/index/PD","<span>Prov. Deptt.</span>"); ?></li>
            <li class="typo"><?php echo anchor("property/index/FD","<span>Fed. Deptt.</span>"); ?></li>
            <li class="typo"><?php echo anchor("property/index/OT","<span>Other</span>"); ?></li>
            <li class="typo"><?php echo anchor("property/index/common","<span>Common List</span>"); ?></li>
            <li class="cal"><?php echo anchor("property/index/","<span>Reports</span>"); ?></li>
        <?php } ?>
        </ul>
    </div>
    