<?php
	require_once 'config.php';
	
	
	class userModel
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
				$query=$this->condb->prepare("INSERT INTO user (name,last_name,type,username, email, password, is_active, entry_date, token, companyId, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$query->bind_param("sssssssssss",$obj->name,$obj->lastName,$obj->type,$obj->username,$obj->email,$obj->password,$obj->isActive,$obj->entrydate,$obj->token,$obj->companyId,$obj->photo);
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
				$query=$this->condb->prepare("UPDATE user SET name=?,last_name=?,type=?, email=?, is_active=?, photo=? WHERE id=?");
				$query->bind_param("ssssssi", $obj->name,$obj->lastName,$obj->type,$obj->email,$obj->isActive,$obj->photo,$obj->id);
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
				$query=$this->condb->prepare("SELECT * FROM user WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$row = mysqli_fetch_array($res);

				if(!empty($row['photo'])){
					unlink("./libs/photo/" . $row['photo']);
				}

				$query=$this->condb->prepare("DELETE FROM user WHERE id=?");
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
					$query=$this->condb->prepare("SELECT * FROM user WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM user");	}		
				
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