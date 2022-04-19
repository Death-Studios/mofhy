<?php
require __DIR__.'/Connect.php';
require __DIR__.'/../handler/SessionHandler.php';
if(isset($_POST['submit'])){
    $analytics_key = 'GTAG';
    $analytics_tracking_id = strip_tags($_POST['analytics_tracking_id']);
	$sql = "UPDATE `google_analytics` SET `analytics_tracking_id`= ? WHERE `analytics_key`= ? LIMIT 1";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param('ss', $analytics_tracking_id, $analytics_key);
	$trigger = $stmt->execute();
	if($trigger !== false){
		$_SESSION['message'] = '<div class="alert alert-success" role="alert"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <path d="M9 12l2 2l4 -4"></path></svg>&nbsp;The new Google Analytic Tracking ID has been updated successfully!</div>';
		header('location: ../apiSettings');
	}
	else{
		$_SESSION['message'] = '<div class="alert alert-danger"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <path d="M10 10l4 4m0 -4l-4 4"></path></svg>&nbsp;Yikes, something is going the wrong way. Please contact support.</div>';
		header('location: ../apiSettings');
	}
}
else{
	header('location: ../');
}
$stmt->close();
?>
