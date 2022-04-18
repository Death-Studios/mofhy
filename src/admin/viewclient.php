<?php
if(isset($_GET['client_id'])){
	$PageInfo = ['title'=>'View client ('.$_GET['client_id'].")",'rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/SessionHandler.php';
	require_once __DIR__.'/../handler/HostingHandler.php';
	require_once __DIR__.'/../modules/UserInfo/UserInfo.php';
	require_once __DIR__.'/includes/Navbar.php';
	// check if user exists
	$hosting_client_key = mysqli_real_escape_string($connect, $_GET['client_id']);
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_key`= ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("s", $hosting_client_key);
	$stmt->execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	if($rows>0){
		$ClientInfo = $result->fetch_assoc();
		include __DIR__.'/template/ViewClient.php';
		require_once __DIR__.'/includes/Footer.php';
	} else{
		include __DIR__.'/../template/503.php';
	}
}
else{
	$PageInfo = ['title'=>'Unathorized Access','rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/SessionHandler.php';
	require_once __DIR__.'/includes/Navbar.php';
	include __DIR__.'/../template/503.php';
	require_once __DIR__.'/includes/Footer.php';
}
?>
