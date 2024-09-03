<?php if(!isset($geton[2])){ ?>

<?php $trabajadores	= $_TUCOACH->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1); ?>

<div class="bfff p4020 bBS1 bCeee mb20">
    <div class="ff3 tU t24 colorMorado2">Responsabilidades de</div>
</div>

<div class="posR max700 mAUTO">
    <div class="t16 taC mb10">Seleccione un trabajador para ver sus responsabilidades</div>
    <select class="bS1 rr5 w100 selectpicker" onchange="location = this.value;" data-live-search="true" name="id_responsable" id="id_responsable">
        <option value="0">Seleccione</option>
        <?php if($trabajadores){ foreach($trabajadores AS $trabajador){ ?>
            <option value="<?= ($trabajador["id"]); ?>" data-subtext="<?= ($trabajador["identificacion"]); ?>"><?= ($trabajador["nombre"]); ?></option>
        <?php } } ?>
    </select>
</div>

<?php
}else{
    include "tool/sel_week.php";
    $trab	= $_TUCOACH->get_data("zoom_users", " AND id = ".$geton[2]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 0);
    if($trab){
?>

<div class="bfff p4020 bBS1 bCeee mb20">
    <div class="ff3 tU t24 colorMorado2">Responsabilidades de <?= ($trab["nombre"]); ?></div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp2(1, '.$trab["id"].', '.$_SESSION["thisProject"].', '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 300);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Objetivos</div>
	<div class="pLR20 bGray">
		<div class="nivel-1" id="nivel-1-<?= $_SESSION["thisProject"]; ?>"></div>
	</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp2(2, '.$trab["id"].', 22, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 800);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">KRs</div>
	<div class="pLR20 bGray">
		<div class="nivel-2" id="nivel-2-22"></div>
	</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp2(3, '.$trab["id"].', 33, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1300);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Acciones</div>
	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-3-33"></div>
	</div>
</div>

<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp2(4, '.$trab["id"].', 44, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 1800);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Sprints</div>
	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-4-44"></div>
	</div>
</div>


<?php echo '<script>setTimeout(function(){ Ion.get_hijosResp2(5, '.$trab["id"].', 55, '.$_SESSION["thisProject"].', '.$week["id"].', '.$today["id"].'); }, 2300);</script>'; ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">
	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Tareas</div>
	<div class="pLR20 bGray">
		<div class="nivel-3" id="nivel-5-55"></div>
	</div>
</div>


<div id="delete-taspe"></div>
<div id="rtn_tasks"></div>



<?php }else echo "Error encontrando trabajador"; } ?>