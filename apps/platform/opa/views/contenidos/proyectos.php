<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">Listado de Proyectos</h4>
            </div>
            <?php
                $listados = $_TUCOACH->get_projects(" AND relrol.id_rol = ".$_SESSION["zoom_rol"]." ", 1);
                if($listados) include "listas/proyectos.php";
                else echo '<div class="card-title t30 taC p50">No tiene acceso a ningún proyecto</div>';
            ?>
        </div>
    </div>

</div>