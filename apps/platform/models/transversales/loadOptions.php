<?php require_once ('../../appInit.php');

    $fila    = str_replace('#', '', $_POST["fila"]);
    $bodytag = $_SESSION["btn-options"][$_POST['mud']];
    $bodytag = str_replace('event-', 'event-'.$fila.'_', $bodytag);
    $bodytag = str_replace('register-', $fila.'_', $bodytag);
    $bodytag = str_replace('object-', $fila.'_', $bodytag);

    echo $bodytag;

?>