<?php require('./Components/bodyhead.inc.php')?>
<?php require('./Components/header.inc.php')?>
<?php  
    $row = mysqli_fetch_array($result);
?>
    <div class=" h-100 form-border overflow-auto pb-2">
        <div class="alert alert-secondary FooterLine w-100 mb-5">
            <span class=" h3">Room Details</span>
        </div> 
       <div style="width: fit-content;">
            <div class=" pb-3 text-right">
               <form action="" method="post"> 
                    <a class="btn btn-primary p-0 pr-2 pl-2" href="room_list">Back to list</a>
                    <a href="delete_room?show_id=<?php echo $row["id"]; ?>" class="btn btn-danger p-0 pr-2 pl-2" onclick="return confirm('Are you sure to delete the selected room?')">Delete</a>
                    <a href="update_room?show_id=<?php echo $row["id"]; ?>" class="btn btn-primary p-0 pr-2 pl-2" href="">Edit</a>
                </form>
            </div>
            <div style="display: flex;" class="pl-4">
                
                <div class=" p-2">
                    <label class="pb-1">Room Number:</label> <br>
                    <label class="pb-1">Details:</label> <br>
                    <label class="pb-1">Room Type:</label> <br>
                </div>
                <div class="text-right p-2" style="width:fit-content; min-width: 200px;">
                    <p><?php echo $row['roomNumber'] ?></p>
                    <p><?php echo $row['details'] ?></p>
                    <?php
                        require_once "configcompany.php";
                        $roomtypeid = $row['roomtypeid'];
                        $result1 = mysqli_query($link,"SELECT name FROM roomtype WHERE id = $roomtypeid");
                        $row1=mysqli_fetch_array($result1);
                        mysqli_close($link);
                    ?>
                    <p><?php echo $row1["name"] ?></p>
                </div>
            </div>
       </div>
    </div>  
    <?php require('./Components/footer.inc.php')?>