<?php
if(isset($_GET['account_id'])){
	$PageInfo = ['title'=>'Account Settings ('.$_GET['account_id'].')','rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/CookieHandler.php';
	require_once __DIR__.'/handler/ValidationHandler.php';
	require_once __DIR__.'/handler/HostingHandler.php';
	require_once __DIR__.'/modules/UserInfo/UserInfo.php';
	$account_id = htmlspecialchars($_GET['account_id']);
	$sql = "SELECT * FROM `hosting_account` WHERE `account_username`= ? AND `account_for`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("ss", $account_id, $ClientInfo['hosting_client_key']);
	$stmt -> execute();
	$rows = $stmt->get_result()->num_rows;
	$stmt -> close();
	if($rows>0){
		require_once __DIR__.'/includes/Navbar.php';
		include __DIR__.'/template/AccountSettings.php';
		require_once __DIR__.'/includes/Footer.php';
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
	require_once __DIR__.'/handler/CookieHandler.php';
	include __DIR__.'/template/503.php';
}
?>
