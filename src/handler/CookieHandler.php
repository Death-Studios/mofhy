<?php
if(isset($_COOKIE['LEFSESS'])){
	$cookie = hex2bin($_COOKIE['LEFSESS']);
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_email`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("s", $cookie);
	$stmt -> execute();
	$rows = $stmt->get_result()->num_rows;
	$fetch = $stmt->get_result()->fetch_assoc();
	$stmt -> close();
	if($rows>0){
		$ClientInfo = $fetch;
	}
	else{
		setcookie('LEFSESS',NULL,-1,'/');
		$_SESSION['message'] = '<div class="alert alert-danger">Your session has been expired.</div>';
		header('location: login.php');
	}
}
else{
	$_SESSION['message'] = '<div class="alert alert-danger">Your session has been expired.</div>';
	header('location: login.php');
}
?>
