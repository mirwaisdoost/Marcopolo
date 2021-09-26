<?php

class guest
{
    // table fields
    public $id;
    public $name;
    public $lastName;
    public $email;
    public $phone;
    public $address;
    public $photo;
    public $userId;

    // message string
    public $id_msg;
    public $name_msg;
    public $lastName_msg;
    public $email_msg;
    public $phone_msg;
    public $address_msg;
    public $photo_msg;
    public $userId_msg;
    
    // constructor set default value
    function __construct()
    {
        $id=$userId=0;$name=$lastName=$email=$phone=$address=$photo="";
        $id_msg=$name_msg=$lastName_msg=$email_msg=$phone_msg=$address_msg=$photo_msg=$userId_msg="";
    }
}

?>