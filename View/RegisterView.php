<?php

class RegisterView {
	private $usernameInput = "username";
	private $passwordInput = "password";
	private $repeatPasswordInput = "sadas";
	private $registerButton = "submit";

	//Funktion för ett registreringsformulär
	public function DoRegisterBox() {
		$xhtml = "<h2>Bli medlem</h2>
					<form action='" . NavigationView::GetRegisterUrl() . "' method='post' id='registerForm'>
							<label for='usernameRegistration'>Användarnamn</label><br />
							<input type='text' id='usernameRegistration' name='$this->usernameInput' /><br />
							<label for='passwordRegistration'>Lösenord</label><br />
							<input type='password' id='passwordRegistration' name='$this->passwordInput' /><br />
							<label for='repeatPasswordRegistration'>Lösenord igen</label><br />
							<input type='password' id='repeatPasswordRegistration' name='$this->repeatPasswordInput' /><br />			
							<input type='submit' id='submitButton' value='Skicka' name='$this->registerButton' /><br />
					</form>\n";
					
		return $xhtml;
	}
	
	//Funktion för användarnamn. Returnerar sträng med användarnamnet
	public function GetUsername() {
		if (isset($_POST[$this->usernameInput]) == true) {
			return $_POST[$this->usernameInput];
		}
		
		return NULL;
	}
	
	//Funktion för lösenord. Returnerar sträng med lösenordet
	public function GetPassword() {
		if (isset($_POST[$this->passwordInput]) == true) {
			return $_POST[$this->passwordInput];
		}
		
		return NULL;
	}
	
	//Funktion för att kontrollera upprepat lösenord. 
	public function CheckRepeatedPassword() {
		if (isset($_POST[$this->repeatPasswordInput]) == true) {
			if($_POST[$this->repeatPasswordInput] == $_POST[$this->passwordInput]){
				return true;					
			}
		}
		
		return false;
	}	
	
	//För att skicka registrering
	public function TriedToRegister(){
		if (isset($_POST[$this->registerButton]) == true){
			return $_POST[$this->registerButton];
		}
		
		return false;
	}
}
