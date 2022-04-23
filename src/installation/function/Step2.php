<?php
ob_start();
session_start();
if(isset($_POST['submit'])){
	include __DIR__."/../../modules/Database/Config.php";
	$connect = mysqli_connect($DataBase['hostname'], $DataBase['username'], $DataBase['password'], $DataBase['name']);
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	function generate_string($input, $strength = 16) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	$FormData = array(
		'admin_id' => '1',
		'admin_fname' => htmlentities(mysqli_real_escape_string($connect, $_POST['first'])),
		'admin_lname' => htmlentities(mysqli_real_escape_string($connect, $_POST['last'])),
		'admin_password' => hash('sha256', mysqli_real_escape_string($connect, $_POST['password'])),
		'admin_email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
		'admin_key' => substr(str_shuffle('qwertyuioplkjhgfdsazxcvbnm012345789QWERTYUIOPLKJHGFDSAZXCVBNM'), 0, 8),
		'admin_hash' => generate_string($permitted_chars, 128)
	);
	$sql = "INSERT INTO `hosting_admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_key`, `admin_password`, `admin_hash`) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("sssssss", $FormData['admin_id'], $FormData['admin_fname'], $FormData['admin_lname'], $FormData['admin_email'], $FormData['admin_key'], $FormData['admin_password'], $FormData['admin_hash']);
	$trigger = $stmt->execute();
	$error = $stmt->error;
	$stmt->close();
	if($trigger !== false){
		$_SESSION['message'] = '<div class="alert alert-success" role="alert">Successfully created admin account.</div>';
		header('location: ../install?step=3');
	}
	else{
		$_SESSION['message'] = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
		header('location: ../install?step=2');
	}
}
?>
