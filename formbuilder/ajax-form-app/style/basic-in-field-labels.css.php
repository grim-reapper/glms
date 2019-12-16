<?php
            header("Content-Type: text/css");
            
            $form_id = (isSet($_GET['form_id'])) ? $_GET['form_id'] : '';
            
            if($form_id == '') exit;
            ?>
/* 
Credits: Bit Repository
*/

#<?php echo $form_id; ?>_wrap { position: relative; background-color: white; text-align:left; margin-left: auto !important; margin-right: auto !important; font-family: Verdana !important; font-size: 12px !important; padding: 10px !important; border: 0px none !important; }
#<?php echo $form_id; ?>_wrap h1 { background:url("../images/icon-mail.png") no-repeat scroll 0 47% white; font-family:"Myriad Pro",Arial,Helvetica,Tahoma,sans-serif !important; font-size:19px !important; font-weight:lighter !important; height:29px; margin:15px 0 !important; padding-left:66px; text-align:left !important; }



#<?php echo $form_id; ?>_wrap .wrap { position: relative; margin: 0px 0 10px 0; }

#<?php echo $form_id; ?>_wrap .no_clear { clear:none; }
#<?php echo $form_id; ?>_wrap .small { float:left; width:auto; margin: 0 15px 0 0; }



#<?php echo $form_id; ?>_afb_note { display:none; margin: 0 0 5px 0; }

#<?php echo $form_id; ?>_wrap .afb_notification_ok { line-height:19px; -moz-border-radius: 5px 5px 5px 5px; background: url("../images/icon-button-ok.png") no-repeat scroll 14px 35% #F5F9FD; height: auto; margin: 0 0 10px; padding: 8px 0 8px 46px; text-align: left; }
#<?php echo $form_id; ?>_wrap .afb_notification_error { line-height:19px; -moz-border-radius:5px 5px 5px 5px; background-color:  #FDF4F5; height:auto; margin:0 0 10px; padding:8px 0 8px 11px; text-align:left; }

#<?php echo $form_id; ?>_wrap .afb_debug { border:1px solid #BF3030 !important; padding: 5px !important; -moz-border-radius:4px !important; margin: 10px 0 10px 0 !important; }

#<?php echo $form_id; ?>_wrap .afb_hide { display:none; }



#<?php echo $form_id; ?>_afb_fields label.escts { width: auto !important; padding-left: 0px !important; margin: 8px 19px 8px 1px !important; text-align: right !important; float: none !important; }
#<?php echo $form_id; ?>_afb_fields .afb_labelfor { float: none !important; padding:0 0 0 5px !important; margin:0 !important; text-align: left !important; }

/* Label, Input, Textarea */

#<?php echo $form_id; ?>_afb_fields div.wrap label.in_field { color:#777777; margin:9px 5px 5px 6px; font-weight:normal; position:absolute; clear:both; }
#<?php echo $form_id; ?>_afb_fields div.wrap label.security_code { color:#777777; display:inline; margin:9px 2px 0 5px; font-weight:normal; position:absolute; }


#<?php echo $form_id; ?>_afb_fields label.afb_labelfor { font-weight:normal; position:none !important; float: none !important; padding:0 0 0 5px !important; margin:0 !important; text-align: left !important;  }

#<?php echo $form_id; ?>_afb_fields div.afp_wrap { line-height:11px !important; padding: 1px 0 1px 0px; }

#<?php echo $form_id; ?>_afb_fields div.parent { margin: 0 0 10px 0; clear:left; }

#<?php echo $form_id; ?>_afb_fields div.escts { line-height: 12px; padding: 10px 0 10px 0 !important; margin: 0 !important; min-height:17px; }
#<?php echo $form_id; ?>_afb_fields label.escts { font-weight:normal !important; width: 199px !important; padding-left: 0px !important; margin: 2px 17px 5px 0px !important; text-align: right !important; float: none !important; }

/* Input, Textarea, Select */
#<?php echo $form_id; ?>_afb_fields input.text, textarea, select { -moz-box-shadow: 0 0 3px #eeeeee; background:-moz-linear-gradient(top, #ffffff, #eeeeee 1px, #ffffff 5px); margin: 5px 5px 5px 0; padding: 2px; }
#<?php echo $form_id; ?>_afb_fields input.text, select { background-color: #fefefe; float: none; border: 1px solid #dedede; color: #333333; -moz-border-radius: 3px; }
#<?php echo $form_id; ?>_afb_fields textarea { background-color: #fefefe; width: 300px; height:auto; padding: 2px; float: none; border: 1px solid #dedede; color: #333333; -moz-border-radius: 3px; }

#<?php echo $form_id; ?>_afb_fields input.larger, #<?php echo $form_id; ?>_afb_fields select.larger { width:177px; }

/* Checkbox */
#<?php echo $form_id; ?>_afb_fields input.chck { cursor: pointer; top: 0 !important; clear:both; float:left !important; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }
#<?php echo $form_id; ?>_afb_fields input.rad { cursor: pointer; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }

#<?php echo $form_id; ?>_afb_fields input.afb_error { border: 1px solid #F3CCBE !important; }
#<?php echo $form_id; ?>_afb_fields input.afb_chck_error { border: 1px solid #F3CCBE !important; }
#<?php echo $form_id; ?>_afb_fields input.afb_rad_error { border: 1px solid #F3CCBE !important; }

#<?php echo $form_id; ?>_afb_fields select.afb_error { border: 1px solid #F3CCBE !important; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_error { border: 1px solid #F3CCBE !important; }

#<?php echo $form_id; ?>_afb_fields input.afb_ok { border: 1px solid #B2C6D5 !important; }
#<?php echo $form_id; ?>_afb_fields select.afb_ok { border: 1px solid #B2C6D5 !important; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_ok { border: 1px solid #B2C6D5 !important; }

#<?php echo $form_id; ?>_afb_fields div.afb_error { font-size: 11px !important; color: red !important; margin: 0px 0px 9px 0px !important; width: auto; text-align: left !important; padding: 0px !important; clear: both !important; }


/* Checkboxes */
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area { display:block; list-style:none outside none; margin:5px 0 5px; padding:0; }
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col { display: block; float: left; font-family: Verdana; font-size: 12px; color:black; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul { float: none; list-style:none outside none; margin:5px 0 5px; display: block; padding: 0 25px 0 0; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

/* Radios */
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area { display:block; list-style:none outside none; margin:5px 0 5px; padding:0; }
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col { display: block; float: left; font-family: Verdana; font-size: 12px; color:black; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul { float: none; list-style:none outside none; margin:5px 0 5px; display: block; padding: 0 25px 0 0; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

#<?php echo $form_id; ?>_afb_fields .fieldTitle { color: #777777 !important; }

div.spacer { margin: 3px 0 5px 0; }

/* Submit Button */
#<?php echo $form_id; ?>_afb_fields .afb_button { cursor: pointer !important; width: 152px !important; background: white url('../images/icon-send-mail.png') no-repeat scroll 11px 50% !important; color: #333333 !important; padding: 9px 1px 8px 25px !important; -moz-border-radius: 3px !important; }

/* br */
#<?php echo $form_id; ?>_afb_fields br { clear: left !important; margin: -5px !important; padding:0 !important; }

div.clear { clear:both !important; }

/* The icon used to reload the CATPCHA */
#<?php echo $form_id; ?>_afb_icon_refresh { margin: 0 0 7px 0 !important; }

#<?php echo $form_id; ?>_afb_main_sec_div { margin: 0 0 7px 0; }

#<?php echo $form_id; ?>_afb_sec_div_two { clear: both; display: none; margin: 0; }

#<?php echo $form_id; ?>_afb_captcha { border: 1px solid #e7e7e7 !important; margin:15px 0 0; -moz-border-radius: 3px; }

#<?php echo $form_id; ?>_afb_captcha_div { float:left !important; margin: -11px 0 0 !important; }

#<?php echo $form_id; ?>_afb_captcha_refresh { display:none; }

#<?php echo $form_id; ?>_afb_input_box_div { float:left !important; }

/* CAPTCHA Verified */
#<?php echo $form_id; ?>_afb_verified { float: left !important; margin: 0 0 10px 0; background: url("../images/icon-ok-blue.png") no-repeat scroll 0 47% white !important; color: #21407E !important; padding: 8px 0 7px 22px !important; min-height: 16px !important; }
#<?php echo $form_id; ?>_afb_verified .ok { margin: 0px !important; } 

/* A CAPTCHA DIV */
#<?php echo $form_id; ?>_afb_sec_div { float: left !important; }

#<?php echo $form_id; ?>_afb_ajax_loading { margin: 16px 0 21px -4px; padding: 0 0 0 29px; display: none; float:left; width:auto; background: white url('../images/icon-ajax-loader.gif') no-repeat scroll 8px 66%; }

/* Highlight Rows */
#<?php echo $form_id; ?>_afb_fields .afb_highlighted { background-color: #F7F9FF !important; }

/* Style the error messages */
#<?php echo $form_id; ?>_afb_fields .afb_styled { font-style: italic !important; }

/* Style for DatePicker */
.ui-widget { font-size: 13px !important; }
.ui-datepicker { font-size:13px !important; z-index: 99999 !important; }

/* simple css-based tooltip */
.tooltip {
    background-color:white;
    border:1px solid #cdcdcd;
    padding:10px 15px;
    width:200px;
    display:none;
    text-align:left;
}