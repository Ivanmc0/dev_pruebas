<div class="bS1 rr10 mb30" style="overflow:hidden;">

	<div class="tab bMorado p20">
		<div class="tabIn">
			<div class="ff3 t20 colorfff">Tarea</div>
		</div>
		<div class="tabIn taR">
			<?php if($this_sprint["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
				<a onClick="Ion.loadModalCR('Tarea', 5, <?=$tarea["id"]?>, <?=$_SESSION["thisProject"]?>, <?=$_SESSION["COMPANY"]["id"]?>, <?= $tarea["id_responsable"]?>)" data-toggle="modal" data-target="#co-responsables" class="btn btn-light btn-sm"><i class="fas fa-users t12"></i> &nbsp;Co-responsables</a>
				<a href="kr_tareaeditar_<?= $getVal[2]; ?>_<?= $tarea["id"]; ?>.html" class="btn btn-light btn-sm"><i class="fas fa-edit t12"></i> &nbsp;Editar</a>
			<?php } ?>
		</div>
	</div>

	<div class="row m0 p0 align-items-center">
		<div class="col-12 col-sm-8 m0 p0" style="border-right:1px solid #eee;">

			<div class="p30 bBS1 bCeee">
				<div class="color666 t20 ff3 mb10"><?= ($tarea["nombre"]); ?></div>
				<div class="color999 t16 magion"><?= ($tarea["descripcion"]); ?></div>
			</div>

			<div class="p30">

				<?php
					$sem = $_ZOOM->get_data("olc_semanas", " AND id = ".$tarea["id_semana"]." AND inactivo = 0 AND eliminado = 0 ", 0);
					$vencido = 0;
					if($sem["semana"] < $this_week["semana"] && $tarea["estado"] != 2) $vencido = 1;
				?>

				<div class="tab color666">
					<div class="tabIn w30x"><i class="far fa-calendar t16"></i></div>
					<div class="tabIn t20 ff0">
						Semana <?php if($sem) echo $sem["semana"]; ?>
						<div class="ff2 dIB color999 t14"> del <?= $_ZOOM->pulirFecha($tarea["fecha_desde"],$tarea["fecha_hasta"]); ?></div>
					</div>
				</div>

			</div>

		</div>
		<div class="col-12 col-sm-4 m0 p30">

			<div class="tab">
				<div class="tabIn taC w60x t24 colorMorado2"><i class="fas fa-users"></i></div>
				<div class="tabIn">
					<?php
						if(isset($tarea["responsable"])){
							echo '<div class="pLR10 ff3 color999 mb10">Responsable</div>';
							echo '<div class="tab bGray p510 t16 bS1 rr3">';
							echo '<div class="tabIn color666 ff3">'.ucwords(strtolower(($tarea["responsable"]["nombre"]))).'</div>';
							echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($tarea["responsable"]["cargo"]))).'</div>';
							echo '</div>';
						}
						if(isset($tarea["corresponsables"])){
							echo '<div class="h20"></div>';
							echo '<div class="pLR10 ff3 color999 mb10">Co-responsables</div>';
							foreach($tarea["corresponsables"] AS $res){
								echo '<div id="litii'.$res["id"].'" class="tab bGray p510 bS1 rr3 mb3">';
								echo '<div class="tabIn color666 ff2">'.ucwords(strtolower(($res["nombre"]))).'</div>';
								echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($res["cargo"]))).'</div>';
								echo '</div>';
							}
							$corris = $tarea["corresponsables"];
						}
					?>
				</div>
			</div>

		</div>
	</div>

</div>


<div class="tab p5 tU estado<?= $tarea["estado"]; ?> rr5 colorfff ff3 <?php if($vencido) echo 'vencido'; ?>">
	<div class="tabIn w40x taL">
		<?php if($tarea["estado"] != 0 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $sem["id"] == $this_week["id"]){ ?>
			<div class="wh30 dIB bS1 bHover2 rr5 taC cP" onClick="Ion.moveTask(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:8px;">
				<i class="fas fa-reply"></i>
			</div>
		<?php } ?>
	</div>
	<div class="tabIn p10 taC">
		<?php if($vencido) echo 'Vencido'; else echo $estado[$tarea["estado"]]; ?>
	</div>
	<div class="tabIn w40x taR">
		<?php if($tarea["estado"] != 2 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $sem["id"] == $this_week["id"]){ ?>
			<div class="wh30 dIB bS1 bHover2 rr5 taC cP" onClick="Ion.moveTask(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:8px;">
				<i class="fas fa-reply fa-flip-horizontal"></i>
			</div>
		<?php } ?>
	</div>
</div>