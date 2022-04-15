<?php
require __DIR__.'/Connect.php';
require __DIR__.'/../handler/CookieHandler.php';
require_once __DIR__.'/../handler/AreaHandler.php';
require __DIR__.'/../handler/SSLHandler.php';
if(isset($_POST['submit'])){
	$CSRData = array(
		'csr_commonname' => strtolower($_POST['domain']),
		'csr_organization' => $AreaInfo['area_name'],
		'csr_department' => 'IT',
		'csr_city' => 'Syracuse',
		'csr_state' => 'North Dakota',
		'csr_country' => 'US',
		'csr_email' => $ClientInfo['hosting_client_email']
	);
	$apiClient = new GoGetSSLApi();
    $token = $apiClient->auth($SSLApi['api_username'], $SSLApi['api_password']);
    $csrorder = $apiClient->generateCSR($CSRData);
    $csr_code = $csrorder['csr_code'];
    $private_key = $csrorder['csr_key'];
	$FormData = array(
		'product_id'       => 65,
		'csr' 			   => $csr_code,
	    'server_count'     => "-1",
	    'period'           => 3,
	    'approver_email'   => 'admin@mofh.cf',
	    'webserver_type'   => "1",
	    'admin_firstname'  => $ClientInfo['hosting_client_fname'],
	    'admin_lastname'   => $ClientInfo['hosting_client_lname'],
	    'admin_phone'      => "003719999999",
	    'admin_title'      => "Mr",
	    'admin_email'      => $ClientInfo['hosting_client_email'],
	    'tech_firstname'   => $ClientInfo['hosting_client_fname'],
	    'tech_lastname'    => $ClientInfo['hosting_client_lname'],
	    'tech_phone'       => "003719999999",
	    'tech_title'       => "Mr",
	    'tech_email'       => $ClientInfo['hosting_client_email'],
	    'org_name'         => "Hostella",
	    'org_division'     => "Hosting",
	    'org_addressline1' => "234 W Genesee St",
	    'org_city'         => "Syracuse",
	    'org_country'      => "US",
	    'org_phone'        => "003719999999",
	    'org_postalcode'   => "13202",
	    'org_region'       => "None",
	    'dcv_method'       => "dns",
	);
	echo "<pre>";
	print_r($FormData);
	$apiClient = new GoGetSSLApi();
	$token = $apiClient->auth($SSLApi['api_username'], $SSLApi['api_password']);
	$Data = $apiClient->addSSLOrder($FormData);
	if(count($Data)>4){
		$sql = "INSERT INTO `hosting_ssl`(`ssl_key`,`ssl_for`, `ssl_pk`) VALUES (?, ?, ?)";
		$stmt = $connect->prepare($sql);
		$stmt -> bind_param("sss", $Data['order_id'], $ClientInfo['hosting_client_key'], $private_key);
		$trigger = $stmt->execute();
		$error = $stmt->error;
		$stmt -> close();
		if($trigger !== false){
			$SSL = $AreaInfo['area_url'].'viewSSL.php?ssl_id='.$Data['order_id'];
			$EmailTo = [['email' => $FormData['email']],['email' => $AreaInfo['area_email']]];
			$Body = "
				<div class='container' style='margin-left:5%;margin-right:5%;margin-top:5%;'>
				<div style='border-radius:1px solid grey;border-radius:5px;box-shadow:1px 1px 5px grey;padding:20px;font-family: Arial, Helvetica, sans-serif;'>
				<h2 style='text-align:center;color:skyblue;'><b>New SSL</b></h2><hr>
				<h3>Hi ".$ClientInfo['hosting_client_fname'].",</h3><p>You have successfully created a new ssl and you need to verify your domain using dns record in order to issue an ssl certificate.</p><br>
				<center><a href='".$SSL."' style='text-decoration:none;border:white;color:#fff;padding:10px 20px 10px 20px;background:orange;border-radius:5px;'>View SSL</a></center>
				<br>
				<p>After login to your account you can use any service ❤</p>
				<p>Regards ".$AreaInfo['area_name']."</p>
				<hr>
				<h4 style='text-align:center;'><b>Need our help?</b></h4><p style='text-align:center'><a href='".$AreaInfo['area_url']."newticket.php' style='color:skyblue;text-decoration:none;margin:0;'>We are here to help you out!</a></p>
				</div>
				</div>";
			$Email = array(
				'subject' => 'New SSL #'.$FormData['order_id'],
				'body' => $Body
			);
			include __DIR__.'/../handler/EmailHandler.php';
			$_SESSION['message'] = '<div class="alert alert-success"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg><span class="alert-title">Success!</span> <span>Your SSL has been requested successfully. You can now verify you domain name.</span></div>';
			header('location: ../sslCertificates');
		}
		else{
			$_SESSION['message'] = '<div class="alert alert-danger"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span class="alert-title">Error</span> : <span>'.$error.'</span></div>';
			header('location: ../newSSL');
		}
	}
	else{
		$_SESSION['message'] = '<div class="alert alert-danger">'.$Data['description'].'</div>';
		header('location: ../newSSL');
	}
}
else{
	header('location: ../');
}
?>
