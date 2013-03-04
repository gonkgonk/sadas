<?php
	
class RegisterController {
	
	public function DoControl(){
		$lh = new LoginHandler();
		$rv = new RegisterView();
		$rh = new RegisterHandler();
		$vh = new ValidationHandler();
		$mh = new MessageHandler();
		$mv = new MessageView();
		$nv = new NavigationView();
		
		$xhtml = "";
		
		//Validerar användarnamn, lösenord och lägger in användaren i databasen
		if ($lh->IsLoggedIn() == false){
			if ($rv->TriedToRegister() == true){
				if ($rh->UsernameExists($rv->GetUsername()) == true){
					$xhtml .= $mv->ShowMessage(MessageView::USERNAME_EXISTS);
				}
				else{
					if ($vh->ValidateUsername($rv->GetUsername()) == false){
						$xhtml .= $mv->ShowMessage(MessageView::INVALID_USERNAME);
					}
					else{
						if ($rv->CheckRepeatedPassword() == false){
							$xhtml .= $mv->ShowMessage(MessageView::UNMATCHING_PASSWORDS);
						}
						else{
							if ($vh->ValidatePassword($rv->GetPassword()) == false){
								$xhtml .= $mv->ShowMessage(MessageView::INVALID_PASSWORD);
							}
							else{
								$rh->InsertUser($rv->GetUsername(), $rv->GetPassword());
								$mh->SetMessage(MessageView::REGISTRATION_SUCCESS);
								$nv->SetHeaderLocation();
							}
						}
					}
				}
			}
		}
		
		//Skriver ut ett registreringsformulär om användaren är utloggad
		if ($lh->IsLoggedIn() == false){
			$xhtml .= $rv->DoRegisterBox();
		}
		else{
			$xhtml .= $mv->ShowMessage(MessageView::LOGOUT_TO_PROCEED);
		}
		
		return $xhtml;
	}
}