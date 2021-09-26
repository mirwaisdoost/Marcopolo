<?php

class user
{
    // table fields
    public $id;
    public $name;
    public $lastName;
    public $type;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $oldPassword;
    public $isActive;
    public $entryDate;
    public $token;
    public $companyId;
    public $photo;

    // message string
    public $id_msg;
    public $name_msg;
    public $lastName_msg;
    public $type_msg;
    public $username_msg;
    public $email_msg;
    public $password_msg;
    public $confirmPassword_msg;
    public $oldPassword_msg;
    public $isActive_msg;
    public $entryDate_msg;
    public $token_msg;
    public $companyId_msg;
    public $photo_msg;
    
    // constructor set default value
    function __construct()
    {
        $id=$type=$companyId=$isActive=0;$category=$name=$lastName=$username=$email=$password=$confirmPassword=$oldPassword=$entryDate=$token=$photo="";
        $id_msg=$name_msg=$lastName_msg=$type_msg=$username_msg=$email_msg=$password_msg=$confirmPassword_msg=$oldPassword_msg=$isActive_msg= $entryDate_msg=$token_msg=$companyId_msg=$photo_msg="";
    }
}

?>