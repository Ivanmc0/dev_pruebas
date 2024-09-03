<?php require_once ('../../appInit.php');

	$id_categoria = $_POST["id_categoria"];


	$sql	= " AND id_categoria = ".$id_categoria." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ";
	$datos 	= $_TUCOACH->get_data('grw_tuc_p2b_competencias', $sql, 1);

	if($datos){
?>
			<option value="0">Todas</option>
<?php
		foreach($datos as $dato){
	?>
			<option value="<?= $dato["id"]; ?>"><?= ($dato["nombre"]); ?></option>
	<?php
		}
	} else {
		echo '<option value="0">Todas</option>';
	}
?>