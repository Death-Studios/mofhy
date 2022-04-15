<?php
if(isset($_GET['account_id'])){
	$PageInfo = ['title'=>'View Account ('.$_GET['account_id'].")",'rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/CookieHandler.php';
	require_once __DIR__.'/handler/ValidationHandler.php';
	require_once __DIR__.'/handler/HostingHandler.php';
	require_once __DIR__.'/modules/autoload.php';
	require_once __DIR__.'/modules/UserInfo/UserInfo.php';
	$account_id = htmlspecialchars($_GET['account_id']);
	$sql = "SELECT * FROM `hosting_account` WHERE `account_username`= ? AND `account_for`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("ss", $account_id, $ClientInfo['hosting_client_key']);
	$stmt -> execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	$stmt -> close();
	if($rows>0){
		require_once __DIR__.'/includes/Navbar.php';
		include __DIR__.'/template/ViewAccount.php';
		require_once __DIR__.'/includes/Footer.php';
	}
	else{
		include __DIR__.'/template/503.php';
	}
}
else{
	$PageInfo = ['title'=>'Unathorized Access','rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/CookieHandler.php';
	include __DIR__.'/template/503.php';
}
?>
