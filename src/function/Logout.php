<?php
require __DIR__.'/Connect.php';
require __DIR__.'/CryptoLib.php';
if(isset($_COOKIE['LEFSESS'])){
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_cookie` = ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("s", $_COOKIE['LEFSESS']);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_assoc();
	$stmt -> close();
	$string = \IcyApril\CryptoLib::randomString(32);
	$sql1 = "UPDATE `hosting_clients` SET `hosting_client_hash` = ? WHERE `hosting_client_email` = ?";
	$stmt = $connect->prepare($sql1);
	$stmt -> bind_param("ss", $string, $fetch['hosting_client_email']);
	$trigger = $stmt->execute();
	$stmt -> close();
	if($trigger !== false){
		setcookie('LEFSESS', 'NULL' , -1, '/');
		$_SESSION['message'] = '<div class="alert alert-success" role="alert">Your session has been cleared!</div>';
		header('location: login');
	} else{
		$_SESSION['message'] = '<div class="alert alert-danger" role="alert">Something went wrong!</div>';
		header('location: login');
	}
}
else{
	$_SESSION['message'] = '<div class="alert alert-danger" role="alert">Please login to continue to the dashboard.</div>';
	header('location: login');
}
?>
