<div class="posR p20 taC">

	<div class="posR mb20">
	
		<div class="posR rr50" style="overflow:hidden;">
			<img src="<?= $dominion; ?>resources/collaborators/<?= $colaborador["foto"]; ?>" alt="">
		</div>
		<a href="<?= $colaborador["linkedin"]; ?>" target="_blank" class="posA wh40 bShadow rr50 t24 bMorado2 colorfff bHover" style="left:30px; bottom:30px;">
			<div class="vMM">
				<i class="lab la-linkedin"></i>
			</div>
		</a>

	</div>
	
	<div class="w80 mAUTO">
		<div class="tU colorMorado ff4 t18 mb5"><?= $colaborador["nombre"]; ?></div>
		<div class="colorMorado2 ff2 t16 mb10"><?= $colaborador["cargo"]; ?></div>
		<div class="color666 ff1 t14"><?= $colaborador["titulo"]; ?></div>
	</div>

</div>