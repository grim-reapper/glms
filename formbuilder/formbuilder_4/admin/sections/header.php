<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Gabriel Comarita" />

	<title>AJAX Form Pro: Admin Panel</title>
 
    <script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/jquery-1.7.1.min.js"></script> 
    <script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/jquery-ui-1.7.1.custom.min.js"></script>
    <link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/css/ui-css/themes/base/jquery.ui.all.css" />
    
    <link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/css/style.css" />
    
    <!-- Formalize -->    
    <script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/formalize/assets/js/jquery.formalize.js"></script>
    <link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/formalize/assets/css/formalize.css" />     
    
    <?php if( ($edit_config_page == 1) || ($edit_form_fields_page == 1) ) { ?>
  
    	<script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/ui/jquery.ui.core.js"></script>
    	<script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/ui/jquery.ui.widget.js"></script>
    
    	<script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/ui/jquery.ui.mouse.js"></script>
    	<script src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/ui/jquery.ui.sortable.js"></script>
    <?php } 
     
    if($edit_config_page == 1) {
        include 'head/edit_form_config_code.php';
    }
    
    if($edit_form_fields_page == 1) {
        include 'head/edit_form_fields_code.php';
    }
    
    if($edit_form_field_page == 1) {
        include 'head/edit_form_field_code/main.php';        
    }
    
    if($manage_forms_page == 1) {
        include 'head/manage_forms_code.php';
    }

    if($get_code_page == 1) {
        include 'head/get_code_page.php';
    }
    
    if($manage_webmasters_page == 1) {
        include 'head/manage_webmasters_code.php';
    }

    if($manage_templates_page == 1) {
        include 'head/manage_templates_code.php';
    }
    
    if($manage_messages_page == 1) {
        include 'head/manage_messages_code.php';
    }    

    if($faq_page == 1) {
        include 'head/faq_code.php';
    } 
    
    if($maintenance_page == 1) {
        include 'head/maintenance_code.php';
    }
    ?>
    
    <link href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/css/fancy-buttons.css" rel="stylesheet" type="text/css" />

<style type="text/css">
#popitmenu {
position: absolute;
background-color: white;
border:1px solid #cdcdcd;
font: normal 12px Verdana;
line-height: 18px;
z-index: 100;
visibility: hidden;
padding: 6px 5px 6px;
}

#popitmenu a {
text-decoration: none;
padding: 6px 6px 6px 29px;
color:#2A4480;
display: block;
}

#popitmenu a:hover{ /* hover background color */
background-color: #D0DBF4;
}

</style>

<script type="text/javascript">

/***********************************************
* Pop-it menu- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var defaultMenuWidth = 'auto'; // Set default menu width.

var linkset = new Array();
// SPECIFY MENU SETS AND THEIR LINKS. FOLLOW SYNTAX LAID OUT

linkset[0]  = '<a class="change_password" href="<?php echo $conf['url']['path_to_afp_admin'].'change_password.php'; ?>">Change Password</a>';
linkset[0] += '<a class="change_email" href="<?php echo $conf['url']['path_to_afp_admin'].'change_email.php'; ?>">Change E-Mail</a>';
linkset[0] += '<a class="change_security_key" href="<?php echo $conf['url']['path_to_afp_admin'].'change_security_key.php'; ?>">Change Security Key</a>';

linkset[1]  = '<a class="add_form" href="<?php echo $conf['url']['path_to_afp_admin'].'add_form.php'; ?>">Add New</a>';
linkset[1] += '<a class="default_configs" href="<?php echo $conf['url']['path_to_afp_admin'].'edit_default_configs.php'; ?>">Default Form Configs</a>';
linkset[1] += '<a class="list" href="<?php echo $conf['url']['path_to_afp_admin'].'manage_forms.php'; ?>">View List</a>';

<?php
// Code for "Manage Forms" page
if($manage_forms_page == 1) {
    foreach($forms as $valoare) {
        $form_id = $valoare['id'];
        $form_title = $valoare['name'];
    ?>
        linkset[<?php echo ($form_id + 10); ?>]  = '<a class="clone" rel="<?php echo $form_id; ?>" title="<?php echo $form_title; ?>" href="#">Clone</a>';
        linkset[<?php echo ($form_id + 10); ?>] += '<a class="delete_f" rel="<?php echo $form_id; ?>" title="<?php echo $form_title; ?>" href="#">Delete</a>';
    <?php
    }
}

// Code for "Manage Messages" page
if($manage_messages_page == 1) {
    foreach($messages as $valoare) {
        $message_id = $valoare['id'];
    ?>
        linkset[<?php echo ($message_id + 10); ?>]  = '<a href="#" class="edit" rel="<?php echo $message_id; ?>">Edit Message</a>';
        linkset[<?php echo ($message_id + 10); ?>] += '<a href="manage_messages.php?form_id=<?php echo $form_id; ?>&action=show_submitted_fields&message_id=<?php echo $message_id; ?>#row_id_<?php echo $message_id; ?>" class="edit_list">Edit Submitted Fields</a>';
        linkset[<?php echo ($message_id + 10); ?>] += '<a href="#" class="del_msg" rel="<?php echo $message_id; ?>">Delete</a>';
    <?php
    }    
}
?>

// No need to edit beyond here

var ie5 = document.all && !window.opera;
var ns6 = document.getElementById;

if (ie5||ns6) {
    document.write('<div id="popitmenu" onMouseover="clearhidemenu();" onMouseout="dynamichide(event)"></div>');
}

function iecompattest() {
    return (document.compatMode && document.compatMode.indexOf("CSS") != -1) ? document.documentElement : document.body;
}

function showmenu(e, which, optWidth){
if (!document.all&&!document.getElementById)
return
clearhidemenu()
menuobj=ie5? document.all.popitmenu : document.getElementById("popitmenu");
menuobj.innerHTML=which
menuobj.style.width=(typeof optWidth!="undefined")? optWidth : defaultMenuWidth
menuobj.contentwidth=menuobj.offsetWidth
menuobj.contentheight=menuobj.offsetHeight
eventX=ie5? event.clientX : e.clientX
eventY=ie5? event.clientY : e.clientY

// Find out how close the mouse is to the corner of the window
var rightedge=ie5? iecompattest().clientWidth-eventX : window.innerWidth-eventX
var bottomedge=ie5? iecompattest().clientHeight-eventY : window.innerHeight-eventY
// if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<menuobj.contentwidth)
// move the horizontal position of the menu to the left by it's width
menuobj.style.left=ie5? iecompattest().scrollLeft+eventX-menuobj.contentwidth+"px" : window.pageXOffset+eventX-menuobj.contentwidth+"px"
else
// position the horizontal position of the menu where the mouse was clicked
menuobj.style.left=ie5? iecompattest().scrollLeft+eventX+"px" : window.pageXOffset+eventX+"px"
// same concept with the vertical position
if (bottomedge<menuobj.contentheight)
menuobj.style.top=ie5? iecompattest().scrollTop+eventY-menuobj.contentheight+"px" : window.pageYOffset+eventY-menuobj.contentheight+"px"
else
menuobj.style.top=ie5? iecompattest().scrollTop+event.clientY+"px" : window.pageYOffset+eventY+"px"
menuobj.style.visibility="visible"
return false
}

function contains_ns6(a, b) {
// Determines if 1 element in contained in another- by Brainjar.com
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function hidemenu(){
    if (window.menuobj) {
        menuobj.style.visibility = "hidden";
    }
}

function dynamichide(e){
    if (ie5 && !menuobj.contains(e.toElement)) {
        hidemenu();
    }
    else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget)) {
        hidemenu();
    }
}

function delayhidemenu(){
    delayhide = setTimeout("hidemenu()", 500);
}

function clearhidemenu(){
    if (window.delayhide) {
        clearTimeout(delayhide);
    }
}

if (ie5 || ns6) {
    document.onclick = hidemenu;
}

jQuery(document).ready(function($) { // When DOM is ready

    $(".manage_forms").mouseover(function(event) {
        showmenu(event,linkset[1]);
    })
    .mouseout(delayhidemenu);

    $(".account").mouseover(function(event) {
        showmenu(event,linkset[0]);
    })
    .mouseout(delayhidemenu)
    .click(function() {
        return false;
    });

    $(".more").mouseover(function(event) {
        showmenu(event,linkset[$(this).attr('rel')]);
    })
    .mouseout(delayhidemenu)
    .click(function() {
        return false;
    });    
    
});
</script>

<script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/scrolltopcontrol.js">

/***********************************************
* Scroll To Top Control script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
    
</head>
<body>
<a name="top"></a>
<div id="afp_wrap">

<div style="margin: 0 0 0 10px;">
<a href="<?php echo $conf['url']['path_to_afp_admin']; ?>manage_forms.php"><img border="0" alt="" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/images/AFP-Logo.png" width="250" height="63" /></a>
</div>