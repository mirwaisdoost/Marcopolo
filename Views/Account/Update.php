
<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    $row = mysqli_fetch_array($result);
    require_once './Models/user.php'; 
    $usertb=isset($_SESSION['updateUser'])?unserialize($_SESSION['updateUser']):new user();
?>

<div class=" form-border h-100 overflow-auto" >
    <form action="update_user_data?show_id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Update User Profile</h3></div>
        <div class="col col-md-6">
            <div class="form-group <?php echo (!empty($usertb->name_msg)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $usertb->name_msg; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($usertb->lastName_msg)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $row['last_name']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $usertb->lastName_msg; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($usertb->type_msg)) ? 'has-error' : ''; ?>">
                <label>Type</label>
                <select class=" form-select" id="1" name="type"  value="<?php echo $row['type']; ?> ">
                    <option value="<?php echo $row['type']; ?>" >
                        <?php 
                            if($row['type']==1){
                                echo "Admin";
                            } else if($row['type']==2){
                                echo "Maintenance";
                            } else if($row['type']==3){
                                echo "Cook";
                            } else {
                                echo "Guard";
                            } 
                        ?> 
                    </option>
                    <?php
                        if($row['type'] == 1){
                            echo '
                                <option value="2">Maintenance</option>
                                <option value="3">Cook</option>
                                <option value="4">Guard</option>
                            ';
                        }else if($row['type'] == 2){
                            echo '
                                <option value="1">Admin</option>
                                <option value="3">Cook</option>
                                <option value="4">Guard</option>
                            ';
                        }else if($row['type'] == 3){
                            echo '
                                <option value="1">Admin</option>
                                <option value="2">Maintenance</option>
                                <option value="4">Guard</option>
                            ';
                        }else if($row['type'] == 4){
                            echo '
                                <option value="1">Admin</option>
                                <option value="2">Maintenance</option>
                                <option value="3">Cook</option>
                            ';
                        }
                    ?>
                </select>
                <span class="help-block"><?php echo $usertb->type_msg; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($usertb->email_msg)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $usertb->email_msg; ?></span>
            </div>
        </div> 
        <div class="col-md-6">
            <div class="form-group mt-2 <?php echo (!empty($usertb->photo_msg)) ? 'has-error' : ''; ?>">
                <div class="image-preview" id="imagePreview">
                    <img src="<?php if(!empty($row['photo'])){echo "./libs/photo/" . $row['photo'];}else{echo "./libs/photo/user.jpg";} ?>" class="image-preview__image" id="image-preview__image" alt="Imge Preivew" style="display:block;">
                    <span class="image-preview__defualt-text" id="image-preview__defualt-text" style="display: none;">Image Preview</span>
                </div>
                <input type="file" name="file" id="inptFile">
                <span class="help-block"><?php echo $usertb->photo_msg; ?></span>
            </div>
            <div class="radio pl-2">
                <label><input type="radio" name="status" value="1" <?php if($row['is_active']==1){echo "checked";} ?> >Active</label>
            </div>
            <div class="radio pl-2">
                <label><input type="radio" name="status" value="0" <?php if($row['is_active']==0){echo "checked";} ?> >Inactive</label>
            </div>
        </div>
        <div class="form-group col-md-7 mt-3">
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
            <a class="btn btn-primary" href="user_list">Cancel</a>
        </div> 
    </form>
</div>
<?php require('./Components/footer.inc.php')?>