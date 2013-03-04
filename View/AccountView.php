<?php

class AccountView{
	
	private $usernameInput = "username";
	private $oldPassword = "oldpass";
	private $passwordInput = "password";
	private $repeatPasswordInput = "sadas";
	private $updateUserButton = "update";
	private $deleteUserButton = "delete";
	
	//Formulär för att uppdatera kontouppgifter
	public function DoUpdateUserBox(){
		$xhtml = "<h2>Konto</h2>
				<div class='accordion'>
					<h3>» Ändra lösenord</h3>\n
						<div>
						<form action='" . NavigationView::GetAccountUrl() . "' method='post' id='updateUserForm'>
							<label for='oldPasswordUpdate'>Gammalt lösenord</label><br />
							<input type='password' id='oldPasswordUpdate' name='$this->oldPassword' /><br />
							<label for='passwordUpdate'>Nytt lösenord</label><br />
							<input type='password' id='passwordUpdate' name='$this->passwordInput' /><br />
							<label for='repeatPasswordUpdate'>Lösenord igen</label><br />
							<input type='password' id='repeatPasswordUpdate' name='$this->repeatPasswordInput' /><br />			
							<input type='submit' id='submitButton' value='Uppdatera' name='$this->updateUserButton' /><br />
						</form>
						</div>
				</div>\n";
					
		return $xhtml;
	}
	
	//Formulär för att ta bort konto
	public function DoDeleteUserBox(){
		$xhtml = "<div class='accordion'>
					<h3>» Radera konto</h3>\n
						<div>
							<form action='' method='post' id='deleteUserForm'>		
									<input type='submit' id='submit_input' value='Ta bort' name='$this->deleteUserButton' /><br />
							</form>
						</div>
				  </div>\n";
					
		return $xhtml;
	}
	
	//Funktion för lösenord. Returnerar sträng med lösenordet
	public function GetOldPassword(){
		if (isset($_POST[$this->oldPassword]) == true){
			return $_POST[$this->oldPassword];
		}
		
		return NULL;
	}	
	
	//Funktion för lösenord. Returnerar sträng med lösenordet
	public function GetNewPassword() {
		if (isset($_POST[$this->passwordInput]) == true) {
			return $_POST[$this->passwordInput];
		}
		
		return NULL;
	}
	
	//Funktion för lösenord. Returnerar sträng med lösenordet
	public function CheckRepeatedPassword(){
		if (isset($_POST[$this->repeatPasswordInput]) == true){
			if($_POST[$this->repeatPasswordInput] == $_POST[$this->passwordInput]){
				return true;					
			}
		}
		
		return false;
	}
	
	//För att ta bort konto
	public function TriedToUpdatePassword(){
		if (isset($_POST[$this->updateUserButton])){
			return true;
		}
		
		return false;
	}
	
	//För att ta bort konto
	public function TriedToDelete(){
		if (isset($_POST[$this->deleteUserButton])){
			return true;
		}
		
		return false;
	}
}