<?php

class GalleryHandler{
	
	private $dbc = null;
	
	//Hämtar filnamnen från databasen
	public function GetPictures(){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";	
		
		$this->dbc->Connect();		
				
		if ($stmt = $this->dbc->Prepare("SELECT pictureName FROM pictures")){	
			$stmt->execute();
			$stmt->bind_result($pictureName);
			
			//Hämtar bildernas filnamn
			while($stmt->fetch()){
				$result[] = $pictureName;
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_GET_PICTURES);
		}
		
		$this->dbc->Close();
		
		return $result;		
	}
	
	//Kollar om bilden finns i databasen
	public function PictureExists($pictureName){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("SELECT pictureName FROM pictures WHERE pictureName = ?")){
			$stmt->bind_param("s", $pictureName);
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows == true){
				$result = true;
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_CHECK_EXISTING_PICTURES);
		}
		$this->dbc->Close();
		
		return $result;		
	}
	
	// Testfunktion
	public function Test(){
		if($this->PictureExists("./GalleryPics/servett.png") == false){
			echo "Bilden finns inte i databasen!";
			return false;
		}
		
		if($this->GetPictures() == false){
			echo "Inga bilder hittades databasen!";
			return false;
		}
	}
}