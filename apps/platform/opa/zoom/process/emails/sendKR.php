<?php require_once ('../../../appInit.php');


	$id 		= $_POST["id"];
	$trabajador = $_TUCOACH->get_data("zoom_users", " AND id = ".$id." ORDER BY id DESC ", 0);
	$empresa 	= $_TUCOACH->get_data("olc_empresas", " AND id = ".$trabajador["id_empresa"]." ORDER BY id DESC ", 0);

	if($trabajador){
		if($trabajador["pass"] == ""){

			$caracteres		= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$longpalabra 	= 5;
			for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) {
				$x 	   = rand(0, $n);
				$pass .= $caracteres[$x];
			}
			$_POST["pass"] 		= "tc-".$pass;
			$update = $_TUCOACH->update_data_array($_POST, "zoom_users", "id", $id);

		}
	}

	if($trabajador["pass"] == "")	$contra = $_POST["pass"];
	else							$contra = $trabajador["pass"];

	$zoomail_para 		= $trabajador["mail"];
	$zoomail_asunto 	= ($empresa["nombre"])." te ha asignado en algunas tareas";
	$zoomail_contenido	= '

								Hola <strong>'.($trabajador["nombre"]).'</strong><br><br>

								Has sido asignado por <strong>'.($empresa["nombre"]).'</strong> para participar en el cumplimiento de algunas tareas.
								<br><br>
								Para ingresar y revisarlas, siga los siguientes pasos:
								<br><br>
								1. Ingresa a <a href="https://olcgroup.co/tucoach">https://olcgroup.co/tucoach</a>
								<br>2. Ingrese su usuario: '.($trabajador["identificacion"]).'
								<br>3. Ingrese su contrasena: '.($contra).'
								<br>4. Realiza las asignaciones.
								<br><br>
								¡Te deseamos un feliz día!

						  ';

	include "plantillaMail.php";


	require '../../../resources/plugins/PHPMailer/PHPMailerAutoload.php';

	$mailinion = new PHPMailer(true);

	$mailinion->SMTPDebug 	= 0;
	$mailinion->isSMTP();
	$mailinion->SMTPAuth 	= true;
	// $mailinion->Host 		= "mail.olcgroup.co";
	// $mailinion->Username 	= 'comunicaciones@olcgroup.co';
	// $mailinion->Password 	= 'a@mD!VFA6V9w';
	$mailinion->Host 		= "smtp.gmail.com";
	$mailinion->Username 	= 'gerencia@olcgroup.co';
	$mailinion->Password 	= 'gyfdbrvuyfcvlfum';
	$mailinion->Port 		= 587;
	$mailinion->SMTPSecure = 'tls';
	$mailinion->isHTML(true);

	$mailinion->setFrom('comunicaciones@olcgroup.co', 'Tu Coach');

	$mailinion->AddAddress($trabajador["mail"], $trabajador["nombre"]);
	$mailinion->addBCC('comunicaciones@olcgroup.co');


	$mailinion->Subject 		= $zoomail_asunto;
	$mailinion->Body   		 	= $zoomail_contenido;

	if(!$mailinion->send()) {
		echo 'Error';
		//echo 'Mailer error: ' . $mailinion->ErrorInfo;
	} else {
		unset($_POST);
		$_POST["envioMail"] = $trabajador["envioMail"] + 1;
		$update = $_TUCOACH->update_data_array($_POST, "zoom_users", "id", $id);
		echo '<i class="la la-mail-reply-all t16"></i> '.$_POST["envioMail"];
	}

?>