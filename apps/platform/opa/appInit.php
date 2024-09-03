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
        if ($part == 'apps') break;
        $projectRoot .= $part . DIRECTORY_SEPARATOR;
    }

    $app    = 'opa';

    $_SESSION['_ROOT']     = $projectRoot;
    $_SESSION['_APPS']     = $_SESSION['_ROOT'].'apps/';
    $_SESSION['_INIT']     = $_SESSION['_ROOT'].'init.php';
    $_SESSION['_HELPERS']  = $_SESSION['_ROOT'].'helpers/';
    $_SESSION['_MAILS']    = $_SESSION['_ROOT'].'mails/';
    $_SESSION['_APP_NAME'] = strtoupper($app);


    /*--------------------------------------------
        INICIO DE APLICACIÓN
    -----------------------------------------------*/
    require_once ( $_SESSION['_INIT'] );

    echo "
        <script>
            var roution  = '".$roution."',
                dominion = '".$dominion."',
                static   = '".$static."';
        </script>
    ";