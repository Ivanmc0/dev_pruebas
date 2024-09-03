<?php
	// if($_SESSION["WORKER"]["id"] == 800){
	// 	echo '<pre>';
	// 	print_r($krs);
	// 	echo '</pre>';
	// }
?>

<div class="tab mb20">
	<div class="tabIn">
		<div class="ff1 t18 tU colorMorado">KR</div>
	</div>
	<div class="tabIn taR">
		<?php if($this_kr["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
			<a data-toggle="modal" data-target="#accion_crear" class="btn btn-success bfff bCMorado colorMorado bHover2 btn-sm">Crear Acción</a>
		<?php } ?>
	</div>
</div>

<div class="bS1 rr10 mb30" style="overflow:hidden;">
	<div class="tab bMorado p20">
		<div class="tabIn">
			<div class="ff3 t20 colorfff"><?= ($krs["nombre"]); ?></div>
		</div>
		<div class="tabIn taR">
			<?php if($krs["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
				<a data-toggle="modal" data-target="#estrategias" class="btn btn-light btn-sm btn-tuto"><i class="fas fa-th-large t12"></i> &nbsp;Estrategias</a>
			<?php } ?>
			<?php if($this_objetivo["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
				<a onClick="Ion.loadModalCR('KR', 2, <?=$krs["id"]?>, <?=$_SESSION["thisProject"]?>, <?=$_SESSION["COMPANY"]["id"]?>, <?= $krs["id_responsable"]?>)" data-toggle="modal" data-target="#co-responsables" class="btn btn-light btn-sm"><i class="fas fa-users t12"></i> &nbsp;Co-responsables</a>
				<a href="kr_kreditar_<?= $getVal[3]; ?>.html" class="btn btn-light btn-sm"><i class="fas fa-edit t12"></i> &nbsp;Editar</a>
			<?php } ?>
		</div>
	</div>
	<div class="row m0 p0 align-items-center">
		<div class="col-12 col-sm-8 m0 p30" style="border-right:1px solid #eee;">

			<?php
				$bbb = $krs;
				include "prev_balance.php";
			?>
			<div class="color666 t16 magion">
				<?= ($krs["descripcion"]); ?>
			</div>
		</div>
		<div class="col-12 col-sm-4 m0 p30">

			<div class="tab">
				<div class="tabIn taC w60x t24 colorMorado2"><i class="fas fa-users"></i></div>
				<div class="tabIn">
					<?php
						if(isset($krs["responsable"])){
							echo '<div class="pLR10 ff3 color999 mb10">Responsable</div>';
							echo '<div class="tab bGray p510 t16 bS1 rr3">';
							echo '<div class="tabIn color666 ff3">'.ucwords(strtolower(($krs["responsable"]["nombre"]))).'</div>';
							echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($krs["responsable"]["cargo"]))).'</div>';
							echo '</div>';
						}
						if(isset($krs["corresponsables"])){
							echo '<div class="h20"></div>';
							echo '<div class="pLR10 ff3 color999 mb10">Co-responsables</div>';
							foreach($krs["corresponsables"] AS $res){
								echo '<div id="litii'.$res["id"].'" class="tab bGray p510 bS1 rr3 mb3">';
								echo '<div class="tabIn color666 ff2">'.ucwords(strtolower(($res["nombre"]))).'</div>';
								echo '<div class="tabIn color999 t12 ff1 taR">'.ucwords(strtolower(($res["cargo"]))).'</div>';
								echo '</div>';
							}
							$corris = $krs["corresponsables"];
						}
					?>
				</div>
			</div>

		</div>

	</div>


	<?php
		if(isset($krs["estrategias"])){
			echo '<div class="bS1 p10 bGray bCeee">';
			echo '<div class="p1020 ff3 t20 colorMorado2">Estrategias relacionadas</div><div class="pLR20">';
			foreach($krs["estrategias"] AS $res){
				echo '<div id="propp'.$res["id"].'" class="bfff color666 t16 p15 bS1 bCeee rr3 mb3">'.($res["nombre"]).'</div>';
			}
			$tratos = $krs["estrategias"];
			echo '</div><div class="h10"></div></div>';
		}
	?>


</div>