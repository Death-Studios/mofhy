<?php
$status = htmlspecialchars($_POST['status']);
$username = htmlspecialchars($_POST['username']);
$sql = "UPDATE `hosting_account` SET `account_sql` = ? WHERE `account_username` = ?";
$stmt = $connect->prepare($sql);
$stmt -> bind_param("ss", $status, $username);
$stmt -> execute();
$stmt -> close();
