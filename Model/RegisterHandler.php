<?php

class RegisterHandler{
	
	private $dbc = null;
	
	// Funktion för att lägga till användare
	public function InsertUser($username, $password){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("INSERT INTO users (username, password) VALUES(?, ?)")){
	        $stmt->bind_param("ss", $username,$password);		
			$stmt->execute();
			
			if($stmt->affected_rows == true){
				$result = true;
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_INSERT_USER);
		}
		
		$this->dbc->Close();
		
		return $result;
	}
	
	// Kollar om användarnamnet finns
	public function UsernameExists($username){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("SELECT * FROM users WHERE username = ?")) {
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$stmt->store_result();
			
			//Om användarnamnet redan finns returneras true
			if($stmt->num_rows == true){
				$result = true;
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_CHECK_EXISTING_USER);		
		}
		
		$this->dbc->Close();
		
		return $result;
	}
	
	//Test
	public function Test(){
		if ($this->InsertUser("Username1", "Password1") == false){
			echo "Detta användarnamn och lösenord ska funka!";
			return false;
		}
		
		if ($this->UsernameExists("username") == true){
			echo "Detta användarnamn finns redan!";
			return false;
		}
	}
}