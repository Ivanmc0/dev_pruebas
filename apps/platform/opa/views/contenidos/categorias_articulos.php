<?php
    if($id == 0) include "proyectos.php";
    else {
        $progresa = $_TUCOACH->get_projects(" AND relrol.id_proyecto = ".$id." AND relrol.id_rol = ".$_SESSION["zoom_rol"]." ", 0);
?>

    <div class="content-body">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <div id="rtn_list" class="fR taR"></div>
                    <h4 class="card-title">Listado de <?= ($access_model["modulo"]); ?> de <?= ($progresa["proyecto"]); ?> </h4>
                </div>
                <?php
                    if($progresa) {
                        $listados = $_TUCOACH->get_data($access_model["tabla"], " AND id_proyecto = ".$id." AND eliminado = 0 ORDER BY prioridad ASC ", 1);
                        if($listados) include "listas/".($access_model["archivo"]).".php";
                        else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                    } else echo '<div class="card-title t30 taC p50">Ud no pesee permisos para acceder a esta zona</div>';
                ?>
            </div>
        </div>
    </div>

<?php } ?>