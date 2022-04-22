<?php
require_once __DIR__.'/../handler/AreaHandler.php';
require_once __DIR__.'/../handler/HostingHandler.php';
$one = 1;
$sql = "UPDATE `hosting_account` SET `account_status` = ? WHERE `account_username` = ?";
$stmt = $connect->prepare($sql);
$stmt -> bind_param("is", $one, $_POST['username']);
$stmt -> execute();
$stmt -> close();
$sql1 = "SELECT `account_for` FROM `hosting_account` WHERE `account_username` = ?";
$stmt = $connect->prepare($sql1);
$stmt -> bind_param("s", $_POST['username']);
$stmt -> execute();
$result = $stmt->get_result();
$id = $result->fetch_assoc();
$stmt -> close();
$sql2 = "SELECT * FROM `hosting_clients` WHERE `hosting_client_key` = ?";
$stmt = $connect->prepare($sql2);
$stmt -> bind_param("s", $id['account_for']);
$stmt -> execute();
$result1 = $stmt->get_result();
$ClientInfo = $result1->fetch_assoc();
$stmt -> close();
$EmailTo = [['email' => $ClientInfo['hosting_client_email']]];
$cYear = date("Y");
$Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <meta name="x-apple-disable-message-reformatting"/> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <meta name="color-scheme" content="light dark"/> <meta name="supported-color-schemes" content="light dark"/> <title></title> <style type="text/css" rel="stylesheet" media="all"> /* Base ------------------------------ */ @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&amp;display=swap"); body{width: 100% !important; height: 100%; margin: 0; -webkit-text-size-adjust: none;}a{color: #3869D4;}a img{border: none;}td{word-break: break-word;}.preheader{display: none !important; visibility: hidden; mso-hide: all; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden;}/* Type ------------------------------ */ body, td, th{font-family: "Nunito Sans", Helvetica, Arial, sans-serif;}h1{margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;}h2{margin-top: 0; color: #333333; font-size: 16px; font-weight: bold; text-align: left;}h3{margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: left;}td, th{font-size: 16px;}p, ul, ol, blockquote{margin: .4em 0 1.1875em; font-size: 16px; line-height: 1.625;}p.sub{font-size: 13px;}/* Utilities ------------------------------ */ .align-right{text-align: right;}.align-left{text-align: left;}.align-center{text-align: center;}/* Buttons ------------------------------ */ .button{background-color: #3869D4; border-top: 10px solid #3869D4; border-right: 18px solid #3869D4; border-bottom: 10px solid #3869D4; border-left: 18px solid #3869D4; display: inline-block; color: #FFF; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;}.button--green{background-color: #22BC66; border-top: 10px solid #22BC66; border-right: 18px solid #22BC66; border-bottom: 10px solid #22BC66; border-left: 18px solid #22BC66;}.button--red{background-color: #FF6136; border-top: 10px solid #FF6136; border-right: 18px solid #FF6136; border-bottom: 10px solid #FF6136; border-left: 18px solid #FF6136;}@media only screen and (max-width: 500px){.button{width: 100% !important; text-align: center !important;}}/* Attribute list ------------------------------ */ .attributes{margin: 0 0 21px;}.attributes_content{background-color: #F4F4F7; padding: 16px;}.attributes_item{padding: 0;}/* Related Items ------------------------------ */ .related{width: 100%; margin: 0; padding: 25px 0 0 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;}.related_item{padding: 10px 0; color: #CBCCCF; font-size: 15px; line-height: 18px;}.related_item-title{display: block; margin: .5em 0 0;}.related_item-thumb{display: block; padding-bottom: 10px;}.related_heading{border-top: 1px solid #CBCCCF; text-align: center; padding: 25px 0 10px;}/* Discount Code ------------------------------ */ .discount{width: 100%; margin: 0; padding: 24px; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #F4F4F7; border: 2px dashed #CBCCCF;}.discount_heading{text-align: center;}.discount_body{text-align: center; font-size: 15px;}/* Social Icons ------------------------------ */ .social{width: auto;}.social td{padding: 0; width: auto;}.social_icon{height: 20px; margin: 0 8px 10px 8px; padding: 0;}/* Data table ------------------------------ */ .purchase{width: 100%; margin: 0; padding: 35px 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;}.purchase_content{width: 100%; margin: 0; padding: 25px 0 0 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;}.purchase_item{padding: 10px 0; color: #51545E; font-size: 15px; line-height: 18px;}.purchase_heading{padding-bottom: 8px; border-bottom: 1px solid #EAEAEC;}.purchase_heading p{margin: 0; color: #85878E; font-size: 12px;}.purchase_footer{padding-top: 15px; border-top: 1px solid #EAEAEC;}.purchase_total{margin: 0; text-align: right; font-weight: bold; color: #333333;}.purchase_total--label{padding: 0 15px 0 0;}body{background-color: #F2F4F6; color: #51545E;}p{color: #51545E;}.email-wrapper{width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #F2F4F6;}.email-content{width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;}/* Masthead ----------------------- */ .email-masthead{padding: 25px 0; text-align: center;}.email-masthead_name{font-size: 16px; font-weight: bold; color: #A8AAAF; text-decoration: none; text-shadow: 0 1px 0 white;}/* Body ------------------------------ */ .email-body{width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;}.email-body_inner{border-radius: 5px; width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #FFFFFF;}.email-footer{width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center;}.email-footer p{color: #A8AAAF;}.body-action{width: 100%; margin: 30px auto; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center;}.body-sub{margin-top: 25px; padding-top: 25px; border-top: 1px solid #EAEAEC;}.content-cell{padding: 45px;}/*Media Queries ------------------------------ */ @media only screen and (max-width: 600px){.email-body_inner, .email-footer{width: 90% !important;}}@media (prefers-color-scheme: dark){body, .email-body, .email-content, .email-wrapper, .email-masthead, .email-footer{background-color: #333333 !important; color: #FFF !important;}.email-body_inner{background-color: #2b2b2b !important; color: #FFF !important;}p, ul, ol, blockquote, h1, h2, h3, span, .purchase_item{color: #FFF !important;}.attributes_content, .discount{background-color: #222 !important;}.email-masthead_name{text-shadow: none !important;}}:root{color-scheme: light dark; supported-color-schemes: light dark;}</style><!--[if mso]> <style type="text/css"> .f-fallback{font-family: Arial, sans-serif;}</style><![endif]--> <style type="text/css" rel="stylesheet" media="all"> body{width: 100% !important; height: 100%; margin: 0; -webkit-text-size-adjust: none;}body{font-family: "Nunito Sans", Helvetica, Arial, sans-serif;}body{background-color: #F2F4F6; color: #51545E;}</style> </head> <body style="width: 100% !important; height: 100%; -webkit-text-size-adjust: none; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; background-color: #F2F4F6; color: #51545E; margin: 0;" bgcolor="#F2F4F6"> <span class="preheader" style="display: none !important; visibility: hidden; mso-hide: all; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden;">This is preheader text. Some clients will show this text as a preview.</span> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #F2F4F6; margin: 0; padding: 0;" bgcolor="#F2F4F6"> <tr> <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 0;"> <tr> <td class="email-masthead" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: center; padding: 25px 0;" align="center"> <a href="'.$AreaInfo['area_url'].'"> <img src="https://api.mofhy.xyz/assets/logo.png" border="0"> </a> </td></tr><tr> <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="word-break: break-word; margin: 0; padding: 0; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #FFFFFF; margin: 0 auto; padding: 0;" bgcolor="#FFFFFF"> <tr> <td class="content-cell" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;"> <div class="f-fallback"> <p style="margin-top: 0; color: #333333; font-size: 16px; text-align: left;" align="left">Greetings,</p><p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Thank you for signing up with '.$AreaInfo['area_name'].'! Your hosting account will now be setup over the next few minutes and this email contains all the information you will need in order to begin using your account.</p><h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Hosting Account Details</h1> <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 0 21px;"> <tr> <td class="attributes_content" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #F4F4F7; padding: 16px;" bgcolor="#F4F4F7"> <table width="100%" cellpadding="0" cellspacing="0" role="presentation"> <tr> <td class="attributes_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;"> <span class="f-fallback"> <strong>Username:</strong> '.$_POST['username'].' </span> </td></tr><tr> <td class="attributes_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;"> <span class="f-fallback"> <strong>Password:</strong> (can be found in your client area)</span> </td></tr></table> </td></tr></table> <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Please note that it takes up to 72 hours for your domain name to start working. This is caused by DNS caching, and depends on many factors (your internet settings being the most important one).</p><table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 30px auto; padding: 0;"> <tr> <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;"> <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation"> <tr> <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;"> <a href="'.$AreaInfo['area_url'].'" class="f-fallback button" target="_blank" style="color: #FFF !important; border-color: #28a745; border-style: solid; border-width: 10px 18px; background-color: #28a745; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Check In Client Area</a> </td></tr></table> </td></tr></table> </div></td></tr></table> </td></tr><tr> <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;"> <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 0 auto; padding: 0;"> <tr> <td class="content-cell" align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;"> <p class="f-fallback sub align-center" style="font-size: 13px; line-height: 1.625; text-align: center; color: #A8AAAF; margin: .4em 0 1.1875em;" align="center">&copy; '.$cYear.' '.$AreaInfo['area_name'].'. All Rights Reserved.</p></td></tr></table> </td></tr></table> </td></tr></table> </body></html>';
$Email = array(
	'subject' => 'New Account',
	'body' => $Body
);
include __DIR__.'/../handler/EmailHandler.php';
