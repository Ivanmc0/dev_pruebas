<?php include "tool/sel_week.php"; ?>

<div class="bfff p4020 bBS1 bCeee">
    <div class="ff3 tU t24 colorMorado2">Mis tareas personales</div>
</div>

<?php if($_SESSION["WORKER"]["id"] == $trabajador["id"]){ ?>
    <div class="tab bMorado5 p30">
        <div class="tabIn pR30">
            <div class="t24 color666 ff3 mb5">Tareas Personales</div>
            <div class="t16 magion color999">
                Son tus tareas exclusivas, nadie más las puede ver,
                puedes crear tantas como quieras y no están sujetas a las semanas,
                te permitirán crear procesos propios para mejorar la auto-gestión de tus procedimientos.
            </div>
        </div>
        <div class="tabIn pL30 taR">
            <a data-toggle="modal" data-target="#tareapersonal_crear" class="btn btn-success bfff bCMorado colorMorado bHover2 btn-sm">Crear Tarea Personal</a>
        </div>
    </div>
<?php } ?>


<div class="row bS1 bCeee m0 mb50">
    <div class="col-12 col-sm-4 bGray p10">
        <div class="h10"></div>
        <div class="p10">
            <?php
                if($_SESSION["WORKER"]["id"] == $trabajador["id"]){
                    $mis_tps = $_TUCOACH->get_data("grw_okr_tareasprivadas", " AND estado = 0 AND id_trabajador = ".$trabajador["id"]." AND id_proyecto = ".$proyecto["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                    if($mis_tps){
                        foreach($mis_tps AS $tarea) include "components/prev_tarea_personal.php";
                    }
                }
            ?>
        </div>
    </div>
    <div class="col-12 col-sm-4 beee p10">
        <div class="h10"></div>
        <div class="p10">
            <?php
                if($_SESSION["WORKER"]["id"] == $trabajador["id"]){
                    $mis_tps = $_TUCOACH->get_data("grw_okr_tareasprivadas", " AND estado = 1 AND id_trabajador = ".$trabajador["id"]." AND id_proyecto = ".$proyecto["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                    if($mis_tps){
                        foreach($mis_tps AS $tarea) include "components/prev_tarea_personal.php";
                    }
                }
            ?>
        </div>
    </div>
    <div class="col-12 col-sm-4 bGray p10">
        <div class="h10"></div>
        <div class="p10">
            <?php
                if($_SESSION["WORKER"]["id"] == $trabajador["id"]){
                    $mis_tps = $_TUCOACH->get_data("grw_okr_tareasprivadas", " AND estado > 1 AND id_trabajador = ".$trabajador["id"]." AND id_proyecto = ".$proyecto["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($mis_tps){
                        foreach($mis_tps AS $tarea) include "components/prev_tarea_personal.php";
                    }
                }
            ?>
        </div>
    </div>
</div>





<div id="delete-taspe"></div>
<div id="rtn_tasks"></div>