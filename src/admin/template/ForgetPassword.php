<div class="flex-fill d-flex flex-column justify-content-center py-4">
	<div class="container-tight py-4">
		<div class="text-center mb-4">
			<a href="https://mofhy.xyz">
				<img src="assets/img/logo.svg" height="40" width="240" alt="Mofhy Lite">
			</a>
		</div>
		<div class="card card-md">
			<div class="card-body">
				<?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);}?>
				<h2 class="card-title text-center mb-4">Reset Your Password</h2>
				<form action="function/ForgetPassword" method="post" autocomplete="off" id="auth-form">
					<p>
						Enter your email address that you used to register. We'll email you with a link to reset your password.
					</p>
					<div class="mb-3">
						<label for="email" class="form-label">Email Address</label>
						<input type="email" class="form-control" name="email" placeholder="Email Address" id="email" required="" autofocus="" value="">
					</div>
					<button class="btn btn-primary w-100" name="reset" type="submit">
						Send Password Reset Link
					</button>
				</form>
			</div>
		</div>
		<div class="text-center text-muted mt-3">
			<a href="login">
				Back To Login
			</a>
		</div>
	</div>
</div>
