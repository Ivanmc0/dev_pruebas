<?php $actividadmodelo    = $_ZOOM->get_data("grw_lel_dinamicas", " AND id = ".$id." ORDER BY id DESC ", 0); ?>

<div class="content-body">
    <div class="card">
        <div class="card-content collapse show">

            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">Listado de <?= ($access_model["modulo"]); ?> | <?= ($actividadmodelo["nombre"]); ?></h4>
            </div>

            <?php
                $listados = $_ZOOM->get_data($access_model["tabla"], " AND id_dinamica = ".$id." AND eliminado = 0 ORDER BY prioridad ASC ", 1);
                if($listados) include "listas/preguntas.php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>

        </div>
    </div>
</div>