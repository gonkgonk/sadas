<?php

class CommentView {

	private $username = "username";
	private $comment = "message";
	private $submitButton = "submit";
	
	const PICTURE_DIRECTORY = "./GalleryPics/";
	
	//Formulär för bildkommentarer
	public function DoCommentBox() {
		$xhtml = "<form action='' method='post' id='commentForm'>
    				<label for='message_input'>Kommentera (Max 250 tecken):</label><br />
    				<textarea id='comment_input' name='$this->comment' cols='40' rows='6'></textarea><br />
    				<input type='submit' id='submit_input' value='Skicka' name='$this->submitButton' />
    		</form>\n";	
			
		return $xhtml;
	}
	
	//Hämtar kommentar
	public function GetComment() {
		if (isset($_POST[$this->comment]) == true) {
			return $_POST[$this->comment];
		} 
		
		return null;
	}
	
	//Hämtar tid och datum
	public function GetDateTime(){
		$dateTime = date("Y-m-d - H:i");
		
		return $dateTime;
	}
	
	//Kollar om tryckt på kommentera-knappen
	public function TriedToComment(){
		if (isset($_POST[$this->submitButton]) == true) {
			return true;
		}
		
		return false;
	}
	
	//Skriver ut bildens kommentarer
	public function ShowComments($comments){
		if (count($comments, COUNT_RECURSIVE) > 1){
			$xhtml = "<p id='pictureCommentsHead'>Kommentarer:</p>";
				foreach ($comments as $key => $value) {
					$xhtml .= "<div class='pictureCommentDiv'>
								<p class='pictureCommentsUser'>Postat av: $value[0]</p>
								<p class='pictureCommentsComment'>$value[1]</p>
								<p class='pictureCommentsDateTime'>$value[2]</p>
							</div>\n";
				}
		} 
		else {
			$xhtml = "<p class='pictureCommentsNotice'>Bli den första att kommentera bilden!</p>";
		}			

		return $xhtml;
	}
	
	//Hämtar bildnamnet genom GET
	public function GetPictureName(){
		$pictureName = $_GET['picname'];
		return $pictureName;
	}
	
	//Skriver ut aktiv bild
	public function ShowSelectedPicture() {
		$xhtml = "<img src='".self::PICTURE_DIRECTORY."".$this->GetPictureName()."' class='largePicture' />\n";
		
		return $xhtml;
	}	
}