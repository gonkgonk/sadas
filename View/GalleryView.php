<?php

class GalleryView{
	
	const PICTURE_DIRECTORY = "./GalleryPics/";	
	
	//Skriver ut bilderna från databasen
	public function ShowPictures($pictureName, $commentNum){
		//Html för bild med kommentarer
		$xhtml = "<div class='pictureDiv'>
						<a href='index.php?picname=$pictureName'><img src='".self::PICTURE_DIRECTORY."$pictureName' alt='$pictureName' class='galleryThumbs' /><span>$commentNum kommentarer</span></a>
				</div>";
					
		return $xhtml;
	}
}