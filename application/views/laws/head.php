<link href="<?php echo base_url(); ?>asset/css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/wysiwyg.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.4.4.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/dataTables/colResizable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/forms/forms.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/forms/autotab.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.ToTop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.listnav.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" charset="utf-8">
 $(function() {
   $("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			
		});
   
  });
</script>
<style type="text/css">
.pp_details{ display:none;}
</style>
