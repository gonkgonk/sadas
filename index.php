<?php
	session_start();

	require_once ("View/LoginView.php");
	require_once ("View/RegisterView.php");
	require_once ("View/NavigationView.php");
	require_once ("View/GalleryView.php");
	require_once ("View/CommentView.php");
	require_once ("View/MessageView.php");
	require_once ("View/AccountView.php");
	require_once ("View/UploadView.php");	
	require_once ("Controller/LoginController.php");
	require_once ("Controller/RegisterController.php");
	require_once ("Controller/GalleryController.php");
	require_once ("Controller/MasterController.php");
	require_once ("Controller/CommentController.php");
	require_once ("Controller/AccountController.php");
	require_once ("Controller/UploadController.php");		
	require_once ("Model/LoginHandler.php");
	require_once ("Model/RegisterHandler.php");
	require_once ("Model/CommentHandler.php");	
	require_once ("Model/GalleryHandler.php");
	require_once ("Model/MessageHandler.php");	
	require_once ("Model/UserHandler.php");
	require_once ("Model/ValidationHandler.php");
	require_once ("Model/UploadHandler.php");
	require_once ("Model/Log.php");
	require_once ("Model/DBConnection.php");
	require_once ("Model/DBSettings.php");
	
	$mc = new MasterController();
	$dbc = new DBConnection();
	$nv = new NavigationView();
	
	$xhtml = "";
	
	//Ansluter till databas
	$dbc->Connect();
	
	//Meny
	$menu = $nv->GetMenu();
	
	//Sidinnehåll
	$xhtml .= $mc->DoControl();
	
	//Stänger databaskopplingen
	$dbc->Close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<title>SADAS.se</title>
	</head>
	<body>
		<div id="container">
			<div id="head">
				<h1>SADAS.se</h1>
				<?php
    				echo $menu;
  				?>
			</div>
			<div id="content">
				<?php
    				echo $xhtml;
  				?>
  			</div>
			<div id="footer">
				<p>&copy; Eric Johansson 2011</p>
			</div>
  		</div>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  		<script type="text/javascript" src="js/validation.js"></script>
  		<script type="text/javascript" src="js/accordion.js"></script>
	</body>
</html>