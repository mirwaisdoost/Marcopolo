<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'marcopolo');
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}*/

class config  
{	
	function __construct() {
		$this->host = "localhost";
		$this->user  = "root";
		$this->pass = "Herat1234";
		$this->db = "marcopolo";
		
		// $this->host = "sql.freedb.tech";
		// $this->user  = "freedb_passoo";
		// $this->pass = 'HcSJuu3pzJG$e&H';
		// $this->db = "freedb_passoo";
	}
}

?>