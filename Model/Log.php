<?php

class Log {

	private $logFile = "Model/log.txt";
	private $errorArray = array();
	
	const COULD_NOT_CONNECT = "Kunde inte ansluta till databasen";
	const COULD_NOT_GET_COMMENTS = "Kunde inte hämta kommentarer från databasen";
	const COULD_NOT_INSERT_COMMENTS = "Kunde inte lägga till ny kommentar i databasen";
	const COULD_NOT_INSERT_USER = "Kunde inte lägga till ny användare i databasen";
	const COULD_NOT_CHECK_EXISTING_USER = "Kunde inte kontrollera existerande användare i databasen";
	const COULD_NOT_GET_USER = "Kunde inte hämta användaren från databasen";
	const COULD_NOT_DELETE_USER = "Kunde inte ta bort användaren från databasen";
	const COULD_NOT_UPDATE_USER_PASS = "Kunde inte uppdatera användarens lösenord i databasen";
	const COULD_NOT_CHECK_EXISTING_PASSWORD = "Kunde inte kontrollera användarens lösenord i databasen";
	const COULD_NOT_GET_PICTURES = "Kunde inte hämta bilder i databasen!";
	const COULD_NOT_CHECK_EXISTING_PICTURES = "Kunde inte kontrollera existerande bilder i databasen!";
	const COULD_NOT_INSERT_PICTURE_INTO_DB = "Kunde inte lägga in bilden i databasen!";
	const COULD_NOT_PREPARE_SQL = "Kunde inte förbereda SQL-frågan!";

	// Loggar felmeddelanden
	public function LogMessage($message) {
		
		$datum = date("l dS \of F Y h:i:s A");

		array_push($this->errorArray, $datum . " - " . $message);

		$file = fopen($this->logFile, "a");
		
		fwrite($file, $datum . " - " . $message . "\r\n");
		fclose($file);
	}
	
	//Funktion som skriver felmeddelanden till textfil.
	public function ShowMessages() {
		
		$file = fopen($this->logFile, "r");
		
		//While-loop som skriver ut rad från rad, till den nått slutet på filen.
		while(! feof($file)){
  			echo fgets($file). "<br />";
  		}

		fclose($file);
	}
	
	//Skriver ut meddelanden
	public function ShowLogFromArray() {
		$xhtml = "";
		
		for ($i = 0; $i < count($this->errorArray); $i++){
		  	$xhtml .= "<p>" .$this->errorArray[$i]."</p>";
		 }
		
		return $xhtml;
	}
}
