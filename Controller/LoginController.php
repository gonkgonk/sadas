<?php
	
class LoginController {
	
	public function DoControl()
	{
		$lv = new LoginView();
		$lh = new LoginHandler();
		$mh = new MessageHandler();
		$mv = new MessageView();
		$nv = new NavigationView();
		
		$xhtml = "";
		
		// Loggar in användaren
		if ($lh->IsLoggedIn() == false){
			if ($lv->TriedToLogIn()){
				if ($lh->DoLogin($lv->GetUserName(),$lv->GetPassword()) == false){
					$xhtml .= $mv->ShowMessage(MessageView::WRONG_USER_OR_PASSWORD);
				}
				else{
					if ($lv->RememberMeChecked() == true) {
						$lv->SetCookies($lv->GetUserName(),$lv->GetPassword());
					}
					$lv->SetUsernameInSession();
					$mh->SetMessage(MessageView::LOGIN_SUCCESS);
					$nv->SetHeaderLocation();
				}
			}
		}
		
		// Loggar ut användaren
		if ($lh->IsLoggedIn()){
			if ($lv->TriedToLogOut()){
				$lh->DoLogout();
				$lv->DeleteCookies();
				$mh->SetMessage(MessageView::LOGOUT_SUCCESS);
				$nv->SetHeaderLocation();
			}
		}		
			
		// Olika formulär beroende på om användaren är inloggad eller utloggad
		if ($lh->IsLoggedIn()){
			$xhtml .= $lv->DoLogoutBox();
		}
		else{
			$xhtml .= $lv->DoLoginBox();
		}
	
		return $xhtml;
	}
}