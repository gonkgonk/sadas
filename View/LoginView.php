<?php

class LoginView{
	
	private $usernameInput = "username";
	private $passwordInput = "password";
	private $submitButton = "submit";
	private $logoutButton = "logout";
	private $rememberCheckbox = "remember";
	private $UserOnlineSession = "username";
	
	//Funktion som returnerar ett login-formulär
	public function DoLoginBox(){
		$xhtml = "<h2>Logga in</h2>
				<form action='" . NavigationView::GetLoginUrl() . "' method='post' id='loginForm'>
	    				<label for='usernameInput'>Användarnamn</label><br />
	    				<input type='text' id='usernameInput' name='$this->usernameInput' /><br />
	    				<label for='passwordInput'>Lösenord</label><br />
	    				<input type='password' id='passwordInput' name='$this->passwordInput' /><br />
	    				<input type='checkbox' id='checkboxInput' name='$this->rememberCheckbox' value='remember' />
	    				<label for='checkboxInput'>Kom ihåg mig</label><br/>
	    				<input type='submit' id='submitButton' value='Logga in' name='$this->submitButton' />
	    		</form>\n";
				
		return $xhtml;
	}

	//Funktion som returnerar ett logga ut-formulär
	public function DoLogoutBox(){
		$xhtml = "<form action='' method='post' id='logofForm'>
	  				<input type='submit' id='submitButton' value='Logga ut' name='$this->logoutButton' />
	  			</form>\n";
				
		return $xhtml;
	}

	//Funktion för användarnamn. Returnerar sträng med användarnamnet
	public function GetUserName(){
		if (isset($_POST[$this->usernameInput]) == true) {
			return $_POST[$this->usernameInput];
		}
		elseif (isset($_COOKIE['userCookie']) == true) {
			return $_COOKIE['userCookie'];
		}

		return NULL;
	}

	//Funktion för lösenord. Returnerar sträng med lösenordet
	public function GetPassword(){
		if (isset($_POST[$this->passwordInput]) == true) {
			return $_POST[$this->passwordInput];
		} 
		elseif (isset($_COOKIE['passCookie']) == true) {
			return $_COOKIE['passCookie'];
		}
		
		return NULL;
	}

	//Funktion för login-knapp eller om kakorna är satta.
	public function TriedToLogIn(){
		if (isset($_POST[$this->submitButton]) == true) {
			return true;
		}
		elseif (isset($_COOKIE['userCookie']) && isset($_COOKIE['passCookie'])) {
			return true;
		}
		
		return false;
	}

	//Funktion för logga ut-knapp. 
	public function TriedToLogOut(){
		if (isset($_POST[$this->logoutButton]) == true) {
			return true;
		}
		if (isset($_GET[NavigationView::LOGOUT]) == true) {
			return true;
		}	
			
		return false;
	}
	
	//Funktion för kom ihåg mig-knapp
	public function RememberMeChecked(){
		if (isset($_POST[$this->rememberCheckbox]) == true) {
			return true;
		}
		
		return false;
	}

	//Funktion för att sätta remember me-kakor
	public function SetCookies($username, $password){
		setcookie("userCookie", $username, time()+3600*24);
		setcookie("passCookie", $password, time()+3600*24);
	}

	//.. och för att ta bort dem.
	public function DeleteCookies() {
		setcookie("userCookie", "", time()-3600*24);
		setcookie("passCookie", "", time()-3600*24);
	}
	
	//Sätter användarnamnet i sessionen
	public function SetUsernameInSession(){
		if (isset($_POST[$this->usernameInput])){
			$_SESSION[$this->UserOnlineSession] = $_POST[$this->usernameInput];
		}
		
		return false;
	}
	
	//Hämtar användarnamnet från sessionen
	public function GetUsernameFromSession(){
		if (isset($_SESSION[$this->UserOnlineSession])){
			return $_SESSION[$this->UserOnlineSession];
		}
		
		return NULL;
	}
}
