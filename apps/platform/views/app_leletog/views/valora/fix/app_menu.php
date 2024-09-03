<?php if($empresa && $empresa["logo"] != ""){ ?>
	<div class="bfff taC bBS1 bCeee pLR40">
		<img src="<?= $dominion; ?>static/logos/300/<?= ($empresa["logo"]); ?>" height="100" alt="">
	</div>
<?php } ?>

<div class="p2030 p20_oS bBS1">
	<div class="color999 ff2 mb10">Bienvenido</div>
	<div class="colorVerde ff3 t20 mb5"><?= ($trabajador["nombre"]); ?></div>
	<div class="color6666 t14 mb10">
		<span class="color333 ff2"><?= ($trabajador["cargo"]); ?></span> de
		<span class="color333 ff2"><?= ($empresa["nombre"]); ?></span>
	</div>
	<div class="color666 ff1 t14 let2 mb20">ID. <?= ($trabajador["identificacion"]); ?></div>


	<a href="<?=$dominion;?>mi-perfil-empresarial/" class="dB bfff t14 ff2 let2 colorVerde2 bHover1 p1020 bS1 bCVerde2 rr40 taC">
		<div class=""><i class="fas fa-user-circle"></i> Mi perfil</div>
	</a>

</div>

<a href="<?=$dominion;?>dashboard" class="dB bHover2 let2 p2030 bBS1 color333 ff0 t16 <?php if($geton[1] == "dashboard") echo "bRS5Verde bfff colorVerde ff2"; ?>">
	<div class="">Dashboard</div>
</a>

<!-- <a href="<?=$dominion;?>personal" class="dB bHover2 let2 p2030 bBS1 color333 ff0 t16 <?php if($geton[1] == "personal") echo "bRS5Verde bfff colorVerde ff2"; ?>">
	<div class="">Personal</div>
</a> -->
<a href="<?=$dominion;?>organizacion" class="dB bHover2 let2 p2030 bBS1 color333 ff0 t16 <?php if($geton[1] == "organizacion") echo "bRS5Verde bfff colorVerde ff2"; ?>">
	<div class="">Organización</div>
</a>
<?php if($_SESSION["WORKER"]["id"] == 21344){ ?>
<a href="<?=$dominion;?>reconocimientos" class="dB bHover2 let2 p2030 bBS1 color333 ff0 t16 <?php if($geton[1] == "reconocimientos") echo "bRS5Verde bfff colorVerde ff2"; ?>">
	<div class="">Mis reconocimientos</div>
</a>
<?php } ?>
<a id="rtn_logout" href="#" onclick="Ion.logOut()" class="dB bHover2 p2030 color999 bBS1 ff2 t12"><i class="fas fa-power-off t12"></i> &nbsp; Cerrar sesión</a>
