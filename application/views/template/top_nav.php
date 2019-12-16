<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome">
            <a href="<?php echo site_url('users/view_detail/'.$this->session->userdata('user_id'));?>" >
            <img src="<?php echo base_url();?>asset/images/userPic.png" alt="" />
            </a>
             
                <span>
				<?php 
				  echo $this->session->userdata('name').' - '.$this->session->userdata('group_level');
				   if( strlen($this->session->userdata('group_name')) > 1 )
				   {
					   echo "(".$this->session->userdata('group_name').")";
				   }
				?>
                
                 </span>
             
            </div>
            <div class="userNav">
                <ul>
                    <li><a href="<?php echo site_url('users/view_detail/'.$this->session->userdata('user_id'));?>" title="">
                    <img src="<?php echo base_url();?>asset/images/icons/topnav/profile.png" alt="" /><span>Profile</span>
                    </a></li>
                    <li><a href="#" title="">
                    <img src="<?php echo base_url();?>asset/images/icons/topnav/tasks.png" alt="" /><span>Tasks</span>
                    </a></li>
                    <li class="dd">
                    <img src="<?php echo base_url();?>asset/images/icons/topnav/messages.png" alt="" />
                    <span>Messages</span><span class="numberTop">8</span>
                        <ul class="menu_body">
                            <li><a href="#" title="">new message</a></li>
                            <li><a href="#" title="">inbox</a></li>
                            <li><a href="#" title="">outbox</a></li>
                            <li><a href="#" title="">trash</a></li>
                        </ul>
                    </li>
                    <li class="dd2"><a href="#" title=""><img src="<?php echo base_url();?>asset/images/icons/topnav/settings.png"/><span>Settings</span></a>
                      <ul class="menu_body2">
                            <li><a href="<?php echo site_url('users/chnage_pass/'.$this->session->userdata('user_id'));?>" >Change Password</a></li>
                          
                        </ul>
                    
                    </li>
                    <?php $logout_src =  base_url()."asset/images/icons/topnav/logout.png"; ?>
                    <li><?php echo anchor("sessions/logout","<img src='$logout_src' /><span>Logout</span>"); ?></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>