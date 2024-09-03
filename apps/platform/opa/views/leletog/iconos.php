<div class="content-body">
    <div class="card">
        <div class="card-content collapse show">

            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">
                    <a href="https://icons8.com/line-awesome" target="_blank" class="fR">Buscador de iconos</a>
                    Listado de <?= ($access_model["modulo"]); ?>
                </h4>
            </div>

            <?php
                $listados = $_ZOOM->get_data($access_model["tabla"], " AND eliminado = 0 ORDER BY id ASC ", 1);
                if($listados) include "listas/".($access_model["archivo"]).".php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>

        </div>
    </div>
</div>