<div class="widget first_form">
    <div class="head"><h5 class="iFrames">Profile Admin</h5>
      
    </div>

<?php 

$attributes = array('class' => 'basicBtn header_button','style' => ' float: left;');
        echo anchor('profile/add_designation', 'Add Designation', $attributes);
        echo anchor('profile/view_designation', 'View Designations', $attributes);
      ?>
</div>
