<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require_once "libs/PHPMailer/src/PHPMailer.php";
    require_once "libs/PHPMailer/src/SMTP.php";
    require_once "libs/PHPMailer/src/Exception.php";
    require 'models/userModel.php';
    require 'models/user.php';

    // session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class account 
	{	
        public static function Login()
		{
            session_start();
            try{
                $user=new user();
                if (isset($_POST['submit'])) 
                {   
                    $noerror=true;
                    // read form value
                    if(empty(trim($_POST['username']))){
                        $user->username_msg="Please enter username.";$noerror=false;
                    }else{
                        $user->username = trim($_POST['username']);
                    }
                    
                    if(empty(trim($_POST['password']))){
                        $user->password_msg="Please enter your password.";$noerror=false;
                    }else{
                        $user->password = trim($_POST['password']);
                    }
                    if(empty(trim($_POST["company"]))){
                        $user->companyId_msg = "Please enter your company.";$noerror=false;
                    } else{
                        $user->companyId = trim($_POST["company"]);
                    }

                    if($noerror==true){
                        // Prepare a select statement
                        $objum =  new userModel();
                        $objum->open_db();
                        $query=$objum->condb->prepare("SELECT id, username, password, name, last_name, companyId FROM user WHERE username = ?");
                        $query->bind_param("s",$user->username);  
                        $query->execute();
                        $res=$query->get_result();
                        $row = mysqli_fetch_array($res);
                        // Check if username exists, if yes then verify password
                        if(sizeof($row) > 0){                    
                            // Bind result variables  
                            if(password_verify(sha1($user->password), password_hash($row['password'],PASSWORD_DEFAULT))){
                                // Check if password is correct, if yes then check company
                                if($user->companyId==$row['companyId']){  
                                    $compid=$row['companyId'];                  
                                    $query=$objum->condb->prepare("SELECT * FROM company where id=$compid");
                                    $query->execute();
                                    $res = $query->get_result();
                                    $comprow = mysqli_fetch_array($res);
                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $row['id'];
                                    $_SESSION["username"] = $row['username'];                            
                                    $_SESSION["name"] = $row['name'];                            
                                    $_SESSION["last_name"] = $row['last_name'];                            
                                    $_SESSION["companyId"] = $row['companyId']; 
                                    $_SESSION["company"] = $comprow["name"];  
                                    
                                }else{
                                    $user->companyId_msg = "Please select a valid company.";$noerror=false;
                                }
                            } else{
                                // Display an error message if password is not valid
                                $user->password_msg = "The password you entered was not valid.";$noerror=false;
                            }
                        }else{
                            // Display an error message if username doesn't exist
                            $user->username_msg = "No account found with that username.";$noerror=false;
                        }

                        if($noerror==true){
                            header('location:Dashboard');
                        }else{
                            $_SESSION['usertbl']=serialize($user);//add session obj           
                            header('location:Login');
                        }

                        $query->close();
                        $objum->close_db();
                    }else
                    {    
                        $_SESSION['usertbl']=serialize($user);//add session obj           
                        header('location:Login');                
                    }
                }
            }catch (Exception $e) 
            {
                $objum->close_db();	
                throw $e;
            }
        }

        public static function changePassword(){
            session_start();
            try{
                $objum =  new userModel();
                $user=new user();

                $id = $_SESSION['id'];

                // Processing form data when form is submitted
                if(isset($_POST['submit'])){
                    $noerror=true;
                    if(empty(trim($_POST['old_password']))){
                        $user->oldPassword_msg="Please enter the old password.";$noerror=false;
                    }else{
                        $objum->open_db();
                        $query=$objum->condb->prepare("SELECT password FROM user where id=$id"); 
                        $query->execute();
                        $res=$query->get_result();
                        $row = mysqli_fetch_array($res);

                        if($row['password'] != sha1($_POST['old_password'])){
                            $user->oldPassword_msg = "The password you enterd is not vslid.";$noerror=false;
                        }
                    }

                    // Validate password
                    if(empty(trim($_POST["password"]))){
                        $user->password_msg = "Please enter a password.";  $noerror=false;   
                    } elseif(strlen(trim($_POST["password"])) < 6){
                        $user->password_msg = "Password must have atleast 6 characters."; $noerror=false;
                    } else{
                        $user->password = $_POST["password"];
                    }
                    
                    // Validate confirm password
                    if(empty(trim($_POST["confirm_password"]))){
                        $user->confirmPassword_msg = "Please confirm password.";  $noerror=false;   
                    } else{
                        $user->confirmPassword = trim($_POST["confirm_password"]);
                        if(empty($password_err) && ($user->password != $user->confirmPassword)){
                            $user->confirmPassword_msg = "Password did not match."; $noerror=false;
                        }
                    }
                    
                    // Check input errors before inserting in database
                    if($noerror==true){
                        
                        // Prepare an update statement
                        $objum->open_db();
                        $query=$objum->condb->prepare("UPDATE user SET password=? WHERE id = $id"); 
                        $query->bind_param("s",sha1($_POST["password"])); 
                        $query->execute();
                        header('Location:Dashboard');
                    }else
                    {    
                        $_SESSION['changePassword']=serialize($user);//add session obj   
                        header('Location:changePassword');              
                    }
                }
            }
            catch (Exception $e) 
            {
                $objum->close_db();	
                throw $e;
            }
        }

        // public static function reset(){
        //     try{
        //         $objum = new userModel();
        //         $message = "";
        //         if(isset($_POST['user'])){
        //             $username = $_POST['user'];
        //             $objum->open_db();
        //             $query1=$objum->condb->prepare("SELECT * FROM user WHERE username = '".$username."'"); 
        //             $query1->execute();
        //             $res=$query1->get_result();
        //             $row1 = mysqli_fetch_array($res);
        //             $id = $row1['id'];
        //             $email = $row1['email'];
        //             $name = $row1['name'];
        //             $lastName = $row1['last_name'];
        //             if(!empty($username)){
        //                 if(!empty($id)){
        //                     $objum->open_db();
        //                     $query=$objum->condb->prepare("SELECT resetpassword('".$id."') as password"); 
        //                     $query->execute();
        //                     $res=$query->get_result();
        //                     $row = mysqli_fetch_array($res);
        //                     $rst = $row['password'];

        //                     $mail = new PHPMailer();
        //                     $mail->isSMTP();
        //                     $mail->Host = 'smtp.gmail.com';
        //                     $mail->SMTPAuth = true;
        //                     $mail->Username = 'mirwaisdst@gmail.com';
        //                     $mail->Password = 'zpzdmddxkmmczdvp';
        //                     $mail->port = '587'; //465
        //                     $mail->SMTPSecure = 'tls';
        //                     $mail->isHTML(true);  
        //                     $mail->setFrom('mirwaisdst@gmail.com');
        //                     $mail->addAddress($email);
        //                     $mail->addBCC('mirwaisdoost@hotmail.com');
        //                     $mail->Subject = 'RESET PASSWORD';
        //                     $mailContent = "<h4>Dear $name $lastName,</h4>
        //                                     <p>Your password has been reseted.</p>
        //                                     <p>Password: $rst</p>
        //                                     <br> 
        //                                     <p>Best regards,</p>
        //                                     <p>Mirwais Doost</p>
        //                                     <p>0093 795 703 071</p>
        //                                     <p>0093 708 411 861</p>";
        //                     $mail->Body = $mailContent;
                            
        //                     if($mail->send()){
        //                         $message = "Mail has been sent succesfully!";
        //                         $index = 0;
        //                         echo json_encode(array("index" => $index, "message" => $message));
        //                     }else{
        //                         $index = 1;
        //                         $message = "Unable to send email. Please try again. " . $mail->ErrorInfo;
        //                         echo json_encode(array("index" => $index, "message" => $message));        
        //                     }
        //                 }else{
        //                     $index = 2;
        //                     $message = "No account found with that username.";
        //                     echo json_encode(array("index" => $index, "message" => $message));
        //                 }
        //             }
        //         }
        //     }
        //     catch (Exception $e) 
        //     {
        //         $objum->close_db();	
        //         throw $e;
        //     }
        // }

        public static function reset(){
            try{
                $objum = new userModel();
                $message = "";
                if(isset($_POST['user'])){
                    $username = $_POST['user'];
                    $objum->open_db();
                    $query1=$objum->condb->prepare("SELECT * FROM user WHERE username = '".$username."'"); 
                    $query1->execute();
                    $res=$query1->get_result();
                    $row1 = mysqli_fetch_array($res);
                    $id = $row1['id'];
                    $email = $row1['email'];
                    $name = $row1['name'];
                    $lastName = $row1['last_name'];
                    if(!empty($username)){
                        if(!empty($id)){
                            $objum->open_db();
                            $query=$objum->condb->prepare("SELECT resetpassword('".$id."') as password"); 
                            $query->execute();
                            $res=$query->get_result();
                            $row = mysqli_fetch_array($res);
                            $rst = $row['password'];

                            $mail = new PHPMailer(true);

                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'mirwaisdst@gmail.com';                     //SMTP username
                            $mail->Password   = 'ffsbxtuuakdhszct';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465; 
                            $mail->setFrom('mirwaisdst@gmail.com', 'Marcopolo Inn Guest House');
                            $mail->addAddress($email);
                            $mail->isHTML(true);  
                            $mail->addBCC('mirwaisdoost@hotmail.com');
                            $mail->Subject = 'RESET PASSWORD';
                            $mailContent = "<h4>Dear $name $lastName,</h4>
                                            <p>Your password has been reseted.</p>
                                            <p>Password: $rst</p>
                                            <br> 
                                            <p>Best regards,</p>
                                            <p>Mirwais Doost</p>
                                            <p>0093 795 703 071</p>
                                            <p>0093 708 411 861</p>";
                            $mail->Body = $mailContent;
                            
                            if($mail->send()){
                                $message = "Mail has been sent succesfully!";
                                $index = 0;
                                echo json_encode(array("index" => $index, "message" => $message));
                            }else{
                                $index = 1;
                                $message = "Unable to send email. Please try again. " . $mail->ErrorInfo;
                                echo json_encode(array("index" => $index, "message" => $message));        
                            }
                        }else{
                            $index = 2;
                            $message = "No account found with that username.";
                            echo json_encode(array("index" => $index, "message" => $message));
                        }
                    }
                }
            }
            catch (Exception $e) 
            {
                $objum->close_db();	
                throw $e;
            }
        }

        // add new record
		public static function insert()
		{
            session_start();
            $objum=new userModel();
            try{
                $user=new user();
                if (isset($_POST['submit'])) {
                    $user->isActive = 1;
                    $user->entryDate = date("YYYY-mm-dd h:i:s");
                    $user->token="confirmed";
                    $user->companyId = $_SESSION["companyId"];

                    if(isset($_FILES['file'])){
                        $file = $_FILES["file"];
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    }

                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        if(empty(trim($_POST["name"]))){
                            $user->name_msg = "Please enter a name.";
                        } else{
                            $user->name = trim($_POST["name"]);
                        }
                        if(empty(trim($_POST["lastname"]))){
                            $user->lastName_msg = "Please enter a lastname.";
                        } else{
                            $user->lastName = trim($_POST["lastname"]);
                        }
                        if(empty(trim($_POST["type"]))){
                            $user->type_msg = "Please select a type.";
                        } else{
                            $user->type = trim($_POST["type"]);
                        }
                        if(empty(trim($_POST["email"]))){
                            $user->email_msg = "Please enter an email address.";
                        } else{
                            $user->email = trim($_POST["email"]);
                        }

                        if(!empty($file['name'])){
                            if(!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])){
                                $user->photo_msg = "your file extesion must be .jpg, .jpeg, .png or .svg";
                            }
                            if($file["size"] > 1048576){
                                $user->photo_msg = "The image size should not be more than 1MB";
                            }

                            $user->photo=$file['name'];
                            
                            $objum->open_db();
                            $sql = "SELECT id FROM user WHERE photo = ?";
                            $query=$objum->condb->prepare("SELECT id FROM user WHERE photo = ?");
                            $query->bind_param("s",$user->photo);  
                            $query->execute();
                            $res=$query->get_result();
                            $row = mysqli_fetch_array($res);

                            if(sizeof($row) > 0){
                                $user->photo_msg = "This photo is already taken.";
                            }
                        }

                        // if (is_uploaded_file($_FILES['file']['tmp_name']) ) 
                        // {
                        //     $file_err = "Photo is not uploded yet.";
                        // }

                        if(empty(trim($_POST["username"]))){
                            $user->username_msg = "Please enter a username.";
                        } else{

                            $objum->open_db();
                            $query=$objum->condb->prepare("SELECT id, username, password, name, last_name, companyId FROM user WHERE username = ?");
                            $query->bind_param("s",$user->username);  
                            $query->execute();
                            $res=$query->get_result();
                            $row = mysqli_fetch_array($res);

                            if(sizeof($row) > 0){
                                $user->username_msg = "This username is already taken.";
                            } else{
                                $user->username = trim($_POST["username"]);
                            }
                        }
                        
                        // Validate password
                        if(empty(trim($_POST["password"]))){
                            $user->password_msg = "Please enter a password.";     
                        } elseif(strlen(trim($_POST["password"])) < 6){
                            $user->password_msg = "Password must have atleast 6 characters.";
                        } else{
                            $user->password = $_POST["password"];
                        }
                        
                        // Validate confirm password
                        if(empty(trim($_POST["confirm_password"]))){
                            $user->confirmPassword_msg = "Please confirm password.";     
                        } else{
                            $user->confirmPassword = $_POST["confirm_password"];
                            if(empty($user->password_msg) && ($user->password != $user->confirmPassword)){
                                $user->confirmPassword_msg = "Password did not match.";
                            }else{
                                $user->password = sha1($_POST["password"]);
                            }
                        }
                        
                        // Check input errors before inserting in database
                        if(empty($user->username_msg) && empty($user->password_msg) && empty($user->confirmPassword_msg) && empty($user->name_msg) && empty($user->lastName_msg) && empty($user->type_msg) && empty($user->email_msg) && empty($user->photo_msg)  ){
                            $objum->insertRecord($user);
                            move_uploaded_file($file["tmp_name"], "./libs/photo/" . $file["name"]); 
                            
                            /*unset this session for validation to empty the validated inputs
                              when come back to create page*/
                            if(isset($_SESSION['usertbl'])){
                                unset($_SESSION['usertbl']);
                            }
                            header('location:user_list');
                        }else{
                            $_SESSION['usertbl']=serialize($user);//add session obj  
                            header('location:create_user');
                        }
                        $query->close();
                        $objum->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $objum->close_db();	
                throw $e;
            }
        }

        // update record
        public static function update()
		{
            session_start();
            $id = $_GET['show_id'];
            $objum=new userModel();
            try{
                $user=new user();
                if (isset($_POST['submit'])) {
                    
                    $user->companyId = $_SESSION["companyId"];
                    
                    if(isset($_FILES['file'])){
                        $file = $_FILES["file"];
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    }
                    
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $user->id = $id;

                        if(empty(trim($_POST["name"]))){
                            $user->name_msg = "Please enter a name.";
                        } else{
                            $user->name = trim($_POST["name"]);
                        }
                        if(empty(trim($_POST["lastname"]))){
                            $user->lastName_msg = "Please enter a lastname.";
                        } else{
                            $user->lastName = trim($_POST["lastname"]);
                        }
                        if(empty(trim($_POST["type"]))){
                            $user->type_msg = "Please select a type.";
                        } else{
                            $user->type = trim($_POST["type"]);
                        }
                        if(empty(trim($_POST["email"]))){
                            $user->email_msg = "Please enter an email address.";
                        } else{
                            $user->email = trim($_POST["email"]);
                        }

                        $user->isActive = trim($_POST["status"]);

                        if(!empty($file['name'])){
                            if(!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])){
                                $user->photo_msg = "your file extesion must be .jpg, .jpeg, .png or .svg";
                            }
                            if($file["size"] > 1048576){
                                $user->photo_msg = "The image size should not be more than 1MB";
                            }

                            $user->photo=$file['name'];
                            
                            $objum->open_db();
                            $query=$objum->condb->prepare("SELECT id FROM user WHERE photo = ?");
                            $query->bind_param("s",$user->photo);  
                            $query->execute();
                            $res=$query->get_result();
                            $row = mysqli_fetch_array($res);

                            if(sizeof($row) > 0){
                                $user->photo_msg = "This photo is already taken.";
                            }
                        }

                        // if (is_uploaded_file($_FILES['file']['tmp_name']) ) 
                        // {
                        //     $file_err = "Photo is not uploded yet.";
                        // }
                        
                        // Check input errors before inserting in database
                        if(empty($user->name_msg) && empty($user->lastName_msg) && empty($user->type_msg) && empty($user->email_msg) && empty($user->photo_msg)  ){
                            
                            $result = $objum->selectRecord($id);
                            $row = mysqli_fetch_array($result);

                            if(!empty($file['name'])){
                                $user->photo = $file["name"];
                            }else{
                                $user->photo = $row['photo'];
                            }
                            
                            $objum->updateRecord($user);

                            if(!empty($file['name']) && !empty($user->photo)){
                                unlink("./libs/photo/" . $row['photo']);
                            }
                            move_uploaded_file($file["tmp_name"], "./libs/photo/" . $file["name"]); 
                            
                            /*unset this session for validation to empty the validated inputs
                            when come back to update page*/
                            if(isset($_SESSION['updateUser'])){
                            unset($_SESSION['updateUser']);
                            }
                            
                            header("location:user_profile?show_id=$id");

                        }else{
                            $_SESSION['updateUser']=serialize($user);//add session obj 
                            header("location:update_user?show_id=$id");
                        }
                        $query->close();
                        $objum->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $objum->close_db();	
                throw $e;
            }
        }
        // delete record
        public static function delete()
		{
            try
            {
                $id = $_GET['show_id'];
                $objum =  new userModel();
                $objum->deleteRecord($id);
                account::list();  
            }
            catch (Exception $e) 
            {
                $objum=new userModel();
                $objum->close_db();				
                throw $e;
            }
        }
        public static function list(){
            $_userModel=new userModel();
            $result=$_userModel->selectRecord(0);
            include "./Views/Account/Index.php";                                        
        }

        public static function home(){
            include "./Views/Account/Home.php";                                        
        }

        public static function view(){
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                header("location: Dashboard.php");
                exit;
            }else{
                include "./Views/Account/Login.php";  
            }                                      
        }

        public static function dashboard(){
            include "./Dashboard.php";                                        
        }
        
        public static function profile(){
            $id = $_GET['show_id'];
            $_SESSION["userid"] = $_GET['show_id'];
            $_userModel=new userModel();
            $result=$_userModel->selectRecord($id);
            include "./Views/Account/Profile.php";                                        
        }

        public static function create_user(){
            include "./Views/Account/Create.php";                                        
        }

        public static function changePassword_view(){
            include "./Views/Account/ChangePassword.php";                                        
        }

        public static function update_user(){

            $id = $_GET['show_id'];
            $_userModel=new userModel();
            $result=$_userModel->selectRecord($id);
            include "./Views/Account/Update.php";                                        
        }

        public static function Logout(){
            include "./Views/Account/Logout.php";                                        
        }
    }
		
	
?>