<?php
require __DIR__.'/Connect.php';
require __DIR__.'/../handler/SessionHandler.php';
require '../../function/CryptoLib.php';
if(isset($_GET['client_id'])){
	$client_id = mysqli_real_escape_string($connect, $_GET['client_id']);
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_key`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("s", $client_id);
	$stmt -> execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	$fetch = $result->fetch_assoc();
	$stmt -> close();
	if($rows>0){
		$Data = $fetch;
		$string = \IcyApril\CryptoLib::randomString(32);
		$sql1 = "UPDATE `hosting_clients` SET `hosting_client_cookie` = ? WHERE `hosting_client_email` = ?";
		$stmt = $connect->prepare($sql1);
		$stmt -> bind_param("ss", $string, $Data['hosting_client_email']);
		$trigger = $stmt -> execute();
		$stmt -> close();
		if($trigger !== false){
			setcookie('LEFSESS', $string, time()+30+86400, '/');
			header('location: ../index.php');
		}
	}
}
else{
	header('location: ../login.php');
}
?>
