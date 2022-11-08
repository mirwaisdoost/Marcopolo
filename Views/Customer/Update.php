<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    $row = mysqli_fetch_array($result);
    require_once './Models/guest.php'; 
    $guesttb=isset($_SESSION['updateGuest'])?unserialize($_SESSION['updateGuest']):new guest();
?>

<div class=" form-border h-100 overflow-auto" >
    <form action="update_guest_data?show_id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Update Guest Profile</h3></div>
        <div class="col col-md-6">
            <div class="form-group <?php echo (!empty($guesttb->name_msg)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $guesttb->name_msg; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($guesttb->lastName_msg)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $row['lastName']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $guesttb->lastName_msg; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($guesttb->email_msg)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $guesttb->email_msg; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($guesttb->phone_msg)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $guesttb->phone_msg; ?></span>
            </div>
        </div> 
        <div class="col-md-6">
            <div class="form-group mt-2 <?php echo (!empty($guesttb->photo_msg)) ? 'has-error' : ''; ?>">
                <div class="image-preview" id="imagePreview">
                    <img src="<?php if(!empty($row['photo'])){echo "./libs/photo/" . $row['photo'];}else{echo "./libs/photo/user.jpg";} ?>" class="image-preview__image" id="image-preview__image" alt="Imge Preivew" style="display:block;">
                    <span class="image-preview__defualt-text" id="image-preview__defualt-text" style="display: none;">Image Preview</span>
                </div>
                <input type="file" name="file" id="inptFile">
                <span class="help-block"><?php echo $guesttb->photo_msg; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($guesttb->address_msg)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $guesttb->address_msg; ?></span>
            </div>
        </div>
        <div class="form-group col-md-7 mt-3">
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
            <a class="btn btn-primary" href="guest_list">Cancel</a>
        </div> 
    </form>
</div>
<?php require('./Components/footer.inc.php')?>