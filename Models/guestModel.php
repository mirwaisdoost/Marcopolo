<?php
	require_once 'config.php';
	
	
	class guestModel
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
				$query=$this->condb->prepare("INSERT INTO guest (name,lastName, email, phone, address, photo, userID) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$query->bind_param("sssssss",$obj->name,$obj->lastName,$obj->email,$obj->phone,$obj->address,$obj->photo,$obj->userId);
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
				$query=$this->condb->prepare("UPDATE guest SET name=?,lastName=?, email=?, phone=?, address=?, photo=? WHERE id=?");
				$query->bind_param("ssssssi", $obj->name,$obj->lastName,$obj->email,$obj->phone,$obj->address,$obj->photo,$obj->id);
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
				$query=$this->condb->prepare("SELECT * FROM guest WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$row = mysqli_fetch_array($res);

				if(!empty($row['photo'])){
					unlink("./libs/photo/" . $row['photo']);
				}

				$query=$this->condb->prepare("DELETE FROM guest WHERE id=?");
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
					$query=$this->condb->prepare("SELECT * FROM guest WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM guest");	}		
				
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