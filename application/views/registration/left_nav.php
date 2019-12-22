<?php $uri = uri_string(); ?>
<div class="leftNav">
    <ul id="menu">
            <li class="dash"><?php echo anchor("dashboard","<span>Dashboard</span>"); ?></li>
        <li class="dash"><?php echo anchor("registration/identified","<span>Identified Scheme</span>",array('class' => $uri == 'registration/identified' ? 'active' : '')); ?></li>
        <li class="dash"><?php echo anchor("registration","<span>Survey</span>",array('class' => $uri == 'registration' ? 'active' : '')); ?></li>
    </ul>
</div>
