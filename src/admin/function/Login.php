<?php
require __DIR__.'/Connect.php';
if(isset($_POST['login'])){
	$FormData = array(
		'admin_email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
		'admin_password' => hash('sha256', $_POST['password']),
		'error_msg' => '<div class="alert alert-danger">These credentials do not match our records.</div>'
	);
	$check = "SELECT * FROM `hosting_admin` WHERE `admin_email`= ? LIMIT 1";
	$stmt = $connect->prepare($check);
	$stmt->bind_param('s', $FormData['admin_email']);
	$trigger = $stmt->execute();
	$result = $stmt->get_result();
	$AdminCreds = $result->fetch_assoc();
	$stmt->close();
	if($trigger !== false){
		if($FormData['admin_password'] == $AdminCreds['admin_password']){
			setcookie('LEASESS', base64_encode($AdminCreds['admin_hash']), time() + (86400 * 30), "/");
			header('location: ../clients');
		} 
		else{
			$_SESSION['message'] = $FormData['error_msg'];
			header('location: ../login');
		}
	}
	else{
		$_SESSION['message'] = $FormData['error_msg'];
		header('location: ../login');
	}
}
else{
	$_SESSION['message'] = $FormData['error_msg'];
	header('location: ../login');
}
?>
