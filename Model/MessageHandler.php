<?php

class MessageHandler {
	
	private $sessionMessage = null;
	
	//Kollar om sessions-meddelande är satt
	public function IsMessageSet(){
		if(isset($_SESSION[$this->sessionMessage])){
			return true;			
		}
		
		return false;
	}	
	
	//Sätter meddelandet i sessionen
	public function SetMessage($message){
		$_SESSION[$this->sessionMessage] = $message;
	}
	
	//Hämtar meddelandet
	public function GetMessage(){
		if (isset($_SESSION[$this->sessionMessage])){
			return $_SESSION[$this->sessionMessage];
		}
		
		return null;
	}

	//Tar bort meddelandet ur sessionen	
	public function ClearSessionMessage(){
		$_SESSION[$this->sessionMessage] = null;
	}
}