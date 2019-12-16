
 <div class="leftNav">
    	<ul id="menu">
           
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <?php if($this->session->userdata('group_id') == 1) { ?>
            <li class="graphs"><?php echo anchor("subdivision","<span>Sub Division</span>");  ?></li>
            <li class="forms"><?php echo anchor("qanungoicircle","<span>Qanungoi Circle</span>"); ?></li>
            <li class="login"><?php echo anchor("patwarcircle","<span>Patwar Circle</span>"); ?></li>
            <li class="typo"><?php echo anchor("mauza","<span>Mauza Management</span>"); ?></li>
            <?php } ?>
            
          <?php  if($this->mdl_users->get_permission('property_view')){ ?>
           <li class="tables"><?php echo anchor("property","<span>Property Management</span>","class='exp'"); ?>
            	<ul class="sub">
                    <li><?php echo anchor("property","Property List"); ?></li>
          <?php   if($this->mdl_users->get_permission('property_add')){ ?>
                    <li><?php echo anchor("property/new_property","New Property"); ?></li>
               <?php } ?>   

                </ul>
            </li>
            <?php } ?>
           <?php   if($this->mdl_users->get_permission('users_view')){ ?>
            <li class="gallery"><?php echo anchor("users","<span>Users Management</span>"); ?></li>
             <?php } ?>
            <li class="cal"><?php echo anchor("reports","<span>Reports</span>"); ?></li>
           <?php   if($this->mdl_users->get_permission('litigation_view')){ ?>
            <li class="typo"><?php echo anchor("litigation","<span>Litigation Management</span>"); ?> </li>
       <?php } ?>
        </ul>
    </div>