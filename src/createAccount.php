<?php
$PageInfo = ['title'=>'New Account','rel'=>''];
require_once __DIR__.'/includes/Connect.php';
require_once __DIR__.'/handler/AreaHandler.php';
require_once __DIR__.'/includes/Header.php';
require_once __DIR__.'/handler/CookieHandler.php';
require_once __DIR__.'/handler/ValidationHandler.php';
require_once __DIR__.'/handler/HostingHandler.php';
require_once __DIR__.'/includes/Navbar.php';
if(isset($_GET['step2'])){
    include __DIR__.'/template/NewAccount2.php';
} else{
    include __DIR__.'/template/NewAccount.php';
}
require_once __DIR__.'/includes/Footer.php';
?>