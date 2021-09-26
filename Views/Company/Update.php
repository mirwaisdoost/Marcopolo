<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    $row = mysqli_fetch_array($result);
    require_once './Models/company.php'; 
    $obj=isset($_SESSION['updateCompany'])?unserialize($_SESSION['updateCompany']):new company();
?>

<div class=" form-border h-100 overflow-auto" >
    <form action="update_company_data?show_id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Update Company Details</h3></div>
        <div class="col col-md-6">
            <div class="form-group <?php echo (!empty($obj->name_msg)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->name_msg; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($obj->email_msg)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->email_msg; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($obj->phone_msg)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->phone_msg; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($obj->address_msg)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->address_msg; ?></span>
            </div> 
        </div> 
        <div class="form-group col-md-7 mt-3">
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
            <a class="btn btn-primary" href="company_list">Cancel</a>
        </div>
    </form>
</div>
<?php require('./Components/footer.inc.php')?>