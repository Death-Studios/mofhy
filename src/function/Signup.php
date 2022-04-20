<?php
require __DIR__.'/Connect.php';
require __DIR__.'/CryptoLib.php';
require_once __DIR__.'/../handler/AreaHandler.php';
if(isset($_POST['signup'])){
	$FormData = array(
		'fname' => mysqli_real_escape_string($connect, $_POST['first']),
		'lname' => mysqli_real_escape_string($connect, $_POST['last']),
		'email' => mysqli_real_escape_string($connect, $_POST['email']),
		'password' => hash('sha256', $_POST['password']),
		'date' => date('d-m-Y'),
		'key' => substr(str_shuffle('qwertyuioplkjhgfdsazxcvbnm012345789QWERTYUIOPLKJHGFDSAZXCVBNM'), 0, 8),
		'verification' => hash("ripemd128", $_POST['email']),
		'cookie' => $string = \IcyApril\CryptoLib::randomString(32)
	);
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_email`= ? OR `hosting_client_key`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("ss", $FormData['email'], $FormData['key']);
	$stmt -> execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	$stmt -> close();
	if($rows>0){
		$_SESSION['message'] = '<div class="alert alert-danger" role="alert"> The email is already in use.</div>';
		header('location: ../login');
		exit;
	}
	else{
	    $zero = 0;
		$sql = "INSERT INTO `hosting_clients`(`hosting_client_fname`, `hosting_client_lname`, `hosting_client_email`, `hosting_client_key`, `hosting_client_date`, `hosting_client_status`, `hosting_client_password`, `hosting_client_verification`, `hosting_client_cookie`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $connect->prepare($sql);
		$stmt -> bind_param("sssssisss", $FormData['fname'], $FormData['lname'], $FormData['email'], $FormData['key'], $FormData['date'], $zero, $FormData['password'], $FormData['verification'],$FormData['cookie'] );
		$trigger = $stmt -> execute();
		$error = $stmt->error;
		$stmt -> close();
		$Link = "https://".$_SERVER['HTTP_HOST']."/activateUser?type=activate&signature=".$FormData['verification'];
		$cYear = date('Y');
		$EmailTo = [['email' => $FormData['email']]];
		$Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <meta http-equiv="x-ua-compatible" content="ie=edge"> <meta name="x-apple-disable-message-reformatting"> <meta name="viewport" content="width=device-width, initial-scale=1"> <meta name="format-detection" content="telephone=no, date=no, address=no, email=no"> <style type="text/css"> body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.p-lg-10:not(table),.p-lg-10:not(.btn)>tbody>tr>td,.p-lg-10.btn td a{padding:0 !important}.p-3:not(table),.p-3:not(.btn)>tbody>tr>td,.p-3.btn td a{padding:12px !important}.p-6:not(table),.p-6:not(.btn)>tbody>tr>td,.p-6.btn td a{padding:24px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-4>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-6>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-10>tbody>tr>td{font-size:40px !important;line-height:40px !important;height:40px !important}}</style> </head> <body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc"> <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc"> <tbody> <tr> <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc"> <table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"> <tbody> <tr> <td align="center" style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;"> <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto;"> <tbody> <tr> <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left"> <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"> <tbody> <tr> <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40"> &#160; </td></tr></tbody> </table> <table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;"> <tbody> <tr> <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left"> <a href="https://'.$AreaInfo['area_url'].'" target="_blank" rel="noopener noreferrer"> <img src="https://assets.mofhy.tk/img/logo.png" style="height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;" alt="'.$AreaInfo['area_name'].' Logo"> </a> </td></tr></tbody> </table> <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"> <tbody> <tr> <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40"> &#160; </td></tr></tbody> </table> <table class="card p-6 p-lg-10 space-y-4" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff"> <tbody> <tr> <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 40px;" align="left" bgcolor="#ffffff"> <h1 class="h3 fw-700" style="padding-top: 0; padding-bottom: 0; font-weight: 700 !important; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;" align="left"> Greetings, </h1> <table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"> <tbody> <tr> <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left" width="100%" height="16"> &#160; </td></tr></tbody> </table> <p class="" style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left"> Welcome &#127881;! Please click on the following button to verify your account and access all our services without interruption! </p><table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"> <tbody> <tr> <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left" width="100%" height="16"> &#160; </td></tr></tbody> </table> <table class="btn btn-success p-3 fw-700 ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; font-weight: 700 !important; margin: 0 auto;"> <tbody> <tr> <td style="line-height: 24px; font-size: 16px; border-radius: 6px; font-weight: 700 !important; margin: 0;" align="center" bgcolor="#198754"> <a href="'.$Link.'" style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 3px; line-height: 20px; display: block; font-weight: 700 !important; white-space: nowrap; background-color: #22BC66; padding: 12px; border: 1px solid #22BC66;">Verify Email Address</a> </td></tr></tbody> </table> </td></tr></tbody> </table> <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"> <tbody> <tr> <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;" align="left" width="100%" height="24"> &#160; </td></tr></tbody> </table> <div class="text-muted text-center" style="color: #718096;" align="center"> &#169; '.$cYear.' '.$AreaInfo['area_name'].'. All Rights Reserved. </div><table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"> <tbody> <tr> <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;" align="left" width="100%" height="24"> &#160; </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </body></html>';
			$Email = array(
				'subject' => 'Verify Your Email Address',
				'body' => $Body
			);
			include __DIR__.'/../handler/EmailHandler';
		if($trigger !== false){
			$_SESSION['message'] = '<div class="alert alert-success" role="alert">Your account has been created!</div>';
			header('location: ../login');
		}
		else{
			$_SESSION['message'] = '<div class="alert alert-danger" role="alert"> '.$error.'</div>';
			header('location: ../signup');
 		}
   }
  }
else{
	header('location: ../signup');
}
?>
