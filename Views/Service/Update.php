<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    $row = mysqli_fetch_array($result);
    require_once './Models/service.php'; 
    $obj=isset($_SESSION['updateService'])?unserialize($_SESSION['updateService']):new service();
?>

<div class=" form-border h-100 overflow-auto" >
    <form action="update_service_data?show_id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Update Service Details</h3></div>
        <div class="col col-md-6">
            <div class="form-group <?php echo (!empty($obj->name_msg)) ? 'has-error' : ''; ?>">
                <label>name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->name_msg ?></span>
            </div> 
        </div> 
        <div class="form-group col-md-7 mt-3">
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
            <a class="btn btn-primary" href="service_list">Cancel</a>
        </div>
    </form>
</div>
<?php require('./Components/footer.inc.php')?>