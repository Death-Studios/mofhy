<?php
include __DIR__.'/Connect.php';
require __DIR__.'/../handler/SessionHandler.php';
require __DIR__.'/../../modules/autoload.php';
use \InfinityFree\MofhClient\Client;
if(isset($_POST['submit'])){
	$FormData = array(
		'new_password' => mysqli_real_escape_string($connect, $_POST['new_password']),
		'account_key' => mysqli_real_escape_string($connect, hex2bin($_POST['account_key'])),
		'account_username' => mysqli_real_escape_string($connect, $_POST['account_username']),
		'account_password' => mysqli_real_escape_string($connect, $_POST['account_password'])
	);
	if(!empty($FormData['new_password'])){
		$client = Client::create();
		$request = $client->password([
		'username' => $FormData['account_key'],
		'password' => $FormData['new_password'],
		'enabledigest' => 1,
		]);
		$response = $request->send();
		$Data = $response->getData();
		$Result = array(
			'status' => $Data['passwd']['status'],
			'message' => $Data['passwd']['statusmsg'],
			'password' => $FormData['new_password']
		);
		if($Result['status'] == 0 && strlen($Result['message'])>1){
			$_SESSION['message'] = '<div class="alert alert-danger">'.$Result['message'].'</div>';
			header('location: ../settings?account_id='.$FormData['account_username']);
			exit;
		}
		elseif($Result['status'] == 1 && strlen($Result['message'])>1){
			$sql = "UPDATE `hosting_account` SET `account_password`= ? WHERE `account_username`= ?";
			$stmt = $connect->prepare($sql);
			$stmt -> bind_param("ss", $Result['password'], $FormData['account_username']);
			$trigger = $stmt->execute();
			$error = $stmt->error;
			$stmt -> close();
			if($trigger !== false){
				$_SESSION['message'] = "<div class='alert alert-success'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-circle-check alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><path d='M9 12l2 2l4 -4'></path></svg><span class='alert-title'>Success!</span><span> The account password has been updated!</span></div>";
				header('location: ../settings?account_id='.$FormData['account_username']);
				exit;
			}
			else{
				$_SESSION['message'] = "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-alert-circle alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12.01' y2='16'></line></svg><span class='alert-title'> Error:</span> ".$error."</div>";
				header('location: ../settings?account_id='.$FormData['account_username']);
				exit;
			}
		}
		elseif($Result['status'] == 0 && $Result['message'] == 0){
			$_SESSION['message'] = "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-alert-circle alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12.01' y2='16'></line></svg><span class='alert-title'> Oops!</span> Something is going the wrong way. Please contact support!</div>";
			header('location: ../settings?account_id='.$FormData['account_username']);
			exit;
		}
	}
	else{
		$_SESSION['message'] = "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-alert-circle alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12.01' y2='16'></line></svg><span class='alert-title'> Oops!</span> The post data contained invalid information. Please contact support!</div>";
		header('location: ../settings?account_id='.$FormData['account_username']);
	}
}
else{
	header('location: ../');
}
?>