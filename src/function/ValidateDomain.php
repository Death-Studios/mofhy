<?php
require __DIR__.'/../modules/autoload.php';
use \InfinityFree\MofhClient\Client;
if(isset($_POST['submit']) && $_POST['domainType'] == 'subdomain' && !empty($_POST['subdomain'])){
	$domain = $_POST['subdomain'] . $_POST['extension'];
	$client = Client::create();
	$request = $client->availability(['domain' => $domain]);
	$response = $request->send();
	if($response->isSuccessful() == 0 && strlen($response->getMessage())>1){
		$_SESSION['message'] = '<div class="alert alert-danger">'.$response->getMessage().'</div>';
		header("location: ../createAccount");
		exit;
	}
	elseif($response->isSuccessful() == 1 && $response->getMessage() == 1){
		$_SESSION['sudomain'] = $domain;
		$_SESSION['message'] = '<div class="alert alert-success"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg></div><div><h4 class="alert-title">Success!</h4><div>The domain '.$domain.' is available!</div></div></div></div>';
		header('location: ../createAccount?step2');
		exit;
	}
	elseif($response->isSuccessful()==0&&$response->getMessage()==0){
		$_SESSION['message'] = '<div class="alert alert-danger"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <path d="M10 10l4 4m0 -4l-4 4"></path></svg>&nbsp;Oops! This domain is already in use on the network.</div>';
		header("location: ../createAccount");
		exit;
	}
	else{
		$_SESSION['message'] = '<div class="alert alert-danger"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <path d="M10 10l4 4m0 -4l-4 4"></path></svg>&nbsp;Yikes, something is going wrong.</div>';
		header("location: ../createAccount");
		exit;
	}
} else{
	$_SESSION['message'] = '<div class="alert alert-danger"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <path d="M10 10l4 4m0 -4l-4 4"></path></svg>&nbsp;Yikes, something is going wrong.</div>';
	header("location: ../createAccount");
	exit;
}

?>
	$client = Client::create();
	$request = $client->availability(['domain' => $FormData['domain']]);
	$response = $request->send();
	if($response->isSuccessful()==0&&strlen($response->getMessage())>1){
		echo $response->getMessage();
		exit;
	}
	elseif($response->isSuccessful()==1&&$response->getMessage()==1){
		echo $FormData['domain'];
		exit;
	}
	elseif($response->isSuccessful()==0&&$response->getMessage()==0){
		echo 'Sorry! domain name already registered';
		exit;
	}
}
else{
	header('location: ../');
}