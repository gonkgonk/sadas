<?php

class MessageView {
	
	const LOGIN_SUCCESS = "Du har loggat in!";
	const LOGOUT_SUCCESS = "Du har loggat ut!";
	const WRONG_USER_OR_PASSWORD = "Fel användarnamn eller lösenord! Försök igen!";
	const USERNAME_EXISTS = "Användarnamnet finns redan";
	const INVALID_USERNAME = "Användarnamnet är ogiltigt!";
	const UNMATCHING_PASSWORDS = "Lösenorden stämmer inte överens!";
	const INVALID_PASSWORD = "Lösenordet måste innehålla en versal, en gemen, en siffra samt vara mellan 6-20 tecken!";
	const REGISTRATION_SUCCESS = "Registrering slutförd! Nu kan du logga in!";
	const INVALID_COMMENT = "Kommentaren måste vara mellan 1-250 tecken!";
	const LOGIN_TO_PROCEED = "Du måste logga in för att fortsätta!";
	const LOGOUT_TO_PROCEED = "Du måste logga ut för att fortsätta!";
	const NOT_FOUND = "Sidan kunde inte hittas!";
	const INVALID_OLD_PASSWORD = "Lösenordet stämmer inte med ditt gamla!";
	const ACCOUNT_CHANGE_SUCCESS = "Ditt konto har uppdaterats!";
	const ACCOUNT_DELETED = "Ditt konto är borttaget!";
	const PICTURE_NOT_UPLOADED = "Bilden kunde inte laddas upp! Den kan vara för stor eller redan finnas!";
	const PICTURE_UPLOADED = "Bilden har laddats upp!";
	
	//Skriver ut meddelanden till användaren
	public function ShowMessage($message){	
		$xhtml = "<p class='outputMessages'>$message</p>\n";
		
		return $xhtml;
	}
}