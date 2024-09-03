<?php require_once('../../../appInit.php');

	$id_categoria = $_POST["id_categoria"];

 

	$sql 			= " AND id_categoria = ".$id_categoria." AND inactivo = 0 ORDER BY nombre ASC ";
	$subcategorias 	= $_ZOOM->get_data('qe_categorias_subcategorias', $sql, 1);

	if($subcategorias != 2){
?>
			<!-- <option value="">Ninguno</option> -->
<?php
		foreach($subcategorias as $subcategoria){
	?>
			<option value="<?= $subcategoria["id"]; ?>"><?= ($subcategoria["nombre"]); ?></option>
	<?php
		}
	} else {
		echo '<option value="0">Sin datos</option>';
	}


?>