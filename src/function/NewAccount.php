<?php
require __DIR__.'/Connect.php';
require __DIR__.'/../handler/CookieHandler.php';
require_once __DIR__.'/../handler/AreaHandler.php';
require_once __DIR__.'/../modules/autoload.php';
use \InfinityFree\MofhClient\Client;
if(isset($_POST['submit'])){
		$username = substr(str_shuffle('qwertyuioplkjhgfdsazxcvbnm012345789QWERTYUIOPLKJHGFDSAZXCVBNM'),0,8);
		$password = substr(str_shuffle('qwertyuioplkjhgfdsazxcvbnm012345789QWERTYUIOPLKJHGFDSAZXCVBNM'),0,16);
		$domain   = mysqli_real_escape_string($connect, $_POST['domain']);
		$email    = filter_var($ClientInfo['hosting_client_email'], FILTER_VALIDATE_EMAIL);
		$plan     = mysqli_real_escape_string($connect, $_POST['package']);
		$label    = mysqli_real_escape_string($connect, $_POST['label']);
		if(empty($domain) || empty($label)){
			$_SESSION['message'] = '<div class="alert alert-danger"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></div><div><h4 class="alert-title">Validation error</h4><div class="text-muted">Some fields are missing. Please try again.</div></div></div></div>';
		    header('location: ../createAccount');
		    exit;
		}
		else{
		$sql = "SELECT * FROM `hosting_account` WHERE `account_for`= ?";
		$stmt = $connect->prepare($sql);
		$stmt -> bind_param("s", $ClientInfo['hosting_client_key']);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> fetch();
		$rows = $stmt->num_rows;
		$stmt ->close();
		if($rows<3){
			$client = Client::create();
			$request = $client->createAccount([
			'username' => $username,
			'password' => $password,
			'domain' => $domain,
			'email' => $email,
			'plan' => $plan
			]);
			$response = $request->send();
			$Data = $response->getData();
			$Result = array(
				'username' => $Data['result']['options']['vpusername'],
				'message' => $Data['result']['statusmsg'],
				'status' => $Data['result']['status'],
				'domain' => str_replace('cpanel', strtolower($username), API_CPANEL_URL),
				'date' => date('d-m-Y')
			);
			if($Result['status'] == 0 && strlen($Result['message'])>1){
				$_SESSION['message'] = '<div class="alert alert-danger">'.$Result['message'].'</div>';
				header('location: ../createAccount');
				exit;
			}
			elseif($Result['status'] == 1 && strlen($Result['message'])>1){
				$sql  = "INSERT INTO `hosting_account`(`account_username`, `account_password`, `account_key`, `account_domain`, `account_status`, `account_date`, `account_for`, `account_sql`, `account_label`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = $connect->prepare($sql);
				$one  = '1'; 
				$sqlserver = 'x';
				$stmt -> bind_param("sssssssss", $Result['username'], $password, $username, $Result['domain'], $one, $Result['date'], $ClientInfo['hosting_client_key'], $sqlserver, $label);
				$trigger = $stmt -> execute();
				$error = $stmt->error;
				$stmt -> close();
				if($trigger !== false){
					$EmailTo = [['email' => $email]];
					$Body = "
						<div class='container' style='margin-left:5%;margin-right:5%;margin-top:5%;'>
						<div style='border-radius:1px solid grey;border-radius:5px;box-shadow:1px 1px 5px grey;padding:20px;font-family: Arial, Helvetica, sans-serif;'>
						<h2 style='text-align:center;color:skyblue;'><b>New Account</b></h2><hr>
						<h3>Hi ".$ClientInfo['hosting_client_fname'].",</h3><p>Congratulations! You have successfully created a new free hosting account. More details are given below:</p><br>
						<b>cPanel Username: </b><span>".$Result['username']."</span><br>
						<b>cPanel Password: </b><span>".$FormData['password']."</span><br>
						<b>Main Domain: </b><span>".$Result['domain']."</span><br>
						<b>Account Date: </b><span>".$Result['date']."</span><br>
						<b>cPanel URL: </b><span>".API_CPANEL_URL."</span><br>
						<b>Server IP: </b><span>".API_SERVER_IP."</span><br>
						<b>Hosting Package: </b><span>".API_PLAN."</span><br>
						<b>FTP Hostname: </b><span>ftpupload.net</span><br>
						<b>MySQL Hostname: </b><span>".str_replace('cpanel', 'sqlxxx', API_CPANEL_URL)."</span><br>
						<b>Nameserver 1: </b><span>".API_NS_1."</span><br>
						<b>Nameserver 2: </b><span>".API_NS_2."</span>
						<br>
						<p>Next, login to your account and you can use any service ❤!</p>
						<p>Regards,<br> </b>".$AreaInfo['area_name']."</b>.</p>
						<hr>
						<h4 style='text-align:center;'><b>Need our help?</b></h4><p style='text-align:center'><a href='".$AreaInfo['area_url']."newticket.php' style='color:skyblue;text-decoration:none;margin:0;'>We are here to help you out!</a></p>
						</div>
						</div>";
					$Email = array(
						'subject' => 'New Hosting Account',
						'body' => $Body
					);
					include __DIR__.'/../handler/EmailHandler.php';
					$_SESSION['message'] = '<div class="alert alert-success"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg></div><div><h4 class="alert-title">Success!</h4><div>Your hosting account has been created! We have sent an email containing credentials.</div></div></div></div>';
					header('location: ../accounts');
					exit;
				}
				else{
					$_SESSION['message'] = '<div class="alert alert-danger" role="alert">Something is wrong! Please contact support with this info :: <code>'.$error.'</code></div>';
					header('location: ../createAccount');
					exit;
				}
			}
			elseif($Result['status']==0 && $Result['message']==0){
				$_SESSION['message'] = '<div class="alert alert-danger" role="alert">Something is wrong! Please contact support ASAP!</div>';
				header('location: ../createAccount');
				exit;
			}
		}
		else{
			$_SESSION['message'] = '<div class="alert alert-danger">You have reached the maximum number of hosting accounts for this email address!</div>';
			header('location: ../createAccount');
		}
	}
}
else{
	header('location: ../');
}
?>
