
 <div class="leftNav">
    	<ul id="menu">
           <?php   if($this->mdl_users->get_permission('users_view')){ ?>
           
        	<li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
            <?php foreach($user_group_list as $list ){?>
            <li class="typo"><?php echo anchor("users/index/".$list->group_id 	,"<span>".$list->group_name."</span>"); ?> </li>
            <?php } ?>
            
            <li class="typo"><?php echo anchor("users","<span>Common List</span>"); ?> </li>
            <li class="typo"><?php echo anchor("users","<span>Reports</span>"); ?> </li>
       <?php } ?>
        </ul>
    </div>