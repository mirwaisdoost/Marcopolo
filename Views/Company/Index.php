<?php require('./Components/bodyhead.inc.php')?>
<?php require('./Components/header.inc.php')?>
<div class=" h-100 form-border overflow-auto">
    <div class="alert alert-secondary FooterLine w-100">
        <span class=" h4">Company List</span>
        <span><a class="btn btn-primary btn-sm float-right" href="create_company">New Company</a></span>
    </div> 
    <div class="table-responsive p-2">  
        <table id="user_data" class="table table-hover table-bordered w-100"> 
            <thead>  
                <tr class=" table-sm" style="font-size:14px;">  
                    <td>ID</td>  
                    <td>Name</td>  
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>Options</td>
                </tr>  
            </thead>  
            <?php  
            while($row = mysqli_fetch_array($result))  
            {  
                echo '  
                <tr  style="font-size:14px;">  
                    <td class=" pb-0 pt-1">'.$row["id"].'</td>  
                    <td class=" pb-0 pt-1">'.$row["name"].'</td>
                    <td class=" pb-0 pt-1">'.$row["email"].'</td>   
                    <td class=" pb-0 pt-1">'.$row["phone"].'</td>   
                    <td class=" pb-0 pt-1">'.$row["address"].'</td>   
                    <td class=" pb-0 pt-1 pb-1"><a href=\'company_profile?show_id='.$row["id"].'\' class="btn pt-0 pb-0 btn-primary btn-sm">Modify</a></td>  
                </tr>  
                ';  
            }  
            ?>  
        </table>  
    </div>  
</div>
    
<?php require('./Components/footer.inc.php')?>