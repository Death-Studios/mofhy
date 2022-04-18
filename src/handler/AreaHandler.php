<?php
$area_key = "AREA";
$sql = "SELECT * FROM `hosting_area` WHERE `area_key`= ?";
$stmt = $connect->prepare($sql);
$stmt -> bind_param("s", $area_key);
$stmt -> execute();
$result = $stmt->get_result();
$AreaInfo = $result->fetch_assoc();
if($AreaInfo['area_status'] != 1){
	header('location: maintaince');
}
?>
