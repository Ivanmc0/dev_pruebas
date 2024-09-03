<?php

	$corris = array();
 
	$responsable	= $_TUCOACH->get_data("zoom_users", " AND id = ".$zona["id_responsable"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);
 
	if($responsable){
		echo '<div class="pLR10 ff3 color999 mb10">Responsable</div>';
		echo '<div class="tab bGray p510 t16 bS1 rr3">';
		echo '<div class="tabIn color666 ff3">'.ucwords(strtolower(($responsable["nombre"]))).'</div>';
		echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(( $responsable["cargo"] ? $responsable["cargo"] : '' ))).'</div>';
		echo '</div>';
	}

?>


<?php

	$corres	= $_TUCOACH->get_data("grw_okr_pyt_corresponsables", " AND nivel = ".$levelN." AND id_nivel = ".$zona["id"]." AND id_proyecto = ".$proyecto["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
	if($corres){
		echo '<div class="h20"></div>';
		echo '<div class="pLR10 ff3 color999 mb10">Co-responsables</div>';
		foreach($corres AS $result){
			$res = $_TUCOACH->get_data("zoom_users", " AND id = ".$result["id_corresponsable"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);
			if($res){
				echo '<div id="litii'.$res["id"].'" class="tab bGray p510 bS1 rr3 mb3">';
				echo '<div class="tabIn color666 ff2">'.ucwords(strtolower(($res["nombre"]))).'</div>';
				echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($res["cargo"]))).'</div>';
				echo '</div>';
				array_push($corris, $res);
			}
		}
		echo '<div class="h10"></div>';
	} else echo '<div class="h20"></div>';
?>

<?php if($zona["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
	<div class="colorMorado taC">
		<a onClick="Ion.loadModalCR('<?=$level?>', <?=$levelN;?>, <?=$zona["id"]?>, <?=$proyecto["id"]?>, <?=$_SESSION["COMPANY"]["id"]?>, <?= $zona["id_responsable"]?>)" data-toggle="modal" data-target="#co-responsables" class="bS1 bCMorado2 colorMorado2 p310 bHover2 aS rr20 cP">
			<i class="fas fa-users t12"></i>&nbsp;
			Configurar Co-responsables
		</a>
	</div>
<?php } ?>
