<div class="flex-fill d-flex flex-column justify-content-center py-4">
	<div class="container-tight py-4">
		<div class="text-center mb-4">
			<a href="https://<?php echo $AreaInfo['area_url']; ?>">
				<img src="https://assets.mofhy.tk/img/logo.svg" height="40" width="240" alt="<?php echo $AreaInfo['area_name'];?>">
			</a>
		</div>
		<div class="card card-md">
			<div class="card-body">
				<div id="hidden-area">
					<?php
					if (isset($_SESSION['message'])) {
						echo ($_SESSION['message']);
						unset($_SESSION['message']);
					}
					?>
				</div>
				<h2 class="card-title text-center mb-4">Verify Your Email Address</h2>
				<p class="text-center">We've sent a verificate email to <?php echo '<code>' . $ClientInfo['hosting_client_email'] . '</code>'; ?>, Pleace click on the link in the email to verify your account and leverage our services!</p>
				<div class="row">
					<div class="col-sm mt-2">
						<a href="resendMail" class="btn w-100 btn-primary">Resend Email &nbsp; <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh-alert" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
								<path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
								<line x1="12" y1="9" x2="12" y2="12"></line>
								<line x1="12" y1="15" x2="12.01" y2="15"></line>
							</svg></a>
					</div>
				</div>
			</div>
		</div>
		<div class="text-center text-muted mt-3">
			<div class="text-center text-muted">
				<a href="logout">Log Out</a>
			</div>
		</div>
	</div>
</div>
