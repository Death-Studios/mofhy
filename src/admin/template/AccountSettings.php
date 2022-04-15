<?php
if ($AccountInfo['account_status'] == '0' || $AccountInfo['account_status'] == '2') {
    header('Location: viewAccount?account_id=' . $_GET['account_id'] . '');
}
$account_id = $_GET['account_id'];
?>
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="row">
            </div>
            <div class="page-body">
                <h1 class="page-title">
                    Edit <?php
                            echo $account_id;
                            ?> (<?php
                                echo $AccountInfo['account_label'];
                                ?>) </h1>
                <div class="page-header mt-0">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='mt-2'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Hosting Account Password</h3>
                    </div>
                    <div class="card-body">
                        <form class="row" action="function/ChangePassword" method="post">
                            <div class="col-md-12">
                                <div class="px-10">
                                    <label class="form-label required">New Password</label>
                                    <input type="password" name="new_password" placeholder="(new password to set)" class="form-control" required>
                                    <input type="hidden" name="account_username" value="<?php echo mysqli_real_escape_string($connect, $AccountInfo['account_username']); ?>">
                                    <input type="hidden" name="account_password" value="<?php echo mysqli_real_escape_string($connect, $AccountInfo['account_password']); ?>">
                                    <input type="hidden" name="account_key" value="<?php echo bin2hex($AccountInfo['account_key']); ?>">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="px-10">
                                    <input type="submit" name="submit" value="Save Password" class="btn bg-primary text-white">
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
