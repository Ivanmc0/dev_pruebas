<?php if($levelN == 1){ ?>
	<a href="<?= $dominion; ?>proyecto/balance/" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($proyecto["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Proyecto</a>
<?php }elseif($levelN == 2){ ?>
	<a href="<?= $dominion; ?>proyecto/balance/" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($proyecto["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Proyecto</a>
	<a href="<?= $dominion; ?>proyecto/objetivo/<?= $superior["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($superior["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Objetivo</a>
<?php
	}elseif($levelN == 3){
		$inObj = $_TUCOACH->get_data("grw_okr_objetivos", " AND id = ".$superior["id_objetivo"]." AND inactivo = 0 AND eliminado = 0 ", 0);
?>
		<a href="<?= $dominion; ?>proyecto/balance/" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($proyecto["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Proyecto</a>
		<a href="<?= $dominion; ?>proyecto/objetivo/<?= $inObj["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($inObj["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Objetivo</a>
		<a href="<?= $dominion; ?>proyecto/kr/<?= $superior["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($superior["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; KR</a>
<?php
	}elseif($levelN == 4){
		$inKr  = $_TUCOACH->get_data("grw_okr_krs", " AND id = ".$superior["id_kr"]." AND inactivo = 0 AND eliminado = 0 ", 0);
		$inObj = $_TUCOACH->get_data("grw_okr_objetivos", " AND id = ".$inKr["id_objetivo"]." AND inactivo = 0 AND eliminado = 0 ", 0);
?>
		<a href="<?= $dominion; ?>proyecto/balance/" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($proyecto["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Proyecto</a>
		<a href="<?= $dominion; ?>proyecto/objetivo/<?= $inObj["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($inObj["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Objetivo</a>
		<a href="<?= $dominion; ?>proyecto/kr/<?= $inKr["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($inKr["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; KR</a>
		<a href="<?= $dominion; ?>proyecto/accizen/<?= $superior["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($superior["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Acción</a>
<?php

	}elseif($levelN == 5){

		if($star = $_OKR->get_task(" AND TASK.id = ".$zona["id"]." AND PROY.id = ".$proyecto["id"]." AND EMP.id = ".$_SESSION["COMPANY"]["id"]."  ")){

			// echo '<pre>';
			// print_r($star);
			// echo '</pre>';

			$star = $star[0];

			echo '
				<div class="tab">
					<a class="tab20 p10 bN1 color999 bHover" href="'.$dominion.'proyecto/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_proyecto"]).'">
						<div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Proyecto</div>
						<div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_proyecto"]))).'</div>
					</a>
					<a class="tab20 p10 bN2 color999 bHover" href="'.$dominion.'proyecto/objetivo/'.$star["id_objetivo"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_objetivo"]).'">
						<div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Objetivo</div>
						<div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_objetivo"]))).'</div>
					</a>
					<a class="tab20 p10 bN3 color999 bHover" href="'.$dominion.'proyecto/kr/'.$star["id_kr"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_kr"]).'">
						<div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; KR</div>
						<div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_kr"]))).'</div>
					</a>
					<a class="tab20 p10 bN4 color999 bHover" href="'.$dominion.'proyecto/accizen/'.$star["id_accion"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_accion"]).'">
						<div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Acción</div>
						<div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_accion"]))).'</div>
					</a>
					<a class="tab20 p10 bN5 color999 bHover" href="'.$dominion.'proyecto/sprint/'.$star["id_sprint"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_sprint"]).'">
						<div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Sprint</div>
						<div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_sprint"]))).'</div>
					</a>
				</div>
			';
		}
	}



		/*<a href="<?= $dominion; ?>proyecto/balance/" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($proyecto["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Proyecto</a>
		// <a href="../../objetivo/<?= $inObj["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($inObj["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Objetivo</a>
		// <a href="../../kr/<?= $inKr["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($inKr["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; KR</a>
		// <a href="../../accin/<?= $inAcc["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($inAcc["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Acción</a>
		// <a href="../../sprint/<?= $superior["id"]; ?>" class="dIB p10 color999 bHover2" data-toggle="tooltip" data-placement="top" title="<?= ($superior["nombre"]); ?>" style="margin-left:-1px"><i class="fas fa-angle-double-right t12"></i> &nbsp; Sprint</a>
		*/


