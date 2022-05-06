<div class="flex-fill d-flex flex-column justify-content-center py-4 mt-4 mb-4">
	<div class="container-tight py-4">
		<div class="card card-md">
			<div class="card-body">
				<h2 class="card-title text-center mb-4">Redirecting to Control Panel ...</h2>
				<form action="<?php echo $HostingApi['api_cpanel_url'] ?>/login.php" method="post" autocomplete="off" id="auth-form">
					<input type="hidden" name="uname" value="<?php echo $AccountInfo['account_username']; ?>" alt="username">
					<input type="hidden" name="passwd" value="<?php echo $AccountInfo['account_password']; ?>" alt="password">
					<button class="btn btn-primary w-100">
						Click Here If You Are Not Being Redirected
					</button>
				</form>
			</div>
		</div>
		<div class="text-center text-muted mt-3"> </div>
	</div>
</div>
<script src="https://assets.mofhy.tk/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#auth-form').submit();
	});
</script>
