<?php
if(isset($_SESSION['LEASESS'])){
	header('location: index.php');	
}
$PageInfo = ['title'=>'Forget Password'];
require_once __DIR__.'/includes/Connect.php';
require_once __DIR__.'/handler/AreaHandler.php';
require_once __DIR__.'/includes/Header.php';
include __DIR__.'/template/ForgetPassword.php';
?>