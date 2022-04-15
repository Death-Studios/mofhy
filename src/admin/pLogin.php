<?php
if(isset($_GET['account_id'])){
	$PageInfo = ['title'=>'Login to Control Panel','rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/SessionHandler.php';
	require_once __DIR__.'/../handler/HostingHandler.php';
	require_once __DIR__.'/../modules/UserInfo/UserInfo.php';
	require_once __DIR__.'/includes/Navbar.php';
	$sql = "SELECT * FROM `hosting_account` WHERE `account_username`= ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("s", $_GET['account_id']);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$AccountInfo = $stmt_result->fetch_assoc();
	if($stmt_result->num_rows>0){
	include __DIR__.'/template/cPLogin.php';
	require_once __DIR__.'/includes/Footer.php';
    } else{
		include __DIR__.'/../template/503.php';
	}
}
else{
	$PageInfo = ['title'=>'Unathorized Access'];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/SessionHandler.php';
	require_once __DIR__.'/includes/Navbar.php';
		include __DIR__.'/../template/503.php';
	require_once __DIR__.'/includes/Footer.php';
}
?>