<div class="page page-center">
	<div class="container-tight py-4">
		<div class="text-center mb-2">
			<a href="https://mofhy.tk">
				<img src="https://assets.mofhy.tk/img/logo.svg" width="240" height="40" alt="<?php echo $AreaInfo['area_name']; ?>"></a>
		</div>
		<form class="card card-md" action="function/ResetPassword" method="post" onsubmit="
					var password = document.getElementById('password').value;
					var cpassword = document.getElementById('cpassword').value;
					if(password != cpassword){
						alert('Password Not Match!');
						return false;
					}
					return true;
				">
			<div class="card-body">
				<h2 class="card-title text-center">Reset Your Password</h2>
				<?php if (isset($_SESSION['message'])) {
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				} ?>
				<div class="mb-3">
					<p>Enter your new password below to update your client area password and then you can login.</p>
					<input type="hidden" name="email" value="<?php $emal = htmlspecialchars($_GET['email']); echo $email; ?>">
				</div>
				<div class="mb-2">
					<label class="form-label required">
						New Password
					</label>
					<div class="input-group input-group-flat">
						<input type="password" name="password" id="password" class="form-control" placeholder="New Password" required="required">
					</div>
					<div class="mt-2">
						<label class="form-label required">
							Confirm Password
						</label>
						<div class="input-group input-group-flat">
							<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" required="required">
						</div>
						<button class="btn btn-primary w-100 mt-2" name="reset" type="submit">Reset My Password</button>
					</div>
		</form>
	</div>
</div>
<div class="text-center text-muted mt-3">
	<a href="login">Get Back Duh</a>
</div>
