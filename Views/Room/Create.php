<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    require_once './Models/room.php'; 
    $obj=isset($_SESSION['roomtbl'])?unserialize($_SESSION['roomtbl']):new room();
?>

    <div class=" form-border h-100 overflow-auto pb-4">
        <form action="create_room_data" method="post" enctype="multipart/form-data">
            <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">New Room</h3></div>
            <div class="col col-md-6">
                <div class="form-group <?php echo (!empty($obj->roomNumber_msg)) ? 'has-error' : ''; ?>">
                    <label>Room Number</label>
                    <input type="text" name="roomNumber" class="form-control" value="<?php echo $obj->roomNumber; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->roomNumber_msg; ?></span>
                </div>  
                <div class="form-group <?php echo (!empty($obj->details_msg)) ? 'has-error' : ''; ?>">
                    <label>Details</label>
                    <input type="text" name="details" class="form-control" value="<?php echo $obj->details; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->details_msg; ?></span>
                </div>  
                <div class="form-group mb-3 <?php echo (!empty($obj->roomtypeid_msg)) ? 'has-error' : ''; ?>">
                    <label for="Company" class="form-label text-secondary">Room Type</label>
                    <select class=" form-select" name="roomtypeid">
                        <option value="">Select Room Type</option>
                        <?php
                            require_once "configcompany.php";
                            
                            $result = mysqli_query($link,"SELECT * FROM roomtype");
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
                    <span class="help-block"><?php echo $obj->roomtypeid_msg; ?></span>
                </div> 
            </div> 
            <div class="form-group col-md-7">
                <input type="submit" class="btn btn-danger" value="Submit" name="submit">
                <a class="btn btn-primary" href="room_list">Cancel</a>
            </div> 
        </form>
    </div> 
<?php require('./Components/footer.inc.php')?>