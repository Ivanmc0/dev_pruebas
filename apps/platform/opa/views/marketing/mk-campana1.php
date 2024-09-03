<div class="content-body">


        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <div id="rtn_list" class="fR taR"></div>
                    <h4 class="card-title">
                        Listado de registros -
                        <?= ($access_model["modulo"]); ?>
                    </h4>
                </div>
                <?php
                    $listados = $_TUCOACH->get_data("web_jv_registros", " AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($listados) include "listas/mk-campana1.php";
                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                ?>
            </div>
        </div>



</div>