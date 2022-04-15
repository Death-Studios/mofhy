<?php 
if(!isset($_SESSION['sudomain'])){
	header("location: ../createAccount");
}
?>
<div class="page-wrapper">
	<div class="container-xl">
		<div class="page-header">
			<h1 class="page-title">
				Create A New Hosting Account
			</h1>
		</div>
		<div class="row">
			<div class="col-12">
			</div>
		</div>
	</div>
	<div class="page-body">
		<div class="container-xl">
			<?php if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			} ?>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create a Hosting Account</h3>
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs mb-3">
						<li class="nav-item"> <a href="createAccount" class="nav-link"> Step 1. Choose a domain name </a> </li>
						<li class="nav-item"> <a href="#" class="nav-link active"> Step 2. Enter additional information </a> </li>
						<li class="nav-item"> <a href="#" class="nav-link disabled" tabindex="-1"> Step 3. Done </a> </li>
					</ul>
					<form method="post" action="function/NewAccount">
						<div class="mb-3">
							<label class="form-label" for="label">Account Label</label>
							<input type="text" class="form-control" name="label" placeholder="Enter something you can use to identify the account." value="Website for <?php echo $_SESSION['sudomain']; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label" for="username">Account Username</label>
							<input type="text" class="form-control" placeholder="(generated automatically)" disabled="">
						</div>
						<div class="mb-3">
							<label class="form-label" for="password">Account Password</label>
							<input type="text" class="form-control" placeholder="(generated automatically)" disabled="">
						</div>
						<input type="hidden" name="domain" value="<?php echo $_SESSION['sudomain']; unset($_SESSION['sudomain']); ?>">
						<input type="hidden" name="package" value="<?php echo $HostingApi['api_package']; ?>">
						<button type="submit" name="submit" class="btn btn-primary">Create Account</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mt-3"></div>
			</div>
		</div>
	</div>