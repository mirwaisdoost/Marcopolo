<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    require_once './Models/service.php'; 
    $obj=isset($_SESSION['servicetbl'])?unserialize($_SESSION['servicetbl']):new service();
?>

    <div class=" form-border h-100 overflow-auto pb-4">
        <form action="create_service_data" method="post" enctype="multipart/form-data">
            <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">New Service</h3></div>
            <div class="col col-md-6">
                <div class="form-group <?php echo (!empty($obj->name_msg)) ? 'has-error' : ''; ?>">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $obj->name; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->name_msg; ?></span>
                </div>  
            </div> 
            <div class="form-group col-md-7">
                <input type="submit" class="btn btn-danger" value="Submit" name="submit">
                <a class="btn btn-primary" href="service _list">Cancel</a>
            </div> 
        </form>
    </div> 
<?php require('./Components/footer.inc.php')?>