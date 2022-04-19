<?php
require_once __DIR__.'/../includes/Connect.php';
require_once __DIR__.'/AreaHandler.php';
$analytics_key = 'GTAG';
$sql = "SELECT * FROM `google_analytics` WHERE `analytics_key`= ? LIMIT 1";
$stmt = $connect->prepare($sql);
$stmt -> bind_param("s", $analytics_key);
$stmt -> execute();
$result = $stmt->get_result();
$GoogleAnalytics = $result->fetch_assoc();
$stmt -> close();
?>
