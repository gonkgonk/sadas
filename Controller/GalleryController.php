<?php

class GalleryController {
	
	public function DoControl(){
		$lh = new LoginHandler();
		$gv = new GalleryView();
		$gh = new GalleryHandler();
		$mv = new MessageView();
		$nv = new NavigationView();
		$ch = new CommentHandler();
		
		$xhtml = "";
		
		//Hämtar ut bildnamn från databasen
		$pictures = $gh->GetPictures();
		
		//Loopar igenom alla bilder och hämtar antal kommentar per bild
		foreach ($pictures as $pictureName) {
			$commentNum = $ch->GetNumberOfCommentsByPicture($pictureName);
			$xhtml .= $gv->ShowPictures($pictureName, $commentNum);
		}
		
		return $xhtml;
	}
}