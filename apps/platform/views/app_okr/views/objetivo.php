<?php

	$levelN 	= 1;

	include "tool/sel_week.php";

	$level 		= "Objetivo";
	$next 		= "KR";
	$zona 		= $_TUCOACH->get_data("grw_okr_objetivos", " AND id = ".$geton[2]." AND inactivo = 0 AND inactivo = 0 ", 0);
	$tabla_p	= "grw_okr_objetivos";
	$tabla_h	= "grw_okr_krs";
	$condition 	= " id_objetivo = ".$zona["id"];

	$superior   = $proyecto;

	include "components/balance.php";

?>

<?php echo '<script>setTimeout(function(){ Ion.get_hijos2(2, '.$geton[2].', '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1000);</script>'; ?>

<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">KRS</div>

	<div class="pLR20 bGray">
		<div class="nivel-2" id="nivel-2-<?= $geton[2]; ?>"></div>
	</div>

</div>