<?php 
    require('./Components/bodyhead.inc.php');
    require('./Components/header.inc.php');
    require_once './Models/company.php'; 
    $obj=isset($_SESSION['companytbl'])?unserialize($_SESSION['companytbl']):new company();
?>

<!-- The Modal -->
<div id="RoomModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <p class="close">x</p>
    <div class="p-3">
    <div class="col col-md-12">
        <div class="form-group <?php echo (!empty($usertb->type_msg)) ? 'has-error' : ''; ?>">
            <label>Room Type</label>
            <select class=" form-select" id="1" name="roomtype">
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
                        ?>
            </select>
        </div>
        <div class="form-group <?php echo (!empty($usertb->name_msg)) ? 'has-error' : ''; ?>">
            <label>Price</label>
            <input type="text" name="name" class="form-control" value="0.00" autocomplete="off" id="price">
        </div>     
        </div>
        <div class="form-group col-md-12">
                <input type="submit" class="btn btn-success" value="Add" name="room_submit" onclick="add_room();">
            </div>  
    </div>
  </div>

</div>

<div id="ServiceModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <p class="close">x</p>
    <div class="p-3">
    <div class="col col-md-12">
        <div class="form-group <?php echo (!empty($usertb->type_msg)) ? 'has-error' : ''; ?>">
            <label>Service</label>
            <select class=" form-select" id="2" name="roomtype">
            <option value="">Select a Service</option>
                        <?php
                            require_once "configcompany.php";
                            
                            $result = mysqli_query($link,"SELECT * FROM service");
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
        </div>
        <div class="form-group <?php echo (!empty($usertb->name_msg)) ? 'has-error' : ''; ?>">
            <label>Price</label>
            <input type="text" name="name" class="form-control" value="0.00" autocomplete="off" id="service_price">
        </div>     
        </div>
        <div class="form-group col-md-12">
                <input type="submit" class="btn btn-success" value="Add" name="service_submit" onclick="add_service();">
            </div>  
    </div>
  </div>

</div>

    <div class=" form-border h-100 overflow-auto pb-4">
        <form action="create_company_data" method="post" enctype="multipart/form-data">
            <div class="alert alert-secondary FooterLine pt-0 pb-0"><h3 class="ml-1">New Company</h3></div>
            <div class="col col-md-6 mt-2">
                <div class="form-group <?php echo (!empty($obj->name_msg)) ? 'has-error' : ''; ?>">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $obj->name; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->name_msg; ?></span>
                </div>  
                <div class="form-group <?php echo (!empty($obj->email_msg)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $obj->email; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->email_msg; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($obj->phone_msg)) ? 'has-error' : ''; ?>">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $obj->phone; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->phone_msg; ?></span>
                </div> 
                <div class="form-group <?php echo (!empty($obj->address_msg)) ? 'has-error' : ''; ?>">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $obj->address; ?> " autocomplete="off">
                    <span class="help-block"><?php echo $obj->address_msg; ?></span>
                </div>  
            </div> 
            <div class="col-md-6 p-1">
                <div class="col-md-12 form-border h-25 overflow-auto">
                    <input type="button" id="RoomBtn" class="float-right mt-1" value="+"/>
                    <table class="table" name="room" id="room">
                        <thead>
                            <tr>
                                <th hidden>ID</th>
                                <th>Room</th>
                                <th>Price</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-md-6 p-1">
                <div class="col-md-12 form-border h-25 overflow-auto">
                    <input type="button" id="ServiceBtn" class="float-right mt-1" value="+"/>
                    <table class="table" name="services" id="services">
                        <thead>
                            <tr>
                                <th hidden>ID</th>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="form-group col-md-7">
                <input type="submit" class="btn btn-danger" value="Submit" name="submit">
                <a class="btn btn-primary" href="company_list">Cancel</a>
            </div> 
        </form>
    </div> 
<?php require('./Components/footer.inc.php')?>
