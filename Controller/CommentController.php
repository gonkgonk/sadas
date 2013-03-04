<?php

class CommentController {
	
	public function DoControl(){
		$lh = new LoginHandler();
		$gv = new GalleryView();
		$gh = new GalleryHandler();
		$mv = new MessageView();
		$nv = new NavigationView();
		$cv = new CommentView();
		$ch = new CommentHandler();
		
		$xhtml = "";
		
		if ($lh->IsLoggedIn() == true){
			//Kontrollerar om bilden finns i databasen
			if ($gh->PictureExists($cv->GetPictureName()) == false){
				$xhtml .= $mv->ShowMessage(MessageView::NOT_FOUND);
			}
			else{
				//Skriver ut vald bild med kommentarer
				$xhtml .= $cv->ShowSelectedPicture();
				$xhtml .= $cv->ShowComments($ch->GetComments($cv->GetPictureName()));
				$xhtml .= $this->NewComment();
				$xhtml .= $cv->DoCommentBox();
			}
		}
		else{
			$xhtml .= $mv->ShowMessage(MessageView::LOGIN_TO_PROCEED);	
		}
		
		return $xhtml;
	}

	//Funktion för att lägga till kommentar i databasen
	private function NewComment(){
		$lv = new LoginView();
		$nv = new NavigationView();
		$vh = new ValidationHandler();
		$mv = new MessageView();
		$ch = new CommentHandler();
		$cv = new CommentView();
		
		$xhtml = "";
		
		if ($cv->TriedToComment() == true){
			//Validerar kommentaren och lägger in den i databasen med användarnamn osv.
			if ($validatedComment = $vh->ValidateComment($cv->GetComment())) {
				$ch->InsertComment($validatedComment, $lv->GetUsernameFromSession(), $cv->GetDateTime(), $cv->GetPictureName()); 
				$nv->SetRefreshHeaderLocation();
			}
			else{
				$xhtml .= $mv->ShowMessage(MessageView::INVALID_COMMENT);
			}
			
		}
		
		return $xhtml;
	}
		
}