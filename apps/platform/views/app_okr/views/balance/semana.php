<?php
	if($_SESSION["WORKER"]["id"] == 800){
		echo '<pre>';
		//print_r($semanal);
		echo '</pre>';
	}
?>

<div class="tab mb20">
	<div class="tabIn">
		<div class="ff1 t18 tU colorMorado mb5">Semana <?= $this_semana["semana"]; ?></div>
		<div class="color999 ff0 t16">Esta semana tiene <span class="ff3"><?php if(isset($semanal["tareas"])) echo count($semanal["tareas"]); else echo 0; ?></span> Tareas</div>
	</div>
	<div class="tabIn taR">
		<?php if($this_sprint["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
			<a data-toggle="modal" data-target="#tarea_crear" class="btn btn-success bfff bCMorado colorMorado bHover2 btn-sm">Crear Tarea</a>
		<?php } ?>
	</div>
</div>

<?php
	$bbb = $semanal;
	include "prev_balance.php";
?>