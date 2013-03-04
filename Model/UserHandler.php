<?php

class UserHandler{
	
	private $dbconnection = NULL;
	
	// Funktion för att kontrollera användaren
	public function UserExists($username, $password){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";	
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("SELECT * FROM users WHERE username = ? AND password = ?")) {
			$stmt->bind_param("ss", $username,$password);
			$stmt->execute();
			$stmt->store_result();
			
			if ($stmt->num_rows == true){
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
	
	// Ändra en användares lösenord
	public function UpdateUserPassword($username, $password){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";	
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("UPDATE users SET password = ? WHERE username = ?")) {
			$stmt->bind_param("ss", $password, $username);
			$stmt->execute();
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_UPDATE_USER_PASS);			
		}			
		
		$this->dbc->Close();
		
		return $result;
	}
	
	// Plocka bort användare
	public function DeleteUser($username){
		$this->dbc = new DBConnection();
		$log = new Log();
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("DELETE FROM users WHERE username = ?")) {
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_DELETE_USER);			
		}		
		
		$this->dbc->Close();
		
		return;
	}
	
	//Testfunktion
	public function Test(){
		if($this->UserExists("username", "password") == false){
			echo "Användarnamnet ska finnas!";
			return false;
		}
		
		if($this->DeleteUser("user") == true){
			echo "Användaren har tagits bort!";
			return false;
		}
		
		if($this->UpdateUserPassword("EnSkivaFyraBen","Sommar123") == true){
			echo "Användarens lösenord har ändrats!";
			return false;
		}
	}
}