<?php require_once '../../appInit.php';

if ($_POST['new_password'] != $_POST['new_password_confirm']) {
    MsgError('La contraseña y su confirmación deben ser iguales.');
    exit(0);
}
$SetNewPasswodIsOk = $_PLATFORM->SetNewPasswodIsOk($_POST['new_password'], $_POST['userToken']);
if ($SetNewPasswodIsOk === 'TokenPerdioVigencia') {
    MsgError('Por seguridad, el tiempo máximo para cambio de contraseña ha finalizado. Solicite de nuevo el cambio de contraseña.');
    exit(0);
}

if ($SetNewPasswodIsOk === 'TokenNoValido') {
    MsgError('El código de seguridad para cambio de contraseña parece estar alterado. Solicite de nuevo el cambio de contraseña');
    exit(0);
}

if ($SetNewPasswodIsOk === 'PasswordUpdated') {
    MsgOk('El cambio de contraseña ha finalizado con éxito. Ahora puede inciar sesión.');
    Redirect('/');
    exit(0);
}
