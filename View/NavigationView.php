<?php

class NavigationView {
	const LOGIN = "login";
	const LOGOUT = "logout";	
	const REGISTER = "register";
	const PICNAME = "picname";
	const ACCOUNT = "account";
	const UPLOAD = "upload";
	
	//Funktion för att kolla hur urlen ser ut	
	public function GetActiveController(){
		if (isset($_GET[self::LOGIN])){
			return self::LOGIN;
		}
		elseif (isset($_GET[self::LOGOUT])){
			return self::LOGOUT;
		}						
		elseif (isset($_GET[self::REGISTER])){
			return self::REGISTER;
		}
		elseif (isset($_GET[self::ACCOUNT])){
			return self::ACCOUNT;
		}		
		elseif (isset($_GET[self::PICNAME])){
			return self::PICNAME;
		}
		elseif (isset($_GET[self::UPLOAD])){
			return self::UPLOAD;
		}		
		else{
			return NULL;
		}
	}
	
	//Funktioner för att hämta olika adresser
	public static function GetIndexLink() {
		return "<a href='index.php'>Start</a>";
	}
	
	public static function GetLoginLink() {
		return "<a href='index.php?".self::LOGIN."'>Logga in</a>";
	}
	
	public static function GetLogoutLink() {
		return "<a href='index.php?".self::LOGOUT."'>Logga ut</a>";
	}
	
	public static function GetRegisterLink() {
		return "<a href='index.php?".self::REGISTER."'>Bli medlem</a>";
	}
	
	public static function GetAccountLink() {
		return "<a href='index.php?".self::ACCOUNT."'>Konto</a>";
	}
	
	public static function GetUploadLink() {
		return "<a href='index.php?".self::UPLOAD."'>Ny bild</a>";
	}	
	
	public static function GetLoginUrl() {
		return "index.php?".self::LOGIN;
	}	
	
	public static function GetRegisterUrl() {
		return "index.php?".self::REGISTER;
	}
	
	public static function GetUploadUrl() {
		return "index.php?".self::UPLOAD;
	}
	
	public static function GetAccountUrl() {
		return "index.php?".self::ACCOUNT;
	}
	
	//Redirectar användaren till startsidan
	public static function SetHeaderLocation(){
		return header("Location: index.php");
	}
	
	//Laddar om sidan
	public static function SetRefreshHeaderLocation(){	
		$ref = $_SERVER['HTTP_REFERER'];
		return header("Location: $ref");	
	}	
	
	//Sätter ihop en menyer beroende på inloggningstillstånd
	public function GetMenu(){
		$lh = new LoginHandler();
		$lv = new LoginView();
		$xhtml = "";
		if($lh->IsLoggedIn() == false){
	         $xhtml .=
	         	"<div id='menu'>
	                <ul>
						<li>".self::GetIndexLink()."</li>
						<li>".self::GetLoginLink()."</li>
						<li>".self::GetRegisterLink()."</li>
	                </ul>
	            </div>";
		}
		else{
	         $xhtml .=
	         	"<div id='menu'>
	                <ul>
						<li>".self::GetIndexLink()."</li>
						<li>".self::GetUploadLink()." </li>
						<li>".self::GetAccountLink()."</li>
						<li>".self::GetLogoutLink()."</li>
						<li><span id='menuLoggedInAs'>[".$lv->GetUsernameFromSession()."]</span></li> 	                    
	                </ul>
	            </div>";
		}
		
		return $xhtml;
	}		
}