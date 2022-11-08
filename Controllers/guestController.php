<?php
    require_once './models/guestModel.php';
    require_once './models/guest.php';
    
	class guestController 
	{	
        // add new record
		public static function insert()
		{
            session_start();
            $objgm=new guestModel();
            try{
                $guest=new guest();
                if (isset($_POST['submit'])) {
                    $guest->userId = $_SESSION["id"];

                    if(isset($_FILES['file'])){
                        $file = $_FILES["file"];
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    }

                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        if(empty(trim($_POST["name"]))){
                            $guest->name_msg = "Please enter a name.";
                        } else{
                            $guest->name = trim($_POST["name"]);
                        }
                        if(empty(trim($_POST["lastname"]))){
                            $guest->lastName_msg = "Please enter a lastname.";
                        } else{
                            $guest->lastName = trim($_POST["lastname"]);
                        }
                        if(empty(trim($_POST["email"]))){
                            $guest->email_msg = "Please enter an email address.";
                        } else{
                            $guest->email = trim($_POST["email"]);
                        }
                        if(empty(trim($_POST["address"]))){
                            $guest->address_msg = "Please enter an address.";
                        } else{
                            $guest->address = trim($_POST["address"]);
                        }
                        if(empty(trim($_POST["phone"]))){
                            $guest->phone_msg = "Please enter a phone number.";
                        } else{
                            $guest->phone = trim($_POST["phone"]);
                        }

                        if(!empty($file['name'])){
                            if(!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])){
                                $guest->photo_msg = "your file extesion must be .jpg, .jpeg, .png or .svg";
                            }
                            if($file["size"] > 1048576){
                                $guest->photo_msg = "The image size should not be more than 1MB";
                            }

                            $guest->photo=$file['name'];
                            
                            $objgm->open_db();
                            $sql = "SELECT id FROM user WHERE photo = ?";
                            $query=$objgm->condb->prepare("SELECT id FROM user WHERE photo = ?");
                            $query->bind_param("s",$guest->photo);  
                            $query->execute();
                            $res=$query->get_result();
                            $row = mysqli_fetch_array($res);

                            if(sizeof($row) > 0){
                                $guest->photo_msg = "This photo is already taken.";
                            }
                        }

                        // Check input errors before inserting in database
                        if(empty($guest->name_msg) && empty($guest->lastName_msg) && empty($guest->phone_msg) && empty($guest->email_msg) && empty($guest->address_msg) && empty($guest->photo_msg)  ){
                            $objgm->insertRecord($guest);
                            move_uploaded_file($file["tmp_name"], "./libs/photo/" . $file["name"]); 
                            
                            /*unset this session for validation to empty the validated inputs
                              when come back to create page*/
                            if(isset($_SESSION['guesttbl'])){
                                unset($_SESSION['guesttbl']);
                            }
                            header('location:guest_list');
                        }else{
                            $_SESSION['guesttbl']=serialize($guest);//add session obj  
                            header('location:create_guest');
                        }
                        $query->close();
                        $objgm->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $objgm->close_db();	
                throw $e;
            }
        }

        // update record
        public static function update()
		{
            session_start();
            $id = $_GET['show_id'];
            $objgm=new guestModel();
            try{
                $guest=new guest();
                if (isset($_POST['submit'])) {
                    
                    if(isset($_FILES['file'])){
                        $file = $_FILES["file"];
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    }
                    
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $guest->id = $id;

                        if(empty(trim($_POST["name"]))){
                            $guest->name_msg = "Please enter a name.";
                        } else{
                            $guest->name = trim($_POST["name"]);
                        }
                        if(empty(trim($_POST["lastname"]))){
                            $guest->lastName_msg = "Please enter a lastname.";
                        } else{
                            $guest->lastName = trim($_POST["lastname"]);
                        }
                        if(empty(trim($_POST["email"]))){
                            $guest->email_msg = "Please enter an email address.";
                        } else{
                            $guest->email = trim($_POST["email"]);
                        }
                        if(empty(trim($_POST["phone"]))){
                            $guest->phone_msg = "Please enter a phone number.";
                        } else{
                            $guest->phone = trim($_POST["phone"]);
                        }
                        if(empty(trim($_POST["address"]))){
                            $guest->address_msg = "Please enter an address.";
                        } else{
                            $guest->address = trim($_POST["address"]);
                        }

                        if(!empty($file['name'])){
                            if(!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])){
                                $guest->photo_msg = "your file extesion must be .jpg, .jpeg, .png or .svg";
                            }
                            if($file["size"] > 1048576){
                                $guest->photo_msg = "The image size should not be more than 1MB";
                            }

                            $guest->photo=$file['name'];
                            
                            $objgm->open_db();
                            $query=$objgm->condb->prepare("SELECT id FROM user WHERE photo = ?");
                            $query->bind_param("s",$guest->photo);  
                            $query->execute();
                            $res=$query->get_result();
                            $row = mysqli_fetch_array($res);

                            if(sizeof($row) > 0){
                                $guest->photo_msg = "This photo is already taken.";
                            }
                        }

                        // if (is_uploaded_file($_FILES['file']['tmp_name']) ) 
                        // {
                        //     $file_err = "Photo is not uploded yet.";
                        // }
                        
                        // Check input errors before inserting in database
                        if(empty($guest->name_msg) && empty($guest->lastName_msg) && empty($guest->phone_msg) && empty($guest->email_msg) && empty($guest->address_msg) && empty($guest->photo_msg)  ){
                            
                            $result = $objgm->selectRecord($id);
                            $row = mysqli_fetch_array($result);

                            if(!empty($file['name'])){
                                $guest->photo = $file["name"];
                            }else{
                                $guest->photo = $row['photo'];
                            }
                            
                            $objgm->updateRecord($guest);

                            if(!empty($file['name']) && !empty($guest->photo)){
                                unlink("./libs/photo/" . $row['photo']);
                            }
                            move_uploaded_file($file["tmp_name"], "./libs/photo/" . $file["name"]); 
                            
                            /*unset this session for validation to empty the validated inputs
                            when come back to update page*/
                            if(isset($_SESSION['updateGuest'])){
                            unset($_SESSION['updateGuest']);
                            }
                            
                            header("location:guest_profile?show_id=$id");

                        }else{
                            $_SESSION['updateGuest']=serialize($guest);//add session obj 
                            header("location:update_guest?show_id=$id");
                        }
                        $query->close();
                        $objgm->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $objgm->close_db();	
                throw $e;
            }
        }
        // delete record
        public static function delete()
		{
            try
            {
                $id = $_GET['show_id'];
                $objgm =  new guestModel();
                $objgm->deleteRecord($id);
                guestController::list();  
            }
            catch (Exception $e) 
            {
                $objgm =  new guestModel();
                $objgm->close_db();				
                throw $e;
            }
        }
        public static function list(){
            $guestModel=new guestModel();
            $result=$guestModel->selectRecord(0);
            include "./Views/Guest/Index.php";                                        
        }
        
        public static function profile(){
            $id = $_GET['show_id'];
            $_SESSION["guestid"] = $_GET['show_id'];
            $guestModel=new guestModel();
            $result=$guestModel->selectRecord($id);
            include "./Views/Guest/Profile.php";                                        
        }

        public static function create_guest(){
            include "./Views/Guest/Create.php";                                        
        }

        public static function update_guest(){
            $id = $_GET['show_id'];
            $guestModel=new guestModel();
            $result=$guestModel->selectRecord($id);
            include "./Views/Guest/Update.php";                                        
        }
    }
		
	
?>