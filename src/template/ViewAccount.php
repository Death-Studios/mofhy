<style>
	@media screen and (max-width: 767px) {
		.mobile-space {
			margin-top: 10px;
		}
	}
</style>
<?php $AccountInfo = $fetch; ?>
<div class="page-wrapper">
	<div class="container-xl">
		<div class="page-header">
			<div class="row">
				<div class="col-12">
				</div>
			</div>
			<div class="page-wrapper">
				<div class="page-header">
					<h1 class="page-title">
						<?php echo mysqli_real_escape_string($connect, $_GET["account_id"]); ?> (<?php echo mysqli_real_escape_string($connect, $AccountInfo["account_label"]); ?>)
					</h1>
				</div>
				<div class="col-12">
					<div id="hidden-area">
						<?php if (isset($_SESSION["message"])) {
							echo $_SESSION["message"];
							unset($_SESSION["message"]);
						} ?>
					</div>
				</div>
				<div class="container-xl">
				</div>
			</div>
		</div><?php if ($AccountInfo["account_status"] == 1) { ?>
			<div class="row">
				<div class="col-12">
				</div>
			</div>
	</div>
	<div class="page-body">
		<div class="container-xl">
			<div class="row row-cards">
				<div class="col-lg-12">
					<div class="row row-cards mb-2">
						<div class="col-12">
							<div class="list-group-item">
								<div class="row">
									<div class="col-lg-4 col-md-4 d-grid">
										<a href="/pLogin?account_id=<?php echo $AccountInfo["account_username"]; ?>" target="_blank" class="btn btn-outline-teal">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
												<path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path>
											</svg>
											Control Panel
										</a>
									</div>
									<div class="col-lg-4 col-md-4 d-grid mobile-space">
										<a href="https://filemanager.ai/new/#/c/ftpupload.net/<?php echo $AccountInfo["account_username"] .
																									"/" .
																									base64_encode(
																										json_encode([
																											"t" => "ftp",
																											"c" => ["v" => 1, "p" => $AccountInfo["account_password"]],
																										])
																									); ?>" target="_blank" class="btn btn-outline-yellow btn-md">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
												<path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path>
												<polyline points="9 15 12 12 15 15"></polyline>
												<line x1="12" y1="12" x2="12" y2="21"></line>
											</svg>
											File Manager
										</a>
									</div>
									<div class="col-lg-4 col-md-4 mobile-space">
										<div class="d-grid">
											<a href="/settings?account_id=<?php echo $AccountInfo["account_username"]; ?>" class="btn btn-outline-azure btn-md">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
													<circle cx="14" cy="6" r="2"></circle>
													<line x1="4" y1="6" x2="12" y2="6"></line>
													<line x1="16" y1="6" x2="20" y2="6"></line>
													<circle cx="8" cy="12" r="2"></circle>
													<line x1="4" y1="12" x2="6" y2="12"></line>
													<line x1="10" y1="12" x2="20" y2="12"></line>
													<circle cx="17" cy="18" r="2"></circle>
													<line x1="4" y1="18" x2="15" y2="18"></line>
													<line x1="19" y1="18" x2="20" y2="18"></line>
												</svg>
												Edit Settings
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php
							$username = htmlentities($AccountInfo["account_username"]);
							$password = htmlentities($AccountInfo["account_password"]);
							$mdomain = htmlentities($AccountInfo["account_domain"]);
							$sqlhost = htmlentities(
								str_replace(
									"cpanel",
									$AccountInfo["account_sql"],
									$HostingApi["api_cpanel_url"]
								)
							);
							?>
							<div class="col-12 mt-2">
								<div class="row row-cards">
									<div class="col-md-6">
										<div class="card">

											<div class="card-header">
												<h3 class="card-title">
													Account Details
												</h3>
											</div>
											<table class="table card-table">
												<tbody>
													<tr>
														<td><strong>Account Username</strong></td>
														<td><?php echo $username; ?></td>
													</tr>
													<tr>
														<td><strong>Account Password</strong></td>
														<td class="d-flex justify-content-between">
															<code id="passwordHide">****************</code>
															<code id="passwordShow" class="d-none"><?php echo $AccountInfo["account_password"]; ?></code>
															<form class="d-inline" action="javascript:if(document.getElementById('passwordShow').classList.contains('d-none')){
            document.getElementById('passwordShow').classList.remove('d-none');
            document.getElementById('passwordHide').classList.add('d-none');}else{
                document.getElementById('passwordShow').classList.add('d-none');
                document.getElementById('passwordHide').classList.remove('d-none')}">
																<button type="submit" class="btn btn-outline-info btn-sm d-inline">
																	<span><span class="bi bi-plus-circle pe-1"></span>Expose/Protect</span>
																</button>
															</form>
														</td>
													</tr>
													<tr>
														<td><strong>Account Status</strong></td>
														<td>
															<span class="badge bg-teal">
																Active
															</span>
														</td>
													</tr>
													<tr>
														<td><strong>Main Domain</strong></td>
														<td><?php echo $mdomain; ?></td>
													</tr>
													<tr>
														<td><strong>Website IP</strong></td>
														<td>185.27.134.3</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">

											<div class="card-header">
												<h3 class="card-title">
													FTP Details</h3>
											</div>
											<table class="table card-table">
												<tbody>
													<tr>
														<td><strong>FTP Username</strong></td>
														<td><?php echo $username; ?></td>
													</tr>
													<tr>
														<td><strong>FTP Password</strong></td>
														<td class="d-flex justify-content-between">
															<code id="passwordHide1">****************</code>
															<code id="passwordShow1" class="d-none"><?php echo $password; ?></code>
															<form class="d-inline" action="javascript:if(document.getElementById('passwordShow1').classList.contains('d-none')){
            document.getElementById('passwordShow1').classList.remove('d-none');
            document.getElementById('passwordHide1').classList.add('d-none');}else{
                document.getElementById('passwordShow1').classList.add('d-none');
                document.getElementById('passwordHide1').classList.remove('d-none')}">
																<button type="submit" class="btn btn-outline-info btn-sm d-inline">
																	<span><span class="bi bi-plus-circle pe-1"></span>Expose/Protect</span>
																</button>
															</form>
														</td>
													</tr>
													<tr>
														<td><strong>FTP Hostname</strong></td>
														<td>ftpupload.net</td>
													</tr>
													<tr>
														<td><strong>FTP Port</strong></td>
														<td>21</td>
													</tr>
													<tr>
														<td><strong>FTP Address</strong></td>
														<td>185.27.134.11</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">

											<div class="card-header">
												<div class="card-title">
													<h3 class="card-title">MySQL Details</h3>
												</div>
											</div>
											<table class="table card-table">
												<tr>
													<td><strong>MySQL Username</strong></td>
													<td><?php echo $username; ?></td>
												</tr>
												<tr>
													<td><strong>MySQL Password</strong></td>
													<td class="d-flex justify-content-between">
														<code id="passwordHide2">****************</code>
														<code id="passwordShow2" class="d-none"><?php echo $password; ?></code>
														<form class="d-inline" action="javascript:if(document.getElementById('passwordShow2').classList.contains('d-none')){
            document.getElementById('passwordShow2').classList.remove('d-none');
            document.getElementById('passwordHide2').classList.add('d-none');}else{
                document.getElementById('passwordShow2').classList.add('d-none');
                document.getElementById('passwordHide2').classList.remove('d-none')}">
															<button type="submit" class="btn btn-outline-info btn-sm d-inline">
																<span><span class="bi bi-plus-circle pe-1"></span>Expose/Protect</span>
															</button>
														</form>
													</td>
												</tr>
												<tr>
													<td><strong>MySQL Hostname</strong></td>
													<td><?php echo $sqlhost; ?></td>
												</tr>
												<tr>
													<td><strong>MySQL Port</strong></td>
													<td>3306</td>
												</tr>
												<tr>
													<td><strong>Database Name</strong></td>
													<td><?php echo $username; ?>_XXX</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								<?php } else { ?>
									<div class="row">
										<div class="col-12">
										</div>
									</div>
								</div>
								<div class="page-body">
									<div class="container-xl">
										<div class="row row-cards">
											<div class="col-lg-12">
												<div class="row row-cards">
													<div class="col-12">
														<?php if ($AccountInfo["account_status"] == "0") {
															echo '<div class="alert alert-danger col-md-12"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <line x1="12" y1="8" x2="12.01" y2="8"></line> <polyline points="11 12 12 12 12 16 13 16"></polyline></svg> Your account is now deactivated. You cannot reactivate it anymore. This record will be deleted within a few days.</div>';
														} elseif ($AccountInfo["account_status"] == "2") {
															echo '<div class="alert alert-danger col-md-12">Your account has been suspended either due to abuse or exceeding server limits. Please contact the support team if you feel that this identification was false.</div>';
														} ?>
														<div class="row row-cards mb-2">
															<div class="col-12">
																<div class="list-group-item">
																	<div class="row">
																		<div class="col-lg-4 col-md-4 d-grid">
																			<button class="btn btn-outline-teal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																					<path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path>
																				</svg>&nbsp;Control Panel</button>
																		</div>
																		<div class="col-lg-4 col-md-4 d-grid">
																			<button class="btn btn-outline-yellow"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																					<path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path>
																					<polyline points="9 15 12 12 15 15"></polyline>
																					<line x1="12" y1="12" x2="12" y2="21"></line>
																				</svg>&nbsp;File Manager</button>
																		</div>
																		<div class="col-lg-4 col-md-4 d-grid">
																				<button class="btn btn-outline-azure"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																						<circle cx="14" cy="6" r="2"></circle>
																						<line x1="4" y1="6" x2="12" y2="6"></line>
																						<line x1="16" y1="6" x2="20" y2="6"></line>
																						<circle cx="8" cy="12" r="2"></circle>
																						<line x1="4" y1="12" x2="6" y2="12"></line>
																						<line x1="10" y1="12" x2="20" y2="12"></line>
																						<circle cx="17" cy="18" r="2"></circle>
																						<line x1="4" y1="18" x2="15" y2="18"></line>
																						<line x1="19" y1="18" x2="20" y2="18"></line>
																					</svg>&nbsp;Edit Settings</button>
																		</div>
																	</div>
																</div>
																<div class="col-12 mt-2">
																	<div class="row row-cards">
																		<div class="col-md-6">
																			<div class="card">
																				<div class="card-header">
																					<h3 class="card-title">
																						Account Details
																					</h3>
																				</div>
																				<table class="table card-table">
																					<tbody>
																						<tr>
																							<td><strong>Username</strong></td>
																							<td><?php echo $AccountInfo["account_username"]; ?></td>
																						</tr>
																						<tr>
																							<td><strong>Password</strong></td>
																							<td class="d-flex justify-content-between">
																								<code id="passwordHide">****************</code>
																								<code id="passwordShow" class="d-none"><?php echo $AccountInfo["account_password"]; ?></code>
																								<form class="d-inline" action="javascript:if(document.getElementById('passwordShow').classList.contains('d-none')){document.getElementById('passwordShow').classList.remove('d-none');document.getElementById('passwordHide').classList.add('d-none');}else{document.getElementById('passwordShow').classList.add('d-none');document.getElementById('passwordHide').classList.remove('d-none')}">
																									<button type="submit" class="btn btn-outline-info btn-sm d-inline">
																										<span>Show/Hide</span>
																									</button>
																								</form>
																							</td>
																						</tr>
																						<tr>
																							<td><strong>Status</strong></td>
																							<td>
																								<?php if ($AccountInfo["account_status"] == "1") {
																									echo '<span class="badge bg-green">Active</span>';
																								} elseif ($AccountInfo["account_status"] == "0") {
																									echo '<span class="badge bg-orange text-light">Deactivated</span>';
																								} elseif ($AccountInfo["account_status"] == "2") {
																									echo '<span class="badge bg-pinterest">Suspended</span>';
																								}?>
																							</td>
																						</tr>
																						<tr>
																							<td><strong>Main Domain</strong></td>
																							<td><?php echo $AccountInfo["account_domain"]; ?></td>
																						</tr>
																						<tr>
																							<td><strong>Website IP</strong></td>
																							<td>185.27.134.3</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="card">
																				<div class="card-header">
																					<h3 class="card-title">
																						FTP Details</h3>
																				</div>
																				<table class="table card-table">
																					<tbody>
																						<tr>
																							<td><strong>FTP Username</strong></td>
																							<td><?php echo $AccountInfo["account_username"]; ?></td>
																						</tr>
																						<tr>
																							<td><strong>FTP Password</strong></td>
																							<td class="d-flex justify-content-between">
																								<code id="passwordHide1">****************</code>
																								<code id="passwordShow1" class="d-none"><?php echo $AccountInfo["account_password"]; ?></code>
																								<form class="d-inline" action="javascript:if(document.getElementById('passwordShow1').classList.contains('d-none')){document.getElementById('passwordShow1').classList.remove('d-none');document.getElementById('passwordHide1').classList.add('d-none');}else{document.getElementById('passwordShow1').classList.add('d-none');document.getElementById('passwordHide1').classList.remove('d-none')}">
																									<button type="submit" class="btn btn-outline-info btn-sm d-inline">
																										<span>Show/Hide</span>
																									</button>
																								</form>
																							</td>
																						</tr>
																						<tr>
																							<td><strong>FTP Hostname</strong></td>
																							<td>ftpupload.net</td>
																						</tr>
																						<tr>
																							<td><strong>FTP Port</strong></td>
																							<td>21</td>
																						</tr>
																						<tr>
																							<td><strong>FTP Address</strong></td>
																							<td>185.27.134.11</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="card">
																				<div class="card-header">
																					<div class="card-title">
																						<h3 class="card-title">MySQL Details</h3>
																					</div>
																				</div>
																				<table class="table card-table">
																					<tr>
																						<td><strong>MySQL Username</strong></td>
																						<td><?php echo $AccountInfo["account_username"]; ?></td>
																					</tr>
																					<tr>
																						<td><strong>MySQL Password</strong></td>
																						<td class="d-flex justify-content-between">
																							<code id="passwordHide3">****************</code>
																							<code id="passwordShow3" class="d-none"><?php echo $AccountInfo["account_password"]; ?></code>
																							<form class="d-inline" action="javascript:if(document.getElementById('passwordShow3').classList.contains('d-none')){document.getElementById('passwordShow3').classList.remove('d-none');document.getElementById('passwordHide3').classList.add('d-none');}else{document.getElementById('passwordShow3').classList.add('d-none');document.getElementById('passwordHide3').classList.remove('d-none')}">
																								<button type="submit" class="btn btn-outline-info btn-sm d-inline">
																									<span>Show/Hide</span>
																								</button>
																							</form>
																						</td>
																					</tr>
																					<tr>
																						<td><strong>MySQL Hostname</strong></td>
																						<td><?php echo str_replace("cpanel", $AccountInfo["account_sql"], $HostingApi["api_cpanel_url"]); ?></td>
																					</tr>
																					<tr>
																						<td><strong>MySQL Port</strong></td>
																						<td>3306</td>
																					</tr>
																					<tr>
																						<td><strong>Database Name</strong></td>
																						<td><?php echo $AccountInfo["account_username"]; ?>_XXX</td>
																					</tr>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	<?php } ?>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
