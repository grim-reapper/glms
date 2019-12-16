<?php
header("Content-Type: text/css");

$form_id = (isSet($_GET['form_id'])) ? $_GET['form_id'] : '';

if($form_id == '') exit;
?>
/* 
Credits: Bit Repository
*/

#<?php echo $form_id; ?>_wrap { position: relative; background-color: white; text-align:left; line-height:normal; margin-bottom: 20px; margin-left: auto; margin-right: auto; font-family: Verdana !important; font-size: 12px !important; padding: 10px; border: 0px none !important; color:black !important; }
#<?php echo $form_id; ?>_wrap h1 { width: 47%; background: url("../images/icon-mail.png") no-repeat scroll 35% 42% white; font-family: "Myriad Pro",Arial,Helvetica,Tahoma,sans-serif; font-size: 19px; font-weight: lighter; height: 27px; margin: 17px 0; padding-left: 188px; }

#<?php echo $form_id; ?>_afb_note { display:none; }


#<?php echo $form_id; ?>_wrap .wrap { position: relative; margin: 0px 0 10px 0; }

#<?php echo $form_id; ?>_wrap .no_clear { clear:none; }
#<?php echo $form_id; ?>_wrap .small { float:left; width:auto; margin: 0 15px 0 0; }
#<?php echo $form_id; ?>_wrap .small div { float:left; }

#<?php echo $form_id; ?>_wrap .afb_notification_ok { width: 88%; line-height:19px; margin: 0 0 5px 0 !important; background: url("../images/icon-button-ok.png") no-repeat scroll 13px 29% #F5F9FD !important; height: auto !important; padding: 3px 0 9px 42px !important; text-align: left !important; -moz-border-radius: 5px !important; }
#<?php echo $form_id; ?>_wrap .afb_notification_error { width: 94%; line-height:19px; -moz-border-radius:5px 5px 5px 5px !important; background-color:  #FDF4F5 !important; height:auto !important; margin:0 0 10px !important; padding:8px 0 8px 11px !important; text-align:left !important; }

#<?php echo $form_id; ?>_wrap .afb_debug { border:1px solid #BF3030 !important; padding: 5px !important; -moz-border-radius:4px !important; margin: 10px 0 10px 0 !important; }

#<?php echo $form_id; ?>_wrap .afb_hide { display:none; }

#<?php echo $form_id; ?>_afb_fields .label_zone { text-align:right; float:left; min-width:120px; margin: 9px 0 0; }
#<?php echo $form_id; ?>_afb_fields .field_zone { float:left; width:auto; }

#<?php echo $form_id; ?>_afb_fields div.escts { padding: 10px 0 0 0 !important; }

#<?php echo $form_id; ?>_afb_fields div.parent { min-height: 40px; }

#<?php echo $form_id; ?>_afb_fields div.afp_wrap { clear:both; }
/* Label */
#<?php echo $form_id; ?>_afb_fields label { font-weight: normal !important; margin: 8px 19px 8px 0 !important; padding-left: 0 !important; text-align: right !important; }
#<?php echo $form_id; ?>_afb_fields label.escts { width: auto !important; padding-left: 0px !important; margin: 8px 19px 8px 1px !important; text-align: right !important; float: none !important; font-weight:normal !important; }
#<?php echo $form_id; ?>_afb_fields .afb_labelfor { float: none !important; padding:0 0 0 5px !important; margin:0 !important; text-align: left !important; }

/* Input, Textarea, Select */
#<?php echo $form_id; ?>_afb_fields input.text, textarea, select { -moz-box-shadow: 0 0 3px #eeeeee !important; background:-moz-linear-gradient(top, #ffffff, #eeeeee 1px, #ffffff 5px) !important; margin: 5px 5px 5px 0 !important; padding: 2px !important; }
#<?php echo $form_id; ?>_afb_fields input.text, select { background-color: #fefefe !important; float: none !important; border: 1px solid #dedede !important; color: #333333 !important; -moz-border-radius: 3px !important; }
#<?php echo $form_id; ?>_afb_fields textarea { background-color: #fefefe !important; width: 285px !important; height:auto; padding: 2px !important; float: none !important; border: 1px solid #dedede !important; color: #333333 !important; -moz-border-radius: 3px !important; }

#<?php echo $form_id; ?>_afb_fields input.larger, #<?php echo $form_id; ?>_afb_fields select.larger { width:177px; }

/* Checkbox */
#<?php echo $form_id; ?>_afb_fields input.chck { cursor: pointer;  margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }
#<?php echo $form_id; ?>_afb_fields input.rad { cursor: pointer; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }

#<?php echo $form_id; ?>_afb_fields input.afb_error { border: 1px solid #F3CCBE !important; }
#<?php echo $form_id; ?>_afb_fields input.afb_chck_error { border: 1px solid #F3CCBE !important; }
#<?php echo $form_id; ?>_afb_fields input.afb_rad_error { border: 1px solid #F3CCBE !important; }

#<?php echo $form_id; ?>_afb_fields select.afb_error { border: 1px solid #F3CCBE !important; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_error { border: 1px solid #F3CCBE !important; }

#<?php echo $form_id; ?>_afb_fields input.afb_ok { border: 1px solid #B9E7AE !important; }
#<?php echo $form_id; ?>_afb_fields select.afb_ok { border: 1px solid #B9E7AE !important; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_ok { border: 1px solid #B9E7AE !important; }

#<?php echo $form_id; ?>_afb_fields div.afb_error { float: none !important; clear:both; color:red; font-style:normal; margin:0 0 6px 0; text-align: left; font-size: 11px; }

/* Checkboxes */
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area { list-style:none outside none !important; margin:5px 0 5px !important; padding:2px !important; }
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area li { list-style-type: none !important; margin: 3px 0 3px 0 !important; padding: 6px 0 0 5px !important; }

#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col { float: left !important; font-family: Verdana !important; font-size: 12px !important; color:black !important; padding:2px !important; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul { float: none !important; list-style:none outside none !important; margin:5px 0 5px !important; padding: 0 25px 0 0 !important; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul li { list-style-type: none !important; margin: 3px 0 3px 0 !important; padding: 6px 0 0 5px !important; }

/* Radios */
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area { list-style:none outside none !important; margin:5px 0 5px !important; padding:2px !important; }
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area li { list-style-type: none !important; margin: 3px 0 3px 0 !important; padding: 6px 0 0 5px !important; }

#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col { float: left !important; font-family: Verdana !important; font-size: 12px !important; color:black !important; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul { float: none !important; list-style:none outside none !important; margin:5px 0 5px !important; padding: 0 25px 0 0 !important; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul li { list-style-type: none !important; margin: 3px 0 3px 0 !important; padding: 6px 0 0 5px !important; }

div.spacer { margin: 5px 0; }

/* Submit Button */
#<?php echo $form_id; ?>_afb_fields .afb_button { cursor: pointer !important; width: auto; background: white url('../images/icon-send-mail.png') no-repeat scroll 11px 50% !important; border-color:#EDEDED #999999 #999999 #EDEDED !important; border-style:solid !important; border-width:1px !important; color: #333333 !important; padding: 6px 6px 8px 32px !important; -moz-border-radius: 3px !important; }

div.clear { clear:both; }

/* br */
#<?php echo $form_id; ?>_afb_fields br { clear: left !important; margin: -5px !important; padding:0 !important; }

/* The icon used to reload the CATPCHA */
#<?php echo $form_id; ?>_afb_icon_refresh { margin: 0 0 7px 0 !important; }

#<?php echo $form_id; ?>_afb_captcha { border: 1px solid #e7e7e7 !important; -moz-border-radius: 3px; }

#<?php echo $form_id; ?>_afb_captcha_div { float:left; margin: 5px 0 0 0; }

#<?php echo $form_id; ?>_afb_captcha_refresh { display:none; }

#<?php echo $form_id; ?>_afb_input_box_div { float:left !important; }

/* CAPTCHA Verified */
#<?php echo $form_id; ?>_afb_verified { background:url('../images/icon-tick-circle-frame.png') no-repeat scroll 0 47% white !important; color:green !important; margin: 0 0 10px 0; min-height:23px !important; padding:8px 0 0 23px !important; }
#<?php echo $form_id; ?>_afb_verified .ok { margin: 0px; } 

/* A CAPTCHA DIV */
#<?php echo $form_id; ?>_afb_sec_div { float: left !important; }

#<?php echo $form_id; ?>_afb_sec_div_two { float: left !important; display: none; margin: 0 !important; }

#<?php echo $form_id; ?>_afb_ajax_loading { margin: 16px 0 21px -4px; padding: 0 0 0 29px; display: none; float:left; width:auto; background: white url('../images/icon-ajax-loader.gif') no-repeat scroll 8px 66%; }

/* Highlight Rows */
#<?php echo $form_id; ?>_afb_fields div.afb_highlighted { background-color: #FFFFEF !important; }

/* Style the error messages */
#<?php echo $form_id; ?>_afb_fields div.afb_styled { font-style: normal; }

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