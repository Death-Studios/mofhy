<?php
require __DIR__.'/Connect.php';
require __DIR__.'/../handler/SessionHandler.php';
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
		setcookie('LEFSESS', bin2hex($Data['hosting_client_email']), time()+30+86400, '/');
			header('location: ../index.php');
		}
	}
else{
	header('location: ../login.php');
}
?>
