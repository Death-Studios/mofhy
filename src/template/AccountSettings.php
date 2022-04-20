<?php
$AccountInfo = $fetch;
$account_id = $_GET['account_id'];
if ($AccountInfo['account_status'] == '0' || $AccountInfo['account_status'] == '2') {
    header('Location: viewAccount.php?account_id='.$account_id.'');
}
?>
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="row">
            </div>
            <div class="page-body">
                <h1 class="page-title">
                    Edit <?php echo $account_id;?> (<?php echo $AccountInfo['account_label']; ?>) 
                </h1>
                <div class="page-header mt-0">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='mt-2'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hosting Account Label</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label class="form-label required">Account Label</label>
                                <input type="text" name="label" class="form-control" value="<?php echo mysqli_real_escape_string($connect, $AccountInfo['account_label']); ?>">
                                <input type="hidden" name="username" value="<?php echo mysqli_real_escape_string($connect, $AccountInfo['account_username']); ?>">
                            </div>
                            <input type="submit" name="update" class="btn bg-primary text-light" value="Update Label"></input>
                        </form>
                    </div>
                </div>
                <div class="card mt-3 mb-3">
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Delete Account (Danger Zone)</h3>
            </div>
            <div class="card-body">
                <p class="mx-10 alert alert-warning"><b>Note</b>: We require you to remove all domains, subdomains and addon domains before deactivation. Please contact support if you need assistance!</p>
                <div class="mt-2 px-10">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-account-modal">Deactivate Account</button>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="m-3">
                        <form action="function/DeactivateAccount" method="post" onsubmit="
            var reason = document.getElementById('reason').value;
            if(reason.length<8){
                alert('Oops! Reason Too Short!');
                return false;
            }
            return true;
        "><label class="form-label required">Deactivation Reason</label>
                            <textarea name="reason" placeholder="Deactivation Reason (min. 8)" class="form-control" id="reason" required></textarea>
                            <input type="hidden" name="account_username" value="<?php
                                                                                echo $AccountInfo['account_username'];
                                                                                ?>">
                            <input type="hidden" name="account_key" value="<?php
                                                                            echo $AccountInfo['account_key'];
                                                                            ?>">
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-white w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="account_username" value="<?php
                                                                                        echo $AccountInfo['account_username'];
                                                                                        ?>">
                                    <input type="hidden" name="account_key" value="<?php
                                                                                    echo $AccountInfo['account_key'];
                                                                                    ?>">
                                    <input type="submit" name="submit" class="btn btn-danger w-100" value="Deactivate Account">
                                    </input>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['update'])) {
            $username = $_POST['username'];
            $label = $_POST['label'];
            $sql      = "UPDATE `hosting_account` SET `account_label`= ? WHERE `account_username`= ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sss", $label, $username, $ss);
            $trigger = $stmt->execute();
            $error = $stmt->error;
            $stmt->close();
            if ($trigger !== false) {
                $_SESSION['message'] = "<div class='alert alert-success'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-circle-check alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><path d='M9 12l2 2l4 -4'></path></svg><span class='alert-title'>Success!</span><span> The account label has been updated!</span></div>";
                header('location: ../settings?account_id=' . $username);
            } else {
                $_SESSION['message'] = "<div class='alert alert-danger'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-alert-circle alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><circle cx='12' cy='12' r='9'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12.01' y2='16'></line></svg><span class='alert-title'> Error</span>: " . $error . "</div>";
                header('location: ../settings?account_id=' . $username);
            }
        }
        ?>
        
