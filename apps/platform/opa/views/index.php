<?php require_once ('../appInit.php');

    if( isset($_SESSION["zoom_id_user"]) && isset($_SESSION["zoom_usuario"]) && isset($_SESSION["zoom_nombre"]) && isset($_SESSION["zoom_rol_nombre"]) ){

        if(isset($_GET["gzoom"])) $z1 = $_GET["gzoom"]; else $z1 = "";
        if(isset($_GET["gzoom2"])) {
            $z2             = $_GET["gzoom2"];
            $z2             = explode("_", $z2);
            $directorio     = $z1;
            $funcion        = $z2[0];
            if(isset($z2[1])) $id = $z2[1]; else $id = 0;
        } else $z2 = "";

        if($z1 != "" && $z2 != ""){

            include "../default/head.php";
            include "../default/header.php";
            include "../default/lateral.php";
            include "../views/content-selector.php";
            include "../default/footer.php";
            include "../default/end.php";

        }else{
            header('Location: ../');
        }

    }else{
        header('Location: ../');
    }

?>
