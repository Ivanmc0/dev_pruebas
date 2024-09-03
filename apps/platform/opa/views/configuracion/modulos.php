<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">Listado de <?= ($access_model["modulo"]); ?></h4>
            </div>
            <?php
                $models = $_TUCOACH->get_data("zoom_models", " AND id_modulo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                if($models) include "listas/modulos.php";
            ?>
        </div>
    </div>

</div>