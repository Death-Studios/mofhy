<?php
if(isset($_COOKIE['LEFSESS'])){
	$string = $_COOKIE['LEFSESS'];
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_cookie`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("s", $string);
	$stmt -> execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	$fetch = $result->fetch_assoc();
	$stmt -> close();
	if($rows>0){
		$ClientInfo = $fetch;
	}
	else{
		setcookie('LEFSESS',NULL,-1,'/');
		$_SESSION['message'] = '<div class="alert alert-danger">Your session has been expired.</div>';
		header('location: login');
	}
}
else{
	$_SESSION['message'] = '<div class="alert alert-danger">Your session has been expired.</div>';
	header('location: login');
}
?>
