<?php

	const SLASH = DIRECTORY_SEPARATOR;

/*--------------------------------------------
VARIABLES DE CLIENTE
-----------------------------------------------*/
	if(isset($hom) && $hom) $roution = ""; else $roution = "../";


/*--------------------------------------------
VARIABLES SE SESIÓN
-----------------------------------------------*/
	$_SESSION['_CLASS'] = $_SESSION['_ROOT'] .'class/';


/*--------------------------------------------
VARIABLES DE ENTORNO Y CLASES
-----------------------------------------------*/
	require_once ( $_SESSION['_HELPERS'].'loadClasses.php');
	require_once ( $_SESSION['_HELPERS'].'phpFunctions.php');
	require_once ( $_SESSION['_HELPERS'].'ProcessDataOrder.php');
	require_once ( $_SESSION['_HELPERS'].'ReporteACT.php');
	require_once ( $_SESSION['_HELPERS'].'BuiltSqlTextsACT.php');
	require_once ( $_SESSION['_HELPERS'].'WorkerOrders.php');





	$vertion  = $_ENV['VERSION'];
	$dominion = $_ENV[$_SESSION['_APP_NAME'] .'_DOMINION'];
	if(isset($_COVER)) $dominion = str_replace("platform", $_COVER, $dominion);
	$static   = $dominion."static/";

	$_SESSION["_ROUTION"]  = $roution;
	$_SESSION["_DOMINION"] = $dominion;
	$_SESSION["_STATIC"]   = $static;
	$_SESSION["_VERTION"]  = $vertion;

/*--------------------------------------------
FOLDER STRUCUTURE
-----------------------------------------------*/
	$geton[0] = "";
	$geton    = isset($_GET["getion"]) ? explode("/", $_GET["getion"]) : $geton;

/*--------------------------------------------
CONTROL DE ERRORES
-----------------------------------------------*/
	if($_ENV["DEBUG"]){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}