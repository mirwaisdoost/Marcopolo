
<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    require_once './Models/user.php'; 
    $usertb=isset($_SESSION['changePassword'])?unserialize($_SESSION['changePassword']):new user();
?>
    <div class=" form-border h-100 overflow-auto pb-4">
        <form action="changePassword_data" method="post" enctype="multipart/form-data">
            <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Reset Password</h3></div>
            <p class=" ml-3 mb-4">Please enter the new password for you account account.</p>
            <div class="col col-md-6">
                <div class="form-group <?php echo (!empty($usertb->oldPassword_msg)) ? 'has-error' : ''; ?>">
                    <label>Old Password</label>
                    <input type="password" name="old_password" class="form-control" value="<?php echo $usertb->oldPassword; ?>">
                    <span class="help-block"><?php echo $usertb->oldPassword_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($usertb->password_msg)) ? 'has-error' : ''; ?>">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $usertb->password; ?>">
                    <span class="help-block"><?php echo $usertb->password_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($usertb->confirmPassword_msg)) ? 'has-error' : ''; ?>">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $usertb->confirmPassword; ?>">
                    <span class="help-block"><?php echo $usertb->confirmPassword_msg; ?></span>
                </div>
                
            </div> 
            <div class="form-group col-md-7">
                <input type="submit" class="btn btn-danger" value="Submit" name="submit">
                <a class="btn btn-primary" href="Dashboard">Cancel</a>
            </div> 
        </form>
    </div> 
<?php require('./Components/footer.inc.php')?>