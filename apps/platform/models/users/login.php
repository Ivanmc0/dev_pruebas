<?php

require_once '../../appInit.php';




if (trim($_POST['user-name']) != "" && trim($_POST['user-password']) != "" && trim($_POST['mi-empresa']) != "") {

    if ($thisUser = $_PLATFORM->Login($_POST['user-name'], $_POST['user-password'], $_POST['mi-empresa'])) {

        $_SESSION["WORKER"]            = $thisUser;
        $_SESSION['WORKER']['nombre']  = $thisUser['nombre_corto'];
        $_SESSION['WORKER']["cargo"]   = $thisUser['cargo']['nombre'];
        $_SESSION['WORKER']["sigla"]   = $thisUser['sigla'] ;
        $_SESSION['WORKER']['email']   = $thisUser['datos_contacto']['correo'] ;
        $_SESSION['WORKER']['celular'] = $thisUser['datos_contacto']['celular'] ;
        $_SESSION["WORKER"]['admin']   = 0;
        $_SESSION["WORKER"]['roles']   = 0;
        $_SESSION["WORKER"]['support'] = 0;

        // Verificar si soporte está intentando logueo
        $_PLATFORM->VerifyLoginSupport( $_POST , $thisUser);
         
        if($roles = $_PLATFORM->RolesUsuario($_SESSION["WORKER"]['id'])){
            $_SESSION["WORKER"]['admin'] = 1;
            $_SESSION["WORKER"]['roles'] = $roles;
        }
 
        if($company = $_COMPANY->GetCompany($_SESSION["WORKER"]['id_empresa'])){

            $dominion = $_ENV['PROTOCOL'].$company['subdominio'].'.'.$_ENV['DOMAIN'].'/';

            $_SESSION["COMPANY"]          = $company;
            $_SESSION["COMPANY"]["GROWI"] = $dominion;

            // Evento de token de sesión
            $_TOKENS->NewSessionId($_SESSION["WORKER"], $_ENV['SESSION_ID_WORKER']);
            $_TOKENS->NewSessionId($_SESSION["COMPANY"], $_ENV['SESSION_ID_COMPANY']);

            // $DataMail = ['nombre' =>$_SESSION["WORKER"]['nombre']];
            // $_MAILS->SendMail('Login', '', $_SESSION["WORKER"]['email'], $DataMail);

            MsgOk('Autenticación exitosa. ¡Ingresando!', 1500);
            Redirect($dominion . 'tablero/');

        } else {
            MsgError('Error, no se encontró la empresa');
        }

    } else {
        MsgError('Usuario o contraseña incorrecta');
    }
} else {
    MsgError('Debes rellenar los campos obligatorios');
}
