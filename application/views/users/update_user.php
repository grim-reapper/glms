<script type="text/javascript" language="javascript">
function group_type()
{
 
   var  group  = $('#group').val();
   if(group == 1 || group == 2 || group == '')
   {
	 $('#land_group').hide();     
   }
   else if(group == 3)
   {
	 $('#land_group').show(); 
	 $('#qon').hide();  
	 $('#patwar').hide(); 
   }
   else if(group == 4)
   {
	 $('#land_group').show(); 
	 $('#qon').show();  
	 $('#patwar').hide(); 
   }
  else if(group == 5)
   {
	 $('#land_group').show(); 
	 $('#qon').show();   
	 $('#patwar').show(); 
   }
}
</script>

<?php $this->load->view("property/property_js");?>
<?php 
$attributes = array('class' => 'mainForm');

echo form_open('users/update_user', $attributes);
?>


<fieldset>
  <div class="widget first_form">
    <div class="head">
      <h5 class="iList">Update User</h5>
    </div>
    <?php 
	   if(validation_errors()){
	?>
    <div class="nNote nWarning hideit">
      <p><strong>WARNING: </strong><?php echo validation_errors(); ?></p>
    </div>
    <?php 
	   }
	  ?>
    <div class="rowElem  noborder">
      <label>Full Name:</label>
      <div class="formRight">
        <input type="text" name="name"   value="<?php echo $user->name; ?>"/>
      </div>
      
      <label>User Group:</label>
      <div class="formRight">
        <select name="group_id" id="group" onchange="group_type();">
           <option value=""> - - - - - - Select - - - - - -</option>
          <?php 
		  foreach($group_list as $list)
		  { ?>
          <?php 
		     if($list->group_id == $user->group_id ){
		  ?>
              <option value="<?php echo $list->group_id ; ?>" selected="selected" ><?php echo $list->group_name ; ?></option>
         <?php  } else {?>
              <option value="<?php echo $list->group_id ; ?>"><?php echo $list->group_name ; ?></option>
            
          <?php } } ?>
        </select>
      </div>
      
      <div class="fix"></div>
    </div>
    <?php 
	if($user->group_id == 1 || $user->group_id == 2 )
	{
		$style  = 'style="display:none;" ';
    }
	else if($user->group_id == 3 || $user->group_id == 4 || $user->group_id == 5)
	{
	    $style  = 'style="display:block;" ';		
    }
	else
	{
	 $style  = '';	
    }
	
	
	?>
   <div id="land_group" <?php echo $style ; ?> > 
      <div class="rowElem noborder">
      <label>Sub Division:</label>
      <div class="formRight">
        <select name="tehsil_id" id="tehsil" onchange="get_qanungoi_circle();">
          <option value=""> - - - - - - Select - - - - - -</option>
          <?php foreach($subdivision_list as $sub_list) {?>
         <?php
		        if( $user_level['tehsil'] == $sub_list->tehsil_id )
				{ ?>
                <option value="<?php echo $sub_list->tehsil_id; ?>" selected="selected" ><?php echo $sub_list->tehsil_name; ?></option>  
			<?php    } else { ?>
          <option value="<?php echo $sub_list->tehsil_id; ?>"><?php echo $sub_list->tehsil_name; ?></option>
          <?php }} ?>
        </select>
      </div>
        <?php 
	if($user->group_id == 4 || $user->group_id == 5)
	{
		$style2  = 'style="display:block;" ';
    }
	else
	{
	    $style2  = 'style="display:none;" ';
	}
	?>
    <span id="qon" <?php echo $style2 ;?> >
      <label>Qanungoi Circle:</label>
      <div class="formRight" >
        <select name="q_id" id="qanungoi"  onchange="get_patwar_circle();"  >
          <option value=""> - - - - - - Select - - - - - -</option>
          <?php foreach($qanungoicircle_list as $qg_list) {?>
             <?php
		        if( $user_level['qanungoi'] == $qg_list->q_id )
				{ ?>
              <option value="<?php echo $qg_list->q_id; ?>" selected="selected" ><?php echo $qg_list->q_circle; ?></option>
          <?php    } else { ?>
           <option value="<?php echo $qg_list->q_id; ?>"><?php echo $qg_list->q_circle; ?></option>
          <?php } } ?>
        </select>
      </div>
     </span>
      <div class="fix"></div>
    </div>
            <?php 
	if($user->group_id == 5)
	{
		$style3  = 'style="display:block;" ';
    }
	else
	{
	    $style3  = 'style="display:none;" ';
	}
	?>
     <div id="patwar" <?php echo $style3 ;?>>
      <div class="rowElem noborder">
     <label>Patwar Circle:</label>
      <div class="formRight">
        <select name="p_id" id="patwar_circle" onchange="get_mauza();" >
          <option value="">- - - - - - - Select- - - - - - </option>
          <?php foreach($patwarcircle_list as $pc_list) {?>
            <?php
		        if( $user_level['patwar'] == $pc_list->p_id )
				{ ?>
          <option value="<?php echo $pc_list->p_id; ?>" selected="selected"><?php echo $pc_list->patwar_circle; ?></option>
           <?php    } else { ?>
           <option value="<?php echo $pc_list->p_id; ?>"><?php echo $pc_list->patwar_circle; ?></option>
          <?php } } ?>
        </select>
      </div>
   
      <label></label>
      <div class="formRight" >
      </div>
      <div class="fix"></div>
    </div>
    </div>
    
    </div>
  <div class="rowElem  noborder">
      <label>Username:</label>
      <div class="formRight">
        <input type="text" name="username"   value="<?php echo $user->username; ?>"/>
      </div>
      <label>Email:</label>
      <div class="formRight">
        <input type="text" name="email"   value="<?php echo $user->email; ?>"/>
      </div>
      <div class="fix"></div>
    </div>
    
     <div class="rowElem  noborder">
      <label>Password:</label>
      <div class="formRight">
        <input type="password" name="password"   value=""/>
      </div>
      <label>Confirm Password:</label>
      <div class="formRight">
        <input type="password" name="passconf"   value=""/>
      </div>
      <div class="fix"></div>
     </div>
    
      <div class="rowElem  noborder">
      <label>Mobile:</label>
      <div class="formRight">
        <input type="text" name="mobile"   value="<?php echo $user->phone_number; ?>"/>
      </div>
      <label>Block:</label>
      <div class="formRight">
           <select name="active" id="active" >
          <option value="1" <?php if( $user->block == 1){ echo 'selected="selected"';}else{ echo '';}  ?> >Yes</option>
          <option value="0" <?php if( $user->block == 0){ echo 'selected="selected"';}else{ echo '';}  ?>>No</option>
        </select>
      </div>
      <div class="fix"></div>
    </div>
 
    <div class="rowElem ">
      <h3> User's Permissions </h3>
    </div>
    <div class="fix"></div>
    <div class="rowElem ">
    <?php
	 $permission = array();
	 foreach($user_permission as $list){
		 if($list->status == 1 ){
		      $permission[] =  $list->user_roll;
			 }
		} 
		
		?>
        
    
      <table id="permissions_table">

        <tr class="permissions_label">
          <td colspan="5">Litigation</td>
        </tr>
        <tr class="permissions_content" >
          <td><input id="litigation_view" type="checkbox" value="litigation_view" name="chkpermission[]"  
          <?php if(in_array('litigation_view',$permission)) { echo 'checked="checked"'; } ?> >
            View </td>
          <td><input id="litigation_add" type="checkbox" value="litigation_add" name="chkpermission[]"
          <?php if(in_array('litigation_add',$permission)) { echo 'checked="checked"'; } ?>>
            Add </td>
          <td><input id="litigation_edit" type="checkbox" value="litigation_edit" name="chkpermission[]"
          <?php if(in_array('litigation_edit',$permission)) { echo 'checked="checked"'; } ?> >
            Edit </td>
            <td><input id="litigation_update" type="checkbox" value="litigation_update" name="chkpermission[]"
             <?php if(in_array('litigation_update',$permission)) { echo 'checked="checked"'; } ?> >
            Update </td>
          <td><input id="litigation_delete" type="checkbox" value="litigation_delete" name="chkpermission[]"
          <?php if(in_array('litigation_delete',$permission)) { echo 'checked="checked"'; } ?> >
            Delete </td>
        </tr>
         <tr class="permissions_label">
          <td colspan="5">Property</td>
        </tr>
        <tr class="permissions_content" >
          <td><input id="property_view" type="checkbox" value="property_view" name="chkpermission[]"
          <?php if(in_array('property_view',$permission)) { echo 'checked="checked"'; } ?>>
            View </td>
          <td><input id="property_add" type="checkbox" value="property_add" name="chkpermission[]"
          <?php if(in_array('property_add',$permission)) { echo 'checked="checked"'; } ?>>
            Add </td>
          <td><input id="property_edit" type="checkbox" value="property_edit" name="chkpermission[]"
          <?php if(in_array('property_edit',$permission)) { echo 'checked="checked"'; } ?>>
            Edit </td>
          <td><input id="property_delete" type="checkbox" value="property_delete" name="chkpermission[]"
          <?php if(in_array('property_delete',$permission)) { echo 'checked="checked"'; } ?>>
            Delete </td>
            <td></td>
        </tr>
          <tr class="permissions_label">
          <td colspan="5">Users</td>
        </tr>
        <tr class="permissions_content" >
          <td><input id="users_view" type="checkbox" value="users_view" name="chkpermission[]"
           <?php if(in_array('users_view',$permission)) { echo 'checked="checked"'; } ?>>
            View </td>
          <td><input id="users_add" type="checkbox" value="users_add" name="chkpermission[]"
           <?php if(in_array('users_add',$permission)) { echo 'checked="checked"'; } ?>>
            Add </td>
          <td><input id="users_edit" type="checkbox" value="users_edit" name="chkpermission[]"
           <?php if(in_array('users_edit',$permission)) { echo 'checked="checked"'; } ?>>
            Edit </td>
          <td><input id="users_delete" type="checkbox" value="users_delete" name="chkpermission[]"
           <?php if(in_array('users_delete',$permission)) { echo 'checked="checked"'; } ?>>
            Delete </td>
          <td><input id="users_log" type="checkbox" value="users_log" name="chkpermission[]"
           <?php if(in_array('users_log',$permission)) { echo 'checked="checked"'; } ?>>
           User Log </td>
        </tr> 
          
        <tr class="permissions_label">
          <td colspan="5">Dak Pad</td>
        </tr>
        
        <tr class="permissions_content" >
          <td><input id="dak_view" type="checkbox" value="dak_view" name="chkpermission[]"
           <?php if(in_array('dak_view',$permission)) { echo 'checked="checked"'; } ?>>
            View </td>
          <td><input id="dak_add" type="checkbox" value="dak_add" name="chkpermission[]"
           <?php if(in_array('dak_add',$permission)) { echo 'checked="checked"'; } ?>>
            Add </td>
          <td><input id="dak_note" type="checkbox" value="dak_note" name="chkpermission[]"
           <?php if(in_array('dak_note',$permission)) { echo 'checked="checked"'; } ?>>
            Add Note </td>
          <td><input id="dak_delete" type="checkbox" value="dak_delete" name="chkpermission[]"
           <?php if(in_array('dak_delete',$permission)) { echo 'checked="checked"'; } ?>>
            Delete </td>
          <td><input id="dak_archive" type="checkbox" value="dak_archive" name="chkpermission[]"
           <?php if(in_array('dak_archive',$permission)) { echo 'checked="checked"'; } ?>>
           Archive </td>
        </tr> 
         <tr class="permissions_content" >
          <td colspan="5"><input id="dak_print" type="checkbox" value="dak_print" name="chkpermission[]"
           <?php if(in_array('dak_print',$permission)) { echo 'checked="checked"'; } ?>>
            Print 
         </td>
        </tr> 
        
        <tr class="permissions_label">
          <td colspan="5">Laws</td>
        </tr>       
        <tr class="permissions_content" >
          <td><input id="law_view" type="checkbox" value="law_view" name="chkpermission[]"
           <?php if(in_array('law_view',$permission)) { echo 'checked="checked"'; } ?>>
            View </td>
          <td><input id="law_add" type="checkbox" value="law_add" name="chkpermission[]"
           <?php if(in_array('law_add',$permission)) { echo 'checked="checked"'; } ?>>
            Add </td>
          <td><input id="law_edit" type="checkbox" value="law_edit" name="chkpermission[]"
           <?php if(in_array('law_edit',$permission)) { echo 'checked="checked"'; } ?>>
            Edit </td>
          <td><input id="law_delete" type="checkbox" value="law_delete" name="chkpermission[]"
           <?php if(in_array('law_delete',$permission)) { echo 'checked="checked"'; } ?>>
            Delete </td>          
        </tr>         
      </table>
    </div>
    <div class="fix"></div>
    <div class="rowElem">
      <div style="width:247px; margin:10px auto 0;">
        <?php
           $attributes = array('class' => 'basicBtn forms_button' );
            echo anchor('users','Cancel',$attributes);
       ?>
        <input type="hidden" name="user_id"   value="<?php echo $user->user_id; ?>"/>
        <input type="submit" value="Submit" class="basicBtn submitForm" />
      </div>
      <div class="fix"></div>
    </div>
    <div class="fix"></div>
  </div>
</fieldset>
<div class="fix"></div>
</form>
