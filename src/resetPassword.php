<?php
if(isset($_COOKIE['LEFSESS'])&&$_COOKIE['LEFSESS']!='NULL'){
	header('location: accounts');	
}
if($_GET['type'] == "reset"){
    if(md5(hex2bin($_GET['email'])) == $_GET['signature']){
        $PageInfo = ['title'=>'Reset Password','rel'=>''];
        require_once __DIR__.'/includes/Connect.php';
        require_once __DIR__.'/handler/AreaHandler.php';
        require_once __DIR__.'/includes/Header.php';
        include __DIR__.'/template/ResetPassword.php';
    }
    else{
        $_SESSION['message'] = '<div class="alert alert-danger">Oops! Something went wrong.</div>';
		header('location: login');
    }
}
else{
        $PageInfo = ['title'=>'403 Forbidden'];
        require_once __DIR__.'/includes/Connect.php';
        require_once "includes/Header.php"; 
        include "template/503.php";
    }?>