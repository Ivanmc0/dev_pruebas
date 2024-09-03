<?php include "tool/sel_week.php"; ?>

<div class="bfff p4020 bBS1 bCeee mb20">
    <div class="ff3 tU t24 colorMorado2">Mis tareas</div>
</div>

<div class="row bS1 bCeee m0 mb50">
    <div class="col-12 col-sm-4 bGray p10">
        <?php $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND estado = 0 AND id_semana = ".$week["id"]." AND id_responsable = ".$trabajador["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1); ?>
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
        <?php $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND estado = 1 AND id_semana = ".$week["id"]." AND id_responsable = ".$trabajador["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1); ?>
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
        <?php $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND estado = 2 AND id_semana = ".$week["id"]." AND id_responsable = ".$trabajador["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1); ?>
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