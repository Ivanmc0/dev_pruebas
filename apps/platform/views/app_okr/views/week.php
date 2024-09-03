<?php

	$levelN 	= 0;

	include "tool/sel_week.php";

	$level 		= "Proyecto";
	$next 		= "Objetivo";
	$zona 		= $proyecto;
	$tabla_p	= "grw_okr_proyectos";
	$tabla_h	= "grw_okr_objetivos";
	$condition 	= " id_proyecto = ".$proyecto["id"];

	$superior   = $proyecto;


	include "components/balance.php";

?>



<?php echo '<script>setTimeout(function(){ Ion.get_hijos2(1, '.$_SESSION["thisProject"].', '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1000);</script>'; ?>

<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Objetivos</div>

	<div class="pLR20 bGray">
		<div class="nivel-1" id="nivel-1-<?= $_SESSION["thisProject"]; ?>"></div>
	</div>

</div>