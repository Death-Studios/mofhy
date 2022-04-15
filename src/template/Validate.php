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

<div class="page-wrapper with-navbar with-sidebar" data-sidebar-type="overlayed-sm-and-down">
	<nav class="navbar">
		<div class="container-fluid">
			<a href="<?php echo $AreaInfo['area_url']; ?>index.php" class="navbar-brand"><?php echo $AreaInfo['area_name']; ?></a>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item nav-height dropdown with-arrow">
					<a class="btn btn-sm m5x" data-toggle="dropdown" id="nav-link-dropdown-toggle">
						<i class="fa fa-user"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="nav-link-dropdown-toggle">
						<a href="logout.php" class="dropdown-item">Logout</a>
						<div class="dropdown-divider"></div>
						<div class="dropdown-content">
							<button class="btn btn-block" role="button" onclick="halfmoon.toggleDarkMode()"><i class="fa fa-sun"></i> Switch</button>
						</div>
					</div>
				</li>
				<li class="nav-item nav-height hidden-on-up">
					<button class="btn btn-sm my-auto" onclick="halfmoon.toggleSidebar()"><i class="fa fa-bars"></i></button>
				</li>
		</div>
	</nav>
	<div class="sidebar-overlay" onclick="halfmoon.toggleSidebar()"></div>
	<div class="sidebar">
		<div class="sidebar-menu">
			<h5 class="sidebar-title">Logged in as:</h5>
			<div class="sidebar-divider"></div>
			<a href="myprofile.php" class="sidebar-link sidebar-link-with-icon">
				<span class="sidebar-icon bg-secondary text-dark rounded-circle">
					<i class="fa fa-user-circle" aria-hidden="true"></i>
				</span>
				<?php
				if ($ClientInfo['hosting_client_status'] == 1) {
					header("location: index.php");
				}
				echo $ClientInfo['hosting_client_fname'] . " " . $ClientInfo['hosting_client_lname']; ?>
			</a>

			<h5 class="sidebar-title">Main Menu</h5>
			<div class="sidebar-divider"></div>
			<a href="<?php echo $AreaInfo['area_url']; ?>logout.php" class="sidebar-link sidebar-link-with-icon">
				<span class="sidebar-icon bg-transparent">
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
				</span>
				Logout
			</a>
			<br />
		</div>
	</div>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="card p-15">
				<h5 class="mb-0 px-5">Validate Account</h5>
				<hr>
				<div>
					<p><b>Note:</b> You need to verify this account inorder to use our free hosting and ssl services. An email has been sent to your submitted email address(<?php echo '<samp>' . $ClientInfo['hosting_client_email'] . '</samp>'; ?>) with validation key.</p>
					<form action="function/Validate.php" method="post">
						<div class="form-group">
							<label class="form-label">Validation key</label>
							<input type="text" name="validation_key" class="form-control" placeholder="eg. Abdu6236734h...">
						</div>
						<div class="form-group">
							<button name="validate" class="btn btn-sm btn-primary">Validate</button>
							<a href="resendemail.php" class="btn btn-sm btn-secondary">Resend Email</a>
						</div>
					</form>
				</div>
			</div>
		</div>