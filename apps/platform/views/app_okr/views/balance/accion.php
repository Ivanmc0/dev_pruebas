<div class="tab mb20">
	<div class="tabIn">
		<div class="ff1 t18 tU colorMorado">ACCIÓN</div>
	</div>
	<div class="tabIn taR">
		<?php if($this_accion["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
			<a data-toggle="modal" data-target="#sprint_crear" class="btn btn-success bfff bCMorado colorMorado bHover2 btn-sm">Crear Sprint Mensual</a>
		<?php } ?>
	</div>
</div>

<div class="bS1 rr10 mb30" style="overflow:hidden;">
	<div class="tab bMorado p20">
		<div class="tabIn">
			<div class="ff3 t20 colorfff"><?= ($accion["nombre"]); ?></div>
		</div>
		<div class="tabIn taR">
			<?php if($this_kr["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
				<a onClick="Ion.loadModalCR('Acción', 3, <?=$accion["id"]?>, <?=$_SESSION["thisProject"]?>, <?=$_SESSION["COMPANY"]["id"]?>, <?= $accion["id_responsable"]?>)" data-toggle="modal" data-target="#co-responsables" class="btn btn-light btn-sm"><i class="fas fa-users t12"></i> &nbsp;Co-responsables</a>
				<a href="kr_accioneditar_<?= $getVal[3]; ?>.html" class="btn btn-light btn-sm"><i class="fas fa-edit t12"></i> &nbsp;Editar</a>
			<?php } ?>
		</div>
	</div>
	<div class="row m0 p0 align-items-center">
		<div class="col-12 col-sm-8 m0 p30" style="border-right:1px solid #eee;">
			<?php
				$bbb = $accion;
				include "prev_balance.php";
			?>
			<div class="color666 t16 magion">
				<?= ($accion["descripcion"]); ?>
			</div>
		</div>
		<div class="col-12 col-sm-4 m0 p30">

			<div class="tab">
				<div class="tabIn taC w60x t24 colorMorado2"><i class="fas fa-users"></i></div>
				<div class="tabIn">
					<?php
						if(isset($accion["responsable"])){
							echo '<div class="pLR10 ff3 color999 mb10">Responsable</div>';
							echo '<div class="tab bGray p510 t16 bS1 rr3">';
							echo '<div class="tabIn color666 ff3">'.ucwords(strtolower(($accion["responsable"]["nombre"]))).'</div>';
							echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($accion["responsable"]["cargo"]))).'</div>';
							echo '</div>';
						}
						if(isset($accion["corresponsables"])){
							echo '<div class="h20"></div>';
							echo '<div class="pLR10 ff3 color999 mb10">Co-responsables</div>';
							foreach($accion["corresponsables"] AS $res){
								echo '<div id="litii'.$res["id"].'" class="tab bGray p510 bS1 rr3 mb3">';
								echo '<div class="tabIn color666 ff2">'.ucwords(strtolower(($res["nombre"]))).'</div>';
								echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($res["cargo"]))).'</div>';
								echo '</div>';
							}
							$corris = $accion["corresponsables"];
						}
					?>
				</div>
			</div>

		</div>

	</div>
</div>