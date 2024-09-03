<?php $listsWeeks = $_TUCOACH->get_data("olc_semanas", " AND id >= ".$this_proyecto["id_semana_desde"]." AND id <= ".$this_proyecto["id_semana_hasta"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1); ?>

<div class="tab mb20">
	<div class="tabIn">
		<div class="ff1 t18 tU colorMorado">Proyecto</div>
	</div>
	<div class="tabIn taR">
		<?php if($this_proyecto["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
			<a data-toggle="modal" data-target="#objetivo_crear" class="btn btn-success bfff bCMorado colorMorado bHover2 btn-sm">Crear Objetivo</a>
		<?php } ?>
	</div>
</div>

<div class="bS1 rr10 mb30" style="overflow:hidden;">
	<div class="tab bMorado p20">
		<div class="tabIn">
			<div class="ff3 t20 colorfff mb5"><?= ($this_proyecto["nombre"]); ?></div>
			<div class="coloreee ff0 t16">Este proyecto tiene <span class="ff3"><?= count($mega); ?></span> Objetivos</div>
		</div>
		<div class="tabIn taR">
			<?php if($this_proyecto["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
				<a onClick="Ion.loadModalCR('Proyecto', 0, <?=$_SESSION["thisProject"]?>, <?=$_SESSION["thisProject"]?>, <?=$_SESSION["COMPANY"]["id"]?>, <?= $this_proyecto["id_responsable"]?>)" data-toggle="modal" data-target="#co-responsables" class="btn btn-light btn-sm"><i class="fas fa-users t12"></i> &nbsp;Co-responsables</a>
				<a href="kr_proyectoeditar_<?= $getVal[2]; ?>.html" class="btn btn-light btn-sm"><i class="fas fa-edit t12"></i> &nbsp;Editar</a>
			<?php } ?>
		</div>
	</div>
	<div class="p20">
		<div class="tab mb20">
			<div class="tabIn w80x t30 colorMorado2 pLR20 mb20"><i class="fas fa-users"></i></div>
			<div class="tabIn">
				<?php
					if($responsable){
						echo '<div class="pLR10 ff3 color999 mb10">Responsable</div>';
						echo '<div class="tab bGray p510 t16 bS1 rr3">';
						echo '<div class="tabIn color666 ff3">'.ucwords(strtolower(($responsable["nombre"]))).'</div>';
						echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($responsable["cargo"]))).'</div>';
						echo '</div>';
					}
					if($corres){
						echo '<div class="h20"></div>';
						echo '<div class="pLR10 ff3 color999 mb10">Co-responsables</div>';
						foreach($corres["corresponsables"] AS $res){
							echo '<div id="litii'.$res["id"].'" class="tab bGray p510 bS1 rr3 mb3">';
							echo '<div class="tabIn color666 ff2">'.ucwords(strtolower(($res["nombre"]))).'</div>';
							echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($res["cargo"]))).'</div>';
							echo '</div>';
						}
						$corris = $corres["corresponsables"];
					}
				?>
			</div>
			<!-- <div class="tabIn w400x taR ff3">
				<div class="">Estás viendo</div>
				<div class="bS1 rr5">
					<select class="selectpicker" onchange="location = this.value;">
						<?php foreach($listsWeeks AS $listsWeek){ ?>
							<option value="kr_tareas-otros_<?= $getVal[2]; ?>_<?= $listsWeek["id"]; ?>_<?= $getVal[4]; ?>.html" <?php if($listsWeek["id"] == $selWeek["id"]) echo "selected"; ?> data-subtext="<?= $_TUCOACH->verMes($listsWeek["mes"])." - ".$listsWeek["ano"]; ?>">
								<?= "Semana ".$listsWeek["semana"]." (".$_TUCOACH->pulirFecha($listsWeek["fecha_desde"],$listsWeek["fecha_hasta"]).")" ; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div> -->
		</div>


		<div class="color666 t16 magion">
			<?= ($this_proyecto["descripcion"]); ?>
		</div>
	</div>



</div>

<?php include "prev_balance_proyecto.php"; ?>
