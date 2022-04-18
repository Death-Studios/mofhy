<?php
require __DIR__.'/../modules/GoGetSSL/GoGetSSLApi.php';
$api_key = "FREESSL";
$sql = "SELECT * FROM `hosting_ssl_api` WHERE `api_key`= ?";
$stmt = $connect->prepare($sql);
$stmt -> bind_param("s", $api_key);
$stmt -> execute();
$result = $stmt ->get_result();
$SSLApi = $result->fetch_assoc();
$stmt -> close();
?>
