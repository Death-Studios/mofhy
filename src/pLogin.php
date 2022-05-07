<?php
if(isset($_GET['account_id'])){
	$PageInfo = ['title'=>'Login to Control Panel','rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/CookieHandler.php';
	require_once __DIR__.'/handler/ValidationHandler.php';
	require_once __DIR__.'/handler/HostingHandler.php';
	require_once __DIR__.'/modules/UserInfo/UserInfo.php';
	$sql = "SELECT * FROM `hosting_account` WHERE `account_username`= ? AND `account_for`= ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("ss", $_GET['account_id'], $ClientInfo['hosting_client_key']);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$AccountInfo = $stmt_result->fetch_assoc();
	$stmt->close();
	if($stmt_result->num_rows>0){
		require_once __DIR__.'/includes/Navbar.php';
		include __DIR__.'/template/cPLogin.php';
	}
	else{
		include __DIR__.'/template/503.php';
	}
}
else{
	$PageInfo = ['title'=>'Unathorized Access'];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/includes/CookieHandler.php';
	include __DIR__.'/template/503.php';
}
?>
