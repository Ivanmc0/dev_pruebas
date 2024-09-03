<?php

    // Initialization PHP Session
    if(session_status() === PHP_SESSION_NONE) session_start();


    /*--------------------------------------------
        DIRECTORIO RAIZ  OLC
    -----------------------------------------------*/
    $projectRoot = '';
    $currentDir  = realpath(__DIR__);
    $rootParts   = explode(DIRECTORY_SEPARATOR, $currentDir);
    foreach ($rootParts as $part) {
        if ($part == 'jobs') break;
        $projectRoot .= $part . DIRECTORY_SEPARATOR;
    }

    $_SESSION['_ROOT']     = $projectRoot;
    $_SESSION['_APPS']     = $_SESSION['_ROOT'].'apps/';
    $_SESSION['_INIT']     = $_SESSION['_ROOT'].'init.php';
    $_SESSION['_HELPERS']  = $_SESSION['_ROOT'].'helpers/';
    $_SESSION['_APP_NAME'] = 'WEB';
    $_SESSION['_MAILS']    = $_SESSION['_ROOT'].'mails/';

    /*--------------------------------------------
        INICIO DE APLICACIÓN
    -----------------------------------------------*/


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
   

    $vertion  = $_ENV['VERSION'];
    $dominion = $_ENV[$_SESSION['_APP_NAME'] .'_DOMINION'];
    if(isset($_COVER)) $dominion = str_replace("platform", $_COVER, $dominion);
    $static   = $dominion."static/";

    $_SESSION["_ROUTION"]  = $roution;
    $_SESSION["_DOMINION"] = $dominion;
    $_SESSION["_STATIC"]   = $static;
