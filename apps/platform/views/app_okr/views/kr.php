<?php

	$levelN 	= 2;

	include "tool/sel_week.php";

	$level 		= "KR";
	$next 		= "Acción";
	$zona 		= $_TUCOACH->get_data("grw_okr_krs", " AND id = ".$geton[2]." AND inactivo = 0 AND inactivo = 0 ", 0);
	$tabla_p	= "grw_okr_krs";
	$tabla_h	= "grw_okr_acciones";
	$condition 	= " id_kr = ".$zona["id"];

	$superior   = $_TUCOACH->get_data("grw_okr_objetivos", " AND id = ".$zona["id_objetivo"]." AND inactivo = 0 AND eliminado = 0 ", 0);


	include "components/balance.php";

?>



<?php echo '<script>setTimeout(function(){ Ion.get_hijos2(3, '.$geton[2].', '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1000);</script>'; ?>

<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Acciones</div>

	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-3-<?= $geton[2]; ?>"></div>
	</div>

</div>