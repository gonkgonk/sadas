<?php

class UploadHandler{
	
	private $dbc = null;
	
	const PICTURE_DIRECTORY = "./GalleryPics/";
	
	//Sparar bilden i mapp
	public function SavePicture($picture){
		if (isset($picture)){
			//Om bilden finns i mappen
			if (file_exists(self::PICTURE_DIRECTORY.$_FILES["$picture"]["name"])){
				return false;
			}
			else{
				//Flyttar temporär fil till katalog
				move_uploaded_file($_FILES["$picture"]["tmp_name"], self::PICTURE_DIRECTORY.$_FILES["$picture"]["name"]);
				return $_FILES["$picture"]["name"];
			}			
		}
		
		return false;
	}
	
	//Sparar bildnamnet i databasen
	public function InsertPictureName($pictureName){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";
		
		$this->dbc->Connect();		
		
		if ($stmt = $this->dbc->Prepare("INSERT INTO pictures (pictureName) VALUES(?)")){
	        $stmt->bind_param("s", $pictureName);		
			$stmt->execute();
			
			if ($stmt->affected_rows == true){
				$result = true;
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_INSERT_PICTURE_INTO_DB);
		}
		
		$this->dbc->Close();
		
		return $result;		
	}
	
	//Testfunktion
	public function Test(){
		if($this->InsertPictureName("./GalleryPics/servett.png") == false){
			echo "Bilden kunde inte läggas in i databasen!";
			return false;
		}		
	}
}