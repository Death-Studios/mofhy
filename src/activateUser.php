<?php 
include "function/Connect.php";
if($_GET['type'] == "activate"){
    if($_GET['signature'] !== NULL){
        $one = 1;
        $sql = "UPDATE `hosting_clients` SET `hosting_client_status`= ? WHERE `hosting_client_verification`= ?";
        $stmt = $connect->prepare($sql);
        $stmt -> bind_param("is", $one, $_GET['signature']);
        $trigger = $stmt->execute();
        $stmt -> close();
        if($trigger !== false){
            $_SESSION['message'] = '<div class="alert alert-success">Your account has been verified.</div>';
			header('location: login');
        }
        else{
            $_SESSION['message'] = '<div class="alert alert-danger">Oops! Something went wrong.</div>';
			header('location: login');
        }
    }
    else{
        $PageInfo = ['title'=>'403 Forbidden'];
        require_once "includes/Header.php"; 
        include "template/503.php";
    }
}
else{
        $PageInfo = ['title'=>'403 Forbidden'];
        require_once "includes/Header.php"; 
        include "template/503.php";
}
?>