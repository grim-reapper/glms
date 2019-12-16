
 <div class="leftNav">
    	<ul id="menu">
           <?php if($this->session->userdata('group_id') == 1) { ?>
           
            <li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
<!--            <li class="forms"><?php //echo anchor("court/divisional","<span>Divisional Courts</span>"); ?></li>-->
            <li class="forms"><?php echo anchor("court/district","<span>District Courts</span>"); ?></li>
<!--            <li class="forms"><?php// echo anchor("court/tehsil","<span>Tehsil Courts</span>"); ?></li>-->
            <li class="dash"><?php echo anchor("judicial_cases","<span>Revenue Cases</span>"); ?></li>
            <li class="dash"><?php echo anchor("","<span>General Cases</span>"); ?></li>
            <li class="typo"><?php echo anchor("decided_cases","<span>Decided Cases</span>"); ?></li>
            <li class="dash"><?php echo anchor("","<span>Calender</span>"); ?></li>
             <?php   if($this->mdl_users->get_permission('users_view')){ ?>
             
             <?php } ?>
              <li class="dash"><?php echo anchor("dashboard","<span>Reports</span>"); ?></li>
            <?php } ?>
            
        </ul>
    </div>