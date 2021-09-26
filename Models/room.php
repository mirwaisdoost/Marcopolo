<?php

class room
{
    // table fields
    public $id;
    public $roomNumber;
    public $details;
    public $roomtypeid;

    // message string
    public $id_msg;
    public $roomNumber_msg;
    public $details_msg;
    public $roomtypeid_msg;
    
    // constructor set default value
    function __construct()
    {
        $id=$roomtypeid=0;$roomNumber=$details="";
        $id_msg=$roomNumber_msg=$details_msg=$roomtypeid_msg="";
    }
}

?>