<?php
    require 'models/roomModel.php';
    require 'models/room.php';
    
	class roomController 
	{	
        // add new record
		public static function insert()
		{
            session_start();
            $objrm=new roomModel();
            try{
                $room=new room();
                if (isset($_POST['submit'])) {
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        if(empty(trim($_POST["roomNumber"]))){
                            $room->roomNumber_msg = "Please enter a room number.";
                        } else{
                            $room->roomNumber = trim($_POST["roomNumber"]);
                        }
                        if(empty(trim($_POST["details"]))){
                            $room->details_msg = "Please enter room details.";
                        } else{
                            $room->details = trim($_POST["details"]);
                        }
                        if(empty(trim($_POST["roomtypeid"]))){
                            $room->roomtypeid_msg = "Please choose a room type.";
                        } else{
                            $room->roomtypeid = trim($_POST["roomtypeid"]);
                        }
                       
                        // Check input errors before inserting in database
                        if(empty($room->roomNumber_msg) && empty($room->details_msg) && empty($room->roomtypeid_msg)){
                            $objrm->insertRecord($room);
                            
                            /*unset this session for validation to empty the validated inputs
                              when come back to create page*/
                            if(isset($_SESSION['roomtbl'])){
                                unset($_SESSION['roomtbl']);
                            }
                            header('location:room_list');
                        }else{
                            $_SESSION['roomtbl']=serialize($room);//add session obj  
                            header('location:create_room');
                        }
                        $objrm->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $objrm->close_db();	
                throw $e;
            }
        }

        // update record
        public static function update()
		{
            session_start();
            $id = $_GET['show_id'];
            $objrm=new roomModel();
            try{
                $room=new room();
                if (isset($_POST['submit'])) {
                    
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $room->id = $id;

                        if(empty(trim($_POST["roomNumber"]))){
                            $room->roomNumber_msg = "Please enter a room number.";
                        } else{
                            $room->roomNumber = trim($_POST["roomNumber"]);
                        }
                        if(empty(trim($_POST["details"]))){
                            $room->details_msg = "Please enter room details.";
                        } else{
                            $room->details = trim($_POST["details"]);
                        }
                        if(empty(trim($_POST["roomtypeid"]))){
                            $room->roomtypeid_msg = "Please choose a room type.";
                        } else{
                            $room->roomtypeid = trim($_POST["roomtypeid"]);
                        }

                        // Check input errors before inserting in database
                        if(empty($room->roomNumber_msg) && empty($room->details_msg) && empty($room->roomtypeid_msg)  ){
                            
                            $objrm->updateRecord($room);

                            /*unset this session for validation to empty the validated inputs
                            when come back to update page*/
                            if(isset($_SESSION['updateRoom'])){
                            unset($_SESSION['updateRoom']);
                            }
                            
                            header("location:room_profile?show_id=$id");

                        }else{
                            $_SESSION['updateRoom']=serialize($room);//add session obj 
                            header("location:update_room?show_id=$id");
                        }
                        $objrm->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $objrm->close_db();	
                throw $e;
            }
        }
        // delete record
        public static function delete()
		{
            try
            {
                $id = $_GET['show_id'];
                $objrm =  new roomModel();
                $objrm->deleteRecord($id);
                roomController::list();  
            }
            catch (Exception $e) 
            {
                $objrm =  new roomModel();
                $objrm->close_db();				
                throw $e;
            }
        }
        public static function list(){
            $roomModel=new roomModel();
            $result=$roomModel->selectRecord(0);
            include "./Views/Room/Index.php";                                        
        }
        
        public static function profile(){
            $id = $_GET['show_id'];
            $_SESSION["roomid"] = $_GET['show_id'];
            $roomModel=new roomModel();
            $result=$roomModel->selectRecord($id);
            include "./Views/Room/Profile.php";                                        
        }

        public static function create_room(){
            include "./Views/Room/Create.php";                                        
        }

        public static function update_room(){
            $id = $_GET['show_id'];
            $roomModel=new roomModel();
            $result=$roomModel->selectRecord($id);
            include "./Views/Room/Update.php";                                        
        }
    }
		
	
?>