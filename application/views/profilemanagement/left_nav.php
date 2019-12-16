<?php $uri = uri_string(); ?>
<div class="leftNav">
    <ul id="menu">
        <?php if ($this->session->userdata('group_id') == 1) { ?>

            <li class="dash"><?php echo anchor("dashboard", "<span>Dashboard</span>"); ?></li>
            <li class="forms"><?php echo anchor("profile/admin", "<span>Admin</span>",array('class' => $uri == 'profile/admin' ? 'active' : '')); ?></li>
            <li class="dash"><?php echo anchor("profile", "<span>District Group</span>"); ?></li>
            <li class="forms"><?php echo anchor("profile/tehsil_group", "<span>Tehsil Group</span>",array('class' => $uri == 'profile/tehsil_group' ? 'active' : '')); ?></li>
            <li class="typo"><?php echo anchor("profile/Staff_group", "<span>Staff Group</span>",array('class' => $uri == 'profile/Staff_group' ? 'active' : '')); ?></li>
            <li class="forms"><?php echo anchor("profile/Qanoongo_group", "<span>Qanoongo Group</span>",array('class' => $uri == 'profile/Qanoongo_group' ? 'active' : '')); ?></li>
            <li class="dash"><?php echo anchor("profile/Patwar_group", "<span>Patwar Group</span>",array('class' => $uri == 'profile/Patwar_group' ? 'active' : '')); ?></li>
            <?php if ($this->mdl_users->get_permission('users_view')) { ?>

            <?php } ?>
            <li class="dash"><?php echo anchor("dashboard", "<span>Reports</span>"); ?></li>
            <?php } ?>

    </ul>
</div>