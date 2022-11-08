<?php require('./Components/bodyhead.inc.php')?>
<?php require('./Components/header.inc.php')?>
<div class=" h-100 form-border overflow-auto">
    <div class="alert alert-secondary FooterLine w-100">
        <span class=" h4">Room List</span>
        <span><a class="btn btn-primary btn-sm float-right" href="create_room">New Room</a></span>
    </div> 
    <div class="table-responsive p-2">  
        <table id="user_data" class="table table-hover table-bordered w-100"> 
            <thead>  
                <tr class=" table-sm" style="font-size:14px;">  
                    <td hidden>ID</td>  
                    <td>Room Number</td>  
                    <td>Details</td>  
                    <td>Room Type</td>
                    <td>Options</td>
                </tr>  
            </thead>  
            <?php  
            while($row = mysqli_fetch_array($result))  
            {  
                require_once "configcompany.php";
                $roomtypeid = $row['roomtypeid'];
                $result1 = mysqli_query($link,"SELECT name FROM roomtype WHERE id = $roomtypeid");
                $row1=mysqli_fetch_array($result1);

                echo '  
                <tr  style="font-size:14px;">  
                    <td class=" pb-0 pt-1" hidden>'.$row["id"].'</td>  
                    <td class=" pb-0 pt-1">'.$row["roomNumber"].'</td>
                    <td class=" pb-0 pt-1">'.$row["details"].'</td>
                    <td class=" pb-0 pt-1">'.$row1["name"].'</td>   
                    <td class=" pb-0 pt-1 pb-1"><a href=\'room_profile?show_id='.$row["id"].'\' class="btn pt-0 pb-0 btn-primary btn-sm">Modify</a></td>  
                </tr>  
                ';  
            }  
            ?>  
        </table>  
    </div>  
</div>
    
<?php require('./Components/footer.inc.php')?>