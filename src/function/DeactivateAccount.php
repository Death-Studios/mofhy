<?php
require_once __DIR__.'/Connect.php';
require __DIR__.'/../handler/CookieHandler.php';
require_once __DIR__.'/../handler/AreaHandler.php';
require_once __DIR__.'/../modules/autoload.php';
use \InfinityFree\MofhClient\Client;
if(isset($_POST['submit'])){
	$FormData = array(
		'username' => $_POST['account_username'],
		'key' => strtolower($_POST['account_key']),
		'reason' => $_POST['reason']
	);
	$client = Client::create();
	$request = $client->suspend([
	'username' => $FormData['key'],
	'reason' => $FormData['reason'],
	]);
	$response = $request->send();
	$Data = $response->getData();
	$Result = array(
		'status' => $Data['result']['status'],
		'message' => $Data['result']['statusmsg']
	);
	if($Result['status'] == 0 && !is_array($Result['message'])){
		$_SESSION['message'] = '<div class="alert alert-danger">'.$Result['message'].'</div>';
		header('location: ../viewAccount?account_id='.$FormData['username']);
		exit;
	} elseif($Result['status'] == 1 && is_array($Result['message'])){
		$zero = 0;
		$sql = "UPDATE `hosting_account` SET `account_status`= ? WHERE `account_username`= ?";
		$stmt = $connect->prepare($sql);
		$stmt -> bind_param("is", $zero, $FormData['username']);
		$trigger = $stmt->execute();
		if($trigger !== false){
			$EmailTo = [['email' => $ClientInfo['hosting_client_email']]];
			$Body = "
				<div class='container' style='margin-left:5%;margin-right:5%;margin-top:5%;'>
				<div style='border-radius:1px solid grey;border-radius:5px;box-shadow:1px 1px 5px grey;padding:20px;font-family: Arial, Helvetica, sans-serif;'>
				<h2 style='text-align:center;color:skyblue;'><b>Account Deactivated</b></h2><hr>
				<h3>Hi ".$ClientInfo['hosting_client_fname'].",</h3><p>We had a good time with you while you were with us. Your account(".$FormData['username'].") have been deactivate successfully and all files and database will be deleted within 30 days.</p><br>
				<p>After you login to your account you can use any services ❤</p>
				<p>Regards ".$AreaInfo['area_name']."</p>
				<hr>
				<h4 style='text-align:center;'><b>Need our help?</b></h4><p style='text-align:center'><a href='".$AreaInfo['area_url']."newticket.php' style='color:skyblue;text-decoration:none;margin:0;'>We are here to help you out!</a></p>
				</div>
				</div>";
			$Email = array(
				'subject' => 'Deactivate Account',
				'body' => $Body
			);
			include __DIR__.'/../handler/EmailHandler.php';
				$_SESSION['message'] = "<div class='alert alert-success'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-circle-check alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><path d='M9 12l2 2l4 -4'></path></svg><span class='alert-title'>Success!</span><span> The account has been deactivated successfully! Thanks for using our service!</span></b>
										</div>";
				header('location: ../viewAccount?account_id='.$FormData['username']);
				exit;
			}
			else{
				$_SESSION['message'] = "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-alert-circle alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12.01' y2='16'></line></svg><span class='alert-title'> Oops!</span> Something is going the wrong way. Please contact support!</div>";
				header('location: ../settings?account_id='.$FormData['username']);
				exit;
			}
	} elseif($Result['status']==0 && $Result['message']==0){
		$_SESSION['message'] = "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-alert-circle alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12.01' y2='16'></line></svg><span class='alert-title'> Oops!</span> Something is going the wrong way. Please contact support!</div>";
		header('location: ../settings?account_id='.$FormData['username']);
		exit;
	}
}
else{
	header('location: ../');
}
?>
