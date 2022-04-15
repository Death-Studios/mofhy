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
						<li class="nav-item"> <a href="#" class="nav-link active"> Step 1. Choose a domain name </a> </li>
						<li class="nav-item"> <a href="#" class="nav-link disabled" tabindex="-1"> Step 2. Enter additional information </a> </li>
						<li class="nav-item"> <a href="#" class="nav-link disabled" tabindex="-1"> Step 3. Done </a> </li>
					</ul>
					<form method="post" action="function/ValidateDomain">
						<div class="mb-3">
							<label class="form-label">Domain Type</label>
							<div class="form-selectgroup">
								<label class="form-selectgroup-item">
									<input type="radio" name="value" value="subdomain" class="form-selectgroup-input domainTypeSwitch">
									<span class="form-selectgroup-label">Subdomain</span>
								</label>
								<label class="form-selectgroup-item">
									<input type="radio" name="value" value="customDomain" class="form-selectgroup-input domainTypeSwitch">
									<span class="form-selectgroup-label">Custom Domain</span>
								</label>
							</div>
						</div>
						<div id="subdomainType">
							<div class="row">
								<div class="col-sm-8 col-md-9">
									<label class="form-label">
										Subdomain
									</label>
									<input type="text" name="subdomain" value="" class="form-control" id="subdomain" placeholder="your-name">
								</div>
								<div class="col-sm-4 col-md-3">
									<label class="form-label">
										Domain Extension
									</label>
									<select class="form-select" name="extension">
										<?php
										$sql = mysqli_query($connect, "SELECT * FROM `hosting_domain_extensions` ORDER BY 'extension_id'");
										if (mysqli_num_rows($sql) > 0) {
											while ($Extension = mysqli_fetch_Assoc($sql)) { ?>
												echo "<option value="<?php echo $Extension['extension_value']; ?>"><?php echo $Extension['extension_value']; ?></option>";
											<?php }
										} else { ?>
											<option>.html-5.me</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div id="customDomainType" class="d-none mb-3">
							<div class="alert alert-info">
								<div class="d-flex">
									<div>
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
											<circle cx="12" cy="12" r="9"></circle>
											<line x1="12" y1="8" x2="12.01" y2="8"></line>
											<polyline points="11 12 12 12 12 16 13 16"></polyline>
										</svg>
									</div>
									<div>
										<h3 class="alert-title">Your domain needs to point to these nameservers before you can create an account:</h3>
										<ul>
											<li><?php echo $HostingApi['api_ns_1']; ?></li>
											<li><?php echo $HostingApi['api_ns_2']; ?></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label" for="customDomain">Your Domain Name</label>
								<input type="text" id="customDomain" class="form-control" name="customDomain" value="" placeholder="example.com">
							</div>
						</div>
						<input type="hidden" name="domainType" value="subdomain" id="domainTypeInput">
						<button name="submit" class="btn btn-primary mt-2">Search Domain</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mt-3"></div>
			</div>
		</div>
	</div>
	<script src="https://assets.mofhy.tk/js/jquery.min.js"></script>
	<script>
		$('.domainTypeSwitch').change(function() {
			$('#domainTypeInput').val(this.value);

			if (this.value === 'customDomain') {
				$('#customDomainType').removeClass('d-none');
				$('#subdomainType').addClass('d-none');
			} else {
				$('#customDomainType').addClass('d-none');
				$('#subdomainType').removeClass('d-none');
			}
		});
	</script>