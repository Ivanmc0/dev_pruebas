<?php require_once ('../../../appInit.php');

    if(trim($_POST['user-name']) != "" && trim($_POST['user-password']) != ""){

        $user = $_TUCOACH->iFilter->process($_POST['user-name']);
        $pass = md5($_POST['user-password']);

        $thisUser = $_TUCOACH->get_data("zoom_users", " AND usuario = '".$user."' AND password = '".$pass."' AND inactivo = 0 AND eliminado = 0 ", 0);
        if($thisUser) {
            $_SESSION["zoom_id_user"]   = $thisUser["id"];
            $_SESSION["zoom_usuario"] 	= $thisUser["usuario"];
            $_SESSION["zoom_nombre"] 	= $thisUser["nombre"];
            $_SESSION["zoom_rol"]     	= $thisUser["id_rol"];

            $rol = $_TUCOACH->get_data("zoom_roles", " AND id = ".$thisUser["id_rol"]."", 0);
            if($rol) $_SESSION["zoom_rol_nombre"] = $rol["rol"];

            echo "<div class='success ff3'>Autenticación exitosa. ¡Ingresando!</div>";
            echo "<script>setTimeout('self.location=\"dashboard/dashboard.zoom\"', 2000)</script>";

        } else echo "<div class='danger'>Usuario o contraseña incorrecta</div>";
    } else echo "<div class='danger'>Debes rellenar los campos obligatorios</div>";

?>