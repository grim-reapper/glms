<?php
$navigation = array(
    'manage_forms' => array(
        'class'   => 'first',
        'class-a' => 'edit manage_forms',
        'href'    => 'manage_forms.php',
        
        'text'    => 'Forms'
    ),

    'templates' => array(
        'class'   => '',
        'class-a' => 'layouts',
        'href'    => $conf['url']['path_to_afp_admin'].'manage_templates.php',
        'text'    => 'Templates'
    ), 

    'account' => array(
        'class'   => '',
        'class-a' => 'account',
        'href'    => '#',
        
        'text'    => 'Account'
    ),

    'recipients' => array(
        'class'   => '',
        'class-a' => 'recipients',
        'href'    => $conf['url']['path_to_afp_admin'].'manage_webmasters.php',
        
        'text'    => 'Recipients'
    ),

    'maintenance' => array(
        'class'   => 'last',
        'class-a' => 'maintenance',
        'href'    => $conf['url']['path_to_afp_admin'].'maintenance.php',
        
        'text'    => 'Maintenance'
    ),
    
    'faq' => array(
        'class'   => '',
        'class-a' => 'faq',
        'target'  => '_blank',
        'href'    => 'http://www.ajaxformpro.com/wiki/?cat=1',
        'text'    => 'Wiki'
    ),

    'stay_updated' => array(
        'class'   => 'last',
        'class-a' => 'stay_updated',
        'href'    => $conf['url']['path_to_afp_admin'].'stay_updated.php',
        
        'text'    => 'Stay Updated'
    )     
);

$self = basename($_SERVER['PHP_SELF']);

$manage_forms_pages = array('edit_form_config.php', 'edit_form_fields.php', 'manage_forms.php', 'add_form.php', 'edit_default_configs.php');

if(in_array($self, $manage_forms_pages)) {
    $navigation['manage_forms']['class'] = 'active';
}

if($self == 'manage_templates.php') {
    $navigation['templates']['class'] = 'active';    
}

if($self == 'change_password.php' || $self == 'change_email.php' || $self == 'change_security_key.php') {
    $navigation['account']['class'] = 'active';    
}

if($self == 'manage_webmasters.php') {
    $navigation['recipients']['class'] = 'active';    
}

if($self == 'maintenance.php') {
    $navigation['maintenance']['class'] = 'active';    
}

if($self == 'stay_updated.php') {
    $navigation['stay_updated']['class'] = 'active';    
}

if($ses->get('user_id')) {
    echo '<div style="float:right;"><a href="'.$conf['url']['path_to_afp_admin'].'logout.php"><strong>Logout</strong></a></div><div style="clear:both;"></div>';
}
?>
<div class="nav_menu">
    <ul class="menu">
        <?php
        foreach($navigation as $value) {
        ?>
            <li <?php if($value['class']) { echo 'class="'.$value['class'].'"'; } ?>><a <?php if($value['target']) { echo 'target="'.$value['target'].'"'; } ?> class="<?php echo $value['class-a']; ?>" href="<?php echo $value['href']; ?>"><b><?php echo $value['text']; ?></b></a></li>
        <?php
        }
        ?>
    </ul>
<div style="clear: both;"></div>
</div>