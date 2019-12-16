<div class="cpanel-left">
  <div class="cpanel">
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('dashboard');?>"> <img alt="" src="<?php echo base_url();?>asset/images/dashboard/house_3.png"><span>Dashboard</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"> <a href="<?php echo site_url('management');?>"> <img alt="" src="<?php echo base_url();?>asset/images/dashboard/lahore.png"><span>Management </span></a> </div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('profile');?>"><img alt="" src="<?php echo base_url();?>asset/images/dashboard/profiles.png"><span>Profiles</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href=""><img alt="" src="<?php echo base_url();?>asset/images/dashboard/telephone.png"><span>Directory</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href=""><img alt="" src="<?php echo base_url();?>asset/images/dashboard/tasks.png"><span>Tasks</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php if($this->mdl_users->get_permission('dak_view')){  echo site_url('dak'); }else{echo "#";}?>"><img alt="" src="<?php echo base_url();?>asset/images/dashboard/dak.png"><span>Dak Pad</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('property');?>"> <img alt="" src="<?php echo base_url();?>asset/images/dashboard/icon-48-language.png"><span>Property</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('filescatalog');?>"> <img alt="" src="<?php echo base_url();?>asset/images/dashboard/catalog.png"><span>Records</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('litigation');?>"> <img alt="" src="<?php echo base_url();?>asset/images/dashboard/litigation.png"> <span>Litigation</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('laws');?>"><img alt="" src="<?php echo base_url();?>asset/images/dashboard/black_book.png"><span>Laws</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href=""><img alt="" src="<?php echo base_url();?>asset/images/dashboard/meetings.png"><span>Meetings</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('registration')?>"><img alt="" src="<?php echo base_url();?>asset/images/dashboard/icon-48-article-add.png"><span>Registration</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href=""><img alt="" src="<?php echo base_url();?>asset/images/dashboard/news.png"><span>BAC</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('court');?>"><img alt="" src="<?php echo base_url();?>asset/images/dashboard/auction-hammer-icon.png"><span>Judicial Work</span></a></div>
    </div>
    <div class="icon-wrapper">
      <div class="icon"><a href="<?php echo site_url('users');?>"> <img alt="" src="<?php echo base_url();?>asset/images/dashboard/icon-48-user.png"><span>Users</span></a></div>
    </div>
  </div>
</div>
<div class="cpanel-right">
  <div class="widget acc">
  <?php
  if($this->session->userdata('group_id') == 1)
		{
  ?>
    <div class="head">
      <h5>Logded-in Users</h5>
    </div>
    <div class="menu_body">
      <table class="tableStatic" cellspacing="0" cellpadding="0" width="100%">
        <thead>
          <tr>
            <th> Name </th>
            <th> <strong>Group</strong> </th>
          </tr>
        </thead>
        <tbody>
          <?php
             $users = $this->onlineusers->get_info(); //prefer using reference to best memory usage
			//  foreach($users as $user)
			 // { ?>
          <tr>
            <th scope="row"> <a href="">Muhammad Ayyub Bhatti</a> </th>
            <td class="center">Admin</td>

          </tr>
          <?php // } ?>
        </tbody>
      </table>
    </div>
     <?php } ?>
    <div class="head">
      <h5>Messages</h5>
    </div>
    <div class="menu_body">
      <table class="tableStatic" cellspacing="0" cellpadding="0" width="100%">
        <thead>
          <tr>
            <th>Subject</th>
            <th> Details</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td ><a href=""> Meeting</a></td>
            <td > This widget is opened by default. Works in case of adding </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="fix"></div>
</div>
