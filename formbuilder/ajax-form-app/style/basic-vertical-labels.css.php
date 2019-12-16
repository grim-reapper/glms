<?php
header("Content-Type: text/css");

$form_id = (isSet($_GET['form_id'])) ? $_GET['form_id'] : '';

if($form_id == '') exit;
?>
/* 
Credits: Bit Repository
*/

#<?php echo $form_id; ?>_wrap { position: relative; background-color: white; text-align:left; margin-bottom: 20px; margin-left: auto; margin-right: auto; font-family: Verdana; font-size: 12px; padding: 10px; border: 0px none; color:black; }
#<?php echo $form_id; ?>_wrap h1 { background: url("../images/icon-mail.png") no-repeat scroll 0 50% white; font-family: "Myriad Pro",Arial,Helvetica,Tahoma,sans-serif; font-size: 19px; font-weight: lighter; height: 32px; margin: 17px 0; padding-left: 63px; text-align: left; }

#<?php echo $form_id; ?>_wrap .wrap { position: relative; margin: 0px 0 10px 0; }

#<?php echo $form_id; ?>_wrap .no_clear { clear:none; }
#<?php echo $form_id; ?>_wrap .small { float:left; width:auto; margin: 0 15px 0 0; }

#<?php echo $form_id; ?>_afb_note { display:none; }

#<?php echo $form_id; ?>_wrap .afb_notification_ok { line-height:19px; -moz-border-radius: 5px 5px 5px 5px; background: url("../images/icon-button-ok.png") no-repeat scroll 14px 35% #F5F9FD; height: auto; margin: 0 0 10px; padding: 8px 0 8px 46px; text-align: left; }
#<?php echo $form_id; ?>_wrap .afb_notification_error { line-height:19px; -moz-border-radius:5px 5px 5px 5px; background-color:  #FDF4F5; height:auto; margin:0 0 10px; padding:8px 0 8px 11px; text-align:left; }

#<?php echo $form_id; ?>_wrap .afb_debug { border:1px solid #BF3030; padding: 5px; -moz-border-radius:4px; margin: 10px 0 10px 0; }

#<?php echo $form_id; ?>_wrap .afb_hide { display:none; }

#<?php echo $form_id; ?>_afb_fields div.escts { padding:10px 0; clear:both; }

div.clear { clear:both; }

#<?php echo $form_id; ?>_afb_fields div.parent { margin: 0 0 10px 0; clear:left; }

/* Label */
#<?php echo $form_id; ?>_afb_fields label.escts { width: auto; padding-left: 0px; margin: 8px 19px 8px 1px; text-align: right; float: none; font-weight:normal !important; }
#<?php echo $form_id; ?>_afb_fields .afb_labelfor { float: none; padding:0 0 0 5px; padding: 5px 0 0 5px; text-align: left; font-weight:normal !important; }

/* Input, Textarea, Select */
#<?php echo $form_id; ?>_afb_fields input.text, textarea, select { -moz-box-shadow: 0 0 3px #eeeeee; background:-moz-linear-gradient(top, #ffffff, #eeeeee 1px, #ffffff 5px); margin: 5px 5px 5px 0; padding: 2px; }
#<?php echo $form_id; ?>_afb_fields input.text, select { background-color: #fefefe; float: none; border: 1px solid #cdcdcd; color: #333333; -moz-border-radius: 3px; }
#<?php echo $form_id; ?>_afb_fields textarea { background-color: #fefefe; width: 300px; height:auto; padding: 2px; float: none; border: 1px solid #cdcdcd; color: #333333; -moz-border-radius: 3px; }

#<?php echo $form_id; ?>_afb_fields input.larger, #<?php echo $form_id; ?>_afb_fields select.larger { width:177px; }

/* Checkbox */
#<?php echo $form_id; ?>_afb_fields input.chck { cursor: pointer; top: 0 !important; clear:both; float:left; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }
#<?php echo $form_id; ?>_afb_fields input.rad { cursor: pointer; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }

#<?php echo $form_id; ?>_afb_fields input.afb_error { border: 1px solid #F3CCBE; }
#<?php echo $form_id; ?>_afb_fields input.afb_chck_error { border: 1px solid #F3CCBE; }
#<?php echo $form_id; ?>_afb_fields input.afb_rad_error { border: 1px solid #F3CCBE; }

#<?php echo $form_id; ?>_afb_fields select.afb_error { border: 1px solid #F3CCBE; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_error { border: 1px solid #F3CCBE; }

#<?php echo $form_id; ?>_afb_fields input.afb_ok { border: 1px solid #B9E7AE; }
#<?php echo $form_id; ?>_afb_fields select.afb_ok { border: 1px solid #B9E7AE; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_ok { border: 1px solid #B9E7AE; }

#<?php echo $form_id; ?>_afb_fields div.afb_error { font-size: 11px; color: red; margin: 0px 0px 15px 0px; width: auto; text-align: left; padding: 0px; clear: both; }

/* Checkboxes */
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area { display:block; list-style:none outside none; margin:5px 0 5px; padding:0; }
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; float:left; clear:both; }

#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col { display: block; float: left; margin: 0 0 15px 0; font-family: Verdana; font-size: 12px; color:black; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul { float: none; list-style:none outside none; margin:5px 0 5px; display: block; padding: 0 25px 0 0; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

/* Radios */
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area { display:block; list-style:none outside none; margin:5px 0 5px; padding:0; }
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col { display: block; float: left; margin: 0 0 15px 0; font-family: Verdana; font-size: 12px; color:black; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul { float: none; list-style:none outside none; margin:5px 0 5px; display: block; padding: 0 25px 0 0; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

/* Submit Button */
#<?php echo $form_id; ?>_afb_fields .afb_button { cursor: pointer !important; width: auto; background: white url('../images/icon-send-mail.png') no-repeat scroll 11px 50% !important; border-color:#EDEDED #999999 #999999 #EDEDED !important; border-style:solid !important; border-width:1px !important; color: #333333 !important; padding: 6px 6px 8px 32px !important; -moz-border-radius: 3px !important; }

/* br */
#<?php echo $form_id; ?>_afb_fields br { clear: left; margin: -5px; padding:0; }

/* The icon used to reload the CATPCHA */
#<?php echo $form_id; ?>_afb_icon_refresh { margin: 0 0 7px 0 !important; }

img.afb_captcha_vertical { margin: 0; border: 1px solid #e7e7e7; -moz-border-radius: 3px; }

#<?php echo $form_id; ?>_afb_captcha_div { float:left; margin: 3px 0 0 0; }
#<?php echo $form_id; ?>_afb_captcha_refresh { display:none; }

#<?php echo $form_id; ?>_afb_input_box_div { float:left; }

/* CAPTCHA Verified */
#<?php echo $form_id; ?>_afb_verified { background: url("../images/icon-tick-circle-frame.png") no-repeat scroll 0 47% white; color: green; margin: 0 0 10px 0; padding: 2px 0 0 23px !important; min-height: 16px !important; }
#<?php echo $form_id; ?>_afb_verified .ok { margin: 0px; } 

/* A CAPTCHA DIV */

#<?php echo $form_id; ?>_afb_main_sec_div { clear:both; }

#<?php echo $form_id; ?>_afb_sec_div { float: left; }
#<?php echo $form_id; ?>_afb_sec_div_two { float: left; clear:both; display: none; margin: 5px 0 5px 0; }

#<?php echo $form_id; ?>_afb_ajax_loading { margin: 16px 0 21px -4px; padding: 0 0 0 29px; display: none; float:left; width:324px; background: white url('../images/icon-ajax-loader.gif') no-repeat scroll 8px 66%; }

/* Highlight Rows */
#<?php echo $form_id; ?>_afb_fields .afb_highlighted { background-color: #FFFFEF; }

/* Style the error messages */
#<?php echo $form_id; ?>_afb_fields .afb_styled { font-style: italic; }

/* Style for DatePicker */
.ui-widget { font-size: 13px !important; }
.ui-datepicker { font-size:13px !important; z-index: 99999 !important; }

.afp_wrap { margin:0 0 10px; }

/* simple css-based tooltip */
.tooltip {
    background-color:white;
    border:1px solid #cdcdcd;
    padding:10px 15px;
    width:200px;
    display:none;
    text-align:left;
}