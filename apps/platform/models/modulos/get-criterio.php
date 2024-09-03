<?php require_once ('../../appInit.php');

	if($_POST["valor"] != "" && $_POST["id_grupo"] != ""){

		$valor 			= $_POST["valor"];
		$id_grupo 		= $_POST["id_grupo"];

		$complemento 	= " AND desde <= ".$valor." AND hasta >= ".$valor;
		$respuesta 		= $_TUCOACH->get_data("grw_paquete_preguntas", $complemento." AND id_grupopregunta = ".$id_grupo." AND inactivo = 0 AND eliminado = 0 ORDER by desde DESC ", 0);
		if($respuesta) echo '<div class="colorMorado ff2">'.($valor." - ".$respuesta["nombre"]).'</div>';

	}

?>