<?php
require __DIR__.'/Connect.php';
require __DIR__.'/CryptoLib.php';
if(isset($_POST['login'])){
	$FormData = array(
		'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
		'password' => hash('sha256', mysqli_real_escape_string($connect, $_POST['password'])),
		'error_msg' => '<div class="alert alert-danger">These credentials do not match our records.</div>'
	);
	$sql = "SELECT * FROM `hosting_clients` WHERE `hosting_client_email`= ? LIMIT 1";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("s", $FormData['email']);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_assoc();
	$rows = $result->num_rows;
	$stmt->close();
	if($rows>0){
		if($fetch['hosting_client_password'] == $FormData['password']){
			$string = \IcyApril\CryptoLib::randomString(64);
			$sql1 = "UPDATE `hosting_clients` SET `hosting_client_hash` = ? WHERE `hosting_client_email` = ?";
			$stmt = $connect->prepare($sql1);
			$stmt -> bind_param("ss", $string, $fetch['hosting_client_email']);
			$trigger = $stmt -> execute();
			$stmt -> close();
			if($trigger !== false){
				setcookie('LEFSESS', $string, time()+3600, '/');
				header('location: ../');
			} else{
				$_SESSION['message'] = $FormData['error_msg'];
				header('location: ../login');
			}
		} else{
			$_SESSION['message'] = $FormData['error_msg'];
			header('location: ../login');
		}
	} else{
		$_SESSION['message'] = $FormData['error_msg'];
		header('location: ../login');
	}
}
else{
	header('location: ../login');
}
?>
