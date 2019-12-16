
 <div class="leftNav">
    	<ul id="menu">
           <?php if($this->session->userdata('group_id') == 1) { ?>
           
            <li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
             <li class="forms"><?php echo anchor("filescatalog","<span>General Records</span>"); ?></li>
            <li class="dash"><?php echo anchor("filescatalog/branch","<span>Branch</span>"); ?></li>
            <li class="dash"><?php echo anchor("revenue","<span>Revenue Records</span>"); ?></li>
            <li class="typo"><?php echo anchor("#","<span>Judicial Records</span>"); ?></li>
            <li class="forms"><?php echo anchor("liberary","<span>Liberary</span>"); ?></li>
             <?php   if($this->mdl_users->get_permission('users_view')){ ?>
             
             <?php } ?>
              <li class="dash"><?php echo anchor("dashboard","<span>Reports</span>"); ?></li>
            <?php } ?>
            
        </ul>
    </div>