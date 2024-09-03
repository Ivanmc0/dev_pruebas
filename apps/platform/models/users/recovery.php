<?php require_once ('../../appInit.php');

    
    $UserExists =  $_PLATFORM->VerifyUser ($_POST['identificacion'],$_POST['email']  );
 
    if ( !$UserExists) {
      MsgError( 'No se han encontrado los datos registrados.');
      exit(0);
    }
    $UserUuid      = $UserExists['uuid'];
    $RecoveryToken = $_PLATFORM->SetTokenRecoveryPassword($UserUuid ) ;
    $UrlRecovery   = $dominion."reset/$RecoveryToken";

    $DataMail = ['nombre' =>$UserExists['nombre'], 'urlrecovery'=>$UrlRecovery ];
    $_MAILS->SendMail('Recovery', '', $UserExists['email'], $DataMail);
    MsgOk('Hemos enviado un correo electrónico con las instrucciones para el cambio de contraseña');
    Redirect('/', 4000);
    
?>