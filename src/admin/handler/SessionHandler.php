<?php
if (isset($_SESSION['LEASESS']))
{
    $cookie = base64_decode($_SESSION['LEASESS']);
    $sql = "SELECT * FROM `hosting_admin` WHERE `admin_email`= ?";
    $stmt = $connect->prepare($sql);
	$stmt -> bind_param("s", $cookie);
	$stmt -> execute();
	$rows = $stmt->get_result()->num_rows;
	$fetch = $stmt->get_result()->fetch_assoc();
	$stmt -> close();
    if ($rows>0)
    {
        $AdminInfo = $fetch;
    }
    else
    {
        unset($_SESSION['LEASESS']);
        $_SESSION['message'] = '<div class="alert alert-danger">Your previous session has expired.</div>';
        header('location: login');
        exit;
    }
}
else
{
    $_SESSION['message'] = '<div class="alert alert-danger">Your previous session has expired.</div>';
    header('location: login');
    exit;
}
?>
