<div class="bfff p4020 bBS1 bCeee mb20">
    <div class="ff3 tU t24 colorMorado2">Mis Responsabilidades</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp(1, '.$trabajador["id"].', '.$_SESSION["thisProject"].', '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 300);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Objetivos</div>
	<div class="pLR20 bGray">
		<div class="nivel-1" id="nivel-1-<?= $_SESSION["thisProject"]; ?>"></div>
	</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp(2, '.$trabajador["id"].', 22, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 800);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">KRs</div>
	<div class="pLR20 bGray">
		<div class="nivel-2" id="nivel-2-22"></div>
	</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp(3, '.$trabajador["id"].', 33, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1300);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Acciones</div>
	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-3-33"></div>
	</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp(4, '.$trabajador["id"].', 44, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1800);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Sprints</div>
	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-4-44"></div>
	</div>
</div>


<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp(5, '.$trabajador["id"].', 55, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 2300);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Tareas</div>
	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-5-55"></div>
	</div>
</div>


<div id="delete-taspe"></div>
<div id="rtn_tasks"></div>