<?php require_once '../../appInit.php';

	require_once($_SESSION['_CLASS'] .'Cookies.php');

	$_COOKIES = new Cookies();
	$Coo      = $_POST['Coo'];
	$Ses      = $_POST['Ses'];

	$_COOKIES->Destroy($_ENV["SESSION_ID_$Coo"]);
	$_TOKENS->NewSessionId($_SESSION[$Ses], $_ENV["SESSION_ID_$Coo"]);

	echo '<script>setTimeout(function() { location.reload(); },  2000)</script>';