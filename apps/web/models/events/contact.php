<?php require_once ('../../appInit.php');

	function is_valid_email($str){
		$matches = null;
		return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
	}

	if($_POST["nombre"] == ""){
		echo '<div class="colorRojo2 ff3">Debe indicar su nombre</div>';
		die();
	}

	if($_POST["empresa"] == ""){
		echo '<div class="colorRojo2 ff3">Debe indicar su empresa</div>';
		die();
	}

	if(!is_valid_email($_POST["email"])){
		echo '<div class="colorRojo2 ff3">Debe indicar su email con formato válido</div>';
		die();
	}

	if($_POST["celular"] == ""){
		echo '<div class="colorRojo2 ff3">Debe indicar su número celular</div>';
		die();
	}

	if($_POST["asunto"] == ""){
		echo '<div class="colorRojo2 ff3">Debe indicar su asunto</div>';
		die();
	}


	// if($existe = $_ZOOM->get_data("grw_val_listasexternas_registros", " AND email = '".$_POST['email']."' ", 0)){
	// 	echo '<div class="colorRojo2 ff3">El email indicado ya se encuentra registrado</div>';
	// 	die();
	// }

 



	if($_MAILS->SendMail('ContactWeb', '', 'contacto@olcgroup.co', $_POST, 'ingenieria@olcgroup.co')){
		echo '<div class="colorVerde2 ff3 t20">Mensaje enviado correctamente</div>';
		echo '<script>$("#btn-formion").slideUp(1);</script>';
		echo '<script>setTimeout(function(){ location.reload(); }, 2000);</script>';
	} else echo '<div class="colorRojo2 ff3">Error enviando mensaje</div>';


	// $_POST["id_empresa"]        = 2;
	// $_POST["id_publico_listado"] = 1;
	// $_POST["fecha"]             = date("Y-m-d H:i:s");

	// if($insert = $_ZOOM->insert_data_array($_POST, "grw_val_listasexternas_registros")){

	// 	$data = [
	// 		"id_empresa"          => 2,
	// 		"id_encuesta"         => 4,
	// 		"id_listaexterna_registro" => $insert
	// 	];

	// 	if($qr = $_ZOOM->insert_data_array($data, "grw_val_asignaciones")){

	// 		if($thisQr = $_ZOOM->get_data("grw_val_asignaciones", " AND id = '".$qr."' ", 0)){

	// 			echo '<script>$("#btn-formion").slideUp(1);</script>';
	// 			echo '<script>$("#formion")[0].reset();</script>';
	// 			echo '<script>setTimeout(function(){ window.location.href="gracias/'.$thisQr["uuid"].'/"; }, 1);</script>';

	// 		}else echo '<div class="colorRojo2 ff3">Error obteniendo QR</div>';
	// 	}else echo '<div class="colorRojo2 ff3">Error almacenando QR</div>';
	// }else echo '<div class="colorRojo2 ff3">Error almacenando registro</div>';

?>