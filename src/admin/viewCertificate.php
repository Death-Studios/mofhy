<?php
if(isset($_GET['ssl_id'])){
	$PageInfo = ['title'=>'View SSL #'.$_GET['ssl_id'],'rel'=>''];
	require_once __DIR__.'/includes/Connect.php';
	require_once __DIR__.'/handler/AreaHandler.php';
	require_once __DIR__.'/includes/Header.php';
	require_once __DIR__.'/handler/SessionHandler.php';
	require_once __DIR__.'/handler/SSLHandler.php';
	require_once __DIR__.'/includes/Navbar.php';
	$sql = "SELECT * FROM `hosting_ssl` WHERE `ssl_key`= ?";
	$stmt = $connect->prepare($sql);
	$stmt -> bind_param("s", $_GET['ssl_id']);
	$stmt -> execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	$fetch = $result->fetch_assoc();
	$stmt -> close();
	if($rows>0){
		include __DIR__.'/template/ViewSSL.php';
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
