
<?php
    require('./Components/head.inc.php');
    require_once './Models/user.php'; 
    session_start();
    $usertb=isset($_SESSION['usertbl'])?unserialize($_SESSION['usertbl']):new user();
?>

<!DOCTYPE html>
<html lang="en">
  

    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

        <!-- Begin page -->
        <div class="home-btn d-none d-sm-block">
            <a href="index.html" class="text-dark"><i class="mdi mdi-home h1"></i></a>
        </div>

        <div class="account-pages">
            
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-1">
                        <div class="text-left">
                            <div>
                                <a href="index.html" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="28" alt="logo"></a>
                            </div>
                            <h5 class="font-14 text-muted mb-4">Responsive Bootstrap 4 Admin Dashboard</h5>
                            <p class="text-muted mb-4">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>

                            <h5 class="font-14 text-muted mb-4">Terms :</h5>
                            <div>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>At solmen va esser necessi far uniform paroles.</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Donec sapien ut libero venenatis faucibus.</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Nemo enim ipsam voluptatem quia voluptas sit .</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-2">
                                    <h4 class="text-muted float-right font-18 mt-4">پنل کاربری</h4>
                                    <div>
                                        <a href="index.html" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="28" alt="logo"></a>
                                    </div>
                                </div>
        
                                <div class="p-2">
                                    <form class="form-horizontal m-t-20" action="Login_creditional" method="post">
        
                                        <div class="form-group row">
                                            <div class="col-12 <?php echo (!empty($usertb->username_msg)) ? 'has-error' : ''; ?>">
                                                <input class="form-control" type="text" placeholder="نام کاربری" name="username" id="username" value="<?php echo $usertb->username; ?>">
                                                <span class="help-block text-danger"><?php echo $usertb->username_msg; ?></span>
                                            </div>
                                        </div>
        
                                        <div class="form-group row">
                                            <div class="col-12 <?php echo (!empty($usertb->password_msg)) ? 'has-error' : ''; ?>">
                                                <input class="form-control" type="password" placeholder="رمز عبور" name="password" value="<?php echo $usertb->password; ?>">
                                                <span class="help-block text-danger"><?php echo $usertb->password_msg; ?></span>
                                            </div>
                                        </div>
        
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">مرا به خاطر بسپار</label>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <input type="submit" name="submit" class="btn btn-primary btn-block waves-effect waves-light" value="ورود به پنل">
                                            </div>
                                        </div>
        
                                        <div class="form-group m-t-10 mb-0 row">
                                            <div class="col-sm-7 m-t-20">
                                                <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> رمز عبور را فراموش کرده اید؟</a>
                                            </div>
                                            <div class="col-sm-5 m-t-20">
                                                <a href="pages-register.html" class="text-muted"><i class="mdi mdi-account-circle"></i> ایجاد حساب کاربری</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>