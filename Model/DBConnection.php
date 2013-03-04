<?php

require_once("DBSettings.php");

class DBConnection{
	private $conn = null;

	//Öppnar en databasanslutning
	public function Connect(){
		$log = new Log();
		
		//Skapar nytt anslutningsobject med databasinställningarna
		$this->conn = new mysqli(DBSettings::DBHOST, 
                                 DBSettings::DBUSER, 
                                 DBSettings::DBPASSWORD,
                                 DBSettings::DATABASE);
		
		
		$this->conn->set_charset("utf8");
		
		if ($this->conn->connect_errno){
			$log->LogMessage(LOG::COULD_NOT_CONNECT);
			return false;
		}

		return true;
	}
	
	//Stänger databasanslutningen
	public function Close(){
		$this->conn->Close();
	}
	
	// "Förbereder" SQL-fråga
	public function Prepare($sql){
		$log = new Log();
		
		if ($this->conn == null){
			$log->LogMessage(LOG::COULD_NOT_PREPARE_SQL);
			return false;
		}
		
		$stmt = $this->conn->prepare($sql);
		
		return $stmt;
	}
		
	// Testfunktion
    public function Test() {
        if ($this->Connect() == false) {
            echo "Kunde inte ansluta till databasen!";
            return false;
        }
		
		if ($this->conn == null){
			echo "Connection är null!";
			return false;
		}
	}
	
}