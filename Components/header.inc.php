<?php require('./Components/head.inc.php')?>

    <?php
        session_start();      

        if(!isset($_SESSION["id"])){
            header("location: Login");
        }

    ?>
    
    <nav class="toolbar fixed-top justify-content-between shadow-lg">
        <a onclick="hide();" class=" btn mt-1"><i id="btn" class="fas fa-bars"></i></a>
        <a class="btn mt-1" href="#"><img src="./libs/img/Logo1.png" alt="" class="img-fluid ml-3 mr-2" style="width: 20px">MIG</a>
        <a class="btn mt-1" href="./Dashboard" ><i class="fa fa-dashboard" style="font-size: 17px;"></i> Dashboard</a>
        <a class=" btn mr-2 mt-1 float-right" href="Logout" id="button" onclick="return confirm('Are you sure you want to exit the system?')" ><i  id="button" class="fas fa-power-off" style="font-size: 17px;"></i> Logout</a>
        <div class="HeaderLine"></div>
    </nav>
     <div class="flex">
        <div class="sidebar bg-light shadow-lg">
            <div class=" mt-4 pt-2 sidebarContent">
                <div class="mt-2 bg-light row pt-2" style="border-bottom: 1px solid lightgrey;">
                    <div class="col-md-6 text-center" style="border-right: 1px solid lightgrey;">
                        <a class=" btn text-decoration-none" style="font-size: 16px;">Quick Links</a>
                    </div>
                    <div class="col-md-6 text-center">
                        <a class=" btn text-decoration-none text-center"  style="font-size: 16px;">Other</a>
                    </div>
                </div>
                <div class="p-3">
                    <a href="#" onclick="menue(this.id);" id="10" class="title text-decoration-none">
                        <div>Transactions</div>
                        <div><i id="first" class="fas fa-angle-right"></i></div>
                    </a>
                    <div class="submenue" id="service">
                        <a href="guest_list" class="text-decoration-none "><div class="submenue-item">Guest Registration</div></a>
                        <a href="room_list" class="text-decoration-none "><div class="submenue-item">Room Registration</div></a>
                        <a href="service_list" class="text-decoration-none "><div class="submenue-item">Add Service</div></a>
                        <a href="company_list" class="text-decoration-none "><div class="submenue-item">Add Company</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Make Reservation</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Add Food Menue</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Other Services</div></a>
                    </div>
                    <a href="#"onclick="menue(this.id);" id="20"  class="title text-decoration-none">
                        <div>Reports</div>
                        <div><i id="second" class="fas fa-angle-right"></i></div>
                    </a>
                    <div class="submenue" id="business">
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Customer Statement</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Balance Report</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Room Report</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Staff Report</div></a>
                    </div>
                    <a href="#"onclick="menue(this.id);" id="30"  class="title text-decoration-none">
                        <div>Invoices</div>
                        <div><i id="third" class="fas fa-angle-right"></i></div>
                    </a>
                    <div class="submenue" id="product">
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Billing Invoices</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Customer Invoices</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Room Invoices</div></a>
                        <a href="#" class="text-decoration-none "><div class="submenue-item">Food Invoices</div></a>
                    </div>
                    <a href="user_list" onclick="menue(this.id);" id="" class="justtitle text-decoration-none mt-5">
                        <div class="mr-3"><i class="fa fa-users" aria-hidden="true"></i></div>
                        <div>Manage Users</div>
                    </a>
                    <a href="changePassword" onclick="menue(this.id);" id="" class="justtitle text-decoration-none mt-2">
                        <div class="mr-3 pt-1"><i class="fa fa-lock" aria-hidden="true" style="font-size: 12px;"></i></div>
                        <div>Change password</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="wrapper mt-5">
            <div> 