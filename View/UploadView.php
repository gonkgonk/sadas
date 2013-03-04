<?php

class UploadView {
	private $pictureUpload = "upload";
	private $submitButton = "submit";

	//Funktion som returnerar ett upload-formulär
	public function DoUploadBox() {
		$xhtml = "<h2 id='uploadPictureHead'>Ladda upp ny bild</h2>
					<form action='" . NavigationView::GetUploadUrl() . "' method='post' enctype='multipart/form-data'>
						<label for='pictureUpload'>Välj en fil:</label>
						<input type='file' name='$this->pictureUpload' id='pictureUpload' /><br />
						<input type='submit' name='$this->submitButton' value='Ladda upp' id='submitButton' />
					</form>	\n";
		return $xhtml;
	}
	
	//För att skicka uppladdning
	public function TriedToUpload(){
		if (isset($_POST[$this->submitButton]) == true){
			return $_POST[$this->submitButton];
		}
		
		return false;
	}
	
	//Hämtar den uppladdade bilden
	public function GetUploadedFile(){
		if ((($_FILES[$this->pictureUpload]["type"] == "image/gif")
			|| ($_FILES[$this->pictureUpload]["type"] == "image/jpeg")
			|| ($_FILES[$this->pictureUpload]["type"] == "image/png")
			|| ($_FILES[$this->pictureUpload]["type"] == "image/pjpeg"))
			&& ($_FILES[$this->pictureUpload]["size"] < 512000)){
			
			return $this->pictureUpload;
		}
		
		return null;
	}
}
