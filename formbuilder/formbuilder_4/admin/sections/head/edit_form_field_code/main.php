<script type="text/javascript" src="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/js/bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="<?php echo $conf['url']['path_to_afp_admin']; ?>includes/css/bootstrap/bootstrap.css" />

<style>
#update_fields_values_btn { font-size: 15px !important; width:210px; }

#add-validation-type { height:528px; width: 390px; display:none; }

#add-field { display:none; }

#add-attribute { height:528px; width: 390px; display:none; }

#add-option { display:none; }
#add-option-attribute { display:none; }

button { padding:7px; }

label { display:block; cursor: pointer; margin: 5px 0 5px; }

input[type=checkbox], input[type=radio] { cursor:pointer; }

select { margin: 5px 0; }
textarea { margin: 5px 0; }

.new_field { display:block; margin: 5px 0 10px; }
input.text { margin-bottom:12px; width:95%; }
fieldset { padding:0 !important; border:0 !important; margin-top:25px !important; }        

.ui-state-disabled { opacity: 1; cursor: text !important; }

.ui-sortable-placeholder { border: 1px dashed #cdcdcd; visibility: visible !important; height: 50px !important; }
.ui-sortable-placeholder * { visibility: hidden; }

.list_row_selected { background-color: #FBD1D3 !important; }

.option_id_checkbox { cursor:pointer; }

#options_controls { margin:10px; }
</style>

<script type="text/javascript">

    // When the document is ready set up our sortable with it's inherant function(s)
    jQuery(document).ready(function($) { // When DOM is ready
        
        // Readme for Field Attributes
        $('#readme_field_attributes').click(function() {
            $('#field_attributes_desc').slideToggle('fast');
            return false;
        });

        // Readme for Field Options
        $('#readme_field_options').click(function() {
            $('#field_options_desc').slideToggle('fast');
            return false;
        });

        /* Accept only numeric values */
        $('.numeric').keyup(function() {
            $(this).val( $(this).val().replace(/[^\d]+/, '') ); 
        });  

        <?php
        // 'Validation' JavaScript Code
        include 'for-validation.php';

        // 'Attribute' JavaScript Code
        include 'for-attribute.php';

        // 'Option' JavaScript Code
        include 'for-option.php';
        ?>

        $('#update_fields_values_btn').click(function() {
            $('input[name=action]').val('update');
            document.getElementById('update_data').submit();
        });
    });          
</script>