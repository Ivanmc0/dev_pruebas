<?php require_once('../../../appInit.php');

	$id_tipo = $_POST["id_tipo"];

 

	$sql 			= " AND id_tipo = ".$id_tipo." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ";
	$tipos 	= $_ZOOM->get_data('olc_preguntas_tipos', $sql, 1);

	if($tipos != 2){
?>
			<!-- <option value="">Ninguno</option> -->
<?php
		foreach($tipos as $tipo){
	?>
			<option value="<?= $tipo["id"]; ?>"><?= ($tipo["nombre"]); ?></option>
	<?php
		}
	} else {
		echo '<option value="0">Sin datos</option>';
	}


?>