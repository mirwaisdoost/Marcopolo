<?php require('./Components/bodyhead.inc.php')?>
<?php require('./Components/header.inc.php')?>
<div class=" h-100 form-border overflow-auto">
    <div class="alert alert-secondary FooterLine w-100">
        <span class=" h4">User List</span>
        <span><a class="btn btn-primary btn-sm float-right" href="create_user">New User</a></span>
    </div> 
    <div class="table-responsive p-2">  
        <table id="user_data" class="table table-hover table-bordered w-100"> 
            <thead>  
                <tr class=" table-sm" style="font-size:14px;">  
                    <td hidden>ID</td>  
                    <td>NAME</td>  
                    <td>LASTNAME</td>  
                    <td>USERNAME</td>  
                    <td>EMAIL</td> 
                    <td>OPTIONS</td> 
                </tr>  
            </thead>  
            <?php  
            while($row = mysqli_fetch_array($result))  
            {  
                echo '  
                <tr  style="font-size:14px;">  
                    <td class=" pb-0 pt-1" hidden>'.$row["id"].'</td>  
                    <td class=" pb-0 pt-1">'.$row["name"].'</td>
                    <td class=" pb-0 pt-1">'.$row["last_name"].'</td>  
                    <td class=" pb-0 pt-1">'.$row["username"].'</td>  
                    <td class=" pb-0 pt-1">'.$row["email"].'</td>  
                    <td class=" pb-0 pt-1 pb-1"><a href=\'user_profile?show_id='.$row["id"].'\' class="btn pt-0 pb-0 btn-primary btn-sm">Modify</a></td>  
                </tr>  
                ';  
            }  
            ?>  
        </table>  
    </div>  
</div>
    
<?php require('./Components/footer.inc.php')?>