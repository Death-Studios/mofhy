<div class="page-wrapper">
	<div class="container-xl">
		<div class="page-header">

			<div class="row">
				<div class="col-12">
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Your Profile</h3>
					</div>
					<div class="card-body">
						<div class="row row-0">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td><strong>Full Name</strong></td>
												<td><?php echo $AdminInfo['admin_fname']." ".$AdminInfo['admin_lname']; ?></td>
											</tr>
											<tr>
												<td><strong>Email Address</strong></td>
												<td><?php echo $AdminInfo['admin_email']?></td>
											</tr>
											<tr>
												<td><strong>Clientarea Name</strong></td>
												<td><?php echo $AreaInfo['area_name']; ?></td>
											</tr>
											<tr>
												<td><strong>Clientarea URL</strong></td>
												<td><?php echo "https://".$_SERVER['HTTP_HOST']; ?></td>
											</tr>
											<tr>
												<td><strong>Clientarea Email</strong></td>
												<td><?php echo $AreaInfo['area_email']; ?></td>
											</tr>
											<tr>
												<td><strong>Clientarea Status</strong></td>
												<td><?php if($AreaInfo['area_status']==1){echo '<span class="badge bg-green">Operational</span>';}elseif($AreaInfo['area_status']==0){echo '<span class="badge bg-orange">Maintaince</span>';}?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a href="profileSettings" class="btn btn-primary">
							Edit Profile
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
