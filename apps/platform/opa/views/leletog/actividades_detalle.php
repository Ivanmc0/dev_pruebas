<?php
$tablus         = $access_model["tabla"];

$getThis    = $_ZOOM->get_data($tablus, " AND id = " . $id . " ORDER BY id DESC ", 0);


if ($getThis) {

    // $getThis    = $_ZOOM->get_data(, " AND id = " . $id . " ORDER BY id DESC ", 0);

    $listModelos    = $_ZOOM->order_array_by($_ZOOM->get_data("olc_modelos", " AND inactivo = 0 AND eliminado = 0 ", 1), "id");
    $listTipos      = $_ZOOM->order_array_by($_ZOOM->get_data("olc_modelos_tipos", " AND inactivo = 0 AND eliminado = 0 ", 1), "id");

?>

    <div class="content-body">

        <h4 class="tU t30 tB teal mb20"><?= ($getThis["nombre"]); ?></h4>

        <div class="card">
            <div class="card-content collapse show">

                <div class="card-header">
                    <div id="rtn_list" class="fR taR"></div>
                    <h4 class="card-title">Contenido interactivo</h4>
                </div>

                <?php
                $listados = $_ZOOM->get_data("grw_lel_dinamicas", " AND id_actividad = " . $id . " AND eliminado = 0 ORDER BY prioridad ASC ", 1);
                if ($listados) include "listas/interactivo.php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                ?>

            </div>
        </div>

    </div>

<?php } else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>'; ?>