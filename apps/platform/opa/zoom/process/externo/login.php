<?php require_once('../../../appInit.php');

    if(trim($_POST['r_email3']) != "" && trim($_POST['r_pass3']) != ""){

        $user = $_ZOOM->iFilter->process(trim($_POST['r_email3']));
        $pass = md5($_ZOOM->iFilter->process(trim($_POST['r_pass3'])));

        $thisUser = $_ZOOM->get_data("ae_clientes", " AND email = '".$user."' AND clave = '".$pass."' AND inactivo = 0 AND eliminado = 0 ", 0);
        if($thisUser) {
            $_SESSION["ae_id"]          	= $thisUser["id"];
            $_SESSION["ae_hash"]          	= $thisUser["hash"];
            $_SESSION["ae_nombre"]  		= $thisUser["nombre"]." ".$thisUser["apellido"];
            $_SESSION["ae_identificacion"]  = $thisUser["identificacion"];
            $_SESSION["ae_email"]      		= $thisUser["email"];
            $_SESSION["ae_celular"]       	= $thisUser["telefono"];

            echo "<div class='colorVerde let ff3'>Autenticación exitosa. Ingresando...</div>";
            //echo "<script>setTimeout('location.reload();', 2000)</script>";
            if(isset($_SESSION["cartion"]) && !empty($_SESSION["cartion"])){
                echo '<script>setTimeout(function(){ window.location="https://quintaestacion.com.pa/pasarela-pago/"; }, 3000);</script>';
            }else{
                echo '<script>setTimeout(function(){ window.location="https://quintaestacion.com.pa/home/"; }, 3000);</script>';
            }



        } else echo "<div class='colorRojo'>Email o contraseña incorrecta</div>";
    } else echo "<div class='colorRojo'>Debes ingresar los campos solicitados</div>";



?>
