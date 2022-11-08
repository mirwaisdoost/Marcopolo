<?php
    require 'models/companyModel.php';
    require 'models/company.php';
    
	class companyController 
	{	
        // add new record
		public static function insert()
		{
            session_start();
            $obj=new companyModel();
            try{
                $company=new company();
                if (isset($_POST['submit'])) {
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        if(empty(trim($_POST["name"]))){
                            $company->name_msg = "Please enter company name.";
                        } else{
                            $company->name = trim($_POST["name"]);
                        }
                        if(empty(trim($_POST["email"]))){
                            $company->email_msg = "Please enter company email address";
                        } else{
                            $company->email = trim($_POST["email"]);
                        }
                        if(empty(trim($_POST["phone"]))){
                            $company->phone_msg = "Please enter company phone number";
                        } else{
                            $company->phone = trim($_POST["phone"]);
                        }
                        if(empty(trim($_POST["address"]))){
                            $company->address_msg = "Please enter company address";
                        } else{
                            $company->address = trim($_POST["address"]);
                        }
                       foreach($_POST["room"]->array_column(0) as $data){
                            $company->roomId = $data;
                       }
                        // Check input errors before inserting in database
                        if(empty($company->name_msg) && empty($company->email_msg) && empty($company->phone_msg) && empty($company->address_msg)){
                            $obj->insertRecord($company);
                            
                            /*unset this session for validation to empty the validated inputs
                              when come back to create page*/
                            if(isset($_SESSION['companytbl'])){
                                unset($_SESSION['companytbl']);
                            }
                            header('location:company_list');
                        }else{
                            $_SESSION['companytbl']=serialize($company);//add session obj  
                            header('location:create_company');
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
            $obj=new companyModel();
            try{
                $company=new company();
                if (isset($_POST['submit'])) {
                    
                    // Processing form data when form is submitted
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $company->id = $id;

                        if(empty(trim($_POST["name"]))){
                            $company->name_msg = "Please enter company name.";
                        } else{
                            $company->name = trim($_POST["name"]);
                        }
                        if(empty(trim($_POST["email"]))){
                            $company->email_msg = "Please enter company email address";
                        } else{
                            $company->email = trim($_POST["email"]);
                        }
                        if(empty(trim($_POST["phone"]))){
                            $company->phone_msg = "Please enter company phone number";
                        } else{
                            $company->phone = trim($_POST["phone"]);
                        }
                        if(empty(trim($_POST["address"]))){
                            $company->address_msg = "Please enter company address";
                        } else{
                            $company->address = trim($_POST["address"]);
                        }
                    
                        // Check input errors before inserting in database
                        if(empty($company->name_msg) && empty($company->email_msg) && empty($company->phone_msg) && empty($company->address_msg)){
                            
                            $obj->updateRecord($company);

                            /*unset this session for validation to empty the validated inputs
                            when come back to update page*/
                            if(isset($_SESSION['updateCompany'])){
                            unset($_SESSION['updateCompany']);
                            }
                            
                            header("location:company_profile?show_id=$id");

                        }else{
                            $_SESSION['updateCompany']=serialize($company);//add session obj 
                            header("location:update_copmany?show_id=$id");
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
                $obj =  new companyModel();
                $obj->deleteRecord($id);
                companyController::list();  
            }
            catch (Exception $e) 
            {
                $obj =  new companyModel();
                $obj->close_db();				
                throw $e;
            }
        }
        public static function list(){
            $companyModel=new companyModel();
            $result=$companyModel->selectRecord(0);
            include "./Views/Company/Index.php";                                        
        }
        
        public static function profile(){
            $id = $_GET['show_id'];
            $_SESSION["companyid"] = $_GET['show_id'];
            $companyModel=new companyModel();
            $result=$companyModel->selectRecord($id);
            include "./Views/Company/Profile.php";                                        
        }

        public static function create_company(){
            include "./Views/Company/Create.php";                                        
        }

        public static function update_company(){
            $id = $_GET['show_id'];
            $companyModel=new companyModel();
            $result=$companyModel->selectRecord($id);
            include "./Views/Company/Update.php";                                        
        }
    }
		
	
?>