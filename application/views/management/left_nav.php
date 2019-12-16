<?php $uri = $this->uri->segment(1); ?>
 <div class="leftNav">
    	<ul id="menu">
           <?php if($this->session->userdata('group_id') == 1) { ?>
           
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <li class="dash"><?php echo anchor("division","<span>Divisions</span>",array('class' => $uri == 'division' ? 'active' : '')); ?></li>
            <li class="dash"><?php echo anchor("districts","<span>Districts</span>" ,array('class' => $uri == 'districts' ? 'active' : '')); ?></li>
            <li class="graphs"><?php echo anchor("subdivision","<span>Sub Divisions</span>" ,array('class' => $uri == 'subdivision' ? 'active' : ''));  ?></li>
            <li class="forms"><?php echo anchor("qanungoicircle","<span>Qanungoi Circles</span>",array('class' => $uri == 'qanungoicircle' ? 'active' : '')); ?></li>
            <li class="login"><?php echo anchor("patwarcircle","<span>Patwar Circles</span>",array('class' => $uri == 'patwarcircle' ? 'active' : '')); ?></li>
            <li class="typo"><?php echo anchor("mauza","<span>Mauzas</span>",array('class' => $uri == 'mauza' ? 'active' : '')); ?></li>
            <li class="dash"><?php echo anchor("dashboard","<span>NA Constituencies</span>"); ?></li>
            <li class="dash"><?php echo anchor("dashboard","<span>PP Constituencies</span>"); ?></li>
            <li class="dash"><?php echo anchor("dashboard","<span>Towns</span>"); ?></li>
            <li class="dash"><?php echo anchor("dashboard","<span>Union Councils</span>"); ?></li>
             <?php   if($this->mdl_users->get_permission('users_view')){ ?>
             <li class="gallery"><?php echo anchor("users","<span>Users Management</span>",array('class' => $uri == 'users' ? 'active' : '')); ?></li>
             <?php } ?>
              <li class="dash"><?php echo anchor("dashboard","<span>Reports</span>"); ?></li>
            <?php } ?>
            
        </ul>
    </div>