<?php

	$correoStart 	=  "
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
						<div style='background:#181466; padding:20px; width:560px; margin:10px auto; border:2px solid #181466; border-radius:5px;'>
							<center><img src='https://johnvinasco.com/resources/img/firma.png' width='250' alt='' /></center>
							<div style='background:#fff; width:80%; padding:20px; margin:30px auto 20px;'>
						";
	$correoEndAdmin	=  "
							</div>
							<p style='font-size:10px; text-align:center;width:80%; margin:0 auto; color:#fff'>Por favor no responda este mensaje, es generado autom&aacute;ticamente por el sistema.</p>
						</div>
						";

	if($_POST["c_nombre"] != ""){
		if($_POST["c_celular"] != ""){
			if($_POST["c_email"] != ""){
				if($_POST["c_mensaje"] != ""){


					$c_nombre 	= $_POST["c_nombre"];
					$c_empresa 	= $_POST["c_empresa"];
					$c_celular 	= $_POST["c_celular"];
					$c_email 	= $_POST["c_email"];
					$c_mensaje 	= $_POST["c_mensaje"];
					$roution 	= $_POST["roution"];


					$zoomail_asunto 	= utf8_decode($c_nombre)." te ha escrito desde JohnVinasco.com";
					$zoomail_contenido	= '<br>
												<b>Hola John.</b><br>Has recibido este mensaje desde el contacto de tu p&aacute;gina web:<br><br>
												Nombre: '.utf8_decode($c_nombre).'<br>
												Empresa: '.utf8_decode($c_empresa).'<br>
												Celular: '.utf8_decode($c_celular).'<br>
												Email: '.utf8_decode($c_email).'<br>
												Mensaje: '.utf8_decode($c_mensaje).'
												<br><br>';

					$zoomail_contenido = $correoStart.$zoomail_contenido.$correoEndAdmin;
					require '../../resources/plugins/PHPMailer/PHPMailerAutoload.php';

					$mailinion = new PHPMailer(true);

					$mailinion->SMTPDebug 	= 0;
					$mailinion->isSMTP();
					$mailinion->SMTPAuth 	= true;
					$mailinion->Host 		= "smtp.gmail.com";
					$mailinion->Username 	= 'gerencia@olcgroup.co';
				//	$mailinion->Password 	= '%OLC_2020%';
					$mailinion->Password 	= 'tribpbemfdvcazmc';
					$mailinion->Port 		= 587;
					$mailinion->SMTPSecure = 'tls';
					$mailinion->isHTML(true);

					$mailinion->setFrom('gerencia@olcgroup.co', 'Contacto Web JV');

					$mailinion->AddAddress("contacto@johnvinasco.com");
					//$mailinion->addBCC('tucoach@olcgroup.co');


					$mailinion->Subject 		= $zoomail_asunto;
					$mailinion->Body   		 	= $zoomail_contenido;

					if(!$mailinion->send()) {
						echo 'Error';
						//echo 'Mailer error: ' . $mailinion->ErrorInfo;
					} else {
						unset($_POST);
						echo '<div class="colorVerde t16 ff3">Hemos recibido su mensaje con éxito</div>';
						echo '<script>$("#c_nombre, #c_empresa, #c_celular, #c_email, #c_mensaje").val("");</script>';
					}

				} else echo '<div class="colorRojo ff2">Debe indicar un mensaje</div>';
			} else echo '<div class="colorRojo ff2">Debe indicar un email</div>';
		} else echo '<div class="colorRojo ff2">Debe indicar un teléfono</div>';
	} else echo '<div class="colorRojo ff2">Debe indicar su nombre</div>';

?>
