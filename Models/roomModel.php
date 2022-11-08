<?php
	require_once 'config.php';
	
	
	class roomModel
	{
		// open mysql database
		public function open_db()
		{
			$objconfig = new config();

			$host = $objconfig->host;
			$user = $objconfig->user;
			$pass =  $objconfig->pass;
			$db = $objconfig->db;   

			$this->condb=new mysqli($host,$user,$pass,$db);
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
		}	

		// insert record
		public function insertRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("INSERT INTO room (roomNumber,details,roomtypeid) VALUES (?, ?, ?)");
				$query->bind_param("sss",$obj->roomNumber,$obj->details,$obj->roomtypeid);
				$query->execute();
				$res= $query->get_result();
				$last_id=$this->condb->insert_id;
				$query->close();
				$this->close_db();
				return $last_id;
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}

        //update record
		public function updateRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("UPDATE room SET roomNumber=?,details=?,roomtypeid=? WHERE id=?");
				$query->bind_param("sssi", $obj->roomNumber,$obj->details,$obj->roomtypeid,$obj->id);
				$query->execute();
				$res=$query->get_result();						
				$query->close();
				$this->close_db();
				return true;
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}
        }
         // delete record
		public function deleteRecord($id)
		{	
			try{
				$this->open_db();
				$query=$this->condb->prepare("DELETE FROM room WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();

				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}		
        }   
        // select record     
		public function selectRecord($id)
		{
			try
			{
                $this->open_db();
                if($id>0)
				{	
					$query=$this->condb->prepare("SELECT * FROM room WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM room");	}		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}
		
	}

?>