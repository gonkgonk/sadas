<?php

class LoginHandler{

	private $UserOnlineSession = true;

	//Funktion för att kolla om användare är inloggad.
	public function IsLoggedIn() {
		if (isset($_SESSION[$this->UserOnlineSession])) {
			return true;
		}
		
		return false;
	}

	//Funktion för hanteringen av inloggning
	public function DoLogin($myUsername, $myPassword) {
		$uh = new UserHandler();
			//Kollar om användaren finns i databasen
			if ($uh->UserExists($myUsername, $myPassword) == true) {
				if (isset($_SESSION[$this->UserOnlineSession]) == false){
					$_SESSION[$this->UserOnlineSession] = true;
				}
				
				return true;
			}
			
		return false;
	}

	//Funktion för hantering av utloggning.
	public function DoLogout() {
		if (isset($_SESSION[$this->UserOnlineSession]) == true){
			unset($_SESSION[$this->UserOnlineSession]);
		}
		
		return;
	}

	//Funktion för testning
	public function Test() {

		//2.2 Loggar ut
		$this->DoLogout();

		//2.3 Testar om användare är inloggad
		if ($this->IsLoggedIn() == true) {
			echo "Felmeddelande 2.3! Användaren är inloggad.";
			return false;
		}

		//2.4 Testar att logga in med felaktiga uppgifter
		if ($this->DoLogin("wrong", "user") == true) {
			echo "Felmeddelande 2.4! Inloggad med felaktiga uppgifter.";
			return false;
		}

		//2.5 Testar att logga in godkänd användare "username" med lösenordet "password"
		if ($this->DoLogin("username", "password") == false) {
			echo "Felmeddelande 2.5! Korrekta uppgifter men misslyckad inloggning.";
			return false;
		}

		//2.6 Kollar om "username" är inloggad
		if ($this->IsLoggedIn() == false) {
			echo "Felmeddelande 2.6! Användaren är inte inloggad.";
			return false;
		}

		//2.7 Loggar ut...
		$this->DoLogout();

		//2.8 ...och testar att logga in med rätt användarnamn och fel lösenord
		if ($this->DoLogin("username", "asdasd") == true) {
			echo "Felmeddelande 2.8! Lyckad inloggning med fel lösenord.";
			return false;
		}

		$this->DoLogout();

		//Testar session genom att logga in med riktigta uppgifter
		if ($this->DoLogin("username", "password") == false) {
			echo "Felmeddelande! Misslyckad inloggning! ";
			return false;
		}

		//Testar om användare är inloggad
		$this->IsLoggedIn();
		if (isset($_SESSION[$this->UserOnlineSession]) == false) {
			echo "Felmeddelande! Användaren är inte inloggad.";
			return false;
		}
		
		$this->DoLogout();
		
		return;
	}

}
