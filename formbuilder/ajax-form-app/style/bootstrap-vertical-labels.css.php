<?php
header("Content-Type: text/css");
            
$form_id = (isSet($_GET['form_id'])) ? $_GET['form_id'] : '';
            
if($form_id == '') exit;
?>

/* 
Credits: Bit Repository
*/

#<?php echo $form_id; ?>_wrap { position: relative; background-color: white; text-align:left; margin-bottom: 20px; margin-left: auto; margin-right: auto; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px; border: 0px none; color:black; }
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
#<?php echo $form_id; ?>_afb_fields label.escts { display: inline; width: auto; padding-left: 0px; margin: 8px 19px 8px 1px; text-align: right; float: none; font-weight:normal !important; }

#<?php echo $form_id; ?>_afb_fields label.afb_labelfor { float: left !important; padding: 0 0 7px 5px !important; margin:0 !important; text-align: left !important;  }

/* Input, Textarea, Select */
#<?php echo $form_id; ?>_afb_fields input.text, textarea, select { -moz-box-shadow: 0 0 3px #eeeeee; background:-moz-linear-gradient(top, #ffffff, #eeeeee 1px, #ffffff 5px); }
#<?php echo $form_id; ?>_afb_fields input.text, select { background-color: #fefefe; float: none; border: 1px solid #cdcdcd; color: #333333; -moz-border-radius: 3px; }
#<?php echo $form_id; ?>_afb_fields textarea { background-color: #fefefe; width: 300px; height:auto; padding: 2px; float: none; border: 1px solid #cdcdcd; color: #333333; -moz-border-radius: 3px; }

/* Checkbox */
#<?php echo $form_id; ?>_afb_fields input.chck { float:left; cursor: pointer; top: 0 !important; clear:both; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }

/* Radio */
#<?php echo $form_id; ?>_afb_fields input.rad { float:left; cursor: pointer; margin: 1px 1px 0 0 !important; padding: 2px !important; background-color:#FEFEFE !important; }

#<?php echo $form_id; ?>_afb_fields input.afb_error { border: 1px solid #F3CCBE; }
#<?php echo $form_id; ?>_afb_fields input.afb_chck_error { border: 1px solid #F3CCBE; }
#<?php echo $form_id; ?>_afb_fields input.afb_rad_error { border: 1px solid #F3CCBE; }

#<?php echo $form_id; ?>_afb_fields select.afb_error { border: 1px solid #F3CCBE; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_error { border: 1px solid #F3CCBE; }

#<?php echo $form_id; ?>_afb_fields input.afb_ok { border: 1px solid #B9E7AE; }
#<?php echo $form_id; ?>_afb_fields select.afb_ok { border: 1px solid #B9E7AE; }
#<?php echo $form_id; ?>_afb_fields textarea.afb_ok { border: 1px solid #B9E7AE; }

#<?php echo $form_id; ?>_afb_fields div.afb_error { font-size: 13px; color: red; margin: 0px 0px 15px 0px; width: auto; text-align: left; padding: 0px; clear: both; }

/* Checkboxes */
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area { display:block; list-style:none outside none; margin:5px 0 5px; padding:0; }
#<?php echo $form_id; ?>_afb_fields ul.afb_checkboxes_area li { list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; float:left; clear:both; }

#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col { display: block; float: left; margin: 0 0 15px 0; font-family: Verdana; font-size: 12px; color:black; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul { float: none; list-style:none outside none; margin:5px 0 5px; display: block; padding: 0 25px 0 0; }
#<?php echo $form_id; ?>_afb_fields div.afb_checkboxes_area_col ul li { height: 20px; list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

/* Radios */
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area { display:block; list-style:none outside none; margin:5px 0 5px; padding:0; }
#<?php echo $form_id; ?>_afb_fields ul.afb_radios_area li { height: 20px; list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col { display: block; float: left; margin: 0 0 15px 0; font-family: Verdana; font-size: 12px; color:black; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul { float: none; list-style:none outside none; margin:5px 0 5px; display: block; padding: 0 25px 0 0; }
#<?php echo $form_id; ?>_afb_fields div.afb_radios_area_col ul li { height: 20px; list-style-type: none; margin: 3px 0 3px 0; padding: 6px 0 0 5px; }

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

/* simple css-based tooltip */
.tooltip {
    background-color:white;
    border:1px solid #cdcdcd;
    padding:10px 15px;
    width:200px;
    display:none;
    text-align:left;
}

.afp_wrap { margin:0 0 10px; }

/*!
 * Bootstrap v2.1.1
 *
 * Copyright 2012 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world @twitter by @mdo and @fat.
 */
.clearfix {
  *zoom: 1;
}
.clearfix:before,
.clearfix:after {
  display: table;
  content: "";
  line-height: 0;
}
.clearfix:after {
  clear: both;
}
.hide-text {
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}
.input-block-level {
  display: block;
  width: 100%;
  min-height: 30px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.label,
.badge {
  font-size: 11.844px;
  font-weight: bold;
  line-height: 14px;
  color: #ffffff;
  vertical-align: baseline;
  white-space: nowrap;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #999999;
}
.label {
  padding: 1px 4px 2px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
.badge {
  padding: 1px 9px 2px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}
a.label:hover,
a.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.label-important,
.badge-important {
  background-color: #b94a48;
}
.label-important[href],
.badge-important[href] {
  background-color: #953b39;
}
.label-warning,
.badge-warning {
  background-color: #f89406;
}
.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
.label-success,
.badge-success {
  background-color: #468847;
}
.label-success[href],
.badge-success[href] {
  background-color: #356635;
}
.label-info,
.badge-info {
  background-color: #3a87ad;
}
.label-info[href],
.badge-info[href] {
  background-color: #2d6987;
}
.label-inverse,
.badge-inverse {
  background-color: #333333;
}
.label-inverse[href],
.badge-inverse[href] {
  background-color: #1a1a1a;
}
.btn .label,
.btn .badge {
  position: relative;
  top: -1px;
}
.btn-mini .label,
.btn-mini .badge {
  top: 0;
}
form {
  margin: 0 0 20px;
}
fieldset {
  padding: 0;
  margin: 0;
  border: 0;
}
legend {
  display: block;
  width: 100%;
  padding: 0;
  margin-bottom: 20px;
  font-size: 21px;
  line-height: 40px;
  color: #333333;
  border: 0;
  border-bottom: 1px solid #e5e5e5;
}
legend small {
  font-size: 15px;
  color: #999999;
}
label,
input,
button,
select,
textarea {
  font-size: 14px;
  font-weight: normal;
  line-height: 20px;
}
input,
button,
select,
textarea {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
label {
  display: block;
  margin-bottom: 5px;
}
select,
textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
.uneditable-input {
  display: inline-block;
  height: 20px;
  padding: 4px 6px;
  margin-bottom: 9px;
  font-size: 14px;
  line-height: 20px;
  color: #555555;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
input,
textarea,
.uneditable-input {
  width: 206px;
}
textarea {
  height: auto;
}
textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
.uneditable-input {
  background-color: #ffffff;
  border: 1px solid #cccccc;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border linear .2s, box-shadow linear .2s;
  -moz-transition: border linear .2s, box-shadow linear .2s;
  -o-transition: border linear .2s, box-shadow linear .2s;
  transition: border linear .2s, box-shadow linear .2s;
}
textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */

  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}
input[type="radio"],
input[type="checkbox"] {
  margin: 4px 0 0;
  *margin-top: 0;
  /* IE7 */

  margin-top: 1px \9;
  /* IE8-9 */

  line-height: normal;
  cursor: pointer;
}
input[type="file"],
input[type="image"],
input[type="submit"],
input[type="reset"],
input[type="button"],
input[type="radio"],
input[type="checkbox"] {
  width: auto;
}
select,
input[type="file"] {
  height: 30px;
  /* In IE7, the height of the select element cannot be changed by height, only font-size */

  *margin-top: 4px;
  /* For IE7, add top margin to align select with labels */

  line-height: 30px;
}
select {
  width: 220px;
  border: 1px solid #cccccc;
  background-color: #ffffff;
}
select[multiple],
select[size] {
  height: auto;
}
select:focus,
input[type="file"]:focus,
input[type="radio"]:focus,
input[type="checkbox"]:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.uneditable-input,
.uneditable-textarea {
  color: #999999;
  background-color: #fcfcfc;
  border-color: #cccccc;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);
  -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);
  cursor: not-allowed;
}
.uneditable-input {
  overflow: hidden;
  white-space: nowrap;
}
.uneditable-textarea {
  width: auto;
  height: auto;
}
input:-moz-placeholder,
textarea:-moz-placeholder {
  color: #999999;
}
input:-ms-input-placeholder,
textarea:-ms-input-placeholder {
  color: #999999;
}
input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
  color: #999999;
}
.radio,
.checkbox {
  min-height: 18px;
  padding-left: 18px;
}
.radio input[type="radio"],
.checkbox input[type="checkbox"] {
  float: left;
  margin-left: -18px;
}
.controls > .radio:first-child,
.controls > .checkbox:first-child {
  padding-top: 5px;
}
.radio.inline,
.checkbox.inline {
  display: inline-block;
  padding-top: 5px;
  margin-bottom: 0;
  vertical-align: middle;
}
.radio.inline + .radio.inline,
.checkbox.inline + .checkbox.inline {
  margin-left: 10px;
}
.input-mini {
  width: 60px;
}
.input-small {
  width: 90px;
}
.input-medium {
  width: 150px;
}
.input-large {
  width: 210px;
}
.input-xlarge {
  width: 270px;
}
.input-xxlarge {
  width: 530px;
}
input[class*="span"],
select[class*="span"],
textarea[class*="span"],
.uneditable-input[class*="span"],
.row-fluid input[class*="span"],
.row-fluid select[class*="span"],
.row-fluid textarea[class*="span"],
.row-fluid .uneditable-input[class*="span"] {
  float: none;
  margin-left: 0;
}
.input-append input[class*="span"],
.input-append .uneditable-input[class*="span"],
.input-prepend input[class*="span"],
.input-prepend .uneditable-input[class*="span"],
.row-fluid input[class*="span"],
.row-fluid select[class*="span"],
.row-fluid textarea[class*="span"],
.row-fluid .uneditable-input[class*="span"],
.row-fluid .input-prepend [class*="span"],
.row-fluid .input-append [class*="span"] {
  display: inline-block;
}
input,
textarea,
.uneditable-input {
  margin-left: 0;
}
.controls-row [class*="span"] + [class*="span"] {
  margin-left: 20px;
}
input.span12, textarea.span12, .uneditable-input.span12 {
  width: 926px;
}
input.span11, textarea.span11, .uneditable-input.span11 {
  width: 846px;
}
input.span10, textarea.span10, .uneditable-input.span10 {
  width: 766px;
}
input.span9, textarea.span9, .uneditable-input.span9 {
  width: 686px;
}
input.span8, textarea.span8, .uneditable-input.span8 {
  width: 606px;
}
input.span7, textarea.span7, .uneditable-input.span7 {
  width: 526px;
}
input.span6, textarea.span6, .uneditable-input.span6 {
  width: 446px;
}
input.span5, textarea.span5, .uneditable-input.span5 {
  width: 366px;
}
input.span4, textarea.span4, .uneditable-input.span4 {
  width: 286px;
}
input.span3, textarea.span3, .uneditable-input.span3 {
  width: 206px;
}
input.span2, textarea.span2, .uneditable-input.span2 {
  width: 126px;
}
input.span1, textarea.span1, .uneditable-input.span1 {
  width: 46px;
}
.controls-row {
  *zoom: 1;
}
.controls-row:before,
.controls-row:after {
  display: table;
  content: "";
  line-height: 0;
}
.controls-row:after {
  clear: both;
}
.controls-row [class*="span"] {
  float: left;
}
input[disabled],
select[disabled],
textarea[disabled],
input[readonly],
select[readonly],
textarea[readonly] {
  cursor: not-allowed;
  background-color: #eeeeee;
}
input[type="radio"][disabled],
input[type="checkbox"][disabled],
input[type="radio"][readonly],
input[type="checkbox"][readonly] {
  background-color: transparent;
}
.control-group.warning > label,
.control-group.warning .help-block,
.control-group.warning .help-inline {
  color: #c09853;
}
.control-group.warning .checkbox,
.control-group.warning .radio,
.control-group.warning input,
.control-group.warning select,
.control-group.warning textarea {
  color: #c09853;
}
.control-group.warning input,
.control-group.warning select,
.control-group.warning textarea {
  border-color: #c09853;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
.control-group.warning input:focus,
.control-group.warning select:focus,
.control-group.warning textarea:focus {
  border-color: #a47e3c;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;
}
.control-group.warning .input-prepend .add-on,
.control-group.warning .input-append .add-on {
  color: #c09853;
  background-color: #fcf8e3;
  border-color: #c09853;
}
.control-group.error > label,
.control-group.error .help-block,
.control-group.error .help-inline {
  color: #b94a48;
}
.control-group.error .checkbox,
.control-group.error .radio,
.control-group.error input,
.control-group.error select,
.control-group.error textarea {
  color: #b94a48;
}
.control-group.error input,
.control-group.error select,
.control-group.error textarea {
  border-color: #b94a48;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
.control-group.error input:focus,
.control-group.error select:focus,
.control-group.error textarea:focus {
  border-color: #953b39;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;
}
.control-group.error .input-prepend .add-on,
.control-group.error .input-append .add-on {
  color: #b94a48;
  background-color: #f2dede;
  border-color: #b94a48;
}
.control-group.success > label,
.control-group.success .help-block,
.control-group.success .help-inline {
  color: #468847;
}
.control-group.success .checkbox,
.control-group.success .radio,
.control-group.success input,
.control-group.success select,
.control-group.success textarea {
  color: #468847;
}
.control-group.success input,
.control-group.success select,
.control-group.success textarea {
  border-color: #468847;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
.control-group.success input:focus,
.control-group.success select:focus,
.control-group.success textarea:focus {
  border-color: #356635;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;
}
.control-group.success .input-prepend .add-on,
.control-group.success .input-append .add-on {
  color: #468847;
  background-color: #dff0d8;
  border-color: #468847;
}
.control-group.info > label,
.control-group.info .help-block,
.control-group.info .help-inline {
  color: #3a87ad;
}
.control-group.info .checkbox,
.control-group.info .radio,
.control-group.info input,
.control-group.info select,
.control-group.info textarea {
  color: #3a87ad;
}
.control-group.info input,
.control-group.info select,
.control-group.info textarea {
  border-color: #3a87ad;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
.control-group.info input:focus,
.control-group.info select:focus,
.control-group.info textarea:focus {
  border-color: #2d6987;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;
}
.control-group.info .input-prepend .add-on,
.control-group.info .input-append .add-on {
  color: #3a87ad;
  background-color: #d9edf7;
  border-color: #3a87ad;
}
input:focus:required:invalid,
textarea:focus:required:invalid,
select:focus:required:invalid {
  color: #b94a48;
  border-color: #ee5f5b;
}
input:focus:required:invalid:focus,
textarea:focus:required:invalid:focus,
select:focus:required:invalid:focus {
  border-color: #e9322d;
  -webkit-box-shadow: 0 0 6px #f8b9b7;
  -moz-box-shadow: 0 0 6px #f8b9b7;
  box-shadow: 0 0 6px #f8b9b7;
}
.form-actions {
  padding: 19px 20px 20px;
  margin-top: 20px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border-top: 1px solid #e5e5e5;
  *zoom: 1;
}
.form-actions:before,
.form-actions:after {
  display: table;
  content: "";
  line-height: 0;
}
.form-actions:after {
  clear: both;
}
.help-block,
.help-inline {
  color: #595959;
}
.help-block {
  display: block;
  margin-bottom: 10px;
}
.help-inline {
  display: inline-block;
  *display: inline;
  /* IE7 inline-block hack */

  *zoom: 1;
  vertical-align: middle;
  padding-left: 5px;
}
.input-append,
.input-prepend {
  margin-bottom: 5px;
  font-size: 0;
  white-space: nowrap;
}
.input-append input,
.input-prepend input,
.input-append select,
.input-prepend select,
.input-append .uneditable-input,
.input-prepend .uneditable-input {
  position: relative;
  margin-bottom: 0;
  *margin-left: 0;
  font-size: 14px;
  vertical-align: top;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
}
.input-append input:focus,
.input-prepend input:focus,
.input-append select:focus,
.input-prepend select:focus,
.input-append .uneditable-input:focus,
.input-prepend .uneditable-input:focus {
  z-index: 2;
}
.input-append .add-on,
.input-prepend .add-on {
  display: inline-block;
  width: auto;
  height: 20px;
  min-width: 16px;
  padding: 4px 5px;
  font-size: 14px;
  font-weight: normal;
  line-height: 20px;
  text-align: center;
  text-shadow: 0 1px 0 #ffffff;
  background-color: #eeeeee;
  border: 1px solid #ccc;
}
.input-append .add-on,
.input-prepend .add-on,
.input-append .btn,
.input-prepend .btn {
  vertical-align: top;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.input-append .active,
.input-prepend .active {
  background-color: #a9dba9;
  border-color: #46a546;
}
.input-prepend .add-on,
.input-prepend .btn {
  margin-right: -1px;
}
.input-prepend .add-on:first-child,
.input-prepend .btn:first-child {
  -webkit-border-radius: 3px 0 0 3px;
  -moz-border-radius: 3px 0 0 3px;
  border-radius: 3px 0 0 3px;
}
.input-append input,
.input-append select,
.input-append .uneditable-input {
  -webkit-border-radius: 3px 0 0 3px;
  -moz-border-radius: 3px 0 0 3px;
  border-radius: 3px 0 0 3px;
}
.input-append .add-on,
.input-append .btn {
  margin-left: -1px;
}
.input-append .add-on:last-child,
.input-append .btn:last-child {
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
}
.input-prepend.input-append input,
.input-prepend.input-append select,
.input-prepend.input-append .uneditable-input {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.input-prepend.input-append .add-on:first-child,
.input-prepend.input-append .btn:first-child {
  margin-right: -1px;
  -webkit-border-radius: 3px 0 0 3px;
  -moz-border-radius: 3px 0 0 3px;
  border-radius: 3px 0 0 3px;
}
.input-prepend.input-append .add-on:last-child,
.input-prepend.input-append .btn:last-child {
  margin-left: -1px;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
}
input.search-query {
  padding-right: 14px;
  padding-right: 4px \9;
  padding-left: 14px;
  padding-left: 4px \9;
  /* IE7-8 doesn't have border-radius, so don't indent the padding */

  margin-bottom: 0;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
}
/* Allow for input prepend/append in search forms */
.form-search .input-append .search-query,
.form-search .input-prepend .search-query {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.form-search .input-append .search-query {
  -webkit-border-radius: 14px 0 0 14px;
  -moz-border-radius: 14px 0 0 14px;
  border-radius: 14px 0 0 14px;
}
.form-search .input-append .btn {
  -webkit-border-radius: 0 14px 14px 0;
  -moz-border-radius: 0 14px 14px 0;
  border-radius: 0 14px 14px 0;
}
.form-search .input-prepend .search-query {
  -webkit-border-radius: 0 14px 14px 0;
  -moz-border-radius: 0 14px 14px 0;
  border-radius: 0 14px 14px 0;
}
.form-search .input-prepend .btn {
  -webkit-border-radius: 14px 0 0 14px;
  -moz-border-radius: 14px 0 0 14px;
  border-radius: 14px 0 0 14px;
}
.form-search input,
.form-inline input,
.form-horizontal input,
.form-search textarea,
.form-inline textarea,
.form-horizontal textarea,
.form-search select,
.form-inline select,
.form-horizontal select,
.form-search .help-inline,
.form-inline .help-inline,
.form-horizontal .help-inline,
.form-search .uneditable-input,
.form-inline .uneditable-input,
.form-horizontal .uneditable-input,
.form-search .input-prepend,
.form-inline .input-prepend,
.form-horizontal .input-prepend,
.form-search .input-append,
.form-inline .input-append,
.form-horizontal .input-append {
  display: inline-block;
  *display: inline;
  /* IE7 inline-block hack */

  *zoom: 1;
  margin-bottom: 0;
  vertical-align: middle;
}
.form-search .hide,
.form-inline .hide,
.form-horizontal .hide {
  display: none;
}
.form-search label,
.form-inline label,
.form-search .btn-group,
.form-inline .btn-group {
  display: inline-block;
}
.form-search .input-append,
.form-inline .input-append,
.form-search .input-prepend,
.form-inline .input-prepend {
  margin-bottom: 0;
}
.form-search .radio,
.form-search .checkbox,
.form-inline .radio,
.form-inline .checkbox {
  padding-left: 0;
  margin-bottom: 0;
  vertical-align: middle;
}
.form-search .radio input[type="radio"],
.form-search .checkbox input[type="checkbox"],
.form-inline .radio input[type="radio"],
.form-inline .checkbox input[type="checkbox"] {
  float: left;
  margin-right: 3px;
  margin-left: 0;
}
.control-group {
  margin-bottom: 10px;
}
legend + .control-group {
  margin-top: 20px;
  -webkit-margin-top-collapse: separate;
}
.form-horizontal .control-group {
  margin-bottom: 20px;
  *zoom: 1;
}
.form-horizontal .control-group:before,
.form-horizontal .control-group:after {
  display: table;
  content: "";
  line-height: 0;
}
.form-horizontal .control-group:after {
  clear: both;
}
.form-horizontal .control-label {
  float: left;
  width: 160px;
  padding-top: 5px;
  text-align: right;
}
.form-horizontal .controls {
  *display: inline-block;
  *padding-left: 20px;
  margin-left: 180px;
  *margin-left: 0;
}
.form-horizontal .controls:first-child {
  *padding-left: 180px;
}
.form-horizontal .help-block {
  margin-bottom: 0;
}
.form-horizontal input + .help-block,
.form-horizontal select + .help-block,
.form-horizontal textarea + .help-block {
  margin-top: 10px;
}
.form-horizontal .form-actions {
  padding-left: 180px;
}
.btn {
  display: inline-block;
  *display: inline;
  /* IE7 inline-block hack */

  *zoom: 1;
  padding: 4px 14px;
  margin-bottom: 0;
  font-size: 14px;
  line-height: 20px;
  *line-height: 20px;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  color: #333333;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
  background-color: #f5f5f5;
  background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
  background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #e6e6e6;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  border: 1px solid #bbbbbb;
  *border: 0;
  border-bottom-color: #a2a2a2;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  *margin-left: .3em;
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.btn:hover,
.btn:active,
.btn.active,
.btn.disabled,
.btn[disabled] {
  color: #333333;
  background-color: #e6e6e6;
  *background-color: #d9d9d9;
}
.btn:active,
.btn.active {
  background-color: #cccccc \9;
}
.btn:first-child {
  *margin-left: 0;
}
.btn:hover {
  color: #333333;
  text-decoration: none;
  background-color: #e6e6e6;
  *background-color: #d9d9d9;
  /* Buttons in IE7 don't get borders, so darken on hover */

  background-position: 0 -15px;
  -webkit-transition: background-position 0.1s linear;
  -moz-transition: background-position 0.1s linear;
  -o-transition: background-position 0.1s linear;
  transition: background-position 0.1s linear;
}
.btn:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.btn.active,
.btn:active {
  background-color: #e6e6e6;
  background-color: #d9d9d9 \9;
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.btn.disabled,
.btn[disabled] {
  cursor: default;
  background-color: #e6e6e6;
  background-image: none;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
}
.btn-large {
  padding: 9px 14px;
  font-size: 16px;
  line-height: normal;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}
.btn-large [class^="icon-"] {
  margin-top: 2px;
}
.btn-small {
  padding: 3px 9px;
  font-size: 12px;
  line-height: 18px;
}
.btn-small [class^="icon-"] {
  margin-top: 0;
}
.btn-mini {
  padding: 2px 6px;
  font-size: 11px;
  line-height: 17px;
}
.btn-block {
  display: block;
  width: 100%;
  padding-left: 0;
  padding-right: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.btn-block + .btn-block {
  margin-top: 5px;
}
input[type="submit"].btn-block,
input[type="reset"].btn-block,
input[type="button"].btn-block {
  width: 100%;
}
.btn-primary.active,
.btn-warning.active,
.btn-danger.active,
.btn-success.active,
.btn-info.active,
.btn-inverse.active {
  color: rgba(255, 255, 255, 0.75);
}
.btn {
  border-color: #c5c5c5;
  border-color: rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.25);
}
.btn-primary {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #006dcc;
  background-image: -moz-linear-gradient(top, #0088cc, #0044cc);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
  background-image: -webkit-linear-gradient(top, #0088cc, #0044cc);
  background-image: -o-linear-gradient(top, #0088cc, #0044cc);
  background-image: linear-gradient(to bottom, #0088cc, #0044cc);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0044cc', GradientType=0);
  border-color: #0044cc #0044cc #002a80;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #0044cc;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
.btn-primary:hover,
.btn-primary:active,
.btn-primary.active,
.btn-primary.disabled,
.btn-primary[disabled] {
  color: #ffffff;
  background-color: #0044cc;
  *background-color: #003bb3;
}
.btn-primary:active,
.btn-primary.active {
  background-color: #003399 \9;
}
.btn-warning {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #faa732;
  background-image: -moz-linear-gradient(top, #fbb450, #f89406);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fbb450), to(#f89406));
  background-image: -webkit-linear-gradient(top, #fbb450, #f89406);
  background-image: -o-linear-gradient(top, #fbb450, #f89406);
  background-image: linear-gradient(to bottom, #fbb450, #f89406);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffbb450', endColorstr='#fff89406', GradientType=0);
  border-color: #f89406 #f89406 #ad6704;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #f89406;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
.btn-warning:hover,
.btn-warning:active,
.btn-warning.active,
.btn-warning.disabled,
.btn-warning[disabled] {
  color: #ffffff;
  background-color: #f89406;
  *background-color: #df8505;
}
.btn-warning:active,
.btn-warning.active {
  background-color: #c67605 \9;
}
.btn-danger {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #da4f49;
  background-image: -moz-linear-gradient(top, #ee5f5b, #bd362f);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#bd362f));
  background-image: -webkit-linear-gradient(top, #ee5f5b, #bd362f);
  background-image: -o-linear-gradient(top, #ee5f5b, #bd362f);
  background-image: linear-gradient(to bottom, #ee5f5b, #bd362f);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffee5f5b', endColorstr='#ffbd362f', GradientType=0);
  border-color: #bd362f #bd362f #802420;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #bd362f;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
.btn-danger:hover,
.btn-danger:active,
.btn-danger.active,
.btn-danger.disabled,
.btn-danger[disabled] {
  color: #ffffff;
  background-color: #bd362f;
  *background-color: #a9302a;
}
.btn-danger:active,
.btn-danger.active {
  background-color: #942a25 \9;
}
.btn-success {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #5bb75b;
  background-image: -moz-linear-gradient(top, #62c462, #51a351);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
  background-image: -webkit-linear-gradient(top, #62c462, #51a351);
  background-image: -o-linear-gradient(top, #62c462, #51a351);
  background-image: linear-gradient(to bottom, #62c462, #51a351);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
  border-color: #51a351 #51a351 #387038;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #51a351;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
.btn-success:hover,
.btn-success:active,
.btn-success.active,
.btn-success.disabled,
.btn-success[disabled] {
  color: #ffffff;
  background-color: #51a351;
  *background-color: #499249;
}
.btn-success:active,
.btn-success.active {
  background-color: #408140 \9;
}
.btn-info {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #49afcd;
  background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
  background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);
  background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);
  background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
  border-color: #2f96b4 #2f96b4 #1f6377;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #2f96b4;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
.btn-info:hover,
.btn-info:active,
.btn-info.active,
.btn-info.disabled,
.btn-info[disabled] {
  color: #ffffff;
  background-color: #2f96b4;
  *background-color: #2a85a0;
}
.btn-info:active,
.btn-info.active {
  background-color: #24748c \9;
}
.btn-inverse {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #363636;
  background-image: -moz-linear-gradient(top, #444444, #222222);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#444444), to(#222222));
  background-image: -webkit-linear-gradient(top, #444444, #222222);
  background-image: -o-linear-gradient(top, #444444, #222222);
  background-image: linear-gradient(to bottom, #444444, #222222);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff444444', endColorstr='#ff222222', GradientType=0);
  border-color: #222222 #222222 #000000;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  *background-color: #222222;
  /* Darken IE7 buttons by default so they stand out more given they won't have borders */

  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
.btn-inverse:hover,
.btn-inverse:active,
.btn-inverse.active,
.btn-inverse.disabled,
.btn-inverse[disabled] {
  color: #ffffff;
  background-color: #222222;
  *background-color: #151515;
}
.btn-inverse:active,
.btn-inverse.active {
  background-color: #080808 \9;
}
button.btn,
input[type="submit"].btn {
  *padding-top: 3px;
  *padding-bottom: 3px;
}
button.btn::-moz-focus-inner,
input[type="submit"].btn::-moz-focus-inner {
  padding: 0;
  border: 0;
}
button.btn.btn-large,
input[type="submit"].btn.btn-large {
  *padding-top: 7px;
  *padding-bottom: 7px;
}
button.btn.btn-small,
input[type="submit"].btn.btn-small {
  *padding-top: 3px;
  *padding-bottom: 3px;
}
button.btn.btn-mini,
input[type="submit"].btn.btn-mini {
  *padding-top: 1px;
  *padding-bottom: 1px;
}
.btn-link,
.btn-link:active,
.btn-link[disabled] {
  background-color: transparent;
  background-image: none;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
}
.btn-link {
  border-color: transparent;
  cursor: pointer;
  color: #0088cc;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.btn-link:hover {
  color: #005580;
  text-decoration: underline;
  background-color: transparent;
}
.btn-link[disabled]:hover {
  color: #333333;
  text-decoration: none;
}
.alert {
  padding: 8px 35px 8px 14px;
  margin-bottom: 20px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  color: #c09853;
}
.alert h4 {
  margin: 0;
}
.alert .close {
  position: relative;
  top: -2px;
  right: -21px;
  line-height: 20px;
}
.alert-success {
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
}
.alert-danger,
.alert-error {
  background-color: #f2dede;
  border-color: #eed3d7;
  color: #b94a48;
}
.alert-info {
  background-color: #d9edf7;
  border-color: #bce8f1;
  color: #3a87ad;
}
.alert-block {
  padding-top: 14px;
  padding-bottom: 14px;
}
.alert-block > p,
.alert-block > ul {
  margin-bottom: 0;
}
.alert-block p + p {
  margin-top: 5px;
}