<?php

class company
{
    // table fields
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $roomId=[];

    // message string
    public $id_msg;
    public $name_msg;
    public $email_msg;
    public $phone_msg;
    public $address_msg;
    
    // constructor set default value
    function __construct()
    {
        $id=0;$name=$email=$phone=$address="";
        $id_msg=$name_msg=$email_msg=$phone_msg=$address_msg="";
    }
}

?>