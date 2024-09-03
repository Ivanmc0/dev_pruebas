<?php
    $tablus         = $access_model["tabla"];
    $getThis    = $_ZOOM->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
    if($getThis){
?>

<div class="content-body">

    <h4 class="tU t30 tB teal mb20"><?= ($getThis["nombre"]); ?></h4>

    <div class="card">
        <div class="card-content collapse show">

            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">Tipos de <?= ($getThis["nombre"]); ?></h4>
            </div>

            <?php
                if($getThis["nombre"] == "Encuesta"){
                    $listados = $_ZOOM->get_data("olc_modelos", " AND eliminado = 0 ORDER BY id ASC ", 1);
                    if($listados) include "modelos/encuestas/listas/tipos.php";
                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                }else if($getThis["nombre"] == "Mensaje"){
                    $listados = $_ZOOM->get_data("olc_modelos", " AND eliminado = 0 ORDER BY id ASC ", 1);
                    if($listados) include "modelos/mensajes/listas/tipos.php";
                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                }
            ?>

        </div>
    </div>


    <div class="h50"></div>


</div>

<?php } else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>'; ?>