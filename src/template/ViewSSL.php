<?php
$apiClient = new GoGetSSLApi();
$token = $apiClient->auth($SSLApi['api_username'], $SSLApi['api_password']);
$sql1 = $fetch;
$SSLInfo = $apiClient->getOrderStatus($_GET['ssl_id']);
if ($SSLInfo['status'] == 'processing') {
	$stat = '<span class="badge bg-primary">Processing</span>';
} elseif ($SSLInfo['status'] == 'active') {
	$stat = '<span class="badge bg-success">Active</span>';
} elseif ($SSLInfo['status'] == 'cancelled') {
	$stat = '<span class="badge bg-danger">Cancelled</span>';
} elseif ($SSLInfo['status'] == 'expired') {
	$stat = '<span class="badge bg-danger">Expired</span>';
}
if (empty($SSLInfo['begin_date'])) {
	$Begin = '** ** ****';
	$End = $Begin;
} else {
	$Begin = $SSLInfo['begin_date'];
	$End = $SSLInfo['end_date'];
}
?>
<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">SSL Certificate For <code><?php echo $SSLInfo['domain']; ?></code></h3>
					</div>
					<div class="row">
						<div class="page-body">
							<div class="container-xl">
								<div class="row row-cards">
									<div class="col-lg-3 col-md-12">
										<div class="card text-center">
											<div class="card-body">
												<div class="font-weight-medium">
													Status: <?php echo $stat; ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="card text-center">
											<div class="card-body">
												<div class="font-weight-medium">
													Domain: <?php echo $SSLInfo['domain']; ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="card text-center">
											<div class="card-body">
												<div class="font-weight-medium">
													Start: <code><?php echo $Begin; ?></code>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="card text-center">
											<div class="card-body">
												<div class="font-weight-medium">
													End: <code><?php echo $End; ?></code>
												</div>
											</div>
										</div>
									</div>
									<?php if ($SSLInfo['status'] == 'processing') {
										$Record = explode(' ', $SSLInfo['approver_method']['dns']['record']);
									?>
										<div class="col-md-12">
											<div class="alert alert-info">Please setup the above CNAME record on your domain. This record is necessary for the certificate provider to prove you own the domain name. Please note that DNS changes can take a few hours to take effect. <a href="https://forum.royalityfree.com/docs?topic=24" class="alert-link">View Instructions</a>.</div>
											<div class="my-2 mx-10 d-none">
												<b>CSR Code:</b>
												<code class="my-0"><textarea class="form-control" style="height: 250px" readonly><?php echo $SSLInfo['csr_code']; ?></textarea></code>
											</div>
											<div class="my-10 mx-10">
												<b>Record:</b>
												<?php
												$dot = '.';
												$find = $dot . $SSLInfo['domain'];
												$replace = '';
												$from = $Record['0'];
												$toprint = str_replace($find, $replace, $from);
												?>
												<input type="text" class="form-control mt-2" value="<?php print_r(strtolower($toprint)) ?>" readonly>
											</div>
											<div class="my-10 mx-10">
												<b>Destination:</b>
												<input type="text" class="form-control mt-2" value="<?php echo $Record['2']; ?>" readonly>
											</div>
										</div>
									<?php } elseif ($SSLInfo['status'] == 'processing') { ?>
										<div class="col-12">
											<div class="card">
												<div class="card-header">
													<h3 class="card-title">Private Key and Certificate</h3>
													<button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="collapse" data-bs-target="#certificatePrivate">Show</button>
												</div>
												<div class="card-body collapse" id="certificatePrivate">
													<div class="alert alert-info">
														<h4 class="alert-title">Not sure what to do with these?</h4>
														<div>
															Check the article
															<a href="https://forum.royalityfree.com/docs?topic=25#if-you-already-have-a-private-key-2" target="_blank" class="alert-link">
																How to install an SSL Certificate
															</a>
															in the knowledge base.
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<h4>Private Key</h4>
															<pre><?php echo $sql1['ssl_pk']; ?>
</pre>
														</div>
														<div class="col-md-6">
															<h4>Certificate</h4>
															<pre><?php echo $SSLInfo['crt_code']; ?>
</pre>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php } elseif ($SSLInfo['status'] == 'cancelled') { ?>
										<div class="col-lg-12">
											<div class="my-5 mx-10">
												<b>CSR Code:</b>
												<pre class="my-0"><textarea class="form-control" style="height: 250px" readonly><?php echo $SSLInfo['csr_code']; ?></textarea></pre>
											</div>
										</div>
									<?php } elseif ($SSLInfo['status'] == 'expired') { ?>
										<div class="col-lg-12">
											<div class="my-5 mx-10">
												<b>Certificate Code:</b>
												<pre class="my-0"><textarea class="form-control" style="height: 250px" readonly>-----</textarea></pre>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="my-5 mx-10">
												<b>CA Bundle:</b>
												<pre class="my-0"><textarea class="form-control" style="height: 250px" readonly>-----</textarea></pre>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <?php if ($SSLInfo['status'] == 'active') { ?>
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Make your website use HTTPS</h3>
						</div>
						<div class="card-body">
							<p>Is your SSL certificate installed successfully? Then you will want to do the following to start using it:</p>
							<ol>
								<li>
									<strong>Make sure all URLs use HTTPS.</strong>
									You can do this by <a href="https://<?php echo $SSLInfo['domain']; ?>" target="_blank" rel="noreferrer">
										opening your website with HTTPS
									</a> and making sure you see a green lock in your address bar.
								</li>
								<li>
									<strong>Force all visitors to use HTTPS.</strong> You can read more about that in our
									<a href="https://forum.royalityfree.com/docs?topic=52" target="_blank">knowledge base</a>.
								</li>
							</ol>
						</div>
					</div>
				</div>
		</div>
	<?php } ?>