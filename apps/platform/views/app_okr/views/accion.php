<?php

	$levelN 	= 3;

	include "tool/sel_week.php";

	$level 		= "Acción";
	$next 		= "Sprint";
	$zona 		= $_TUCOACH->get_data("grw_okr_acciones", " AND id = ".$geton[2]." AND inactivo = 0 AND inactivo = 0 ", 0);
	$tabla_p	= "grw_okr_acciones";
	$tabla_h	= "grw_okr_sprints";
	$condition 	= " id_accion = ".$zona["id"];

	$superior   = $_TUCOACH->get_data("grw_okr_krs", " AND id = ".$zona["id_kr"]." AND inactivo = 0 AND eliminado = 0 ", 0);

	include "components/balance.php";

?>



<?php echo '<script>setTimeout(function(){ Ion.get_hijos2(4, '.$geton[2].', '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1000);</script>'; ?>

<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Sprints</div>

	<div class="pLR20 bGray">
		<div class="nivel-4" id="nivel-4-<?= $geton[2]; ?>"></div>
	</div>

</div>