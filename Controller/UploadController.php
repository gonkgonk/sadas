<?php
	
class UploadController{
	
	public function DoControl(){
		$lh = new LoginHandler();
		$mh = new MessageHandler();
		$mv = new MessageView();
		$nv = new NavigationView();
		$uv = new UploadView();
		$uph = new UploadHandler();
		
		$xhtml = "";
		
		//Sparar den uppladdade bilden
		if ($lh->IsLoggedIn()){
			if ($uv->TriedToUpload()){
				//Hämtar filen, katalogsparar den och sparar namnet i databasen
				if ($pictureName = $uph->SavePicture($uv->GetUploadedFile())){
					$uph->InsertPictureName($pictureName);
					$mh->SetMessage(MessageView::PICTURE_UPLOADED);
					$nv->SetHeaderLocation();
				}
				else{
					$xhtml .= $mv->ShowMessage(MessageView::PICTURE_NOT_UPLOADED);
				}
			}	
		}
		
		//Skriver ut uppladdningsformulär
		if ($lh->IsLoggedIn()){
			$xhtml .= $uv->DoUploadBox();
		}
		
		return $xhtml;
	}
}