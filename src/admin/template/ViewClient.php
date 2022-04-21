<div class="page-wrapper">
	<div class="container-xl">
		<div class="page-header">
			<h1 class="page-title">
				Client Profile
			</h1>
		</div>
		<div class="row">
			<div class="col-12">
			</div>
		</div>
	</div>
	<div class="page-body">
		<div class="container-xl">
			<div class="row row-cards">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Viewing <kbd><?php echo $ClientInfo['hosting_client_email']; ?></kbd></h3>
						</div>
						<div class="card-body">
							<div class="row row-0">
								<div class="col-md-3">
									<img src="<?php echo get_gravatar($ClientInfo['hosting_client_email'], 150); ?>" alt="<?php echo $ClientInfo['hosting_client_fname'] . " " . $ClientInfo['hosting_client_lname'] . "'s Avatar"; ?>">
								</div>
								<div class="col-md-9">
									<div class="table-responsive">
										<table class="table table-bordered" aria-labelledby="Client Profile">
											<tbody>
												<tr>
													<td><strong>Full Name</strong></td>
													<td><?php echo $ClientInfo['hosting_client_fname'] . " " . $ClientInfo['hosting_client_lname']; ?></td>
												</tr>
												<tr>
													<td><strong>Email Address</strong></td>
													<td><?php echo $ClientInfo['hosting_client_email']; ?></td>
												</tr>
												<tr>
													<td><strong>Hosting Accounts</strong></td>
													<td>
														<?php 
														$sql = "SELECT `account_id` FROM `hosting_account` WHERE `account_for` = ?";
														$stmt = $connect->prepare($sql);
														$stmt -> bind_param("s", $ClientInfo['hosting_client_key']);
														$stmt -> execute();
														$result = $stmt->get_result();
														$rows = $result->num_rows;
														$stmt -> close();
														echo $rows;
														?>
													</td>
												</tr>
												<tr>
													<td><strong>Registration Date</strong></td>
													<td><?php echo $ClientInfo['hosting_client_date']; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<a href="clogin.php?client_id=<?php echo $ClientInfo['hosting_client_key'] ?>" class="btn btn-primary">Login as <?php echo $ClientInfo['hosting_client_fname'] ?></a>
							<?php
							if ($ClientInfo['hosting_client_status'] == 0 || $ClientInfo['hosting_client_status'] == 2) {
								echo '<a href="function/ActivateClient.php?client_id=' . $ClientInfo['hosting_client_key'] . '" class="btn btn-success text-white">Mark as Active</a>';
							} else {
								echo '<a href="function/SuspendClient.php?client_id=' . $ClientInfo['hosting_client_key'] . '" class="btn btn-danger">Mark as Suspended</a>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
