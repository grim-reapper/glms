<?php $uri = $this->uri->segment(3); ?>
 <div class="leftNav">
    	<ul id="menu">
       
           
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <?php  if($this->mdl_users->get_permission('dak_view')){ ?>
            <li class="dash"><?php echo anchor("dak/index/fresh","<span>Fresh Dak</span>",array('class' => $uri == 'fresh' ? 'active' : '')); ?></li>
            <?php } ?>
          <?php  if($this->mdl_users->get_permission('dak_view')){ ?>
            <li class="dash"><?php echo anchor("dak/index/dealt","<span>Dealt Dak</span>",array('class' => $uri == 'dealt' ? 'active' : '')); ?></li>
            <?php } ?>
          <?php  if($this->mdl_users->get_permission('dak_view')){ ?>
            <li class="dash"><?php echo anchor("dak/index/archive","<span>Archives</span>",array('class' => $uri == 'archive' ? 'active' : '')); ?></li>
            <?php } ?>
          <?php  if($this->mdl_users->get_permission('dak_view')){ ?>
            <li class="dash"><?php echo anchor("dak","<span>Reports</span>"); ?></li>     
            <?php } ?>
              
        </ul>
    </div>