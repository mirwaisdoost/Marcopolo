<?php require('./Components/bodyhead.inc.php')?>
<?php require('./Components/header.inc.php')?>
<?php  
    $row = mysqli_fetch_array($result);
?>
    <div class=" h-100 form-border overflow-auto pb-2">
        <div class="alert alert-secondary FooterLine w-100 mb-5">
            <span class=" h3">Guest Profile</span>
        </div> 
       <div style="width: fit-content;">
            <div class=" pb-3 text-right">
                <div style="width: 120px; margin-left:30px;">
                    <img src="<?php if(!empty($row['photo'])){echo "./libs/photo/" . $row['photo'];}else{echo "./libs/photo/user.jpg";} ?>" class=" img-fluid ">
                </div>
               <form action="" method="post"> 
                    <a href="delete_guest?show_id=<?php echo $row["id"]; ?>" class="btn btn-danger p-0 pr-2 pl-2" onclick="return confirm('Are you sure to delete the selected guest?')">Delete</a>
                    <a href="update_guest?show_id=<?php echo $row["id"]; ?>" class="btn btn-primary p-0 pr-2 pl-2" href="">Edit</a>
                </form>
            </div>
            <div style="display: flex;" class="pl-4">
                
                <div class=" p-2">
                    <label class="pb-1">Name:</label> <br>
                    <label class="pb-1">Last Name:</label> <br>
                    <label class="pb-1">Email:</label> <br>
                    <label class="pb-1">Phone:</label> <br>
                    <label class="pb-1">Address:</label> <br>
                </div>
                <div class="text-right p-2" style="width:fit-content; min-width: 200px;">
                    <p><?php echo $row['name'] ?></p>
                    <p><?php echo $row['lastName'] ?></p>
                    <p><?php echo $row['email'] ?></p>
                    <p><?php echo $row['phone'] ?></p>
                    <p><?php echo $row['address'] ?></p>
                </div>
            </div>
       </div>
    </div>  
    <?php require('./Components/footer.inc.php')?>