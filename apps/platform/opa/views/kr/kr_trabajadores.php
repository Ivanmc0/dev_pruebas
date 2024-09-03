<div class="content-body">

    <?php if($id == 0){ ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <div id="rtn_list" class="fR taR"></div>
                    <h4 class="card-title"><?= ($access_model["modulo"]); ?></h4>
                </div>
                <?php
                    $listados = $_TUCOACH->get_data("olc_empresas", " AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($listados) include "listas/empresas.php";
                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                ?>
            </div>
        </div>

    <?php }else{ ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <div id="rtn_list" class="fR taR"></div>
                    <h4 class="card-title">
                        Listado de trabajadores -
                        <?= ($access_model["modulo"]); ?>:
                        <strong>
                            <?php
                                $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = $id AND eliminado = 0 ORDER BY id DESC ", 0);
                                if($empresa) echo ($empresa["nombre"]);
                            ?>
                        </strong>
                    </h4>
                </div>
                <?php
                    $complemento = " AND id_empresa = $id ";
                    $evaluadores = $_TUCOACH->get_data("zoom_users", $complemento." AND eliminado = 0 ORDER BY nombre ASC ", 1);
                    if($evaluadores) include "listas/trabajadores.php";
                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                ?>
            </div>
        </div>

    <?php } ?>


</div>