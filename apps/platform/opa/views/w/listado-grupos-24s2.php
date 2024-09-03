<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">Listado de <?= ($access_model["modulo"]); ?> </h4>
            </div>
            <?php

                $programa = $access_model["id"] == 3031 ? 2 : 1;

                $sesiones = $_ZOOM->get_data("grw_rkg_sesiones", " AND id_programa = $programa AND eliminado = 0 ORDER BY id_grupo ASC, numero ASC ", 1);

                foreach ($sesiones as $key => $sesion) {

                    $listados[$sesion["id_grupo"]][$sesion["numero"]] = [
                        "id_modulo" => $sesion["id_modulo"],
                        "id_sesion" => $sesion["id"]
                    ];

                }

                $grupos  = $_ZOOM->order_id_array($_ZOOM->get_data("grw_grupos", " AND id_empresa = 100100 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
                $modulos = $_ZOOM->order_id_array($_ZOOM->get_data("grw_rkg_modulos", " AND id_empresa = 100100 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));

                if($listados) include "listas/".($access_model["archivo"]).".php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';

            ?>
        </div>
    </div>


</div>