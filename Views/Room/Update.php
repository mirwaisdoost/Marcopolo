<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    $row = mysqli_fetch_array($result);
    require_once './Models/room.php'; 
    $obj=isset($_SESSION['updateRoom'])?unserialize($_SESSION['updateRoom']):new room();
?>

<div class=" form-border h-100 overflow-auto" >
    <form action="update_room_data?show_id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">Update Room Details</h3></div>
        <div class="col col-md-6">
            <div class="form-group <?php echo (!empty($obj->roomNumber_msg)) ? 'has-error' : ''; ?>">
                <label>Room Number</label>
                <input type="text" name="roomNumber" class="form-control" value="<?php echo $row['roomNumber']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->roomNumber_msg ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($obj->details_msg)) ? 'has-error' : ''; ?>">
                <label>Details</label>
                <input type="text" name="details" class="form-control" value="<?php echo $row['details']; ?> " autocomplete="off">
                <span class="help-block"><?php echo $obj->details_msg; ?></span>
            </div>
            <div class="form-group mb-3 <?php echo (!empty($obj->roomtypeid_msg)) ? 'has-error' : ''; ?>">
                    <label for="Company" class="form-label text-secondary">Room Type</label>
                    <select class=" form-select" name="roomtypeid">
                        <?php
                            require_once "configcompany.php";
                            $roomtypeid = $row['roomtypeid'];
                            $result1 = mysqli_query($link,"SELECT * FROM roomtype WHERE id = $roomtypeid");
                            $row1=mysqli_fetch_array($result1);
                            $name1=$row1["name"];
                            $id1=$row1["id"];
                            echo "<option value='$id1'>$name1<br></option>";
                            
                            $result = mysqli_query($link,"SELECT * FROM roomtype WHERE id != $roomtypeid");
                            if($result){
                                while($row=mysqli_fetch_array($result)){
                                    $name=$row["name"];
                                    $id=$row["id"];
                                    echo "<option value='$id'>$name<br></option>";
                                }
                            }

                            mysqli_close($link);
                        ?>
                    </select>
                    <span class="help-block text-danger"><?php echo $obj->roomtypeid_msg; ?></span>
                </div> 
        </div> 
        <div class="form-group col-md-7 mt-3">
            <input type="submit" class="btn btn-danger" value="Submit" name="submit">
            <a class="btn btn-primary" href="room_list">Cancel</a>
        </div>
    </form>
</div>
<?php require('./Components/footer.inc.php')?>