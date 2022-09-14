<?php
    require('./Components/head.inc.php');
    require_once './Models/user.php'; 
    session_start();
    $usertb=isset($_SESSION['usertbl'])?unserialize($_SESSION['usertbl']):new user();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /  >
        <title>Marcopolo</title>
        <link rel="stylesheet" type="text/css" href="./libs/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="./libs/css/styles.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav class="Login ">
            <div class="container flex">
              <a class=" text-decoration-none" href="#"><img src="./libs/img/Logo1.png" alt="" class="img-fluid mt-1 mb-1 mr-3" style="width: 7%;">MARCOPOLO</a>
            </div>
            <div class="HeaderLine"></div>
        </nav>
          <nav class="footer fixed-bottom mt-5">
            <div class="container">
                <ul class="list-group list-group-horizontal pt-3">
                    <li class="list-inline-item pr-3"><a href="#">Product Website</a></li>
                    <li class="list-inline-item"><a href="#">Support</a></li>
                </ul>
            </div>
          </nav>
          <header class="page-header mb-5 pb-3">
              <div class="container pt-2 pl-5 pr-5 h-100">
                <h2 class="my-0">Hotel Management System</h2>
                  <div class="row align-items-center justify-content-center mt-3">
                      <div class="col-md-8">
                            <div class="row mb-2">
                                <div class="col-md-1 p-0">
                                    <img src="./libs/img/Invoice.png" class="m-0" >
                                </div>
                                <div class="col-md-10">
                                    <strong style="font-weight: bold; font-size: 12px;" class="font-weight-bold">Smart Invoicing</strong>
                                    <p style="font-size: 12px;">Whether you are creating a Tour Invoice or a Refund Invoice, Wiztrav provides you the flexibility to manage all aspects of travel costs, revenues and operational details of Air Tickets, Hotel Bookings, Transport Bookings, Visa and Insurance services.</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 p-0">
                                    <img src="./libs/img/Statement.png" class="m-0" >
                                </div>
                                <div class="col-md-10">
                                    <strong style="font-weight: bold; font-size: 12px;" class="font-weight-bold">Swift Settlement</strong>
                                    <p style="font-size: 12px;">With the swift settlement module, you administer various functions from creating payment and receipt vouchers to invoice and memo allocation</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 p-0">
                                    <img src="./libs/img/Report.png" class="m-0" >
                                </div>
                                <div class="col-md-10">
                                    <strong style="font-weight: bold; font-size: 12px;" class="font-weight-bold">In-Depth Reporting</strong>
                                    <p style="font-size: 12px;">Marcopolo's Reporting module provides with comprehensive reports to perform travel and financial data analysis</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 p-0">
                                    <img src="./libs/img/Support.png" class="m-0" >
                                </div>
                                <div class="col-md-10">
                                    <strong style="font-weight: bold; font-size: 12px;" class="font-weight-bold">Fanatic Support</strong>
                                    <p style="font-size: 12px;">Yes, that's what you get unconditionally with us. You are never own your own if something doesn't work as the support team is just a call / email away</p>
                                </div>
                            </div>
                      </div>
                      <div class="col-md-4 mb-5">
                          <div class="aler alert-danger" id="username_err"></div>
                          <div class="p-3 border Login pb-4">
                            <h5>Sign in</h5>
                            <div class="LoginLine mb-3 row"></div>
                                <form action="Login_creditional" method="post">
                                    <div class="form-group  mb-3 <?php echo (!empty($usertb->username_msg)) ? 'has-error' : ''; ?>">
                                        <label for="Username" class="form-label text-secondary">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $usertb->username; ?>" autocomplete="off">
                                        <span class="help-block text-danger"><?php echo $usertb->username_msg; ?></span>
                                    </div>
                                    <div class="form-group mb-3 <?php echo (!empty($usertb->password_msg)) ? 'has-error' : ''; ?>">
                                        <label for="password" class="form-label text-secondary">Password</label>
                                        <input type="password" name="password" class="form-control" value="<?php echo $usertb->password; ?>">
                                        <span class="help-block text-danger"><?php echo $usertb->password_msg; ?></span>
                                    </div>
                                    <div class="form-group mb-3 <?php echo (!empty($usertb->companyId_msg)) ? 'has-error' : ''; ?>">
                                        <label for="Company" class="form-label text-secondary">Company</label>
                                        <select class=" form-select" id="1" name="company">
                                            <option value="">Select Company</option>
                                            <?php
                                                require_once "configcompany.php";
                                                
                                                $result = mysqli_query($link,"SELECT * FROM company");
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
                                        <span class="help-block text-danger"><?php echo $usertb->companyId_msg; ?></span>
                                    </div>
                                    <input type="button" class=" btn btn-defualt" style="font-size: 13px;" value="Reset password" name="reset" onclick="resset();"/>
                                    <input type="submit" name="submit" class="btn btn-danger mt-2 float-right btn-sm Line" value="Sign In">
                                </form>
                          </div>
                      </div>
                  </div>
              </div>
          </header>
          <script src="js/bootstrap.min.js"></script>
    </body>
    
    <script type="text/javascript">
        function resset(){
        
            if (confirm("Are you sure you want to reset your password?")) {
                var username = $("#username");
                var username_err = $("#username_err");
                if(username.val() != ""){
                    $.ajax({
                        type: "POST",
                        url: 'Reset',
                        data: {user: username.val()},
                        success: function(data)
                        {
                            var jsonData = JSON.parse(data);
                            
                            if(jsonData.index == 0){
                                username_err.text(jsonData.message);
                                username_err.attr('class', 'alert alert-success');
                            }else if(jsonData.index == 2){
                                username_err.text(jsonData.message);
                                username_err.attr('class', 'alert alert-danger');
                            }else if((jsonData.index == 1)){
                                alert(jsonData.message);
                            }
                        }   
                    });
                }else{
                    username_err.text("Username can not be blank");
                    username_err.attr('class', 'alert alert-danger');
                }
            } 
        }
    </script>
</html>