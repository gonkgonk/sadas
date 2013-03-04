<?php

class AccountController {
	
	public function DoControl(){
		$lh = new LoginHandler();
		$av = new AccountView();
		$uh = new UserHandler();
		$lv = new LoginView();
		$vh = new ValidationHandler();
		$mv = new MessageView();
		$nv = new NavigationView();
		$mh = new MessageHandler();
			
		$xhtml = "";
				
		// Funktion för att uppdatera lösenord
		if ($lh->IsLoggedIn()){
			if ($av->TriedToUpdatePassword()){
				//Kollar om det gamla lösenordet stämmer
				if (!$uh->UserExists($lv->GetUsernameFromSession(), $av->GetOldPassword())){
					$xhtml .= $mv->ShowMessage(MessageView::INVALID_OLD_PASSWORD);
				}
				else{
					//Validerar lösenord
					if ($vh->ValidatePassword($av->GetNewPassword()) == false){
						$xhtml .= $mv->ShowMessage(MessageView::INVALID_PASSWORD);
					}
					else{
						if ($av->CheckRepeatedPassword() == false){
							$xhtml .= $mv->ShowMessage(MessageView::UNMATCHING_PASSWORDS);
						}
						else{
							//Uppdaterar med det nya lösenordet i databasen
							$uh->UpdateUserPassword($lv->GetUsernameFromSession(), $av->GetNewPassword());
							$mh->SetMessage(MessageView::ACCOUNT_CHANGE_SUCCESS);
							$nv->SetRefreshHeaderLocation();
						}
					}
				}
			}
		}		
		
		// Funktion för att ta bort konto
		if ($lh->IsLoggedIn()){
			if ($av->TriedToDelete()){
				$uh->DeleteUser($lv->GetUsernameFromSession());
				$lh->DoLogout();
				$mh->SetMessage(MessageView::ACCOUNT_DELETED);
				$nv->SetHeaderLocation();
			}
		}
		
		// Skriver formulär för uppdatera konto & ta bort-konto
		if ($lh->IsLoggedIn()){
			$xhtml .= $av->DoUpdateUserBox();
			$xhtml .= $av->DoDeleteUserBox();
		}
		else{
			$xhtml .= $mv->ShowMessage(MessageView::LOGIN_TO_PROCEED);			
		}
				
		return $xhtml;
	}
}