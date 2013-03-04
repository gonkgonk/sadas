<?php

class ValidationHandler {

	//Funktion för att validera användarnamn
	function ValidateUsername($user) {
		if (preg_match('/^([a-zA-Z0-9_]){3,20}+$/',$user)){
			return true;
		}
		
		return false;
	}

	//Funktion för att validera lösenord
	public function ValidatePassword($pass){
		//Mellan 6-20 tecken. Minst en gemen, en versal och en siffra!
		if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/",$pass)){
			return true;
		}
		
		return false;
	}
	
	//Validerar kommentarer till bilderna
	public function ValidateComment($comment){
		//Kommentaren måste vara minst 1
		if (strlen(trim($comment)) > 0){
			$stringLength = strlen($comment);
			if ($stringLength >= 251 == false){
				//Plockar bort alla taggar
				$comment = strip_tags($comment, "");
				return $comment;
			}
		}
		
		return null;
	}
	
	//Testfunktion
	public function Test(){
		if($this->ValidateUsername("") == true){
			echo "En tomsträng ska egentligen inte funka!";
			return false;
		}
		
		if($this->ValidateUsername("_enAnvandare") == false){
			echo "Ett giltigt användarnamn ska funka!";
			return false;
		}
		
		if($this->ValidatePassword("") == true){
			echo "Lösenordet får inte vara tomt";
			return false;
		}
		
		if($this->ValidatePassword("abc") == true){
			echo "Lösenordet måste ha minst 6 tecken!";
			return false;
		}
		
		if($this->ValidatePassword("Abcdef6") == false){
			echo "Detta lösenord ska funka!";
		 	return false;
		}
	}
}