<?php require_once ('../../../appInit.php');

	$id_competencia = $_POST["id_competencia"];


	$sql	= " AND id_competencia = ".$id_competencia." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ";
	$datos 	= $_TUCOACH->get_data('grw_tuc_p2b_comportamientos', $sql, 1);

	if($datos){
?>
			<option value="0">Todos</option>
<?php
		foreach($datos as $dato){
	?>
			<option value="<?= $dato["id"]; ?>"><?= ($dato["nombre"]); ?></option>
	<?php
		}
	} else {
		echo '<option value="0">Todos</option>';
	}
?>