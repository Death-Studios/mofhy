<div class="page-wrapper">
	<div class="container-xl">
		<div class="page-header">
			<h1 class="page-title">
				SSL Certificates
			</h1>
		</div>
		<div class="row">
			<div class="col-12">
			</div>
		</div>
	</div>
	<div class="page-body">
		<div class="container-xl">
			<div class="alert alert-danger bg-red py-4" id="fundingNotice" style="display: block;">
				<div class="text-center">
					<h3>This is a dummy placeholder where you should insert your ad code. <br>Insert the ad code below this <kbd>div</kbd> element. Best of luck!</h3>
				</div>
			</div>
			<?php
				if (isset($_SESSION['message'])) {
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				}
				?>
			<div class="row row-cards">
				<div class="col-md-8">
					<div class="card">
						<div class="table-responsive">
							<table class="table table-vcenter text-nowrap card-table">
								<thead>
									<tr>
										<th>Domain</th>
										<th>Provider</th>
										<th>Status</th>
										<th>Created at</th>
										<th>Expires at</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM `hosting_ssl` WHERE `ssl_for` = ? ORDER BY `ssl_id` DESC";
									$stmt = $connect->prepare($sql);
									$stmt -> bind_param("s", $ClientInfo['hosting_client_key']);
									$stmt -> execute();
									$result = $stmt->get_result();
									$Rows = $result->num_rows;
									$fetch = $result->fetch_assoc();
									$stmt -> close();
									if ($Rows>0) {
										while ($SSLToken = $fetch) {
											$apiClient = new GoGetSSLApi();
											$token = $apiClient->auth($SSLApi['api_username'], $SSLApi['api_password']);
											$SSLInfo = $apiClient->getOrderStatus($SSLToken['ssl_key']);
											if (empty($SSLInfo['begin_date'])) {
												$Begin = '(unknown)';
												$End = $Begin;
											} else {
												$Begin = $SSLInfo['begin_date'];
												$End = $SSLInfo['end_date'];
											}
									?>
											<tr>
												<td><?php echo $SSLInfo['domain']; ?></td>
												<td>GoGetSSL</td>
												<td><?php if ($SSLInfo['status'] == 'processing') {
														$btn = ['primary', 'cog'];
														echo '<span class="badge bg-primary">Processing</span>';
													} elseif ($SSLInfo['status'] == 'active') {
														$btn = ['success', 'globe'];
														echo '<span class="badge bg-success">Active</span>';
													} elseif ($SSLInfo['status'] == 'cancelled') {
														$btn = ['danger', 'lock'];
														echo '<span class="badge bg-danger">Cancelled</span>';
													} elseif ($SSLInfo['status'] == 'expired') {
														$btn = ['danger', 'lock'];
														echo '<span class="badge bg-danger">Expired</span>';
													} ?></td>
												<td><?php echo $Begin; ?></td>
												<td><?php echo $End; ?></td>
												<td class="text-center">
													<a class="btn btn-primary" href="viewCertificate?ssl_id=<?php echo $SSLInfo['order_id']; ?>"> Manage </a>
												</td>
											</tr>
										<?php }
									} else { ?>
										<tr>
											<td colspan="6" class="text-center">No certificates found, want to create one?</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="card-footer d-flex"> <a href="newSSL" class="btn btn-primary m-0"> New SSL Certificate </a>
							<div class="m-0 ms-auto"> </div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Don't like manual installation?</h3>
						</div>
						<div class="card-body">
							<p> iFastNet's Premium Hosting integrates Let's Encrypt directly into the cPanel control panel, so your free SSL certificates can be created, installed and renewed fully automatically! </p>
							<p> Learn more about this and the other benefits of Premium Hosting from iFastNet! </p> <a href="https://ifastnet.com/" target="_blank" rel="nofollow" class="btn btn-success" onclick="ga('send', 'event', 'premium', 'click', 'acme-ssl-automatic')"> Learn More </a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mt-3">
					<div class="alert alert-danger bg-red py-4" id="fundingNotice" style="display: block;">
						<div class="text-center">
							<h3>This is a dummy placeholder where you should insert your ad code. <br>Insert the ad code below this <kbd>div</kbd> element. Best of luck!</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
