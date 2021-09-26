<?php require('./Components/bodyhead.inc.php')?>
<?php require('./Components/header.inc.php')?>
<?php  
    $row = mysqli_fetch_array($result);
?>
    <div class=" h-100 form-border overflow-auto pb-2">
        <div class="alert alert-secondary FooterLine w-100 mb-5">
            <span class=" h3">Service Details</span>
        </div> 
       <div style="width: fit-content;">
            <div class=" pb-3 text-right">
               <form action="" method="post"> 
                    <a href="delete_service?show_id=<?php echo $row["id"]; ?>" class="btn btn-danger p-0 pr-2 pl-2" onclick="return confirm('Are you sure to delete the selected service?')">Delete</a>
                    <a href="update_service?show_id=<?php echo $row["id"]; ?>" class="btn btn-primary p-0 pr-2 pl-2" href="">Edit</a>
                </form>
            </div>
            <div style="display: flex;" class="pl-4">
                
                <div class=" p-2">
                    <label class="pb-1">Name:</label> <br>
                </div>
                <div class="text-right p-2" style="width:fit-content; min-width: 200px;">
                    <p><?php echo $row['name'] ?></p>
                </div>
            </div>
       </div>
    </div>  
    <?php require('./Components/footer.inc.php')?>