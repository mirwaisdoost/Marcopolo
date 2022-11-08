<?php
    require 'models/serviceModel.php';
    require 'models/service.php';
    
	class serviceController 
	{	
        // add new record
		public static function insert()
		{
            session_start();
            $obj=new serviceModel();
            try{
                $service=new service();
                if (isset($_POST['submit'])) {
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        if(empty(trim($_POST["name"]))){
                            $service->name_msg = "Please enter a service name.";
                        } else{
                            $service->name = trim($_POST["name"]);
                        }
                       
                        // Check input errors before inserting in database
                        if(empty($service->name_msg)){
                            $obj->insertRecord($service);
                            
                            /*unset this session for validation to empty the validated inputs
                              when come back to create page*/
                            if(isset($_SESSION['servicetbl'])){
                                unset($_SESSION['servicetbl']);
                            }
                            header('location:service_list');
                        }else{
                            $_SESSION['servicetbl']=serialize($service);//add session obj  
                            header('location:create_service');
                        }
                        $obj->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $obj->close_db();	
                throw $e;
            }
        }

        // update record
        public static function update()
		{
            session_start();
            $id = $_GET['show_id'];
            $obj=new serviceModel();
            try{
                $service=new service();
                if (isset($_POST['submit'])) {
                    
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $service->id = $id;

                        if(empty(trim($_POST["name"]))){
                            $service->name_msg = "Please enter a service name.";
                        } else{
                            $service->name = trim($_POST["name"]);
                        }
                    
                        // Check input errors before inserting in database
                        if(empty($service->name_msg)){
                            
                            $obj->updateRecord($service);

                            /*unset this session for validation to empty the validated inputs
                            when come back to update page*/
                            if(isset($_SESSION['updateService'])){
                            unset($_SESSION['updateService']);
                            }
                            
                            header("location:service_profile?show_id=$id");

                        }else{
                            $_SESSION['updateService']=serialize($service);//add session obj 
                            header("location:update_service?show_id=$id");
                        }
                        $obj->close_db();
                    }
                }
            }catch (Exception $e) 
            {
                $obj->close_db();	
                throw $e;
            }
        }
        // delete record
        public static function delete()
		{
            try
            {
                $id = $_GET['show_id'];
                $obj =  new serviceModel();
                $obj->deleteRecord($id);
                serviceController::list();  
            }
            catch (Exception $e) 
            {
                $obj =  new serviceModel();
                $obj->close_db();				
                throw $e;
            }
        }
        public static function list(){
            $serviceModel=new serviceModel();
            $result=$serviceModel->selectRecord(0);
            include "./Views/Service/Index.php";                                        
        }
        
        public static function profile(){
            $id = $_GET['show_id'];
            $_SESSION["serviceid"] = $_GET['show_id'];
            $serviceModel=new serviceModel();
            $result=$serviceModel->selectRecord($id);
            include "./Views/Service/Profile.php";                                        
        }

        public static function create_service(){
            include "./Views/Service/Create.php";                                        
        }

        public static function update_service(){
            $id = $_GET['show_id'];
            $serviceModel=new serviceModel();
            $result=$serviceModel->selectRecord($id);
            include "./Views/service/Update.php";                                        
        }
    }
		
	
?>