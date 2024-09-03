<?php if(!isset($geton[2])){ ?>

    <?php $trabajadores	= $_TUCOACH->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1); ?>

    <div class="bfff p4020 bBS1 bCeee mb20">
        <div class="ff3 tU t24 colorMorado2">Tareas de</div>
    </div>

    <div class="posR max700 mAUTO">
        <div class="t16 taC mb10">Seleccione un trabajador para ver sus tareas</div>
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
    <div class="ff3 tU t24 colorMorado2">Tareas de <?= ($trab["nombre"]); ?></div>
</div>

<div class="row bS1 bCeee m0 mb50">
    <div class="col-12 col-sm-4 bGray p10">
        <?php $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND id_responsable = ".$trab["id"]." AND estado = 0 AND id_semana = ".$week["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1); ?>
        <div class="bMorado2 rr5 p1020 ff2 t18 colorfff mb20">Pendientes <span>(<?php if($get_homeworks) echo count($get_homeworks); else echo 0; ?>)</span></div>
        <div class="">
            <?php
                if($get_homeworks){
                    foreach($get_homeworks AS $tarea){
                        include "components/prev_tarea.php";
                    }
                } else echo '<div class="taC color999 t16 tU p40 ff0"><i class="fas fa-exclamation-circle colorccc t80"></i><div class="h20"></div>Sin resultados</div>';
            ?>
        </div>
    </div>
    <div class="col-12 col-sm-4 beee p10">
        <?php $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND id_responsable = ".$trab["id"]." AND estado = 1 AND id_semana = ".$week["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1); ?>
        <div class="bMorado rr5 p1020 ff2 t18 colorfff mb20">En proceso <span>(<?php if($get_homeworks) echo count($get_homeworks); else echo 0; ?>)</span></div>
        <div class="">
            <?php
                if($get_homeworks){
                    foreach($get_homeworks AS $tarea){
                        include "components/prev_tarea.php";
                    }
                } else echo '<div class="taC color999 t16 tU p40 ff0"><i class="fas fa-exclamation-circle colorccc t80"></i><div class="h20"></div>Sin resultados</div>';
            ?>
        </div>
    </div>
    <div class="col-12 col-sm-4 bGray p10">
        <?php $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND id_responsable = ".$trab["id"]." AND estado = 2 AND id_semana = ".$week["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1); ?>
        <div class="bMorado3 rr5 p1020 ff2 t18 colorfff mb20">Realizadas <span>(<?php if($get_homeworks) echo count($get_homeworks); else echo 0; ?>)</span></div>
        <div class="">
            <?php
                if($get_homeworks){
                    foreach($get_homeworks AS $tarea){
                        include "components/prev_tarea.php";
                    }
                } else echo '<div class="taC color999 t16 tU p40 ff0"><i class="fas fa-exclamation-circle colorccc t80"></i><div class="h20"></div>Sin resultados</div>';
            ?>
        </div>
    </div>
</div>



<div id="delete-taspe"></div>


<?php }else echo "Error encontrando trabajador"; } ?>