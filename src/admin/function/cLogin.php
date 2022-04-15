<?php
require __DIR__.'/Connect.php';
require __DIR__.'/../handler/SessionHandler.php';
if(isset($_GET['client_id'])){
	$sql = mysqli_query($connect,"SELECT * FROM `hosting_clients` WHERE `hosting_client_key`='".mysqli_real_escape_string($connect, $_GET['client_id'])."'");
	if(mysqli_num_rows($sql)>0){
		$Data = mysqli_fetch_assoc($sql);
		setcookie('LEFSESS', bin2hex($Data['hosting_client_email']), time()+30+86400, '/');
			header('location: ../index.php');
		}
	}
else{
	header('location: ../login.php');
}
?>