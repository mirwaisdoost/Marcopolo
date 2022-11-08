<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    require_once './Models/user.php'; 
    $usertb=isset($_SESSION['usertbl'])?unserialize($_SESSION['usertbl']):new user();
?>

    <div class=" form-border h-100 overflow-auto pb-4">
        <form action="create_user_data" method="post" enctype="multipart/form-data">
            <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Sign Up</h3></div>
            <p class=" ml-3 mb-4">Please fill this form to create an account.</p>
            <div class="col col-md-6">
                <div class="form-group <?php echo (!empty($usertb->name_msg)) ? 'has-error' : ''; ?>">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $usertb->name; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $usertb->name_msg; ?></span>
                </div>  
                <div class="form-group <?php echo (!empty($usertb->lastName_msg)) ? 'has-error' : ''; ?>">
                    <label>Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo $usertb->lastName; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $usertb->lastName_msg; ?></span>
                </div>   
                <div class="form-group <?php echo (!empty($usertb->type_msg)) ? 'has-error' : ''; ?>">
                    <label>Type</label>
                    <select class=" form-select" id="1" name="type">
                        <?php
                            if($usertb->type > 0){
                                if($usertb->type == 1){
                                    echo '
                                        <option value="1">Admin</option>
                                        <option value="2">Maintenance</option>
                                        <option value="3">Cook</option>
                                        <option value="4">Guard</option>
                                    ';
                                }else if($usertb->type == 2){
                                    echo '
                                        <option value="2">Maintenance</option>
                                        <option value="1">Admin</option>
                                        <option value="3">Cook</option>
                                        <option value="4">Guard</option>
                                    ';
                                }else if($usertb->type == 3){
                                    echo '
                                        <option value="3">Cook</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Maintenance</option>
                                        <option value="4">Guard</option>
                                        ';
                                }else if($usertb->type == 4){
                                    echo '
                                        <option value="4">Guard</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Maintenance</option>
                                        <option value="3">Cook</option>
                                    ';
                                }
                            }else{
                                echo '
                                <option value="">Select Type</option>
                                <option value="1">Admin</option>
                                <option value="2">Maintenance</option>
                                <option value="3">Cook</option>
                                <option value="4">Guard</option>
                                ';
                            }
                        ?>
                    </select>
                    <span class="help-block"><?php echo $usertb->type_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($usertb->email_msg)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $usertb->email; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $usertb->email_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($usertb->username_msg)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $usertb->username; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $usertb->username_msg; ?></span>
                </div>    
            </div> 
            <div class="col col-md-6">
                <div class="form-group mt-2 <?php echo (!empty($usertb->photo_msg)) ? 'has-error' : ''; ?>">
                    <div class="image-preview" id="imagePreview">
                        <img src="" class="image-preview__image" id="image-preview__image" alt="Imge Preivew">
                        <span class="image-preview__defualt-text" id="image-preview__defualt-text">Image Preview</span>
                    </div>
                    <input type="file" name="file" id="inptFile">
                    <span class="help-block"><?php echo $usertb->photo_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($usertb->password_msg)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $usertb->password; ?>">
                    <span class="help-block"><?php echo $usertb->password_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($usertb->confirmPassword_msg)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $usertb->confirmPassword; ?>">
                    <span class="help-block"><?php echo $usertb->confirmPassword_msg; ?></span>
                </div>
                
            </div> 
            <div class="form-group col-md-7">
                <input type="submit" class="btn btn-danger" value="Submit" name="submit">
                <a class="btn btn-primary" href="user_list">Cancel</a>
            </div> 
        </form>
    </div> 
<?php require('./Components/footer.inc.php')?>