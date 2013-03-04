<?php
	
class MasterController {
	
	public function DoControl()
	{
		$mc = new MasterController();
		$dbc = new DBConnection();
		$lc = new LoginController();
		$rc = new RegisterController();
		$cc = new CommentController();
		$nv = new NavigationView();
		$gc = new GalleryController();
		$mv = new MessageView();
		$mh = new MessageHandler();
		$ac = new AccountController();
		$uc = new UploadController();
		$mc = new MasterController();	
		
		$xhtml = "";
		
		//Meddelanden som kommer från en redirect
		if ($mh->IsMessageSet() == true){
			$xhtml .= $mv->ShowMessage($mh->GetMessage());
			$mh->ClearSessionMessage();
		}
		
		//Kollar vilken sida som är aktiv och anropar aktuell controller
		if ($nv->GetActiveController() == NavigationView::LOGIN){
			$xhtml .= $lc->DoControl();
		}
		elseif ($nv->GetActiveController() == NavigationView::LOGOUT){
			$xhtml .= $lc->DoControl();
		}
		elseif ($nv->GetActiveController() == NavigationView::REGISTER){
			$xhtml .= $rc->DoControl();
		}
		elseif ($nv->GetActiveController() == NavigationView::PICNAME){
			$xhtml .= $cc->DoControl();
		}		
		elseif ($nv->GetActiveController() == NavigationView::ACCOUNT){
			$xhtml .= $ac->DoControl();
		}
		elseif ($nv->GetActiveController() == NavigationView::UPLOAD){
			$xhtml .= $uc->DoControl();
		}		
		else {
			$xhtml .= $gc->DoControl();
		}	
		
		return $xhtml;
	}
}