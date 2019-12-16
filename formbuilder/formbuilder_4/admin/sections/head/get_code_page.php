<script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/zclip/jquery.zclip.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($) { // When DOM is ready
    $('.copy_to_clipboard').bind('focus click', function() {        
        $(this).parent().parent().find('textarea:first').select();
    });
    
    $('.copy_to_clipboard').zclip({
        path: '<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/zclip/ZeroClipboard.swf',
        copy: function() { 
            return $(this).parent().parent().find('textarea:first').val()
        },
        afterCopy: function() {
            
        }
    });
});
</script>